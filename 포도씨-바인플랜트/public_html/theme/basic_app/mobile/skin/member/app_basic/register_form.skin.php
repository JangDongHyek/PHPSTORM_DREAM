 <?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css?v='.G5_CSS_VER.'">', 0);

//$readonly = '';
//if($w == 'u' || !empty($sns)) { // 수정 || sns로그인
//    $readonly = 'readonly';
//}

$mb_id = $member['mb_id'];
 if($w == '' && !empty($sns)) { $mb_id = '자동생성됩니다.'; }
//if($w == '' && $sns == 'kakao') { $mb_id = $id.'@k'; }
//else if($w == '' && $sns == 'naver') { $mb_id = substr($id, 0, 10).'@n'; }

$mb_name = $member['mb_name'];
if(!empty($sns) && !empty($name)) { $mb_name = $name; }
$mb_hp = $member['mb_hp'];
if(!empty($sns) && !empty($_GET['mobile'])) { $mb_hp = $_GET['mobile']; }
$mb_email = $member['mb_email'];
if(!empty($sns) && !empty($email)) {
    $mb_email = $email;
    //$mb_id = explode('@', $email)[0]; // 이메일을 가지고 올 경우 @ 앞에 잘라서 아이디로 사용
}

$direct_join = false;
if($w == '' && !empty($sns) && !empty($email)) { $direct_join = true; }
?>
<script src="<?php echo G5_JS_URL ?>/jquery.register_form.js"></script>
<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<style>
#ft_copy{ display:none;}
#ft{display:none;}

@media screen and (min-width:767px) {
	#ft_copy{ display:block;}
}
#mb_photo {position: absolute; left: -999px; top: -999px;}
</style>


