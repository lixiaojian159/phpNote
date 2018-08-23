# 监听80端口HTTP请求，全部跳转到HTTPS
server {
        listen       80;
        if ($host = "www.jianshu.lijian159.cn"){
                return 302 https://www.jianshu.lijian159.cn$request_uri;
        }
        return 302 https://$host$request_uri;
}

server {
        listen       443;
        server_name  jianshu.lijian159.cn;

        ssl          on;
        ssl_certificate /home/www/jianshu/Nginx/1_www.jianshu.lijian159.cn_bundle.crt;
        ssl_certificate_key /home/www/jianshu/Nginx/1_www.jianshu.lijian159.cn_bundle.crt;
        ssl_session_timeout 5m;
        ssl_protocols TLSv1 TLSv1.1 TLSv1.2; #按照这个协议配置
        ssl_ciphers ECDHE-RSA-AES128-GCM-SHA256:HIGH:!aNULL:!MD5:!RC4:!DHE; #按照这个套件配置
        ssl_prefer_server_ciphers on;

        root /home/www/jianshu/public/;
        location / {
             index  index.php index.html index.htm;
             try_files $uri https://$host$1/ /index.php?$query_string;
        }

        error_page   500 502 503 504  /50x.html;
        location = /50x.html {
            root   html;
        }

        location ~ \.php$ {
            fastcgi_pass   127.0.0.1:9000;
            fastcgi_index  index.php;
            fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
            include        fastcgi_params;
        }

    }
