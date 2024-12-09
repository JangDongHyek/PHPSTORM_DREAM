<?php
include_once ("./_common.php");

// 24-07-22 완열 토큰 검사 추가
$ss_token = get_session("find_id_token");
set_session("find_id_token","");
if(!empty($ss_token) && !empty($token) && $ss_token == $token){
    $mb_name = $_POST['mb_name'];
    $mb_hp = $_POST['mb_hp'];

    $sql = "SELECT mb_id, mb_datetime FROM g5_member
        WHERE mb_status = '일반' AND mb_name = '{$mb_name}' AND mb_hp = '{$mb_hp}' 
        ORDER BY mb_no ASC;";
    $result = sql_query($sql);
    $result_cnt = sql_num_rows($result);
}
?>
<style>
    .find_box {margin: 20px 0;}
    .find_box strong {color: #ce4168;}
</style>
<div class="find_box">
    <?if ($result_cnt==0) { ?>
    존재하지 않는 회원정보 입니다.
    <? } else { ?>
    <div><?=$result_cnt?>개의 아이디를 찾았습니다.</div>
    <ul>
        <? for ($i = 0; $row = sql_fetch_array($result); $i++) { ?>
         <li><strong><?=$row['mb_id']?></strong> (가입일: <?=date("y.m.d", strtotime($row['mb_datetime']));?>)</li>
        <?} ?>
    </ul>
    <?} ?>
</div>
