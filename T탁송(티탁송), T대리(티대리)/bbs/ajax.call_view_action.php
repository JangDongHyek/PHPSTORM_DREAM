<?php
/************************************************
콜 상세 - 상태변경 버튼호출
************************************************/
include_once('./_common.php');

$mb_id = $_GET['mb_id'];                // 콜신청 회원 아이디
$mb_hp = $_GET['mb_hp'];                // 콜신청 회원 연락처
$call_status = $_GET['status'];         // 현재 콜상태
$call_type = $_GET['call_type'];        // 콜종류
$driver_id = $_GET['driver_id'];        // 수락한 드라이버 아이디
$cancel_yn = $_GET['cancel_yn'];        // 콜상태 접수일때 취소가능여부 (Y, N)


// <0>대기, <R>접수 (동일한 상태이지만 관리자에서 신청,접수로 단순 구분짓기위해 분리)
if ($call_status == "0" || $call_status == "R") {
    // 본인이 신청한 콜이면 취소버튼 노출
    if ($member['mb_level'] == "2" && $member['mb_id'] == $mb_id) {
        if ($cancel_yn == "N" && $call_status == "R") { // 취소불가
?>
        <!-- 1.1) 고객 : 요청취소버튼 -->
        <button class="btn request" type="button" onclick="completeAcceptAlim()">접수완료</button>
<?php
        } else {
?>
        <!-- 1.2) 고객 : 요청취소버튼 -->
        <button class="btn request" type="button" id="cancel-btn" onclick="openCancel()">T대리 취소하기</button>
<?php
        } // $cancel_yn
    }
    // 자기사이며 본인이 수락할수있는 콜유형 or 본인이 수락불가
    else if ($member['mb_level'] == "5") {
        $_tmp = array('event'=>'getNoti(1, \'수락 불가능한 콜 입니다.\')', 'name'=>'T대리 수락불가', 'cls'=>'state off');
        if ($member['driv_type']=="2" || $member['driv_type']==$call_type) {
            $_tmp['event'] = "request('1')";
            $_tmp['name'] = "T대리 수락하기";
            $_tmp['cls'] = "request";
        }
?>
        <!-- 3) 기사(자기사) : 요청수락버튼 -->
        <button class="btn <?=$_tmp['cls']?>" type="button" id="request_btn" onclick="<?=$_tmp['event']?>"><?=$_tmp['name']?></button>
<?php
    }
}
// <-1>취소
else if ($call_status == "-1") {
?>
        <!-- 2) 공통 : 취소알림 -->
        <button class="btn state off" type="button" id="status-btn4">취소됨</button>
<?php
}
// <1>진행
else if ($call_status == "1") {
    // 진행중인 기사이면
    if ($member['mb_id'] == $driver_id) {
?>
        <!-- 4) 기사 : 요청수락시 진행중 버튼 (기사완료) -->
        <div id="ongoing_area">
            <p style="margin: 10px 0;font-weight: bold;color:#63AA66;">진행중인 콜입니다.</p>
            <button class="btn state on" type="button" id="status-btn1" onclick="request('2')">진행완료하기</button>
            <div class="connect" style="margin-top: 5px;">
                <a type="button" class="btn" href="tel://<?=$mb_hp?>">고객연결</a>
                <a type="button" class="btn" href="javascript:getNoti(1, '준비중입니다.');">상황실연결</a>
            </div>
        </div>
<?php
    }
    // 진행중인 회원이면
    else if ($member['mb_id'] == $mb_id) {
?>
        <!-- 5) 고객 : 요청수락시 진행중 버튼 -->
        <button class="btn state on" type="button" id="status-btn5">진행중</button>
<?php
    }
}
// <2>진행완료
else if ($call_status == "2") {
?>
        <!-- 6) 기사 : 진행완료 -->
        <button class="btn state off" type="button" id="end_btn">진행완료</button>
<?php
}
?>