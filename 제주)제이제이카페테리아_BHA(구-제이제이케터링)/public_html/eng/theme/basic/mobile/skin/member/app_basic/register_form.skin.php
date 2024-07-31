<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
//include_once($member_skin_path.'/mb.head.php');
?>
<div class="mbskin">
    <script src="<?php echo G5_JS_URL ?>/jquery.register_form.js"></script>
    <?php if($config['cf_cert_use'] && ($config['cf_cert_ipin'] || $config['cf_cert_hp'])) { ?>
    <script src="<?php echo G5_JS_URL ?>/certify.js"></script>
    <?php } ?>

    <form name="fregisterform" id="fregisterform" action="<?php echo $register_action_url ?>" onsubmit="return fregisterform_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
    <input type="hidden" name="w" value="<?php echo $w;?>">
    <input type="hidden" name="url" value="<?php echo $urlencode ?>">
    <input type="hidden" name="cert_type" value="<?php echo $member['mb_certify']; ?>">
    <input type="hidden" name="cert_no" value="">
    <input type="hidden" name="mb_sns_type" value="<?php echo $mb_sns_type;?>">
    <input type="hidden" name="mb_type" id="mb_type" value="<?php echo $mb_type;?>">
	<!--<input type="hidden" name="mb_level" id="mb_level" value="<? if($w == '') { echo $mb_level; } else { echo $member[mb_level]; } ?>">-->
	<?php 
		if($w=="u"){?>
	<input type="hidden" name="mb_level" value="<?php echo $member[mb_level]?>">
	<?php }?>
    <?php if (isset($member['mb_sex'])) { ?><input type="hidden" name="mb_sex" value="<?php echo $member['mb_sex'] ?>"><?php } ?>

	
	<article class="box-article">
		<?php
			if($w==""){?>
    	<h2>Member classification</h2>
        <div class="mem_sel_txt">Please select a member classification first.</div>
 		<div class="mem_select">
        	<ul>
            	<li>
                <div class="radio_ico">
                    <input type="radio" name="mb_level" id="m1"<?php echo $w==""||$member[mb_level]=="2"?" checked":"";?> value="2">
                    <label for="m1"><div>Student</div></label>
                </div>
                </li>
            	<li>
                <div class="radio_ico">
                    <input type="radio" name="mb_level" id="m2" value="3" <?php echo $member[mb_level]=="2"?" checked":"";?>>
                    <label for="m2"><div>Parents</div></label>
                </div>
                </li>
            	<li>
                <div class="radio_ico">
                    <input type="radio" name="mb_level" id="m3" value="4" <?php echo $member[mb_level]=="4"?" checked":"";?>>
                    <label for="m3"><div>Faculty and staff</div></label>
                </div>
                </li>
            </ul>
        </div><!--.mem_select-->   
		<?php }?>
    
    	<div id="join_info" >
		<h2><?php if($w == ""){ ?>Enter Member Information<? }else { ?>Checking and modifying member information<?php } ?> <p><span style="color:#fb2323;">*</span> Required</p></h2>
            <div class="box-body">
                <dl class="row">
                	<dd class="col-xs-1 req">*</dd>
                    <dd class="col-xs-11">
                        <label for="reg_mb_id">ID</label>
                        <input type="text" name="mb_id" value="<?php echo $member['mb_id'] ?>" id="reg_mb_id" class="regist-input <?php echo $required ?> <?php if($w=="u") echo "readonly";?>" minlength="4" <?php echo $required ?> placeholder="ID" <?php if($w=="u") echo "readonly";?>>
                    </dd>
                    <dd class="status_ico"><i class="fas fa-check"></i></dd>
                    <dd class="error col-xs-12"></dd>
                </dl>

                <dl class="row">
                	<dd class="col-xs-1 req">*</dd>
                    <dd class="col-xs-11">
                        <label for="reg_mb_password">PW</label>
                        <input type="password" name="mb_password" id="reg_mb_password" class="regist-input <?php echo $required ?>" minlength="4"  <?php echo $required ?> placeholder="PW">
                    </dd>
                    <dd class="status_ico lock_ico1"><i class="fas fa-lock-open"></i></dd>
                    <dd class="error col-xs-12"></dd>
                </dl>

                <dl class="row">
                	<dd class="col-xs-1 req">*</dd>
                    <dd class="col-xs-11">
                        <label for="mb_password_re">PW Cheick</label>
                        <input type="password" name="mb_password_re" id="reg_mb_password_re" class="regist-input <?php echo $required ?>" minlength="4"  <?php echo $required ?> placeholder="PW Cheick">
                    </dd>
                    <dd class="status_ico lock_ico2"><i class="fas fa-lock"></i></dd>
                    <dd class="error col-xs-12"></dd>
                </dl>

                <dl class="row">
                	<dd class="col-xs-1 req">*</dd>
                    <dd class="col-xs-11">
                        <label for="reg_mb_name">Name</label>
                        <input type="text" name="mb_name" value="<?php echo $member['mb_name'] ?>" id="reg_mb_name" class="regist-input <?php echo $required ?>" <?php echo $required ?> placeholder="Name">
                    </dd>
                    <dd class="status_ico"><i class="fas fa-check"></i></dd>
                    <dd class="error col-xs-12"></dd>
                </dl>
				<!-- 학생 학번 -->
				<dl class="row level2" id="form_schno">
                	<dd class="col-xs-1 req">*</dd>
                    <dd class="col-xs-11">
                        <label for="reg_mb_1">School entrance year</label>
                        <input type="text" name="mb_1" value="<?php echo $member['mb_1'] ?>" id="reg_mb_1" class="regist-input" placeholder="School entrance year">
                    </dd>
                    <dd class="status_ico"><i class="fas fa-check"></i></dd>
                    <dd class="error col-xs-12"></dd>
                </dl>
				<!-- 학생 생년월일-->
				<dl class="row level2" id="form_birth">
                	<dd class="col-xs-1 req">*</dd>
                    <dd class="col-xs-11">
                        <label for="reg_mb_birth">the date of one's birth</label>
                        <input type="text" name="mb_birth" value="<?php echo $member['mb_birth'] ?>" id="reg_mb_birth" class="regist-input picker" readonly placeholder="the date of one's birth">
                    </dd>
                    <dd class="status_ico"><i class="fas fa-check"></i></dd>
                    <dd class="error col-xs-12"></dd>
                </dl>
				<!-- 학부모 교직원 휴대폰번호 -->
                <dl class="row level3 level4" id="form_hp" style="display:none">
                	<dd class="col-xs-1 req">*</dd>
                    <dd class="col-xs-11">
                        <label for="reg_mb_hp">Phone Number</label>
                        <input type="tel" name="mb_hp" value="<?php echo preg_replace("/[^0-9]*/s", "", $member['mb_hp']); ?>" id="reg_mb_hp" class="regist-input" placeholder="Phone Number" style="font-size:0.95em;" minlength="10" maxlength="14" >
                    </dd>
                    <dd class="status_ico"><i class="fas fa-check"></i></dd>
                    <dd class="error col-xs-12"></dd>
                </dl>

			

