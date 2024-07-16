<?php
include_once('./_common.php');

if($mode == 'profile01') { //회사요약
    @mkdir(G5_DATA_PATH . '/file/' . 'company', G5_DIR_PERMISSION);
    @chmod(G5_DATA_PATH . '/file/' . 'company', G5_DIR_PERMISSION);

    // 회사로고 삭제
    if(count($del_file) > 0) {
        $row = sql_fetch(" select * from g5_member_img where idx = {$del_file}; ");
        unlink(G5_DATA_PATH . '/file/company/' . $row['img_file']);
        sql_query(" delete from g5_member_img where idx = {$del_file}; ");
        sql_query(" update g5_member set mb_img_idx = 0 where mb_id = '{$member['mb_id']}' ");
    }

    // 이미지 새로 등록 시
    if(!empty($_FILES['file']['name'])) {
        // 회사로고 파일 업로드
        $tmp_file = $_FILES['file']['tmp_name'];
        $filesize = $_FILES['file']['size'];
        $filename = $_FILES['file']['name'];
        $filename = get_safe_filename($filename);
        $img_file = fileUpload_up(G5_DATA_PATH . "/file/company/", $filename, $tmp_file); // 경로, 파일명, 임시파일명

        // 회사로고 DB INSERT
        sql_query(" insert into g5_member_img set category = '로고', mb_id='{$member['mb_id']}', img_source = '{$filename}', img_file = '{$img_file}', img_filesize = '{$filesize}', img_datetime = '" . G5_TIME_YMDHIS . "' ");
        $img_idx = sql_insert_id();
    }

    // 회원 정보 DB UPDATE
    if(empty($img_idx)) { $img_idx = $member['mb_img_idx']; } // 이미지 idx

    $company_sector_detail = "";
    for($i=0; $i<count($mb_company_sector_detail); $i++) {
        if(!empty($mb_company_sector_detail[$i])) {
            $company_sector_detail .= "{$mb_company_sector_detail[$i]}|";
        }
    }
    $company_sector_detail = substr($company_sector_detail, 0, -1);
    $sql_add = ", mb_company_sector_detail = '{$company_sector_detail}' "; // 상세업종

    $sql = " update g5_member set mb_img_idx = '{$img_idx}', mb_company_name = '{$mb_company_name}', mb_company_name_eng = '{$mb_company_name_eng}',
             mb_company_establish_date = '{$mb_company_establish_date}', mb_company_si = '{$mb_company_si}', mb_company_homepage = '{$mb_company_homepage}', 
             mb_company_sector = '{$mb_company_sector}', profile_updatetime = '".G5_TIME_YMDHIS."' {$sql_add} where mb_id = '{$member['mb_id']}' ";
    $result = sql_query($sql);

    die($result);
}
else if($mode == 'profile02') { //회사소개
    $sql = " update g5_member set mb_company_introduce = '{$mb_company_introduce}', mb_company_introduce_eng = '{$mb_company_introduce_eng}',
             mb_ceo = '{$mb_ceo}', mb_company_tel = '{$mb_company_tel}', mb_company_fax = '{$mb_company_fax}', mb_company_num = '{$mb_company_num}'
             where mb_id = '{$member['mb_id']}' ";
    $result = sql_query($sql);

    die($member['mb_no']);
}
else if($mode == 'profile03') { //인증서 및 자료
    // 카달로그/카달로그커버 삭제
    for($i=0; $i<count($del_files); $i++) {
        $temp = explode(',',  $del_files[$i]);
        $kind = $temp[0]; // 파일 or 커버
        $idx = $temp[1]; // 파일 idx
        if($kind == 'file') { // 파일 삭제 시 커버도 삭제
            // 카달로그 정보
            $del_file =  sql_fetch(" select * from g5_member_img where idx = {$idx} ");

            // 카달로그 삭제
            unlink(G5_DATA_PATH . '/file/company/' . $del_file['img_file']);
            sql_query(" delete from g5_member_img where idx = '{$idx}'; ");

            // 카달로그 커버 정보
            $del_cover = sql_fetch(" select * from g5_member_img where p_idx = {$idx} ");
        }
        else if($kind == 'cover') {
            // 카달로그 커버 정보
            $del_cover = sql_fetch(" select * from g5_member_img where idx = {$idx} ");
        }

        // 카달로그 커버 삭제
        unlink(G5_DATA_PATH . '/file/company/' . $del_cover['img_file']);
        sql_query(" delete from g5_member_img where idx = '{$del_cover['idx']}'; ");
    }

    // 카달로그 커버 수정
    for($i=0; $i<count($edit_covers); $i++) {
        // 카달로그 커버 파일 업로드
        $tmp_file = $_FILES['covers']['tmp_name'][$i];
        $filesize = $_FILES['covers']['size'][$i];
        $filename = $_FILES['covers']['name'][$i];
        $filename = get_safe_filename($filename);
        $img_file = fileUpload_up(G5_DATA_PATH . "/file/company/", $filename, $tmp_file); // 경로, 파일명, 임시파일명

        // 카달로그 커버 DB INSERT
        sql_query(" insert into g5_member_img set category = '카달로그커버', p_idx = {$edit_covers[$i]}, mb_id='{$member['mb_id']}', img_source = '{$filename}', img_file = '{$img_file}', img_filesize = '{$filesize}', img_datetime = '" . G5_TIME_YMDHIS . "' ");
    }

    // 카달로그 등록
    for($i=0; $i<count($_FILES['files']['name']); $i++) {
        if(!empty($_FILES['files']['name'])) {
            // 카달로그 파일 업로드
            $tmp_file = $_FILES['files']['tmp_name'][$i];
            $filesize = $_FILES['files']['size'][$i];
            $filename = $_FILES['files']['name'][$i];
            $filename = get_safe_filename($filename);
            $img_file = fileUpload_up(G5_DATA_PATH . "/file/company/", $filename, $tmp_file); // 경로, 파일명, 임시파일명

            // 카달로그 DB INSERT
            sql_query(" insert into g5_member_img set category = '카달로그', mb_id='{$member['mb_id']}', img_source = '{$filename}', img_file = '{$img_file}', img_filesize = '{$filesize}', img_datetime = '" . G5_TIME_YMDHIS . "' ");
            $p_idx = sql_insert_id();
        }

        for($j=0; $j<count($use_cover); $j++) {
            if($use_cover[$j] == $i) { // 카달로그 커버를 사용하는 것만 저장
                // 카달로그 커버 파일 업로드
                $tmp_file = $_FILES['covers']['tmp_name'][$j];
                $filesize = $_FILES['covers']['size'][$j];
                $filename = $_FILES['covers']['name'][$j];
                $filename = get_safe_filename($filename);
                $img_file = fileUpload_up(G5_DATA_PATH . "/file/company/", $filename, $tmp_file); // 경로, 파일명, 임시파일명

                // 카달로그 커버 DB INSERT
                sql_query(" insert into g5_member_img set category = '카달로그커버', p_idx = {$p_idx}, mb_id='{$member['mb_id']}', img_source = '{$filename}', img_file = '{$img_file}', img_filesize = '{$filesize}', img_datetime = '" . G5_TIME_YMDHIS . "' ");

                break;
            }
        }
    }

    $patent = "";
    for($i=0; $i<count($mb_patent); $i++) {
        if(!empty($mb_patent[$i])) {
            $patent .= "{$mb_patent[$i]}|";
        }
    }
    $patent = substr($patent, 0, -1);
    $sql_add = ", mb_patent = '{$patent}' "; // 보유 인증, 특허

    $sql = " update g5_member set mb_video_link = '{$mb_video_link}', profile_updatetime = '".G5_TIME_YMDHIS."' {$sql_add} where mb_id = '{$member['mb_id']}' ";
    $result = sql_query($sql);

    die($member['mb_no']);
}
else if($mode == 'profile04') { //취급제품 및 브랜드
    // 취급제품 및 서비스
    $goods_service = "";
    for($i=0; $i<count($mb_goods); $i++) {
        if(!empty($mb_goods[$i])) {
            $goods_service .= "{$mb_goods[$i]}|";
        }
    }
    $goods_service = substr($goods_service, 0, -1);
    $sql_add1 = ", mb_goods_service = '{$goods_service}' ";

    // 브랜드
    $brand = "";
    for($i=0; $i<count($mb_brand); $i++) {
        if(!empty($mb_brand[$i])) {
            $brand .= "{$mb_brand[$i]}|";
        }
    }
    $brand = substr($brand, 0, -1);
    $sql_add2 = ", mb_brand = '{$brand}' ";

    $sql = " update g5_member set profile_updatetime = '".G5_TIME_YMDHIS."' {$sql_add1} {$sql_add2} where mb_id = '{$member['mb_id']}' ";
    $result = sql_query($sql);

    die($member['mb_no']);
}
else if($mode == 'profile05') { //해시태그
    $sql = " update g5_member set mb_hashtag = '{$hashtag}' where mb_id = '{$member['mb_id']}' ";
    $result = sql_query($sql);

    die($member['mb_no']);
}
?>