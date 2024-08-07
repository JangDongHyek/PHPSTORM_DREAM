<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>

<div id="find_info" class="new_win mbskin">
	<article class="box-article">
		<div class="box-body" style="margin-bottom:0;">
			<div class="box-contitle">
				비밀번호 찾기
			</div>
			<p style="margin-bottom:15px">회원가입시 등록하신 휴대폰번호를 입력해 주세요.</p>

			<form method="post" action="password_update.php" name="findFrm">
				<input type="hidden" name="mb_cert_no" id="mb_cert_no" value="">
				<div class="box-content box-bottom clearfix" style="border:none;">
					<dl style="padding:0 0 5px 0">
						<input type="tel" name="mb_id" id="mb_id" value="<?php echo $member['mb_id']?>" class="frm_input" style="width:<?php if($w=="") echo "calc(100% - 120px)"; else echo "100%;"?>" placeholder="본인ID : 01012345678" required onkeyup="this.value = number_only(this.value)">
						<input type="button" class="btn btn-danger" value="인증번호 발송" onclick="setRec();" style="width:115px; height:38px; float:right; <?php if($w!="") echo "display:none;";?>">
					</dl>
					<dl id="stx_rec" style="padding:0 0 5px 0; display:none;">	
					</dl>
					<dl id="set_rec" style="padding:0 0 5px 0; display:none;">
						<input type="tel" name="mb_cert" id="mb_cert" value="" class="frm_input" style="width:calc(100% - 60px)" placeholder="인증번호 입력" onkeyup="this.value = number_only(this.value)">
						<input type="button" class="btn btn-danger" value="인증" style="width:55px; height:38px; float:right;" onclick="setCert()">
					</dl>
					<dl id="set_pass" style="padding:0 0 5px 0; display:none;">
						<input type="password" name="mb_password" id="mb_password" value="" class="frm_input" style="width:100%;" placeholder="비밀번호" required>
						<input type="password" name="mb_password_chk" id="mb_password_chk" value="" class="frm_input" style="width:100%;margin: 5px 0;" placeholder="비밀번호 확인" required>
						<div id="pass_rec"></div>
						<input type="button" onclick="fnSubmit();" class="btn btn-primary btn-large" value="비밀번호 변경" accesskey="s" style="width:100%; height:auto; text-align:center; margin-top: 20px;">
					</dl>
				</div>
				
			</form>
		</div>
	</article>

	<!--
    <div class="win_btn">
        <input type="submit" class="btn_submit" value="확인">
        <button type="button" onclick="history.back();">뒤로가기</button>
    </div>
	-->
</div>

<script>
$(function(){
	$("#mb_password, #mb_password_chk").on("focus", function(){
		$("#pass_rec").text("");
	});
});

function fnSubmit(){
	var f = document.findFrm;
	var pass = f.mb_password.value;
	var pass_chk = f.mb_password_chk.value;

	if(pass == ""){
		$("#pass_rec").text("비밀번호를 입력하세요.");
		f.mb_password.focus();
		return false;
	}

	if(pass_chk == ""){
		$("#pass_rec").text("비밀번호 확인을 입력하세요.");
		f.mb_password_chk.focus();
		return false;
	}

	if(pass != pass_chk){
		$("#pass_rec").text("비밀번호와 비밀번호 확인이 다릅니다.");
		return false;
	}

	f.submit();

}
function setRec(){
	if(!$("#mb_id").val()){
		$("#stx_rec").css("display", "").html("아이디(휴대폰번호)를 입력해주세요.");
		return false;
	}else{
		$("#stx_rec").css("display", "").html("인증번호를 입력해주세요.");
	}

	var mb_hp = $("#mb_id").val();

	$.post(g5_bbs_url + "/ajax.hp_check.php",{ mb_hp:mb_hp, pageMode : "find" }, function (result){
		if(result.status == "false"){
			$("#stx_rec").html("존재하지 않는 회원입니다.");
			return false;
		}

		$("#mb_cert_no").val(result.cret);		
		$("#set_rec").slideDown(300);
		
		//setTimeout("autoCert('"+result.cret+"')","10000"); //??
	}, "json");
}

function setCert(){
	if($("#mb_cert").val() != $("#mb_cert_no").val()){
		$("#stx_rec").html("<font color=red>인증번호가 틀렸습니다.</font>");
	}else{
		$("#stx_rec").html("<font color=blue>인증이 완료 되었습니다.</font>");
		$("#set_pass").slideDown(300);
	}
}

function autoCert(cret){
	$("#mb_cert").val(cret);
}

function number_only(num) {
	num = num + "";
	num = num.replace(/[^0-9]/gi, ""); 

	if(isNaN(num)) return "";

	return num ;
}

</script>