<!--                <dl class="row">
                	<dd class="col-xs-1 req">*</dd>
                    <dd class="col-xs-11">
                        <label for="reg_mb_nick">닉네임</label>
                        <input type="text" name="mb_nick" id="reg_mb_nick" class="regist-input <?php /*echo $required */?> <?php /*if($w=="u") echo "readonly";*/?>" minlength="2" maxlength="20" <?php /*echo $required */?> placeholder="닉네임" value="<?php /*echo $member['mb_nick']; */?>">
                    </dd>
                    <dd class="status_ico"><i class="fas fa-check"></i></dd>
                    <dd class="error col-xs-12"></dd>
                </dl>-->

            <dl class="row">
                	<dd class="col-xs-1 req">*</dd>
                    <dd class="col-xs-11">
                        <label for="reg_mb_email">E-mail</label>
                        <input type="email" name="mb_email" id="reg_mb_email" class="regist-input <?php echo $required ?>" minlength="3" maxlength="50" <?php echo $required ?> placeholder="E-mail" value="<?php echo $member['mb_email']; ?>">
                    </dd>
                    <dd class="status_ico"><i class="fas fa-check"></i></dd>
                    <dd class="error col-xs-12"></dd>
                </dl>
				<!-- 학부모 자녀 정보 -->
				<dl class="row level3" id="form_sonname" style="display:none">
                	<dd class="col-xs-1 req">*</dd>
                    <dd class="col-xs-11">
                        <label for="reg_mb_2">Children's name</label>
                        <input type="text" name="mb_2" value="<?php echo $member['mb_2'] ?>" id="reg_mb_2" class="regist-input"  placeholder="Children's name">
                    </dd>
                    <dd class="status_ico"><i class="fas fa-check"></i></dd>
                    <dd class="error col-xs-12"></dd>
                </dl>

				  <dl class="row level3" id="form_sonnum" style="display:none">
                	<dd class="col-xs-1 req">*</dd>
                    <dd class="col-xs-11">
                        <label for="reg_mb_3">Children's school entrance year</label>
                        <input type="text" name="mb_3" value="<?php echo $member['mb_3'] ?>" id="reg_mb_3" class="regist-input"  placeholder="Children's school entrance year">
                    </dd>
                    <dd class="status_ico"><i class="fas fa-check"></i></dd>
                    <dd class="error col-xs-12"></dd>
                </dl>

            </div>
        </div><!--//join_info-->

		<?php if($w == ""){ ?>
        <div id="join_agr">
        <h2>Terms and Conditions Agree</h2>
            <div class="box-body">
                <dl class="row agree-row">
                    <dd class="col-xs-8 chk_ico" data-for="reg_req1">
                        <input type="checkbox" name="reg_req[]" id="reg_req1" value="0" onclick="ag_check(this)">
                        <label for="reg_req1">Accept the Terms and Conditions (Required)</label>
                      	<!-- <i></i> 이용약관 동의 (필수) -->
                    </dd>
                    <dd class="col-xs-4 text-right"><input type="button" value="View Content" class="btn btn-agr"></dd>
                    <dd class="col-xs-12 agr_textarea"><textarea readonly><?php echo get_text($config['cf_1']) ?></textarea></dd>
                </dl>

                <dl class="row agree-row">
                    <dd class="col-xs-8 chk_ico" data-for="reg_req2">
                        <input type="checkbox" name="reg_req[]" id="reg_req2" value="0" onclick="ag_check(this)">
                        <label for="reg_req2">Consent to personal information processing policies (Required)</label>
                        <!--<i></i> 개인정보처리방침 동의 (필수) -->
                    </dd>
                    <dd class="col-xs-4 text-right"><input type="button" value="View Content" class="btn btn-agr"></dd>
                    <dd class="col-xs-12 agr_textarea"><textarea readonly><?php echo get_text($config['cf_2']) ?></textarea></dd>
                </dl>

                <!--<dl class="agree-row">
                    <dd class=" chk_ico" data-for="reg_chk1">
                        <input type="checkbox" name="reg_chk[]" id="reg_chk1" value="">
                        <label for="reg_chk1">선택 동의 (선택)</label>
                        <i></i> 선택 동의 (선택)
                    </dd>
                </dl>-->
            </div>
        </div><!--//join_chk-->
		<?php } ?>

		<input type="submit" class="btn_submit ft_btn" value="<?php echo $w==''?'Join':'Modify'; ?>" accesskey="s">
        <?php /*?><a class="logout_btn" href="<?php echo G5_BBS_URL ?>/point.php">코인내역</a>
        <?php if(!$w == ""){ ?><a class="logout_btn" href="<?php echo G5_BBS_URL ?>/logout.php">로그아웃</a><?php } ?><?php */?>
	</article>
    </form>
