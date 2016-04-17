<?php /* Smarty version 2.6.28, created on 2016-04-17 14:07:34
         compiled from form.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'form.tpl', 2, false),array('function', 'html_radios', 'form.tpl', 5, false),array('function', 'html_options', 'form.tpl', 41, false),)), $this); ?>
<form class="form-horizontal" id="myform" method="post" action="http://<?php echo $_SERVER['SERVER_NAME']; ?>
/index/post">
    <input type="hidden"  class="form-control" name="id"  value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['form_param']->id)) ? $this->_run_mod_handler('default', true, $_tmp) : smarty_modifier_default($_tmp)); ?>
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