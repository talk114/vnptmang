<?php
if(isset($_POST['submit'])){
$query = $con->prepare("SELECT * FROM `server` where type = ?");
$query->execute(array($_POST['server']));
foreach($query->fetchAll() as $row){
$update1 = $con->prepare("UPDATE `server` SET `trashmobi` = 0 WHERE `id` = ? ");
$update1->execute(array($row['id']));
$query2 = $con->prepare("SELECT `numbersv_mobile` FROM `apichannel` WHERE `id` = ?");
$query2->execute(array($row['idchannel']));
$rw = $query2->fetch(PDO::FETCH_ASSOC);
$n = $rw['numbersv_mobile']+1;
$update2 = $con->prepare("UPDATE `apichannel` SET `numbersv_mobile` = ? WHERE `id` = ? ");
$update2->execute(array($n, $row['idchannel']));
}
header('Location: /api/');
}else{
?>
<form name="up2" method="post">
Mã Server:
<input class="classinput" type="text" name="server" placeholder="Mã Server...">
<input class="button" type="submit" name="submit" value="Khôi phục">
</form>
<br>
<br>
<div class="clear"></div>
<div class="info">
<em style="padding-left:100px">
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