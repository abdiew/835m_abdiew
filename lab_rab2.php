<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Лабораторная работа №2</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
	<h3>Вывод серверных переменных:</h3>
	<table border="1" style="width: 75%">
		<tr>
			<td style="width: 75%"><?php print_r($_SERVER); ?></td>
		</tr>
	</table>

	<?php
	function power($number, $n)
	{
    $sum = 1;
    for ($i = 0; $i < $n; $i++)
        $sum *= $number;
    return $sum;
	}
	?>
	
	<h3>Возведение числа в степень:</h3>
	<form method="post">
            <p>Введите число: <input type="text" name="num"></p>
            <p>Введите степень: <input type="text" name="pv"></p>
            <p><input type="submit" value="Посчитать" name="eq"></p>
        </form>
        <?php 
            if (isset($_POST['num']) && isset($_POST['pv']))
            {
                $num = $_POST['num'];
                $pv = $_POST['pv'];
                echo "<p>Число ".$num."  в степени ".$pv." равно ".power($num, $pv)."</p>";
            }
        ?>
	</form>
</body>
</html>
