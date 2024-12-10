<?php
include_once('./_common.php');
$g5['title'] = '포인트출금신청';

if (!$is_member) { //if (!$is_driver) {
	alert("잘못된 접근입니다.", G5_URL."/index.php");
}

// 23.11.20 고천수만 포인트 wc
if (strpos($member['mb_name'],'고천수') === false) {
    alert("해당기능 사용불가능합니다.", G5_URL."/index.php");
}

include_once(G5_THEME_PATH.'/head.php');

// 계좌번호
$acc_info = "등록된 계좌가 없습니다.";
if ($member['mb_6'] != "" && $member['mb_7'] != "" && $member['mb_8'] != "") {
	$acc_info = $bank_list[$member['mb_6']]."&nbsp;".$member['mb_7']."<br>".$member['mb_8'];
}

?>


<div id="point_box">
	<div id="point_b">
    	<div class="pb_title">계좌번호</div>
        <div style="margin-bottom:30px;">
			<div class="pb_bank"><?=$acc_info?><a class="pb_btn2" href="./register_form.php?w=u#acc">은행계좌변경</a></div>         
			<? /*
            <div class="pb_bank">우리은행 111-11-11111 <a class="pb_btn2" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">계좌정보입력</a></div>         <!--.pb_bank-->
            <div class="collapse" id="collapseExample">
               <div class="well">
                 	<div class="bank_name row">
                        <div class="col-xs-6" style="padding:0 3px 0 15px;">
                        <select>
                            <option>은행선택</option>
                        </select>
                        </div>
                        <div class="col-xs-6" style="padding:0 15px 0 3px;"><input type="text"  placeholder="은행명" class="pb_input2"/></div>
                    </div><!--.bank_name-->
                    <div class="bank_man"><input type="text" placeholder="계좌주"  class="pb_input2"/></div><!--.bank_man-->
                    <div class="bank_num"><input type="text" placeholder="계좌번호" class="pb_input2"/></div><!--.bank_num-->
                    <div class="pb_btn3"><input type="button" value="저 장"/></div><!--.pb_btn3-->
               </div>
            </div><!--.collapse-->
			*/ ?>
        </div>
        
    	<div class="pb_title">환급신청</div>
        <div class="pb_my">
        	<div class="my_p"><div class="p_icon">P</div>출금가능금액 <strong><?=number_format($member['mb_point'])?>원</strong></div>
        </div><!--.pb_my-->

		<? if ($member['mb_user_acc'] == "Y") { ?>
		<form name="aFrm" id="aFrm" onsubmit="return fnSubmit(this);">
		<input type="hidden" name="point" value="<?=$member['mb_point']?>">
		<input type="hidden" name="moid" value="TR<? echo time().getRandomString(4, 'int')?>">
		<input type="hidden" name="bankCode" value="<?=$member['mb_6']?>">
		<input type="hidden" name="acntNo" value="<?=$member['mb_7']?>"><!-- 입금계좌번호 -->
		<input type="hidden" name="acntNm" value="<?=$member['mb_8']?>"><!-- 입금예금주 -->

        <!--<div class="pb_box row">
        	<div class="col-xs-8" style="padding:0 5px 0 15px;"><input type="number" name="amt" class="pb_input f_num" required /></div>
        	<div class="col-xs-4" style="padding:0 15px 0 0px;"><input type="submit" class="pb_btn" value="신청하기" /></div>
        </div>--><!--.pb_box-->

		<div class="pb_box row">
			<div class="col-xs-2"><button type="button" class="btn" onclick="changeAmt(0);">-</button></div>
			<div class="col-xs-8"><input type="text" name="amt" class="pb_input" required readonly value="10,000" /></div>
			<div class="col-xs-2"><button type="button" class="btn" onclick="changeAmt(1);">+</button></div>
			<div class="col-xs-12" style="margin-top:10px;"><input type="submit" class="pb_btn" value="출금" /></div>
		</div><!--.pb_box-->

        <div class="pb_txt">
			※ 출금액은 10,000원 단위로 가능하며, 출금시 수수료 500원이 차감된 금액이 입금됩니다.<br>
			<? if ($is_driver) { // 드라이버 : 잔여5만원이상 남아야함 ?>
			※ 환급신청 후 출금가능금액 잔여가 5만원 이상 남아야합니다.
			<div style="margin-left: 10px">예) 출금가능금액 6만원일때<br>1만원 출금가능 (잔여 5만원 남음)<br>2만원 출금불가 (잔여 4만원 남음)</div>
			<? } else { // 고객 : 잔여1만원이상 남아야함 ?>
			※ 환급신청 후 출금가능금액 잔여가 1만원 이상 남아야합니다.
			<div style="margin-left: 10px">예) 출금가능금액 2만원일때<br>1만원 출금가능 (잔여 1만원 남음)<br>2만원 출금불가 (잔여 없음)</div>
			<? } ?>
		</div>
		</form>

		<? } else { ?>
		<div class="pb_bank">관리자의 출금계좌 승인이 완료되어야 포인트 출금신청이 가능합니다.</div>
		<? } ?>
        
    </div><!--#point_b-->
