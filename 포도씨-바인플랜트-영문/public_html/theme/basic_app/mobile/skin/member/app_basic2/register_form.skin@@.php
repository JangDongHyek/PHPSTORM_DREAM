<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>

<div class="mbskin">
    <script src="<?php echo G5_JS_URL ?>/jquery.register_form.js"></script>
    <?php if($config['cf_cert_use'] && ($config['cf_cert_ipin'] || $config['cf_cert_hp'])) { ?>
    <script src="<?php echo G5_JS_URL ?>/certify.js"></script>
    <?php } ?>

    <form name="fregisterform" id="fregisterform" action="<?php echo $register_action_url ?>" onsubmit="return fregisterform_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
    <input type="hidden" name="w" value="<?php echo $w;?>">
    <input type="hidden" name="url" value="<?php echo $urlencode ?>">
    <input type="hidden" name="cert_type" value="<?php echo $member['mb_certify']; ?>">
    <input type="hidden" name="cert_no" value="">
    <input type="hidden" name="mb_sns_type" value="<?php echo $mb_sns_type;?>">
    <input type="hidden" name="mb_type" id="mb_type" value="<?php echo $mb_type;?>">
    <?php if (isset($member['mb_sex'])) { ?><input type="hidden" name="mb_sex" value="<?php echo $member['mb_sex'] ?>"><?php } ?>
    <?php if (isset($member['mb_nick_date']) && $member['mb_nick_date'] > date("Y-m-d", G5_SERVER_TIME - ($config['cf_nick_modify'] * 86400))) { // 닉네임수정일이 지나지 않았다면 ?>
    <input type="hidden" name="mb_nick_default" value="<?php echo get_text($member['mb_nick']) ?>">
    <input type="hidden" name="mb_nick" value="<?php echo get_text($member['mb_nick']) ?>">
    <?php } ?>
	
	<article class="box-article">
		<div class="box-body">
			<dl>
				<dt><i class="fa fa-pencil-square-o" aria-hidden="true"></i> 회원 정보 입력</dt>
			
			</dl>

			<dl class="row">
				<dd class="col-xs-12">
					<label for="reg_mb_id">아이디</label>
					<input type="text" name="mb_id" value="<?php echo $member['mb_id'] ?>" id="reg_mb_id" class="regist-input <?php echo $required ?> <?php if($w=="u") echo "readonly";?>" minlength="6" maxlength="20" <?php echo $required ?> placeholder="아이디" <?php if($w=="u") echo "readonly";?>>
				</dd>
				<dd class="status_icons text-right">
					<i class="fa fa-check-circle" aria-hidden="true"></i>
				</dd>
				<dd class="col-xs-12"></dd>
			</dl>

			<dl class="row">
				<dd class="col-xs-12">
					<label for="reg_mb_password">비밀번호</label>
					<input type="password" name="mb_password" id="reg_mb_password" class="regist-input <?php echo $required ?>" minlength="6" maxlength="20" <?php echo $required ?> placeholder="비밀번호">
				</dd>
				<dd class="status_icons text-right">
					<i class="fa fa-lock" aria-hidden="true"></i>
				</dd>
				<dd class="col-xs-12"></dd>
			</dl>

			<dl class="row">
				<dd class="col-xs-12">
					<label for="mb_password_re">비밀번호확인</label>
					<input type="password" name="mb_password_re" id="reg_mb_password_re" class="regist-input <?php echo $required ?>" minlength="6" maxlength="20" <?php echo $required ?> placeholder="비밀번호확인">
				</dd>
				<dd class="status_icons text-right">
					<i class="fa fa-unlock-alt" aria-hidden="true"></i>
				</dd>
				<dd class="col-xs-12"></dd>
			</dl>

			<dl class="row">
				<dd class="col-xs-12">
					<label for="reg_mb_name">이름</label>
					<input type="text" name="mb_name" value="<?php echo $member['mb_name'] ?>" id="reg_mb_name" class="regist-input <?php echo $required ?>" <?php echo $required ?> placeholder="이름" <?php if($w=="u") echo "readonly";?>>
				</dd>
				<dd class="status_icons text-right">
					<i class="fa fa-check-circle" aria-hidden="true"></i>
				</dd>
				<dd class="col-xs-12"></dd>
			</dl>
			
			<dl class="row">
				<dd class="col-xs-12">
					<label for="reg_mb_hp">휴대번호</label>
					<input type="tel" name="mb_hp" value="<?php echo $member['mb_hp'] ?>" id="reg_mb_hp" class="regist-input <?php echo $required ?>" <?php echo $required ?> placeholder="휴대번호" style="font-size:0.95em;" minlength="10" maxlength="14">
				</dd>
				<dd class="status_icons text-right">
					<i class="fa fa-check-circle" aria-hidden="true"></i>
				</dd>
				<dd class="col-xs-12"></dd>
			</dl>

			<dl class="row">
				<dd class="col-xs-12">
					<label for="reg_mb_nick">닉네임</label>
					<input type="text" name="mb_nick" id="reg_mb_nick" class="regist-input <?php echo $required ?> <?php if($w=="u") echo "readonly";?>" minlength="2" maxlength="20" <?php echo $required ?> placeholder="닉네임" value="<?php echo $member['mb_nick']; ?>">
				</dd>
				<dd class="status_icons text-right">
					<i class="fa fa-check-circle" aria-hidden="true"></i>
				</dd>
				<dd class="col-xs-12"></dd>
			</dl>

			<dl class="row">
				<dd class="col-xs-12">
					<label for="reg_mb_email">E-mail</label>
					<input type="text" name="mb_email" id="reg_mb_email" class="regist-input <?php echo $required ?>" minlength="3" maxlength="50" <?php echo $required ?> placeholder="E-mail" value="<?php echo $member['mb_email']; ?>">
				</dd>
				<dd class="status_icons text-right">
					<i class="fa fa-check-circle" aria-hidden="true"></i>
				</dd>
				<dd class="col-xs-12"></dd>
			</dl>

		</div>
		
		<?php if($w == ""){ ?>
		<div class="box-body">
			<dl>
				<dt><i class="fa fa-check-square-o" aria-hidden="true"></i> 약관동의</dt>
			</dl>
			<dl class="row agree-row">
				<dd class="col-xs-8" data-for="reg_req1">
					<input type="hidden" name="reg_req[]" id="reg_req1" value="">
					<i class="fa fa-square-o"></i> 이용약관 동의 (필수)
				</dd>
				<dd class="col-xs-4 text-right"><input type="button" value="내용보기" class="btn btn-danger btn-agr"></dd>
				<dd class="col-xs-12"><textarea readonly><?php echo get_text($config['cf_stipulation']) ?></textarea></dd>
			</dl>
			
			<dl class="row agree-row">
				<dd class="col-xs-8" data-for="reg_req2">
					<input type="hidden" name="reg_req[]" id="reg_req2" value="">
					<i class="fa fa-square-o"></i> 개인정보처리방침 동의 (필수)
				</dd>
				<dd class="col-xs-4 text-right"><input type="button" value="내용보기" class="btn btn-danger btn-agr"></dd>
				<dd class="col-xs-12"><textarea readonly><?php echo get_text($config['cf_stipulation']) ?></textarea></dd>
			</dl>
			
			<dl class="agree-row">
				<dd data-for="reg_chk1">
					<input type="hidden" name="reg_chk[]" id="reg_chk1" value="">
					<i class="fa fa-square-o"></i> 선택 동의 (선택)
				</dd>
			</dl>
		</div>
		<?php } ?>

		<input type="submit" class="btn btn-danger btn-large" style="margin:10px; width:calc(100% - 20px); padding:5px 0 10px 0; border-radius:4px; font-size:1.4em;" value="<?php echo $w==''?'회원가입':'정보수정'; ?>" accesskey="s">
	</article>
    </form>
