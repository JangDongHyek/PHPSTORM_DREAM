<?php
$sub_menu = "600100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'w');

if ($w == ''){
    $required_mb_id = 'required';
    $required_mb_id_class = 'required alnum_';
    $required_mb_password = 'required';
    $sound_only = '<strong class="sound_only">필수</strong>';

    $mb['mb_mailling'] = 1;
    $mb['mb_open'] = 1;
    //$mb['mb_level'] = $config['cf_register_level'];
    $html_title = '추가';
}else if ($w == 'u'){
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
}else{
    alert('제대로 된 값이 넘어오지 않았습니다.');
}

// 본인확인방법
switch($mb['mb_certify']) {
    case 'hp':
        $mb_certify_case = '휴대폰';
        $mb_certify_val = 'hp';
        break;
    case 'ipin':
        $mb_certify_case = '아이핀';
        $mb_certify_val = 'ipin';
        break;
    case 'admin':
        $mb_certify_case = '관리자 수정';
        $mb_certify_val = 'admin';
        break;
    default:
        $mb_certify_case = '';
        $mb_certify_val = 'admin';
        break;
}

// 본인확인
$mb_certify_yes  =  $mb['mb_certify'] ? 'checked="checked"' : '';
$mb_certify_no   = !$mb['mb_certify'] ? 'checked="checked"' : '';

// 성인인증
$mb_adult_yes       =  $mb['mb_adult']      ? 'checked="checked"' : '';
$mb_adult_no        = !$mb['mb_adult']      ? 'checked="checked"' : '';

//메일수신
$mb_mailling_yes    =  $mb['mb_mailling']   ? 'checked="checked"' : '';
$mb_mailling_no     = !$mb['mb_mailling']   ? 'checked="checked"' : '';

// SMS 수신
$mb_sms_yes         =  $mb['mb_sms']        ? 'checked="checked"' : '';
$mb_sms_no          = !$mb['mb_sms']        ? 'checked="checked"' : '';

// 정보 공개
$mb_open_yes        =  $mb['mb_open']       ? 'checked="checked"' : '';
$mb_open_no         = !$mb['mb_open']       ? 'checked="checked"' : '';

if (isset($mb['mb_certify'])) {
    // 날짜시간형이라면 drop 시킴
    if (preg_match("/-/", $mb['mb_certify'])) {
        sql_query(" ALTER TABLE `{$g5['member_table']}` DROP `mb_certify` ", false);
    }
} else {
    sql_query(" ALTER TABLE `{$g5['member_table']}` ADD `mb_certify` TINYINT(4) NOT NULL DEFAULT '0' AFTER `mb_hp` ", false);
}

if(isset($mb['mb_adult'])) {
    sql_query(" ALTER TABLE `{$g5['member_table']}` CHANGE `mb_adult` `mb_adult` TINYINT(4) NOT NULL DEFAULT '0' ", false);
} else {
    sql_query(" ALTER TABLE `{$g5['member_table']}` ADD `mb_adult` TINYINT NOT NULL DEFAULT '0' AFTER `mb_certify` ", false);
}

// 지번주소 필드추가
if(!isset($mb['mb_addr_jibeon'])) {
    sql_query(" ALTER TABLE {$g5['member_table']} ADD `mb_addr_jibeon` varchar(255) NOT NULL DEFAULT '' AFTER `mb_addr2` ", false);
}

// 건물명필드추가
if(!isset($mb['mb_addr3'])) {
    sql_query(" ALTER TABLE {$g5['member_table']} ADD `mb_addr3` varchar(255) NOT NULL DEFAULT '' AFTER `mb_addr2` ", false);
}

// 중복가입 확인필드 추가
if(!isset($mb['mb_dupinfo'])) {
    sql_query(" ALTER TABLE {$g5['member_table']} ADD `mb_dupinfo` varchar(255) NOT NULL DEFAULT '' AFTER `mb_adult` ", false);
}

