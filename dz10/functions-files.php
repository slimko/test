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

$DBconf=getCONF();

/**
 * устанавливаем соединение с БД
 */

$DB = DbSimple_Generic::connect("mysql://{$DBconf['user_name']}:{$DBconf['password']}@{$DBconf['server_name']}/{$DBconf['database']}");
// Дальше работаем с соединением (или текущей транзакцией) $DB.

// Устанавливаем обработчик ошибок.
$DB->setErrorHandler('databaseErrorHandler');
$DB->setLogger('myLogger');
$DB->query("SET NAMES UTF8");

// Код обработчика ошибок SQL.
function databaseErrorHandler($message, $info){
    // Если использовалась @, ничего не делать.
    if (!error_reporting()) return;
    // Выводим подробную информацию об ошибке.
    echo "SQL Error: $message<br><pre>";
    print_r($info);
    echo "</pre>";
    exit();
}
//функция логирования запросов
function myLogger($db, $sql)
{
    // Находим контекст вызова этого запроса.
    $caller = $db->findLibraryCaller();
    global $firePHP;
    $firePHP->group("at ".@$caller['file'].' line '.@$caller['line']);
    $firePHP->log($sql);
    $firePHP->groupEnd();
}

/**
 * Функция получает города, категории и все объявления из БД
 */
function getDataBD($DB){
    $bd['city'] = $DB->selectCol('SELECT id AS ARRAY_KEY, name FROM city ORDER by id ASC');

    $category = $DB->select('SELECT t2.id, t1.name as cat_name, t2.name as name FROM category AS t1 Left JOIN category as t2 ON t2.parent_id=t1.id WHERE t2.name is not null');
    foreach ($category as $k => $v) {
        $bd['cat'][$v['cat_name']][$v['id']] = $v['name'];
    }

    $bd['bd'] = $DB->select('SELECT id AS ARRAY_KEY,id,name,email,phone,title_ad,price,description,city,cat,private,allow_mails FROM ad');

    return $bd;
}

/**
 * функция отвечающая за отправление в БД новых данных
 */
function postBD($DB,$data){
    $DB->query('INSERT INTO ad(?#) VALUES(?a)', array_keys($data), array_values($data));
}

/**
 * функция отвечающая за обновление в БД присланных через форму данных
 */
function updateBD($DB,$data,$id){
    $DB->query('UPDATE ad SET ?a WHERE ad.id=?d', $data,$id);
}

/**
 * функция отвечающая за удаление из БД данных
 */
function deleteBD($DB,$id){
    $DB->query('DELETE FROM ad WHERE id=?', $id);
}

?>