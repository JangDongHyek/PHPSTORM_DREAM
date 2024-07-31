<?php
define('__HHGYU__',"hhgyu");
ob_start();
ob_implicit_flush(0);
session_cache_limiter('');
session_start();

$path = $_SERVER['SCRIPT_FILENAME'];
$tmp = explode("/",$_SERVER['SCRIPT_FILENAME']);
$path = str_replace($tmp[count($tmp)-1],"",$path);

$server_path = str_replace(basename(__FILE__), "", realpath(__FILE__));

define("__ROOT_PATH__", $server_path);
define("__INCLUDE_PATH__", __ROOT_PATH__ . "include/");
//$_SERVER[DOCUMENT_ROOT] = str_replace("themaweek", "jpub", $_SERVER[DOCUMENT_ROOT]);


require_once(__INCLUDE_PATH__ . 'config.php');
$config = &Config::getInstance();
require_once(__INCLUDE_PATH__ . 'include.php');
$mysql_query->connent();

$passkey="";
if(@$_REQUEST['passkey']!='') {$passkey=$_REQUEST['passkey'];}

/*
if($passkey == "" || $passkey!=$config->passkey_gen)
{
	$rows = array();
	$rows['error']['message']='passkey Null or Miss Match!\r\n' . mysql_error();
	$rows['error']['number']=0;
	echo json_encode($rows);
	return;
}*/


if(!$mysql_query->isConnected())
{
	$rows = array();
	$rows['error']['message']='DB에 접속할수 없습니다!\r\n';
	$rows['error']['number']=0;
	echo json_encode($rows);
	return;
}



$incpath = get_include_path();
//include $incpath."include/func.php";



if(@$_REQUEST['mode']!='') {$mode=$_REQUEST['mode'];}
if(@$_REQUEST['RegID']!='') {$RegID=$mysql_query->real_escape_string($_REQUEST['RegID']);}
if(@$_REQUEST['ID']!='') {$ID=$mysql_query->real_escape_string($_REQUEST['ID']);}
if(@$_REQUEST['app_type']!='') {$app_type=$mysql_query->real_escape_string($_REQUEST['app_type']);}

//else {$app_type=$mysql_query->real_escape_string('Android');}
if(@$_REQUEST['DeviceID']!='') {$DeviceID=$mysql_query->real_escape_string(($_REQUEST['DeviceID']));}



