<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css?v='.G5_CSS_VER.'">', 100);
?>
<script src="<?php echo G5_JS_URL ?>/jquery.register_form.js"></script>

<div class="mbskin">
    <form name="fregisterform" id="fregisterform" action="<?php echo $register_action_url ?>" onsubmit="return fregisterform_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
    <input type="hidden" name="w" value="<?php echo $w ?>">
    <input type="hidden" name="url" value="<?php echo $urlencode ?>">
    <input type="hidden" name="agree" value="<?php echo $agree ?>">
    <input type="hidden" name="agree2" value="<?php echo $agree2 ?>">
	<!-- 대리점 -->
	<input type="hidden" name="agency_no" value="<? echo ($w == "")? $_SESSION['myAgency'] : $member['agency_no'] ?>">
	<!-- 회원구분 -->
    <? if ($w==""){ ?>
    <div id="mb_cate">
    	<input type="radio" name="mb_level" value="2" id="mb-level2" checked><label for="mb-level2">일반회원</label>&nbsp;&nbsp;&nbsp;&nbsp;
    	<input type="radio" name="mb_level" value="1" id="mb-level3"><label for="mb-level3">드라이버</label>
    </div>
	<? } else { ?>
	<input type="hidden" name="mb_level" value="<?=$member['mb_level']?>">
	<? } ?>
	<!-- 로그인용 아이디 자동생성 -->
	<input type="hidden" name="mb_id" value="<?=$member['mb_id']?>">
	<!-- 출금계좌승인 -->
	<input type="hidden" name="mb_user_acc" id="mb_user_acc" value="<?=$member['mb_user_acc']?>">
	<!-- 출금계좌tid -->
	<input type="hidden" name="mb_namechk_tid" id="mb_namechk_tid" value="<?=$member['mb_namechk_tid']?>">


    <div class="tbl_frm01 tbl_wrap">
        <table>
        <caption>이용정보 입력</caption>
		<tr>
            <th scope="row"><label for="reg_mb_name">이름</label></th>
            <td><input placeholder="이름" type="text" id="reg_mb_name" name="mb_name" value="<?php echo get_text($member['mb_name']) ?>" <?php echo $required ?> <?php echo $readonly; ?> class="frm_input <?php echo $required ?> <?php echo $readonly ?>"></td>
        </tr>
		<tr>
            <th scope="row"><label for="reg_mb_hp">아이디</label></th>
            <td>
                <input placeholder="휴대폰번호" type="tel" name="mb_hp" value="<?=get_text($member['mb_hp']) ?>" id="reg_mb_hp"  class="frm_input <?php echo $required ?>" maxlength="20" required <?php echo $readonly ?> <? if ($w=="") { ?>style="width:calc(100% - 65px)"<? } ?>>
				<? if ($w=="") { ?>
				<button type="button" class="btn btn-success" id="injung" style="width:60px;">인증</button>
				<? } ?>
            </td>
        </tr>
		<? if ($w=="") { ?>
		<tr id="injung-no" style="display:none">
            <th scope="row"><label for="reg_mb_hp">인증번호</label></th>
            <td>
				<input type="hidden" name="" value="" id="injung-re">
				<input type="number" placeholder="6자리 인증번호를 입력하세요" id="injung-answer" class="frm_input"  style="width:calc(100% - 106px)">
				<button type="button" class="btn btn-success" style="width:60px" id="injung-success">확인</button>
				<span id="time"></span>
            </td>
        </tr>
		<? } ?>
		<tr>
            <th scope="row"><label for="reg_mb_password">비밀번호</label></th>
            <td><input placeholder="비밀번호" type="password" name="mb_password" id="reg_mb_password" class="frm_input <?php echo $required ?>" minlength="4" maxlength="20" <?php echo $required ?>></td>
        </tr>
        <tr>
            <th scope="row"><label for="reg_mb_password_re">비밀번호 확인</label></th>
            <td><input placeholder="비밀번호 확인" type="password" name="mb_password_re" id="reg_mb_password_re" class="frm_input <?php echo $required ?>" minlength="4" maxlength="20" <?php echo $required ?>></td>
        </tr>
		<? if ($w=="") { ?>
		<tr>
            <th scope="row">추천인</th>
            <td><input placeholder="추천인" type="text" id="reg_mb_recommend" name="mb_recommend" value="<?=$member['mb_recommend']?>" class="frm_input" maxlength="30"></td>
        </tr>
		<? } ?>
        </table>
    </div>

	<div id="driver_area">
		<!-- 드라이버 선택시 기사계약서 추가 -->
		<!-- /bbs/ajax.driver_form.php -->
	</div>

	<div id="accnt_area">
		<!-- 회원공통 은행정보 추가 -->
		<!-- /bbs/ajax.accnt_from.php -->
	</div>
    
    <div class="btn_confirm">
        <input type="submit" value="<?php echo $w==''?'회원가입':'정보수정'; ?>" id="btn_submit" class="btn_submit" accesskey="s">
        <a href="<?php echo G5_URL; ?>/" class="btn_cancel">취소</a>
    </div>
    </form>

	<!------------------- 사인하기 모달 시작 -->
	<div class="modal fade modalS" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-body" id="pad_load">
			<h1 style="margin-bottom: 10px">11</h1>
			<!-- pad load -->
			<form method="POST" name="pfrm">
				<input type="hidden" id="sign_type">
				<div class="pad_bg"><canvas class="pad" id="sign_pad"></canvas></div>
				<fieldset style="margin-top: 5px;"><input type="reset" class="btn btn-default" value="서명 다시하기" /></fieldset>
			</form>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="sign_ok" onclick="signSubmit()">확인</button>
			<button type="button" class="sign_close" data-dismiss="modal" aria-label="Close">취소</button>
		  </div>
		</div>
	  </div>
	</div><!--.modalS-->
	<!------------------- 사인하기 모달 끝 -->

	<!-------------------은행계좌변경 모달 시작 -->
	<div class="modal fade modalS" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
		<form method="POST" name="bkfrm" id="bkfrm" onsubmit="return editFrm(this);">
			<input type="hidden" name="edit_nc_tid" id="edit_nc_tid" value="">
			<div class="modal-content">
			  <div class="modal-body">
					<div class="bank_area">
						<div class="tbl_frm01 tbl_wrap">
							<table>
							<caption>은행정보변경</caption>
							<tbody>
							<tr>
								<th scope="row"><label for="edit_mb_6">은행</label></th>
								<td>
									<select name="edit_mb_6" id="edit_mb_6" class="frm_input" required>
										<option value="">은행선택</option>
										<? foreach ($bank_list as $key=>$val) { ?>
										<option value="<?=$key?>"><?=$val?></option>
										<? } ?>
									</select>
								</td>
							</tr>
							<tr>
								<th scope="row"><label for="edit_mb_7">계좌번호</label></th>
								<td><input type="number" id="edit_mb_7" name="edit_mb_7" value="" class="frm_input f_num f_edit" required></td>
							</tr>
							<tr>
								<th scope="row"><label for="edit_mb_8">예금주</label></th>
								<td>
									<input type="text" id="edit_mb_8" name="edit_mb_8" value="" class="frm_input f_edit" maxlength="20" required style="width:calc(100% - 65px)">
									<button type="button" class="btn btn-success" id="nameChk2" style="width:60px;">인증</button>
								</td>
							</tr>
							<tr>
								<th scope="row"><label for="edit_mb_10">생년월일</label></th>
								<td><input type="number" id="edit_mb_10" name="edit_mb_10" value="" class="frm_input f_num" required maxlength="10"><div style="color: #777;font-size: 0.9em;">생년월일(6자리) 또는 사업자번호(10자리)</div></td>
							</tr>
							<tr>
								<th scope="row"><label for="edit_upload_mb_9">면허증사본첨부</label></th>
								<td>
									<input type="hidden" name="edit_mb_9" id="edit_mb_9" class="f_edit" value="">
									<input type="file" name="upload_mb_9" id="edit_upload_mb_9" class="frm_input f_edit" accept="image/*" onchange="uploadImg(this, 'edit')" />
									<div id="bank_img" class="img2"></div>
								</td>
							</tr>
							</tbody>
							</table>
						</div>
					</div>
			  </div>
			  <div class="modal-footer">
				<button type="submit" class="sign_ok">계좌변경완료</button>
				<button type="button" class="sign_close" data-dismiss="modal" aria-label="Close">취소</button>
			  </div>
		</div>
		</form>
	  </div>
	</div><!--.modalS-->
	<!-------------------은행계좌변경 모달 끝 -->

