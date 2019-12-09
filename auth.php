<?php
if (isset($_POST['login']) && isset($_POST['password']))
{
	$login = clearData($_POST['login']);
    	$password = clearData($_POST['password']);
    	$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
	$_SESSION['user_login'] = $login;
 	echo '<meta http-equiv="refresh" content="0;URL=index.php">';
	exit;
}

if (isset($_SESSION['user_login']) and $_SESSION['ip'] == $_SERVER['REMOTE_ADDR']) return;
else
{
?>
	<table align="center" style="margin-left:40px">
	<tr><td>
	<h3>Вход в систему</h3>
	<form method="POST">
	<p>Логин:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="login"><br>
	<p>Пароль:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="password" name="password"><br>
	<p><input type="submit"><br>
	</form>
	</td></tr></table>
<?php
}
exit;
?>