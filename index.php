<?
if($_GET["zone"]){$opt="";}else{$opt="<option value='' selected>請選擇地區</option>";}

$table="";
require_once("SQLconnection.php");
// 建立MySQL資料庫連結
    $link = create_connection();
// 建立SQL指令字串
$sql = "SELECT zone ,city FROM biker GROUP BY zone ORDER BY city  ASC";   
$result = mysql_query($sql); // 執行SQL指令
// 是否有文章
if (mysql_num_rows($result) != 0) 
{

  while ($rows = mysql_fetch_array($result, MYSQL_BOTH)) {

if($_GET["zone"]==$rows["zone"]){$sla="selected";}else{$sla="";}
$opt.= "<option value='".$rows["zone"]."' $sla>".$rows["city"]."-".$rows["zone"]."</option>\r\n";   



	 }
}
  mysql_free_result($result);
  //上面是列出選項
  
$addr="";
if($_GET["zone"]){
 $zone=$_GET["zone"];
require_once("SQLconnection.php");
// 建立MySQL資料庫連結
    $link = create_connection();
// 建立SQL指令字串
$sql = "SELECT * FROM  biker where zone='$zone'  "; 
$result = mysql_query($sql); // 執行SQL指令
$firrow='';
// 是否有文章
if (mysql_num_rows($result) != 0) 
{
$i=1;
  while ($rows = mysql_fetch_array($result, MYSQL_BOTH)) {
if($firrow==''){$addr.=$rows["addr"]; 
$firrow="done";
}else{
$addr.="\r\n".$rows["addr"];   }

$table.="<tr><td>$i</td><td><b>".$rows["name"]."</b></td><td>".$rows["addr"]."</td><td>".$rows["city"]."</td>	<td>".$rows["zone"]."</td><td>".$rows["tel"]."</td>	<td>".$rows["time"]."</td><td>".$rows["type"]."</td>	<td>".$rows["memo"]."</td>	</tr>";
$i++;
	 }
}
  mysql_free_result($result);
  }
  


function my_counter(){
    $data="count.txt";
    //產生新值
    if(file_exists($data)){                     //如果$data存在
        //讀取舊值並加1成為新值
        $fp=fopen($data,"r");                   //fopen開啟檔案
        $old_count=fread($fp,filesize($data));  //fread讀取檔案
        $new_count=$old_count+1;
        fclose($fp);                            //關閉檔案
    }else{
        $new_count=1;
    }
    //寫入新值到count.txt中
    $fp=fopen($data,"w");
    fwrite($fp,$new_count);
    fclose($fp);

    return $new_count;
}
  ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml">
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
  <title>台中廢棄機油查詢</title>

