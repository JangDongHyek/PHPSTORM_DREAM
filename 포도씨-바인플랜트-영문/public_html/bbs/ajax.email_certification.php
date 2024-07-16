<?php
include_once('./_common.php');
include_once(G5_LIB_PATH.'/mailer.lib.php');

// * 인증 완료 후 가입 완료한 메일일 경우
$count = selectCount('g5_member', 'mb_email', $reg_mb_email);
if($count > 0) {
    die('fail1');
}

// * 인증 처리
// 인증에 사용할 키 설정 (이메일 암호화)
$certify_key = base64_encode($reg_mb_email);

// 인증 요청 횟수 조회 (메일 재발송 때문)
$request_count = sql_fetch(" select ch_count from g5_certify_history where ch_id = '{$reg_mb_email}'; ")['ch_count'];
$certify_count = base64_encode($request_count+1);

// 인증 링크 생성
$certify_href = G5_BBS_URL.'/email_certification_link.php?certify_key='.$certify_key.'&certify_count='.$certify_count.'&amp;';

// 메일 제목
$subject = "[Sign up] podosea Email Authentication";

// 메일 내용
$content = "";
$content .= "<div style='width:600px;border:10px solid #f7f7f7;text-align: center;font-family:Nanum Gothic;'>";
$content .= "<span><h1>podosea</h1></span><h1 style='color:#555;font-size:1.4em'> Email Verification Guide</h1>";
$content .= "<p style='font-size:18px;margin-bottom:0;padding-top: 15px;padding-bottom: 15px;font-family:Nanum Gothic;background:#f7f7f7;'>Click the Authenticate button below.</p>";
$content .= "<a href='".$certify_href."' target='_blank' style='display:inline-block;background-color:#216bd1;padding:10px 32px;font-size:20px;color:#fff;text-decoration:none;margin-top: 20px;margin-bottom: 20px;'>Authenticate</a>";
$content .= "</div>";

// 메일 발송
itforoneMailer( 'no-reply@dreamforone.com','PODOSEA', $reg_mb_email, $reg_mb_email, $subject, $content);

// 인증 이력이 없을 경우 insert
// * ch_count : 중복 메일 확인용
$sql_common = " ch_method = 'mail', send_date = now(), ";
if($request_count == 0) {
    $sql_common .= " ch_id = '{$reg_mb_email}', ch_count = 1 ";
    sql_query(" insert into g5_certify_history set {$sql_common} ");
} else {
    $request_count = $request_count+1;
    $sql_common .= " ch_count = {$request_count} ";
    sql_query(" update g5_certify_history set {$sql_common} where ch_id = '{$reg_mb_email}' ");
}

// 메일 발송 결과 코드
die($data['code']);
?>
