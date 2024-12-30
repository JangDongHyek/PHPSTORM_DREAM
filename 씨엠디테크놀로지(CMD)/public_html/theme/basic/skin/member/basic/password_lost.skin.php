<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>
<style>
    html, body{width:100%;height:100%;min-height:500px;background:url(<?php echo $member_skin_url ?>/img/bg2.jpg) no-repeat center fixed ; background-size:cover; overflow-y:hidden; overflow-x:hidden;}
</style>

<!-- 회원정보 찾기 시작 { -->
<div id="find_info" class="mbskin">
    <h1 id="win_title">회원정보 찾기</h1>
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
			<input type="text" name="" id="mb_name1" class="frm_input" size="30" placeholder="이름">
		</fieldset>
		<fieldset id="info_fs">
			<label for="mb_hp">휴대번호<strong class="sound_only">필수</strong></label>
			<input type="tel" name="" id="mb_hp1" class="frm_input" size="30" placeholder="휴대번호" onkeyup="onlyNumber(this);" maxlength="11">
		</fieldset>	
		<div class="text-center" id="id-result">
			
		</div>
		<div class="win_btn">
			<button type="button" class="btn_submit" id="id-btn">확인</button>
            <a href="javascript:history.back();" class="btn_back">뒤로가기</a>
		</div>
	  </div>
	  <!-- 아이디 찾기 내용 끝 -->
	  <!-- 비번 찾기 내용 시작 -->
	  <div role="tabpanel" class="tab-pane" id="pass-find">
		<form name="fpasswordlost" action="<?php echo $action_url ?>" onsubmit="return fpasswordlost_submit(this);" method="post" autocomplete="off">
		<fieldset id="info_fs">
			<label for="mb_name">아이디<strong class="sound_only">필수</strong></label>
			<input type="text" name="mb_id" id="mb_id" class="frm_input" size="30" placeholder="아이디">
		</fieldset>

		<fieldset id="info_fs">
			<label for="mb_hp">휴대번호<strong class="sound_only">필수</strong></label>
			<input type="tel" name="mb_hp" id="mb_hp2" class="frm_input" size="30" placeholder="휴대번호" onkeyup="onlyNumber(this);" maxlength="11">
		</fieldset>
		<fieldset id="info_fs">
			<label for="mb_email">이메일<strong class="sound_only">필수</strong></label>
			<input type="text" name="mb_email" id="mb_email" class="frm_input email" size="30" placeholder="이메일">
            * 임시 비밀번호를 받을 이메일 주소
		</fieldset>

		<div class="win_btn">
			<input type="submit" value="확인" class="btn_submit">
		</div>
		</form>
	  </div>
	  <!-- 비번 찾기 내용 끝 -->
	</div>
</div>

<script type="text/javascript">
$(function(){
	$('#myTab a:last').tab('show')
    $("#id-btn").click(function () {
        if ($("#mb_name1").val().length < 1) {
            swal("이름을 입력해 주세요.");
            return false;
        }
        if ($("#mb_hp1").val().length < 1) {
            swal("휴대번호를 입력해 주세요.");
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
});
</script>

<script>
function fpasswordlost_submit(f) {
	if ($("#mb_id").val().length < 1) {
        swal("아이디를 입력해 주세요.");
        return false;
    }
    if ($("#mb_hp2").val().length < 1) {
        swal("휴대번호를 입력해 주세요.");
        return false;
    }
    if ($("#mb_email").val().length < 1) {
        swal("이메일주소를 입력해 주세요.");
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
</script>
<!-- } 회원정보 찾기 끝 -->