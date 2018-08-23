<?php
require './func/function.php';
$username = isset($_COOKIE['username'])?$_COOKIE['username']:'';
$password = isset($_COOKIE['password'])?$_COOKIE['password']:'';
$pass_arr = explode(':', $password);
$pass_end = end($pass_arr);
$sql = "select * from student where id = {$pass_end}";

$result   = query($sql,$mysql_array);
if($result){
	$row = fetch_one($result); 
	$pass_mysql = md5($username.$row['password']);
	if($pass_arr[0] != $pass_mysql){
		exit("<script>
			    alert('请先登录');
			    location.href='login.php';
			  </script>");
	}
}else{
	exit("<script>
		        alert('请先登录');
		        location.href='login.php';
		  </script>");
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>首页</title>
</head>
<body>
	<p>你好,<?php echo $_COOKIE['username']; ?>!!!欢迎登录</p>
	<h2>首页</h2>
</body>
</html>