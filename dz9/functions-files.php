<?php
//проверяем конфиг
function getCONF(){
    $filename='./base.conf';
    if(!fopen($filename,'r')){
        echo "не могу открыть файл конфигурации";
        exit;
    }
    if ($content=file_get_contents($filename)){
        $conf = json_decode($content, true);
    }
    else{
        $conf = null;
    }
    return $conf;
}


/**
 * функция отвечающая за соединение с БД и отправкой в нее подготовенных запросов
 */

function connect_db($sql){
    $conf=getCONF();
    $db = mysqli_connect($conf['server_name'],$conf['user_name'],$conf['password']) or die ('Ошибка подключения к базе данных: '.mysqli_connect_error().'<p><a href="./install.php">Выполните установку</a></p>' );//устанавливаем соединение с сервером
    mysqli_select_db($db,$conf['database']) or die('Не удалось выбрать базу данных: '.mysqli_error($db)); //выбираем базу данных
    mysqli_query($db, 'set names utf8'); //настраиваем кодировку

    $result = mysqli_query($db,$sql) or die('запрос не удался: '.mysqli_error($db)); //запрос в базу
    //mysqli_close($db);//закрыли соединение

    return $result;
}

/**
 * функция отвечающая за получение всех объявлений из БД и данных для формы (город, категории)
 */
function getDataBD(){

$sql='select * from city ORDER by id ASC'; //формируем запрос
$result = connect_db($sql); //получаем данные из базы данных
if(mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)){
        $bd['city'][$row['id']]=$row['name'];
    }
}

$sql='SELECT t2.id, t1.name as cat_name, t2.name as name FROM category AS t1 Left JOIN category as t2 ON t2.parent_id=t1.id WHERE t2.name is not null'; //формируем запрос
$result = connect_db($sql); //получаем данные из базы данных
if(mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)){
        $bd['cat'][$row['cat_name']][$row['id']]=$row['name'];
    }
}

$sql='select * from ad'; //формируем запрос
$result = connect_db($sql); //получаем данные из базы данных
if(mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)){
        $bd['bd'][$row['id']]=$row;
    }
}
else{
    $bd['bd']=null;
}

return $bd;
}

/**
 * функция отвечающая за отправление в БД новых данных
 */
function postBD($bd){
    $columns = implode(", ",array_keys($bd));//получаем строку ключей
    $values  = implode("', '",array_values($bd)); // получаем строку значений
    $sql = "INSERT INTO ad ($columns) VALUES ('$values')"; //формируем запрос в базу данных
    connect_db($sql); //получаем данные из базы данных
}

/**
 * функция отвечающая за обновление в БД присланных через форму данных
 */
function updateBD($bd){
    $data_update='';//переменная для запроса
    //проверяем наш чекбокс
        if (!array_key_exists('allow_mails', $bd)) {
            $data_update = "allow_mails='0', ";
        }
    //создаем строку запроса
    foreach ($bd as $key => $value) {
        $data_update .= "$key='$value', ";
    }
    $data_update = substr($data_update, 0, -2); //убираем лишний пробел и запятую
    $sql="UPDATE ad SET $data_update WHERE ad.id='$bd[id]'"; //формируем строку запроса

    connect_db($sql); //обновляем базу данных
}
/**
 * функция отвечающая за удаление из БД данных
 */
function deleteBD($data){
    $sql="DELETE FROM ad WHERE id='$data'"; //формируем строку запроса

    connect_db($sql); //обновляем базу данных
}

?>