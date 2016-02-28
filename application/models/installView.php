<?php
class installView{
    function install(){
        $smarty = new Smarty(); //класс внешнего шаблонизатора
        $smarty_dir='./lib/smarty/';
        //настройки смарти
        $smarty->compile_check = true;
        $smarty->debugging = false;
        $smarty->template_dir = './application/views';
        $smarty->compile_dir = $smarty_dir.'templates_c';
        $smarty->cache_dir = $smarty_dir.'cache';
        $smarty->config_dir = $smarty_dir.'configs';
        //выводим шаблон
        $smarty->display('install.tpl');
    }
}
?>