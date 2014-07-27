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
<form name="up2" method="post">
Tên kênh:
<input class="classinput" type="text" name="name" placeholder="Tên kênh...">
Link Ảnh:
<input class="classinput" type="text" name="img" placeholder="Link ảnh....">
Số Server:
<input class="classinput" type="text" name="numsv" placeholder="Số server....">
Nhóm:
<input class="classinput" type="text" name="groups" placeholder="Nhóm....">
<input class="button" type="submit" name="submit" value="Gửi">
</form>
<?php
}
?>
