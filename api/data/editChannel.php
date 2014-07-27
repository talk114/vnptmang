<?php
if(isset($_POST['submit'])){
$query = $con->prepare("UPDATE `apichannel` SET `name`=?,`imgsrc`=?,`numsv`=?, `groups`=? where id=?");
$query->execute(array($_POST['name'],$_POST['img'],$_POST['numsv'],$_POST['groups'],$extend1));
header('Location: /');
}else{
$sql = $con->prepare("SELECT * FROM `apichannel` WHERE id=?");
$sql->execute(array($extend1));
$row =$sql->fetch(PDO::FETCH_ASSOC);
?>
<form name="up2" method="post">
Tên kênh:
<input class="classinput" type="text" name="name" placeholder="Tên kênh..." value="<?=$row['name']?>">
Link Ảnh:
<input class="classinput" type="text" name="img" placeholder="Link ảnh...." value="<?=$row['imgsrc']?>">
Số Server:
<input class="classinput" type="text" name="numsv" placeholder="Số Server...." value="<?=$row['numsv']?>">
Nhóm:
<input class="classinput" type="text" name="groups" placeholder="Nhóm...." value="<?=$row['groups']?>">
<input class="button" type="submit" name="submit" value="Gửi">
</form>
<?php
}
?>