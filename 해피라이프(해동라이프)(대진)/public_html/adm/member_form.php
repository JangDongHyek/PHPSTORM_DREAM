<?php
$sub_menu = "200100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'w');

if ($w == '')
{
    $required_mb_id = 'required';
    $required_mb_id_class = 'required alnum_';
    $required_mb_password = 'required';
    $sound_only = '<strong class="sound_only">필수</strong>';

    $mb['mb_mailling'] = 1;
    $mb['mb_open'] = 1;
    $mb['mb_level'] = $config['cf_register_level'];
    $html_title = '추가';
}
else if ($w == 'u')
{
    $mb = get_member($mb_id);
    if (!$mb['mb_id'])
        alert('존재하지 않는 회원자료입니다.');

    if ($is_admin != 'super' && $mb['mb_level'] >= $member['mb_level'])
        alert('자신보다 권한이 높거나 같은 회원은 수정할 수 없습니다.');

    $required_mb_id = 'readonly';
    $required_mb_password = '';
    $html_title = '수정';

    $mb['mb_name'] = get_text($mb['mb_name']);
    $mb['mb_nick'] = get_text($mb['mb_nick']);
    $mb['mb_email'] = get_text($mb['mb_email']);
    $mb['mb_homepage'] = get_text($mb['mb_homepage']);
    $mb['mb_birth'] = get_text($mb['mb_birth']);
    $mb['mb_tel'] = get_text($mb['mb_tel']);
    $mb['mb_hp'] = get_text($mb['mb_hp']);
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

	if ($mb['mb_leave_date']) {
		alert("탈퇴처리된 회원입니다.");
	}
}
else
    alert('제대로 된 값이 넘어오지 않았습니다.');


//if ($mb['mb_intercept_date']) $g5['title'] = "차단된 ";
//else $g5['title'] .= "";
$g5['title'] .= '회원 '.$html_title;
include_once('./admin.head.php');

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js

// 회원레벨
$mb_level = ($w == "")? 2 : $mb['mb_level'];

// 가입비
$mb_bank_amt = ($w == "")? $config['cf_3'] : $mb['mb_bank_amt'];

?>
<style>
#prev_area {margin: 10px 0; line-height: 150px;}
#prev_area img {height: 150px; margin-right: 5px;}
</style>

<form name="fmember" id="fmember" action="./member_form_update.php" onsubmit="return fmember_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
<input type="hidden" name="w" value="<?=$w ?>">
<input type="hidden" name="sfl" value="<?=$sfl ?>">
<input type="hidden" name="stx" value="<?=$stx ?>">
<input type="hidden" name="page" value="<?=$page ?>">
<input type="hidden" name="token" value="">
<!--
<input type="hidden" name="sst" value="<?=$sst ?>">
<input type="hidden" name="sod" value="<?=$sod ?>">
-->
<?php for ($i=1; $i<=10; $i++) { ?>
<input type="hidden" name="mb_<?=$i ?>" value="<?=$mb['mb_'.$i] ?>">
<?php } ?>

<!-- 회원구분 -->
<input type="hidden" name="mb_level" value="<?=$mb_level?>">

