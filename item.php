<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET['id']))
{
	$id = clearData($_GET['id']);
	$dbh = mysqli_connect($host, $user, $pass, $database);
	$query = "SELECT * FROM ITEMS WHERE name='$id'";
	$result = mysqli_query($dbh, $query);
	$row = mysqli_fetch_row($result);
}
?>

<br/>
<a href='index.php?page=catalog'><button class='btn'>Назад</button></a>
<a href='index.php?page=edit&id=<?=$row[0]?>'><button class='btn'>Редактировать</button></a>
<br/><br/>
<table border="1" style="text-align:left;" align="left" >
	<tr>
		<th width="25%">Название книги</th>
		<td  ><?= $row[1] ?></td>
		<td rowspan="4"><img src='<?= $row[4] ?> '></td>
	</tr>
	<tr>
		<th>Жанр</th>
		<td width="15%"><?= $row[2] ?></td>
	</tr>
	<tr>
		<th>Автор</th>
		<td width="15%"><?= $row[3] ?></td>
	</tr>
</table>
<br/>
