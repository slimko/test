<?php
//основной класс по работе с объявлениями (запись, удаление, редактирование)
class IndexController {
	private $postAds = NULL; //массив пост
	private $Models; //переменная модели объявлений
	private $fc; //FrontController

	public function __construct($ads_post){
		if($ads_post!==null)$this->postAds=$ads_post;    //если есть $_POST пишем в свойство $postAds
		$this->Models = new Ads($this->postAds);		//инициализируем модель
		$this->fc = FrontController::getInstance();    //инициализируем фронт контроллер
	}

	/** метод срабатывающий при первом запуске программы или при отсутствии других параметров */
	function indexAction(){
		$ads = $this->Models->getAds(); //получаем объявления
		$this->fc->setBody($this->Models->render($ads)); //выводим пользователю результат (рендерим страницу)
	}

	/** метод обрабатывающий отправку формы  */
	function postAction(){
		$this->Models->postAds(); //добавляем нашу запись в базу данных
		$this->indexAction(); //продолжаем отображение данных и страницы
	}

	/** метод работающий при гет запросе - запросить запись на редактирование  */
	function getAction(){
		$ads = $this->Models->getAds(); //получем объявления
		$id = $this->fc->getParams();//получаем id редактируемой записи
		$this->fc->setBody($this->Models->render($ads,$id['id']));
			 //выводим пользователю результат (рендерим страницу)
	}

	/** метод работающий при гет запросе - удалить запись */
	function delAction(){
		$result=array();
		$id = $this->fc->getParams();//получаем id редактируемой записи
		if($this->Models->deleteBD($id['id'])){ //удаляем запись из базы данных
			$result['status']='success';
			$result['message']='Запись удалена';
		}else{
			$result['status']='error';
			$result['message']='Ошибка удаления записи';
		}
		echo json_encode($result);
	}

}
?>