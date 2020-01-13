<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Регистрация</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>

<body>
				<?php
					$host="localhost"; 
					$user="root"; 
					$pass="";
					$database='alexandria';
					if ($_SERVER['REQUEST_METHOD'] == 'POST')
					$dbh = mysqli_connect($host, $user, $pass, $database); 

					{
						if (!empty($_POST['login_reg']) && !empty($_POST['password_1']) && !empty($_POST['password_2']) && !empty($_POST['email'])) 
						{
							if ($_POST['password_1'] == $_POST['password_2'])
							{
								$login_reg = clearData($_POST['login_reg']);
								$hash_password = clearData($_POST['password_1']);
								$email_reg = clearData($_POST['email']);
								
								$dbh = mysqli_connect($host, $user, $pass, $database); 
								$query = "INSERT INTO USERSM (LOGIN,PASSWORD,EMAIL) VALUES ('$login_reg','$hash_password','$email_reg')";
								if (mysqli_query($dbh, $query))
									echo "Регистрация завершена успешно";
								else 
									echo "Сбой при регистрации: ".  mysqli_error($dbh);
								mysqli_begin_transaction($dbh, MYSQLI_TRANS_START_READ_WRITE);
							}
							else echo 'Ваши пароли не совпадают';
						}
						else echo 'Полностью заполните форму';
					}
					?>

					<h3>Регистрация</h3>
					<table class="data_table">
						<tr>
							<td><form method="POST">
								<table>
									<tr>
										<td>
											<label>Логин:</label>
										</td>
										<td>
											<input type="text" required name="login_reg" style="margin-left:30px">
										</td>
									</tr>	
									<tr>
										<td>
											<label>Пароль:</label>
										</td>
										<td>
											<input type="password" required name="password_1" style="margin-left:30px">
										</td>
									</tr>
									<tr>
										<td>
											<label>Повторите пароль:</label>
										</td>
										<td>
											<input type="password" required name="password_2" style="margin-left:30px">
										</td>
									</tr>	
									
									<tr>
										<td>
											<label>Email:</label>
										</td>
										<td>
											<input type="email" required name="email" style="margin-left:30px">
										</td>
									</tr>
									<tr><td></td>
										<td>
											<input type="submit" style="margin-left:30px;margin-top:30px">
										</td>
									</tr>
								</table>
							</form>
						</td>
					</tr>
					</table>
</body>
</html>