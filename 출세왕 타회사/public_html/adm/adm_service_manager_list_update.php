<?php
$sub_menu = "200100";
include_once('./_common.php');

check_demo();

if (!count($_POST['chk'])) {
    alert($_POST['act_button']." 하실 항목을 하나 이상 체크하세요.");
}

auth_check($auth[$sub_menu], 'w');

if ($_POST['act_button'] == "선택정산") {
    $qstr = $_POST['qstr'];
    for ($i=0; $i<count($_POST['chk']); $i++)
    {
        // 실제 번호를 넘김
        $k = $_POST['chk'][$i];

        $ma_payment= isset($_POST['ma_payment'][$k]) ? (int) $_POST['ma_payment'][$k] : 0;

        $sql = " update new_car_wash
                        set ma_step = 2,
                            ma_payment_datetime = '".G5_TIME_YMDHIS."',
                            ma_payment = $ma_payment
                            
                        where cw_idx = $k ";
        //var_dump($sql);
        sql_query($sql);
    }

}

if ($msg)
    alert($msg);
    //echo '<script> alert("'.$msg.'"); </script>';


goto_url('./adm_service_manager_list.php?cw_step=2'.$qstr);
?>