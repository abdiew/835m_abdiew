

<?php
	$host="localhost"; 
	$user="root"; 
	$pass="";
	$database='alexandria';
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	if (!empty($_POST['namet']) && !empty($_POST['genre']) && !empty($_POST['autor']))
	{
		$namet = clearData($_POST['namet']);
		if (!preg_match("/^[a-zA-Zа-яёА-ЯЁ][\w\s:-]{2,50}$/iu", $namet)) {
			echo '<h3>Введите корректное название записи</h3>';
			exit;
		}
		$namet = clearData($_POST['namet']);
		$dbh = mysqli_connect($host, $user, $pass, $database);
		$result = mysqli_query($dbh,"SELECT COUNT(*) FROM ITEMS WHERE name='$namet'");
		$total_items = mysqli_fetch_row($result);
		if ($total_items[0] < 1)
		{
			$genre = clearData($_POST['genre']);
			$autor = clearData($_POST['autor']);
			$autor = preg_replace("~(?:(?:https?|ftp|telnet)://(?:[a-z0-9_-]{1,32}".
				"(?::[a-z0-9_-]{1,32})?@)?)?(?:(?:[a-z0-9-]{1,128}\.)+(?:com|net|".
				"org|mil|edu|arpa|gov|biz|info|aero|inc|name|[a-z]{2})|(?!0)(?:(?".
				"!0[^.]|255)[0-9]{1,3}\.){3}(?!0|255)[0-9]{1,3})(?:/[a-z0-9.,_@%&".
				"?+=\~/-]*)?(?:#[^ '\"&<>]*)?~i",'',$autor);

			if (!empty($_FILES['uploadfile']['name']))
			{
				$tmp_path = 'tmp/';
				$result = imageCheck();
				$file_path = 'covers/';
				if ($result == 1)
				{
					$name = resize($_FILES['uploadfile']);
					$uploadfile = $file_path . $name;
					if (@copy($tmp_path . $name, $file_path . $namet . '.jpg'))
						unlink($tmp_path . $name);
				}
				else
				{
					echo $result;
					exit;
				}
			}
			$uploadlink = $file_path . $namet . '.jpg';
			$query = "INSERT INTO ITEMS (name,genre,autor,uploadlink) VALUES ('$namet','$genre','$autor','$uploadlink')";
			mysqli_query($dbh, $query) or die ("Сбой при доступе к БД: ");
			//header("Location: index.php?page=catalog");
		}
		else echo 'Такой товар уже существует';
	}
	else echo 'Полностью заполните форму';
}
?>


<h2 style="margin: 10px 100px 30px 200px;">Добавить книгу</h2>
<form method='POST' action='index.php?page=add' ENCTYPE='multipart/form-data'>			
	<table>
		<tr>
			<th>Название книги:</th>
			<td><input type='text' name='namet' style="width:150%"></td>
		</tr>
		<tr>
			<th>Жанр:</th> 
			<td><input type='text' name='genre' style="width:150%"></td>
		</tr>			 			
		<tr>
			<th>Автор:</th>
			<td><input type='text' name='autor' style="width:150%"></td>
		</tr>
		<tr>
			<th>Обложка:</th> 
			<td><input type='file' name='uploadfile' accept='.jpg'></td>
		</tr>
		<tr>
			<th></th> 
			<td><input class="btn" type='submit' value='Добавить' name='add' style="margin: 5px 0px 100px 100px"></td>
		</tr>
	</table>
</form>