<?php

/**
 * 前提： 安装linux (目前安装centos7) 具体过程省略
 */

/**
 *  安装一些linux下常用的工具
 *  yum install vim
 *  yum install wget
 */

/**
 * 前提： 安装一些依赖库  (linux下的php和mysql还有nginx需要的依赖库)
 *  yum -y install gcc gcc-c++ autoconf libjpeg libjpeg-devel libpng libpng-devel freetype freetype-devel libxml2 libxml2-devel zlib zlib-devel glibc glibcdevel glib2 glib2-devel bzip2 bzip2-devel ncurses ncurses-devel curl curldevel e2fsprogs e2fsprogs-devel krb5 krb5-devel libidn libidn-devel openssl openssl-devel openldap openldap-devel nss_ldap openldap-clients openldapservers gd gd2 gd-devel gd2-devel perl-CPAN pcre-deve
 */


 /**
  * 安装 nginx
  *
  *  1. 在 nginx 官网下载稳定版的 nginx安装包 , 通过ftp上传到linux上
  *  2. 解压nginx包  tar zxvf nginx....
  *  3. ./configure --prefix=/usr/local/nginx   (编译三部曲之一：检测包，同时设置安装的路径)
  *  4. make (编译三部曲之二)
  *  5. make install (编译三部曲之三)
  *  注意：make  和  make install  可以合并写一起   make & make install
  *
  *  特别注意： 在 ./configure的时候,  这个时候系统检查的时候,可能会发现你还缺少其他的库，缺少哪个库，安装哪个库就好
  *
  */


/**
 *  安装php
 *
 *  1. 安装php的依赖文件 yum install gcc gcc++ libxml2-devel
 *                      yum -y install gcc-c++ gd zlib zlib-devel openssl openssl-devel libxml2 libxml2-devel libjpeg libjpeg-devel libpng libpng-devel 
 *  2. 下载php7.0版本  http://cn2.php.net/get/php-7.2.9.tar.gz/from/this/mirror
 *  3. 解压下载好的压缩包 tar -zxvf 压缩包名
 *  4. ls 查看解压出来的文件名  cd 解压后的文件目录中
 *  5.  ./configure --prefix=/usr/local/php7 --enable-fpm  回车  (configure如果成功,会报 Thank you for using php)
 *  6.  编译 make
 *  7.  make install
 *  注： 可以测试一下php, 是否成功
 *      在根目录下， vim test.php (内容：phpinfo(); )
 *      /usr/local/php7/bin/php test.php
 */

/**
 *  安装mysql
 *
 *  1系统约定
 *    安装文件下载目录：/data/software
 *    Mysql目录安装位置：/usr/local/mysql
 *    数据库保存位置：/data/mysql
 *    日志保存位置：/data/log/mysql
 *
 *  2. mkdir /data/software
 *     创建文件夹 下载安装包 建议：在windows上下载，然后用工具（filezilla）上传到 /data/software目录下;
 *
 *  3. 解压压缩包到目标位置
 *     cd /data/software
 *     tar -xzvf /data/software/mysql-5.7.21-linux-glibc2.12-x86_64.tar.gz
 *
 *  4. 移动并重命名文件夹
 *     mv /data/software/mysql-5.7.21-linux-glibc2.12-x86_64 /usr/local/mysql
 *
 *  5. 创建数据仓库目录   --/data/mysql 数据仓库目录
 *     mkdir /data/mysql
 *
 *  6. 新建mysql用户、组及目录
 *     groupadd mysql    ---新建一个msyql组
 *     useradd -r -s /sbin/nologin -g mysql mysql -d /usr/local/mysql    ---新建msyql用户
 *
 *  7. 改变目录属有者
 *     cd /usr/local/mysql
 *     chown -R mysql .
 *     chgrp -R mysql .
 *     chown -R mysql /data/mysql
 *
 *  8. 配置参数
 *    ./bin/mysqld --initialize --user=mysql --basedir=/usr/local/mysql --datadir=/data/mysql
 *    (此处需要注意记录生成的临时密码，如上文结尾处的：YLi>7ecpe;YP)
 *    ./bin/mysql_ssl_rsa_setup  --datadir=/data/mysql
 *
 *  9. 修改系统配置文件
 *     cd /usr/local/mysql/support-files
 *     cp mysql.server /etc/init.d/mysql
 *     vim /etc/init.d/mysql   修改以下内容：  basedir = /usr/local/mysql         datadir = /data/mysql
 *
 */

/**
 * 安装 nginx
 *
 *  前提： 安装一些依赖库
 *  yum -y install gcc gcc-c++ autoconf libjpeg libjpeg-devel libpng libpng-devel freetype freetype-devel libxml2 libxml2-devel zlib zlib-devel glibc glibcdevel glib2 glib2-devel bzip2 bzip2-devel ncurses ncurses-devel curl curldevel e2fsprogs e2fsprogs-devel krb5 krb5-devel libidn libidn-devel openssl openssl-devel openldap openldap-devel nss_ldap openldap-clients openldapservers gd gd2 gd-devel gd2-devel perl-CPAN pcre-deve
 *
 *  1. 在 nginx 官网下载稳定版的 nginx安装包 , 通过ftp上传到linux上
 *  2. 解压nginx包  tar zxvf nginx....
 *  3. ./configure --prefix=/usr/local/nginx   (编译三部曲之一：检测包，同时设置安装的路径)
 *  4. make (编译三部曲之二)
 *  5. make install (编译三部曲之三)
 *  注意：make  和  make install  可以合并写一起   make & make install
 *
 *  特别注意： 在 ./configure的时候,  这个时候系统检查的时候,可能会发现你还缺少其他的库，缺少哪个库，安装哪个库就好
 *
 * /
