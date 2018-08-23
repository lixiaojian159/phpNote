<?php

/*
   artisan 控制台

   一、 artisan 简介

       artisan 是 laravel 自带的命令执行工具的名称

  二、 artisan 的使用

      php artisan   可以查看所有的 artisan 的功能命令     (查询)

     1. 创建控制器  php artisan make:controller  StudentController

     2. 创建模型   php artisan make:model Student

     3. 创建中间件  php artisan make:middleware Activity
 */


/*
   用户认证  Auth

   1.  php artisan make:auth   他会自动生成用户认证的相关页面（前端和后端）

   2.  修改 .env 配置文件       数据库的相关配置

   3.  php artisan migrate    执行数据迁移文件  生成用户认证所需的表  (注意：执行过程可能会报错, 查看数据迁移知识讲解的 坑1 )

 */


/*
   数据迁移文件

   前提 ： 设置 .env 有关数据库连接的相关数据

 一、 新建 数据迁移文件

    第一种 ： 新建一个student表为例子   php artisan make:migration create_students_table --create="students"

    第二种 : 创建模型的同时创建数据迁移文件   php artisan make:model Articl -m

    新建了数据迁移文件之后, 迁移文件的保存位置 ：项目目录/database/migrations 下, 修改里面的字段/********重要细节*********//*

 二、 修改数据迁移表的字段 （细节注意修饰字段）

 三、 执行数据迁移文件   生成数据表  php artisan migrate

 */


/*
   数据填充

  一、 如何新建 数据填充文件  php artisan make:seeder StudentsTableSeeder    数据填充文件 路径： 项目目录/database/seeds 目录下

  二、 修改  StudentsTableSeeder 此文件里面的 run() 方法  编写里面的数据

  三、 执行 数据填充文件

      方法一 ：   执行单个数据填充文件
                  php artisan db:seed --class=StudentsTableSeeder

      方法二 ：   执行批量的数据填充文件
                 1.  修改 项目目录/database/seeds/DatabaseSeeder.php 文件里面的 run() 方法  ：$this->call(StudentsTableSeeder::class);
                     执行几个数据填充文件就写及几个$this->call()

                2.   php artisan db:seed
 */


/*
   文件上传

  配置文件  ： 项目目录/config/filesystems.php 文件  根据自己的需要修改

              'uploads' => [
                  'driver' => 'local',
                  'root' => storage_path('app/uploads'),
              ],

  上传方法:(方法一：)还有其他方法这里没写
            1.  use Illuminate\Support\Facades\Storage;  引入类

            2.  $file = $request->file('file');

            //判断文件是否上传成功
      			if($request->hasFile('file') && $file->isValid()){
      				//文件后缀
      				$ext  = $file->getClientOriginalExtension();
      				//文件类型
      				$type = $file->getClientMimeType();
              //临时绝对地址
      				$realPath = $file->getRealPath();
      				//文件新名
      				$newFile = date('Y-m-d-H-i-s').'-'.rand(1000,9999).'.'.$ext;
      				//上传文件
      				Storage::disk('uploads')->put($newFile,file_get_contents($realPath));  // 返回的boolean值  //这里的 uploads 是/config/filesystems.php 文件里面的配置名****
      				//返回文件地址
      				return './storage/app/uploads/'.$newFile;
      			}
 */

