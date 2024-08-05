<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>


<style>
    #hd{
        display: none;
    }
	#join_info{
		text-align: left;
	}
    .sound_only{
        position: relative;
        top: 0;
        left: 0;
        width: auto;
        height: auto;
        font-size: 15px;
        font-weight: 500;
        color: #666;
        overflow: visible !important;
        visibility: inherit;
        margin: 0 0 10px !important;
        display: block !important;
        line-height: 1em !important;
    }
</style>
<!-- 회원정보 입력/수정 시작 { -->
<div class="mbskin">

    <script src="<?php echo G5_JS_URL ?>/jquery.register_form.js?ver=2"></script>
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
<!--
			<h6 class="logBoxT">
				<p class="tit">부산시중앙신협 MEMBERS</p>
				<p class="stit">부산시 중앙신협만의 특별한 MEMBERS에 오신것을 환영합니다.</p>
			</h6>
-->
			<div id="join_info" class="v1">
				<h2><?php if($w == ""){ ?>회원정보 입력<? }else { ?>회원정보 확인 및 수정<?php } ?> 
<!--				<p><span style="color:#fb2323;">*</span> 필수입력</p>-->
				</h2>
				<div class="box-body">
					<dl class="row_wrap">
						<dd class="">
							<label for="reg_mb_id" class="sound_only">아이디</label>
							<input type="text" name="mb_id" value="<?php echo $member['mb_id'] ?>" id="reg_mb_id" class="regist-input <?php echo $required ?> <?php if($w=="u") echo "readonly";?>" minlength="3" maxlength="20" <?php echo $required ?> placeholder="아이디를 입력하세요" <?php if($w=="u") echo "readonly";?>>
						</dd>
						<dd class="error status_ico">아이디를 입력하세요</dd>
					</dl>

					<dl class="row_wrap">
						<dd class="">
							<label for="reg_mb_password"  class="sound_only">비밀번호</label>
							<input type="password" name="mb_password" id="reg_mb_password" class="regist-input <?php echo $required ?>" minlength="4" maxlength="20" <?php echo $required ?> placeholder="비밀번호를 입력하세요">
						</dd>
						<dd class="error status_ico"></dd>
					</dl>

					<dl class="row_wrap">
						<dd class="">
							<label for="mb_password_re"  class="sound_only">비밀번호확인</label>
							<input type="password" name="mb_password_re" id="reg_mb_password_re" class="regist-input <?php echo $required ?>" minlength="4" maxlength="20" <?php echo $required ?> placeholder="비밀번호 한번더 입력하세요">
						</dd>
						<dd class="error status_ico"></dd>
					</dl>

					<dl class="row_wrap">
						<dd class="">
							<label for="reg_mb_name"  class="sound_only">이름</label>
							<input type="text" name="mb_name" value="<?php echo $member['mb_name'] ?>" id="reg_mb_name" class="regist-input required f_empty" required placeholder="이름을 입력하세요">
						</dd>
						<dd class="error status_ico"></dd>
					</dl>

					<? if($is_apple == false) { ?>
						<dl class="row_wrap birth_wrap">
							<dd class="">
								<div>
								<label for="reg_mb_birth"  class="sound_only">생년월일</label>
								<select name="mb_year">
									<?
									//1940~현재년도까지
									foreach(range(date('Y'), 1930) as $val) echo '<option value="'.$val.'">'.$val.'</option>';

									?>
								</select>
								</div>
								<div>
								<label>년</label>
								<select name="mb_month">
									<?
									//1월부터 12월까지
									foreach(range(1, 12) as $val) echo '<option value="'.sprintf('%02d' , $val).'">'.sprintf('%02d' , $val).'</option>';

									?>
								</select>
								</div>
								<div>
								<label>월</label>
								<select name="mb_day">
									<?
									//1일부터 31일까지
									foreach(range(1, 31) as $val) echo '<option value="'.sprintf('%02d' , $val).'">'.sprintf('%02d' , $val).'</option>';

									?>
								</select>
								</div>
							</dd>
							<dd class="error status_ico"></dd>
						</dl>
					<?}?>
					<? if($is_apple == false) { ?>
					<dl class="row_wrap">
						<dd class="">
							<label for="reg_mb_sex"  class="sound_only">성별</label>
							<select name="mb_sex" id="reg_mb_sex" class="regist-input required">
							    <option value="남자">남자</option>
							    <option value="여자">여자</option>
							</select>
						</dd>
						<dd class="error status_ico"></dd>
					</dl>
					<?}?>

                    <dl class="row_wrap">
                        <dd class="contact_wrap">
                            <label for="reg_mb_hp">휴대번호</label>
                            <input type="tel" name="mb_hp" value="<?php echo preg_replace("/[^0-9]*/s", "", $member['mb_hp']); ?>" id="reg_mb_hp" class="regist-input <?php echo $required ?>" <?php if($is_member && $member['mb_level'] == 2) echo "readonly";?> placeholder="휴대번호" minlength="10" maxlength="13" >
                            <?php if(!$is_member){ ?>
                                <button type="button" class="certi btn_certi" onclick="register_sms()">인증</button>
                            <?php } ?>
                        </dd>
                        <dd class="error status_ico"></dd>
                    </dl>
                    <?php if(!$is_member){ ?>

                        <dl class="row_wrap">
                            <dd class="contact_wrap">
                                <input type="number" value="" id="reg_mb_chk" class="regist-input <?php echo $required ?>" placeholder="인증번호" minlength="10" maxlength="13" >
                                <button class="certi btn_certi" type="button" onclick="sms_number_chk()">인증확인</button>
                            </dd>
                            <dd class="error status_ico"></dd>
                        </dl>

                    <?php } ?>
				</div>
					
			</div><!--//join_info-->

				<!-- device 아이디 값 가져오기 -->
				<input type="hidden" name="uuid" id="uuid" value="">

			</div><!--//join_agr -->
				<div class="btn_confirm">
					<input type="submit" value="<?php echo $w==''?'회원가입':'정보수정'; ?>" id="btn_submit" class="btn_submit" accesskey="s">
					<a href="<?php echo G5_URL ?>" class="btn_cancel">취소</a>
				</div>
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
		var dis = $(this).parents(".row_wrap").find(".agr_textarea").css("display");
		if(dis == "none")
			$(this).parents(".row_wrap").find(".agr_textarea").slideDown(100);
		else
			$(this).parents(".row_wrap").find(".agr_textarea").slideUp(100);
	});
    <?php if($w == ""){ ?>
        // 아이디 체크
        $("#reg_mb_id").keyup(function (){
            var mb_id = $(this).val();
            var reg_mb_id = $(this);

            // 아이디 정규표현식
            var regId = /^[a-z0-9.@_]{3,20}$/;

            if (regId.test(mb_id)){
                $(this).parents(".row_wrap").find(".status_ico").removeClass("err").addClass("pas");
                $(this).parents(".row_wrap").find(".error").html("");
            }else{
                $(this).parents(".row_wrap").find(".status_ico").removeClass("pas").addClass("err");
                $(this).parents(".row_wrap").find(".error").addClass("on").html("아이디는 영문과 숫자, 3 ~ 20자리까지 가능합니다.");

                return false;
            }

            // 아작스로 중복 아이디가 있는지 체크 1
            $.post(g5_bbs_url+"/ajax.mb_id.php", {"reg_mb_id":mb_id}, function (result){
                if(result == ""){  // ajax.mb_id.php 의 die($msg); 값을 가져옴
                    reg_mb_id.parents(".row_wrap").find(".status_ico").removeClass("err").addClass("pas"); //될때 초록색 박스 i 는 icon 의 약자
                    reg_mb_id.parents(".row_wrap").find(".error").html(""); // 마지막 dd 의 css 스타일 사용
                }else{
                    reg_mb_id.parents(".row_wrap").find(".status_ico").removeClass("pas").addClass("err");
                    reg_mb_id.parents(".row_wrap").find(".error").addClass("on").html(result);
                }
            });
        });
    <?php } ?>

        $("#reg_mb_password").keyup(function (){
            var mb_password = $(this).val();
            var reg_mb_password = $(this);

            // 바뀌면 무조건 틀렸다로 표시.
            if($("#reg_mb_password_re").val() != mb_password){
                $("#reg_mb_password_re").parents(".row_wrap").find(".status_ico").removeClass("pas").addClass("err");
                $("#reg_mb_password_re").parents(".row_wrap").find(".error").addClass("on").html("비밀번호가 다릅니다.");
            }else{
                $("#reg_mb_password_re").parents(".row_wrap").find(".status_ico").removeClass("err").addClass("pas");
                $("#reg_mb_password_re").parents(".row_wrap").find(".error").html("");
            }

            // 비밀번호 정규표현식
            // var regPassword = /^.*(?=^.{8,15}$)(?=.*\d)(?=.*[a-zA-Z])(?=.*[!@#$%^&+=]).*$/;

            if (mb_password.length >= 4){
                $(this).parents(".row_wrap").find(".status_ico").removeClass("err").addClass("pas");
                $(this).parents(".row_wrap").find(".error").html("");
            }else{
                $(this).parents(".row_wrap").find(".status_ico").removeClass("pas").addClass("err");
                $(this).parents(".row_wrap").find(".error").addClass("on").html("비밀번호는 4글자 이상입니다.");
            }
        });

        $("#reg_mb_password_re").keyup(function (){
            var mb_password_re = $(this).val();
            var mb_password = $("#reg_mb_password").val();

            // 비밀번호 정규표현식
            var regPassword = /^.*(?=^.{8,15}$)(?=.*\d)(?=.*[a-zA-Z])(?=.*[!@#$%^&+=]).*$/;

            if(mb_password == mb_password_re){
                $(this).parents(".row_wrap").find(".status_ico").removeClass("err").addClass("pas");
                $(this).parents(".row_wrap").find(".error").html("");
            }else{
                $(this).parents(".row_wrap").find(".status_ico").removeClass("pas").addClass("err");
                $(this).parents(".row_wrap").find(".error").addClass("on").html("비밀번호가 다릅니다.");
            }
        });


        $("#reg_mb_name").keyup(function (){
            var mb_name = $(this).val();
            var reg_mb_name = $(this);

            // 이름 정규표현식
            var regName = /^[가-힣]{2,4}|[a-zA-Z]{2,10}\s[a-zA-Z]{2,10}$/;

            if (regName.test(mb_name)){
                $(this).parents(".row_wrap").find(".status_ico").removeClass("err").addClass("pas");
                $(this).parents(".row_wrap").find(".error").html("");
            }else{
                $(this).parents(".row_wrap").find(".status_ico").removeClass("pas").addClass("err");
                $(this).parents(".row_wrap").find(".error").addClass("on").html("2글자 이상 한글만 입력해주세요.");
            }
        });

        $("#reg_mb_hp").keyup(function (){
            var mb_hp = $(this).val();
            var reg_mb_hp = $(this);

            // 휴대폰 정규표현식
            // /^01([0|1|6|7|8|9]?)-?([0-9]{3,4})-?([0-9]{4})$/
            //var regHp = /^\d{10,12}$/;
            var regHp = /^([0-9]{3,4})-?([0-9]{3,4})-?([0-9]{4})$/;
            var msg = reg_mb_hp_check();

            if (msg != "" || !regHp.test(mb_hp)){
                $(this).parents(".row_wrap").find(".status_ico").removeClass("pas").addClass("err");
                $(this).parents(".row_wrap").find(".error").addClass("on").html(msg);
            }else{
                $(this).parents(".row_wrap").find(".status_ico").removeClass("err").addClass("pas");
                $(this).parents(".row_wrap").find(".error").html("");

            }


        });

        $("#reg_mb_email").keyup(function (){
            var mb_email = $(this).val();
            var reg_mb_email = $(this);

            // 이메일 정규표현식
            var regEmail = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/;

            if (regEmail.test(mb_email)){
                $(this).parents(".row_wrap").find(".status_ico").removeClass("err").addClass("pas");
                $(this).parents(".row_wrap").find(".error").html("");
            }else{
                $(this).parents(".row_wrap").find(".status_ico").removeClass("pas").addClass("err");
                $(this).parents(".row_wrap").find(".error").addClass("on").html("올바른 E-mail 형식으로 입력해주십시오.")
                return false;
            }
        });

        $("#reg_mb_level").click(function (){
            var mb_level = $(this).val();
            var reg_mb_level = $(this);

            // 이메일 정규표현식

            var regEmail = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/;

            if (regEmail.test(mb_email)){
                $(this).parents(".row_wrap").find(".status_ico").removeClass("err").addClass("pas");
                $(this).parents(".row_wrap").find(".error").html("");
            }else{
                $(this).parents(".row_wrap").find(".status_ico").removeClass("pas").addClass("err");
                $(this).parents(".row_wrap").find(".error").addClass("on").html("올바른 E-mail 형식으로 입력해주십시오.")
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
                    swal(msg);
                    f.mb_id.select();
                    return false;
                }
            }

            if (f.w.value == '') {
                if (f.mb_password.value.length < 3) {
                    swal('비밀번호를 3글자 이상 입력하십시오.');
                    f.mb_password.focus();
                    return false;
                }
            }

            if (f.mb_password.value != f.mb_password_re.value) {
                swal('비밀번호가 같지 않습니다.');
                f.mb_password_re.focus();
                return false;
            }

            if (f.mb_password.value.length > 0) {
                if (f.mb_password_re.value.length < 3) {
                    swal('비밀번호를 3글자 이상 입력하십시오.');
                    f.mb_password_re.focus();
                    return false;
                }
            }

            // 이름 검사
            if (f.w.value=='') {
                if (f.mb_name.value.length < 1) {
                    swal('이름을 입력하십시오.');
                    f.mb_name.focus();
                    return false;
                }
            }

            if($('#reg_mb_id').parents(".row_wrap").find(".status_ico").hasClass("err")) {
                swal('아이디를 확인하세요.');
                $('#reg_mb_id').focus();
                return false;
            }
            if($('#reg_mb_password_re').parents(".row_wrap").find(".status_ico").hasClass("err")) {
                swal('비밀번호를 확인하세요.');
                $('#reg_mb_password_re').focus();
                return false;
            }
            if($('#reg_mb_name').parents(".row_wrap").find(".status_ico").hasClass("err")) {
                swal('이름을 확인하세요.');
                $('#reg_mb_name').focus();
                return false;
            }
            if($('#reg_mb_hp').parents(".row_wrap").find(".status_ico").hasClass("err")) {
                swal('휴대번호를 확인하세요.');
                $('#reg_mb_hp').focus();
                return false;
            }
            if($('#reg_mb_email').parents(".row_wrap").find(".status_ico").hasClass("err")) {
                swal('이메일을 확인하세요.');
                $('#reg_mb_email').focus();
                return false;
            }

            <?php if($w == ""){ ?>

                if (final_sms){
                    swal("핸드폰 인증을 해주세요");
                    return false;
                }

            <?php } ?>

            return true;
        }
		//디바이스 아이디 세팅
		function setDeviceId(uuid){
			$("#uuid").val(uuid);
		}


    /*************휴대폰 인증*******************/
    var req_sms = true;
    var final_sms = true;
    function register_sms(){

        if($("#reg_mb_name").val().length<1 ){
            swal("이름을 입력하세요");
            return false;
        }

        if($("#reg_mb_hp").val().length<1 ){
            swal("휴대폰 번호를 입력하세요");
            return false;
        }

        $.ajax({
            type: "POST",
            url: g5_bbs_url+"/ajax.sms_register.php",
            data: {
                "mb_name": $("#reg_mb_name").val(),
                "level": $("#mb_level").val(),
                "mb_hp": $("#reg_mb_hp").val(),
                "mode" : "sms_send",
                "type" : "id"
            },
            dataType: "json",
            success: function(data) {


                if (data['msg'] != 'sms_ok'){
                    swal(data['swal_msg']);
                    req_sms = true;
                }else{
                    swal(data['swal_msg']).then(function(){
                        req_sms = false;
                        $("#reg_mb_name").attr("readonly",true);
                        $("#reg_mb_hp").attr("readonly",true);
                    });
                }


            }
        });
    }

    function sms_number_chk(){

        if (req_sms){
            swal("인증을 먼저 진행해주세요.");
            return false;
        }

        $.ajax({
            type: "POST",
            url: g5_bbs_url+"/ajax.sms_register.php",
            data: {
                "mb_name": $("#reg_mb_name").val(),
                "level": $("#mb_level").val(),
                "mb_hp": $("#reg_mb_hp").val(),
                "number": $("#reg_mb_chk").val(),
                "mode" : "sms_number_chk",
            },
            dataType: "json",
            success: function(data) {


                if (data['msg'] != 'ok'){
                    swal(data['swal_msg']);
                    final_sms = true;

                }else{
                    swal(data['swal_msg']).then(function(){
                        final_sms = false;
                        $("#reg_mb_chk").attr("readonly",true);
                    });
                }


            }
        });
    }
    </script>

</div>
<!-- } 회원정보 입력/수정 끝 -->