if ($mb['mb_intercept_date']) $g5['title'] = "차단된 ";
else $g5['title'] .= "";
$g5['title'] .= '매니저 '.$html_title;
include_once('./admin.head.php');

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js
?>
<script src="<?=G5_JS_URL?>/jquery.register_form.js"></script>
<form name="fmember" id="fmember" action="./member_form_update.php" onsubmit="return fmember_submit(this);" method="post" enctype="multipart/form-data">
<input type="hidden" name="w" value="<?php echo $w ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="">
<input type="hidden" name="mb_mailling" value="1">
<input type="hidden" name="mb_sms" value="1">
<input type="hidden" name="mb_open" value="1">

<input type="hidden" name="member_form_manager" value="1">

<!-- 매니저 레벨 8 -->
<!--<input type="hidden" name="mb_level" value="8">-->

<!-- 매니저 가맹점명 현재 로그인 한 가맹점 이름 -->
<!--<input type="hidden" name="mb_company" value="<?php echo $_SESSION['ss_mb_company'] ?>">-->

<div class="tbl_frm_mb tbl_wrap">	
    <h2 class="title">매니저 기본정보</h2>

	<!-- 가맹점 정보 S-->
    <table>
    <tbody>
	<tr>
        <th scope="row" style="width:10%">아이디</th>
        <td><input type="text" name="mb_id" value="<?php if($mb['mb_id']){echo $mb['mb_id'];} ?>" id="reg_mb_id" class="frm_input required" required size="30"></td>
		<th scope="row" style="width:10%"><label for="mb_password">비밀번호<?php echo $sound_only ?></label></th>
        <td><input type="password" name="mb_password" id="mb_password" <?php echo $required_mb_password ?> class="frm_input <?php echo $required_mb_password ?>" size="30" maxlength="20"></td>		
	</tr>
	<tr>
		<th scope="row">가맹점명</th>
        <td>
			<!--<input type="text" name="mb_company" value="<?if($mb['mb_company']){echo $mb['mb_company'];}else{echo $_SESSION['ss_mb_company'];}?>" id="mb_company" class="frm_input" size="30">-->
			<?
				//가맹점 명
				$sql = "select mb_company from `g5_member` where mb_id != 'lets080' group by mb_company order by mb_datetime desc";
				$company_name = sql_query($sql);
			?>
			<select id="mb_company" name="mb_company" required>
				<option value="">선택하세요.</option>
				<?for($i=0; $company_row=sql_fetch_array($company_name); $i++){?>
				<option value="<?=$company_row['mb_company']?>" <?if($company_row['mb_company'] == $mb['mb_company']){echo "selected";}?>><?=$company_row['mb_company']?></option>	
				<?}?>
			</select>
		</td>
		<th scope="row"><label for="mb_name">매니저 이름<strong class="sound_only">필수</strong></label></th>
        <td><input type="text" name="mb_name" value="<?php echo $mb['mb_name'] ?>" id="mb_name" required class="frm_input required" size="30" minlength="2" maxlength="20"></td>
	</tr>
	<tr>
		<th scope="row"><label for="mb_tel">가맹점 전화번호</label></th>
		<td>
			<!-- 매니저 전화번호 -->
			<input type="text" name="mb_tel" value="<?php echo $mb['mb_tel'] ?>" id="mb_tel" class="frm_input" size="30">
		</td>
		<th scope="row"><label for="mb_hp">매니저 휴대폰</label></th>
		<td>
			<!-- 매니저 휴대폰 -->
			<input type="text" name="mb_hp" value="<?php echo $mb['mb_hp'] ?>" id="reg_mb_hp" required class="frm_input required" size="30">
		</td>
	</tr>
	<tr>
		<th scope="row"><label for="mb_email">E-메일</label></th>
		<td>
			<input type="text" name="mb_email" value="<?php echo $mb['mb_email'] ?>" id="mb_email" maxlength="100" class="frm_input" size="30">
		</td>		
		<th scope="row"><label for="mb_10">팩스번호</label></th>
		<td>
			<!-- 매니저 팩스번호 -->
			<input type="text" name="mb_10" value="<?php echo $mb['mb_10'] ?>" id="mb_10" class="frm_input" size="30">
		</td>
	</tr>
	<tr>
		<th scope="row"><label for="mb_level">매니저권한</label></th>
		<td colspan="3">
			<select id="mb_level" name="mb_level">
				<option value="8" <?if($mb['mb_level']=='8'){echo 'selected';}?>>일반</option>
				<option value="7" <?if($mb['mb_level']=='7'){echo 'selected';}?>>부분(등록만가능)</option>
			</select>
		</td>		
	</tr>
	<tr>
		<th scope="row"><label for="mb_10">사진</label></th>
		<td colspan="3" style="padding:50px;">
			<!-- 매니저 사진 -->
			<?php 	
				$file_cnt = 1;
				for($i=0; $i<$file_cnt; $i++){ 
					if($mb['mb_file'.($i+1)]){
						$mb_file_path[$i] = G5_DATA_PATH.'/member/'.$mb['mb_file'.($i+1)];
						$mb_file_url[$i] = G5_DATA_URL.'/member/'.$mb['mb_file'.($i+1)];
					}
			?>				
					<?php /*?>사진 #<?php echo $i+1?>
					<br /><br /><?php */?>
					<?php if ($w == 'u' && file_exists($mb_file_path[$i])) { ?>						
					<img src="<?php echo $mb_file_url[$i] ?>" alt="이미지 #<?php echo $i+1?>" style="max-width:300px;max-height:300px;">
					<?php }else{  ?>
					<img src="<?=G5_DATA_URL?>/member/entks01.noimage.gif" alt="이미지 #<?php echo $i+1?>" style="width:300px;height:300px;">
					<?php } ?>				
			<?php } ?>       
			<?php 	
				$file_cnt = 1;
				for($i=0; $i<$file_cnt; $i++){ 
					if($mb['mb_file'.($i+1)]){
						$mb_file_path[$i] = G5_DATA_PATH.'/member/'.$mb['mb_file'.($i+1)];
						$mb_file_url[$i] = G5_DATA_URL.'/member/'.$mb['mb_file'.($i+1)];
					}
			?>		
					<br />
					<?//php echo $i+1?> (2 MB 이하만 업로드 가능)
					<br />
					<input type="file" name="mb_file[]" id="reg_mb_file<?php echo $i?>" class="frm_input">					
					<?php if ($w == 'u' && file_exists($mb_file_path[$i])) { ?>
					<br />
					<input type="checkbox" name="del_mb_file[]" value="<?php echo $i?>" id="del_mb_pdf<?php echo $i?>">
					<label for="del_mb_pdf<?php echo $i?>">삭제</label>( <?php echo $mb['mb_file'.($i+1)]?> )								
					<?php } ?>
					<br/><br/>								
					<input type="hidden" name="mb_file_name<?php echo $i+1?>" value="<?=$mb['mb_file'.($i+1)]?>">
					<br />					
			<?php } ?>            
		</td>
	</tr>
	<?if($is_admin){?>
	<tr>
		<th scope="row"><label for="mb_intercept_date">접근차단일자</label></th>
		<td colspan="3">
			<input type="text" name="mb_intercept_date" value="<?php echo $mb['mb_intercept_date'] ?>" id="mb_intercept_date" class="frm_input" maxlength="8">
			<input type="checkbox" value="<?php echo date("Ymd"); ?>" id="mb_intercept_date_set_today" onclick="if
			(this.form.mb_intercept_date.value==this.form.mb_intercept_date.defaultValue) { this.form.mb_intercept_date.value=this.value; } else {
			this.form.mb_intercept_date.value=this.form.mb_intercept_date.defaultValue; }">
			<label for="mb_intercept_date_set_today">접근차단일을 오늘로 지정</label>
		</td>		
	</tr>
	<?}?>
    </tbody>
    </table>
    <!-- 가맹점 정보 E-->	
	
	<!-- lets080 접속일때 S -->    
	<?if($_SESSION['ss_mb_id'] == "lets080"){?>
	<h2 class="title">회사계정만 노출</h2>
	<table>
    <tbody>
    <?php if ($w == 'u') { ?>
    <tr>
        <th scope="row">회원가입일</th>
        <td><?php echo $mb['mb_datetime'] ?></td>
        <th scope="row">최근접속일</th>
        <td><?php echo $mb['mb_today_login'] ?></td>
    </tr>
    <tr>
        <th scope="row">IP</th>
        <td colspan="3"><?php echo $mb['mb_ip'] ?></td>
    </tr>
    <?php if ($config['cf_use_email_certify']) { ?>
    <tr>
        <th scope="row">인증일시</th>
        <td colspan="3">
            <?php if ($mb['mb_email_certify'] == '0000-00-00 00:00:00') { ?>
            <?php echo help('회원님이 메일을 수신할 수 없는 경우 등에 직접 인증처리를 하실 수 있습니다.') ?>
            <input type="checkbox" name="passive_certify" id="passive_certify">
            <label for="passive_certify">수동인증</label>
            <?php } else { ?>
            <?php echo $mb['mb_email_certify'] ?>
            <?php } ?>
        </td>
    </tr>
    <?php } ?>
    <?php } ?>

    <?php if ($config['cf_use_recommend']) { // 추천인 사용 ?>
    <tr>
        <th scope="row">추천인</th>
        <td colspan="3"><?php echo ($mb['mb_recommend'] ? get_text($mb['mb_recommend']) : '없음'); // 081022 : CSRF 보안 결함으로 인한 코드 수정 ?></td>
    </tr>
    <?php } ?>
	
	
    <tr>
        <th scope="row"><label for="mb_leave_date">탈퇴일자</label></th>
        <td colspan="3">
            <input type="text" name="mb_leave_date" value="<?php echo $mb['mb_leave_date'] ?>" id="mb_leave_date" class="frm_input" maxlength="8">
            <input type="checkbox" value="<?php echo date("Ymd"); ?>" id="mb_leave_date_set_today" onclick="if (this.form.mb_leave_date.value==this.form.mb_leave_date.defaultValue) {
this.form.mb_leave_date.value=this.value; } else { this.form.mb_leave_date.value=this.form.mb_leave_date.defaultValue; }">
            <label for="mb_leave_date_set_today">탈퇴일을 오늘로 지정</label>
        </td>
         <!--<th scope="row">접근차단일자</th>
        <td>
           <input type="text" name="mb_intercept_date" value="<?php echo $mb['mb_intercept_date'] ?>" id="mb_intercept_date" class="frm_input" maxlength="8">
            <input type="checkbox" value="<?php echo date("Ymd"); ?>" id="mb_intercept_date_set_today" onclick="if
