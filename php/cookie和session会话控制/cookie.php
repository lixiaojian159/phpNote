<?php

/*

cookie

保存地址：   客户端   1.  内存cookie  由浏览器维护, 保存在内存中, 浏览器关闭, cookie销毁

                     2.  硬盘cookie 保存在硬盘里, 有一个过期时间, 到期自动销毁, 也可以手动销毁


使用场景:    永久登录   购物车


具体操作:   

1. 设置cookie

   bool setcookie ( string $name [, string $value = "" [, int $expire = 0 [, string $path = "" [, string $domain = "" [, bool $secure = false [, bool $httponly = false ]]]]]] )

   (简写)setcookie(string $name, string $value, int $expire, $path, $domain, $secure)

   $name  : 名称 ****
   $value : 值   ****
   $expire: 有效时间, 默认值为0, 单位：秒数  *****


   $path ： 有效路径 默认是当前目录和子目录, 也可以指定根目录/
   $domain : 设置cookie的作用域, 默认在本域下   (如果网站有二级、三级域名)
   $secure : 设置是否cookie只能通过https传输, 默认是false   作用： 安全, 可以减少XSS攻击


2. 读取cookie

   cookie数据保存在$_COOKIE

   $_COOKIE['cookie名'];


3. 更新cookie

   setcookie($name,$value,$time);  $name相同, 则更新以前的cookie, 

   注意: 如果要修改以前的cookie, 一定要选项相同('名字','有效路径','有效域名')

4. 删除cookie

   a. 可以在浏览器手动删除  (测试时，使用)

   b. setcookie('username','',time()-1);

      setcookie('username',null);

      注意: 一定要选项相同('名字','有效路径','有效域名')


5. 通过header方式设置cookie

   header('Set-Cookie:name=value[;expires=value][;domain=value][;path=value][;ecure=true][;httponly=true]');

   注意：  value的两边无''(引号)



6. cookie 保存数组形式的数据

setcookie('username[name]','zhangsan',strtotime('+1 day'));
setcookie('username[email]','56559@qq.com',strtotime('+1 day'));
setcookie('username[qq]','56559',strtotime('+1 day'));



7. 通过js操作cookie   不会(慕课网)


代码： (内存cookie, 浏览器关闭后,cookie自动销毁)

setcookie('username','king1');
setcookie('age',20);
setcookie('email','4546448376876@qq.com');


var_dump($_COOKIE);




8. 用面向对象的思想, 封装一个cookie设置、读取、删除的类  (代码下面)



9. cookie的缺点

   a. cookie不要保存敏感数据, 会被劫取, 伪造和欺骗

   b. 不能把cookie当作的客户端的一个储存容器, 每一个浏览器可以存储的cookie的数量是有限的, cookie中保存的最大字节：4K

   c. cookie设置后, 每次http请求, cookie都会在header头中发送, 浪费带宽



10. HTML5新技术 替代 cookie 

    localStorage

    常用的API :
               设置  localStorage.setItem(key,value);    localStorage('test','this is test1');
               读取  localStorage.setItem(key);
               删除某个 localStorage.removeItem(key);
               清空  localStorage.clear();
               获取指定的键名  localStorage.key(0)

   localStorage 只能保存字符串, 如果是json数据需要转换
   
   例子：

   var userInfo = {'username':'zhangsan','age':23,'tel':'123456896'};

   localStorage.setItem('userInfo',JSON.stringify(userInfo));     //  localStorage.getItem('userInfo'); 

   JSON.parse(localStorage.getItem('userInfo'));




代码: (硬盘cookie,设置了cookie的有效期)


setcookie('username','zhangsan',time()+10);
setcookie('age',20,time()+15);
setcookie('email','62453445@qq.com',time()+20);)
setcookie('test','test@qq.com',time()+60*60);


代码：  (有效日期的不同写法)

setcookie('test','aaaaaa',strtotime('+7 days'));
setcookie('username','zhangsan',time()+3600)
setcookie('test2','bbbbbbb',strtotime('+1 day'));


代码:  (有效路径)

setcookie('username1','zhangsan1',time()+3600);           //默认为当前目录下
setcookie('username2','zhangsan2',time()+3600,'/');       //根目录
setcookie('username3','zhangsan3',time()+3600,'/test/a/');//指定目录(根目录-->test目录-->a目录)


代码： 


setcookie('username','zhangsan',time()+3600,'/','');       http://文件路径  可以访问   默认是false
setcookie('password','123456',time()+3600,'/','',true);    https://文件路径 可以访问   (更安全)



代码： (通过header设置)


header('Set-Cookie:a=1');

header('Set-Cookie:username=zhangsan;expires='.gmdate('D, d M Y H:i:s \G\M\T',time()+3600));

header('Set-Cookie:a=1;expires='.gmdate('D, d M Y H:i:s \G\H\T',time()+3600).';path=/');

header('Set-Cookie:b=2;secure=true');  只能https设置，访问

header('Set-Cookie:c=3;httponly=true'); 不能javascript获取和设置


代码：  (封装一个cookie设置、读取、销毁的类)


class CustomCookie{
   private static $instance = null;
   private $expire = 0;
   private $path = '';
   private $domain = '';
   private $secure = false;
   private $httponly = false;

   private function __construct($options = []){
      $this->setOptions($options);
   }

   private function setOptions($options = []){
      if(isset($options['expire'])){
         $this->expire = $options['expire'];
      }
      if(isset($options['path'])){
         $this->path = $options['path'];
      }
      if(isset($options['domain'])){
         $this->domain = $options['domain'];
      }
      if(isset($options['secure'])){
         $this->secure = $options['secure'];
      }
      if(isset($options['httponly'])){
         $this->httponly = $options['httponly'];
      }
   }

   public function set($name,$value,$options = []){

      if(is_array($options) && count($options) > 0){
         $this->setOptions($options);
      }
      if(is_array($value) || is_object($value)){
         $value = json_encode($value,JSON_FORCE_OBJECT);
      }
      setcookie($name,$value,$this->expire,$this->path,$this->domain,$this->secure,$this->httponly);
   }

   public function get($name){
      if(isset($_COOKIE[$name])){
         if(substr($_COOKIE[$name],0,1) == '{'){
            $value = json_decode($_COOKIE[$name]);
         }else{
            $value = $_COOKIE[$name];
         }
         return $value;
      }else{
         return null;
      }
   }

   public function delete($name,$option = []){
      if(is_array($options) && count($options) > 0){
         $this->setOptions($options);
      }
      if(isset($_COOKIE[$name])){
         setcookie($name,'',time()-1,$this->expire,$this->path,$this->domain,$this->secure,$this->httponly);
      }
      unset($_COOKIE[$name]);
   }
   public function deleteAll($options = []){
      if(is_array($options) && count($options) > 0){
         $this->setOptions($options);
      }
      foreach($_COOKIE as $name => $value){
         setcookie($name,'',time()-1,$this->expire,$this->path,$this->domain,$this->secure,$this->httponly);
         unset($_COOKIE[$name]);
      }
   }

   public static function getIns($options = []){
      if(!(self::$instance instanceof self)){
         self::$instance = new self;
      }

      return self::$instance;
   }
}

$arr = array(
           'expire'   => time()+3600,
           'path'     => '/',
           'domain'   => 'localhost',
           'secure'   => true,
           'httponly' => true,
);

$cookie_test = CustomCookie::getIns();

$cookie_test->set('aa','123',$arr);

//$aa = $cookie_test->get('aa');

$cookie_test->set('userInfo',array('username'=>'zhangsan','password'=>'123456'),array('expire'=>time()+3600));

$userInfo = $cookie_test->get('userInfo');

echo '<pre>';
print_r($userInfo);

$cookie_test->delete('userInfo');

echo '<pre>';
print_r($userInfo);