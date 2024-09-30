<?php
include_once('../common.php');
include_once(G5_CAPTCHA_PATH.'/captcha.lib.php');
include_once(G5_LIB_PATH.'/register.lib.php');

/**
 * 회원가입
 */

// 에러확인
//error_reporting(E_ALL);
//ini_set("display_errors", 1);

include_once("./app_head.php");

// 불법접근을 막도록 토큰생성
$token = md5(uniqid(rand(), true));
set_session("ss_token", $token);
set_session("ss_cert_no",   "");
set_session("ss_cert_hash", "");
set_session("ss_cert_type", "");

if ($w == "") {
    // 회원 로그인을 한 경우 회원가입 할 수 없다
    // 경고창이 뜨는것을 막기위해 아래의 코드로 대체
    // alert("이미 로그인중이므로 회원 가입 하실 수 없습니다.", "./");
    if ($is_member) {
        goto_url(G5_URL);
    }

    // 리퍼러 체크
    referer_check();

    $agree  = preg_replace('#[^0-9]#', '', $_POST['agree']);
    $agree2 = preg_replace('#[^0-9]#', '', $_POST['agree2']);

    $member['mb_birth'] = '';
    $member['mb_sex']   = '';
    $member['mb_name']  = '';
    if (isset($_POST['birth'])) {
        $member['mb_birth'] = $_POST['birth'];
    }
    if (isset($_POST['sex'])) {
        $member['mb_sex'] = $_POST['sex'];
    }
    if (isset($_POST['mb_name'])) {
        $member['mb_name'] = $_POST['mb_name'];
    }

    $g5['title'] = '회원 가입';

}
else if ($w == 'u') {
    if ($is_admin)
        alert('관리자의 회원정보는 관리자 화면에서 수정해 주세요.', G5_URL);

    if (!$is_member)
        alert('로그인 후 이용해 주세요.', G5_URL);

    if ($member['mb_id'] != $_GET['mb_id'])
        alert('올바른 경로가 아닙니다.');

    $g5['title'] = '회원 정보 수정';

    set_session("ss_reg_mb_name", $member['mb_name']);
    set_session("ss_reg_mb_hp", $member['mb_hp']);

    $member['mb_email']       = get_text($member['mb_email']);
    $member['mb_homepage']    = get_text($member['mb_homepage']);
    $member['mb_birth']       = get_text($member['mb_birth']);
    $member['mb_tel']         = get_text($member['mb_tel']);
    $member['mb_hp']          = get_text($member['mb_hp']);
    $member['mb_addr1']       = get_text($member['mb_addr1']);
    $member['mb_addr2']       = get_text($member['mb_addr2']);
    $member['mb_signature']   = get_text($member['mb_signature']);
    $member['mb_recommend']   = get_text($member['mb_recommend']);
    $member['mb_profile']     = get_text($member['mb_profile']);
    $member['mb_1']           = get_text($member['mb_1']);
    $member['mb_2']           = get_text($member['mb_2']);
    $member['mb_3']           = get_text($member['mb_3']);
    $member['mb_4']           = get_text($member['mb_4']);
    $member['mb_5']           = get_text($member['mb_5']);
    $member['mb_6']           = get_text($member['mb_6']);
    $member['mb_7']           = get_text($member['mb_7']);
    $member['mb_8']           = get_text($member['mb_8']);
    $member['mb_9']           = get_text($member['mb_9']);
    $member['mb_10']          = get_text($member['mb_10']);

    $sns = $member['sns'];
} else {
    alert('w 값이 제대로 넘어오지 않았습니다.');
}

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
if ($config['cf_use_addr'])
    add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="' . $member_skin_url . '/style.css?ver=' . G5_CSS_VER . '">', 100);

if($sns == 'kakao' && $w == '') {
    $sns_mb_id = $id.'@k';
}
else if($sns == 'naver' && $w == '') {
    $sns_mb_id = substr($id, 0, 10).'@n';
}
?>

