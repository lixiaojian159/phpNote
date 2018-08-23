<?php

/*
linux + nginx + php + mysql
网站 https://  的访问设置

1.在云服务器运营商的操作：

管理界面    a. 解析域名  b. ssl证书验证 (下载ssl证书)

2.把下载好的证书(解压缩)-->选择nginx包-->上传到linux服务器项目下

3.修改nginx的配置文件  cd /etc/nginx.conf.d  下面的配置文件

例子：

server {
        listen 80;   
        listen 443;  *********************
        ssl on;      *********************
        server_name   linshi.muxun.org;
        root          /home/car/hejiang/web;
        index         index.php index.html;
        ssl_certificate /home/car/hejiang/Nginx/1_linshi.muxun.org_bundle.crt;  **********证书地址
        ssl_certificate_key /home/car/hejiang/Nginx/2_linshi.muxun.org.key;     **********证书地址
        ssl_session_cache shared:SSL:1m;
        ssl_session_timeout 5m;
        ssl_protocols TLSv1 TLSv1.1 TLSv1.2;
        ssl_ciphers ECDHE-RSA-AES128-GCM-SHA256:ECDHE:ECDH:AES:HIGH:!NULL:!aNULL:!MD5:!ADH:!RC4;
        ssl_prefer_server_ciphers on;

        location / {
                try_files $uri $uri/ /index.php?$query_string;
        }

  location ~ \.php$ {
    fastcgi_pass 127.0.0.1:9000;


4.  重启nginx  centos7情况下  systemctl reload nginx 

5.  在浏览器中试着访问完网站域名 https://域名.com

 */