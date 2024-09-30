<?php
include_once("../common.php");
/**
 *  정기배달도시락 주문/수정 완료 (new)
 */

loginCheck($member['mb_id']);
orderCheck(date('H:i')); // 주문가능시간 체크

// 담당기사
$rider = sql_fetch(" select * from g5_rider where customer = '{$member['mb_id']}'; ")['rider'];

$sql_common = ", order_name = '{$order_name}',
                 order_tel = '{$order_tel}',
                 order_post = '{$order_post}',
                 order_addr1 = '{$order_addr1}',
                 order_addr2 = '{$order_addr2}',
                 order_memo = '{$order_memo}',
                 read_yn = 'N',
                 rider = '{$rider}' ";

if($w == '') { // 등록
    $msg = '완료';

    $rlt = sql_query(" select * from g5_order_tmp where mb_id = '{$member['mb_id']}' order by delivery_date, tmp_no ");
    while($row = sql_fetch_array($rlt)) {
        // 주문번호
        $today = date('Ymd', strtotime(G5_TIME_YMDHIS));
        $sql = " select max(right(order_no, 4)) as max_order_no from g5_order where left(order_no, 8) like '%".$today."' ";
        $max_order_no = sql_fetch($sql)['max_order_no'];
        if(empty($max_order_no)) {
            $order_no = $today.'-0001';// 주문번호 생성
        } else {
            $max_order_no = $max_order_no+1;
            $order_no = $today.'-'.sprintf('%04d', $max_order_no);// 주문번호 생성
        }

        $sql = " insert into g5_order set 
                 order_no = '{$order_no}',
                 order_category = '{$row['order_category']}',
                 order_state = '주문접수',
                 dosirak_idx = '{$row['dosirak_idx']}',
                 mb_id = '{$member['mb_id']}',
                 do_name = '{$row['do_name']}',
                 order_amount = '{$row['order_amount']}',
                 delivery_date = '{$row['delivery_date']}',
                 total_price = '{$row['total_price']}',
                 wr_datetime = '".G5_TIME_YMDHIS."'
                 {$sql_common} ";
        $result = sql_query($sql);
    }

    sql_query(" delete from g5_order_tmp where mb_id = '{$member['mb_id']}' "); // 임시 데이터 삭제
}
else { // 수정
    if(strtotime(date('Y-m-d H:i')) > strtotime($delivery_date.' 08:30')) { // 정기배달일 지나면 수정 못함 (당일 8시 30분 전까지)
        die('fail');
    }

    $msg = '수정';
    $ord = sql_fetch(" select * from g5_order where idx = '{$idx}' "); // 주문정보
    $sql = " insert into g5_order set
             wr_datetime = '".G5_TIME_YMDHIS."',
             up_datetime = '".G5_TIME_YMDHIS."',
             mod_yn = 'Y',
             order_no = '{$ord['order_no']}',
             order_category = '{$ord['order_category']}',
             order_state = '주문접수',
             dosirak_idx = '{$ord['dosirak_idx']}',
             mb_id = '{$ord['mb_id']}',
             do_name = '{$ord['do_name']}',
             order_amount = '{$order_amount}',
             delivery_date = '{$delivery_date}',
             total_price = '{$total_price}',
             rel_idx = '{$ord['idx']}'
             {$sql_common} ";
    $result = sql_query($sql);

    sql_query(" update g5_order set read_yn = null where idx = '{$idx}' ");
}

if($result) {
    die('success');
}
?>
