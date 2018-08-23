<?php
session_start();
require './func/function.php';

$code = strtolower(strip_tags($_SESSION['code']));

$username = trim($_POST['username']);
$password = $_POST['password'];
$password2 = $_POST['password2'];
$email = trim($_POST['email']);
$verify = strtolower(trim($_POST['verify']));

$str = 'QWERTYUIOPASDFGHJKLZXCVBNMqwertyuiopasdfghjklzxcvbnm';

$arr = str_split($str);

if(strlen($verify) != 4){
	err('验证码必须为4位','index.php');
}

if($verify != $code){
	err('验证码不正确','index.php');
}

if(!in_array($username[1],$arr)){
	err('用户名要以字母开头','index.php');
}

if(strlen($username)<6 || strlen($username)>10){
	err('用户名的位数6-10','index.php');
}

if(strlen($password)<6 || strlen($password)>10){
	err('密码位数6-10','index.php');
}

if($password !== $password2){
	err('两次密码不一致','index.php');
}

$email_pattern = '/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*\.[a-zA-Z0-9]{2,6}$/';

if(!preg_match($email_pattern, $email)){
	err('邮箱格式不正确','index.php');
}

$password = md5($password);

$like = $_POST['like'];

$like = implode(',', $like);


echo "<h1>注册成功</h2>";

$userInfo =<<<HTML
    <table border="1" cellpadding="0" cellspacing="0" width="800">
        <caption>个人信息表</caption>
        <tr align="center">
        	<td>用户名</td>
        	<td>密码</td>
        	<td>邮箱</td>
        	<td>专业</td>
        </tr>
        <tr align="center">
        	<td>{$username}</td>
        	<td>{$password}</td>
        	<td>{$email}</td>
        	<td>{$like}</td>
        </tr>
    </table>
HTML;

echo $userInfo;