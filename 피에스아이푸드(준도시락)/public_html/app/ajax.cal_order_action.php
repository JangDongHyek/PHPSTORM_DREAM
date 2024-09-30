<?php
include_once ('../common.php');
/**
 * 도시락 달력 주문 선택완료/선택해제
 * $mode: r=선택완료, d=선택해제
 * $order_arr[0]: 도시락 카테고리
 * $order_arr[1]: 도시락 idx (g5_dosirak idx)
 * $order_arr[2]: 입력 수량
 */

//print_r($_REQUEST);exit;

if($mode == 'reg' || $mode == 'del') {
    // 임시 테이블에 저장하기 전 동일한 아이디와 동일한 배송시작일에 데이터 있으면 삭제 후 저장, 주문을 완료하지 않고 나갈 수 있기 때문, 선택해제의 경우에도 동작
    if($mode == 'del' && empty($delivery_date)) {
        $result = sql_query(" delete from g5_order_tmp where mb_id = '{$member['mb_id']}' ");
    } else {
        $result = sql_query(" delete from g5_order_tmp where mb_id = '{$member['mb_id']}' and delivery_date = '{$delivery_date}' ");
    }
}

if($mode == 'reg') { // 선택완료
    for($i=0; $i<count($order_arr); $i++) {
        $order_category = $order_arr[$i][0];
        $dosirak_idx = $order_arr[$i][1];
        $amount = $order_arr[$i][2];
        $do = sql_fetch(" select * from g5_dosirak where idx = '{$dosirak_idx}' "); // 도시락 정보
        $single_price = $do['do_price']; // 도시락 1개 금액
        $total_price = $amount * $single_price; // 합계 금액

        $tmp = sql_fetch(" select max(tmp_no) as tmp_no from g5_order_tmp where mb_id = '{$member['mb_id']}' and delivery_date = '{$delivery_date}' ")['tmp_no'];
        $tmp_no = $tmp['tmp_no'] + 1;

        $sql = " insert into g5_order_tmp set 
                 tmp_no = '{$tmp_no}',
                 mb_id = '{$member['mb_id']}', 
                 delivery_date = '{$delivery_date}', 
                 order_category = '{$order_category}', 
                 dosirak_idx = '{$dosirak_idx}', 
                 do_name = '{$do['do_name']}',
                 order_amount = '{$amount}',
                 total_price = '{$total_price}',
                 wr_datetime = '".G5_TIME_YMDHIS."' ";
        $result = sql_query($sql);
    }

    if($result) { echo 1;exit; }
}
else if($mode == 'get') { // 조회
    $rlt = sql_query(" select * from g5_order_tmp where mb_id = '{$member['mb_id']}' and delivery_date = '{$delivery_date}' order by tmp_no ");
    $cnt = sql_num_rows($rlt);
    if($cnt > 0) {
        $num = 1;
        while($info = sql_fetch_array($rlt)) {
        ?>
        <div class="ordmenu addmenu ord_<?=$num?>">
            <p class="">
                <select class="frm_input main" id="main_<?=$num?>" name="main[]" onchange="getDosirak(this.value, '<?=$num?>');" disabled>
                    <option value="정기배달" <?=$info['order_category'] == '정개배달' ? 'selected' : '';?>>정기배달도시락</option>
                    <!--<option value="샐러드팩" <?/*=$info['order_category'] == '샐러드팩' ? 'selected' : '';*/?>>샐러드팩</option>-->
                </select>
            </p>
            <p class="">
                <!--ajax.select_dosirak.php-->
                <select class="frm_input sub" id="sub_<?=$num?>" name="sub[]">
                    <?php
                    $rlt2 = sql_query(" select * from g5_dosirak where do_category = '{$info['order_category']}' ");
                    while ($row = sql_fetch_array($rlt2)) {
                    ?>
                    <option value="<?= $row['idx'] ?>" <?=$info['dosirak_idx'] == $row['idx'] ? 'selected' : '';?>><?= $row['do_name'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </p>
            <p class="">
                <input type="text" class="frm_input amount" id="amount_<?=$num?>" name="amount[]" value="<?=number_format($info['order_amount'])?>" style="width:calc(100% - 20px); margin-right:6px;"/>개
            </p>
            <div class="add_btn">
            <?php if($num == 1) { ?>
                <span onclick="addMenu();"><i class="fa-regular fa-plus"></i>추가</span>
            <?php } else { ?>
                <span onclick="delMenu('<?=$num?>');"><i class="fa-regular fa-minus"></i>삭제</span>
            <?php } ?>
            </div>
        </div>
        <?php
        $num++;
        }
    }
    else {
        echo '';exit;
    }
}
else if($mode == 'info') { // 결제예정금액에 도시락 표시
    $rlt = sql_query(" select * from g5_order_tmp where mb_id = '{$member['mb_id']}' order by delivery_date, tmp_no ");
    $all_total = 0;
    while($row = sql_fetch_array($rlt)) {
        $all_total += $row['total_price'];
    ?>
    <li class="pay_ord">
        <h3><?=$row['delivery_date']?></h3>
        <p><?=$row['do_name']?> <span><?=$row['order_amount']?>개</span></p>
        <strong><?=number_format($row['total_price'])?>원</strong>
    </li>
    <?php
    }
    ?>
    <p class="total"><span>합계</span> <strong><?=number_format($all_total)?>원</strong></p>
    <?php
}

//// 배송시작일 오름차순으로 정렬
//foreach ((array) $dosirak_arr as $key => $value) {
//    $sort[$key] = $value[0];
//}
//array_multisort($sort, SORT_ASC, $dosirak_arr);
//
//$return_data = [];
//for($i=0; $i<count($dosirak_arr); $i++) {
//    $delivery_date = $dosirak_arr[$i][0]; // 배송시작일
//    $amount = $dosirak_arr[$i][3]; // 도시락 수량
//    $do = sql_fetch(" select * from g5_dosirak where idx = {$dosirak_arr[$i][2]} ");
//    $dosirak_price = $do['do_price'] * $amount; // 금액
//
//    $return_data[$i] = [$delivery_date, trim($do['do_name']), $dosirak_price];
//}
//
//echo json_encode($return_data);exit;
?>
