<?php
$sub_id = "register_expert_form03";
include_once('./_common.php');
include_once(G5_CAPTCHA_PATH.'/captcha.lib.php');
include_once(G5_LIB_PATH.'/register.lib.php');

$g5['title'] = '재능인 등록/수정';
include_once('./_head.php');

if ($is_guest){
    alert('회원이 아닙니다. 로그인 후 다시 이용해주세요.',G5_URL.'/index.php');
}

//나이제한
//if (!(getManNai($member['mb_birth']) >= 19 && getManNai($member['mb_birth']) <= 39 )){
//    alert($config['cf_title'].'는 만 19세 이상부터 만 39세 이하의 연령인만 전문인으로 등록이 가능합니다.');
//}

// 회원아이콘 경로
//$mb_icon_path = G5_DATA_PATH.'/member/'.substr($member['mb_id'],0,2).'/'.$member['mb_id'].'.jpg';
//$mb_icon_url  = G5_DATA_URL.'/member/'.substr($member['mb_id'],0,2).'/'.$member['mb_id'].'.jpg';

$sql = "select * from {$g5['profile_table']} where mb_id = '{$member["mb_id"]}' ";
$view = sql_fetch($sql);

//자격증 태그
$view_pf_certificate = explode(",", $view['pf_certificate']);
$certificate_image = count($view_pf_certificate);

$sql = "select * from {$g5['board_file_table']} where wr_id = '{$member['mb_id']}' and bo_table = 'certificate' order by bf_idx";
$cer_result = sql_query($sql);



for ($i = 0; $i < count($view_pf_certificate); $i++){
    $certificate_html .= " <div id='certificatetag_".$i."' class=\"tag\">";
    $certificate_html .=  "<div onclick='tag_del(".$i.",0,\"certificate\");' class=\"close\"><i class=\"fal fa-times\"></i></div>";
    $certificate_html .=  "<span name = 'certificate_span'>".$view_pf_certificate[$i]."</span>";
    $certificate_html .=   "</div>";
}
for ($i = 0; $cer_image = sql_fetch_array($cer_result); $i++){
    $certificate_html .=  "<input type='hidden' id='file_input_idx_".$i."' value='".$cer_image['bf_idx']."'>";
}

if ($view_pf_certificate[0] == ""){
    $certificate_html = "";
}

//전문분야
$view_pf_pro_ctg1 = explode(",", $view['pf_pro_ctg1']);
$view_pf_pro_ctg2 = explode(",", $view['pf_pro_ctg2']);
$view_pf_pro_ctg3 = explode(",", $view['pf_pro_ctg3']);
$pro_ctg1_html = "";
for ($i = 0; $i < count($view_pf_pro_ctg1); $i++){
    $p_common_name = common_code($view_pf_pro_ctg1[$i],'code_idx','json');

    $pro_ctg1_html .= "<li id='pro_ctg_sub_".$p_common_name[0]['idx']."'>";
    $pro_ctg1_html .= "<input type='hidden' id='proinput_ctg1_".$p_common_name[0]['idx']."' value='".$p_common_name[0]['idx']."'>";
    $pro_ctg1_html .= "<div class=\"tag_t\">".$p_common_name[0]['name']."</div>\n";
    for ($a = 0; $a < count($view_pf_pro_ctg2); $a++){
        $sql = "select * from {$g5['code_table']} where code_idx = '{$view_pf_pro_ctg2[$a]}' and code_p_idx = '{$view_pf_pro_ctg1[$i]}' and code_use = '1' order by code_p_idx";
        $common_name = sql_fetch($sql);
        $sql = "select * from {$g5['code_table']} where code_idx = '{$view_pf_pro_ctg3[$a]}' and code_p_idx = '{$view_pf_pro_ctg2[$a]}' and code_use = '1' order by code_p_idx";
        $common_name2 = sql_fetch($sql);
        if (isset($common_name)) {
            $id = 'pro';
            $pro_code_name = $common_name['code_name'].'/'.$common_name2['code_name'];
            $pro_ctg1_html .= "<div id='protag_" . $common_name['code_idx'] . "' class=\"tag02\">\n";
            $pro_ctg1_html .= "            <div class=\"close\" onclick='tag_del(" . $common_name['code_idx'] . "," . $view_pf_pro_ctg1[$i] . "," . "\"" . $id . "\");'><i class=\"fal fa-times\"></i></div>\n";
            $pro_ctg1_html .= "        <span>" . $pro_code_name . "</span>\n";
            $pro_ctg1_html .= "        <input type='hidden' value='" . $common_name['code_idx'] . "' id='proinput_tag_" . $common_name['code_idx'] . "'>\n";
            $pro_ctg1_html .= "        <input type='hidden' value='" . $common_name2['code_idx'] . "' id='proinput_tag2_" . $common_name2['code_idx'] . "'>\n";
            $pro_ctg1_html .= "        </div>";
        }
    }
    $pro_ctg1_html .= "</li>";
}


//보유기술
$view_pf_hold_ctg1 = explode(",", $view['pf_hold_ctg1']);
$view_pf_hold_ctg2 = explode(",", $view['pf_hold_ctg2']);
$hold_ctg1_html = "";
for ($i = 0; $i < count($view_pf_hold_ctg1); $i++){
    $p_common_name = common_code($view_pf_hold_ctg1[$i],'code_idx','json');
    $hold_ctg1_html .= "<li id='pro_ctg_sub_".$p_common_name[0]['idx']."'>";
    $hold_ctg1_html .= "<input type='hidden' id='holdinput_ctg1_".$p_common_name[0]['idx']."' value='".$p_common_name[0]['idx']."'>";
    $hold_ctg1_html .= "<div class=\"tag_t\">".$p_common_name[0]['name']."</div>\n";

    for ($a = 0; $a < count($view_pf_hold_ctg2); $a++){
        $sql = "select * from {$g5['code_table']} where code_idx = '{$view_pf_hold_ctg2[$a]}' and code_p_idx = '{$view_pf_hold_ctg1[$i]}' and code_use = '1' order by code_p_idx";
        $common_name = sql_fetch($sql);
        if (isset($common_name)) {
            $id = 'pro';
            $hold_ctg1_html .= "<div id='protag_" . $common_name['code_idx'] . "' class=\"tag02\">\n";
            $hold_ctg1_html .= "            <div class=\"close\" onclick='tag_del(" . $common_name['code_idx'] . "," . $view_pf_hold_ctg1[$i] . "," . "\"" . $id . "\");'><i class=\"fal fa-times\"></i></div>\n";
            $hold_ctg1_html .= "        <span>" . $common_name['code_name'] . "</span>\n";
            $hold_ctg1_html .= "        <input type='hidden' value='" . $common_name['code_idx'] . "' id='holdinput_tag_" . $common_name['code_idx'] . "'>\n";
            $hold_ctg1_html .= "        </div>";
        }
    }
    $hold_ctg1_html .= "</li>";
}

//연락가능시간
$pf_call_time1 = explode(':',$view['pf_call_time1']);
$pf_call_time2 = explode(':',$view['pf_call_time2']);

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
if ($config['cf_use_addr'])
    add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js

include_once($member_skin_path.'/register_expert_form03.skin.php');
include_once('./_tail.php');
?>