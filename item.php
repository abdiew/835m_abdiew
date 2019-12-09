<?php
$catalog = file('catalog.dat');
$item = explode(';',$catalog[$_GET['id']]);
?>
<br/>
<a href='index.php?page=catalog' style='margin-left:40px'>Назад</a>
<a href='index.php?page=edit&id=<?=$_GET['id'];?>' style='margin-left:40px'>Редактировать</a>
<a href='index.php?page=catalog&del=<?=$_GET['id'];?>' style='margin-left:40px'>Удалить</a>
<br/><br/>
<table cellpadding="3" cellspacing="0" border="1">
	<tr>
		<th>Название</th>
		<td><?=$item[0];?></td>
	</tr>
	<tr>
		<th>Жанр</th>
		<td><?=$item[1];?></td>
	</tr>
	<tr>
		<th>Автор</th>
		<td><?=$item[2];?></td>
	</tr>
	<tr>
		<th colspan="2" align="center">Обложка</th>
	</tr>
	<tr>
		<td colspan="2" align="center"><img src='covers/<?=$item[3];?>'></td>
	</tr>
</table>