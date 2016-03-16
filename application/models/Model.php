<?php
class Model{
	public $params; //параметры для выпадающих списков
	protected $db = null; // линк к БД

	function __construct(){
		//проверим заполнен ли конфигурационный файл с подключением к БД в случае ошибки перенаправим на установку
		//делаем такую проверку до подключения к БД
		if (!file_get_contents('base.conf')){
			header('Location: http://'.$_SERVER['HTTP_HOST'].'/install');
			exit;
		}
		$this->db=DatabaseConnection::getConnection(); //подключаемся к базе данных
	}



	//функция получает данные для формы (города и категории)
	function getDataBD(){
		//получаем возможные города для формы
		$params['city'] = $this->db->selectCol('SELECT id AS ARRAY_KEY, name FROM city ORDER by id ASC');
		//получаем возможные категории для формы
		$params['cat'] = $this->db->selectCol('SELECT t1.name AS ARRAY_KEY_1, t2.id AS ARRAY_KEY_2,t2.name FROM category AS t1 Left JOIN category as t2 ON t2.parent_id=t1.id WHERE t2.name is not null');

	    return $this->params = $params;
	}

	//главная функция вывода темплейта
	function render($adsFromBD=null,$id=null){
		/** создаем объект библиотеки вывода Смарти и настраиваем его **/
		$smarty = new Smarty(); //класс внешнего шаблонизатора
		$smarty_dir='./lib/smarty/';
		//настройки Смарти
		$smarty->compile_check = true;
		$smarty->debugging = false;
		$smarty->template_dir = './application/views';
		$smarty->compile_dir = $smarty_dir.'templates_c';
		$smarty->cache_dir = $smarty_dir.'cache';
		$smarty->config_dir = $smarty_dir.'configs';
		/** Закончили  **/

		//выводим основной шаблон
		$this->getDataBD();// получаем данные из базы для формы в виде массива
		if($id!=null){$smarty->assign('form_param',$adsFromBD[$id]); }//наполняем форму значениями при гете

		$smarty->assign('bd', $adsFromBD); //переменная для вывода всех объявлений
		$smarty->assign('options_city',$this->params['city']);
		$smarty->assign('options_cat',$this->params['cat']);
		$smarty->assign('radios', array(1 => 'Частное лицо', 2 => 'Компания'));
		$smarty->display('index.tpl');

	}

}
?>