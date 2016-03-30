<?php /* Smarty version 2.6.28, created on 2016-02-28 19:11:54
         compiled from install.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'config_load', 'install.tpl', 1, false),)), $this); ?>
<?php echo smarty_function_config_load(array('file' => 'example.conf'), $this);?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="col-sm-12 col-md-12 col-lg-12">
    <?php if (isset ( $this->_tpl_vars['error'] )): ?>
        <div class="alert alert-danger " role="alert"><h4 class="text-center"><?php echo $this->_tpl_vars['error']; ?>
</h4></div>
    <?php endif; ?>
    <h3 class="text-center">Укажите параметры для подключения к Вашей базе данных</h3>
    <form action="http://<?php echo $_SERVER['SERVER_NAME']; ?>
/install" method="post" class="form-horizontal">
        <div class="form-group">
            <label for="server_name" class="col-sm-4  col-md-4 control-label">Server name:</label>
            <div class="col-sm-4  col-md-4">
                <input type="text" class="form-control" maxlength="40" name="server_name" id="server_name" value="" placeholder="Введите адрес сервера">
            </div>
        </div>
        <div class="form-group">
            <label for="user_name" class="col-sm-4  col-md-4 control-label">User name:</label>
            <div class="col-sm-4  col-md-4">
                <input type="text" class="form-control" maxlength="40" name="user_name" id="user_name" value="" placeholder="Введите имя пользователя базы данных">
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="col-sm-4  col-md-4 control-label">Password:</label>
            <div class="col-sm-4  col-md-4">
                <input type="password" class="form-control" maxlength="40" name="password" id="password" value="" placeholder="Введите пароль от базы данных">
            </div>
        </div>
        <div class="form-group">
            <label for="database" class="col-sm-4  col-md-4 control-label">Database:</label>
            <div class="col-sm-4  col-md-4">
                <input type="text" class="form-control" maxlength="40" name="database" id="database" value="" placeholder="Введите название базы данных">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-4 col-sm-6">
                <button type="submit" class="btn btn-primary col-sm-3">Установить</button>
                <button type="reset" class="btn btn-default col-sm-3 col-sm-offset-1">Очистить</button>
            </div>
        </div>
        </form>
    </div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>