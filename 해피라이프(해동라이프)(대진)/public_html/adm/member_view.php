<?php
$sub_menu = "200100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$g5['title'] .= '회원상세';
include_once('./admin.head.php');

$mb = get_member($mb_id);

if (!$mb['mb_id'])
	alert('존재하지 않는 회원자료입니다.');
?>
<style>
.btn.write {float: right; font-size: 1em; margin-bottom: 5px;}
</style>
<div class="tbl_frm01 tbl_wrap">
	<input type="hidden" name="mb_id" id="mb_id" value="<?=$mb_id?>">

	<h2 class="h2_frm">기본정보</h2>
    <table>
    <colgroup>
        <col width="13%">
        <col width="20%">
        <col width="13%">
        <col width="20%">
		<col width="13%">
        <col width="*">
    </colgroup>
	<tbody>
	<tr>
		<th scope="row">가입구분</th>
        <td><?=$member_group[$mb['mb_group']]?></td>
		<th scope="row">아이디</th>
        <td><?=$mb['mb_id']?></td>
		<th scope="row">이름</th>
        <td><?=$mb['mb_name']?></td>
	</tr>
	<tr>
		<th scope="row">성별</th>
        <td><?=$mb['mb_sex']?></td>
		<th scope="row">생년월일</th>
        <td><?=$mb['mb_birth']?></td>
		<th scope="row">E-mail</th>
        <td><?=$mb['mb_email']?></td>
	</tr>
	<tr>
		<th scope="row">휴대폰번호</th>
        <td><?=$mb['mb_hp']?></td>
		<th scope="row">가입경로</th>
        <td><?=$mb['mb_route']?></td>
		<th scope="row">회원가입일</th>
        <td><?=$mb['mb_datetime']?></td>
	</tr>
	<tr>
		<th scope="row">주소</th>
        <td colspan="5">
			<?
			$mb_addr = "";
			if ($mb['mb_zip1'] && $mb['mb_zip2']) $mb_addr .= "(".$mb['mb_zip1'].$mb['mb_zip2'].") ";
			if ($mb['mb_addr1']) $mb_addr .= $mb['mb_addr1'];
			if ($mb['mb_addr2']) $mb_addr .= "<br>".$mb['mb_addr2'];

			echo $mb_addr;
			?>
		</td>
	</tr>
	<tr>
		<th scope="row">회사주소</th>
        <td colspan="5">
			<?
			$mb_cp_addr = "";
			if ($mb['mb_cp_zip']) $mb_cp_addr .= "(".$mb['mb_cp_zip'].") ";
			if ($mb['mb_cp_addr1']) $mb_cp_addr .= $mb['mb_cp_addr1'];
			if ($mb['mb_cp_addr2']) $mb_cp_addr .= "<br>".$mb['mb_cp_addr2'];

			echo $mb_cp_addr;
			?>
		</td>
	</tr>
	<tr>
		<th scope="row">가입비</th>
        <td><?=number_format($mb['mb_bank_amt']);?></td>
		<th scope="row">입금확인일</th>
        <td colspan="3"><? echo ($mb['mb_bank_date'] != '')? $mb['mb_bank_date'] : "미입금"; ?></td>
	</tr>
	</tbody>
	</table>

	<h2 class="h2_frm">증정품 정보</h2>
	<table class="blue">
    <colgroup>
        <col width="13%">
        <col width="20%">
        <col width="13%">
        <col width="20%">
		<col width="13%">
        <col width="*">
    </colgroup>
	<tbody>
	<tr>
		<th scope="row">증정품 선택</th>
        <td>
			<?
			$rs = sql_fetch("SELECT gf_name FROM g5_gift WHERE idx = '{$mb['mb_gift_idx']}'");
			echo $rs['gf_name'];
			?>
		</td>
		<th scope="row">증정품 주소</th>
        <td colspan="3">
			<?
			$mb_addr = "";
			if ($mb['mb_gift_zip']) $mb_addr .= "(".$mb['mb_gift_zip'].") ";
			if ($mb['mb_gift_addr1']) $mb_addr .= $mb['mb_gift_addr1'];
			if ($mb['mb_gift_addr2']) $mb_addr .= "<br>".$mb['mb_gift_addr2'];

			echo $mb_addr;
			?>
		</td>
	</tr>
	</tbody>
	</table>

	<h2 class="h2_frm">상담내역 <button type="button" class="btn btn_03 write" onclick="getFrmLoad();">상담등록</button></h2>
	<div id="consult_load"><!-- adm/ajax.member_consult.php --></div>
	

	<h2 class="h2_frm">행사내역</h2>
	<div id="funeral_load"><!-- adm/ajax.member_funeral.php --></div>
	

	<div class="btn_fixed_top">
		<button type="button" onclick="history.back();" class="btn btn_02">목록</button>
	</div>