</div>


<script>
$(function (){
	// 아이디 체크
	
	$("#reg_mb_id").keyup(function (){
		var mb_id = $(this).val();
		var reg_mb_id = $(this);

		// 아이디 정규표현식
		var regId = /^[a-z0-9]{4,12}$/;
		
		if (regId.test(mb_id)){ 
			$(this).parents(".row").find("i").css("color", "#1EC545");
			$(this).parents(".row").find("dd:last-child").html("");
		}else{
			$(this).parents(".row").find("i").css("color", "#BC0000");
			$(this).parents(".row").find("dd:last-child").css("color", "#BC0000").html("아이디는 영문과 숫자, 4 ~ 12자리까지 가능합니다.");
			
			return false;
		}
		
		// 아작스로 중복 아이디가 있는지 체크 1
		$.post(g5_bbs_url+"/ajax.mb_register.php", {"type":"mb_id", "val":mb_id}, function (result){
			if(result == "0"){  // ajax.mb_register.php 의 echo $row['cnt']; 값을 가져옴
				reg_mb_id.parents(".row").find("i").css("color", "#1EC545"); //될때 초록색 박스 i 는 icon 의 약자
				reg_mb_id.parents(".row").find("dd:last-child").html(""); // 마지막 dd 의 css 스타일 사용
			}else{
				reg_mb_id.parents(".row").find("i").css("color", "#BC0000");
				reg_mb_id.parents(".row").find("dd:last-child").css("color", "#BC0000").html("사용중인 아이디입니다.");
			}
		});
	});

	$("#reg_mb_password").keyup(function (){
		var mb_password = $(this).val();
		var reg_mb_password = $(this);

		// 바뀌면 무조건 틀렸다로 표시.
		if($("#reg_mb_password_re").val() != mb_password){
			$("#reg_mb_password_re").parents(".row").find("i").css("color", "#BC0000");
			$("#reg_mb_password_re").parents(".row").find("dd:last-child").css("color", "#BC0000").html("비밀번호가 다릅니다.");	
		}else{
			$("#reg_mb_password_re").parents(".row").find("i").css("color", "#1EC545");
			$("#reg_mb_password_re").parents(".row").find("dd:last-child").html("");
		}

		// 비밀번호 정규표현식
		var regPassword = /^.*(?=^.{8,15}$)(?=.*\d)(?=.*[a-zA-Z])(?=.*[!@#$%^&+=]).*$/;

		if (regPassword.test(mb_password)){ 
			$(this).parents(".row").find("i").css("color", "#1EC545");
			$(this).parents(".row").find("dd:last-child").html("");
		}else{
			$(this).parents(".row").find("i").css("color", "#BC0000");
			$(this).parents(".row").find("dd:last-child").css("color", "#BC0000").html("비밀번호는 8자~15자 영문,숫자,특수문자가 포함 되어야 합니다.");
		}
	});

	$("#reg_mb_password_re").keyup(function (){
		var mb_password_re = $(this).val();
		var mb_password = $("#reg_mb_password").val();

		// 비밀번호 정규표현식
		var regPassword = /^.*(?=^.{8,15}$)(?=.*\d)(?=.*[a-zA-Z])(?=.*[!@#$%^&+=]).*$/;

		if(mb_password == mb_password_re){
			$(this).parents(".row").find("i").css("color", "#1EC545");
			$(this).parents(".row").find("dd:last-child").html("");
		}else{
			$(this).parents(".row").find("i").css("color", "#BC0000");
			$(this).parents(".row").find("dd:last-child").css("color", "#BC0000").html("비밀번호가 다릅니다.");	
		}
	});


	$("#reg_mb_name").keyup(function (){
		var mb_name = $(this).val();
		var reg_mb_name = $(this);

		// 이름 정규표현식
		var regName = /^[가-힣]{2,4}|[a-zA-Z]{2,10}\s[a-zA-Z]{2,10}$/;

		if (regName.test(mb_name)){ 
			$(this).parents(".row").find("i").css("color", "#1EC545");
			$(this).parents(".row").find("dd:last-child").html("");
		}else{
			$(this).parents(".row").find("i").css("color", "#BC0000");
			$(this).parents(".row").find("dd:last-child").css("color", "#BC0000").html("2글자 이상 한글만 입력해주세요.");
		}
	});

	$("#reg_mb_hp").keyup(function (){
		var mb_hp = $(this).val();
		var reg_mb_hp = $(this);

		// 휴대폰 정규표현식
		// /^01([0|1|6|7|8|9]?)-?([0-9]{3,4})-?([0-9]{4})$/
		var regHp = /^\d{10,12}$/;

		if (regHp.test(mb_hp)){
			$(this).parents(".row").find("i").css("color", "#1EC545");
			$(this).parents(".row").find("dd:last-child").html("");
		}else{
			$(this).parents(".row").find("i").css("color", "#BC0000");
			$(this).parents(".row").find("dd:last-child").css("color", "#BC0000").html("휴대폰 번호는 10 ~ 12자리 숫자만 입력하세요.");
		}
	});

	$("#reg_mb_nick").keyup(function (){
		var mb_nick = $(this).val();
		var reg_mb_nick = $(this);

		// 닉네임 정규표현식
		var regNick = /^[\w\Wㄱ-ㅎㅏ-ㅣ가-힣]{2,20}$/;
		
		if (regNick.test(mb_nick)){ 
			$(this).parents(".row").find("i").css("color", "#1EC545");
			$(this).parents(".row").find("dd:last-child").html("");
		}else{
			$(this).parents(".row").find("i").css("color", "#BC0000");
			$(this).parents(".row").find("dd:last-child").css("color", "#BC0000").html("2글자 이상 입력해주세요.")		
			return false;
		}

		$.post(g5_bbs_url+"/ajax.mb_register.php", {"type2":"mb_nick", "val2":mb_nick}, function (result){
			if(result == "0"){  
				reg_mb_nick.parents(".row").find("i").css("color", "#1EC545"); 
				reg_mb_nick.parents(".row").find("dd:last-child").html("");
			}else{
				reg_mb_nick.parents(".row").find("i").css("color", "#BC0000");
				reg_mb_nick.parents(".row").find("dd:last-child").css("color", "#BC0000").html("사용중인 닉네임 입니다.");
			}
		});
	});
	
	$("#reg_mb_email").keyup(function (){
		var mb_email = $(this).val();
		var reg_mb_email = $(this);

		// 이메일 정규표현식
		var regEmail = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/;
		
		if (regEmail.test(mb_email)){ 
			$(this).parents(".row").find("i").css("color", "#1EC545");
			$(this).parents(".row").find("dd:last-child").html("");
		}else{
			$(this).parents(".row").find("i").css("color", "#BC0000");
			$(this).parents(".row").find("dd:last-child").css("color", "#BC0000").html("올바른 E-mail 형식으로 입력해주십시오.")		
			return false;
		}
	});
	
	$("#reg_mb_level").click(function (){
		var mb_level = $(this).val();
		var reg_mb_level = $(this);

		// 이메일 정규표현식
		var regEmail = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/;
		
		if (regEmail.test(mb_email)){ 
			$(this).parents(".row").find("i").css("color", "#1EC545");
			$(this).parents(".row").find("dd:last-child").html("");
		}else{
			$(this).parents(".row").find("i").css("color", "#BC0000");
			$(this).parents(".row").find("dd:last-child").css("color", "#BC0000").html("올바른 E-mail 형식으로 입력해주십시오.")		
			return false;
		}
	});
	
	// 라디오 버튼
	$("#dd_type p").click(function (){
		var v = $(this).data("val");
		$("#mb_type").val(v);
		$("#dd_type p").find("i").removeClass("fa-check-circle-o").addClass("fa-circle-o");
		$(this).find("i").removeClass("fa-circle-o").addClass("fa-check-circle-o");
	});

	// 내용보기 
	$(".btn-agr").click(function (){
		var dis = $(this).parents(".row").find("dd:last-child").css("display");
		if(dis == "none")
			$(this).parents(".row").find("dd:last-child").slideDown(100);
		else
			$(this).parents(".row").find("dd:last-child").slideUp(100);
	});
	// 약관동의
	
	$(".agree-row dd:first-child").click(function (){
		var ford = $(this).data("for");
		var targ = $("#" + ford);
		
		if(targ.val() == "1"){
			targ.val("");
			$(this).find("i").removeClass("fa-check-square").addClass("fa-square-o");
		}else{
			targ.val("1");
			$(this).find("i").removeClass("fa-square-o").addClass("fa-check-square");
		}
	});
});

function only_number(num){
	num = num + "";
	num = num.replace(/[^0-9]/gi, "");
	return num;
}

// submit 최종 폼체크
function fregisterform_submit(f)
{
	// 필수 체크박스
	// 조건들 확인
	
	// 회원아이디 검사
	if (f.w.value == "") {
		var msg = reg_mb_id_check();
		if (msg) {
			alert(msg);
			f.mb_id.select();
			return false;
		}
	}

	if (f.w.value == '') {
		if (f.mb_password.value.length < 3) {
			alert('비밀번호를 3글자 이상 입력하십시오.');
			f.mb_password.focus();
			return false;
		}
	}

	if (f.mb_password.value != f.mb_password_re.value) {
		alert('비밀번호가 같지 않습니다.');
		f.mb_password_re.focus();
		return false;
	}

	if (f.mb_password.value.length > 0) {
		if (f.mb_password_re.value.length < 3) {
			alert('비밀번호를 3글자 이상 입력하십시오.');
			f.mb_password_re.focus();
			return false;
		}
	}

	// 이름 검사
	if (f.w.value=='') {
		if (f.mb_name.value.length < 1) {
			alert('이름을 입력하십시오.');
			f.mb_name.focus();
			return false;
		}
	}

	// 닉네임 검사
	if ((f.w.value == "") || (f.w.value == "u" && f.mb_nick.defaultValue != f.mb_nick.value)) {
		var msg = reg_mb_nick_check();
		if (msg) {
			alert(msg);
			f.reg_mb_nick.select();
			return false;
		}
	}

	// E-mail 검사
	if ((f.w.value == "") || (f.w.value == "u" && f.mb_email.defaultValue != f.mb_email.value)) {
		var msg = reg_mb_email_check();
		if (msg) {
			alert(msg);
			f.reg_mb_email.select();
			return false;
		}
	}
	<?php if($w == ""){ ?>
	if($("#reg_req1").val()!="1"){
		alert("이용약관 동의(필수)를 체크하십시오");
		return false;
	}
	if($("#reg_req2").val()!="1"){
		alert("개인정보처리방침 동의(필수)를 체크하십시오");
		return false;
	}
	return true;
	<?php } ?>
}
</script>