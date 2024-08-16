<?php
$sub_menu = "200200";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$g5['title'] = '회원문자발송';
include_once('./admin.head.php');

?>
<style>
#box_wrap .tbl_wrap {vertical-align: top;}
#box_wrap .left {width: 50%; display: inline-block; height: 600px; overflow-y: scroll;}
#box_wrap .local_sch01 {margin: 0 0 5px;}
#box_wrap .local_sch01 select {height: 30px;}
#box_wrap .right {width: 47%; display: inline-block; margin-left: 1%; }
#box_wrap .right textarea {height: 300px; resize: none; line-height: 1.6; font-size: 1.1em; vertical-align: middle;}
#box_wrap .right input {vertical-align: middle;}
#box_wrap .right td {padding-left: 5px;}
#box_wrap .hide {position: absolute; width: 0; height: 0; opacity: 0; left: -99999px; top: -9999px; z-index: -1;}
#img_area img {max-height: 250px; margin: 5px 0;}
</style>

<div id="box_wrap">
<!--<form name="flist" id="flist" method="post" autocomplete="off" onsubmit="return frmSubmit(this)">-->

	<!-- 검색창 -->
	<div class="local_sch01">
		<select name="s_type" onchange="getMemberList(this.value)">
			<option value="99">전체회원</option>
			<? foreach ($member_group as $Key=>$val) { ?>
			<option value="<?=$Key?>"><?=$val?></option>
			<? } ?>
		</select>
		<input type="text" name="s_name" class="frm_input" placeholder="이름, 가입경로">
		<input type="button" class="btn_submit" value="검색">
	</div>
	<!-- //검색창 -->

	<!-- 회원목록 -->
	<div class="tbl_head01 tbl_wrap left">
		<table>
		<caption>회원목록</caption>
		<colgroup>
		<col width="10%">
		<col width="10%">
		<col width="20%">
		<col width="25%">
		<col width="30%">
		</colgroup>
		<thead>
		<tr>
			<th><input type="checkbox" id="allChk" name="s_all" value="1"></th>
			<th>No.</th>
			<th>구분</th>
			<th>회원명</th>
			<th>연락처</th>
		</tr>
		</thead>
		<tbody id="mb_list">
			<!-- 회원목록 load -->
			<!-- ajax.sms_member_list.php -->
		</tbody>
		</table>
	</div>

<form name="flist" id="flist" class="right" method="post" autocomplete="off" onsubmit="return frmSubmit(this)">

	<div class="btn_fixed_top">
		<button type="submit" class="btn btn_01">문자발송</button>
	</div>
	
	<!-- 문자발송입력폼 -->
	<div class="tbl_head01 tbl_wrap">
		<table>
		<caption>문자발송 폼</caption>
		<colgroup>
		<col width="20%">
		<col width="80%">
		</colgroup>
		<thead>
		<tr>
			<th>구분</th>
			<td>
				<?
				$sms_type = array(4=>"SMS", 6=>"MMS/LMS");
				$sms_type_msg = array(4=>"(90byte 이하)", 6=>"");
				foreach ($sms_type as $key=>$val) {
				?>
				<input type="radio" name="sms_type" id="stp<?=$key?>" value="<?=$key?>" <? if ($key == 4) echo "checked"; ?>>
				<label for="stp<?=$key?>"><?=$val?> <?=$sms_type_msg[$key]?></label>&nbsp;
				<? } ?>
			</td>
		</tr>
		<tr>
			<th>발신번호</th>
			<td><input type="hidden" name="sms_send_num" value="<?=SMS_SEND_NUM?>"><?=SMS_SEND_NUM?></td>
		</tr>
		<tr>
			<th>문자내용</th>
			<td>
				<textarea name="sms_msg" id="sms_msg"></textarea>
				<div><span id="msg_byte">0</span> byte</div>
			</td>
		</tr>
		<tr id="img_area" class="hide">
			<th>이미지첨부</th>
			<td>
				<input type="file" id="sms_img1" class="sms_files" onchange="imgUpload(1, this)" accept="image/*">
				<div id="sms_img1_prev"></div>

				<input type="file" id="sms_img2" class="sms_files" onchange="imgUpload(2, this)" accept="image/*">
				<div id="sms_img2_prev"></div>
			</td>
		</tr>
		</thead>
		<tbody>
		</tbody>
		</table>
	</div>

	</form>
</div>


<script>
$(function() {
	getMemberList();
	
	// 이름검색 엔터
	$('input[name=s_name]').keydown(function() {
		if (event.keyCode === 13) {
			event.preventDefault();
			getMemberList($("select[name] option:selected").val());
		};
	});

	// 회원전체선택
	$('input#allChk').on('click', function() {
		var flag = $(this).prop('checked');
		$('#mb_list input[type=checkbox]').prop('checked', flag);
	});

	// 목록체크박스 선택시 전체선택 해제
	$(document).on("click", '#mb_list input[type=checkbox]', function() {
		if (!$(this).prop('checked')) {
			$('input#allChk').prop('checked', false);
		};
	});

	// sms구분 선택시 이미지첨부 노출여부
	$("input[name=sms_type]").on("change", function() {
		if (parseInt($(this).val()) == 6) {
			$("#img_area").removeClass("hide");
			// mms초기화
			$("input.sms_files").val('');
			$("input.sms_files+div").html('');

		} else {
			$("#img_area").addClass("hide");
		}
	});

	// 바이트 계산기
	$("textarea#sms_msg").on("keyup", function() {
		var input_byte = byteCheck($(this));
		var chk_type = $("input[name=sms_type]:checked").val();

		$("#msg_byte").html(input_byte);

		if (input_byte > 90 && chk_type == '4') {
			alert('90byte를 초과합니다. LMS로 변경됩니다.');
			$('#stp6').prop("checked", true);
		}
	});

});