<div class="mbskin">
    <script src="<?php echo G5_JS_URL ?>/jquery.register_form.js"></script>
    <?php if ($config['cf_cert_use'] && ($config['cf_cert_ipin'] || $config['cf_cert_hp'])) { ?>
        <script src="<?php echo G5_JS_URL ?>/certify.js"></script>
    <?php } ?>

    <form name="fregisterform" id="fregisterform" action="./register_update.php" onsubmit="return fregisterform_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
        <input type="hidden" name="w" value="<?php echo $w; ?>">
        <input type="hidden" name="url" value="<?php echo $urlencode ?>">
        <input type="hidden" name="mb_level" id="mb_level" value="<? if ($w == '') { echo 2; } else { echo $member['mb_level']; } ?>">
        <?php if (isset($member['mb_sex'])) { ?><input type="hidden" name="mb_sex" value="<?php echo $member['mb_sex'] ?>"><?php } ?>
        <input type="hidden" name="token" id="token"> <!--푸시-->
        <!--sns정보-->
        <input type="hidden" name="sns" id="sns" value="<?=$sns?>">
        <input type="hidden" name="sns_id" value="<?=$id?>">
        <input type="hidden" name="mb_email" value="<?=$email?>">
        <!--//sns정보-->

        <article class="box-article">
            <div id="join_info">
                <h2>회원 정보 입력</h2>
                <div class="box-body">
                    <dl class="row">
                        <dd class="col-xs-12">
                            <label for="reg_mb_id">이메일</label>
                            <input type="text" name="mb_id" value="<?=empty($sns) || $w == 'u'?$member['mb_id']:$sns_mb_id?>" <?=empty($sns)?'':'readonly'?> id="reg_mb_id" class="regist-input <?php if ($w == "u") echo "readonly"; ?>" placeholder="<?=empty($sns)?'아이디 (이메일)':'아이디 (자동생성)'?>" <?php if ($w == "u") echo "readonly"; ?>>
                        </dd>
                        <dd class="status_ico <?=empty($sns)?'':'pas'?>"><i class="fas fa-check"></i></dd>
                        <dd class="error col-xs-12"></dd>
                    </dl>

                    <?php if(empty($sns)) { ?>
                    <dl class="row">
                        <dd class="col-xs-12">
                            <label for="reg_mb_password">비밀번호</label>
                            <input type="password" name="mb_password" id="reg_mb_password" class="regist-input" minlength="4" maxlength="20" placeholder="비밀번호">
                        </dd>
                        <dd class="status_ico lock_ico1"><i class="fas fa-lock-open"></i></dd>
                        <dd class="error col-xs-12"></dd>
                    </dl>

                    <dl class="row">
                        <dd class="col-xs-12">
                            <label for="mb_password_re">비밀번호확인</label>
                            <input type="password" name="mb_password_re" id="reg_mb_password_re" class="regist-input" minlength="4" maxlength="20" placeholder="비밀번호확인">
                        </dd>
                        <dd class="status_ico lock_ico2"><i class="fas fa-lock"></i></dd>
                        <dd class="error col-xs-12"></dd>
                    </dl>
                    <?php } ?>

                    <dl class="row">
                        <dd class="col-xs-12">
                            <label for="reg_mb_name">업체명&현장명</label>
                            <input type="text" name="mb_name" value="<?=$w=='u'?$member['mb_name']:$name?>" id="reg_mb_name" class="regist-input" placeholder="업체명&현장명">
                        </dd>
                        <dd class="status_ico <?=empty($sns)?'':'pas'?>"><i class="fas fa-check"></i></dd>
                        <dd class="error col-xs-12"></dd>
                    </dl>

                    <dl class="row">
                        <dd class="col-xs-12">
                            <label for="reg_mb_hp">휴대번호</label>
                            <input type="tel" name="mb_hp" value="<?=empty($sns) || $w == 'u'?$member['mb_hp']:$mobile?>" id="reg_mb_hp" class="regist-input" placeholder="휴대번호" style="font-size:0.95em;" maxlength="13">
                        </dd>
                        <dd class="status_ico <?=empty($sns)?'':'pas'?>"><i class="fas fa-check"></i></dd>
                        <dd class="error col-xs-12"></dd>
                    </dl>

                    <dl class="row">
                        <dd class="col-xs-12">
                            <label for="reg_mb_hp">주문배송지</label>
                            <input type="text" class="regist-input" id="mb_addr1" name="mb_addr1" placeholder="주문배송지" value="<?= $w == 'u' ? $member['mb_addr1'] : '' ?>" style="margin-bottom: 8px;" onclick="sample2_execDaumPostcode()"/>
                            <input type="text" class="regist-input" id="mb_addr2" name="mb_addr2" placeholder="상세주소" value="<?= $w == 'u' ? $member['mb_addr2'] : '' ?>"/>
                            <input type="hidden" id="mb_zip1" name="mb_zip1" value="<?= $w == 'u' ? $member['mb_zip1'] : '' ?>"/>
                        </dd>
                    </dl>

                    <dl class="row">
                        <dd class="col-xs-12">
                            <label for="reg_mb_email">명세서수신이메일</label>
                            <input type="text" name="send_email" id="reg_mb_email" class="regist-input <?php echo $required ?>" minlength="3" maxlength="50" <?php echo $required ?> placeholder="명세서수신이메일" value="<?php echo $member['send_email']; ?>">
                        </dd>
                        <dd class="status_ico"><i class="fas fa-check"></i></dd>
                        <dd class="error col-xs-12"></dd>
                        <p>* 월 명세서 및 세금계산서를 받으실 이메일주소 기입부탁드립니다.</p>
                    </dl>

                    <dl class="row pay">
                    	<dt class="col-xs-3">결제방법</dt>
                        <dd class="col-xs-9 chk">
                            <input type="radio" class="regist-input" name="payment" id="pay1" value="카드결제" <?=$w == '' || $member['payment'] == '카드결제' ? 'checked' : ''; ?>><label for="pay1" style="display:inline-block;"><div></div>카드결제</label>
                            <input type="radio" class="regist-input" name="payment" id="pay2" value="계좌입금" <?=$member['payment'] == '계좌입금' ? 'checked' : ''; ?>><label for="pay2" style="display:inline-block;"><div></div>계좌입금</label>
                        </dd>
                    </dl>

                </div>
            </div><!--//join_info-->

            <?php if ($w == "") { ?>
                <div id="join_agr">
                    <h2>약관동의</h2>
                    <div class="box-body chk">
                        <dl class="row agree-row">
                            <dd class="col-xs-9" data-for="reg_req1">
                                <input type="checkbox" name="reg_req[]" id="reg_req1" value="0" onclick="ag_check(this)">
                                <label for="reg_req1"><div></div>이용약관 동의 <strong>(필수)</strong></label>
                            </dd>
                            <dd class="col-xs-3 text-right"><input type="button" value="내용보기" class="btn btn-agr"></dd>
                            <dd class="col-xs-12 agr_textarea"><textarea readonly><?php echo get_text($config['cf_stipulation']) ?></textarea></dd>
                        </dl>

                        <dl class="row agree-row">
                            <dd class="col-xs-9" data-for="reg_req2">
                                <input type="checkbox" name="reg_req[]" id="reg_req2" value="0" onclick="ag_check(this)">
                                <label for="reg_req2"><div></div>개인정보처리방침 동의 <strong>(필수)</strong></label>
                            </dd>
                            <dd class="col-xs-3 text-right"><input type="button" value="내용보기" class="btn btn-agr"></dd>
                            <dd class="col-xs-12 agr_textarea"><textarea readonly><?php echo get_text($config['cf_privacy']) ?></textarea></dd>
                        </dl>

                    </div>
                </div><!--//join_chk-->
            <?php } ?>
            <input type="submit" class="btn_submit ft_btn" value="<?php echo $w == '' ? '가입하기' : '정보수정'; ?>" accesskey="s">
        </article>
    </form>
