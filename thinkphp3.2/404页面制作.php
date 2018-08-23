<?php

/**
* 404页面
*
*  框架：thinkpgp3.2
*
*  一般都是写在 CommonController.class.php 控制器中  的error()方法
*  （别的功能类  继承----> CommonController类  继承---> Controller类 ） (use Think\Controller;)
*  然后别的控制器类 继承 CommonController这个类
*  别的控制器中的方法一点判断系统出错, 就调用CommonController这个类中的 error    return $this->error('前端页面');
*
*  前端页面：自由发挥
*/
