<?php
$group= $extend1;
$tv = $con->prepare("select * from `channel` where `groups` = ? order by `sort`");
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
<input class="button" type="text" readonly name="url[<?=$j?>]" value="<?=$row['url']?>">
<input class="button" type="text" name="sx[<?=$j?>]" value="<?=$row['sort']?>"><br/>
<?php
}
?>
<input class="button" type="submit" name="submit" value="Gửi">
</form>
<?php
if(isset($_POST['submit'])){
for($i=1; $i<=$sl; $i++){
$kenh = $_POST['url'][$i];   
$sx = $_POST[sx][$i];   
$query2 = $con->prepare("UPDATE `channel` SET `sort` = ? where `url` = ?");
$query2->execute(array($sx, $kenh));
}
header("Location: /");
}
?>