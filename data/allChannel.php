
<?php
$sql = $con->prepare("Select * from `channel`");
$sql->execute();


foreach($sql->fetchAll() as $rows){
if($rows['alt']=='') $alt = $rows['title'];
else $alt = $rows['alt'];
$content1 .= '<figure class="channel"><a title="'.$rows['title'].'"  href="'.$rows['url'].'"><img class="imgchl" src="'.$rows['imgsrc'].'" alt="'.$alt.'"/></a><div class="popup" rel=''></div></figure>'
}

?>


<div class="content1">
<?=$content1;?>
</div>
