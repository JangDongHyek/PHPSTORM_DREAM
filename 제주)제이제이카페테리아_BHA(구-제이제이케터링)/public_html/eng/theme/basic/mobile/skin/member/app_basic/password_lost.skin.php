<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>
<style>
	
</style>
<!-- 회원정보 찾기 시작 { -->
<div id="find_info" class="mbskin">
    <h1 id="win_title">Find Member Information</h1>
	<!-- 탭메뉴 시작 -->
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active"><a href="#id-find" aria-controls="id-find" role="tab" data-toggle="tab">Find ID</a></li>
		<li role="presentation"><a href="#pass-find" aria-controls="pass-find" role="tab" data-toggle="tab">Find PW</a></li>
	</ul>
	<!-- 탭메뉴 끝 -->
	<!-- 탭 내용 시작-->
	<div class="tab-content">
	  <input type="checkbox" name="mb_level" value="2" id="mb-level"><label for="mb-level">Find Student ID/PW</label><br/>
	  <sub>If you are a student, you must check the check box above</sub>
	  <script type="text/javascript">
		var isLevelChecked=false;
		$(function(){
			$("#mb-level").click(function(){
				$(this).prop("checked")?$("#field1").html("생년월일"):$("#field1").html("휴대폰번호");
				$(this).prop("checked")?$("#mb_val1").attr("placeholder","생년월일"):$("#mb_val1").attr("placeholder","휴대폰번호");
				$(this).prop("checked")?$("#field").val("mb_birth"):$("#field").val("mb_hp");
				$(this).prop("checked")?$("#field-2").val("mb_birth"):$("#field").val("mb_hp");
				$(this).prop("checked")?$("#field2").html("생년월일"):$("#field2").html("휴대폰번호");
				$(this).prop("checked")?$("#mb_val2").attr("placeholder","생년월일"):$("#mb_val2").attr("placeholder","휴대폰번호");
				
			});
		});
	  </script>
	  <input type="hidden" name="field" value="mb_hp" id="field">

	  <!-- 아이디 찾기 내용 시작-->
	  <div role="tabpanel" class="tab-pane active" id="id-find">
		<fieldset id="info_fs">
			<label for="mb_name">이름<strong class="sound_only">필수</strong></label>
			<input type="text" name="" id="mb_name1" required class="required frm_input" size="30" placeholder="Name">
		</fieldset>
		<fieldset id="info_fs" class="mb-hp">
			<label for="mb_hp" id="field1">휴대폰번호<strong class="sound_only">필수</strong></label>
			<input type="text" name="" id="mb_val1" required class="required frm_input" size="30" placeholder="Phone Number">
		</fieldset>	
		<div class="text-center" id="id-result">
			
		</div>
		<div class="win_btn">
			<button type="button" class="btn03" id="id-btn">Submit</button>
			<button type="button" onclick="javascript:history.back();" class="btn01">Back</button>
		</div>
	  </div>
	  <!-- 아이디 찾기 내용 끝 -->
	  <!-- 비번 찾기 내용 시작 -->
	  <div role="tabpanel" class="tab-pane" id="pass-find">
		<form name="fpasswordlost" action="<?php echo $action_url ?>" onsubmit="return fpasswordlost_submit(this);" method="post" autocomplete="off">
		<input type="hidden" name="field2" id="field-2" value="mb_hp">
		<fieldset id="info_fs">
			<label for="mb_name">아이디<strong class="sound_only">필수</strong></label>
			<input type="text" name="mb_id" id="mb_id" required class="required frm_input" size="30" placeholder="ID">
		</fieldset>
		<fieldset id="info_fs">
			<label for="mb_hp" id="field2">휴대폰번호<strong class="sound_only">필수</strong></label>
			<input type="tel" name="mb_val2" id="mb_val2" required class="required frm_input" size="30" placeholder="Phone Number">
		</fieldset>
		<fieldset id="info_fs">
			<label for="mb_email">E-mail 주소<strong class="sound_only">필수</strong></label>
			<input type="text" name="mb_email" id="mb_email" required class="required frm_input email" size="30" placeholder="E-mail Address">
		</fieldset>
		<div class="win_btn">
			<input type="submit" value="Submit" class="btn03">
			<button type="button" onclick="javascript:history.back();" class="btn01">Back</button>
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
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script type="text/javascript">
$(function(){
	$('#myTab a:last').tab('show')
	$("#id-btn").click(function(){
		if($("#mb_name1").val().length<1){
			alert("이름을 입력하세요");
			return false;
		}
		var msg=$("#mb-level").prop("checked")?"생년월일을":"휴대폰 번호를";
		if($("#mb_val1").val().length<1){
			alert(msg+" 입력하세요");
			return false;
		}
		$.ajax({
			url:"./ajax.mb_id.find.php",
			data:{"mb_name":$("#mb_name1").val(),"field":$("#field").val(),"mb_val":$("#mb_val1").val()},
			dataType:"html",
			type:"POST",
			success:function(data){
				$("#id-result").html(data);
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
	var msg=$("#mb-level").prop("checked")?"생년월일을":"휴대폰 번호를";
		
	if($("#mb_val2").val().length<1){
		alert(msg+" 입력하세요");
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
</script>
<!-- } 회원정보 찾기 끝 -->