<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 100);

$frm_step = 1;
$bullet_on = "";		// 회원정보수정시 불릿 on
$imgs_cnt = 0;

// 회원정보 수정시
if ($w == "u") {
	$frm_step = 2;
	$bullet_on = "on";

	$mb_imgs = getMemberImg($member['mb_id']);
	$imgs_cnt = $mb_imgs['cnt'];
}

// KCB 본인확인
$kcb_cert = "F";
if (($w == "u" && $member['mb_certify'] == "Y") || ($w == "u" && $member['mb_birth'] != "")) $kcb_cert = "T";

$kcb_readonly = array();
$kcb_bullet = array();


// 아이티포원 본인인증 pass
//if ($_SERVER['REMOTE_ADDR'] == "59.19.201.109" && $w == "") {
//	$frm_step = 2;
//	$kcb_cert = "T";
//	$member['mb_name'] = "홍길동";
//	$member['mb_sex'] = "남";
//	$member['mb_birth'] = "1990-01-01";
//	$member['mb_hp'] = "000-0000-0000";
//	$member['mb_certify'] = "Y";
//	$member['mb_id'] = "test" . getRandomString(8);
//}

if ($kcb_step == '2')  {			// 본인인증후 kcb_step=2 리턴 (/bbs/kcb/phone_popup3.php)
	$frm_step = 2;
	$kcb_cert = "T";

    // 본인확인 POST log
    $post_string = http_build_query($_POST);
    $post_string .= "&name=" . iconv("euckr","utf-8", $kcb_name);
    sql_query("INSERT INTO g5_log_data SET post_data = '{$post_string}', page = 'join'");
	
	// 본인확인 후 데이터 검사
	if ($kcb_name == "" || $kcb_sex == "" || $kcb_birth == "" || $kcb_hp == "") 
		alert("본인확인 정보를 받아오는데 실패하였습니다. 다시 시도해 주세요.", G5_BBS_URL."/register_form.php");

	// 본인확인 후 휴대폰번호 중복검사
	//$rs = sql_fetch("SELECT COUNT(*) as cnt FROM g5_member WHERE mb_hp = '{$kcb_hp}';");
	// (210309) 중복검사 변경 - 일반,블랙만 (탈퇴는 재가입가능)
	//$rs = sql_fetch("SELECT COUNT(*) as cnt FROM g5_member WHERE mb_hp = '{$kcb_hp}' AND mb_status IN ('일반', '블랙');");
	// (210902) 중복검사 변경 - 일반,블랙만 (탈퇴는 재가입가능) + 본인인증시 휴대폰/생년월일/이름 조건비교 추가
    $kcb_birth_format = substr($kcb_birth, 0, 4)."-".substr($kcb_birth, 4, 2)."-".substr($kcb_birth, 6, 2);
    $kcb_name_utf8 = iconv("euckr","utf-8", $kcb_name);
    //$rs = sql_fetch("SELECT COUNT(*) as cnt FROM g5_member WHERE mb_hp = '{$kcb_hp}' AND mb_status IN ('일반', '블랙') AND mb_birth = '{$kcb_birth_format}' AND mb_name = '{$kcb_name_utf8}'");
	//$hp_cnt = (int)$rs['cnt'];
	//if ($hp_cnt > 0)	alert("이미 가입 된 회원정보 입니다. 로그인 페이지로 이동합니다.", G5_BBS_URL."/login.php");
    // ↑↑↑↑ (210914) 휴대폰번호 중복검사 제거함

    // (210923) 블랙으로 등록된 회원은 가입불가
    $rs = sql_fetch("SELECT COUNT(*) as cnt FROM g5_member WHERE mb_hp = '{$kcb_hp}' AND mb_status = '블랙'");
    if ((int)$rs['cnt'] > 0)    alert("가입이 불가능한 회원정보 입니다. (블랙회원)", G5_URL."/index.php");

	$member['mb_name'] = $kcb_name_utf8;
	$kcb_readonly['mb_name'] = "readonly";
	$kcb_bullet['mb_name'] = "on";

	$member['mb_sex'] = ($kcb_sex == "M")? "남" : "여";
	$kcb_readonly['mb_sex'] = "onclick='return(false);'";
	$kcb_bullet['mb_sex'] = "on";

	$member['mb_birth'] = $kcb_birth_format;
	$kcb_readonly['mb_birth'] = "";
	$kcb_bullet['mb_birth'] = "on";

	$member['mb_hp'] = $kcb_hp;

	$member['mb_certify'] = "Y";
}

