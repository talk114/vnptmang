<?php
if(isset($_POST['submit'])){
$query = $con->prepare("DELETE FROM `trash` where `type` = ? and `device`=?");
$query->execute(array($_POST['server'], $_POST['device']));
der('Location: /api/');
}else{
?>
<form name="up2" method="post">
Mã Server:
<input class="classinput" type="text" name="server" placeholder="Mã Server...">
<select name="device">
	<option value="0" selected>PC</option>
	<option value="1">Mobile</option>
</select>
<input class="button" type="submit" name="submit" value="Khôi phục">
</form>
<br>
<br>
<div class="clear"></div>


<div class="info"  style="padding-left:100px">
<pre>
	<p>SERVER đã xóa:
	</p>
	<?php	
	$select = $con->prepare("SELECT * FROM `trash`");
	$select->execute(array());
	$i=0;
	$arr = array("", "Link M3u8", "VNN", "FPT", "VNPT", "Clip", "HTVOnline", "VTVplus", "VTVplay", "Social", "Movie", "TV VNN");
	$arr2= array("PC", "Mobile");
	foreach($select->fetchAll() as $row){
		echo ($i+1).": ".$arr2[$row['device']]." - ".$arr[$row['type']]."(".$row['type'].")"."<br>";
	}		
	?>
</pre>
<br>
<em>
1. M3U8, RTMP<br>
2. VNN<br>
3. FPT<br>
4. VNPT<br>
5. Clip<br>
6. HTV<br>
7. VTVplus<br>
8. VTVPlay<br>
9. Yeah1<br>
</em>
</div>
<?php
}
?>