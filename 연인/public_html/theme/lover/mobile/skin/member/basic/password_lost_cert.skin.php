<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);

$find_css = "";

// kcb인증후 비밀번호 업데이트
if ($kcb_cert == "Y") {
	$find_css = "display: block;";
	$err_msg = "임시비밀번호 발급에 실패하였습니다. 다시 시도해 주세요.";
	$err_url = G5_BBS_URL."/password_lost_cert.php";

    /*
    if ($_SERVER['REMOTE_ADDR'] == "183.103.22.103") {
        print_r($_POST);
        Array
        (
            [kcb_step] => 2
            [kcb_name] => ������
            [kcb_birth] => 19890220
            [kcb_sex] => F
            [kcb_hp] => 01026120220
            [kcb_cert] => Y
            [kcb_telcom] => 02
        )

        die();
    }
    */

	// 본인인증 완료되었으면 임시비밀번호 발급
	$tmp_pass = getRandomString(6);
	$mb_password = get_encrypt_string($tmp_pass);
	$mb_hp = $kcb_hp;

	if ($mb_hp == "")
		alert($err_msg, $err_url);

	// (210902) 본인인증시 휴대폰/생년월일/이름 조건 비교추가
    $kcb_birth_format = substr($kcb_birth, 0, 4)."-".substr($kcb_birth, 4, 2)."-".substr($kcb_birth, 6, 2);
    $kcb_name_utf8 = iconv("euckr","utf-8", $kcb_name);

	$sql = "UPDATE g5_member SET 
			mb_password = '{$mb_password}', 
			mb_10 = '{$tmp_pass}' 
			WHERE REPLACE(mb_hp, '-', '') = '{$mb_hp}' AND mb_hp != '' AND mb_level != 10 AND mb_status IN ('일반') AND mb_birth = '{$kcb_birth_format}' AND mb_name = '{$kcb_name_utf8}'
			";
	$update_result = sql_query($sql);

	if ($update_result) {
		$sql = "SELECT mb_id FROM g5_member 
				WHERE REPLACE(mb_hp, '-', '') = '{$mb_hp}' AND mb_level != 10 AND mb_status IN ('일반') AND mb_birth = '{$kcb_birth_format}' AND mb_name = '{$kcb_name_utf8}'
				ORDER BY mb_no DESC LIMIT 0, 1";
		$row2 = sql_fetch($sql);
		$mb_id = $row2['mb_id'];
		
		// 아이디조회 실패
		if ($mb_id == "")
			alert("본인확인 정보와 일치하는 회원정보가 없습니다.", $err_url);

	} else {
		alert($err_msg, $err_url);
	}
}

?>
<style>
.mbskin .btn_submit {width:60px;height:50px;background:#ac9dd4;color:#fff; width:100%;border-radius:0px !important; border:1px solid #fff; box-shadow:none;font-size:1.3em;font-weight:bold;margin:5px 0; transition:all 0.3s;}
.mbskin .btn_submit:hover{ background:#fff!important; color:#2abaee!important; border-color:#2abaee!important; transition:all 0.3s;}
.mbskin .win_btn {margin-top: 30px;}
.mbskin .win_btn:after{ display:block; content:""; color:both;}
.mbskin .win_btn .btn_submit{ font-size:13px; height:40px; float:left; width:50%; margin:0 !important; box-sizing: border-box;}
.mbskin .win_btn .btn01{padding: 0; float:left; width:calc(48% - 2%); margin-left:2%; height: 40px; line-height: 40px; box-sizing: border-box; font-size: 13px;}
.mbskin p {padding: 10px 0;}
#find_frm {margin: 10px 0;}
#find_info{padding:30px;}
#find_info #mb_hp_label {display:inline-block;margin-left:10px}
#find_info #info_fs {margin:0px 0px;padding:0; font-size:0.95em;}
#find_info #info_fs label{ display:none;}
#find_info #info_fs .frm_input {width:100%; padding:0 10px; font-size:13px; margin-top:5px; height: 35px; background: #FFF; border: 0; border-bottom: 1px solid #ac9dd4; border-radius: 0 !important;}
#find_info #info_fs .phone{ width:65%;}
#find_info #info_fs .phone_btn{ width:calc(35% - 10px); margin:5px 0 0 5px; border:1px solid #333; background:#444; color:#fff; font-size:13px; padding:2px 0; height: 35px;}
#find_info #info_fs  p {margin:15px 0;line-height:1.5em; font-size:13px;}
#find_info #captcha {margin:0 20px}
.mbskin button.btn01{width:100%;padding:10px 0;text-align:center;border-radius:0px!important; background:none; border:1px solid #ccc; color:#333; margin-bottom:3px; font-size:0.9em; letter-spacing:-1px;}
#find_info #win_title { border-bottom:1px solid #ddd; padding:10px 0; font-size:1.4em; font-weight: 700;} 
#find_result {clear: both; display: none;}
#find_result h1 {margin-bottom:10px; font-size: 14px; font-weight:bold;}
</style>

<!-- 회원정보 찾기 시작 { -->
<div id="find_info" class="mbskin">
    <h1 id="win_title">회원정보 찾기</h1>
	
	<? if ($kcb_cert != "Y") { ?>
	<!-- 1) 찾기 -->
	<div id="find_frm">
		<fieldset>
		<p>휴대폰 본인인증 후 새로운 비밀번호로 변경하실 수 있습니다.</p>
		</fieldset>
		<div class="win_btn">
			<input type="button" value="본인인증" class="btn_submit" onclick="location.href='./kcb/phone_popup1.php?req_page=find'">
			<button type="button" onclick="javascript:history.back();" class="btn01">뒤로</button>
			<div style="clear:both;"></div>
		</div>
	</div>
	<!-- // 찾기 -->
	<? } ?>

	<!-- 2) 본인인증 완료 -->
	<div id="find_result" style="<?=$find_css?>">
		<fieldset id="info_fs">
			<p>
				임시비밀번호로 변경 완료되었습니다. <br>로그인 후 비밀번호를 변경해 주세요.
			</p>
			<h1>* 아이디 : <span id="tmp_id"><?=$mb_id?></span></h1>
			<h1>* 임시비밀번호 : <span id="tmp_pass"><?=$tmp_pass?></span></h1>
			<div class="win_btn">
				<input type="button" value="로그인으로 이동" class="btn_submit" onclick="location.href='./login.php'">
				<button type="button" onclick="location.href='<?=G5_URL?>'" class="btn01">메인화면</button>
			</div>
		</fieldset>
	</div>
	<!-- // 본인인증 완료 -->
</div>