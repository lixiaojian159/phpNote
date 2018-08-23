<?php

/*

session会话控制

一、什么是session

   就是一种会话, 服务器和浏览器保有的小秘密的一段时间

二、session的工作原理


三、session的 具体操作

   1. 开启会话  session_start();

   2. 设置 $_SESSION['usernsme'] = 'zhangsan';

      php.ini文件可以查询到session保存的位置, 还有session_name的名字

      setcookie(session_name(),session_id(),time()+3600);

   3. 读取  echo $_SESSION['username'];

            var_dump($_SESSION);

   4. 销毁 session_destroy();

           $_SESSION = [];


      注意：销毁session 如果是cookie传值, 记得把cookie也销毁, 利用setcookie函数


四、 session的用户登录小实例



五、

session_set_save_hander()  设置用户自定义会话存储函数



代码：  


建立session,设置

session_start();

$_SESSION['username'] = 'zhangsan';
$_SESSION['password'] = '123456';
$_SESSION['age'] = 20;


echo session_name();
echo '<br/>';
echo session_id();


$_SESSION['userInfo'] = [
	                     'user1'=>['username1' => 'zhangsan1','sge' => 201, 'email' => '123456@qq.com'],
	                     'user2'=>['username2' => 'zhangsan2','sge' => 202, 'email' => '223456@qq.com'],
];


读取session

session_start();

var_dump($_SESSION);




销毁session

session_start();

$_SESSION = [];

if(ini_get('session.use_cookies')){
	$params = session_get_cookie_params();
	setcookie(session_name(),'',time()-1,$params['path'],$params['domain'],$params['secure'],$params['httponly']);
}

session_destroy();