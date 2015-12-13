<?php
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
?>
