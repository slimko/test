<?php
error_reporting(E_ERROR|E_WARNING|E_PARSE|E_NOTICE);
ini_set('display_errors',1);
/*
 * Следующие задания требуется воспринимать как ТЗ (Техническое задание)
 * p.s. Разработчик, помни! 
 * Лучше уточнить ТЗ перед выполнением у заказчика, если ты что-то не понял, чем сделать, переделать, потерять время, деньги, нервы, репутацию.
 * Не забывай о навыках коммуникации :)
 * 
 * Задание 1
 */
echo '<h3>1. Создайте массив $date с пятью элементами</h3>';
 	$date = array(1,2,3,4,5);
 	echo '<pre>';
 	print_r($date);
 	echo '</pre>';
 
echo '<h3>2. C помощью генератора случайных чисел забейте массив $date юниксовыми метками</h3>';

function arr_date($date){
	return $dat[] = rand(1, time());
	//return $dat[$date] = date('d m Y', $date);
	//$dat[$date] = rand(1, time());
	//echo '<br>';
}
$date=array_map('arr_date',$date);
echo '<pre>';
print_r($date); 
echo '</pre>';

echo '<h3>3. Сделайте вывод сообщения на экран о том, какой день в сгенерированном массиве получился наименьшим, а какой месяц наибольшим</h3>';
//прогоняем  через функцию временную метку
function dateTod($timestamp){
	return $day[] = idate('d', $timestamp);
}
$day=array_map('dateTod',$date); //получаем данные в массив day
//выводим наименьший день
echo 'Наименьший в сгенерированном массиве день - '.min($day);
echo '<br>';

//прогоняем  через функцию временную метку
function dateToMonth($timestamp){
	return $day[] = date('F', $timestamp);
}
$month=array_map('dateToMonth',$date); //получаем данные в массив day
echo 'Наибольший в сгенерированном массиве месяц - '.max($month);
 
echo '<h3>4. Отсортируйте массив по возрастанию дат</h3>';

//функция преобразует временные метки в формат: день месяц год
function dateTodFY($date){
	return $d[] = date('d F Y',$date);
}
//сортируем массив по возрастанию
sort($date);
//преобразуем массив в формат: день месяц год
$dates=array_map('dateTodFY',$date);
//выводим на экран резулльтат
echo '<pre>';
print_r($dates); 
echo '</pre>';

echo '<h3>5. С помощью функция для работы с массивами извлеките последний элемент массива в новую переменную $selected</h5>';
// извлекаем последний элемент из массива дат в новую переменную
$selected=array_pop($date);
//выводим на экран
echo '$selected='.$selected;


echo '<h3>6. C помощью функции date() выведите $selected на экран в формате "дд.мм.ГГ ЧЧ:ММ:СС"</h3>';
echo date('d.m.Y g:i:s a',$selected);
echo '<h3>7. Выставьте часовой пояс для Нью-Йорка, и сделайте вывод снова, чтобы проверить, что часовой пояс был изменен успешно</h3>';

date_default_timezone_set('America/New_York');
echo 'А тем временем в New York '.date('d.m.Y g:i:s a',$selected);
 ?>