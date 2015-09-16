<?php
/*
 * Следующие задания требуется воспринимать как ТЗ (Техническое задание)
 * p.s. Разработчик, помни! 
 * Лучше уточнить ТЗ перед выполнением у заказчика, если ты что-то не понял, чем сделать, переделать, потерять время, деньги, нервы, репутацию.
 * Не забывай о навыках коммуникации :)
 */

 echo '<h1> Задание 1</h1>';
/* - Создайте переменную $name и присвойте ей значение содержащее ваше имя, например Игорь
  * - Создайте переменную $age и присвойте ей ваше количество лет, например 30
 * - Выведите на экран фразу по шаблону "Меня зовут Игорь"
 *                                      "Мне 30 лет"
 * Удалите переменные $name и $age
 */
 $name = "Ivan Markov";
 $age = 24;
 echo 'Меня зовут '.$name.'<br>Мне '.$age.' года<br>';

unset($name);
unset($age);

echo '<h1> Задание 2</h1>';
 /* - Создайте константу и присвойте ей значение города в котором живете
 * - Прежде чем выводить константу на экран, проверьте, действительно ли она объявлена и существует
 * - Выведите значение объявленной константы
 * - Попытайтесь изменить значение созданной константы
 */
define("SITY", "Voronezh");

if(SITY){
	echo SITY;
}
else{
	echo 'Значение константы не существует<br>';
}
echo '<br>';
if (defined("SITY")){ 
echo SITY;
}

define("SITY",'34'); //пробую изменить значение константы
echo SITY;


echo '<h1>Задание 3</h1>';
 /* - Создайте ассоциативный массив $book, ключами которого будут являться значения "title", "author", "pages"
 * - Заполните его по логике описания книг, укажите значения книги, которую недавно прочитали
 * - Выведите следующую строку на экран, следуя шаблону: "Недавно я прочитал книгу 'title', написанную автором author, я осилил все pages страниц, мне она очень понравилась"
 */

$book=array('book'=>'&laquo;Объектно-ориентированное программивание&raquo;','autor'=>'Максим Кузнецов','pages'=>608);
echo 'Недавно я прочитал книгу '.$book['book'].', написанную автором '.$book['autor'].', я осилил все '.$book['pages'].' страниц, мне она очень понравилась.';

 echo '<h1> Задание 4</h1>';
 /*  - Создайте индексный массив $books, который будет содержать в себе два массива $book1 и $book2, где будут записаны уже две последние прочитанные вами книги
 *  - Выведите следующую строку на экран, следуя шаблону: "Недавно я прочитал книги 'title1' и 'title2', 
 *  написанные соответственно авторами author1 и author2, я осилил в сумме pages1+pages2 страниц, не ожидал от себя подобного"

 */
$books=array(
	array(
		'book'=>'&laquo;Объектно-ориентированное программивание&raquo;','autor'=>'Максим Кузнецов','pages'=>608
	),
	array(
		'book'=>'&laquo;PHP - 10 минут на урок&raquo;','autor'=>'Крис Ньюман','pages'=>255
	)
);
echo '<br>';
echo 'Недавно я прочитал книги '.$books[0]['book'].' и '.$books[1]['book'].', написанные соответственно авторами '.$books[0]['autor'].' и '.$books[1]['autor'].', я осилил в сумме '.($books[0]['pages']+$books[1]['pages']).' страниц, не ожидал от себя подобного.';
?>