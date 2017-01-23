<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title></title>
	<link rel="stylesheet" href="/resource/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="/resource/script.js"></script>
</head>

<body>

	<div class="wrapper">

		<div class="menu">
			<a href="/">Главная</a>

			<?if(!isset($_SESSION['user_id'])){?>
				<a href="/user/registration">Регистрация</a>
				<a href="/user/login">Логин</a>
			<?} else {?>
				<a href="/user/exitRequest">Выход</a>
			<?}?>
		</div>

		<div class="content">
			<div class="block">

			<?php
				include ($contentPage);
			?>

			</div>
		</div>
	</div>
</body>
</html>

