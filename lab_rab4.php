<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
//Параметры подключения
$host="localhost"; 
$user="root"; 
$pass="";
$database='alexandria';
//Создание БД

echo 'База данных успешно создана!</br>';
echo 'Структура базы данных:</br>';
$dbh = mysqli_connect($host, $user, $pass, $database);
//Начало транзакции
mysqli_begin_transaction($dbh, MYSQLI_TRANS_START_READ_WRITE);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
//Создание таблиц	
mysqli_query($dbh, "drop table if exists Users");
mysqli_query($dbh, "drop table if exists Purshase");
mysqli_query($dbh, "CREATE TABLE IF NOT EXISTS Users (id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT, name VARCHAR(60) not null, date_born DATE, adress VARCHAR(80) not null, phone SMALLINT)");
mysqli_query($dbh, "CREATE TABLE IF NOT EXISTS Purshase (id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT, name VARCHAR(60) not null, autor VARCHAR(60), userid INTEGER REFERENCES UsersLAB  , date_take TIMESTAMP)");

mysqli_commit($dbh);
//Вывод информации о таблицах
getTableInfo($host, $user, $pass, $database);
mysqli_begin_transaction($dbh, MYSQLI_TRANS_START_READ_WRITE);
echo '</br>Измененная структура базы данных:</br>';
//Изменение структуры таблицы
$dbh = mysqli_connect($host, $user, $pass, $database);
mysqli_query($dbh, "ALTER TABLE Purshase ADD price INTEGER");
mysqli_query($dbh, "ALTER TABLE Users DROP phone");
mysqli_query($dbh, "ALTER TABLE Users add email VARCHAR(50)");
mysqli_commit($dbh);

//Вывод информации о таблицах
getTableInfo($host, $user, $pass, $database);
//Заполнение таблиц данными


mysqli_query($dbh, "INSERT INTO Users (name,adress,date_born,email) VALUES ('Иванов','Рязань','1994.12.14', 'ivanov@gmail.com')");
mysqli_query($dbh, "INSERT INTO Users (name,adress,date_born,email) VALUES ('Петров','Санк-Петербург','2000.03.13','petrov@gmail.com')");
mysqli_query($dbh, "INSERT INTO Users (name,adress,date_born,email) VALUES ('Сидоров','Москва','1989.01.24','sidorov@gmail.com')");

mysqli_query($dbh, "INSERT INTO Purshase (name,autor,userid,date_take,price) VALUES ('Вино из одуванчиков',' Рэй Брэдбери','1','2019.12.01 15:45:45', '260')");
mysqli_query($dbh, "INSERT INTO Purshase (name,autor,userid,date_take,price) VALUES ('Миры Гарри Гаррисона','Гарри Гаррисон','2','2019.11.25 16:47:52', '300')");
mysqli_query($dbh, "INSERT INTO Purshase (name,autor,userid,date_take,price) VALUES ('Тяжелый свет Куртейна: Синий','Макс Фрай','3','2019.12.13 17:34:25','500')");
mysqli_query($dbh, "INSERT INTO Purshase (name,autor,userid,date_take,price) VALUES ('Тяжелый свет Куртейна: Желтый','Макс Фрай','1','2017.11.06 19:23:56','500')");


//Вывод содержимого таблиц
echo "</br>Таблица Purshase:</br><table border='1' width='80%'>
<tr>
<th width='10%'>ID</th>
<th width='30%'>Название книги</th>
<th width='15%''>Автор</th>		
<th width='20%'>Имя клиента</th>
<th width='20%'>Дата покупки</th>
<th width='20%'>Цена, руб</th>
</tr>";
$result = mysqli_query($dbh, "SELECT Purshase.id, Purshase.name, Purshase.autor,Users.name, Purshase.date_take, Purshase.price FROM Purshase,Users WHERE Purshase.userid = Users.id ") or die ("Сбой при доступе к БД: " );
while ($row = mysqli_fetch_row($result)) 
{
	echo "<tr>
	<td>$row[0]</td>
	<td>$row[1]</td>
	<td>$row[2]</td>
	<td>$row[3]</td>
	<td>$row[4]</td>
	<td>$row[5]</td></tr>";
}
echo '</table>';
echo "</br>Таблица Users:</br><table border='1' width='80%'>
<tr>
<th width='10%'>ID</th>
<th width='30%'>Имя</th>
<th width='25%''>Адрес</th>
<th width='30%'>Дата рождения</th>
<th width='30%'>E-mail</th>
</tr>";
$result = mysqli_query($dbh, "SELECT * FROM Users") or die ("Сбой при доступе к БД: " );
while ($row = mysqli_fetch_row($result)) 
{
	echo "<tr>
	<td>$row[0]</td>
	<td>$row[1]</td>
	<td>$row[3]</td>		
	<td>$row[2]</td>
	<td>$row[4]</td>
	</tr>";
}
echo '</table>';

//Вывод результатов первого запроса
echo "</br>Запрос №1:</br>
Вывести информацию о покупках Иванова, сумма которых более 100</br></br>

<table border='1' width='80%'>
<tr>
<th width='45%'>Название товара</th>
<th width='20%''>Цена, руб</th>
<th width='35%'>Дата покупки</th>
</tr>";
$result = mysqli_query($dbh, "SELECT name,price,date_take FROM Purshase WHERE userid=(select id from Users WHERE name='Иванов') AND price>=100") or die ("Сбой при доступе к БД: " );
while ($row = mysqli_fetch_row($result)) 
{
	echo "<tr>
	<td>$row[0]</td>
	<td>$row[1]</td>
	<td>$row[2]</td></tr>";
}
echo '</table>';

//Вывод результатов второго запроса
echo "</br>Запрос №2:</br>
Вывести информацию о покупках клиентов, определив дату последней покупки и сумму по всем заказам</br></br>

<table border='1' width='80%'>
<tr>
<th width='30%'>Имя</th>
<th width='20%'>Цена</th>
<th width='40%'>Дата покупки</th>
</tr>";
$result = mysqli_query($dbh, "SELECT U.name,P.Sum_purshase,P.Max_date FROM Users U, (SELECT userid,SUM(price),MAX(date_take) FROM Purshase GROUP BY userid) AS P (userid,Sum_purshase,Max_date) WHERE P.userid=U.id") or die ("Сбой при доступе к БД: " );
while ($row = mysqli_fetch_row($result)) 
{
	echo "<tr>
	<td>$row[0]</td>
	<td>$row[1]</td>
	<td>$row[2]</td>
	</tr>";
}
echo '</table>';

//Удаление БД
mysqli_query($dbh, "drop table if exists Users");
mysqli_query($dbh, "drop table if exists Purshase");
echo '</br>База данных успешно удалена!</br>';
?>