// 본인인증한 회원은 성별, 생년월일 변경불가
if ($w == "u" && $member['mb_certify'] == "Y") {
	$kcb_readonly['mb_sex'] = "onclick='return(false);'";
	$kcb_bullet['mb_sex'] = "on";

	$kcb_bullet['mb_birth'] = "on";
}

?>

<style>
#join_wrap i.on {background: #1EC545;}
#join_wrap i.fail {background: #E84438;}
#join_wrap input[type=checkbox], .long input[type=checkbox] {margin: 0;}
</style>

<form name="fregisterform" id="fregisterform" action="<?php echo $register_action_url ?>" onsubmit="return false;" method="post" enctype="multipart/form-data" autocomplete="off">
<input type="hidden" name="w" value="<?php echo $w ?>">
<input type="hidden" name="step" value="<?=$frm_step?>">

    <div class="mbskin" id="join_wrap">
        <div class="j_tab">

            <?
            $step_title = ($w == "")? "STEP 1" : "STEP 2";
            if ((int)$frm_step == 2) $step_title = "STEP 2";
            if ((int)$frm_step == 3) $step_title = "STEP 3";
            $step_class = ($w == "")? "s1" : "s2";
            if ((int)$frm_step == 2) $step_class = "s2";
            else if ((int)$frm_step == 3) $btn_name = "s3";
            ?>

            <a href="<?=G5_URL ?>"><i class="fas fa-arrow-left"></i></a>
            <h6>연인과<br>함께 해요</h6>
            <p class="<?=$step_class?>" id="stepRoute"><?=$step_title?></p>
        </div>

        <!-- step01 본인확인 -->
        <div id="step01">
            <div id="join_info">
                <h2>본인확인</h2>

                <!-- KCB 본인인증 -->
                <input type="hidden" name="mb_certify" value="<?=$member['mb_certify']?>">
                <input type="hidden" name="mb_hp" value="<?=$member['mb_hp']?>">

                <div class="box-body">
                    <input type="button" value="휴대폰 본인인증" class="btn_red" onclick="location.href='./kcb/phone_popup1.php'">
                </div>
                <!-- // KCB 본인인증 -->

            </div><!--//.join_info-->
        </div>
        <!-- // step01 본인확인 -->


    <?/*php } else {?>

<div class="mbskin" id="join_wrap">
	<div class="j_tab">
		<ul> 
			<li <? if ($w == "") echo 'class="current"'; ?>><h3>본인확인</h3></li><!--
			--><li <? if ($w == "u") echo 'class="current"'; ?>><h3>프로필 입력</h3></li><!--
			--><li><h3>이상형 설정</h3></li>
		</ul>
	</div>

	<!-- step01 본인확인 -->
	<div id="step01">
		<div id="join_info">
			<h2>본인확인</h2>
			
			<!-- KCB 본인인증 -->
			<input type="hidden" name="mb_certify" value="<?=$member['mb_certify']?>">
			<input type="hidden" name="mb_hp" value="<?=$member['mb_hp']?>">

			<div class="box-body">
				<dl class="rows long hpc">
					<dt style="width: 140px;"><label for="reg_mb_hp">휴대폰 본인인증<strong class="sound_only">필수</strong></label></dt>
					<dd>
						<input type="button" value="인증하기" class="btn_red" onclick="location.href='./kcb/phone_popup1.php'">
					</dd>
					<dd class="error_msg"></dd>
				</dl>
			</div>
		</div><!--//.join_info-->
	</div>
	<!-- // step01 본인확인 -->

    <?php }*/?>

	<!-- 프로필입력 -->
	<div id="step02">
        <?php
            include_once($member_skin_path."/register_form_step02_renewal.skin.php");
            //include_once($member_skin_path."/register_form_step02.skin.php");
        ?>
	</div>
	<!-- // 프로필입력 -->

	<!-- 이상형설정 -->
	<div id="step03">
		<? include_once($member_skin_path."/register_form_step03.skin.php"); ?>
	</div>
	<!-- // 이상형설정 -->

</div><!-- //mbskin -->

<div class="btn_confirm_join">
	<? 
	$btn_name = ($w == "")? "STEP01 본인확인 완료" : "STEP02 프로필입력 완료"; 
	if ((int)$frm_step == 2) $btn_name = "STEP02 프로필입력 완료"; 
	//else if ((int)$frm_step == 3) $btn_name = "STEP03 이상형설정 완료"; 
	?>
    <? if($frm_step != 1) { ?>
        <input type="button" value="<?=$btn_name?>" id="btn_submit" class="btn_submit" onclick="getSubmit(document.fregisterform);">
    <?}?>

</div>
<div style="height:60px;"></div>
</form>