</div>

<link href="<?=G5_URL?>/css/jquery.signaturepad.css" rel="stylesheet">
<script src="<?=G5_URL?>/js/jquery.signaturepad.js"></script>
<script>
var certBoolean=false;
var injungTime=90;
var injungFunc;

// 사인
var api;
var canvas;
var padResize = function(event) {
	canvas.attr({
		height: 250,
		width: window.innerWidth - 36 // padding+border빼기
	});
};

var is_driver = "<? echo ($is_driver)? 'T' : 'F'; ?>";

// 계좌실명인증
var nc_join = false;		// 가입시 계좌실명인증 확인변수
var nc_join_bank = "";		// 가입시 실명인증된 은행코드
var nc_edit = false;		// 수정시
var nc_edit_bank = "";		// 수정시

$(function() {
	// 사인
	api = $('#pad_load form').signaturePad({
		drawOnly: true,
		defaultAction: 'drawIt',
		validateFields: false,
		lineWidth: 0,
		output: null,
		sigNav: null,
		name: null,
		typed: null,
		clear: 'input[type=reset]',
		typeIt: null,
		drawIt: null,
		typeItDesc: null,
		drawItDesc: null,
		penColour: '#000'
	});
	$('#myModal').on('hidden.bs.modal', function (e) {
		$(this).find(".error").remove();
	});

	// 드라이버 폼추가
	$("input[name=mb_level]").on("change", function() {
		getDriverFrm($(this).val());
	});

	// 정보 수정시 드라이버이면 폼추가
	if (is_driver == "T" && document.fregisterform.w.value == "u") {
		getDriverFrm($("input[name=mb_level]").val());
	}

	// 은행정보 폼추가
	getAccntFrm();

	// 인증하기 눌렀을 때
	$("#injung").click(function(){
		getNoti(1, '서비스 준비중입니다.');
		return false;

		if(injungFunc!=undefined){
			clearTimeout(injungFunc);
			injungTime=90;
		}
		var mb_hp=$("#reg_mb_hp").val();
		if(mb_hp.length < 11){
			alert("휴대폰번호 자릿수가 맞지 않습니다.");
			$("#reg_mb_hp").focus();
			return;
		}

		getNoti(1, '서비스 준비중입니다.');
		/*
		$.ajax({
			url:"./ajax.injung.php",
			data:{'mb_hp':mb_hp},
			type:"POST",
			dataType:"HTML",
			success:function(data){
				console.log(data);
				$("#injung-no").css("display","");
				$("#injung-time").css("display","");
				$("#injung-re").val(data);
				injungSleepTime();
			},
			error:function(request,status,error){
				alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
			 }
		});
		*/
	});

	// 인증번호 확인
	$("#injung-success").click(function(){
		if($("#injung-answer").val()!=$("#injung-re").val()){
			alert("인증번호가 맞지 않습니다.");
			return;
		}else{
			clearTimeout(injungFunc);
			injungTime=90;
			$("#injung-success").css("display","none");
			$("#time").html("인증성공");
		}
	});
});

