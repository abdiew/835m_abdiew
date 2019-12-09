<table class="bottom">
	<tr>
		<td> E-mail: alexandria@biblio.co
				<br/> Мы в социальных сетях: 
				<br/><img src="images/icon1.png" alt="Книги"></img>
				<img src="images/icon2.png" alt="Книги"></img>
				<img src="images/icon3.png" alt="Книги"></img>
				</td> 
		<?php date_default_timezone_set('Asia/Muscat')?>
		<td> Ваш последний визит: <?=(isset($dateVisit)?$dateVisit:'вы здесь впервые')?>
		<br/> Текущее время: <?=date("d.m.Y H:i")?>
		<br/> Powered by <?=$_SERVER['SERVER_SOFTWARE']?>
		</td>
	</tr>
</table>
