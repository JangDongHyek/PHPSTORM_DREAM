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
                <h4 class="modal-title"><i class="fal fa-credit-card"></i>&nbsp;출금 상세 내역</h4>
            </div>

            <div class="modal-body">
                    <div id="my_income" style="margin:15px 0">
                        <div class="income_list" style="margin:0">
                               <h4 class="account_info">입금계좌 정보<span name="mb_1_mb_2_mb_3"><i class="fal fa-money-check"></i> <?=$bank_list[$mb['mb_1']]?> <?=$mb['mb_3']?> (<?=$mb['mb_2']?>)</span></h4>
                        </div>
                    </div>
                    <div class="withdraw_appli" style="padding:0; border:0">
                         <dl>
                             <dt>출금 신청 금액</dt>
                             <dd><span id="modal_withdraw_fee">0원</span></dd>
                         </dl>
                         <!--<dl>
                             <dt>수수료</dt>
                             <dd>50,000원</dd>
                         </dl>-->
                         <dl>
                             <dt>출금 후 잔액</dt>
                             <dd><span id="modal_withdraw_after_fee">0원</span></dd>
                         </dl>
                         <!--<dl>
                             <dt>최종 출금 금액</dt>
                             <dd class="tot"><span id="modal_total_withdraw_fee">0원</span></dd>
                         </dl>-->
                    </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="withdraw_request();">출금 신청하기</button>
<p class="addcount">입금계좌 변경은 <a href="<?php echo G5_BBS_URL ?>/my_income.php">마이페이지 > 수익관리</a>에서 변경 가능</p>
					<p class="addcount st2">캐시는 수수료 10%를 제외한 금액</p>
            </div>
        </div><!--//modal-content-->
    </div>
</div>
<!-- //출금 상세 내역 MODAL-->

<!-- 계좌번호 MODAL -->
<div class="accountModal modal fade" id="mb1_write_modal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title"><i class="fal fa-credit-card"></i>&nbsp;계좌번호 등록</h4>
            </div>

            <div class="modal-body">
                <div id="my_income" style="margin:15px 0">
                    <div class="income_list" style="margin:0">
                        <h4 class="account_info">입금계좌가 등록되지 않았습니다.<br>입금계좌 및 예금주를 등록해주세요.</h4>
                    </div>
                </div>
                <div class="withdraw_appli" style="padding:0; border:0">
                    <dl>
                        <dt>예금주</dt>
                        <dd><input type="text" style="width: 120px" name = 'mb_2' value="<?=$member['mb_2']?>" placeholder="예금주">
                            <select name="mb_1" style="width: 100px" class="select <?php echo $required ?>" id="mb_1" title="은행 선택" >
                                <option value="" hidden>은행 선택</option>
                                <!--normal select-->
                                <option value="">은행명</option>
                                <? foreach ($bank_list as $code=>$name) { ?>
                                    <option value="<?=$code?>" <? if ($code == $member['mb_1']) echo "selected"; ?>><?=$name?></option>
                                <? } ?>
                            </select>
                        </dd>
                    </dl>
                    <!--<dl>
                        <dt>수수료</dt>
                        <dd>50,000원</dd>
                    </dl>-->
                    <dl>
                        <dt>계좌번호</dt>
                        <dd><input name = 'mb_3' type="text" value="<?=$member['mb_3']?>" placeholder="계좌번호"></dd>
                    </dl>
                    <!--<dl>
                        <dt>최종 출금 금액</dt>
                        <dd class="tot"><span id="modal_total_withdraw_fee">0원</span></dd>
                    </dl>-->
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="mb_1_write();">계좌 등록하기</button>
            </div>
        </div><!--//modal-content-->
    </div>
</div>
<!-- //출금 상세 내역 MODAL-->



<!--출금 신청-->

