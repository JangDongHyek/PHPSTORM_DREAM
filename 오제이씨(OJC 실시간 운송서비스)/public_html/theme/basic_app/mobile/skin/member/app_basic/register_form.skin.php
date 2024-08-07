<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가


// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="' . $member_skin_url . '/style.css?ver=' . G5_CSS_VER . '">', 100);

//$naver_info = naver_info($_REQUEST['code']);
//var_dump($naver_info);

?>

<div class="mbskin">
    <script src="<?php echo G5_JS_URL ?>/jquery.register_form.js"></script>
    <?php if ($config['cf_cert_use'] && ($config['cf_cert_ipin'] || $config['cf_cert_hp'])) { ?>
    <script src="<?php echo G5_JS_URL ?>/certify.js"></script>
    <?php } ?>

    <form name="fregisterform" id="fregisterform" action="<?php echo $register_action_url ?>" onsubmit="return fregisterform_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
        <input type="hidden" name="w" value="<?php echo $w; ?>">
        <input type="hidden" name="url" value="<?php echo $urlencode ?>">
        <input type="hidden" name="kakao_code" value="<?=$_REQUEST['code']?>" />
<!--        <input type="hidden" name="mb_level" id="mb_level" value="--><?// if ($w == '') { echo $mb_level; } else { echo $member['mb_level']; } ?><!--">-->
        <?php if (isset($member['mb_sex'])) { ?><input type="hidden" name="mb_sex" value="<?php echo $member['mb_sex'] ?>"><?php } ?>


        <article class="box-article">
            <div id="mb_part">
                <div class="round">
                <input type="radio" name="mb_level" id="mb-level2" value="2" <?=$w=="u" ? ($member['mb_level']=="2" ? "checked" : "") : "checked" ?> /><label for="mb-level2">개인</label>
                <input type="radio" name="mb_level" id="mb-level3" value="3" <?=$w=="u" ? ($member['mb_level']=="3" ? "checked" : "") : "" ?> /><label for="mb-level3">개인·법인 사업자</label>
                </div>
            </div>
            <div id="join_info">
                <h2>회원 정보 입력</h2>
                <div class="box-body">
                    <dl class="row">
                        <dd class="col-xs-12">
                            <label for="reg_mb_id">이메일</label>
                            <input type="text" name="mb_id" value="<?php echo $member['mb_id'] ?>" id="reg_mb_id" class="regist-input <?php if ($w == "u") echo "readonly"; ?>" placeholder="이메일" <?php if ($w == "u") echo "readonly"; ?>>
                        </dd>
                        <dd class="status_ico" id="reg_mb_id_status"><i class="fas fa-check"></i></dd>
                        <dd class="error col-xs-12" id="reg_mb_id_err"></dd>
                    </dl>

                    <dl class="row">
                        <dd class="col-xs-12">
                            <label for="reg_mb_password">비밀번호</label>
                            <input type="password" name="mb_password" id="reg_mb_password" class="regist-input" minlength="4" maxlength="20" placeholder="비밀번호">
                        </dd>
                        <dd class="status_ico" id="reg_mb_password_status"><i class="fas fa-lock-open"></i></dd>
                        <dd class="error col-xs-12" id="reg_mb_password_err"></dd>
                    </dl>

                    <dl class="row">
                        <dd class="col-xs-12">
                            <label for="mb_password_re">비밀번호확인</label>
                            <input type="password" name="mb_password_re" id="reg_mb_password_re" class="regist-input" minlength="4" maxlength="20" placeholder="비밀번호확인">
                        </dd>
                        <dd class="status_ico" id="reg_mb_password_re_status"><i class="fas fa-lock"></i></dd>
                        <dd class="error col-xs-12" id="reg_mb_password_re_err"></dd>
                    </dl>

                    <!-- 판매자가입 추가 필드 -->
                    <div id="reg_bis" <?=$w=="u" && $member['mb_level']=="3" ? 'style="display:block;"' : "" ?> >
                        <dl class="row">
                            <dd class="col-xs-12">
                                <label for="reg_mb_name">회사명</label>
                                <input type="text" name="mb_1" value="<?php echo $member['mb_1'] ?>" id="reg_mb_1" class="regist-input" placeholder="회사명" >
                            </dd>
                            <dd class="status_ico" id="reg_mb_1_status"><i class="fas fa-check"></i></dd>
                            <dd class="error col-xs-12" id="reg_mb_1_err"></dd>
                        </dl>

                        <dl class="row">
                            <dd class="col-xs-12">
                                <label for="reg_mb_hp">대표자명</label>
                                <input type="text" name="mb_2" value="<?php echo $member['mb_2'] ?>" id="reg_mb_2" class="regist-input" placeholder="대표자명" style="font-size:0.95em;" maxlength="6">
                            </dd>
                            <dd class="status_ico" id="reg_mb_2_status"><i class="fas fa-check"></i></dd>
                            <dd class="error col-xs-12" id="reg_mb_2_err"></dd>
                        </dl>

                        <dl class="row">
                            <dd class="col-xs-12">
                                <label for="reg_mb_hp">사업자등록번호</label>
                                <input type="text" name="mb_3" value="<?php echo $member['mb_3'] ?>" id="reg_mb_3" class="regist-input" placeholder="사업자등록번호" style="font-size:0.95em;" maxlength="12">
                            </dd>
                            <dd class="status_ico" id="reg_mb_3_status"><i class="fas fa-check"></i></dd>
                            <dd class="error col-xs-12" id="reg_mb_3_err"></dd>
                        </dl>
                    </div>
                    <!-- 판매자가입 추가 필드 -->

                    <dl class="row">
                        <dd class="col-xs-12">
                            <label for="reg_mb_name">이름</label>
                            <input type="text" name="mb_name" value="<?php echo $member['mb_name'] ?>" id="reg_mb_name" class="regist-input" placeholder="이름" <?php if ($w == "u") echo "readonly"; ?>>
                        </dd>
                        <dd class="status_ico" id="reg_mb_name_status"><i class="fas fa-check"></i></dd>
                        <dd class="error col-xs-12" id="reg_mb_name_err"></dd>
                    </dl>

                    <dl class="row">
                        <dd class="col-xs-12">
                            <label for="reg_mb_hp">휴대번호</label>
                            <input type="tel" name="mb_hp" value="<?php echo $member['mb_hp'] ?>" id="reg_mb_hp" class="regist-input" placeholder="휴대번호" style="font-size:0.95em;" maxlength="13">
                        </dd>
                        <dd class="status_ico" id="reg_mb_hp_status"><i class="fas fa-check"></i></dd>
                        <dd class="error col-xs-12" id="reg_mb_hp_err"></dd>
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
                                <label for="reg_req1">이용약관 동의 (필수)</label>
                            </dd>
                            <dd class="col-xs-3 text-right"><input type="button" value="내용보기" class="btn btn-agr"></dd>
                            <dd class="col-xs-12 agr_textarea"><textarea readonly><?php echo get_text($config['cf_stipulation']) ?></textarea></dd>
                        </dl>

                        <dl class="row agree-row">
                            <dd class="col-xs-9" data-for="reg_req2">
                                <input type="checkbox" name="reg_req[]" id="reg_req2" value="0" onclick="ag_check(this)">
                                <label for="reg_req2">개인정보처리방침 동의 (필수)</label>
                            </dd>
                            <dd class="col-xs-3 text-right"><input type="button" value="내용보기" class="btn btn-agr"></dd>
                            <dd class="col-xs-12 agr_textarea"><textarea readonly><?php echo get_text($config['cf_privacy']) ?></textarea></dd>
                        </dl>

                    </div>
                </div><!--//join_chk-->
            <?php } ?>

            <input type="submit" class="btn_submit ft_btn" value="<?php echo $w == '' ? '회원가입' : '정보수정'; ?>" accesskey="s">
        </article>
    </form>
