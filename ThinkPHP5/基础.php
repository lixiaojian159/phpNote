<?php

/**
 *    ThinkPHP5.0  版本
 */

/**
 *   thinkphp5  中最灵活的内容就是      url路由      控制器的接收参数     数据库操作 ***********
 */


/**
 *   url  访问路径s
 *   localhost/Zerg/public/index.php/模块/控制器/方法
 *   sample.lijian159.cn/index.php/模块/控制器/方法
 *
 *   域名/入口文件/ ../../..
 *
 *   模块 ：不要把一个功能放一个模块, 模块还是很大的, 中小型企业一般都是单模块
 */


/**
 *  重温： 在本地设置虚拟域名
 */

/**
 *  学会使用： postman 测试接口的工具
 */

/**
 *  路由  有两种编写方法
 *
 *   url 路径格式  (要知道如何在 config.php配置文件 中配置)
 *
 *   PATH_INFO 模式
 *
 *   混合模式 (不是同一个操作模式)
 *
 *   强制模式  (必须使用路由)
 */

/**
 *   路由规则
 *
 *   1.  Route::rule( '路由表达式' , '路由地址' , '请求类型' , '路由参数(数组)' , '变量规则(数组)' );
 *
 *     方式：  GET  POST  DETELE PUT  *
 *
 *
 *     快捷路由定义方式
 *
 *     Route::方式( 'url访问表达式' , '模块/控制器/方法' )；
 *     Route::get ( 'hello' , 'sample/Test/hello' );
 *     Route::post( 'hello' , 'sample/Test/hello' );
 *     Route::any ( 'hello' , 'sample/Test/hello' );
 *
 *
 *     获取请求参数
 *
 *     Route::get('hello/:id' , 'sample/Test/hello' );
 *
 *     url  传参  目的是为了 控制器接收参数, 然后做运算
 *          接参   控制器如何接
 *
 *     a.   Route::get( 'hello/:id' , 'sample/Test/hello' );    zz.cn/hello/2?name=qiyue
 *
 *          那么 接参   控制器如何接  public function hello($id,$name){}
 *
 *     b.   控制器 引入  use think\Request;
 *
 *          获取单个变量
 *
 *          public function hello(){
 *              $id   = Request()->instance()->param('id');
 *              $name = Request()->instance()->param('name');
 *              $age  = Request()->instance()->param('age');
 *              return  $id.'****'.$name.'&&&&&'.$age;
 *          }
 *
 *          获取所有变量
 *
 *         public function hello(){
 *             $all = Request()->instance()->param();
 *             var_dump($all);
 *         }
 *
 *      c.   Request()->instance()->route();    //获取url中  zz.cn/5    url的PATH_INFO的参数
 *
 *           Request()->instance()->get();
 *
 *           Request()->instance()->get('name');
 *
 *           Request()->instance()->post();
 *
 *           Request()->instance()->post('name');
 *
 *           具体情况根据 传值方式不同  接收方式也不同，  具体看手册，  以上只是常用
 *
 *
 *        d.  助手函数
 *
 *            获取所有参数       $all = input('param.');
 *
 *           获取单个参数        $name = input('param.name');
 *
 *           获取get的所有参数   $all = input('get.');
 *
 *           获取get的单个参数   $name = input('get.name');
 *
 *           获取post的所有参数  $all = input('post.');
 *
 *           获取post的单个参数  $name = input('post.name');
 *
 *
 *        e.  依赖注入
 *             public function hello(Request $request){
 *                   $name = $request->param('name');
 *             }
 *
 *
 *        总结：
 *                a1 .  在hello方法中依次定义变量,获取参数
 *                a2 .  利用 实例 Request() 对象
 *                a3 .  利用 Request 依赖注入  
 *
 */
