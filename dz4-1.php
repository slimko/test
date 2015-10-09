<?php

$ini_string='
[игрушка мягкая мишка белый]
цена = '.  mt_rand(1, 10).';
количество заказано = '.  mt_rand(1, 10).';
осталось на складе = '.  mt_rand(0, 10).';
diskont = diskont'.  mt_rand(0, 2).';
    
[одежда детская куртка синяя синтепон]
цена = '.  mt_rand(1, 10).';
количество заказано = '.  mt_rand(1, 10).';
осталось на складе = '.  mt_rand(0, 10).';
diskont = diskont'.  mt_rand(0, 2).';
    
[игрушка детская велосипед]
цена = '.  mt_rand(1, 10).';
количество заказано = '.  mt_rand(1, 10).';
осталось на складе = '.  mt_rand(0, 10).';
diskont = diskont'.  mt_rand(0, 2).';

[игрушка малая велосипед]
цена = '.  mt_rand(1, 10).';
количество заказано = '.  mt_rand(1, 10).';
осталось на складе = '.  mt_rand(0, 10).';
diskont = diskont'.  mt_rand(0, 2).';

';
$bd=parse_ini_string($ini_string, true);

//начало
//для начала проверяем сколько заказал детских велосипедов покупатель, если их больше или равно 3 то меняем скидку в массиве
echo '<h2>АКЦИЯ<br>При заказе товара "Игрушка детская велосипед" в количестве 3 и более штук Вы гарантированно получаете скидку 30%</h2>';
if(isset($bd['игрушка детская велосипед']) and $bd['игрушка детская велосипед']['количество заказано']>=3){
	$bd['игрушка детская велосипед']['diskont']='diskont3';

 }

global $general_total_price;//общая цена всех товаров

//разбираем массив с базы рекурсивная функция
function parse_bd($param,$mass=null) {

	foreach ($param as $k => $v) {
		if(is_array($v)){
			$a["name"]=$k; //назначаем имя товару
			$mass[]=(parse_bd($v,$a));
		}	
		else{
			$arr=parse_product($k,$v); //забиваем массив значениями через функцию parse_product
			foreach ($arr as $key => $value) { //заполняем массив с данными
			$mass[$key] = $value;
			}
		}
	} return $mass;
}

//функция определяет скидку согласно заданию от 10 до 30 %
function discont($v){
	switch ($v) {
		case 'diskont1':
			return 10;
			break;
		case 'diskont2':
			return 20;
			break;
		case 'diskont3':
			return 30;
			break;
		default:
			return 'нет скидки';
			break;
		}
}

function parse_product($k,$v){
	global $general_total_price;//общая цена всех товаров
	static $product_price=0; // цена товара
	static $product_quantity=0;//количество заказанного продукта
	static $product_sklad=0;//количество заказанного продукта
	static $diskont=0; //скидка на товар

	switch ($k) {
		
	 	case 'цена':
		 	$product_price=$v;
		 	break;
		 	 //записываем в глобальную переменную	
	 	case 'количество заказано':
	 		$product_quantity=$v;
	 		break;
			//return array($k => $v);//записываем в глобальную переменную 	
		case 'осталось на складе':
			$product_sklad=$v;
			if($product_quantity>$product_sklad){ 
				$v=$v."<br>На складе не хватает товара";
			}
			break;
		case 'diskont':
			$v=$diskont=discont($v);//выводим дисконт	
			break;	

	 	default:
	 		return array($k => $v); //выводим значение в таблицу
	 		
	}
	if ($diskont and $product_price and $product_quantity and $diskont){
		$total_price=($product_price*$product_quantity); //считаем общую сумму без учета скидки
		//ниже считаем скидку
		if($diskont!=='нет скидки'){
			$total_price=$total_price-($total_price*$diskont)/100; //цена со скидкой
		}
	$general_total_price+=$total_price;//состовляем глобальную переменную с общей ценой всех товаров
	$product_price=$product_quantity=$product_sklad=$diskont= 0; //обнуляем переменные
	return array($k => $v, 'окончательная цена'=>$total_price); //возвращаем массив
	}
	return array($k => $v); //возвращаем значения
}

//функция вывода корзины
function print_basket($array) {
	foreach ($array as $k => $v) {
		if(is_array($v)){
			echo '<tr>';
			print_basket($v);
		}	
		else{
			echo "<td>$v</td>";
		}
	}
	echo '</tr>';
}

//парсим базу данных через наши функции
$bd2=parse_bd($bd);
$quantity_tovar=count($bd2); //определяем количество заказанного товара

 

//выводим корзину
echo "<h2>Корзина</h2><p>Вы заказали {$quantity_tovar} товара:</p>";

//создаем таблицу корзины
echo '<table border="1" style="border:1px solid black;" cellpadding="10" cellspacing="0">
		<tr align="center">
			<th>Название товара</th>
			<th>цена</th>
			<th>количество заказано</th>
			<th>остаток товара на складе</th>
			<th>скидка</th>
			<th>окончательная цена (со скидкой)</th>
		</tr>
		<tbody align="center">';	
print_basket($bd2); //вызываем функцию вывода корзины - вставляем ячейки
echo '</tbody></table>';

echo '<h2>Общая сумма вашего заказа:  '.$general_total_price.' </h2>'; //общая цена



/*
 * 
 * - Вам нужно вывести корзину для покупателя, где указать: 
 * 1) Перечень заказанных товаров, их цену, кол-во и остаток на складе
 * 2) В секции ИТОГО должно быть указано: сколько всего наименовний было заказано, каково общее количество товара, какова общая сумма заказа
 * - Вам нужно сделать секцию "Уведомления", где необходимо извещать покупателя о том, что нужного количества товара не оказалось на складе
 * - Вам нужно сделать секцию "Скидки", где известить покупателя о том, что если он заказал "игрушка детская велосипед" в количестве >=3 штук, то на эту позицию ему 
 * автоматически дается скидка 30% (соответственно цены в корзине пересчитываются тоже автоматически)
 * 3) у каждого товара есть автоматически генерируемый скидочный купон diskont, используйте переменную функцию, чтобы делать скидку на итоговую цену в корзине
 * diskont0 = скидок нет, diskont1 = 10%, diskont2 = 20%
 * 
 * В коде должно быть использовано:
 * - не менее одной функции
 * - не менее одного параметра для функции
 * операторы if, else, switch
 * статические и глобальные переменные в теле функции
 * 

 */
?>