<?php
$sub_menu = 150100;
include_once('./_common.php');

auth_check($auth[$sub_menu], 'w');

if ($w == '') {
    $required_mb_id = 'required';
    $required_mb_password = 'required';
    $sound_only = '<strong class="sound_only">필수</strong>';
    $html_title = '등록';

    $mb['mb_level'] = 9;
	$mb['mb_use'] = "Y";

} else if ($w == 'u') {
    $mb = get_member($mb_id);

    if (!$mb['mb_id'])
        alert('존재하지 않는 회원자료입니다.');

    if ($member['mb_level'] != "10")
        alert('잘못된 접근입니다.');

    $required_mb_id = 'readonly';
    $required_mb_password = '';
	$sound_only = '';
    $html_title = '수정';

    $mb['mb_name'] = get_text($mb['mb_name']);
    $mb['mb_nick'] = get_text($mb['mb_nick']);
    $mb['mb_hp'] = get_text($mb['mb_hp']);
	/*
    $mb['mb_email'] = get_text($mb['mb_email']);
    $mb['mb_homepage'] = get_text($mb['mb_homepage']);
    $mb['mb_birth'] = get_text($mb['mb_birth']);
    $mb['mb_tel'] = get_text($mb['mb_tel']);
    $mb['mb_addr1'] = get_text($mb['mb_addr1']);
    $mb['mb_addr2'] = get_text($mb['mb_addr2']);
    $mb['mb_addr3'] = get_text($mb['mb_addr3']);
    $mb['mb_signature'] = get_text($mb['mb_signature']);
    $mb['mb_recommend'] = get_text($mb['mb_recommend']);
    $mb['mb_profile'] = get_text($mb['mb_profile']);
    $mb['mb_1'] = get_text($mb['mb_1']);
    $mb['mb_2'] = get_text($mb['mb_2']);
    $mb['mb_3'] = get_text($mb['mb_3']);
    $mb['mb_4'] = get_text($mb['mb_4']);
    $mb['mb_5'] = get_text($mb['mb_5']);
    $mb['mb_6'] = get_text($mb['mb_6']);
    $mb['mb_7'] = get_text($mb['mb_7']);
    $mb['mb_8'] = get_text($mb['mb_8']);
    $mb['mb_9'] = get_text($mb['mb_9']);
    $mb['mb_10'] = get_text($mb['mb_10']);
	*/
} else {
    alert('제대로 된 값이 넘어오지 않았습니다.');
}

$g5['title'] .= '대리점 '.$html_title;
include_once('./admin.head.php');

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js
?>
<script src="<?=G5_URL?>/js/jquery.register_form.js"></script>

<form name="fmember" id="fmember" action="./member_form_update.php" onsubmit="return fmember_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
<input type="hidden" name="w" value="<?php echo $w ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<!--<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">-->
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="">

<input type="hidden" name="mode" value="agency">
<input type="hidden" name="mb_level" value="<?=$mb['mb_level']?>">
<? /*
<?php for ($i=1; $i<=10; $i++) { ?>
<input type="hidden" name="mb_<?php echo $i ?>" value="<?php echo $mb['mb_'.$i] ?>" id="mb_<?php echo $i ?>">
<?php } ?>
*/ ?>

