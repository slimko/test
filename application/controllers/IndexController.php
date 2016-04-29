<?php
//основной класс по работе с объявлениями (запись, удаление, редактирование)
class IndexController {
	private $postAds = NULL; //массив пост
	private $modelAds; //переменная модели объявлений
	private $fc; //FrontController

	public function __construct($ads_post){
		if($ads_post!==null)$this->postAds=$ads_post;    //если есть $_POST пишем в свойство $postAds
		$this->modelAds = new Ads($this->postAds);		//инициализируем модель
		$this->fc = FrontController::getInstance();    //инициализируем фронт контроллер
	}

	/** метод срабатывающий при первом запуске программы или при отсутствии других параметров */
	function indexAction(){
		$ads = $this->modelAds->getAds(); //получаем объявления
		$this->fc->setBody($this->modelAds->render($ads)); //выводим пользователю результат (рендерим страницу)
	}

	/** метод обрабатывающий отправку формы  */
	function postAction(){
		$response = $this->modelAds->postAds(); //добавляем нашу запись в базу данных и получаем ответ
		$this->modelAds->renderTable($response);
	}

	/** метод работающий при гет запросе - запросить запись на редактирование  */
	function getAction(){
		$id = $this->fc->getParams();//получаем id редактируемой записи
		$ads = $this->modelAds->getAds($id['id']); //получем объявление для редактирования;

		$this->modelAds->renderEdit($ads); // отдаем объект объявления на рендер формы

		//$this->fc->setBody($this->modelAds->render($ads,$id['id']));
			 //выводим пользователю результат (рендерим страницу)
	}

	/** метод работающий при гет запросе - удалить запись */
	function delAction(){
		$params = $this->fc->getParams();//получаем id редактируемой записи
		$result = $this->modelAds->delAds($params['id']); //возвращает id удаленной записи
	}


}
?>