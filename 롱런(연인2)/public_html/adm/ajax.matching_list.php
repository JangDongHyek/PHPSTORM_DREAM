<?php
/**********************************
회원 - 매칭하기 
회원검색후 선택한 회원 목록 
**********************************/
include_once('./_common.php');

//print_r($_POST);
//Array ( [list_no] => 4 [id] => test08 [name] => 긴급정산 [sex] => 여 [age] => 25 [tel] => [si] => 세종 [gu] => 고운동 )

// 카운슬러 리스트
$sql = "SELECT mb_id, mb_name FROM g5_member 
        WHERE mb_level = '10' AND mb_status = '카운슬러' AND mb_3 != 'out' ORDER BY mb_name ASC";
$result = sql_query($sql);
$result_cnt = sql_num_rows($result);
$helper_list = array();

for ($i = 0; $i < $result_cnt; $i++) {
	$helper_list[$i] = sql_fetch_array($result);
}

if ($member['mb_status'] == "관리자") {
	$tmp_arr['mb_id'] = $member['mb_id'];
	$tmp_arr['mb_name'] = $member['mb_name'];
	$helper_list[] = $tmp_arr;
}

// 남자회원이면 하트, 쿠폰 조회
$coupon_cnt = 0;
$heart_cnt = 0;
if ($_POST['sex'] == "남") {
    $coupon_cnt = getMemberCoupon($_POST['no']);
    $heart_cnt = getMemberHeart($_POST['no']);
}


?>
<table class="tbl_match" id="match<?=$list_no?>">
<caption>매칭상대 회원정보</caption>
<thead>
<tr>
	<th colspan="4">매칭상대 회원정보 <button type="button" class="btn_frmline btn_list_del" onclick="delMatchList(<?=$list_no?>);">삭제</button></th>
</tr>
</thead>
<tbody>
<tr>
	<th>이름</th>
	<td><input type="text" name="target_name[<?=$list_no?>]" class="frm_info" value="<?=$_POST['name']?>" readonly></td>
	<th>성별</th>
	<td>
        <input type="text" name="target_sex[<?=$list_no?>]" class="frm_info" value="<?=$_POST['sex']?>" readonly style="display: inline-block; width: 20px; vertical-align: top;">
        <?if ($_POST['sex'] == "남") { ?>
        <span>(쿠폰:<?=$coupon_cnt?> /하트:<?=$heart_cnt?>)</span>
        <input type="hidden" name="target_coupon[<?=$list_no?>]" value="<?=$coupon_cnt?>">
        <input type="hidden" name="target_heart[<?=$list_no?>]" value="<?=$heart_cnt?>">
        <?}?>
    </td>
</tr>
<tr>
	<th>나이</th>
	<td><input type="text" name="target_age[<?=$list_no?>]" class="frm_info" value="<?=$_POST['age']?>" readonly></td>
	<th>연락처</th>
	<td><input type="text" name="target_hp[<?=$list_no?>]" class="frm_info" value="<?=$_POST['tel']?>" readonly></td>
</tr>
<tr>
	<th>지역</th>
	<td><input type="text" name="target_si[<?=$list_no?>]" class="frm_info" value="<?=$_POST['si']?>" readonly></td>
	<th>상세지역</th>
	<td><input type="text" name="target_gu[<?=$list_no?>]" class="frm_info" value="<?=$_POST['gu']?>" readonly></td>
</tr>
<tr>
	<th>카운슬러선택</th>
	<td>
		<select name="helper_id[<?=$list_no?>]" class="valid_helper">
			<? if ($member['mb_status'] == "카운슬러") { ?>
			<option value="<?=$member['mb_id']?>"><?=$member['mb_name']?></option>
			<? } else { ?>
			<option value="">--선택--</option>
			<?	foreach ($helper_list as $key=>$val) { ?>
			<option value="<?=$val['mb_id']?>" <? if ($member['mb_status'] == "카운슬러" && $member['mb_id'] == $val['mb_id']) echo "selected"; ?>><?=$val['mb_name']?></option>
			<?	} ?>
			<? } ?>
		</select>
	</td>
	<th>소개종류</th>
	<td>
		<select name="match_type[<?=$list_no?>]" class="valid_type" data-num="<?=$list_no?>">
			<option value="">--선택--</option>
			<? foreach ($match_type_arr as $key=>$val) { ?>
			<option value="<?=$val?>"><?=$val?></option>
			<? } ?>
		</select>
		<input type="hidden" name="list_no[]" value="<?=$list_no?>">
		<input type="hidden" name="target_id[<?=$list_no?>]" value="<?=$_POST['id']?>"><!-- 매칭상대아이디 -->
        <input type="hidden" name="target_no[<?=$list_no?>]" value="<?=$_POST['no']?>"><!-- 매칭상대회원번호 -->
	</td>
</tr>
</tbody>
</table>