<? 
include_once("./_common.php");

$g5['title'] = '정보수정';
$pid = "modify_info";
include_once('./_head.php');
$w = "u";

$register_action_url = G5_BBS_URL.'/register_form_update.php';
?>
<link rel="stylesheet" href="<?=G5_BBS_URL?>/style.css?v=<?=G5_CSS_VER?>">
<style>
    @media (max-width:768px) {
        .btm_nav_box .link_title.ver2 {
            margin-bottom: 20px;
        }
    }

</style>

<div class="autoW bdpd">
    <div id="mypage_wrap" class="">
        <?php include_once('./mypage_left_menu.php'); ?>
        <div class="con_wrap">
            <div id="join_info">
                <form action="<?php echo $register_action_url ?>" onsubmit="return fregisterform_submit(this);" method="post" >
                    <input type="hidden" name="w" value="u">
                    <div class="box-body">
                        <dl class="row_wrap">
                            <dd class="">
                                <label for="reg_mb_id" class="sound_only">아이디</label>
                                <input type="text" name="mb_id" value="<?php echo $member['mb_id'] ?>" id="reg_mb_id" class="regist-input <?php echo $required ?> <?php if($w=="u") echo "readonly";?>" minlength="3" maxlength="20" <?php echo $required ?> placeholder="아이디를 입력하세요" <?php if($w=="u") echo "readonly";?>>
                            </dd>
                            <dd class="error status_ico"></dd>

                        </dl>

                        <dl class="row_wrap">
                            <dd class="">
                                <label for="reg_mb_password" class="sound_only">비밀번호</label>
                                <input type="password" name="mb_password" id="reg_mb_password" class="regist-input <?php echo $required ?>" minlength="4" maxlength="20" <?php echo $required ?> placeholder="비밀번호를 입력하세요">
                            </dd>
                            <dd class="error status_ico"></dd>
                        </dl>

                        <dl class="row_wrap">
                            <dd class="">
                                <label for="mb_password_re" class="sound_only">비밀번호확인</label>
                                <input type="password" name="mb_password_re" id="reg_mb_password_re" class="regist-input <?php echo $required ?>" minlength="4" maxlength="20" <?php echo $required ?> placeholder="비밀번호 한번더 입력하세요">
                            </dd>
                            <dd class="error status_ico"></dd>
                        </dl>

                        <dl class="row_wrap">
                            <dd class="">
                                <label for="reg_mb_name" class="sound_only">이름</label>
                                <input type="text" name="mb_name" value="<?php echo $member['mb_name'] ?>" id="reg_mb_name" class="regist-input required f_empty" required placeholder="이름을 입력하세요">
                            </dd>
                            <dd class="error status_ico"></dd>
                        </dl>

                        <dl class="row_wrap birth_wrap">
                            <dd>
<!--                                <label for="reg_mb_birth" class="sound_only">생년월일</label>-->
                                <div>
									<label>년</label>
									<select name="mb_year">
										<?
										//1940~현재년도까지
										foreach(range(date('Y'), 1940) as $val) echo '<option value="'.$val.'">'.$val.'</option>';

										?>
									</select>
                                </div>
                                <div>
                                <label>월</label>
									<select name="mb_month">
										<?
										//1월부터 12월까지
										foreach(range(1, 12) as $val) echo '<option value="'.sprintf('%02d' , $val).'">'.sprintf('%02d' , $val).'</option>';

										?>
									</select>
                                </div>
                                <div>
                                	<label>일</label>
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

                        <dl class="row_wrap">
                            <dd class="">
                                <label for="reg_mb_sex" class="sound_only">성별</label>
                                <select name="mb_sex" id="reg_mb_sex" class="regist-input required">
                                    <option <? if ($member["mb_sex"] == "남") echo "selected" ?> value="남자">남자</option>
                                    <option <? if ($member["mb_sex"] == "여") echo "selected" ?> value="여자">여자</option>
                                </select>
                            </dd>
                            <dd class="error status_ico"></dd>
                        </dl>

                        <dl class="row_wrap">
                            <dd class="">
                                <label for="reg_mb_hp" class="sound_only">휴대번호</label>
                                <input type="tel" name="mb_hp" value="<?php echo $member['mb_hp'] ?>" id="reg_mb_hp" class="regist-input required" required placeholder="휴대번호를 -없이 입력하세요" style="font-size:0.95em;" minlength="10" maxlength="13">
                            </dd>
                            <dd class="error status_ico"></dd>
                        </dl>
                    </div>
                    <div class="btn_confirm">
                        <input type="submit" value="정보수정" id="btn_submit" class="btn_submit" >
                        <a href="<?php echo G5_URL ?>" class="btn_cancel">취소</a>
                    </div>
                    <a href="./widthdraw.php" class="btn-widthdraw">탈퇴하기</a>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo G5_JS_URL ?>/jquery.register_form.js?ver=2"></script>
<script>
    //숫자및 하이픈
    $(function () {
        $("[name=mb_year]").val("<?=$member['mb_year']?>");
        $("[name=mb_month]").val("<?=$member['mb_month']?>");
        $("[name=mb_day]").val("<?=$member['mb_day']?>");

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

    // submit 최종 폼체크
    function fregisterform_submit(f){
        // 필수 체크박스
        // 조건들 확인


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
        if (f.mb_name.value.length < 1) {
            swal('이름을 입력하십시오.');
            f.mb_name.focus();
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

        <?php /*if($w == ""){ ?>
            if($("#reg_req1").val()!="1"){
                swal("이용약관 동의(필수)를 체크하십시오");
                return false;
            }
            if($("#reg_req2").val()!="1"){
                swal("개인정보처리방침 동의(필수)를 체크하십시오");
                return false;
            }
            <?php }*/ ?>

        return true;
    }


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

</script>

<?php
include_once('./_tail.php');
?>
