<?php
class getClip{
function get_clip_movie($con, $url){
$result = file_get_contents('http://phim.clip.vn/info/Movie/'.$url);
$result = trim(preg_replace('/\s\s+/', '', $result));
$title = explode('<div class="title" itemprop="name"><h1>', $result);
$title = explode('</div></h1>', $title[1]);
$name = explode("<div class = 'originaltitle'>", $title[0]);//Name - Ename
echo "$name[0] - $name[1]<br>";
$direct = explode('Đạo diễn: <strong>', $result);
$direct = explode('</strong>', $direct[1]);
echo $direct[0]."<br>";
$produ = explode('Sản xuất: <strong>', $result);
$produ = explode('</strong>', $produ[1]);
echo $produ[0]."<br>";
$year = explode('Phát hành: <strong>', $result);
$year = explode('</strong>', $year[1]);
echo $year[0]."<br>";
$dura = explode('Thời lượng: <strong>', $result);
$dura = explode(' Phút</strong>', $dura[1]);
echo $dura[0]."<br>";
$country = explode('Quốc gia: <strong>', $result);
$country = explode('</strong>', $country[1]);
echo $country[0]."<br>";
$intro = explode('<div class="filmdescription" itemprop="description">', $result);
$intro = explode('</div><div class="tag-info">', $intro[1]);
$temp = explode('<p style="text-align: justify;">', $intro[0]);
$string = '';
for($i=0; $i<sizeof($temp); $i++){
$str = explode('</p>', $temp[$i]);
$string.=$str[0];
}
$genre ='';
$gioithieu = html_entity_decode($string);
$gen = explode('Thể loại: <strong>', $result);
$gen = explode('</strong>', $gen[1]);
if(stripos($gen[0], 'hài')) $genre .= '1,';
else if(stripos($gen[0], 'kinh dị')) $genre .= '2,';
else if(stripos($gen[0], 'viễn tưởng')) $genre .= '3,';
else if(stripos($gen[0], 'hành động')) $genre .= '4,';
else if(stripos($gen[0], 'tình cảm')) $genre .= '5,';
else if(stripos($gen[0], 'hoạt hình')) $genre .= '6,';
else if(stripos($gen[0], 'phiêu lưu')) $genre .= '7,';
else if(stripos($gen[0], 'hình sự')) $genre .= '8,';
echo $genre.'<br>';

$actor = explode('Diễn viên: <strong>', $result);
$actor = explode('</strong>', $actor[1]);
preg_match_all("|<[^>]+>(.*)</[^>]+>|U", $actor[0] ,$out);
$stractor=$out[1][0];
for($i=1; $i<sizeof($out[0]); $i++){
$stractor.=','.$out[1][$i];
}
echo $stractor;
$url = strtolower($name[0]);
$url = str_replace(' ', '-', $url);
$url = str_replace(':', '', $url);
$url = str_replace('/', '', $url);
$query = $con->prepare("INSERT INTO `movie`(`name`, `ename`, `director`, `actor`,`country`, `year`, `quality`,`intro`,`productor`,`genre`, `url`,`duration`) VALUES (:name, :ename, :director, :actor, :country, :year, :quality, :intro, :productor, :genre, :url, :dura)");
$query->execute(array(":name"=> $name[0], ":ename" => $name[1],":director" => $direct[0],":actor" => $stractor,":country" => $country[0],":year" => $year[0],":quality" => 3,":intro" => $gioithieu,":productor" => $produ[0],":genre" => $genre, ":url"=>$url, ":dura"=>$dura[0]));
$idmovie =  $con->lastInsertId();
$c=true;
$i=0;
$tapphim = explode('<div class="item active">', $result);
$tapphim = explode('</div>', $tapphim[1]);
$sotap = explode('_clip1-', $result);
$sotap = explode('" />', $sotap[1]);

while($c){
$i++;
$pre = "_clip$i-$sotap[0],";
$ep = explode($pre, $tapphim[0]);
$ep = explode("/", $ep[1]);
echo $ep[0]."<br>";
if($ep[0]=='') $c=false;
else{
$query2 = $con->prepare("INSERT INTO `epison`(`idmovie`, `server`, `ep`, `link`) VALUES (:idmovie, :server, :ep, :link)");
$query2->execute(array(':idmovie'=>$idmovie, ':server'=> 1, ':ep'=>$i, ':link'=>$ep[0]));
}
}
}

function get_clip_film($con,$url){
$result = file_get_contents('http://phim.clip.vn/info/Movie/'.$url);
$result = trim(preg_replace('/\s\s+/', '', $result));
$title = explode('<div class="title" itemprop="name"><h1>', $result);
$title = explode('</div></h1>', $title[1]);
$name = explode("<div class = 'originaltitle'>", $title[0]);//Name - Ename
echo "$name[0] - $name[1]<br>";
$direct = explode('Đạo diễn: <strong>', $result);
$direct = explode('</strong>', $direct[1]);
echo $direct[0]."<br>";
$produ = explode('Sản xuất: <strong>', $result);
$produ = explode('</strong>', $produ[1]);
echo $produ[0]."<br>";
$year = explode('Phát hành: <strong>', $result);
$year = explode('</strong>', $year[1]);
echo $year[0]."<br>";
$dura = explode('Thời lượng: <strong>', $result);
$dura = explode(' Tập</strong>', $dura[1]);
echo $dura[0]."<br>";
$country = explode('Quốc gia: <strong>', $result);
$country = explode('</strong>', $country[1]);
echo $country[0]."<br>";
$intro = explode('<div class="filmdescription" itemprop="description">', $result);
$intro = explode('</div><div class="tag-info">', $intro[1]);
$temp = explode('<p style="text-align: justify;">', $intro[0]);
$string = '';
for($i=0; $i<sizeof($temp); $i++){
$str = explode('</p>', $temp[$i]);
$string.=$str[0];
}
$genre ='';
$gioithieu = html_entity_decode($string);
echo $gioithieu;
$gen = explode('Thể loại: <strong>', $result);
$gen = explode('</strong>', $gen[1]);
if(stripos($gen[0], 'hài')) $genre .= '1,';
else if(stripos($gen[0], 'kinh dị')) $genre .= '2,';
else if(stripos($gen[0], 'viễn tưởng')) $genre .= '3,';
else if(stripos($gen[0], 'hành động')) $genre .= '4,';
else if(stripos($gen[0], 'tình cảm')) $genre .= '5,';
else if(stripos($gen[0], 'hoạt hình')) $genre .= '6,';
else if(stripos($gen[0], 'phiêu lưu')) $genre .= '7,';
else if(stripos($gen[0], 'hình sự')) $genre .= '8,';
echo $genre.'<br>';

$actor = explode('Diễn viên: <strong>', $result);
$actor = explode('</strong>', $actor[1]);
preg_match_all("|<[^>]+>(.*)</[^>]+>|U", $actor[0] ,$out);
$stractor=$out[1][0];
for($i=1; $i<sizeof($out[0]); $i++){
$stractor.=','.$out[1][$i];
}
echo $stractor;
$url = strtolower($name[0]);
$url = str_replace(' ', '-', $url);
$url = str_replace(':', '', $url);
$url = str_replace('/', '', $url);
$query = $con->prepare("INSERT INTO `movie`(`name`, `ename`, `director`, `actor`,`country`, `year`, `quality`,`intro`,`productor`,`genre`, `url`,`duration`,`maxserver1`) VALUES (:name, :ename, :director, :actor, :country, :year, :quality, :intro, :productor, :genre, :url, :dura,:maxsv1)");
$query->execute(array(":name"=> $name[0], ":ename" => $name[1],":director" => $direct[0],":actor" => $stractor,":country" => $country[0],":year" => $year[0],":quality" => 3,":intro" => $gioithieu,":productor" => $produ[0],":genre" => $genre, ":url"=>$url, ":dura"=>$dura[0], ":maxsv1"=>$dura[0]));
$idmovie =  $con->lastInsertId();

$eplist = explode('<div class="item active">', $result);
$eplist = explode('<a data-slide="prev" href="#myclips-carousel" class="left clips-carousel-control"></a>', $eplist[1]);
preg_match_all('|href="(.*)"+ |U', $eplist[0] ,$epison);
for($i=0; $i<sizeof($epison[1]); $i++){
$tap = explode(',', $epison[1][$i]);
$tap= explode('/', $tap[1]);
$query2 = $con->prepare("INSERT INTO `epison`(`idmovie`, `server`, `ep`, `link`) VALUES (:idmovie, :server, :ep, :link)");
$query2->execute(array(':idmovie'=>$idmovie, ':server'=> 1, ':ep'=>($i+1), ':link'=>$tap[0]));
}
}
}
?>