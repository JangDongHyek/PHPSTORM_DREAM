<?php
//!#/usr/local/php -q
header('Content-Type: text/html; charset=UTF-8');

$hostName = "localhost";
$userName = "tdaeri2";
$password = "7p0weqkw";
$database = "tdaeri2";
$connect = mysqli_connect($hostName,$userName,$password,$database);
mysqli_select_db($connect,$database);

// echo "매월1일 차감";

$check_month_day = ((int)date("d") == 1)? true : false;


$sql = "SELECT * FROM g5_member WHERE at_point2_type = '1' ";
if ($check_month_day) $sql .= "OR at_point_type = '1' "; // 매월 1일 : 월/일 차감 체크

$sql .= "ORDER BY mb_no ASC";
$result = mysqli_query($connect, $sql);

while($member = mysqli_fetch_array($result)) {
    $mb_id = $member['mb_id'];                      // 회원아이디

    $at_point = $member['at_point'];                // 자동차감 포인트 - 월
    $at_point_type = $member['at_point_type'];      // 차감방식 - 월차감 (0:없음, 1:차감)

    $at_point2 = $member['at_point2'];              // 자동차감 포인트 - 일
    $at_point2_type = $member['at_point2_type'];    // 차감방식 - 일차감 (0:없음, 1:차감)

    //echo "회원아이디:".$mb_id."({$member['mb_no']}/{$member['mb_name']})<br>";

    $list = [];

    // 월 차감 확인
    if ($at_point_type == "1" && $check_month_day) {
        $list[2] = array("date"=>date("Y-m-01"), "action"=> "auto_point_month", "point"=>$at_point);
    }

    // 일 차감 확인
    if ($at_point2_type == "1") {
        $list[1] = array("date"=>date("Y-m-d"), "action"=> "auto_point_day", "point"=>$at_point2);
    }

//    print_r($list);
//    echo "<br>";
//    continue;

    foreach ($list AS $key=>$val) {
        $sql2 = "SELECT COUNT(*) AS cnt FROM g5_point 
                 WHERE mb_id = '{$mb_id}' AND po_rel_action = '{$val['action']}' AND po_auto_date = '{$val['date']}'";
        $result2 = mysqli_query($connect, $sql2);
        $point = mysqli_fetch_assoc($result2);

        //echo $sql2;

        if ($point['cnt'] == 0) {
            //echo "차감하기<br>";

            $mb_point = getMemberPoint($mb_id);                     // 회원 누적포인트
            $remain_point = (int)$mb_point - (int)$val['point'];    // 잔여포인트

            minusMemberPoint($mb_id, $key, $val['point'], $remain_point);

        } else {
            //echo "차감함<br>";
        }
    }

}


// 회원 누적포인트
function getMemberPoint($mb_id) {
    global $connect;

    // 회원 포인트 조회
    $sql = "SELECT po_mb_point FROM g5_point WHERE mb_id = '{$mb_id}' ORDER BY po_id DESC LIMIT 0,1";
    $result = mysqli_query($connect, $sql);
    $point = mysqli_fetch_assoc($result);

    return $point['po_mb_point']; // 누적포인트
}


// 회원 포인트 차감
function minusMemberPoint($mb_id, $at_type, $use_point, $remain_point)
{
    global $connect;

    $content = "포인트 자동차감 ";
    $action = "auto_point";
    $po_auto_date = "";

    if ($at_type == "1") {
        $content .= "(일/".date("Y.m.d").")";
        $action .= "_day";
        $po_auto_date = date("Y-m-d");

    } else if ($at_type == "2") {
        $content .= "(월/".date("Y.m").")";
        $action .= "_month";
        $po_auto_date = date("Y-m-01");

    } else {
        return;
    }

    // 포인트차감 DB 등록
    $sql = "insert into g5_point set 
            mb_id = '{$mb_id}',
            po_datetime = '" . date("Y-m-d H:i:s") . "',
            po_content = '" . addslashes($content) . "',
            po_point = '0',
            po_use_point = '{$use_point}',
            po_mb_point = '{$remain_point}',
            po_expired = '0',
            po_expire_date = '9999-12-31',
            po_rel_table = '',
            po_rel_id = '',
            po_rel_action = '{$action}',
            po_rel_tid = '',
            po_auto_date = '{$po_auto_date}'
            ";
    $insert_res = mysqli_query($connect, $sql);
    //echo ($insert_res)? "성공" : "실패";

    if ($insert_res) {
        // 회원 잔여포인트 UPDATE
        $sql = " update g5_member set mb_point = '{$remain_point}' where mb_id = '{$mb_id}'";
        mysqli_query($connect, $sql);
    }

}

die();