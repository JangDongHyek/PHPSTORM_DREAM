<?php
include_once('./_common.php');

$g5['survey_table'] = "g5_eazy_survey";
$g5['clause_table'] = "g5_eazy_clause";

$sv = sql_fetch(" select * from {$g5['survey_table']} where sv_id = '{$_POST['sv_id']}' ");
if (!$sv['sv_id'])
    alert('sv_id 값이 제대로 넘어오지 않았습니다.');

for($i=0; $i<count($cl_id); $i++){
	${"gb_survey".$i} = preg_replace('/[^0-9]/', '', ${"gb_survey".$i});
	if(!${"gb_survey".$i})
		alert('항목을 선택하세요.');
}
$search_mb_id = false;
$search_ip = false;

if($is_member) {
    // 투표했던 회원아이디들 중에서 찾아본다
    $ids = explode(',', trim($sv['mb_ids']));
    for ($i=0; $i<count($ids); $i++) {
        if ($member['mb_id'] == trim($ids[$i])) {
            $search_mb_id = true;
            break;
        }
    }
} else {
    // 투표했던 ip들 중에서 찾아본다
    $ips = explode(',', trim($sv['sv_ips']));
    for ($i=0; $i<count($ips); $i++) {
        if ($_SERVER['REMOTE_ADDR'] == trim($ips[$i])) {
            $search_ip = true;
            break;
        }
    }
}

$result_url = G5_BBS_URL."/survey.php";

// 없다면 선택한 투표항목을 1증가 시키고 ip, id를 저장
if (!($search_ip || $search_mb_id)) {
    $sv_ips = $sv['po_ips'] . $_SERVER['REMOTE_ADDR'].",";
    $mb_ids = $sv['mb_ids'];
	$cl_ext_txt = $_POST['cl_ext_txt'];

    if ($is_member) { // 회원일 때는 id만 추가
        $mb_ids .= $member['mb_id'].',';
        $sql = " update {$g5['survey_table']} set mb_ids = '$mb_ids' where sv_id = '$sv_id' ";
    } else {
        $sql = " update {$g5['survey_table']} set sv_ips = '$sv_ips' where sv_id = '$sv_id' ";
    }

    sql_query($sql);

	for($i=0; $i<count($cl_id); $i++){
		$sql_common = "";
		if(${"gb_survey".$i} != 9){
			$sql_common = " cl_cnt".${"gb_survey".$i}." = cl_cnt".${"gb_survey".$i}." + 1 ";
		}else{
			$cl = sql_fetch(" select * from {$g5['clause_table']} where cl_id = '{$cl_id[$i]}' ");
			$cl_txt = $cl['cl_ext_txt'].$cl_ext_txt.",";

			$sql_common = " cl_ext_cnt = cl_ext_cnt + 1, cl_ext_txt = '".$cl_txt."' ";
		}
		$sql = " update {$g5['clause_table']} set {$sql_common} where cl_id = '".$cl_id[$i]."'";
		sql_query($sql);
	}
} else {
    alert($sv['sv_subject'].'에 이미 참여하셨습니다.', $result_url);
}

/*
if (!$search_mb_id)
    insert_point($member['mb_id'], $sv['po_point'], $sv['sv_id'] . '. ' . cut_str($sv['po_subject'],20) . ' 투표 참여 ', '@poll', $sv['sv_id'], '투표');
*/

//goto_url($g5['bbs_url'].'/poll_result.php?sv_id='.$sv_id.'&amp;skin_dir='.$skin_dir);
alert($sv['sv_subject']."투표에 참여하였습니다.", $result_url);
?>