<div class="mbskin">

    <form name="fregisterform" id="fregisterform" action="<?php echo $register_action_url ?>" onsubmit="return fregisterform_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
    <input type="hidden" name="w" value="<?php echo $w;?>">
    <input type="hidden" name="url" value="<?php echo $urlencode ?>">
	<input type="hidden" name="mb_level" id="mb_level" value="<? if($w == "") { echo 2; } else { echo $member['mb_level']; } ?>">
	<input type="hidden" name="mb_group" value="<?=$mb_group?>">
    <input type="hidden" name="mb_category" value="일반">
    <input type="hidden" name="sns" value="<?=$sns?>">
    <input type="hidden" name="sns_id" value="<?=$id?>">
    <input type="hidden" name="sns_token" value="<?=$sns_token?>">
    <input type="hidden" name="mb_name" value="<?=$mb_name?>">
    <input type="hidden" name="mb_hp" value="<?=$mb_hp?>">

	<article class="box-article">
		<h1 class="logo">
            <img src="<?php echo G5_THEME_IMG_URL ?>/app/logo2.svg" alt="PODOSEA">
		</h1>
		<div id="area_join">
			<div id="join_info">
			<h2><?php if($w == ""){ ?>일반회원가입<? }else { ?>회원정보 확인 및 수정<?php } ?> <p></h2>
				<div class="box-body">

                    <dl class="row">
						<dt>아이디</dt>
						<dd>
							<div class="input">
								<input type="text" name="mb_id" value="<?=$mb_id?>" id="reg_mb_id" class="regist-input" minlength="3" maxlength="20" required <?=$readonly?> placeholder="아이디를 입력해 주세요. <?=!empty($sns)?'(자동생성)':'';?>" <?=!empty($sns)?'readonly':'';?>
							</div>
						</dd>
						<dd class="error col-xs-12"></dd>
					</dl>

                    <?php if(empty($sns)) { // sns로그인은 비밀번호 필요없음?>
					<dl class="row">
						<dt>비밀번호</dt>
						<dd>
							<div class="input">
								<input type="password" name="mb_password" id="reg_mb_password" class="regist-input <?=$required?>" <?=$required?> minlength="4" maxlength="20" placeholder="비밀번호를 입력해 주세요.">
							</div>
						</dd>
						<dd class="error col-xs-12"></dd>
					</dl>

					<dl class="row password">
						<dt>비밀번호확인</dt>
						<dd>
							<div class="input">
								<input type="password" name="mb_password_re" id="reg_mb_password_re" class="regist-input <?=$required?>" <?=$required?> minlength="4" maxlength="20" placeholder="비밀번호를 한번 더 입력해 주세요.">
							</div>
						</dd>
						<dd class="error col-xs-12"></dd>
					</dl>
                    <?php } ?>

					<dl class="row">
						<dt>이메일</dt>
						<dd>
							<div class="input">
								<input type="text" name="mb_email" id="reg_mb_email" class="regist-input required f_empty email" minlength="3" maxlength="50" required placeholder="이메일을 입력해 주세요." value="<?=$mb_email?>">
							</div>
						</dd>
						<dd class="error col-xs-12"></dd>
					</dl>

				</div>
			</div><!--//join_info-->
		</div>

		<? if ($w == "" && empty($sns)) { ?>
		<div id="area_join">
        <div id="join_agr">
        <h2>약관동의</h2>
			<div class="cek_all">
				 <label class="selector">
					<input type="checkbox" id="all_chk" name="all_chk">
					<span><i></i>동의합니다.</span>
				</label>
			</div>
            <div class="box-body">
				<dl class="row agree-row">
                    <dd class="col-xs-8 chk_ico" data-for="reg_req3">
                        <input type="checkbox" name="reg_req[]" id="reg_req3" value="0" onclick="ag_check(this)">
                        <label for="reg_req3"><span></span><em>만 14세 이상입니다 (필수)</em></label>
                      	<!-- <i></i> 이용약관 동의 (필수) -->
                    </dd>
                </dl>

                <dl class="row agree-row">
                    <dd class="col-xs-8 chk_ico" data-for="reg_req1">
                        <input type="checkbox" name="reg_req[]" id="reg_req1" value="0" onclick="ag_check(this)">
                        <label for="reg_req1"><span></span><em>이용약관 동의 (필수)</em></label>
                      	<!-- <i></i> 이용약관 동의 (필수) -->
                    </dd>
                    <dd class="col-xs-4 text-right"><input type="button" value="내용보기" class="btn btn-agr"></dd>
                    <dd class="col-xs-12 agr_textarea"><textarea readonly><?php echo get_text($config['cf_stipulation']) ?></textarea></dd>
                </dl>

                <dl class="row agree-row">
                    <dd class="col-xs-9 chk_ico" data-for="reg_req2">
                        <input type="checkbox" name="reg_req[]" id="reg_req2" value="0" onclick="ag_check(this)">
                        <label for="reg_req2"><span></span><em>개인정보처리방침 동의 (필수)</em></label>
                        <!--<i></i> 개인정보처리방침 동의 (필수) -->
                    </dd>
                    <dd class="col-xs-3 text-right"><input type="button" value="내용보기" class="btn btn-agr"></dd>
                    <dd class="col-xs-12 agr_textarea"><div class="textarea"><?php echo $config['cf_privacy'] ?></div></dd>
                </dl>

				<dl class="row agree-row">
                    <dd class="col-xs-8 chk_ico" data-for="reg_req4">
                        <input type="checkbox" name="reg_req[]" id="reg_req4" value="0" onclick="ag_check(this)">
                        <label for="reg_req4"><span></span><em>서비스 정보 및 이벤트 혜택 알림 수신 동의 (선택)</em></label>
                    </dd>
                </dl>

				<!--<dl class="row agree-row">
                    <dd class="col-xs-8 chk_ico" data-for="reg_req5">
                        <input type="checkbox" name="reg_req[]" id="reg_req5" value="0" onclick="ag_check(this)">
                        <label for="reg_req5"><span></span><em>장기 미접속시 계정활성상태 유지합니다 (선택)</em></label>
                    </dd>
                </dl>-->
            </div>
        </div>
        </div><!--//join_chk-->
		<? } ?>

		<div class="btn_confirm">
			<input type="submit" class="btn_submit ft_btn" id="pay_submit" value="<?php echo $w==''?'회원가입 완료!':'정보수정'; ?>" accesskey="s">
			<!--<input type="submit" class="btn_submit ft_btn cancle" id="pay_submit" value="취소">-->
		</div>
	</article>
    </form>
