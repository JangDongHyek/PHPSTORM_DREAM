<?php
include_once('./_common.php');

$mb_id = $_REQUEST['mb_id'];

$sql = " update {$g5['member_table']} set mb_approval = 'Y', mb_profile = 'Y', show_yn = 'Y' where mb_id = '{$mb_id}' ";
sql_query($sql);

// 21.05.06 승인 시 330 만나 적립 ==> 22.07.08 부터 160만나로 변경 => 220823 240만나로 수정
$cw_point = 240;
$cw_point = $manna_arr['approval'];

$sql_add = "";
// 만나 유효기간 일주일
$timestamp = strtotime(date('Y-m-d') . " +7 days");
$expire_date = date('Y-m-d', $timestamp);
//$sql_add = ", expire_date = '{$expire_date}' ";


// 23.04.05 승인만나 지급안함 주석처리함 밑에4줄 wc
//$sql = " insert into g5_member_point set mb_id = '{$mb_id}', point_category = '적립', point = '{$cw_point}', acc_point = '{$cw_point}', point_content = '프로필 심사 승인 (".$cw_point." 만나 지급)', wr_datetime = '".G5_TIME_YMDHIS."' ";
//sql_query($sql);

//$sql = " update g5_member set cw_point = '{$cw_point}', acc_cw_point = '{$cw_point}' {$sql_add}  where mb_id = '{$mb_id}' ";
//sql_query($sql);

// 21.03.08 푸시
$mb = get_member($mb_id);
if($member['mb_level'] == 10 && $mb['alarm'] == 'ON') {
    $sql = " select * from g5_fcm where mb_id = '{$mb_id}' "; // 관리자 회원 승인 시 승인 회원에게 푸시
    $fRow = sql_fetch($sql);
    $tokens = array($fRow[token]);
    $message = array(
        "subject"=>"크리스찬시그널",
        "message"=>"프로필 심사 승인 완료되었습니다.",
        "goUrl"=>"",
    );
    $fcm=sendFcm($tokens, $message);
    $fcm=sendFcmIOS($tokens, $message);
}

// ==22.01.14 승인 완료 시 메세지 전송
$mb_no = $mb['mb_no'];
/*
$message = '안녕하세요. 크리스찬 시그널입니다.<br>
먼저 저희 앱에 관심 가져 주시고 회원가입해 주심에 진심으로 감사를 드립니다.<br>
가입 축하로 '.$cw_point.'만나 무료 지급해드립니다.<br>
회원사진을 보시고 열람하시는데 한 섹션 열람 시 80만나가 차감되오며,<br>
저희 앱에서 좋은 분 만나시기를 기도드리며 좋은 하루 되세요.';
*/

// 23.04.05 승인 메세지 변경 wc
/*
$message = '안녕하세요. 크리스찬 시그널입니다.<br>
먼저 저희 앱에 관심 가져 주시고 회원가입해 주심에 진심으로 감사를 드립니다.<br> 
가입만나 2000 만나가 지급되오며<br>
배우자정보, 신앙정보를 무료열람가능하시고, 사진과 나의정보 메세지는 유료전환되십니다. <br> 
저희 앱에서 좋은 분 만나시기를 기도드리며 좋은 하루 되세요.';
*/

// 23.07.14 승인 메세지 변경 wc
$message = '안녕하세요. 크리스찬 시그널입니다.<br>
먼저 저희 앱에 관심 가져 주시고 회원가입해 주심에 진심으로 감사를 드립니다.<br> 
배우자정보, 신앙정보를 무료열람가능하시고, 사진과 나의정보 메세지는 유료전환되십니다. <br> 
저희 앱에서 좋은 분 만나시기를 기도드리며 좋은 하루 되세요.';

// 메세지 저장
$sql = " insert into g5_message set
         send_mb_no = {$member['mb_no']}, send_mb_id = '{$member['mb_id']}', receive_mb_no = {$mb_no}, receive_mb_id = '{$mb_id}', message = '{$message}', message_date = now() ";
sql_query($sql);
// ==22.01.14 승인 완료 시 메세지 전송

die('success');
?>