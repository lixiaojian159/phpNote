<?php

/**
 *     问题一：  在win7下,composer安装后,cmd命令行可以正常使用,但是git却不能使用
 *
 *     问题描述：
 *
 *     已经安装composer，写好composer.bat，并且设置好了path，在cmd下可以正常使用，但是在git-bash里面不行，显示如下提示：
 *     bash: composer: command not found
 *
 *     真正的原因：
 *
 *     git-bash 不识别 composer.bat 文件
 *
 *     解决办法：
 *
 *     需要新建一个 composer 文件，输入如下内容：
 *     #!/usr/bin/env sh
 *     # php /path/to/composer.phar $*
 *     php `dirname $0`/composer.phar $*
 */
