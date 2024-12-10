<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 100);
add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js
?>
<script src="<?php echo G5_JS_URL ?>/jquery.register_form.js"></script>

<div class="mbskin">
    <form name="fregisterform" id="fregisterform" action="./agency_update.php" onsubmit="return fregisterform_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
    <input type="hidden" name="w" value="<?php echo $w ?>">
	<!-- 승인여부 -->
    <input type="hidden" name="mb_use" value="N">
	<input type="hidden" name="mode" value="agency">
	<input type="hidden" name="mb_level" value="9">
	
    <div class="tbl_frm01 tbl_wrap">
        <table>
        <caption>대리점 정보 입력</caption>
		<tr>
            <th scope="row">대리점명</th>
            <td><input placeholder="대리점명" type="text" id="reg_mb_nick" name="mb_nick" value="" class="frm_input" required></td>
        </tr>
		<tr>
            <th scope="row">대표번호</th>
            <td>
				<input placeholder="대리점 대표번호" type="text" id="reg_mb_11" name="mb_11" value="" class="frm_input" maxlength="20" required>
				<p style="font-size: 12px; color: #777; margin: 5px 0 0; line-height: 1.1;">어플 상단에 노출되는 대표번호이므로, 정확히 기입해 주세요.</p>
			</td>
        </tr>
		<tr>
            <th scope="row">아이디</th>
            <td><input placeholder="아이디" type="text" name="mb_id" value="" id="reg_mb_id" class="frm_input" minlength="3" maxlength="20" required></td>
        </tr>
			<tr>
            <th scope="row">비밀번호</th>
            <td><input placeholder="비밀번호" type="password" name="mb_password" id="reg_mb_password" class="frm_input" minlength="4" maxlength="20" required></td>
        </tr>
        <tr>
            <th scope="row">비밀번호 확인</th>
            <td><input placeholder="비밀번호 확인" type="password" name="mb_password_re" id="reg_mb_password_re" class="frm_input" minlength="4" maxlength="20" required></td>
        </tr>
		<tr>
            <th scope="row">이름</th>
            <td>
                <input placeholder="이름" type="text" id="reg_mb_name" name="mb_name" value="" class="frm_input" required>
            </td>
        </tr>
        <tr>
            <th scope="row">연락처</th>
            <td><input placeholder="연락처" type="tel" id="reg_mb_hp" name="mb_hp" value="" class="frm_input f_num" required></td>
        </tr>
        <tr>
            <th scope="row">주소</th>
            <td>
				<?
				$addr_event = "open_zip('fregisterform', 'mb_zip', 'mb_addr1', 'mb_addr2');";
				?>
                <input type="text" name="mb_zip" value="" id="reg_mb_zip" required class="frm_input" size="5" maxlength="6" placeholder="우편번호">
                <button type="button" class="btn_frmline" onclick="<?=$addr_event?>">주소 검색</button><br>
                <input type="text" name="mb_addr1" value="" id="reg_mb_addr1" class="frm_input frm_address" required placeholder="기본주소" onclick="<?=$addr_event?>"><br>
                <input type="text" name="mb_addr2" value="" id="reg_mb_addr2" class="frm_input frm_address" placeholder="상세주소">
            </td>
        </tr>
		<tr>
            <th scope="row">사업자등록번호</th>
            <td><input placeholder="사업자등록번호" type="tel" id="reg_mb_1" name="mb_1" value="" class="frm_input f_num" maxlength="12" required></td>
        </tr>
		<tr>
            <th scope="row">사업자등록증</th>
            <td><input type="file" name="upload_mb_2" class="frm_input" accept="image/*" required /></td>
        </tr>
    </table>
    </div>
 	<!--대리점계약서 동의 시작-->
    <div id="join_agree">
        <h2>대리점계약서</h2>
        <div class="ja_txt">대리점 계약서 약관 동의 후 가입이 가능합니다.</div>
        
        <div class="ja_box">
            <div class="row join_ag">
                <div class="chk_ico" data-for="reg_req">
                    <input type="checkbox" name="reg_req" id="reg_req" value="1">
                    <label for="reg_req">대리점 계약서 약관동의(필수) </label>
                </div>
                <button type="button" class="btn_jac" data-toggle="modal" data-target="#myModal2"><span class="btn_jacv">내용보기</span></button>
            </div><!--.join_ag-->
                
            <div class="ja_sign">
            	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <th scope="row">(을)성명</th>
                    <td><input placeholder="성명" type="text" name="mb_3" id="reg_mb_3" value="" class="frm_input" maxlength="12" required></td>
                  </tr>
                  <tr>
                    <th scope="row">주민번호</th>
                    <td><input placeholder="앞자리 6" type="number" name="mb_4" id="reg_mb_4" value="" class="frm_input f_num" maxlength="6" minlength="6" required></td>
                  </tr>
				  <tr>
                    <th scope="row">이름서명</th>
                    <td>
						<input type="hidden" name="mb_12" value=""><!-- 이름서명파일명 -->
						<button type="button" class="btn_sign sign_before" onclick="openSignPad('name')">이름서명하기</button>
						<!--사인이미지 영역 -->
						<div id="nm_sign_area" class="sign_area" style="display: none;">
							<div class="sign_img"></div>
						</div>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">사인</th>
                    <td>
						<input type="hidden" name="mb_5" value=""><!-- 사인파일명 -->
						<button type="button" class="btn_sign sign_before" onclick="openSignPad('sign')">사인하기</button>
						<!--사인이미지 영역 -->
						<div id="sign_area" class="sign_area" style="display: none;">
							<div class="sign_img"></div>
						</div>
                    </td>
                  </tr>
                </table>
            </div><!--.ja_sign-->
        </div> <!--ja_box-->   
    </div><!--//join_agree-->
    
        <!------------------- 계약서 내용 시작 -->
        <div class="modal fade modalC" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-body">
                <p>콜 위탁 수행 이행계약서 탁송, 대리운전 T대리 어플리케이션 T대리점 및 T지사 운영 계약서</p>
                    <p><br>
                    </p><p>&nbsp;</p>
                    <p>- (갑)상호(회사명): 주식회사 티대리</p>
                    <p>- 사업자 등록번호 : 735-86-01545</p>
                    <p>- (을) 성명: <span id="cont_name"></span></p>
                    <p>- 주민번호(앞자리 6): <span id="cont_jumin"></span></p>
                    <p>- T대리 분양몰 id: <span id="cont_id"></span></p>
                    <p>- 휴대폰번호: <span id="cont_hp"></span></p>
                    <p><br>
                    </p>
                    <?
                    // 대리점 계약서 내용
                    include_once (G5_BBS_PATH."/contract_agc.php");
                    ?>
                <div class="ja_date"><span class="syear"><?=date('Y')?></span>년 <span class="smonth"><?=date('m')?></span>월 <span class="sdate"><?=date('d')?></span>일</div><!--.ja_date-->
              </div>
              <div class="modal-footer">
                <button type="button" class="sign_ok" data-dismiss="modal">확인</button>
              </div>
            </div>
          </div>
        </div><!--.modalC-->
        <!------------------- 계약서 내용 시작 끝 -->
		
 	<!--대리점계약서 동의 끝-->
	<div style="height: 250px;"><!--디바이스에서 스크롤이 없어 공백만듬--></div>


    <div class="btn_confirm">
        <input type="submit" value="<?php echo $w==''?'가입':'정보수정'; ?>" id="btn_submit" class="btn_submit" accesskey="s">
        <a href="<?php echo G5_URL; ?>/" class="btn_cancel">취소</a>
    </div>
    </form>

	<!------------------- 사인하기 모달 시작 -->
	<div class="modal fade modalS" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-body" id="pad_load">
			<h1 style="margin-bottom: 10px">사인하기</h1>
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

