<?php

/*  面向对象




学习进度：

成员属性

成员方法

构造函数

析构函数

访问修饰符

静态属性/静态方法












类  对象   类与对象的关系  

类的实例化就是一个对象（new）  通过一个类获得一个对象实例

类与对象的区别：

a. 类是抽象的，概念的  代表一类事物

b. 对象是具体的,实际的 代表一个具体的事物

c. 类是对象的模版, 对象是类的一个个实例



类的基本定义

class 类名{
	访问控制符 成员属性;
}

访问控制符  public  protected   private

成员属性 的数据类型 可以是php的8种数据类型   一般是int string 也可以是 array  object  resouce

->  对象运算符  访问对象里面的某个属性或者是某个方法

如何创建对象   $对象名 = new 类名();

如何访问对象的属性  $对象名->属性;

类名是不区分大小写的  但是要遵守类名的命名规范   大写字母开头  驼峰命名 一般使用名词




面向对象的传递机制  ***********

对象标识符： 当我们创建一个对象时，系统会自动分配一个对象标识符（var_dump(对象)）  object(类名)#1

代码1：

class Person{
	public $name;
	public $age;
}

$person1 = new Person();

$person2 = $person1;

echo '<pre>';
var_dump($person1);
var_dump($person2);

$person1->name = '小吴';

echo $person2->name;

代码2：

class Person{
	public $name;
	public $age;
}

$person1 = new Person();

$person2 = $person1;

echo '<pre>';
var_dump($person1);
var_dump($person2);

$person1->name = '小吴';

$person2->name = '老吴';

echo $person1->name;

注意：  php的传值默认是值传递   对象传递也是，但是传递的是对象标识符 *********


对象的传递机制(细节)


代码：

class Dog{
	public $name;
}

$dog1 = new Dog();

$dog1->name = '大黄';
$dog2 = $dog1;
$dog2 = 'abc';

echo $dog1->name;    问：输出什么


代码：

class Cat{
	public $name;
}

$cat1 = new Cat();
$cat1->name = '小花猫';

$cat2 = &$cat1;

$cat2 = 'abc';

echo $cat1->name;
echo $cat1;          问:输出什么




成员方法（成员函数）


构造方法

基本使用：

访问修饰符 function __construct(形式参数列表){

	函数体;

}

作用：完成初始化作用  (构造方法一般不需要return)



构造函数细节：

a. 构造方法是一种特殊的方法，完成对对象的初始化，没有返回值

b. 在创建一个新对象时new,构造函数是自动调用的

c. 在php4中构造方法和类名是一样的

d. 默认构造方法，当你没写构造函数时，会默认有一个没有参数的构造函数

f. 一个类中智能有一个构造方法


代码:

class Person{

	public $name;
	public $age;

	public function __construct($name,$age){

		$this->name = $name;
		$this->age = $age;
	}
}

$p = new Person('张三',20);



this  关键字  代表 当前的对象 (谁调用我,this就指向谁)

系统会给每一个对象分配一个this,代表当前对象



析构函数

基本介绍：

主要作用：是释放相关资源

public function __destruct(){
	
	函数体;
}


代码：

class Person{
	
	public $name;

	public function __construct($name){

		$this->name = $name;
	}

	public function __destruct(){

		echo $this->name.'被释放了<br/>';
	}
}


$p1 = new Person('胖和尚');

$p2 = new Person('瘦和尚');  问：哪一个先被释放   理解成： 子弹夹栈区  先进后出



代码：

class Person{

	public $name;

	public function __construct($name){

		$this->name = $name;
	}

	public function __destruct(){

		echo $this->name.'被释放了<br/>';
	}
}


$p1 = new Person('胖和尚');
$p1 = null;
$p2 = new Person('瘦和尚');
$p3 = new Person('中和尚');   问：被释放的先后  


析构函数的最佳实践：在程序结束之前，释放数据库连接资源    根据实际项目需求而定



垃圾回收机制   

1. 在php中, 当一个对象没有任何引用指向它时; 就会成为一个垃圾对象, php将启用垃圾回收器, 销毁对象

2. 在程序退出前, php也将启用垃圾回收器, 销毁对象、




访问修饰符

public 公有的  

protected 受保护的

private  私有的



魔术方法 

在满足某种情况下,系统自动调用的方法

魔术方法以__开头



__get($name) 访问一个不能访问的属性的时候,要被自动触发

__set($name,$value) 在给不可访问的属性赋值时, 要自动触发




__isset()  当对不可访问的属性  isset()  empty() 时,会自动调用

__unset()  当对不可访问的属性 unset()时, 会自动调用



__toString()  当我们把一个对象当一个字符串输出时, 会自动调用__toString()



__clone()     当我们新建一个对象,  clone 一个已有的对象, 会调用__clone()

最主要的作用： 防止别人克隆对象  做法 ： private  function __clone(){}

经典使用：  单例模式



__call()     当对象调用一个不存在,受保护的,私有的的方法时, 会自动调用


注：不可访问 的意思是：  private protected 还有不存在


__callStatic() 当对象调用一个不存在的,受保护的,私有的静态方法时, 会自动调用




类的自动加载      我们使用一个没有定义过的类时, 会自动调用, 这是一个动态加载机制, 

 function __autoload($name){
	          
	require $name.'.class.php';
}


优化类的自动加载

在一个大项目中, 我们需要做一个类的映射数组


高级类的自动加载(tp框架) 

spl_autoload_register()

bool  spl_autoload_register ([ callable $autoload_function [, bool $throw = true [, bool $prepend = false ]]] ) //回调函数

一般都是： spl_autoload_register(callback)



类的静态属性/静态方法  static 

格式： 访问修饰符 static 变量名

如何访问静态属性：  1.在类内部   self::$静态属性名   2.在类外部   类名::$静态属性名 (前提是：访问修饰符必须是public)

::范围标识符

静态属性的细节：

a. 静态属性：是该类的所有对象共享的变量, 任何一个对象取访问它,取得的都是都是一样的值,  任何一个该类的对象去修改它也都是一个同一个变量

b. 静态变量可以在定义时，直接初始化

c. 静态变量的初始化，不依赖于是否创建对象; 静态变量的初始化是和类的加载同步的

self和this区别解释：

1.使用方式不同

self::         类的范畴（指向的是类）

$this->        对象的实例(指向的是对象)


静态方法:(类方法)

格式：访问修饰符 static function 方法名(){}

使用情况:

1. 我们操作静态属性, 可以使用静态方法

2. 使用静态方法可以在使用没有实例化对象的情况下,就可以使用,  经典案列： 单例模式


静态方法的细节：

a. 如果在类的外部调用静态方法, 则该静态方法必须是public

b. 访问方式： 1.在类外部访问  类名::静态方法()  或者  $对象名->静态方法() 
             2.在类内部访问  self::静态方法()  或者  $this->静态方法()



注意：  静态方法, 不能访问普通的属性(非静态属性)  ******************

       普通的成员方法,是可以使用静态属性的


静态属性/静态方法的最佳实例  单例模式

设计模式：  单例模式

说明：在一次http申请中, 确保某个类只有一个对象实例, 这样可以节省资源开销


面向对象的三大特性：  封装 继承 多态



抽象

核心思想：一种研究问题的思想和方法, 将一类事物的共同特点提取出来, 然后组成事物的属性和方法


封装

基本介绍：概念(略)

就是把抽象出来的数据和对数据的操作封装在一起

访问控制修饰符 ： 可以修饰属性, 也可以修饰方法

控制修饰符: public        protected              private

类外部       yes           no                      no

继承类       yes           yes                     no

本类         yes           yes                    yes



访问protected和private的三种方式

1.  魔术方法__get()和__set()

2.  getXxx 和 setXxx (分开写) 可以有业务逻辑

3.  showInfo() (一次性获取)


封装的细节：


1. protected 和 private  修饰时,  可以使用模式方法 __get() 和 __set() 得到和设置


2. getXxx 和 setXxx  可以自己控制, 比较灵活


3. 可以在类中写一个 public 的方法, 可以得到protected和private 的属性和方法


4. var 默认就是 public 兼容 php4 和 php5 


5. 静态属性  public static $num = 0;    如果不写public 也是可以的, 不会报错


6. 当我们的方法没写访问修饰符, 默认就是public



对象运算符的连用现象

基本介绍: 在实际开发中, 你可能会看到 echo $student->getSchool()->getClass->name;

原理：  就是把一个对象, 放进另外一个对象的属性里面
       
       然后通过一个对象的属性,得到另外一个对象, 然后在输出这个对象的属性





继承

基本概念: 程序设计特性

关键字: extends 

名称(叫法)  :     父类/基类     子类/扩展类

作用 :  可以解决代码的复用(减少代码的rongyu,利于扩张和优化)

继承的细节:

1.  父类的哪些方法和属性可以被子类继承和访问   只有public 和 protected 能被继承的子类使用

2.  继承不能简单的理解为: 子类集成时, 会把父类的public和protected的方法和属性拷贝一份, 而是建立了一种继承 *****查找的关系******

    当一个对象去操作一个属性或者方法时, 先到子类的里面看, 是否存在这个属性或者方法

    如果存在, 则看它的访问控制符, 是都有权访问

    如果不存在, 则去它的父类去查找该属性和方法, 然后再看这个父类中的属性和方法的访问修饰符

    依次往上找,  一直到顶层父类

3.  子类最多只能继承一个父类 ***

4.  子类可以继承其父类的public和protected修饰的属性和方法

5.  在创建某个子类的对象时, 会自动调用父类的构造方法  （***指在子类中没有自定义构造函数）

6.  在子类中调用父类的public和protected修饰的方法和属性  的三种方式 
                                                               a. $this->方法名()
                                                               b. (父类)类名::方法名()
                                                               c. parent::方法名()

                                                        什么情况下,应该用那种方式：*********

                                                        当子类中的调用父类普通的成员方法式,  $this->方法名()

                                                        当子类中的函数调用父类中的构造函数方式,  parent::方法名();

7.  如何在子类中有一个方法和父类的方法名相同, 则我们称之为方法的重写



方法的重载   overloading 

基本概念： 动态的创建类属性和方法, 我们通过模式方法来实现

在php中不能存在相同的方法名(传统意义的重载有不同)

使用魔术方法__call()来实现方法的重载

静态方法的重载  __callStatic()   魔术方法


属性重载  代码：&&&&&&#####


方法重写

为什么会有重写的现象: 父类的方法在某些情况下,不能确定,则该方法,就可能被子类覆盖

重写要求：  子类的函数名和参数的个数, 要和父类中的方法和参数个数一致******

重写的具体细节:

1. 子类已经覆盖了父类的方法, 此时, 子类还想访问父类的方法   (父类)类名::方法名()  或者 parent::方法名()

2. 在子类重写父类的方法中, 此方法如何访问父类中的静态属性  parent::$静态属性

3. 子类的方法不能缩小父类的访问权限（public protected）


类型约束:php7新特性, 老韩不加修改成这样






属性重写



多态：


基本概念: 一个对象的多种状态

php可以根据传入的对象的类型不同, 调用对应该对象的方法

php天生就是多态语言, 可以通过继承父类或者实现接口来实现多态的。

多态在说明:

当子类去访问父类的属性时, parent::父类方法(){ $this->属性名 }  如果这个属性被子类继承, 则输出子类的值, 如果没继承就输出父类的值




重载和重写 的区别

重写: 子类可以去覆盖父类的某个方法



抽象类

为什么有抽象类这个需求:  

1. 父类方法不确定, 我们可以把这个方法申明为抽象的

2. 被abstract修饰的方法, 不能有方法体

3. 只要一个类中包含一个抽象方法, 则该类必须声明成抽象类

4. 抽象类和抽象方法作用：  让子类去实现它, 关键是设计, 不是实现, 被子类继承,并实现他的方法

关键字 ：  abstract


语法介绍： 

abstract class Animal{

	abstract public function cry();
}



抽象类的细节说明:

1. 抽象类不能实例化

2. 抽象类里面可以没有抽象方法, 同时也可以有实现过的方法

3. 一个抽象类中, 可以有抽象方法, 可以有普通方法, 也可以有常量

4. 如果一个类中有一个抽象方法abstract function test(){}, 则这个类必须用abstract修饰

5. 如果子类继承了一个抽象父类, 子类必须实现父类的所有抽象方法

6. 如果子类继承了一个抽象父类, 同时他还不想实现抽象父类的所有方法, 则只需讲这个子类页设置成 abstract

7. 如果一个类继承了多个抽象父类, 这个子类将实现所有抽象父类中的抽象方法

8. 如果父类是抽象类, 那么他的抽象方法不能是private的




接口

基本概念： 接口就是一些没有实现的方法


关键字: interface

接口是更加抽象的抽象类, 体现'高内聚低耦合'的特点

语法: 

interface 接口名{
	方法
}

接口名的命名规范:  以i开头, 后面是驼峰法命名

接口中的方法没方法体, 接口的价值在于设计, 不在实现, 他让其他的类来实现它声明的方法

应用场景:(什么时候用)

接口细节：

1. 接口不能实例化, 抽象类都不能实例化

2. 接口中的方法都是抽象方法，所以不用abstract来修饰, 所有方法都不能有主体;

3. 一个类可以实现多个接口, 接口与接口之间用'逗号'分开, 这个类就要把所implements的所有接口的方法都要实现

4. 接口中属性只能是常量, 而且必须是public 

5. 接口中的方法都是public 

6. 一个接口不能继承其他的类, 但是可以同时继承多个其他接口



实现接口 VS 继承类   区别

小猴子可以继承老猴子的本领(继承类), 可是小猴子还想学习鸟的飞行和鱼的游泳(接口)



final

基本介绍:

一个方法被final, 则这个方法不能被重写,  一个类被final, 则这个类不能被继承

final的细节:

1. 不能修饰属性

2. final类中不能出现final方法   因为final类不能被继承, 那他的方法就没必要final

3. final类可以实例化








类常量 

关键字 const 

具体的一个值, 定值, 不能是一个变量

希望该值不能被别人修改, 定值

格式:

const TEX = 3.17;

访问：  类名::常量名  或者 self::常量名   接口名::常量名


1.  类常量的命名规则 大写字母  中间用'_'连接

2. 类常量定义时, 必须立刻给值

3. const不能有访问修饰符  因为它本身就是public 类常量必须是公有的

4. 在类外部访问   类名::常量名  接口名::常量名

   在类内部访问   self::常量名(推荐)   类名::常量名

5. 类常量一旦定义, 不能修改

6. 类常量会被继承, 因为类常量都是默认public

7. 一个类常量是属于类的, 不能通过this调用

8. 哪些数据类型, 可以定义成类常量： string  int  float bool  array  null 
 
9. 类常量可以在任何地方使用, 全局   (一般的函数, 类里面)




对象的遍历

只能是遍历对象的属性

语法格式:

foreach($对象 as $key => $val){
	echo $key=>$val;
}

细节：

1. 在类的外部遍历, 只能是遍历到public的属性

2. 在类的内遍历对象的所有属性, 在类中写一个public的方法 foreach($this as $key => $val){}



php的内置标准类 stdClass

基本介绍：

php中有一个类stdClass, 这个类不需要创建就可以直接使用, 通常可以使用它来以对象的形式管理我们的数据


$std = new stdClass();




掌握(重要)

再大项目中, 一定会用到

对象序列化  


如果不学对象序列化, 就不会把一个对象保存在session里,  就不会把一个对象放进一个文件里面

在会话中保存对象

理解: 把一个对象的属性名称、属性类型、属性值,都保存在文件中, 还可以通过反序列化, 把对象返回来.

程序员称之为: 冰冻

使用情况: 

1. 需要讲一个对象的数据和类型保存在一个文件中,便于我们日后查看, 便于调试时, 就会有用

2. 把一个对象放入session,

总体思想：  对象需要先序列化, 在保存起来,  

           需要把被保存起来的对象恢复(反序列化)

如果不序列化, 就不能把一个对象保存起来


序列化：   serialize  

反序列化： unserialize

同时需要配合的函数 ：   

file_put_contents(fileName,data)  将一个字符串, 保存到一个文件中

file_get_contents(fileName)       将一个文件里面的内容读取出来


整体步奏:

1.  将一个对象序列化成一个字符串    string  serialize($obj);  将转化后的字符串放进一个文件中   file_put_contents()

2.  把文件中的内容读取出来    file_get_contents();            再将读取出来的字符串反序列化成对象    unserialize()





类与对象的相关函数

bool  class_exists(string)   判断一个类是否存在  

逻辑：  类存在, 怎么办;  类不存在, 怎么办

bool method_exists(obj $obj,string)   判断对象$obj里面有这个方法没

bool property_exists(string'类名', string '属性名')  判断一个类中是否有这个属性

get_class()    当前对象对应的类名是...

__autoload()   自动加载类   spl_autoload_register






trait


基本介绍：


php实现代码复用的另一种方式   

可以减少单继承的限制

格式: 

trait 名称{
	
	方法代码区
}


引用：  在类中 use 名称

细节：

1.  trait 不鞥被实例化

2.  trait和类有相同的方法时, 谁的优先级高  trait中的方法 高于 类中的方法



了解


其他数据类型(int float array 等等)转换成对象   

1. 数组转换成对象 成为(PHP的内置标准类)stdClass对象实例, 如果该数组是关联数组, 数组的key变成对象的属性名, 数组的值变成对象的属性值

2. 基本数据类型转换成对象

3. NULL转换成对象 转换成一个空对象




了解

对象当字符串使用


需求： echo $对象名;    会输出什么内容

基本介绍：

1. 利用魔术方法 __toString()

2. 同时利用 reflectionclass反射类, 


作用： 在将来写php的底层框架, 用到反射



代码：

class Monkey{

	public $name;
	protected $food;

	public function __construct($name,$food){

		$this->name = $name;
		$this->food = $food;
	}

	public function say(){
		echo '我是'.$this->name.' 喜欢吃'.$this->food.'<br/>';
	}

	public function __get($name){

		if(isset($this->$name)){
			return $this->$name;
		}else{
			return '属性不存在';
		}
	}

	public function __set($name,$value){
		
		if(isset($this->$name)){
			$this->$name = $value;
		}else{
			echo '属性不存在';
		}
	}
}

$p = new Monkey('金丝猴','香蕉');
$p->say();


echo $p->food;

echo $p->abc;
echo '<br/>';

$p->food = '苹果';
$p->say();
$p->sex = 'nvsheng';

代码：

class Cat{
	public $name;
	protected $food;
	private $sex;

	public function __construct($name,$food,$sex){
		$this->name = $name;
		$this->food = $food;
		$this->sex = $sex;
	}

	public function __isset($name){
		return $this->$name;
	}

	public function __unset($name){
		if(isset($this->$name)){
			unset($this->$name);
		}else{
			echo '要释放的属性,不存在';
		}
	}


}


$cat = new Cat('波斯猫','土豆','女');

if(isset($cat->name)){
	echo '存在';
}else{
	echo '不存在';
}

if(isset($cat->food)){
	echo '存在';
}else{
	echo '不存在';
}

unset($cat->name);
unset($cat->food);


代码：


class Dog{

	public $name;

	public function __toString(){
		return '__toSring()被调用';
	}
}

$dog = new Dog();

echo $dog;


代码：

class Animal{
	private $name;
	private $age;
	private $ability;

	public function __construct($name,$age,$ability){
		$this->name = $name;
		$this->age = $age;
		$this->ability = $ability;
	}

	public function __toString(){
		return '我的名字是'.$this->name.' 我的年龄是'.$this->age.' 我的功能是'.$this->ability;
	}
}

$xn = new Animal('犀牛',19,'耕地');

echo $xn;


代码：

class Monkey{
	public $name;
	public $food;

	public function __construct($name,$food){
		$this->name = $name;
		$this->food = $food;
	}

	public function showInfo(){
		echo $this->name.'喜欢吃'.$this->food;
	}

	public function __call($name,$args){
		echo $name.'不存在';
		echo '<pre>';
		print_r($args);
	}
}

$monkey = new Monkey('妖猴','小女孩');

$monkey->showInfo();

$monkey->showInfo2('abc',123);


代码：

$map_arr = array(

	'Dog'  => './model/Dog.class.php',
	'Cat'  => './model/Cat.class.php',
	'fish' => './model/fish.class.php'
);

function __autoload($name){

	global  $map_arr;
	require $map_arr[$name];
}



$cat  = new Cat();
$dog  = new Dog();
$fish = new fish();


代码:

$map_arr = array(

	'Dog'  => './model/Dog.class.php',
	'Cat'  => './model/Cat.class.php',
	'fish' => './model/fish.class.php'
);



function MyAutoLoad($className){

    global  $map_arr;
	require $map_arr[$className];
}

spl_autoload_register('MyAutoLoad');  


$cat  = new Cat();
$dog  = new Dog();
$fish = new fish();


代码：

class Child{

	public $name;
	public static $num = 0;

	public function __construct($name){
		$this->name = $name;
	}

	public function joinGame(){
		echo $this->name.'加入游戏<br/>';
		self::$num ++;
	}

	public function getTotalNum(){
		echo '一共有'.self::$num.'人在参加<br/>';
	}
}

$a = new Child('张三丰');
$a->joinGame();
$a->getTotalNum();
$b = new Child('张无忌');
$b->joinGame();
$b->getTotalNum();
$c = new Child('赵敏');
$c->joinGame();
$c->getTotalNum();


代码：


class Person{

	public static $a = 190;

	public function __construct(){
		echo 'hello';
	}
}

echo Person::$a;

$p = new Person();


代码：


class Student{
	public $name;
	public static $fee = 0;

	public function __construct($name){
		$this->name = $name;
	}

	public static function free($free){
		self::$fee += $free;
	}

	public static function getFee(){
		echo '一共交了'.self::$fee.'元';
	}
}
$a = new Student('犀牛精');
$a->free(4000);
$b = new Student('狐狸精');
$b->free(6000);
$a->getFee();



代码: (单列模式 第1种)

class DB{

	private $link;
	private static $instance = null;

	private function __construct(){

		$this->link = mysqli_connect('localhost','root','','test2');
	}

	public static function getIns(){

		if(self::$instance == null){
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __clone(){

	}
}

$db1 = DB::getIns();

$db2 = DB::getIns();

echo '<pre>';
var_dump($db1);
var_dump($db2);

if($db1 === $db2){
	echo '$db1 === $db2';
}else{
	echo '$db1 != $db2';
}

代码： (单例模式 第2种)

class DB{

	private $link;
	private static $instance = null;

	private function __construct(){

		$this->link = mysqli_connect('localhost','root','','test2');
	}

	public static function getIns(){

		if(!(self::$instance instanceof self)){
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __clone(){

	}
}

$db1 = DB::getIns();

$db2 = DB::getIns();

echo '<pre>';
var_dump($db1);
var_dump($db2);

if($db1 === $db2){
	echo '$db1 === $db2';
}else{
	echo '$db1 != $db2';
}

代码：


class Cat{
	public $name;
	private static $instance = null;

	private function __construct($name){
		$this->name = $name;
	}

	public static function getIns($name){

		if(self::$instance == null){
			self::$instance = new self($name);
		}
		return self::$instance;
	}

	private function __clone(){}
}

$c1 = Cat::getIns('波斯猫');

$c2 = Cat::getIns('加菲猫');

echo '<pre>';

var_dump($c1);
var_dump($c2);




代码：

class Cat{
	public $name;
	private static $instance = null;

	private function __construct($name){
		$this->name = $name;
	}

	public static function getIns($name){

		if(!(self::$instance instanceof self)){
			self::$instance = new self($name);
		}
		return self::$instance;
	}

	private function __clone(){}
}

$c1 = Cat::getIns('波斯猫');

$c2 = Cat::getIns('加菲猫');

echo '<pre>';

var_dump($c1);
var_dump($c2);

代码:

class Clerk{
	public $name;
	protected $job;
	private $salary;

	public function __construct($name,$job,$salary){
		$this->name  = $name;
		$this->job   = $job;
		$this->salary= $salary;
	}

	public function getJob($a){
		if($a == '123'){
			return $this->job;
		}else{
			return '你无授权访问';
		}
	}

}

$a = new Clerk('张三','项目经理','23000.45');

echo $a->name;
//echo $a->job;
//echo $a->salary;
echo $a->getJob('123');



代码：


class Person{

	public $name;
	protected $nick;
	private $address;

	public function __construct($name,$nick,$address){
		$this->name = $name;
		$this->nick = $nick;
		$this->address = $address;
	}

	public function __get($pro_name){
		if(isset($this->$pro_name)){
			return $this->$pro_name;
		}else{
			return '没有这个属性';
		}
	}

	public function __set($pro_name,$value){
		if(isset($this->$pro_name)){
			$this->$pro_name = $value;
		}else{
			echo '没有这个属性,无法设置';
		}
	}

}

$a = new Person('张三','小三子','北京市朝阳区');

echo $a->nicksdjdhi;
$a->addresds = '北京三里屯';

echo $a->address;

代码：

class Book{

	public $name;
	public $author;
	public $price;
	private $amount = 0;

	public function __construct($name,$author,$price){
		$this->name = $name;
		$this->author = $author;
		$this->price = $price;
	}

	public function setAmount($num){
		if(is_int($num)){
			$this->amount = $num;
		}else{
			echo '数据格式不正确';
		}
	}

	public function getAmount($code){
		if($code == 'itbull'){
			return $this->amount;
		}else{
			return '密码错误';
		}
	}
}

$bool = new Book('红楼梦','曹雪芹',29);
$bool->setAmount(2000);
echo $bool->getAmount('itbull');


代码: (对象运算符的连用)

class Student{
	public $name;
	private $school;

	public function setSchool($school){
		$this->school = $school;
	}

	public function getSchool(){
		return $this->school;
	}
}

class School{
	public $school_name;
	protected $school_address;
	private $school_class;

	public function setClass($school_class){
		$this->school_class = $school_class;
	}

	public function getClass(){
		return $this->school_class;
	}
}

class SchoolClass{
	public $class_name;
	private $class_num;

	public function __construct($class_name,$class_num){
		$this->class_name = $class_name;
		$this->class_num = $class_num;
	}
}

$my_class = new SchoolClass('PHP大牛二期班',108);
echo '<pre>';
print_r($my_class);

$my_school = new School();
$my_school->school_name = '泰牛程序员';
$my_school->setClass($my_class);

$student = new Student();
$student->name = '小贱';
$student->setSchool($my_school);

echo $student->getSchool()->getClass()->class_name;



代码: (对象运算符的连用)


class Dog{
	public $dog_name;
	public $dog_age;
	private $master;

	public function setMaster($master){
		$this->master = $master;
	}

	public function getMaster(){
		return $this->master;
	}
}

class Master{
	public $master_name;
	public $master_age;
	private $dog;

	public function setDog($dog){
		$this->dog = $dog;
	}

	public function getDog(){
		return $this->dog;
	}
}

$dog = new Dog();
$dog->dog_name = '哈士奇';
$dog->dog_age = 2;


$master = new Master();
$master->name = '张三丰';
$master->age = 60;
$master->setDog($dog);
// echo '<pre>';
// var_dump($master->getDog());

echo $master->getDog()->dog_name;

$dog->setMaster($master);

echo $dog->getMaster()->master_name;



代码： (继承的基本介绍)

class Person{
	public $name;
	public $sex;
	protected $fen;

	public function __construct($name,$age){
		$this->name = $name;
		$this->age  = $age;
	}

	public function setFee($fen){
		$this->fen = $fen;
	}

	public function getFee(){
		return $this->name.'考了'.$this->fen.'分';
	}
}

class Pupil extends Person{

	public function testing(){
		echo '小学生考试,考的是小学数学';
	}

}

class Student extends Person{

	public function testing(){
		echo '大学生考试,考的是微积分';
	}

}

$a = new Pupil('灰姑娘',20);
$a->testing();
$a->setFee(60);
echo $a->getFee();

$b = new Student('黑猫警长',30);
$b->testing();
$b->setFee(80);
echo $b->getFee();

代码 : (继承的可访问属性和方法)

class Person{
	public $name = '泰牛';
	protected $age = 10;
	private $salary = 94.5;

	public function abc1(){
		echo 'abc1';
	}

	protected function abc2(){
		echo 'abc2';
	}

	private function abc3(){
		echo 'abc3';
	}
}
class Student extends Person{
	public $address = '唐家岭';

	public function showInfo(){
		echo $this->name.'=='.$this->age;
	}

	public function useMethod(){
		$this->abc1();
		$this->abc2();
	}
}

$a = new Student();

echo '<pre>';

var_dump($a);
$a->showInfo();
$a->useMethod();


代码:  (在子类没有定义构造函数时,子类创建对象时,会自动调用父类的构造函数,)

class A{

	//构造函数
	public function __construct(){
		echo 'class A';
	}
}

class B extends A{

}

$b = new B();


代码:  (在子类有定义构造函数时,子类创建对象时,会自动调用子类自己的的构造函数,)

class A{

	//构造函数
	public function __construct(){
		echo 'class A';
	}
}

class B extends A{

	public function __construct(){
		echo 'class B';
	}
}

$b = new B();


代码:  

(在子类有定义构造函数时,子类创建对象时,会自动调用子类自己的的构造函数,同时子类的构造方法通过parent::__construct把父类的构造方法继承过来)


class A{

	//构造函数
	public function __construct(){
		echo 'class A';
	}
}

class B extends A{

	public function __construct(){
		parent::__construct();
		echo 'class B';
	}
}

$b = new B();


代码: (利用模式方法__call来实现方法的重载)


class DB{

	public function __call($pro_name,$args){
		if($pro_name == 'getVal'){
			$num = count($args);
			if($num == 2){

				if(is_numeric($args[0]) && is_numeric($args[1])){
					return $this->getSum($args[0],$args[1]);
				}

			}elseif($num == 3){

				if(is_numeric($args[0]) && is_numeric($args[1]) && is_numeric($args[2])){
					return $this->getMax($args[0],$args[1],$args[2]);
				}

			}
		}else{
			echo '这个方法不存在'.$pro_name;
		}
	}

	public function getSum($a,$b){
		return $a + $b;
	}

	public function getMax($a,$b,$c){
		return max($a,$b,$c);
	}
}

$a = new DB();
echo $a->getVal(1,6);
echo $a->getVal(1,6,5);
echo $a->jashf();


代码: (属性的重载)  &&&&&&#####

class Dog{
	public $name = '黑狗';
	private $age = 10;
	private $pro_array;

	public function __set($pro_name,$value){
		$this->pro_array[$pro_name] = $value;
	}

	public function __get($pro_name){
		if(isset($this->pro_array[$pro_name])){
			return $this->pro_array[$pro_name];
		}else{
			return '没有这个属性'.$pro_name;
		}
	}
}

$a = new Dog();
echo $a->name;
$a->sex = '公';
echo $a->sex;


&&&&&&#####



代码： (重写)

class Animal{
	public $name;

	public function crying(){
		echo '动物会叫...';
	}
}

class Cat extends Animal{

	public function crying(){
		echo '小猫喵喵叫>>>';
	}
}

$cat = new Cat();

$cat->crying();


代码： (重写的具体细节)


class Animal{
	public $name;

	public function crying(){
		echo '动物会叫...';
	}
}

class Cat extends Animal{

	public function crying(){
		echo '小猫喵喵叫>>><br/>';
		parent::crying();
	}
}

$cat = new Cat();

$cat->crying();class Animal{
	public $name;

	public function crying(){
		echo '动物会叫...';
	}
}

class Cat extends Animal{

	public function crying(){
		echo '小猫喵喵叫>>><br/>';
		parent::crying();
	}
}

$cat = new Cat();

$cat->crying();




代码： (重写的具体细节)


class Animal{
	public $name;

	public function crying(){
		echo '动物会叫...';
	}
}

class Cat extends Animal{

	public function crying(){
		echo '小猫喵喵叫>>><br/>';
		Animal::crying();
	}
}

$cat = new Cat();

$cat->crying();


代码: 

class Dog{

}

class Cat{

}

function test(Dog $dog,array $arr){
	var_dump($dog);
	print_r($arr);
}

test(new Dog(),array(1,6));


代码： 


class Animal{

	public $name;

	public function __construct($name){
		$this->name = $name;
	}
}

class Dog extends Animal{

	public function showInfo(){
		echo $this->name;
	}
}

class Cat extends Animal{

	public function showInfo(){
		echo $this->name;
	}
}

class Food{
	public $name;

	public function __construct($name){
		$this->name = $name;
	}
}

class Fish extends Food{

	public function showInfo(){
		echo $this->name;
	}
}

class Clona extends Food{

	public function showInfo(){
		echo $this->name;
	}
}

$a = new Dog('黑狗');
$b = new Cat('小猫');

$c = new Fish('鲤鱼');
$d = new Clona('骨头');

class Master{
	public $name;

	public function __construct($name){
		$this->name = $name;
	}

	public function feed(Animal $animal,Food $food){
		$animal->showInfo();
		echo '喜欢吃';
		$food->showInfo();
		echo '<br/>';
	}
}

$master = new Master('张三丰');
$master->feed($a,$d);
$master->feed($b,$c);


代码： (多态)

class Animal{

	public $name;

	public function __construct($name){
		$this->name = $name;
	}

	public function showInfo(){
		echo $this->name;
	}
}

class Dog extends Animal{

}

class Cat extends Animal{

}

class Sheep extends Animal{

}

class Food{

	public $name;

	public function __construct($name){
		$this->name = $name;
	}

	public function showInfo(){
		echo $this->name;
	}
}

class Fish extends Food{

}

class Clona extends Food{

}

class Green extends Food{

}

class Master{

	public $name;

	public function __construct($name){
		$this->name = $name;
	}

	public function feed(Animal $animal,Food $food){
		$animal->showInfo();
		echo '喜欢吃';
		$food->showInfo();
		echo '<br/>';
	}
}

$a = new Dog('哮天犬');

$b = new Cat('波斯猫');

$c = new Fish('大鲤鱼');

$d = new Clona('酱大骨');

$e = new Sheep('喜羊羊');

$f = new Green('青草');

$master = new Master('张三丰');

$master->feed($a,$d);
$master->feed($b,$c);
$master->feed($e,$f);


代码: (多态再说明)


当子类去访问父类的属性时, parent::父类方法(){ $this->属性名 }  如果这个属性被子类继承, 则输出子类的值, 如果没继承就输出父类的值


class A{
	private $num1 = 100;
	protected $num2 =200;
    public $num3 = 300;

    public function show1(){
    	echo '<br/>num3='.$this->num3;
    }

    protected function show2(){
    	echo '<br/>num2='.$this->num2;
    }

    protected function show3(){
    	echo '<br/>num1='.$this->num1;
    }
}

class B extends A{
	private $num1 = 1;
	protected $num2 = 2;
	public $num3 = 3;

	public function show1(){
		echo '<br/>num3='.$this->num3;
		parent::show1();
	}

	public function show2(){
		echo '<br/>num2='.$this->num2;
		parent::show2();
	}

	public function show3(){
		echo '<br/>num1='.$this->num1;
		parent::show3();
	}
}

$b = new B();
$b->show1();
$b->show2();
$b->show3();



代码 : (类名可以是一个变量)   简

class Dog{

}

$as = 'Dog';

$a = new $as();

echo '<pre>';

var_dump($a);

代码: (类名可以是一个变量)   繁



class Person_china{

	public function cry(){

		echo '中国,泰牛程序员';
	}

}

class Person_Anrimal{

	public function cry(){

		echo '美国,硅谷程序员';
	}

}

$country = 'china';

$className = 'Person_'.$country;

$per = new $className();

$per->cry();



代码: 

abstract class A{

	abstract public function getSum($a,$b);
}

class B extends A{

	public function getSum($a,$b){
		return $a + $b;
	}
}

$nb = new B();
echo $nb->getSum(1,6);



代码 : 

abstract class A{

	abstract public function getSum($a,$b);
}

class B extends A{

	public function getSum($a,$b){
		return $a + $b;
	}
}

abstract class C extends A{

	abstract public function sayHello();
}

class D extends C{

	public function getSum($a,$b){
		return $a + $b;
	}

	public function sayHello(){
		echo 'hello world';
	}
}

$nb = new B();
echo $nb->getSum(1,6);




代码：



abstract class DB{

	public $conn;

	abstract public function getConnect(array $arr = null);

	abstract public function query(array $arr = null);
}


class MysqlDB extends DB{

	public function getConnect(array $arr = null){
		echo '实现mysql连接';
	}

	public function query(array $arr = null){
		echo '查询mysql';
	}
}

class OraloDB extends DB{

	public function getConnect(array $arr = null){
		echo '实现mysql连接';
	}

	public function query(array $arr = null){
		echo '查询mysql';
	}
}



代码 :

abstract class Animal{

	public static function abc(){
		echo 'abc...';
	}
}


Animal::abc();


代码 :  (接口)

interface iMyInterface{

	public function getSum($n1,$n2);
}

class Monkey implements iMyInterface{

	public function getSum($n1,$n2){
		return $n1 + $n2;
	}
}


$monkey = new Monkey();

echo $monkey->getSum(1,6);



代码 ：

interface iUsb{

	//开始工作
	public function start();

	//停止工作
	public function close();
}

//手机开始工作
class Iphone implements iUsb{

	public function start(){
		echo '手机usb开始工作<br/>';
	}

	public function close(){
		echo '手机usb停止工作<br/>';
	}
}


//相机开始工作
class Camera implements iUsb{

	public function start(){
		echo '相机usb开始工作<br/>';
	}

	public function close(){
		echo '相机usb停止工作<br/>';
	}
}

//计算机类

class Computer{

	public function work($iUsb){
		$iUsb->start();
		echo '工作了四小时...<br/>';
		$iUsb->close();
	}
}

$a = new Iphone();
$b = new Camera();
$c = new Computer();
$c->work($a);
$c->work($b);


代码 :  (一个类实现多个接口)


interface iAbc{

	public function sayHello();
}

interface iBcd{

	public function sayHi();
}

class A implements iAbc,iBcd{

	public function sayHello(){
		echo 'hello';
	}

	public function sayHi(){
		echo 'hi';
	}
}

$a = new A();

$a->sayHello();
$a->sayHi();


代码： (接口的属性只能是常量 const)

interface iUsb{

	const TEX_RATE = 3.17;

	public function sayHello();
}

echo iUsb::TEX_RATE;


代码 : (一个接口，可以同多继承多个接口)


interface iUsb{

	public function abc();
}

interface iMyMonkey{
	public function getSum($a,$b);
}
interface iUsc extends iUsb,iMyMonkey{

	public function abz();
}

class A implements iUsc{
	public function abc(){}

	public function getSum($a,$b){
		return $a + $b;
	}

	public function abz(){}
}





代码： (继承类 VS 接口实现)


class Monkey{
	public $name;
	public $age;
	public $sex;

	public function pashu(){
		echo '猴子会爬树<br/>';
	}
}

interface iBird{
	public function fly();
}

interface iFish{

	public function swim();
}


class SmallMonkey extends Monkey implements iBird,iFish{

	public function run(){
		echo '猴子会跑步<br/>';
	}

	public function fly(){
		echo '小猴子学会了鸟的飞行<br/>';
	}

	public function swim(){
		echo '小猴子学会了鱼的游泳<br/>';
	}
}

$a = new SmallMonkey();
$a->pashu();
$a->run();
$a->fly();
$a->swim();


代码 : 


class SuperMan{

	public $name;
	public $ability;

	final public function attact(){
		echo '超人的攻击方式:原子弹...<br/>';
	}
}

class Gtx extends SuperMan{

	public function attact2(){
		echo '钢铁侠的攻击方式:氢弹...<br/>';
	}
}



代码 : (类常量)

class Company{
   
    const TAX = 0.08;
   
	public function getTax($money){

		return $money*self::TAX;
	}
}


$company = new Company();

echo $company->getTax(30000);



代码：

class Company{

	const TAX_RATE = 0.08;

	public function getTax($money){
		return self::TAX_RAYE*$money;
	}
}

class A{
	public function getTest(){
		return 'A'.Company::TAX_RATE;
	}
}

echo Company::TAX_RATE;

echo '<br/>';

function getTex(){
	return Company::TAX_RATE;
}


echo getTex();

echo '<br/>';

$test = new A();
echo $test->getTest();


代码： (对象的遍历)

class Cat{
	public $name = '小黑猫';
	protected $age = 10;
	private $lover = '大黑猫';

	public function showInfo(){
		foreach($this as $key => $val){
			echo '属性:'.$key.'==>'.'属性值'.$val.'<br/>';
		}
	}
}

$cat = new Cat();

foreach($cat as $key => $val){
	echo '属性：'.$key.'=>'.'属性值:'.$val.'<br/>';
}

$cat->showInfo();




代码： (php内置标准类)


$std = new stdClass();

$std->name = '八戒';
$std->ability = '36变';

echo '<pre>';

var_dump($std);


echo 'name'.$std->name;
echo 'ability'.$std->ability;



代码:  (数组转成对象) 强制转换


$arr = array('no1'=>'宋江','no2'=>'卢俊义','no3'=>'吴用');

$arr_obj = (object)$arr;

echo '<pre>';

var_dump($arr_obj);

echo $arr_obj->no3;


代码： （基本数据类型转换成对象）


$age = 10;

$age_obj = (object)$age;

echo '<pre>';

var_dump($age_obj);

echo $age_obj->scalar;


代码： （基本数据类型转换成对象）


$nu = NULL;

$nu_obj = (object)$nu;

echo '<pre>';
var_dump($nu_obj);



代码 ： (对象转换成字符串)


class Dog{
	public $name;
	protected $age;
	private $lover;

	public function __construct($name,$age,$lover){
		$this->name = $name;
		$this->age = $age;
		$this->lover = $lover;
	}

	protected function cry(){
		echo '汪汪叫...<br/>';
	}

	public function __toString(){
		$reflection_class = new reflectionclass($this);
		echo '<pre>';
		var_dump($reflection_class);
		echo '这个类的类名是:'.$reflection_class->getName();
		echo '<br/>';
		var_dump($reflection_class->getMethods()[0]->name);
		return '13';
	}
}

$dog = new Dog('小黑狗',2,'小黄狗');

echo  $dog;




代码:

class Dog{
	public $name;
	protected $age;

	public function __construct($name,$age){
		$this->name = $name;
		$this->age  = $age;
	}
}

$dog = new Dog('小黄狗',20);

$str = serialize($dog);

echo '<pre>';

echo $str;

echo '<br/>';

file_put_contents('a.txt', $str);

$str2 = file_get_contents('a.txt');

$dog_un_obj = unserialize($str2);

var_dump($dog_un_obj);