<div class="tbl_frm01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?></caption>
    <colgroup>
        <col width="15%">
        <col width="35%">
        <col width="15%">
        <col width="35%">
    </colgroup>
    <tbody>
	<tr>
		<th scope="row"><label for="mb_use1">승인여부<strong class="sound_only">필수</strong></label></th>
        <td colspan="3">
			<input type="radio" name="mb_use" id="mb_use1" value="Y" <? if ($mb['mb_use'] == "Y") echo "checked"; ?>><label for="mb_use1"> 승인완료</label>&nbsp;
			<input type="radio" name="mb_use" id="mb_use2" value="N" <? if ($mb['mb_use'] != "Y") echo "checked"; ?>><label for="mb_use2"> 미승인</label>
		</td>
	</tr>
	<tr>
        <th scope="row"><label for="mb_nick">대리점명<strong class="sound_only">필수</strong></label></th>
        <td><input type="text" name="mb_nick" value="<?php echo $mb['mb_nick'] ?>" id="mb_nick" class="required frm_input" size="30" maxlength="20" required></td>
		<th scope="row"><label for="mb_11">대리점 대표번호</label></th>
        <td><input type="text" name="mb_11" value="<?php echo $mb['mb_11'] ?>" id="mb_11" class="frm_input" size="30" maxlength="30"></td>
    </tr>
    <tr>
        <th scope="row"><label for="reg_mb_id">아이디<?php echo $sound_only ?></label></th>
        <td>
            <input type="text" name="mb_id" value="<?php echo $mb['mb_id'] ?>" id="reg_mb_id" class="frm_input required" size="30" minlength="3" maxlength="20" <?=$required_mb_id?>>
        </td>
        <th scope="row"><label for="mb_password">비밀번호<?php echo $sound_only ?></label></th>
        <td><input type="password" name="mb_password" id="mb_password" <?php echo $required_mb_password ?> class="frm_input <?php echo $required_mb_password ?>" size="30" maxlength="20"></td>
    </tr>
    <tr>
        <th scope="row"><label for="mb_name">이름<strong class="sound_only">필수</strong></label></th>
        <td><input type="text" name="mb_name" value="<?php echo $mb['mb_name'] ?>" id="mb_name" required class="required frm_input" size="30" minlength="2" maxlength="20"></td>
		<th scope="row"><label for="mb_hp">연락처</label></th>
        <td><input type="text" name="mb_hp" value="<?php echo $mb['mb_hp'] ?>" id="mb_hp" class="frm_input f_num" size="30" maxlength="20"></td>
    </tr>
	<tr>
		<th scope="row">사업자등록번호</th>
        <td colspan="3"><input type="text" name="mb_1" value="<?=getBizNum($mb['mb_1'])?>" id="mb_1" class="frm_input required" size="30" maxlength="12" required></td>
	</tr>
	<tr>
	    <th scope="row"><label for="mb_zip">주소</label></th>
        <td>
			<? $addr_onclick = "win_zip('fmember', 'mb_zip', 'mb_addr1', 'mb_addr2', 'mb_addr3', 'mb_addr_jibeon');"; ?>
            <input type="text" name="mb_zip" value="<?php echo $mb['mb_zip1'].$mb['mb_zip2']; ?>" id="mb_zip" class="frm_input" size="10" maxlength="6" onclick="<?=$addr_onclick?>" placeholder="우편번호">
            <button type="button" class="btn_frmline" onclick="<?=$addr_onclick?>">주소 검색</button><br>
            <input type="text" name="mb_addr1" value="<?php echo $mb['mb_addr1'] ?>" id="mb_addr1" class="frm_input" size="60" placeholder="기본주소"><br>
            <input type="text" name="mb_addr2" value="<?php echo $mb['mb_addr2'] ?>" id="mb_addr2" class="frm_input" size="60" placeholder="상세주소"><br>
            <input type="text" name="mb_addr3" value="<?php echo $mb['mb_addr3'] ?>" id="mb_addr3" class="frm_input" size="60" style="display: none;">
            <input type="hidden" name="mb_addr_jibeon" value="<?php echo $mb['mb_addr_jibeon']; ?>"><br>
        </td>
		<th scope="row"><label for="upload_mb_2">사업자등록증 파일</label></th>
        <td>
			<input type="file" name="upload_mb_2" id="upload_mb_2">
			<? 
			if ($w == "u" && $mb['mb_2'] != "") { 
				$f_size = floor(filesize(G5_DATA_PATH.'/biz/'.$mb['mb_2']) / 1024);
			?>
			<div style="margin: 10px 0 0;">
				<input type="hidden" name="old_mb_2" value="<?=$mb['mb_2']?>">
				<input type="checkbox" name="del_mb_2" id="del_mb_2" value="1">&nbsp;
				<label for="del_mb_2">파일삭제</label>
				<label>|</label>
				<label onclick="getFileDown('<?=$mb['mb_no']?>');" style="cursor:pointer;">파일다운로드(<?=$f_size?>KB)</label>
			</div>
			<? } ?>
		</td>
    </tr>
	<tr>
        <th scope="row"><label for="mb_memo">관리자 메모</label></th>
        <td colspan="3"><textarea name="mb_memo" id="mb_memo"><?php echo $mb['mb_memo'] ?></textarea></td>
    </tr>
	<tr>
	    <th scope="row"><label for="mb_3">계약서<br>(을)성명</label></th>
        <td><input type="text" name="mb_3" value="<?=$mb['mb_3']?>" id="mb_3" class="frm_input" size="30" maxlength="20"></td>
		<th scope="row"><label for="mb_4">계약서<br>주민번호</label></th>
        <td><input type="text" name="mb_4" value="<?=$mb['mb_4']?>" id="mb_4" class="frm_input f_num" size="30" maxlength="6"></td>
	</tr>

    <?php if ($w == 'u') { ?>
	<tr>
		<th scope="row"><label for="">계약서 사인</label></th>
		<td>
			<?
			$sign_chk = false;
			if ($w == "u" && $mb['mb_5'] != "") {
				$img_path = G5_SIGN_PATH."/".$mb['mb_5'];
				if (file_exists($img_path)) {
					$img_url = G5_SIGN_URL."/".$mb['mb_5'];
					$sign_chk = true;
			?>
			<!--<a target="_blank" href="<?=$img_url?>"><img src="<?=$img_url?>" style="max-height: 80px; width: auto; border: 1px solid #EEE;"></a>-->
			<img src="<?=$img_url?>" style="max-height: 80px; width: auto; border: 1px solid #EEE;">
			<?
				}
			}
			if (!$sign_chk) echo "계약서사인 없음";
			?>
		</td>
		<th scope="row"><label for="">이름 서명</label></th>
		<td>
			<?
			$nm_sign_chk = false;
			if ($w == "u" && $mb['mb_12'] != "") {
				$img_path = G5_SIGN_PATH."/".$mb['mb_12'];
				if (file_exists($img_path)) {
					$img_url = G5_SIGN_URL."/".$mb['mb_12'];
					$nm_sign_chk = true;
			?>
			<!--<a target="_blank" href="<?=$img_url?>"><img src="<?=$img_url?>" style="max-height: 80px; width: auto; border: 1px solid #EEE;"></a>-->
			<img src="<?=$img_url?>" style="max-height: 80px; width: auto; border: 1px solid #EEE;">
			<?
				}
			}
			if (!$nm_sign_chk) echo "이름서명 없음";
			?>
		</td>
	</tr>

    <tr>
        <th scope="row">회원가입일</th>
        <td><?php echo $mb['mb_datetime'] ?></td>
        <th scope="row">최근접속일</th>
        <td><?php echo $mb['mb_today_login'] ?></td>
    </tr>
    <?php } ?>

    </tbody>
    </table>
