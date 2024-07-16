<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="' . $member_skin_url . '/style.css">', 0);
?>
<!-- 회원정보 찾기 시작 { -->
<div id="find_info" class="mbskin">
    <h1 id="win_title">Find Member Information</h1>
    <!-- 탭메뉴 시작 -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#id-find" aria-controls="id-find" role="tab" data-toggle="tab">ID</a>
        </li>
        <li role="presentation"><a href="#pass-find" aria-controls="pass-find" role="tab" data-toggle="tab">PASSWORD</a>
        </li>
    </ul>
    <!-- 탭메뉴 끝 -->
    <!-- 탭 내용 시작-->
    <div class="tab-content">
        <!-- 아이디 찾기 내용 시작-->
        <div role="tabpanel" class="tab-pane active" id="id-find">
            <!--<fieldset id="info_fs">
                <label for="mb_name">Name<strong class="sound_only">필수</strong></label>
                <input type="text" name="" id="mb_name1" required class="required frm_input" size="30" placeholder="Name">
            </fieldset>-->
            <fieldset id="info_fs">
                <label for="mb_email1">EMAIL<strong class="sound_only">필수</strong></label>
                <input type="text" name="" id="mb_email1" required class="required frm_input" size="30" placeholder="EMAIL">
            </fieldset>
            <div class="text-center" id="id-result"></div><br/>

            <div class="win_btn">
                <button type="button" class="btn03" id="id-btn">Find User ID</button>
                <button type="button" onclick="javascript:history.back();" class="btn01">Back</button>
            </div>
        </div>
        <!-- 아이디 찾기 내용 끝 -->
        <!-- 비번 찾기 내용 시작 -->
        <div role="tabpanel" class="tab-pane" id="pass-find">
            <form name="fpasswordlost" action="<?php echo $action_url ?>" onsubmit="return fpasswordlost_submit(this);"
                  method="post" autocomplete="off">
                <fieldset id="info_fs">
                    <label for="mb_name">ID<strong class="sound_only">필수</strong></label>
                    <input type="text" name="mb_id" id="mb_id" required class="required frm_input" size="30" placeholder="ID">
                </fieldset>
                <fieldset id="info_fs">
                    <label for="mb_email">EMAIL<strong class="sound_only">필수</strong></label>
                    <input type="text" name="mb_email" id="mb_email" required class="required frm_input email" size="30" placeholder="EMAIL">
                </fieldset>

                <div class="win_btn">
                    <input type="submit" value="Find Password" class="btn03">
                    <button type="button" onclick="javascript:history.back();" class="btn01">Back</button>
                </div>
            </form>
        </div>
        <!-- 비번 찾기 내용 끝 -->
    </div>
</div>
<script type="text/javascript">
$(function () {
    $('#myTab a:last').tab('show')
    $("#id-btn").click(function () {
        /*if ($("#mb_name1").val().length < 1) {
            alert("Please enter Name");
            return false;
        }*/
        if ($("#mb_email1").val().length < 1) {
            alert("Please enter Email");
            return false;
        }
        $.ajax({
            url: "./ajax.mb_id.find.php",
            data: {"mb_name": $("#mb_name1").val(), "mb_email": $("#mb_email1").val()},
            dataType: "html",
            type: "POST",
            success: function (data) {
                $("#id-result").html(data);
            },
            error: function (request, status, error) {
                alert("code:" + request.status + "\n" + "message:" + request.responseText + "\n" + "error:" + error);
            }
        });
    });
});
</script>

<script>
function fpasswordlost_submit(f) {
    if ($("#mb_id").val().length < 1) {
        alert("Please enter ID");
        return false;
    }

    if ($("#mb_email").val().length < 1) {
        alert("Please enter Email");
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
</script>
<!-- } 회원정보 찾기 끝 -->