</div>

<div id="layer" style="display:none;position:fixed;overflow:hidden;z-index:3;-webkit-overflow-scrolling:touch;">
    <div class="add_title">
        <h2>주소찾기</h2>
        <div class="btn_close" onclick="closeDaumPostcode()" alt="접기버튼">
            <span></span>
            <span></span>
        </div>
    </div>
    <i id="btnCloseLayer" style="margin-right:0px; font-style:normal; width:40px; height:40px; color:#fff; background:#222; font-size:1.2em; text-align:center; font-weight:bold; line-height:40px; cursor:pointer;position:absolute;right:0;bottom:0;z-index:1" onclick="closeDaumPostcode()" alt="닫기 버튼">X</i>
</div>

<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<script>
    // 약관 동의
    function ag_check(obj) {
        if (obj.value == "0") {
            obj.value = "1";
        } else {
            obj.value = "0";
        }
    }

    $(function () {
        // 아이디 체크 (이메일 형식)
        $("#reg_mb_id").keyup(function () {
            var mb_email = $(this);
            var state = stateChk(mb_email); // 상태표시(패스/에러)
            var err = errChk(mb_email); // 에러메세지

            // 이메일 정규표현식
            var regEmail = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/;

            if (regEmail.test(mb_email.val())) {
                state.removeClass("err").addClass("pas");
                err.removeClass("on").html("");
            } else {
                state.removeClass("pas").addClass("err");
                err.addClass("on").html("올바른 이메일 형식으로 입력해 주세요.")
                return false;
            }
        });

        // 비밀번호 체크
        $("#reg_mb_password").keyup(function () {
            var mb_password = $(this);
            var mb_password_re = $('#reg_mb_password_re');
            var state = stateChk(mb_password); // 상태표시(패스/에러)
            var err = errChk(mb_password); // 에러메세지
            var state2 = stateChk(mb_password_re); // 상태표시(패스/에러)
            var err2 = errChk(mb_password_re); // 에러메세지

            // 비밀번호와 비밀번호확인이 일치하는지 체크
            if (mb_password.val() != "" && mb_password_re.val() != "" && mb_password_re.val() != mb_password.val()) {
                state.removeClass("pas").addClass("err");
                err.addClass("on").html("비밀번호가 다릅니다.");
            } else if(mb_password.val().length < 4) {
                state.removeClass("pas").addClass("err");
                err.addClass("on").html("비밀번호를 4자 이상 입력해 주세요.");
            } else {
                state.removeClass("err").addClass("pas");
                err.removeClass("on").html("");
                state2.removeClass("err").addClass("pas");
                err2.removeClass("on").html("");
            }

            /*// 비밀번호 정규표현식
            var regPassword = /^.*(?=^.{8,15}$)(?=.*\d)(?=.*[a-zA-Z])(?=.*[!@#$%^&+=]).*$/;

            if (regPassword.test(mb_password)) {
                $(this).parents(".row").find(".status_ico").removeClass("err").addClass("pas");
                $(this).parents(".row").find(".error").removeClass("on").html("");
            } else {
                $(this).parents(".row").find(".status_ico").removeClass("pas").addClass("err");
                $(this).parents(".row").find(".error").addClass("on").html("비밀번호는 8자~15자 영문,숫자,특수문자가 포함 되어야 합니다.");
            }*/
        });

        // 비밀번호확인 체크
        $("#reg_mb_password_re").keyup(function () {
            var mb_password_re = $(this);
            var mb_password = $("#reg_mb_password");
            var state = stateChk(mb_password_re); // 상태표시(패스/에러)
            var err = errChk(mb_password_re); // 에러메세지
            var state2 = stateChk(mb_password_re); // 상태표시(패스/에러)
            var err2 = errChk(mb_password_re); // 에러메세지

            if (mb_password.val() == mb_password_re.val()) {
                state.removeClass("err").addClass("pas");
                err.removeClass("on").html("");
                state2.removeClass("err").addClass("pas");
                err2.removeClass("on").html("");
            } else {
                state.removeClass("pas").addClass("err");
                err.addClass("on").html("비밀번호가 다릅니다.");
            }
        });

        // 이름 체크
        $("#reg_mb_name").keyup(function () {
            var mb_name = $(this);
            var state = stateChk(mb_name); // 상태표시(패스/에러)
            var err = errChk(mb_name); // 에러메세지

            // 이름 정규표현식
            var regName = /^[가-힣]{2,4}|[a-zA-Z]{2,10}\s[a-zA-Z]{2,10}$/;

            if (regName.test(mb_name.val())) {
                state.removeClass("err").addClass("pas");
                err.removeClass("on").html("");
            } else {
                state.removeClass("pas").addClass("err");
                err.addClass("on").html("2글자 이상 한글만 입력해 주세요.");
            }
        });

        // 휴대번호 체크
        $("#reg_mb_hp").keyup(function () {
            var mb_hp = $(this);
            var state = stateChk(mb_hp); // 상태표시(패스/에러)
            var err = errChk(mb_hp); // 에러메세지

            // 휴대폰 정규표현식
            var regHp = /^([0-9]{3,4})-?([0-9]{3,4})-?([0-9]{4})$/;

            if (regHp.test(mb_hp.val())) {
                state.removeClass("err").addClass("pas");
                err.removeClass("on").html("");
            } else {
                state.removeClass("pas").addClass("err");
                err.addClass("on").html("휴대폰 번호는 10 ~ 12자리 숫자만 입력해 주세요.");
            }
        }).keydown(function (event) {
            var mb_hp = $(this);
            var key = event.charCode || event.keyCode || 0;
            if (key !== 8 && key !== 9) {
                if (mb_hp.val().length === 3) {
                    mb_hp.val(mb_hp.val() + '-');
                }
                if (mb_hp.val().length === 8) {
                    mb_hp.val(mb_hp.val() + '-');
                }
            }

            return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
        });

        // 이메일 체크
        $("#reg_mb_email").keyup(function (){
            var mb_email = $(this);
            var state = stateChk(mb_email); // 상태표시(패스/에러)
            var err = errChk(mb_email); // 에러메세지

            // 이메일 정규표현식
            var regEmail = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/;

            if (regEmail.test(mb_email.val())){
                state.removeClass("err").addClass("pas");
                err.removeClass("on").html("");
            }else{
                state.removeClass("pas").addClass("err");
                err.addClass("on").html("올바른 형식으로 입력해 주세요.");
            }
        });

        // 내용보기
        $(".btn-agr").click(function () {
            var dis = $(this).parents(".row").find(".agr_textarea").css("display");
            if (dis == "none")
                $(this).parents(".row").find(".agr_textarea").slideDown(100);
            else
                $(this).parents(".row").find(".agr_textarea").slideUp(100);
        });

        // 약관동의
        $(".agree-row dd:first-child").click(function () {
            var ford = $(this).data("for");
            var targ = $("#" + ford);

            if (targ.val() == "1") {
                $(this).find("i").removeClass("nochk").addClass("chk");
            } else {
                $(this).find("i").removeClass("chk").addClass("nochk");
            }
        });
    });

    // submit 최종 폼체크
    function fregisterform_submit(f) {
        // 필수 조건 확인

        // 아이디 검사
        if (f.w.value == "" && f.sns.value == "") {
            var msg = reg_mb_id_check();
            if (msg) {
                swal(msg);
                f.mb_id.select();
                return false;
            }
        }

        // 비밀번호 검사
        if(f.sns.value == "") {
            if (f.w.value == '') {
                if (f.mb_password.value.length < 4) {
                    swal('비밀번호를 4자 이상 입력해 주세요.');
                    f.mb_password.focus();
                    return false;
                }
            }

            if (f.mb_password.value != f.mb_password_re.value) {
                swal('비밀번호가 다릅니다.');
                f.mb_password_re.focus();
                return false;
            }

            if (f.mb_password.value.length > 0) {
                if (f.mb_password_re.value.length < 4) {
                    swal('비밀번호를 4글자 이상 입력해 주세요.');
                    f.mb_password_re.focus();
                    return false;
                }
            }
        }

        // 이름 검사
        if (f.w.value == '') {
            if (f.mb_name.value.length < 1) {
                swal('업체명&현장명을 입력해 주세요.');
                f.mb_name.focus();
                return false;
            }
        }

        // 휴대번호 검사
        if (f.mb_hp.value.length < 1) {
            swal('휴대번호를 입력해 주세요.');
            f.mb_hp.focus();
            return false;
        }

        // 이메일 검사
        if(f.send_email.value.length < 1) {
            swal('이메일주소를 입력해 주세요.');
            f.mb_email.focus();
            return false;
        }

        var obj = {};
        var submit = true;
        if (f.w.value == "") obj.reg_mb_id = "이메일을";
        if (f.sns.value == "") obj.reg_mb_password = "비밀번호를";
        if (f.sns.value == "") obj.reg_mb_password_re = "비밀번호확인을";
        obj.reg_mb_name = "업체명&현장명을";
        obj.reg_mb_hp = "휴대번호를";
        obj.reg_mb_email = "이메일주소를";

        for (var prop in obj) {
            var el = $('#'+prop);
            if (el.parents(".row").find(".error").html() != '' && submit) {
                swal(obj[prop] +' 확인해 주세요.');
                el.focus();
                submit = false;
            }
        }
        if (!submit) {
            return false;
        }

        // 약관 동의 검사
        <?php if($w == "") { ?>
        if ($("#reg_req1").val() != "1") {
            swal("이용약관 동의(필수)를 체크해 주세요.");
            return false;
        }
        if ($("#reg_req2").val() != "1") {
            swal("개인정보처리방침 동의(필수)를 체크해 주세요.");
            return false;
        }
        <?php } ?>

        return true;
    }

    // 푸시
    function fcmKey(token) {
        $("input[name='token']").val(token); //토큰값을 필드에 넣기 mb_10일 경우 mb_10으로 하면된다
    }

    // *** 다음 주소 api ***
    var element_layer = document.getElementById('layer');

    function closeDaumPostcode() {
        // iframe을 넣은 element를 안보이게 한다.
        element_layer.style.display = 'none';
    }

    function sample2_execDaumPostcode() {
        new daum.Postcode({
            oncomplete: function (data) {
                // 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                // 각 주소의 노출 규칙에 따라 주소를 조합한다.
                // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                var addr = ''; // 주소 변수
                var extraAddr = ''; // 참고항목 변수

                //사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
                if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                    addr = data.roadAddress;
                } else { // 사용자가 지번 주소를 선택했을 경우(J)
                    addr = data.jibunAddress;
                }

                // 사용자가 선택한 주소가 도로명 타입일때 참고항목을 조합한다.
                if (data.userSelectedType === 'R') {
                    // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                    // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                    if (data.bname !== '' && /[동|로|가]$/g.test(data.bname)) {
                        extraAddr += data.bname;
                    }
                    // 건물명이 있고, 공동주택일 경우 추가한다.
                    if (data.buildingName !== '' && data.apartment === 'Y') {
                        extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                    }
                    // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                    if (extraAddr !== '') {
                        extraAddr = ' (' + extraAddr + ')';
                    }
                    // 조합된 참고항목을 해당 필드에 넣는다.
                    // document.getElementById("sample2_extraAddress").value = extraAddr;

                } else {
                    // document.getElementById("sample2_extraAddress").value = '';
                }

                // 우편번호와 주소 정보를 해당 필드에 넣는다.
                document.getElementById("mb_zip1").value = data.zonecode;
                document.getElementById("mb_addr1").value = addr + ' ' + extraAddr;
                // 커서를 상세주소 필드로 이동한다.
                document.getElementById("mb_addr2").focus();

                // iframe을 넣은 element를 안보이게 한다.
                // (autoClose:false 기능을 이용한다면, 아래 코드를 제거해야 화면에서 사라지지 않는다.)
                element_layer.style.display = 'none';
            },
            width: '100%',
            height: '100%',
            maxSuggestItems: 5
        }).embed(element_layer);

        // iframe을 넣은 element를 보이게 한다.
        element_layer.style.display = 'block';

        // iframe을 넣은 element의 위치를 화면의 가운데로 이동시킨다.
        initLayerPosition();
    }

    // 브라우저의 크기 변경에 따라 레이어를 가운데로 이동시키고자 하실때에는
    // resize이벤트나, orientationchange이벤트를 이용하여 값이 변경될때마다 아래 함수를 실행 시켜 주시거나,
    // 직접 element_layer의 top,left값을 수정해 주시면 됩니다.
    function initLayerPosition() {
        var width = "450"; //우편번호서비스가 들어갈 element의 width 350
        var height = "500"; //우편번호서비스가 들어갈 element의 height 400
        var borderWidth = 1; //샘플에서 사용하는 border의 두께

        // 위에서 선언한 값들을 실제 element에 넣는다.
        element_layer.style.width = width + 'px';
        element_layer.style.height = height + 'px';
        element_layer.style.border = borderWidth + 'px solid';
        // 실행되는 순간의 화면 너비와 높이 값을 가져와서 중앙에 뜰 수 있도록 위치를 계산한다.
        element_layer.style.left = (((window.innerWidth || document.documentElement.clientWidth) - width) / 2 - borderWidth) + 'px';
        element_layer.style.top = (((window.innerHeight || document.documentElement.clientHeight) - height) / 2 - borderWidth) + 'px';
    }
    // *** 다음 주소 api ***
</script>

<?php
include_once('./app_tail.php');
?>
