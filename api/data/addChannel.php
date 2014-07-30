<?php
if(isset($_POST['submit']) && $_POST['name']!=''){
$sql = $con->prepare("SELECT MAX(sort) FROM `apichannel` where `groups`=?");
$sql->execute(array($_POST['groups']));
$row = $sql->fetch(PDO::FETCH_ASSOC);
$next_sort = $row['MAX(sort)']+10;
$query = $con->prepare("INSERT INTO `apichannel`(`name`,`imgsrc`,`numsv`,`groups`,`sort`) VALUES (:name,:img,:numsv,:groups,:sort)");
$query->execute(array(":name"=> $_POST['name'],":img"=> $_POST['img'],":numsv"=> $_POST['numsv'],":groups"=> $_POST['groups'],":sort"=>$next_sort));
$idchannel = $query->lastInsertId();
for($i=1; $i<=$_POST['soserver']; $i++){
$server = $con->prepare("INSERT INTO `server`(`idchannel`, `server`, `url`, `type`, `device`) VALUES (:idchannel, :server, :url, :type, :device)");
$server->execute(array(":idchannel"=> $idchannel, ":server"=>$i, ":url"=>$_POST['url'][$i], ":type"=>$_POST['type'][$i], ":device"=>$_POST['device'][$i]);
}
header("Location: /");
}else{
?>
<script>
$(function(){
$('.themtapphim').click(function(){
var crEp = $("#soserver").attr("value");
var nextEp = parseInt(crEp)+1;
$('#server').append("<div class='content'>Server "+nextEp+":<br><input type='text' class='classinput' name='server["+nextEp+"]' placeholder='Link ...'><input class='mininput' type='text' name='type["+nextEp+"]' placeholder='Kiểu link....'><input class='mininput' type='text' name='device["+nextEp+"]' placeholder='Thiết bị....'><input type='button' class='delete' value='Xoá'></div>");
$("#soserver").attr("value", nextEp);
});
$('.delete').click(function(){
$(this).parent().remove();
var i = parseInt($("#soserver").val());
$("#soserver").val(i-1);
});
});
</script>

<form name="up2" method="post">
Tên kênh:
<input class="classinput" type="text" name="name" placeholder="Tên kênh...">
Tiêu đề:
<input class="classinput" type="text" name="name" placeholder="Tiêu đề...">
Link Ảnh:
<input class="classinput" type="text" name="img" placeholder="Link ảnh....">
Số Server:
<input class="classinput" type="text" name="numsv" placeholder="Số server....">
Nhóm:
<input class="classinput" type="text" name="groups" placeholder="Nhóm....">
<section id="server">
<div class="content">
Server 1:
<input class="classinput" type="text" name="url[1]" placeholder="Link Server....">
<input class="mininput" type="text" name="type[1]" placeholder="Kiểu link....">
<input class="mininput" type="text" name="device[1]" placeholder="Thiết bị....">
<input type="button" class="delete" value="Xoá">
</div>
<div class="themtapphim">Thêm server</div>
<input type="hidden" name="soserver" id="soserver" value="1">
</section>
<input class="button" type="submit" name="submit" value="Gửi">
</form>
<div class="info">
<em>1. M3U8, RTMP<br>
2. HTV, VTVplus, VTVPlay<br>
3. FPT<br>
4. VNPT<br>
5. Clip<br>
</em>
</div>
<?php
}
?>