(this.form.mb_intercept_date.value==this.form.mb_intercept_date.defaultValue) { this.form.mb_intercept_date.value=this.value; } else {
this.form.mb_intercept_date.value=this.form.mb_intercept_date.defaultValue; }">
            <label for="mb_intercept_date_set_today">접근차단일을 오늘로 지정</label>-->
        </td>
    </tr>
	<?php } ?>	
	</tbody>
    </table>
	<!-- lets080 접속일때 E -->    

</div>

<div class="btn_confirm01 btn_confirm">
    <input type="submit" value="확인" class="btn_submit" accesskey='s'>
    <a href="./member_list_manager.php?<?php echo $qstr ?>">목록</a>
</div>
</form>

<script>
function fmember_submit(f)
{
	if(f.w.value != "u"){
		//아이디 체크
		var id_check = reg_mb_id_check();
		if(id_check){
			alert(id_check);
			f.reg_mb_id.focus();
			return false;
		}
		//휴대폰번호 체크
		var hp_check = reg_mb_hp_check2();
		if(hp_check){
			alert(hp_check);
			f.reg_mb_hp.focus();
			return false;
		}

		if (!f.mb_icon.value.match(/\.gif$/i) && f.mb_icon.value) {
			alert('아이콘은 gif 파일만 가능합니다.');
			return false;
		}
	}

    return true;
}
</script>

<?php
include_once('./admin.tail.php');
?>
