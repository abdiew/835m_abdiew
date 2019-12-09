<table class="top">
				<tr>
					<td colspan="3"><a href="index.html"><img src="images/logo.png" alt="Логотип" /></a></td>
				</tr>
				<tr>
					<td colspan="2" class="top_left"> 
					<?php
					if (!empty($_SESSION['user_login'])){
						echo "Здравствуйте, <b>{$_SESSION['user_login']}</b> [<a href='index.php?logout=true'>Выход</a>]";		
					}else{
						echo "Здравствуйте, Гость!";
					}
					?> </td>
					<td class="top_right"> <input type="text" name="search" size="40" maxlength="50" /> 
					<input type="submit" value="Поиск" />	</td>
				</tr>
</table>