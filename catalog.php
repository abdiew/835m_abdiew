
	<form method='GET' action='index.php'>
		<input type='hidden' name='page' value='catalog'>
		<p>Название книги:</br><input type='text' name='namet'><? $namet ?></input></p>
		<p>Автор:</br><input name='autor'><? $autor ?></input></p>
		<input type='submit' value='Поиск' class='btn'>
	</form>
</br>
<button onclick="location.href='index.php?page=add';" class="btn" style="float: left;">Добавить</button> &nbsp&nbsp&nbsp

	<?php
		$namet = "";
		$where = "";
		$and = "";
		$condition2 = "";
		$sort = "";
		$type = "";
		$order_by = "";
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
				$result = mysqli_query($dbh, "SELECT * FROM ITEMS WHERE name='$del'") or die("Сбой при доступе к БД1: " );
				$row = mysqli_fetch_row($result);
				if (!empty($row[7]))
				{
					unlink($row[7]);
				}
				mysqli_query($dbh, "DELETE FROM ITEMS WHERE name='$del'") or die("Сбой при доступе к БД: " );
			}
			//header("Refresh");
		}
		if (isset($_GET['sort'])) {
			$sort = clearData($_GET['sort']);
			switch($sort) {
				case '1': $order_by = 'ORDER BY NAME'; break;
				case '2': $order_by = 'ORDER BY GENRE'; break;
				case '3': $order_by = 'ORDER BY AUTOR'; break;
			}
		}
		
		if (!empty($_GET['namet']) or !empty($_GET['type'])) {
			$where = "WHERE ";
			if (!empty($_GET['namet'])) {
				$namet = clearData($_GET['namet']);
				if (!preg_match("/.{2,}/", $namet)) {
					echo '<h3>Строка для поиска должна состоять из 2 или более символов</h3>';
					exit;
				}
				if (!preg_match("/[\D]{1,}/", $namet)) {
					echo '<h3>Строка для поиска должна состоять только из цифр</h3>';
					exit;
				}
				
				$namet = preg_split('/[\s]+/', $namet);
				$namet = preg_grep('/[\D]{1,}/', $namet);
				for ($i=0; $i<count($namet); $i++) {
					$conditions[] = "UPPER (name) LIKE UPPER('%".$namet[$i]."%')";
				}
				$namet = implode($namet);
			}
			if (!empty($_GET['autor'])) {
				if (!empty($_GET['namet'])) $and = "AND ";
				$autor = clearData($_GET['autor']);
				$condition2 = "autor LIKE '%".$autor."%'";
			}
		}
		else $conditions[]='';
		
		$num = 2;
		if (!empty($_GET['n']))
			$n = clearData($_GET['n']);
		if(empty($n) or $n < 0) $n = 1;
		$start = $n * $num - $num;
		$total_items = mysqli_fetch_row(mysqli_query($dbh,"SELECT COUNT(*) FROM ITEMS ". $where . implode(' OR ', $conditions). $and . $condition2));
		if ($total_items[0] == 0) {
			echo '<h3>Ничего не найдено</h3>';
			exit;
		}
		
		$login = $_SESSION['user_login'];
		if ($login=='admin')
		{
			$query = "SELECT * FROM ITEMS ". $where . implode(' OR ', $conditions). $and . $condition2. " ". $order_by;
		}
		else 
		{	
			$query = "SELECT * FROM ITEMS WHERE LOGIN='$login'" . implode(' OR ', $conditions). $and . $condition2. " ". $order_by;
		}
		$result = mysqli_query($dbh, $query);

		//$query = "SELECT * FROM ITEMS ". $where . implode(' OR ', $conditions). $and . $condition2. " ". $order_by;
		//$result = mysqli_query($dbh, $query);
		echo "<table border='2'><tr>
		<th width='45%'><a href='index.php?page=catalog&sort=1&namet=$namet&type=$type'>Название книги</a></th>
		<th width='25%'><a href='index.php?page=catalog&sort=2&namet=$namet&type=$type'>Жанр</a></th>
		<th width='30%'><a href='index.php?page=catalog&sort=3&namet=$namet&type=$type'>Автор</a></th>
		<th width='5%'></th></tr>";

		while ($row = mysqli_fetch_row($result)) 
		{
			echo "
			<tr>
				<td>
					<a href='index.php?page=item&id=$row[1]'>
						$row[1]
					</a>
				</td>
				<td>$row[2]</td>
				<td>$row[3]</td>
				<td>
					<form method='POST'>
					<input type='checkbox' name='cbs[]' value='$row[1]' />
				</td>
			</tr>";
		}
		echo "
		<input class='btn' id='delete' type='submit' name='delete' value='Удалить'/>
		</form>
		</table>
		<div style='margin-left:40px'>Число записей: <b>$total_items[0]</b></div>";
		getOutputMenu($num,$total_items,$n,'page=catalog&sort='.$sort.'&namet='.$namet.'&type='.$type);
	?>
