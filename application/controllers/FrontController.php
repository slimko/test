<?php
class FrontController {
	protected $_controller, $_action, $_params, $_body;
	static $_instance;
	public static function getInstance(){
		if(!(self::$_instance instanceOf self))
			self::$_instance = new self();
		return self::$_instance;
	}
	private function __construct(){
		$request = $_SERVER['REQUEST_URI'];
		//собираем массив с url
		$splits = explode ('/',trim($request,'/'));
		//выбор контроллера
		$this->_controller = 'IndexController'; // выбираем контроллер. (код для расширения функционала - !empty($splits[0])?ucfirst($splits[0]).'Controller':)
		//выбор метода
		$this->_action = !empty($splits[0])?$splits[0].'Action':'indexAction';
		//параметры
		if(!empty($splits[1])){
			$keys = $values = array();
			for ($i=1,$cnt=count($splits);$i<$cnt;$i++){
				if($i%2==0)
					//Четное = ключ (параметр)
					$values[]=$splits[$i];
				else
					//Значение параметра
					$keys[]=$splits[$i];
			}
			if($keys and $values !=NULL){
				$this->_params = array_combine($keys,$values);
			}else{
				$this->_params=null;
			}
		}
	}
	public function route(){
		if(class_exists($this->getController())){
			$rc = new ReflectionClass($this->getController());
			if($rc->hasMethod($this->getAction())){
				$controller = $rc->newInstance($_POST);
				$method = $rc->getMethod($this->getAction());
				$method->invoke($controller);

			}else{
				echo "Error";
				throw new Exception('Wrong Action');
			}
		}else{
			echo "Error";
			throw new Exception('Wrong Controller');
		}
	}
	function getParams(){
		return $this->_params;
	}
	function getController(){
		return $this->_controller;
	}
	function getAction(){
		return $this->_action;
	}
	function getBody(){
		return $this->_body;
	}
	function setBody($body){
		$this->_body=$body;
	}

}
?>