// 계약서내용bind
$(document).on("show.bs.modal", "#myModal2", function(e) {
	$("#cont_name").html($("#mb_3").val());
	$("#cont_jumin").html($("#mb_4").val());
	$("#cont_id").html($("#reg_mb_hp").val());
	$("#cont_hp").html($("#reg_mb_hp").val());
});

// 드라이버 폼추가 (기사계약서)
function getDriverFrm(lv) {
	var el = $("#driver_area");
	var obj = {};
	obj.w = document.fregisterform.w.value;
	obj.mb_id = document.fregisterform.mb_id.value;

	if (lv == "2") {
		el.html("");
		getAccntFrm();
		return false;
	}

	$.ajax({  
		type : "get",  
		url : "./ajax.driver_form.php",
		data : obj,
		dataType : "html",  
		success : function(data) {  
			el.html(data);
		},  
		error : function(xhr,status,error) {
			location.reload();
		},
		complete : function() {
			getAccntFrm();

			// 포인트출금신청 - 은행계좌변경으로 들어온 경우
			if (obj.w == "u" && location.href.indexOf("#acc") > -1) {
				var st = Math.round($(".bank_area").offset().top);
				$(window).scrollTop(st - 100);
			}
		}
	});
}

// 공통 은행정보 호출
function getAccntFrm() {
	var el = $("#accnt_area");
	var obj = {};
	obj.w = document.fregisterform.w.value;
	obj.mb_id = document.fregisterform.mb_id.value;
	obj.mb_lv = document.fregisterform.mb_level.value;
	console.log(obj);

	$.ajax({  
		type : "get",  
		url : "./ajax.accnt_from.php",
		data : obj,
		dataType : "html",  
		success : function(data) {  
			el.html(data);
		},  
		error : function(xhr,status,error) {
			location.reload();
		},
		complete : function() {
			// 포인트출금신청 - 은행계좌변경으로 들어온 경우
			if (obj.w == "u" && location.href.indexOf("#acc") > -1) {
				var st = Math.round($(".bank_area").offset().top);
				$(window).scrollTop(st - 100);
			}
		}
	});
}

