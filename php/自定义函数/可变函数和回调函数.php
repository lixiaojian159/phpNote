<?php
/**
 *  可变函数: (变量函数)    函数名称来自于另外一个变量
 *
 * 可以用 call_user_func_array(可变函数名称,参数列表数组) 来调用可变函数
 */

/**
 * 回调函数  
 */


/**
 * [add description]
 * @param [int] $a 数值
 * @param [int] $b 数值
 */
 function add($a,$b){
   echo $a + $b;
 }

 $name = 'add';

 $name(2,6);

 call_user_func_array($name,[2,6]);
