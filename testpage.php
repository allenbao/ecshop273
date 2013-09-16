<?php
define('IN_ECS', true);

require(dirname(__FILE__) . '/includes/init.php');

assign_template();

$position=assign_ur_here();

/* 缓存编号 */
$cache_id = sprintf('%X', crc32($_SESSION['user_rank'] . '-' . $_CFG['lang']));

$smarty->assign('page_title',$position['title']);
$smarty->assign('ur_here',$position['ur_here']);

$smarty->assign('keywords',        htmlspecialchars($_CFG['shop_keywords']));
$smarty->assign('description',     htmlspecialchars($_CFG['shop_desc']));
$smarty->assign('flash_theme',     $_CFG['flash_theme']);  // Flash轮播图片模板

$smarty->assign('feed_url',        ($_CFG['rewrite'] == 1) ? 'feed.xml' : 'feed.php'); // RSS URL
 
$smarty->assign('index_ad',     $_CFG['index_ad']);
if ($_CFG['index_ad'] == 'cus')
{
	$sql = 'SELECT ad_type, content, url FROM ' . $ecs->table("ad_custom") . ' WHERE ad_status = 1';
	$ad = $db->getRow($sql, true);
	$smarty->assign('ad', $ad);
}



$smarty->assign('shop_notice',     $_CFG['shop_notice']);       // 商店公告
$smarty->assign('categories',      get_categories_tree());      // 分类树
$smarty->assign('invoice_list',    index_get_invoice_query());  // 发货查询


$smarty->assign('best_goods',      get_recommend_goods('best'));    // 推荐商品
$smarty->assign('promotion_goods', get_promote_goods());            // 特价商品
$smarty->assign('brand_list',      get_brands());                   // 品牌  



/* 页面中的动态内容 */
//assign_dynamic('index2');

$smarty->display('test.dwt',$cache_id);


/**
 * 调用发货单查询
 *
 * @access  private
 * @return  array
 */
function index_get_invoice_query()
{
	$sql = 'SELECT o.order_sn, o.invoice_no, s.shipping_code FROM ' . $GLOBALS['ecs']->table('order_info') . ' AS o' .
			' LEFT JOIN ' . $GLOBALS['ecs']->table('shipping') . ' AS s ON s.shipping_id = o.shipping_id' .
			" WHERE invoice_no > '' AND shipping_status = " . SS_SHIPPED .
			' ORDER BY shipping_time DESC LIMIT 10';
	$all = $GLOBALS['db']->getAll($sql);

	foreach ($all AS $key => $row)
	{
		$plugin = ROOT_PATH . 'includes/modules/shipping/' . $row['shipping_code'] . '.php';

		if (file_exists($plugin))
		{
			include_once($plugin);

			$shipping = new $row['shipping_code'];
			$all[$key]['invoice_no'] = $shipping->query((string)$row['invoice_no']);
		}
	}

	clearstatcache();

	return $all;
}

?>