//if(@$_REQUEST['model']!='') {$DeviceModel=$mysql_query->real_escape_string(mpassUnlock($_REQUEST['model']));}
if($mode=="get"){
	//$query = $mysql_query->select($config->db_info->api_db,"*",'');

	$rows = array();
	$rows[$mode]['message']='성공했습니다!';
	$rows[$mode]['data']['GCM_RegistrationID']=$config->gcm->GCM_RegistrationID;//$mysql_query->fetch($query);
	echo json_encode($rows);
	return;
}
else if($mode=="insert"){

	if($RegID == ""  ||  $DeviceID == "null" || $ID == "")
	{
		$rows = array();
		$rows['error']['message']='필요한 정보가 넘어오지 않았습니다!\r\n';
		$rows['error']['number']=0;
		echo json_encode($rows);
		return;
	}
	
	$insert = false;

	if($RegID){
		$count = $mysql_query->max_count($config->db_info->user_db,"`ID`='$ID' and `RegID`='$RegID' and `DeviceID`='$DeviceID' and `app_type` = '$app_type' and `delete` = 0");
		if($count == null || is_numeric($count) == false){ // 쿼리문에 이상이 있을때
			$rows = array();
			$rows['error']['message']='알수없은 에러가 발생하였습니다!\r\n' . mysql_error();
			$rows['error']['number']=10;
			
			echo json_encode($rows);
			return;
		} else if($count >= 1){ //이미 등록되었을때
			$rows[$mode]['message']='성공했습니다!';
			$rows[$mode]['number']=1;
			echo json_encode($rows);
			return;
		} else { //세가지 조건이 만족하지 않으면
			$count = $mysql_query->max_count($config->db_info->user_db,"`ID`='$ID'");
			if($count > 0){ //아이디가 있으면
				$query = $mysql_query->select($config->db_info->user_db,"`DeviceID`","`DeviceID` = '$DeviceID' and `ID`='$ID' and `app_type` = '$app_type'");
				$rows = $mysql_query->fetch($query);

				$tmpDBInsert_name = array();
				$tmpDBInsert_value = array();
				$tmpDBInsert_name[] = '`ID`';
				$tmpDBInsert_name[] = '`DeviceID`';
				$tmpDBInsert_name[] = '`RegID`';
				$tmpDBInsert_name[] = '`app_type`';
				$tmpDBInsert_name[] = '`delete`';

				$tmpDBInsert_value[] = "'" . $ID . "'";
				$tmpDBInsert_value[] = "'" . $DeviceID . "'";
				$tmpDBInsert_value[] = "'" . $RegID . "'";
				$tmpDBInsert_value[] = "'" . $app_type . "'";
				$tmpDBInsert_value[] = "'" . 0 . "'";
				if($rows["DeviceID"] == $DeviceID){ //DeviceID가 같고 GCM키가 같지않다면 GCM키 업데이트
					$mysql_query->update($config->db_info->user_db, $tmpDBInsert_name,$tmpDBInsert_value,"`DeviceID` = '$DeviceID' and `ID` = '$ID' and `app_type` = '$app_type'");
					$rows[$mode]['message']='성공했습니다!';
					$rows[$mode]['number']=2;

				} else { //DeviceID가 같지 않다면 추가
					//$mysql_query->delete($config->db_info->user_db,"`ID`='$ID'");
					$mysql_query->insert($config->db_info->user_db, $tmpDBInsert_name, $tmpDBInsert_value);
					$rows[$mode]['message']='성공했습니다!';
					$rows[$mode]['number']=3;
				}
			} else { //아이디가 없다면 추가

				$count = $mysql_query->max_count($config->db_info->user_db,"`DeviceID`='$DeviceID'");

				if($count > 0){ //디바이스 아이디가 있다면 GCM키가 같지 않다면 GCM키 업데이트
				$tmpDBInsert_name = array();
				$tmpDBInsert_value = array();
				$tmpDBInsert_name[] = '`ID`';
				$tmpDBInsert_name[] = '`DeviceID`';
				$tmpDBInsert_name[] = '`RegID`';
				$tmpDBInsert_name[] = '`app_type`';
				$tmpDBInsert_name[] = '`delete`';

				$tmpDBInsert_value[] = "'" . $ID . "'";
				$tmpDBInsert_value[] = "'" . $DeviceID . "'";
				$tmpDBInsert_value[] = "'" . $RegID . "'";
				$tmpDBInsert_value[] = "'" . $app_type . "'";
				$tmpDBInsert_value[] = "'" . 0 . "'";
					
					$mysql_query->update($config->db_info->user_db, $tmpDBInsert_name,$tmpDBInsert_value,"`DeviceID`='$DeviceID' and `app_type` = '$app_type'");
					$rows[$mode]['message2']='성공했습니다!';
				} else {
					$tmpDBInsert_name = array();
					$tmpDBInsert_value = array();
					$tmpDBInsert_name[] = '`ID`';
					$tmpDBInsert_name[] = '`DeviceID`';
					$tmpDBInsert_name[] = '`RegID`';
					$tmpDBInsert_name[] = '`app_type`';
					$tmpDBInsert_name[] = '`delete`';

					$tmpDBInsert_value[] = "'" . $ID . "'";
					$tmpDBInsert_value[] = "'" . $DeviceID . "'";
					$tmpDBInsert_value[] = "'" . $RegID . "'";
					$tmpDBInsert_value[] = "'" . $app_type . "'";
					$tmpDBInsert_value[] = "'" . 0 . "'";

					$mysql_query->insert($config->db_info->user_db, $tmpDBInsert_name, $tmpDBInsert_value);
					$rows[$mode]['message']='성공했습니다!';
					$rows[$mode]['number']=4;
				}
			}
		}
		
		echo json_encode($rows);
		return;
	}
	else{
		$rows = array();
		$rows['error']['message']='알수없은 에러가 발생하였습니다!\r\n' . mysql_error();
		$rows['error']['number']=5;
		echo json_encode($rows);
		return;
	}
}
else{
	$rows = array();
	$rows['error']['message']='알수없은 에러가 발생하였습니다!\r\n';
	$rows['error']['number']=9;
	echo json_encode($rows);
	return;
}

$mysql_query->close();
GzDocOut(9,0);
ob_end_flush();

function print_json($rows)
{
	header('Content-type: application/json');
	echo json_encode($rows);
	GzDocOut(9,0);
	ob_end_flush();
}

function print_array($rows)
{
	echo "<xmp>";
	var_dump($rows);
	echo "</xmp>";
	GzDocOut(9,0);
	ob_end_flush();
}