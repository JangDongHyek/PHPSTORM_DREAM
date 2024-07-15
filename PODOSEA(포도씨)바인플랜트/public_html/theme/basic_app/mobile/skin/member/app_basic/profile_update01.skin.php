 <?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css?v='.G5_CSS_VER.'">', 0);

?>
<script src="<?php echo G5_JS_URL ?>/jquery.register_form.js"></script>
<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>


<div class="mbskin">

    <form name="fregisterform" id="fregisterform" action="<?php echo $register_action_url ?>" onsubmit="return fregisterform_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
    <input type="hidden" name="w" value="<?php echo $w;?>">
    <input type="hidden" name="url" value="<?php echo $urlencode ?>">
	<input type="hidden" name="mb_level" id="mb_level" value="<? if($w == '') { echo $mb_level; } else { echo $member[mb_level]; } ?>">
	<input type="hidden" name="mb_group" value="<?=$mb_group?>">

	<article class="box-article">
		<h2>프로필 업데이트</h2>
		<div id="area_join">
			<div id="join_info">
			<h2>프로필 업데이트</h2>
				<div class="box-body">
					<dl class="row">
						<dt>아이디</dt>
						<dd>
							<div class="input">
								<input type="text" name="mb_id" value="<?php echo $member['mb_id'] ?>" id="reg_mb_id" class="regist-input <?php echo $required ?> <?php if($w=="u") echo "readonly";?>" minlength="3" maxlength="20" <?php echo $required ?> placeholder="아이디를 입력해 주세요." <?php if($w=="u") echo "readonly";?>>
							</div>
						</dd>
						<dd class="error col-xs-12"></dd>
					</dl>

					<dl class="row">
						<dt>비밀번호</dt>
						<dd>
							<div class="input">
								<input type="password" name="mb_password" id="reg_mb_password" class="regist-input <?php echo $required ?>" minlength="4" maxlength="20" <?php echo $required ?> placeholder="비밀번호를 입력해 주세요.">
							</div>
						</dd>
						<dd class="error col-xs-12"></dd>
					</dl>

					<dl class="row password">
						<dt>비밀번호확인</dt>
						<dd>
							<div class="input">
								<input type="password" name="mb_password_re" id="reg_mb_password_re" class="regist-input <?php echo $required ?>" minlength="4" maxlength="20" <?php echo $required ?> placeholder="비밀번호를 한번 더 입력해 주세요.">
							</div>
						</dd>
						<dd class="error col-xs-12"></dd>
					</dl>

					<dl class="row">
						<dt>이름</dt>
						<dd>
							<div class="input">
								<input type="text" name="mb_name" value="<?php echo $member['mb_name'] ?>" id="reg_mb_name" class="regist-input required f_empty <?php if($w=="u") echo "readonly";?>" required <?php if($w=="u") echo "readonly";?> placeholder="이름을 입력해 주세요.">
							</div>
						</dd>
						<dd class="error col-xs-12"></dd>
					</dl>
				
					<dl class="row hp">
						<dt>이메일</dt>
						<dd>
							<div class="input">
								<input type="text" name="mb_email" id="reg_mb_email" class="regist-input required f_empty" minlength="3" maxlength="50" required placeholder="이메일을 입력해 주세요." value="<?php echo $member['mb_email']; ?>">
								<button type="button" class="btn_hp">인증하기</button>
							</div>
						</dd>
						<dd class="error col-xs-12"></dd>
					</dl>

					<dl class="row">
						<dt>휴대번호</dt>
						<dd>
							<div class="input">
								<input type="tel" name="mb_hp" value="<?php echo $member['mb_hp'] ?>" id="reg_mb_hp" class="regist-input required" required placeholder="휴대폰번호를 입력해 주세요." minlength="10" maxlength="13">								
							</div>
						</dd>
						<dd class="error col-xs-12"></dd>
					</dl>

					<dl class="row">
						<dt>사업자등록번호</dt>
						<dd>
							<div class="input">
								<input type="tel" name="mb_company_num" value="<?php echo $member['company_num'] ?>" id="reg_mb_company_num" class="regist-input required" required placeholder="사업자등록번호를 입력해 주세요." minlength="10" maxlength="13">								
							</div>
						</dd>
						<dd class="error col-xs-12"></dd>
					</dl>	
					
					<dl class="row">
						<dt>회사명</dt>
						<dd>
							<div class="input">
								<input type="tel" name="mb_company" value="<?php echo $member['company'] ?>" id="reg_mb_company" class="regist-input required" required placeholder="사업자등록번호를 입력해 주세요." minlength="10" maxlength="13">								
							</div>
						</dd>
						<dd class="error col-xs-12"></dd>
					</dl>
					
					<dl class="row">
						<dt>대표명</dt>
						<dd>
							<div class="input">
								<input type="tel" name="mb_ceo" value="<?php echo $member['ceo'] ?>" id="reg_mb_ceo" class="regist-input required" required placeholder="사업자등록번호를 입력해 주세요." minlength="10" maxlength="13">								
							</div>
						</dd>
						<dd class="error col-xs-12"></dd>
					</dl>
					
					<dl class="row">
						<dt>회사주소</dt>
						<dd>
							<div class="input">	
								<input type="text" name="mb_addr1" id="reg_mb_addr1" class="regist-input required" minlength="3" maxlength="50" required placeholder="주소" value="<?php echo $member['mb_addr1']; ?>">
							<input type="hidden" name="mb_zip" id="reg_mb_zip" value="<?=$member['mb_zip1'].$member['mb_zip2']?>">
							</div>
						</dd>
						<dd class="error col-xs-12"></dd>
					</dl>
					
					<dl class="row">
						<dt>상세주소</dt>
						<dd class="col-xs-11">
							<div class="input">	
							<input type="text" name="mb_addr2" id="reg_mb_addr2" class="regist-input required" minlength="1" maxlength="50" required placeholder="상세주소" value="<?php echo $member['mb_addr2']; ?>">
							</div>
						</dd>
						<dd class="error col-xs-12"></dd>
					</dl>					
				</div>
				
			</div><!--//join_info-->

			
		</div>

		<? if ($w == "") { ?>
		<div id="area_join">
        <div id="join_agr">
        <h2>약관동의</h2>
            <div class="box-body">
                <dl class="row agree-row">
                    <dd class="col-xs-8 chk_ico" data-for="reg_req1">
                        <input type="checkbox" name="reg_req[]" id="reg_req1" value="0" onclick="ag_check(this)">
                        <label for="reg_req1">이용약관 동의 (필수)</label>
                      	<!-- <i></i> 이용약관 동의 (필수) -->
                    </dd>
                    <dd class="col-xs-4 text-right"><input type="button" value="내용보기" class="btn btn-agr"></dd>
                    <dd class="col-xs-12 agr_textarea"><textarea readonly><?php echo get_text($config['cf_stipulation']) ?></textarea></dd>
                </dl>

                <dl class="row agree-row">
                    <dd class="col-xs-9 chk_ico" data-for="reg_req2">
                        <input type="checkbox" name="reg_req[]" id="reg_req2" value="0" onclick="ag_check(this)">
                        <label for="reg_req2">개인정보처리방침 동의 (필수)</label>
                        <!--<i></i> 개인정보처리방침 동의 (필수) -->
                    </dd>
                    <dd class="col-xs-3 text-right"><input type="button" value="내용보기" class="btn btn-agr"></dd>
                    <dd class="col-xs-12 agr_textarea"><textarea readonly><?php echo get_text($config['cf_privacy']) ?></textarea></dd>
                </dl>
            </div>
        </div>
        </div><!--//join_chk-->
		<? } ?>
		
		<div class="btn_confirm">
			<input type="submit" class="btn_submit ft_btn" id="pay_submit" value="<?php echo $w==''?'회원가입 완료!':'정보수정'; ?>" accesskey="s">
		</div>
	</article>
    </form>
