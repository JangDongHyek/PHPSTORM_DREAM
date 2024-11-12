<?php
include_once('./_common.php');
include_once(G5_LIB_PATH.'/mailer.lib.php');

$reg_mb_email = $_POST['reg_mb_email'];

// 인증 완료, 가입 완료한 메일일 경우
$sql = " select count(*) as count from {$g5['member_table']} where mb_email = '{$reg_mb_email}' ";
$row = sql_fetch($sql);
$count = $row['count'];

if($count > 0) {
    die('no');
}

// 인증에 사용할 키 설정 (이메일 암호화)
$certify_key = base64_encode($_POST['reg_mb_email']);

// 인증 링크 생성
$certify_href = G5_BBS_URL.'/certi_mail_check.php?certify_key='.$certify_key.'&amp;';

// 메일 제목
$subject = "[회원가입] fingerrate 이메일 인증";

// 메일 내용
$content = "";
$content .= "<div style='width:600px;border:10px solid #f7f7f7;text-align: center;'>";
$content .= "<span><img src='".G5_THEME_IMG_URL."/common/logo.png' style='width: 200px;'></span><h1 style='color:#555;font-size:1.4em'> 이메일 인증 안내</h1>";
$content .= "<p style='font-size:20px;margin-bottom:0;padding-top: 20px;padding-bottom: 20px;font-family:Nanum Gothic;background:#f7f7f7;'>아래 이메일 인증하기 버튼을 클릭하세요.</p>";
$content .= "<a href='".$certify_href."' target='_blank' style='display:inline-block;background-color:#4a8cdb;padding:16px 52px;font-size:20px;color:#fff;text-decoration:none;margin-top: 20px;margin-bottom: 20px;'>이메일 인증하기</a>";
$content .= "</div>";

// 메일 발송
itforoneMailer( 'ghs1214@hanmail.net','아이티포원', $reg_mb_email, $reg_mb_email, $subject, $content);

// 인증 요청 횟수
$sql = " select count(*) as count from g5_certify_history where ch_id = '{$reg_mb_email}' ";
$row = sql_fetch($sql);
$count = $row['count'];

// 인증 이력이 없을 경우 insert / 인증 이력이 있을 경우 인증일자 update
// * ch_count : 중복 메일 확인용 (미사용 시 삭제)
if($count == 0) {
    $sql_common = " ch_method = 'mail', ch_id = '{$reg_mb_email}', ch_count = 1 ";
    sql_query(" insert into g5_certify_history set $sql_common ");
} else {
    $count = $count+1;
    $sql_common = " ch_count = {$count}, ch_date = now() where ch_id = '{$reg_mb_email}' ";
    sql_query(" update g5_certify_history set $sql_common ");
}

// 메일 발송 결과 코드
die($data['code']);
?>