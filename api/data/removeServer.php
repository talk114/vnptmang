﻿<?php
if(isset($_POST['submit'])){
/*
$query = $con->prepare("SELECT * FROM `server` where type = ?");
$query->execute(array($_POST['server']));
if($_POST['device']==0){
	foreach($query->fetchAll() as $row){
		$update1 = $con->prepare("UPDATE `server` SET `trashpc` = 1 WHERE `id` = ? ");
		$update1->execute(array($row['id']));
		$query2 = $con->prepare("SELECT `numsv` FROM `apichannel` WHERE `id` = ?");
		$query2->execute(array($row['idchannel']));
		$rw = $query2->fetch(PDO::FETCH_ASSOC);
		$n = $rw['numsv']-1;
		$update2 = $con->prepare("UPDATE `apichannel` SET `numsv` = ? WHERE `id` = ? ");
		$update2->execute(array($n, $row['idchannel']));
	}
}else{
	foreach($query->fetchAll() as $row){
		$update1 = $con->prepare("UPDATE `server` SET `trashmobi` = 1 WHERE `id` = ? ");
		$update1->execute(array($row['id']));
		$query2 = $con->prepare("SELECT `numbersv_mobile` FROM `apichannel` WHERE `id` = ?");
		$query2->execute(array($row['idchannel']));
		$rw = $query2->fetch(PDO::FETCH_ASSOC);
		$n = $rw['numbersv_mobile']-1;
		$update2 = $con->prepare("UPDATE `apichannel` SET `numbersv_mobile` = ? WHERE `id` = ? ");
		$update2->execute(array($n, $row['idchannel']));
	}
}*/
$insert = $con->prepare("INSERT INTO `trash`(`device`, `type`) VALUES(:d, :t)");
$insert->execute(array(":d"=>$_POST['device'], ":t"=>$_POST['server']));
header('Location: /api/');
}else{
?>
<form name="up2" method="post">
Mã Server:
<input class="classinput" type="text" name="server" placeholder="Mã Server...">
<select name="device">
	<option value="0" selected>PC</option>
	<option value="1">Mobile</option>
</select>
<input class="button" type="submit" name="submit" value="Xóa server">
</form>
<div class="clear"></div>
<br><br>
<div class="info"  style="padding-left:100px">
<em>
1. M3U8, RTMP<br>
2. VNN<br>
3. FPT<br>
4. VNPT<br>
5. Clip<br>
6. HTV<br>
7. VTVplus<br>
8. VTVPlay<br>
9. Yeah1<br>
</em>
</div>
<?php
}
?>