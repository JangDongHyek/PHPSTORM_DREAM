<?php
include_once('./_common.php');
include_once(G5_LIB_PATH . '/mailer.lib.php');
include_once(G5_LIB_PATH . "/thumbnail.lib.php");

$mode = $_REQUEST['mode'];

if ($mode == 'competition_form') {

    $cp_idx = $_REQUEST['cp_idx'];
    $bo_table = "competition_main";
    $bo_table2 = "competition_sub";

    if ($cp_idx == "") {

        $sql = "insert into new_competition set ";

        foreach ($_REQUEST as $key => $value) {
            if (strpos($key, 'cp_') === 0) {
                if ($key == "cp_reward"){
                    $value = str_replace ( ',' , '', $value);
                }
                $sql .= $key . "='" . $value . "',";
            }
        }
        $sql .= "cp_datetime = '" . $_REQUEST['year'] ."-".$_REQUEST['month'] ."-".$_REQUEST['day']. "',";
        $sql .= "mb_id = '" . $member['mb_id'] . "',";
        $sql .= "wr_datetime = '" . G5_TIME_YMDHIS . "'";

        $result = sql_query($sql);
        $idx = sql_insert_id();

        //공모전 등록 시 출금금액에서 공모전 상금 제외
        $cp_reward = str_replace ( ',' , '', $_REQUEST['cp_reward'])."0000";
        $sql = "update {$g5['member_table']} set mb_6 = mb_6-{$cp_reward} where mb_id = '{$member['mb_id']}' ";
        sql_query($sql);

        $ph_total = $member['mb_6']-$cp_reward;
        //히스토리 내역에 추가 $competition_content => common.php에 저장
        payment_history($member['mb_id'], $competition_content['content'], $cp_reward, $ph_total,'@pay_minus','',$competition_content['idx'],$idx,'new_competition');


    } else {
        $sql = "update new_competition set ";

        foreach ($_REQUEST as $key => $value) {
            if (strpos($key, 'cp_') === 0) {
                if ($key != 'cp_idx') {
                    $sql .= $key . "='" . $value . "',";
                }
            }
        }
        $sql .= "cp_datetime = '" . $_REQUEST['year'] ."-".$_REQUEST['month'] ."-".$_REQUEST['day']. "',";
        $sql .= "up_datetime = '" . G5_TIME_YMDHIS . "'";
        $sql .= " where cp_idx = '" . $cp_idx . "'";
        $result = sql_query($sql);

        $idx = $cp_idx;


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
        $sql = " select bf_file,bo_table from {$g5['board_file_table']} where bo_table = 'competition_main' and bf_idx = '{$main_del_idx[$i]}' ";
        $img_row = sql_fetch($sql);
        @unlink(G5_DATA_PATH . '/file/' . $img_row['bo_table'] . '/' . $img_row['bf_file']);
        $sql = "delete from {$g5['board_file_table']} where bo_table = 'competition_main' and bf_idx = '{$main_del_idx[$i]}' ";
        sql_query($sql);
    }

    for ($i = 0; $i < count($sub_del_idx); $i++){
        $sql = " select bf_file,bo_table from {$g5['board_file_table']} where bo_table = 'competition_sub' and bf_idx = '{$sub_del_idx[$i]}' ";
        $img_row = sql_fetch($sql);
        @unlink(G5_DATA_PATH . '/file/' . $img_row['bo_table'] . '/' . $img_row['bf_file']);
        $sql = "delete from {$g5['board_file_table']} where bo_table = 'competition_sub' and bf_idx = '{$sub_del_idx[$i]}' ";
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
    echo $result;
}elseif ($mode == "competition_comment_update"){
    $table_name = "new_comment";
    if ($_REQUEST['wr_num'] == "") {
        $_REQUEST['wr_num'] = get_next_num($table_name);
    }

    $sql = "insert into {$table_name} set ";

    foreach ($_REQUEST as $key => $value) {
        if (strpos($key, 'wr_') === 0) {
            $sql .= $key . "='" . $value . "',";
        }
    }
    $sql .= "mb_id = '" . $member['mb_id'] . "',";
    $sql .= "wr_datetime = '" . G5_TIME_YMDHIS . "'";


    $result = sql_query($sql);
    $idx = sql_insert_id();

    if ($result == 1){

        if ($_REQUEST['alim_mode'] != "") {
            $request_mb = get_member($_REQUEST['mb_id']);
            alimtalk($request_mb['mb_hp'], array("talent_title" => $_REQUEST['talent_title'], "comment_nick" => $request_mb['mb_nick']), $_REQUEST['alim_mode']);
        }

        die(json_encode(array('msg'=>"success", 'idx'=> $idx)));
    }else{
        die(json_encode(array('msg'=>"댓글 저장에 실패했습니다. 새로고침하여 다시시도해주세요.")));
    }

}elseif ($mode == 'competition_comment_list'){
    $idx = $_REQUEST['idx'];
    $table = $_REQUEST['wr_table'];

    $sql = "select * from new_comment where wr_parent = '{$idx}' and wr_table = '{$table}' ";
    $result = sql_query($sql);
    $html = "";

    for ($i = 0; $row = sql_fetch_array($result); $i++){

        $html .= '<div class="reply" style="white-space: pre-wrap">';
        $html .= $row['wr_content'];
        if ($member['mb_id'] == $row['mb_id']) {
            $html .= '<a href="javascript:competition_comment_del('.$row["comment_idx"].')"><span style="float: right">삭제</span></a>';
        }
        $html .= '</div>';
    }

    echo $html;

}elseif ($mode == "competition_comment_del"){
    $idx = $_REQUEST['idx'];
    $table = $_REQUEST['wr_table'];
    if (empty($idx)){
        alert('올바른 삭제방법이 아닙니다.');
    }

    $sql = "delete from new_comment where (comment_idx = '{$idx}' or wr_parent = '{$idx}' ) and wr_table = '{$table}' ";

    $result = sql_query($sql);
    echo $result;
}elseif ($mode == 'ing_competition'){

    if ($search == 'date'){
        $order_by = "cp_datetime asc";
    }else{
        $order_by = "cp_reward desc";
    }
    $sql = "select * from new_competition where date_format(cp_datetime, '%Y-%m-%d') >= '".G5_TIME_YMD."' and cp_progress = 1 ORDER by {$order_by} limit 6";
    $ing_result = sql_query($sql);

    $html = "";
    for ($i = 0; $ing_row = sql_fetch_array($ing_result); $i++){
        $sql = "select * from {$g5['board_file_table']} where wr_id = {$ing_row['cp_idx']} and bo_table = 'competition_main' ";
        $img = sql_fetch($sql);
        $img_file = G5_DATA_PATH.'/file/competition_main/'.$img['bf_file'];
        //d-day구하기
        $sql = "SELECT DATEDIFF(date(now()), '".date('Y-m-d',strtotime($ing_row['cp_datetime']))."') d_day ";
        $d_day = sql_fetch($sql)['d_day'];


        $html .= ' <div class="list cf"><a href="'.G5_BBS_URL.'/contest_view.php?idx='.$ing_row['cp_idx'].'"><div class="mg" style="background:url('. G5_DATA_URL.'/file/competition_main/'.$img['bf_file'].') #575f70; background-size:cover">';
        if (file_exists($img_file) && $img['bf_file'] != ""){
            //$html .= '<img src="'. G5_DATA_URL.'/file/competition_main/'.$img['bf_file'].'">';
        }else{
            // echo '<img src="'. G5_THEME_IMG_URL.'/main/heart_on.png">';
            $html .= "<div class='no_img'>로고 이미지가 없습니다.</div>";
        }
        $html .= "</div>";
        $html .= '<div class="info">';
        $html .= '<div class="tit_ing">'.$ing_row["cp_title"].'</div>';
        $html .= '<div class="date">
                    <span class="dday">D';
        if ($d_day == 0 ){
            $html.= '-Day';
        }else{
            $html.= $d_day;
        }
        $html .= '  </span>';
        $html .= "<span>".common_code($ing_row['cp_category2'],'code_idx','json', ' and code_ctg = \"competition_ctg2\" ' )[0]['name']."</span>";
        $html .= '</div>';
        $html .= '<div class="txt"><i class="fas fa-trophy-alt"></i> 상금 '. number_format($ing_row["cp_reward"]) .'만원</div>';
        $html .= '</div></a></div>';
    }

    if (sql_num_rows($ing_result) == 0){
        $html = "<div>진행중인 공모전이 없습니다.</div>";
    }

    echo $html;
}elseif ($mode == 'comp_apply_form') {

//    $cp_idx = $_REQUEST['cp_idx'];
    $bo_table = "comp_apply_real";
    $bo_table2 = "comp_apply_capture";


    $sql = "insert into new_competition_apply set ";

    foreach ($_REQUEST as $key => $value) {
        if (strpos($key, 'ap_') === 0) {
            $sql .= $key . "='" . $value . "',";
        }
    }
    $sql .= "mb_id = '" . $member['mb_id'] . "',";
    $sql .= "wr_datetime = '" . G5_TIME_YMDHIS . "'";

    $result = sql_query($sql);
    $idx = sql_insert_id();

    @mkdir(G5_DATA_PATH . '/file/' . $bo_table, G5_DIR_PERMISSION);
    @chmod(G5_DATA_PATH . '/file/' . $bo_table, G5_DIR_PERMISSION);

    @mkdir(G5_DATA_PATH . '/file/' . $bo_table2, G5_DIR_PERMISSION);
    @chmod(G5_DATA_PATH . '/file/' . $bo_table2, G5_DIR_PERMISSION);



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
    echo $result;
}elseif ($mode == 'comp_apply_view_modal'){



    $idx = $_REQUEST['idx'];
    $sql = "select * from new_competition_apply where ap_idx = {$idx} order by ap_idx asc ";
    $result = sql_fetch($sql);

    $apply_mem = get_member($result['mb_id']);

    $sql = "select * from {$g5['board_file_table']} where bo_table = 'comp_apply_real' and wr_id = '{$idx}' ";
    $file = sql_fetch($sql);
    $sql = "select * from {$g5['board_file_table']} where bo_table = 'comp_apply_capture' and wr_id = '{$idx}' ";
    $file2 = sql_query($sql);

    $ss_name = 'ss_view_comp_apply_real_'.$idx;
    set_session($ss_name, TRUE);


    $html1 = '<h4 class="modal-title"><i class="fas fa-user-circle"></i>&nbsp;'.$apply_mem['mb_nick'].'<span>'.date('Y.m.d', strtotime($result['wr_datetime'])).'</span></h4>';
    $html2 = $result['ap_content'];
    if($file['bf_source'] != "") {
        $html3 = ' <li><a href="' . G5_BBS_URL . '/download.php?bo_table=comp_apply_real&wr_id=' . $idx . '&no=0"><div class="tag03"><span>' . $file['bf_source'] . '</span></div></a></li>';
    }else{
        $html3 = '<li><div class="tag03"><span>첨부파일 없음</span></li>';
    }
    $html4 = "";
    for ($i = 0; $row = sql_fetch_array($file2); $i++){
        if (file_exists(G5_DATA_PATH.'/file/comp_apply_capture/'.$row['bf_file'])) {
            $html4 .= '<li><img src="' . G5_DATA_URL . '/file/comp_apply_capture/' . $row['bf_file'] . '"></li> ';
        }
    }
    die(json_encode(array('html1'=>$html1, 'html2'=>$html2,'html3'=>$html3,'html4'=>$html4)));

}elseif ($mode == 'comp_win_idx'){

    $write_id = $_REQUEST['write_id'];
    if ($member['mb_id'] != $write_id){
        alert('올바른 방법으로 이용해 주십시오.', G5_URL);
    }

    $sql = "update new_competition set cp_win_apply = '{$_REQUEST["apply_idx"]}', cp_progress = '3' where cp_idx = '{$_REQUEST["idx"]}'";
    $result = sql_query($sql);
    echo $result;


}elseif ($mode == 'last_day_ajax'){

    $year = $_REQUEST['year'];
    $month = $_REQUEST['month'];
    $result = last_day($year,$month);

    echo $result;

}elseif ($mode == 'comp_pay_update'){
    $sql = "select cp.*, ap.mb_id ap_mb_id from new_competition cp left join new_competition_apply ap on cp.cp_win_apply = ap.ap_idx where cp_idx = '{$_REQUEST["idx"]}' ";
    $comp = sql_fetch($sql);

    if ($member['mb_id'] != $comp['mb_id']){
        alert('올바른 방법으로 이용해 주십시오.', G5_URL);
    }

    //상태값 변경
    $sql = "update new_competition set cp_progress = '4' where cp_idx = '{$_REQUEST["idx"]}'";
    $result = sql_query($sql);

    //수상자에게 금액 지급
    $amt = $comp['cp_reward']."0000";
    $sql = "update {$g5['member_table']} set mb_6 = mb_6 + {$amt} where mb_id = '{$comp['ap_mb_id']}' ";
    sql_query($sql);

    $mb = get_member($comp['ap_mb_id']);
    payment_history($comp['ap_mb_id'], $competition_win_content['content'],$comp['cp_reward']."0000",  $mb['mb_6'],'@pay_plus','',$competition_win_content['idx'],$_REQUEST["idx"],'new_competition');


    echo $result;


}