</div><!--#point_box-->

<script src="<?=G5_JS_URL?>/jquery.serializeObject.js"></script>
<script>
var min_amt = 10000;	// 최소출금금액 1만원부터
var min_amt_str = "1만원";
var min_point = 50000;	// 출금후 포인트잔액이 5만원 이상 남아야함 (고객은 1만원이상)
var min_point_str = "5만원";

var is_driver = "<? echo ($is_driver)? 'T' : 'F'; ?>";

if (is_driver == "F") {
	min_point = 10000;
	min_point_str = "1만원";
}


$(function() {
	document.aFrm.amt.value = addComma(min_amt);
});

function changeAmt(mode) {
	var f = document.aFrm;
	var amt = parseInt(unComma(f.amt.value));

	amt = (mode == 0)? amt - 10000 : amt + 10000;
	if (amt < min_amt) amt = min_amt;

	f.amt.value = addComma(amt);
}

function fnSubmit(f) {
	var amt = parseInt(unComma(f.amt.value));
	var point = parseInt(f.point.value);

	if (amt < min_amt) {
		getNoti(1, "최소 "+ min_amt_str +"부터 출금이 가능합니다.", "", 2);
		f.amt.value = addComma(min_amt);
		return false;
	}

	// 출금후 포인트잔액이 5만원 이상 남아야함 (고객은 1만원이상)
	var point_bal = point - amt; 
	if (point_bal < min_point) { 
		getNoti(1, "환급신청 후 출금가능금액이 "+ min_point_str +" 이상 남아야함으로 출금이 불가능합니다.", "", 2);
		console.log('출금후 잔여', point_bal);
		return false;
	}

	if (point <  amt) {
		getNoti(1, "보유포인트가 부족합니다.");
		return false;
	}

	swal({
		//title : "제목",
		text: f.amt.value + "원을 출금하시겠습니까? 출금시 수수료 300원이 차감된 금액이 고객님의 계좌로 입금됩니다.",
		icon: 'info',
		buttons: ['닫기', '확인'],
		//dangerMode: true,
	}).then(function(result) {
		if (result) {
			getPointTransf();
		} else {
			return false;
		}
	});

	return false;

	//getNoti(1, "서비스 준비중입니다.");
	//return false;
}

function getPointTransf() {
	var obj = $("#aFrm").serializeObject();
	var err_msg = "포인트 출금신청에 실패하였습니다. 다시 시도해 주세요.";

	//obj.amt = 500;

	$('#page_loader').show();

	setTimeout(function() {
		$.ajax({
			type : "post",  
			url : g5_bbs_url + "/ajax.point_trans.php",
			data : obj,  
			dataType : "json",
			success : function(data){  
				console.log(data);
				$('#page_loader').hide();

				if (data.result == "F") {
					if (data.msg.length > 0) err_msg = data.msg;
					getNoti(1, err_msg);
				} else if (data.result == "T") {
					swal("", "고객님의 계좌로 포인트 출금이 완료되었습니다.", "success", {button: "확인",}).then(function(result) {
						location.reload();
					});
				}
			},
			error : function(xhr,status,error) {
				console.log(error);
				getNoti(1, err_msg, '', 2);
			},
			complete: function() {
				$('#page_loader').hide();
			}
		});
	}, 200);
}

</script>

<?php
//include_once('./_tail.sub.php');
include_once(G5_THEME_PATH.'/tail.php');
?>