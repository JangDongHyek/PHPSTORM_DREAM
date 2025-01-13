<?
/******************************
가상계좌 주문취소 처리
결제취소는 상점에서 직접 필요
(취소처리는 별도 모듈 필요)
******************************/

include_once('../../common.php');

if($co_id == "point_myorder") { $odTblName = "g5_point_order"; } 
else { $odTblName = "g5_order"; }

$sql = " update {$odTblName} set 
		pay_status='결제취소', 
		cancel_msg='정상처리되었습니다.', 
		cancel_date='".date("Ymd")."', 
		cancel_time='".date("His")."'
		where od_idx='{$od_idx}' ";

$result = sql_query($sql);

if($result == false) {
	echo "error";
} else {
	echo "success";
}

?>