/*
  邮件发送

  一、 配置文件  /config/mail.php


  二、 发送邮件的方法  （两种）

       第一种 ： Mail::raw()

       1.  在控制器中 引入文件  use Mail;

       2.  设置 config/mail.php文件  （其实只要修改 .env文件里面的邮件发送相关设置就可以）

           eg: 以 qq 邮箱为例

           首先： 要把qq邮箱的 开启服务： POP3/SMTP服务 开启

           必须知道   如何设置POP3/SMTP的SSL加密方式？
                        使用SSL的通用配置如下：
                        接收邮件服务器：pop.qq.com，使用SSL，端口号995
                        发送邮件服务器：smtp.qq.com，使用SSL，端口号465或587
                        账户名：您的QQ邮箱账户名（如果您是VIP帐号或Foxmail帐号，账户名需要填写完整的邮件地址）
                        密码：您的QQ邮箱密码
                        电子邮件地址：您的QQ邮箱的完整邮件地址
          然后根据上文 , 修改 .env 文件 , 如下:
                                              MAIL_DRIVER=smtp
                                              MAIL_HOST=smtp.qq.com
                                              MAIL_PORT=465
                                              MAIL_USERNAME=852688838@qq.com
                                              MAIL_PASSWORD=rpxlraqqtowfbcdg     //不是邮箱的登录密码, 是邮箱开启 POP3/SMTP服务 的授权密码
                                              MAIL_ENCRYPTION=ssl
                                              MAIL_FROM_ADDRESS=852688838@qq.com
                                              MAIL_FROM_NAME=慕课网

         最后： 编写控制器里面的邮件发送方法

               Mail::raw('邮件的内容',function($meaasga){            //邮件的内容
                     $message->from('852688838@qq.com','慕课网');   //发件人的邮箱和名字
                     $message->subject('邮件的主题');               // 邮件的主题
                     $message->to('18633899381@163.com');          //收件人的邮箱
               });

      第二种 :  以上步奏中 1  2 以及 3的最后之前的设置都是一致的 , 只需要修改最后的控制器里面的方法

            特点：  可以自定义邮件模版  模版视图位置(依旧): resources/views/..（mail）/..（index）    具体的位置可以自定义

                Mail::send('mail.index',['name'=>'李健','content'=>'欢迎注册'],function($message){
                         $message->from('852688838@qq.com','慕课网');
                         $message->subject('这是邮件的主题');
                         $message->to('18633899381@163.com');
                });

              以上Mail::send()方法的介绍：
              参数：  模版     变量(一位数组,在模版中输出就是{{$name}}  {{$content}})    回调函数（发送者和邮件主题和收件人设置）

 */



/*
    缓存

    主要方法 ：  put()

                add()

                forever()

                has()

                get()

                forget()

                pull()

    缓存的方式： "apc", "array", "database", "file", "memcached", "redis"

                不同的缓存方式, 缓存文件的路径不一样 (具体看cache.php配置文件), 程序默认的缓存方式： file

   配置文件： config/cache.php  文件

   具体方法 介绍：

            前提： use Illuminate\Support\Facades\Cache;

           设置缓存   Cache::put('key1','value1',10);  //对应参数 键  值  保存时间(单位：min)

           设置缓存   Cache::add('key2','value2',10);  //对应参数 键  值  保存时间(单位：min)

           与上方法的区别: add()方法有返回值, 如果要设置的 key 键名已存在, 则返回false,设置失败; 如果要设置的 key 键值 是第一次设置, 返回 true, 设置成功

           设置缓存  Cache::forever('key3','alue3');   //对应参数   键  值  与上两个的区别： 永久设置, 所以少了第三个时间的参数

           读取缓存   Cache::gey('key1')               //参数  键

           读取缓存   Cache::pull('key1')              //参数 键   与上个的区别：  只能读取一次, 读取之后就销毁了这个键值, 不能再次读取

           判断缓存是否存在   Cache::has('key1')       //参数   键    有换回值:boolean

           删除缓存  Cache::forget('key1')            //参数   键    有返回值:boolean  删除成功返回 true  删除失败返回 false

 */





/*
  laravel 中的错误与日志

  简介：  Debug模式

         HTTP异常

         日志

  详解：

         Debug 模式
         配置文件： config/app.php  在本地开发模式： APP_DEBUG=true; 在生产模式下: APP_DEBUG=false;


         HTTP异常  abort('404');   前提是view视图里面有 errors文件夹/  404.blade.php静态文件模版


         日志   前提： 1. 设置配置文件 .env   APP_LOG=single  (可以设置的："single", "daily", "syslog", "errorlog")
                      2. 控制器里面要引入文件  use Illuminate\Support\Facades\Log;

              日志文件路径  :  storage/logs/laravel.log

                      解释  APP_LOG=single 和 APP_LOG=daily

                      1.   APP_LOG=single 在.env里面设置之后, 控制器里面写一个方法, 方法体是 : Log::info('这是一个普通的日志');

                      2.   APP_LOG=daily 在.env里面设置之后,  程序会按照日期, 每天生成一个日志文件

 */

/*
   队列

   课件：  https://www.imooc.com/video/13343

   主要步奏：  1. 迁移队列需要的数据表
              2.编写任务类
              3.推送任务到队列
              4.运行队列监听器
              5.处理失败任务


  配置文件： config/queue.php

      未完待续
 */
