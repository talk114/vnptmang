<?php
if(isset($_POST['submit']) && $_POST['url']!=''){
$sql = $con->prepare("SELECT MAX(sort) FROM `channel` where `groups`=?");
$sql->execute(array($_POST['groups']));
$row = $sql_fecth(PDO::FETCH_ASSOC);
$next_sort = $row['MAX(sort)']+10;
$query = $con->prepare("INSERT INTO `channel`(`url`,`title`,`imgsrc`,`alt`,`groups`,`sort`) VALUES (:url,:title,:img,:alt,:groups,:sort)");
$query->execute(array(":url"=> $_POST['url'],":title"=> $_POST['title'],":img"=> $_POST['img'],":alt"=> $_POST['alt'],":groups"=> $_POST['groups'],":sort"=>$next_sort));
header("Location: /");
}else{
?>
<form name="up2" method="post">
URL:
<input class="classinput" type="text" name="url" placeholder="URL...">
Title Seo URL:
<input class="classinput" type="text" name="title" placeholder="Tiêu đề...">
Link Ảnh:
<input class="classinput" type="text" name="img" placeholder="Link ảnh....">
Alt:
<input class="classinput" type="text" name="alt" placeholder="ALT....">
Nhóm:
<input class="classinput" type="text" name="groups" placeholder="Nhóm....">
<input class="button" type="submit" name="submit" value="Gửi">
</form>
<?php
}
?>
