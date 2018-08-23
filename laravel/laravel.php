<?php

/*


一、 路由器  文件目录  /routes/web.php

  1.  基础路由



Route::get('basic1',function(){
	return 'basic1';
});

Route::post('basic2',function(){
	return 'basic2';
});



  2.  多请路由


Route::match(['get','post'],'basic3',function(){
	return 'basic3';
});

Route::any('basic4',function(){
	return 'basic4';
});



  3.  路由参数


Route::get('basic5/{id}',function($id){
	return 'basci5-id'.$id;
});

Route::get('basic6/{name}',function($name){
	return 'basic6-name-'.$name;
});

Route::get('basic7/{name?}',function($name= 'iwen'){                         参数可有可无(设置默认值)
	return 'basic7-name-?-可有可无'.$name;
});

Route::get('basic8/{id}/{name}',function($id,$name){
	return 'basic8-id-'.$id.'-name-'.$name;
});



  4.  路由别名


Route::get('/user/basic9',['as'=>'basic9',function(){
	return route('basic9');
}]);

如果 上一个路由要改, 路由名称, 则方法体里面的地址就不用改

Route::get('/user/center/basic9',['as'=>'basic9',function(){
	return route('basic9');
}]);




  5.  路由群组


Route::group(['prefix'=>'member'],function(){

	Route::get('/user/center',['as'=>'cen',function(){
		return route('cen');
	}]);

	Route::get('basic1',function(){
		return '路由群组';
	});
});



6.  路由器的 resource  方法

    定义一条路由器     Route::resource('users', 'UsersController');      该方法接收两个参数，第一个参数为资源名称，第二个参数为控制器名称。


    上面代码将等同于：

    Route::get('/users', 'UsersController@index')->name('users.index');

    Route::get('/users/{user}', 'UsersController@show')->name('users.show');

    Route::get('/users/create', 'UsersController@create')->name('users.create');

    Route::post('/users', 'UsersController@store')->name('users.store');

    Route::get('/users/{user}/edit', 'UsersController@edit')->name('users.edit');

    Route::patch('/users/{user}', 'UsersController@update')->name('users.update');

    Route::delete('/users/{user}', 'UsersController@destroy')->name('users.destroy');


以上只是介绍路由, 实际开发中很少在路由器中写函数, 都是通过路由地址调用控制器Controller


二、 路由输出视图


Route::get('basic11',function(){
	return view('welcome');
});














php artisan make:migration create_users_table --create=users  数据迁移中的创建表结构

php artisan migrate                                           数据迁移中的创建表动作

php artisan make:model users

****************

注意:没有';'   

****************


关联模型


一对一   hasOne()  用户-->手机号

一对多   hasMany() 文章-->评论

一对多反向  belongsTo  评论-->文章

多对多的反向 belongsToMany   用户  


laravel 提供了三种数据库操作方法：  DB facade(原始查找)    查询构造器    Eloquent ORM





A\  DB  facade(原始查找)   不建议使用,  如果删除和修改不写条件限制, 会把所有数据改变或者删除
新建数据表  


增：   $row = DB::insert('insert into student(name,age,sex) values ("王五",22,0)');    返回bool

       $row = DB::insert('insert into student(name,age,sex) value (?,?,?)',['王五',21,1]);


改：   $row = DB::update('update student set sex = 1 where id = 12');    返回受影响的条数

       $row = DB::update('update student set name = ?, age=?, sex=? where id = ?',['赵云',25,0,1]);


删：   $row = DB::delete('delete from student where id =12');            返回受影响的条数

查：   $row = DB::select('select * from student');
       
       $row = DB::select('select * from student where id =1');

       $row = DB::select('select * from student where id>10');





B\  数据库操作：查看构造器

前提引入  DB      (use Illuminate\Support\Facades\DB;)

查：     $student = DB::table('student')->get();  

增:     $arr = ['name'=>'zhangsan','age'=>20,'sex'=>1];  数组(一维数组单条; 二维数组多条)
        $bool = DB::table('student')->insert($arr);  

改:     $arr = ['name'=>'张小三'];
		$bool = DB::table('student')->where('id',1)->update($arr);  返回bool    更新数据的时候一定要写id条件

删：     $bool = DB::table('student')->where('id',7)->delete();



 $bool = DB::table('student')->increment('age');   全部  加法                    返回受影响的条数

 $bool = DB::table('student')->where('id',2)->increment('age');  一条   加法     返回受影响的条数

 $bool = DB::table('student')->increment('age',3);

 $bool = DB::table('student')->decrement('age',2);  减法

 $bool = DB::table('student')->where('id',2)->decrement('age',1,['name'=>'lisi']);  自增的同时,修改其他值



 使用查询构造器查询数据

 get()  lists()  first()  select()  where()   chunk()  pluck()

 $data = DB::table('student')->first(); 默认正序第一条

 $data = DB::table('student')->orderBy('id','desc')->first(); 倒序第一条


 $data = DB::table('student')->get();     得到全部数据

 $data = DB::table('student')->pluck('name');  只取name字段

 $data = DB::table('student')->select('name','age')->get();   拿出数据库中的部分字段


 查询构造器中的聚合函数

 count()  sum()  max()  min()   avg()

 $num = DB::table('student')->count();

 $num = DB::table('student')->where('id','>=',4)->sum('age');

 $num = DB::table('student')->max('age');

 $num = DB::table('student')->min('age');

 $num = DB::table('student')->avg('age');







C\  Eloquent ORM     注意: 一定要在使用的控制器中引用该模型  use  App\Models\Student

简介, 模型的建立, 查询数据

新增数据, 自定义时间戳, 以及批量赋值的使用 


1. 建立模型 来继承原始Model类(use Illuminate\Database\Eloquent\Model;)

实例：

namespace App;  //命名空间

use Illuminate\Database\Eloquent\Model;  //引用依赖的类

class Help extends Model{

	//指定表名
	protected $table = 'help';

	//指定id
	protected $primaryKey = 'id';

	//自动维护时间戳 true    false是不自动维护
	public $timestamps = true;

    //可以批量添加的字段
	protected $fillable = ['name','sex'];

	//不可以批量赋值的数据
	protected $guarded = ['age','nickname'];

	protected function getDateFormat(){
	    return time();      //时间戳的形式保存created_at和updated_at
	}

	protected function asDateTime($val){
		return $val;       //如果不写这个方法, laravel会按照它自己设计好的形式输出
	}
}




2. orm修改数据
 
  (单条更新)
  $row = Student::find(1);
  $row->name = 'zhangsan';
  $bool = $row->save();

  (批量更新)
  $num = Student::where('id','>=',6)->update(
            ['age'=>'28']
  );


3. orm删除数据

  (通过模型删除数据)
  $row = Student::find(2);
  $bool = $row->delete();

  (通过主键值删除)
  $bool = Student::destroy(2);
  $bool = Student::destroy(2,9);    //字符串形式
  $bool = Student::destroy([2,9]);  //数组形式

  (根据指定条件删除)
  $bool = Student::where('id','>=',20)->delete();


4. orm的新增数据

   $stu = new Student();
   $stu->name = '张三';
   $stu->age  = 20;
   $stu->sex  = 1;
   $bool = $stu->save();

   使用模型的create()方法添加数据    注意：返回的还是一个对象
   $stu = Student::create(
            ['name' => '张三', 'age'=>20]
   );


5. orm的查询数据
   $students = Student::all();    //查询全部数据

   $students = Student::get();    查询所有数据

   $student = Student::find(1);   //查询一条数据

   $student = Student::findOrFail(1);   /查询id主键为1的, 有数据就得到, 无数据会报错

   $student = Help::where('id','>=',9)->orderBy('id','desc')->first();  条件id>=9, 倒序排序, 取第一条



   orm的软删除

   效果： 是在模型上设置一个 deleted_at 属性并插入数据库(字段名一致)，如果模型有一个非空 deleted_at 值，那么该模型已经被软删除了。

   操作地址：  需要被软删除的Model文件内

   具体代码：  1. 在模型上   use Illuminate\Database\Eloquent\SoftDeletes;   这个类
              2. 在模型类中 use SoftDeletes;  （因为是trait的用法)
              3. 在模型中定义个受保护的属性   protected $dates = ['deleted_at'];   与数据表中的字段对应,同时调整字段的数据类型
              4. 调用delete方法, 将 'deleted_at' 列将被设置为当前日期和时间 (回想：效果处知识点)
              5. 判断给定模型实例是否被软删除，可以使用 trashed 方法

    查询被软删除的模型：
    



laravel 模版继承


section

yield

extends

parent




页面调错：





