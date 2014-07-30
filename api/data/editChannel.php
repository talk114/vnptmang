<?php
if(isset($_POST['submit'])){
$query = $con->prepare("UPDATE `apichannel` SET `name`=?,`imgsrc`=?,`numsv`=?, `groups`=? where id=?");
$query->execute(array($_POST['name'],$_POST['img'],$_POST['numsv'],$_POST['groups'],$extend1));
$idchannel = $con->lastInsertId();
$sv=0;
for($i=1; $i<=$_POST['soserver']; $i++){
if(!strpos($i, $_POST["serverdeleted"])){
$sv++;
$server = $con->prepare("INSERT INTO `server`(`idchannel`, `server`, `url`, `type`, `device`) VALUES (:idchannel, :server, :url, :type, :device)");
$server->execute(array(":idchannel"=> $idchannel, ":server"=>$sv, ":url"=>$_POST['url'][$i], ":type"=>$_POST['type'][$i], ":device"=>$_POST['device'][$i]));
}

}
$update = $con->prepare("Update apichannel set numsv = ? where id = ?");
$update->execute(array($sv, $idchannel));
header('Location: /');
}else{
$sql = $con->prepare("SELECT * FROM `apichannel` WHERE id=?");
$sql->execute(array($extend1));
$row =$sql->fetch(PDO::FETCH_ASSOC);
$querysv = $con->prepare("SELECT * FROM `server` WHERE `idchannel`=?");
$querysv->execute(array($extend1));
?>
<script>
$(function(){
$('.themtapphim').click(function(){
var crEp = $("#soserver").attr("value");
var nextEp = parseInt(crEp)+1;
$('#server').append("<div class='content'>Server "+nextEp+":<br><input type='text' class='classinput' name='server["+nextEp+"]' placeholder='Link ...'><input class='mininput' type='text' name='type["+nextEp+"]' placeholder='Kiểu link....'><input class='mininput' type='text' name='device["+nextEp+"]' placeholder='Thiết bị....'><input type='button' class='delete' sequence="+nextEp+" value='Xoá'></div>");
$("#soserver").attr("value", nextEp);
deletesv();
});
deletesv();
});
function deletesv(){
$('.delete').click(function(){
$(this).parent().remove();
int i = parseInt($("#soserver").val())-1;
$("#soserver").val(i);
var str = $("#serverdeleted").val();
str += ","+$(this).attr("sequence");
$("#serverdeleted").val(str);
});
}
</script>
<form name="up2" method="post">
Tên kênh:
<input class="classinput" type="text" name="name" placeholder="Tên kênh..." value="<?=$row['name']?>">
Tiêu đề:
<input class="classinput" type="text" name="genre" placeholder="Tiêu đề...." value="<?=$row['genre']?>">
Link Ảnh:
<input class="classinput" type="text" name="img" placeholder="Link ảnh...." value="<?=$row['imgsrc']?>">
Nhóm:
<input class="classinput" type="text" name="groups" placeholder="Nhóm...." value="<?=$row['groups']?>">
<section id="server">
<?php
$i=0;
foreach($querysv->fetchAll() as rowssv){
$i++;
?>
<div class="content">
Server <?=$rowssv['server']?>:
<input class="classinput" type="text" name="url[<?=$i?>]" value="<?=$rowssv['url']?>" placeholder="Link Server....">
<input class="mininput" type="text" name="type[<?=$i?>]" value="<?=$rowssv['type']?>" placeholder="Kiểu link....">
<input class="mininput" type="text" name="device[<?=$i?>]" value="<?=$rowssv['device']?>" placeholder="Thiết bị....">
<input type="button" class="delete" sequence=<?=$i?> value="Xoá">
</div>
<?php
}
?>
</section>
<div class="themtapphim">Thêm server</div>
<input type="hidden" name="soserver" id="soserver" value="<?=$row['numsv']?>">
<input type="hidden" name="addedserver" id="addedserver" value="">
<input type="hidden" name="deletededserver" id="deletededserver" value="">
<input class="button" type="submit" name="submit" value="Gửi">
</form>
<div class="info">
<em style="padding-left:100px">1. M3U8, RTMP<br>
2. HTV, VTVplus, VTVPlay<br>
3. FPT<br>
4. VNPT<br>
5. Clip<br>
Thiết bị:<br>
0. Tất cả<br>
1. PC
</em>
</div>
<?php
}
?>