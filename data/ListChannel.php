<?php
$sql = $con->prepare("Select * from `channel`");
$sql->execute(array());
$query = $sql->fetchAll(PDO::FETCH_ASSOC);
?>
<script>
$(function(){
$('.delete').click(function(){
$.post("/delChannel.php", {id:$(this).attr('idmv')}, function(suc){
if(suc.success==true){
$('.notice').css({'right':10});
$('.notice').text('Đã xóa thành công!');
setTimeout(function(){$('.notice').css({'right':-500});}, 2000);
$(this).parent().hide();
}else{
$('.notice').css({'right':10});
$('.notice').text('Lỗi không thể xóa được!');
setTimeout(function(){$('.notice').css({'right':-500});}, 2000);

}
},"json");
});
$('.notice .close').click(function(){
$('.notice').css({'right':-500});
});
});
</script>
<div class="notice"><span class="close">x</span></div>

<table class="table">
<thead>
<tr>
<th>Tên phim
<th>Chức năng
<tbody>
<?php
foreach($query as $rows){
?>
<tr>
<td class="tdname"><div class="maxcontent"><a href="http://phim.vnptmang.com/phim-<?=$rows['url']?>/1/1"><?=$rows['name']?></a></div>
<td class="function"><div class="maxcontent"><a href="/editChannel/<?=$rows['id']?>">Sửa Thông tin</a> / <a class="delete" idmv="<?=$rows['id']?>" href="#">Xóa</a></div>
<?php
}
?>



