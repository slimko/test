<?php
class DB{
	private $db = NULL;
	private static $instance = NULL;
	private $_conf; //конфиг для подключения к бд

	private function __construct(){
		require_once "./lib/dbsimple/config.php";
		require_once "./lib/dbsimple/DbSimple/Generic.php";
		//проверим заполнен ли конфигурационный файл с подключением к БД в случае ошибки перенаправим на установку
		if (!file_get_contents('base.conf')){
			header('Location: http://'.$_SERVER['HTTP_HOST'].'/install');
			exit;
		}
		$this->getConfig();//получаем конфиг к подключению к базе данных

		$this->db = DbSimple_Generic::connect("mysql://{$this->_conf['user_name']}:{$this->_conf['password']}@{$this->_conf['server_name']}/{$this->_conf['database']}");

		//в случае возникновения ошибки
		if(!empty($this->db->error)){
			$this->db = $this->databaseError($this->db->error['code'],$this->db->error['message']);
			return $this->db;
		}
		$this->db->query("SET NAMES UTF8");
	}
	private function __clone() {
		// ограничивает клонирование объекта
	}
	private function __wakeup() {
		// ограничивает дублирование объекта
	}

	//обработчик ошибок
	function databaseError($code,$message){
		switch ($code) {
			case 2005:
				return $message;
				break;
			case 1045:
				return $message;
				break;
			case 1046:
				return $message;
				break;
			case 1049:
				return $message;
				break;
		}
	}

	// получаем коннект к базе если его нет. статический метод
	public static function Conn(){
		if(!(self::$instance instanceOf self)){
			self::$instance = new self();
		}
		return self::$instance->db;
	}
	//функция получает из конфига данные для входа в базу данных
	private function getConfig(){
		$filename='./base.conf';
		if(!fopen($filename,'r')){
			echo "не могу открыть файл конфигурации";
			exit;
		}
		if ($content=file_get_contents($filename)){
			$this->_conf = json_decode($content, true);
		}
		else{
			$this->_conf = null;
		}
		return $this->_conf;
	}

}
?>