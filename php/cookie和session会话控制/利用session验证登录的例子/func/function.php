<?php

$mysql_array = array( 
	                'host'    => 'localhost' , 
	                'user'    => 'root' , 
	                'pwd'     =>'' , 
	                'db_name' => 'test2' , 
	                'char'    =>'utf8' 
);


/** 
* connect 
* 连接数据库
* 
* @access public 
* @param  array  $arr  数据库配置的相关属性
* @return object $link 数据库连接的通道对象
*/  

function connect($arr){
	$link = mysqli_connect($arr['host'],$arr['user'],$arr['pwd'],$arr['db_name']) or die('error connect');
	mysqli_query($link,'set names '.$arr['char']);
	return $link;
}

/** 
* query
* 执行sql语句
* 
* @access public 
* @param  array  $arr    数据库配置的相关属性
* @param  string $sql    sql语句
* @return source $result 返回一个结果
*/ 

function query($sql,$arr){
	$link   = connect($arr);
	$result = mysqli_query($link,$sql);
	return $result;
}

/** 
* fetch_one
* 查询一条数据
* 
* @access public 
* @param  source $result 一个结果
* @return array  $row    一条数据的一位数组
*/ 

function fetch_one($result){
	$row    = mysqli_fetch_assoc($result);
	return $row;
}


/** 
* fetch_all
* 查询多条数据
* 
* @access public 
* @param  source $result 一个结果
* @return array  $data   多条数据的二维数组
*/ 

function fetch_all($result){
	$data = array();
	while($row = mysqli_fetch_assoc($result)){
		$data[] = $row;
	}
	return $data;
}




function getVerify(){
	$image = imagecreatetruecolor(100, 35);
	$white = imagecolorallocate($image, 255,240,245);
	$color_rand1 = imagecolorallocate($image, rand(0,255), rand(0,255), rand(0,255));
	imagefill($image, 0, 0, $white);
	$str = 'qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM0123456789';
	$count = strlen($str);
	$string = '';
	for($i=0;$i<4;$i++){
		$string .= $str[mt_rand(0,$count-1)];
	}
	$_SESSION['code'] = $string;
	imagettftext($image, 20, rand(-8,8), 20, 25, $color_rand1, 'lucon.ttf', $string);
	for($i=0;$i<100;$i++){
		imagesetpixel($image, rand(0,100), rand(0,35), imagecolorallocate($image, rand(0,255), rand(0,255), rand(0,255)));
	}
	for($i=0;$i<3;$i++){
		imageline($image, rand(0,100), rand(0,35), rand(0,100), rand(0,35), imagecolorallocate($image, rand(0,255), rand(0,255), rand(0,255)));
	}
	header("content-type:image/png");
	imagepng($image);
	imagedestroy($image);
}

