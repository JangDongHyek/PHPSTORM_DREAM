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
}
else
    alert('제대로 된 값이 넘어오지 않았습니다.');

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

// 이메일인증 체크 필드추가
if(!isset($mb['mb_email_certify2'])) {
    sql_query(" ALTER TABLE {$g5['member_table']} ADD `mb_email_certify2` varchar(255) NOT NULL DEFAULT '' AFTER `mb_email_certify` ", false);
}

if ($mb['mb_intercept_date']) $g5['title'] = "차단된 ";
else $g5['title'] .= "";
$g5['title'] .= '회원 '.$html_title;
include_once('./admin.head.php');

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js

?>
<style>
select {height: 24px;}
</style>

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

<div class="tbl_frm01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?></caption>
    <colgroup>
        <col width="15%">
        <col width="35%">
        <col width="15%">
        <col width="35%"
    </colgroup>
    <tbody>
	<tr>
        <th scope="row"><label for="mb_level">회원 권한</label></th>
        <td><?php echo get_member_level_select('mb_level', 1, $member['mb_level'], $mb['mb_level']) ?></td>
        <th scope="row"><label for="mb_1">회원 구분</label></th>
        <td>
			<?php
			$mc_list_arr = mc_mb_list($mb['mb_level']);
			$mc_list = explode('|',$mc_list_arr);
			?>
			<select name="mb_1" id="mb_1">
				<option value="">선택하세요</option>
				<?php for($mc=0; $mc<count($mc_list); $mc++){ ?>
				<option value="<?php echo $mc_list[$mc] ?>" <?php if($mb['mb_1'] == $mc_list[$mc]) echo 'selected'; ?>><?php echo $mc_list[$mc] ?></option>
				<?php } ?>
			</select>
		</td>
    </tr>
    <tr>
        <th scope="row"><label for="mb_id">아이디<?php echo $sound_only ?></label></th>
        <td>
            <input type="text" name="mb_id" value="<?php echo $mb['mb_id'] ?>" id="mb_id" <?php echo $required_mb_id ?> class="frm_input <?php echo $required_mb_id_class ?>" size="15" minlength="3" maxlength="20">
        </td>
        <th scope="row"><label for="mb_password">비밀번호<?php echo $sound_only ?></label></th>
        <td><input type="password" name="mb_password" id="mb_password" <?php echo $required_mb_password ?> class="frm_input <?php echo $required_mb_password ?>" size="15" maxlength="20"></td>
    </tr>
    <tr>
        <th scope="row"><label for="mb_name">이름<strong class="sound_only">필수</strong></label></th>
        <td>
			<input type="text" name="mb_name" value="<?php echo $mb['mb_name'] ?>" id="mb_name" required class="required frm_input" size="15" minlength="2" maxlength="20">
			<label style="margin-left:10px;"><b>매장명</b>&nbsp;<input type="text" name="mb_2" value="<?php echo $mb['mb_2'] ?>" id="mb_2" class="frm_input" size="15"></label>
		</td>
		<th scope="row"><label for="mb_hp">휴대폰번호</label></th>
        <td><input type="text" name="mb_hp" value="<?php echo $mb['mb_hp'] ?>" id="mb_hp" class="frm_input" size="15" maxlength="20"></td>
    </tr>
	<tr>
		<th scope="row"><label for="mb_3">사업자등록번호</label></th>
		<td><input type="text" name="mb_3" value="<?php echo $mb['mb_3'] ?>" id="mb_3" class="frm_input" size="15"></td>
		<th scope="row"><label for="mb_4">계육업체구분</label></th>
		<td>
			<select name="mb_4" id="mb_4">
				<option value="">선택하세요</option>
				<?
				$co_rst = sql_query("SELECT * FROM g5_ck_company WHERE co_use = 'Y' ORDER BY idx DESC");
				while($rs = sql_fetch_array($co_rst)) {
				?>
				<option value="<?=$rs['idx']?>" <? if ($w == 'u' && $mb['mb_4'] == $rs['idx']) echo "selected"; ?>><?=$rs['co_name']?></option>
				<?
				}
				?>
			</select>
		</td>
		<? /*
		<th scope="row"><label for="mb_icon">회원아이콘</label></th>
        <td>
            <input type="file" name="mb_icon" id="mb_icon">
            <?php
            $mb_dir = substr($mb['mb_id'],0,2);
            $icon_file = G5_DATA_PATH.'/member/'.$mb_dir.'/'.$mb['mb_id'].'.'.$mb['mb_10'];
            if (file_exists($icon_file) && $mb['mb_10'] != '') {
                $icon_url = G5_DATA_URL.'/member/'.$mb_dir.'/'.$mb['mb_id'].'.'.$mb['mb_10'];
                echo '<div style="padding-top:10px;">';
				echo '<img src="'.$icon_url.'" style="width:100%; max-width:200px;">';
                echo '&nbsp;&nbsp;<label><input type="checkbox" id="del_mb_icon" name="del_mb_icon" value="1"> 삭제</label>';
				echo '</div>';
            }
            ?>
        </td>
		*/ ?>
    </tr>

    <? // 23.08.21 매장주소/업태/종목/이메일주소 추가?>
    <? if(1) { ?>
    <tr>
        <th scope="row"><label for="mb_addr1">매장주소</label></th>
        <td>
            <input type="hidden" name="mb_zip" value="<?php echo $mb['mb_zip1'].$mb['mb_zip2']; ?>" id="mb_zip" class="frm_input readonly" size="5" maxlength="6">
            <input type="text" name="mb_addr1" value="<?php echo $mb['mb_addr1'] ?>" id="mb_addr1" class="frm_input readonly" size="60" onclick="win_zip('fmember', 'mb_zip', 'mb_addr1', 'mb_addr2', 'mb_addr3', 'mb_addr_jibeon');">
            <button type="button" class="btn_frmline" onclick="win_zip('fmember', 'mb_zip', 'mb_addr1', 'mb_addr2', 'mb_addr3', 'mb_addr_jibeon');">주소 검색</button><br>

            <input type="text" name="mb_addr2" value="<?php echo $mb['mb_addr2'] ?>" id="mb_addr2" class="frm_input" size="30">


            <input type="hidden" name="mb_addr3" value="<?php echo $mb['mb_addr3'] ?>" id="mb_addr3" class="frm_input" size="60">
            <input type="hidden" name="mb_addr_jibeon" value="<?php echo $mb['mb_addr_jibeon']; ?>"><br>
        </td>
        <th scope="row"><label for="mb_5">업태</label></th>
        <td><input type="text" name="mb_5" value="<?=$mb['mb_5']?>" id="mb_5" class="frm_input" size="15" maxlength="20"></td>
    </tr>
    <tr>
        <th scope="row"><label for="mb_6">종목</label></th>
        <td><input type="text" name="mb_6" value="<?=$mb['mb_6']?>" id="mb_6" class="frm_input" size="15" maxlength="20"></td>
        <th scope="row"><label for="mb_hp">이메일주소</label></th>
        <td><input type="text" name="mb_email" value="<?=$mb['mb_email']?>" id="mb_email" class="frm_input" size="50" maxlength="20"></td>
    </tr>
    <? } ?>

	<!--
    <tr>
        <th scope="row">주소</th>
        <td colspan="3" class="td_addr_line">
            <label for="mb_zip" class="sound_only">우편번호</label>
            <input type="text" name="mb_zip" value="<?php echo $mb['mb_zip1'].$mb['mb_zip2']; ?>" id="mb_zip" class="frm_input readonly" size="5" maxlength="6">
            <button type="button" class="btn_frmline" onclick="win_zip('fmember', 'mb_zip', 'mb_addr1', 'mb_addr2', 'mb_addr3', 'mb_addr_jibeon');">주소 검색</button><br>
            <input type="text" name="mb_addr1" value="<?php echo $mb['mb_addr1'] ?>" id="mb_addr1" class="frm_input readonly" size="60">
            <label for="mb_addr1">기본주소</label><br>
            <input type="text" name="mb_addr2" value="<?php echo $mb['mb_addr2'] ?>" id="mb_addr2" class="frm_input" size="60">
            <label for="mb_addr2">상세주소</label>
            <br>
            <input type="text" name="mb_addr3" value="<?php echo $mb['mb_addr3'] ?>" id="mb_addr3" class="frm_input" size="60">
            <label for="mb_addr3">참고항목</label>
            <input type="hidden" name="mb_addr_jibeon" value="<?php echo $mb['mb_addr_jibeon']; ?>"><br>
        </td>
    </tr>
	-->
    <?php if ($w == 'u') { ?>
	<!--
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
	-->
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

	<input type="hidden" name="mb_leave_date" id="mb_leave_date" value="<?php echo $mb['mb_leave_date'] ?>">
	<input type="hidden" name="mb_intercept_date" id="mb_intercept_date" value="<?php echo $mb['mb_intercept_date'] ?>">

    </tbody>
    </table>

	<div class="shadow_box" style="display:inline-block; width:450px; vertical-align:top;">
		<label class="shadow_title">1:1 문의 수신항목 설정</label>
		<div style="padding-bottom:15px;">( 점주가 1:1문의를 등록 했을 때 알림 문자를 수신하는 기능입니다 )</div>
		<?php
		$inq_sql = " select * from g5_write_inquiry_cate WHERE ic_use = 'Y' order by ic_idx asc ";
		$inq_qry = sql_query($inq_sql);
		$inq_num = sql_num_rows($inq_qry);
		if($inq_num > 0){
			for($inq=0; $inq<$inq_num; $inq++){
				$inq_row = sql_fetch_array($inq_qry);

				$icm_sql = " select count(*) as cnt from g5_write_inquiry_cate_mb where icm_ca_idx='{$inq_row['ic_idx']}' and icm_mb_id='{$mb_id}' and icm_use='y' ";
				$icm_row = sql_fetch($icm_sql);
		?>
		<div class="inq_container">
			<div class="inq_box">
				<input type="checkbox" name="inq_check[]" id="inq_check<?php echo $inq ?>" class="inq_check" value="<?php echo $inq_row['ic_idx'] ?>" <?php if($icm_row['cnt'] > 0) echo 'checked'; ?>>
				<label style="cursor:pointer; display:inline-block; margin-top:3px;" for="inq_check<?php echo $inq ?>"><?php echo $inq_row['ic_ca_name'] ?></label>
			</div>
		</div>
		<?php
			}
		}
		?>
		<div style="clear:both; margin:0; padding:0; height:0;"></div>
	</div>

	<div style="display:inline-block; margin:0; width:520px; vertical-align:top;">
	<div class="shadow_box" style="display:inline-block; margin-left:20px; width:450px; vertical-align:top;">
		<label class="shadow_title">쇼핑몰 문자 수신항목 설정</label>
		<?php
		$osc_sql = " select * from g5_order_sms_cate order by osc_idx asc ";
		$osc_qry = sql_query($osc_sql);
		$osc_num = sql_num_rows($osc_qry);
		if($osc_num > 0){
			for($osc=0; $osc<$osc_num; $osc++){
				$osc_row = sql_fetch_array($osc_qry);

				$oscm_sql = " select count(*) as cnt from g5_order_sms_cate_mb where oscm_ca_name='{$osc_row['osc_ca_name']}' and oscm_mb_id='{$mb_id}' and oscm_use='y' ";
				$oscm_row = sql_fetch($oscm_sql);
		?>
		<div class="osc_container">
			<div class="osc_box">
				<input type="checkbox" name="osc_check[]" id="osc_check<?php echo $osc ?>" class="osc_check" value="<?php echo $osc_row['osc_ca_name'] ?>" <?php if($oscm_row['cnt'] > 0) echo 'checked'; ?>>
				<label style="cursor:pointer; display:inline-block; margin-top:3px;" for="osc_check<?php echo $osc ?>"><?php echo $osc_row['osc_ca_name'] ?></label>
			</div>
		</div>
		<?php
			}
		}
		?>
		<div style="clear:both; margin:0; padding:0; height:0;"></div>
	</div>

	<div class="shadow_box" style="display:inline-block; margin-top:70px; margin-left:20px; width:450px; vertical-align:top;">
		<label class="shadow_title">칭찬합니다 게시판 문자 수신설정</label>
		<?php
		$psc_sql = " select * from g5_praise_sms_cate order by psc_idx asc ";
		$psc_qry = sql_query($psc_sql);
		$psc_num = sql_num_rows($psc_qry);
		if($psc_num > 0){
			for($psc=0; $psc<$psc_num; $psc++){
				$psc_row = sql_fetch_array($psc_qry);

				$pscm_sql = " select count(*) as cnt from g5_praise_sms_cate_mb where pscm_ca_name='{$psc_row['psc_ca_name']}' and pscm_mb_id='{$mb_id}' and pscm_use='y' ";
				$pscm_row = sql_fetch($pscm_sql);
		?>
		<div class="osc_container">
			<div class="osc_box">
				<input type="checkbox" name="psc_check[]" id="psc_check<?php echo $psc ?>" class="psc_check" value="<?php echo $psc_row['psc_ca_name'] ?>" <?php if($pscm_row['cnt'] > 0) echo 'checked'; ?>>
				<label style="cursor:pointer; display:inline-block; margin-top:3px;" for="psc_check<?php echo $psc ?>"><?php echo $psc_row['psc_ca_name'] ?></label>
			</div>
		</div>
		<?php
			}
		}
		?>
        <div style="clear:both; margin:0; padding:0; height:0;"></div>
	</div>

	</div>

</div>

<div class="btn_confirm01 btn_confirm" style="clear:both;">
    <input type="submit" value="확인" class="btn_submit" accesskey='s'>
    <a href="./member_list.php?<?php echo $qstr ?>">목록</a>
</div>
</form>

<script>
$(function(){
	$("#mb_level").on('change', function(){

		var mb_level = $(this).val();

		$.ajax({
			type: "POST",
			url: "<?php echo G5_BBS_URL ?>/mc_list.php",
			data: { level: mb_level },
			success:function( datas ) {
				if(datas){
					datas_arr = datas.split('|');
					if(datas_arr.length > 0){
						var adata = '';
						$("#mb_1").empty();
						$("#mb_1").append("<option>선택하세요</option>");

						for(var i=0; i<datas_arr.length; i++){
							adata += '<option value="'+datas_arr[i]+'">'+datas_arr[i]+'</option>';
						}

						$("#mb_1").append(adata);
					}
				}
			}
		});

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

    return true;
}
</script>

<?php
include_once('./admin.tail.php');
?>
