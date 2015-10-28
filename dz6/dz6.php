<?php
session_start();//стартуем сессию
$citys = array('641780'=>'Новосибирск','641490'=>'Барабинск','641510'=>'Бердск');
$transport = array('9'=>'Автомобили с пробегом','109'=>'Новые автомобили','14'=>'Мотоциклы и мототехника','81'=>'Грузовики и спецтехника','11'=>'Водный транспорт','10'=>'Запчасти и аксессуары');

//функция присваивания id объявления в сессии
function check_session(){
    if ( ! isset( $_SESSION['counter'] )) 
    { 
        $_SESSION['counter'] = 0; 
    } 
    else 
    { 
        $_SESSION['counter']++; 
    }
    return $_SESSION['counter'];
}

//функция добавления/изменения данных в массиве session
function add_ads($var,$i=NULL){
    if($i==null){
        $i = check_session(); //если объявление не изменяем, то получаем id нового объявления  
    }else{
        unset($_SESSION['ads'][$i]); //очищаем переменную для перезаписи, используется для того, чтобы было понятно изменили ли значение переменной - "Я не хочу получать вопросы по объявлению по e-mail"
    }
    foreach ($var as $key => $value) {
        $_SESSION['ads'][$i][$key]=$value; //записываем значение в сессию
    }

}
//функция выводит блок данных из session: название|цену|удалить|
function show_ads($data){
    //array_multisort($data,SORT_DESC); //сортируем массив по порядку
    foreach ($data as $k => $v) {
            echo $k.'. <a href="?id='.$k.'">'.$v['title'].'</a> | '.$v['price'].' руб. | <a href="?del='.$k.'">удалить</a><br>';
    }
}

//проверяем массив пост
if($_POST!=NULL){
    if(isset($_SESSION['form'])){ //если существует этот массив в сессии, значит редактируем объявление
        $i=$_SESSION['form']['id'];//передаем в переменную id изменяемого объявления
        unset($_SESSION['form']); //удаляем
        add_ads($_POST,$i); //передаем массив POST из формы с id объявления
    }else{
        add_ads($_POST); //передаем массив POST из формы для добавления нового объявления
    }
}

//проверяем наичие гета и сессии
if(isset($_GET,$_SESSION['ads'])){
    foreach ($_GET as $k => $v){
        switch ($k) {
            case 'id':
                if(is_numeric($v) and isset($_SESSION['ads']["$v"])){
                    $_SESSION['form']['id']=$v; //запишем id новости в массив для последующего редактирования из формы
                    $var=$_SESSION['ads']["$v"]; //распарсим массив для редактирования в форме
                    foreach ($var as $key => $value) {
                        $_SESSION['form'][$key]=$value;
                    }
                }
                else{
                    echo "<h2>Такой записи не существует</h2>";
                }    
            break;
            case 'del':
                unset($_SESSION['ads']["$v"]);
                break;
            default:
                header("HTTP/1.1 404 Not Found");
                header('Location: /404.html');
                exit();     
        }
    }  
}
else{
    unset($_SESSION['form']); //если массив гет пустой - очищаем данные из формы в сессии
}

?>
<!--форма для добавления -->
<form action="dz6.php" method="post"> 
    <label for="private">Частное лицо</label> 
        <input type="radio" value="1" <?php if(isset($_SESSION['form']['private']) && $_SESSION['form']['private']=="1")echo 'checked=""';?>name="private">
    <label for="company">Компания</label>
        <input type="radio" value="0" <?php if(isset($_SESSION['form']['private']) && $_SESSION['form']['private']=="0")echo 'checked=""';?>name="private"><br>
    <label for="name">Ваше имя</label>
        <input type="text" maxlength="40" name="name" id="name" value='<?php if(isset($_SESSION['form'])){echo $_SESSION['form']['name'];}?>'><br>
    <label for="email">Электронная почта</label>
        <input type="text" name="email" value='<?php if(isset($_SESSION['form'])){echo $_SESSION['form']['email'];}?>'><br>
    <label for="allow_mails"> 
        <input type="checkbox" name="allow_mails" 
        <?php if(isset($_SESSION['form']) and isset($_SESSION['form']['allow_mails'])=='on'){echo 'checked';} else {echo '';}?>>Я не хочу получать вопросы по объявлению по e-mail</label><br>
    <label for="fld_phone">Номер телефона</label> 
        <input type="text" name="phone" id="fld_phone" value='<?php if(isset($_SESSION['form'])){echo $_SESSION['form']['phone'];}?>'><br>
    <label for="region" >Город</label> 
        <select title="Выберите Ваш город" name="region"> 
            <option value="">-- Выберите город --</option>
            <option disabled="disabled">-- Города --</option>
            <?php
            foreach($citys as $number=>$city){
                $selected = ($number==$_SESSION['form']['region']) ? 'selected=""' : ''; //если мы передали в функцию город который нужно выставить в списке то мы ставим специальную метку в селектор
                        echo '<option '.$selected.' value="'.$number.'">'.$city.'</option>';
                    }
            ?>   
        </select>
        <br>
    <label for="fld_category_id" class="form-label">Категория</label>
        <select title="Выберите категорию объявления" name="transport" class="form-input-select">
            <option value="">-- Выберите категорию --</option>
            <optgroup label="Транспорт">

                <?php
                foreach($transport as $number=>$bibi){
                $selected = ($number==$_SESSION['form']['transport']) ? 'selected=""' : ''; //если мы передали в функцию город который нужно выставить в списке то мы ставим специальную метку в селектор
                        echo '<option '.$selected.' value="'.$number.'">'.$bibi.'</option>';
                    }
                ?>   
            </optgroup>
        </select>
    <br>
    <label for="fld_title">Название объявления</label>
        <input type="text" maxlength="50" name="title" value='<?php if(isset($_SESSION['form'])){echo $_SESSION['form']['title'];}?>'><br>
    <label for="fld_description" >Описание объявления</label>
        <textarea maxlength="3000" name="description"><?php if(isset($_SESSION['form'])){echo $_SESSION['form']['description'];}?></textarea><br>
    <label for="fld_price">Цена</label>
    <input type="text" maxlength="9" name="price" value='<?php if(isset($_SESSION['form'])){echo $_SESSION['form']['price'];}else{echo 0;}?>'>
        &nbsp;руб.<br>
    <button type="submit">Отправить</button>
</form>

<?php


//проверяем массив сессии и выводим объявления
if(isset($_SESSION['ads'])){
    show_ads($_SESSION['ads']);
}else{
    echo 'Вы еще не добавили ни одного объявления';
}

?>