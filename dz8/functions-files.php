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

function clear_post($val){
    var_dump($val);
    if(is_array($val)){
        foreach ($val as $key => $value) {
            //$result[$key]=htmlentities($value, ENT_QUOTES);
            $input_text = trim($value);
            $result[$key] = htmlspecialchars($input_text);
            //$result[$key] = mysql_escape_string($input_text);
        }
    }
    else{
        //$result=htmlentities($val, ENT_QUOTES);
        $input_text = trim($val);
        $result = htmlspecialchars($input_text);
        //$result = mysql_escape_string($input_text);
    }
    return $result;  
}



?>