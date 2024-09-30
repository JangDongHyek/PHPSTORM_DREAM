<?php
$pid = "order_deli";
include_once("./app_head.php");
/**
 * 주문하기 (정기배달도시락) - 사용안함
 */
loginCheck($member['mb_id']);
orderCheck(date('H:i'), 'deli'); // 주문가능시간 체크

if($w == 'u') {
    $do = sql_fetch(" select ord.*, do_price from g5_order as ord left join g5_dosirak as do on do.idx = ord.dosirak_idx where ord.idx = '{$idx}'");
} else {
    $do = sql_fetch(" select * from g5_dosirak where idx = '{$idx}' ");
}
$category = $do['do_category'] == "정기배달" ? "정기배달" : "샐러드팩";

// 정기배달시작일을 주문수정일 다음날로 지정 예) 오늘이 2022-02-11이면 배달시작일을 2022-02-12로
$timestamp = strtotime("+1 days");
$do['delivery_date'] = date("Y-m-d", $timestamp);
?>
<div id="container">
	<div id="order">
        <form id="forder" name="forder" method="post" action="./order_complete.php">
            <input type="hidden" name="idx" value="<?=$idx?>"> <!--도시락idx-->
            <input type="hidden" name="do_name" value="<?=$do['do_name']?>"> <!--도시락이름-->
            <input type="hidden" name="do_shipping_fee" value="<?=$do['do_shipping_fee']?>"> <!--도시락이름-->
            <input type="hidden" name="order_category" id="category" value="<?=$category?>">
            <input type="hidden" id="option" value="<?=$do['do_add_price']?>"> <!--추가금액여부-->
            <input type="hidden" id="min_cnt" value="<?=$do['do_min_delivery_cnt']?>"> <!--최소주문수량-->
            <input type="hidden" id="today" value="<?=date('Y-m-d')?>">
            <input type="hidden" id="w" name="w" value="<?=$w?>">
            <div class="title">
                <h2>주문메뉴 및 수량</h2>
            </div>
            <div id="order_frm">
                <ul>
                    <li><p class="num"><input type="text" id="order_amount" value="<?=$w=='u'? number_format($do['order_amount']) : ''?>" name="order_amount" class="frm_input" onkeyup="commaNumber(this);amountChk('<?=$do['do_price']?>', this.value);" />개</p>
                    <label for=""><?=$do['do_name']?></label>
                    </li>
                </ul>
                <?php if($do['do_warm'] == "Y") { ?>
                <!--<label>발열도시락변경 <?php /*if($do['do_add_price'] == "Y") { */?><strong>개당 1,000원</strong><?php /*} */?></label>
                <select class="frm_input" id="order_warm" name="order_warm" onchange="amountChk('<?/*=$do['do_price']*/?>', $('#order_amount').val(), this.value);">
                    <option value="N">변경안함</option>
                    <option value="Y">변경</option>
                </select>-->
                <?php } ?>
            </div>
            <div class="title">
                <h2>주문서작성</h2>
            </div>
            <div id="order_frm">
                <label>받는사람</label>
                <input type="text" class="frm_input" id="order_name" name="order_name" placeholder="이름" value="<?=$w=='u'? $do['order_name'] : $member['mb_name']?>" />
                <label>연락처</label>
                <input type="text" class="frm_input" id="order_tel" name="order_tel" placeholder="연락처" maxlength="13" value="<?=$w=='u'? $do['order_tel'] : $member['mb_hp']?>" />
                <label for="">주문배송지</label><a class="addr_btn" onclick="sample2_execDaumPostcode()">주소검색</a>
                <input type="text" class="frm_input" id="order_addr1" name="order_addr1" placeholder="주소입력" value="<?=$w=='u'? $do['order_addr1'] : ''?>" />
                <input type="text" class="frm_input" id="order_addr2" name="order_addr2" placeholder="상세주소" value="<?=$w=='u'? $do['order_addr2'] : ''?>" />
                <input type="hidden" class="frm_input" id="order_post" name="order_post" value="<?=$w=='u'? $do['order_post'] : ''?>" />
                <label for="">정기배달시작일</label>
                <input type="date" class="frm_input" id="delivery_date" name="delivery_date" placeholder="" style="text-indent: 10px !important;" value="<?=$do['delivery_date']?>" />
                <label for="">메모</label>
                <input type="text" class="frm_input" id="order_memo" name="order_memo" placeholder="전달할 내용을 간략하게 적어주세요" />
            </div>
            <div id="pay">
                <p>결제예정금액</p>
                <input type="hidden" id="shipping_fee" name="shipping_fee" value="<?=$w=='u'? $do['shipping_fee'] : $do['do_shipping_fee']?>">
                <input type="hidden" id="total_price" name="total_price" value="<?=$w=='u'? $do['total_price'] : ''?>">
                <strong id="total"><?=$w=='u'? number_format($do['total_price']) : '0'?>원</strong>
            </div>
            <div class="ft_btn">
            <?php if($w=='') { //주문접수?>
            <button type="button" class="b03" onclick="orderComplete('deli');">주문완료</button>
            <?php } else { //주문수정?>
            <button type="button" class="b02 half" onclick="history.back();">취소</button>
            <button type="button" class="b03 half" onclick="orderComplete('deli');">주문수정</button>
            <?php } ?>
            </div>
        </form>
    </div>

    <div id="layer" style="display:none;position:fixed;overflow:hidden;z-index:3;-webkit-overflow-scrolling:touch;">
        <div class="add_title">
            <h2>주소찾기</h2>
            <div class="btn_close" onclick="closeDaumPostcode()" alt="접기버튼">
                <span></span>
                <span></span>
            </div>
        </div>
        <i id="btnCloseLayer" style="margin-right:0px; font-style:normal; width:40px; height:40px; color:#fff; background:#222; font-size:1.2em; text-align:center; font-weight:bold; line-height:40px; cursor:pointer;position:absolute;right:0;bottom:0;z-index:1" onclick="closeDaumPostcode()" alt="닫기 버튼">X</i>
    </div>
</div>

<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<script src="./js/order.js"></script>

<?php
include_once ("./app_tail.php");
?>
