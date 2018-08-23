<?php
require './func/function.php';
$username = isset($_COOKIE['username'])?$_COOKIE['username']:'';
$password = isset($_COOKIE['password'])?$_COOKIE['password']:'';
$pass_arr = explode(':',$password);
$pass_end = end($pass_arr); 
$sql = "select * from student where id = {$pass_end}";
$result = query($sql,$mysql_array);
if($result){
	$row = fetch_one($result);
	$pass_mysql = md5($username.$row['password']);

	if($pass_arr[0] == $pass_mysql){
		exit("<script>
			        alert('{$username}您好,欢迎登录');
			        location.href='hello.php';
			  </script>");
	}
}
?> 

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>login</title>
	<style type="text/css">

	 #login{
	    margin:auto;
		margin-top:100px;
		width:250px;
		height:200px;
		/*background-color:pink;*/
	 }
	 h2{
	    /*background-color:pink;*/
		text-align:center;
	}
	 input[type='text'],input[type='password']{
	    outline:none;
	 }
	 p:last-child{
	    /*background-color:green;*/
		text-align:center;
	 }
	 input[type='submit']{
	    width:80px;
		height:35px;
		border-radius:2px;
	 }
	</style>
</head>
<body>
<div id="login">
<form method="post" action="doAction.php">
    <h2>登录页面</h2>
	<p>
	    <label for="username">用 户：</label>
		<input type="text" name="username" id="username" placeholder="Enter Username" required="required">
	</p>
	<p>
	    <label for="password">密 码：</label>
		<input type="password" name="password" id="password" placeholder="Enter Password" required="required">
	</p>
	<p>
	    <input type="checkbox" name="login_auto" value="1">一周内自动登录
	</p>
	<p>
	    <input type="submit" value="LOGIN">
	</p>
</form>
</div>
</body>
</html>