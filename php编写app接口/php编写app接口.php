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
