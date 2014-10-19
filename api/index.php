<!DOCTYPE html>
<html>
<head>
<title>Quản lý Kênh</title>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="/api/style.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js">.</script>
</head>
<body>
<header>
API
<nav class="clear"><ul>
<li><a href="/api/">Danh sách Kênh</a></li>
<li><a href="/api/index.php/addChannel">Thêm kênh mới</a></li>
<li><a href="/api/index.php/Trash">Thùng rác</a></li>
<li>Sắp xếp<ul>
<li><a href="/api/index.php/sortChannel/1">VTV</a></li>
<li><a href="/api/index.php/sortChannel/2">VTC</a></li>
<li><a href="/api/index.php/sortChannel/3">VTVCab</a></li>
<li><a href="/api/index.php/sortChannel/4">Quốc tế</a></li>
<li><a href="/api/index.php/sortChannel/5">Địa phương</a></li>
<li><a href="/api/index.php/sortChannel/6">Quốc gia</a></li>
</ul></li>
</ul></nav>

</header>
<main>
<?php
if(!isset($_COOKIE['admin'])) header("Location: http://vnptmang.com");
//if($_SERVER['HTTP_X_FORWARDED_PROTO']!='https') 
	//header("Location: https://ch.vnptmang.com/api");
	echo getenv('HTTP_X_FORWARDED_PROTO');
include_once('../mysql.php');
$uri = $_SERVER['REQUEST_URI'];
list($null, $folder,$index, $fun, $extend1, $extend2, $extend3) = explode('/', $uri);
if($fun=='') $fun = 'ListChannel';
include_once("./data/$fun.php");
?>
</main>
</body>
</html>