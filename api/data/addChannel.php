<?php
if(isset($_POST['submit']) && $_POST['name']!=''){
$sql = $con->prepare("SELECT MAX(sort) FROM `apichannel` where `groups`=?");
$sql->execute(array($_POST['groups']));
$row = $sql->fetch(PDO::FETCH_ASSOC);
$next_sort = $row['MAX(sort)']+10;
$query = $con->prepare("INSERT INTO `apichannel`(`name`,`imgsrc`,`numsv`,`groups`,`sort`) VALUES (:name,:img,:numsv,:groups,:sort)");
$query->execute(array(":name"=> $_POST['name'],":img"=> $_POST['img'],":numsv"=> $_POST['numsv'],":groups"=> $_POST['groups'],":sort"=>$next_sort));
header("Location: /");
}else{
?>
<script>
$(function(){
$('.themtapphim').click(function(){
var crEp = $("#soserver").attr("value");
var nextEp = parseInt(crEp)+1;
$('.server').append("Tập "+nextEp+":<br><input type='text' class='classinput' name='server["+nextEp+"]' placeholder='Mã phim ...'><input class='classinput' type='text' name='type[1]' placeholder='Kiểu link....'><input class='classinput' type='text' name='device[1]' placeholder='Thiết bị....'>");
$("#soserver").attr("value", nextEp);
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
Server 1:
<input class="classinput" type="text" name="server[1]" placeholder="Link Server....">
<input class="classinput" type="text" name="type[1]" placeholder="Kiểu link....">
<input class="classinput" type="text" name="device[1]" placeholder="Thiết bị....">
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
