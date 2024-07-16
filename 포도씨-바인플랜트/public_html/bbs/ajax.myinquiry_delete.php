<?php
include_once('./_common.php');
/**
 * 기업 마이페이지 - 나의의뢰 - 요청의뢰/보낸견적/받은의뢰 삭제(숨김)
 */

if($mode == 'company01' || $mode == 'company03') { // 요청의뢰/받은의뢰
    $info_rlt = sql_query(" select * from g5_company_inquiry where idx in ({$idx}) ");
    while($info = sql_fetch_array($info_rlt)) {
        if(empty($info['noshow'])) {
            $noshow = $member['mb_id'];
        } else {
            $noshow = $info['noshow'].','.$member['mb_id'];
        }
        $sql = " update g5_company_inquiry set noshow = '{$noshow}' where idx = '{$info['idx']}' ";
        $result = sql_query($sql);
    }
}
else if($mode == 'company02') { // 보낸견적
    $info_rlt = sql_query(" select * from g5_company_estimate where idx in ({$idx}) ");
    while($info = sql_fetch_array($info_rlt)) {
        if(empty($info['noshow'])) {
            $noshow = $member['mb_id'];
        } else {
            $noshow = $info['noshow'].','.$member['mb_id'];
        }
        $sql = " update g5_company_estimate set noshow = '{$noshow}' where idx = '{$info['idx']}' ";
        $result = sql_query($sql);
    }
}

die($result);