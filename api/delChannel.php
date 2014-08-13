<?php
include("/mysql.php");
$id = $_POST['id'];
$sql = $con->prepare("update `apichannel` set `trash`=1 where id =?");
$sql->execute(array($id));
?>
{"success":true}

