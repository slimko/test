<?php
error_reporting(E_ERROR|E_WARNING|E_PARSE|E_NOTICE);
ini_set('display_errors', 0);
header("Content-Type: text/html; charset=utf-8");

//подключаем конфиг
if(!file_exists('./base.conf')){
    echo 'Не создан файл конфигурации. Сначала выполните <a href="./install.php">установку</a> скрипта!';
    exit;
}
//подключаем функции
if(file_exists('./functions-files.php')){
    require_once './functions-files.php';
}
else{
    echo 'Не могу найти файл с функциями';
    exit;
}

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


//проверяем массив пост и добавляем в бд
if($_POST){
    if(is_numeric($_POST['price'])){
        if($_POST['id']){ //проверяем наличие id у формы
            updateBD($_POST); //отправляем в базу данных на обновление
        }
        else{
            $post = array_diff($_POST, array(null)); // удалим id с пустым значением
            postBD($post); //отправляем данные в базу данных
        }

    }
    else{
        $params['form_bd']=$_POST;

        $smarty->assign('form_param', $params['form_bd']);
        $smarty->assign('price_error', 'Введите корректную сумму!');
    }
}

if(isset($_GET['del'])){
    $id=$_GET['del'];
    deleteBD($id);
}

$params = getDataBD();//получаем объявления и данные для формы из БД
//проверяем гет id, если его нет заполняем форму пыстыми значениями
if(isset($_GET['id']) and !empty($params['bd'][$_GET['id']])){
    $id=$_GET['id'];
    $params['form_bd'] = $params['bd'][$id];
    $params['form_bd']['id'] = $id;

    $smarty->assign('form_param', $params['form_bd']);
}


// далее настраиваем вывод
$smarty->assign('title', 'Домашнее задание №9');
$smarty->assign('bd', $params['bd']);
$smarty->assign('options_city',$params['city']);
$smarty->assign('options_cat',$params['cat']);
$smarty->assign('radios', array(0 => 'Частное лицо', 1 => 'Компания'));
//выводим шаблон
$smarty->display('index.tpl');
?>