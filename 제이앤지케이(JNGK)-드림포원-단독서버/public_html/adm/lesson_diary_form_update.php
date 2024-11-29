<?php
//$sub_menu = "220100";
include_once("./_common.php");

@mkdir(G5_DATA_PATH . '/file/' . 'lesson', G5_DIR_PERMISSION);
@chmod(G5_DATA_PATH . '/file/' . 'lesson', G5_DIR_PERMISSION);

$w = $_POST['w'];
$idx = $_POST['idx'];
$path = $_POST['path'];

$sql = " select mb.*, le.* from g5_member as mb left join g5_lesson as le on le.idx = mb.lesson_idx where mb.mb_no = {$_POST['mb_no']} ";
$mb = sql_fetch($sql);

$sql = " select count(*) as count from g5_lesson_diary as ld left join g5_member as mb on ld.mb_no = mb.mb_no where mb.mb_no = {$_POST['mb_no']} and ld.history_idx = {$mb['history_idx']} ";
$count = sql_fetch($sql)['count'];

$sql_common = " lesson_contents = '{$_POST['lesson_contents']}',
                lesson_memo = '{$_POST['lesson_memo']}',
                ";

if($w == '') {
    if($count == 0) {
        if($mb['mb_state'] == 'one_point_lesson') { // 원포인트회원은 1회성 레슨
            $lesson_remain_count = 0;
        } else {
            $lesson_remain_count = explode('/',$mb['lesson_count'])[0] - 1; // 일지 등록 시 전체 회차 - 1
        }
    } else {
        $sql = " select min(lesson_remain_count*1) as lesson_remain_count from g5_lesson_diary where mb_no = {$_POST['mb_no']} and history_idx = {$mb['history_idx']} "; // 남은 회차 조회
        $lesson_remain_count = sql_fetch($sql)['lesson_remain_count'];

        if($lesson_remain_count == 0) { // 남은 회차 없을 경우 0
            $lesson_remain_count = 0;
        } else {
            $lesson_remain_count = $lesson_remain_count - 1;  // 일지 등록 시 남은 회차 - 1
        }
    }

    $reser = sql_fetch(" select * from g5_lesson_reser where idx = '{$_POST['reser_idx']}'; "); // 레슨 예약 정보

    $sql_common .= " lesson_date = '{$_POST['lesson_date']}',
                     lesson_time = '{$_POST['lesson_time']}',
                     lesson_code = '{$_POST['lesson_code']}',
                     lesson_count = '{$_POST['lesson_count']}',
                     pro_mb_no = '{$reser['pro_mb_no']}',
                     history_idx = '{$_POST['history_idx']}',
                     reser_idx = '{$_POST['reser_idx']}',
                     mb_no = '{$_POST['mb_no']}',
                     lesson_remain_count = '{$lesson_remain_count}',
                     reg_date = now() ";

    $sql = " insert into g5_lesson_diary set {$sql_common} ";
    sql_query($sql);
    $idx = sql_insert_id();

    // 레슨 예약 정보 테이블(g5_lesson_reser)에 레슨 일지 idx INSERT
    sql_query(" update g5_lesson_reser set diary_idx = '{$idx}' where idx = '{$_POST['reser_idx']}' ");

    // 21.10.20 임시 -- 레슨 예약 정보 테이블에 history_idx 넣기 위함
    $reser_history_idx = sql_fetch(" select history_idx from g5_lesson_reser where idx = '{$_POST['reser_idx']}' ")['history_idx'];
    if(empty($reser_history_idx)) { // g5_lesson_reser 테이블에 history_idx가 없을 경우
        sql_query(" update g5_lesson_reser set history_idx = '{$_POST['history_idx']}' where idx = '{$_POST['reser_idx']}' ");
        // * g5_lesson_reser의 history_idx와 g5_lesson_diary의 history_idx가 다를 수 있음, 예약을 이미 했으나 도중에 회원 재등록 시 history_idx가 변경되기 때문에 달라짐 (상품 이력 관리 때문에 history_idx 구분)
        // 레슨일지 등록 시 예약 테이블에 변경된 history_idx로 업데이트 해주어도 되지만 데이터 확인용으로 업데이트 하지 않음
        // 회원의 레슨 정보 또는 예약 정보가 필요하여 두 테이블의 history_idx를 비교해야 할 경우가 생긴다면 g5_lesson_diary의 history_idx로 확인하는게 정확할 듯 함 (재등록 하기 전 레슨의 레슨일지는 재등록 전에 작성 완료 했어야 함)
        // 현재는 재등록 시 재등록 시점 이후의 예약대기 상태인 예약의 history_idx를 현재 history_idx로 업데이트 해줌
        // g5_lesson_reser에 있는 history_idx는 예약할 당시 진행 중인 레슨, g5_lesson_diary에 있는 history_idx는 현재 진행 중인 레슨 정보
    }

    if($mb['mb_state'] == 'one_point_lesson') { // 원포인트회원은 레슨완료일이 곧 레슨종료일
        //$sql = " update g5_member set lesson_start_date = date_format(now(), '%Y-%m-%d'), lesson_end_date = date_format(now(), '%Y-%m-%d'), no_register_date = now(), mb_state = 'no_register' where mb_no = {$_POST['mb_no']} ";
        $sql = " update g5_member set mb_state = 'no_register' where mb_no = {$_POST['mb_no']} ";
        sql_query($sql);

        /*$sql = " update g5_member_history set lesson_start_date = date_format(now(), '%Y-%m-%d'), lesson_end_date = date_format(now(), '%Y-%m-%d') where idx = '{$_POST['history_idx']}' ";
        sql_query($sql);*/
    }
}
if($w == 'u') {
    $sql_common .= " mod_date = now() ";

    $sql = " update g5_lesson_diary set {$sql_common} where idx = {$idx} ";
    sql_query($sql);
}

