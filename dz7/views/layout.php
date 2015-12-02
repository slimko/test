<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link href="./style.css" rel="stylesheet">
	</head>
	<body>
		<?php include "./form.php";?>
		<h2>Объявления:</h2>
		<?php show_ads($params['bd']); //выводим объявления ?>
	</body>
</html>