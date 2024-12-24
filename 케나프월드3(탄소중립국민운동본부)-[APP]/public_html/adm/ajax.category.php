<?php
include_once("./_common.php");

$ca_id = $_POST['ca_id'];
$w = $_POST['w'];

$ca = sql_fetch("select * from g5_category where ca_id = '{$ca_id}'");

// 삭제일 경우
if($w == "d"){
	$result = sql_query("select * from g5_category where ca_code like '{$ca['ca_code']}%'");
	while($row = sql_fetch_array($result)){
		$ca_dir = substr($row['ca_code'], 0, 2);
		@unlink(G5_DATA_PATH.'/category/'.$ca_dir.'/'.$row['ca_file']);
	}

	sql_query("delete from g5_category where ca_code like '{$ca['ca_code']}%' ");
	sql_query("delete from gr_write_business where ca_code like '{$ca['ca_code']}%' ");
	
	$json['result'] = false;
	$json['error']	= "카테고리를 삭제하였습니다.";
	echo json_encode($json);
	exit;
}

$json			= $ca;
$json['result'] = true;
$json['w']		= $w;

if(!$json){
	$json['result'] = false;
	$json['error'] = "해당 카테고리를 찾을 수 없습니다.";
	echo json_encode($json);
	exit;
}

if($w == "r"){
	$ca_id	 = $json['ca_id'];
	$ca_code = $json['ca_code'];
    $len = strlen($ca_code);

    if ($len == 10){
		$json['result'] = false;
		$json['error'] = "분류를 더 이상 추가할 수 없습니다. 5단계 분류까지만 가능합니다.";
		echo json_encode($json);
		exit;
	}

    $len2 = $len + 1;
    $len3 = $len + 2;

	$sql = " select MAX(SUBSTRING(ca_code, $len2, 2)) as max_subid from g5_category
			  where SUBSTRING(ca_code,1,$len) = '{$ca_code}' ";

	$row = sql_fetch($sql);

	$subid = base_convert($row['max_subid'], 36, 10);
	$subid += 36;
	if ($subid >= 36 * 36)
		$subid = "  ";

	$subid = base_convert($subid, 10, 36);
	$subid = substr("00" . $subid, -2);
	$subid = $ca_code . $subid;
	
	$sql = " select max(ca_order) as max_order from g5_category where ca_code like '{$ca_id}%' and char_length(ca_code) = '{$len3}'";
	$row = sql_fetch($sql);

	$json['sql']		= $sql;
	$json['ca_id']		= "";
	$json['ca_name']	= "";
	$json['ca_file']	= "";
	$json['ca_filename']= "";

	$json['ca_code']	= $subid;
	$json['ca_order']	= $row['max_order'] + 1;
}

echo json_encode($json);
?>