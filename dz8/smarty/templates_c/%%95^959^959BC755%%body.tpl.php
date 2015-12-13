<?php /* Smarty version 2.6.28, created on 2015-12-13 23:38:42
         compiled from body.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_radios', 'body.tpl', 5, false),array('function', 'html_checkboxes', 'body.tpl', 12, false),array('function', 'html_options', 'body.tpl', 16, false),array('modifier', 'default', 'body.tpl', 12, false),)), $this); ?>

<form action="dz8.php" method="post" class="contact_form"> 
		<input type="hidden"  name="id"  value="<?php echo $this->_tpl_vars['form_param']['id']; ?>
">
	   	<div class="wrapper">
	   	<?php echo smarty_function_html_radios(array('name' => 'private','options' => $this->_tpl_vars['radios'],'checked' => $this->_tpl_vars['form_param']['private']), $this);?>

	   	</div>
	    <br>
	    <label for="name" class="input_name_label">Ваше имя</label>
	        <input type="text" class="input_text" maxlength="40" name="name" id="name" value="<?php echo $this->_tpl_vars['form_param']['name']; ?>
"><br>
	    <label for="email" class="input_name_label">Электронная почта</label>
	        <input type="text" name="email" id="email" class="input_text" value="<?php echo $this->_tpl_vars['form_param']['email']; ?>
"><br>
	    <?php echo smarty_function_html_checkboxes(array('name' => 'allow_mails','values' => '1','output' => "Я не хочу получать вопросы по объявлению по e-mail",'checked' => ((is_array($_tmp=@$this->_tpl_vars['form_param']['allow_mails'])) ? $this->_run_mod_handler('default', true, $_tmp, '0') : smarty_modifier_default($_tmp, '0')),'labels' => 'true'), $this);?>

	    <label for="fld_phone" class="input_name_label">Номер телефона</label> 
	        <input type="text" class="input_text" name="phone" id="fld_phone" value="<?php echo $this->_tpl_vars['form_param']['phone']; ?>
"><br>
	    <label for="region" class="input_name_label">Город</label>
	    	<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['options_city'],'selected' => $this->_tpl_vars['form_param']['city'],'class' => 'input_text','name' => 'city'), $this);?>
    
	        <br>
	    <label for="fld_category_id"  class="input_name_label">Категория</label>
	        <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['options_cat'],'selected' => $this->_tpl_vars['form_param']['cat'],'class' => 'input_text','name' => 'cat'), $this);?>

	    <br>
	    <label for="title" class="input_name_label">Название объявления</label>
	        <input type="text" class="input_text" maxlength="50" name="title" id="title" value="<?php echo $this->_tpl_vars['form_param']['title']; ?>
"><br>
	    <label for="description"  class="input_name_label">Описание объявления</label>
	        <textarea maxlength="3000" name="description" for="description"><?php echo $this->_tpl_vars['form_param']['description']; ?>
</textarea><br>
	    <label for="price"  class="input_name_label">Цена</label>
	    <input type="text" class="input_text" maxlength="9" name="price" id="price" value="<?php echo $this->_tpl_vars['form_param']['price']; ?>
">
	        &nbsp;руб.<br>
	    <div class="wrapper"><button type="submit">Отправить</button><button type="reset">Очистить</button></div>
	</form>
	<h2>Объявления:</h2>
		<ul>
	<?php $_from = $this->_tpl_vars['bd']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['nameValue'] => $this->_tpl_vars['Value']):
?>
		<li><?php echo $this->_tpl_vars['nameValue']; ?>
. <a href="?id=<?php echo $this->_tpl_vars['nameValue']; ?>
"><?php echo $this->_tpl_vars['Value']['title']; ?>
</a> | <?php echo $this->_tpl_vars['Value']['price']; ?>
 руб. | <a href="?del=<?php echo $this->_tpl_vars['nameValue']; ?>
">удалить</a></li>
		<?php endforeach; else: ?>
		<p>Вы еще не добавили объявлений</p>
	<?php endif; unset($_from); ?>
	</ul>