</div>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


<script>

var register_flgs = new Array(0,0,0,0,0,0,0);

$("input:radio[name='mb_level']").click(function(){
	for(var i=2;i<5;i++){
		$(".level"+i).css("display","none");
		$(".level"+i).find("input").removeAttr("required");
		$(".level"+i).find("input").val("");
	}
	$(".level"+$(this).val()).css("display","block");
	$(".level"+$(this).val()).find("input").attr("required","required");

		/*
		switch($(this).val()){

			case 'student' :  {
				$("#form_hp").attr("style","display:none");
				$("#form_sonname").attr("style","display:none");
				$("#form_sonnum").attr("style","display:none");
				$("#form_schno").attr("style","display:block");
				$("#form_birth").attr("style","display:block");
				register_flgs = new Array(0,0,0,0,0,0,0);
				break;
			}
			case 'parent':{
				$("#form_hp").attr("style","display:block");
				$("#form_sonname").attr("style","display:block");
				$("#form_sonnum").attr("style","display:block");
				$("#form_schno").attr("style","display:none");
				$("#form_birth").attr("style","display:none");
				register_flgs = new Array(0,0,0,0,0,0,0,0);
				break;
			}
			case 'officer': {
			
				$("#form_hp").attr("style","display:block");
				$("#form_sonname").attr("style","display:none");
				$("#form_sonnum").attr("style","display:none");
				$("#form_schno").attr("style","display:none");
				$("#form_birth").attr("style","display:none");
				register_flgs = new Array(0,0,0,0,0,0);
				break;
			}
		}*/

});

