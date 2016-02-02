<?php
class View{
	public $form = array("name"=>"","email"=>"","phone"=>"","title_ad"=>"","price"=>null,"description"=>"","city"=>NULL,"cat"=>NULL,"private"=>null,"allow_mails"=>NULL);
	public $params;
	private $db = null;

	function __construct(){
		$this->db=DatabaseConnection::getConnection();
	}

	//функция получает данные для формы и объявления в базе
	function getDataBD(){

		$params['city'] = $this->db->selectCol('SELECT id AS ARRAY_KEY, name FROM city ORDER by id ASC');
		$params['cat'] = $this->db->selectCol('SELECT t1.name AS ARRAY_KEY_1, t2.id AS ARRAY_KEY_2,t2.name FROM category AS t1 Left JOIN category as t2 ON t2.parent_id=t1.id WHERE t2.name is not null');
		$params['bd'] = $this->db->select('SELECT id AS ARRAY_KEY,id,name,email,phone,title_ad,price,description,city,cat,private,allow_mails FROM ad');

	    return $this->params = $params;
	}

	/**
	 * функция отвечающая за отправление в БД новых данных
	 */
	function postBD($data){
		$this->db->query('INSERT INTO ad(?#) VALUES(?a)', array_keys($data), array_values($data));
	}

	/**
	 * функция отвечающая за обновление в БД присланных через форму данных
	 */
	function updateBD($data,$id){
		$this->db->query('UPDATE ad SET ?a WHERE ad.id=?d', $data,$id);
	}

	/**
	 * функция отвечающая за удаление из БД данных
	 */
	function deleteBD($id){
		$this->db->query('DELETE FROM ad WHERE id=?', $id);
	}

	function render($getparams=null){
		$this->getDataBD();// получаем данные из базы для шаблона

		//создаем объект библиотеки вывода Смарти
		$smarty = new Smarty(); //класс внешнего шаблонизатора
		$smarty_dir='./lib/smarty/';
		//настройки смарти
		$smarty->compile_check = true;
		$smarty->debugging = false;
		$smarty->template_dir = './application/views';
		$smarty->compile_dir = $smarty_dir.'templates_c';
		$smarty->cache_dir = $smarty_dir.'cache';
		$smarty->config_dir = $smarty_dir.'configs';

		//проверяем наличие $_GET
		if($getparams){
			$this->form = $this->params['bd'][$getparams['id']];
		}
		$smarty->assign('form_param',$this->form);

		$smarty->assign('bd', $this->params['bd']);
		$smarty->assign('options_city',$this->params['city']);
		$smarty->assign('options_cat',$this->params['cat']);
		$smarty->assign('radios', array(1 => 'Частное лицо', 2 => 'Компания'));

		//выводим шаблон
		$smarty->display('index.tpl');

	}

}
?>