<!-- $Id: pack_list.htm 14216 2008-03-10 02:27:21Z testyang $ -->

<?php if ($this->_var['full_page']): ?>
<?php echo $this->fetch('pageheader.htm'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,listtable.js')); ?>
<!-- start goods list -->
<form method="post" action="" name="listForm">
<div class="list-div" id="listDiv">
<?php endif; ?>
  <table cellpadding="3" cellspacing="1">
    <tr>
      <th><a href="javascript:listTable.sort('pack_name'); "><?php echo $this->_var['lang']['pack_name']; ?></a><?php echo $this->_var['sort_pack_name']; ?></th>
      <th><a href="javascript:listTable.sort('pack_fee'); "><?php echo $this->_var['lang']['pack_fee']; ?></a><?php echo $this->_var['sort_pack_fee']; ?></th>
      <th><a href="javascript:listTable.sort('free_money');"><?php echo $this->_var['lang']['free_money']; ?></a><?php echo $this->_var['sort_free_money']; ?></th>
      <th><?php echo $this->_var['lang']['pack_desc']; ?></th>
      <th><?php echo $this->_var['lang']['handler']; ?></th>
    </tr>
    <?php $_from = $this->_var['packs_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'pack');if (count($_from)):
    foreach ($_from AS $this->_var['pack']):
?>
    <tr>
      <td class="first-cell">
        <?php if (( $this->_var['pack']['pack_img'] )): ?><a href = "../data/packimg/<?php echo $this->_var['pack']['pack_img']; ?>" target="_brank"><img src="images/picflag.gif" width="16" height="16" border="0" alt="" /></a><?php else: ?><img src="images/picnoflag.gif" width="16" height="16" border="0" alt="" /><?php endif; ?>
        <span onclick="listTable.edit(this, 'edit_name', <?php echo $this->_var['pack']['pack_id']; ?>)"><?php echo htmlspecialchars($this->_var['pack']['pack_name']); ?></span>
      </td>
      <td align="right"><span onclick="listTable.edit(this, 'edit_pack_fee', <?php echo $this->_var['pack']['pack_id']; ?>)"><?php echo $this->_var['pack']['pack_fee']; ?></span></td>
      <td align="right"><span onclick="listTable.edit(this, 'edit_free_money', <?php echo $this->_var['pack']['pack_id']; ?>)"><?php echo $this->_var['pack']['free_money']; ?></span></td>
      <td><?php echo htmlspecialchars(sub_str($this->_var['pack']['pack_desc'],50)); ?></td>
      <td align="center" nowrap="true" valign="top">
        <a href="?act=edit&amp;id=<?php echo $this->_var['pack']['pack_id']; ?>" title="<?php echo $this->_var['lang']['edit']; ?>"><img src="images/icon_edit.gif" border="0" height="16" width="16"></a>
        <a href="javascript:;" onclick="listTable.remove(<?php echo $this->_var['pack']['pack_id']; ?>, '<?php echo $this->_var['lang']['drop_confirm']; ?>')" title="<?php echo $this->_var['lang']['remove']; ?>"><img src="images/icon_drop.gif" border="0" height="16" width="16"></a>
      </td>
    </tr>
    <?php endforeach; else: ?>
    <tr><td class="no-records" colspan="10"><?php echo $this->_var['lang']['no_records']; ?></td></tr>
    <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
  </table>

  <table cellpadding="4" cellspacing="0">
    <tr>
      <td align="right"><?php echo $this->fetch('page.htm'); ?></td>
    </tr>
  </table>
<?php if ($this->_var['full_page']): ?>
</div>
<!-- end goods list -->
</form>

<script type="text/javascript" language="JavaScript">
listTable.recordCount = <?php echo $this->_var['record_count']; ?>;
listTable.pageCount = <?php echo $this->_var['page_count']; ?>;
<?php $_from = $this->_var['filter']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
listTable.filter.<?php echo $this->_var['key']; ?> = '<?php echo $this->_var['item']; ?>';
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

<!--
onload = function()
{
  // ��ʼ��鶩��
  startCheckOrder();
}
//-->
</script>

<?php echo $this->fetch('pagefooter.htm'); ?>
<?php endif; ?>