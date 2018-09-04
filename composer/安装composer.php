<?php
/*
一、安装composer

   参考文献: https://pkg.phpcomposer.com/

   下载：  composer.phar  https://getcomposer.org/download/


   *****************************************

   注意：安装的前提条件

   要求：
    .php版本要求:>=5.5.9;
 		.OpenSSL扩展          extension=php_openssl.dll
 		.PDO扩展              extension=php_pdo_mysql.dll
 		.Mbstring扩展         extension=php_mbstring.dll

   如何实施： 修改php.ini文件  开启   注意(集成包,有可能出现多个extension=php_pdo_mysql.dll, 只需要开启一个,开启两个会报错)

   php的环境变量设置好 php.exe加入环境变量

   如何在win下设置全局环境变量

   1. 查看软件的安装地址 ，复制地址
   2. 点击 我的电脑 右击-->属性-->高级系统设置 --> 环境变量 --> 系统变量 --> PATH 里面 接着写  ;软件地址 （注意前面的';'一定不能丢掉）

  **********************************************


   有两种安装情况(局部安装和全局安装)  这里介绍和推荐全局安装

   不同系统环境下的全局安装， 如下：

   第一种   在 mac 和 linux下 ：

   1. 将下载好的 composer.phar 文件移动到 /usr/local/bin/ 目录下面
   2. 将文件 composer.phar 重命名为 composer (修改此文件的权限755)
   3. 测试是否可以正常使用：  composer -v 或者 composer 查看是否可以出现标志物（注意测试的界面） xhell

   第二种  在 win 下：

  1. 进入 PHP 的安装目录
  2. 将 composer.phar 复制到 PHP 的安装目录下面，也就是和 php.exe 在同一级目录。
  3. 在 PHP 安装目录下新建一个 composer.bat 文件， 文件内容为： @php "%~dp0composer.phar" %*
  4. 测试是否可以正常使用：  composer -v 或者 composer 查看是否可以出现标志物 （注意测试的界面） cmd


二、配置composer国内全局镜像    (通用 win  mac linux )

   composer config -g repositories.packagist composer https://packagist.phpcomposer.com


三、 使用 composer

  1. search 搜索

  2. show 展示

  3. require 申明依赖

  4. install 安装

  5. update  更新

  首先： 来到项目目录下： 如： d:/xampp/htdocs/demo/下
  然后： composer init  初始化
  之后： 输入名字： imooc/lijian （自定义） 回车
  在后： 输入描述： test composer (自定义)
  之后： 两个回车  出现输入：要安装的软件包  如： library
  之后： 回车 ， 回车 ， 回车
  最后： 出现 Do you confirm generation ? yes  输入yes 回车



 你在使用一个库时， 应该先搜索这个库，看这个库是否是存在的  composer search 库名      eg： composer search monolog

 你还可以查看这个库的所有信息： composer show --all monolog/monolog(库名)

 填写 composer.json 文件  如下：

 {
    "name": "imooc/test",
    "description": "test composer",
    "type": "library",
    "authors": [
        {
            "name": "lijian",
            "email": "852688838@qq.com"
        }
    ],
    "require": {
	   "monolog/monolog": "1.21.*"      /**************这里填写*************//*
	}
}

保存,退出文件  composer.json

composer  install


注意 ： composer require symfony/http-foundation    这个是直接运行， 就可以直接下载, 不用修改 composer.json文件

 */
