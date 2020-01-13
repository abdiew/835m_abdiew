<?php
session_start();
ini_set('display_errors',1);
error_reporting(E_ALL);
date_default_timezone_set('Asia/Muscat');
include "lib.inc.php";
if (isset($_COOKIE['dateVisit']))
	$dateVisit = $_COOKIE['dateVisit'];
setcookie('dateVisit',date('Y-m-d H:i:s'),time()+0xFFFFFFF);

	if (isset($_GET['logout'])) 
	{
	  	session_destroy();
	  	header("Location: index.php");
	  	exit;
	}
	$page = "";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Электронная библиотека "Александрия"</title>
	<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
	<meta http-equiv="cache-Control" content="no-cache" meta charset="UTF-8"/>
</head>
<body>
	<table class="table">
		<tr>
			<td align="center" colspan="3">
				<!-- Верхняя часть сайта --> 
				<?php include "top.inc.php "?>
			</td>
		</tr>
		<tr>
			<td class="menutd">
				<!-- Меню сайта -->
				<?php include "menu.inc.php "?>
			</td>
			<td colspan="2">
				<table class="content">
					<tr>
						<td class="content_td">
							<!-- Область основного контента сайта -->
							<?php
							require 'base_reg.php';
							if (!empty($_GET['page']))
								$page = $_GET['page'];
							if ($page == 'reg')
							{
								include 'registration.php';
								exit;
							}
							if (!empty($_GET['page']))
									$page = $_GET['page'];
							require 'auth.php';
							if (empty($page)) { ?>
								<p style="text-align: center;"><b>О Нашем проекте.</b></p>
								<p class="textb"><b>Электро́нная библиоте́ка</b> — упорядоченная коллекция разнородных электронных документов (в том числе книг, журналов), снабжённых средствами навигации и поиска. Может быть веб-сайтом, где постепенно накапливаются различные тексты (чаще литературные, но также научные и любые другие, вплоть до компьютерных программ) и медиафайлы, каждый из которых самодостаточен и в любой момент может быть востребован читателем. Электронные библиотеки могут быть универсальными, стремящимися к наиболее широкому выбору материала (как Библиотека Максима Мошкова или Либрусек), и более специализированными, как Фундаментальная электронная библиотека или проект Сетевая Словесность, нацеленный на собирание авторов и типов текста, наиболее ярко заявляющих о себе именно в Интернете. На нашем сайте вы найдете и художественную литературу всемирно признанных авторов и научно-популярные статьи из большого количества областей науки.</p>
								<p class="textb"> </p>
								<p style="text-align: center;"><img src="images/image1.png" alt="Книги"></img></p>
								<p class="textb">Форматы, в которых книги доступны для скачивания  с нашего сайта — заархивированный TXT, RTF и DOC, Mobipocket .PRC (формат для чтения книг на кпк и телефонах), FictionBook.</p>
								<p class="textb">Дополнительно, материалы, изобилующие математическими формулами и сложными схемами, доступны в графическом формате, DjVu и PDF.</p>
								<?php 
								}
									else switch($page)
								{
									case 'lr1':
									include_once('auth.php');
									include 'lab_rab1.html'; break;
									case 'lr2':
									include_once('auth.php');
									include 'lab_rab2.php'; break;
									case 'lr3':
									include_once('auth.php');
									include 'lab_rab3.php'; break;	
									case 'lr4':
									include_once('auth.php');
									include 'lab_rab4.php'; break;
									case 'lr5':
									include_once('auth.php');
									include 'lab_rab5.php'; break;				
									case 'catalog':
									include_once('auth.php');
									include 'catalog.php'; break;	
									case 'add': 
									include_once('auth.php');
									include 'add.php'; break;
									case 'item':
									include_once('auth.php');
									include 'item.php'; break;	
									case 'edit':
									include_once('auth.php'); 
									include 'edit.php'; break;	
									case 'reg':
									include_once('auth.php'); 
									include 'registration.php'; break;
								}		
								?>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="3">
					<!-- Нижняя часть сайта --> 
					<?php include "bottom.inc.php "?>
				</td>
			</tr>
		</table>
	</body>
	</html>