// 바이트 byte 계산
function byteCheck(el){
    var codeByte = 0;
    for (var i = 0; i < el.val().length; i++) {
        var oneChar = escape(el.val().charAt(i));
        if ( oneChar.length == 1 ) {
            codeByte ++;
        } else if (oneChar.indexOf("%u") != -1) {
            codeByte += 2;
        } else if (oneChar.indexOf("%") != -1) {
            codeByte ++;
        }
    }
    return codeByte;
}

// 이미지 동적업로드
function imgUpload(num, input) {
	var reg_ext = /(.*?)\.(jpg|jpeg|png)$/;

	if (!reg_ext.test(input.files[0].name)) {
		alert("이미지만 등록이 가능합니다. (jpg, jpeg, png)");
		$(input).val("");
		return false;
	}


	var formData = new FormData();
	formData.append("sms_img", $("#sms_img"+num)[0].files[0]);

	$.ajax({
		url: './ajax.sms_img_upload.php',
		processData: false,
		contentType: false,
		data: formData,
		type: 'POST',
		success: function(result) {
			if (result == "F") {
				alert('이미지 첨부에 실패하였습니다. 다시 시도해 주세요.');
				$("#sms_img"+num).vla("");
			} else {
				var path = '<?=G5_DATA_PATH?>',
					url = '<?=G5_DATA_URL?>';
				var prev = $("#sms_img"+ num +"_prev"),
					img = $("<img src='"+ result +"'>");
					input = $("<input type='hidden' name='sms_img"+ num +"' value='"+ result.replace(url, path) +"'>");

				prev.html('').append(img).append(input);
			}
		}
	});
}

// 회원목록 Load
function getMemberList(group) {
	var f = document.flist;

	if (typeof group == "undefined") {
		group = 99;
	}

	$.ajax({  
		type : "post",  
		url : "./ajax.sms_member_list.php",
		data : {"mb_group" : group, "mb_name" : document.querySelector('[name=s_name]').value},
		dataType : "html",  
		success : function(html) {  
			$("#mb_list").html(html);
			//$('input#allChk').prop('checked', true);
		},  
		error : function(xhr,status,error) {
			alert("회원목록을 불러오는데 실패하였습니다. 다시 시도해 주세요.");
		}
	});
}

// 문자발송
function frmSubmit(f) {
	//var f = document.flist;
	var chk_cnt = $("input[name='sms_chkbox[]']:checked").length;

	if (f.sms_type.value == "") {
		alert("문자 구분을 선택하세요.");
		f.sms_type.focus();
		return false;
	}

	if (f.sms_msg.value == "") {
		alert("문자 내용을 입력하세요.");
		f.sms_msg.focus();
		return false;
	}

	/*
	if (f.sms_type.value == "6" && document.getElementById('sms_img1').value == "") {
		alert("MMS 이미지를 첨부하세요.");
		document.getElementById('sms_img1').focus();
		return false;
	}
	*/

	if (chk_cnt == 0) {
		alert("회원을 선택하세요.");
		//document.getElementById('allChk').focus();
		return false;
	}

	if (confirm("문자를 발송하시겠습니까?")) {
		//f.action = "./send_sms_update.php";
		//return true;

		// 업로드 진행
		var frm = $(f)[0];
		var form_data = new FormData(frm);
		form_data.append("s_type", $("[name=s_type]").val());

		$.each($('input[name="sms_chkbox[]"]:checked'), function(index, el) {
			var mb_no = el.value;
			var mb_id = $("[name='sms_rcv_id["+ mb_no +"]']").val();
			var mb_hp = $("[name='sms_rcv_hp["+ mb_no +"]']").val();

			form_data.append("mb_id["+ mb_no +"]", mb_id);
			form_data.append("mb_hp["+ mb_no +"]", mb_hp);
		});

		var err_msg = "문자발송에 실패했습니다. 잠시 후 다시 시도해 주세요.";

		$.ajax({
			url : "./send_sms_update_ajax.php",
			type : "post",
			processData : false,
			contentType : false,
			data : form_data,
			dataType: "json"
		}).done(function(data, textStatus, xhr) {
			if (data.result) {
				alert('완료되었습니다');
				location.href = './sms_list.php';
			} else {
				alert(err_msg);
			}
		}).fail(function(data, textStatus, errorThrown) {
			alert(err_msg);
		});
	} 
		
	return false;
}

</script>