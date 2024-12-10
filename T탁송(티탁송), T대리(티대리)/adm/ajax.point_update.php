<?php
// 회원정보상세 - 관리자 포인트 충전/차감 등록
include_once('./_common.php');

// print_r($_POST);

$po_charge_memo = mb_substr(trim($po_charge_memo), 0, 200, 'utf-8');

if ($po_type == "save") {			// 포인트충전
	//insert_point($mb_id, $po_point, $po_content, '', '', $rel_action='admin_save', 0);
	point_update($mb_id, $po_point, 0, $po_content, '', '', 'admin_save', '', '', trim($po_charge_memo));

} else if ($po_type == "use") {		// 포인트차감
	point_update($mb_id, 0, $po_point, $po_content, '', '', 'admin_use', '', '', trim($po_charge_memo));

}

?>