<?php
if(isset($_POST['submit'])){
$query = $con->prepare("UPDATE `movie` SET `name`=?, `ename`=?, `director`=?, `actor`=?,`country`=?, `year`=?, `image`=?,`imdb`=?,`quality`=?,`intro`=?,`productor`=?,`genre`=?, `duration`=? where id=?");
$query->execute(array($_POST['mvname'],$_POST['ename'],$_POST['director'],$_POST['actor'],$_POST['country'],$_POST['year'],$_POST['image'],$_POST['imdb'],$_POST['quality'],$_POST['intro'],$_POST['productor'],$_POST['genre'],$_POST['duration'],$extend1));
header('Location: http://cmv.vnptmang.com/');
}else{
$sql = $con->prepare("SELECT * FROM `movie` WHERE id=?");
$sql->execute(array($extend1));
$row =$sql->fetch(PDO::FETCH_ASSOC);
?>
<script>
$(function(){
var valuegen = $('.inputgenre').attr('value');
var temp = valuegen.split(",");
var idarr = ['hai', 'kinhdi', 'vientuong', 'hanhdong', 'tinhcam', 'hoathinh','phieuluu','hinhsu','phimhay'];
var number = [1,2,3,4,5,6,7,8,9];
var array = ['Hài', 'Kinh dị', 'Viễn tưởng', 'Hành động', 'Tình cảm', 'Hoạt hình','Phiêu lưu','Hình sự', 'Phim Hay'];
for(var i=0; i<temp.length; i++){
if(temp[i]==1){$('#genre').append("<div class='tlgenre'>" + array[0]+" <span class='close' val='0'>x</span></div>");$('#hai').hide();}
else if(temp[i]==2) {
$('#kinhdi').hide();
$('#genre').append("<div class='tlgenre'>" + array[1]+"<span class='close' val='1'>x</span></div>");
}
else if(temp[i]==3){$('#genre').append("<div class='tlgenre'>"+ array[2]+"<span class='close' val='2'>x</span></div>"); $('#vientuong').hide();}
else if(temp[i]==4){$('#genre').append("<div class='tlgenre'>" + array[3]+"<span class='close' val='3'>x</span></div>"); $('#hanhdong').hide();}
else if(temp[i]==5){$('#genre').append("<div class='tlgenre'>" + array[4]+"<span class='close' val='4'>x</span></div>"); $('#tinhcam').hide();}
else if(temp[i]==6){$('#genre').append("<div class='tlgenre'>" + array[5]+"<span class='close' val='5'>x</span></div>"); $('#hoathinh').hide();}
else if(temp[i]==9){$('#genre').append("<div class='tlgenre'>" + array[6]+"<span class='close' val='6'>x</span></div>"); $('#phimhay').hide();}
else{
}
}
$('.buttongen').click(function(){
var value = parseInt($(this).attr('value'));
console.log(value);
var valuegen = $('.inputgenre').attr('value');
var newvalue = valuegen+value+',';
$('.inputgenre').attr('value', newvalue);
$('#genre').append("<div class='tlgenre'>" + array[number.indexOf(value)]+"<span class='close' val='"+number.indexOf(value)+"'>x</span></div>");
close(idarr);
$(this).fadeOut(1000);
return false;
});
close(idarr);


});
function close(idarr){
$('#genre .close').on('click', function(){
var id =$(this).attr('val');
$('#'+idarr[id]).fadeIn(500);
$(this).parent().remove();
$(this).remove();
});
}
</script>
<form name="up2" method="post">
Tên phim: 
<input class="classinput" type="text" name="mvname" value='<?=$row['name']?>'>
Tên tiếng Anh:
<input class="classinput" type="text" name="ename" placeholder="Tên phim bằng tiếng anh..." value='<?=$row['ename']?>'>
Link Ảnh:
<input class="classinput" type="text" name="image" placeholder="Link ảnh...." value='<?=$row['image']?>'>
Đạo diễn:
<input class="classinput" type="text" name="director" placeholder="Đạo diễn...." value='<?=$row['director']?>'>
Diễn viên:
<input class="classinput" type="text" name="actor" placeholder="Diễn Viên...." value='<?=$row['actor']?>'>
Nhà sản xuất:
<input class="classinput" type="text" name="productor" placeholder="Nhà Sản xuất...." value='<?=$row['productor']?>'>
Năm sản xuất:
<input class="classinput" type="text" name="year" placeholder="Năm Sản xuất...." value='<?=$row['year']?>'>
Quốc gia:
<input class="classinput" type="text" name="country" placeholder="Quốc gia...." value='<?=$row['country']?>'>
Điểm IMDb:
<input class="classinput" type="text" name="imdb" placeholder="IMDb...." value='<?=$row['imdb']?>'>
Thời lượng:
<input class="classinput" type="text" name="duration" placeholder="Thời lượng...." value='<?=$row['duration']?>'>

Giới thiệu:<br>
<textarea name="intro" placeholder="Giới thiệu..."><?=$row['intro']?></textarea>
<br>Thể loại:
<div id="genre"></div><div class="clear"></div>
<button class="buttongen" id="hai" value="1">Hài</button>
<button class="buttongen" id="kinhdi" value="2">Kinh dị</button>
<button class="buttongen" id="vientuong" value="3">Viễn tưởng</button>
<button class="buttongen" id="hanhdong" value="4">Hành động</button>
<button class="buttongen" id="tinhcam" value="5">Tình cảm</button>
<button class="buttongen" id="hoathinh" value="6">Hoạt hình</button>
<button class="buttongen" id="phieuluu" value="7">Phiêu lưu</button>
<button class="buttongen" id="hinhsu" value="8">Hình sự</button>
<button class="buttongen" id="phimhay" value="9">Phim Hay</button>
<input type="hidden" class="inputgenre classinput" name="genre" value='<?=$row['genre']?>'>
<br>Chất lượng:
<select name="quality">
<option value="1"<?php if($row['quality']==1) echo " selected";?>>Cam</option>
<option value="2"<?php if($row['quality']==2) echo " selected";?>>SD</option>
<option value="3"<?php if($row['quality']==3) echo " selected";?>>HD</option>
</select>
<div class="clear"></div>
<input class="button" type="submit" name="submit" value="Gửi">
</form>
<?php
}
?>