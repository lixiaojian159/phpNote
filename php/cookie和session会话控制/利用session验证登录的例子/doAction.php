<?php
session_start();

require './func/function.php';

$username = $_POST['username'];
$password = $_POST['password'];
$verify   = strtolower($_POST['verify']);
$code     = strtolower($_SESSION['code']);


if($verify != $code){
	exit("<script>
		        alert('验证码错误');
		        location.href='login.php';
		  </script>");
}


$sql = "select * from student where username='{$username}'";
$result = query($sql,$mysql_array);
$row = fetch_one($result);

if(!$row){
	exit("<script>
		    alert('无此用户');
		    location.href='login.php';
		  </script>");
}

if($password != $row['password']){
	exit("<script>
		      alert('密码不正确,请重新输入');
		      location.href='login.php';
		  </script>");
}


$_SESSION['username'] = $username;

$salt = 'atom';

$_SESSION['password'] = md5($password.$salt);

echo "<script>
          alert('欢迎登录,{$username}你好.');
          location.href='hello.php';
      </script>";
