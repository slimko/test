<?php
//основной класс по работе с объявлениями (запись, удаление, редактирование)
class IndexController {
	private $postAds = NULL; //массив пост
	private $ViewModels; //переменная модели

	public function __construct($ads_post){
		if($ads_post!==null)$this->postAds=$ads_post;
		$this->ViewModels = new View(); //инициализируем модель
	}

	//метод срабатывающий при первом запуске программы или при отсутствии других параметров
	function indexAction(){
		$main = StorageController::getInstance(); //подключаемся к хранилищу
		$ads = $main->getAdsFromBD(); //получаем данные объявлений из хранилища
		$fc=FrontController::getInstance();
		$fc->setBody($this->ViewModels->render($ads)); //выводим пользователю результат (рендерим страницу)
	}

	//метод обрабатывающий отправку формы
	function postAction(){
		$ads = new AdsController($this->postAds); //вызываем класс по работе с объявлениями и передаем ему наш ПОСТ массив
			$ads->postAds(); //добавляем нашу запись в базу данных
		$this->indexAction(); //продолжаем отображение данных и страницы
	}

	//метод работающий при гет запросе - запросить запись на редактирование
	function getAction(){
		$main = StorageController::getInstance(); //подключаемся к хранилищу
		$ads = $main->getAdsFromBD(); //получаем данные объявлений из хранилища
		$fc=FrontController::getInstance();
		$getId = $fc->getParams();//получаем id
		$fc->setBody($this->ViewModels->render($ads,$getId['id'])); //выводим пользователю результат (рендерим страницу)
	}

	//метод работающий при гет запросе - удалить запись
	function delAction(){

		$fc=FrontController::getInstance();
		$delId = $fc->getParams();//получаем id
		$ads = new AdsController(); //вызываем класс по работе с объявлениями
		$ads->deleteAds($delId['id']); //удаляем запись из базы
		$main = StorageController::getInstance(); //подключаемся к хранилищу
		$ads = $main->getAdsFromBD(); //получаем данные объявлений из хранилища
		$fc->setBody($this->ViewModels->render($ads)); //выводим пользователю результат (рендерим страницу)

	}


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
		$bd = json_encode($bd);
		if(file_put_contents('./base.conf',$bd)===false){
			echo 'не могу создать конфигурационный файл';
		}
	}

}
?>