<div class="tbl_frm01 tbl_wrap">
    <table>
    <colgroup>
        <col width="15%">
        <col width="35%">
        <col width="15%">
        <col width="35%">
    </colgroup>
    <tbody>
	<tr>
		<th scope="row"><label for="mb_group">가입구분</label></th>
        <td colspan="3">
			<select name="mb_group">
				<? foreach ($member_group as $key=>$val) {?>
				<option value="<?=$key?>" <? if ($w == "u" && $mb['mb_group'] == $key) echo "selected"; ?>><?=$val?></option>
				<? } ?>
			</select>
		</td>
	</tr>
    <tr>
        <th scope="row"><label for="mb_id">아이디<?=$sound_only ?></label></th>
        <td><input type="text" name="mb_id" value="<?=$mb['mb_id']?>" id="mb_id" <?=$required_mb_id ?> class="frm_input <?=$required_mb_id_class?>" size="15"  maxlength="20"></td>
        <th scope="row"><label for="mb_password">비밀번호<?=$sound_only ?></label></th>
        <td><input type="password" name="mb_password" id="mb_password" <?=$required_mb_password ?> class="frm_input <?=$required_mb_password ?>" size="15" maxlength="20"></td>
    </tr>
    <tr>
        <th scope="row"><label for="mb_name">이름<strong class="sound_only">필수</strong></label></th>
        <td><input type="text" name="mb_name" value="<?=$mb['mb_name'] ?>" id="mb_name" required class="required frm_input" size="15"  maxlength="20"></td>
        <th scope="row"><label for="mb-sex1">성별<strong class="sound_only">필수</strong></label></th>
		<td>
			<input type="radio" name="mb_sex" id="mb-sex1" value="남" <? if ($mb['mb_sex'] == "남") echo "checked"; ?>>
			<label for="mb-sex1"> 남성</label>&nbsp;&nbsp;
			<input type="radio" name="mb_sex" id="mb-sex2" value="여" <? if ($mb['mb_sex'] == "여") echo "checked"; ?>>
			<label for="mb-sex2"> 여성</label>
		</td>
    </tr>
    <tr>
		<th scope="row"><label for="mb_birth">생년월일</label></th>
        <td><input type="text" name="mb_birth" value="<?=$mb['mb_birth'] ?>" id="mb_birth" class="frm_input f_date" size="15"></td>
        <th scope="row"><label for="mb_email">E-mail</label></th>
        <td><input type="text" name="mb_email" value="<?=$mb['mb_email'] ?>" id="mb_email" maxlength="100" class="frm_input email" size="30"></td>
    </tr>

    <tr>
        <th scope="row"><label for="mb_hp">휴대폰번호</label></th>
        <td><input type="text" name="mb_hp" value="<?=$mb['mb_hp'] ?>" id="mb_hp" class="frm_input f_hp" size="15" maxlength="20"></td>
        <th>가입경로</th>
		<td>
			<?
			$route_css = "display: none;";
			$regist_route[] = "직접입력";

			if ($w == "u" && ($mb['mb_route'] == "직접입력" || $mb['mb_route'] == "추천인")) {
				$route_css = "";
			}
			?>
			<select name="mb_route" id="reg_mb_route" class="frm_input">
				<option value="">선택하세요</option>
				<? foreach ($regist_route as $key=>$val) { ?>
				<option value="<?=$val?>" <? if ($w == "u" && $mb['mb_route'] == $val) echo "selected"; ?>><?=$val?></option>
				<? } ?>
			</select>
			<input type="text" name="mb_route_input" id="mb_route_input" class="frm_input" style="<?=$route_css?>" value="<?=$mb['mb_route_input']?>" maxlength="20">
		</td>
    </tr>
    
    <tr>
        <th scope="row">주소</th>
        <td class="td_addr_line">
			<?
			$addr_event = "win_zip('fmember', 'mb_zip', 'mb_addr1', 'mb_addr2', '', '');";
			?>
            <input type="text" name="mb_zip" value="<?=$mb['mb_zip1'].$mb['mb_zip2']; ?>" id="mb_zip" class="frm_input" size="5" maxlength="6">
            <button type="button" class="btn_frmline" onclick="<?=$addr_event?>">주소 검색</button><br>
            <input type="text" name="mb_addr1" value="<?=$mb['mb_addr1'] ?>" id="mb_addr1" class="frm_input" size="60"><br>
            <input type="text" name="mb_addr2" value="<?=$mb['mb_addr2'] ?>" id="mb_addr2" class="frm_input" size="60"><br>
        </td>
		<th scope="row">회사 주소</th>
        <td class="td_addr_line">
			<?
			$addr_event3 = "win_zip('fmember', 'mb_cp_zip', 'mb_cp_addr1', 'mb_cp_addr2', '', '');";
			?>
            <input type="text" name="mb_cp_zip" value="<?=$mb['mb_cp_zip']; ?>" id="mb_cp_zip" class="frm_input" size="5" maxlength="6">
            <button type="button" class="btn_frmline" onclick="<?=$addr_event3?>">주소 검색</button><br>
            <input type="text" name="mb_cp_addr1" value="<?=$mb['mb_cp_addr1'] ?>" id="mb_cp_addr1" class="frm_input" size="60"><br>
            <input type="text" name="mb_cp_addr2" value="<?=$mb['mb_cp_addr2'] ?>" id="mb_cp_addr2" class="frm_input" size="60"><br>
        </td>
    </tr>
	<tr>
        <th scope="row" for="mb_bank_amt">가입비</th>
        <td><input type="text" name="mb_bank_amt" id="mb_bank_amt" class="frm_input f_amt" size="15" value="<?=number_format($mb_bank_amt)?>" required> 원</td>
		<th scope="row">입금확인일</th>
        <td><input type="text" name="mb_bank_date" id="mb_bank_date" class="frm_input f_date" size="15" value="<?=$mb['mb_bank_date']?>" readonly placeholder="미입금"></td>
	</tr>
	<tr>
		<th scope="row" for="cert_img">회원증서</th>
		<td>
			<input type="hidden" name="old_cert_img" value="<?=$mb['mb_cert_img']?>">
			<input type="hidden" name="del_cert_img" value="">
			<input type="file" id="cert_img" name="cert_img" onchange="getImgPrev(this)" accept="image/*">
			<div id="prev_area">
				<?
				if ($w == "u" && $mb['mb_cert_img'] != "" && file_exists(MB_CERT_PATH."/".$mb['mb_cert_img'])) {
				?>
				<img src="<?=MB_CERT_URL?>/<?=$mb['mb_cert_img']?>">
				<button type="button" class="btn_frmline">증서삭제</button>
				<? } ?>
			</div>
		</td>
		<th scope="row">행사명</th>
		<td><input type="text" name="mb_event_name" class="frm_input" value="<?=$mb['mb_event_name']?>" maxlength="90" size="40"></td>
	</tr>
	</tbody>
    </table>

	<br>

	<table class="blue">
	<colgroup>
        <col width="15%">
        <col width="35%">
        <col width="15%">
        <col width="35%">
    </colgroup>
	<tbody>
	<tr>
        <th scope="row"><label for="mb_gift_idx">증정품 선택</label></th>
		<td colspan="3">
			<select name="mb_gift_idx" id="mb_gift_idx">
				<option value="">선택하세요</option>
				<?
				$gift_list = getGiftList('all');
				$line_chk = false;
				foreach ($gift_list as $key=>$val) {
					if (!$line_chk && $val['gf_use'] == "N") {
						echo '<option value="">--------------과거 증정품내역--------------</option>';
						$line_chk = true;
					}
				?>
				<option value="<?=$val['idx']?>" <? if ($w == "u" && $mb['mb_gift_idx'] == $val['idx']) echo "selected"; ?>><?=$val['gf_name']?></option>
				<? } ?>
			</select>
		</td>
	</tr>
	<tr>
        <th scope="row"><label for="reg_mb_zip">증정품 주소</label></th>
        <td colspan="3" class="td_addr_line">
			<?
			$addr_event2 = "win_zip('fmember', 'mb_gift_zip', 'mb_gift_addr1', 'mb_gift_addr2', '', '');";
			$same_chk = ($w == "u" && ($mb['mb_gift_addr1'] == $mb['mb_addr1'] && $mb['mb_gift_addr2'] == $mb['mb_addr2']))? true : false;
			?>
			<input type="checkbox" name="chk_addr" id="chk_addr" onclick="getPostCopy(document.fmember);" <? if ($same_chk) echo "checked"; ?>>
			<label for="chk_addr">주소와 동일합니다.</label><br>
			<!-- 증정품주소 -->
			<input type="text" name="mb_gift_zip" value="<?=$mb['mb_gift_zip']; ?>" id="reg_mb_zip" class="frm_input" size="5" maxlength="6" onclick="<?=$addr_event2?>" onkeyup="<?=$addr_event2?>" placeholder="우편번호">
			<button type="button" class="btn_frmline" onclick="<?=$addr_event2?>">주소 검색</button><br>
			<input type="text" name="mb_gift_addr1" value="<?=get_text($mb['mb_gift_addr1']) ?>" class="frm_input" size="60" placeholder="기본주소" readonly><br>
			<input type="text" name="mb_gift_addr2" value="<?=get_text($mb['mb_gift_addr2']) ?>" class="frm_input" size="60" placeholder="상세주소">
        </td>
    </tr>
	</tbody>
    </table>
	
	<br>

	<table>
	<colgroup>
        <col width="15%">
        <col width="35%">
        <col width="15%">
        <col width="35%">
    </colgroup>
	<tbody>
    <?php if ($w == 'u') { ?>
    <tr>
        <th scope="row">회원가입일</th>
        <td><?=$mb['mb_datetime'] ?></td>
        <th scope="row">최근접속일</th>
        <td><?=$mb['mb_today_login'] ?></td>
    </tr>
	<tr>
		<th scope="row">회원탈퇴</th>
        <td colspan="3"><button type="button" class="btn btn_02" onclick="leaveMember();">탈퇴처리</button></td>
	</tr>
	<!--
    <tr>
        <th scope="row">IP</th>
        <td colspan="3"><?=$mb['mb_ip'] ?></td>
    </tr>
	-->
    <?php } ?>
	
	<? /*
    <tr>
        <th scope="row"><label for="mb_leave_date">탈퇴일자</label></th>
        <td>
            <input type="text" name="mb_leave_date" value="<?=$mb['mb_leave_date'] ?>" id="mb_leave_date" class="frm_input" maxlength="8">
            <input type="checkbox" value="<?=date("Ymd"); ?>" id="mb_leave_date_set_today" onclick="if (this.form.mb_leave_date.value==this.form.mb_leave_date.defaultValue) {
this.form.mb_leave_date.value=this.value; } else { this.form.mb_leave_date.value=this.form.mb_leave_date.defaultValue; }">
            <label for="mb_leave_date_set_today">탈퇴일을 오늘로 지정</label>
        </td>
        <th scope="row">접근차단일자</th>
        <td>
            <input type="text" name="mb_intercept_date" value="<?=$mb['mb_intercept_date'] ?>" id="mb_intercept_date" class="frm_input" maxlength="8">
            <input type="checkbox" value="<?=date("Ymd"); ?>" id="mb_intercept_date_set_today" onclick="if
(this.form.mb_intercept_date.value==this.form.mb_intercept_date.defaultValue) { this.form.mb_intercept_date.value=this.value; } else {
this.form.mb_intercept_date.value=this.form.mb_intercept_date.defaultValue; }">
            <label for="mb_intercept_date_set_today">접근차단일을 오늘로 지정</label>
        </td>
    </tr>
	*/ ?>
    </tbody>
    </table>
