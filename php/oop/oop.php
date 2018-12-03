<?php

/**
 * 面向对象
 * oop 是一种编程思想, 而不是一种技术
 * 学习目标： 基本语法   编程思想
 * 类与对象:  类是生成对象的模版,  对象是类的一个实例
 */


/**
 * 类的声明与内部属性和方法定义
 * 访问修饰符 public protected private
 * class 类名{
 *    类属性
 *    类方法
 * }
 */

/**
 * 创建对象的6种方法
 * 1.  new  类名();
 * 2. 将类名以一个字符串的方式, 放在一个变量中
 * 3. 用对象来创建对象, 并且它创建的是一个新对象
 * 4. 用new self();
 * 5. 用new parent()来创建一个对象
 * 6. 基于当前调用的类来创建  （有一个知识点：静态延迟绑定）  new static();
 */


 class Demo{

	public $name = 'php中文网';

	public function getName(){
		return $this->name;
	}

	public function getObj(){
		return new self();
	}

	public function getSatic(){
		return new static();
	}
}

class Demo2 extends Demo{
	public function getNewObj(){
		return new parent();
	}
}

// $test = new Demo();

// echo $test->getName().'<br/>';

// echo $test->name;


$className = 'Demo';

$obj = new $className;

var_dump($obj);

echo get_class($obj);

echo '<br/>';

$obj2 = new $obj();

echo get_class($obj2);

echo '<br/>';

echo $obj2->name;

var_dump($obj2);

$obj3 = $obj->getObj();

var_dump($obj3);

$obj4 = (new Demo2)->getNewObj();

var_dump($obj4);

echo get_class($obj4);

$obj5 = (new Demo)->getSatic();

var_dump($obj5);

echo get_class($obj5);

$obj6 = (new Demo2)->getObj();
$obj7 = (new Demo2)->getSatic();

var_dump($obj6);
var_dump($obj7);


/**
 * 类常量就是它的值在类中始终不变的量
 * const  常量名 = '必须初始化';
 * 类常量从php5.3+以后, 开始支持nowdoc语法
 * 在类的方法中访问类常量, self::类常量名
 * 在类外部访问类常量     1. 类名::类常量名
 *                      2. 类变量::类常量名
 *                      3. 用当前类的对象访问类常量名    类对象::类常量名
 *                      4. 用类中的方法来间接访问类常量  类对象->方法()
 */

 class Demo{

 	const siteName = 'php中文网';

 	const domain = <<<'EOT'
 	<a href="">www.php.cn</a>
EOT;

 	public function getSiteName(){
 		return self::siteName;
 	}
 }

 echo Demo::siteName.Demo::domain.'<br/>';

 $className = 'Demo';

 echo $className::siteName.$className::domain.'<br/>';


 echo (new Demo)::siteName.'<br/>';

 echo (new Demo)->getSiteName();


 /**
  * 类文件的自动加载
  * __autoload()  当我们引入一个不存在的类时, 自动调用他导入该类文件
  * 自定义导入函数, 用sql_autoload_register()
  */