</div>


<link href="<?=G5_URL?>/css/jquery.signaturepad.css" rel="stylesheet">
<script src="<?=G5_URL?>/js/jquery.signaturepad.js"></script>
<script>
// 사인
var api;
var canvas;
var padResize = function(event) {
	canvas.attr({
		height: 250,
		width: window.innerWidth - 36 // padding+border빼기
	});
};

$(function() {
	$("#reg_mb_zip").on("focusin", function(){
		open_zip('fregisterform', 'mb_zip', 'mb_addr1', 'mb_addr2');
	});

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

	// 계약서내용bind
	$('#myModal2').on('show.bs.modal', function (e) {
		$("#cont_name").html($("#reg_mb_3").val());
		$("#cont_jumin").html($("#reg_mb_4").val());
		$("#cont_id").html($("#reg_mb_id").val());
		$("#cont_hp").html($("#reg_mb_hp").val());
	});
});

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
		data : {"sign" : sign, "page" : "agency", "sign_type" : sign_type},
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
				$("#sign_area").show();
				$("#sign_area div").html(img);
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
function fregisterform_submit(f) {

	// 회원아이디 검사
	if (f.w.value == "") {
		var msg = reg_mb_id_check();
		msg = msg.replace(/\r\n/g, "");	//엔터제거
		if (msg != "") {
			getNoti(1, msg);
			f.mb_id.focus();
			return false;
		}
		
		if (f.mb_password.value.length < 3) {
			getNoti(1, '비밀번호를 3글자 이상 입력하세요.');
			return false;
		}
	}

	if (f.mb_password.value != f.mb_password_re.value) {
		getNoti(1, '비밀번호가 같지 않습니다.');
		return false;
	}

	if (f.mb_password.value.length > 0) {
		if (f.mb_password_re.value.length < 3) {
			getNoti(1, '비밀번호 확인을 3글자 이상 입력하세요.');
			return false;
		}
	}

	if (f.upload_mb_2.value == "") {
		getNoti(1, "사업자등록증을 첨부하세요.");
		return false;
	}

	if (!$("#reg_req").prop("checked")) {
		getNoti(1, "대리점 계약서 약관동의를 체크해주세요.");
		return false;
	}

	if (!api.validateForm() || f.mb_5.value == "") {
		getNoti(1, "대리점 계약서의 사인하기가 완료되지 않았습니다. [사인하기] 버튼을 눌러 사인을 입력하세요.");
		$(".error").remove();
		return false;
	}

	document.getElementById("btn_submit").disabled = "disabled";
	return true;
}
</script>