<?php
/**
 * 数组函数
 */

/**
 *  array_rand(): 从数组中随机取出1个或者多个元素的键名
 *  array_rand(array[,int])
 *  例子：
 *  array_rand($arr)   取出一个,返回值int
 *  array_rand($arr,2) 取出两个,返回值array
 */

 $arr = ['北京','南京','天津','河北'];

 echo array_rand($arr);

 $arrArr = array_rand($arr,2);

 print_r($arrArr);


 /**
  * shuffle() : 将数组乱序输出, 原有键名全部删除, 按默认索引重新排序,
  *             返回布尔值：  1表示成功; 0表示失败
  */

$arr = ['ah'=>'合肥','js'=>'南京','武汉','杭州','上海'];

echo '<pre>';

if(shuffle($arr)){
 	  print_r($arr);
}else{
 	  echo '数组打乱失败<br/>';
}


/**
 * array_sum() : 数组元素求和
 */

 echo array_sum([10,20,30]);

 echo '<br/>';

 echo array_sum(['10',20,40]);  //可以将数值型字符串自动转化位数值型(数字)

 echo '<br/>';

 echo array_sum(['php','100php',50]);

 /**
  * range() : 生成一个索引数组
  */

  $arr = range(1,10);  //参数1 从数字1开始; 参数2 到数字10结束 （默认步长值为1）

  echo '<pre>';
  print_r($arr);

  $arr = range(1,10,2); //参数1 从数字1开始; 参数2 到数字10结束 , 参数3  步长值为2

  echo '<pre>';
  print_r($arr);
