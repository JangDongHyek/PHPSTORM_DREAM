<?php
$sub_menu = "400100";
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

	// 이미지조회
	$rs = sql_fetch("SELECT * FROM g5_member_img WHERE mb_id = '{$mb_id}' ORDER BY idx DESC LIMIT 0, 1");
	$mi_img = $rs['mi_img'];
	$mi_idx = $rs['idx'];


} else {
    alert('제대로 된 값이 넘어오지 않았습니다.');
}


// 수정권한
$edit_flag = false;
if ($member['mb_status'] == '관리자') {
	$edit_flag = true;
} else if ($member['mb_id'] == $mb['mb_id']) {
	$edit_flag = true;
}

if (!$edit_flag) {
	alert('잘못된 접근입니다.');
}


$g5['title'] .= '카운슬러 '.$html_title;
include_once('./admin.head.php');
?>

<form name="fmember" id="fmember" action="./helper_form_update.php" onsubmit="return fmember_submit(this);" method="post" enctype="multipart/form-data" class="max1200">
	<input type="hidden" name="w" value="<?php echo $w ?>">
	<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
	<input type="hidden" name="stx" value="<?php echo $stx ?>">
	<input type="hidden" name="page" value="<?php echo $page ?>">
	<input type="hidden" name="token" value="">
	<!-- 추가 -->
	<input type="hidden" name="mode" value="helper">
	<input type="hidden" name="mb_level" value="10">
	<input type="hidden" name="mb_status" value="카운슬러">

	<div class="tbl_frm01 tbl_wrap">
		<table>
		<caption><?php echo $g5['title']; ?></caption>
		<colgroup>
			<col class="grid_4">
			<col>
			<col class="grid_4">
			<col>
		</colgroup>
		<tbody>
		<tr>
			<th scope="row"><label for="mb_id">아이디</label></th>
			<td><input type="text" name="mb_id" value="<?php echo $mb['mb_id'] ?>" id="mb_id" <?php echo $required_mb_id ?> class="frm_input <?php echo $required_mb_id_class ?>" size="25" minlength="3" maxlength="20"></td>
			<th scope="row"><label for="mb_password">비밀번호</label></th>
			<td><input type="password" name="mb_password" id="mb_password" <?php echo $required_mb_password ?> class="frm_input <?php echo $required_mb_password ?>" size="25" maxlength="20"></td>
		</tr>
		<tr>
			<th scope="row"><label for="mb_name">이름</label></th>
			<td><input type="text" name="mb_name" value="<?=$mb['mb_name']?>" id="mb_name" required class="required frm_input" size="25" minlength="2" maxlength="20"></td>
			<th scope="row"><label for="mb_1">카톡아이디</label></th>
			<td><input type="text" name="mb_1" value="<?=$mb['mb_1']?>" id="mb_1" class="frm_input" size="25" maxlength="30"></td>
		</tr>
        <tr>
            <th scope="row"><label for="mb_4">출근시간</label></th>
            <td><input type="text" name="mb_4" value="<?=$mb['mb_4']?>" id="mb_4" class="frm_input" size="25" minlength="2" maxlength="50" placeholder="pm 12:00 ~ pm 09:00"></td>
        </tr>
		<tr>
			<th scope="row"><label for="mb_profile">자기소개</label></th>
			<td colspan="3"><textarea id="mb_profile" name="mb_profile"><?=$mb['mb_profile']?></textarea></td>
		</tr>
		<tr>
			<th scope="row"><label for="mb_2">소개요청주소</label></th>
			<td colspan="3"><input type="text" name="mb_2" value="<?=$mb['mb_2']?>" id="mb_2" class="frm_input" maxlength="255" style="width:90%;"></td>
		</tr>
		<tr>
			<th scope="row"><label for="mi_img">사진</label></th>
			<td colspan="3">
				<input type="file" name="mi_img[]" id="mi_img">
				<div id="prev_area">
					<!--미리보기-->
					<? if ($w == "u" && $mi_img != "" && file_exists(MB_IMG_PATH."/".$mi_img)) { ?>
					<div class="p_box" id="img_box"><img src="<?=MB_IMG_URL."/".$mi_img?>" class="p_img"></div>
					<input type="hidden" name="mi_idx[]" value="<?=$mi_idx?>">
					<input type="hidden" name="mi_del[]" id="mi_del" value="">
					<input type="hidden" name="mi_old_img[]" value="<?=$mi_img?>">
					<? } ?>
				</div>
			</td>
		</tr>
		<tr>
			<th scope="row">출퇴근</th>
			<td colspan="3">
				<input type="radio" name="mb_3" value="off" id="mb_3_2" <? if ($w == "" || $mb['mb_3'] == "off") echo "checked"; ?> required><label for="mb_3_2"> off</label>&nbsp;&nbsp;
				<input type="radio" name="mb_3" value="on" id="mb_3_1" <? if ($mb['mb_3'] == "on") echo "checked"; ?>><label for="mb_3_1"> on</label>
			</td>
		</tr>

		</tbody>
		</table>
	</div>

	<div class="btn_confirm01 btn_confirm">
		<input type="submit" value="확인" class="btn_submit" accesskey='s'>
		<a href="./helper_list.php<? if ($qstr != "") echo "?".$qstr; ?>">목록</a>
	</div>
</form>

<script>
$(function() {
	$("#mi_img").on("change", function() {
		getImgPrev(this);
	});
});

// 업로드 미리보기
function getImgPrev(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function(e) {
			var area = document.getElementById("prev_area"),
				div = document.createElement('div'),
				img = document.createElement('img');

			var img_box = document.getElementById("img_box");

			if (img_box) {
				img_box.parentNode.removeChild(img_box);
			}

			div.setAttribute("class", "p_box");
			div.setAttribute("id", "img_box");
			img.setAttribute("class", "p_img");
			img.setAttribute("src", e.target.result);

			div.appendChild(img);
			area.appendChild(div);

			// 삭제체크
			if (document.fmember.w.value == "u") {
				document.getElementById("mi_del").value = 1;
			}
		}
		reader.readAsDataURL(input.files[0]);
	}
}


</script>


<?php
include_once('./admin.tail.php');
?>
