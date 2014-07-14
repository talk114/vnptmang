<?php
include("mysql.php");
$id = $_POST['id'];
$sql = $con->prepare("update `channel` set `trash`=1 where id =?");
$sql->execute(array($id));
?>
{"success":true}