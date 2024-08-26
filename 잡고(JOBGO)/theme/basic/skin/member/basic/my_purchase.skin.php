<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/epggea.css">', 0);
add_javascript('<script type="text/javascript" src="'.$member_skin_url.'/js/epggea.js"></script>', 100);


?>
<style>
.box-article .box-body .row{ background:#fff}
.tab-content {
	display: none;
	float: left;
	width: 100%;
	padding: 0 0 1em 0;
	background:#fff;
}
</style>

<!-- 출금 상세 내역 MODAL -->
<div class="modal fade" id="Withdraw_appli" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title"><i class="fal fa-coin"></i>&nbsp;구매 상세 내역</h4>
            </div>

            <div class="modal-body">
                    <div class="withdraw_appli" style="padding:0; border:0">
                         <dl>
                             <dt>구매 신청 마일리지</dt>
                             <dd><span id="modal_mileage_fee"></span></dd>
                         </dl>
                         <dl>
                             <dt>구매 후 마일리지</dt>
                             <dd class="tot"><span id="modal_mileage_after_fee"></span></dd>
                         </dl>
                    </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="mileage_request();">구매 신청하기</button>
            </div>
        </div><!--//modal-content-->
    </div>
</div>
<!-- //출금 상세 내역 MODAL-->


<!--출금 신청-->

<article id="mypage">

    <?php include_once($member_skin_path.'/mypage_left_menu.php'); ?>

        <section id="right_view">
             <h3>마일리지 구매</h3>
             
                <div id="my_income">
                    <header>
                            <h4>총 마일리지</h4>
                            <p class="tot_price"><?=number_format(floor($member['mb_7']))?><span>원</span></p>
                    </header>
                    <!--잡고캐쉬
                    <div class="cash_idx">
                            <ul>
                                <li>
                                    <a href="<?=G5_BBS_URL?>/my_item.php"><dl>
                                        <dt>출금가능 캐쉬</dt>
                                        <dd>2,500,000<span>원</span><span class="account">출금하기</span></dd>
                                    </dl></a>
                                </li>
                                <li>
                                    <a href="<?=G5_BBS_URL?>/my_contest.php"><dl>
                                        <dt>예상수익금</dt>
                                        <dd>250,000<span>원</span></dd>
                                    </dl></a>
                                </li>
                                <li>
                                    <a href="<?=G5_BBS_URL?>/my_inquiry.php"><dl>
                                        <dt>출금완료 수익금</dt>
                                        <dd>350,000<span>원</span></dd>
                                    </dl></a>
                                </li>
                            </ul>
                    </div>-->
                    <!--//잡고캐쉬-->
                    <div class="income_list">
                           <h4 class="account_info">마일리지 구매<span><i class="fal fa-coin"></i> 마일리지 구매 금액을 입력해주세요.</span></h4>
                    </div>
                    <div class="withdraw_appli">
                        <dl>
                            <dt>구매 가능 금액</dt>
                            <dd><span id="withdraw_atfer_fee"><?=number_format($member['mb_6'])?>원</span></dd>
                        </dl>
                         <dl>
                             <dt>마일리지 구매 금액</dt>
                             <dd>			
                             <label for="mileage_fee">마일리지 구매 금액</label>
			                 <input type="text" id="mileage_fee" onkeyup="add_comma(this);number_check(this);input_mileage(this.value);" >원
                             </dd>
                         </dl>
                        <dl>
                            <dt>구매 후 마일리지</dt>
                            <dd><span id="mileage_atfer_fee"><?=number_format(floor($member['mb_7']))?></span>원</dd>
                        </dl>
                    </div>
                    <div class="t_margin50"><button class="" data-toggle="modal" onclick="mileage_request_modal()">구매 신청</button></div>
                </div>
                      
        </section>

</article>

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

    // 출금 신청 금액 입력
    var flag = false;
    function input_mileage(fee) {
        fee = fee.replace(/,/gi, ""); // 입력 금액
        if(Number(fee) > Number('<?=floor($member['mb_6'])?>'.replace(/,/gi, ""))) {
            swal('구매 가능 금액이 부족합니다.');
            flag = true;
        } else {
            flag = false;
        }

        var mileage_after_fee = (<?=floor($member['mb_7'])?>*1) + (fee*1); // 출금 가능 금액 + 입력 금액 => +를 문자열 합치기로 인식해 *1해줌
        $('#mileage_atfer_fee').text(number_format(mileage_after_fee.toString())); // 출금 후 잔액

        $('#modal_mileage_fee').text(number_format(fee.toString())); // 모달 출금 신청 금액
        $('#modal_mileage_after_fee').text(number_format(mileage_after_fee.toString())); // 모달 출금 후 잔액
    }

    // 출금 신청
    function mileage_request_modal() {
        if($.trim($('#mileage_fee').val()) == '' || $.trim($('#mileage_fee').val()) == 0) {
            swal('구매금액을 입력하세요.');
            return false;
        }
        console.log(flag);
        if(flag) {
            swal('구매 가능 금액이 부족합니다.');
            return false;
        }
        $('#Withdraw_appli').modal('show');
    }

    // 최종 출금 신청
    function mileage_request() {
        $.ajax({
            url: g5_bbs_url + "/ajax.controller.php",
            type: "POST",
            data: {
                mode: 'mileage_request_update',
                mileage_fee: $('#mileage_fee').val() // 출금 신청 금액
            },
            success: function (data) {
                if(data == 'success') {
                    swal('마일리지 구매가 완료되었습니다.')
                        .then(() => {
                            location.replace(g5_bbs_url+'/my_purchase.php');
                        });
                }else{
                    swal('오류입니다. 다시 시도해주세요.')
                        .then(() => {
                            // location.replace(g5_bbs_url+'/my_purchase.php');
                        });
                }
            },
        });
    }
</script>