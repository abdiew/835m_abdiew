<?php
$host="localhost"; 
$user="root"; 
$pass="";
$database='alexandria';
$file_path = 'covers/';
if ($_SERVER['REQUEST_METHOD'] == 'GET')   $id = clearData($_GET['id']);
if ($_SERVER['REQUEST_METHOD'] == 'POST')  $id = clearData($_POST['id']);

$dbh = mysqli_connect($host, $user, $pass, $database);
$result = mysqli_query($dbh, "SELECT * FROM ITEMS WHERE name='$id'");
$row = mysqli_fetch_row($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	if (!empty($_POST['genre']) && !empty($_POST['autor']))
	{
		$namet = clearData($_POST['namet']);
		$genre = clearData($_POST['genre']);
		$autor = clearData($_POST['autor']);
		$autor = preg_replace("~(?:(?:https?|ftp|telnet)://(?:[a-z0-9_-]{1,32}".
				"(?::[a-z0-9_-]{1,32})?@)?)?(?:(?:[a-z0-9-]{1,128}\.)+(?:com|net|".
				"org|mil|edu|arpa|gov|biz|info|aero|inc|name|[a-z]{2})|(?!0)(?:(?".
				"!0[^.]|255)[0-9]{1,3}\.){3}(?!0|255)[0-9]{1,3})(?:/[a-z0-9.,_@%&".
				"?+=\~/-]*)?(?:#[^ '\"&<>]*)?~i",'',$autor);

		if (($namet <> $row[1]) or (!empty($_FILES['uploadfile']['name'])))
		{
			if ($namet <> $row[1])
			{
				rename($row[4], $file_path . $namet . '.jpg');
			}
			if (!empty($_FILES['uploadfile']['name']))
			{
				$tmp_path = 'tmp/';
				$result = imageCheck();
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
			
			$query = "UPDATE ITEMS SET name='$namet',genre='$genre',autor='$autor',uploadlink='$uploadlink' WHERE name='$id'";
		}
		else
		{
			
			$query = "UPDATE ITEMS SET name='$namet',genre='$genre',autor='$autor', WHERE name='$id'";
		}
		mysqli_query($dbh, $query) or die ("Сбой при доступе к БД: " );
		//header("Location: index.php?page=catalog");
	}
	else echo 'Полностью заполните форму';	
}

?>
	
	<h2 style="margin: 10px 100px 30px 200px;">Редактирование записи</h2>
	<form method='POST' action='index.php?page=edit&id=<?php echo $id; ?>' ENCTYPE='multipart/form-data'>			
		<input type='text' hidden name='id' value='<?=$row[1]?>'>	
		<table>
			<tr>
				<th>Название книги:</th>
				<td><input type='text' name='namet' value='<?=$row[1]?>' size="35"></td>
			</tr>
			<tr>
				<th>Жанр:</th> 
				<td><input type='text' name='genre' value='<?=$row[2]?>' size="35"></td>
			</tr >
			<tr>
				<th>Автор:</th>
				<td><input type='text' name='autor' value='<?=$row[3]?>' size="35"></td>
			</tr>
			<tr>
				<th>Изображение:</th> 
				<td><input type='file' name='uploadfile'></td>
			</tr>
		</table>
		<center><p><input class="btn" type='submit' value='Сохранить'></p></center>
	</form>