<?php
//проверяем массив пост и добавляем в бд
if($_POST){
    $bd = getBD();//получаем данные из кук
    if(!empty($_POST['id'])){
        $i=$_POST['id'];
        $bd[$i]=$_POST;//помещаем данные из формы в переменную
        $post=serialize($bd); 
        setcookie ('ads',$post,time()+3600*24+7);
    }   
    else{
        $bd[]=$_POST;//помещаем данные из формы в бд
        $bd=serialize($bd);//сериализуем в строку
        setcookie ('ads',$bd,time()+3600*24+7);
    }
}
//проверяем гет id, если его нет заполняем форму пыстыми значениями
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $form_bd = getBD($id);
    $form_bd['id'] = $id;
}
else{
    $form_bd = array('private' => 0,'name' =>'','email' =>'','phone' =>'','city' =>'','cat' =>'','title' =>'','description' =>'','price' =>'','id' =>'');
}

//проверяем наличие кук мис объявления, если есть, то записываем все в переменную $bd
function getBD($id=null){
    if(isset($_COOKIE['ads'])){
        if($id!=null){
            $bd = unserialize($_COOKIE['ads']);
            return $bd[$id]; 
        }
        else{
            $bd = unserialize($_COOKIE['ads']);
            return $bd;
        }
    }else{
        $bd = null; 
        return $bd; //бд пустая
    } //переменная с базой данных
}

//функция выводит данные в select
function show_select($array,$number=null){
    foreach ($array as $k => $v){
        if(is_array($v)){
            echo '<optgroup label="'.$k.'">';
            show_select($v,$number);
            echo '</optgroup>';
        }   
        else{
            if($k==$number){$selected='selected';}else{$selected='';}
            echo '<option value="'.$k.'"'.$selected.'>'.$v.'</option>';
        }
    }
}
//функция выводит блок данных из бд: название|цену|удалить|
function show_ads(){ 
    $bd = getBD();//получаем данные из кук
    if(!empty($bd)){
        echo '<ul>';
        foreach ($bd as $k => $v) {
            echo '<li>'.$k.'. <a href="?id='.$k.'">'.$v['title'].'</a> | '.$v['price'].' руб. | <a href="?del='.$k.'">удалить</a></li>';
        }
    echo '</ul>';
    }else{
        echo '<p>Вы еще не добавили ни одного объявления</p>';
    }
}



?>
