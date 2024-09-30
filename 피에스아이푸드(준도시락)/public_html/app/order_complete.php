<?php
include_once("../common.php");
/**
 * 주문하기 - 주문완료 - 사용안함
 */

orderCheck(date('H:i')); // 주문가능시간 체크

if($order_category == "행사용") {
    $url = "order_event.php";
    $sql_add = ", event_date = '{$event_date}', event_time = '{$event_time}'";
} else { // 정기배달/샐러드팩
    $url = "order_deli.php";
    if(empty($delivery_date)) {
        // 정기배달시작일을 주문수정일 다음날로 지정 예) 오늘이 2022-02-11이면 배달시작일을 2022-02-12로
        $timestamp = strtotime("+1 days");
        $delivery_date = date("Y-m-d", $timestamp);
    }
    $sql_add = ", delivery_date = '{$delivery_date}'";
}

//if($private) {
//    echo $sql_add;exit;
//}

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

$order_amount = str_replace(',', '', $order_amount); // 주문수량

$rider = sql_fetch(" select * from g5_rider where customer = '{$member['mb_id']}'; ")['rider']; // 담당기사

$sql_common = ", order_name = '{$order_name}',
                 order_amount = '{$order_amount}',
                 order_warm = '{$order_warm}',
                 order_tel = '{$order_tel}',
                 order_post = '{$order_post}',
                 order_addr1 = '{$order_addr1}',
                 order_addr2 = '{$order_addr2}',
                 order_memo = '{$order_memo}',
                 shipping_fee = '{$shipping_fee}',
                 total_price = '{$total_price}',
                 read_yn = 'N',
                 rider = '{$rider}' ";

if($w == '') { // 등록
    $msg = '완료';
    $sql = " insert into g5_order set 
             order_no = '{$order_no}',
             order_category = '{$order_category}',
             order_state = '주문접수',
             dosirak_idx = '{$idx}',
             mb_id = '{$member['mb_id']}',
             do_name = '{$do_name}',
             wr_datetime = '".G5_TIME_YMDHIS."'
             {$sql_common}
             {$sql_add} ";
    $result = sql_query($sql);
}
else { // 수정
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
             rel_idx = '{$ord['idx']}'
             {$sql_common}
             {$sql_add} ";
    //if($private) { echo $sql;exit; }
    $result = sql_query($sql);

    sql_query(" update g5_order set read_yn = null where idx = '{$idx}' ");
}

if($result) {
    // 행사도시락 주문 시 관리자에게 문자 발송
    //- 발신번호: 051-746-9987
    //- 수신번호: 01049066196 / 01044455016 / 01022772613
    if(!$private) {
        if($order_category == '행사용') {
            $arr = ['01049066196', '01044455016', '01022772613'];
            for($i=0; $i<count($arr); $i++) {
                $receive_phone = $arr[$i]; // 받는번호
                $send_phone = '0517469987'; // 보낸번호
                $sms_msg = '[준도시락] 행사도시락 주문이 접수되었습니다.';
                goSms($receive_phone, $send_phone, $sms_msg);
            }
        }
    }

    alert("주문이 ".$msg."되었습니다.", './order_list.php', false);
} else {
    alert("오류가 발생하였습니다.\n다시 진행해 주세요.", './'.$url, true);
}
?>
