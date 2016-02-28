<?php

class AdsController{
    private $id = 'null';
    private $name = 'null';
    private $email = 'null';
    private $phone = 'null';
    private $title_ad = 'null';
    private $price = 'null';
    private $description = 'null';
    private $city = 'null';
    private $allow_mails = 'null';
    private $cat = 'null';
    private $private = 'null';

    public function __construct($ads=null){
        /** проходимся по переменным используемых в классе (самописный __set) */
        if($ads!=null) {
            foreach ($ads as $keys => $value){
               $this->$keys = $value;
            }
        }
    }
    //магические методы
    public function __get($property){
        return $this->$property;
    }

    //метод получает переменные участвующие в форме
    public function getFormParams(){
        return array('name' => $this->name, 'private' => $this->private, 'email' => $this->email, 'phone' => $this->phone, 'title_ad' => $this->title_ad, 'price' => $this->price, 'description' => $this->description, 'city' => $this->city, 'allow_mails' => $this->allow_mails, 'cat' =>$this->cat);
    }

    //функция обновляет и постит в базу данные из формы
    function postAds(){
        $ViewModels = new Ads(); //инициализируем модель
        if($this->id != null){ //проверяем наличие id у формы
            $ViewModels->updateBD($this->getFormParams(),$this->id); //отправляем в базу данных на обновление
        }
        else{
            $ViewModels->postBD($this->getFormParams()); //отправляем данные в базу данных на запись
        }
    }
    //функция удаляет данные из базы
    function deleteAds($id){
        $ViewModels = new Ads(); //инициализируем модель
        $ViewModels->deleteBD($id);
    }

}