<?php
if(isset($_POST['submit']) && $_POST['mvname']!=''){
$url = strtolower($_POST['mvname']);
$url = str_replace(' ', '-', $url);
$url = str_replace(':', '', $url);
$url = str_replace('/', '', $url);
$query = $con->prepare("INSERT INTO `channel`(`url`,`title`,`imgsrc`,`alt`,`groups`) VALUES (:url,:title,:img,:alt,:groups)");
$query->execute(array(":url"=> $_POST['url'],":title"=> $_POST['title'],":img"=> $_POST['img'],":alt"=> $_POST['alt'],":groups"=> $_POST['groups']));
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
