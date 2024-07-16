<?php
include_once('./_common.php');

if(!empty($company_inquiry_idx)) {
    $ce_offer_price = str_replace(',','',$ce_offer_price);

    $sql = " insert into g5_company_estimate set company_inquiry_idx = {$company_inquiry_idx}, mb_id = '{$member['mb_id']}', ce_offer_price = '{$ce_offer_price}', ce_unit = '{$ce_unit}', ce_contents = '{$ce_contents}', wr_datetime = '".G5_TIME_YMDHIS."' ";
    $result = sql_query($sql);

    if($result) {
        if($mode == 'adm') { // 관리자페이지에서 견적보내기 시 -- 사용 x
            echo '<script>alert("견적보내기를 완료하였습니다.");window.close();opener.parent.location.reload();</script>';
        }
        else {
            alert('견적보내기를 완료하였습니다.', G5_BBS_URL.'/company_list.php', false);
        }
    }
}