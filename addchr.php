
<?php
  function update2($id,$city,$zone,$addr){
  require_once("SQLconnection.php");

	$sql = "UPDATE biker SET city='".$city."',zone='".$zone."',addr='".$addr."' where id='".$id."'";
	//echo $sql;
	  // 建立MySQL資料庫連結
    $link = create_connection();
	// 執行SQL指令
      mysql_query($sql);
      mysql_close($link);
	  return $sql;
	  }
 require_once("SQLconnection.php");
// 建立MySQL資料庫連結
    $link = create_connection();
// 建立SQL指令字串
$sql = "SELECT * FROM  biker WHERE  `addr` LIKE  '%桃園縣%'";   //$sql = "SELECT * FROM  bulletin WHERE reference=-1"; 
$result = mysql_query($sql); // 執行SQL指令
// 是否有文章
if (mysql_num_rows($result) != 0) 
{
  while ($rows = mysql_fetch_array($result, MYSQL_BOTH)) {

echo $rows["id"]."原始地址:".$rows["addr"];   
echo "<BR>";
$address=str_replace("桃園縣","",$rows["addr"]);  //把台中市拿掉
$aa[0]= mb_substr($address,0,3,"utf-8");
// ereg("(.*)區",$address,$aa);
//echo $aa[0];
echo "<BR>";
$newadd=$rows["addr"];
$newadd=str_replace("一","1",$newadd);
$newadd=str_replace("二","2",$newadd);
$newadd=str_replace("三","3",$newadd);
$newadd=str_replace("四","4",$newadd);
$newadd=str_replace("五","5",$newadd);
$newadd=str_replace("六","6",$newadd);
$newadd=str_replace("七","7",$newadd);
$newadd=str_replace("八","8",$newadd);
$newadd=str_replace("九","9",$newadd);
$newadd=str_replace("○","0",$newadd);
//echo $newadd;  數字的縣市

echo "縣市:桃園縣 <b>地區</b>".$aa[0]."<b>地址</b>".$newadd;
echo "<BR>";
echo update2($rows["id"],"桃園縣",$aa[0],$newadd);
echo "<hr>";
	 }
}
  mysql_free_result($result);
  
  
  

?>

	</ul>
</body>
</html>
