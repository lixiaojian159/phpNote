<?php

/*

函数的简介

自定义函数

特殊函数

使用自定义函数

函数实战


原则： 一个函数只完成一个功能 ******


函数执行原理： *****

函数不调用的时候不执行, 当封装完成后会将其调用到内存中, 当调用函数的时候, 找到对应的函数, 执行函数体.

当碰到return语句或者执行到函数尾部, 再将控制权交到调用函数的位置上, 接着程序继续往下运行


函数格式：

function 函数名([形参1,形参2...]){

	函数体;

	return 返回值;
}


注意： 函数的命名, 函数名不能有特殊字符, 以字母或下划线开始, 跟上数字字母下划线
      
      函数名一般以动词开始, 最好含义明确  getExt()

      驼峰命名或者下划线  getExt() 或者 get_ext()

      函数名不区分大小写, 但是尽量遵循名称一致

      函数不支持重写, 不支持重名,  重名会报错



检测程序中是否存在此函数   bool  functin_exists(string $string)


var_dump(function_exists('md5'));

var_dump(function_exists('test'));


函数中的 return  返回值：

1. 函数中智能有0个或者1个返回值, 如果向返回多个数据则可以使用数组或者对象的形式

2. return 返回值, 函数碰到return会立刻结束

3. 函数的返回值的类型可以是任何类型



变量的作用域**************

局部变量： 函数体内声明的变量

局部变量：  动态变量 和 静态变量(static)

           动态变量：  在函数体执行完毕后立即释放

           静态变量：  关键字 static 修饰, 第一次调用函数时, 静态变量初始化, 当函数执行完毕后静态变量没有释放, 而是保存在静态内存中, 当再次调用函数时, 从静态内存中把静态变量取出继续使用 


全局变量：  函数体外部声明的变量  或者  在函数体内部, 用 global 修饰的变量


那么,问题：  如何在函数中使用全局变量呢 ???

            1. 关键字  global

            2. $GLOBALS 超全局数组



函数 数值传值 和  引用传值 & 的区别：

默认情况下是, 数值传值

&引用传值   传递的是变量的内存地址

注意：  只有变量可以引用传值, 具体的数值不可以(报错)

Fatal error: Only variables can be passed by reference in D:\xampp\htdocs\www\test\demo2\28\1-test.php on line 191  报错语句

错误代码：


$a = 1;

function test(&$m){
	$m += 10;
	echo $m;
	echo '<br/>';
}
test(3);
echo $a;

Fatal error: Only variables can be passed by reference in D:\xampp\htdocs\www\test\demo2\28\1-test.php on line 191  报错语句




函数的几种特殊函数(特殊形式的函数)

1. 可变函数

2. 递归函数

3. 匿名函数

4. 回调函数

5. 可变参数形式的函数



1. 可变函数

   在php中将 函数名 赋予给一个变量, 该变量的值为字符串的函数名, 然后在变量后加上(), 就可以直接调用这个函数,  原则就是  等量代换**

   了解： get_defined_functions()  可以得到所有函数, 包括系统函数和自定义函数


2. 回调函数

   就是调用函数的时候将另外一个函数的名称当作参数传递进去, 并且在函数体中调用

   如何调用回调函数：
                   1.  利用可变函数的形式在函数体内调用

                   2.  可以通过call_user_func 和 call_user_func_array()来调用


                       a. mixed call_user_func ( callable $callback [, mixed $parameter [, mixed $... ]] )

                       第一个参数 callback 是被调用的回调函数，其余参数是回调函数的参数。 

                       例子：  echo call_user_func('md5','123456');


                       b.  mixed call_user_func_array ( callable $callback , array $param_arr )

                       把第一个参数作为回调函数（callback）调用，把参数数组作（param_arr）为回调函数的的参数传入。 




3.  匿名函数  (闭包函数)

    可以临时建立一个没有指定名称的函数, 最经常用作回调函数参数的值

    匿名函数也可以用作变量的值使用




4. 递归函数

   自己调用自己, 

   注意： 不要写死循环, 要有停止条件

   用途： 遍历文件目录, 栏目层级关系






使用自定义函数


include require include_once  reqiure_once    (区别)     包含一个函数文件包



函数实战

1. 封装一个截取文件名的函数

2. 封装一个简单的计算器
|

3. 封装一个获取日期时间星期形式的函数


4. 封装获取验证码的函数



代码实例:(得到文件的后缀)

1.

function get_ext1($filename){
	$ext_arr = explode('.',$filename);
	$ext = end($ext_arr);
	return $ext;
}

2.

function get_ext($filename){
	$ext_arr = explode('.',$filename);
	$ext = array_pop($ext_arr);
	return $ext;
}

3.


function get_ext($filename){
	$num = strrpos($filename,'.');
	$ext = substr($filename,$num+1);
	return $ext;
}


4.


function get_ext($filename){
	$ext_arr = pathinfo($filename);
	$ext = $ext_arr['extension'];
	return $ext;
}



代码：    (1和2的区别),在理解下3

1. 


$a = 1;
$b = 2;

function test(){
	
	echo $a;
	echo '<br/>';
	echo $b;
}

test();



2.


$a = 1;
$b = 2;

function test(){

	global $a;
	global $b;

	echo $a;
	echo '<br/>';
	echo $b;
}

test();




3.


$a = 1;
$b = 2;

function test(){
	global $a;
	global $b;

	echo $a;
	echo '<br/>';
	echo $b;
	echo '<br/>';

	$a = 9;
	$b = 10;
}

test();

echo $a;
echo '<br/>';
echo $b;



代码：

1.

$name = 'zhansgan';
$age = 12;

function test(){
	echo '<pre>';
	print_r($GLOBALS);
	echo $GLOBALS['name'].'<br/>';
	echo $GLOBALS['age'].'<br/>';
}

test();



2.


$name = 'zhansgan';
$age = 12;

function test(){
	echo $GLOBALS['name'].'<br/>';
	echo $GLOBALS['age'].'<br/>';
	$GLOBALS['name'] = 'admin';
	$GLOBALS['age'] = 22;
}

test();

echo $name;
echo $age;



代码： 


这个就是 数值传值的例子

$str = 'ATOM';

$strs = strtolower($str);

echo $str;
echo '<br/>';
echo $strs;



接下来, 是一个引用传值的例子



$arr = array('1','9','5','8');

echo '<pre>';

print_r($arr);

array_pop($arr);

print_r($arr);




代码：

1.



$a = 1;

function test($m){
	$m += 10;
	echo $m;
	echo '<br/>';
}
test($a);
echo $a;




2.


$a = 1;

function test(&$m){
	$m += 10;
	echo $m;
	echo '<br/>';
}
test($a);
echo $a;


代码: (可变函数)

1.

$a = 'md5';

echo $a;

echo $a('123456');


2.

function  test(){
	echo 'this is a test1';
}

$a = 'test';

$a();

$arr = get_defined_functions();

echo '<pre>';

print_r($arr);



代码： (回调函数)


1.


function study($name){
	echo $nume.'study....<br/>';
}

function run($name){
	echo $name.'running...<br/>';
}

function dowhat($functionName,$name){
	$functionName($name);
}

dowhat('run','zhangsan');


2.



function test($a,$b,$func){
	$num = $func($a,$b);
	return $num;
}

function getSum($a,$b){
	return $a + $b;
}

$a = test(2,5,'getSum');


echo $a;



3.  数组的每个值都乘以2


$arr = [1,2,3,4,5,6,7,8,9];

echo '<pre>';

print_r($arr);

function getTwo($a){
	return $a*2;
}


$arr = array_map('getTwo',$arr);

print_r($arr);


4.   数组的每个值都乘以3

$arr = [1,2,3,4,5,6,7,8,9,10];

function getNum(&$val){
	$val = $val*3;
}


var_dump(array_walk($arr,'getNum'));

echo '<pre>';

print_r($arr);


5.  取出所有奇数


$arr = [1,2,3,4,5,6,7,8,9];

function test($val){
	if($val%2 == 1){
		return true;
	}
}

$brr = array_filter($arr,'test');

echo '<pre>';

print_r($brr);




代码：  call_user_func 和  call_user_func_array



1.



function getSum($a,$b){
	return $a + $b;
}


$a = call_user_func('getSum',1,6);

echo $a;



2.


function getSum($a,$b){
	return $a + $b;
}

$a = call_user_func_array('getSum',array('1','6'));

echo $a;



代码 ：  (匿名函数)


1.


$func = function(){
	return 'this is a test1';
};


$test = $func();

echo $test;



2.



$func = function($name){
	echo $name.'is studying ...';
};

$func('zhangsan');



3.

 $arr = [1,2,3,4,5,6,7,8,9];

$brr = array_map(function($val){return $val*2;},$arr);

echo '<pre>';
print_r($brr);




4.


echo call_user_func(function($a,$b){return $a+$b;},1,6);



代码： (获取当前时间)



function get_time($year='年',$month='月',$date='日'){
	$time = date("Y{$year}m{$month}d{$date}*N*H:i:s",time());
	$data_arr = explode('*',$time);
	switch($data_arr[1]){
		case 1: $data_arr[1] = '星期一'; break;
		case 2: $data_arr[1] = '星期二'; break;
		case 3: $data_arr[1] = '星期三'; break;
		case 4: $data_arr[1] = '星期四'; break;
		case 5: $data_arr[1] = '星期五 '; break;
		case 6: $data_arr[1] = '星期六'; break;
		case 7: $data_arr[1] = '星期日'; break;
	}
	$data = implode($data_arr, ' ');
	return $data;
}

echo get_time('-','-','');
echo '<br/>';
echo get_time();


代码：  (验证码)



默认为4位的验证码
type=1 数字
type=2 字母
type=3 数字+字母
我也可以改变验证码的长度



function verify($type,$width='100',$height='30',$count='4'){
	$image = imagecreatetruecolor($width, $height);
	$white = imagecolorallocate($image,255,240,245);
	$black = imagecolorallocate($image,47,79,79);
	imagefill($image, 0, 0, $white);
	if($type == 1){
	    $str = '0123456789';
	    $num = strlen($str);
	    $w = $width/$count-15;
	    for($i=0;$i<$count;$i++){
		    $string = $str[rand(0,$num-1)];
		    $color = imagecolorallocate($image, rand(0,255), rand(0,255), rand(0,255));
	        imagettftext($image, 20, rand(-5,8), $w, 23, $color, 'lucon.ttf', $string);
		    $w = $w+20; 
	    }
	}else if($type ==2){
		$str = 'QWERTYUIOPASDFGHJKLZXCVBNMqwertyuiopasdfghjklzxcvbnm0123456789';
		$num = strlen($str);
		$w = $width/$count-15;
		for($i=0;$i<$count;$i++){
			$string = $str[rand(0,$num-1)];
			$color = imagecolorallocate($image, rand(0,255), rand(0,255), rand(0,255));
		    imagettftext($image, 20, rand(-5,8), $w, 23, $color, 'lucon.ttf', $string);
			$w = $w+20; 
		}
	}else if($type == 3){
		$str = 'QWERTYUIOPASDFGHJKLZXCVBNMqwertyuiopasdfghjklzxcvbnm';
		$num = strlen($str);
		$w = $width/$count-15;
		for($i=0;$i<$count;$i++){
			$string = $str[rand(0,$num-1)];
			$color = imagecolorallocate($image, rand(0,255), rand(0,255), rand(0,255));
		    imagettftext($image, 20, rand(-5,8), $w, 23, $color, 'lucon.ttf', $string);
			$w = $w+20; 
		}
	}
	header('content-type:image/png');
	imagepng($image);
}

verify(2);