<?php
include_once('./_common.php');

$mode = $_REQUEST['mode'];

if ($mode == 'reply'){

    $sql_common = "";
    foreach ($_REQUEST as $key => $value) {
        if ($key != "mode" && $key != "fo"  && $key != "te_no") {
            $sql_common .= $key . '="' . $value . '" ,';
        }
    }
    $sql_common .= "wr_datetime = '".G5_TIME_YMDHIS."' " ;

    $sql = "insert into {$g5['reply_table']} set {$sql_common}";
    $result = sql_query($sql);

    if (!$result){
        alert("실패하였습니다.");
    }else{
        $contents = "";
        //답글 쿼리
        $sql = "select * from {$g5['reply_table']}  where eval_idx = '{$_REQUEST["eval_idx"]}' order by reply_no desc ";
        $reply_result = sql_query($sql);

        $contents .= '<div name="review_cont02_'.$eval_row['idx'].'">';
        //답글 시작
        for ($i = 0; $reply_row = sql_fetch_array($reply_result); $i++) {
//            print_r($reply_row);
//            exit;
            $mb = get_member_no($reply_row['mb_no']);
            //답글 프로필 이미지
            $sql = "select *from g5_file where mb_no = '{$reply_row['mb_no']}' and fi_table = 'mypage' order by fi_no desc limit 1";
            $re_file_result = sql_fetch($sql);
            $re_img_path = G5_DATA_PATH . '/file/mypage/' . $re_file_result['fi_file'];
            $re_img_url = G5_DATA_URL . '/file/mypage/' . $re_file_result['fi_file'];
            //답글 id 일부처리
            $id_array = explode("@", $mb['mb_id']);
            $re_str = substr($id_array[0], 0, 4);
            for ($i = 0; $i < (strlen($id_array[0]) - 4); $i++) {
                $re_str .= '*';
            }
            $contents .= '<div name="review_cont02_'.$reply_row['eval_idx'].'"><li class="cont02">';
            $contents .= '<div class="ico_reply"><img src="'.G5_THEME_IMG_URL.'/common/icon_reply.png"></div>';
            $contents .= '<header class="re_wr">';
            $contents .= '<div id="inf_link">';
            $contents .= ' <div class="img">';
            if (file_exists($re_img_path) && isset($re_file_result['fi_file'])) {
                $contents .= '<img src="'.$re_img_url.'" alt="프로필이미지">';
            }else{
                $contents .= ' <img src="'.G5_THEME_IMG_URL.'/mobile/main01.jpg" alt="프로필이미지">';
            }
            $contents .= '</div>';
            $contents .= '<div class="txt">';
            $contents .= '<p class="name"><span>'.$re_str.'</span></p>';
            $contents .= '<p class="info"><i class="fal fa-clock"></i>'. passing_time($reply_row["wr_datetime"]).'</p>';
            $contents .= '<p></p>';
            $contents .= '</div>';
            $contents .= '</div>';
            $contents .= '</header>';
            $contents .= '<div class="re_wr">';
            $contents .= '<p>'.$reply_row["reply_contents"].'</p>';
            $contents .= '</div>';
            $contents .= '</li>';

        }
        $contents .= '</div>';

        echo $contents;

    }

}elseif ($mode == 'reply_cnt'){
    $sql = "select count(idx) from {$g5['eval_table']} 
        where te_no = '{$te_no}' and finger_option = '{$fo}' and category = '리뷰' ";
    $result = sql_fetch($sql);

    die(json_encode(array('msg'=>'success', 'cnt'=> $result['count(idx)'])));

}
?>