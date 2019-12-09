<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Лабораторная работа №2</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
	<h3>Вывод серверных переменных:</h3>
	<table border="1" style="width: 40%">
		<tr>
			<td style="width: 500px"><?php print_r($_SERVER); ?></td>
		</tr>
	</table>
	
	<h3>Возведение числа в степень:</h3>
	<form method="post">
            <p>Введите число: <input type="text" name="chislo"></p>
            <p>Введите степень, в которую надо возвести число: <input type="text" name="stepen"></p>
            <p><input type="submit" value="Посчитать" name="send"></p>
        </form>
        <?php 
            if (isset($_POST['chislo']) && isset($_POST['stepen']))
            {
                $chislo = $_POST['chislo'];
                $stepen = $_POST['stepen'];
                echo "<p>Число ".$chislo."  в степени ".$stepen." равно ".power($chislo, $stepen)."</p>";
            }
        ?>
	</form>
</body>
</html>