</div>

<div class="btn_fixed_top">
    <a href="./member_list.php<?if ($qstr != "") echo "?".$qstr ?>" class="btn btn_02">목록</a>
    <input type="submit" value="확인" class="btn_submit btn" accesskey='s'>
</div>
</form>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
<script>
var month_arr = ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
	day_arr = ['일', '월', '화', '수', '목', '금', '토'];

$(function() {
	// 가입경로
	$("#reg_mb_route").on("change", function() {
		if ($(this).val() == "직접입력" || $(this).val() == "추천인") {
			$("#mb_route_input").show().focus();
		} else {
			$("#mb_route_input").hide().val("");
		}
	});

	// 데이터형
	$("input.f_date").datepicker({ 
		changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", showButtonPanel: true, showMonthAfterYear : true, monthNames: month_arr, monthNamesShort: month_arr, dayNames : day_arr, dayNamesShort : day_arr, dayNamesMin : day_arr
	});
});

// 회원증서 삭제
$(document).on("click", "#prev_area > button", function(e) {
	if (confirm('회원증서를 삭제하시겠습니까?')) {
		$("#prev_area").html("");
		$("#cert_img").val("");
		$("input[name=del_cert_img]").val(1);
	}
});

// 파일업로드 미리보기
function getImgPrev(input) {
	if (detectIE() < 10) { // 익스
		alert("익스플로러 9이하는 지원하지 않습니다. 익스플로러 10이상 또는 크롬브라우저를 사용하세요.");
		$("#cert_img").val("");
		$("#cert_img").replaceWith($("#cert_img").clone(true));
		return false;
	}

	var reg_ext = /(.*?)\.(jpg|jpeg|png|bmp)$/;

	if (!reg_ext.test(input.files[0].name)) {
		alert("이미지만 등록이 가능합니다. (jpg, jpeg, png, bmp)");
		return false;
	}

	// 최대용량 체크
	var	max_size_mb = 4, //4mb
		max_byte = max_size_mb * 1024 * 1024,
		file_byte = input.files[0].size;
	
	if (file_byte > max_byte) {
		alert("최대 용량 (" + max_size_mb + "mb)을 초과합니다.");
		$("#cert_img").val("");
		return false;
	}

	// 미리보기
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function(e) {
			var img = $("<img src='"+ e.target.result +"'>");
			var btn = $('<button type="button" class="btn_frmline">증서삭제</button>');

			$("#prev_area").html("").append(img).append(btn);
			$("input[name=del_cert_img]").val(1);
		}
		reader.readAsDataURL(input.files[0]);
	}
}

