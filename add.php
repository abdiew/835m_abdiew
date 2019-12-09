<a href='index.php?page=catalog' style='margin-left:40px'>назад</a>
<h1>Добавление записи в каталог</h1>
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
        $catalog = file('catalog.dat');    
        
        resize($_FILES['img']);
        if (copy($_FILES['img']['tmp_name'], 'covers/'.(count($catalog)+1).'.jpeg'))    
        unlink($_FILES['img']['tmp_name']);

        $catalog[]=clearData_catalog($_POST['name']).';'.clearData_catalog($_POST['genre']).';'.clearData_catalog($_POST['autor']).';'.(count($catalog)+1).".jpeg\r\n";
        file_put_contents('catalog.dat',$catalog); 
        echo '<meta http-equiv="refresh" content="0;URL=index.php?page=catalog">';
    }
}

?>
<form action="#" method="POST" enctype="multipart/form-data">
<table cellpadding="3" cellspacing="0" border="1">
<tr>
    <th>Название</th>
    <td><input name="name" type="text" value="<?=(isset($_POST['name'])?$_POST['name']:'');?>"></td>
</tr>
<tr>
    <th>Жанр</th>
    <td><input name="genre" type="text" value="<?=(isset($_POST['genre'])?$_POST['genre']:'');?>"></td>
</tr>
<tr>
    <th>Автор</th>
    <td><input name="autor" type="text" value="<?=(isset($_POST['autor'])?$_POST['autor']:'');?>"></td>
</tr>
<tr>
    <th>Обложка</th>
    <td><input type='file' name='img'></td>
</tr>
<tr>
    <td colspan="2" align="center"><input type='submit' value='Добавить'  name="go"></td>
</tr>
</form>

</table>