</div>

<div class="btn_confirm01 btn_confirm">
    <input type="submit" value="확인" class="btn_submit" accesskey='s'>
    <a href="./agency_list.php<? if ($qstr != '') echo '?'.$qstr ?>">목록</a>
</div>
</form>

<!-- 포인트 -->
<div id="point_list"><!-- /adm/ajax.point_list.php --></div>
<!-- //포인트 -->

<script>
$(function() {
	// 사업자등록번호
	$("#mb_1").on("keyup", function(e) {
		var _val = $.trim($(this).val());
		$(this).val(validateBiznum(_val));
		console.log(_val);
	});

});
function fmember_submit(f)
{
	/*
    if (!f.mb_icon.value.match(/\.gif$/i) && f.mb_icon.value) {
        alert('아이콘은 gif 파일만 가능합니다.');
        return false;
    }
	*/

	if (f.w.value == "") {
		var msg = reg_mb_id_check();
		if (msg != "") {
			alert(msg);
			f.reg_mb_id.focus();
			return false;
		}
	}

    return true;
}

function getFileDown(mb_no) {
	location.href = './file_download.php?mb_no=' + mb_no;
}


///// 포인트 /////
$(function() {
	if (document.fmember.w.value == "u") {
		getPointList(1);
	}
});

// 포인트내역
function getPointList(page) {
	$.ajax({  
		type : "post",  
		url : "./ajax.point_list.php",
		data : {"mb_id" : document.fmember.mb_id.value, "page" : page},
		dataType : "html",  
		success : function(data) {  
			$("#point_list").html(data);
		},  
		error : function(xhr,status,error) {
			alert("포인트 내역을 불러오는데 실패하였습니다. 다시 시도해 주세요.");
		}
	});
}

// 포인트충전/차감 폼오픈
function pointFrm() {
	var area = $("#frm_area"),
		f = document.pFrm;

	f.po_content.value = "";
	f.po_point.value = "";

	if (area.css("display") == "none") {
		area.css("display", "inline-block");
	} else {
		area.css("display", "none");
	}
}

// 포인트충전/차감 처리
var pointUpdateFlag = false;
function pointSubmit(f) {
    if (pointUpdateFlag) {
        alert("포인트 처리 중입니다.");
        return false;
    }
    pointUpdateFlag = true;

	$.ajax({
		type : "post",  
		url : "./ajax.point_update.php",
		data : {"mb_id" : f.mb_id.value, "po_type" : f.po_type.value, "po_content" : f.po_content.value, "po_point" : f.po_point.value},
		dataType : "text",  
		success : function(data) {  
			console.log(data);
			getPointList(1);
		},  
		error : function(xhr,status,error) {
			alert("포인트 처리에 실패하였습니다. 다시 시도해 주세요.");
			location.reload();
		},
        complete:function(data,textStatus) {
            pointUpdateFlag = false;
        }
	});

	return false;
}
</script>

<?php
include_once('./admin.tail.php');
?>
