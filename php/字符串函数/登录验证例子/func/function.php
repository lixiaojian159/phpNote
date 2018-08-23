<?php


/**
 * err
 * 错误跳转js
 * @param  string $str 信息提示
 * @param  string $url 跳转页面
 */

function err($str,$url){
	$string = "<script>alert('{$str}');location.href='{$url}';</script>";
	exit($string);
}