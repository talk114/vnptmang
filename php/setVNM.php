<?php
$urlchannel = $_GET['url'];
$urlchannel = str_replace('/', '', $urlchannel);
echo $urlchannel;
$opts = array('http' =>
    array(
        'method'  => 'POST',
        'header'  => 'Content-type: application/x-www-form-urlencoded',
    )
);
$context  = stream_context_create($opts);
$result = file_get_contents('http://vnptmang.com/'.$urlchannel.'/', false, $context);
$xml = explode('<div class="art-layout-cell art-content">',$result);
$xml = explode('<div class="comment-respond">',$xml[1]);
$string ='<div class="cleared"></div></div><div class="cleared"></div></div></div><div class="cleared"></div></div>';
$content = $xml[0].$string;
$file='./vnm/1.json';

file_put_contents($file, $content);
echo $content;
