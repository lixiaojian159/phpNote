<?php
session_start();
require './func/function.php';
if(!isset($_SESSION['username']) && !isset($_SESSION['password'])){
	exit("<script>
		      alert('请先登录');
		      location.href='login.php';
		  </script>");
}
$username = $_SESSION['username'];
$password = $_SESSION['password'];
$sql = "select * from student where username='{$username}'";
$result = query($sql,$mysql_array);
$row = fetch_one($result);
if(!$row){
	exit("<script>
		       alert('请先登录');
		       location.href='login.php';
		  </script>");
}

$salt = 'atom';
if(md5($row['password'].$salt) != $password){
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
	<p>你好,<?php echo $username; ?>!!!欢迎登录 <a href="loginout.php">注销</a></p>
	<h2>首页</h2>
</body>
</html>