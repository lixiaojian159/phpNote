<?php

/* 一、数据库相关知识点

命令行进入mysql  
mysql -h localhost -u root -p 回车 输入密码

查看数据库
show databases;

选择某个数据库
use 数据库名称;   如：use blog;

创建一个数据库
create database student;
create database if not exists student;   if not exists 是否存在student这个数据库,不存在则创建（兼容性）

删除一个数据库
drop database student;
drop database if exists student;      if exists 是否存在student这个数据库,存在则删除(兼容性)

查看一个数据库的创建语句
show create database student;

查看数据库的连接情况
show processlist;



二、数据库表的备份和恢复

备份
mysqldump -u root -p 数据库>D:/重新命名.pak(存放路径)   注意：不要写 ;

恢复
首先进入mysql的命令行  
创建一个数据库 create database blog2;
选择这个数据库 use blog2;
恢复          source d:/blog2.pak;    source 路径;

备份的注意事项：
1.只备份数据库的某几张表  
mysqldump -u root -p 数据库 表1 表2 > d:/重新命名.pak

2.如何恢复某几张表
首先进入mysql的命令行  
创建一个数据库 create database blog3;
选择这个数据库 use blog3;
恢复          source d:/blog3.pak;    source 路径;

3.如何备份多个数据库
mysqldump -u root -p -B 数据库1 数据库2 > d:/重新命名.pak  (-B 里面包含创建数据库的sql语句)

4.同时恢复多个数据库
首先进入mysql命令行
source 路径（上一步的保存路径）

强烈建议 
mysqldump -u root -p -B 数据库>D:/重新命名.pak   强烈建议写 -B 包含创建数据库的sql语句



三、修改数据库

主要是修改数据库的字符集、校验规则

alter database 数据库名 charset=utf8;
alter database 数据库名 character set  utf8;
alter database 数据库名 collate utf8_general_ci;


create table stu(
 id int,
 name varchar(20),
 password varchar(50),
 salt char(4)
)engine=myisam,charset=utf8;



四、mysql的数据类型

1.数值型  tinyint smallint mediumini int bigint 

tinyint     占1个字节   -128 127    默认是有符号     注意有无符号 
                        0   255          无符号

smallint    占2个字节

mediumint   占3个字节

int         占4个字节

bigint      占8个字节


alter table tt2 modify num2 int(4) zerofill;

unsigned  无符号 zerofill和unsigned相配合  不足位数，用0补齐


bit  


float(M,D)  小数  M是一共多少位,D是小数几位  区分有无符号unsigned  大约可以精确到小数点7位

decimal(M,D)  定点数 M是一共多少位，D是小数几位  区分有无符号unsigned

float和decimal的区别：  定点数（decimal）的精度 比 浮点数float的 精度高

建议：如果希望小数的精度高一些 可以使用decimal


字符串：

char  定长字符串 最大字符255

varchar 是变长字符串 最大字符65532字节   编码为utf-8最大21844字符 1-3个字节用来记录大小

如何选择varchar还是char：

text  大段字符串  不能使用默认值


日期和时间类型：

date  只有日期 2018-05-03

datetime  有日期和时间2018-05-03 21:30:56

timestamp  自动生成当时的时间戳  添加和修改时都会自动更新时间


枚举enum(单选) 男女

set(多选) 爱好  1 2 4 8 16 32 

如何查询set的数据  find_in_set（）


练习：

create table tt4(
 id int,
 username varchar(20),
 sex enum('1','0'),
 password char(32)
);



create table tt5(
  id int not null default 0,
  username varchar(20) not null default '',
  password char(32) not null default '',
  brithday date not null default 0,
  sex enum('男','女') not null default '男',
  join_time datetime not null default 0,
  job varchar(20) not null default '',
  instr text
)charset=utf8 engine=myisam;

insert into tt5(id,username,password,brithday,sex,join_time,job,instr) values (1,'zhangsan','123456','2018-05-04','男','2015-05-04 15:07:02','学生','我是 一名大学生');

insert into tt5(id,username,password,brithday,sex,join_time,job,instr) values (2,'lisi','123456','2018-05-05','男','2015-05-06 15:07:02','学生','我是 一名程序员');



五、修改表

修改表的结构  字段名称 字段的大小 字段的类型  表的字符集类型  表的存储引擎 

添加字段 修改字段  

alter table 表名 add 字段 数据类型 not null default '' after 字段;  (在哪个字段后添加一个字段)

alter table tt5 add image varchar(100) not null default '' after instr;

修改某个字段
alter table tt5 modify image varchar(125) not null default '';

删除某个字段(格外小心,删除字段后,该字段的数据全部删除,无法找回)

alter table tt5 drop image

修改表名

alter table tt5 rename to student;

修改字符集  校验规则 引擎  类似

alter table student charset=utf8;   engine=myisam  colleta

修改字段名称

alter table student change username user_name varchar(20) not null default '';

alter table student change user_name username varchar(20) not null default '';  同上


删除表（结构）

drop table 表名;


注意： modify 和 change 的区别 

modify  只修改字段的类型和大小

change  修改字段名称或者类型和大小  old_name  new_name


补充说明：

not null 不能为空

default  默认值

comment  注释  该字段表示什么含义

console.log



六、 关于标的curd操作(增、删、改、查)


1. insert 语句


create table goods(
 id int unsigned not null default 0,
 goods_name varchar(50) not null default '',
 price float(10,2) not null default 0.0
)charset=utf8 engine=myisam;

alter table goods modify id int unsigned not null default 0;

insert into goods(id,goods_name,price) values (1,'雪碧饮料',3.0);
insert into goods(id,goods_name,price) values (2,'可口可乐',5.0);
insert into goods(id,goods_name,price) values (3,'美年达',3.50);


insert的注意事项：（插入失败的原因）

a. 插入数据类型应该和字段的数据类型一致

b. 数据的大小 

c. 字符串和日期 应该放在单引号中 

d. 插入空值  只有允许才可以

f. 如果  insert into goods values (4,'百事可乐',5.5);     没有字段，就要把所有字段的内容都写出来

e. 建议在以后添加数据的时候,把数据都用引号包裹起来,包括数值

g. 如果只给部分字段赋值,则需要指定字段   前提：没有给值的字段，有默认值
   insert into goods(id,goods_name) values (5,'红牛饮料');



create table scroce(
 id int unsigned not null default 0,
 username varchar(20) not null default '',
 math float(4,2) not null default 0.0,
 chinese float(4,2) not null default 0.0,
 english float(4,2) not null default 0.0
)charset=utf8 engine=myisam;



2. update 语句

update 表名 set 字段 = 数值,字段 = 数值 where 条件

update stu set salary= salary + 1000 where name='张三丰';  加减乘除都可以


3. delete 语句 

  delete from 表名 where 条件

  truncate 删除表中记录


  注意：delete 和 truncate 的区别

  a. truncate 的效率好一点

  b. delete 可以设置限制条件

  c. delete 返回删除的记录数 truncate返回的是0

  d. 只有drop可以删除表结构  delete和truncate都不可以删除表结构   drop table 表名 删除一张表（表结构）

  推荐使用 delete


  detele的使用细节：

  a.  删除一定要加where限制条件  否则整个表记录删除

  b.  delete 不能删除某个值，可以用update 修改成null或者''空字符串

  c.  删除数据时 引起其他参考完整性问题, 不要忘记外键



4.  select 语句

create table stu2(
 id int unsigned primary key auto_increment,
 name varchar(20) not null default '',
 math float(4,2) not null default 0.0,
 chinese float(4,2) not null default 0.0,
 english float(4,2) not null default 0.0
)charset=utf8 engine=myisam;

insert into stu2(name,math,chinese,english) values ('韩顺平',89,78,90);
insert into stu2(name,math,chinese,english) values ('张飞',67,98,56);
insert into stu2(name,math,chinese,english) values ('张三丰',89,98,76);
insert into stu2(name,math,chinese,english) values ('宋江',87,78,77);
insert into stu2(name,math,chinese,english) values ('关羽',88,98,90);
insert into stu2(name,math,chinese,english) values ('赵云',82,84,67);
insert into stu2(name,math,chinese,english) values ('欧阳锋',55,85,45);
insert into stu2(name,math,chinese,english) values ('黄蓉',75,65,30);


select distinct math from stu2;  去掉重复的数据  distinct 过滤数据中重复的

select * from 表名 

select * from 表名 where 条件

注意： 尽量不要用* 效率低下 用那几个字段就写那几个字段 


select id,name,math+chinese+english as title from stu2;
select id,name,(math+chinese+english)*1.6 as title from stu2;
select id,name,math,chinese,english from stu2 where name like '赵%';    模糊查询  where 字段 like ''
select id,name,math as '数学' from stu2;



select 的细节：

where 子句

select * from stu2 where name like '韩%';   

select * from stu2 where english >=90;  

select id,name,math+chinese+english as title from stu2 where (math+chinese+english) >200;

select * from stu2 where name like '赵%' and id >90;

select * from stu2 where english > chinese;

select * from stu2 where (math+chinese+english)>200 and math > chinese and name like '宋%'; 

select * from stu2 where english >=80 and english<=90;

select * from stu2 where english between 80 and 90;  同上

select * from stu2 where math = 89 or math =90 or math = 91; 同上

select * from stu2 where math in (89,90,91);   同上 推荐使用

select * from stu2 where math >80 or english >80;



order by 子句  排序 

order by 字段  asc     正序

order by 字段  desc    倒序 

注意：
order by 的字段可以是表中的字段，也可以select后来指定的字段（as)

如果没有指定desc 默认是asc

select * from stu2  order by math desc;

select *,(math+chinese+english) as title from stu2 order by title desc; 

select *,(math+chinese+english) as title from stu2 where name like '张%' order by title desc;



练习：

create table stu3(
 id int unsigned primary key auto_increment,
 name varchar(20) not null default '',
 sex enum('男','女') not null default '男',
 brithday date not null,
 entry_date date not null,
 job varchar(20) not null,
 salary float(10,2) not null default 0.0,
 resume text not null default ''
)charset=utf8 engine=myisam;




统计函数 count

基本语法： count(*)    count(列名)

count(*)     会统计一共的记录数  

count(列名)  会排除掉为空的条数

注意： count是合计函数 只能返回单条记录

select count(*) from stu2;  班级有多少个学生

select count(id) from stu2;

select count(*) from stu2 where math >80;  数学成绩大于80的条数

select count(*) from stu2 where (math+chinese+english) >200;  总分大于200的学生人数

现在只能查出有多少人,如果想知道具体是那几个人需要以后的多表查询



求和函数  sum

注意：sum 仅对数值有作用, 否则会报错 

select sum(math) from stu2;   查询数学总分

select sum(math),sum(chinese),sum(english) from stu2;  查询数学、语文、英语各科的总和

select sum(math+chinese+english) from stu2;  求一个班的数学语文英语的成绩总和   这个sql对，但是危险

select sum(math)+sum(chinese)+sum(english) from stu2;  同上,这个相对与上方安全


select avg(chinese) from stu2;  查询语文平均分

select sum(chinese)/count(*) from stu2; 同上



求平均数函数 avg 

针对数值型 使用 

select avg(math) from stu2;  查询一个班级的数学平均分

select sum(math)/count(*) from stu2;  同上

select avg(math+chinese+english) from stu2;  查询一个班级的总分的平均数


最大值函数  max

最小值函数  min

select *,max(math) from stu2; 求数学的最大值

select max(math+chinese+english),min(math+chinese+english) from stu2;  求总和的最大值和最小值



group by 子句

往往和 having  一起使用 对于结果的过滤和筛选

联系

select avg(salary) from stu group by bumen;  求每个部门的平均工资

select avg(salary) as tit from stu2 having tit < 2000 group by bumen; 查询部门的平均工资低于2000元的



七、 mysql的函数

日期函数
 
current_date  当前日期(年、月、日)  select  current_date();

current_time  当前时间(年、月、日 时：分：秒)

current_timestamp  当前时间戳

date(datetime)  返回datetime的日期部分

date_add(date2,interval )  在date2时间上加上时间

date_sub(date2,interval )  在date2时间上减去时间

datediff(date1,dat2)  返回两个日期的差（天数） date1-date2


create table tt5(
 id int unsigned primary key auto_increment,
 name varchar(20) not null default '',
 brithday date not null
)charset=utf8 engine=myisam;

insert into tt5(name,brithday) values ('zhangsan',current_date()); 把当前的时间


select date('2018-05-06 09:40:50');   结果：  2018-05-06  只返回日期

select date_add('2018-06-09',interval 10 day);  结果： 2018-06-19

select date_add('2018-06-06',interval -10 day);  结果： 2018-05-28


create table mes(
 id int unsigned primary key auto_increment,
 content varchar(30) not null default '',
 sendtime datetime not null
)charset=utf8 engine=myisam;

insert into mes(content,sendtime) values ('hello1',now());
insert into mes(content,sendtime) values ('hello2',now());


select id,content,date(sendtime) from mes;   查询所有留言信息，只显示日期(不显示时间)

select * from mes where date_add(sendtime,interval 10 minute) >= now();  请查询在10分钟内发布的帖子

select datediff('2011-11-11','1990-1-1');  查询2011-11-11到1990-1-1差多少天

细节使用：

date_add(date2,interval )  的interval 后面可以加 year minute second  day 

date_sub(date2,interval )  的interval 后面可以加 year minute second  day 

datediff(date1,date2)  得到的是 天数   date1-date2  因此可以取负值

这几个函数的日期类型可以是 date datetime timestamp
 
这几个函数长在论坛留言表使用


还有一些日期函数 

timediff(date1,date2)  两个时间差  返回的是多少时多少分多少秒  很少使用 注意两个时间不能相差一个月以上

now()     查询当前时间                  select now();

year()   只返回年份 

month()  只返回月份

unix_timestamp()      类似与php中的time()    语言不同，效果一致，注意归纳总结

select unix_timestamp();  得到一个结果：一个时间戳，是一个秒数

select from_unixtime(unix_timestamp());
        对时间戳格式化   时间戳

select from_unixtime(unix_timestamp(),'%y-%m-%d %h:%i:%s');  类似于php中的 date('Y-m-d H:i:s',time())

注意：什么时候应该使用哪个

select * from mes where year(sendtime) = 2018;  查询2018年输入的信息

select * from mes where year(sendtime) = 2018 and month(sendtime) = 5;  查询2018年5月份输入的信息


细节使用：

实际开发中,我们经常使用int来保存一个时间戳

create table tt6(
 id int unsigned primary key auto_increment,
 content varchar(20) not null default '',
 sendtime int unsigned not null default 0
)charset=utf8 engine=myisam;

insert into tt6(content,sendtime) values ('abc',unix_timestamp());  填入时间戳的int时间

select id,content,from_unixtime(sendtime,'%y-%m-%d %h:%i:%s') from tt6;   格式化时间戳查询




字符串函数

charset(str)  查询字符集

select charset(name) from stu2;  查看name字段的字符集

concat(str)  连接字符串

select id,concat(name,'的数学成绩',math) from stu2;

ucase()  大写转换               php中strtoupper

lcase()  小写转换               php中strtolower

length() 占的字节  select id,name,length(name) from stu2;  utf8中1个汉字占3个字节

replace('在那个字段里找','查找内容','替换成');

substring('在那个字段里找',1,2);  开始是1 长度是2  截取

concat(lcase(substring('name',1,1)),substring('name',2,length('name')-1))




数学函数


abs()  绝对值

bin() 十进制转换二进制

ceiling()  向上取整

floor()    向下取整

format('小数',保留的位数);  保留小数点后几位

round()  四舍五入

least()  最小数

mod()    取模

rand()   随机数  [ 0 - 1.0 ]



流程控制函数

略


其他函数

user()  查看当前用户名  select user();

md5()   加密   select md5(123);  对一个字符串进行md5加密,得到一个32位的字符串  (不可逆的)

database()  查看当前数据库  select database();

password()  加密函数  mysql用户加密  select password('abcd');


select * from mysql.user \G;     \G 纵向显示信息





select 加强查询

select * from stu where name like 'S%';     %代表任意多个字符

select * from stu where name like '__O%';   _代表任意单个字符

select * from emplee where salary in(80,90,96);

select * from emp where pid is null;   进行是否为空时 

select * from emp where pid is not null;  非空

select * from emp where (salary > 500 or job = 'manager') and name like 'J%';  逻辑运算符的使用


order by  加强

select * from emp order by salary desc;

select * from emp order by bumen,salary desc; 

二次排序（两个字段的排序，先对部门升序，然后salary降序排序）按部门排序然后工资倒序



mysql 的分页查询

limit (起始位置,取得条数)  注意：从0开始

select * from stu order by id desc limit 0,5;

select * from stu order by id desc limit 5,5;






select * from emp where salary > (select avg(salary) from emp);

select *,avg(salary) from emp group by bumen; 

select *,avg(salary) as pj from emp group by bumen having pj <2000;

select avg(salary),sum(salary),max(salary),min(salary) from emp;  平均工资,总计工资,最高工资,最低工资

select *,count(*) from emp group by bumen;