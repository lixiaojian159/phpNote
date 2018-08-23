<?php

/*
  本地：
  1.   来到项目目录下    composer create-project laravel/laravel Laravel --prefer-dist "5.5.*"  

  2.   设置本地的的 .env 文件 （也可以不设置）

  3.   通过 git 上传到 gitHub， 首先：git init(初始化)
                               然后: git add .
                               然后：git commit -m'注释'
                               然后：在 gitHub上新建一个项目 得到 https或者 ssh
                               然后：回到本地命令行 git remote add origin https地址
                               然后：git push origin master
                               去 github 看是否上传成功
  注意事项:
        laravel 项目上传时会有一个忽略文件 .gitignore 这个文件里面的东西都不会上传到远程 gitHub
        .gitignore文件里面 有个 vendor 文件,这个文件时laravel项目所需的第三方包,服务器上的项目也是需要的,但是不上传,也许是因为太大太多文件、
        解决办法：
        在服务器上把laravel项目从gitHub上拉下来后, 在服务器上运行 composer update 、 (composer install)
 */

/*
  服务器：

   1.  来到 要放项目的根目录 /home/www/（习惯）

   2.  从 gitHub上 把项目拉下来  git clone https路径

   3.  项目里面没 .env 文件 需要复制一个 cp .env.example .env  修改里面的配置内容,
                                                                第一：APP_KEY= 是空的 ，从本地项目的 .env复制过来就好

                                                                第二：数据库设置
                                                                      DB_CONNECTION=mysql
                                                                      DB_HOST=127.0.0.1       //数据库也是在服务器上，所以它相对于服务器就是本地
                                                                      DB_PORT=3306            //端口
                                                                      DB_DATABASE=laravel54   //库名
                                                                      DB_USERNAME=root        //数据库用户名
                                                                      DB_PASSWORD=            //数据库密码
   4. 执行数据迁移文件  php artisan migrate 创建项目需要的表和数据

 */


  /*
  服务器  nginx 的配置文件:

    1. 配置文件地址： /etc/nginx/nginx.conf

    2. 配置文件的内容：
    server {
          listen       80 default_server;
          listen       [::]:80 default_server;
          server_name  _;
          root         /home/www/jianshu/public/;  //设置 ： 你的项目根目录

          # Load configuration files for the default server block.
          include /etc/nginx/default.d/*.conf;

          location /{
                 index index.php index.html index.htm;            // 设置： 可以识别或者可以解析的文件格式
                 try_files $uri $uri/ /index.php?$query_string;   // 设置:  不设置的话, 项目只能访问项目根目录,不鞥访问别的页面
           }

          location ~ \.php(.*)$ {             //整个：必须,不能少了这里的内容
              fastcgi_pass   127.0.0.1:9000;
              fastcgi_index  index.php;
              fastcgi_split_path_info  ^((?U).+\.php)(/?.+)$;
              fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
              fastcgi_param  PATH_INFO  $fastcgi_path_info;
              fastcgi_param  PATH_TRANSLATED  $document_root$fastcgi_path_info;
              include        fastcgi_params;
          }

          error_page 404 /404.html;
              location = /40x.html {
          }

          error_page 500 502 503 504 /50x.html;
              location = /50x.html {
          }
    }

   */


  /*
    设置 本地与服务器代码的连同 远程编辑

    以 sublime为例

           1. 用 controller Package 安装 sftp 插件

           2. 设置文件 sftp-config.json 放在项目根目录

              sftp-config.json  文件内容:

            {
               "type": "sftp",

                "save_before_upload": true,
                "upload_on_save": true,
                "sync_down_on_open": false,
                "sync_skip_deletes": false,
                "sync_same_age": true,
                "confirm_downloads": false,
                "confirm_sync": true,
                "confirm_overwrite_newer": false,

                "host": "58.87.111.55",       //主机的地址
                "user": "root",               //主机的用户名
                "password": "lj723945031ZN",  //主机的密码
                "port": "22",                 //主机的端口(一般是固定的)

                "remote_path": "/home/www/jianshu/",   // 项目的根目录(注意：与 nginx 的配置文件的根目录有所不同)
                "ignore_regexes": [
                    "\\.sublime-(project|workspace)", "sftp-config(-alt\\d?)?\\.json",
                    "sftp-settings\\.json", "/venv/", "\\.svn/", "\\.hg/", "\\.git/",
                    "\\.bzr", "_darcs", "CVS", "\\.DS_Store", "Thumbs\\.db", "desktop\\.ini"
                ],
                "connect_timeout": 30,
             }

   */

/*
  最后：注意事项

       1. 项目运行时 需要记录日志 日志在 storage 文件夹下  需要读写的权限   来到 storage 文件夹下  运行  chown php-fpm:php-fpm ./ -R  ****

       2. 记得下载 laravel 项目需要的第三方类包 composer update 或者 (composer install) 或者 (composer dump-autoload)
 */
