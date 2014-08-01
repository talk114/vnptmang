<?php
$sql = $con->prepare("Select * from `apichannel` where trash=0 order by `sort`");
$sql->execute(array());
$query = $sql->fetchAll(PDO::FETCH_ASSOC);
?>
<style>

.delete{
display:inline;
cursor:pointer;
background-color:#646464;
color:white;
padding:5px;
}
</style>
<script>
$(function(){
$('.delete').click(function(){
$.post("/api/delChannel.php", {id:$(this).attr('idmv')}, function(suc){
if(suc.success==true){
$('.notice').css({'right':10});
$('.notice').text('Đã xóa thành công!');
setTimeout(function(){$('.notice').css({'right':-500});}, 2000);
$.post("/api/reloadListChannel.php", function(data){
$(".table tbody").html(data);
});

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
<th>Tên kênh
<th>Chức năng
<tbody>
<?php
foreach($query as $rows){
?>
<tr>
<td class="tdname"><div class="maxcontent"><?=$rows['name']?></div>
<td class="function"><div class="maxcontent"><a href="/api/index.php/editChannel/<?=$rows['id']?>">Sửa Thông tin</a></div>
<td class="delete" idmv="<?=$rows['id']?>">Xóa
<?php
}
?>



