<?php /* Smarty version 2.6.28, created on 2016-05-07 17:18:01
         compiled from body.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'body.tpl', 6, false),array('modifier', 'escape', 'body.tpl', 24, false),)), $this); ?>
	<div class="col-sm-7 col-md-6 col-lg-6" id="forma" style="background-color: #e0f2f1;margin-top:15px;">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'form.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>
	<div class="col-sm-5 col-md-6 col-lg-6">

	<span style="color:red;"><?php echo ((is_array($_tmp=@$this->_tpl_vars['price_error'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
</span>
		<h2>Доска объявлений:</h2>
		<div id="message" class="alert alert-success" role="alert" style="display:none;">
			<button type="button" class="btn close" onclick="$('#message').hide();return false;"><span aria-hidden="true">&times;</span></button>
			<div id="message_info"></div>
		</div>
				<table class="table table-hover" id="ads">
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
					<td number="<?php echo $this->_tpl_vars['Value']->id; ?>
"><?php echo $this->_tpl_vars['Value']->id; ?>
</td>
					<td><?php echo ((is_array($_tmp=$this->_tpl_vars['Value']->title_ad)) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
</td>
					<td><?php echo ((is_array($_tmp=$this->_tpl_vars['Value']->price)) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
 руб.</td>
					<td><a class="edit">редактировать</a></td>
					<td><a class="delete btn btn-default">удалить</a></td>
				</tr>
				<?php endforeach; else: ?>
				<p>Вы еще не добавили объявлений</p>
			<?php endif; unset($_from); ?>
			</tbody>
		</table>
	</div>