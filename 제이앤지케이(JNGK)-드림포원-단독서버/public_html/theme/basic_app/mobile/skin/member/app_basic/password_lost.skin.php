<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="' . $member_skin_url . '/style.css">', 0);
?>
<style>

</style>
<!-- 회원정보 찾기 시작 { -->
<div id="find_info" class="mbskin">
    <h1 id="win_title">회원정보 찾기</h1>
    <!-- 탭메뉴 시작 -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#id-find" aria-controls="id-find" role="tab" data-toggle="tab">아이디찾기</a>
        </li>
        <li role="presentation"><a href="#pass-find" aria-controls="pass-find" role="tab" data-toggle="tab">비밀번호찾기</a>
        </li>
    </ul>
    <!-- 탭메뉴 끝 -->
    <!-- 탭 내용 시작-->
    <div class="tab-content">
        <!-- 아이디 찾기 내용 시작-->
        <div role="tabpanel" class="tab-pane active" id="id-find">
            <fieldset id="info_fs">
                <label for="mb_name">이름<strong class="sound_only">필수</strong></label>
                <input type="text" name="" id="mb_name1" required class="required frm_input" size="30" placeholder="이름">
            </fieldset>
            <fieldset id="info_fs">
                <label for="mb_hp">휴대폰번호<strong class="sound_only">필수</strong></label>
                <input type="tel" name="" id="mb_hp1" required class="required frm_input" size="30" placeholder="휴대폰번호" onkeyup="only_number(this);" maxlength="11">
            </fieldset>

            <div class="text-center" id="id-result"></div>

            <div class="win_btn">
                <button type="button" class="btn03" id="id-btn">확인</button>
                <button type="button" onclick="javascript:history.back();" class="btn01">뒤로</button>
            </div>
        </div>
        <!-- 아이디 찾기 내용 끝 -->
        <!-- 비번 찾기 내용 시작 -->
        <div role="tabpanel" class="tab-pane" id="pass-find">
            <form name="fpasswordlost" action="<?php echo $action_url ?>" onsubmit="return fpasswordlost_submit(this);"
                  method="post" autocomplete="off">
                <fieldset id="info_fs">
                    <label for="mb_id">아이디<strong class="sound_only">필수</strong></label>
                    <input type="text" name="mb_id" id="mb_id" required class="required frm_input" size="30" placeholder="아이디">
                </fieldset>

                <fieldset id="info_fs">
                    <label for="mb_name">이름<strong class="sound_only">필수</strong></label>
                    <input type="text" name="mb_name2" id="mb_name2" required class="required frm_input" size="30" placeholder="이름">
                </fieldset>

                <!--<fieldset id="info_fs">
                    <label for="mb_hp2">휴대폰번호<strong class="sound_only">필수</strong></label>
                    <input type="tel" name="mb_hp2" id="mb_hp2" required class="required frm_input" size="30" placeholder="휴대폰번호" onkeyup="only_number(this);" maxlength="11">
                </fieldset>-->

                <fieldset id="info_fs">
                    <label for="mb_email">이메일<strong class="sound_only">필수</strong></label>
                    <input type="text" name="mb_email" id="mb_email" required class="required frm_input email" size="30" placeholder="이메일">
                    * 임시 비밀번호를 받을 이메일 주소
                </fieldset>

                <div class="text-center" id="passwd-result"></div>

                <div class="win_btn">
                    <button type="button" value="확인" class="btn03" id="passwd-btn">확인</button>
                    <button type="button" onclick="javascript:history.back();" class="btn01">뒤로</button>
                    <button type="button" class="btn03 login hide" id="login">로그인</button>
                </div>
            </form>
        </div>
        <!-- 비번 찾기 내용 끝 -->
    </div>
    <!-- 탭내용 끝 -->
    <!--<form name="fpasswordlost" action="<?php echo $action_url ?>" onsubmit="return fpasswordlost_submit(this);" method="post" autocomplete="off">
    <fieldset id="info_fs">
        <p>
            회원가입 시 등록하신 이메일 주소를 입력해 주세요.<br>
            해당 이메일로 아이디와 비밀번호 정보를 보내드립니다.
        </p>
        <label for="mb_email">E-mail 주소<strong class="sound_only">필수</strong></label>
        <input type="text" name="mb_email" id="mb_email" required class="required frm_input email" size="30" placeholder="E-mail 주소">
    </fieldset>
    <?php echo captcha_html(); ?>
    <div class="win_btn">
        <input type="submit" value="확인" class="btn_submit">
        <button type="button" onclick="javascript:history.back();" class="btn01">뒤로</button>
    </div>
    </form>-->
</div>
<script type="text/javascript">
    $(function () {
        $('#myTab a:last').tab('show')
        $("#id-btn").click(function () {
            if ($("#mb_name1").val().length < 1) {
                swal("이름을 입력하세요");
                return false;
            }

            if ($("#mb_hp1").val().length < 1) {
                swal("휴대폰 번호를 입력하세요");
                return false;
            }

            $.ajax({
                url: "./ajax.mb_id.find.php",
                data: {"mb_name": $("#mb_name1").val(), "mb_hp": $("#mb_hp1").val()},
                dataType: "html",
                type: "POST",
                success: function (data) {
                    $("#id-result").html(data);
                },
                error: function (request, status, error) {
                    swal("code:" + request.status + "\n" + "message:" + request.responseText + "\n" + "error:" + error);
                }
            });
        });

        $('#passwd-btn').click(function() {
            if ($("#mb_id").val().length < 1) {
                swal("아이디를 입력하세요");
                return false;
            }

            if ($("#mb_name2").val().length < 1) {
                swal("이름을 입력하세요");
                return false;
            }

            // if ($("#mb_hp2").val().length < 1) {
            //     swal("휴대폰번호를 입력하세요");
            //     return false;
            // }

            if ($("#mb_email").val().length < 1) {
                swal("이메일주소를 입력하세요");
                return false;
            }

            $.ajax({
                url: "./ajax.mb_id.find.php",
                data: {"mb_id": $("#mb_id").val(), "mb_name": $("#mb_name2").val(), "mb_hp": $("#mb_hp2").val(), "mb_email": $("#mb_email").val(), "mode": 'password'},
                dataType: "html",
                type: "POST",
                success: function (data) {
                    $("#passwd-result").html('');
                    if(data == '해당정보가 없거나 또는 잘못 정보를 입력하셨습니다.') {
                        $("#passwd-result").html(data);
                    } else {
                        swal(data).then(() => { location.href = g5_bbs_url+'/login.php'; });
                    }
                },
                error: function (request, status, error) {
                    swal("code:" + request.status + "\n" + "message:" + request.responseText + "\n" + "error:" + error);
                }
            });
        });
    });
</script>

<script>
    function fpasswordlost_submit(f) {
        if ($("#mb_id").val().length < 1) {
            swal("아이디를 입력하세요");
            return false;
        }

        if ($("#mb_hp2").val().length < 1) {
            swal("휴대폰번호를 입력하세요");
            return false;
        }

        if ($("#mb_email").val().length < 1) {
            swal("이메일주소를 입력하세요");
            return false;
        }
        return true;
    }

    $(function () {
        var sw = screen.width;
        var sh = screen.height;
        var cw = document.body.clientWidth;
        var ch = document.body.clientHeight;
        var top = sh / 2 - ch / 2 - 100;
        var left = sw / 2 - cw / 2;
        moveTo(left, top);
    });

    function password_mail_send() {
        // 입력 이메일
        var mb_id = $('#mb_id').val().replace(/\s/g,"");

        // 이메일 공란 체크
        if(mb_id == ''){
            swal('이메일 주소를 입력해주세요.');
            $('#mb_id').focus();
            return;
        }
        // 이메일 형식 체크
        var data = /^([0-9a-zA-Z_\.-]+)@([0-9a-zA-Z_-]+)(\.[0-9a-zA-Z_-]+){1,2}$/;

        if(mb_id.search(data) != -1){
            $.ajax({
                url: './password_mail_send.php',
                type: 'POST',
                data: {
                    reg_mb_email : $('#mb_email').val()
                },
                dataType: 'html',
                success: function(data){
                    // 메일 발송 성공
                    if(data == 'S00') {
                        swal('임시 비밀번호가 발송되었습니다.');

                        $('#password-result').html('임시 비밀번호가 발송되었습니다.\n발급된 임시 비밀번호로 로그인하세요.');
                    }
                    if(data == 'no') {
                        $('#password-result').html('입력한 이메일을 찾을 수 없습니다.');
                        // swal('입력한 이메일을 찾을 수 없습니다.');
                    }
                }
            });
        }else{
            swal('이메일 형식이 올바르지 않습니다.');
            $('#mb_email').focus();
            return;
        }
    }
</script>
<!-- } 회원정보 찾기 끝 -->
