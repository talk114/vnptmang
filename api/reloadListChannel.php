<?php
include_once("mysql.php");
$sql = $con->prepare("Select * from `apichannel` where trash=0 order by `sort`");
$sql->execute(array());
$query = $sql->fetchAll(PDO::FETCH_ASSOC);
?>
<?php
foreach($query as $rows){
?>
<tr>
<td class="tdname"><div class="maxcontent"><?=$rows['name']?></div>
<td class="function"><div class="maxcontent"><a href="/editChannel/<?=$rows['id']?>">Sửa Thông tin</a></div>
<td class="delete" idmv="<?=$rows['id']?>">Xóa
<?php
}
?>



