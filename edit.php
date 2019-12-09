<?php
$catalog = file('catalog.dat');
$item = explode(';',$catalog[$_GET['id']]);
?>
<a href='index.php?page=catalog' style='margin-left:40px'>назад</a>
<h1>Редактирование записи: <?=$item[0];?></h1>
<?php

if(isset($_POST['go'])){ 
    $error = '';
    if(strlen($_POST['name'])<1)$error.='Необходимо заполнить поле "Название"<br>';
    if(strlen($_POST['genre'])<1)$error.='Необходимо заполнить поле "Жанр"<br>';
    if(strlen($_POST['autor'])<1)$error.='Необходимо заполнить поле "Автор"<br>';
    if(strlen($_FILES['img']['name'])<1) $error.='Необходимо приложить файл изображение<br>';
    if (!empty($_FILES['img']['name'])){
        $checkImg = imageCheck();  
        if($checkImg!=1)$error.=$checkImg.'<br>';        
    }
    
    if(strlen($error)>1){
	   echo '<b>Ошибки заполнения формы:</b><br>'.$error;
    } else {
        if (!empty($_FILES['img']['name'])){     
            resize($_FILES['img']);
            unlink('covers/'.trim($item[3]));
            if (copy($_FILES['img']['tmp_name'], 'covers/'.trim($item[3])))   
            unlink($_FILES['img']['tmp_name']);
            $catalog[$_GET['id']]=clearData_catalog($_POST['name']).';'.clearData_catalog($_POST['genre']).';'.clearData_catalog($_POST['autor']).';'.$item[3];
        } else {
            $catalog[$_GET['id']]=clearData_catalog($_POST['name']).';'.clearData_catalog($_POST['genre']).';'.clearData_catalog($_POST['autor']).';'.$item[3];
        }
        file_put_contents('catalog.dat',$catalog); 
        echo '<meta http-equiv="refresh" content="0;URL=index.php?page=catalog">';
    }
}

?>
<form action="#" method="POST" enctype="multipart/form-data">
<table cellpadding="3" cellspacing="0" border="1">
<tr>
    <th>Название</th>
    <td><input name="name" type="text" value="<?=$item[0];?>"></td>
</tr>
<tr>
    <th>Жанр</th>
    <td><input name="genre" type="text" value="<?=$item[1];?>"></td>
</tr>
<tr>
    <th>Автор</th>
    <td><input name="autor" type="text" value="<?=$item[2];?>"></td>
</tr>
<tr>
    <th colspan="2" align="center">Текущая обложка</th>
</tr>
<tr>
    <td colspan="2" align="center"><img src='covers/<?=$item[3];?>'></td>
</tr>
<tr>
    <th>Заменить обложку</th>
    <td><input type='file' name='img'></td>
</tr>
<tr>
    <td colspan="2" align="center"><input type='submit' value='Сохранить'  name="go"></td>
</tr>
</form>

</table>