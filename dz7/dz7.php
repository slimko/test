<?php
/*
 * 1) dz6_1.php Сохранять объявления в Cookie и выставить время жизни - неделю
   2) dz6_2.php Сохранять объявления в файлах
 */
require_once './array.php'; //подключаем базу данных
require_once './functions-files.php'; //подключаем функции для сохранения в файлы
//require_once './functions-cookies.php'; //подключаем функции для сохранения в куки

$bd = getBD();//получаем данные из БД
//print_r($bd);
//проверяем массив пост и добавляем в бд
if($_POST){
	echo $_POST['id'];
    if($_POST['id']>='0'){ //проверяем наличие id у формы
        $i=$_POST['id'];
        var_dump($bd);
        $bd[$i]=$_POST;//помещаем данные из формы в переменную
    }   
    else{
        $bd[]=$_POST;//помещаем данные из формы в бд
        echo "создаем новую переменную";
    }
    postBD($bd); //помещаем в базу данных
}
//проверяем гет id, если его нет заполняем форму пыстыми значениями
if(isset($_GET['id']) and !empty($bd[$_GET['id']])){
    $id=$_GET['id'];
    $form_bd = $bd[$id];
    $form_bd['id'] = $id;
    var_dump($form_bd);
}
else{
    $form_bd = array('private' => 0,'name' =>'','email' =>'','phone' =>'','city' =>'','cat' =>'','title' =>'','description' =>'','price' =>'','id' =>'');
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link href="./style.css" rel="stylesheet">
</head>
<body>
<!--форма для добавления -->
<form action="dz7.php" method="post" class="contact_form"> 
	<input type="hidden"  name="id"  value="<?= $form_bd['id'];?>">
   	<div class="wrapper">
   		<label for="private">Частное лицо</label> 
            <input type="radio" class="input_radio" value="1" name="private" <?php if($form_bd['private']=='1'){echo 'checked';}?>>
        <label for="company">Компания</label>
            <input type="radio" class="input_radio" value="0" name="private" <?php if($form_bd['private']=='0'){echo 'checked';}?>>
    </div>
    <br>
    <label for="name" class="input_name_label">Ваше имя</label>
        <input type="text" class="input_text" maxlength="40" name="name" id="name" value="<?= $form_bd['name'];?>"><br>
    <label for="email" class="input_name_label">Электронная почта</label>
        <input type="text" name="email" class="input_text" value="<?= $form_bd['email'];?>"><br>
    <label for="allow_mails" > 
        <input type="checkbox" name="allow_mails" class="allow_mails" <?php if(!empty($form_bd['allow_mails'])){echo 'checked';}?>>Я не хочу получать вопросы по объявлению по e-mail</label><br>
    <label for="fld_phone" class="input_name_label">Номер телефона</label> 
        <input type="text" class="input_text" name="phone" id="fld_phone" value="<?= $form_bd['phone'];?>"><br>
    <label for="region" class="input_name_label" >Город</label>
        <select class="input_text" title="Выберите Ваш город" name="city"> 
            <option value="0">-- Выберите город --</option>
            <option disabled="disabled">-- Города --</option> 
            <?php show_select($city,$form_bd['city']);?>
        </select>
        <br>
    <label for="fld_category_id"  class="input_name_label">Категория</label>
        <select title="Выберите категорию объявления" name="cat" class="input_text">
            <option>-- Выберите категорию --</option>
            <?php show_select($cat,$form_bd['cat']);?>
        </select>
    <br>
    <label for="fld_title" class="input_name_label">Название объявления</label>
        <input type="text" class="input_text" maxlength="50" name="title" value="<?= $form_bd['title'];?>"><br>
    <label for="fld_description"  class="input_name_label">Описание объявления</label>
        <textarea maxlength="3000" name="description"><?= $form_bd['description'];?></textarea><br>
    <label for="fld_price"  class="input_name_label">Цена</label>
    <input type="text" class="input_text" maxlength="9" name="price" value="<?= $form_bd['price'];?>">
        &nbsp;руб.<br>
    <div class="wrapper"><button type="submit">Отправить</button><button type="reset">Очистить</button></div>
</form>
<h2>Объявления:</h2>
<?php show_ads($bd); //выводим объявления ?>
</body>
</html>