</div>


<!-- Modal -->
<div class="modal fade" id="regFrm" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header"><h1>상담내역</h1></div>
			<div class="modal-body" id="frm_load">
			...
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn_01" onclick="frmSubmit();">등록완료</button>
				<button type="button" class="btn btn_02" data-dismiss="modal">닫기</button>
			</div>
		</div>
	</div>
</div>


<link rel="stylesheet" href="<?=G5_CSS_URL?>/bootstrap.modal.css">
<script src="<?=G5_JS_URL?>/bootstrap.modal.js"></script>
<script src="<?=G5_JS_URL?>/jquery.serializeObject.js"></script>
<script>
$(function() {
	getInnerList(1);	// 상담내역
	getInnerList(2);	// 행사내역
});


// 리스트 호출
function getInnerList(mode, page) {
	var mb_id = document.getElementById('mb_id').value;
	var url, wrap;

	if (typeof page == 'undefined') {
		page = 1;
	}

	if (mode == 1) {
		url = './ajax.member_consult.php';
		wrap = $("#consult_load");
	} else {
		url = './ajax.member_funeral.php';
		wrap = $("#funeral_load");
	}

	$.ajax({  
		type : "get",  
		url : url,
		data : {'mb_id' : mb_id, 'page' : page},
		dataType : "html",  
		success : function(html) {  
			wrap.html(html);
		}, 
		error : function(xhr,status,error) {
		}
	});
}

// 상담등록 폼
function getFrmLoad(idx) {
	var mb_id = document.getElementById('mb_id').value;

	if (typeof idx == 'undefined') {
		idx = '';
	}

	$.ajax({  
		type : 'post',  
		url : './ajax.member_consult_update.php',
		data : {'mode' : 'load', 'mb_id' : mb_id, 'idx' : idx},
		dataType : "html",  
		success : function(html) {  
			$("#frm_load").html(html);
			$('#regFrm').modal('show');
		}, 
		error : function(xhr,status,error) {
			alert('상담등록 폼을 불러오는데 실패하였습니다. 다시 시도해 주세요.');
		}
	});
}


// 상담등록 처리
function frmSubmit() {
	var obj = $("#frm").serializeObject();

	if (obj.cs_date.length == 0) {
		alert('상담일자를 입력하세요.');
		$("#frm [name=cs_date]").focus();
		return false;
	}

	if (obj.cs_memo.length == 0) {
		alert('상담내용을 입력하세요.');
		$("#frm [name=cs_memo]").focus();
		return false;
	}

	if (obj.cs_name.length == 0) {
		alert('작성자를 입력하세요.');
		$("#frm [name=cs_name]").focus();
		return false;
	}

	obj.mode = 'update';
	
	$.ajax({  
		type : 'post',  
		url : './ajax.member_consult_update.php',
		data : obj,
		dataType : "text",  
		success : function(result) {  
			if (result == "T") {
				getInnerList(1);
			} else {
				alert('상담등록을 처리하는데 실패하였습니다. 다시 시도해 주세요.');
			}
		}, 
		error : function(xhr,status,error) {
			alert('상담등록을 처리하는데 실패하였습니다. 다시 시도해 주세요.');
		},
		complete : function() {
			$('#regFrm').modal('hide');
		}
	});
}

// 상담삭제
function frmDelete(idx) {
	if (!confirm("선택하신 상담을 삭제하시겠습니까?")) {
		return false;
	}

	$.ajax({  
		type : 'post',  
		url : './ajax.member_consult_update.php',
		data : {'mode' : 'delete', 'idx' : idx},
		dataType : "text",  
		success : function(result) {  
			if (result == "T") {
				getInnerList(1);
			} else {
				alert('삭제에 실패하였습니다. 다시 시도해 주세요.');
			}
		}, 
		error : function(xhr,status,error) {
			alert('삭제에 실패하였습니다. 다시 시도해 주세요.');
		},
		complete : function() {
			getInnerList(1);
		}
	});
}


</script>

<?php
include_once('./admin.tail.php');
?>

