<?php

/*

一. 安装仓库


sudo yum install epel-release -y                                      EPEL

sudo yum install https://centos7.iuscommunity.org/ius-release.rpm     IUS库

为什么： 为了安装php时需要的一些扩展库


二. 安装 NGINX

NGINX 这个软件包已经包装在 EPEL 仓库里了, 所以可以直接yum

因为nginx不是centos官方yum源里，是位于第三方yum包需要安装epel , 解释为什么要安装EPEL


sudo yum install nginx -y             #安装nginx

sudo systemctl start nginx            #启动nginx

sudo systemctl enable nginx           #开启自启动



注释：sodu  是给一个普通用户使用root权限, 可以不用sodu


检测是否安装nginx成功,  关键 ： 服务启动以后，你就可以在浏览器上使用服务器的 IP 地址，或者指向这个地址的域名访问服务器指定的目录了。


如果不能正常访问：

原因：  centoe7的防火墙未关闭, 再关闭防火墙之前,设置防火墙的白名单, 端口号80或者8080

CentOS 7.0默认使用的是firewall作为防火墙


a、  关闭firewall：

systemctl stop firewalld.service #停止firewall
systemctl disable firewalld.service #禁止firewall开机启动
firewall-cmd --state #查看默认防火墙状态（关闭后显示notrunning，开启后显示running)


b、   查看已经开放的端口：

firewall-cmd --list-ports


     开启端口

firewall-cmd --zone=public --add-port=80/tcp --permanent    以80为例

上一行注释：

–zone #作用域

–add-port=80/tcp #添加端口，格式为：端口/通讯协议

–permanent #永久生效，没有此参数重启后失效

c、   重启防火墙

firewall-cmd --reload #重启firewall

关于防火墙的相关命令：

 开启    systemctl  start   firewalld.service

 关闭    systemctl  stop   firewalld.service

 查看状态  firewall-cmd    --state

 禁止开启自启动    systemctl   disable   firewalld.service


三. 配置 nginx 虚拟主机

  1.  到目录下  cd /etc/nginx/conf.d

      打开 vim test.bbs.com.conf  文件   (前提：vim提前安装好   yum install vim -y  )


      文件内容如下:  （以下两种不是两种方法都行, 情况）

    第一种：
		server {
		  listen        80;
		  server_name   test.httproot.com;    这里是域名
		  root          /var/www/laravel/public;
		  index         index.php index.html;

		  location / {
		    try_files $uri $uri/ /index.php?$query_string;
		  }

		  location ~ \.php$ {
		    fastcgi_pass 127.0.0.1:9000;
		    fastcgi_index index.php;
		    include fastcgi.conf;
		  }
		}

     第二种：
		server {
        listen 80;
        listen 443;
        ssl on;
        server_name   project.muxun.org;**********
        root          /home/car/back_end_of_meow/public;***********
        index         index.php index.html;
        ssl_certificate /home/key/1_project.muxun.org_bundle.crt;
        ssl_certificate_key /home/key/2_project.muxun.org.key;
        ssl_session_cache shared:SSL:1m;
        ssl_session_timeout 5m;
        ssl_protocols TLSv1 TLSv1.1 TLSv1.2;
        ssl_ciphers ECDHE-RSA-AES128-GCM-SHA256:ECDHE:ECDH:AES:HIGH:!NULL:!aNULL:!MD5:!ADH:!RC4;
        ssl_prefer_server_ciphers on;

        location / {
                try_files $uri $uri/ /index.php?$query_string;
        }
    }


	关键 ：  systemctl reload nginx  重启nginx


  四. 安装PHP7

前提： 安装php所依赖的扩展库

sudo yum install php70u-gd  php70u-mysqlnd php70u-pdo php70u-mcrypt php70u-mbstring php70u-json php70u-opcache php70u-xml php70u-cli -y

sudo yum install php70u-fpm -y     ＃安装php7

sudo systemctl start php-fpm        ＃ 重启php7

sudo systemctl enable php-fpm     ＃开机启动

sudo systemctl reload php-fpm      重启


测试： 运行一个php文件  echo 111;



五. 安装 MySQL / MariaDB

sudo yum install mariadb101u-server -y

如果出现冲突的提示，是因为系统本身自带 MariaDB，我们需要先删除掉系统本身带的，才能正常安装比较新的。一般可以这样来删除(不报错跳过)：
sudo yum remove mariadb-libs -y

重启mysql/mariadb

sudo systemctl start mariadb

设置开机启动

sudo systemctl enable mariadb



然后我们需要简单配置一下 mysql ，默认安装以后 mysql 的 root 用户是没有密码的，所以我们来设置一下
mysql_secure_installation


Enter current password for root (enter for none):
解释：输入当前 root 用户密码，默认为空，直接回车。
Set root password? [Y/n]  y
解释：要设置 root 密码吗？输入 y 表示愿意。
Remove anonymous users? [Y/n]  y
解释：要移除掉匿名用户吗？输入 y 表示愿意。
Disallow root login remotely? [Y/n]  n
解释：不想让 root 远程登陆吗？输入n 表示允许远程登录。
Remove test database and access to it? [Y/n]  y
解释：要去掉 test 数据库吗？输入 y 表示愿意。
Reload privilege tables now? [Y/n]  y
解释：想要重新加载权限吗？输入 y 表示愿意。


六. 部署laravel

yum install git  安装git

克隆代码到/var/www/laravel下

git clone https://git.coding.net/laravel.git(git的项目地址)



添加文件权限，否则出500错误哦

cd /var/www
chmod -R 777 vendor/ storage/ bootstrap/cache/


七.  安装 composer

curl -sS https://getcomposer.org/installer | php



运行结果如下

All settings correct for using Composer
Downloading...

Composer successfully installed to: /root/composer.phar
Use it: php composer.phar


添加composer 的环境变量

mv composer.phar /usr/local/bin/composer

测试：composer的环境变量是否修改成功  composer -V
