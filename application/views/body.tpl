	<div class="col-sm-7 col-md-6 col-lg-6" id="forma" style="background-color: #e0f2f1;margin-top:15px;">
		{include file='form.tpl'}
	</div>
	<div class="col-sm-5 col-md-6 col-lg-6">

	<span style="color:red;">{$price_error|default:''}</span>
		<h2>Доска объявлений:</h2>
		<div id="message" class="alert alert-success" role="alert" style="display:none;">
			<button type="button" class="btn close" onclick="$('#message').hide();return false;"><span aria-hidden="true">&times;</span></button>
			<div id="message_info"></div>
		</div>
		{* выводим объявления *}
		<table class="table table-hover" id="ads">
			<thead>
				<th>#</th>
				<th>Название объявления</th>
				<th>Цена</th>
				<th colspan="2">Действие</th>
			</thead>
			<tbody>
			{foreach from=$bd key=nameValue item=Value }
				<tr>
					<td number="{$Value->id}">{$Value->id}</td>
					<td>{$Value->title_ad|escape:htmlall:'UTF-8'}</td>
					<td>{$Value->price|escape:htmlall:'UTF-8'} руб.</td>
					<td><a class="edit">редактировать</a></td>
					<td><a class="delete btn btn-default">удалить</a></td>
				</tr>
				{foreachelse}
				<p>Вы еще не добавили объявлений</p>
			{/foreach}
			</tbody>
		</table>
	</div>