// 사인하기 오픈
function openSignPad(type) {
	$('#myModal').modal('show');
	canvas = $('canvas');

	$("#sign_type").val(type);
	var subj = (type == "sign")? "계약서 사인하기" : "이름 서명하기";
	$("#pad_load > h1").html(subj);

	window.addEventListener('orientationchange', padResize, false);
	window.addEventListener('resize', padResize, false);
	padResize();
}

// 사인 업로드
function signSubmit() {
	if (!api.validateForm()) {
		return false;
	}

	var sign = document.getElementById("sign_pad").toDataURL("image/png");
	sign = sign.replace('data:image/png;base64,', '');
	var sign_type = $("#sign_type").val();

	$.ajax({  
		type : "post",  
		url : g5_bbs_url + "/ajax.sign_upload.php",
		data : {"sign" : sign, "page" : "driver", "sign_type" : sign_type},
		dataType : "text",  
		success : function(json) {
			var data = JSON.parse(json);
			console.log(data);

			var fd = "";
			var area = "";

			if (sign_type == "sign") {
				fd = document.fregisterform.mb_5;	// 사인필드
				area = $("#sign_area");
			} else {
				fd = document.fregisterform.mb_12;	// 이름서명필드
				area = $("#nm_sign_area");
			}

			if (data.result == "T" && fd != "") {	// 사인완료
				fd.value = data.file;
				$('#myModal').modal('hide');
				var img = $('<img src="<?=G5_SIGN_URL?>/'+ data.file +'" style="max-height: 70px;width:auto;">');
				area.show().find(".sign_img").html(img);
			} else {
				getNoti(1, "사인등록에 실패하였습니다. 다시 시도해 주세요.");
				fd.value = "";
			}

			/*
			var mb_5 = document.fregisterform.mb_5;	// 사인필드
			if (data.result == "T") {
				// 사인완료
				mb_5.value = data.file;
				$('#myModal').modal('hide');
				var img = $('<img src="<?=G5_SIGN_URL?>/'+ data.file +'" style="max-height: 70px;width:auto;">');
				$("#sign_area").show().find(".sign_img").html(img);
			} else {
				getNoti(1, "사인등록에 실패하였습니다. 다시 시도해 주세요.");
				mb_5.value = "";
			}
			*/
		},  
		error : function(xhr,status,err) {
			getNoti(1, "사인등록에 실패하였습니다. 다시 시도해 주세요.");
			console.log(err);
		}
	});
}