</div>


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

    $("input[name=mb_level]").click(function(e){
        if(e.target.value=="3"){
            document.getElementById("reg_bis").style.display="block";
        }else{
            document.getElementById("reg_bis").style.display="none";
            $("#reg_mb_1,#reg_mb_2,#reg_mb_3").val("");
        }
    });

    // 아이디 체크 (이메일 형식)
    $("#reg_mb_id").keyup(function () {
        var mb_id = $(this);
        var mb_id_id = $(this).attr("id");
        var state = stateChk(mb_id_id); // 상태표시(패스/에러)
        var err = errChk(mb_id_id); // 에러메세지

        // 이메일 정규표현식
        var regEmail = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/;

        if (regEmail.test(mb_id.val())) {
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
        var mb_password_id = $(this).attr("id");
        var mb_password_re_id = mb_password_re.attr("id");
        var state = stateChk(mb_password_id); // 상태표시(패스/에러)
        var err = errChk(mb_password_id); // 에러메세지
        var state2 = stateChk(mb_password_re_id); // 상태표시(패스/에러)
        var err2 = errChk(mb_password_re_id); // 에러메세지

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
        var mb_password_re_id = $(this).attr("id");
        var mb_password_id = mb_password.attr("id");
        var state = stateChk(mb_password_re_id); // 상태표시(패스/에러)
        var err = errChk(mb_password_re_id); // 에러메세지
        var state2 = stateChk(mb_password_id); // 상태표시(패스/에러)
        var err2 = errChk(mb_password_id); // 에러메세지

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
        var mb_name_id = $(this).attr("id");
        var state = stateChk(mb_name_id); // 상태표시(패스/에러)
        var err = errChk(mb_name_id); // 에러메세지

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

    // 사업자번호 자동 하이픈 추가
    $("#reg_mb_3").keyup(function (e){
        this.value = BisAutoHypen(e.target.value);
    });


    // 휴대번호 체크
    $("#reg_mb_hp").keyup(function () {
        var mb_hp = $(this);
        var mb_hp_id = $(this).attr("id");
        var state = stateChk(mb_hp_id); // 상태표시(패스/에러)
        var err = errChk(mb_hp_id); // 에러메세지

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
    if (f.w.value == "") {
        var msg = reg_mb_id_check();
        if (msg) {
            swal(msg);
            f.mb_id.select();
            return false;
        }
    }

    // 비밀번호 검사
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

    // 이름 검사
    if (f.w.value == '') {
        if (f.mb_name.value.length < 1) {
            swal('이름을 입력해 주세요.');
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

    var obj = {};
    var submit = true;
    if (f.w.value == "") obj.reg_mb_id = "이메일을";
    obj.reg_mb_password = "비밀번호를";
    obj.reg_mb_password_re = "비밀번호확인을";
    obj.reg_mb_name = "이름을";
    obj.reg_mb_hp = "휴대번호를";

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
</script>
