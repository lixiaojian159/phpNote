<?php
require './func/function.php';

$username   = $_POST['username'];
$password   = $_POST['password'];
$login_auto = isset($_POST['login_auto'])?$_POST['login_auto']:0;

$sql    = "select * from student where username = '{$username}'";
$result = query($sql,$mysql_array);
$row    = fetch_one($result);
if(!$row){
	exit("<script>
		    alert('无此用户');
		    location.href='login.php';
		  </script>");
}
if($password != $row['password']){
	exit("<script>
		        alert('您的密码不正确');
		        location.href='login.php';
		  </script>");
}

echo '用户和密码验证成功,接下来看是否需要一周自动登录';
$salt = 'atom';
$password = md5($username.$password).':'.$row['id'];
if($login_auto == 1){
	setcookie('username',$username,strtotime('+7 days'));
	setcookie('password',$password,strtotime('+7 days'));
}else{
	setcookie('username',$username);
	setcookie('password',$password);
}

echo "<script>
        alert('{$username}您好,欢迎登录');
        location.href='hello.php';
      </script>";