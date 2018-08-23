<?php

/**
*  thinkphp3.2   apache的URL重写
*
*  环境： apache   (区别：nginx)
*
*  方法：
          1.  apache配置文件 httpd.conf 中的  mod_rewrite.so, 启动此模块
          2.  AllowOverride , 值= All  (重启apache)
          3.  在项目的入口文件（index.php）的同级目录下, 新建 .htaccess文件
*
*          .htaccess文件  内容:
*          <IfModule mod_rewrite.c>
*             Options +FollowSymlinks
*             RewriteEngine on
*
*             RewriteCond %{REQUEST_FILENAME} !-d
*             RewriteCond %{REQUEST_FILENAME} !-f
*             RewriteRule ^(.*)$ index.php/$1 [QSA,PT,L]
*
*          </IfModule>
*/
