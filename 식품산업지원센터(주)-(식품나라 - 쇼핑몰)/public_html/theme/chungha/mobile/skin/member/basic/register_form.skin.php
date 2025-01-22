<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>

<!-- 회원정보 입력/수정 시작 { -->
<div class="mbskin">

    <script src="<?php echo G5_JS_URL ?>/jquery.register_form.js"></script>
    <?php if($config['cf_cert_use'] && ($config['cf_cert_ipin'] || $config['cf_cert_hp'])) { ?>
    <script src="<?php echo G5_JS_URL ?>/certify.js"></script>
    <?php } ?>

    <form id="fregisterform" name="fregisterform" action="<?php echo $register_action_url ?>" onsubmit="return fregisterform_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
    <input type="hidden" name="w" value="<?php echo $w ?>">
    <input type="hidden" name="url" value="<?php echo $urlencode ?>">
    <input type="hidden" name="agree" value="<?php echo $agree ?>">
    <input type="hidden" name="agree2" value="<?php echo $agree2 ?>">
    <input type="hidden" name="cert_type" value="<?php echo $member['mb_certify']; ?>">
    <input type="hidden" name="cert_no" value="">
    <?php if (isset($member['mb_sex'])) {  ?><input type="hidden" name="mb_sex" value="<?php echo $member['mb_sex'] ?>"><?php }  ?>
    <?php if (isset($member['mb_nick_date']) && $member['mb_nick_date'] > date("Y-m-d", G5_SERVER_TIME - ($config['cf_nick_modify'] * 86400))) { // 닉네임수정일이 지나지 않았다면  ?>
    <input type="hidden" name="mb_nick_default" value="<?php echo get_text($member['mb_nick']) ?>">
    <input type="hidden" name="mb_nick" value="<?php echo get_text($member['mb_nick']) ?>">
    <?php }  ?>

		<div class="resBox box-article">
			<div class="logBoxT">
				<!-- <p class="tit">PLAYRUN</p> -->
				<p class="stit"><strong><?php echo $config['cf_title']; ?></strong>에 오신 것을 환영합니다.</p>
			</div>
			<div id="join_info" class="v1">
				<h2><?php if($w == ""){ ?>회원정보 입력<? }else { ?>회원정보 확인 및 수정<?php } ?> <p><span style="color:#fb2323;">*</span> 필수입력</p></h2>
				<div class="box-body">
					<dl class="row">
						<dd class="col-xs-1 req">*</dd>
						<dd class="col-xs-11">
							<label for="reg_mb_id" class="sound_only">아이디</label>
							<input type="text" name="mb_id" value="<?php echo $member['mb_id'] ?>" id="reg_mb_id" class="regist-input <?php echo $required ?> <?php if($w=="u") echo "readonly";?>" minlength="3" maxlength="20" <?php echo $required ?> placeholder="아이디" <?php if($w=="u") echo "readonly";?>>
						</dd>
						<dd class="status_ico <?=$pas?>"><i class="fas fa-check"></i></dd>
						<dd class="error col-xs-12"></dd>
					</dl>

					<dl class="row">
						<dd class="col-xs-1 req">*</dd>
						<dd class="col-xs-11">
							<label for="reg_mb_password"  class="sound_only">비밀번호</label>
							<input type="password" name="mb_password" id="reg_mb_password" class="regist-input <?php echo $required ?>" minlength="4" maxlength="20" <?php echo $required ?> placeholder="비밀번호">
						</dd>
						<dd class="status_ico lock_ico1"><i class="fas fa-lock-open"></i></dd>
						<dd class="error col-xs-12"></dd>
					</dl>

					<dl class="row">
						<dd class="col-xs-1 req">*</dd>
						<dd class="col-xs-11">
							<label for="mb_password_re"  class="sound_only">비밀번호확인</label>
							<input type="password" name="mb_password_re" id="reg_mb_password_re" class="regist-input <?php echo $required ?>" minlength="4" maxlength="20" <?php echo $required ?> placeholder="비밀번호확인">
						</dd>
						<dd class="status_ico lock_ico2"><i class="fas fa-lock"></i></dd>
						<dd class="error col-xs-12"></dd>
					</dl>

					<dl class="row">
						<dd class="col-xs-1 req">*</dd>
						<dd class="col-xs-11">
							<label for="reg_mb_name"  class="sound_only">이름</label>
							<input type="text" name="mb_name" value="<?php echo $member['mb_name'] ?>" id="reg_mb_name" class="regist-input required f_empty" required placeholder="이름">
						</dd>
						<dd class="status_ico <?=$pas?>"><i class="fas fa-check"></i></dd>
						<dd class="error col-xs-12"></dd>
					</dl>

					<dl class="row">
						<dd class="col-xs-1 req">*</dd>
						<dd class="col-xs-11">
							<label for="reg_mb_hp"  class="sound_only">휴대번호</label>
							<input type="tel" name="mb_hp" value="<?php echo $member['mb_hp'] ?>" id="reg_mb_hp" class="regist-input required" required placeholder="휴대번호" style="font-size:0.95em;" minlength="10" maxlength="13">
						</dd>
						<dd class="status_ico <?=$pas?>"><i class="fas fa-check"></i></dd>
						<dd class="error col-xs-12"></dd>
					</dl>

					<dl class="row">
						<dd class="col-xs-1 req">*</dd>
						<dd class="col-xs-11">
							<label for="reg_mb_email"  class="sound_only">E-mail</label>
							<input type="text" name="mb_email" id="reg_mb_email" class="regist-input required f_empty" minlength="3" maxlength="50" required placeholder="E-mail" value="<?php echo $member['mb_email']; ?>">
						</dd>
						<dd class="status_ico <?=$pas?>"><i class="fas fa-check"></i></dd>
						<dd class="error col-xs-12"></dd>
					</dl>

                    <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
					<?php //if ($config['cf_use_addr']) { ?>
					<dl class="row adrBox">
						<dd class="col-xs-1 req">*</dd>
						<dd class="col-xs-11">


							<input type="text" name="mb_zip" value="<?php echo $member['mb_zip1'].$member['mb_zip2']; ?>" id="reg_mb_zip" <?php echo $config['cf_req_addr']?"required":""; ?> class="required f_empty" size="5" maxlength="6" placeholder="우편번호">
							<button class="newBtn smallB " type="button" onclick="win_zip('fregisterform', 'mb_zip', 'mb_addr1', 'mb_addr2', 'mb_addr3', 'mb_addr_jibeon');">주소검색</button>
							
							<input type="text" name="mb_addr1" value="<?php echo get_text($member['mb_addr1']) ?>" id="reg_mb_addr1" <?php echo $config['cf_req_addr']?"required":""; ?> class="required f_empty" size="50" placeholder="기본주소">
							<input type="text" name="mb_addr2" value="<?php echo get_text($member['mb_addr2']) ?>" id="reg_mb_addr2" class="required f_empty" size="50" placeholder="상세주소">
							
							<br>
							<!--<input type="hidden" name="mb_addr3" value="--><?php //echo get_text($member['mb_addr3']) ?><!--" id="reg_mb_addr3" class="required f_empty" size="50" readonly="readonly">-->
							
							<input type="hidden" name="mb_addr_jibeon" value="<?php echo get_text($member['mb_addr_jibeon']); ?>">
							<!--
							<label for="reg_mb_addr"  class="sound_only">주소</label>
							<input type="text" name="mb_addr" id="reg_mb_addr" class="regist-input required f_empty" minlength="3" maxlength="50" required placeholder="주소" value="<?php echo $member['mb_addr']; ?>"><button class="addr_sch">주소검색</button>
                            <input type="text" name="mb_addr2" id="reg_mb_addr2" class="regist-input required f_empty" minlength="3" maxlength="50" required placeholder="상세주소" value="<?php echo $member['mb_addr2']; ?>" style="border-top:1px solid #eee;">-->
						</dd>
						<dd class="status_ico <?=$pas?>"><i class="fas fa-check"></i></dd>
						<dd class="error col-xs-12"></dd>
					</dl>
					<?php //}?>
                    
                    
                    
                    
                    
				</div>
					
			</div><!--//join_info-->

        <?php if($w == ""){ ?>

			<div id="join_agr">
				<h2>약관동의</h2>
				<div class="box-body">
					<dl class="row agree-row">
						<dd class="col-xs-8 chk_ico" data-for="reg_req1">
							<input type="checkbox" name="reg_req[]" id="reg_req1" value="0" onclick="ag_check(this)" class="sound_only">
							<label for="reg_req1">이용약관 동의 (필수)</label>
							<!-- <i></i> 이용약관 동의 (필수) -->
						</dd>
						<dd class="col-xs-4 text-right"><input type="button" value="내용보기" class="btn btn-agr"></dd>
						<dd class="col-xs-12 agr_textarea" style="display:none"><textarea readonly><?php echo get_text($config['cf_stipulation']) ?></textarea></dd>
					</dl>

					<dl class="row agree-row">
						<dd class="col-xs-8 chk_ico" data-for="reg_req2">
							<input type="checkbox" name="reg_req[]" id="reg_req2" value="0" onclick="ag_check(this)"  class="sound_only">
							<label for="reg_req2">개인정보처리방침 동의 (필수)</label>
							<!--<i></i> 개인정보처리방침 동의 (필수) -->
						</dd>
						<dd class="col-xs-4 text-right"><input type="button" value="내용보기" class="btn btn-agr"></dd>
						<dd class="col-xs-12 agr_textarea"  style="display:none"><textarea readonly><?php echo get_text($config['cf_privacy']) ?></textarea></dd>
					</dl>
				</div>

            <?php } ?>
				<!-- device 아이디 값 가져오기 -->
				<input type="hidden" name="uuid" id="uuid" value="">
				<div class="btn_confirm">
					<input type="submit" value="<?php echo $w==''?'회원가입':'정보수정'; ?>" id="btn_submit" class="newBtn bgT" accesskey="s">
					<a href="<?php echo G5_URL ?>" class="newBtn">취소</a>
				</div>

			</div><!--//join_agr -->
		</div>
		<!-- /resBox -->
		<span class="bgType"></span>
	</form>

	<script>
    //숫자및 하이픈
    $(function () {
        $('#reg_mb_hp').keydown(function (event) {
            var key = event.charCode || event.keyCode || 0;
            $text = $(this);
            if (key !== 8 && key !== 9) {
                if ($text.val().length === 3) {
                    $text.val($text.val() + '-');
                }
                if ($text.val().length === 8) {
                    $text.val($text.val() + '-');
                }
            }

            return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
            // Key 8번 백스페이스, Key 9번 탭, Key 46번 Delete 부터 0 ~ 9까지, Key 96 ~ 105까지 넘버패트
            // 한마디로 JQuery 0 ~~~ 9 숫자 백스페이스, 탭, Delete 키 넘버패드외에는 입력못함
        })
    });
    
    function ag_check(obj){
        if(obj.value == "0"){
            obj.value = "1";
        }else{
            obj.value = "0";
        }
    }
		// 내용보기
	$(".btn-agr").click(function (){
		var dis = $(this).parents(".row").find(".agr_textarea").css("display");
		if(dis == "none")
			$(this).parents(".row").find(".agr_textarea").slideDown(100);
		else
			$(this).parents(".row").find(".agr_textarea").slideUp(100);
	});
    <?php if($w == ""){ ?>
        // 아이디 체크
        $("#reg_mb_id").keyup(function (){
            var mb_id = $(this).val();
            var reg_mb_id = $(this);

            // 아이디 정규표현식
            var regId = /^[a-z0-9.@_]{3,20}$/;

            if (regId.test(mb_id)){
                $(this).parents(".row").find(".status_ico").removeClass("err").addClass("pas");
                $(this).parents(".row").find(".error").html("");
            }else{
                $(this).parents(".row").find(".status_ico").removeClass("pas").addClass("err");
                $(this).parents(".row").find(".error").addClass("on").html("아이디는 영문과 숫자, 3 ~ 20자리까지 가능합니다.");

                return false;
            }

            // 아작스로 중복 아이디가 있는지 체크 1
            $.post(g5_bbs_url+"/ajax.mb_id.php", {"reg_mb_id":mb_id}, function (result){
                if(result == ""){  // ajax.mb_id.php 의 die($msg); 값을 가져옴
                    reg_mb_id.parents(".row").find(".status_ico").removeClass("err").addClass("pas"); //될때 초록색 박스 i 는 icon 의 약자
                    reg_mb_id.parents(".row").find(".error").html(""); // 마지막 dd 의 css 스타일 사용
                }else{
                    reg_mb_id.parents(".row").find(".status_ico").removeClass("pas").addClass("err");
                    reg_mb_id.parents(".row").find(".error").addClass("on").html(result);
                }
            });
        });
    <?php } ?>

        $("#reg_mb_password").keyup(function (){
            var mb_password = $(this).val();
            var reg_mb_password = $(this);

            // 바뀌면 무조건 틀렸다로 표시.
            if($("#reg_mb_password_re").val() != mb_password){
                $("#reg_mb_password_re").parents(".row").find(".status_ico").removeClass("pas").addClass("err");
                $("#reg_mb_password_re").parents(".row").find(".error").addClass("on").html("비밀번호가 다릅니다.");
            }else{
                $("#reg_mb_password_re").parents(".row").find(".status_ico").removeClass("err").addClass("pas");
                $("#reg_mb_password_re").parents(".row").find(".error").html("");
            }

            // 비밀번호 정규표현식
            // var regPassword = /^.*(?=^.{8,15}$)(?=.*\d)(?=.*[a-zA-Z])(?=.*[!@#$%^&+=]).*$/;

            if (mb_password.length >= 4){
                $(this).parents(".row").find(".status_ico").removeClass("err").addClass("pas");
                $(this).parents(".row").find(".error").html("");
            }else{
                $(this).parents(".row").find(".status_ico").removeClass("pas").addClass("err");
                $(this).parents(".row").find(".error").addClass("on").html("비밀번호는 4글자 이상입니다.");
            }
        });

        $("#reg_mb_password_re").keyup(function (){
            var mb_password_re = $(this).val();
            var mb_password = $("#reg_mb_password").val();

            // 비밀번호 정규표현식
            var regPassword = /^.*(?=^.{8,15}$)(?=.*\d)(?=.*[a-zA-Z])(?=.*[!@#$%^&+=]).*$/;

            if(mb_password == mb_password_re){
                $(this).parents(".row").find(".status_ico").removeClass("err").addClass("pas");
                $(this).parents(".row").find(".error").html("");
            }else{
                $(this).parents(".row").find(".status_ico").removeClass("pas").addClass("err");
                $(this).parents(".row").find(".error").addClass("on").html("비밀번호가 다릅니다.");
            }
        });


        $("#reg_mb_name").keyup(function (){
            var mb_name = $(this).val();
            var reg_mb_name = $(this);

            // 이름 정규표현식
            var regName = /^[가-힣]{2,4}|[a-zA-Z]{2,10}\s[a-zA-Z]{2,10}$/;

            if (regName.test(mb_name)){
                $(this).parents(".row").find(".status_ico").removeClass("err").addClass("pas");
                $(this).parents(".row").find(".error").html("");
            }else{
                $(this).parents(".row").find(".status_ico").removeClass("pas").addClass("err");
                $(this).parents(".row").find(".error").addClass("on").html("2글자 이상 한글만 입력해주세요.");
            }
        });

        $("#reg_mb_hp").keyup(function (){
            var mb_hp = $(this).val();
            var reg_mb_hp = $(this);

            // 휴대폰 정규표현식
            // /^01([0|1|6|7|8|9]?)-?([0-9]{3,4})-?([0-9]{4})$/
            //var regHp = /^\d{10,12}$/;
            var regHp = /^([0-9]{3,4})-?([0-9]{3,4})-?([0-9]{4})$/;

            if (regHp.test(mb_hp)){
                $(this).parents(".row").find(".status_ico").removeClass("err").addClass("pas");
                $(this).parents(".row").find(".error").html("");
            }else{
                $(this).parents(".row").find(".status_ico").removeClass("pas").addClass("err");
                $(this).parents(".row").find(".error").addClass("on").html("휴대폰 번호는 10 ~ 12자리 숫자만 입력하세요.");
            }
        });

        $("#reg_mb_email").keyup(function (){
            var mb_email = $(this).val();
            var reg_mb_email = $(this);

            // 이메일 정규표현식
            var regEmail = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/;

            if (regEmail.test(mb_email)){
                $(this).parents(".row").find(".status_ico").removeClass("err").addClass("pas");
                $(this).parents(".row").find(".error").html("");
            }else{
                $(this).parents(".row").find(".status_ico").removeClass("pas").addClass("err");
                $(this).parents(".row").find(".error").addClass("on").html("올바른 E-mail 형식으로 입력해주십시오.")
                return false;
            }
        });

        $("#reg_mb_level").click(function (){
            var mb_level = $(this).val();
            var reg_mb_level = $(this);

            // 이메일 정규표현식

            var regEmail = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/;

            if (regEmail.test(mb_email)){
                $(this).parents(".row").find(".status_ico").removeClass("err").addClass("pas");
                $(this).parents(".row").find(".error").html("");
            }else{
                $(this).parents(".row").find(".status_ico").removeClass("pas").addClass("err");
                $(this).parents(".row").find(".error").addClass("on").html("올바른 E-mail 형식으로 입력해주십시오.")
                return false;
            }
        });

        // submit 최종 폼체크
        function fregisterform_submit(f){
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

            if($('#reg_mb_id').parents(".row").find(".status_ico").hasClass("err")) {
                alert('아이디를 확인하세요.');
                $('#reg_mb_id').focus();
                return false;
            }
            if($('#reg_mb_password_re').parents(".row").find(".status_ico").hasClass("err")) {
                alert('비밀번호를 확인하세요.');
                $('#reg_mb_password_re').focus();
                return false;
            }
            if($('#reg_mb_name').parents(".row").find(".status_ico").hasClass("err")) {
                alert('이름을 확인하세요.');
                $('#reg_mb_name').focus();
                return false;
            }
            if($('#reg_mb_hp').parents(".row").find(".status_ico").hasClass("err")) {
                alert('휴대번호를 확인하세요.');
                $('#reg_mb_hp').focus();
                return false;
            }
            if($('#reg_mb_email').parents(".row").find(".status_ico").hasClass("err")) {
                alert('이메일을 확인하세요.');
                $('#reg_mb_email').focus();
                return false;
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
            <?php } ?>

            return true;
        }
		//디바이스 아이디 세팅
		function setDeviceId(uuid){
			$("#uuid").val(uuid);
		}
    </script>

</div>
<!-- } 회원정보 입력/수정 끝 -->