<style type="text/css">
body{font-family: Arial; font-size: small; background-color: #fff;}
#outline {margin:20px; float:left; -moz-outline-radius:20px;  -moz-outline-style:solid;
   -moz-outline-color:#9FB6CD; -moz-outline-width:10px;}
#map{width:812px; height:440px; float:left;}
#head{text-align:left; margin-left:20px; font-size:150%;}
#novel{width:400px; margin:20px;float:right;}
#AdSense{margin:10px;}
#scale{width:300px; border: 1px solid blue; visibility:hidden}
#bar{background-color:blue; height:4px; width:0px;}
a:hover {color: red; text-decoration: underline overline;}
td{vertical-align:top;}
code{font-size:13px}
.pushpin{width:20px; height:34px; border:none;}
.small{color:#666; font-size:80%;}
.geocode {}
.slec{margin-left:100px}
</style>

  <script src="http://maps.google.com/maps?file=api&v=2&key=ABQIAAAA1OQ5vG9u4olaQnHXB3iBshSR8Rz-PsxrMEfPnvhFCaupeHvO9BQE-JXH0SB08Y67SjgegPKkAsiGMg" type="text/javascript">
  </script>

</head>
<body onunload="GUnload()" >
    <h3 id="head"> 台中市廢棄機油傾倒地點 (新增 桃園 金門)</h3>
	<div class="slec">
		<form method="GET" action="">

	<p>請選擇 你的地區 <select size="1" name="zone">
<?=$opt?>
	</select><input type="submit" value="送出"></p>
</form>

</div>

<table>

  <tr>
    <td>
      <div id="outline">
        <div id="map">
          <noscript>You should turn on JavaScript</noscript>
        </div>
      </div>
    </td>
    <td rowspan="2">
	

	
	
	
	
	
	
	
	
      <div id="novel">

        <div id="scale"><div id="bar"></div></div>
        共有以下這幾間店家:<br/>
        <form class ="geocode" action="#" onsubmit="geo(this.haku.value); return false">
          <textarea cols="40" rows="10" wrap="off" id="haku" name="haku" title="200+ lines not recommended at a time" ><?=$addr?></textarea>
      <!--    <input type="submit" id="hae" value=" Geocode " title="Run"/>   -->

        </form>
        未列在地圖上的店家:
        <div>
        <textarea id="errors"
cols="40" rows="5" wrap="off" title="Error report"></textarea><br/>
        <input type="button" id="stop" value="停止" title="Emergency stop" onclick="len=0"/>

        </div>



        <p><span id="api-version"></span><BR>power by davidou form ptt.cc <br>2011.10.30<br><?  echo "查詢過次數：".my_counter();?>次</p>

      </div>
    </td>
  </tr>
  <tr>
    <td>

    </td>
  </tr>
</table>

<table border="1" width="100%">
	<tr>
		<td>　</td>
		<td>名稱</td>
		<td>地址</td>
		<td>城市</td>
		<td>地區</td>
		<td>電話</td>
		<td>營業時間</td>
		<td>總類</td>
		<td>備註</td>
	</tr>
	<?=$table?>
	</table>
 <textarea id="memo"
cols="60" rows="30" wrap="off" title="Copy and edit your material here." style="display : none;"></textarea> 


<script type="text/javascript">
/**
 * 'Map coming...' visible only with JavaScript on.
 */
document.getElementById("map").innerHTML = "Map coming...";
document.getElementById("api-version").innerHTML = "api版本 v=2."+G_API_VERSION;
if (!GBrowserIsCompatible()) {
  alert('Sorry. Your browser is not Google Maps compatible.');
}

/**
 * map
 */
_mPreferMetric = true;
var map = new GMap2(document.getElementById("map"));
map.setCenter(new GLatLng(0,0), 1);
map.addControl(new GLargeMapControl());
map.addControl(new GMapTypeControl(1));
map.addControl(new GScaleControl());
map.openInfoWindowHtml(map.getCenter(), "Nice to see you.");
map.closeInfoWindow(); //preload iw


/**
 * Geocoder
 */
var points = [];
var bounds = new GLatLngBounds();
var geocoder = new GClientGeocoder();
var lines;
var lineNumber;
var len = 0;
var bar = document.getElementById("bar");
var scale = document.getElementById("scale");
function geo(addresses){
if(addresses.length<1){}else{
  scale.style.visibility = "visible";
  var start = new Date().getTime();
  lines = addresses.split("\n");
  len = lines.length;
  lineNumber=0;
  function doIt(){
    var query = lines[lineNumber];

    geocoder.getLatLng(query,function(point){
      if(!point){
        lineNumber++;
        report(query, lineNumber);
        if(lineNumber<len){doIt()};
      }else{
        var marker = new GMarker(point);
        map.addOverlay(marker);
        bounds.extend(point);
        point.address = query;
        points.push(point);//to be used
        memo(point); // intentionally slow function
        lineNumber++;
        marker.bindInfoWindowHtml(lineNumber + "<br/>" + query);
        if(lineNumber<len){doIt()};
        map.fit(bounds);
        bar.style.width = parseInt(300*lineNumber/len)+"px";
      }
      if(lineNumber>=len){
        var time = ((new Date().getTime() - start)/1000).toFixed(0);
        alert("列出"+lineNumber+" 個地址\n 共花了"+time+"秒")
      };
    });
  }
  doIt();
  }
}





/**
 * Dom functions for output fields
 */
var printOut = document.getElementById("memo");
printOut.value = "";
function memo(pnt){
  var row = pnt.lng().toFixed(5);
  row += ", ";
  row += pnt.lat().toFixed(5);
  row += ", ";
  row += pnt.address;
  row += "\n";
  printOut.value += row;
}

var errorReport = document.getElementById("errors");
errorReport.value = "";
function report(query_, n_){
  var row ="#"+n_;
  row += " not found: ";
  row += query_;
  row += "\n";
  errorReport.value += row;
}

function clearInput(){
  document.getElementById("haku").value="";
  scale.style.visibility = "hidden";
  bar.style.width = "0px";
}

function clearOutput(){
  map.clearOverlays();
  bounds = new GLatLngBounds();
  printOut.value="";
  errorReport.value="";
  scale.style.visibility = "hidden";
  bar.style.width = "0px";
}

/**
 * zoom and pan to fit in view
 */
GMap2.prototype.fit = function(bounds){
  this.setCenter(bounds.getCenter(), this.getBoundsZoomLevel(bounds));
}

window.onload = function ()
{
geo(this.haku.value); return false
}
</script>
</body>
</html>