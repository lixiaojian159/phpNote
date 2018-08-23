<?php
session_start();

$_SESSION['username'] = '';
$_SESSION['password'] = '';

if(ini_get('session.use_cookies')){
	$params = session_get_cookie_params();
	setcookie(session_name(),'',time()-1,$params['path'],$params['domain'],$params['secure'],$params['httponly']);
}

session_destroy();

echo "<script>
          alert('成功退出');
          location.href='login.php';
      </script>";