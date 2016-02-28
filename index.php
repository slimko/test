<?php
error_reporting(E_ERROR|E_WARNING|E_PARSE|E_NOTICE);
ini_set('display_errors', -1);
header("Content-Type: text/html; charset=utf-8");

set_include_path(get_include_path()
.PATH_SEPARATOR.'application/controllers'
.PATH_SEPARATOR.'application/models'
.PATH_SEPARATOR.'lib/smarty/libs'
.PATH_SEPARATOR.'lib/dbsimple/DbSimple'
.PATH_SEPARATOR.'application/views');

function __autoload($class){
	require_once $class.'.php';
}
$front = FrontController::getInstance();
$front->route(); //разруливает

echo $front->getBody();// выводит всю страницу