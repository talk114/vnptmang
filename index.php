<!DOCTYPE html>
<html>
<head>
<title>Quản lý Movie</title>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="/style.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js">.</script>
</head>
<body>
<header>
WebTV
<nav class="clear"><ul>
<li><a href="../">Danh sách Movie</a></li>
<li><a href="/addChannel">Thêm Movie mới</a></li>
<li><a href="/Trash">Thùng rác</a></li>
<li>Sắp xếp<ul>
<li><a href="/sortChannel/1">VTV</a></li>
<li><a href="/sortChannel/2">VTC</a></li>
<li><a href="/sortChannel/3">VTVCab</a></li>
<li><a href="/sortChannel/4">Quốc tế</a></li>
<li><a href="/sortChannel/5">Địa phương</a></li>
<li><a href="/sortChannel/6">Quốc gia</a></li>
</ul></li>
</ul></nav>

</header>
<main>
<?php
if(!isset($_COOKIE['admin'])) header("Location: http://vnptmang.hdg.vn");
include_once('mysql.php');
$uri = $_SERVER['REQUEST_URI'];
list($null, $fun, $extend1, $extend2, $extend3) = explode('/', $uri);
if($fun=='') $fun = 'ListChannel';
include_once("data/$fun.php");
?>
</main>
</body>
</html>