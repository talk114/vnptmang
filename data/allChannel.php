
<?php
$sql = $con->prepare("Select * from `channel`");
$sql->execute();


foreach($sql->fetchAll() as $rows){
if($rows['alt']=='') $alt = $rows['title'];
else $alt = $rows['alt'];
$content[$rows['groups']] .= '<figure class="channel"><a title="'.$rows['title'].'"  href="'.$rows['url'].'"><img class="imgchl" src="'.$rows['imgsrc'].'" alt="'.$alt.'"/></a><div class="popup" rel=""></div></figure>';
}

?>


<div class="content1">
<?=$content[1];?>
</div>
<div class="content2">
<?=$content[2];?>
</div>
<div class="content3">
<?=$content[3];?>
</div>
<div class="content4">
<?=$content[4];?>
</div>
<div class="content5">
<?=$content[5];?>
</div>
<div class="content6">
<?=$content[6];?>
</div>