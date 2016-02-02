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
		if(!empty($this->db->error)){
			echo '<p>Подключение к базе данных не выполнено. Выполните <a href="./install">установку</a> скрипта!</p>';
			exit;
		}
		// Дальше работаем с соединением (или текущей транзакцией) $DB.
		// Устанавливаем обработчик ошибок.
		//$this->db->setErrorHandler('databaseErrorHandler');

		$this->db->query("SET NAMES UTF8");
	}
	//неработающи обработчик ошибок
	function databaseErrorHandler($message, $info){
		// Если использовалась @, ничего не делать.
		if (!error_reporting()) return;
		// Выводим подробную информацию об ошибке.
		echo "SQL Error: $message<br><pre>";
		print_r($info);
		echo "</pre>";
		exit();
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