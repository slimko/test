<?php
class StorageController {
    private static $_instance = NULL;
    private $ads = array(); // хранилище наших объявлений

    public static function getInstance(){
        if(!(self::$_instance instanceOf self))
            self::$_instance = new self();
        return self::$_instance;
    }
    //добавляем в массив $ads (хранилище) объявления
    public function addAds(AdsController $ad){
        if(!($this instanceof StorageController)){
            die('Нельзя использовать этот методод конструктора класса');
        }
        $this->ads[$ad->id]=$ad; //заполняем массив $ads объявлениями
    }

    //функция заполняет массив $ads объявлениями из базы  и отдает нам
    public function getAdsFromBD(){
        $view = new View();  //вызываем модель для запроса
            $all = $view->getAdsBD(); //запрос в базу данных
        foreach ($all as $value){
            $ad = new AdsController ($value); //создаем экземпляр класса объявлений
            self::addAds($ad); // добавляем объекты в хранилище
        }
        return $this->ads;
    }
}
?>