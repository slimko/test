<?php
class Model{
	protected $params; //параметры для выпадающих списков
	//private $db = null; // линк к БД

	function __construct(){

		//$this->db=DB::Conn(); //подключаемся к базе данных
	}
	//магические методы
	public function __get($property){
		return $this->$property;
	}
	/** функция отвечающая за отправление в БД новых данных */
	function postBD($tablename,$data){
		return DB::Conn()->query('INSERT INTO '.$tablename.'(?#) VALUES(?a)', array_keys($data), array_values($data));
	}

	/** функция отвечающая за обновление в БД присланных через форму данных */
	function updateBD($tablename,$data,$id){
		return DB::Conn()->query('UPDATE '.$tablename.' SET ?a WHERE '.$tablename.'.id=?d', $data,$id);
	}

	/** функция отвечающая за удаление из БД данных */
	function deleteBD($tablename,$id){
		if(DB::Conn()->query('DELETE FROM '.$tablename.' WHERE id=?d', $id)){
			return $id;
		}
		else{
			return false;
		}
	}

	/**  функция получает данные для формы (города и категории) */
	function getDataBD(){
		//получаем возможные города для формы
		$params['city'] = DB::Conn()->selectCol('SELECT id AS ARRAY_KEY, name FROM city ORDER by id ASC');
		//получаем возможные категории для формы
		$params['cat'] = DB::Conn()->selectCol('SELECT t1.name AS ARRAY_KEY_1, t2.id AS ARRAY_KEY_2,t2.name FROM category AS t1 Left JOIN category as t2 ON t2.parent_id=t1.id WHERE t2.name is not null');

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
	function renderTable($response){
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

		$smarty->assign('ads',$response['ads']);
		$response['ads'] = $smarty->fetch('table_row.tpl.html');// добавляем таблицу со значениями
		echo json_encode($response);

	}
	function renderForm($ads){
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

		$this->getDataBD();// получаем данные из базы для формы в виде массива
		$smarty->assign('options_city',$this->params['city']);
		$smarty->assign('options_cat',$this->params['cat']);
		$smarty->assign('radios', array(1 => 'Частное лицо', 2 => 'Компания'));

		$smarty->assign('form_param',$ads);
		$response = $smarty->fetch('form.tpl');// добавляем таблицу со значениями
		echo json_encode($response, JSON_HEX_QUOT| JSON_HEX_TAG| JSON_HEX_AMP| JSON_HEX_APOS| JSON_NUMERIC_CHECK| JSON_PRETTY_PRINT| JSON_UNESCAPED_SLASHES| JSON_FORCE_OBJECT| JSON_UNESCAPED_UNICODE);

	}

}
?>