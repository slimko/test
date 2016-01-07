<?php
error_reporting(E_ERROR|E_WARNING|E_PARSE|E_NOTICE);
ini_set('display_errors', 0);
header("Content-Type: text/html; charset=utf-8");

$filename='./base.conf';
if($_POST){
    $db = mysqli_connect($_POST['server_name'],$_POST['user_name'],$_POST['password']) or die ('Ошибка подключения к базе данных: '.mysqli_connect_error().'<p><a href="./install.php">Повторить установку</a></p>' );//устанавливаем соединение с сервером
    mysqli_select_db($db,$_POST['database']) or die('<p><a href="./install.php">Повторить установку</a></p>Не удалось выбрать базу данных: '.mysqli_error($db).'<p>Укажите существующую базу данных</p>'); //выбираем базу данных

    if(!fopen($filename,'r')){
        echo "не могу открыть файл";
        exit;
    }else{
        $sql = file_get_contents('./base-setup.sql'); //формируем запрос в базу данных
        mysqli_query($db, 'set names utf8'); //настраиваем кодировку
        mysqli_multi_query($db,$sql) or die('запрос не удался: '.mysqli_error($db)); //запрос в базу
        postCONF($_POST,$filename);
    }
}


//отправляем в конфиг данные
function postCONF($bd,$filename){
    $bd = json_encode($bd);
    if(file_put_contents($filename, $bd)===false){
        echo 'не могу создать конфигурационный файл';
    }else{
        echo '<h1>Установка завершена!</h1><p>Пора переходить на <a href="./index.php">главную страницу сайта!</p>';
        exit;
    }
}
?>
<h3>Укажите параметры для подключения к Вашей базе данных</h3>
<form action="install.php" method="post">
    <label class="input_name_label">Server name:<br>
    <input type="text" class="input_text" maxlength="50" name="server_name" ></label><br>
    <label class="input_name_label">User name:<br>
        <input type="text" class="input_text" maxlength="50" name="user_name"></label><br>
    <label class="input_name_label">Password:<br>
        <input type="text" class="input_text" maxlength="50" name="password" ></label><br>
    <label class="input_name_label">Database:<br>
        <input type="text" class="input_text" maxlength="50" name="database" ></label><p></p>
    <div class="wrapper"><button type="submit">Установить</button><button type="reset">Очистить</button></div>
</form>