<link href="<?=G5_ADMIN_URL?>/css/jquery-ui.min.css" rel="stylesheet" />
<script src="<?=G5_ADMIN_URL?>/js/jquery-ui.min.js"></script>
<script src="<?php echo G5_JS_URL ?>/jquery.register_form.js"></script>
<script src="<?=G5_JS_URL?>/sign_up.js?<?=G5_JS_VER?>"></script><!--리뉴얼 회원가입 js-->
<script>
    let kcb_cert = "<?=$kcb_cert?>";
</script>

<?php /*
<!--회원가입 js-->
<script>
var paramGu = "<?=$member['mb_gu']?>";
var month_arr = ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
	day_arr = ['일', '월', '화', '수', '목', '금', '토'];

var auth_num = 0,		// 인증번호
	auth_flag = false;

var kcb_cert = "<?=$kcb_cert?>";

$(function() {
	// step2 노출 - 1)글 수정
	if (document.fregisterform.w.value == "u") {
		$("#step01").hide();
		$("#step02").show();
		fnGetCity();

		// 이미지수정으로 눌러서 들어왔으면 스크롤 이동
		var st = "<?=$_GET['st']?>";
		if (st == "img") {
			var el_top = document.getElementById("bf_wrap").getBoundingClientRect().top,
				hd = document.getElementById("hd_sub").offsetHeight + 20,
				scroll = Math.floor(el_top - hd);

			window.scrollTo(0, scroll);
			$(window).scrollTop(scroll);
			console.log(scroll);
		}
	}

	// step2 노출 - 2)본인확인
	if (document.fregisterform.w.value == "" && kcb_cert == "T") {
		$("#step01").hide();
		$("#step02").show();
		auth_flag = true;
	}

	// 시/도 bind
	$("#reg_mb_si").on("change", fnGetCity);

	// 약관 내용보기 
	$(".btn_agr .btn_red").click(function (){
		var dis = $(this).parents(".agree").find(".agr_textarea").css("display");
		if(dis == "none")
			$(this).parents(".agree").find(".agr_textarea").slideDown(100);
		else
			$(this).parents(".agree").find(".agr_textarea").slideUp(100);
	});
	
	// 약관 전체동의
	$("#agree0").click(function(){
		if($(this).is(":checked") == true){
			$("#agree1, #agree2, #agree3").prop("checked", "checked");
		}else{
			$("#agree1, #agree2, #agree3").prop("checked", "");
		}
	});

    if (kcb_cert != 'T') {
        // 생년월일 달력호출
        $("#reg_mb_birth").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "yy-mm-dd",
            showButtonPanel: true,
            showMonthAfterYear: true,
            monthNames: month_arr,
            monthNamesShort: month_arr,
            dayNames: day_arr,
            dayNamesShort: day_arr,
            dayNamesMin: day_arr,
            yearRange: "1900:<?=date('Y')?>"
        });
    }

	//********** 필드검사 START **********
	// 텍스트
	$(".f_txt").on("keyup", function (){
		var name = $(this).prop("name");
		
		// 수정시 비밀번호체크
		if ($(this).val().length == 0 && document.fregisterform.w.value == "u" && (name == "mb_password" || name == "mb_password_re")) {
			setElementsFlag($(this), "init");
			return false;
		}
		getFrmValid(name);
	});

	// 텍스트-직접입력
	$("input[name=mb_religion_str], input[name=mb_job_str], input[name=mb_body_type_str], input[name=mb_hobby_str], input.step03_txt, input[name=mb_ideal_type_str]").on("keyup", function() {
		var name = $(this).data("name");
		getFrmValid(name);
	});

	// 셀렉트박스
	$(".f_slct").on("change", function() {
		var name = $(this).prop("name");
		getFrmValid(name);
	});

	// 라디오, 체크박스
	$("input[name=mb_sex], input[name=mb_military], input[name=mb_car], input[name='mb_char[]'], input[name=ideal_long_dist], input[name='mb_ideal_type[]']").on("click", function() {
		var name = $(this).prop("name");

		if (name == "mb_char[]") {
			name = "mb_char";
			// 성격 직접입력체크시
			if ($(this).val() == "직접입력") {
				var flag = $(this).prop("checked");
				if (flag) $("input[name=mb_char_str]").removeClass("hide").addClass("show");
				else $("input[name=mb_char_str]").removeClass("show").addClass("hide").val("");
			}
		} else if (name == "mb_ideal_type[]") {
			name = "mb_ideal_type";
			// 성격 직접입력체크시
			if ($(this).val() == "직접입력") {
				var flag = $(this).prop("checked");
				if (flag) $("input[name=mb_ideal_type_str]").removeClass("hide").addClass("show");
				else $("input[name=mb_ideal_type_str]").removeClass("show").addClass("hide").val("");
			}
		}
		getFrmValid(name);
	});
	//********** 필드검사 END **********
});

// 시/도 변경
function fnGetCity() {
	var si = $("#reg_mb_si").val();

	$("#reg_mb_gu").find("option").remove();
	$("#reg_mb_gu").append("<option value=''>구/군 전체</option>");

	if (!si) {
		return false;
	}

	$.ajax({
		type : "GET",
		url : "<?php echo G5_PLUGIN_URL?>/address/address.php",
		dataType : "json",
		data : {"si": si}, 
		success : function(datas){
			var opt_select = "", opt = ""; 

			for(var i = 0; i < datas.length; i++){
				opt_select = (paramGu == datas[i])? "selected" : "";
				opt = "<option value='" + datas[i] + "' " + opt_select + ">" + datas[i] + "</option>";

				$("#reg_mb_gu").append(opt);
			}
		},
		error : function(request,status,error){
			console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
			window.location.reload();
		}
	});
}

// 인증번호발송 (사용X-본인인증으로 바뀜)
// function sendAuthNum() {
// 	getFrmValid('hp_auth');
// }

// 회원등록/수정
function getSubmit(f) {
	var step = parseInt(f.step.value),
		w = f.w.value;

    // 가입경로 필수체크
    if ($("input[name='mb_join_path[]']:checked").length == 0) {
        alert("가입경로를 선택해 주세요.");
        window.scrollTo(0,0);
        return false;
    }

	if (w == "") {
		// 회원가입시 (사용X-본인인증으로 바뀜)
		switch (step) {
			case 1 : 
				// 휴대폰번호 검사
				if (!getFrmValid('mb_hp')) {
					return false;
				}

				var input_auth_num = f.hp_auth.value,
					err = $("#reg_hp_auth").parents("dd").next(".error_msg");

				// 인증번호받기확인
				if ($("#hp_auth_area").css("display") == "none") {
					getFrmValid('hp_auth');
					return false;
				}

				// 인증번호 확인
				if (input_auth_num != auth_num || input_auth_num.length != 6) {
					err.addClass("on").html("인증번호 6자리가 맞지 않습니다.");
					f.hp_auth.focus();
					return false;
				} else {
					err.removeClass("on").html("");
					auth_flag = true;
				}

				if (!auth_flag) {
					err.addClass("on").html("인증번호 6자리가 맞지 않습니다.");
					return false;
				}

				break;

			case 2 :
				// 동의체크
				if (!f.agree1.checked) {
                    window.scrollTo(0,0)
					alert('서비스 이용약관 동의를 체크해주세요.');
					return false;
				}
				if (!f.agree2.checked) {
                    window.scrollTo(0,0)
					alert('개인정보처리방침 동의를 체크해주세요.');
					return false;
				}

				if (!f.agree3.checked) {
                    window.scrollTo(0,0)
					alert('"연인" 소개팅 관련 정보 수신에 대한 동의를 체크해주세요.');
					return false;
				}
				
				var valid_field = ["mb_id", "mb_password", "mb_password_re", "mb_name", "mb_sex", "mb_gu", "mb_birth", "mb_height", "mb_smoking", "mb_job", "mb_char", "mb_body_type", "mb_hobby", "mb_profile", "mb_img"];
				// mb_military, mb_blood_type, mb_car, mb_drinking, mb_religion, mb_edu
				
				for (var field of valid_field) {
					if (!getFrmValid(field)) {
						return false;
					}
				}
				
				break;

			case 3 :
				//var valid_field = ["ideal_age_min", "ideal_long_dist", "ideal_height_min", "ideal_body_type", "ideal_religion", "ideal_drinking", "ideal_smoking", "ideal_char", "ideal_date", "ideal_contents"];
				var valid_field = ["mb_ideal_type"];

				for (var field of valid_field) {
					if (!getFrmValid(field)) {
						return false;
					}
				}

				break;
		}
		
	} else {
		// 회원정보수정시
		switch (step) {
			case 2 :
				var valid_field = ["mb_name", "mb_sex", "mb_gu", "mb_birth", "mb_height", "mb_smoking", "mb_job", "mb_char", "mb_body_type", "mb_hobby", "mb_profile", "mb_img"];
				// mb_military, mb_blood_type, mb_car, mb_drinking, mb_religion, mb_edu

				if (f.mb_password.value.length > 0 || f.mb_password_re.value.length > 0) {
					valid_field.push("mb_password");
					valid_field.push("mb_password_re");
				}

				for (var field of valid_field) {
					if (!getFrmValid(field)) {
						return false;
					}
				}

				break;

			case 3 :
				var valid_field = ["mb_ideal_type"];

				for (var field of valid_field) {
					if (!getFrmValid(field)) {
						return false;
					}
				}

				break
		}
	}

	if (step == 1) {
		f.btn_submit.value = "STEP02 프로필입력 완료";
		$("#step01").slideUp();
		$("#step02").slideDown();

	} else if (step == 2) {
		f.btn_submit.value = "STEP03 이상형설정 완료";
		$("#step02").slideUp();
		$("#step03").slideDown();

	} else {
		$("#loader_wrap").show();
		f.submit();
	}

	step += 1;
	f.step.value = step;

	$(".j_tab li").removeClass("current");
	$(".j_tab li").eq(step-1).addClass("current");
	$(window).scrollTop(0);

	// console.log(">> step" + step);
	$('#stepRoute').text(`STEP ${step}`).removeClass().addClass(`s${step}`);
}

// 필드유효성검사
function getFrmValid(t) {
	var f = document.fregisterform;

	switch (t) {
		case "mb_id" :
			var reg_mb_id = $("#reg_mb_id");
				mb_id = reg_mb_id.val(),
				regId = /^[a-z0-9]{4,12}$/;
			
			if (regId.test(mb_id)){ 
				setElementsFlag(reg_mb_id, "on");
			}else{
				setElementsFlag(reg_mb_id, "off", "아이디는 영문(소문자)와 숫자, 4 ~ 12자리까지 가능합니다.");
				return false;
			}
			
			$.post(g5_bbs_url+"/ajax.mb_register.php", {"type":"mb_id", "val":mb_id}, function (result){
				if(result == "0"){
					setElementsFlag(reg_mb_id, "on");
				}else{
					setElementsFlag(reg_mb_id, "off", "이미 사용 중이거나 탈퇴 된 아이디입니다.");
					return false;
				}
			});
			break;

		case "mb_hp" : 
			var err = $("#reg_mb_hp").parents("dd").next(".error_msg"),
				hp = f.reg_mb_hp.value,
				leng = hp.length,
				result = false;

			if (leng == 0) {
				err.addClass("on").html("휴대폰번호를 입력하세요.");
				f.reg_mb_hp.focus();
				return false;

			} else {
				$.ajax({  
					type : "post",  
					url : g5_bbs_url + "/ajax.mb_hp_chk.php",
					data : {"reg_mb_hp" : hp},
					dataType : "text", 
					async: false,				// 비동기 처리
					success : function(data) {  
						if (data != "T") {
							if (data == "leave") {
								data = "탈퇴된 회원입니다. <a href='./leave.php'>재가입안내 바로가기</a>";
							}
							err.addClass("on").html(data);
							f.reg_mb_hp.focus();
							result = false;
						} else {
							err.removeClass("on").html("");
							result = true;
						}
					},  
					error : function(xhr,status,error) {
						alert("휴대폰번호가 올바르지 않습니다. 다시 시도해 주세요.");
						f.reg_mb_hp.focus();
					}
				});

				return result;
			}
				
			break;

		case "hp_auth" :		// 휴대폰인증체크
			var err = $("#reg_mb_hp").parents("dd").next(".error_msg"),
				hp = f.reg_mb_hp.value,
				leng = hp.length,
				result = false;
		
			if (leng < 10) {
				err.addClass("on").html("휴대폰번호를 정확히 입력하세요.");
				f.reg_mb_hp.focus();
				return false;
			} else {
				err.removeClass("on").html("");
			}

			$.ajax({  
				type : "post",  
				url : g5_bbs_url + "/ajax.mb_hp_auth.php",
				data : {"reg_mb_hp" : hp},
				dataType : "text", 
				async: false,				// 비동기 처리
				success : function(data) {
					console.log(data);
					if (data == "leave") {
						err.addClass("on").html("탈퇴된 회원입니다. <a href='./leave.php'>재가입안내 바로가기</a>");
						f.reg_mb_hp.focus();

					} else {
						auth_num = parseInt(data);
						result = true;
						alert("인증번호가 발송되었습니다.");
						$("#hp_auth_area").slideDown(1000);
						f.hp_auth.focus();
					}
				},  
				error : function(xhr,status,error) {
					alert("인증번호 발송에 실패하였습니다. 다시 시도해 주세요.");
					f.reg_mb_hp.focus();
				}
			});

			return result;
			
			break;

		case "mb_name" :
			var el = $("#reg_mb_name"),
				mb_name = el.val(),
				regName = /^[가-힣]{2,4}|[a-zA-Z]{2,10}\s[a-zA-Z]{2,10}$/;

			if (regName.test(mb_name)){ 
				setElementsFlag(el, "on");
			}else{
				setElementsFlag(el, "off", "2글자 이상 한글만 입력해주세요.");
				return false;
			}
			break;
		
		case "mb_password" :
			var el = $("#reg_mb_password"),
				mb_password = el.val(),
				regPassword = /^[A-Za-z0-9+]*$/; ///^.*(?=^.{8,15}$)(?=.*\d)(?=.*[a-zA-Z])(?=.*[!@#$%^&+=]).*$/;

			if (regPassword.test(mb_password) && mb_password.length > 3){ 
				setElementsFlag(el, "on");
			}else{
				setElementsFlag(el, "off", "비밀번호는 4자 이상 영문, 숫자만 가능합니다.");
				return false;
			}
			break;

		case "mb_password_re" :
			var el = $("#reg_mb_password_re"),
				mb_password_re = el.val(),
				mb_password = $("#reg_mb_password").val();

			if(mb_password == mb_password_re){
				setElementsFlag(el, "on");
			}else{
				setElementsFlag(el, "off", "비밀번호가 일치하지 않습니다.");
				return false;
			}
			break;

		case "mb_sex" :
			var el = $("input[name=mb_sex]");

			if (el.is(":checked") == true) {
				setElementsFlag(el, "on");
			}else{
				setElementsFlag(el, "off", "성별을 선택하세요.");
				return false;
			}
			break;

		case "mb_military" :
			var el = $("input[name=mb_military]");

			if (el.is(":checked") == true) {
				setElementsFlag(el, "on");
			}else{
				setElementsFlag(el, "off", "병역을 선택하세요.");
				return false;
			}
			break;

		case "mb_gu" :
			var si = $("#reg_mb_si"),
				gu = $("#reg_mb_gu");

			if (si.val() != "" && gu.val() != "") {
				setElementsFlag(si, "on");
			} else {
				setElementsFlag(si, "off", "거주지역을 선택하세요.");
				return false;
			}
			break;
		
		case "mb_birth" :
			var el = $("#reg_mb_birth");

			if (el.val() != "") {
				setElementsFlag(el, "on");
			} else {
				setElementsFlag(el, "off", "생년월일을 입력하세요.");
				return false;
			}
			break;
		
		case "mb_height" :
			var el = $("#reg_mb_height");

			if (el.val() != "") {
				setElementsFlag(el, "on");
			} else {
				setElementsFlag(el, "off", "키를 입력하세요.");
				return false;
			}
			break;

		case "mb_blood_type" :
			var el = $("#reg_mb_blood_type");

			if (el.val() != "") {
				setElementsFlag(el, "on");
			} else {
				setElementsFlag(el, "off", "혈액형을 선택하세요.");
				return false;
			}
			break;

		case "mb_smoking" :
			var el = $("#reg_mb_smoking");

			if (el.val() != "") {
				setElementsFlag(el, "on");
			} else {
				setElementsFlag(el, "off", "흡연을 선택하세요.");
				return false;
			}
			break;

		case "mb_car" :
			var el = $("input[name=mb_car]");

			if (el.is(":checked") == true) {
				setElementsFlag(el, "on");
			}else{
				setElementsFlag(el, "off", "자차를 선택하세요.");
				return false;
			}
			break;

		case "mb_drinking" :
			var el = $("#reg_mb_drinking");

			if (el.val() != "") {
				setElementsFlag(el, "on");
			} else {
				setElementsFlag(el, "off", "음주를 선택하세요.");
				return false;
			}
			break;

		case "mb_religion" :
			var el = $("#reg_mb_religion"),
				txt = $("input[name=mb_religion_str]");

			if (el.val() != "") {
				if (el.val() == "직접입력" && txt.val() == "") {
					setElementsFlag(txt, "off", "종교를 입력하세요.");
					return false;
				} 
				setElementsFlag(el, "on");
				
			} else {
				setElementsFlag(el, "off", "종교를 선택하세요.");
				return false;
			}
			break;

		case "mb_edu" :
			var el = $("#reg_mb_edu");

			if (el.val() != "") {
				setElementsFlag(el, "on");
			} else {
				setElementsFlag(el, "off", "학력을 선택하세요.");
				return false;
			}
			break;

		case "mb_job" :
			var el = $("#reg_mb_job"),
				txt = $("input[name=mb_job_str]");

			if (el.val() != "") {
				if (el.val() == "직접입력" && txt.val() == "") {
					setElementsFlag(txt, "off", "직업을 입력하세요.");
					return false;
				} 
				setElementsFlag(el, "on");
				
			} else {
				setElementsFlag(el, "off", "직업을 선택하세요.");
				return false;
			}
			break;

		case "mb_char" :
			var el = $("input[name='mb_char[]']"),
				txt = $("input[name=mb_char_str]"),
				chked = $("input[name='mb_char[]']:checked");

			if ($("#chd").is(":checked") && txt.val() == "") {	// 성격 직접입력 체크시
				setElementsFlag(txt, "off", "성격을 입력하세요.");
				return false;
			}
			if (chked.length < 2) {
				setElementsFlag(el, "off", "성격을 2개 이상 선택하세요.");
				return false;
			} 
			setElementsFlag(el, "on");
			break;

		case "mb_body_type" :
			var el = $("#reg_mb_body_type"),
				txt = $("input[name=mb_body_type_str]");

			if (el.val() != "") {
				if (el.val() == "직접입력" && txt.val() == "") {
					setElementsFlag(txt, "off", "체형을 입력하세요.");
					return false;
				} 
				setElementsFlag(el, "on");
				
			} else {
				setElementsFlag(el, "off", "체형을 선택하세요.");
				return false;
			}
			break;

		case "mb_hobby" :
			var el = $("#reg_mb_hobby"),
				txt = $("input[name=mb_hobby_str]");

			if (el.val() != "") {
				if (el.val() == "직접입력" && txt.val() == "") {
					setElementsFlag(txt, "off", "취미를 입력하세요.");
					return false;
				} 
				setElementsFlag(el, "on");
				
			} else {
				setElementsFlag(el, "off", "취미를 선택하세요.");
				return false;
			}
			break;

		case "mb_profile" :
			var el = $("#reg_mb_profile");

			if (el.val() != "") {
				setElementsFlag(el, "on");
			} else {
				setElementsFlag(el, "off", "내 소개를 입력하세요.");
				return false;
			}
			break;

		case "mb_img" :
			var leng = $("#prev_area .p_box").length;
			if (leng < 2) {
				alert("사진을 2장 이상 등록하셔야 합니다.");
				return false;
			}
			break;

		case "mb_ideal_type" :
			var el = $("input[name='mb_ideal_type[]']"),
				txt = $("input[name=mb_ideal_type_str]"),
				chked = $("input[name='mb_ideal_type[]']:checked");

			if ($("#itp").is(":checked") && txt.val() == "") {	// 이상형설정 직접입력 체크시
				setElementsFlag(txt, "off", "이상형을 입력하세요.");
				return false;
			}
			if (chked.length < 2) {
				setElementsFlag(el, "off", "이상형을 2개 이상 선택하세요.");
				return false;
			} 
			setElementsFlag(el, "on");
			break;

		case "ideal_age_min" :
			var min = $("#ideal_age_min"),
				max = $("#ideal_age_max");

			if (min.val() != "" && max.val() != "") {
				setElementsFlag(min, "on");
			} else {
				var el = (min.val().length != 2)? min : max;
				setElementsFlag(el, "off", "이상형 나이를 입력하세요.");
				return false;
			}
			break;
			
		case "ideal_long_dist" :
			var el = $("input[name=ideal_long_dist]");

			if (el.is(":checked") == true) {
				setElementsFlag(el, "on");
			}else{
				setElementsFlag(el, "off", "장거리 유무를 선택하세요.");
				return false;
			}
			break;

		case "ideal_height_min" :
			var min = $("#ideal_height_min"),
				max = $("#ideal_height_max");

			if (min.val() != "" && max.val() != "") {
				setElementsFlag(min, "on");
			} else {
				var el = (min.val().length != 3)? min : max;
				setElementsFlag(el, "off", "이상형 키를 입력하세요.");
				return false;
			}
			break;

		case "ideal_body_type" :
			var el = $("#ideal_body_type"),
				txt = $("input[name=ideal_body_type_str]");

			if (el.val() != "") {
				if (el.val() == "직접입력" && txt.val() == "") {
					setElementsFlag(txt, "off", "이상형 체형을 입력하세요.");
					return false;
				} 
				setElementsFlag(el, "on");
				
			} else {
				setElementsFlag(el, "off", "이상형 체형을 선택하세요.");
				return false;
			}
			break;

		case "ideal_religion" :
			var el = $("#ideal_religion"),
				txt = $("input[name=ideal_religion_str]");

			if (el.val() != "") {
				if (el.val() == "직접입력" && txt.val() == "") {
					setElementsFlag(txt, "off", "이상형 종교를 입력하세요.");
					return false;
				} 
				setElementsFlag(el, "on");
				
			} else {
				setElementsFlag(el, "off", "이상형 종교를 선택하세요.");
				return false;
			}
			break;

		case "ideal_drinking" :
			var el = $("#ideal_drinking");

			if (el.val() != "") {
				setElementsFlag(el, "on");
			} else {
				setElementsFlag(el, "off", "이상형 음주를 선택하세요.");
				return false;
			}
			break;

		case "ideal_smoking" :
			var el = $("#ideal_smoking");

			if (el.val() != "") {
				setElementsFlag(el, "on");
			} else {
				setElementsFlag(el, "off", "이상형 흡연을 선택하세요.");
				return false;
			}
			break;

		case "ideal_char" :
			var el = $("#ideal_char");

			if (el.val() != "") {
				setElementsFlag(el, "on");
			} else {
				setElementsFlag(el, "off", "해당 내용을 입력하세요.");
				return false;
			}
			break;
		
		case "ideal_date" :
			var el = $("#ideal_date");

			if (el.val() != "") {
				setElementsFlag(el, "on");
			} else {
				setElementsFlag(el, "off", "해당 내용을 입력하세요.");
				return false;
			}
			break;

		case "ideal_contents" :
			var el = $("#ideal_contents");

			if (el.val() != "") {
				setElementsFlag(el, "on");
			} else {
				setElementsFlag(el, "off", "해당 내용을 입력하세요.");
				return false;
			}
			break;
	}
	return true;
}

// 필드유효성검사 결과on,off
function setElementsFlag(el, type, msg) {
	var bullet = el.parents(".rows").find("i"),
		err_msg = el.parents(".rows").find(".error_msg");

	bullet.removeClass();

	if (type == "on") {
		bullet.addClass("on"); //.css("background", "#1EC545");
		err_msg.removeClass("on").html("");
	} else if (type == "init") {
		err_msg.removeClass("on").html("");
	} else {
		bullet.addClass("fail"); //css("background", "#E84438");
		err_msg.addClass("on").html(msg);
		el.focus();
	}
}

// 직접입력 필드체크
function getSelctdChk(el) {
	var input = el.nextSibling.nextSibling;

	if (el.value == "직접입력") {
		input.classList.remove("hide");
		input.classList.add("show");
		input.focus();
	} else {
		input.classList.remove("show");
		input.classList.add("hide");
		input.value = "";
	}
}

// ****************************************************
// 이미지업로드
var file_num = 0;	// 업로드파일 순번

// 이미지업로드 동적생성
function getImgUpload() {
	var area = document.getElementById("img_after"),
		input = document.createElement('input'),
		leng = $("#prev_area .p_box").length;

	file_num = leng;

	if (leng > 4) { // 5장까지
		alert("최대 5장까지 등록 가능합니다.");
		return false;
	}

	input.setAttribute("type", "file");
	input.setAttribute("accept", "image/*");
	input.setAttribute("name", "bf_file[]");
	input.setAttribute("id", "f"+file_num);
	input.setAttribute("onchange", "getImgPrev(this)");

	area.appendChild(input);

	var elem = document.getElementsByName("bf_file[]"),
		eq = elem.length;

	elem[eq-1].click();
}

// 이미지업로드 미리보기
function getImgPrev(input) {
	var reg_ext = /(.*?)\.(jpg|jpeg|png|bmp)$/;

	if (!reg_ext.test(input.files[0].name)) {
		alert("이미지만 등록이 가능합니다. (jpg, jpeg, png, bmp)");
		return false;
	}

	if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function(e) {
			var area = document.getElementById("prev_area"),
				div = document.createElement('div'),
				div_img = document.createElement('div'),
				img = document.createElement('img'),
				btn = document.createElement('button');

			div.setAttribute("class", "p_box");
			div.setAttribute("id", "box"+file_num);

			div_img.setAttribute("class", "img_bd");
			img.setAttribute("class", "p_img");
			img.setAttribute("src", e.target.result);

			btn.setAttribute("type", "button");
			btn.setAttribute("class", "btn");
			btn.setAttribute("onclick", "getImgDel('w', "+ file_num +")");
			btn.innerHTML = "X";

			div_img.appendChild(img);
			div.appendChild(div_img);
			div.appendChild(btn);
			area.appendChild(div);

			file_num++;
		}
		reader.readAsDataURL(input.files[0]);
	}

	
}

// 이미지미리보기/업로드된 이미지 삭제
function getImgDel(mode, idx) {
	if (mode == "w") {
		var input = document.getElementById("f"+idx),
			prev = document.getElementById("box"+idx);

		input.parentNode.removeChild(input);
		prev.parentNode.removeChild(prev);

	} else if (mode == "u") {
		var input = document.getElementById("bf_file_del"+idx),
			prev = document.getElementById("ubox"+idx);

		if (confirm("사진을 삭제하시겠습니까?") == true) {
			input.value = 1;
			prev.parentNode.removeChild(prev);
		} else {
			return false;
		}
	}
}

</script>
*/ ?>