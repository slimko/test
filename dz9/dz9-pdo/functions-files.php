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
$dsn = "mysql:host={$DBconf['server_name']};dbname={$DBconf['database']};charset=utf8";
$opt = array(
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
);
$pdo = new PDO($dsn,$DBconf['user_name'], $DBconf['password'], $opt);


/**
 * функция отвечающая за получение всех объявлений из БД и данных для формы (город, категории)
 */
function getDataBD($pdo){
    // получаем города
    $stmt = $pdo->query('select * from city ORDER by id ASC');
    while ($row = $stmt->fetch()){
        $bd['city'][$row['id']]=$row['name'];
    }

    // получаем категории
    $stmt = $pdo->query('SELECT t2.id, t1.name as cat_name, t2.name as name FROM category AS t1 Left JOIN category as t2 ON t2.parent_id=t1.id WHERE t2.name is not null');
    while ($row = $stmt->fetch()){
        $bd['cat'][$row['cat_name']][$row['id']]=$row['name'];
    }

    // получаем данные
    $stmt = $pdo->query('select * from ad');
        $bd['bd']=null;
        while (($row = $stmt->fetch())!==false) {
            $bd['bd'][$row['id']] = $row;
        }
return $bd;
}

/**
 * функция отвечающая за отправление в БД новых данных
 */
function postBD($pdo,$bd){
    $stmt = $pdo->prepare("INSERT INTO ad(name, email, phone, title_ad, price, description, city, cat, private, allow_mails) VALUES (:name, :email, :phone, :title_ad, :price, :description, :city, :cat, :private, :allow_mails)");
    $stmt->execute(array(':name'=>$bd['name'], ':email'=>$bd['email'], ':phone'=>$bd['phone'], ':title_ad'=>$bd['title_ad'], ':price'=>$bd['price'], ':description'=>$bd['description'], ':city'=>$bd['city'], ':cat'=>$bd['cat'], ':private'=>$bd['private'], ':allow_mails'=>$bd['allow_mails']));
}

/**
 * функция отвечающая за обновление в БД присланных через форму данных
 */

function updateBD($pdo,$bd){
    $stmt = $pdo->prepare("UPDATE ad SET name=:name, email=:email, phone=:phone, title_ad=:title_ad, price=:price, description=:description, city=:city, cat=:cat, private=:private, allow_mails=:allow_mails WHERE ad.id=:id");
    $stmt->execute(array(':id'=>$bd['id'],':name'=>$bd['name'], ':email'=>$bd['email'], ':phone'=>$bd['phone'], ':title_ad'=>$bd['title_ad'], ':price'=>$bd['price'], ':description'=>$bd['description'], ':city'=>$bd['city'], ':cat'=>$bd['cat'], ':private'=>$bd['private'], ':allow_mails'=>$bd['allow_mails']));
}

/**
 * функция отвечающая за удаление из БД данных
 */
function deleteBD($pdo,$id){
    $stmt = $pdo->prepare('DELETE FROM ad WHERE id = ?');
    $stmt->execute(array($id));
}

?>