// submit 최종 폼체크
function fregisterform_submit(f)
{
	if (f.w.value == "") {
		// 회원 로그인용 아이디 생성
		var id_chk = false;
		var msg = "아이디 중복조회에 실패하였습니다. 다시 시도해 주세요.";
		$.ajax({ 
			type : "post",  
			url : g5_bbs_url + "/ajax.mb_login_id.php",
			data : {"agency_no" : f.agency_no.value, "mb_hp" : f.mb_hp.value, "reg_page" : "app"},
			dataType : "json", 
			async : false,
			success : function(data) { 
				if (data.result == true) {
					f.mb_id.value = data.login_id;
					id_chk = true;

				} else {
					if (data.msg.length > 0)	msg = data.msg;
				}
			},  
			error : function(xhr,status,error) {
				getNoti(1, "아이디 중복조회에 실패하였습니다. 다시 시도해 주세요.");
				return false;
			},
		});

		if (!id_chk) {
			getNoti(1, msg);
			return false;
		}

		if (f.mb_password.value.length < 3) {
			getNoti(1, '비밀번호를 3글자 이상 입력하십시오.');
			f.mb_password.focus();
			return false;
		}
	}

	if (f.mb_password.value != f.mb_password_re.value) {
		getNoti(1, '비밀번호가 같지 않습니다.');
		f.mb_password_re.focus();
		return false;
	}

	if (f.mb_password.value.length > 0) {
		if (f.mb_password_re.value.length < 3) {
			getNoti(1, '비밀번호를 3글자 이상 입력하십시오.');
			f.mb_password_re.focus();
			return false;
		}
	}
	
	/*
	// 휴대폰 인증검사
	if (f.w.value == "") {
		if($("#injung-answer").val()==""){
			getNoti(1, "휴대폰 인증을 하십시오");
			return false;
		}

		if($("#injung-answer").val()!=$("#injung-re").val()){
			getNoti(1, "휴대폰 인증번호가 맞지 않습니다");
			return false;
		}
		if($("#time").html()!="인증성공"){
			getNoti(1, "휴대폰 인증을 하십시오");
			return false;
		}
	}
	*/

	// 드라이버 가입& 수정
	var dr_chk = false;
	if (f.w.value == "" && f.mb_level.value == "1") dr_chk = true;
	if ($("#reg_req").length > 0) dr_chk = true;	// 기사계약서동의부분
	if (f.w.value == "u" && is_driver == "T") dr_chk = true;
	if (f.w.value == "u" && $("#mb_user_acc").val() == "Y") nc_join = true;	// 계좌승인받은 기사

	// 드라이버 가입이면 기사계약서, 은행정보 체크, 서명체크
	if (dr_chk) {
		if (!nc_join) {
			getNoti(1, "인증을 눌러 은행정보 인증을 받으셔야 합니다.");
			return false;
		}

		if (!$("#reg_req").prop("checked") && $("#reg_req").length > 0) {
			getNoti(1, "기사 계약서 약관동의를 체크해주세요.");
			return false;
		}

		if (f.mb_5.value == "") { //if (!api.validateForm() || f.mb_5.value == "") {
			getNoti(1, "기사 계약서의 사인하기가 완료되지 않았습니다. [사인하기] 버튼을 눌러 사인을 입력하세요.");
			$(".error").remove();
			return false;
		}

		if (f.mb_12.value == "") {
			getNoti(1, "기사 계약서의 이름서명이 완료되지 않았습니다. [이름서명하기] 버튼을 눌러 이름을 입력하세요.");
			$(".error").remove();
			return false;
		}

	} else {
		// 일단추가
		if (!nc_join) {
			getNoti(1, "인증을 눌러 은행정보 인증을 받으셔야 합니다.");
			return false;
		}
	}

	document.getElementById("btn_submit").disabled = "disabled";
	return true;
}

