<?php
$pid = "order_event";
include_once("./app_head.php");
/**
 * 주문하기 (일반도시락) - 사용안함
 */
loginCheck($member['mb_id']);
orderCheck(date('H:i')); // 주문가능시간 체크

$do = sql_fetch(" select * from g5_dosirak where idx = '{$idx}' ");
?>
<div id="container">
	<div id="order">
        <form id="forder" name="forder" method="post" action="./order_complete.php">
        <input type="hidden" id="w" name="w">
        <input type="hidden" name="idx" value="<?=$idx?>"> <!--도시락idx-->
        <input type="hidden" name="do_name" value="<?=$do['do_name']?>"> <!--도시락이름-->
        <input type="hidden" name="do_shipping_fee" value="<?=$do['do_shipping_fee']?>"> <!--도시락이름-->
        <input type="hidden" name="order_category" id="category" value="<?=$do['do_category']?>">
        <input type="hidden" id="option" value="<?=$do['do_add_price']?>"> <!--추가금액여부-->
        <input type="hidden" id="min_cnt" value="<?=$do['do_min_delivery_cnt']?>"> <!--최소주문수량-->
        <input type="hidden" id="today" value="<?=date('Y-m-d')?>">
        <div class="title">
            <h2>주문메뉴 및 수량</h2>
        </div>
        <div id="order_frm">
            <ul>
                <li><p class="num"><input type="text" id="order_amount" name="order_amount" class="frm_input" onkeyup="commaNumber(this);amountChk('<?=$do['do_price']?>', this.value);" />개</p>
                <label for=""><?=$do['do_name']?></label><br>
                <!--<em style="font-style: unset;font-size: 0.9em">* 최소주문수량 <?/*=$do['do_min_delivery_cnt']*/?>개</em>-->
                </li>
            </ul>
            <!--제품별 추가 옵션사항-->
            <?php if($do['do_warm'] == "Y") { ?>
            <!--<label>발열도시락변경 <strong>개당 1,000원</strong></label>
            <select class="frm_input" id="order_warm" name="order_warm" onchange="amountChk('<?/*=$do['do_price']*/?>', $('#order_amount').val(), this.value);">
                <option value="N">변경안함</option>
                <option value="Y">변경</option>
            </select>-->
            <?php } ?>
            <!--//제품별 추가 옵션사항-->
        </div>
        <div class="title">
            <h2>주문서작성</h2>
        </div>
        <div id="order_frm">
            <label>받는사람</label>
            <input type="text" class="frm_input" id="order_name" name="order_name" placeholder="이름(회사명)" value="<?=$member['mb_name']?>" />
            <label>연락처</label>
            <input type="text" class="frm_input" id="order_tel" name="order_tel" placeholder="연락처" maxlength="13" value="<?=$member['mb_hp']?>" />
            <label for="">행사장소</label><a class="addr_btn" onclick="sample2_execDaumPostcode()">주소검색</a>
            <input type="text" class="frm_input" id="order_addr1" name="order_addr1" placeholder="주소입력" />
            <input type="text" class="frm_input" id="order_addr2" name="order_addr2" placeholder="상세주소" />
            <input type="hidden" class="frm_input" id="order_post" name="order_post" />
            <label for="" style="display:block;">행사날짜</label>
            <input type="date" class="frm_input" id="event_date" name="event_date" placeholder="" style="text-indent: 10px !important; min-width:calc(100% - 40px); width:100%; display:block;" />
            <label for="">행사시간</label>
            <!--<input type="time" class="frm_input" placeholder="" style="text-indent: 10px !important;" />-->
            <select class="frm_input" id="event_time" name="event_time">
                <option value="08:00">08:00</option>
                <option value="09:00">09:00</option>
                <option value="10:00">10:00</option>
                <option value="11:00">11:00</option>
                <option value="12:00">12:00</option>
                <option value="13:00">13:00</option>
                <option value="14:00">14:00</option>
                <option value="15:00">15:00</option>
                <option value="16:00">16:00</option>
                <option value="17:00">17:00</option>
                <option value="18:00">18:00</option>
                <option value="19:00">19:00</option>
                <option value="20:00">20:00</option>
            </select>
            <label for="">메모</label>
            <input type="text" class="frm_input" id="order_memo" name="order_memo" placeholder="전달할 내용을 간략하게 적어주세요" />
        </div>
        <div id="pay">
            <p>결제금액</p>
            <input type="hidden" id="shipping_fee" name="shipping_fee" value="<?=$do['do_shipping_fee']?>">
            <input type="hidden" id="total_price" name="total_price" value="">
            <strong id="total"><span>(+) 배송비 <?=number_format($do['do_shipping_fee'])?>원</span>0원</strong>
        </div>
        <div class="ft_btn">
        <button type="button" class="b03" onclick="orderComplete('event');">주문완료</button>
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
<script src="./js/order.js?v=<?=G5_JS_VER?>"></script>

<?php
include_once ("./app_tail.php");
?>
