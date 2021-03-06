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
        parent::__construct(); //перезагружаем конструктор родителя чтобы получить линк к bd
        /** проходимся по переменным используемых в классе (самописный __set) */
        if($ads!=null) {
            foreach ($ads as $keys => $value){
                $this->$keys = $value;
            }
        }
    }

    /** магические методы */
    public function __get($property){
        return $this->$property;
    }

    /**  метод получает значения свойств */
    public function getFormParams(){
        return array('id'=>$this->id,'name' => $this->name, 'private' => $this->private, 'email' => $this->email, 'phone' => $this->phone, 'title_ad' => $this->title_ad, 'price' => $this->price, 'description' => $this->description, 'city' => $this->city, 'allow_mails' => $this->allow_mails, 'cat' =>$this->cat);
    }
    public function getid(){
        return $this->id;
    }
    /**Получение свойств объекта*/
    public function getParam(){
        return $this->title_ad;
    }

    /** метод получает массив объектов объявлений или одного объявления */
    public function getAds($id = null){
        $result = array();

            if($id){

                $ads = $this->bd->select('SELECT id AS ARRAY_KEY,id,name,email,phone,title_ad,price,description,city,cat,private,allow_mails FROM ad WHERE id='.$id);
                $result = new Ads($ads[$id]);
                return (get_object_vars($result));
            }else{
                $ads = $this->bd->select('SELECT id AS ARRAY_KEY,id,name,email,phone,title_ad,price,description,city,cat,private,allow_mails FROM ad');

                if ($ads != null) {
                    foreach ($ads as $key => $value) {
                        $user = new Ads( $value );
                        $result[$key] = $user;
                    }
                    return $result;
                }
            }
    }

    /** метод определяет постить или обновлять в базе данные */
    function postAds(){
        if($this->id != null and $this->id!=''){ //проверяем наличие id у формы, если нет, то:
            $id = $this->updateBD('ad',$this->getFormParams(),$this->id); //отправляем в базу данных на обновление
            $result = $this->createResponse($this->getid(),'update',$this->getFormParams()); //формируем ответ от сервера
            return $result;
        }
        else{
            $id = $this->postBD('ad', $this->getFormParams()); //отправляем новые данные в базу данных на запись и поучаем id новой записи
            $result = $this->createResponse($id,'insert',$this->getFormParams()); //формируем ответ от сервера
            return $result;
        }

    }

    function delAds($id){
        $result = $this->deleteBD('ad', $id); //возвращает id удаленной записи
        $result = $this->createResponse($result,'del'); //формируем ответ от сервера
        echo json_encode($result);

    }


    /** формируем ответ от сервера  */
    function createResponse($id,$method,$data=null){
        switch ($method) {
            case "insert": {
                if ($id) {
                    $result['status'] = 'insert';
                    $result['ads'] = $data;
                    $result['ads']['id'] = $id;
                    $result['message'] = "Товар #" . $id . " успешно добавлен";
                } else {
                    $result['status'] = 'error';
                    $result['message'] = "Ошибка обновления или вставки данных";
                }
                return $result;
                break;
            }
            case "update":{
                if($id){ //обновляем
                    $result['status']='update';
                    $result['message']='Запись №'.$id.' обновлена';
                    $result['id'] = $id;
                    $result['ads'] = $data;
                    $result['ads']['id'] = $id;
                }else{
                    $result['status']='error';
                    $result['message']='Ошибка обновления №'.$id.' обновлена';
                }
                return $result;
                break;
            }
            case "del":{
                if($id){ //удаляем запись из базы данных
                    $result['status']='success';
                    $result['message']='Запись №'.$id.' удалена';
                }else{
                    $result['status']='error';
                    $result['message']='Ошибка удаления №'.$id.' записи';
                }
                return $result;
                break;
            }
        }
    }
}