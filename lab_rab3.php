<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Калькулятор</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
	<form method="GET" action="">  

		x: <input type="text" name="x"> 

		<select required name="act"> 
			<option></option>  
			<option value="+">+</option>  
			<option value="-">-</option>  
			<option value="*">*</option>  
			<option value=".">/</option>  
		</select> 

		y: <input type="text" name="y">   
		система счисления, в которой будет выведен результат: <input type="text" name="s">
		<input type="submit" name="okbutton" value="=" /> 

	</form> 

	<?php 
	if (empty($_GET['x']) || empty($_GET['y'])) {
		echo 'Не заданы аргументы';
		return;
	}

	if (empty($_GET['s'])) {
		echo 'Не задана СИ';
		return;
	}

	$x=$_GET["x"]; 
	$y=$_GET["y"]; 
	$s=$_GET["s"];

	$act=$_GET["act"];

	if($act=="+") {$res = base_convert(($x + $y), 10, $s);}; 
	if($act=="-") {$res = base_convert(($x - $y), 10, $s);};
	if($act=="*") {$res = base_convert(($x * $y), 10, $s);};
	if($act=="/") {$res = base_convert(($x / $y), 10, $s);}; 

	echo"</p>$x $act $y = $res</p>";//вывод результата ?>  
</body>
</html>