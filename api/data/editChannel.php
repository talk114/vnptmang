<?php
if(isset($_POST['submit'])){
$query = $con->prepare("UPDATE `apichannel` SET `name`=?,`imgsrc`=?,`groups`=? where id=?");
$query->execute(array($_POST['name'],$_POST['img'],$_POST['groups'],$extend1));
$sv=0;
echo $_POST["deletededserver"];

for($i=1; $i<=$_POST['soserver']; $i++){
if(strpos($_POST["deletededserver"], "$i")){
//Xoá server
$server=$con->prepare("DELETE FROM `server` where idchannel = ?  and server = ?");
$server->execute(array($extend1, $i));
}
else if($i>$_POST["addedserver"]&& $_POST['url'][$i]!=""){
//Thêm server
$sv++;
$server = $con->prepare("INSERT INTO `server`(`idchannel`, `server`, `url`, `type`, `device`) VALUES (:idchannel, :server, :url, :type, :device)");
$server->execute(array(":idchannel"=> $extend1, ":server"=>$sv, ":url"=>$_POST['url'][$i], ":type"=>$_POST['type'][$i], ":device"=>$_POST['device'][$i]));
}
else{
//Cập nhật server
if($_POST['url'][$i]!=""){
$sv++;
$server = $con->prepare("UPDATE `server` SET `server`=?, `url`=?, `type`=?, `device`=? where `idchannel`=?");
$server->execute(array($sv, $_POST['url'][$i], $_POST['type'][$i], $_POST['device'][$i], $extend1));
}
}
}
$update = $con->prepare("Update `apichannel` set `numsv` = ? where `id` = ?");
$update->execute(array($sv, $extend1));
header('Location: /api/');
}else{
$sql = $con->prepare("SELECT * FROM `apichannel` WHERE id=?");
$sql->execute(array($extend1));
$row =$sql->fetch(PDO::FETCH_ASSOC);
$querysv = $con->prepare("SELECT * FROM `server` WHERE `idchannel`=?");
$querysv->execute(array($extend1));
?>
<script>
$(function(){
$('.delete').click(function(){
$(this).parent().remove();
if(parseInt($(this).attr('sequence'))<= parseInt($("#addedserver").val())){
var str = $(".deletededserver").val();
str += ","+$(this).attr("sequence")+" ";
$(".deletededserver").val(str);
}
});

$('.themtapphim').click(function(){
var crEp = $("#soserver").attr("value");
var nextEp = parseInt(crEp)+1;
$('#server').append("<div class='content'>Server "+nextEp+":<br><input type='text' class='classinput' name='url["+nextEp+"]' placeholder='Link ...'><input class='mininput' type='text' name='type["+nextEp+"]' placeholder='Kiểu link....'><input class='mininput' type='text' name='device["+nextEp+"]' placeholder='Thiết bị....'><input type='button' class='delete' sequence="+nextEp+" value='Xoá'></div>");
$("#soserver").attr("value", nextEp);
$('.delete').click(function(){
$(this).parent().remove();
});});

});

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
foreach($querysv->fetchAll() as $rowssv){
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
<input type="hidden" name="soserver" id="soserver" value="<?php if($row['numsv']=="") echo "0"; else echo $row['numsv']; ?>">
<input type="hidden" name="addedserver" id="addedserver" value="<?php if($row['numsv']=="") echo "0"; else echo $row['numsv']; ?>">
<input type="hidden" name="deletededserver" class="deletededserver">
<input class="button" type="submit" name="submit" value="Gửi">
</form>
<div class="info">
<em style="padding-left:100px">
1. M3U8, RTMP<br>
2.VNN
3. FPT<br>
4. VNPT<br>
5. Clip<br>
6. HTV<br>
7. VTVplus<br>
8. VTVPlay<br>
9. Yeah1<br>
Thiết bị:<br>
0. Tất cả<br>
1. PC
</em>
</div>
<?php
}
?>