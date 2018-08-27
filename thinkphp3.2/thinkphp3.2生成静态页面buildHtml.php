<?php

/**
 *     如何优化网址响应时间
 *
 *   1.动态页面静态化
 *   2.优化数据库
 *   3.使用负载均衡
 *   4.使用缓存
 */


/**
 *    详细讲解： 动态页面静态化
 *
 *    前提： 页面的内容不经常变动
 *    实质： 生成静态html页面
 *    原理： (php的执行顺序: 语法分析--->编译--->运行--->展示) 需要与数据库接连
 *           (html执行顺序： 运行)                           不需要与数据库联系
 *    不适应：  内容经常改变, 如：微博
 *    方式： 静态html页面是由php程序生成的
 */


/**
 *  关于动态url地址转变为静态url地址 （伪静态）
 */

/**
 *   php静态化分为   1.纯静态 （局部静态、全部静态）
 *                  2.伪静态
 */


/**
 *   纯静态页面的生成
 *
 *   buffer  缓冲区, 主要用来存储数据, (内存)
 *   先把内容写入buffer中, 当buffer写满后,再写入磁盘 (echo/print_r/print/var_dump输出语句)
 *   内容---->php buffer---->tcp----->终端
 *   开启php的buffer缓冲区  ：  php配置文件 php.ini中  output_buffering = on;
 *   php冲缓冲区中读取内容  :   ob_get_contents(); 获取缓冲区的内容
 *
 *   注意： 1.如果不在php的配置文件中开启buffer缓冲区的话,将不能读取缓冲区的内容,
 *         2.如果在非开启buffer缓存区的前提下，读取缓冲区,也可以在php文件中,  ob_start();
 */

/**
 *  php如何实现页面的纯静态化
 *
 * 基本方式： 1.file_put_contents();
 *           2.php内置缓存机制实现页面静态化---output_buffering  内置函数  ob函数
 *             ob_start();       打开缓冲控制缓存
 *             ob_put_contents();返回输出缓存区的内容
 *             ob_clean();       清空缓存区
 *             ob_get_clean();    得到当前缓冲区的内容,之后清空内容
 */

/**
 * 1. 连接数据库,从数据库中把数据读取出来
 * 2. 将获取的数据填充在模版文件中
 * 3. 把动态的页面转化为静态页面,生成静态文件
 */


 /**
  * 如何触发生成静态页面
  *
  * 1.页面添加缓存时间
  * 2.手动触发
  * 3.crontab定时扫描(linux中的一个定时工具)
  */

 /**
  *   页面添加缓存时间 ：
  *
  *   用户请求页面 -----> 页面时间是否过期 ---->  过期  -----> 重新生成一个静态页面
  *                                            没过期 -----> 获取静态页面
  *
  *  filemtime();  获取文件最后修改时间
  */
 /**
  * crontab 定时扫描
  *
  *  */5 * * * * php/data/static/index.php         (每5分钟执行)
  /**
  *  linux下的命令：
  *                  crontab -e
  */


 /**
  *  局部纯静态化(局部动态化)   如何在静态化页面中加载动态的内容
  *  ajax技术
  *  $.ajax({
  *      url:'接口地址',
  *      data:{json格式的数据},
  *      type: 'POST/GET',
  *      dataType:'JSON/HTML',
  *      error:function(){
  *      },
  *      success:function(result){
  *      }
  *  })
  *
  *  编写接口  ajax请求接口操作
  *  1.获取数据
  *  2.将获取的数据组装成接口数据提通信
  *
  */


 /**
  *   伪静态url (实质：访问的是动态页面)
  *   path_info 模式
  *   nginx模式下：默认不支持path_info模式, 需要配置
  *   $_SERVER   $_SERVER['PATH_INFO']
  *   preg_match();
  *
  *   正则表达式实例：
  *   preg_match('/^\/(\d+)\/(\d+).html$/',$_SERVER['PATH_INFO'],$arr)   返回值： true  打印$arr
  */

 /**
  *  web服务器下的rewrite配置 ：
  *                              1.apache下的rewrite配置
  *                              2.nginx 下的rewrite配置
  */


/**
 *  apache 下的rewrite配置
 *
 * 1. 虚拟域名配置
 *               apache目录下/conf目录/httpd.conf   （LoadModule rewrite_module modules/mod_rewrite.so 开启）
 *                                                  (Include conf/extra/httpd-vhosts.conf  开启)
 *               apache目录下/conf/extra/httpd-vhosts.conf
 *               C:\Windows\System32\drivers\etc\hosts 文件    例如：127.0.0.19   state.com
 * 2. httpd_vhosts_conf配置文件
 */
