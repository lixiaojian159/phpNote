<?php

/**
 *  默认参数： 适合于实参数小于形参数, 多出来的形参必须有默认值, 而这些多出来的默认形参必须在函数参数列表的最右面
 */


/**
 * 可变参数:  函数可以接受任意数量的参数, 适合于实际参数大于形参
 * func_get_args():  用在函数体内, 将当前函数的参数打包成数组返回
 */


 function demo(){
   	echo '<pre>';
   	$arr = func_get_args();
   	print_r($arr);
   	echo func_get_arg(2);
 }

 demo(1,5,9);
