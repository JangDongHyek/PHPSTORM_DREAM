<?
require_once ('include/JSON.php');
	$db_host = "localhost"; 
	$db_user = "ktchurch"; 
	$db_passwd = "tpsxja!@#";
	$db_name = "ktchurch"; 

	$connect = mysql_connect($db_host,$db_user,$db_passwd);
	
	if (!$connect) {
		die('Not connected : ' . mysql_error());
	}
	$db_selected = mysql_select_db($db_name,$connect);

	if (!$db_selected) {
		die('Can\'t use mysql_db_name : ' . mysql_error());
	}

$selectday = $_REQUEST['selectday'];
list($pak, $pak2, $pak3) = explode("-",$selectday);
if($pak3 < 10){
	$pak3 = "0".$pak3;
}
$selectday = "$pak-$pak2-$pak3";

$Print_arr = array();
$resultDB = mysql_query("SELECT * FROM rg_qt2_body WHERE `rg_title` = '$selectday';");
if($rowDB = mysql_fetch_array($resultDB)){
	$Print_arr['date'] = $rowDB['rg_title'];
	$Print_arr['title'] = iconv("EUC-KR", "UTF-8", $rowDB['rg_ext1']);
	$Print_arr['body'] = iconv("EUC-KR", "UTF-8", $rowDB['rg_content']);
} else {
	$Print_arr['sql'] = "SELECT * FROM rg_one_read_body WHERE `rg_title` = '$selectday';";
	$Print_arr['body'] = "미등록";
	$Print_arr['title'] = "";
}


echo json_encode($Print_arr);

function json_encode($data) {
	$json = new Services_JSON();
	return( $json->encode($data) );
}
?>

