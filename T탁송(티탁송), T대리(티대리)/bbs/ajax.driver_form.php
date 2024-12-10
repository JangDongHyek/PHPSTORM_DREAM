<?php
/************************************************
회원가입시 기사폼
************************************************/
include_once('./_common.php');

$driver_sign = false;	// 기사계약서 동의여부
$name_sign = false;		// 기사이름서명 사인여부 (200827추가)
if ($w == "u" && $member['mb_3'] != "" && $member['mb_4'] != "" && $member['mb_5'] != "") {
	$driver_sign = true;
}
if ($w == "u" && $member['mb_12'] != "") $name_sign = true;


// 은행정보 입력여부
$bK_flag = false;
if ($w == "u" && $member['mb_6'] != "" && $member['mb_7'] != "" && $member['mb_8'] != "") { //&& $member['mb_9'] != ""
	$bK_flag = true;
}

// 계약일
$cont_date = array();
if ($w == "") {
	$cont_date[0] = date("Y");
	$cont_date[1] = date("m");
	$cont_date[2] = date("d");
} else {
	$cont_date[0] = date("Y", strtotime($member['mb_datetime']));
	$cont_date[1] = date("m", strtotime($member['mb_datetime']));
	$cont_date[2] = date("d", strtotime($member['mb_datetime']));
}

?>

<!-------------------기사계약서 동의 시작-->
<div id="join_agree">
	<h2>기사계약서</h2>
	<? if (!$driver_sign) { ?><div class="ja_txt">기사 계약서 약관 동의 후 가입이 가능합니다.</div><? } ?>
	
	<div class="ja_box">
		<div class="row join_ag">
			<div class="chk_ico" data-for="reg_req">
				<? if (!$driver_sign) { ?>
				<input type="checkbox" name="reg_req" id="reg_req" value="1">
				<label for="reg_req">기사 계약서 약관동의(필수) </label>

				<? } else { ?>
				<label for="reg_req">기사 계약서 약관 </label>
				<? } ?>
			</div>
			<button type="button" class="btn_jac" data-toggle="modal" data-target="#myModal2"><span class="btn_jacv">내용보기</span></button>
		</div><!--.join_ag-->
			
		<div class="ja_sign">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<th scope="row">(을)성명</th>
				<td><input placeholder="성명" type="text" name="mb_3" id="mb_3" value="<?=$member['mb_3']?>" class="frm_input" maxlength="12" required <? if ($driver_sign) echo "readonly"; ?>></td>
			  </tr>
			  <tr>
				<th scope="row">주민번호</th>
				<td><input placeholder="앞자리 6" type="number" name="mb_4" id="mb_4" value="<?=$member['mb_4']?>" class="frm_input f_num" maxlength="6" minlength="6" required <? if ($driver_sign) echo "readonly"; ?>></td>
			  </tr>
			  <tr>
				<th scope="row">이름서명</th>
				<td>
					<input type="hidden" name="mb_12" value="<?=$member['mb_12']?>"><!-- 이름서명파일명 -->
					<? if ($name_sign) { // 이름서명됨 ?>
					<div id="nm_sign_area" class="sign_area">
						<div class="sign_img"><img src="<?=G5_SIGN_URL?>/<?=$member['mb_12']?>" style="max-height: 100%; width: auto;"></div>
					</div>
					<? } else { // 이름서명안됨 ?>
					<button type="button" class="btn_sign sign_before" onclick="openSignPad('name')">이름서명하기</button>
					<!--사인이미지 영역 -->
					<div id="nm_sign_area" class="sign_area" style="display: none;">
						<div class="sign_img"></div>
					</div>
					<? } ?>
				</td>
			  </tr>
			  <tr>
				<th scope="row">사인</th>
				<td>
					<input type="hidden" name="mb_5" value="<?=$member['mb_5']?>"><!-- 사인파일명 -->
					<? if ($driver_sign) { // 사인됨 ?>
					<div id="sign_area" class="sign_area">
						<div class="sign_img"><img src="<?=G5_SIGN_URL?>/<?=$member['mb_5']?>" style="max-height: 100%; width: auto;"></div>
					</div>
					<? } else { // 사인안됨 ?>
					<button type="button" class="btn_sign sign_before" onclick="openSignPad('sign')">사인하기</button>
					<!--사인이미지 영역 -->
					<div id="sign_area" class="sign_area" style="display: none;">
						<div class="sign_img"></div>
					</div>
					<? } ?>
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
		<p>콜 위탁 수행 이행계약서 탁송, 대리운전 T대리 어플리케이션 T대리점 및 기사 운영 계약서</p>
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
          // 기사 계약서 내용
          include_once (G5_BBS_PATH."/contract_driver.php");
          ?>
		<div class="ja_date"><span class="syear"><?=$cont_date[0]?></span>년 <span class="smonth"><?=$cont_date[1]?></span>월 <span class="sdate"><?=$cont_date[2]?></span>일</div><!--.ja_date-->
	  </div>
	  <div class="modal-footer">
		<button type="button" class="sign_ok" data-dismiss="modal">확인</button>
	  </div>
	</div>
  </div>
</div><!--.modalC-->
<!------------------- 계약서 내용 시작 끝 -->
<!-------------------기사계약서 동의 끝-->

<?/* 
// ./ajax.accnt_from 로 분리함
<!-------------------은행계좌 정보 시작-->
<div class="bank_area">
<div class="tbl_frm01 tbl_wrap">
	<table>
	<caption>은행정보</caption>
	<? if ($bK_flag) { // 입금정보 있음 ?>
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
		<th scope="row"><label for="mb_9">통장사본첨부</label></th>
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

	<? } else { // 입금정보 없음 ?>
	<tr>
		<th scope="row"><label for="mb_6">은행</label></th>
		<td>
			<select name="mb_6" id="mb_6" class="frm_input" required>
				<option value="">은행선택</option>
				<? foreach ($bank_list as $key=>$val) { ?>
				<option value="<?=$key?>"><?=$val?></option>
				<? } ?>
			</select>
		</td>
	</tr>
	<tr>
		<th scope="row"><label for="mb_7">계좌번호</label></th>
		<td><input type="number" id="mb_7" name="mb_7" value="<?=$member['mb_7']?>" class="frm_input f_num" required></td>
	</tr>
	<tr>
		<th scope="row"><label for="mb_10">생년월일</label></th>
		<td><input type="number" id="mb_10" name="mb_10" value="<?=$member['mb_10']?>" class="frm_input f_num" required maxlength="10"><div style="color: #777;font-size: 0.9em;">생년월일(6자리) 또는 사업자번호(10자리)</div></td>
	</tr>
	<tr>
		<th scope="row"><label for="mb_8">예금주</label></th>
		<td>
			<input type="text" id="mb_8" name="mb_8" value="<?=$member['mb_8']?>" class="frm_input" maxlength="20" required <? if ($w=="") { ?>style="width:calc(100% - 65px)"<? } ?>>
			<? if ($w=="") { ?>
			<button type="button" class="btn btn-success" id="nameChk" style="width:60px;">인증</button>
			<? } ?>
		</td>
	</tr>
	<tr>
		<th scope="row"><label for="upload_mb_9">통장사본첨부</label></th>
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
*/ ?>