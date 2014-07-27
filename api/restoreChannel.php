<?php
include("mysql.php");
$id = $_POST['id'];
$sql = $con->prepare("update `apichannel` set `trash`=0 where id =?");
$sql->execute(array($id));
?>
{"success":true}