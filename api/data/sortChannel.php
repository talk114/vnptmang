<?php
$group= $extend1;
$tv = $con->prepare("select * from `apichannel` where `groups` = ? order by `sort`");
$tv->execute(array($group));
$sl = $tv->rowCount();
echo $sl;
?>
<form name="up" action="#" method="post">
<?php
$j=0;
foreach($tv->fetchAll() as $row){
    $j++;
?>
<input class="button" type="text" readonly name="name[<?=$j?>]" value="<?=$row['name']?>">
<input class="button" type="text" name="sx[<?=$j?>]" value="<?=$row['sort']?>"><br/>
<input type="hidden" name="id[<?=$j?>]" value="<?=$row['id']?>">
<?php
}
?>
<input class="button" type="submit" name="submit" value="Gửi">
</form>
<?php
if(isset($_POST['submit'])){
for($i=1; $i<=$sl; $i++){
$kenh = $_POST['name'][$i];  
$id = $_POST['id'][$i];
$sx = $_POST[sx][$i];   
$query2 = $con->prepare("UPDATE `apichannel` SET `sort` = ? where `id` = ?");
$query2->execute(array($sx, $id));
}
header("Location: /");
}
?>