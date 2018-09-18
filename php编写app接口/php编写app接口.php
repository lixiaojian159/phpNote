<?php

/**
 *   app接口 (又名：通信接口)
 *
 *   界面布局  和   填充数据
 *
 *   请求app地址(接口地址) ---> 返回接口数据 ---> 解析数据  ---> 客户端
 *
 *   app 接口定义：
 *                  接口地址：
 *                  接口文件：  处理一些业务逻辑
 *                  接口数据：
 */

/**
 *    XML
 *     定义：  (Extensible  Markup  Language)  扩展标记语言
 *     作用：  用来标记数据、定义数据类型，是一种允许用户对自己的标记语言惊醒定义的源语言
 *             XML  ---> 节点可以自定义(标签)
 *             根节点只能有一个,  必须有结束标签
 *             可读性比较强
 *     XML 格式统一,跨平台
 *
 */

/**
 *  JSON  (JavaScript Object Nonation)  一种轻量型的数据交换格式
 */

/**
 *  XML 与 JSON 区别对比：
 *
 *      1.   可读性      ----->    XML  优
 *      2.   生成数据    ----->    JSON 优
 *      3.   传输速度    ----->    JSON 优
 */

/**
 *    app接口的用途：
 *                 1.获取数据
 *                 2.提交数据
 */






/**
 * iconv('原始编码','要转化后的编码','数据');
 * 此函数用户字符串的编码转换
 */

/**
 *   通信数据标准格式
 *
 *     code      状态码 (200,400)
 *     message   提示信息(邮箱格式不正确,返回数据成功)
 *     data      返回数据
 *
 */



 /**
  *   封装app通信接口的方法
  *
  *   1.  JSON 方式封装接口方法  (只能转化utf-8的数据)
  *   2.  XML  方式封装接口方法
  */



/**
 *   1.  JSON 方式封装接口方法  (只能转化utf-8的数据)
 */

 /**
  * [Response 按JSON数据输出数据]
  * @param  integer  $code 状态码
  * @param  string   $msg  提示信息
  * @param  array    $data 返回数据
  * return  string
  */

 class Response{

     public static function json($code,$msg='',$data=[]){
       if(!is_numeric($code)){
         return '';
       }
        $arr = [
          'code' => $code,
          'msg'  => $msg,
          'data' => $data,
        ];

        echo  json_encode($arr);
        exit;
     }
 }



 Response::json('200','返回数据成功',['id'=>1,'name'=>'lijian']);



 /**
  *   2.  XML 方式封装接口方法  (只能转化utf-8的数据)
  *
  *       2.1   php生成xml数据
  *                            ------> 组装字符串
  *                            ------> 使用系统类 (DomDocument,XMLWriter,SimpleXML)
  *       2.2   XML方式封装接口数据方法
  */


/**
 *   2.1  php生成XML数据  (组装字符串)
 */

 **
  * [Response 生成XML数据]
  * @param  integer  $code 状态码
  * @param  string   $msg  提示信息
  * @param  array    $data 返回数据
  * return  string
  */
  class Response{

    public static function xml(){
      header("Content-Type:text/xml");
      $xml  = '<?xml version="1.0" encoding="UTF-8"?>';
      $xml .= '<root>';
      $xml .= '<code>200</code>';
      $xml .= '<message>返回数据成功</message>';
      $xml .= '<data>';
      $xml .= '<id>1</id>';
      $xml .= '<name>lijian</name>';
      $xml .= '</data>';
      $xml .= '</root>';
      echo $xml;
    }
  }

  Response::xml();


  /**
   *   2.2  XML 方式封转数据 (组装字符串)
   */




   class Response{
     public static function xmlEncode($code,$msg='',$data){
       if(!is_numeric($code)){
         return '';
       }
         $arr = [
           'code' => $code,
           'msg'  => $msg,
           'data' => $data,
         ];
         header("Content-Type:text/xml");
         $xml  = '<?xml version="1.0" encoding="UTF-8"?>';
         $xml .= '<root>';
         $xml .= self::xmlToEncode($arr);
         $xml .= '</root>';
         echo $xml;
     }

     public static function xmlToEncode($data){
       $xml  = '';
       $attr = '';
       foreach($data as $key => $val){
         if(is_numeric($key)){
           $attr = " id='{$key}'";
           $key  = "item";
         }
         $xml .= "<{$key}{$attr}>";
         $xml .= is_array($val) ? self::xmlToEncode($val) : $val;
         $xml .= "</{$key}>";
       }
       return $xml;
     }
   }

   Response::xmlEncode(200,'返回数据成功',['id'=>1,'name'=>'lijian','type'=>[1,2,3]]);




   /**
    *  综合方式 可以选择json 或者选择xml  默认 json
    *  简单写法 , 无优化
    */


    class Response{

      public static function show($code,$msg='',$data=[],$type='json'){
        if($type == 'json'){
          self::json($code,$msg,$data);
        }elseif($type == 'xml'){
          self::xmlEncode($code,$msg,$data);
        }
      }

      public static function json($code,$msg='',$data=[]){
        if(!is_numeric($code)){
          return '';
        }
         $arr = [
           'code' => $code,
           'msg'  => $msg,
           'data' => $data,
         ];

         echo  json_encode($arr);
         exit;
      }


      public static function xmlEncode($code,$msg='',$data){
        if(!is_numeric($code)){
          return '';
        }
          $arr = [
            'code' => $code,
            'msg'  => $msg,
            'data' => $data,
          ];
          header("Content-Type:text/xml");
          $xml  = '<?xml version="1.0" encoding="UTF-8"?>';
          $xml .= '<root>';
          $xml .= self::xmlToEncode($arr);
          $xml .= '</root>';
          echo $xml;
      }

      public static function xmlToEncode($data){
        $xml  = '';
        $attr = '';
        foreach($data as $key => $val){
          if(is_numeric($key)){
            $attr = " id='{$key}'";
            $key  = "item";
          }
          $xml .= "<{$key}{$attr}>";
          $xml .= is_array($val) ? self::xmlToEncode($val) : $val;
          $xml .= "</{$key}>";
        }
        return $xml;
      }
    }

    Response::show(200,'返回数据成功',['id'=>1,'name'=>'lijian','type'=>[1,2,3]],'xml');


