<?php

/*

字符串需要书写在定界符中

定界符有几种：

1. 单引号

2. 双引号


双引号和单引号的区别：

双引号可以解析变量, 效率低一点

单引号不能解析变量, 效率高一些

转义符：  当内容和定界符冲突的时候需要使用转义符

双引号能够解析所有的转义符

单引号只解析\'和\\

花括号{} 可以给变量做控制 增删改查  

其中 改 只能是一个字符串改一个字符串

$username = 'king';
$str = "我的名字是{$username}";



3.heredoc语句结构  相当于双引号的作用

$str =<<<HTML
内容
HTML;


4. nowdoc语句结构  相当于单引号的作用

$str =<<<'HTML'
内容
HTML;




其他数据类型转换成字符串

a. 数值型转换成字符串

   数值---> 数值本身

b. 布尔型

    true ---->  '1'
    false ---->  空字符串

c. NULL -----> 空字符串


d. 数组

e. 资源

f. 对象不能直接转换成字符串, 会报错, 


强制转换字符串   $str = (string)$int;

获取变量数据类型  gettype();

设置变量数据类型  settype();



字符串转换成其他类型

'' ---> bool  false
'0'---> bool  false
'0.0'---> bool true
' ' ----> bool true
'false'---> bool true



常用的字符串库

ord()

char()

substr()

strcmp($str1,$str2)  比较两个字符串的大小, 区分大小写

trim()

ltrim()

rtrim()

strpos()

stripos()

strrpos()

strripos()


