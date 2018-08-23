<?php
session_start();
$str = 'QWERTYUIOPASDFGHJKLZXCVBNMqwertyuiopasdfghjklzxcvbnm0123456789';
$num = strlen($str);
$string = '';
for($i=0;$i<4;$i++){
	$string .= '<span style="color:rgb('.mt_rand(0,255).','.mt_rand(0,255).','.mt_rand(0,255).');font-size:20px">'.$str[mt_rand(0,$num-1)].'</span>';
}
$_SESSION['code'] = $string;
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>注册</title>
	<link rel="stylesheet" type="text/css" href="./css/style.css">
</head>
<body>
	<div id="resigter">
	<h1>慕课网注册页面</h1>
	<form method="post" action="doAction.php">
		<p>
			<label for="username">用户名称：</label>
			<input type="text" name="username" id="username" placeholder="请输入您的用户名..." required="required">
			<small>用户名以字母开头,长度为6-10</small>
		</p>
		<p>
			<label for="password">密码输入：</label>
			<input type="password" name="password" id="password" placeholder="请输入您的密码..." required="required">
			<small>密码长度6-10</small>
		</p>
		<p>
			<label for="password2">确认密码：</label>
			<input type="password" name="password2" id="password2" placeholder="请确认您的密码..." required="required">
			<small>两次密码一致</small>
		</p>
		<p>
			<label for="email">电子邮箱：</label>
			<input type="text" name="email" id="email" placeholder="请确认您的电子邮箱..." required="required">
			<small>邮箱必须格式正确,例:123456789@qq.com</small>
		</p>
		<p>
			<label for="like">个人爱好：</label>
			<span>
			<input type="checkbox" name="like[]" value="php">PHP
			<input type="checkbox" name="like[]" value="JAVA">JAVA
			<input type="checkbox" name="like[]" value="IOS">IOS
			<input type="checkbox" name="like[]" value="c">C语言
			<input type="checkbox" name="like[]" value="c++">C++<br/>
			<input type="checkbox" name="like[]" value="swift">Swift
			<input type="checkbox" name="like[]" value="meter">Meter
			<input type="checkbox" name="like[]" value="nodejs">NodeJS
			<input type="checkbox" name="like[]" value="ionic">ionic
			</span>

		</p>
		<p>
			<label for="verify">验证密码:</label>
			<input type="text" name="verify" id="verify" placeholder="验证码..."><?php echo $string; ?>
		</p>
		<p>
			<input type="submit" name="submit" value="立即注册">
		</p>
	</form>
	</div>
</body>
</html>