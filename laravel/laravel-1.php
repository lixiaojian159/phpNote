<?php

/** 5.1 章节说明
 *
 * 如何对模型对象进行增删改查
 * 用户注册和登录, 并对用户身份进行权限认证
 * 让管理员用户可以对用户进行删除
 * 构建一套用户账号激活和密码找回系统,
 */


/**
 * Eloquent ORM
 *
 * 用到数据模型- Model，利用 Laravel 提供的 Eloquent ORM 跟数据库进行交互，实现用户数据的增删改查操作
 * Eloquent 提供了简洁优雅的 ActiveRecord 实现来跟数据库进行交互
 * Active Record 是一种领域模型模式, 其特点是一个模型类对应关系型数据库中的一个表，模型类的一个实例对应表中的一行记录
 *
 */


/**
 * 数据迁移
 *
 * 所有创建的迁移文件都被统一放在 database/migrations 文件夹
 * Laravel 默认创建的两个迁移文件，一个用于构建用户表，一个用于构建密码重置表
 *
 *      database/migrations/2014_10_12_000000_create_users_table.php
        database/migrations/2014_10_12_100000_create_password_resets_table.php

 *
 * 数据迁移   database/migrations 文件夹下(有新生成的迁移文件,才可以迁移)     php artisan migrate
 * 数据回滚   (回滚到最后一次的数据迁移处)                                php artisan migrate:rollback
 *
 *
 * 坑1： 在数据迁移laravel自带的迁移文件(2014_10_12_000000_create_users_table.php名字可能略有差别)的时候, 系统报错：
 *
 * In Connection.php line 664:

  SQLSTATE[42000]: Syntax error or access violation: 1071 Specified key was t
  oo long; max key length is 767 bytes (SQL: alter table `users` add unique `
  users_email_unique`(`email`))


  In Connection.php line 458:

  SQLSTATE[42000]: Syntax error or access violation: 1071 Specified key was t
  oo long; max key length is 767 bytes

  原因是：数据库的字符集和校验规则改成了utf8mb4,或者是字段长度

  解决方法：
          找到  app\Providers\AppServiceProvider.php文件
          添加  use Illuminate\Support\Facades\Schema;
          修改  AppServiceProvider类中的boot方法,   Schema::defaultStringLength(191);


 *
 * 报错原因：
 *        Laravel 默认使用 utf8mb4 字符，它支持在数据库中存储 "emojis" 。
 *
 *        如果你是在版本低于 5.7.7 的 MySQL release 或者版本低于 10.2.2 的 MariaDB release 上创建索引，
 *        那就需要你手动配置迁移生成的默认字符串长度。
 *
 *        对于myisam和innodb存储引擎，prefixes的长度限制分别为1000 字节和767 字节。注意prefix的单位是 字节，但是建表时我们指定的长度单位是 字符 。
 *        utf8下3字节表示一个字符，utf8mb4是4字节表示一个字符，以innodb存储引擎来换算：utf8下长度255的字符索引占255X3=765字节，
 *        但Laravel 默认使用 utf8mb4 ，这样255X4=1020，超过了767字节，改称191后，191X4=764字节。这也是为什么要指定默认字符串长度１９１，
 *        其实如果你用不么这么长，指定小于１９１的也可以。
 */

/**
 * 数据迁移 (建库之后,设置env的数据库连接配置)
 *
 * 数据库中会多一个migrations表
 *
 * migrations表字段  id  migration  batch
 *
 * 表作用： 记录每一条迁移文件,迁移文件名称和执行时间
 *
 * 一般情况： 如果要重新执行迁移文件, 需要把migrations表中的记录清空( 相当于 php artisan migrate:refresh ), 再执行 php artisan migrate
 *
 * 注意点： 把数据库中的表删除后, 在migrations表中删除对应的表记录 , 然后再执行 php artisan migrate
 */


/**
 *
 * 坑2：  '/' 和 '\'两个斜线的区别
 *
 * app/Models/Article.php 是文件操作系统的路径信息
 *
 * App\Models\User 是类在 PHP 命名空间的位置
 */
