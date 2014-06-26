<?php
if(isset($_POST['submit'])){
$query = $con->prepare("UPDATE `channel` SET `url`=?,`title`=?,`imgsrc`=?,`alt`=?,`groups`=? where id=?");
$query->execute(array($_POST['url'],$_POST['title'],$_POST['img'],$_POST['alt'],$_POST['groups'],$extend1));
header('Location: /');
}else{
$sql = $con->prepare("SELECT * FROM `channel` WHERE id=?");
$sql->execute(array($extend1));
$row =$sql->fetch(PDO::FETCH_ASSOC);
?>
<form name="up2" method="post">
URL:
<input class="classinput" type="text" name="url" placeholder="URL..." value="<?=$row['url'?>">
Title Seo URL:
<input class="classinput" type="text" name="title" placeholder="Tiêu đề..."value="<?=$row['title'?>">
Link Ảnh:
<input class="classinput" type="text" name="img" placeholder="Link ảnh...."value="<?=$row['imgsrc'?>">
Alt:
<input class="classinput" type="text" name="alt" placeholder="ALT...."value="<?=$row['alt'?>">
Nhóm:
<input class="classinput" type="text" name="groups" placeholder="Nhóm...."value="<?=$row['groups'?>">
<input class="button" type="submit" name="submit" value="Gửi">
</form>
<?php
}
?>