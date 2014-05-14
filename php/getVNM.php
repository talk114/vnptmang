<?php
$urlchannel = $_GET['url'];
$urlchannel = str_replace('/', '', $urlchannel);
$file='./vnm/'.$urlchannel.'.json';
$result = file_get_contents($file);

echo $result;
