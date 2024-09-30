<?php
include_once("./_common.php");

// 메뉴등록 (ajax)

@mkdir(G5_DATA_PATH . '/file/' . 'dosirak', G5_DIR_PERMISSION);
@chmod(G5_DATA_PATH . '/file/' . 'dosirak', G5_DIR_PERMISSION);
$file_path = G5_DATA_PATH . '/file/dosirak/';

$do_price = str_replace(',', '', $do_price);
$do_shipping_fee = str_replace(',', '', $do_shipping_fee);

$sql_common = " do_category = '{$do_category}',
                do_name = '{$do_name}', 
                do_price = '{$do_price}', 
                do_shipping_fee = '{$do_shipping_fee}', 
                do_delivery_time = '{$do_delivery_time}', 
                do_min_delivery_cnt = '{$do_min_delivery_cnt}', 
                do_warm = '{$do_warm}', 
                do_add_price = '{$do_add_price}', 
                do_contents = '{$do_contents}',
                rider_color = '{$rider_color}',
                no_st_time = '{$no_st_time}',
                no_ed_time = '{$no_ed_time}',
                no_date = '{$no_date}' ";

if($w == '') { // 등록
    $sql = " insert into g5_dosirak set {$sql_common}, wr_datetime = '".G5_TIME_YMDHIS."' ";
    $result = sql_query($sql);
    $idx = sql_insert_id();
}
else if($w == 'u') { // 수정
    $sql = " update g5_dosirak set {$sql_common}, up_datetime = '".G5_TIME_YMDHIS."' where idx = '{$idx}' ";
    $result = sql_query($sql);
}

// 파일 삭제
$del_file = explode(',', $del_file_idx);
for($i = 0; $i < count($del_file); $i++) {
    $sql = " select * from g5_dosirak_img where idx = {$del_file[$i]} ";
    $row = sql_fetch($sql);

    unlink($file_path . $row['img_file']);

    $sql = " delete from g5_dosirak_img where idx = {$del_file[$i]} ";
    $result = sql_query($sql);
}

// 파일 업로드
for($i=0; $i<count($_FILES['files']['name']); $i++) {
    if(!empty($_FILES['files']['name'])) {
        $tmp_file = $_FILES['files']['tmp_name'][$i];
        $file_size = $_FILES['files']['size'][$i];
        $file_name = $_FILES['files']['name'][$i];
        $file_name = get_safe_filename($file_name);
        $img_file = fileUpload_mod($file_path, $file_name, $tmp_file); // 경로, 파일명, 임시파일명

        // DB INSERT
        $result = sql_query(" insert into g5_dosirak_img set dosirak_idx = {$idx}, img_source = '{$file_name}', img_file = '{$img_file}', img_filesize = '{$file_size}', img_datetime = '" . G5_TIME_YMDHIS . "' ");
    }
}

echo 'success';exit;
