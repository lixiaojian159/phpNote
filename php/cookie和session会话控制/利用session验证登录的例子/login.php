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
	 #verify{
	 	width: 50px;
	 }
	 img{
	 	position: relative;
	 	top:10px;
	 	left:10px;
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
		<label for="verify">验 证：</label>
	    <input type="text" name="verify" placeholder="Verify" id="verify" required="required">
	    <img src="code.php" onclick="this.src = this.src+'?random='+Math.random()">
	</p>
	<p>
	    <input type="submit" value="LOGIN">
	</p>
</form>
</div>
</body>
</html>