<?php
if(isset($_POST['submit']) && $_POST['name']!=''){
$sql = $con->prepare("SELECT MAX(sort) FROM `apichannel` where `groups`=?");
$sql->execute(array($_POST['groups']));
$row = $sql->fetch(PDO::FETCH_ASSOC);
$next_sort = $row['MAX(sort)']+10;
$query = $con->prepare("INSERT INTO `apichannel`(`name`,`genre`,`imgsrc`,`groups`,`sort`) VALUES (:name,:genre,:img,:groups,:sort)");
$query->execute(array(":name"=> $_POST['name'],":genre"=>$_POST['genre'],":img"=> $_POST['img'],":groups"=> $_POST['groups'],":sort"=>$next_sort));
$idchannel = $con->lastInsertId();
$sv=0;
for($i=1; $i<=$_POST['soserver']; $i++){
if(!strpos($i, $_POST["serverdeleted"]) && $_POST['url'][$i]!=""){
$sv++;
$server = $con->prepare("INSERT INTO `server`(`idchannel`, `server`, `url`, `type`, `device`) VALUES (:idchannel, :server, :url, :type, :device)");
$server->execute(array(":idchannel"=> $idchannel, ":server"=>$sv, ":url"=>$_POST['url'][$i], ":type"=>$_POST['type'][$i], ":device"=>$_POST['device'][$i]));
}
}
$update = $con->prepare("Update apichannel set numsv = ? where id = ?");
$update->execute(array($sv, $idchannel));
header("Location: /api/");
}else{
?>
<script>
$(function(){
$('.themtapphim').click(function(){
deletesv();
var crEp = $("#soserver").attr("value");
var nextEp = parseInt(crEp)+1;
$('#server').append("<div class='content'>Server "+nextEp+":<br><input type='text' class='classinput' name='url["+nextEp+"]' placeholder='Link ...'><input class='mininput' type='text' name='type["+nextEp+"]' placeholder='Kiểu link....'><input class='mininput' type='text' name='device["+nextEp+"]' placeholder='Thiết bị....'><input type='button' class='delete' sequence="+nextEp+" value='Xoá'></div>");
$("#soserver").attr("value", nextEp);
deletesv();
});

});
function deletesv(){
$('.delete').click(function(){
var str = $("#serverdeleted").val();
str += ","+$(this).attr("sequence");
$("#serverdeleted").val(str);
$(this).parent().remove();
});
}
</script>

<form name="up2" method="post">
Tên kênh:
<input class="classinput" type="text" name="name" placeholder="Tên kênh...">
Tiêu đề:
<input class="classinput" type="text" name="genre" placeholder="Tiêu đề...">
Link Ảnh:
<input class="classinput" type="text" name="img" placeholder="Link ảnh....">
Nhóm:
<input class="classinput" type="text" name="groups" placeholder="Nhóm....">
<section id="server">
<div class="content">
Server 1:
<input class="classinput" type="text" name="url[1]" placeholder="Link Server....">
<input class="mininput" type="text" name="type[1]" placeholder="Kiểu link....">
<input class="mininput" type="text" name="device[1]" placeholder="Thiết bị....">
<input type="button" class="delete" sequence=1 value="Xoá">
</div>
</section>
<div class="themtapphim">Thêm server</div>
<input type="hidden" name="soserver" id="soserver" value="1">
<input type="hidden" name="serverdeleted" id="serverdeleted" value="">
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
