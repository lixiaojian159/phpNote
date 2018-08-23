<?php

/*

学习大纲

文件/目录操作 : 创建,查看,移动,改名,删除,复制

用户/组管理: 创建组/用户,删除组/用户

权限管理: 查看/修改权限

进程管理: 查进程,杀进程

打包解压: .gz .bz 这样的压缩文件操作

软件安装: yum 安装 编译安装

编辑器: vim

网络配置

实战达标:

安装 Linux,配置上网,配置 lnmp 环境(nginx+mysql+php)



提升要求:

shell 定时任务, 定期备份









1.查看系统版本   uname -r

2.系统安装:  手动分区和自动分区       由于内存大了, 一般现在都是自动分区
 
  如果是手动分区, 记得有根分区和swap分区
  
  linux 一切皆文件 


3.关机  shutdown    或者   init 0

4.重启  reboot      或者   init 6


5. 超级管理员  root


6. 图形界面进入字符界面  init 3

   字符界面进入图形界面  startx


7. 地址定位： 相对地址和绝对地址

   例子： cd /usr/local/bin   绝对地址


8. 切换目录  cd /user/local/bin     

             ./    .   当前目录

             ../       上一级目录 

    查询当前的目录地址 pwd


9. 创建目录  mkdir  
        
            mkdir test

            mkdir tes1 test2 test3

            mkdir dir{1,2,3}


10. 创建普通空文件   
               
            touch  testname 
    
    删除普通文件 

            rm    testname

            rm -f  testname    (强制删除,没有提示) 

            rm -rf  test  如果文件夹下有文件夹有文件 可以用递归的方式删除


10. 删除文件夹  rmdir


11. 查看文件  ls    或者    ll  

    查看隐藏文件  ls -a *********


12. 复制文件  cp  被复制文件(地址)   复制的地址(绝对地址, 相对地址) 

13. 移动文件  mv  被移动文件(地址)   移动到的地址(绝对, 相对)

14. 创建快捷方式   ln -s  被指快捷方式的地址(原文件)   快捷方式的地址(快捷方式)

15. 创建一个空文件  touch  name

    在这个文件中输入内容    vi  name 

    保存这个文件的内容   ESC   ：wq  

    读取这个文件的内容   more name
                       cat name      读取到屏幕
                       head -2 name  读取文件前两行
                       tail -3 name  读取文件最后3行
                       less name     类似more name

    把文件a的内容覆盖到b文件里面  cat  a > b   (如何b文件有内容则把就内容覆盖)

    把文件a的内容追加到b文件里面  cat  a >> b  (在b原有的内容后面继续添加a的内容) 


    /dev/null    就是一个垃圾占, 扔进去的东西都没了


    查找相关内容      grep  查找内容   在哪个文件查找



16.  打包压缩, 解压拆包

     
    打包, 拆包

    a . 打包   tar -cvf    包名  被打包a   被打包b   被打包c

    b . 查看打包文件的内容   tar -tvf 包名

    c . 拆包                tar -xvf 包名 


    压缩, 解压

    gz格式     gzip  要被压缩的文件名     (会删除原文件)      gzip -c  test > test.gz   (不删除原文件)

               gzip -d  要被解压的文件名      


    还有其他格式



17. 查找文件   find  查找路径(默认是当前)  查找方式  查找目标

              find  ./ -name  a.gz



              find ./ -empty 在当前目录下查找出空文件或空文件夹

              find ./ -name filename 在当前目录下模糊查找出含有filename的文件
            
              find ./ -amin -10 从当前目录下查找出最后10分钟访问的文件
            
              find ./ -atime -2 从当前目录下查找出最后48小时访问的文件

              find ./ -mmin -5 从当前目录下查找最后5分钟内修改过的文件
              
              find ./ -mtime -1 从当前目录下查找最后24小时内修改过的文件(此处数字不代表小时而是天数)

              find / -nouser 从系统中查找出作废用户的文件
              
              find / -user dengpeng 从系统中查找出属于dengpeng这个用户的文件
 
              find ./ -name "*.txt"|xargs grep "hello" 从当前目录中找出以".txt"结尾同时含有"hello"关键词的文件(注意:如果只找出1个文件,则不显示文件名)


18. 查看当前用户    whoami

19. 查看命令的发出   whereis cd                       where is touch

20. 查看内存使用情况   free -h


21. 查看系统中的进程       ps -aus

    查看系统中nginx进程    ps -aus|grep nginx

    杀死某个进程           kill  

    pkill 进程名 杀死系统进程中所有包含"进程名"的进程




22. 挂载    linux下一切皆文件

            
            mount 挂载命令

            umount 删除挂载


            例子:


            在 /mnt文件夹下创建 cdrm文件夹

            mount  /dev/cdrom(固定)  /mnt/cdrm     添加挂载

            umount  /mnt/cdrm/  卸载挂载点


23.  vim/vi 编辑器

     安装：  在根目录下,  yum install vim

     vim  文件名

     a s i o 修改文件

     esc 退出  ：q 退出(没修改时)   ：q!  强制退出     :wq 保存退出



24. 网络配置 

    配置文件  /etc/sysconfig/network-scripts/ifcfg-eth0

    vim  /etc/sysconfig/network-scripts/ifcfg-eth0
      
    文件内容:
    
    网卡的配置文件的常用字段释义:

	TYPE=Ethernet 网卡类型
    DEVICE=eth0 网卡接口名称
    ONBOOT=yes 系统启动时是否自动启动网卡 ***
    BOOTPROTO=static  (地址协议 static 静态的手动配置ip地址 dhcp 自动获取ip地址)***
    IPADDR=192.168.1.11 该块网卡的ip地址(1-255) ***
    NETMASK=255.255.255.0 该块网卡的子网掩码  （固定）
    GATEWAY=192.168.1.1 网关  ****
    HWADDR=00:0C:29:13:5D:74 该块网卡的mac地址,即物理地址

    网络配置时的常用命令

    service iptables top    关闭防火墙
	service network stop/start/restart 停止/开启/重启网卡
	ifdown eth0 关闭eth0网卡
	ifup eth0 开启eth0网卡
	ifconfig 查看网络配置信息(所有网卡)


25. 用户和组

    /home   目录下  放置的是普通用户

    /root   目录下  放置的是root超级用户



26. rpm 安装    


    rpm  -i  包名            安装

    rpm  -q  包名(去掉后缀)   查询是否安装

    rpm  -e  包名(去掉后缀)   卸载


27. yum 安装  

    yum install 包名   安装

    yum list   查询所有安装

    yum list   包名(去掉后缀) 查询某个包名 

    yum remove 包名(去掉后缀)  卸载


28.  手动编译软件(三部曲)

    .configure  

    make
     
    make install




    新增：

    从服务器端代码下载到本地：  使用FTP软件