<article id="mypage">

    <?php include_once($member_skin_path.'/mypage_left_menu.php'); ?>

        <section id="right_view">
             <h3>출금하기</h3>
             
                <div id="my_income">
                    <header>
                            <h4>출금 가능 금액</h4>
                            <p class="tot_price"><?=number_format(floor($mb['mb_6']))?><span>원</span></p>
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
                           <h4 class="account_info">입금계좌 정보<span name="mb_1_mb_2_mb_3"><i class="fal fa-money-check"></i> 입금정보 : <?=$bank_list[$mb['mb_1']]?> <?=$mb['mb_3']?> (<?=$mb['mb_2']?>)</span></h4>
                    </div>
                    <div class="withdraw_appli">
                         <dl>
                             <dt>출금 신청 금액</dt>
                             <dd>			
                             <label for="withdraw_fee">출금 신청 금액</label>
			                 <input type="text" id="withdraw_fee" onkeyup="add_comma(this);number_check(this);input_withdraw(this.value);">원
                             </dd>
                         </dl>
                         <!--<dl>
                             <dt>수수료</dt>
                             <dd>50,000원</dd>
                         </dl>-->
                         <dl>
                             <dt>출금 후 잔액</dt>
                             <dd><span id="withdraw_atfer_fee">0원</span></dd>
                         </dl>
                         <!--<dl>
                             <dt>최종 출금 금액</dt>
                             <dd class="tot"><span id="total_withdraw_fee">0원</span></dd>
                         </dl>-->
                    </div>
                    <div class="t_margin50"><button class="" onclick="withdraw_request_modal();">출금 신청</button></div>
					

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
    function input_withdraw(fee) {
        fee = fee.replace(/,/gi, ""); // 입력 금액
        if(Number(fee) > Number('<?=floor($mb['mb_6'])?>'.replace(/,/gi, ""))) {
            swal('출금 가능 금액이 부족합니다.');
            flag = true;
        } else {
            flag = false;
        }

        var withdraw_after_fee = '<?=floor($mb['mb_6'])?>' - fee; // 출금 가능 금액 - 입력 금액
        $('#withdraw_atfer_fee').text(number_format(withdraw_after_fee.toString())+'원'); // 출금 후 잔액

        $('#modal_withdraw_fee').text(number_format(fee.toString())+'원'); // 모달 출금 신청 금액
        $('#modal_withdraw_after_fee').text(number_format(withdraw_after_fee.toString())+'원'); // 모달 출금 후 잔액
    }

    var is_req = false;
    // 출금 신청
    function withdraw_request_modal() {

        if (is_req){
            swal("출금신청을 진행중입니다.. 기다려주세요.");
            return false;
        }
        if($.trim($('#withdraw_fee').val()) == '' || $.trim($('#withdraw_fee').val()) == 0) {
            swal('출금 신청 금액을 입력하세요.');
            return false;
        }
        if(flag) {
            swal('출금 가능 금액이 부족합니다.');
            return false;
        }

        $('#Withdraw_appli').modal('show');
    }

    // 최종 출금 신청
    function withdraw_request() {
        is_req = true;

        $.ajax({
            url: g5_bbs_url + "/ajax.withdraw_request.php",
            type: "POST",
            data: {
                withdraw_fee: $('#withdraw_fee').val(), // 출금 신청 금액
                now_fee: Number('<?=floor($mb['mb_6'])?>'.replace(/,/gi, "")), // 출금 가능 금액
            },
            success: function (data) {
                if(data == 'success') {
                    swal('출금 신청이 완료되었습니다.')
                    .then(() => {
                        location.replace(g5_bbs_url+'/my_withdraw.php');
                    });
                }else if(data == 'modal'){
                    //계좌등록 안되어있을 경우 모달 출력
                    $("#mb1_write_modal").modal();

                }else{

                    swal(data);
                }
            },
        });
    }
    //계좌번호 등록
    function mb_1_write() {
        var mb_1 = $('[name = mb_1]').val(),
         mb_2 = $('[name = mb_2]').val(),
         mb_3 = $('[name = mb_3]').val();

        $.ajax({
            url: g5_bbs_url + "/ajax.controller.php",
            type: "POST",
            data: {
                mode : "mb_1_write",
                mb_1 : mb_1,
                mb_2 : mb_2,
                mb_3 : mb_3
            },
            dataType: "json",
            success: function (data) {

                if (data.code == "success") {
                    $('#mb1_write_modal').modal("hide"); //닫기
                    $('[name=mb_1_mb_2_mb_3]').html('<i class="fal fa-money-check"></i> 출금정보 : ' + data.mb_1+" "+ mb_3 + '(' + mb_2 + ')');
                    swal("계좌가 등록되었습니다. 출금신청을 다시 시도해주세요.");
                }else{
                    swal("오류입니다. 다시 시도해주세요. ");
                }
            },
        });
    }
</script>