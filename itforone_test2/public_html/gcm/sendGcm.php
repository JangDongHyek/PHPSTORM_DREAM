<?php

define('__HHGYU__',"hhgyu");
ob_start();
ob_implicit_flush(0);
session_cache_limiter('');
session_start();
set_time_limit(0);

$path = $_SERVER['SCRIPT_FILENAME'];
$tmp = explode("/",$_SERVER['SCRIPT_FILENAME']);
$path = str_replace($tmp[count($tmp)-1],"",$path);

$server_path = str_replace(basename(__FILE__), "", realpath(__FILE__));

define("__ROOT_PATH__", $server_path);
define("__INCLUDE_PATH__", __ROOT_PATH__ . "include/");



//$_SERVER[DOCUMENT_ROOT] = "/home/bsyacht3/public_html"

require_once(__INCLUDE_PATH__ . 'config.php');
$config2 = &Config::getInstance();
require_once(__INCLUDE_PATH__ . 'include.php');
$mysql_query->connent();

//header('Content-Type: text/html; charset=utf-8');
if(!$mysql_query->isConnected())
{
	$rows = array();
	$rows['error']['message']='DB에 접속할수 없습니다!\r\n';
	$rows['error']['number']=0;
	//json_encode($rows);
	return;
}

//이벤트 생성 후 자동 푸쉬 알림 현재는 테스트 아이디만
$eventTitle = "테스트GCM입니다 ^^";
$msg = <<<EOD
<!DOCTYPE html>
<html lang="ko">
	<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densitydpi=medium-dpi" />
</head>
<body>
<p style="color:#512504;font-size=11pt;">※새로운 게시물이 등록되었습니다.</p>
</body>
</html>
EOD;
//<img src="http://wimg.fileham.com/event/gcm/FridayEvent/pop_event.jpg" style="width:100%;display: block;margin: 0 auto;" />


$options = array();

if($post_user != null){
	if(count($post_user) > 1){
		$options['arrID'] = $post_user;
	} else {
		$options['ID'] = $post_user;
	}
}
//$options['ID'] = "gogoflvhxj";
//$options['arrID'] = array("gogoflvhxj", "gogoflvhxj");

if($gcmtest){
	$options['idx'] = "29";
	$res = $gcm_manager->sendToMember_ALL_APNS($postNo,$post_title, $post_content, "", "$post_url", null, $returnObj);
}

if($options != null && count($options) > 0){
	$options = $evnet_manager->allowOptions($options);
	if(count($options) != 1) {
		echo "여러개의 조건은 지원하지 않습니다.\n<br />";
		exit;
	}
}
//$post_title = "정관토끼 새로운소식입니다.";
$res = false;
$returnObj = array();
if($options != null && count($options) > 0){
	if(count($options) == 1) {
		reset ($options);
		$firstKey = key($options);
		if($firstKey == "idx") {
			$res = $gcm_manager->sendToMember_idx($postNo, $options["idx"], $post_title, $post_content, "$button_string", "$post_url", null, $returnObj);
			$res = $gcm_manager->sendToMember_idx_APNS($postNo,$options["idx"],$post_title, $post_content, "$button_string", "$post_url", null, $returnObj);
		} else if($firstKey == "ID") {
			$res = $gcm_manager->sendToMember_ID($postNo, $options["ID"], $post_title, $post_content, "$button_string", "$post_url", null, $returnObj);
			$res = $gcm_manager->sendToMember_ID_APNS($postNo,$options["ID"],$post_title, $post_content, "$button_string", "$post_url", null, $returnObj);
		} else if($firstKey == "arrID") {
			if(is_array($options["arrID"])) {
				foreach($options["arrID"] as $id) {
					$res = $gcm_manager->sendToMember_ID($postNo, $id, $post_title, $post_content, "$button_string", "$post_url", null, $returnObj);
					$res = $gcm_manager->sendToMember_ID_APNS($postNo,$id,$post_title, $post_content, "$button_string", "$post_url", null, $returnObj);
				}
			}
		} else {
			echo "허용하지 않는 key 입니다.\n<br />";
			exit;
		}
	}

}else {
	$res = $gcm_manager->sendToMember_ALL($postNo,$post_title, $post_content, "$button_string", "$post_url", null, $returnObj);
	$res = $gcm_manager->sendToMember_ALL_APNS($postNo,$post_title, $post_content, "$button_string", "$post_url", null, $returnObj);
}

$tb[] = "`name`";
$tb[] = "`title`";
$tb[] = "`body`";
$tb[] = "`time`";
$tb[] = "`url`";

$va[] = "'".$post_user."'";
$va[] = "'".iconv("utf-8","euc-kr",$post_title)."'";
$va[] = "'".iconv("utf-8","euc-kr",$post_content)."'";
$va[] = "'".date("Y-m-d H:i", mktime())."'";
$va[] = "'".$post_url."'";

$mysql_query->insert("gcm_table", $tb, $va);
/*
if($res != false) {
	 json_encode($returnObj);
	 GzDocOut(9,0);
	 ob_end_flush();
}
$mysql_query->close();

//GzDocOut(9,0);
//ob_end_flush();


function print_array($rows)
{
	 "<xmp>";
	var_dump($rows);
	 "</xmp>";
	GzDocOut(9,0);
	ob_end_flush();
}

function print_json($rows)
{
	@header('Content-type: application/json');
	//json_encode($rows);
	GzDocOut(9,0);
	ob_end_flush();
}
*/

?>