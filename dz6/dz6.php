<?php
session_start();//стартуем сессию
//подключаем массив с данными
require_once 'array.php';

//функция выводит данные в select
function show_select($array){
    foreach ($array as $k => $v){
        if(is_array($v)){
            echo '<optgroup label="'.$k.'">';
            show_select($v);
            echo '</optgroup>';
        }   
        else{
            if($_SESSION['ads'][$_GET['id']]['city']==$k or $_SESSION['ads'][$_GET['id']]['cat']==$k){$selected='selected';}else{$selected='';}
            //$selected = ($k==$_SESSION['ads'][$_GET['id']][$k]) ? 'selected' : ''; //если мы передали в функцию город который нужно выставить в списке то мы ставим специальную метку в селектор
            echo '<option value="'.$k.'"'.$selected.'>'.$v.'</option>';
            }
        }
}
//проверяем массив пост и добавляем в сессию
if($_POST){
    if(isset($_POST['id'])){
        $i=$_POST['id'];
        $_SESSION['ads'][$i]=$_POST;
    }   
    else{
        $_SESSION['ads'][]=$_POST; //записываем значение в сессию
    }
}
//проверяем массив get на запрос про удаление
if(isset($_GET['del'])){
    if(is_numeric($_GET['del']) and $_GET['del']<=count($_SESSION['ads'])){
        $i=$_GET['del'];
        unset($_SESSION['ads'][$i]);
    }
    else{
        echo 'Нет данных для удаления';
    } 
}

//функция выводит блок данных из session: название|цену|удалить|
function show_ads(){
    echo '<p>Все объявления:</p><ul>';
    if(!empty($_SESSION['ads'])){
        foreach ($_SESSION['ads'] as $k => $v) {
        echo '<li>'.$k.'. <a href="?id='.$k.'">'.$v['title'].'</a> | '.$v['price'].' руб. | <a href="?del='.$k.'">удалить</a></li>';
    }
    echo '</ul>';
    }else{
        echo 'Вы еще не добавили ни одного объявления';
    }
}
?>   
<html>
<head>
    <style type="text/css">
        .contact_form {
            border: 1px solid gray;
            width: 550px;
        }
        .contact_form .input_name_label {
            width:160px;
            display:inline-block;
            margin:5px;
            vertical-align: top;
        }
        .contact_form .input_text {
            padding:2px;
            margin: 5px;
            width: 300px;
        }
        .contact_form textarea {padding:8px; margin: 5px;width:300px;}
        .contact_form button, .contact_form .input_radio, {margin-right: 40px; padding: 5px;}
        .contact_form .allow_mails{
            margin:10px;
        }
        .wrapper{
            width:300px;
            display:inline-block;
            padding:2px;
            margin: 5px;
            margin-left: 180px;    
        }
        li{
            list-style-type: none;
        }
    </style>
</head>
<body>
<!--форма для добавления -->
<form action="dz6.php" method="post" class="contact_form"> 
   <?php if(isset($_GET['id']) and is_numeric($_GET['id']) and $_GET['id']<=count($_SESSION['ads'])){echo '<input type="hidden"  name="id"  value="'.$_GET['id'].'">';}?>
   <div class="wrapper">
         <label for="private" >Частное лицо</label> 
            <input type="radio" class="input_radio" 
            <?php if(isset($_GET['id']) and !empty($_SESSION['ads'][$_GET['id']]['private']) and $_SESSION['ads'][$_GET['id']]['private']=='1')
            {
                echo 'value="1" checked ';
                }
                else{ echo 'value="1"';
            }?> name="private">
        <label for="company">Компания</label>
            <input type="radio" class="input_radio" 
            <?php if(isset($_GET['id']) and !empty($_SESSION['ads'][$_GET['id']]['private']) and $_SESSION['ads'][$_GET['id']]['private']=='0'){
                echo 'value="0" checked ';
            }
            elseif(!isset($_GET['id'])){ echo 'value="0" checked';
            }
            else{ echo 'value="0"';
            }
            ?> name="private">
    </div>
    <br>
    <label for="name" class="input_name_label">Ваше имя</label>
        <input type="text" class="input_text" maxlength="40" name="name" id="name" <?php if(isset($_GET['id']) and !empty($_SESSION['ads'][$_GET['id']]['name'])){echo 'value="'.$_SESSION['ads'][$_GET['id']]['name'].'"';}?>><br>
    <label for="email" class="input_name_label">Электронная почта</label>
        <input type="text" name="email" class="input_text" <?php if(isset($_GET['id']) and !empty($_SESSION['ads'][$_GET['id']]['email'])){echo 'value="'.$_SESSION['ads'][$_GET['id']]['email'].'"';}?>><br>
    <label for="allow_mails" > 
        <input type="checkbox" name="allow_mails" class="allow_mails" <?php if(isset($_GET['id']) and !empty($_SESSION['ads'][$_GET['id']]['allow_mails'])){echo 'checked';}?>>Я не хочу получать вопросы по объявлению по e-mail</label><br>
    <label for="fld_phone" class="input_name_label">Номер телефона</label> 
        <input type="text" class="input_text" name="phone" id="fld_phone" <?php if(isset($_GET['id']) and !empty($_SESSION['ads'][$_GET['id']]['phone'])){echo 'value="'.$_SESSION['ads'][$_GET['id']]['phone'].'"';}?>><br>
    <label for="region" class="input_name_label" >Город</label> 
        <select class="input_text" title="Выберите Ваш город" name="city"> 
            <option value="0">-- Выберите город --</option>
            <option disabled="disabled">-- Города --</option>
            <?php show_select($city); ?>
        </select>
        <br>
    <label for="fld_category_id"  class="input_name_label">Категория</label>
        <select title="Выберите категорию объявления" name="cat" class="input_text">
            <option value="">-- Выберите категорию --</option>
            <?php show_select($cat) ?>
        </select>
    <br>
    <label for="fld_title" class="input_name_label">Название объявления</label>
        <input type="text" class="input_text" maxlength="50" name="title" <?php if(isset($_GET['id']) and !empty($_SESSION['ads'][$_GET['id']]['title'])){echo 'value="'.$_SESSION['ads'][$_GET['id']]['title'].'"';}?>><br>
    <label for="fld_description"  class="input_name_label">Описание объявления</label>
        <textarea maxlength="3000" name="description"><?php if(isset($_GET['id']) and !empty($_SESSION['ads'][$_GET['id']]['description'])){echo $_SESSION['ads'][$_GET['id']]['description'];}?></textarea><br>
    <label for="fld_price"  class="input_name_label">Цена</label>
    <input type="text" class="input_text" maxlength="9" name="price" <?php if(isset($_GET['id']) and !empty($_SESSION['ads'][$_GET['id']]['price'])){echo 'value="'.$_SESSION['ads'][$_GET['id']]['price'].'"';}else{echo '0';}?>>
        &nbsp;руб.<br>
    <div class="wrapper"><button type="submit">Отправить</button><button type="reset">Очистить</button></div>
</form>
<?php show_ads(); //выводим объявления?>
</body>
</html>