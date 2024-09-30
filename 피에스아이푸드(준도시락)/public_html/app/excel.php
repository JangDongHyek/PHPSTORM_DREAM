<?php
include_once('../common.php');
/**
 * 사파리에서 엑셀 다운로드 할 수 있게 하기 위하여 중간 링크 추가
 * 없으면 사파리에서 바로 다운로드 받을 수 없음, 링크 받아서 다시 열어야 함
 */
$ed_date = empty($ed_date) ? date('Y-m-d') : $ed_date;
echo("<script>location.replace('".APP_URL."/excel_download.php?mb_id=".$mb_id."&cate=정기배달&st_date=".$st_date."&ed_date=".$ed_date."');</script>");
?>