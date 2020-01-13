<?php
	$menu = array(
		"Главная"=>"index.php", 
		"Каталог"=>"index.php?page=catalog",
		"Работа №1"=>"index.php?page=lr1",
		"Работа №2"=>"lab_rab2.php",
		"Работа №3"=>"lab_rab3.php",
		"Работа №4"=>"index.php?page=lr4",
		"Работа №5"=>"index.php?page=lr5");
?>	
<table class="menu">
	<tr>
		<td>
			<?php
				getMenu($menu);
			?>
		</td>
	</tr>
</table>