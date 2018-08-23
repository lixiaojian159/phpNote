<?php

/*


1. 如何创建PDO对象

   $pdo = new PDO("mysql:host=localhost;dbname=ajax;charset=UTF8","root","");
                数据库类型     主机地址        库名        字符集    用户名 密码


2. 添加操作

   	$num = $pdo->exec($sql);      添加一条sql数据,  返回受影响的条数
   	$id = $pdo->lastInsertId();   查询最后添加数据的id

例子:

try{
	$pdo = new PDO('mysql:host=localhost;dbname=test2;charset=UTF8','root','');
	$sql = "insert into student(username,password) values ('武松','123789')";
	$num = $pdo->exec($sql);
	$id = $pdo->lastInsertId();
	if($num>0){
		echo '添加'.$num.'条数据;最后的id为'.$id;
	}
}catch(PDOExxeption $e){
	die('数据库连接失败'.$e->getMessage());
}


3. 更新操作

   	$num = $pdo->exec($sql);   执行sql语句, sql语句为update, 返回受影响的条数


例子:

try{
	$pdo = new PDO('mysql:host=localhost;dbname=test2;charset=UTF8','root','');
	$sql = "insert into student(username,password) values ('武松','123789')";
	$num = $pdo->exec($sql);
	$id = $pdo->lastInsertId();
	if($num>0){
		echo '添加'.$num.'条数据;最后的id为'.$id;
	}
}catch(PDOExxeption $e){
	die('数据库连接失败'.$e->getMessage());
}



4. 删除操作

   $num = $pdo->exec($sql);   执行sql语句, sql语句为delete, 返回受影响的条数

例子：

try{
	$pdo = new PDO('mysql:host=localhost;dbname=test2;charset=UTF8','root','');
	$sql = "delete from student where id = 7";
	$num = $pdo->exec($sql);
	if($num>0){
		echo '删除成功';
	}
}catch(PDOExxeption $e){
	die('数据库连接失败'.$e->getMessage());
}



5. select查询操作

   结果集用PDO::query($sql)方法获取

   查询结果放在PDOStatement对象

   PDOStatement::setFetchMode(PDO::FETCH_ASSOC)  读取方式

   PDOStatement::fetch()     解析结果集       查询一条记录

   PDOStatement::fetchAll()  解析结果集       查询多条结果

   PDO的结果集可以直接遍历 foreach($result as $v) 不用解析结构集, 但不有推荐使用

   将结果集映射到对象遍历,  注意： 类名和表名一致, 属性与字段一致, 通过魔术方法__get获取


   例子:1  查询单条

   try{
	$pdo = new PDO('mysql:host=localhost;dbname=test2;charset=UTF8','root','');
	$sql = 'select * from student';
	$result= $pdo->query($sql);
	$result->setFetchMode(PDO::FETCH_ASSOC);
	echo "<table border='1' width='600' cellspacing='0' cellpaddng='0' align='center'>";
	echo "<tr align='center'><td>ID</td><td>姓名</td><td>密码</td></tr>";
	while($row = $result->fetch()){
		echo "<tr align='center'>";
		echo "<td>".$row['id']."</td>";
		echo "<td>".$row['username']."</td>";
		echo "<td>".$row['password']."</td>";
		echo "</tr>";
	}
	echo "</table>";
}catch(PDOExxeption $e){
	die('数据库连接失败'.$e->getMessage());
}


例子: 2   查询多条

try{
	$pdo = new PDO('mysql:host=localhost;dbname=test2;charset=UTF8','root','');
	$sql = 'select * from student';
	$result= $pdo->query($sql);
	$result->setFetchMode(PDO::FETCH_ASSOC);
	$data = $result->fetchAll();

	echo "<table border='1' width='600' cellspacing='0' cellpaddng='0' align='center'>";
	echo "<tr align='center'><td>ID</td><td>姓名</td><td>密码</td></tr>";
	foreach($data as $v){
		echo "<tr align='center'>";
		echo "<td>".$v['id']."</td>";
		echo "<td>".$v['username']."</td>";
		echo "<td>".$v['password']."</td>";
		echo "</tr>";
	}
	echo "</table>";
}catch(PDOExxeption $e){
	die('数据库连接失败'.$e->getMessage());
}



例子：3    

try{
	$pdo = new PDO('mysql:host=localhost;dbname=test2;charset=UTF8','root','');
	$sql = 'select * from student';
	$result= $pdo->query($sql);
	$result->setFetchMode(PDO::FETCH_ASSOC);

	echo "<table border='1' width='600' cellspacing='0' cellpaddng='0' align='center'>";
	echo "<tr align='center'><td>ID</td><td>姓名</td><td>密码</td></tr>";
	foreach($result as $v){
		echo "<tr align='center'>";
		echo "<td>".$v['id']."</td>";
		echo "<td>".$v['username']."</td>";
		echo "<td>".$v['password']."</td>";
		echo "</tr>";
	}
	echo "</table>";
}catch(PDOExxeption $e){
	die('数据库连接失败'.$e->getMessage());
}


例子： 4   将结果集映射到对象遍历

class Student{
	private $id;
	private $username;
	private $password;

	public function __get($pro_name){
		if(isset($this->$pro_name)){
			return $this->$pro_name;
		}
	}
}


try{
	$pdo = new PDO('mysql:host=localhost;dbname=test2;charset=UTF8','root','');
	$sql = 'select * from student';
	$result= $pdo->query($sql);
	$result->setFetchMode(PDO::FETCH_CLASS,'Student');    ********注意*******

	echo "<table border='1' width='600' cellspacing='0' cellpaddng='0' align='center'>";
	echo "<tr align='center'><td>ID</td><td>姓名</td><td>密码</td></tr>";
	foreach($result as $v){
		echo "<tr align='center'>";
		echo "<td>".$v->id."</td>";
		echo "<td>".$v->username."</td>";
		echo "<td>".$v->password."</td>";
		echo "</tr>";
	}
	echo "</table>";
}catch(PDOExxeption $e){
	die('数据库连接失败'.$e->getMessage());
}


6. 预处理  有效的sql注入攻击


前提了解： mysql本身的预处理 

          $sql = 'select * from student where id = 2 or 1';   //这条sql是被sql注入的。 or 1

          解决方法：  预处理   如下

          perpare stu(预处理名称) from 'select * from student where id = ?';

          set @id = '2 or 1';  设置    //select @id;  查询

          execute stu(预处理名称) using @id;


PDO的预处理

          $sql = 'select * from student where id = ?';

          PDO::prepare($sql);    返回PDOStatement对象

          PDOStatement::execute([2]);   参数以数组形式,  [2]

          PDOStatement::fetch()  PDOStatement::fetchAll
          



例子：


try{
	$pdo = new PDO('mysql:host=localhost;dbname=test2;charset=utf8','root','');
	$sql = 'select * from student where id = ?';
	$stu = $pdo->prepare($sql);   //预处理  传输一个架子
	$stu->execute([2]);
	$row = $stu->fetch();
	echo '<pre>';
	print_r($row);
}catch(PDOException $e){
	die('连接数据库失败'.$e->getMessage());
}