</div>

<script>
    if (!'<?=$private?>') {
        // F12 버튼 방지
        $(document).ready(function () {
            $(document).bind('keydown', function (e) {
                if (e.keyCode == 123 /* F12 */) {
                    e.preventDefault();
                    e.returnValue = false;
                }
            });
        });

        // 마우스 우클릭 방지
        document.onmousedown = function (event) {
            if (event.button == 2) {
                return false;
            }
        };
    }
</script>

<script>
function ag_check(obj) {
    if (obj.value == "0") {
        obj.value = "1";
    } else {
        obj.value = "0";
    }
}

$(function () {
    if('<?=$direct_join?>') { // sns 가입 시 바로 회원가입 완료
        showLoadingBar();
        $('#fregisterform').submit();
    }

    // 약관동의 전체체크
    $("#all_chk").click(function() {
        if($("#all_chk").prop("checked")) {
            $("input[type=checkbox]").prop("checked",true);
            $("input[type=checkbox]").val("1");
        } else {
            $("input[type=checkbox]").prop("checked",false);
            $("input[type=checkbox]").val("0");
        }
    });

    $('input[name^=reg_req]').click(function() {
        if($("input[name^='reg_req']:checked").length == 4) {
            $('#all_chk').prop("checked", true);
        } else {
            $('#all_chk').prop("checked", false);
        }
    });

	// 아이디 체크
	$("#reg_mb_id").keyup(function (){
		var mb_id = $(this).val();
		var state = $(this).parents(".row").find(".status_ico");
		var err = $(this).parents(".row").find(".error");

		// 아이디 정규표현식
		var regId = /^[a-z0-9_]{3,15}$/;

		if (regId.test(mb_id)){
			var msg = reg_mb_id_check();
			if (msg) {
				state.removeClass("pas").addClass("err");
				err.addClass("on").html(msg);
			} else {
				state.removeClass("err").addClass("pas");
				err.html("");
			}
		}else{
			state.removeClass("pas").addClass("err");
			err.addClass("on").html("아이디는 영문 소문자와 숫자, 3 ~ 15자리까지 가능합니다.");
		}
	});

	$("#reg_mb_password").keyup(function (){
		var mb_password = $(this);
		var mb_password_re = $("#reg_mb_password_re");
		var state = mb_password.parents(".row").find(".status_ico");
		var err = mb_password.parents(".row").find(".error");

		if (mb_password.val() != "" && mb_password_re.val() != "") {
			// 바뀌면 무조건 틀렸다로 표시.
			if(mb_password_re.val() != mb_password.val()){
				state.removeClass("pas").addClass("err");
				err.addClass("on").html("비밀번호가 다릅니다.");
			}else{
				state.removeClass("err").addClass("pas");
				err.html("");
			}
		} else if (mb_password.val().length < 8) {
			state.removeClass("pas").addClass("err");
			err.addClass("on").html("비밀번호를 8자 이상 입력해 주세요.");
		} else {
			state.removeClass("err").addClass("pas");
			err.html("");
		}

        // 비밀번호 정규식 체크
        var chk_flag = mbPasswordChk(mb_password.val());
        if(!chk_flag) {
            state.removeClass("pas").addClass("err");
            err.addClass("on").html("영문, 숫자, 특수문자 중 2종류 이상 조합하여 8자리 이상 입력해 주세요.");
        } else {
            state.removeClass("err").addClass("pas");
            err.html("");
        }
	});

	$("#reg_mb_password_re").keyup(function (){
		var mb_password_re = $(this).val();
		var mb_password = $("#reg_mb_password").val();
		var state = $(this).parents(".row").find(".status_ico");
		var err = $(this).parents(".row").find(".error");

		// 비밀번호 정규표현식
		var regPassword = /^.*(?=^.{8,15}$)(?=.*\d)(?=.*[a-zA-Z])(?=.*[!@#$%^&+=]).*$/;

		if(mb_password == mb_password_re){
			state.removeClass("err").addClass("pas");
			err.html("");
		}else{
			state.removeClass("pas").addClass("err");
			err.addClass("on").html("비밀번호가 다릅니다.");
		}
	});

	$("#reg_mb_email").keyup(function (){
		// 공백제거
		$(this).val($(this).val().replace(/ /gi, ''));
		var mb_email = $(this).val();
		var state = $(this).parents(".row").find(".status_ico");
		var err = $(this).parents(".row").find(".error");

		// 이메일 정규표현식
		var regEmail = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/;

		if (regEmail.test(mb_email)){
			var msg = reg_mb_email_check();
			if (msg) {
				state.removeClass("pas").addClass("err");
				err.addClass("on").html(msg);
			} else {
				state.removeClass("err").addClass("pas");
				err.html("");
			}
		}else{
			state.removeClass("pas").addClass("err");
			err.addClass("on").html("올바른 E-mail 형식으로 입력해 주세요.")
			return false;
		}
	});

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
});

// submit 최종 폼체크
function fregisterform_submit(f){
	// 필수 체크박스
	// 조건들 확인

	// 회원아이디 검사
	if (f.w.value == "" && f.sns.value == "") {
		var msg = reg_mb_id_check();
		if (msg) {
			swal(msg);
			f.mb_id.focus();
			return false;
		}
	}

    if(f.w.value == "" && f.sns.value == "") {
        if (f.mb_password.value.length < 4) {
            swal('비밀번호를 8자 이상 입력해 주세요.');
            f.mb_password.focus();
            return false;
        }

        if (f.mb_password.value != f.mb_password_re.value) {
            swal('비밀번호가 같지 않습니다.');
            f.mb_password_re.focus();
            return false;
        }

        if (f.mb_password.value.length > 0) {
            if (f.mb_password_re.value.length < 4) {
                swal('비밀번호를 8자 이상 입력해 주세요.');
                f.mb_password_re.focus();
                return false;
            }
        }
    }

	// 이메일중복체크
	var msg = reg_mb_email_check();
	if (msg) {
		swal(msg);
		f.mb_email.focus();
		hideLoadingBar();
		return false;
	}

	// 필수필드 입력검사
	var obj = {};
	var submit = true;
	if(f.w.value == "") obj.reg_mb_id = "아이디를";
	if(f.sns.value == "") {
        obj.reg_mb_password = "비밀번호를";
        obj.reg_mb_password_re = "비밀번호확인을";
    }
	obj.reg_mb_email = "이메일을";

	for (var prop in obj) {
	    var msg = '';
		var el = $('#'+prop);
		if (el.parents(".row").find(".error").html() != '' && submit) {
		    swal(obj[prop] +' 확인하세요');
			el.focus();
			submit = false;
		}
	}
	if (!submit) {
		return false;
	}

	if (f.w.value == "" && f.sns.value == "") {
        if($("#reg_req3").val()!="1"){
            swal("만 14세 이상입니다(필수)를 체크하세요.");
            return false;
        }
		if($("#reg_req1").val()!="1"){
			swal("이용약관 동의(필수)를 체크하세요.");
			return false;
		}
		if($("#reg_req2").val()!="1"){
			swal("개인정보처리방침 동의(필수)를 체크하세요.");
			return false;
		}
	}

	// return true;
}
</script>
