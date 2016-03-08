<?php
class Ads extends Model{

    //получаем объявления из БД
    function getAdsBD(){
        $params = $this->db->select('SELECT id AS ARRAY_KEY,id,name,email,phone,title_ad,price,description,city,cat,private,allow_mails FROM ad');
        return $params;
    }

    //функция получает данные для формы
    function getDataBD(){
        //получаем возможные города для формы
        $params['city'] = $this->db->selectCol('SELECT id AS ARRAY_KEY, name FROM city ORDER by id ASC');
        //получаем возможные категории для формы
        $params['cat'] = $this->db->selectCol('SELECT t1.name AS ARRAY_KEY_1, t2.id AS ARRAY_KEY_2,t2.name FROM category AS t1 Left JOIN category as t2 ON t2.parent_id=t1.id WHERE t2.name is not null');

        return $this->params = $params;
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