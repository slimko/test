<?php
class DatabaseConnection{
	public $db = NULL;
	private static $instance = NULL;
	protected $_conf;

	private function __construct(){
		require_once "./lib/dbsimple/config.php";
		require_once "./lib/dbsimple/DbSimple/Generic.php";

		$config = $this->getConfig();//получаем конфиг к подключению к базе данных
		$this->db = DbSimple_Generic::connect("mysql://{$config['user_name']}:{$config['password']}@{$config['server_name']}/{$config['database']}");
		//в случае возникновения ошибки
		if(!empty($this->db->error)){
			$this->db = $this->databaseError($this->db->error['code'],$this->db->error['message']);
			return $this->db;
		}
		$this->db->query("SET NAMES UTF8");
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
	public static function getConnection(){
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