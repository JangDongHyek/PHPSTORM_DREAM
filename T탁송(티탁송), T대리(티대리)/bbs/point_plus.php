<?php
include_once('./_common.php');
$g5['title'] = '포인트충전';

//if (!$is_member || $is_driver) {
if (!$is_member) {
	alert("잘못된 접근입니다.", G5_URL."/index.php");
}

include_once(G5_THEME_PATH.'/head.php');

// 전용계좌 발급확인
$my_bank = getMemberVbankNo($member['mb_id']);

?>
<div id="point_box">
	<div id="point_b">
    	<div class="pb_title">포인트충전</div>
        
        <div class="pb_my">
        	<div class="my_p"><div class="p_icon">P</div>보유포인트 <strong><?=number_format($member['mb_point'])?>점</strong></div>
        </div><!--.pb_my-->

		<?
		// 전용계좌가 없으면 발급폼 노출
		if (count($my_bank) == 0) {
		?>
		<form name="aFrm" onsubmit="return fnSubmit(this);">
		<input type="hidden" name="mb_id" value="<?=$member['mb_id']?>">
        <div class="pb_box row">
			<? /*
        	<div class="col-xs-8" style="padding:0 5px 0 15px;"><input type="number" name="amt" class="pb_input f_num" required /><!-- 충전액 --></div>
        	<div class="col-xs-4" style="padding:0 15px 0 0px;"><input type="submit" class="pb_btn" value="충전하기" /></div>
			*/ ?>
			<div class="col-xs-12" style="padding:0 15px;"><input type="submit" class="pb_btn" value="전용계좌발급" /></div> 
        </div><!--.pb_box-->
        <div class="pb_txt">[전용계좌발급]을 누르시면 고객님의 포인트 충전 전용계좌가 발급되며, 입금이 완료되면 포인트가 자동으로 충전됩니다.</div>
		</form>
		<?
		// 전용계좌가 있으면 계좌노출
		} else { 
		?>
		<div class="pb_title">전용계좌안내</div>
		<div class="pb_my">
			<div class="my_p"><?=$my_bank['bank_name']?> <?=$my_bank['acc_no']?></div>
			<div class="my_p">예금주 : 주식회사 티대리</div>
		</div>
		<div class="pb_txt">전용계좌로 입금이 완료되면 포인트가 자동으로 충전됩니다.<br>충전된 포인트는 [포인트적립내역]에서 확인할 수 있습니다.</div>
		<? } ?>
    </div><!--#point_b-->
</div><!--#point_box-->


<script>
function fnSubmit(f) {
	var err = "전용계좌 발급에 실패하였습니다. 다시 시도해 주세요.";

	$.ajax({
		type : "post",  
		url : "./ajax.point_charge.php",
		data : {"mb_id" : f.mb_id.value},
		dataType : "json", 
		async : false,
		success : function(data){
			var _err = (data.err_msg != "")? data.err_msg : err;
			if (data.result == "T") {
				swal("", "고객님의 포인트충전 전용계좌가 발급되었습니다.", "success", {button: "확인",}).then(function(result) {
					location.reload();
				});
			} else {
				swal("", _err, "error", {button: "확인",}).then(function(result) {
					location.reload();
				});
			} 
			return false;
		}, 
		error : function(xhr,status,error) {
			console.log(error);
			swal("", err, "error", {button: "확인",}).then(function(result) {
				location.reload();
			});
		}
	});
	
	return false;
}
</script>

<?php
include_once('./_tail.sub.php');
//include_once(G5_THEME_PATH.'/tail.php');
?>