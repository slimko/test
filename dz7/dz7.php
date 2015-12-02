<?php
/*
 * 1) dz6_1.php Сохранять объявления в Cookie и выставить время жизни - неделю
   2) dz6_2.php Сохранять объявления в файлах
 */
require_once './array.php'; //подключаем базу данных
require_once './functions-files.php'; //подключаем функции для сохранения в файлы
//require_once './functions-cookies.php'; //подключаем функции для сохранения в куки

$params['bd'] = getBD();//получаем данные из БД

//проверяем массив пост и добавляем в бд
if($_POST){
    if($_POST['id']>='0'){ //проверяем наличие id у формы
        $i=$_POST['id'];
        $params['bd'][$i]=$_POST;//помещаем данные из формы в переменную
    }   
    else{
        $params['bd'][]=$_POST;//помещаем данные из формы в бд
    }
    postBD($params['bd']); //помещаем в базу данных
}
//проверяем гет id, если его нет заполняем форму пыстыми значениями
if(isset($_GET['id']) and !empty($params['bd'][$_GET['id']])){
    $id=$_GET['id'];
    $params['form_bd'] = $params['bd'][$id];
    $params['form_bd']['id'] = $id;
}
else{
    $params['form_bd'] = array('private' => 0,'name' =>'','email' =>'','phone' =>'','city' =>'','cat' =>'','title' =>'','description' =>'','price' =>'','id' =>'');
}
template('./views/layout.php',$params);
?>