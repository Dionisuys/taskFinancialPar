<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Обработка заявок</title>
	<!-- Подключение библиотеки Bootstrap 5 -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
	<style>
		body {
			background-color: black;
			color: white;
		}
	</style>
</head>
<body>
	<div class="container">
        <h1>Обработка заявок</h1>
		<h2>Описание проекта</h2>
		<p>Проект использует фреймворк Symfony 5 для создания веб-приложения. Для визуального 
        оформления была использована библиотека Bootstrap 5. Программа написана на языке PHP и 
        использует шаблонизатор Twig для отображения данных на странице.</p>
        <p>Для работы с базой данных была использована ORM Doctrine DBAL. Проект использует базу 
        данных MySQL, которая запущена на локальном компьютере.</p>
        <p>В проекте также используется проверка на валидность данных с помощью Symfony Validator и 
        авторизация с помощью Symfony Security.</p>
        <p>В программе присутствует форма с выбором действий, либо оставить заявку, либо зайти как 
        менеджер. При заполнении заявки появляется форма из 5 полей, где пятое поле является 
        необязательным комментарием, а все остальные поля обязательны. Если выбрать авторизацию 
        менеджера, нужно будет ввести логин и пароль, которые уже есть в базе. Если такие логин и 
        пароль есть, откроется рабочее окно для менеджера с заявками от клиентов.</p>
		<h2>Заявки</h2>
		<p>Заявки делятся на чётные и нечётные по id из таблицы базы данных.</p>
		<h2>Технологии</h2>
		<ul>
			<li>Symfony 5</li>
			<li>Bootstrap 5</li>
			<li>PHP</li>
			<li>Twig</li>
			<li>Shell</li>
			<li>Post-запросы</li>
			<li>Doctrine DBAL</li>
			<li>Symfony Security</li>
			<li>Symfony Validator</li>
			<li>ORM (Object-Relational Mapping)</li>
			<li>MySQL</li>
		</ul>
		<h2>Установка и запуск проекта</h2>
		<ol>
			<li>Склонируйте репозиторий на свой локальный компьютер:</li>
			<pre><code>git clone https://github.com/ваш-username/название-репозитория.git</code></pre>
			<li>Перейдите в каталог проекта:</li>
			<pre><code>cd название-репозитория</code></pre>
			<li>Установите зависимости:</li>
			<pre><code>composer install</code></pre>
			<li>Создайте базу данных:</li>
			<pre><code>php bin/console doctrine:database:create</code></pre>
			<li>Запустите миграции:</li>
			<pre><code>php bin/console doctrine:migrations:migrate</code></pre>
			<li>Запустите веб-сервер:</li>
			<pre><code>symfony server:start</code></pre>
			<li>Откройте браузер и введите адрес <a href="http://localhost:8000">http://localhost:8000</a></li>
		</ol>
        <h2>Использование</h2>
        <p>При запуске программы появляется форма с выбором действий - оставить заявку или войти как 
        менеджер.</p>
        <p>При заполнении заявки появляется форма из 5 полей, где пятое поле является необязательным 
        комментарием, а все остальныеполя обязательны. После заполнения полей формы можно отправить 
        заявку на обработку.Если выбрать авторизацию менеджера, нужно будет ввести логин и пароль, 
        которые уже есть в базе. Если такие логин ипароль есть, откроется рабочее окно для менеджера с 
        заявками от клиентов.</p>
        <h2>Лицензия</h2>
        <p>MIT</p>
	</div>
</body>
</html>
