<?php
/*************************************************************
배너관리 - 배너등록/수정
 *************************************************************/
include_once('./_common.php');

//print_r($_POST);
//print_r($_FILES);

$table_name = 'new_adm_banner';

$ba_number= preg_replace("/\s+/","", $_POST['ba_number']);
$ba_link = preg_replace("/\s+/","", $_POST['ba_link']);
//$bnr_sort = preg_replace("/\s+/","", $_POST['bnr_sort']);


$sql_common = " ba_link = '{$ba_link}',
				ba_number = '{$ba_number}',
				";

if ($_POST['idx'] == "") {
    $sql = "INSERT INTO {$table_name} SET ";
    $sql .= $sql_common;
    $sql .= "wr_datetime =  '".G5_TIME_YMDHIS."' ";

    $w = "";

} else {
    $sql = "UPDATE {$table_name} SET ";
    $sql .= $sql_common;
    $sql .= "up_datetime =  '".G5_TIME_YMDHIS."' ";
    $sql .= " WHERE idx = '{$_POST['idx']}'";

    $w = "u";
}

// 배너DB 등록
$result = sql_query($sql);

if ($result) {
    $upload_dir = G5_BNR_PATH.'/';
//    echo "<script>alert('".$upload_dir."')</script>";
//    exit();
    $upload_file = $_FILES['image']['tmp_name'];
    $img_del_flag = ($bnr_img_del == "1")? true : false;

    if ($w == "") {
        $row = sql_fetch(" SELECT idx FROM {$table_name} WHERE ba_number= '{$ba_number}' ORDER BY idx DESC LIMIT 0, 1 ");
        $idx = $row['idx'];

    }



    // 이미지업로드 진행
    if ($upload_file != "") {
        $ext = array_pop(explode('.', $_FILES['image']['name']));
        $file_name = "{$idx}_".strtotime(G5_TIME_YMDHIS).".{$ext}";
        $upload_path = $upload_dir.$file_name;
        move_uploaded_file($upload_file, $upload_path);

        if ($w == "u")
            $img_del_flag = true;

    } else {
        $file_name = $bnr_img_old;
    }

    // 이전이미지삭제
    if ($img_del_flag) {
        @unlink($upload_dir.$bnr_img_old);
        if ($file_name == $bnr_img_old) $file_name = "";
    }

    $sql = "UPDATE {$table_name} SET 
			image = '{$file_name}'
			WHERE idx = '{$idx}'
			";
    sql_query($sql);

    // 배너 등록 완료
    echo "<script>parent.frmResult('T');</script>";

} else {
    // 배너 등록 실패
    echo "<script>parent.frmResult('F');</script>";

}

exit;

?>