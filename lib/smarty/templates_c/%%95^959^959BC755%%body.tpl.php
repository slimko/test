<?php /* Smarty version 2.6.28, created on 2016-03-17 02:26:36
         compiled from body.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'body.tpl', 3, false),array('modifier', 'escape', 'body.tpl', 104, false),array('function', 'html_radios', 'body.tpl', 7, false),array('function', 'html_options', 'body.tpl', 43, false),)), $this); ?>
	<div class="col-sm-7 col-md-6 col-lg-6" style="background-color: #e0f2f1;margin-top:15px;">
		<form action="http://<?php echo $_SERVER['SERVER_NAME']; ?>
/index/post" method="post" class="form-horizontal">
			<input type="hidden"  name="id"  value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['form_param']->id)) ? $this->_run_mod_handler('default', true, $_tmp) : smarty_modifier_default($_tmp)); ?>
">

			<div class="form-group">
				<div class="col-sm-offset-4 col-sm-8 radio">
					<?php echo smarty_function_html_radios(array('name' => 'private','options' => $this->_tpl_vars['radios'],'checked' => ((is_array($_tmp=@$this->_tpl_vars['form_param']->private)) ? $this->_run_mod_handler('default', true, $_tmp, 1) : smarty_modifier_default($_tmp, 1))), $this);?>

				</div>
			</div>

			<div class="form-group">
					<label for="first_name" class="col-sm-4 control-label">Ваше имя</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" maxlength="40" name="name" id="first_name" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['form_param']->name)) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" placeholder="Введите Ваше имя">
					</div>
			</div>
			<div class="form-group">
				<label for="email" class="col-sm-4 control-label">Электронная почта</label>
				<div class="col-sm-8">
					<input type="text" name="email" id="email" class="form-control" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['form_param']->email)) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
">
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-4 col-sm-8">
					<div class="checkbox">
						<label>
							<input type="checkbox" name="allow_mails" value="1" <?php if (((is_array($_tmp=@$this->_tpl_vars['form_param']->allow_mails)) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)) == '1'): ?>checked<?php endif; ?>> Я не хочу получать вопросы по объявлению на e-mail
						</label>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label for="fld_phone" class="col-sm-4 control-label">Номер телефона</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" name="phone" id="fld_phone" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['form_param']->phone)) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
">
				</div>
			</div>
			<div class="form-group">
				<label for="region" class="col-sm-4 control-label">Город</label>
				<div class="col-sm-8">
					<select name="city" class="form-control">
						<option value='null'>-- Выберите город --</option>
						<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['options_city'],'selected' => ((is_array($_tmp=@$this->_tpl_vars['form_param']->city)) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, ''))), $this);?>

						<option value='1000' <?php if ($this->_tpl_vars['form_param']->city == '1000'): ?>selected<?php endif; ?>>Другой город</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="fld_category_id" class="col-sm-4 control-label">Категория</label>
				<div class="col-sm-8">
					<select name="cat" class="form-control">
						<option value='null'>-- Выберите категорию --</option>
						<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['options_cat'],'selected' => ((is_array($_tmp=@$this->_tpl_vars['form_param']->cat)) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, ''))), $this);?>

					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="title_ad" class="col-sm-4 control-label">Название объявления</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" maxlength="50" name="title_ad" id="title_ad" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['form_param']->title_ad)) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
">
				</div>
			</div>
			<div class="form-group">
				<label for="description" class="col-sm-4 control-label">Описание объявления</label>
				<div class="col-sm-8">
					<textarea maxlength="3000" name="description" for="description" class="form-control" rows="3"><?php echo ((is_array($_tmp=@$this->_tpl_vars['form_param']->description)) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
</textarea>
				</div>
			</div>
			<div class="form-group">
				<label for="price" class="col-sm-4 control-label">Цена</label>
				<div class="col-sm-7">
					<input type="text" class="form-control" maxlength="9" name="price" id="price" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['form_param']->price)) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
">
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

	<span style="color:red;"><?php echo ((is_array($_tmp=@$this->_tpl_vars['price_error'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
</span>
		<h2>Доска объявлений:</h2>
		<div id="message" class="alert alert-success alert-dismissible" role="alert">
		</div>
				<table class="table table-hover">
			<thead>
				<th>#</th>
				<th>Название объявления</th>
				<th>Цена</th>
				<th colspan="2">Действие</th>
			</thead>
			<tbody>
			<?php $_from = $this->_tpl_vars['bd']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['nameValue'] => $this->_tpl_vars['Value']):
?>
				<tr>
					<td><?php echo $this->_tpl_vars['Value']->id; ?>
</td>
					<td><?php echo ((is_array($_tmp=$this->_tpl_vars['Value']->title_ad)) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
</td>
					<td><?php echo ((is_array($_tmp=$this->_tpl_vars['Value']->price)) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
 руб.</td>
					<td><a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>
/index/get/id/<?php echo $this->_tpl_vars['Value']->id; ?>
">редактировать</a></td>
					<td><a class="delete btn btn-default">удалить</a></td>

				</tr>
				</tr>
				<?php endforeach; else: ?>
				<p>Вы еще не добавили объявлений</p>
			<?php endif; unset($_from); ?>
			</tbody>
		</table>
	</div>