function ag_check(obj){
	if(obj.value == "0"){
		obj.value = "1";
	}else{
		obj.value = "0";
	}
}
$(function (){
	<? if($w==""){?>
		$(".level2").find("input").attr("required","required");
	<? }else{?>
		for(var i=2;i<5;i++){
			$(".level"+i).css("display","none");
			$(".level"+i).find("input").removeAttr("required");
			$(".level"+i).find("input").val("");
		}
		$(".level<?=$member[mb_level]?>").css("display","block");
		$(".level<?=$member[mb_level]?>").find("input").attr("required","required");
	<? }?>
	$("#reg_mb_birth").datepicker({

		dateFormat: 'yy-mm-dd',
        prevText: '이전 달',
        nextText: '다음 달',
        monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
        monthNamesShort: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
		changeMonth: true,
		changeYear: true, 
		nextText: '다음 달',
		prevText: '이전 달', 
		showMonthAfterYear: true ,
		yearRange:'1970:<?php echo date("Y")-15?>'
		
	});


	// 아이디 체크
	
	$("#reg_mb_id").keyup(function (){
		var mb_id = $(this).val();
		var reg_mb_id = $(this);

		// 아이디 정규표현식
		var regId = /^[a-z0-9]{4,12}$/;

		if (regId.test(mb_id)){
			$(this).parents(".row").find(".status_ico").removeClass("err").addClass("pas");
			$(this).parents(".row").find(".error").html("");
			register_flgs[0] = 1;
		}else{
			$(this).parents(".row").find(".status_ico").removeClass("pas").addClass("err");
			$(this).parents(".row").find(".error").addClass("on").html("ID can be up to 4 to 12 digits in English and numbers.");
			register_flgs[0] = 0;
			return false;
		}

		// 아작스로 중복 아이디가 있는지 체크 1
		$.post(g5_bbs_url+"/ajax.mb_register.php", {"type":"mb_id", "val":mb_id}, function (result){
			if(result == "0"){  // ajax.mb_register.php 의 echo $row['cnt']; 값을 가져옴
				reg_mb_id.parents(".row").find(".status_ico").removeClass("err").addClass("pas"); //될때 초록색 박스 i 는 icon 의 약자
				reg_mb_id.parents(".row").find(".error").html(""); // 마지막 dd 의 css 스타일 사용
				register_flgs[0] = 1;
			}else{
				reg_mb_id.parents(".row").find(".status_ico").removeClass("pas").addClass("err");
				reg_mb_id.parents(".row").find(".error").addClass("on").html("ID in use.");
				register_flgs[0] = 0;
			}
		});
	});

	/*$("#reg_mb_1").keyup(function(){
		var student_no  = $(this).val();
		var reg_mb_1 = $(this);

		$.post(g5_bbs_url+"/ajax.student_no.php", {"val":student_no}, function (result){
			console.log(result);
			if(result == "0"){  // ajax.mb_register.php 의 echo $row['cnt']; 값을 가져옴
				reg_mb_1.parents(".row").find(".status_ico").removeClass("err").addClass("pas"); //될때 초록색 박스 i 는 icon 의 약자
				reg_mb_1.parents(".row").find(".error").html(""); // 마지막 dd 의 css 스타일 사용
				register_flgs[0] = 1;
			}else{
				reg_mb_1.parents(".row").find(".status_ico").removeClass("pas").addClass("err");
				reg_mb_1.parents(".row").find(".error").addClass("on").html("사용중인 아이디입니다.");
				register_flgs[0] = 0;
			}
		});	

	});*/

	$("#reg_mb_password").keyup(function (){
		var mb_password = $(this).val();
		var reg_mb_password = $(this);

		// 바뀌면 무조건 틀렸다로 표시.
		if($("#reg_mb_password_re").val() != mb_password){
			$("#reg_mb_password_re").parents(".row").find(".status_ico").removeClass("pas").addClass("err");
			$("#reg_mb_password_re").parents(".row").find(".error").addClass("on").html("The password is different.");
			register_flgs[1] = 0;
		}else{
			$("#reg_mb_password_re").parents(".row").find(".status_ico").removeClass("err").addClass("pas");
			$("#reg_mb_password_re").parents(".row").find(".error").html("");
			register_flgs[1] = 1;
		}

		// 비밀번호 정규표현식
		//var regPassword = /^.*(?=^.{4,15}$)(?=.*\d)(?=.*[a-zA-Z])(?=.*[!@#$%^&+=]).*$/;
		var regPassword = /^.*(?=^.{4,15}$)(?=.*\d)/;

		if (regPassword.test(mb_password)){
			$(this).parents(".row").find(".status_ico").removeClass("err").addClass("pas");
			$(this).parents(".row").find(".error").html("");
			register_flgs[1] = 1;
		}else{
			$(this).parents(".row").find(".status_ico").removeClass("pas").addClass("err");
			$(this).parents(".row").find(".error").addClass("on").html("Password must contain 4~15 alphanumeric characters.");
			register_flgs[1] = 0;
		}
	});

	$("#reg_mb_password_re").keyup(function (){
		var mb_password_re = $(this).val();
		var mb_password = $("#reg_mb_password").val();	
		

		if(mb_password == mb_password_re){
			$(this).parents(".row").find(".status_ico").removeClass("err").addClass("pas");
			$(this).parents(".row").find(".error").html("");
			register_flgs[2] = 1;
		}else{
			$(this).parents(".row").find(".status_ico").removeClass("pas").addClass("err");
			$(this).parents(".row").find(".error").addClass("on").html("The password is different.");
			register_flgs[2] = 0;
		}
	});


	$("#reg_mb_name").keyup(function (){
		var mb_name = $(this).val();
		var reg_mb_name = $(this);

		// 이름 정규표현식
		var regName = /^[\uac00-\ud7a3]*$/;

		if (regName.test(mb_name)){
			$(this).parents(".row").find(".status_ico").removeClass("err").addClass("pas");
			$(this).parents(".row").find(".error").html("");
			register_flgs[3] = 1;
		}else{
			$(this).parents(".row").find(".status_ico").removeClass("pas").addClass("err");
			$(this).parents(".row").find(".error").addClass("on").html("Please enter at least 2 characters in Korean.");
			register_flgs[3] = 0;
		}
	});

	$("#reg_mb_hp").keyup(function (){
		var mb_hp = $(this).val();
		var reg_mb_hp = $(this);

		// 휴대폰 정규표현식
		// /^01([0|1|6|7|8|9]?)-?([0-9]{3,4})-?([0-9]{4})$/
		//var regHp = /^\d{10,12}$/;
        var regHp = /^([0-9]{3,4})-?([0-9]{3,4})-?([0-9]{4})$/;

		if (regHp.test(mb_hp)){
			$(this).parents(".row").find(".status_ico").removeClass("err").addClass("pas");
			$(this).parents(".row").find(".error").html("");
			register_flgs[4] = 1;
		}else{
			$(this).parents(".row").find(".status_ico").removeClass("pas").addClass("err");
			$(this).parents(".row").find(".error").addClass("on").html("Please enter only 10 to 12 digits for your mobile phone number.");
			register_flgs[4] = 0;
		}
	});

	$("#reg_mb_email").keyup(function (){
		var mb_email = $(this).val();
		var reg_mb_email = $(this);

		// 이메일 정규표현식
		var regEmail = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/;

		if (regEmail.test(mb_email)){
			$(this).parents(".row").find(".status_ico").removeClass("err").addClass("pas");
			$(this).parents(".row").find(".error").html("");

			if($("input:radio[name='mb_1']:checked").val() =='student'){
						register_flgs[6] = 1;
			}	
			else{
						register_flgs[5] = 1;
			}
		}else{
			$(this).parents(".row").find(".status_ico").removeClass("pas").addClass("err");
			$(this).parents(".row").find(".error").addClass("on").html("Please enter in the correct e-mail format.")

			if($("input:radio[name='mb_1']:checked").val() =='student'){
						register_flgs[6] = 0;
			}	
			else{
						register_flgs[5] = 0;
			}

			return false;
		}
	});

	$("#reg_mb_level").click(function (){
		var mb_level = $(this).val();
		var reg_mb_level = $(this);

		// 이메일 정규표현식

		var regEmail = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/;

		if (regEmail.test(mb_email)){
			$(this).parents(".row").find(".status_ico").removeClass("err").addClass("pas");
			$(this).parents(".row").find(".error").html("");
		}else{
			$(this).parents(".row").find(".status_ico").removeClass("pas").addClass("err");
			$(this).parents(".row").find(".error").addClass("on").html("Please enter in the correct e-mail format.")
			return false;
		}
	});

	// 라디오 버튼
	$("#dd_type p").click(function (){
		var v = $(this).data("val");
		$("#mb_type").val(v);
		$("#dd_type p").find("i").removeClass("fa-check-circle-o").addClass("fa-circle-o");
		$(this).find("i").removeClass("fa-circle-o").addClass("fa-check-circle-o");
	});

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

	// 가입경로선택
	//$("#reg_mb_1").on("change", function() {
//		if ($(this).val() == "기타") {
//			$("#reg_mb_2").show().focus();
//		} else {
//			$("#reg_mb_2").hide().val("");
//		}
//	});

});

