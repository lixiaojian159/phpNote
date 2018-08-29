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
