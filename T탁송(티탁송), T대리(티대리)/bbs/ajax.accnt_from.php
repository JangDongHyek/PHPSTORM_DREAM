<?php
/************************************************
회원가입시 은행정보 입력
************************************************/
include_once('./_common.php');

// 은행정보 입력여부
$bK_flag = false;
if ($w == "u" && $member['mb_6'] != "" && $member['mb_7'] != "" && $member['mb_8'] != "") { //&& $member['mb_9'] != ""
	$bK_flag = true;
}

?>

<!-------------------은행계좌 정보 시작-->
<div class="bank_area">
<div class="tbl_frm01 tbl_wrap">
	<p style="position: absolute; right: 20px; margin-top: 10px; color: #777;">포인트출금시 은행정보 필요</p>
	<table>
	<caption>은행정보</caption>
	<? if ($bK_flag) { // 은행정보 있음 ?>
	<tr>
		<th scope="row"><label for="mb_6">은행</label></th>
		<td><input type="hidden" name="mb_6" id="mb_6" value="<?=$member['mb_6']?>"><?=$bank_list[$member['mb_6']]?></td>
	</tr>
	<tr>
		<th scope="row"><label for="mb_7">계좌번호</label></th>
		<td><input type="hidden" name="mb_7" value="<?=$member['mb_7']?>"><?=$member['mb_7']?></td>
	</tr>
	<tr>
		<th scope="row"><label for="mb_10">생년월일</label></th>
		<td><input type="hidden" name="mb_10" value="<?=$member['mb_10']?>"><?=$member['mb_10']?><div style="color: #777;font-size: 0.9em;">생년월일(6자리) 또는 사업자번호(10자리)</div></td>
	</tr>
	<tr>
		<th scope="row"><label for="mb_8">예금주</label></th>
		<td><input type="hidden" name="mb_8" value="<?=$member['mb_8']?>"><?=$member['mb_8']?></td>
	</tr>
	<tr>
		<th scope="row">
            <label for="mb_9">면허증사본첨부</label><!--<label for="mb_9">통장사본첨부</label>-->
        </th>
		<td>
			<input type="hidden" name="mb_9" value="<?=$member['mb_9']?>">
			<div id="bank_img"><?php if ($member['mb_9'] != "") { ?><img src="<?=G5_DATA_URL?>/bank/<?=$member['mb_9']?>"><? } else { echo "없음"; } ?></div>
		</td>
	</tr>
	<tr>
		<th scope="row" style="line-height:1.5"><label for="">출금계좌<br>승인여부</label></th>
		<td style="line-height:1.5">
			<strong><? echo ($member['mb_user_acc'] == "Y")? "승인완료" : "대기"; ?></strong>
			<p style="color: #999; margin: 3px 0 5px;">1. 관리자의 승인이 완료되어야 포인트 출금신청이 가능합니다.<br>2. 계좌가 변경되는 경우 [은행계좌변경]을 눌러 계좌정보를 변경하시고, 관리자의 재승인 후 포인트 출금신청이 가능합니다.</p>
			<button type="button" class="btn btn-success" onclick="openBankPop()">은행계좌변경</button>
		</td>
	</tr>

	<? 
	} else { // 은행정보 없음 
		//$accnt_reqrd = ($mb_lv == "2")? "" : "required";
		$accnt_reqrd = "required";
	?>
	<tr>
		<th scope="row"><label for="mb_6">은행</label></th>
		<td>
			<select name="mb_6" id="mb_6" class="frm_input <?=$accnt_reqrd?>" <?=$accnt_reqrd?>>
				<option value="">은행선택</option>
				<? foreach ($bank_list as $key=>$val) { ?>
				<option value="<?=$key?>"><?=$val?></option>
				<? } ?>
			</select>
		</td>
	</tr>
	<tr>
		<th scope="row"><label for="mb_7">계좌번호</label></th>
		<td><input type="number" id="mb_7" name="mb_7" value="<?=$member['mb_7']?>" class="frm_input <?=$accnt_reqrd?> f_num" <?=$accnt_reqrd?>></td>
	</tr>
	<tr>
		<th scope="row"><label for="mb_10">생년월일</label></th>
		<td><input type="number" id="mb_10" name="mb_10" value="<?=$member['mb_10']?>" class="frm_input <?=$accnt_reqrd?> f_num" <?=$accnt_reqrd?> maxlength="10"><div style="color: #777;font-size: 0.9em;">생년월일(6자리) 또는 사업자번호(10자리)</div></td>
	</tr>
	<tr>
		<th scope="row"><label for="mb_8">예금주</label></th>
		<td>
			<input type="text" id="mb_8" name="mb_8" value="<?=$member['mb_8']?>" class="frm_input <?=$accnt_reqrd?>" maxlength="20" <?=$accnt_reqrd?> style="width:calc(100% - 65px)">
			<button type="button" class="btn btn-success" id="nameChk" style="width:60px;">인증</button>
		</td>
	</tr>
	<tr>
		<th scope="row">
            <label for="upload_mb_9">면허증사본첨부</label><!--<label for="upload_mb_9">통장사본첨부</label>-->
        </th>
		<td>
			<input type="hidden" name="mb_9" id="mb_9" value="<?=$member['mb_9']?>">
			<input type="file" name="upload_mb_9" id="upload_mb_9" class="frm_input" accept="image/*" onchange="uploadImg(this, 'upload')" />
			<div id="bank_img" class="img1"></div>
		</td>
	</tr>
	<? } ?>

	</table>
	</div>
</div><!--.bank_area-->
<!-------------------은행계좌 정보 끝-->

<div style="height: 250px;"><!--디바이스에서 스크롤이 없어 공백만듬--></div>