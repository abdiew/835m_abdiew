<?php
$catalog = file('catalog.dat');

if(isset($_GET['del'])){
    $item = explode(';',$catalog[$_GET['del']]);
    unlink('img/'.trim($item[3]));      
    unset($catalog[$_GET['del']]);      
    file_put_contents('catalog.dat',$catalog);
    echo '<meta http-equiv="refresh" content="0;URL=index.php?page=catalog">';
}

?>

<h1>Каталог</h1>
<button onclick="location.href='index.php?page=add';" style="margin-top:-15px">Добавить</button>
<form action="#" method="POST">
<table style="margin-top:10px" cellpadding="3" cellspacing="0" border="1">
<tr>
    <th>Название</th>
    <th>Жанр</th>
    <th>Автор</th>
    <th>Обложка</th>
</tr>
<?php
foreach($catalog as $key=>$val){
  $values = explode(';',$val);
  echo "<tr>";
  echo "<td><a href='index.php?page=item&id=".$key."'>".$values[0]."</a></td>";  
  echo "<td>".$values[1]."</td>";
  echo "<td>".$values[2]."</td>";
  echo "<td><a href='index.php?page=catalog&del=".$key."'>удалить</a></td>";
}
?>
</table>