<?php
include_once('./_common.php');
include_once(G5_LIB_PATH . '/mailer.lib.php');
include_once(G5_LIB_PATH . "/thumbnail.lib.php");

$mode = $_REQUEST['mode'];

if ($mode == 'certi_mail_send') {

    $reg_mb_email = trim($_POST['reg_mb_email']);

    // * 예외 처리
    // 1. 인증 완료 후 가입 완료한 메일일 경우
    $sql = " select count(*) as count from {$g5['member_table']} where mb_email = '{$reg_mb_email}' ";
    $row = sql_fetch($sql);
    $count = $row['count'];

    if ($count > 0) {
        die('no');
    }

    // 2. 인증 완료 후 가입 완료 하지 않고 다시 인증 메일 발송 했을 경우 -- 재인증 필요
    $sql = " select ch_no, ch_check from new_certify_history where ch_id = '{$reg_mb_email}' ";
    $row = sql_fetch($sql);

    if ($row['ch_check'] == 'Y') {
        $sql = " update new_certify_history set ch_check = 'N' where ch_no = {$row['ch_no']} ";
        sql_query($sql);
    }

    // * 인증 처리
    // 인증에 사용할 키 설정 (이메일 암호화)
    $certify_key = base64_encode($_POST['reg_mb_email']);

    // 인증 요청 횟수 조회 (메일 재발송 때문)
    $sql = " select ch_count from new_certify_history where ch_id = '{$reg_mb_email}' ";
    $row = sql_fetch($sql);
    $request_count = $row['ch_count'];
    $certify_count = base64_encode($request_count + 1);

    // 인증 링크 생성
    $certify_href = G5_BBS_URL . '/certi_mail_check.php?certify_key=' . $certify_key . '&certify_count=' . $certify_count . '&amp;';

    // 메일 제목
    $subject = "[회원가입] " . $config['cf_title'] . " 이메일 인증";

    // 메일 내용
    $content = "";
    $content .= "<div style='width:600px;border:10px solid #f7f7f7;text-align: center;'>";
    $content .= "<span style='font-size: 15px; font-weight: bold'>JOBGO</span><h1 style='color:#555;font-size:1.4em'> 이메일 인증 안내</h1>";
    $content .= "<p style='font-size:20px;margin-bottom:0;padding-top: 20px;padding-bottom: 20px;font-family:Nanum Gothic;background:#f7f7f7;'>아래 이메일 인증하기 버튼을 클릭하세요.</p>";
    $content .= "<a href='" . $certify_href . "' target='_blank' style='display:inline-block;background-color:#4a8cdb;padding:16px 52px;font-size:20px;color:#fff;text-decoration:none;margin-top: 20px;margin-bottom: 20px;'>이메일 인증하기</a>";
    $content .= "</div>";

    // 메일 발송 (업체 메일 : tabassum@gg56.world)
    itforoneMailer('dreamforone@naver.com', 'jobgo', $reg_mb_email, $reg_mb_email, $subject, $content);

    // 인증 이력이 없을 경우 insert / 인증 이력이 있을 경우 인증 일자 update
    // * ch_count : 중복 메일 확인용 (미사용 시 삭제)
    if ($request_count == 0) {
        $sql_common = " ch_method = 'mail', ch_id = '{$reg_mb_email}', ch_count = 1 ";
        sql_query(" insert into new_certify_history set $sql_common ");
    } else {
        $request_count = $request_count + 1;
        $sql_common = " ch_method = 'mail',ch_count = {$request_count}, ch_date = now() where ch_id = '{$reg_mb_email}' ";
        sql_query(" update new_certify_history set $sql_common ");
    }

    // 메일 발송 결과 코드
    die($data['code']);

}
elseif ($mode == 'certi_confirm_check') {

    $reg_mb_email = $_POST['reg_mb_email'];

    // 이메일 인증 여부 확인
    $sql = " select count(*) as count from new_certify_history where ch_check='Y' and ch_id = '{$reg_mb_email}' ";
    $row = sql_fetch($sql);
    $count = $row['count'];

    // 인증 완료
    if ($count > 0) {
        die('certify');
    } else {
        die('no_certify');
    }
}
elseif ($mode == 'pro_step') {
    $ta_idx = $_REQUEST['ta_idx'];
    $bo_table = "talent";
    $bo_table2 = "sub_talent";


    if ($ta_idx == "") {

        $sql = "insert into {$g5['talent_table']} set ";

        foreach ($_REQUEST as $key => $value) {
            if (strpos($key, 'ta_') === 0) {
                $sql .= $key . "='" . $value . "',";
            }
        }
        $sql .= "mb_id = '" . $member['mb_id'] . "',";
        $sql .= "wr_datetime = '" . G5_TIME_YMDHIS . "'";

        $result = sql_query($sql);
        $idx = sql_insert_id();


    } else {
        $sql = "update {$g5['talent_table']}  set ";

        foreach ($_REQUEST as $key => $value) {
            if (strpos($key, 'ta_') === 0) {
                if ($key != 'ta_idx' && $key != "ta_imsi") {
                    $sql .= $key . "='" . $value . "',";
                }
            }
        }
        $sql .= "up_datetime = '" . G5_TIME_YMDHIS . "'";
        $sql .= " where ta_idx = '" . $ta_idx . "'";

        $result = sql_query($sql);



        $idx = $ta_idx;


    }

    //pro_step1일경우만 넣어줌
    if ($_REQUEST['tab'] == '1'){
        $option_cnt = $option_cnt;

        //category_service_table에 데이터 없을 경우 넣어줌.
        if ($_REQUEST['ta_ctg_idx'] == ''||$_REQUEST['ta_ctg_idx'] == '0' ){
            //전부 빈값일 경우 안넣기위해서 삽입
            $empty_yn = 'N';
            //1단계에서 카테고리 별 옵션 넣기
            $option_sql = "insert into {$g5['category_service_table']} set ";
            for ($a = 1; $a <= $option_cnt; $a++) {
                $arr = '';
                for ($b = 0; $b < count($_REQUEST['option'.$a]);$b++){
                    $arr .=  $_REQUEST['option'.$a][$b].',';
                }
                $arr = substr($arr, 0, -1);
                if ($arr != "" ) {
                    $empty_yn = 'Y';
                }
                $option_sql .= 'ctg_option' . $a . "='" . $arr . "',";
            }
            $option_sql .= "ta_idx = '" . $idx . "',";
            $option_sql .= "wr_datetime = '" . G5_TIME_YMDHIS . "'";
            if ($empty_yn == "Y" ) {
                $option_result = sql_query($option_sql);
                $option_idx = sql_insert_id();

                $sql = "update {$g5['talent_table']}  set ta_ctg_idx = {$option_idx} where  ta_idx = {$idx}";
                sql_query($sql);
            }

        }else{
            //common.php 에 있는 option_cnt 호출. 빈값이 들어오면 저장이 안되서 option_cnt만큼 돌려줌
            $option_sql = "update {$g5['category_service_table']} set ";
            for ($a = 1; $a <= $option_cnt; $a++) {
                $arr = '';
                for ($b = 0; $b < count($_REQUEST['option'.$a]);$b++){
                    $arr .=  $_REQUEST['option'.$a][$b].',';
                }
                $arr = substr($arr, 0, -1);

                $option_sql .= 'ctg_option' . $a . "='" . $arr . "',";
            }
            $option_sql .= " up_datetime = '" . G5_TIME_YMDHIS . "'";
            $option_sql .= " where ta_idx = '" . $ta_idx . "'";

            sql_query($option_sql);
        }
    }


    @mkdir(G5_DATA_PATH . '/file/' . $bo_table, G5_DIR_PERMISSION);
    @chmod(G5_DATA_PATH . '/file/' . $bo_table, G5_DIR_PERMISSION);

    @mkdir(G5_DATA_PATH . '/file/' . $bo_table2, G5_DIR_PERMISSION);
    @chmod(G5_DATA_PATH . '/file/' . $bo_table2, G5_DIR_PERMISSION);

    $main_del_idx = explode(',',$_REQUEST['update_main_idx']);
    $sub_del_idx = explode(',',$_REQUEST['update_sub_idx']);;

    //idx 값이 있는데 하나만 삭제했을 경우 배열생성안되서 처리해줌.
    if ($main_del_idx != 0 && count($main_del_idx) == 0){
        $main_del_idx[0] = $_REQUEST['update_main_idx'];
    }

    if ($sub_del_idx != 0 && count($sub_del_idx) == 0){
        $sub_del_idx[0] = $_REQUEST['update_sub_idx'];
    }


    //기존 데이터 삭제
    for ($i = 0; $i < count($main_del_idx); $i++){
        $sql = " select bf_file,bo_table from {$g5['board_file_table']} where bo_table = 'talent' and bf_idx = '{$main_del_idx[$i]}' ";
        $img_row = sql_fetch($sql);
        @unlink(G5_DATA_PATH . '/file/' . $img_row['bo_table'] . '/' . $img_row['bf_file']);
        $sql = "delete from {$g5['board_file_table']} where bo_table = 'talent' and bf_idx = '{$main_del_idx[$i]}' ";
        sql_query($sql);
    }

    for ($i = 0; $i < count($sub_del_idx); $i++){
        $sql = " select bf_file,bo_table from {$g5['board_file_table']} where bo_table = 'sub_talent' and bf_idx = '{$sub_del_idx[$i]}' ";
        $img_row = sql_fetch($sql);
        @unlink(G5_DATA_PATH . '/file/' . $img_row['bo_table'] . '/' . $img_row['bf_file']);
        $sql = "delete from {$g5['board_file_table']} where bo_table = 'sub_talent' and bf_idx = '{$sub_del_idx[$i]}' ";
        sql_query($sql);
    }


    for ($a = 0; $a < 2; $a++) {
        if ($a == 0) {


            $_FILES['bf_file'] = $_FILES['bf_file'];
            $bo_table = $bo_table;
        } else {
            $_FILES['bf_file'] = $_FILES['subbf_file'];
            $bo_table = $bo_table2;
        }

        for ($i = 0; $i < count($_FILES['bf_file']['name']); $i++) {
            $upload[$i]['file'] = '';
            $upload[$i]['source'] = '';
            $upload[$i]['filesize'] = 0;
            $upload[$i]['image'] = array();
            $upload[$i]['image'][0] = '';
            $upload[$i]['image'][1] = '';
            $upload[$i]['image'][2] = '';

            $tmp_file = $_FILES['bf_file']['tmp_name'][$i];
            $filesize = $_FILES['bf_file']['size'][$i];
            $filename = $_FILES['bf_file']['name'][$i];
            $filename = get_safe_filename($filename);


            // 서버에 설정된 값보다 큰파일을 업로드 한다면
            //        if ($filename) {
            //            if ($_FILES['bf_file']['error'][$i] == 1) {
            //                $file_upload_msg .= '\"' . $filename . '\" 파일의 용량이 서버에 설정된 값보다 크므로 업로드 할 수 없습니다.\\n';
            //
            //                continue;
            //            } else if ($_FILES['bf_file']['error'][$i] != 0) {
            //                $file_upload_msg .= '\"' . $filename . '\" 파일이 정상적으로 업로드 되지 않았습니다.\\n';
            //
            //                continue;
            //            }
            //        }

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
                $dest_file = G5_DATA_PATH . '/file/' . $bo_table . '/' . $upload[$i]['file'];

                //            $filename = compress_image($tmp_file, $dest_file, 70); //실제 파일용량 줄이는 부분
                //            list($width, $height, $type, $attr) = getImagesize($tmp_file);

                //이미지 크기조정
                move_uploaded_file($tmp_file, $dest_file) or die($_FILES['mb_img']['error'][$i]);
                //size_image($_FILES['bf_file'], 700, 466, $dest_file, 'multi', $i);

                // 업로드가 안된다면 에러메세지 출력하고 죽어버립니다.
                //        $error_code = move_uploaded_file($tmp_file, $dest_file) or die($_FILES['bf_file']['error'][$i]);

                // 올라간 파일의 퍼미션을 변경합니다.
                chmod($dest_file, G5_FILE_PERMISSION);
            }
        }

        for ($i = 0; $i < count($_FILES['bf_file']['name']); $i++) {

            $sql = " insert into {$g5['board_file_table']}
                        set bo_table = '{$bo_table}',
                             wr_id = '{$idx}',
                             bf_no = '{$i}',
                             bf_source = '{$upload[$i]['source']}',
                             bf_file = '{$upload[$i]['file']}',
                             bf_content = '{$bf_content[$i]}',
                             bf_download = 0,
                             bf_filesize = '{$upload[$i]['filesize']}',
                             bf_width = '{$upload[$i]['image']['0']}',
                             bf_height = '{$upload[$i]['image']['1']}',
                             bf_type = '{$upload[$i]['image']['2']}',
                             bf_datetime = '" . G5_TIME_YMDHIS . "' ";
            sql_query($sql);

        }
    }

    //임시 데이터 삭제(탭 3번째에서 최종등록 눌렀을 경우)
    if ($_REQUEST['tab'] == '3' && $_REQUEST['move_mode'] == "final_save") {
        $sql = "update {$g5['talent_table']} set ta_imsi = 'N' where ta_idx = '{$idx}' ";
        sql_query($sql);
        $sql = "select ta_idx from {$g5['talent_table']} where ta_imsi != 'N' and mb_id = '{$member['mb_id']}' ";
        $talent_sql = sql_query($sql);
        for ($i = 0; $imsi = sql_fetch_array($talent_sql); $i++) {
            $sql = "delete from {$g5['talent_table']} where ta_idx = '{$imsi['ta_idx']}' ";
            sql_query($sql);

            $sql = " select bf_idx,bf_file,bo_table from {$g5['board_file_table']} where (bo_table = 'talent' or bo_table = 'sub_talent') and wr_id = '{$imsi['ta_idx']}' ";
            $img_sql = sql_query($sql);
            for ($a = 0; $img_row = sql_fetch_array($img_sql); $a++) {
                @unlink(G5_DATA_PATH . '/file/' . $img_row['bo_table'] . '/' . $img_row['bf_file']);
                $sql = "delete from {$g5['board_file_table']} where bf_idx = '" . $img_row['bf_idx'] . "' ";
                sql_query($sql);
            }

            $sql = "delete from {$g5['category_service_table']} where ta_idx = '{$imsi['ta_idx']}' ";
            sql_query($sql);

            $sql = "delete from {$g5['pay_talent_table']} where ta_idx = '{$imsi['ta_idx']}' ";
            sql_query($sql);

            $sql = "delete from new_talent_qna where ta_idx = '{$imsi['ta_idx']}' ";
            sql_query($sql);

        }
    }


    if ($result == 1) {
        if ($_REQUEST['move_mode'] == 'next') {
            if (!empty($_REQUEST['page'])) { // 01-기본정보 or 02-가격정보 or 03-서비스상세 선택

                goto_url(G5_BBS_URL . '/' . $_REQUEST['page'] . '?ta_idx=' . $idx);
            } else { // 다음단계 선택
                goto_url(G5_BBS_URL . '/pro_step02.php?ta_idx=' . $idx);
            }
        }else{
            echo $result;
        }
    }

}
else if($mode == 'pro_step2') {
    // insert 3번..? standard, deluxe, premium 각각 insert..
    $idx = $_REQUEST['ta_idx'];

    $sql = " select count(*) as count from {$g5['pay_talent_table']} where ta_idx = {$idx} ";
    $count = sql_fetch($sql)['count'];

    if($count > 0) { // 이미 저장된 가격정보가 있을 경우 update
        $sql_common = " ta_idx = '" . $idx . "', pta_package = '{$_REQUEST['pta_package']}', up_datetime = '" . G5_TIME_YMDHIS . "' ";

        // standard
        $sql = " update {$g5['pay_talent_table']} set ";
        foreach ($_REQUEST as $key => $value) {
            if (strpos($key, 'standard_') === 0) {
                $key = explode('_', $key)[1] . '_' . explode('_', $key)[2]; // standard string 분리

                if (strpos($key, 'pta_') === 0) {
                    if($key == 'pta_pay') {
                        $value = str_replace(',','',$value);
                    }
                    $sql .= $key . "='" . $value . "',";
                }
            }
        }
        $sql .= " {$sql_common} where ta_idx = {$idx} and pta_info = 1; ";
        $result = sql_query($sql);

        if($_REQUEST['pta_package'] == 'Y') { // 패키지로 가격설정 시 deluxe, premium insert
            for($i=2; $i<=3; $i++) {
                $sql = " select count(*) as count from {$g5['pay_talent_table']} where ta_idx = {$idx} and pta_info = {$i} ";
                $count = sql_fetch($sql)['count'];

                if($i==2) { $needle = 'deluxe_'; } else { $needle = 'premium_'; }
                if($count > 0) { // update
                    $sql = " update {$g5['pay_talent_table']} set ";
                }
                else { // insert
                    $sql = " insert into {$g5['pay_talent_table']} set ";
                    $sql .= " pta_info = '" . $i . "', ";
                }
                foreach ($_REQUEST as $key => $value) {
                    if (strpos($key, $needle) === 0) {
                        $key = explode('_', $key)[1] . '_' . explode('_', $key)[2]; // deluxe, premium string 분리

                        if (strpos($key, 'pta_') === 0) {
                            if($key == 'pta_pay') {
                                $value = str_replace(',','',$value);
                            }
                            $sql .= $key . "='" . $value . "',";
                        }
                    }
                }
                if($count > 0) { // update
                    $sql .= " {$sql_common} where ta_idx = {$idx} and pta_info = {$i}; ";
                }
                else { // insert
                    $sql .= " {$sql_common} ";
                }
                $result = sql_query($sql);
            }
        }
    }
    else { // 저장된 가격정보가 없을 경우 insert
        $sql_common = " ta_idx = '" . $idx . "', pta_package = '{$_REQUEST['pta_package']}', wr_datetime = '" . G5_TIME_YMDHIS . "'; ";

        // standard
        $sql = " insert into {$g5['pay_talent_table']} set ";
        $sql .= " pta_info = '1', ";
        foreach ($_REQUEST as $key => $value) {
            if (strpos($key, 'standard_') === 0) {
                $key = explode('_', $key)[1] . '_' . explode('_', $key)[2]; // standard string 분리

                if (strpos($key, 'pta_') === 0) {
                    if($key == 'pta_pay') {
                        $value = str_replace(',','',$value);
                    }
                    $sql .= $key . "='" . $value . "',";
                }
            }
        }
        $sql .= " {$sql_common} ";
        $result = sql_query($sql);
        $pta_idx = sql_insert_id();

        // new_talent 테이블 가격정보(ta_pta_idx) 업데이트 -- 스탠다드 데이터로
        $sql = " update {$g5['talent_table']} set ta_pta_idx = {$pta_idx} where ta_idx = {$idx}; ";
        sql_query($sql);

        if($_REQUEST['pta_package'] == 'Y') { // 패키지로 가격설정 시 deluxe, premium insert
            for($i=2; $i<=3; $i++) {
                $sql = " insert into {$g5['pay_talent_table']} set ";
                $sql .= " pta_info = '" . $i . "', ";

                if($i==2) { $needle = 'deluxe_'; } else { $needle = 'premium_'; }
                foreach ($_REQUEST as $key => $value) {
                    if (strpos($key, $needle) === 0) {
                        $key = explode('_', $key)[1] . '_' . explode('_', $key)[2]; // deluxe, premium string 분리

                        if (strpos($key, 'pta_') === 0) {
                            if($key == 'pta_pay') {
                                $value = str_replace(',','',$value);
                            }
                            $sql .= $key . "='" . $value . "',";
                        }
                    }
                }
                $sql .= " {$sql_common} ";
                $result = sql_query($sql);
            }
        }
    }

    if($_REQUEST['move_mode'] == 'save') { // 임시저장
        goto_url(G5_URL . '/index.php');
    } else if($_REQUEST['move_mode'] == 'next') {
        if(!empty($_REQUEST['page'])) { // 01-기본정보 or 03-서비스상세 선택
            goto_url(G5_BBS_URL . '/' . $_REQUEST['page'] . '?ta_idx=' . $idx);
        } else { // 다음단계 선택
            goto_url(G5_BBS_URL . '/pro_step03.php?ta_idx=' . $idx);
        }
    }
}else if($mode == 'pro_ctg2_name'){

    $result = common_code($_REQUEST['pro_ctg2'],'code_idx','json');
    echo json_encode($result) ;
}else if ($mode == 'profile_form'){
    $arr = $_REQUEST;

    $sql = "select count(pf_idx) cnt from {$g5['profile_table']} where mb_id = '{$member["mb_id"]}' ";
    $result = sql_fetch($sql);

    if ($result['cnt'] == 0 ){
        $sql = "insert into {$g5['profile_table']} set ";
        $date = " wr_datetime = '".G5_TIME_YMDHIS."' ";
    }else{
        $sql = "update {$g5['profile_table']} set ";
        $date .= " up_datetime = '".G5_TIME_YMDHIS."' ";
        $sql_where = " where mb_id = '{$member["mb_id"]}' ";
    }

    foreach ($arr as $key => $value) {
        if (strpos( $key, 'pf_' ) === 0) {
            if ($key != 'pf_idx') {
                $sql .= $key . "='" . $value . "',";
            }
        }
    }

    $pf_call_time1 = $_REQUEST['call_hour_1'].":".$_REQUEST['call_min_1'].":00";
    $pf_call_time2 = $_REQUEST['call_hour_2'].":".$_REQUEST['call_min_2'].":00";

    $sql .= " pf_call_time1 = '".$pf_call_time1."', ";
    $sql .= " pf_call_time2 = '".$pf_call_time2."', ";
    $sql .= " pf_pro_ctg1 = '".$arr['pro_ctg1_arr']."', ";
    $sql .= " pf_pro_ctg2 = '".$arr['pro_ctg2_arr']."', ";
    $sql .= " pf_pro_ctg3 = '".$arr['pro_ctg3_arr']."', ";
    $sql .= " pf_hold_ctg1 = '".$arr['hold_ctg1_arr']."', ";
    $sql .= " pf_hold_ctg2 = '".$arr['hold_ctg2_arr']."', ";
    $sql .= " pf_certificate = '".$arr['certificate_arr']."', ";
    $sql .= " mb_id = '".$member['mb_id']."', ";
    $sql .= $date;
    $sql .= $sql_where;
//    print_r($sql);
//    exit;
    $return = sql_query($sql);

    //자격증 이미지 저장
    $bo_table = 'certificate';

    @mkdir(G5_DATA_PATH . '/file/' . $bo_table, G5_DIR_PERMISSION);
    @chmod(G5_DATA_PATH . '/file/' . $bo_table, G5_DIR_PERMISSION);

    $_FILES['bf_file'] = $_FILES['image'];

    //자격증 이미지삭제
    $del_idx = explode(',',$_REQUEST['update_idx']);;

    //idx 값이 있는데 하나만 삭제했을 경우 배열생성안되서 처리해줌.
    if ($del_idx != 0 && count($del_idx) == 0){
        $del_idx[0] = $_REQUEST['update_idx'];
    }
    //기존 데이터 삭제
    for ($i = 0; $i < count($del_idx); $i++){
        $sql = " select bf_file,bo_table from {$g5['board_file_table']} where bo_table = 'certificate' and bf_idx = '{$del_idx[$i]}' ";
        $img_row = sql_fetch($sql);
        @unlink(G5_DATA_PATH . '/file/certificate/' . $img_row['bf_file']);
        $sql = "delete from {$g5['board_file_table']} where bo_table = 'certificate' and bf_idx = '{$del_idx[$i]}' ";
        sql_query($sql);
    }

    for ($i = 0; $i < count($_FILES['bf_file']['name']); $i++) {

        //이름 빈값일 경우 저장안함.
        if($_FILES['bf_file']['name'] == ""){
            continue;
        }

        $upload[$i]['file'] = '';
        $upload[$i]['source'] = '';
        $upload[$i]['filesize'] = 0;
        $upload[$i]['image'] = array();
        $upload[$i]['image'][0] = '';
        $upload[$i]['image'][1] = '';
        $upload[$i]['image'][2] = '';

        $tmp_file = $_FILES['bf_file']['tmp_name'][$i];
        $filesize = $_FILES['bf_file']['size'][$i];
        $filename = $_FILES['bf_file']['name'][$i];
        $filename = get_safe_filename($filename);


        // 서버에 설정된 값보다 큰파일을 업로드 한다면
        //        if ($filename) {
        //            if ($_FILES['bf_file']['error'][$i] == 1) {
        //                $file_upload_msg .= '\"' . $filename . '\" 파일의 용량이 서버에 설정된 값보다 크므로 업로드 할 수 없습니다.\\n';
        //
        //                continue;
        //            } else if ($_FILES['bf_file']['error'][$i] != 0) {
        //                $file_upload_msg .= '\"' . $filename . '\" 파일이 정상적으로 업로드 되지 않았습니다.\\n';
        //
        //                continue;
        //            }
        //        }

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
            $dest_file = G5_DATA_PATH . '/file/' . $bo_table . '/' . $upload[$i]['file'];
            //            $filename = compress_image($tmp_file, $dest_file, 70); //실제 파일용량 줄이는 부분
            //            list($width, $height, $type, $attr) = getImagesize($tmp_file);

            //이미지 크기조정
            move_uploaded_file($tmp_file, $dest_file) or die($_FILES['bf_file']['error'][$i]);
            //size_image($_FILES['bf_file'], 700, 466, $dest_file, 'multi', $i);

            // 업로드가 안된다면 에러메세지 출력하고 죽어버립니다.
            //        $error_code = move_uploaded_file($tmp_file, $dest_file) or die($_FILES['bf_file']['error'][$i]);

            // 올라간 파일의 퍼미션을 변경합니다.
            chmod($dest_file, G5_FILE_PERMISSION);
        }
    }

    for ($i = 0; $i < count($_FILES['bf_file']['name']); $i++) {
        //이름 빈값일 경우 저장안함.
        if($_FILES['bf_file']['name'][$i] == ""){
            continue;
        }

        $sql = " insert into {$g5['board_file_table']}
                        set bo_table = '{$bo_table}',
                             wr_id = '{$member['mb_id']}',
                             bf_no = '{$i}',
                             bf_source = '{$upload[$i]['source']}',
                             bf_file = '{$upload[$i]['file']}',
                             bf_content = '{$bf_content[$i]}',
                             bf_download = 0,
                             bf_filesize = '{$upload[$i]['filesize']}',
                             bf_width = '{$upload[$i]['image']['0']}',
                             bf_height = '{$upload[$i]['image']['1']}',
                             bf_type = '{$upload[$i]['image']['2']}',
                             bf_datetime = '" . G5_TIME_YMDHIS . "' ";
        sql_query($sql);

    }



   if ($arr['pf_idx'] != "" || $_REQUEST['re'] == 'y'){
        $url = G5_URL.'/index.php';
        $msg = '프로필 수정이 완료되었습니다.';

    }else if ($arr['pf_idx'] == ""){
        $url = G5_HTTP_BBS_URL.'/register_result.php';
        $msg = 'success';
    }
    die(json_encode(array('msg'=> $msg, 'url'=> $url)));

}else if($mode == 'ctg2_option'){

    $result = common_code($_REQUEST['ctg_idx'],'code_p_idx','html');
    echo $result;

}else if($mode == 'pro_ctg2_common'){

    $result = common_code($_REQUEST['pro_ctg1'],'code_p_idx','html');
    echo $result;
}else if($mode == 'pro_ctg3_common'){
    $pro_ctg1 = $_REQUEST['pro_ctg1'];
    $ctg1 = common_code($pro_ctg1,'code_name','json','and code_p_idx = 0');
    $code_name = $_REQUEST['pro_ctg2'];
    $result = common_code($code_name,'code_name','json','and code_p_idx = '.$ctg1[0]['idx']);

    $sql = "select * from {$g5['code_table']} where code_p_idx =  {$result[0]['idx']} and code_use = '1'  order by code_number limit 1";
    $result = sql_fetch($sql);

    echo json_encode($result);
}else if($mode == 'ctg_service') {

    $ctg = $_REQUEST['ctg'];
    if ($ctg == 5) {
        $option_name = 'trans';
    } else if ($ctg == 6) {
        $option_name = 'education';
    }


    if ($ctg == 5 || $ctg == 6){
        $html = "";
        $html .= '<div class="bx">';
        $html .= '<h3 class="tit">' . $option_list[$option_name][0] . '</h3>';
        $html .= '<div class="chk cf">';
        for ($i = 1; $i < count($option_list[$option_name]); $i++) {
            $html .= '<div class="chk_co"><input type="checkbox" name="option2[]" value="' . $option_name . "_" . $i . '" id="' . $option_name . "_" . $i . '"><label for="' . $option_name . "_" . $i . '">' . $option_list[$option_name][$i] . '</label></div>';
        }
        $html .= '</div>';

    }
    echo $html;


}else if ($mode == 'qna_save'){

    $qna_q = $_REQUEST['qna_q'];
    $qna_a = $_REQUEST['qna_a'];
    $sql = "insert into {$g5['talent_qna_table']}
            set ta_idx = '{$ta_idx}',qna_q = '{$qna_q}',qna_a = '{$qna_a}', mb_id = '{$member['mb_id']}',wr_datetime = '".G5_TIME_YMDHIS."' ";

    $result = sql_query($sql);

    echo $result;

}else if ($mode == 'qna_list'){
    $ta_idx = $_REQUEST['ta_idx'];

    $sql = "select * from {$g5['talent_qna_table']} where ta_idx = '{$ta_idx}' ";

    $result = sql_query($sql);
    $html = "";
    for ($i = 0; $row = sql_fetch_array($result); $i++){
        $html .= '<div class="list">';
        $html .= '<div class="repairZone"><span><a href="javascript:qna_del('.$row['qna_idx'].');">삭제</a></span>';
        $html .= '</div>';
        $html .= '<h2 class="qw">'.$row["qna_q"].'</h2>';
        $html .= '<div class="aw">'.$row["qna_a"].'</div>';
        $html .= '</div>';

    }

    echo $html;

}else if ($mode == 'qna_del'){

    $qna_idx = $_REQUEST['qna_idx'];
    $sql = "delete from {$g5['talent_qna_table']} where qna_idx = '{$qna_idx}' ";
    $result = sql_query($sql);
    echo $result;
}else if ($mode == 'like_chk'){

    $ta_idx = $_REQUEST['ta_idx'];
    $type = $_REQUEST['type'];
    $li_table = $_REQUEST['li_table'];
    if(!$is_member){
        die(json_encode(array('msg'=>"회원만 사용할 수 있는 기능입니다.", 'url'=> G5_BBS_URL.'/login.php')));
    }

    //탈퇴한 사용자 일 경우 게시물 접근 X
    if ($li_table == 'talent'){
        $sql = "select * from new_talent where ta_idx = {$ta_idx} ";
    }else{
        $sql = "select * from new_competition where cp_idx = {$ta_idx} ";
    }
    $li_table_member = sql_fetch($sql)['mb_id'];
    $mb = get_member($li_table_member);
    if($mb['mb_8'] == 2){
        die(json_encode(array('msg'=>"탈퇴한 사용자가 올린 글이므로 해당 게시물을 찜할 수 없습니다.", 'url'=> '')));
    }

    $sql = "select * from {g5['like_table']} where ta_idx = {$ta_idx} and mb_id = '{$member['mb_id']}' ";
    $result = sql_fetch($sql);
    $text_li_table = "'".$li_table."'";

    if ($_REQUEST['main'] == 'main') {
        $text_idx = "'" . $ta_idx . "_" . substr($li_table, 0, 3) . "'";
        $main = "'".$_REQUEST['main']."'";
    }else{
        $text_idx = $ta_idx;
        $main = "";
    }

    if ($type == 'on'){

        if (empty($result)){
            $sql = "insert into {$g5['like_table']} set ta_idx = {$ta_idx}, mb_id = '{$member['mb_id']}',li_table = '{$li_table}', wr_datetime = '".G5_TIME_YMDHIS."' ";
            $html = '<button type="button" onclick="like_chk(\'off\','.$text_idx.','.$text_li_table.','.$main.')" class="heart on"><img src="'. G5_THEME_IMG_URL.'/main/heart_on.png" alt="좋아요on" title="좋아요on"></button>';
        }else{
            die(json_encode(array('msg'=>"좋아요를 다시 시도해주세요.", 'url'=> G5_URL.'/index.php')));

        }

    }elseif ($type == 'off'){
        $sql = "delete from {$g5['like_table']} where ta_idx = {$ta_idx} and li_table = '{$li_table}'and mb_id = '{$member['mb_id']}' ";
        $html = '<button type="button" onclick="like_chk(\'on\','.$text_idx.','.$text_li_table.','.$main.')" class="heart off"><img src="'. G5_THEME_IMG_URL.'/main/heart_off.png" alt="좋아요off" title="좋아요off"></button>';

    }

    $result = sql_query($sql);
    if ($result == 1){
        die(json_encode(array('msg'=>"success", 'html'=> $html)));
    }else{
        die(json_encode(array('msg'=>"실패했습니다. 다시 시도 해주세요.", 'url'=> G5_URL.'/index.php')));

    }

}else if ($mode == 'division_change'){
    $division =$_REQUEST['division'];
    if($division == 1){
        $msg = '일반인';
    }elseif($division == 2){
        $msg = '전문인';
    }else{
        alert('올바른 접근이 아닙니다.',G5_URL);
    }

    $sql = "update g5_member set mb_division = '{$division}' where mb_id = '{$member['mb_id']}' ";
    sql_query($sql);

    alert($msg."으로 변경되었습니다.",G5_BBS_URL.'/mypage.php');

}else if($mode == "code_ctg_change"){
    //대분류로 찾기
    $result = common_code($_REQUEST['value'],'code_ctg','html');

    print_r($result);
    exit;


}elseif ($mode == 'yn_list_change'){

    $sql = "update {$g5['code_table']} set code_use = '{$_REQUEST["code_use"]}' where code_idx = {$_REQUEST["idx"]} ";

    $result = sql_query($sql);

    echo $result;

}elseif ($mode == 'yn_list_banner_change'){

    if ($_REQUEST['act_button'] == '비노출로 변경'){
        $use = '2';
    }else{
        $use = '1';
    }

    for ($i=0; $i<count($_POST['chk']); $i++)
    {

        $sql = "update new_adm_banner set ba_use = '{$use}' where idx = {$_POST['chk'][$i]} ";
        sql_query($sql);

    }


   goto_url(G5_ADMIN_URL.'/banner_list.php'.$qstr);

//정보수정에서 현재비밀번호 확인
}else if($mode == 'now_pw_check'){
    $mb_id = $_REQUEST['reg_mb_id'];
    $mb = get_member($mb_id);

    $mb_password = $_REQUEST['reg_pw'];

    if (!$mb['mb_id'] || !check_password($mb_password, $mb['mb_password'])) {
        echo '현재 비밀번호와 일치하지 않아 수정이 불가능합니다.';
    }


}else if($mode == 'question_update'){

    $idx = $_REQUEST['tq_idx'];
    $sql_common = "";

    foreach ($_REQUEST as $key => $value) {
        if (strpos($key, 'tq_') === 0) {
            if ($key != 'tq_idx') {
                $sql_common .= $key . "='" . $value . "',";
            }
        }
    }

    if ($idx != "" ){
        $sql = "update new_talent_question set ".$sql_common." up_datetime = '".G5_TIME_YMDHIS."' where tq_idx = ".$idx;
        $result = sql_query($sql);
    }else{
        $sql = "insert into new_talent_question set ".$sql_common." tq_mb_id = '{$member['mb_id']}', wr_datetime = '".G5_TIME_YMDHIS. "'";
        $result = sql_query($sql);
        $idx = sql_insert_id();
    }

    echo $result;


}else if($mode == 'mb_icon_update'){
    $mb_id = $member['mb_id'];
    $mb_dir = substr($mb_id,0,2);
    $member_type = $_REQUEST['member_type'];

    // 회원 아이콘 삭제 후 넣기
        @unlink(G5_DATA_PATH.'/member/'.$mb_dir.'/'.$mb_id.'.jpg');

    // 아이콘 업로드

    if (is_uploaded_file($_FILES['mb_icon']['tmp_name'])) {
        $mb_dir = substr($mb_id, 0, 2);

// 디렉토리가 없다면 생성합니다. (퍼미션도 변경하구요.)
        @mkdir(G5_DATA_PATH.'/member/'.$mb_dir, G5_DIR_PERMISSION);
        @chmod(G5_DATA_PATH.'/member/'.$mb_dir, G5_DIR_PERMISSION);


        $arr_name = explode('.', $_FILES['mb_icon']['name']);
        $file_ext = array_pop($arr_name); //확장자 추출 (array_pop : 배열의 마지막 원소를 빼내어 반환)

        $file_type = $_FILES['mb_icon']['type'];
        $check_ext = array('jpg', 'jpeg', 'png','JPG', 'JPEG', 'PNG'); //확장자 체크를 위한 선언부


        if (!in_array($file_ext, $check_ext)) {
            echo "허용되지 않는 확장자입니다";
            exit;

        }
//    if ($file_width > $new_file_width) { //이미지 가로사이즈가 200보다 크면 사이즈 조절
        $dest_path = G5_DATA_PATH . '/member/' . $mb_dir . '/' . $mb_id. '.jpg';
        print_r($dest_path);

        size_image($_FILES['mb_icon'],$config['cf_member_icon_width'],$config['cf_member_icon_height'],$dest_path,'one');

//    }
        echo 'success';
    }

}else if($mode =='mileage_request_update'){

    $mileage_fee = $_POST['mileage_fee'];
    $mileage_fee = str_replace(',','',$mileage_fee);

    $mb = get_member($_SESSION['ss_mb_id']);

    if ($mb['mb_6'] < $mileage_fee){
        die('보유 금액 보다 많이 구매할 수 없습니다.');
    }

    $sql = " update g5_member set mb_6 = mb_6 - {$mileage_fee}, mb_7 = mb_7 + {$mileage_fee} where mb_id = '{$_SESSION['ss_mb_id']}' ";
    sql_query($sql);
    $mb = get_member($_SESSION['ss_mb_id']);

    $sql = " insert into new_mileage
             set mb_id = '{$_SESSION['ss_mb_id']}', category = '구매', mileage = {$mileage_fee}, remain_mileage = {$mb['mb_7']}, wr_datetime = '" . G5_TIME_YMDHIS . "' ";
    $result = sql_query($sql);

    //history
    payment_history($member['mb_id'],$exchange_content,$mileage_fee, $mb['mb_6'],'@pay_minus');
    payment_history($member['mb_id'],$mileage_buy_content,$mileage_fee,$mb['mb_7'],'@$mileage_plus','Y');

    if($result) {
        die('success');
    }

}