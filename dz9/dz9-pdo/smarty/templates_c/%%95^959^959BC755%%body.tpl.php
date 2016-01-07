<?php /* Smarty version 2.6.28, created on 2016-01-07 21:37:14
         compiled from body.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'body.tpl', 3, false),array('modifier', 'escape', 'body.tpl', 43, false),array('function', 'html_radios', 'body.tpl', 5, false),array('function', 'html_options', 'body.tpl', 19, false),)), $this); ?>

<form action="index.php" method="post" class="contact_form">
		<input type="hidden"  name="id"  value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['form_param']['id'])) ? $this->_run_mod_handler('default', true, $_tmp) : smarty_modifier_default($_tmp)); ?>
">
	   	<div class="wrapper">
	   	<?php echo smarty_function_html_radios(array('name' => 'private','options' => $this->_tpl_vars['radios'],'checked' => ((is_array($_tmp=@$this->_tpl_vars['form_param']['private'])) ? $this->_run_mod_handler('default', true, $_tmp, 1) : smarty_modifier_default($_tmp, 1))), $this);?>

	   	</div>
	    <br>
	    <label for="name" class="input_name_label">Ваше имя</label>
	        <input type="text" class="input_text" maxlength="40" name="name" id="name" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['form_param']['name'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
"><br>
	    <label for="email" class="input_name_label">Электронная почта</label>
	        <input type="text" name="email" id="email" class="input_text" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['form_param']['email'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
"><br>
	    	    <label><input type="checkbox" name="allow_mails" value="1" <?php if ($this->_tpl_vars['form_param']['allow_mails'] == '1'): ?>checked<?php endif; ?>>Я не хочу получать вопросы по объявлению на e-mail</label>
	    <label for="fld_phone" class="input_name_label">Номер телефона</label> 
	        <input type="text" class="input_text" name="phone" id="fld_phone" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['form_param']['phone'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
"><br>
	    <label for="region" class="input_name_label">Город</label>
		<select name="city" class="input_text">
			<option value='null'>-- Выберите город --</option>
			<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['options_city'],'selected' => $this->_tpl_vars['form_param']['city']), $this);?>

			<option value='1000' <?php if ($this->_tpl_vars['form_param']['city'] == '1000'): ?>selected<?php endif; ?>>Другой город</option>
		</select>
	        <br>
	    <label for="fld_category_id"  class="input_name_label">Категория</label>
		<select name="cat" class="input_text">
			<option value='null'>-- Выберите категорию --</option>
	        <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['options_cat'],'selected' => $this->_tpl_vars['form_param']['cat']), $this);?>

		</select>
	    <br>
	    <label for="title_ad" class="input_name_label">Название объявления</label>
	        <input type="text" class="input_text" maxlength="50" name="title_ad" id="title_ad" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['form_param']['title_ad'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
"><br>
	    <label for="description"  class="input_name_label">Описание объявления</label>
	        <textarea maxlength="3000" name="description" for="description"><?php echo ((is_array($_tmp=@$this->_tpl_vars['form_param']['description'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
</textarea><br>
	    <label for="price"  class="input_name_label">Цена</label>
	    <input type="text" class="input_text" maxlength="9" name="price" id="price" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['form_param']['price'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
">
	        &nbsp;руб.<br>
	    <div class="wrapper"><button type="submit">Отправить</button><button type="reset">Очистить</button></div>
	</form>
<span style="color:red;"><?php echo ((is_array($_tmp=@$this->_tpl_vars['price_error'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
</span>	
	<h2>Объявления:</h2>
		<ul>
	<?php $_from = $this->_tpl_vars['bd']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['nameValue'] => $this->_tpl_vars['Value']):
?>
		<li><?php echo $this->_tpl_vars['Value']['id']; ?>
. <a href="?id=<?php echo $this->_tpl_vars['Value']['id']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['Value']['title_ad'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
</a> | <?php echo ((is_array($_tmp=$this->_tpl_vars['Value']['price'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
 руб. | <a href="?del=<?php echo $this->_tpl_vars['nameValue']; ?>
">удалить</a></li>
		<?php endforeach; else: ?>
		<p>Вы еще не добавили объявлений</p>
	<?php endif; unset($_from); ?>
	</ul>