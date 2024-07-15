<?php
include_once("./_common.php");

/** 프리미엄 신청내역 - 상태(등급) 변경 (ajax) **/

// 처리 상태 변경
sql_query(" update g5_premium set state = '{$state}', up_datetime = '".G5_TIME_YMDHIS."' where idx = '{$idx}' ");

if($state == 'Premium') {
    // 프리미엄으로 전환
    $result = sql_query(" update g5_member set mb_grade = 'Premium' where mb_id = '{$mb_id}' ");
} else {
    // 해시태그 5개 초과면 5개까지 남기고 삭제
    $mb = get_member($mb_id);
    if(!empty($mb['mb_hashtag'])) {
        $arr = explode(',', $mb['mb_hashtag']);
        if(count($arr) > 5) {
            $hash_arr = array();
            for($i=0; $i<count($arr); $i++) {
                if($i < 5) {
                    array_push($hash_arr, $arr[$i]);
                }
            }
            $hashtag = implode(',', $hash_arr);
            $sql_add = ", mb_hashtag = '{$hashtag}' ";
        }
    }

    // 베이직으로 전환
    $result = sql_query(" update g5_member set mb_grade = 'Basic' {$sql_add} where mb_id = '{$mb_id}' ");
}

die($result);