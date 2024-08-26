<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="' . $member_skin_url . '/style.css">', 0);
add_stylesheet('<link rel="stylesheet" href="' . $member_skin_url . '/epggea.css">', 0);
add_javascript('<script type="text/javascript" src="' . $member_skin_url . '/js/epggea.js"></script>', 100);
?>

<style>
    .box-article .box-body .row {
        background: #fff
    }

    .tab-content {
        display: none;
        float: left;
        width: 100%;
        padding: 0 0 1em 0;
        background: #fff;
    }

    #reply {
        display: none
    }
</style>

<!-- 충전 상세 내역 MODAL -->
<div class="modal fade" id="cash_Charge" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title"><i class="fal fa-coin"></i>&nbsp;충전 상세 내역</h4>
            </div>

            <div class="modal-body">
                <div class="withdraw_appli" style="padding:0; border:0">
                    <dl>
                        <dt>캐쉬 충전</dt>
                        <dd><span id="modal_pucharse_fee">0원</span></dd>
                    </dl>
                    <dl>
                        <dt>충전 후 캐쉬</dt>
                        <dd class="tot"><span id="modal_pucharse_after_fee">0원</span></dd>
                    </dl>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="purchase_request();">충전 신청하기</button>
            </div>
        </div><!--//modal-content-->
    </div>
</div>
<!-- //충전 상세 내역 MODAL-->

<script type="text/javascript" src="https://pg.innopay.co.kr/pay/js/Innopay.js"></script><!-- InnoPay 결제연동 스크립트(필수) -->
<form id="payfrm" name="payfrm" method="post">
    <!-- 이노페이 필수 -->
    <input type="hidden" name="Amt" id="Amt" value="">
    <input type="hidden" name="GoodsCnt" value="">
    <input type="hidden" name="GoodsName" value="JOBGO">
    <input type="hidden" name="Moid" id="Moid" value="<?=$Moid?>">
    <input type="hidden" name="MID" value="pgjobgo02m"> <!-- 테스트 : testpay01m -->
    <input type="hidden" name="MerchantKey" value="caDx7wMGGxhsGE5ryFLl9jfXFmP/Fnuatc246Ant4tp0QGElAzqbW5laOQy2wquABsAzNrQ6VOhsVYDr0M/yMA=="> <!-- 테스트 : Ma29gyAFhvv/+e4/AHpV6pISQIvSKziLIbrNoXPbRS5nfTx2DOs8OJve+NzwyoaQ8p9Uy1AN4S1I0Um5v7oNUg== -->
    <input type="hidden" name="ReturnURL" value="<?=G5_BBS_URL?>/pay_result.php">
    <input type="hidden" name="RetryURL" value="<?=G5_BBS_URL?>/pay_result.php">
    <input type="hidden" name="ResultYN" value="N">

    <input type="hidden" name="mallUserID" value="<?=$member['mb_id']?>">
    <input type="hidden" name="BuyerName" value="<?=$member['mb_name']?>">
    <input type="hidden" name="BuyerTel" value="<?=str_replace ('-','',$member['mb_hp'])?>">
    <input type="hidden" name="BuyerEmail" value="<?=$mb['mb_email']?>"> <!-- 판매자 -->
    <input type="hidden" name="EncodingType" id="EncodingType" value="utf-8">
    <input type="hidden" name="FORWARD" value="Y"><!-- 팝업유무 Y,N -->

    <input type="hidden" name="ediDate" value=""><!-- 결제요청일시 제공된 js 내 setEdiDate 함수를 사용하거나 가맹점에서 설정 yyyyMMddHHmmss-->
    <input type="hidden" name="EncryptData" value=""><!-- 암호화데이터 -->
    <input type="hidden" name="MallIP" value="127.0.0.1"/>
    <input type="hidden" name="UserIP" value="127.0.0.1">
    <input type="hidden" name="MallResultFWD" value="N"><!-- Y 인 경우 PG결제결과창을 보이지 않음 -->
    <input type="hidden" name="device" value=""><!-- 자동셋팅 -->

<!--마이페이지-->
<article id="mypage">

    <?php include_once($member_skin_path . '/mypage_left_menu.php'); ?>

    <section id="right_view">
        <h3>캐쉬 충전</h3>

        <div id="my_income">
            <header>
                <h4>총 캐쉬</h4>
                <p class="tot_price"><?=number_format($mb['mb_6'])?><span>원</span></p>
            </header>
            <div class="income_list">
                <h4 class="account_info">캐쉬 충전<span><i class="fal fa-coin"></i>캐쉬 충전 금액을 입력해주세요.</span></h4>
            </div>
            <div class="withdraw_appli">
                <dl>
                    <dt>캐쉬 충전 금액</dt>
                    <dd>
                        <label for="purchase_fee">캐쉬 충전 금액</label>
                        <input type="text" id="purchase_fee" onkeyup="add_comma(this);number_check(this);input_cash(this.value);">원
                    </dd>
                </dl>
            </div>
            <div class="howorder t_margin20">
                <h3>결제방법</h3>
                <div>
                    <input type="radio" id="pm1" name="PayMethod" value="CARD" checked="">
                    <label for="pm1">카드결제</label>&nbsp;&nbsp;
                    <input type="radio" id="pm2" name="PayMethod" value="BANK">
                    <label for="pm2">계좌이체</label>&nbsp;&nbsp;
                    <input type="radio" id="pm3" name="PayMethod" value="EPAY">
                    <label for="pm3">간편결제</label>
                </div>
            </div>
            <div class="t_margin50">
                <button type="button" class="" onclick="purchase_request_modal();">충전 신청</button>
            </div>
        </div>

    </section>

</article>

</form>

<script>
    // 금액 천단위 콤마
    function add_comma(data) {
        var price = data.value;
        price = price.replaceAll(/,/gi, "");
        $('#'+data.id).val(number_format(price));
    }

    // 숫자만 입력
    function number_check(data) {
        $('#'+data.id).val(data.value.replace(/[^\d]+/g, ''));
        $('#'+data.id).val(data.value.replace(/(\d)(?=(?:\d{3})+(?!\d))/g, '$1,'));
    }

     // 충전 금액 입력 시 모달 데이터 입력
    function input_cash(fee) {
        fee = fee.replace(/,/gi, ""); // 입력 금액

        $('#Amt').val(fee);

        var pucharse_after_fee = Number('<?=$mb['mb_6']?>') + Number(fee); // 잔여 캐시 + 충전 신청 금액

        $('#modal_pucharse_fee').text(number_format(fee.toString())+'원'); // 모달 충전 신청 금액
        $('#modal_pucharse_after_fee').text(number_format(pucharse_after_fee.toString())+'원'); // 모달 충전 후 잔액
    }

    // 충전 신청
    function purchase_request_modal() {
        if($.trim($('#purchase_fee').val()) == '' || $.trim($('#purchase_fee').val()) == 0) {
            swal('캐쉬 충전 금액을 입력하세요.');
            return false;
        }

        $('#cash_Charge').modal('show');
    }

    /*//이노페이 금액 보내기
    $("#pay_submit").on("click", function() {
        if($('input[id="check_order"]:checked').val() != 'Y'){
            swal('결제동의 부분을 체크 하지 않으면 결제가 불가능 합니다.');
            return false;
        }
        // console.log(document.payfrm);
        $('#Moid').val("<?=$Moid?>" + "=" + $('#GoodsCnt').val());
        goPay(document.payfrm);
    });*/

    // 이노페이 금액 보내기
    function purchase_request() {
        $('#Moid').val("<?=$Moid?>" + "=Y");
        goPay(document.payfrm);
    }
</script>
