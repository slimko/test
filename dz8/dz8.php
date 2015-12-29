<?php
error_reporting(E_ERROR|E_WARNING|E_PARSE|E_NOTICE);
ini_set('display_errors', 1);
header("Content-Type: text/html; charset=utf-8");

require_once './array.php'; //подключаем базу данных
require_once './functions-files.php'; //подключаем функции для сохранения в файлы

//подключаем шаблонизатор смарти
$smarty_dir='./smarty/';
require($smarty_dir.'libs/Smarty.class.php');

//создаем объект библиотеки
$smarty = new Smarty(); 
//настройки смарти
$smarty->compile_check = true;
$smarty->debugging = false;
$smarty->template_dir = $smarty_dir.'templates';
$smarty->compile_dir = $smarty_dir.'templates_c';
$smarty->cache_dir = $smarty_dir.'cache';
$smarty->config_dir = $smarty_dir.'configs';

$params['bd'] = getBD();//получаем данные из БД

//проверяем массив пост и добавляем в бд
if($_POST){
    //$_POST=clear_post($_POST); //Преобразуем все возможные символы в соответствующие HTML-сущности
    if(is_numeric($_POST['price'])){
        if($_POST['id']>='0'){ //проверяем наличие id у формы
            $i=$_POST['id'];
            $params['bd'][$i]=$_POST;//помещаем данные из формы в переменную
        }   
        else{
            $params['bd'][]=$_POST;//помещаем данные из формы в бд
        }
        postBD($params['bd']); //помещаем в базу данных
    }
    else{
        $params['form_bd']=$_POST;

        $smarty->assign('form_param', $params['form_bd']);
        $smarty->assign('price_error', 'Введите корректную сумму!');
    }    
}
//проверяем гет id, если его нет заполняем форму пыстыми значениями
if(isset($_GET['id']) and !empty($params['bd'][$_GET['id']])){
    $id=$_GET['id'];
    $params['form_bd'] = $params['bd'][$id];
    $params['form_bd']['id'] = $id;
    $smarty->assign('form_param', $params['form_bd']);
}

// далее настраиваем вывод
$smarty->assign('title', 'Домашнее задание №8');
$smarty->assign('bd', $params['bd']);
$smarty->assign('options_city',$params['city']);
$smarty->assign('options_cat',$params['cat']);
$smarty->assign('radios', array(0 => 'Частное лицо', 1 => 'Компания'));
//выводим шаблон
$smarty->display('index.tpl');
?>