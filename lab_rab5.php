<form method="post">
	<b>Вопрос №1.</b><br/>
	Восстановить файл prog1.pas, находящийся в каталоге C:\PROGRAMS<br/><br/>
  	Ответ: <input name="answer1" type="text" size="100" maxlength="255" value="<?=(isset($_POST['answer1'])?$_POST['answer1']:'')?>"><br/><br/>
	<b>Вопрос №2.</b><br/>
	Перейти из текущего каталога в каталог C:\DATA\TEXT<br/><br/>
  	Ответ: <input name="answer2" type="text" size="100" maxlength="255" value="<?=(isset($_POST['answer2'])?$_POST['answer2']:'')?>"><br/><br/>
	<b>Вопрос №3.</b><br/>
	Проверить носитель данных в дисководе А: на наличие ошибок с выводом на экран дисплея информации по каждому из проверенных файлов и информации об обнаруженных дефектах диска. Ошибки должны исправляться после соответствующего запроса<br/><br/>
  	Ответ: <input name="answer3" type="text" size="100" maxlength="255" value="<?=(isset($_POST['answer3'])?$_POST['answer3']:'')?>"><br/><br/>
	<b>Вопрос №4.</b><br/>
	Сравнить файл prog1.pas в каталоге D:\PASCAL\ с файлом prog2.pas, находящимся в текущем каталоге. Воспользоваться командой, не отображающей различия между файлами.<br/><br/>
  	Ответ: <input name="answer4" type="text" size="100" maxlength="255" value="<?=(isset($_POST['answer3'])?$_POST['answer4']:'')?>"><br/><br/>
	<b>Вопрос №5.</b><br/>
	Сравнить два диска при наличии одного дисковода А:. Сравниваться должны только первые стороны дисков.<br/><br/>
  	Ответ: <input name="answer5" type="text" size="100" maxlength="255" value="<?=(isset($_POST['answer5'])?$_POST['answer5']:'')?>"><br/><br/>
  	<input type="submit" value="Ответить" style="margin:10px">
</form><br/>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$correct = 0;
	for ($i=1;$i<=5;$i++)
	{
		$answer[] = trim($_POST["answer".$i]);	
	}
	if (preg_match('/^recover\s+c:\\\\programs\\\\prog1\.pas$/i', $answer[0]))
	{
	    # recover c:\programs\prog1.pas
        # RECOVER c:\PROGRAMS\prog1.PAS
		$correct++;
	}
	if (preg_match('/^(cd|chdir)\s+c:\\\\data\\\\text$/i', $answer[1]))
	{
	    # cd c:\data\text
        # chdir c:\data\text
		$correct++;
	}
	if (preg_match('/^chkdsk\s+a:\s?(\/f\s?\/v|\/v\s?\/f)$/i', $answer[2]))
	{
	    # chkdsk a:/f/v
        # chkdsk a:/v/f
        # chkdsk A: /v /f
        # chkdsk A: /f /v
		$correct++;
	}
	if (preg_match('/^comp\s(d:\\\\pascal\\\\prog1.pas\sprog2.pas|prog2.pas\sd:\\\\pascal\\\\prog1.pas)$/i', $answer[3]))
	{
	    # comp d:\pascal\prog1.pas prog2.pas
        # comp prog2.pas d:\pascal\prog1.pas
		$correct++;
	}
	if (preg_match('/^diskcomp\s(a:\sa|a:\sb|b:\sa):\/1$/i', $answer[4]))
	{
	    # diskcomp a: a:/1
        # diskcomp a: b:/1
        # diskcomp b: a:/1
		$correct++;
	}
	switch($correct)
	{
		case '5': $estimation = 5; break;
		case '4': $estimation = 4; break;
		case '3': $estimation = 3; break;
		default: $estimation = 2;
	}	
	echo "<table border='1'><tr>
	<th>Правильных ответов </th>
	<td>$correct</td></tr>
	<tr><th>Оценка </th>
	<td>$estimation</td>
	</tr></table><br/>";
}	
?>

