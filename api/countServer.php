<?php
include_once("mysql.php");
$sql = $con->prepare("Select * from `apichannel` where trash=0");
$sql->execute(array());
$query = $sql->fetchAll(PDO::FETCH_ASSOC);
foreach($query as $rows){	
$pc=0;
$mb=0;
	$server = $con->prepare("Select * from `server` where `idchannel`=?");
	$server->execute(array($rows['id']));
	foreach($server->fetchAll() as $srow){
		$select = $con->prepare("SELECT * FROM `trash` where `type` = ? limit 1");
		$select->execute(array($srow['type']));
		$row = $select->fetch(PDO::FETCH_ASSOC);
		if(sizeof($row)>0){	
			if($row['device']==0&&$row['type']!="") $pc++;
			else if($row['device']==1) $mb++;
		}
	}
	$svpc = $server->rowCount() - $pc;
	$svmobi = $server->rowCount() - $mb;
	$update = $con->prepare("Update `apichannel` set `numsv` = ?, `numbersv_mobile`=? where `id` = ?");
	$update->execute(array($svpc, $svmobi, $rows['id']));
}
?>