/**
 *    核心技术
 *           1.  缓存技术
 *                1.1     静态缓存
 *                1.2.1   Memcache
 *                1.2.2   redies
 *           2.  定时任务
 */


/**
 *   php 操作缓存：
 *                1. 生成缓存
 *                2. 获取缓存
 *                3. 删除缓存
 */


 /**
  *   生成静态缓存
  */

  /**
  *   File  静态缓存   版本一
  *
  *   @param  string   $key          静态文件名称
  *   @param  如果是  空字符串        读取静态文件
  *           如果是  NULL           删除缓存
  *           如何是  string/array   生成缓存
  *   @param  string  文件路径
  *
  *   return  boolean
  */

 class File{

 	const EXT = '.txt';
 	public $dir;

 	public function __construct(){
 		$this->dir = dirname(__FILE__).'/files/';
 	}

 	public function cacheData($key,$value,$path){

 		$dirname  = $this->dir.$path.'/';
 		$filename = $dirname.$key.self::EXT;

 		if(!is_dir($dirname)){
 			mkdir($dirname,0777);
 		}

 		if($value !== ''){

 			if($value === NULL){
 				return unlink($filename);
 			}
 			return file_put_contents($filename,json_encode($value));
 		}

 		if(is_file($filename)){

 			$file = json_decode(file_get_contents($filename));
      return $file;
 		}
 	}
 }

 $data = [
 	'id'   => 201,
 	'name' => 'lijian12',
 ];

 $file = new File();
 $file->cacheData('test',$data,'156');




 /**
  *   File  静态缓存
  *
  *    File  静态缓存   版本二  (与版本一的差别：缓存有效期)
  *
  *   @param  string   $key          静态文件名称
  *   @param  如果是  空字符串        读取静态文件
  *           如果是  NULL           删除缓存
  *           如何是  string/array   生成缓存
  *   @param  int     $cacheTime     缓存有效期
  *   @param  string  文件路径
  *
  *   return  boolean
  */

 class File{

 	const EXT = '.txt';
 	public $dir;

 	public function __construct(){
 		$this->dir = dirname(__FILE__).'/files/';
 	}

 	public function cacheData($key,$value='',$cacheTime=0){

 		$dirname  = $this->dir;

 		$filename = $dirname.$key.self::EXT;

 		if(!is_dir($dirname)){
 			mkdir($dirname,0777);
 		}

 		if($value !== ''){

 			if($value === NULL){
 				return unlink($filename);
 			}
 			$cacheTime = sprintf('%011d',$cacheTime);
 			return file_put_contents($filename,$cacheTime.json_encode($value));
 		}

 		if(is_file($filename)){

 			$contents  = file_get_contents($filename);
 			$content   = substr($contents,11);
 			$cacheTime = intval(substr($contents,0,11));  //强制转换
 			if( $cacheTime != 0 && ($cacheTime + filemtime($filename)) < time()){
 				unlink($filename);
 				return false;
 			}
 			$file = json_decode($content,true);
 			return $file;
 		}
 	}
 }

 $data = [
 	'id'   => 201,
 	'name' => 'lijian12',
 ];

 $file = new File();
 $file->cacheData('test');


 /**
  *  memcache  Redis
  *
  *   1.  memcache 和 Redis 都是用来管理数据的
  *   2.  他们都是把数据存储在内存里
  *   3.  Redis 可以定期把数据备份到磁盘(持久化)
  *   4.  memcache 只是简单的 key/value 缓存
  *   5.  Redis 不仅支持 key/value 存储数据, 还提供了 list、set、hash等数据结构的存储
  */


 /**
  *  如何操作数据库 mysql
  *
  *   mysql  客户端   mysql服务器
  */


 /**
  *  Redis  缓存技术 (数据操作)
  *
  *   1.  开启 Redis客户端
  *   2.  设置缓存值    set 缓存名称  缓存数据
  *   3.  获取缓存值    get 缓存名称
  *   4.  设置过期时间  setex  key 10 value  (10s)
  *   5.  删除缓存值    delete key
  *
  *
  * 重点  ：  php如何操作 Redis
  *
  *   1.  安装phpredis扩展
  *   2.  php链接 redis服务 --connect(127.0.0.1  6379端口)
  *   3.  set  设置缓存
  *   4.  get  获取缓存
  */




