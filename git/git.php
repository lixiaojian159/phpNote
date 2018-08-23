<?php

/*   git

版本控制器

一、如何安装  windows  ios  linux

windows  安装包 下一步 ...

linux   # yum install git


二、如何使用(以windows为例)

1. 打开 git bash

2. 自曝家门

   $ git config --global user.name  lijian             (你的名字)

   $ git config --global user.email 852688838@qq.com   (你的邮箱)

3. 常用操作

  创建版本库
 
  cd 路径   选择在哪个文件夹下创建   mkdir  创建文件/文件夹  ls 查询当前文件夹下的内容  ll 详细查询当前文件夹下的内容 

  来到想要设置的文件夹为下 


  $ git init  初始化

  eg： 新建一个a.txt 

  $ git status  查看状态

  $ git add a.txt  添加一个文件

  $ git commit -m '新建a.txt文件'

  $ git rm a.txt  删除一个文件

  注意：操作之后,都要 $ git commit -m'注释说明文字'    每次都要     最好查一下  $ git status


4. 建立一个远程仓库  (团队协作) 需要配合 码云(网站)

   在码云中创建一个新的项目  复制https项目地址

   $ git push 复制的项目地址 master                       简写 （在注意之后）
   
   注意：每一次本地项目的修改, 都需要 $ git add . 

   $ git remote add orign 复制的项目地址    (orign 相当于地址起的别名)

   以后可以 $ git push orign master  (向服务器推项目)

   在码云中邀请开发人员 

   然后开发人员  在它的本地机  $ git clone 复制项目地址

   然后另外一个开发人员 在它的本地机  $ git pull 复制项目地址 master


5. 代码管理

   工作区：开发者工作的目录

   暂存区: 修改已被记录, 但未录入版本库

   版本库: 存储变化日志及版本信息



   过程  ：  工作区--------------------> 暂存区------------------>版本库
                     add->                        commit-->


一些快捷操作：

$ git add a.txt

$ git add a.txt b.txt

$ git add *.txt

$ git add .



6.改动日志

查看日志  $ git log

查看日志(按格式)  $ git log --pretty=oneline  

退出查看日志   q

比较两个日志的不同  $ git diff <版本1> <版本2>   注:一般版本号写前6位就好, 不用全写




7. 版本切换 

$ git reset --hard 版本号(前6位)



8. 分支管理 (杀手锏) *****************************

查看分支   $ git branch

创建分支   $ git branch 分支名字

切换分支   $ git checkout 分支名称

注意:  创建分支hou, 在该分支下修改文件, 之后 一定要 $ git add .  和 $ git commit -m'注释说明' ******

合并分支  一定要在master总之下, $ git megre 分支名称

删除分支  在问题都解决好, 分支合并后, 删除无用分支 $ git branch -d 分支名称



9. 忽略 （文件）  .gitignore

  需要忽略的文件 配置文件 缓存文件

  作用: 被忽略的文件不被git软件跟踪/记录

  步奏:  1.新建一个文件 a.txt
         2. 在git命令行  把上个文件修改名称  mv a.txt .gitignore  


.gitignore 格式

 空行不匹配文件,只是为了让文件易读

 行开头是#,代表注释

 行内的空格是被忽略的,除非加\转义

 !开头代表相反(不忽略)

 如果以/结尾,匹配的是目录,而非文件或软链接. 例foo/匹配的是foo目录,而非foo文件

 如果不以/开头,视为一种模式通配, 以.gitignore位置开始定位,包含子孙目录.

 *通配符不能通配"/", 即 /foo/*.html,可以通配/foo/a.html /foo/b.html,...,但不能通配 /foo/bar/a.html
 *
 2个**通过所有路径.例:**/foo通配任意地方的foo文件和foo目录. **/foo/bar通配任意处于foo下的bar文件或目录.

 /**通过目录下所有内容.例abc/**通过abc目录下所有内容

 /后放2个*,例a/**/b,通配a的子孙目录下的b目录



/*

10. 远程仓库地址

所谓远程仓库地址, 就是给这些较长的url地址起一个短一点的别名

查看远程仓库  $ git remote 

查看远程仓库地址 $ git remote -v

删除远程仓库  $ git remote remove <远程仓库名>


11. 公钥登录

  a. 配置ssh格式的远程仓库地址

  $ git remote add 远程仓库名 远程仓库地址



  b. 创建ssh key

  ssh-keygen -t rsa -C "youremail@example.com",把邮件地址换成你自己的邮件地址,一直回车,不用输入密码.完成后,可以在用户主目录里找

  到.ssh目录,内有id_rsa和id_rsa.pub两个文件. id_rsa是私钥,id_rsa.pub是公钥.

  这两把钥匙是成对的,可以让分别持有私钥和公钥的双方相互认识.


  c. 把公钥放在服务器
  用记事本打开id_rsa.pub,复制公钥内容