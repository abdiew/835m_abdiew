<?php
	function getMenu($menu, $vertical=true)
	{
		$style = "";
		if(!$vertical)
		{
			$style = "display:inline";
		}
		echo '<ul style="list-style-type:none">';
			foreach ($menu as $link=>$href)
			{
				echo "<li style='$style'><a href=\"$href\">", $link, '</a></li>';
			}
		
		echo '</ul>';
	}

	function power($number, $n)
	{
    $sum = 1;
    for ($i = 0; $i < $n; $i++)
        $sum *= $number;
    return $sum;
	}
	
	function clearData($data)
	{
		return trim(strip_tags($data));
	}

    function clearData_catalog($data)     
    {
        $data = str_replace(';',',',$data); 
        return clearData($data);             
    }

	function imageCheck()
	{
		if ($_FILES['img']['type'] == "image/jpeg")
		{
			if ($_FILES['img']['size']<=1024000)
				return 1;
			else
				return "Размер файла не должен превышать 1000Кб";
		}
		else
			return "Файл должен иметь jpeg-расширение";
	}

	
	function resize($file)
    {
         // Ограничение по ширине в пикселях
        $max_size = 250;
        // Cоздаём исходное изображение на основе исходного файла
        $src = imagecreatefromjpeg($file['tmp_name']);
        // Определяем ширину и высоту изображения
        $w_src = imagesx($src);
        $h_src = imagesy($src);
        // Если ширина больше заданной
        if ($w_src > $max_size)
        {
            // Вычисление пропорций
            $ratio = $w_src/$max_size;
            $w_dest = round($w_src/$ratio);
            $h_dest = round($h_src/$ratio);
            // Создаём пустую картинку
            $dest = imagecreatetruecolor($w_dest, $h_dest);
            // Копируем старое изображение в новое с изменением параметров
            imagecopyresampled($dest, $src, 0, 0, 0, 0, $w_dest, $h_dest, $w_src, $h_src);
            // Вывод картинки и очистка памяти
            imagejpeg($dest, $_FILES['img']['tmp_name']);
            imagedestroy($dest);
            imagedestroy($src);
            return $file['name'];
        }
        else
        {
            // Вывод картинки и очистка памяти
            imagejpeg($src, $_FILES['img']['tmp_name']);
            imagedestroy($src);
            return $file['name'];
        }
    }
?>