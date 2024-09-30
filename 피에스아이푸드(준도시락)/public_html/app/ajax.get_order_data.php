<?php
include_once ('../common.php');
/**
 * 정기배달 도시락 주문내역 상세내역 (new)
 * 주문내역 상세보기 클릭 시 상세정보 모달 오픈
 */

$sql = " select *, do.do_price from g5_order as ord left join g5_dosirak as do on do.idx = ord.dosirak_idx where ord.idx = '{$idx}' ";
$row = sql_fetch($sql);

$weekday = array('일', '월', '화', '수', '목', '금', '토');
$tmp = explode('-', $row['delivery_date']);
$ord_date = $tmp[1].'월 '.$tmp['2'].'일 ('.$weekday[date('w', strtotime($row['delivery_date']))].')';
?>

<dt><i class="fa-regular fa-calendar-check"></i> <span id="ord_date"><?=$ord_date?></span></dt>
<dd>
    <span><?=$row['do_name']?></span>
    <strong>
        <?php
        $no_edit = false;
        if(date('Y-m-d H:i') > date('Y-m-d H:i', strtotime($row['delivery_date'].' 08:00'))) { // 정기배달일 지나면 수정 못함 (당일 8시 30분 전까지)
            $no_edit = true;
        } else {
            // // 주문 가능 시간 체크 ==> 22.09.29 업체요청으로 주문 수정 불가능 시간 삭제
            // if(date('H:i', strtotime('08:00')) < date('H:i') && date('H:i') < date('H:i', strtotime('09:00'))) { // 주문가능시간 아니면 수정 못함 (8시 30분 ~ 10시 30분 주문 못함)
            //     $no_edit = true;
            // }
        }
        $no_edit = $no_edit ? 'disabled' : '';
        ?>
        <input class="frm_input" id="order_amount" name="order_amount" value="<?=$row['order_amount']?>" onclick="editChk('<?=$row['delivery_date']?>');" onkeyup="commaNumber(this);amountChk('<?=$row['do_price']?>', this.value);" <?=$no_edit?> />개
    </strong>
</dd>

<br />

<div id="order_view">
    <h3>배송지정보</h3>
    <div id="order_frm">
        <label for="">주문배송지</label><?php if(empty($no_edit)) { ?><a class="addr_btn" onclick="sample2_execDaumPostcode()">주소검색</a><?php } ?>
        <input type="text" class="frm_input" id="order_addr1" name="order_addr1" placeholder="주소입력" value="<?=$row['order_addr1']?>" <?=$no_edit?> />
        <input type="text" class="frm_input" id="order_addr2" name="order_addr2" placeholder="상세주소" value="<?=$row['order_addr2']?>" <?=$no_edit?> />
        <input type="hidden" class="frm_input" id="order_post" name="order_post" value="<?=$row['order_post']?>" />
        <label>받는사람</label>
        <input type="text" class="frm_input" id="order_name" name="order_name" placeholder="이름" value="<?=$row['order_name']?>" <?=$no_edit?> />
        <label>연락처</label>
        <input type="text" class="frm_input" id="order_tel" name="order_tel" placeholder="연락처" maxlength="13" value="<?=$row['order_tel']?>" <?=$no_edit?> />
        <label for="">메모</label>
        <input type="text" class="frm_input" id="order_memo" name="order_memo" placeholder="전달할 내용을 간략하게 적어주세요" value="<?=$row['order_memo']?>" <?=$no_edit?> />
    </div>
    <div class="total">
        <span>합계</span> <strong id="total"><?=number_format($row['total_price'])?>원</strong>
    </div>
</div>