function fmember_submit(f)
{
	/*
    if (!f.mb_icon.value.match(/\.(gif|jpe?g|png)$/i) && f.mb_icon.value) {
        alert('아이콘은 이미지 파일만 가능합니다.');
        return false;
    }

    if (!f.mb_img.value.match(/\.(gif|jpe?g|png)$/i) && f.mb_img.value) {
        alert('회원이미지는 이미지 파일만 가능합니다.');
        return false;
    }
	*/

    return true;
}

// 회원탈퇴
function leaveMember() {
	if (confirm("해당 회원을 탈퇴시키겠습니까? 탈퇴된 회원아이디는 재사용이 불가능합니다.")) {
		$.ajax({  
			type : "post",  
			url : "./ajax.member_leave.php",
			data : {"mb_id" : $("#mb_id").val()},
			dataType : "text",  
			success : function(data) {
				if (data == "T") {
					alert("탈퇴처리가 완료되었습니다.");
					location.href = "./member_list.php";
				} else {
					alert("탈퇴처리에 실패하였습니다. 다시 시도해 주세요.");
				}
			},  
			error : function(xhr,status,error) {
				alert("탈퇴처리에 실패하였습니다. 다시 시도해 주세요.");
			}
		});
	}
}
</script>

<?php
include_once('./admin.tail.php');
?>
