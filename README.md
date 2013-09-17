ecshop273
=========
 
GitHub For Windows 版本控制工具 （http://windows.github.com）

目前有两个网站可以同步数据：GitHub.com (共享的库免费，私有的需要支付) 和 BitBucket.org(免费的私有库，限制最多有5个团队作者使用，多则支付)


1、github.com 上传和连接到公网很好使用,这里不讲。

2、bitbucket.org 上传如下：

   首先，在Local 的 repositories 上 create a new repository 填写名字和描述、项目所在的本地存储路径，并且不选择Push to github前面的勾，然后确认创建；
   其次，选择刚才创建的库，open this repo, 进入后在顶部，一次选在tools->Settings 可以看到一个primary  remote(origin)需要填写地址，例如：git@bitbucket.org:allenbao/demoline.git，在网站https://bitbucket.org/{账号}/{当前项目名}的SSH后面找到此地址。
   最后把地址填入primary  remote(origin)后的框中，选择UPDATE保存成功！

 
