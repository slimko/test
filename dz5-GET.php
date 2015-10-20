<?php

//GET

$news='Четыре новосибирские компании вошли в сотню лучших работодателей
Выставка университетов США: открой новые горизонты
Оценку «неудовлетворительно» по качеству получает каждая 5-я квартира в новостройке
Студент-изобретатель раскрыл запутанное преступление
Хоккей: «Сибирь» выстояла против «Ак Барса» в пятом матче плей-офф
Здоровое питание: вегетарианская кулинария
День святого Патрика: угощения, пивной теннис и уличные гуляния с огнем
«Красный факел» пустит публику на ночные экскурсии за кулисы и по закоулкам столетнего здания
Звезды телешоу «Голос» Наргиз Закирова и Гела Гуралиа споют в «Маяковском»';
$news=  explode("\n", $news);
//print_r($news);

// точка входа на сайт.
function show_news($data) {
	if($_GET==null){	
		show_all_news($data);//показываем все новости	
	}
	elseif (isset($_GET['id'])) {
		$id=$_GET['id']; //забираем id новости
		show_current_news($data,$id); //показываем новость по id
	}
	else{
		header("HTTP/1.1 404 Not Found");
		header('Location: /404.html');
		exit();
	}


}
// Функция вывода всего списка новостей.
function show_all_news($data) {
	echo '<br><ol>';
	foreach ($data as $k => $v) {	
			echo '<li><a href="?id='.$k.'">'.$v.'</a></li>';		
	}
	echo '</ol>';
}

// Функция вывода конкретной новости.
function show_current_news($data,$id) {
	if (array_key_exists($id, $data)) {
	echo '<h3>'.$data[$id].'</h3>';
	echo '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras egestas auctor enim, eu rutrum lacus consequat ac. Pellentesque hendrerit metus ac tellus mollis accumsan. Nunc eget orci eu justo placerat aliquet. Nam massa nisl, pretium in feugiat vel, consequat ac ipsum. Nullam et ultrices orci. Morbi vestibulum dui at felis aliquam aliquam a sit amet enim. Curabitur pellentesque ante eu massa placerat maximus. Sed nec diam a dui volutpat lobortis sit amet sit amet neque. Aliquam aliquet condimentum pellentesque. Proin quis nisi lacu</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras egestas auctor enim, eu rutrum lacus consequat ac. Pellentesque hendrerit metus ac tellus mollis accumsan. Nunc eget orci eu justo placerat aliquet. Nam massa nisl, pretium in feugiat vel, consequat ac ipsum. Nullam et ultrices orci. Morbi vestibulum dui at felis aliquam aliquam a sit amet enim. Curabitur pellentesque ante eu massa placerat maximus. Sed nec diam a dui volutpat lobortis sit amet sit amet neque. Aliquam aliquet condimentum pellentesque. Proin quis nisi lacu</p>';
	}
	else{
		show_all_news($data);
	}
}

// Точка входа.
// Если новость присутствует - вывести ее на сайте, иначе мы выводим весь список

// Был ли передан id новости в качестве параметра?
// если параметр не был передан - выводить 404 ошибку
// http://php.net/manual/ru/function.header.php


?>
<!DOCTYPE>
<html>
    <head>
        <title>Домашнее задание 5</title>
           <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    </head>
    <body>
   <!--точка входа-->
	<h2>Новости сайта</h2>
	<hr>
		<?php show_news($news);?>
	</body>
</html>