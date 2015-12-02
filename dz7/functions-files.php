<?php
function template($templateName,$params){
   include_once($templateName);
}
//проверяем наличие кук на объявления, если есть, то записываем все в переменную $bd
function getBD(){
    $filename='./base.html';
        if(!fopen($filename,'a+')){
            echo "не могу создать и открыть файл";
            exit;
        }
        if ($content=file_get_contents($filename)){
            $bd = json_decode($content, true);
        }
        else{
            $bd = null; 
        }
        return $bd;
}
//отправляем в базу данные
function postBD($bd){
    $bd = json_encode($bd);
    file_put_contents('./base.html', $bd);
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
function show_ads($bd){ 
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
