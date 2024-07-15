<?php
include_once('./_common.php');

if($mode == 'profile01') { //회원소개
    @mkdir(G5_DATA_PATH . '/file/' . 'member', G5_DIR_PERMISSION);
    @chmod(G5_DATA_PATH . '/file/' . 'member', G5_DIR_PERMISSION);

    // 이미지 새로 등록 시
    if(!empty($_FILES['file']['name'])) {
        // 프로필 이미지 삭제
        if(count($del_file) > 0) {
            $row = sql_fetch(" select * from g5_member_img where idx = {$del_file}; ");

            unlink(G5_DATA_PATH . '/file/member/' . $row['img_file']);

            sql_query(" delete from g5_member_img where idx = {$del_file}; ");
        }

        // 프로필 이미지 파일 업로드
        $tmp_file = $_FILES['file']['tmp_name'];
        $filesize = $_FILES['file']['size'];
        $filename = $_FILES['file']['name'];
        $filename = get_safe_filename($filename);
        $img_file = fileUpload_up(G5_DATA_PATH . "/file/member/", $filename, $tmp_file); // 경로, 파일명, 임시파일명

        // 프로필 이미지 DB INSERT
        sql_query(" insert into g5_member_img set mb_id='{$member['mb_id']}', img_source = '{$filename}', img_file = '{$img_file}', img_filesize = '{$filesize}', img_datetime = '" . G5_TIME_YMDHIS . "' ");
        $img_idx = sql_insert_id();
    }

    // 회원 정보 DB UPDATE
    if(empty($img_idx)) { $img_idx = $member['mb_img_idx']; } // 이미지 idx

    $sql = " update g5_member set mb_name = '{$mb_name}', mb_hp = '{$mb_hp}', mb_certify = '{$mb_certify}', mb_active_business = '{$mb_active_business}', mb_nick = '{$mb_nick}', mb_introduce = '{$mb_introduce}', mb_si = '{$mb_si}', mb_img_idx = '{$img_idx}', profile_updatetime = '".G5_TIME_YMDHIS."' where mb_id = '{$member['mb_id']}' ";
    $result = sql_query($sql);

    die($result);
}
else if($mode == 'profile02') { //경력사항
    /*if(empty($mb_free)) { // 프리랜서 X
        $sql_common = " mb_company = '{$mb_company}', mb_department = '{$mb_department}', mb_position = '{$mb_position}', mb_work_year = '{$mb_work_year}', mb_work_month = '{$mb_work_month}' ";
    } else { // 프리랜서 O
        $sql_common = " mb_free = 'Y', mb_company = '', mb_department = '', mb_position = '', mb_work_year = '{$mb_work_year}', mb_work_month = '{$mb_work_month}' ";
    }*/
    $sql_common = " mb_career = '{$mb_career}' ";
    if($member['mb_active_business'] == 1) {
        if($profile2_open == 'X') { $sql_common .= ", profile2_open = null"; } else { $sql_common .= ", profile2_open = '{$profile2_open}'"; } // 프로필 공개설정 ('X'는 건너뛰기, DB에 NULL)
    } else {
        $sql_common .= ", profile2_open = '{$profile2_open}'";
    }

    // 회원 정보 DB UPDATE
    $sql = " update g5_member set {$sql_common}, profile_updatetime = '".G5_TIME_YMDHIS."' where mb_id = '{$member['mb_id']}' ";
    $result = sql_query($sql);

    die($result);
}
else if($mode == 'profile03') { //학력, 전공
    //$sql_common = " mb_school = '{$mb_school}', mb_school_major = '{$mb_school_major}', mb_school_state = '{$mb_school_state}' ";
    $sql_common = " mb_education = '{$mb_education}' ";
    if($profile3_open == 'X') { $sql_common .= ", profile3_open = null"; } else { $sql_common .= ", profile3_open = '{$profile3_open}'"; } // 프로필 공개설정 ('X'는 건너뛰기, DB에 NULL)

    // 회원 정보 DB UPDATE
    $sql = " update g5_member set {$sql_common}, profile_updatetime = '".G5_TIME_YMDHIS."' where mb_id = '{$member['mb_id']}' ";
    $result = sql_query($sql);

    die($result);
}
else if($mode == 'profile04') { //보유기술, 자격증
    /*$mb_certificate_date = $mb_certificate_date.'-00';
    $sql_common = " mb_certificate = '{$mb_certificate}', mb_certificate_office = '{$mb_certificate_office}', mb_certificate_date = '{$mb_certificate_date}' ";*/
    $sql_common = " mb_tech = '{$mb_tech}' ";
    if($profile4_open == 'X') { $sql_common .= ", profile4_open = null"; } else { $sql_common .= ", profile4_open = '{$profile4_open}'"; } // 프로필 공개설정 ('X'는 건너뛰기, DB에 NULL)

    // 회원 정보 DB UPDATE
    $sql = " update g5_member set {$sql_common}, profile_updatetime = '".G5_TIME_YMDHIS."' where mb_id = '{$member['mb_id']}' ";
    $result = sql_query($sql);

    die($result);
}
else if($mode == 'profile05') { //추가정보
    // 회원 정보 DB UPDATE
    $sql = " update g5_member set mb_birth = '{$mb_birth}', mb_sex = '{$mb_sex}', mb_keyword = '{$keyword}', mb_push = '{$mb_push}', profile_updatetime = '".G5_TIME_YMDHIS."', profile = '{$profile}' where mb_id = '{$member['mb_id']}' ";
    $result = sql_query($sql);

    // 프로필 작성 완료 시 보너스 벙커 적립 (처음 작성 완료 시 적립)
    $bonus_chk = sql_fetch(" select count(*) as count from g5_bunker_history where mb_id = '{$member['mb_id']}' and mode = '적립' and contents like '%프로필 업데이트 완료%' ")['count'];
    if($bonus_chk == 0) {
        //$sql = "update g5_member set mb_bunker_bonus = 500 where mb_id = '{$member['mb_id']}' ";
        //$result = sql_query($sql);

        // BUNKER HISTORY (프로필 업데이트 완료 BUNKER 적립)
        if($member['mb_category'] == '일반') {
            // 유효기간 설정 (90일)
            bunkerHistory($member['mb_id'], '적립', 200, '프로필 업데이트 완료', '', '', '', 'bonus');
        }
    }

    die($result);
}
?>