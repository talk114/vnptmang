<?php
$sql = $con->prepare("Select * from `channel` where trash = 0 order by `sort`");
$sql->execute();


foreach($sql->fetchAll() as $rows){
if($rows['alt']=='') $alt = $rows['title'];
else $alt = $rows['alt'];
$content[$rows['groups']] .= '<figure class="channel"><a title="'.$rows['title'].'"  href="'.$rows['url'].'"><img class="imgchl" src="'.$rows['imgsrc'].'" alt="'.$alt.'"/></a><div class="popup" rel=""></div></figure>';
}

?>
<script>
$(function(){
$('#send').click(function(){
$.post("http://vnptmang.com/wp-content/themes/VNPTmang/tap.php", {content:$('#vnptmang').html()});
});
});
</script>
<input type="button" id="send"  value="Set List Channel">
<div id="vnptmang"><div class="content1"><?=$content[1];?></div><div class="content2"><?=$content[2];?></div><div class="content3"><?=$content[3];?></div><div class="content4"><?=$content[4];?></div><div class="content5"><?=$content[5];?></div><div class="content6"><?=$content[6];?></div></div>