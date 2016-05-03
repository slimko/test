<?php /* Smarty version 2.6.28, created on 2016-05-03 20:48:04
         compiled from table_row.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'table_row.tpl.html', 3, false),)), $this); ?>
<tr>
    <td><?php echo $this->_tpl_vars['ads']['id']; ?>
</td>
    <td><?php echo ((is_array($_tmp=$this->_tpl_vars['ads']['title_ad'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
</td>
    <td><?php echo ((is_array($_tmp=$this->_tpl_vars['ads']['price'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
 руб.</td>
    <td><a class="edit">редактировать</a></td>
    <td><a class="delete btn btn-default">удалить</a></td>
</tr>