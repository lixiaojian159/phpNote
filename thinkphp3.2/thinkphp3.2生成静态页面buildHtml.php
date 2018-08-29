<?php

/**
 *  ThinkPHP3.2  生成静态页面
 *
 *  方法：  buildHtml
 *
 *  具体方法：
 *            1. 项目的入口文件 index.php中, 定义一个常量      define('HTML_PATH', './bhtml');
 *            2. 在项目根目录下新建一个bhtml文件夹
 *            3. 配置文件config.php 新增 'HTML_FILE_SUFFIX' => '.html',    // 默认静态文件后缀
              4. 在控制器中  $this->buildHtml("index",HTML_PATH,"Index/index");   关键:  $this->buildHtml('静态文件名', '静态路径','模板文件');

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