// 면허증사본첨부
function uploadImg(input, mode) {
	var reg_ext = /(.*?)\.(jpg|jpeg|png)$/;

	if (!reg_ext.test(input.files[0].name)) {
		getNoti(1, "이미지만 등록이 가능합니다. (jpg, jpeg, png)");
		$("#upload_mb_9").val("");
		return false;
	}

	// 최대용량 체크
	var	max_size_mb = 5, //5mb
		max_byte = max_size_mb * 1024 * 1024,
		file_byte = input.files[0].size;
	
	if (file_byte > max_byte) {
		getNoti(1, "최대 용량 (" + max_size_mb + "mb)을 초과합니다.");
		$("#upload_mb_9").val("");
		return false;
	}

	// 업로드 진행
	var frm = $("#fregisterform")[0];
	var frm_data = new FormData(frm);

	if (mode == "edit") {	// 은행계좌변경
		frm = $("#bkfrm")[0];
		frm_data = new FormData(frm);
	}

	$('#page_loader').show();

	setTimeout(function() {
		$.ajax({  
			type : "POST",  
			url : "./ajax.driver_form_img.php",
			data : frm_data,
			processData : false,
			contentType : false,
			async : false,
			//beforeSend: function() {
			//	$('#page_loader').show();
			//},
			success : function(json) {
				var data = JSON.parse(json);
				var img_area = $("#bank_img.img1");

				if (data.result == "T") {
					if (mode == "edit") {	// 은행계좌변경
						img_area = $("#bank_img.img2");
						$("#edit_mb_9").val(data.file);
					} else {
						$("#mb_9").val(data.file);
					}
					var _src = g5_url + "/data/bank/" + data.file;
					var _img = $("<img src='"+ _src +"'>");
					img_area.html(_img);

				} else {
					getNoti(1, "첨부에 실패하였습니다. 다시 시도해 주세요.");
				}
			},  
			error : function(xhr,status,error) {
				//console.log(error);
				getNoti(1, "첨부에 실패하였습니다. 다시 시도해 주세요.");
			},
			complete: function() {
				$('#page_loader').hide();
			}
		});
	}, 200);
}

// 은행계좌변경
function openBankPop() {
	$("#edit_mb_6 option:eq(0)").prop("selected", true);
	$("#myModal3 .f_edit").val("");
	$("#bank_img.img2").html("");
	$('#myModal3').modal('show');
}

// 계좌변경 submit
function editFrm(f) {
	//console.log(f);
	var obj = {};
	obj.mb_id = document.fregisterform.mb_id.value;
	obj.mb_6 = f.edit_mb_6.value;	//은행
	obj.mb_7 = f.edit_mb_7.value;	//계좌
	obj.mb_8 = f.edit_mb_8.value;	//예금주
	obj.mb_9 = f.edit_mb_9.value;	//면허증사본
	obj.mb_10 = f.edit_mb_10.value;	//생년월일
	obj.mb_tid = f.edit_nc_tid.value;	//실명인증 tid

	if (!nc_edit || obj.mb_tid == "") {
		getNoti(1, "은행정보 인증을 받으셔야 합니다");
		return false;
	}

	$('#page_loader').show();

	setTimeout(function() {
		$.ajax({
			type : "POST",  
			url : "./ajax.driver_form_edit.php",
			data : obj,
			//contentType : false,
			async : false,
			dataType: "json",
			success : function(data) {
				//var data = JSON.parse(json);
				//console.log(data);
				if (data.result == "T") {
					swal("계좌변경완료", "은행정보가 변경되었습니다. 관리자의 승인이 완료되면 포인트 출금신청이 가능합니다.", "success", {
					  button: "확인",
					}).then(function(result) {
						location.reload();
					});
				} else {
					getNoti(1, "계좌변경에 실패하였습니다. 다시 시도해 주세요.");
				}
			},  
			error : function(xhr,status,error) {
				//console.log(error);
				getNoti(1, "계좌변경에 실패하였습니다. 다시 시도해 주세요.");
			},
			complete: function() {
				$('#page_loader').hide();
			}
		});
	}, 200);

	return false;
}

// 계좌실명인증 bind
$(document).on("click", "#nameChk", function() {
	getNameChk('join');

}).on("click", "#nameChk2", function() {
	getNameChk('edit');

// 계좌번호, 예금주, 생년월일 입력시 공백제거
}).on("keyup", "#mb_7, #mb_8, #edit_mb_7, #edit_mb_8, #edit_mb_10", function() {
	var txt = $(this).val().replace(/ /gi, '');
	$(this).val(txt);

// 계좌인증후 은행코드 변경불가
}).on("change", "#mb_6", function() {
	if (nc_join_bank != "" && nc_join) {
		$(this).val(nc_join_bank).prop("selected", true);
	}
}).on("change", "#edit_mb_6", function() {
	if (nc_edit_bank != "" && nc_edit) {
		$(this).val(nc_edit_bank).prop("selected", true);
	}
});

