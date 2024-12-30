<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="' . $member_skin_url . '/style.css?ver=' . G5_CSS_VER . '">', 100);
?>
<style>
    html, body{width:100%;height:100%;min-height:500px;background:url(<?php echo $member_skin_url ?>/img/bg2.jpg) no-repeat center fixed ; background-size:cover; overflow-y:hidden; overflow-x:hidden;}
</style>

<div class="mbskin">
    <script src="<?php echo G5_JS_URL ?>/jquery.register_form.js"></script>
    <?php if ($config['cf_cert_use'] && ($config['cf_cert_ipin'] || $config['cf_cert_hp'])) { ?>
    <script src="<?php echo G5_JS_URL ?>/certify.js"></script>
    <?php } ?>

    <form name="fregisterform" id="fregisterform" action="<?php echo $register_action_url ?>" onsubmit="return fregisterform_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
        <input type="hidden" name="w" value="<?php echo $w; ?>">
        <input type="hidden" name="url" value="<?php echo $urlencode ?>">
        <input type="hidden" name="mb_level" id="mb_level" value="<? if ($w == '') { echo $mb_level; } else { echo $member['mb_level']; } ?>">
        <?php if (isset($member['mb_sex'])) { ?><input type="hidden" name="mb_sex" value="<?php echo $member['mb_sex'] ?>"><?php } ?>

        <article class="box-article">
            <div id="join_info">
                <h2>회원 정보 입력</h2>
                <div class="box-body">
                    <dl class="row">
                        <dd class="col-xs-12">
                            <label for="reg_mb_id">아이디<strong class="sound_only">필수</strong></label>
                            <input type="text" name="mb_id" value="<?php echo $member['mb_id'] ?>" id="reg_mb_id" <?php echo $required ?> <?php echo $readonly ?> class="frm_input <?php echo $required ?> <?php echo $readonly ?>" minlength="3" maxlength="20" placeholder="아이디">
                            <span class="frm_info">영문자, 숫자, _ 만 입력 가능. 최소 3자이상 입력하세요.</span>
                        </dd>
                        <dd class="status_ico"><i class="fas fa-check"></i></dd>
                        <dd class="error col-xs-12"></dd>
                    </dl>

                    <dl class="row">
                        <dd class="col-xs-12">
                            <label for="reg_mb_password">비밀번호</label>
                            <input type="password" name="mb_password" id="reg_mb_password" class="frm_input" minlength="4" maxlength="20" placeholder="비밀번호">
                        </dd>
                        <dd class="status_ico lock_ico1"><i class="fas fa-lock-open"></i></dd>
                        <dd class="error col-xs-12"></dd>
                    </dl>

                    <dl class="row">
                        <dd class="col-xs-12">
                            <label for="mb_password_re">비밀번호확인</label>
                            <input type="password" name="mb_password_re" id="reg_mb_password_re" class="frm_input" minlength="4" maxlength="20" placeholder="비밀번호확인">
                        </dd>
                        <dd class="status_ico lock_ico2"><i class="fas fa-lock"></i></dd>
                        <dd class="error col-xs-12"></dd>
                    </dl>

                    <dl class="row">
                        <dd class="col-xs-12">
                            <label for="reg_mb_name">기업명</label>
                            <input type="text" name="mb_name" value="<?php echo $member['mb_name'] ?>" id="reg_mb_name" class="frm_input" placeholder="기업명" <?php if ($w == "u") echo "readonly"; ?>>
                        </dd>
                        <dd class="status_ico"><i class="fas fa-check"></i></dd>
                        <dd class="error col-xs-12"></dd>
                    </dl>


                    <dl class="row">
                        <dd class="col-xs-12">
                            <label for="reg_mb_hp">전화번호</label>
                            <input type="tel" name="mb_hp" value="<?php echo $member['mb_hp'] ?>" id="reg_mb_hp" class="frm_input" placeholder="휴대번호" maxlength="13">
                        </dd>
                        <dd class="status_ico"><i class="fas fa-check"></i></dd>
                        <dd class="error col-xs-12"></dd>
                    </dl>

                    <dl class="row">
                        <dd class="col-xs-12">
                            <label for="reg_mb_id">이메일</label>
                            <input type="text" name="mb_email" value="<?php echo $member['mb_email'] ?>" id="reg_mb_email" class="frm_input <?php if ($w == "u") echo "readonly"; ?>" placeholder="이메일" <?php if ($w == "u") echo "readonly"; ?>>
                        </dd>
                        <dd class="status_ico"><i class="fas fa-check"></i></dd>
                        <dd class="error col-xs-12"></dd>
                    </dl>

                    <dl class="row">
                        <dd class="col-xs-12">
                            <label for="reg_mb_contact">담당자명</label>
                            <input type="text" name="mb_1" value="<?php echo $member['mb_1'] ?>" id="reg_mb_contact" class="frm_input" placeholder="담당자명" <?php if ($w == "u") echo "readonly"; ?>>
                        </dd>
                        <dd class="status_ico"><i class="fas fa-check"></i></dd>
                        <dd class="error col-xs-12"></dd>
                    </dl>



                </div>
            </div><!--//join_info-->

            <?php if ($w == "") { ?>
                <div id="join_agr">
                    <h2>약관동의</h2>
                    <div class="box-body chk">
                        <dl class="row agree-row">
                            <dd class="col-xs-9" data-for="reg_req1">
                                <input type="checkbox" name="reg_req[]" id="reg_req1" value="1" onclick="ag_check(this)">
                                <label for="reg_req1"><div></div>이용약관 동의 <strong>(필수)</strong></label>
                            </dd>
                            <dd class="col-xs-3 text-right"><input type="button" value="내용보기" class="btn btn-agr"></dd>
                            <dd class="col-xs-12 agr_textarea"><textarea readonly><?php echo get_text($config['cf_stipulation']) ?></textarea></dd>
                        </dl>

                        <dl class="row agree-row">
                            <dd class="col-xs-9" data-for="reg_req2">
                                <input type="checkbox" name="reg_req[]" id="reg_req2" value="1" onclick="ag_check(this)">
                                <label for="reg_req2"><div></div>개인정보처리방침 동의 <strong>(필수)</strong></label>
                            </dd>
                            <dd class="col-xs-3 text-right"><input type="button" value="내용보기" class="btn btn-agr"></dd>
                            <dd class="col-xs-12 agr_textarea"><textarea readonly><?php echo get_text($config['cf_privacy']) ?></textarea></dd>
                        </dl>

                    </div>
                </div><!--//join_chk-->
            <?php } ?>

            <input type="submit" class="btn_submit ft_btn" value="<?php echo $w == '' ? '가입하기' : '정보수정'; ?>" accesskey="s">
            <a href="javascript:history.back();" class="btn_back">뒤로가기</a>
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
    // 아이디 체크 (이메일 형식)
    $("#reg_mb_id").keyup(function (){
        var mb_id = $(this).val();
        var reg_mb_id = $(this);

        // 아이디 정규표현식
        var regId = /^[a-z0-9]{4,12}$/;

        if (regId.test(mb_id)){
            $(this).parents(".row .frm_info").find("i").css("color", "#1EC545");
            $(this).parents(".row").find(".frm_info").html("");
        }else{
            $(this).parents(".row .frm_info").find("i").css("color", "#BC0000");
            $(this).parents(".row").find(".frm_info").css("color", "#395693").html("영문자, 숫자, _ 만 입력 가능. 최소 3자이상 입력하세요.");

            return false;
        }

        // 아작스로 중복 아이디가 있는지 체크 1
        $.post(g5_bbs_url+"/ajax.mb_register.php", {"type":"mb_id", "val":mb_id}, function (result){
            if(result == "0"){  // ajax.mb_register.php 의 echo $row['cnt']; 값을 가져옴
                reg_mb_id.parents(".row").find("i").css("color", "#1EC545"); //될때 초록색 박스 i 는 icon 의 약자
                reg_mb_id.parents(".row").find("dd:last-child").html(""); // 마지막 dd 의 css 스타일 사용
            }else{
                reg_mb_id.parents(".row").find("i").css("color", "#BC0000");
                reg_mb_id.parents(".row").find(".frm_info").css("color", "#BC0000").html("사용중인 아이디입니다.");
            }
        });
    });

    // 비밀번호 체크
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
        var regPassword = /^.*(?=^.{4,15}$)(?=.*\d)(?=.*[a-zA-Z]).*$/;

        if (regPassword.test(mb_password)){
            $(this).parents(".row").find("i").css("color", "#1EC545");
            $(this).parents(".row").find("dd:last-child").html("");
        }else{
            $(this).parents(".row").find("i").css("color", "#BC0000");
            $(this).parents(".row").find("dd:last-child").css("color", "#BC0000").html("비밀번호는 4자~15자 영문,숫자가 포함 되어야 합니다.");
        }
    });

    // 비밀번호확인 체크
    $("#reg_mb_password_re").keyup(function (){
        var mb_password_re = $(this).val();
        var mb_password = $("#reg_mb_password").val();

        // 비밀번호 정규표현식
        var regPassword = /^.*(?=^.{8,15}$)(?=.*\d)(?=.*[a-zA-Z]).*$/;

        if(mb_password == mb_password_re){
            $(this).parents(".row").find("i").css("color", "#1EC545");
            $(this).parents(".row").find("dd:last-child").html("");
        }else{
            $(this).parents(".row").find("i").css("color", "#BC0000");
            $(this).parents(".row").find("dd:last-child").css("color", "#BC0000").html("비밀번호가 다릅니다.");
        }
    });
    // 휴대번호 체크
    $("#reg_mb_hp").keyup(function () {
        var mb_hp = $(this).val();
        var reg_mb_hp = $(this);

        // 휴대폰 정규표현식
        // /^01([0|1|6|7|8|9]?)-?([0-9]{3,4})-?([0-9]{4})$/
        var regHp = /^\d{10,12}$/;
        console.log(regHp.test(mb_hp));
        if (11 < mb_hp.length){
            $(this).parents(".row").find("i").css("color", "#1EC545");
            $(this).parents(".row").find("dd:last-child").html("");
        }else{
            $(this).parents(".row").find("i").css("color", "#BC0000");
            $(this).parents(".row").find("dd:last-child").css("color", "#BC0000").html("휴대폰 번호는 10 ~ 12자리 숫자만 입력하세요.");
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
            alert('비밀번호를 4자 이상 입력해 주세요.');
            f.mb_password.focus();
            return false;
        }
    }

    if (f.mb_password.value != f.mb_password_re.value) {
        alert('비밀번호가 다릅니다.');
        f.mb_password_re.focus();
        return false;
    }

    if (f.mb_password.value.length > 0) {
        if (f.mb_password_re.value.length < 4) {
            alert('비밀번호를 4글자 이상 입력해 주세요.');
            f.mb_password_re.focus();
            return false;
        }
    }

    // 이름 검사
    if (f.w.value == '') {
        if (f.mb_name.value.length < 1) {
            alert('기업명을 입력해 주세요.');
            f.mb_name.focus();
            return false;
        }
    }

    // 휴대번호 검사
    if (f.mb_hp.value.length < 1) {
        alert('휴대번호를 입력해 주세요.');
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
            alert(obj[prop] +' 확인해 주세요.');
            el.focus();
            submit = false;
        }
    }
    if (!submit) {
        return false;
    }

    // 약관 동의 검사
    <?php if($w == "") { ?>
    if($("#reg_req1").prop("checked") === false){
        alert("이용약관 동의(필수)를 체크해 주세요.");
        return false;
    }
    if($("#reg_req2").prop("checked") === false){
        alert("개인정보처리방침 동의(필수)를 체크해 주세요.");
        return false;
    }
    <?php } ?>

    return true;
}
</script>