/**
 *  php 操作Redis设置缓存
 */

 $redis = new Redis();
 $redis->connect('127.0.0.1',6379);
 $redis->set('singwa',123);

 /**
  *  php 操作Redis 获取缓存
  */


  $redis = new Redis();
  $redis->connect('127.0.0.1',6379);
  $singwa = $redis->get('singwa');
  var_dump($singwa);


  /**
   *  php 操作 Redis 获取缓存, 有效时间
   */


 $reids = new Redis();
 $redis->connect('127.0.0.1',6379);
 $redis->setex('singwa',10,'456');



/**
 *  php 操作 memcache 缓存
 *
 *    前提： 安装一个扩展
 *
 *    1.  安装 memcache 扩展
 *    2.  链接服务--connect('memcache_host',11211);
 *    3.  set 设置缓存
 *    4.  get 获取缓存
 */


/**
 *   定时任务  主要是 讲 linux下
 *
 *    1.  如何设置定时任务  常用命令
 *    2.  如何定时运行php程序
 *
 *    定时任务  提供 crontab命令 来设置
 *
 *    crontab -e   编辑某个用户的 cron 服务
 *    crontab -l   列出某个用户的 cron 服务的详细内容
 *    crontab -r   删除某个用户的 cron 服务
 *
 *
 *
 *    定时任务 格式
 *
 *        分   小时     日    月     星期    命令
 *        *     *       *     *       *     command
 *       0-59  0-23    1-31   1-12   0-6
 *
 *        *  代表取值范围数字
 *        /  代表每
 *
 *     例子：
 *
 *                       */1  * * * *  php  /www/data/contest.php   每分钟执行一次 contest.php 文件
/**
 *                       50  7 * * *   /sbin/server  ssh start      每天的 7:50 开启ssh服务
 *
 */



/**
 *    定时任务 结合php案例
 *
 *    问题：   如何设置每分钟插入数据到数据表中
 */


/**
 *   APP接口实例
 *
 *    单例模式 连接数据库
 *
 *    单例的三大原则：
 *                   1. __construct()析构方法  非public (防止外部new实例化)
 *                   2. 拥有一个保存实例的 public 的静态成员变量 static $_instance
 *                   3. 拥有一个访问这个方法(公共、静态)
 */


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




/**
 *  首页APP接口开发 ：
 *
 *    1. 从读取数据库方式      数据库  --->  封装   ---> 生成接口数据  (数据时效性比较高)
 *
 *    2. 从缓存数据方式        数据库  ----> 封装  ---> 缓存 ----> 返回数据
 *
 *    3. 定时读取缓存数据方式  数据库  --->
 *
 */


/**
 *   首页APP接口开发   从数据库里面读取数据
 *
 *    1. 如何获取数据
 *    2. 如何将获取的数据生成通信数据
 *
 *    HTTP请求  --->  服务器 ----> 查询数据 ---> 返回数据
 */

/**
 *  *** 一定要养成书写  接口文档
 */


 /**
  *  首页APP接口开发  读取缓存的方式
  *
  *   1. 静态缓存如何设置缓存时间
  *
  *   2. 如何设置缓存
  *
  *       静态缓存     memcache缓存   Redis缓存
  */


/**
 *  定时读取缓存方式
 *
 *   1. 如何编写定时脚本程序
 *   2. 理解服务器如何提前准备数据
 *
 *   项目场景：
 *       HTTP请求  ----> 服务器 --->  读取缓存
 *       crontab ---> 生成缓存
 */


*/5 * * * * /usr/bin/php  data/www/app/cron.php   
