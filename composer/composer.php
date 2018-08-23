<?php

/*


一、安装composer

  要求： php版本要求:>=5.5.9;
		.OpenSSL扩展          extension=php_openssl.dll
		.PDO扩展              extension=php_pdo_mysql.dll
		.Mbstring扩展         extension=php_mbstring.dll

  如何实施： 修改php.ini文件  开启   注意(集成包,有可能出现多个extension=php_pdo_mysql.dll, 只需要开启一个,开启两个会报错)

  php的环境变量设置好 php.exe加入环境变量


  win下安装的方式： 两种

  一种：  官网下载exe,双击安装


  二种： 离线安装  压缩包解压到php.exe同级目录下

         1. 把php.exe所在目录的路径,加入环境变量,保证随处可以cmd下调用php命令.
         2. 把本压缩包下的`composer.bat`,`composer.phar`解压放到php.exe相同的目录下.
         3. (xampp下php目录下)



  cmd   composer -v   可以出来版本信息就证明安装成功


  配置composer国内全局镜像     composer config -g repositories.packagist composer https://packagist.phpcomposer.com



二、 composer如何使用

   1. packagist网站https://packagist.org/  都要安装的包, 

     例：在blog根目录下,用smarty包  则在blog下新建 composer.json文件 

        1. composer.json文件 内容

        {
			"require" : {
			    "smarty/smarty":"3.1.30"
			}
		}


       2. cmd  来到blog目录下   composer install

       3. 项目中如何用库,  require __DIR__."/vendor/autoload.php";

          检测是否引入库成功,      print_r(new smarty());


      注意： 如何需要多个库,  composer.json文件

            {
				"require" : {
					"smarty/smarty":"3.1.30",
					"phpmailer/phpmailer": "5.2.16"
				}
			}

	    如何碰到版本问题, 更新类库  composer update


	    卸载类库  composer remove phpmailer/phpmailer(文件名)


	2. 另一种: 简单方法  composer require phpmailer/phpmailer(文件名);

	                    想安装在哪个文件夹下, 就来到cmd 下的这个文件夹下, 执行上行

   

    小实例:  在d:/xampp/htdocs/aaa目录下安装laravel, 

             cmd 下 来到 d:/xampp/htdocs/aaa目录下, composer create-project laravel/laravel=5.5.0 (版本号)


    


