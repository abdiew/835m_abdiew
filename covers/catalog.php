<button onclick="location.href='index.php?page=add';" style="float: left;">Добавить</button>
<table class="data_table"  border="1">
	<tr>
		<th width="44%">Название книги</th>
		<th width="24%">Жанр</th>
		<th width="32%">Автор</th>
	</tr>

	<?php
			$host="localhost"; 
			$user="root"; 
			$pass="";
			$database='alexandria';
	$dbh = mysqli_connect($host, $user, $pass, $database);
	if (isset($_POST['delete']) && isset($_POST['cbs']))
	{
		$cbs = $_POST['cbs'];
		$count = count($_POST['cbs']);
		for ($i = 0; $i < $count; $i++) 
		{
			$del = $cbs[$i];
			$result = mysqli_query($dbh, "SELECT * FROM ITEMS WHERE name='$del'");
			$row = mysqli_fetch_row($result);
			if (!empty($row[7]))
			{
				unlink($row[7]);
			}
			mysqli_query($dbh, "DELETE FROM ITEMS WHERE name='$del'");
		}
	}

	$query = "SELECT * FROM ITEMS ORDER BY name";
	$result = mysqli_query($dbh, $query);
	while ($row = mysqli_fetch_row($result)) 
	{
		echo "
		<tr>
			<td>
				<a href='index.php?page=item&id=$row[0]'>
					$row[0]
				</a>
			</td>
			<td>$row[1]</td>
			<td>$row[2]</td>
			<td>
				<form method='POST'>
				<input type='checkbox' name='cbs[]' value='$row[0]' />
			</td>
		</tr>";
	}
	echo "
	<input id='delete' type='submit' name='delete' value='Удалить' class='catalog_2'/>
	</form>
	</table>
	";
	?>
