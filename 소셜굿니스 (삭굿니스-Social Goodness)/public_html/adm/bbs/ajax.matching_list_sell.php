<?php
include_once('./_common.php');

$page = $_REQUEST['page'];
$te_no = $_REQUEST['te_no'];
$fo = $_REQUEST['fo'];

if($page)
{
    $rows = '15';
//    $rows = '2';

    $from_record = ($page - 1) * $rows; // 시작 열을 구함

    $sql = "select * from {$g5['eval_table']} 
        where te_no = '{$te_no}' and finger_option = '{$fo}' and category = '리뷰' limit {$from_record}, {$rows} ";

    $eval_result = sql_query($sql);

    $contents = "";
    $te = get_tes_no($te_no);
    for ($i = 0; $eval_row = sql_fetch_array($eval_result); $i++) {

        $mb = get_member_no($eval_row['mb_no']);
        //답글 쿼리
        $sql = "select * from {$g5['reply_table']}  where eval_idx = '{$eval_row["idx"]}' order by reply_no desc";
        $reply_result = sql_query($sql);
        //프로필 이미지
        $sql = "select *from g5_file where mb_no = '{$eval_row['mb_no']}' and fi_table = 'mypage' order by fi_no desc limit 1";
        $file_result = sql_fetch($sql);
        $img_path = G5_DATA_PATH . '/file/mypage/' . $file_result['fi_file'];
        $img_url = G5_DATA_URL . '/file/mypage/' . $file_result['fi_file'];
        // id 일부표시하기
        $id_array = explode("@", $mb['mb_id']);
        $str = substr($id_array[0], 0, 4);
        for ($c = 0; $c < (strlen($id_array[0]) - 4); $c++) {
            $str .= '*';
        }

        $contents .='<li class="cont02">';
            $contents .='<header>';
                $contents .='<div id="inf_link">';
                    $contents .='<div class="img">';
                    if (file_exists($img_path) && isset($file_result['fi_file'])) {
                    $contents .='<img src="'.$img_url.'" alt="프로필이미지">';
                    } else {
                    $contents .='<img src="'.G5_THEME_IMG_URL.'/no_image.jpg" alt="프로필이미지">';
                    }
                    $contents .=' </div>';
                    if ($member['mb_no'] == $te['mb_no']) {
                    $contents .='<div class="re_w"><a href="#reply_wr" class="btn_re" data-idx='.$eval_row['idx'].' data-toggle="modal"><i class="fal fa-reply"></i>답글쓰기</a></div>';
                    }
                    $contents .='<div class="txt">';
                    $contents .='<p class="name"><span>'. $str.'</span></p>';
                    $contents .='<p class="info"><i class="fal fa-clock"></i>'.passing_time($eval_row['detail_eval_date']).'</p>';
                    $contents .='<p></p>';
                $contents .='</div>';
            $contents .='</header>';
            //서비스,시설, 가격 progress 반목문.
            for ($b= 1; $b<=5; $b++) {

                $name_en = $op_list[$b][1];
                $name = $op_list[$b][2];

                $contents .= '<div class="progress_wrap">';
                $contents .= '<ul>';
                $contents .= '<li><p class="t">'.$name.'</p></li>';
                $contents .= '<li>';
                $contents .= '<li>';
                if (is_numeric($eval_row[$name_en."_option"])) {
                    $contents .= '<div class="progress">
                                            <div class="progress-bar progress-bar-success" role="progressbar"
                                                 aria-valuenow="' . $eval_row[$name_en."_option"] . "0" . '" aria-valuemin="0"
                                                 aria-valuemax="100"
                                                 style="width:' . ($eval_row[$name_en."_option"] * 2) . "0" . '%">                                             
                                            </div>
                                          </div>
                                        </li>
                                    <li><p class="num"><span>' . $eval_row[$name_en."_option"] . '</span>/5</p></li>';
                } else {
                    $contents .= '<p>' . $eval_row[$name_en."_option"] . '</p>
                                    </li>
                                <li></li>';
                }
                $contents .= '</ul>
                            </div>';
            }
            $contents .= '</li>';
            //답글 시작

            $contents .= '<div name="review_cont02_'.$eval_row['idx'].'">';

            for ($i = 0; $reply_row = sql_fetch_array($reply_result); $i++) {
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
                $contents .= '<li class="cont02">';
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

            $contents .= "</div>";
        }

    echo $contents;
}