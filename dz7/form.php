<!--форма для добавления объявлений-->
<form action="dz7.php" method="post" class="contact_form"> 
	<input type="hidden"  name="id"  value="<?= $params['form_bd']['id'];?>">
   	<div class="wrapper">
   		<label for="private">Частное лицо</label> 
            <input type="radio" class="input_radio" value="1" name="private" <?php if($params['form_bd']['private']=='1'){echo 'checked';}?>>
        <label for="company">Компания</label>
            <input type="radio" class="input_radio" value="0" name="private" <?php if($params['form_bd']['private']=='0'){echo 'checked';}?>>
    </div>
    <br>
    <label for="name" class="input_name_label">Ваше имя</label>
        <input type="text" class="input_text" maxlength="40" name="name" id="name" value="<?= $params['form_bd']['name'];?>"><br>
    <label for="email" class="input_name_label">Электронная почта</label>
        <input type="text" name="email" class="input_text" value="<?= $params['form_bd']['email'];?>"><br>
    <label for="allow_mails" > 
        <input type="checkbox" name="allow_mails" class="allow_mails" <?php if(!empty($params['form_bd']['allow_mails'])){echo 'checked';}?>>Я не хочу получать вопросы по объявлению по e-mail</label><br>
    <label for="fld_phone" class="input_name_label">Номер телефона</label> 
        <input type="text" class="input_text" name="phone" id="fld_phone" value="<?= $params['form_bd']['phone'];?>"><br>
    <label for="region" class="input_name_label" >Город</label>
        <select class="input_text" title="Выберите Ваш город" name="city"> 
            <option value="0">-- Выберите город --</option>
            <option disabled="disabled">-- Города --</option> 
            <?php show_select($params['city'],$params['form_bd']['city']);?>
        </select>
        <br>
    <label for="fld_category_id"  class="input_name_label">Категория</label>
        <select title="Выберите категорию объявления" name="cat" class="input_text">
            <option>-- Выберите категорию --</option>
            <?php show_select($params['cat'],$params['form_bd']['cat']);?>
        </select>
    <br>
    <label for="fld_title" class="input_name_label">Название объявления</label>
        <input type="text" class="input_text" maxlength="50" name="title" value="<?= $params['form_bd']['title'];?>"><br>
    <label for="fld_description"  class="input_name_label">Описание объявления</label>
        <textarea maxlength="3000" name="description"><?= $params['form_bd']['description'];?></textarea><br>
    <label for="fld_price"  class="input_name_label">Цена</label>
    <input type="text" class="input_text" maxlength="9" name="price" value="<?= $params['form_bd']['price'];?>">
        &nbsp;руб.<br>
    <div class="wrapper"><button type="submit">Отправить</button><button type="reset">Очистить</button></div>
</form>