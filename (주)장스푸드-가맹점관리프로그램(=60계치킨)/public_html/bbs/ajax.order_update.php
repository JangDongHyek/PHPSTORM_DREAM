<?php
include_once("./_common.php");
error_reporting(E_ALL);
ini_set("display_errors", 1);
$addColums = "";
$ColumnsArr = explode('&', $_POST["datas"]);

for($arr=0; $arr<count($ColumnsArr); $arr++){
	$tmpArr = explode('=',$ColumnsArr[$arr]);

	if($tmpArr[0] == 'od_idx'){
		$od_idx = $tmpArr[1];
	} else {
		$addColums .= ", {$tmpArr[0]} = '".urldecode($tmpArr[1])."'";
	}
}


$tableName = ($_POST['tblInfo'] == "point_order")? "g5_point_order" : "g5_order";

// 주문정보 업데이트
$sql = "UPDATE {$tableName} SET
		od_status = '대기', 
		pay_status = '결제전', 
		od_date = '".date('Y-m-d H:i:s')."'
		{$addColums}
		WHERE od_idx = '{$od_idx}'";

$result = sql_query($sql);

if($result == false) {
	echo "error";
} else {
	echo "success";
}

?>