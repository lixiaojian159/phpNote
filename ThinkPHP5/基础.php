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

/**
 *   参数校验层  validate  类   (作用：验证用户传过来的数据是否合法)
 *
 *   1. 独立验证
 *
 *      引入  validate  类    use Validate;
 *
 *      // 接收的数据(待校验)
 *      $data = [ 'name' => 'vendor' , 'email' => '852688838@qq.com' ];
 *
 *      // 定义的校验规则 (内置规则,还有自定义规则)
 *      $validate = new Validate([
 *           'name'  => 'require|max:10',
 *           'email' => 'email',
 *      ]);
 *
 *      // 执行校验
 *      $result = $validate->check($data);   返回值： boolean    $result = $validate->batch()->check($data);  批量(一起)校验
 *
 *      // 获取错误结果
 *      $info = $validate->getError();
 *
 *   2. 验证器 (******重要**** 更加封装，相比独立验证, 推荐)
 */


/**
 *          REST  (全称：Representational State Transfer  表述性状态转移，  一种约定,使用JSON描述数据)        轻量
 *
 *   区别： SOAP   (全称：simple object access protocol  简单对象存取协议, 通常就是说，使用XML来描述数据)      繁重
 *
 *   作用： 可以在不同的语言之间交换数据 , 服务器返回给你一个结果, 这个结果是JSON格式的.
 *
 *   内容：
 *         基于资源 (url 就是资源) 增删改查就是对资源状态的改变
 *         使用HTTP动词来操作资源   GET POST DELETE PUT PATCH
 *
 *         1. 传统的web，选择个get还是post的依据：   看数据的简单还是繁琐， 如果简单就用GET, 繁琐就用POST
 *         2. REST的web设计
 *
 *   REST 的最佳实践
 *
 *         HTTP 动词的：
 *
 *          POST   创建
 *          PUT    更新
 *          GET    查询
 *          DELETE 删除
 *
 *         状态码： 404、400、200、201、202、401、403、500
 *
 *         错误码
 *
 *         统一描述错误
 *
 *  REST 的最佳方式 (模仿):
 *
 *        豆瓣开放API   GitHub开放API
 *
 *
 *  合理使用REST, 不要盲目照搬标准RSET
 */


/**
 *   使用 Token令牌 授权和验证身份
 */

/**
 *   版本控制
 */


/**
 *   测试与生产环境
 */

/**
 *    url语义明确
 */

/**
 *   一份标准的文档
 */
