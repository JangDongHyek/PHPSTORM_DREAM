<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
//include_once($member_skin_path.'/mb.head.php');
?>
<style>
body{background: #f5f5f5;}
.box-article .box-body dd input {
    background: #f3f6fc !important;
}
.box-article .box-body dd input.required_custom {
    background: #fff !important;
    border: 1px solid #e6e6e6;
    border-radius: 0 !important;
}
</style>


<!-- 회원가입시작 { -->
<div class="mbskin">
    <script src="<?php echo G5_JS_URL ?>/jquery.register_form.js"></script>
    <?php if($config['cf_cert_use'] && ($config['cf_cert_ipin'] || $config['cf_cert_hp'])) { ?>
    <script src="<?php echo G5_JS_URL ?>/certify.js"></script>
    <?php } ?>

    <form name="fregisterform" id="fregisterform" action="<?php echo $register_action_url ?>" onsubmit="return fregisterform_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
    <input type="hidden" name="w" value="<?php echo $w;?>">
    <!--
    <input type="hidden" name="url" value="<?php /*echo $urlencode */?>">
    <input type="hidden" name="cert_type" value="<?php /*echo $member['mb_certify']; */?>">
    <input type="hidden" name="cert_no" value="">
    <input type="hidden" name="mb_sns_type" value="<?php /*echo $mb_sns_type;*/?>">
    <input type="hidden" name="mb_type" id="mb_type" value="<?php /*echo $mb_type;*/?>">
    <?php /*if (isset($member['mb_nick_date']) && $member['mb_nick_date'] > date("Y-m-d", G5_SERVER_TIME - ($config['cf_nick_modify'] * 86400))) { // 닉네임수정일이 지나지 않았다면 */?>
    <?php /*} */?>
    <input type="hidden" name="mb_nick_default" value="<?php /*echo get_text($member['mb_nick']) */?>">
    <input type="hidden" name="mb_nick" value="<?php /*echo get_text($member['mb_nick']) */?>">
    <?php /*if (isset($member['mb_sex'])) { */?><input type="hidden" name="mb_sex" value="<?php /*echo $member['mb_sex'] */?>"><?php /*} */?>
    -->
	<input type="hidden" name="mb_level" id="mb_level" value="<?php if($w == '') { echo $mb_level; } else { echo $member['mb_level']; } ?>">
    <input type="hidden" name="join_type" id="join_type" value="<?=$join_type?>">
    <input type="hidden" name="disab_type1" id="disab_type1">
    <input type="hidden" name="disab_type2" id="disab_type2">
    <input type="hidden" name="delete_yn" id="delete_yn">

	<article class="box-article">
    	<div id="join_exinfo">
		<h2><?php if($w == ""){ ?>회원정보 입력<? }else { ?>회원정보 확인 및 수정<?php } ?> <p><span style="color:#fb2323;">*</span> 필수입력</p></h2>
            <div class="box-body">
                <dl class="row">
                	<dd class="col-xs-1 req">*</dd>
                    <dd class="col-xs-12">
                        <label for="reg_mb_id">판매자 구분</label>
                    </dd>
                    <div id="join_agr">
                        <div class="b_rdo cf">
                            <div class="st">
                                <label>
                                    <input type="radio" name="join_type" id="person_1" value="초혼" checked="">
                                    <em></em>
                                    <div class="bx"><h2 class="tit"><span>초혼</span>입니다.</h2></div>
                                </label>
                            </div>
                            <div class="st">
                                <label>
                                    <input type="radio" name="join_type" id="person_2" value="재혼">
                                    <em></em>
                                    <div class="bx"><h2 class="tit"><span>재혼</span>입니다.</h2></div>
                                </label>
                            </div>
                        </div>
                    </div>
                    <dd class="error col-xs-12" id="email_msg"></dd>
                </dl>
            
                <dl class="row">
                	<dd class="col-xs-1 req">*</dd>
                    <dd class="col-xs-12">
                        <span id="button_span"><button type="button" class="phone" onclick="certi_phone_send();">인증하기</button></span>
                        <label for="reg_mb_id">휴대폰 인증</label>
                        <input type="text" name="mb_phone" value="<?php echo $member['mb_email'] ?>" id="reg_mb_phone" class="phone regist-input <?php echo $required ?> <?php if($w=="u") echo "readonly";?>" minlength="4" maxlength="50">
                    </dd>
                    <dd class="error col-xs-12" id="phone"></dd>
                </dl>

                <dl class="row">
                	<dd class="col-xs-1 req">*</dd>
                    <dd class="col-xs-12">
                        <label for="reg_mb_password">실명</label>
                        <input type="text" name="mb_name" value="<?php echo $member['mb_name'] ?>" id="reg_mb_name" class="regist-input <?php echo $required ?>">
                    </dd>
                    <dd class="error col-xs-12"></dd>
                </dl>

                <dl class="row">
                	<dd class="col-xs-1 req">*</dd>
                    <dd class="col-xs-121">
                        <label for="mb_password_re">생년월일</label>
                        <div class="birth_wrap">
                             <ul>
                                  <li>
                                  <select name="wr_year" class="select" id="" title="년도 선택">
                                   <option value="" hidden>년도 선택</option>
                                        <!--normal select-->
                                        <option value="06:">2010</option>
                                        <option value="07:">2011</option>
                                        <option value="08:">2009</option>
                                  </select>
                                  </li>
                                  <li>
                                  <select name="wr_year" class="select" id="" title="월 선택">
                                        <option value="" hidden>월 선택</option>
                                        <!--normal select-->
                                        <option value="06:">01</option>
                                        <option value="07:">02</option>
                                        <option value="08:">03</option>
                                  </select>
                                  </li>
                                  <li>
                                  <select name="wr_year" class="select" id="" title="일 선택">
                                   <option value="" hidden>일 선택</option>
                                        <!--normal select-->
                                        <option value="06:">01</option>
                                        <option value="07:">02</option>
                                        <option value="08:">03</option>
                                  </select>
                                  </li>
                              </ul>
                        </div>
                    </dd>
                    <dd class="error col-xs-12"></dd>
                </dl>

                <dl class="row">
                	<dd class="col-xs-1 req">*</dd>
                    <dd class="col-xs-12">
                        <label for="reg_mb_name">출금계좌정보<span>예금주는 휴대폰인증 정보와 동일</span></label>
                        <div class="account_wrap">
                             <ul>
                                  <li>
                                  <select name="wr_year" class="select" id="" title="은행 선택">
                                   <option value="" hidden>은행 선택</option>
                                        <!--normal select-->
                                        <option value="06:">2010</option>
                                        <option value="07:">2011</option>
                                        <option value="08:">2009</option>
                                  </select>
                                  </li>
                                  <li>
                                  <input type="text" name="mb_name" value="<?php echo $member['mb_name'] ?>" id="reg_mb_name" class="regist-input <?php echo $required ?>" placeholder="예금주 입력">
                                  </li>
                                  <li>
                                  <input type="text" name="mb_name" value="<?php echo $member['mb_name'] ?>" id="reg_mb_name" class="regist-input <?php echo $required ?>" placeholder="'-'없이 숫자만 입력해 주세요">
                                  </li>
                              </ul>
                        </div>
                        <!--서비스 판매시 세금관련 유의사항-->
                        <div>
                        </div>
                    </dd>
                    <dd class="error col-xs-12"></dd>
                </dl>

                <dl class="row">
                            <div class="notice_area">
                            <h3>※서비스 판매 시 "세금"관련 유의사항</h3>
                            <textarea readonly="">잡고를 통해 서비스를 판매하는 전문가는 사업자 등록 후 서비스를 판매하셔야 합니다. 사업자등록은 사업 개시 후 20일 이내에 사업장 소재지 관할 세무서에서 신청하시면 됩니다. 사업자 등록 없이 사업을 영위하는 경우 다음과 같은 가산세 부담 등의 불이익을 받게 됩니다.
                            </textarea>
                            </div>
                </dl>

                <!--<dl class="row">
                	<dd class="col-xs-1 req">*</dd>
                    <dd class="col-xs-11">
                        <label for="reg_mb_email">E-mail</label>
                        <input type="text" name="mb_email" id="reg_mb_email" class="regist-input <?php echo $required ?>" minlength="3" maxlength="50" <?php echo $required ?> placeholder="E-mail" value="<?php echo $member['mb_email']; ?>">
                    </dd>
                    <dd class="status_ico"><i class="fas fa-check"></i></dd>
                    <dd class="error col-xs-12"></dd>
                </dl>-->
    

                <dl class="row">
                	<dd class="col-xs-1 req">*</dd>
                    <dd class="col-xs-12">
                        <label for="reg_mb_id">전자서명</label>
                        <input type="text" name="mb_phone" value="<?php echo $member['mb_email'] ?>" id="reg_mb_phone" class="phone regist-input <?php echo $required ?> <?php if($w=="u") echo "readonly";?>" minlength="4" maxlength="50">
                    </dd>
                    <dd class="error col-xs-12" id="email_msg"></dd>
                </dl>
    
            </div>
        </div><!--//join_info-->
		
		<?php if($w == ""){ ?>
        <div id="join_agr">
        <h2 class="hide">약관동의</h2>
            <div class="box-body agree allcheck">
                <dl class="row agree-row all">
                    <dd class="col-xs-12 chk_ico" data-for="reg_all">
                        <input type="checkbox" name="reg_all" id="reg_all" value="0" onclick="ag_check(this)">
                        <label for="reg_all" class="title">약관전체동의</label>
                      	<!-- <i></i> 이용약관 동의 (필수) -->
                    </dd>
                </dl>

				<dl class="row agree-row">
                    <dd class="col-xs-8 chk_ico" data-for="reg_req0">
                        <input type="checkbox" name="reg_req[]" id="reg_req0" value="0" onclick="ag_check(this)">
                        <label for="reg_req0">서비스 이용약관에 동의합니다. (필수)</label>
                      	<!-- <i></i> 이용약관 동의 (필수) -->
                    <dd class="col-xs-4 text-right"><input type="button" value="보기" class="btn btn-agr"></dd>
                    <dd class="col-xs-12 agr_textarea"><textarea readonly><?php echo get_text($config['cf_stipulation']) ?></textarea></dd>
                    </dd>
                </dl>

				<dl class="row agree-row">
                    <dd class="col-xs-8 chk_ico" data-for="reg_req1">
                        <input type="checkbox" name="reg_req[]" id="reg_req1" value="0" onclick="ag_check(this)">
                        <label for="reg_req1">개인정보처리방침에 동의합니다. (필수)</label>
                      	<!-- <i></i> 이용약관 동의 (필수) -->
                    </dd>
                    <dd class="col-xs-4 text-right"><input type="button" value="보기" class="btn btn-agr"></dd>
                    <dd class="col-xs-12 agr_textarea"><textarea readonly><?php echo get_text($config['cf_stipulation']) ?></textarea></dd>
                </dl>
                
                <dl class="row agree-row">
                    <dd class="col-xs-9 chk_ico" data-for="reg_req2">
                        <input type="checkbox" name="reg_req[]" id="reg_req2" value="0" onclick="ag_check(this)">
                        <label for="reg_req2">잡고 판매홍보 대행 약관에 동의합니다. (필수)</label>
                        <!--<i></i> 개인정보처리방침 동의 (필수) -->
                    </dd>
                    <dd class="col-xs-3 text-right"><input type="button" value="보기" class="btn btn-agr"></dd>
                    <dd class="col-xs-12 agr_textarea"><textarea readonly><?php echo get_text($config['cf_privacy']) ?></textarea></dd>
                </dl>
                
                <!--<dl class="agree-row">
                    <dd class=" chk_ico" data-for="reg_chk1">
                        <input type="checkbox" name="reg_chk[]" id="reg_chk1" value="">
                        <label for="reg_chk1">선택 동의 (선택)</label>
                        <i></i> 선택 동의 (선택) 
                    </dd>
                </dl>-->
            </div>
            
        </div><!--//join_chk-->
        
        
		<?php } ?>

		<input type="submit" class="btn_submit ft_btn" value="<?php echo $w==''?'재능인 등록 요청':'정보수정'; ?>" accesskey="s">
	</article>
    </form>
</div>


<script>

function certi_mail_send() {
    // 입력 이메일
    var reg_mb_email = $('#reg_mb_email').val();

    // 이메일 공란 체크
    if(reg_mb_email == '') {
        $('#email_msg').text('이메일 주소를 입력해주세요.');
        $('#reg_mb_email').focus();
        return;
    }

    // 이메일 형식 체크
    var data = /^([0-9a-zA-Z_\.-]+)@([0-9a-zA-Z_-]+)(\.[0-9a-zA-Z_-]+){1,2}$/;

    if(reg_mb_email.search(data) != -1) {
        $.ajax({
            url: g5_bbs_url+'/ajax.controller.php',
            type: 'POST',
            data: {
                mode : 'certi_mail_send',
                reg_mb_email : $('#reg_mb_email').val()
            },
            dataType: 'html',
            success: function(data) {
                // 메일 발송 성공
                if(data == 'S00') {
                    $('#button_span').html('<button type="button" class="btn cert" onclick="certi_confirm();">인증 확인</button>');
                    $('#email_msg').text('인증 메일이 발송되었습니다.\n 메일을 확인하여 인증을 완료해주세요.');
                }

                if(data == 'no') {
                    $('#email_msg').text('이미 회원가입 한 이메일입니다.');
                }
            }
        });
    } else {
        $('#email_msg').text('이메일 형식이 올바르지 않습니다.');
        $('#reg_mb_email').focus();
        return;
    }
}

// 인증 확인
function certi_confirm() {
    var mb_email = $('#reg_mb_email').val();

    $.ajax({
        url: g5_bbs_url+'/ajax.controller.php',
        type: 'POST',
        data: {
            mode: "certi_confirm_check",
            reg_mb_email : $('#reg_mb_email').val()
        },
        dataType: 'html',
        success: function(data) {
            if(data == 'no_certify') {
                alert('인증을 완료해주세요.');
            } else {
                location.href = './register_form.php?certify_id='+mb_email;
            }
        }
    });
}

function ag_check(obj) {
	if(obj.value == "0"){
		obj.value = "1";
	}else{
		obj.value = "0";
	}
}

$(function (){


	//전체동의 체크 클릭시
	$("#reg_all").click(function(){
		$("#reg_req1").prop("checked",$(this).prop("checked"));
		$("#reg_req2").prop("checked",$(this).prop("checked"));
		$("#reg_req0").prop("checked",$(this).prop("checked"));
	});

	// 아이디 체크
	$("#reg_mb_id").keyup(function (){
		var mb_id = $(this).val();
		var reg_mb_id = $(this);

		// 아이디 정규표현식
		var regId = /^[a-z0-9]{4,12}$/;
		/*
		if (regId.test(mb_id)){
			$(this).parents(".row").find(".status_ico").removeClass("err").addClass("pas");
			$(this).parents(".row").find(".error").html("");
		}else{
			$(this).parents(".row").find(".status_ico").removeClass("pas").addClass("err");
			$(this).parents(".row").find(".error").addClass("on").html("아이디는 영문과 숫자, 4 ~ 12자리까지 가능합니다.");

			return false;
		}*/

		// 아작스로 중복 아이디가 있는지 체크 1
		$.post(g5_bbs_url+"/ajax.mb_id.php", {"reg_mb_id":mb_id}, function (result){
			if(result == ''){  // ajax.mb_id.php 의 die($msg); 값을 가져옴
				reg_mb_id.parents(".row").find(".status_ico").removeClass("err").addClass("pas"); //될때 초록색 박스 i 는 icon 의 약자
				reg_mb_id.parents(".row").find(".error").html(""); // 마지막 dd 의 css 스타일 사용
			}else{
				reg_mb_id.parents(".row").find(".status_ico").removeClass("pas").addClass("err");
				reg_mb_id.parents(".row").find(".error").addClass("on").html(result);
			}
		});
	});

	$("#reg_mb_password").keyup(function (){
		var mb_password = $(this).val();
		var reg_mb_password = $(this);
		/*
		// 바뀌면 무조건 틀렸다로 표시.
		if($("#reg_mb_password_re").val() != mb_password){
			$("#reg_mb_password_re").parents(".row").find(".status_ico").removeClass("pas").addClass("err");
			$("#reg_mb_password_re").parents(".row").find(".error").addClass("on").html("비밀번호가 다릅니다.");
		}else{
			$("#reg_mb_password_re").parents(".row").find(".status_ico").removeClass("err").addClass("pas");
			$("#reg_mb_password_re").parents(".row").find(".error").html("");
		}*/
		/*
		// 비밀번호 정규표현식
		var regPassword = /^.*(?=^.{8,15}$)(?=.*\d)(?=.*[a-zA-Z])(?=.*[!@#$%^&+=]).*$/;

		if (regPassword.test(mb_password)){
			$(this).parents(".row").find(".status_ico").removeClass("err").addClass("pas");
			$(this).parents(".row").find(".error").html("");
		}else{
			$(this).parents(".row").find(".status_ico").removeClass("pas").addClass("err");
			$(this).parents(".row").find(".error").addClass("on").html("비밀번호는 8자~15자 영문,숫자,특수문자가 포함 되어야 합니다.");
		}*/
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


    /*
	$("#reg_mb_nick").keyup(function (){
		var mb_nick = $(this).val();
		var reg_mb_nick = $(this);

		// 닉네임 정규표현식
		var regNick = /^[\w\Wㄱ-ㅎㅏ-ㅣ가-힣]{2,20}$/;

		if (regNick.test(mb_nick)){
			$(this).parents(".row").find(".status_ico").removeClass("err").addClass("pas");
			$(this).parents(".row").find(".error").html("");
		}else{
			$(this).parents(".row").find(".status_ico").removeClass("pas").addClass("err");
			$(this).parents(".row").find(".error").addClass("on").html("2글자 이상 입력해주세요.")
			return false;
		}

		$.post(g5_bbs_url+"/ajax.mb_register.php", {"type2":"mb_nick", "val2":mb_nick}, function (result){
			if(result == "0"){
				reg_mb_nick.parents(".row").find(".status_ico").removeClass("err").addClass("pas");
				reg_mb_nick.parents(".row").find(".error").html("");
			}else{
				reg_mb_nick.parents(".row").find(".status_ico").removeClass("pas").addClass("err");
				reg_mb_nick.parents(".row").find(".error").addClass("on").html("사용중인 닉네임 입니다.");

			}
		});
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

	// 라디오 버튼
	$("#dd_type p").click(function (){
		var v = $(this).data("val");

		$("#mb_type").val(v);
		$("#dd_type p").find("i").removeClass("fa-check-circle-o").addClass("fa-circle-o");
		$(this).find("i").removeClass("fa-circle-o").addClass("fa-check-circle-o");
	});
    */

	// 내용보기
	$(".btn-agr").click(function (){
		var dis = $(this).parents(".row").find(".agr_textarea").css("display");
		if(dis == "none")
			$(this).parents(".row").find(".agr_textarea").slideDown(100);
		else
			$(this).parents(".row").find(".agr_textarea").slideUp(100);
	});

	// 약관동의
	$(".agree-row dd:first-child").click(function (){
		var ford = $(this).data("for");
		var targ = $("#" + ford);

		if(targ.val() == "1"){
			$(this).find("i").removeClass("nochk").addClass("chk");
			//targ.val("0");
		}else{
			$(this).find("i").removeClass("chk").addClass("nochk");
			//targ.val("1");
		}
	});

	// // 가입경로선택
	// $("#reg_mb_1").on("change", function() {
	// 	if ($(this).val() == "기타") {
	// 		$("#reg_mb_2").show().focus();
	// 	} else {
	// 		$("#reg_mb_2").hide().val("");
	// 	}
	// });
});


// submit 최종 폼체크
function fregisterform_submit(f) {
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

	<?php if($w == ""){ ?>
	if($("#reg_req1").prop("checked")==false){
        swal("이용약관 동의(필수)를 체크하십시오");
		return false;
	}
	if($("#reg_req2").prop("checked")==false){
        swal("개인정보처리방침 동의(필수)를 체크하십시오");
		return false;
	}
	<?php } ?>

	return true;
}

</script>

<script>
$(document).ready(function () {

});
</script>