// 계좌실명인증
function getNameChk(mode) {
	var mb_6 = $("#mb_6");		//은행코드
	var mb_7 = $("#mb_7");		//계좌번호
	var mb_8 = $("#mb_8");		//예금주명
	var mb_10 = $("#mb_10");	//주민번호

	// 1) 가입시
	if (mode == 'join') {
		if (nc_join) {
			getNoti(1, "계좌인증이 완료되었습니다.");
			return false;
		}
	
	// 2) 수정시
	} else if (mode == 'edit') {
		if (nc_edit) {
			getNoti(1, "계좌인증이 완료되었습니다.");
			return false;
		}

		mb_6 = $("#edit_mb_6");
		mb_7 = $("#edit_mb_7");
		mb_8 = $("#edit_mb_8");
		mb_10 = $("#edit_mb_10");
	}
	
	if (mb_6.val() == "") {
		getNoti(1, "은행을 선택하세요.");
		return false;
	}

	if (mb_7.val().length < 1) {
		getNoti(1, "계좌번호를 입력하세요.");
		return false;
	}

	if (mb_10.val().length < 6) {
		getNoti(1, "생년월일(6자리) 또는 사업자번호(10자리)를 입력하세요.");
		return false;
	}

	if (mb_8.val().length < 1) {
		getNoti(1, "예금주명을 입력하세요.");
		return false;
	}

	var obj = {};
	obj.bankCode = mb_6.val();
	obj.acntNo = mb_7.val();
	obj.idNo = mb_10.val();
	obj.acntNm = mb_8.val();
	obj.mode = mode;

	$.ajax({
		type : "post",  
		url : g5_bbs_url + "/ajax.acc_namechk.php",
		data : obj,  
		dataType : "json",  
		async : false,
		success : function(data) {  
			console.log(data);
			//var msg = (data.err_msg != "")? data.err_msg : "계좌인증에 실패하였습니다. 다시 시도해 주세요.";
			var msg = "계좌인증에 실패하였습니다. 다시 시도해 주세요.";
			if (data.err_msg != "") msg = data.err_msg;

			// 1) 가입시
			if (mode == 'join') {
				if (data.result == "T") {
					getNoti(1, "계좌인증이 완료되었습니다.");
					nc_join = true;
					nc_join_bank = $("#mb_6").val();

					$("#mb_7, #mb_8, #mb_10").prop("readonly", true);
					$("#mb_user_acc").val("Y");
					$("#mb_namechk_tid").val(data.list.tid);

				} else {
					getNoti(1, msg);
					$("#mb_user_acc").val("N");
					$("#mb_namechk_tid").val("");
				}

			// 2) 수정시
			} else if (mode == 'edit') {
				if (data.result == "T") {
					getNoti(1, "계좌인증이 완료되었습니다.");
					nc_edit = true;
					nc_edit_bank = $("#edit_mb_6").val();

					$("#edit_mb_7, #edit_mb_8, #edit_mb_10").prop("readonly", true);
					$("#edit_nc_tid").val(data.list.tid);

				} else {
					getNoti(1, msg);
					$("#edit_nc_tid").val("");
				}
			}
		},  
		error : function(xhr,status,error) {
			console.log(error);
		}
	});

}


/*
var cert = "";
var si;
//인증요청버튼 누르면
$("#cert_btn").click(function (){
	if(si!=null){
		clearInterval(si);
	}
	var tg = $(this);//인증요청버튼 값을 담는다
	var wr_1 = $("#wr_1").val();//넘어온 이벤트명을 담는다.		
	var mb_hp = $("#reg_mb_hp").val();//휴대폰번호1를 담는다.
	//var mb_hp1 = $("#mb_hp1").val();//휴대폰번호1를 담는다.
	//var mb_hp2 = $("#mb_hp2").val();//휴대폰번호2를 담는다.
	//var mb_hp3 = $("#mb_hp3").val();//휴대폰번호3를 담는다.
	
	//휴대폰번호 입력확인
	if(!mb_hp){
		alert("연락처를 입력해주세요.");
		return false;
	}

});
//인증번호 입력시 30초 카운터다운 함수
function injungSleepTime(){
	if(injungTime<0){
		clearTimeout(injungFunc);
		injungTime=90;
		return;
	}
	$("#time").html(injungTime+"초");
	injungTime--;
	injungFunc=setTimeout("injungSleepTime()","1000");
}
*/
</script>