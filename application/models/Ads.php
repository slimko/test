<?php
class Ads extends Model{

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
       parent::__construct();
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

    /**  метод получает значения свойств */
    public function getFormParams(){
        return array('name' => $this->name, 'private' => $this->private, 'email' => $this->email, 'phone' => $this->phone, 'title_ad' => $this->title_ad, 'price' => $this->price, 'description' => $this->description, 'city' => $this->city, 'allow_mails' => $this->allow_mails, 'cat' =>$this->cat);
    }

    /**  получаем все объявления из БД */
    function getAdsFromBD(){
        $adsArray = $this->db->select('SELECT id AS ARRAY_KEY,id,name,email,phone,title_ad,price,description,city,cat,private,allow_mails FROM ad');
        return $adsArray;
    }

    /** метод получает все объявления */
    public function getAds(){
        $result = array();
        $ads = $this->db->select('SELECT id AS ARRAY_KEY,id,name,email,phone,title_ad,price,description,city,cat,private,allow_mails FROM ad');
        if ($ads != null) {
            foreach ($ads as $key => $value) {
                $user = new Ads( $value ); //!!!!!!!!!!!! вот этот момент меня волнует - мне кажется, так делать нельзя
                $result[$key] = $user;
            }
            return $result;
        }
    }

    /** метод определяет постить или обновлять в базе данные */
    function postAds(){
        if($this->id != null){ //проверяем наличие id у формы
            $this->updateBD($this->getFormParams(),$this->id); //отправляем в базу данных на обновление
        }
        else{
            $this->postBD($this->getFormParams()); //отправляем данные в базу данных на запись
        }
    }

    /** функция отвечающая за отправление в БД новых данных */
    function postBD($data){
        $this->db->query('INSERT INTO ad(?#) VALUES(?a)', array_keys($data), array_values($data));
    }

    /** функция отвечающая за обновление в БД присланных через форму данных */
    function updateBD($data,$id){
        $this->db->query('UPDATE ad SET ?a WHERE ad.id=?d', $data,$id);
    }

    /** функция отвечающая за удаление из БД данных */
    function deleteBD($id){
        $this->db->query('DELETE FROM ad WHERE id=?d', $id);
    }
}