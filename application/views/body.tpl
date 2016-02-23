	<div class="col-sm-7 col-md-6 col-lg-6" style="background-color: #e0f2f1;margin-top:15px;">
		<form action="http://{$smarty.server.SERVER_NAME}/post" method="post" class="form-horizontal">
			<input type="hidden"  name="id"  value="{$form_param->id}">

			<div class="form-group">
				<div class="col-sm-offset-4 col-sm-8 radio">
					{html_radios name="private" options=$radios checked=$form_param->private|default:1}
				</div>
			</div>

			<div class="form-group">
					<label for="first_name" class="col-sm-4 control-label">Ваше имя</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" maxlength="40" name="name" id="first_name" value="{$form_param->name}" placeholder="Введите Ваше имя">
					</div>
			</div>
			<div class="form-group">
				<label for="email" class="col-sm-4 control-label">Электронная почта</label>
				<div class="col-sm-8">
					<input type="text" name="email" id="email" class="form-control" value="{$form_param->email}">
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-4 col-sm-8">
					<div class="checkbox">
						<label>
							<input type="checkbox" name="allow_mails" value="1" {if $form_param->allow_mails eq '1'}checked{/if}> Я не хочу получать вопросы по объявлению на e-mail
						</label>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label for="fld_phone" class="col-sm-4 control-label">Номер телефона</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" name="phone" id="fld_phone" value="{$form_param->phone}">
				</div>
			</div>
			<div class="form-group">
				<label for="region" class="col-sm-4 control-label">Город</label>
				<div class="col-sm-8">
					<select name="city" class="form-control">
						<option value='null'>-- Выберите город --</option>
						{html_options options=$options_city selected=$form_param->city}
						<option value='1000' {if $form_param->city eq '1000'}selected{/if}>Другой город</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="fld_category_id" class="col-sm-4 control-label">Категория</label>
				<div class="col-sm-8">
					<select name="cat" class="form-control">
						<option value='null'>-- Выберите категорию --</option>
						{html_options options=$options_cat selected=$form_param->cat}
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="title_ad" class="col-sm-4 control-label">Название объявления</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" maxlength="50" name="title_ad" id="title_ad" value="{$form_param->title_ad}">
				</div>
			</div>
			<div class="form-group">
				<label for="description" class="col-sm-4 control-label">Описание объявления</label>
				<div class="col-sm-8">
					<textarea maxlength="3000" name="description" for="description" class="form-control" rows="3">{$form_param->description}</textarea>
				</div>
			</div>
			<div class="form-group">
				<label for="price" class="col-sm-4 control-label">Цена</label>
				<div class="col-sm-7">
					<input type="text" class="form-control" maxlength="9" name="price" id="price" value="{$form_param->price}">
				</div>
				<div class="col-sm-1">
					<p class="form-control-static">руб.</p>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-4 col-sm-8">
					<button type="submit" class="btn btn-primary col-sm-3">Отправить</button>
					<button type="reset" class="btn btn-default col-sm-3 col-sm-offset-1">Очистить</button>
				</div>
			</div>
		</form>
	</div>
	<div class="col-sm-5 col-md-6 col-lg-6">
	<span style="color:red;">{$price_error|default:''}</span>
		<h2>Доска объявлений:</h2>
		{* выводим объявления *}
		<table class="table table-hover">
			<thead>
				<th>#</th>
				<th>Название объявления</th>
				<th>Цена</th>
				<th colspan="2">Действие</th>
			</thead>
			<tbody>
			{foreach from=$bd key=nameValue item=Value }
				<tr>
					<td>{$Value->id}.</td>
					<td>{$Value->title_ad|escape:htmlall:'UTF-8'}</td>
					<td>{$Value->price|escape:htmlall:'UTF-8'} руб.</td>
					<td><a href="http://{$smarty.server.SERVER_NAME}/get/id/{$Value->id}">редактировать</a></td>
					<td><a href="http://{$smarty.server.SERVER_NAME}/del/id/{$nameValue}">удалить</a></td>
				</tr>
				</tr>
				{foreachelse}
				<p>Вы еще не добавили объявлений</p>
			{/foreach}
			</tbody>
		</table>
	</div>