</div>

<!-- 다음주소 -->
<div id="layer" style="display:none;position:fixed;overflow:hidden;z-index:1;-webkit-overflow-scrolling:touch;">
	<div class="add_title">
		<h2>주소찾기</h2>
		<div class="btn_close2" onclick="closeDaumPostcode()" alt="닫기 버튼">
			<span></span>
			<span></span>
		</div>
	</div>
	<img src="//t1.daumcdn.net/postcode/resource/images/close.png" id="btnCloseLayer" style="cursor:pointer;position:absolute;right:-3px;top:-3px;z-index:1" onclick="closeDaumPostcode()" alt="닫기 버튼">
</div>


<script>
function ag_check(obj){
	if(obj.value == "0"){
		obj.value = "1";
	}else{
		obj.value = "0";
	}
}

$(function (){
	// 사진첨부클릭
	$("button.btn_photo").on("click", function() { $("#mb_photo").trigger('click') });


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
			err.addClass("on").html("아이디는 영문과 숫자, 3 ~ 15자리까지 가능합니다.");
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
		} else if (mb_password.val().length < 4) {
			state.removeClass("pas").addClass("err");
			err.addClass("on").html("비밀번호를 4자 이상 입력해 주세요.");
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

	$("#reg_mb_name").keyup(function (){
		var mb_name = $(this).val();
		var reg_mb_name = $(this);
		var state = $(this).parents(".row").find(".status_ico");
		var err = $(this).parents(".row").find(".error");

		// 이름 정규표현식
		var regName = /^[가-힣]{2,4}|[a-zA-Z]{2,10}\s[a-zA-Z]{2,10}$/;

		if (regName.test(mb_name)){
			state.removeClass("err").addClass("pas");
			err.html("");
		}else{
			state.removeClass("pas").addClass("err");
			err.addClass("on").html("2글자 이상 한글만 입력해 주세요.");
		}
	});

	$("#reg_mb_hp").keyup(function (){
		var mb_hp = $(this).val();
		var reg_mb_hp = $(this);
		var state = $(this).parents(".row").find(".status_ico");
		var err = $(this).parents(".row").find(".error");

		// 휴대폰 정규표현식
		// /^01([0|1|6|7|8|9]?)-?([0-9]{3,4})-?([0-9]{4})$/
		//var regHp = /^\d{10,12}$/;
        var regHp = /^([0-9]{3,4})-?([0-9]{3,4})-?([0-9]{4})$/;

		if (regHp.test(mb_hp)){
			state.removeClass("err").addClass("pas");
			err.html("");
		}else{
			state.removeClass("pas").addClass("err");
			err.addClass("on").html("휴대폰 번호는 10 ~ 12자리 숫자만 입력해 주세요.");
		}

	}).keydown(function (event) {
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
	});

	$("#reg_mb_addr1").on("focusin", execDaumPostcode);

	$("#reg_mb_addr2").keyup(function (){
		var state = $(this).parents(".row").find(".status_ico");
		var err = $(this).parents(".row").find(".error");
		if ($(this).val().length > 0) {
			state.removeClass("err").addClass("pas");
			err.html("");
		} else {
			state.removeClass("pas").addClass("err");
			err.addClass("on").html("상세주소를 입력해 주세요.");
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

	/*
	// 라디오 버튼
	$("#dd_type p").click(function (){
		var v = $(this).data("val");
		$("#mb_type").val(v);
		$("#dd_type p").find("i").removeClass("fa-check-circle-o").addClass("fa-circle-o");
		$(this).find("i").removeClass("fa-circle-o").addClass("fa-check-circle-o");
	});
	*/

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

// 파일업로드 미리보기
function getImgPrev(input) {
	if (detectIE() < 10) { // 익스
		alert("익스플로러 9이하는 지원하지 않습니다. 익스플로러 10이상 또는 크롬브라우저를 사용하세요.");
		$("#mb_photo").replaceWith($("#mb_photo").clone(true));
		$(input).val("");
		return false;
	}

	var reg_ext = /(.*?)\.(jpg|jpeg|png)$/;

	if (!reg_ext.test(input.files[0].name)) {
		alert("이미지만 등록이 가능합니다. (jpg, jpeg, png)");
		if (detectIE() == 10) $(input).attr("type", "hidden").attr("type", "file");
		$(input).val("");
		return false;
	}

	// 최대용량 체크
	var	max_size_mb = 5, //5mb
		max_byte = max_size_mb * 1024 * 1024,
		file_byte = input.files[0].size;
	
	if (file_byte > max_byte) {
		alert("최대 용량 (" + max_size_mb + "mb)을 초과합니다.");
		if (detectIE() == 10) $(input).attr("type", "hidden").attr("type", "file");
		$(input).val("");
		return false;
	}

	// 미리보기
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function(e) {
			var src = e.target.result;
			var tag = '<img src="'+ src +'">';
			tag += '<button type="button" class="btn" onclick="removePhoto()">삭제</button>';

			$(".prev_area").html(tag);
		}
		reader.readAsDataURL(input.files[0]);
	}
}

function removePhoto() {
	$("#mb_photo").val("");
	if (detectIE() == 10) $("#mb_photo").attr("type", "hidden").attr("type", "file");

	$(".prev_area").html("");
	$("#del_mb_photo").val(1);
}


// submit 최종 폼체크
function fregisterform_submit(f){
	// 필수 체크박스
	// 조건들 확인

	// 회원아이디 검사
	if (f.w.value == "") {
		var msg = reg_mb_id_check();
		if (msg) {
			alert(msg);
			f.mb_id.focus();
			return false;
		}
		
		if (f.mb_password.value.length < 4) {
			alert('비밀번호를 4자 이상 입력해 주세요.');
			f.mb_password.focus();
			return false;
		}
	}

	if (f.mb_password.value != f.mb_password_re.value) {
		alert('비밀번호가 같지 않습니다.');
		f.mb_password_re.focus();
		return false;
	}

	if (f.mb_password.value.length > 0) {
		if (f.mb_password_re.value.length < 4) {
			alert('비밀번호를 4자 이상 입력해 주세요.');
			f.mb_password_re.focus();
			return false;
		}
	}

	// 이메일중복체크
	var msg = reg_mb_email_check();
	if (msg) {
		alert(msg);
		f.mb_email.focus();
		return false;
	}

	// 필수필드 입력검사
	var obj = {};
	var submit = true;
	if (f.w.value == "") obj.reg_mb_id = "아이디를";
	obj.reg_mb_password = "비밀번호를";
	obj.reg_mb_password_re = "비밀번호확인를";
	obj.reg_mb_name = "이름을";
	obj.reg_mb_hp = "휴대번호를";
	obj.reg_mb_addr1 = "주소를";
	obj.reg_mb_addr2 = "상세주소를";
	obj.reg_mb_email = "이메일을";

	for (var prop in obj) {
		var el = $('#'+prop);
		if (el.parents(".row").find(".status_ico").hasClass("err") && submit) {
			el.focus();
			submit = false;
		}
	}
	if (!submit) {
		return false;
	}

	if (f.w.value == "") {
		if($("#reg_req1").val()!="1"){
			alert("이용약관 동의(필수)를 체크하세요.");
			return false;
		}
		if($("#reg_req2").val()!="1"){
			alert("개인정보처리방침 동의(필수)를 체크하세요.");
			return false;
		}
	}

	return true;
}

/* 다음주소 */
var element_layer = document.getElementById('layer');

function closeDaumPostcode() {
	element_layer.style.display = 'none';
}

function execDaumPostcode() {
	new daum.Postcode({
		oncomplete: function(data) {
			//console.log(data);
			document.getElementById("reg_mb_addr1").value = data.roadAddress;
			document.getElementById("reg_mb_zip").value = data.zonecode;
			document.getElementById("reg_mb_addr2").focus();

			element_layer.style.display = 'none';
			
			// chk처리
			var state = $("#reg_mb_addr1").parents(".row").find(".status_ico");
			state.removeClass("err").addClass("pas");
		},
		width : '100%',
		height : '100%',
		maxSuggestItems : 5
	}).embed(element_layer);

	element_layer.style.display = 'block';
	initLayerPosition();
}

<?php /*
// 브라우저의 크기 변경에 따라 레이어를 가운데로 이동시키고자 하실때에는
// resize이벤트나, orientationchange이벤트를 이용하여 값이 변경될때마다 아래 함수를 실행 시켜 주시거나,
// 직접 element_layer의 top,left값을 수정해 주시면 됩니다. */ ?>
function initLayerPosition(){
	var width = Math.round($(window).width() * 0.9);
	var height = Math.round($(window).height() * 0.8);
	var borderWidth = 1;

	// 위에서 선언한 값들을 실제 element에 넣는다.
	element_layer.style.width = width + 'px';
	element_layer.style.height = height + 'px';
	element_layer.style.border = borderWidth + 'px solid';
	// 실행되는 순간의 화면 너비와 높이 값을 가져와서 중앙에 뜰 수 있도록 위치를 계산한다.
	element_layer.style.left = (((window.innerWidth || document.documentElement.clientWidth) - width)/2 - borderWidth) + 'px';
	element_layer.style.top = (((window.innerHeight || document.documentElement.clientHeight) - height)/2 - borderWidth) + 'px';
}
</script>