function only_number(num){
	num = num + "";
	num = num.replace(/[^0-9]/gi, "");
	return num;
}

// submit 최종 폼체크
function fregisterform_submit(f)
{
	// 필수 체크박스
	// 조건들 확인

	// 회원아이디 검사
	if (f.w.value == "") {
		var msg = reg_mb_id_check();
		if (msg) {
			alert(msg);
			f.mb_id.select();
			return false;
		}
	}

	if (f.w.value == '') {
		if (f.mb_password.value.length < 3) {
			alert('Please enter a password of at least 3 characters.');
			f.mb_password.focus();
			return false;
		}
	}

	if (f.mb_password.value != f.mb_password_re.value) {
		alert('The password is not the same.');
		f.mb_password_re.focus();
		return false;
	}

	if (f.mb_password.value.length > 0) {
		if (f.mb_password_re.value.length < 3) {
			alert('Please enter a password of at least 3 characters.');
			f.mb_password_re.focus();
			return false;
		}
	}
	
	// 이름 검사
	if (f.w.value=='') {
		if (f.mb_name.value.length < 1) {
			alert('Please enter your name.');
			f.mb_name.focus();
			return false;
		}
	}
	/*
	if(f.mb_1.value=='student'){		
			if($("#reg_mb_2").val()==''){
				alert("생년월일을 입력하세요");
				return false;
			}
			if($("#reg_mb_1").val()==''){
				alert("학번을 입력하세요");
				return false;
			}
	}
	if(f.mb_1.value=='parent'){
			if($("#reg_mb_3").val()==''){
				alert("자녀이름을 입력하세요");
				return false;
			}
			if($("#reg_mb_4").val()==''){
				alert("자녀학번을 입력하세요");
				return false;
			}
			

	}
	
	for(var i=0; i<register_flgs.length; i++){

			if(register_flgs[i] ==0){
				alert("입력내용을 확인해주세요.");
				return false;
			}
			
	}
	*/
	


	// 가입경로확인
	//if ($("select#reg_mb_1 option:selected").val() == "기타" && $("input#reg_mb_2").val() == "") {
//		alert("가입경로를 입력하세요.");
//		$("input#reg_mb_2").focus();
//		return false;
//	}

	<?php if($w == ""){ ?>
	if($("#reg_req1").val()!="1"){
		alert("Check the Agree to Terms of Use (required)");
		return false;
	}
	if($("#reg_req2").val()!="1"){
		alert("Check I agree to the privacy policy (required)");
		return false;
	}
	<?php } ?>



	return true;
}
</script>

<script>
$(document).ready(function () {
   $(function () {

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

});
</script>



