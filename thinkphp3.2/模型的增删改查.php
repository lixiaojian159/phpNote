<?php

/*
   数据库的CURD操作

   1.新增数据
     add()     增加一条
     addAll()  增加多条（注：只能是mysql数据库）

   2. 查询数据
     select()
     a. $res = $user->select();
     a. $res = $user->where('id=1')->select();
     a.$arr['id'] = 1;
    	 $res = $user->where($arr)->select();
    a. $arr['id'] = 1;
       $arr['name'] = 'xiaoming';
       $res = $user->where($arr)->select();  注：  id字段 and name字段
    a1. $arr['id'] = 1;
        $arr['name'] = 'xiaoming';
        $arr['_logic'] = 'or';
        $res = $user->where($arr)->select();  注:   id字段 or name字段
    a2. $arr['id'] = array('between','1,2');
    	  $res = $user->where($arr)->select();
    a3. $arr['id'] = array('in','1,2');
    	  $res = $user->where($arr)->select();
*/



/*
php把页面生成静态页面
*/
