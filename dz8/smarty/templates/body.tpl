
<form action="dz8.php" method="post" class="contact_form"> 
		<input type="hidden"  name="id"  value="{$form_param.id}">
	   	<div class="wrapper">
	   	{html_radios name="private" options=$radios checked=$form_param.private}
	   	</div>
	    <br>
	    <label for="name" class="input_name_label">Ваше имя</label>
	        <input type="text" class="input_text" maxlength="40" name="name" id="name" value="{$form_param.name}"><br>
	    <label for="email" class="input_name_label">Электронная почта</label>
	        <input type="text" name="email" id="email" class="input_text" value="{$form_param.email}"><br>
	    {html_checkboxes name="allow_mails" values="1" output="Я не хочу получать вопросы по объявлению по e-mail" checked=$form_param.allow_mails|default:"0" labels="true"}
	    <label for="fld_phone" class="input_name_label">Номер телефона</label> 
	        <input type="text" class="input_text" name="phone" id="fld_phone" value="{$form_param.phone}"><br>
	    <label for="region" class="input_name_label">Город</label>
	    	{html_options options=$options_city selected=$form_param.city class="input_text" name="city"}    
	        <br>
	    <label for="fld_category_id"  class="input_name_label">Категория</label>
	        {html_options options=$options_cat selected=$form_param.cat class="input_text" name="cat"}
	    <br>
	    <label for="title" class="input_name_label">Название объявления</label>
	        <input type="text" class="input_text" maxlength="50" name="title" id="title" value="{$form_param.title}"><br>
	    <label for="description"  class="input_name_label">Описание объявления</label>
	        <textarea maxlength="3000" name="description" for="description">{$form_param.description}</textarea><br>
	    <label for="price"  class="input_name_label">Цена</label>
	    <input type="text" class="input_text" maxlength="9" name="price" id="price" value="{$form_param.price}">
	        &nbsp;руб.<br>
	    <div class="wrapper"><button type="submit">Отправить</button><button type="reset">Очистить</button></div>
	</form>
	<h2>Объявления:</h2>
	{* выводим объявления *}
	<ul>
	{foreach from=$bd key=nameValue item=Value }
		<li>{$nameValue}. <a href="?id={$nameValue}">{$Value.title}</a> | {$Value.price} руб. | <a href="?del={$nameValue}">удалить</a></li>
		{foreachelse}
		<p>Вы еще не добавили объявлений</p>
	{/foreach}
	</ul>