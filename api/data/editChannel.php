<?php
if(isset($_POST['submit'])){
$query = $con->prepare("UPDATE `apichannel` SET `name`=?,`imgsrc`=?,`groups`=? where id=?");
$query->execute(array($_POST['name'],$_POST['img'],$_POST['groups'],$extend1));
$sv=0;
$strdel = $_POST['deletededserver']."]";
$strdel = str_replace(",]", "", $strdel);
$del=$con->prepare("DELETE FROM `server` where `id` in (".$strdel.")");
$del->execute();

for($i=0; $i<=sizeof($_POST['url']); $i++){
if($_POST['url'][$i]!=""){
 if($i>$_POST["addedserver"]){
//Thêm server
	$sv++;
	$server = $con->prepare("INSERT INTO `server`(`idchannel`, `server`, `url`, `type`) VALUES (:idchannel, :server, :url, :type)");
	$server->execute(array(":idchannel"=> $extend1, ":server"=>$sv, ":url"=>$_POST['url'][$i], ":type"=>$_POST['type'][$i]));
}else{
	//Cập nhật server
	$sv++;
	$server = $con->prepare("UPDATE `server` SET `server` = ?, `url`=?, `type`=? where `idchannel`=? and `server` = ?");
	$server->execute(array($sv, $_POST['url'][$i], $_POST['type'][$i], $extend1,$i));
}
}
}
$svmobi = $sv - $_POST['trashmobi'];
$svpc = $sv - $_POST['trashpc'];
$update = $con->prepare("Update `apichannel` set `numsv` = ?, `numbersv_mobile`=? where `id` = ?");
$update->execute(array($svpc, $svmobi, $extend1));
//header('Location: /api/');
}else{
$sql = $con->prepare("SELECT * FROM `apichannel` WHERE id=?");
$sql->execute(array($extend1));
$row =$sql->fetch(PDO::FETCH_ASSOC);
$querysv = $con->prepare("SELECT * FROM `server` WHERE `idchannel`=?");
$querysv->execute(array($extend1));
$has_numsv = $querysv->rowCount();
?>
<script>
var num_sv = <?=$has_numsv?>;
$(function(){
$('.delete').click(function(){
if($(this).attr('seq')!=""){
	var str = $(".deletededserver").val();
	str += $(this).attr("cid")+",";
	$(".deletededserver").val(str);	
}
$(this).parent().remove();

});

$('.themserver').click(function(){
	num_sv++;
$('#server').append("<div class='content'>Server "+num_sv+":<input type='text' class='classinput' name='url[]' placeholder='Link ...'><input class='mininput' type='text' name='type[]' placeholder='Kiểu link....'><input type='button' class='delete' seq='added' value='Xoá'><div class='clear'></div></div>");

$('.delete').click(function(){
$(this).parent().remove();
});});
$(".pc").click(function(){
	var value =  parseInt($("#trashpc").val())-1;
	$("#trashpc").val(value);
});
$(".mobi").click(function(){
	var value =  parseInt($("#trashmobi").val())-1;
	$("#trashmobi").val(value);
});
});

</script>
<form name="up2" method="post">
Tên kênh:
<input class="classinput" type="text" name="name" placeholder="Tên kênh..." value="<?=$row['name']?>"><div class="clear"></div>
Tiêu đề:
<input class="classinput" type="text" name="genre" placeholder="Tiêu đề...." value="<?=$row['genre']?>"><div class="clear"></div>
Link Ảnh:
<input class="classinput" type="text" name="img" placeholder="Link ảnh...." value="<?=$row['imgsrc']?>"><div class="clear"></div>
Nhóm:
<input class="classinput" type="text" name="groups" placeholder="Nhóm...." value="<?=$row['groups']?>"><div class="clear"></div>
<section id="server">
<?php
$i=0; $mobi =0; $pc=0;
foreach($querysv->fetchAll() as $rowssv){
$i++;
$more="";
if($rowssv['trashmobi']==1){
 $more .= " mobi";
 $mobi++;
 }
 if($rowssv['trashpc']==1){
 $more .= " pc";
  $pc++;
 }
 ?>
<div class="content">
Server <?=$rowssv['server']?>:
<input class="classinput" type="text" name="url[]" value="<?=$rowssv['url']?>" placeholder="Link Server....">
<input class="mininput" type="text" name="type[]" value="<?=$rowssv['type']?>" placeholder="Kiểu link....">
<input type="button" class="delete<?=$more?>" cid=<?=$rowssv['id']?> value="Xoá"><div class="clear"></div>
</div>
<?php
}
?>
</section>
<div class="themserver">Thêm server</div>
<input type="hidden" name="addedserver" id="addedserver" value="<?=$has_numsv?>">
<input type="hidden" name="deletededserver" class="deletededserver">
<input type="hidden" id="trashpc" name="trashpc" value="<?=$pc?>">
<input type="hidden" id="trashmobi" name="trashmobi" value="<?=$mobi?>">
<input class="button" type="submit" name="submit" value="Gửi">
</form>
<div class="clear"></div>
<div class="info">
<em style="padding-left:100px">
1. M3U8, RTMP<br>
2.VNN<br>
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