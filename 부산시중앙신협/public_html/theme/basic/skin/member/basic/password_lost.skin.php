<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>
<style>
    /*html, body{width:100%;height:100%;min-height:500px;background:url(<?php echo $member_skin_url ?>/img/bg2.jpg) no-repeat center fixed ; background-size:cover; overflow-y:hidden; overflow-x:hidden;}*/
    html, body{width:100%;height:100%;min-height:500px;background:#fff;}
</style>



<!-- 회원정보 찾기 시작 { -->
<div id="find_info" class="mbskin">
    <h1 class="text-center b_margin30"><a href="<?php echo G5_URL ?>"><img src="<?php echo G5_THEME_IMG_URL ?>/common/logo.png" alt="로고"></a></h1>
    <h2 id="win_title">회원정보 찾기</h2>
    <!-- 탭메뉴 시작 -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#id-find" aria-controls="id-find" role="tab" data-toggle="tab">아이디찾기</a></li>
        <li role="presentation"><a href="#pass-find" aria-controls="pass-find" role="tab" data-toggle="tab">비번찾기</a></li>
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
                <input type="tel" name="" id="mb_hp1" required class="required frm_input" size="30" placeholder="휴대폰번호">
                <button onclick="id_send_sms();" class="btn_certi btn_black">인증번호 발송</button>
            </fieldset>
            <fieldset id="info_fs">
                <label for="mb_hp">인증번호<strong class="sound_only">필수</strong></label>
                <input type="tel" name="number" id="number" required class="required frm_input" size="30" placeholder="인증번호">
            </fieldset>
            <div class="text-center" id="id-result">

            </div>
            <div class="win_btn">
                <button type="button" class="btn03 btn_color" id="id-btn">확인</button>
                <button type="button" onclick="javascript:history.back();" class="btn01 btn_gray">뒤로</button>
            </div>
        </div>
        <!-- 아이디 찾기 내용 끝 -->
        <!-- 비번 찾기 내용 시작 -->
        <div role="tabpanel" class="tab-pane" id="pass-find">
            <form name="fpasswordlost" action="<?php echo $action_url ?>" onsubmit="return fpasswordlost_submit(this);" method="post" autocomplete="off">
                <fieldset id="info_fs">
                    <label for="mb_name">아이디<strong class="sound_only">필수</strong></label>
                    <input type="text" name="mb_id" id="mb_id" required class="required frm_input" size="30" placeholder="아이디">
                </fieldset>

                <fieldset id="info_fs">
                    <label for="mb_hp">휴대폰번호<strong class="sound_only">필수</strong></label>
                    <input type="tel" name="mb_hp" id="mb_hp2" required class="required frm_input" size="30" placeholder="휴대폰번호">
                </fieldset>

                <div class="win_btn">
                    <input type="button" onclick="pw_send_sms()" value="임시비밀번호 발송" class="btn03 btn_color">
                    <button type="button" onclick="javascript:history.back();" class="btn01 btn_gray">뒤로</button>
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
    <?php echo captcha_html();  ?>
    <div class="win_btn">
        <input type="submit" value="확인" class="btn_submit">
        <button type="button" onclick="javascript:history.back();" class="btn01">뒤로</button>
    </div>
    </form>-->
</div>
<script type="text/javascript">
    $(function(){
        $('#myTab a:last').tab('show')
        $("#id-btn").click(function(){
            if($("#number").val().length<1){
                alert("인증번호를 입력하세요");
                return false;
            }

            $.ajax({
                url:"./ajax.mb_id.find.php",
                data:{"mb_name":$("#mb_name1").val(),"mb_hp":$("#mb_hp1").val(), "number" : $("#number").val()},
                dataType:"json",
                type:"POST",
                success:function(data){
                    if (data.msg == 'success') {
                        $("#id-result").html(data.id);
                    }else{
                        $('#number').val("");
                        $('#id-result').html("");
                        swal(data.msg);
                    }
                },
                error:function(request,status,error){
                    alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
                }
            });
        });

    });

</script>

<script>
    function fpasswordlost_submit(f)
    {
        if($("#mb_id").val().length<1){
            alert("아이디를 입력하세요");
            return false;
        }

        if($("#mb_hp2").val().length<1){
            alert("휴대폰번호를 입력하세요");
            return false;
        }
        if($("#mb_email").val().length<1){
            alert("이메일주소를 입력하세요");
            return false;
        }
        return true;
    }

    $(function() {
        var sw = screen.width;
        var sh = screen.height;
        var cw = document.body.clientWidth;
        var ch = document.body.clientHeight;
        var top  = sh / 2 - ch / 2 - 100;
        var left = sw / 2 - cw / 2;
        moveTo(left, top);
    });

    function id_send_sms(){

        // $('#mb_hp').attr('readonly', true); // 인증 번호 발송 후 휴대폰 번호 수정 불가 처리
        if($("#mb_name1").val().length<1){
            swal("이름을 입력하세요");
            return false;
        }
        if($("#mb_hp1").val().length<1){
            swal("휴대폰 번호를 입력하세요");
            return false;
        }

        $.ajax({
            type: "POST",
            url: g5_bbs_url+"/ajax.sms_register.php",
            data: {
                "mb_name": $("#mb_name1").val(),
                "mb_hp": $("#mb_hp1").val(),
                "mode" : "sms_send",
                "type" : "id"
            },
            dataType: "json",
            success: function(data) {


                if (data['msg'] != 'sms_ok'){
                    swal(data['msg']);
                }else{
                    swal(data['swal_msg']);
                    $('#mb_hp1').attr('readonly', true);
                }


            }
        });
    }
    function pw_send_sms(){

        // $('#mb_hp').attr('readonly', true); // 인증 번호 발송 후 휴대폰 번호 수정 불가 처리
        if($("#mb_id").val().length<1){
            swal("아이디를 입력하세요");
            return false;
        }
        if($("#mb_hp2").val().length<1){
            swal("휴대폰 번호를 입력하세요");
            return false;
        }

        $.ajax({
            type: "POST",
            url: g5_bbs_url+"/ajax.sms_register.php",
            data: {
                "mb_id": $("#mb_id").val(),
                "mb_hp": $("#mb_hp2").val(),
                "mode" : "sms_send",
                "type" : "pw"
            },
            dataType: "json",
            success: function(data) {
                console.log(data.swal_msg);


                if (data.msg != 'sms_ok'){
                    swal(data.swal_msg);
                }else{
                    swal(data.swal_msg).then(function(){
                        window.close();
                    });
                }


            }
        });
    }
</script>
<!-- } 회원정보 찾기 끝 -->