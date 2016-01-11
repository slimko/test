<?php
error_reporting(E_ERROR|E_WARNING|E_PARSE|E_NOTICE);
ini_set('display_errors', 1);
header("Content-Type: text/html; charset=utf-8");

//подключаем конфиг
if(!file_exists('./base.conf') or !file_get_contents('./base.conf')){
    echo 'Не создан файл конфигурации. Сначала выполните <a href="./install.php">установку</a> скрипта!';
    exit;
}

//подключаем шаблонизатор смарти
$smarty_dir='./smarty/';
require($smarty_dir.'libs/Smarty.class.php');

/*
 * Подключаем библиотеку с бд
 */
require_once "./dbsimple/config.php";
require_once "./dbsimple/DbSimple/Generic.php";
/*
 * Подключаем firePHP
 */
require_once "./FirePHPCore/FirePHP.class.php";
//инициализируем класс
$firePHP = FirePHP::getInstance(true);
//устанавливаем активность для fireBug
$firePHP -> setEnabled(true);


//подключаем функции
if(file_exists('./functions-files.php')){
    require_once './functions-files.php';
}
else{
    echo 'Не могу найти файл с функциями';
    exit;
}

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
    $form= array("name"=>"","email"=>"","phone"=>"","title_ad"=>"","price"=>null,"description"=>"","city"=>NULL,"cat"=>NULL,"private"=>null,"allow_mails"=>NULL);
    if(is_numeric($_POST['price'])){
        if($_POST['id']){ //проверяем наличие id у формы
            $result = array_replace ($form, $_POST);
            unset($result['id']); //вырезаем id
            updateBD($DB,$result,$_POST['id']); //отправляем в базу данных на обновление
        }
        else{
            unset($_POST['id']); //вырезаем id
            var_dump($_POST);
            postBD($DB,$_POST); //отправляем данные в базу данных
        }

    }
    else{
        $params['form_bd']=$_POST;
        $smarty->assign('form_param', $params['form_bd']);
        $smarty->assign('price_error', 'Введите корректную сумму!');
    }
}

if(isset($_GET['del'])){
    deleteBD($DB,$_GET['del']);
}

$params = getDataBD($DB);//получаем объявления и данные для формы из БД
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
$smarty->assign('radios', array(1 => 'Частное лицо', 2 => 'Компания'));
//выводим шаблон
$smarty->display('index.tpl');
?>