<?php

/*
   数据库的CURD操作

   1.新增数据
     add()     增加一条
     addAll()  增加多条（注：只能是mysql数据库）

   2. 查询数据
     select()
     a. $res = $user->select();
     // 直接字符串
     a. $res = $user->where('id=1')->select();
     a.$arr['id'] = 1;
    	 $res = $user->where($arr)->select();
    //数组方式
    a. $arr['id'] = 1;
       $arr['name'] = 'xiaoming';
       $res = $user->where($arr)->select();  注：  id字段 and name字段
    a1. $arr['id'] = 1;
        $arr['name'] = 'xiaoming';
        $arr['_logic'] = 'or';
        $res = $user->where($arr)->select();  注:   id字段 or name字段

    //表达式方式
    a2. $arr['id'] = array('between','1,2');
    	  $res = $user->where($arr)->select();
    a3. $arr['id'] = array('in','1,2');
    	  $res = $user->where($arr)->select();
    a4. $arr['id'] = array('gt','3');
        $res = $user->where($arr)->select();

    a5. $arr['id'] = array('not in','1,3');
        $res = $user->where($arr)->select();

    a6.  $arr['name'] = array('like','%ming');
        $res = $user->where($arr)->select();

    a7.  $arr['name'] = array('like',array('%ming','xiao%'));   模糊查询  or关系
         $res = $user->where($arr)->select();

    a8.  $arr['id'] = array(array('gt','1'),array('lt','10'));  区间查询  and关系
         $res = $user->where($arr)->select();
    a9.  $arr['id'] = array(array('lt','3'),array('gt','100'),'or');  区间查询 or

    //统计用法

      $res = M('user')->count();
      $res = M('user')->max('age');
      $res = M('user')->max('id');
      $res = M('user')->min('id');
      $res = M('user')->avg('age');
      $res = M('user')->sum('socre');

  3. 更新数据
      a1.
      $data['id'] = 1;
      $data['name'] = 'zhangsan';
      $data['password'] = '123456';
      $res = M('user')->save($data);

      a2.
      $update['name'] = 'zhangsan';
      $where['id'] = 1;
      $res = M('user')->where($where)->save($update);

  4. 删除数据

      a1.
      $where['id'] = 1;
      $res = M('user')->where($where)->delete();

      a2.
      $res = M('user')->delete($id);  必须是主键

*/


/*
  连贯操作 (必须在select之前)

   1. order排序  order('字段 desc/asc')  单条件 order('字段 desc,字段 asc')多条件

   $res = M('user')->order('socre desc')->select();

   $res = M('user')->order('socre desc','id asc')->select();

   2. field筛选字段  field(字符串)  多个字段用英文逗号分开

      field('id,name',true)     field('id,name') 只取 id name
      field('id,name',false)    取除去id和name之外

   3. limit(start,length)   page(页码,每页的条数)
      limit(5)  取前5条
      limit(1,5);

   4.  group() 分组  having()

   5. 多表查询 (表名如果有前缀,一定要写上前缀，这里不会给你默认添加上)

     $res = M()->table(array('mk_user'=>'user','mk_info'=>'info'))->where('user.id=info.id')->select();

   6. 多表查询  jion()

      $res = M('user')->jion('jion mk_info On mk_info.id = mk_user.id')->select();        左关联

      $res = M('user')->jion('Right jion mk_info On mk_info.id = mk_user.id')->select();  右关联

      $res = M('user')->jion('inner jion mk_info On mk_info.id = mk.user.id')->select();  两端

  7.  union()

  8. distinct() 过滤

 */



/*
php把页面生成静态页面
*/
