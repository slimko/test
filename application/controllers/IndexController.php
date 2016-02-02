<?php
class IndexController {
	//функция установки
	function installAction(){
		if(!$_POST){
			$view = new installView();
			$result=$view->install();
		}else{
			$this->postConfig($_POST);
			$view = new View();
			$result=$view->render();
		}

		$fc=FrontController::getInstance();
		$fc->setBody($result);
	}
	//функция записи конфига при установке
	private function postConfig($post){
		$bd = array("server_name"=>null,"user_name"=>null,"password"=>null,"database"=>null);
		foreach ($post as $k=>$v) {
			if(!$v==''){
				$bd[$k]=$v;
			}else{
				$bd[$k]='nodata';
			}
		}
		//echo '<b>';print_r($bd);echo '</b>';
		//echo '<br>';
		$bd = json_encode($bd);
		//print_r($this->bd);
		if(file_put_contents('./base.conf',$bd)===false){
			echo 'не могу создать конфигурационный файл';
		}
	}

	function indexAction(){
		$view = new View();
		$result=$view->render();
		$fc=FrontController::getInstance();
		$fc->setBody($result);
	}

	function postAction(){
		$view = new View();

		if($_POST){
			if(is_numeric($_POST['price'])){
				if($_POST['id']){ //проверяем наличие id у формы
					$result = array_replace ($view->form, $_POST);
					unset($result['id']); //вырезаем id
					$view->updateBD($result,$_POST['id']); //отправляем в базу данных на обновление
				}
				else{
					unset($_POST['id']); //вырезаем id
					$view->postBD($_POST); //отправляем данные в базу данных
			}

			}
			else{
				$this->form = array_replace ($view->form, $_POST);
				$smarty->assign('price_error', 'Введите корректную сумму!');
			}
		}


		$result=$view->render();
		$fc=FrontController::getInstance();
		$fc->setBody($result);
	}
	function getAction(){

		$fc=FrontController::getInstance();
		$view = new View();

			if(!empty($fc->getParams())){
				$result=$view->render($fc->getParams());
			}
			else {
				$result = $view->render();
			}

		$fc->setBody($result);
	}
	function delAction(){
		$fc=FrontController::getInstance();
		$view = new View();
		$params = $fc->getParams();
			$view->deleteBD($params['id']);

		$result = $view->render();
		$fc->setBody($result);
	}
}
?>