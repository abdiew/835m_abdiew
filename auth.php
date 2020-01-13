<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
if (isset($_POST['login']) && isset($_POST['password']))
{
	$host="localhost"; 
	$user="root"; 
	$pass="";
	$database='alexandria';
	$login = clearData($_POST['login']);
	$password = clearData($_POST['password']);
	$dbh = mysqli_connect($host, $user, $pass,$database); 

	
	$query = "SELECT * FROM USERSM WHERE LOGIN='$login' AND PASSWORD='$password'";
	$result = mysqli_query($dbh, $query);

	if ($row = mysqli_fetch_assoc($result)) 
	{
		//session_start();
		$_SESSION['user_login'] = $row['LOGIN'];
		$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
		echo '<script>location = location</script>';
		exit;
	}
	else echo 'Неправильно введен логин или пароль';
}

if (isset($_GET['logout'])) 
{
	session_start();
	session_destroy();
	header("Location: index.php");
	exit;
}

if (isset($_SESSION['user_login']) and $_SESSION['ip'] == $_SERVER['REMOTE_ADDR']) return;
else {
	?>
	<div class= "authorization">
		<table align="center" style="margin-left:40px">
			<tr>
				<td>
					<h3>Авторизируйтесь:</h3>
					<form method="POST">
						<p>Логин:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="login" ><br>
							<p>Пароль:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="password" name="password" ><br>
								<p><input type="submit" value="Отправить"><br>
								</form>
								<button onclick="location.href='index.php?page=reg'">Зарегистрироваться</button>

							</td>
						</tr>
					</table>
				</div>
				<?php 
			}
			exit;
			?>
			