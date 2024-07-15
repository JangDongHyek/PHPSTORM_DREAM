<?php
include_once("./_common.php");

/** 기업 - 마이페이지 - 기업의뢰 - 미체결 / 거래 후기 조회 (ajax) **/

if($mode == 'no') { // 미체결사유
    $cnt = selectCount("g5_company_inquiry_result", "inquiry_idx", $idx);
    if($cnt > 0) {
        $sql = " select * from g5_company_inquiry_result where inquiry_idx = {$idx} ";
        $row = sql_fetch($sql);

        echo json_encode($row);
    }
}
else if($mode == 'select') { // 거래후기
    
}