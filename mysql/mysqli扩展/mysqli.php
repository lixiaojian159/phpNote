<?php

/*
mysqli扩展库  

（有 面向对象 和 面向过程 两套）

开启mysqli扩展库  修改php.ini文件 extension=php_mysqli.dll

mysqli类就代表php和mysql的一个连接


面向对象   的写法

实例:  


@$mysqli = new mysqli('localhost','root','','test2');    //实例化 mysqi类  得到一个php和mysql的连接


if($mysqli->connect_errno){       //连接失败返回一个int数值, 失败返回int  0

	die('mysqli_connect Error;'.$mysqli->connect_error);     //显示错误信息

}

$mysqli->set_charset('utf8');    //设置字符集

$sql = 'select * from student';

$result = $mysqli->query($sql);    //   返回的是：mysqli_result类    代表从一个数据库查询中获取的结果集。 

$data = [];

while($row = $result->fetch_assoc()){    //从结果集中查询数据
	$data[] = $row;
}

$result->free();  //释放资源

$mysqli->close(); //断开连接






面向过程  的写法

实例：


@$link = mysqli_connect('localhost','root','','test2');  //打开php和mysql的一个连接

if(mysqli_connect_errno()){                              //检测是否正常连接
	die('连接失败;错误信息：'.mysqli_connect_error());     //如果连接失败, 显示错误原因
}

mysqli_set_charset($link,'utf8');                         //设置字符集

$sql = 'select * from student';

$result = mysqli_query($link,$sql);                       // 返回结果集对象  mysqli_result
 
$data = [];

while($row = mysqli_fetch_assoc($result)){                 //从结果集对象中查询一条数据, 赋给一个数组
	$data[] = $row;
}

echo '<pre>';

print_r($data);

mysqli_free_result($result);                               //释放mysqli_result类资源

mysqli_close($link);                                       //关闭php和mysql的连接





细节：面向对象的mysqli类


mysqli::query($sql)   $sql 为 insert update  delete 成功返回true, 失败返回false
 
                      $sql 为 select                成功返回mysqli_result对象, 失败返回false

4种方法取出记录, 如下

mysqli_result::fetch_assoc()   获取的结果是索引数组  数组的键名是表的字段   *******首选******

mysqli_result::fetch_row()     获取的结果是关联数组  数组的下标从0开始

mysqli_result::fetch_array()   关联数组和索引数组    结合

mysqli_result::fetch_object()  对象



代码实例:  (封装一个DaoMysqi.class.php数据库操作类包)

class DaoMysqli{
	private $host;
	private $user;
	private $pwd;
	private $db_name;
	private $port;
	private $char;
	private $mysqli;
	private static $instance;

	private function __construct($option = array()){
		echo 'qqqq';
		$this->host = isset($option['host']) ? $option['host'] : '';
		$this->user = isset($option['user']) ? $option['user'] : '';
		$this->pwd  = isset($option['pwd'])  ? $option['pwd']  : '';
		$this->db_name = isset($option['db_name']) ? $option['db_name']: '';
		$this->port = isset($option['port']) ? $option['port'] : '';
		$this->char = isset($option['char']) ? $option['char'] : '';
		//对数据进行一下检测, 如果为空, 则退出程序, 同时提示信息
		
		if( ($this->host == '') || ($this->user == '') || ($this->db_name == '') || ($this->port == '') || ($this->char == '') ){
			die('你传入的数据有问题, 请重新输入...');
		}
		@$this->mysqli = new mysqli($this->host,$this->user,$this->pwd,$this->db_name);

		if($this->mysqli->connect_errno){
			die('数据库连接失败,原因:'.$this->mysqli->connect_error);
		}else{
			echo '数据库连接成功';
		}

		$this->mysqli->set_charset($this->char);
	}

	public function fetchAll($sql = ''){
		$data = [];
		$result = $this->mysqli->query($sql);
		while($row = $result->fetch_assoc()){
			$data[] = $row;
		}
		$result->free();
		return $data;
	}

	public function fetchOne($sql = ''){
		$result = $this->mysqli->query($sql);
		$row = $result->fetch_assoc();
		$result->free();
		return $row;
	}

	public function query($sql = ''){
		$result = $this->mysqli->query($sql);
		if(!$result){
			die('添加失败,失败原因是:'.$this->mysqli->error);
		}
		return $result;
	}

	public static function getIns($option = array()){
		if(!(self::$instance instanceof self)){
			self::$instance = new self($option);
		}
		return self::$instance;
	}
}



调用文件


require './DaoMysqli.class.php';

$arr = [
	    'host'    =>  'localhost',
	    'user'    =>  'root',
	    'pwd'     =>  '',
	    'db_name' =>  'test2',
	    'port'    =>  '3306',
	    'char'    =>  'utf8',
];

$mysqli = DaoMysqli::getIns($arr);

echo '<pre>';


$sql = 'select * from goods where id = 1';

$row = $mysqli->fetchOne($sql);
print_r($row);


$sql = "insert into goods(goods_name,price) values ('酸奶','2.5')";

$result = $mysqli->query($sql);

if($result){
	echo '添加成功';
}