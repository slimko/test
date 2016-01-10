
<form action="index.php" method="post" class="contact_form">
		<input type="hidden"  name="id"  value="{$form_param.id|default}">
	   	<div class="wrapper">
	   	{html_radios name="private" options=$radios checked=$form_param.private|default:1}
	   	</div>
	    <br>
	    <label for="name" class="input_name_label">Ваше имя</label>
	        <input type="text" class="input_text" maxlength="40" name="name" id="name" value="{$form_param.name|default:''}"><br>
	    <label for="email" class="input_name_label">Электронная почта</label>
	        <input type="text" name="email" id="email" class="input_text" value="{$form_param.email|default:''}"><br>
	    {*html_checkboxes name="allow_mails" values="1" output="Я не хочу получать вопросы по объявлению по e-mail" checked=$form_param.allow_mails|default:'0' labels="true"*}
	    <label><input type="checkbox" name="allow_mails" value="1" {if $form_param.allow_mails eq '1'}checked{/if}>Я не хочу получать вопросы по объявлению на e-mail</label>
	    <label for="fld_phone" class="input_name_label">Номер телефона</label> 
	        <input type="text" class="input_text" name="phone" id="fld_phone" value="{$form_param.phone|default:''}"><br>
	    <label for="region" class="input_name_label">Город</label>
		<select name="city" class="input_text">
			<option value='null'>-- Выберите город --</option>
			{html_options options=$options_city selected=$form_param.city}
			<option value='1000' {if $form_param.city eq '1000'}selected{/if}>Другой город</option>
		</select>
	        <br>
	    <label for="fld_category_id"  class="input_name_label">Категория</label>
		<select name="cat" class="input_text">
			<option value='null'>-- Выберите категорию --</option>
	        {html_options options=$options_cat selected=$form_param.cat}
		</select>
	    <br>
	    <label for="title_ad" class="input_name_label">Название объявления</label>
	        <input type="text" class="input_text" maxlength="50" name="title_ad" id="title_ad" value="{$form_param.title_ad|default:''}"><br>
	    <label for="description"  class="input_name_label">Описание объявления</label>
	        <textarea maxlength="3000" name="description" for="description">{$form_param.description|default:''}</textarea><br>
	    <label for="price"  class="input_name_label">Цена</label>
	    <input type="text" class="input_text" maxlength="9" name="price" id="price" value="{$form_param.price|default:''}">
	        &nbsp;руб.<br>
	    <div class="wrapper"><button type="submit">Отправить</button><button type="reset">Очистить</button></div>
	</form>
<span style="color:red;">{$price_error|default:''}</span>	
	<h2>Объявления:</h2>
	{* выводим объявления *}
	<ul>
	{foreach from=$bd key=nameValue item=Value }
		<li>{$Value.id}. <a href="?id={$Value.id}">{$Value.title_ad|escape:htmlall:'UTF-8'}</a> | {$Value.price|escape:htmlall:'UTF-8'} руб. | <a href="?del={$nameValue}">удалить</a></li>
		{foreachelse}
		<p>Вы еще не добавили объявлений</p>
	{/foreach}
	</ul>