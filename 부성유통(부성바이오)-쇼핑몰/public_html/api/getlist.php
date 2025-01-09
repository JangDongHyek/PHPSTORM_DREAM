<?
include "../connect.php";
require_once ('JSON.php');
if($idx != null && $idx != "")
	$Where = "Where item_no = '$idx'";
$sql = "Select * From item $Where Order by item_no desc";
$result = mysql_query($sql);

while($rows = mysql_fetch_array($result)){
	foreach($rows as $key=>$val){
		$rows[$key] = iconv("euc-kr","utf-8",$val);
	}
	$print[] = $rows;
}

echo json_encode($print);

function json_encode($data) {
	$json = new Services_JSON();
	return( $json->encode($data) );
}
?>