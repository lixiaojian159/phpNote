<?php
/**
 * 匿名函数: 没有名称或者是名称可以动态设置的函数
 */

 $showMess = function($study){
 	  return '我在'.$study.'学习...';
 };

 echo $showMess('php中文网');

/**
 * 闭包: 就是在一个函数内, 引入一个匿名函数, 就构成了一个闭包
 */

 function demo($name){
   	$site = function($study){
   		  echo '我在'.$study.'学习php课程...';
   	};

 	  $site($name);
 }

 demo('php中文网');
