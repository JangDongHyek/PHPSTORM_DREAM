<?php
$sub_id = "my_service";
include_once('./_common.php');

$g5['title'] = '서비스 관리';
include_once('./_head.php');

// 회원이 아닌 경우 접속하실 수 없습니다.
if (!$is_member){
    //alert('로그인 후 이용하여 주십시오.', G5_BBS_URL.'/register.php');
}

$sql = "select *from {$g5['profile_table']} where mb_id = '{$member['mb_id']}' ";
$profile = sql_fetch($sql);

//$tab = $_REQUEST['tab'];
//print_r($tab);
//if (empty($tab)) $tab = 'like'; // 텝이 없으면 첫 페이지 (1 페이지)
$total_count = 0;

//탭별 페이지(찜한 재능)
$sql = " select count(li_idx) cnt from {$g5['like_table']} where mb_id = '{$member['mb_id']}' and li_table = 'talent' ";
$my_like_cnt = sql_fetch($sql);
$like_total_count = $my_like_cnt['cnt'];
$rows = $config['cf_page_rows'];
//$rows = 1;
$like_total_page  = ceil($like_total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$like_from_record = ($page - 1) * $rows; // 시작 열을 구함
//탭별 페이지(구매한 재능)
$sql = " select count(li_idx) cnt from {$g5['like_table']} where mb_id = '{$member['mb_id']}' ";
$my_buy_cnt = sql_fetch($sql);
$buy_total_count = $my_buy_cnt['cnt'];
$rows = $config['cf_page_rows'];
//$rows = 1;
$buy_total_page  = ceil($buy_total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$buy_from_record = ($page - 1) * $rows; // 시작 열을 구함

//전문인일때
if ($member['mb_division'] == 2) {


    $view_pf_pro_ctg1 = explode(",", $profile['pf_pro_ctg1']);
    $view_pf_pro_ctg2 = explode(",", $profile['pf_pro_ctg2']);
    $view_pf_pro_ctg3 = explode(",", $profile['pf_pro_ctg3']);

    $pro_ctg1_html = "";
    for ($i = 0; $i < count($view_pf_pro_ctg1); $i++) {
        $p_common_name = common_code($view_pf_pro_ctg1[$i], 'code_idx', 'json');
        $pro_ctg1_html .= '<li>';
        $pro_ctg1_html .= ' <div class="tag_t02">' . $p_common_name[0]['name'] . '</div>';
        for ($a = 0; $a < count($view_pf_pro_ctg2); $a++) {
            $sql = "select * from {$g5['code_table']} where code_idx = '{$view_pf_pro_ctg2[$a]}' and code_p_idx = '{$view_pf_pro_ctg1[$i]}' and code_use = '1' order by code_p_idx";
            $common_name = sql_fetch($sql);
            $sql = "select * from {$g5['code_table']} where code_idx = '{$view_pf_pro_ctg3[$a]}' and code_p_idx = '{$view_pf_pro_ctg2[$a]}' and code_use = '1' order by code_p_idx";
            $common_name2 = sql_fetch($sql);
            if (isset($common_name)) {
                $pro_ctg1_html .= "<div class='tag03'>";
                $pro_ctg1_html .= "<span>" . $common_name['code_name'] . "/" . $common_name2['code_name'] . "</span>";
                $pro_ctg1_html .= "</div>";
            }
        }
        $pro_ctg1_html .= "</li>";
    }


    $sql = " select count(ta_idx) cnt from {$g5['talent_table']} where mb_id = '{$member['mb_id']}' and ta_imsi != 'Y' ";
    $talent_cnt = sql_fetch($sql);

    $sql = "SELECT ta.*, pta.pta_pay FROM {$g5['talent_table']} as ta
        left join {$g5['pay_talent_table']} as pta on pta.pta_idx = ta.ta_pta_idx
        where mb_id = '{$member['mb_id']}' and ta_imsi != 'Y'
        order by ta_idx desc ";
    $talent_result = sql_query($sql);
//일반인 일 때
}else{


    $sql = "select *,pta.pta_pay, ta.ta_idx ta_idx from {$g5['like_table']} li
            left join {$g5['talent_table']} ta on li.ta_idx = ta.ta_idx
             left join {$g5['pay_talent_table']} as pta on pta.pta_idx = ta.ta_pta_idx
             where li.mb_id = '{$member['mb_id']}' and li.li_table = 'talent' limit {$like_from_record}, {$rows}";
    $like_list_result = sql_query($sql);


}

include_once($member_skin_path.'/my_service.skin.php');

include_once('./_tail.php');
?>