// 파일 삭제
if(!empty($_POST['del_video'])) {
    $sql = " select * from g5_lesson_video where diary_idx = {$_POST['del_video']} ";
    $row = sql_fetch($sql);

    unlink(G5_DATA_PATH . '/file/lesson/' . $row['img_file']);

    $sql = " delete from g5_lesson_video where diary_idx = {$_POST['del_video']} ";
    sql_query($sql);
}

// 파일 등록
for ($i = 0; $i < count($_FILES['file']['name']); $i++) {
    $upload[$i]['file'] = '';
    $upload[$i]['source'] = '';
    $upload[$i]['filesize'] = 0;
    $upload[$i]['image'] = array();
    $upload[$i]['image'][0] = '';
    $upload[$i]['image'][1] = '';
    $upload[$i]['image'][2] = '';

    $tmp_file = $_FILES['file']['tmp_name'];
    $filesize = $_FILES['file']['size'];
    $filename = $_FILES['file']['name'];
    $filename = get_safe_filename($filename);

    if (is_uploaded_file($tmp_file)) {
        //=================================================================\
        // 090714
        // 이미지나 플래시 파일에 악성코드를 심어 업로드 하는 경우를 방지
        // 에러메세지는 출력하지 않는다.
        //-----------------------------------------------------------------
        $timg = @getimagesize($tmp_file);
        // image type
        if (preg_match("/\.({$config['cf_image_extension']})$/i", $filename) ||
            preg_match("/\.({$config['cf_flash_extension']})$/i", $filename)) {
            if ($timg['2'] < 1 || $timg['2'] > 16)
                continue;
        }
        //=================================================================

        $upload[$i]['image'] = $timg;

        // 프로그램 원래 파일명
        $upload[$i]['source'] = $filename;
        $upload[$i]['filesize'] = $filesize;

        // 아래의 문자열이 들어간 파일은 -x 를 붙여서 웹경로를 알더라도 실행을 하지 못하도록 함
        $filename = preg_replace("/\.(php|phtm|htm|cgi|pl|exe|jsp|asp|inc)/i", "$0-x", $filename);

        shuffle($chars_array);
        $shuffle = implode('', $chars_array);

        // 첨부파일 첨부시 첨부파일명에 공백이 포함되어 있으면 일부 PC에서 보이지 않거나 다운로드 되지 않는 현상이 있습니다. (길상여의 님 090925)
        $upload[$i]['file'] = abs(ip2long($_SERVER['REMOTE_ADDR'])) . '_' . substr($shuffle, 0, 8) . '_' . replace_filename($filename);
        $dest_file = G5_DATA_PATH . '/file/lesson/' . $upload[$i]['file'];

        //이미지 크기조정
        //size_image($_FILES['file'], 200, 200, $dest_file, 'multi', $i);

        // 업로드가 안된다면 에러메세지 출력하고 죽어버립니다.
        $error_code = move_uploaded_file($tmp_file, $dest_file) or die($_FILES['mb_img']['error'][$i]);

        // 올라간 파일의 퍼미션을 변경합니다.
        chmod($dest_file, G5_FILE_PERMISSION);

        $sql = " insert into g5_lesson_video set diary_idx = '{$idx}', mb_no = '{$mb_no}', img_source = '{$upload[$i]['source']}', img_file = '{$upload[$i]['file']}', 
                                               img_filesize = '{$upload[$i]['filesize']}', img_width = '{$upload[$i]['image']['0']}', img_height = '{$upload[$i]['image']['1']}', 
                                               img_type = '{$upload[$i]['image']['2']}', img_datetime = '" . G5_TIME_YMDHIS . "' ";
        sql_query($sql);
    }
}

/*if(empty($path)) { // 회원정보에서 레슨일지등록
echo "
 <script>
    opener.document.location.replace('./member_list.php');
    window.close();
</script>
";
} else if($path == 'sch') { // 레슨스케줄에서 레슨일지등록
echo "
 <script>
    opener.document.location.replace('./pro_lesson.php');
    window.close();
</script>
";
} else if($path == 'reser') { // 레슨예약에서 레슨일지등록
echo "
 <script>
    //opener.document.location.replace('./lesson_reser.php');
    window.close();
</script>
";
}*/

?>


