<?php
include_once('./_common.php');

/** 커리어 - 채용공고 - 지원하기 (이력서 저장) **/

@mkdir(G5_DATA_PATH . '/file/' . 'resume', G5_DIR_PERMISSION);
@chmod(G5_DATA_PATH . '/file/' . 'resume', G5_DIR_PERMISSION);

//print_r($_FILES);exit;
//print_r($_REQUEST);

if(!empty($recruit_idx)) {
    $company_name = sql_fetch(" select mb.mb_company_name from g5_career_recruit as cr left join g5_member as mb on mb.mb_id = cr.mb_id where cr.idx = '{$recruit_idx}' ")['mb_company_name'];
    $sql = " insert into g5_resume set recruit_idx = {$recruit_idx}, company_name = '{$company_name}', mb_id = '{$member['mb_id']}', re_subject = '{$re_subject}', re_name = '{$re_name}', re_hp = '{$re_hp}', re_email = '{$re_email}', wr_datetime = '" . G5_TIME_YMDHIS . "' ";
    $result = sql_query($sql);
    $resume_idx = sql_insert_id();

    // 이력서 파일 삭제
    $del_file = explode(',', $del_file_idx);
    for($i = 0; $i < count($del_file); $i++) {
        $sql = " select * from g5_resume_file where idx = {$del_file[$i]} ";
        $row = sql_fetch($sql);

        unlink(G5_DATA_PATH . '/file/resume/' . $row['img_file']);

        $sql = " delete from g5_resume_file where idx = {$del_file[$i]} ";
        sql_query($sql);
    }

    // 이력서 파일 업로드
    for($i=0; $i<count($_FILES['files']['name']); $i++) {
        if(!empty($_FILES['files']['name'])) {
            $tmp_file = $_FILES['files']['tmp_name'][$i];
            $filesize = $_FILES['files']['size'][$i];
            $filename = $_FILES['files']['name'][$i];
            $filename = get_safe_filename($filename);
            $img_file = fileUpload_up(G5_DATA_PATH . "/file/resume/", $filename, $tmp_file); // 경로, 파일명, 임시파일명

            // 견적 상세 자료 DB INSERT
            $result = sql_query(" insert into g5_resume_file set resume_idx = '{$resume_idx}', img_source = '{$filename}', img_file = '{$img_file}', img_filesize = '{$filesize}', img_datetime = '" . G5_TIME_YMDHIS . "' ");
        }
    }

    if($result) {
        // 이력서 지원 시 지원 기업에 푸시
        $info = sql_fetch("select * from  g5_career_recruit where idx = '{$recruit_idx}'"); // 이력서 정보
        $push_status = "resume";
        $push_data = array('subject'=>$info['cr_subject'], 'url'=>G5_BBS_URL."/mypage_career_corp_resume.php?idx=".$recruit_idx, 'ref_idx'=>$recruit_idx, 'ref_table'=>'g5_career_recruit', 'mb_id'=>$info['mb_id']);
        @include_once(G5_BBS_PATH.'/send_push.php');

        die('success');
    }
}
?>