<?php
class Model {
	private $params; //параметры для выпадающих списков
	protected $bd;
	private $smarty; //класс внешнего шаблонизатора
	function __construct(){
		$this->bd = DB::Conn(); //подключаемся к базе данных

		/** создаем объект библиотеки вывода Смарти и настраиваем его **/
		$this->smarty = new Smarty(); //класс внешнего шаблонизатора
		//настройки Смарти
		$this->smarty->compile_check = true;
		$this->smarty->debugging = false;
		$this->smarty->template_dir = './application/views';
		$this->smarty->compile_dir = './lib/smarty/templates_c';
		$this->smarty->cache_dir = './lib/smarty/cache';
		$this->smarty->config_dir = './lib/smarty/configs';
		/** Закончили  **/
	}
	//магические методы
	public function __get($property){
		return $this->$property;
	}
	/** функция отвечающая за отправление в БД новых данных */
	function postBD($tablename,$data){
		return $this->bd->query('INSERT INTO '.$tablename.'(?#) VALUES(?a)', array_keys($data), array_values($data));
	}

	/** функция отвечающая за обновление в БД присланных через форму данных */
	function updateBD($tablename,$data,$id){
		return $this->bd->query('UPDATE '.$tablename.' SET ?a WHERE '.$tablename.'.id=?d', $data,$id);
	}

	/** функция отвечающая за удаление из БД данных */
	function deleteBD($tablename,$id){
		if($this->bd->query('DELETE FROM '.$tablename.' WHERE id=?d', $id)){
			return $id;
		}
		else{
			return false;
		}
	}

	/**  функция получает данные для формы (города и категории) */
	function getDataBD(){
		//получаем возможные города для формы
		$params['city'] = $this->bd->selectCol('SELECT id AS ARRAY_KEY, name FROM city ORDER by id ASC');
		//получаем возможные категории для формы
		$params['cat'] = $this->bd->selectCol('SELECT t1.name AS ARRAY_KEY_1, t2.id AS ARRAY_KEY_2,t2.name FROM category AS t1 Left JOIN category as t2 ON t2.parent_id=t1.id WHERE t2.name is not null');

	    return $this->params = $params;
	}

	//главная функция вывода темплейта
	function render($adsFromBD=null,$id=null){

		$this->getDataBD();// получаем данные из базы для формы в виде массива
		if($id!=null){$this->smarty->assign('form_param',$adsFromBD[$id]); }//наполняем форму значениями при гете
		$this->smarty->assign('bd', $adsFromBD); //переменная для вывода всех объявлений
		$this->smarty->assign('options_city',$this->params['city']);
		$this->smarty->assign('options_cat',$this->params['cat']);
		$this->smarty->assign('radios', array(1 => 'Частное лицо', 2 => 'Компания'));
		$this->smarty->display('index.tpl');

	}
	function renderTable($response){

		$this->smarty->assign('ads',$response['ads']);
		$response['ads'] = $this->smarty->fetch('table_row.tpl.html');// добавляем таблицу со значениями
		echo json_encode($response);

	}
	/*Рисуем форму*/
	function renderForm($ads){

		$this->getDataBD();// получаем данные из базы для формы в виде массива
		$this->smarty->assign('options_city',$this->params['city']);
		$this->smarty->assign('options_cat',$this->params['cat']);
		$this->smarty->assign('radios', array(1 => 'Частное лицо', 2 => 'Компания'));

		$this->smarty->assign('form_param',$ads);
		$response = $this->smarty->fetch('form.tpl');// добавляем таблицу со значениями
		echo json_encode($response, JSON_HEX_QUOT| JSON_HEX_TAG| JSON_HEX_AMP| JSON_HEX_APOS| JSON_NUMERIC_CHECK| JSON_PRETTY_PRINT| JSON_UNESCAPED_SLASHES| JSON_FORCE_OBJECT| JSON_UNESCAPED_UNICODE);

	}
	function renderEdit($response){
		unset($response['bd']);
		echo json_encode($response, JSON_HEX_QUOT| JSON_HEX_TAG| JSON_HEX_AMP| JSON_HEX_APOS| JSON_NUMERIC_CHECK| JSON_PRETTY_PRINT| JSON_UNESCAPED_SLASHES| JSON_FORCE_OBJECT| JSON_UNESCAPED_UNICODE);
	}

}
?>