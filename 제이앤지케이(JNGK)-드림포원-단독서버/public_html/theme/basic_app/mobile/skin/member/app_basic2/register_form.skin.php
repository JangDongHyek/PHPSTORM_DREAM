<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 100);
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
	<input type="hidden" name="mb_level" id="mb_level" value="<? if($w == '') { echo $mb_level; } else { echo $member[mb_level]; } ?>">
    <?php if (isset($member['mb_sex'])) { ?><input type="hidden" name="mb_sex" value="<?php echo $member['mb_sex'] ?>"><?php } ?>
    <?php if (isset($member['mb_nick_date']) && $member['mb_nick_date'] > date("Y-m-d", G5_SERVER_TIME - ($config['cf_nick_modify'] * 86400))) { // 닉네임수정일이 지나지 않았다면 ?>
    <input type="hidden" name="mb_nick_default" value="<?php echo get_text($member['mb_nick']) ?>">
    <input type="hidden" name="mb_nick" value="<?php echo get_text($member['mb_nick']) ?>">
    <?php } ?>
	
	<article class="box-article">
		<? if($w==""){?>
        <div id="mb_part">
        	<div class="radio">
            <input type="radio" name="mb_level" id="mb-level2" checked value="2"/><label for="mb-level2"><div></div>라이더회원</label>
            <input type="radio" name="mb_level" id="mb-level3" value="3"/><label for="mb-level3"><div></div>사장님회원</label>
        	</div>
        </div>
		<? }?>
		<script type="text/javascript">
			$(function(){
				$("input[name='mb_level']").click(function(){
					$('.mb-level'+($(this).val())).css("display","");
					if($(this).val()=="2"){
						$('.mb-level3').css("display","none");
					}else{
						$('.mb-level2').css("display","none");
					}
				});
			});
		</script>
    	<div id="join_info">
		<h2>회원 정보 입력</h2>
            <div class="box-body">
                <dl class="row">
                    <dd class="col-xs-12">
                        <label for="reg_mb_id">아이디</label>
                        <input type="text" name="mb_id" value="<?php echo $member['mb_id'] ?>" id="reg_mb_id" class="regist-input <?php echo $required ?> <?php if($w=="u") echo "readonly";?>" minlength="6" maxlength="20" <?php echo $required ?> placeholder="아이디" <?php if($w=="u") echo "readonly";?>>
                    </dd>
                    <dd class="status_ico"><i class="fas fa-check"></i></dd>
                    <dd class="error col-xs-12"></dd>
                </dl>
    
                <dl class="row">
                    <dd class="col-xs-12">
                        <label for="reg_mb_password">비밀번호</label>
                        <input type="password" name="mb_password" id="reg_mb_password" class="regist-input <?php echo $required ?>" minlength="6" maxlength="20" <?php echo $required ?> placeholder="비밀번호">
                    </dd>
                    <dd class="status_ico lock_ico1"><i class="fas fa-lock-open"></i></dd>
                    <dd class="error col-xs-12"></dd>
                </dl>
    
                <dl class="row">
                    <dd class="col-xs-12">
                        <label for="mb_password_re">비밀번호확인</label>
                        <input type="password" name="mb_password_re" id="reg_mb_password_re" class="regist-input <?php echo $required ?>" minlength="6" maxlength="20" <?php echo $required ?> placeholder="비밀번호확인">
                    </dd>
                    <dd class="status_ico lock_ico2"><i class="fas fa-lock"></i></dd>
                    <dd class="error col-xs-12"></dd>
                </dl>
    
                <dl class="row">
                    <dd class="col-xs-12">
                        <label for="reg_mb_name">이름</label>
                        <input type="text" name="mb_name" value="<?php echo $member['mb_name'] ?>" id="reg_mb_name" class="regist-input <?php echo $required ?>" <?php echo $required ?> placeholder="이름" <?php if($w=="u") echo "readonly";?>>
                    </dd>
                    <dd class="status_ico"><i class="fas fa-check"></i></dd>
                    <dd class="error col-xs-12"></dd>
                </dl>
                
                <dl class="row">
                    <dd class="col-xs-12">
                        <label for="reg_mb_hp">휴대번호</label>
                        <input type="tel" name="mb_hp" value="<?php echo $member['mb_hp'] ?>" id="reg_mb_hp" class="regist-input <?php echo $required ?>" <?php echo $required ?> placeholder="휴대번호" style="font-size:0.95em;" minlength="10" maxlength="14">
                    </dd>
                    <dd class="status_ico"><i class="fas fa-check"></i></dd>
                    <dd class="error col-xs-12"></dd>
                </dl>
				<!-- 라이더스 회원 폼 -->
				 <dl class="row mb-level2" style="<?php echo ($w=="u"&&$member[mb_level]=="2")||$w==""?" display:":"display:none";?>">
                    <dd class="col-xs-12">
                        <label for="mb_1">활동지역</label>
                        <select name="mb_1" id="mb_1" class="regist-input">
							
							<option value="">활동지역선택</option>
							<? for($i=0;$i<count($sidoArr);$i++){?>
							<option value="<?=$sidoArr[$i]?>"<?echo $w=="u"&&$member[mb_1]==$sidoArr[$i]?" selected":"";?>><?=$sidoArr[$i]?></option>
							<? }?>
						</select>
                    </dd>
                    <dd class="status_ico"><i class="fas fa-check"></i></dd>
                    <dd class="error col-xs-12"></dd>
                </dl>
				<dl class="row mb-level2" style="<?php echo ($w=="u"&&$member[mb_level]=="2")||$w==""?" display:":"display:none";?>">
                    <dd class="col-xs-12">
                        <label for="mb_2f">면허증등록</label>
						<input type="text" name="mb_2f" id="mb_2f" value="<?=$member[mb_2]?>" onclick="$('#mb_2').click();" readonly class="regist-input" placeholder="면허증등록">
                        <input type="file" name="mb_2" value="" class="regist-input" id="mb_2" style="display:none" onchange="">
                    </dd>
					<script type="text/javascript">
						$(function(){
							$("#mb_2").on('change',function(){
								var file = this.files[0],
									filename=file.name;
								$("#mb_2f").val(filename);
							});
						});
					</script>
                    <dd class="status_ico"><i class="fas fa-check"></i></dd>
                    <dd class="error col-xs-12"></dd>
                </dl>

				<dl class="row mb-level2" style="<?php echo ($w=="u"&&$member[mb_level]=="2")||$w==""?" display:":"display:none";?>;padding:10px">
                    <dd class="col-xs-12" style="color:red">
                        면허증 등록시 파일명에 특수문자가 들어가 있으면 등록이 불가능합니다.
                    </dd>
					
                </dl>
				<!-- 사업자 회원 폼 -->
				 <dl class="row mb-level3" style="<?php echo ($w=="u"&&$member[mb_level]=="3")?" display:":"display:none";?>">
                    <dd class="col-xs-12">
                        <label for="mb_3">사업자등록번호</label>
                        <input type="text" name="mb_3" id="mb_3" value="<?=$member[mb_3]?>" class="regist-input" placeholder="사업자등록번호">
                    </dd>
                    <dd class="status_ico"><i class="fas fa-check"></i></dd>
                    <dd class="error col-xs-12"></dd>
                </dl>
				<dl class="row mb-level3"  style="<?php echo ($w=="u"&&$member[mb_level]=="3")?" display:":"display:none";?>">
                    <dd class="col-xs-12">
                        <label for="mb_4f">사업자등록증</label>
						<input type="text" name="mb_4f" id="mb_4f" value="<?=$member[mb_4]?>" onclick="$('#mb_4').click();" readonly class="regist-input" placeholder="사업자등록증">
                        <input type="file" name="mb_4" value="" class="regist-input" id="mb_4" style="display:none" onchange="">
                    </dd>
					<script type="text/javascript">
						$(function(){
							$("#mb_4").on('change',function(){
								var file = this.files[0],
									filename=file.name;
								$("#mb_4f").val(filename);
							});
						});
					</script>
                    <dd class="status_ico"><i class="fas fa-check"></i></dd>
                    <dd class="error col-xs-12"></dd>
                </dl>

				<dl class="row mb-level3" style="<?php echo ($w=="u"&&$member[mb_level]=="3")?" display:":"display:none";?>">
                    <dd class="col-xs-12" style="color:red;padding:10px">
                        사업자등록증 등록시 파일명에 특수문자가 들어가 있으면 등록이 불가능합니다.
                    </dd>
					
                </dl>

				<!--
                <dl class="row">
                    <dd class="col-xs-12">
                        <label for="reg_mb_nick">닉네임</label>
                        <input type="text" name="mb_nick" id="reg_mb_nick" class="regist-input <?php echo $required ?> <?php if($w=="u") echo "readonly";?>" minlength="2" maxlength="20" <?php echo $required ?> placeholder="닉네임" value="<?php echo $member['mb_nick']; ?>">
                    </dd>
                    <dd class="status_ico"><i class="fas fa-check"></i></dd>
                    <dd class="error col-xs-12"></dd>
                </dl>
    
                <dl class="row">
                    <dd class="col-xs-12">
                        <label for="reg_mb_email">E-mail</label>
                        <input type="text" name="mb_email" id="reg_mb_email" class="regist-input <?php echo $required ?>" minlength="3" maxlength="50" <?php echo $required ?> placeholder="E-mail" value="<?php echo $member['mb_email']; ?>">
                    </dd>
                    <dd class="status_ico"><i class="fas fa-check"></i></dd>
                    <dd class="error col-xs-12"></dd>
                </dl>-->
    
            </div>
        </div><!--//join_info-->
		
		<?php if($w == ""){ ?>
        <div id="join_agr">
        <h2>약관동의</h2>
            <div class="box-body chk">
                <dl class="row agree-row">
                    <dd class="col-xs-9" data-for="reg_req1">
                        <input type="checkbox" name="reg_req[]" id="reg_req1" value="0" onclick="ag_check(this)">
                        <label for="reg_req1"><div></div>이용약관 동의 (필수)</label>
                      	<!-- <i></i> 이용약관 동의 (필수) -->
                    </dd>
                    <dd class="col-xs-3 text-right"><input type="button" value="내용보기" class="btn btn-agr"></dd>
                    <dd class="col-xs-12 agr_textarea"><textarea readonly><?php echo get_text($config['cf_stipulation']) ?></textarea></dd>
                </dl>
                
                <dl class="row agree-row">
                    <dd class="col-xs-9" data-for="reg_req2">
                        <input type="checkbox" name="reg_req[]" id="reg_req2" value="0" onclick="ag_check(this)">
                        <label for="reg_req2"><div></div>개인정보처리방침 동의 (필수)</label>
                        <!--<i></i> 개인정보처리방침 동의 (필수) -->
                    </dd>
                    <dd class="col-xs-3 text-right"><input type="button" value="내용보기" class="btn btn-agr"></dd>
                    <dd class="col-xs-12 agr_textarea"><textarea readonly><?php echo get_text($config['cf_privacy']) ?></textarea></dd>
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

		<input type="submit" class="btn_submit ft_btn" value="<?php echo $w==''?'회원가입':'정보수정'; ?>" accesskey="s">
	</article>
    </form>
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
	
	// 아이디 체크
	
	$("#reg_mb_id").keyup(function (){
		var mb_id = $(this).val();
		var reg_mb_id = $(this);

		// 아이디 정규표현식
		var regId = /^[a-z0-9]{4,12}$/;
		
		if (regId.test(mb_id)){ 
			$(this).parents(".row").find(".status_ico").removeClass("err").addClass("pas");
			$(this).parents(".row").find(".error").removeClass("on").html("");
		}else{
			$(this).parents(".row").find(".status_ico").removeClass("pas").addClass("err");
			$(this).parents(".row").find(".error").addClass("on").html("아이디는 영문과 숫자, 4 ~ 12자리까지 가능합니다.");
			
			return false;
		}
		
		// 아작스로 중복 아이디가 있는지 체크 1
		$.post(g5_bbs_url+"/ajax.mb_register.php", {"type":"mb_id", "val":mb_id}, function (result){
			if(result == "0"){  // ajax.mb_register.php 의 echo $row['cnt']; 값을 가져옴
				reg_mb_id.parents(".row").find(".status_ico").removeClass("err").addClass("pas"); //될때 초록색 박스 i 는 icon 의 약자
				reg_mb_id.parents(".row").find(".error").removeClass("on").html(""); // 마지막 dd 의 css 스타일 사용
			}else{
				reg_mb_id.parents(".row").find(".status_ico").removeClass("pas").addClass("err");
				reg_mb_id.parents(".row").find(".error").addClass("on").html("사용중인 아이디입니다.");
			}
		});
	});

	$("#reg_mb_password").keyup(function (){
		var mb_password = $(this).val();
		var reg_mb_password = $(this);

		// 바뀌면 무조건 틀렸다로 표시.
		if($("#reg_mb_password_re").val() != mb_password){
			$("#reg_mb_password_re").parents(".row").find(".status_ico").removeClass("pas").addClass("err");
			$("#reg_mb_password_re").parents(".row").find(".error").addClass("on").html("비밀번호가 다릅니다.");	
		}else{
			$("#reg_mb_password_re").parents(".row").find(".status_ico").removeClass("err").addClass("pas");
			$("#reg_mb_password_re").parents(".row").find(".error").removeClass("on").html("");
		}

		// 비밀번호 정규표현식
		var regPassword = /^.*(?=^.{8,15}$)(?=.*\d)(?=.*[a-zA-Z])(?=.*[!@#$%^&+=]).*$/;

		if (regPassword.test(mb_password)){ 
			$(this).parents(".row").find(".status_ico").removeClass("err").addClass("pas");
			$(this).parents(".row").find(".error").removeClass("on").html("");
		}else{
			$(this).parents(".row").find(".status_ico").removeClass("pas").addClass("err");
			$(this).parents(".row").find(".error").addClass("on").html("비밀번호는 8자~15자 영문,숫자,특수문자가 포함 되어야 합니다.");
		}
	});

	$("#reg_mb_password_re").keyup(function (){
		var mb_password_re = $(this).val();
		var mb_password = $("#reg_mb_password").val();

		// 비밀번호 정규표현식
		var regPassword = /^.*(?=^.{8,15}$)(?=.*\d)(?=.*[a-zA-Z])(?=.*[!@#$%^&+=]).*$/;

		if(mb_password == mb_password_re){
			$(this).parents(".row").find(".status_ico").removeClass("err").addClass("pas");
			$(this).parents(".row").find(".error").removeClass("on").html("");
		}else{
			$(this).parents(".row").find(".status_ico").removeClass("pas").addClass("err");
			$(this).parents(".row").find(".error").addClass("on").html("비밀번호가 다릅니다.");	
		}
	});


	$("#reg_mb_name").keyup(function (){
		var mb_name = $(this).val();
		var reg_mb_name = $(this);

		// 이름 정규표현식
		var regName = /^[가-힣]{2,4}|[a-zA-Z]{2,10}\s[a-zA-Z]{2,10}$/;

		if (regName.test(mb_name)){ 
			$(this).parents(".row").find(".status_ico").removeClass("err").addClass("pas");
			$(this).parents(".row").find(".error").removeClass("on").html("");
		}else{
			$(this).parents(".row").find(".status_ico").removeClass("pas").addClass("err");
			$(this).parents(".row").find(".error").addClass("on").html("2글자 이상 한글만 입력해주세요.");
		}
	});

	$("#reg_mb_hp").keyup(function (){
		var mb_hp = $(this).val();
		var reg_mb_hp = $(this);

		// 휴대폰 정규표현식
		// /^01([0|1|6|7|8|9]?)-?([0-9]{3,4})-?([0-9]{4})$/
		var regHp = /^\d{10,12}$/;

		if (regHp.test(mb_hp)){
			$(this).parents(".row").find(".status_ico").removeClass("err").addClass("pas");
			$(this).parents(".row").find(".error").removeClass("on").html("");
		}else{
			$(this).parents(".row").find(".status_ico").removeClass("pas").addClass("err");
			$(this).parents(".row").find(".error").addClass("on").html("휴대폰 번호는 10 ~ 12자리 숫자만 입력하세요.");
		}
	});

	$("#reg_mb_nick").keyup(function (){
		var mb_nick = $(this).val();
		var reg_mb_nick = $(this);

		// 닉네임 정규표현식
		var regNick = /^[\w\Wㄱ-ㅎㅏ-ㅣ가-힣]{2,20}$/;
		
		if (regNick.test(mb_nick)){ 
			$(this).parents(".row").find(".status_ico").removeClass("err").addClass("pas");
			$(this).parents(".row").find(".error").removeClass("on").html("");
		}else{
			$(this).parents(".row").find(".status_ico").removeClass("pas").addClass("err");
			$(this).parents(".row").find(".error").addClass("on").html("2글자 이상 입력해주세요.")		
			return false;
		}

		$.post(g5_bbs_url+"/ajax.mb_register.php", {"type2":"mb_nick", "val2":mb_nick}, function (result){
			if(result == "0"){  
				reg_mb_nick.parents(".row").find(".status_ico").removeClass("err").addClass("pas"); 
				reg_mb_nick.parents(".row").find(".error").removeClass("on").html("");
			}else{
				reg_mb_nick.parents(".row").find(".status_ico").removeClass("pas").addClass("err");
				reg_mb_nick.parents(".row").find(".error").addClass("on").html("사용중인 닉네임 입니다.");
			}
		});
	});
	
	$("#reg_mb_email").keyup(function (){
		var mb_email = $(this).val();
		var reg_mb_email = $(this);

		// 이메일 정규표현식
		var regEmail = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/;
		
		if (regEmail.test(mb_email)){ 
			$(this).parents(".row").find(".status_ico").removeClass("err").addClass("pas");
			$(this).parents(".row").find(".error").removeClass("on").html("");
		}else{
			$(this).parents(".row").find(".status_ico").removeClass("pas").addClass("err");
			$(this).parents(".row").find(".error").addClass("on").html("올바른 E-mail 형식으로 입력해주십시오.")		
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
			$(this).parents(".row").find(".error").removeClass("on").html("");
		}else{
			$(this).parents(".row").find(".status_ico").removeClass("pas").addClass("err");
			$(this).parents(".row").find(".error").addClass("on").html("올바른 E-mail 형식으로 입력해주십시오.")		
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
			alert('비밀번호를 3글자 이상 입력하십시오.');
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
		if (f.mb_password_re.value.length < 3) {
			alert('비밀번호를 3글자 이상 입력하십시오.');
			f.mb_password_re.focus();
			return false;
		}
	}

	// 이름 검사
	if (f.w.value=='') {
		if (f.mb_name.value.length < 1) {
			alert('이름을 입력하십시오.');
			f.mb_name.focus();
			return false;
		}
	}

	// 닉네임 검사
	/*if ((f.w.value == "") || (f.w.value == "u" && f.mb_nick.defaultValue != f.mb_nick.value)) {
		var msg = reg_mb_nick_check();
		if (msg) {
			alert(msg);
			f.reg_mb_nick.select();
			return false;
		}
	}

	// E-mail 검사
	if ((f.w.value == "") || (f.w.value == "u" && f.mb_email.defaultValue != f.mb_email.value)) {
		var msg = reg_mb_email_check();
		if (msg) {
			alert(msg);
			f.reg_mb_email.select();
			return false;
		}
	}*/
	<?php if($w == ""){ ?>
	if($("#reg_req1").val()!="1"){
		alert("이용약관 동의(필수)를 체크하십시오");
		return false;
	}
	if($("#reg_req2").val()!="1"){
		alert("개인정보처리방침 동의(필수)를 체크하십시오");
		return false;
	}
	return true;
	<?php } ?>
}
</script>