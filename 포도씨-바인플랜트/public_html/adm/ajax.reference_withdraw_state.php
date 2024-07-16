<?php
include_once('./_common.php');

/** 판매대금관리 출금신청 승인 상태 변경 (ajax) **/
/** 취소 기능 X, 취소 기능 필요 시 HISTORY 삭제 후 회원 포인트 원래대로 업데이트 시켜줘야함 **/

$mb = get_member($mb_id); // 신청 회원 정보

$sql = " select * from g5_reference_room_withdraw where idx = {$idx} "; // 출금 정보
$row = sql_fetch($sql);

$sql_add = '';
if($state == '완료') { // 완료
    $sql_add .= " , payment_date = '".G5_TIME_YMDHIS."' ";
}
else if($state == '대기') { // 대기
    $sql_add .= " , payment_date = '' ";
}
/*else if($state == '취소') { // 취소
    // 출금 신청 금액 복구
    $sql = " update g5_member set sales_proceeds = sales_proceeds + '{$row['sales_proceeds']}' where mb_id = '{$mb_id}' ";
    sql_query($sql);
}*/
$sql = " update g5_reference_room_withdraw set state = '{$state}', up_datetime = '".G5_TIME_YMDHIS."' {$sql_add} where idx = {$idx} ";
$result = sql_query($sql);

die($result);
?>
