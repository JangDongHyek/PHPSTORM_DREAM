<?php

$sql = "select * from {$g5['board_file_table']} where wr_id = '{$_REQUEST['idx']}' and bo_table = 'car_wash' ";
$result = sql_query($sql);
$cnt = sql_num_rows($result);
?>

<div>
    <?php
    // 파일 출력
    if($cnt != 0) {
        for ($b = 0; $file = sql_fetch_array($result); $b++) {
            echo '<img class="swiper-slide" src="'.G5_DATA_URL.'/file/car_wash/'.$file['bf_file'].'">';;
        }
    }
    ?>
</div>
