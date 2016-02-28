<?php
class InstallController{
    private $postAds = NULL; //массив пост
    private $db = null; // линк к БД

    public function __construct($ads_post){
        if($ads_post!==null)$this->postAds=$ads_post;
    }

    //функция установки (c костылями)
    function indexAction(){

        if(!$this->postAds){
            $view = new installView();
            $result=$view->render(); //показываем форму установки

        }else{
            $errMes = $this->postConfig($this->postAds); //получаем результат после проверки пост данных
            if(!empty($errMes)){
                $view = new installView();
                $result=$view->render($errMes); //показываем форму установки
            }
            else {
                $this->db = DatabaseConnection::getConnection();
                if (!is_object($this->db)){
                    $view = new installView();
                    $result = $view->render($this->db); //показываем форму установки
                }
                else{
                    header('Location: http://'.$_SERVER['HTTP_HOST']);
                }
            }
        }
        $fc=FrontController::getInstance();
        $fc->setBody($result);
    }

    //функция записи конфига при установке
    private function postConfig($post){
        if(empty($post['server_name'])){
            return "Заполните имя сервера";
        }
        elseif(empty($post['user_name'])){
            return "Заполните имя пользователя";
        }
        elseif(empty($post['database'])){
            return "Заполните имя базы данных";
        }

        $result = json_encode($post);

        if(file_put_contents('./base.conf',$result)===false){
            echo 'не могу создать конфигурационный файл';
        }
        return null;
    }
}

?>