<?php
include_once('./_common.php');
/**
 *  For Sale(매물올리기) 등록/수정
 */
@mkdir(G5_DATA_PATH . '/file/' . 'for_sale', G5_DIR_PERMISSION);
@chmod(G5_DATA_PATH . '/file/' . 'for_sale', G5_DIR_PERMISSION);

//print_r($_FILES);exit;
//print_r($_REQUEST);exit;

// 등록번호
$max = sql_fetch(" select max(substring(ref_no, 2)) as max from g5_for_sale where sale_type = '{$sale_type}' and del_yn is null ")['max'];
if(empty($max)) {
    $ref_no = substr($sale_type,0,1).'0000001';
} else {
    $max = sprintf('%07d', $max+1);
    $ref_no = substr($sale_type,0,1).$max;
}

$sql_common = ", sale_type = '{$sale_type}', ref_no = '{$ref_no}', sale_category = '{$sale_category}', sale_subject = '{$sale_subject}' ";

if($sale_type == 'ship') {
    $sql_common .= ", ship_type = '{$ship_type}',
                      ship_name = '{$ship_name}',
                      main_capacity = '{$main_capacity}',
                      main_capacity_unit = '{$main_capacity_unit}',
                      built_year = '{$built_year}',
                      sub_capacity = '{$sub_capacity}',
                      sub_capacity_unit = '{$sub_capacity_unit}',
                      price_idea = '{$price_idea}',
                      loa = '{$loa}',
                      breadth = '{$breadth}',
                      depth = '{$depth}',
                      class = '{$class}',
                      service_speed = '{$service_speed}',
                      ship_location = '{$ship_location}',
                      sell_as_scrap = '{$scrap}',
                      full_description = '{$full_description}'";
}
else if($sale_type == 'machinery') {
    $sql_common .= ", product_name = '{$product_name}',
                      maker = '{$maker}',
                      manufacture_year = '{$manufacture_year}',
                      model = '{$model}',
                      certificate = '{$certificate}',
                      condition = '{$condition}',
                      quantity = '{$quantity}',
                      quantity_unit = '{$quantity_unit}',
                      price_idea = '{$price_idea}',
                      price_idea_unit = '{$price_idea_unit}',
                      delivery = '{$delivery}',
                      payment = '{$payment}',
                      guarantee = '{$guarantee}',
                      located_at = '{$located_at},
                      full_description = '{$full_description}'";
}
else if($sale_type = 'parts/articles') {
    $sql_common .= ", maker = '{$maker}',
                      model = '{$model}',
                      certificate = '{$certificate}',
                      sale_condition = '{$condition}',
                      delivery = '{$delivery}',
                      payment = '{$payment}',
                      located_at = '{$located_at}',
                      full_description = '{$full_description}'";
}

if($w == '') {
    $sql = " insert into g5_for_sale set mb_id = '{$member['mb_id']}', wr_datetime = '" . G5_TIME_YMDHIS . "' {$sql_common} ";
    $result = sql_query($sql);
    $idx = sql_insert_id();
}
else if($w == 'u') {
    $sql = " update g5_for_sale set up_datetime = '".G5_TIME_YMDHIS."' {$sql_common} where idx = '{$idx}' ";
    $result = sql_query($sql);
}
else if($w == 'd') { // 삭제
    $sql = " update g5_for_sale set del_yn = 'Y' where idx = '{$idx}' ";
    $result = sql_query($sql);
}

// 부품
if($sale_type == 'parts/articles') {
    sql_query(" delete from g5_for_sale_part where for_sale_idx = '{$idx}' ");
    for($i=0; $i<count($item); $i++) {
        $sql = " insert into g5_for_sale_part set 
                 for_sale_idx = '{$idx}', mb_id = '{$member['mb_id']}', item = '{$item[$i]}',
                 part_no = '{$part_no[$i]}', drawing_no = '{$drawing_no[$i]}', qty = '{$qty[$i]}', unit_price = '{$unit_price[$i]}',price = '{$price[$i]}', remark = '{$remark[$i]}' ";
        sql_query($sql);
    }
}

// 파일 삭제
$del_file = explode(',', $del_file_idx);
for($i = 0; $i < count($del_file); $i++) {
    $sql = " select * from g5_for_sale_img where idx = {$del_file[$i]} ";
    $row = sql_fetch($sql);

    unlink(G5_DATA_PATH . '/file/for_sale/' . $row['img_file']);

    $sql = " delete from g5_for_sale_img where idx = {$del_file[$i]} ";
    sql_query($sql);
}

// 파일 업로드
for($i=0; $i<count($_FILES['files']['name']); $i++) {
    if(!empty($_FILES['files']['name'])) {
        $tmp_file = $_FILES['files']['tmp_name'][$i];
        $filesize = $_FILES['files']['size'][$i];
        $filename = $_FILES['files']['name'][$i];
        $filename = get_safe_filename($filename);
        $img_file = fileUpload_up(G5_DATA_PATH . "/file/for_sale/", $filename, $tmp_file); // 경로, 파일명, 임시파일명

        // 견적 상세 자료 DB INSERT
        $result = sql_query(" insert into g5_for_sale_img set for_sale_idx = {$idx}, img_source = '{$filename}', img_file = '{$img_file}', img_filesize = '{$filesize}', img_datetime = '" . G5_TIME_YMDHIS . "' ");
    }
}

if($result) {
    die('success');
}
?>