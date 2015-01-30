<?php
include_once("../mysql.php");
$sql = $con->prepare("Select * from `apichannel` where trash=0 order by `sort`");
$sql->execute(array());
$query = $sql->fetchAll(PDO::FETCH_ASSOC);
?>
<?php
$arr = array("", "Link M3u8", "VNN", "FPT", "VNPT", "Clip", "HTVOnline", "VTVplus", "VTVplay", "Social", "Movie", "TV VNN");
foreach($query as $rows){
	$str .= $arr[$row['type']]." ,";
?>
<tr>
<td class="tdname"><div class="maxcontent"><?=$rows['name']?></div>
<td class="function"><div class="maxcontent"><a href="/api/index.php/editChannel/<?=$rows['id']?>">Sửa Thông tin</a></div>
<td class="tdname"><div class="maxcontent">PC: <?=$rows['numsv']?> / Mobi: <?=$rows['numbersv_mobile']?></div>
<td class="detail"><div class="maxcontent"><?=$str?></div>
<td class="delete" idmv="<?=$rows['id']?>">Xóa
<?php
}
?>



