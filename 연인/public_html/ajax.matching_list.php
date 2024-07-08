<?php
/**********************************
회원 - 매칭하기 
회원검색후 선택한 회원 목록 
**********************************/
include_once('./_common.php');

?>
<table class="tbl_match" id="match1">
<caption>매칭상대 회원정보</caption>
<thead>
<tr>
	<th colspan="4">매칭상대 회원정보 <button type="button" class="btn_frmline btn_list_del" onclick="delMatchList(1);">삭제</button></th>
</tr>
</thead>
<tbody>
<tr>
	<th>이름</th>
	<td><input type="text" name="target_name[1]" class="frm_info" value="" readonly></td>
	<th>성별</th>
	<td><input type="text" name="target_sex[1]" class="frm_info" value="" readonly></td>
</tr>
<tr>
	<th>나이</th>
	<td><input type="text" name="target_age[1]" class="frm_info" value="" readonly></td>
	<th>연락처</th>
	<td><input type="text" name="target_hp[1]" class="frm_info" value="" readonly></td>
</tr>
<tr>
	<th>지역</th>
	<td><input type="text" name="target_si[1]" class="frm_info" value="" readonly></td>
	<th>상세지역</th>
	<td><input type="text" name="target_gu[1]" class="frm_info" value="" readonly></td>
</tr>
<tr>
	<th>헬퍼선택</th>
	<td>
		<select name="helper_id[1]">
			<? if ($member['mb_status'] == "헬퍼") { ?>
			<option value="<?=$member['mb_id']?>"><?=$member['mb_name']?></option>
			<? } else { ?>
			<option value="">--선택--</option>
			<?	foreach ($helper_list as $key=>$val) { ?>
			<option value="<?=$val['mb_id']?>" <? if ($member['mb_status'] == "헬퍼" && $member['mb_id'] == $val['mb_id']) echo "selected"; ?>><?=$val['mb_name']?></option>
			<?	} ?>
			<? } ?>
		</select>
	</td>
	<th>소개종류</th>
	<td>
		<select name="match_type[1]">
			<option value="">--선택--</option>
			<? foreach ($match_type_arr as $key=>$val) { ?>
			<option value="<?=$val?>"><?=$val?></option>
			<? } ?>
		</select>
		<input type="hidden" name="target_id[1]" value=""><!-- 매칭상대아이디 -->
	</td>
</tr>
</tbody>
</table>