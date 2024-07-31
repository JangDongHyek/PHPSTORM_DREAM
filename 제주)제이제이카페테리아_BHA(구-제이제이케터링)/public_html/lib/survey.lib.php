<?php
if (!defined('_GNUBOARD_')) exit;

$g5['survey_table'] = "g5_eazy_survey";
$g5['clause_table'] = "g5_eazy_clause";

// 설문조사
function survey($skin_dir='basic', $sv_id=false)
{
    global $config, $member, $g5, $is_admin;

    // 투표번호가 넘어오지 않았다면 가장 큰(최근에 등록한) 투표번호를 얻는다
    if (!$sv_id) {
        $row = sql_fetch(" select MAX(sv_id) as max_sv_id from {$g5['survey_table']} ");
        $sv_id = $row['max_sv_id'];
    }

    if(!$sv_id)
        return;

    if(preg_match('#^theme/(.+)$#', $skin_dir, $match)) {
        if (G5_IS_MOBILE) {
            $survey_skin_path = G5_THEME_MOBILE_PATH.'/'.G5_SKIN_DIR.'/survey/'.$match[1];
            if(!is_dir($survey_skin_path))
                $survey_skin_path = G5_THEME_PATH.'/'.G5_SKIN_DIR.'/survey/'.$match[1];
            $survey_skin_url = str_replace(G5_PATH, G5_URL, $survey_skin_path);
        } else {
            $survey_skin_path = G5_THEME_PATH.'/'.G5_SKIN_DIR.'/survey/'.$match[1];
            $survey_skin_url = str_replace(G5_PATH, G5_URL, $survey_skin_path);
        }
        //$skin_dir = $match[1];
    } else {
        if (G5_IS_MOBILE) {
            $survey_skin_path = G5_MOBILE_PATH.'/'.G5_SKIN_DIR.'/survey/'.$skin_dir;
            $survey_skin_url  = G5_MOBILE_URL.'/'.G5_SKIN_DIR.'/survey/'.$skin_dir;
        } else {
            $survey_skin_path = G5_SKIN_PATH.'/survey/'.$skin_dir;
            $survey_skin_url  = G5_SKIN_URL.'/survey/'.$skin_dir;
        }
    }

    $sv = sql_fetch(" select * from {$g5['survey_table']} where sv_id = '$sv_id' ");

    ob_start();
    include_once ($survey_skin_path.'/survey.skin.php');
    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}
?>