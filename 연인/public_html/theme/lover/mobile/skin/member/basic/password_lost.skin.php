<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>
<style>
.mbskin .btn_submit {width:60px;height:50px;background:#ac9dd4;color:#fff; width:100%;border-radius:0px !important; border:1px solid #fff; box-shadow:none;font-size:1.3em;font-weight:bold;margin:5px 0; transition:all 0.3s;}
.mbskin .btn_submit:hover{ background:#fff!important; color:#2abaee!important; border-color:#2abaee!important; transition:all 0.3s;}
.mbskin .win_btn {margin-top: 10px;}
.mbskin .win_btn:after{ display:block; content:""; color:both;}
.mbskin .win_btn .btn_submit{ font-size:13px; height:40px; float:left; width:50%; margin:0 !important; box-sizing: border-box;}
.mbskin .win_btn .btn01{padding: 0; float:left; width:calc(48% - 2%); margin-left:2%; height: 40px; line-height: 40px; box-sizing: border-box; font-size: 13px;}
#find_info{padding:30px;}
#find_info #mb_hp_label {display:inline-block;margin-left:10px}
#find_info #info_fs {margin:0px 0px;padding:0; font-size:0.95em;}
#find_info #info_fs label{ display:none;}
#find_info #info_fs .frm_input {width:100%; padding:0 10px; font-size:13px; margin-top:5px; height: 35px; background: #FFF; border: 0; border-bottom: 1px solid #ac9dd4; border-radius: 0 !important;}
#find_info #info_fs .phone{ width:65%;}
#find_info #info_fs .phone_btn{ width:calc(35% - 10px); margin:5px 0 0 5px; border:1px solid #333; background:#444; color:#fff; font-size:13px; padding:2px 0; height: 35px;}
#find_info #info_fs  p {margin:15px 0;line-height:1.5em; font-size:13px;}
#find_info #captcha {margin:0 20px}
.mbskin button.btn01{width:100%;padding:10px 0;text-align:center;border-radius:0px!important; background:none; 
					 border:1px solid #ccc; color:#333; margin-bottom:3px; font-size:0.9em; letter-spacing:-1px;}
#find_info #win_title { border-bottom:1px solid #ddd; padding:10px 0; font-size:1.4em; font-weight: 700;} 
</style>

<!-- 회원정보 찾기 시작 { -->
<div id="find_info" class="mbskin">
    <h1 id="win_title">회원정보 찾기</h1>
	
	<!-- 찾기 -->
	<div id="find_frm">
		<form name="fpasswordlost" action="<?php echo $action_url ?>" onsubmit="return fpasswordlost_submit(this);" method="post" autocomplete="off">
		<input type="hidden" name="chk_num" id="chk_num">
		<fieldset id="info_fs">
			<p>
				회원가입 시 등록하신 휴대폰번호를 입력해 주세요.<br>
				해당 휴대폰번호로 임시비밀번호를 보내드립니다.
			</p>
			<label for="mb_id">휴대폰번호<strong class="sound_only">필수</strong></label>
			<input type="number" name="mb_id" id="mb_id" required class="frm_input phone" placeholder="휴대폰번호 (숫자만 입력)">
			<button type="button" class="phone_btn" onclick="getAuthNum();">인증번호받기</button><br>
			<input type="number" name="auth_num" id="auth_num" required class="frm_input" minlength="6" maxlength="6" placeholder="인증번호 6자리">
		</fieldset>
		<div class="win_btn">
			<input type="submit" value="확인" class="btn_submit">
			<button type="button" onclick="javascript:history.back();" class="btn01">뒤로</button>
			<div style="clear:both;"></div>
		</div>
		</form>
	</div>
	<!-- // 찾기 -->

	<!-- 변경완료 -->
	<div id="find_result" style="display:none;clear:both;">
		<fieldset id="info_fs">
			<p>
				임시비밀번호로 변경 완료되었습니다. <br>로그인 후 비밀번호를 변경해 주세요.
			</p>
			<h1 style="margin-bottom:10px; font-size: 14px; font-weight:bold;">* 아이디 : <span id="tmp_id"></span></h1>
			<h1 style="margin-bottom:10px; font-size: 14px; font-weight:bold;">* 임시비밀번호 : <span id="tmp_pass"></span></h1>
			<div class="win_btn">
				<input type="button" value="로그인으로 이동" class="btn_submit" onclick="location.href='./login.php'">
				<button type="button" onclick="javascript:history.back();" class="btn01">뒤로</button>
			</div>
		</fieldset>
	</div>
	<!-- // 변경완료 -->
</div>

<script>
$("input[type=number]").on("keyup", function() {
	$(this).val($(this).val().replace(/[^0-9]/gi,""));
});

$('#mb_id').keydown(function(e) {
	if (e.keyCode === 13) {
		e.preventDefault();
		getAuthNum();
	};
});

// 인증번호 받기
function getAuthNum() {
	var f = document.fpasswordlost;

	f.chk_num.value = "";

	if (f.mb_id.value == "") {
		alert("휴대폰번호를 입력해 주세요.");
		f.mb_id.focus();
		return false;
	}

	$.ajax({
		type : "post",  
		url : g5_bbs_url + "/ajax.password_lost.php",
		data : {"mode" : "find", "mb_id" : f.mb_id.value},
		dataType : "json",  
		success : function(data){  
			var cnt = data.cnt;
			alert(data.msg);
			if (cnt > 0) {
				f.auth_num.focus();
				f.chk_num.value = parseInt(data.auth);
			}
			//console.log(data);
		}, 
		error : function(xhr,status,error) {
			alert("인증번호받기에 실패하였습니다. 다시 시도해 주세요.");
			console.log(error);
		}
	});
}

// 확인
function fpasswordlost_submit(f)
{
	if (f.mb_id.value == "") {
		alert("휴대폰번호를 입력해 주세요.");
		f.mb_id.focus();
		return false;
	}

	if (f.auth_num.value == "") {
		alert("인증번호 6자리를 입력해 주세요.");
		f.auth_num.focus();
		return false;
	}

	if (f.auth_num.value != f.chk_num.value) {
		alert("인증번호가 맞지 않습니다.");
		f.auth_num.focus();
		return false;
	}

	$.ajax({
		type : "post",  
		url : g5_bbs_url + "/ajax.password_lost.php",
		data : {"mode" : "modify", "mb_id" : f.mb_id.value},
		dataType : "json",  
		success : function(data) {
			if (data.rst == "T") {
				$("#find_frm").remove();
				$("#tmp_id").text(data.mb_id);
				$("#tmp_pass").text(data.auth);
				$("#find_result").show();
			} else {
				alert(data.msg);
			}
			console.log(data);
		}, 
		error : function(xhr,status,error) {
			alert("임시비밀번호 변경에 실패하였습니다. 다시 시도해 주세요.");
			console.log(error);
		},
		complete : function() {
			f.chk_num.value = "";
		}
	});

    return false;
}

</script>
<!-- } 회원정보 찾기 끝 -->