<?php
$sub_id = "my_profile02";
include_once('./_common.php');

$mb_id = $_POST['mb_id'];
$page = $_POST['page']; // 이동할 페이지 (기본정보 or 인터뷰)
$save_op = $_POST['save_op']; // 저장 옵션 (탭 이동 or 저장)

$sql = " select * from {$g5['member_table']} where mb_id = '{$mb_id}' ";
$mb = sql_fetch($sql);

if(!empty($_POST['hobby_code'])) {
    sql_query( " delete from g5_member_hobby where mb_no = '{$mb['mb_no']}' ");
    $code = explode(',', $_POST['hobby_code']);

    for($i=0; $i<count($code); $i++) {
        $hobby_code = explode('_', $code[$i]);
        if($hobby_code[0] == 'hobby') $code_name = "취미";
        if($hobby_code[0] == 'exercise') $code_name = "운동";
        if($hobby_code[0] == 'movie') $code_name = "영화";
        if($hobby_code[0] == 'music') $code_name = "음악";
        if($hobby_code[0] == 'tv') $code_name = "TV";

        sql_query(" insert into g5_member_hobby set mb_no = '{$mb['mb_no']}', co_code = '{$hobby_code[1]}', co_code_name = '{$code_name}' ");
    }
}

$sql_common = " mb_mycar = '{$mb_mycar}',
                mb_myhome = '{$mb_myhome}',
                mb_salary = '{$mb_salary}', 
                mb_family = '{$mb_family}',
                mb_family_txt = '{$mb_family_txt}',
                mb_live = '{$mb_live}',
                mb_live_txt = '{$mb_live_txt}',
              ";

// 프로필 작성 상태 완료 및 추가정보 업데이트
$sql = " update {$g5['member_table']} set {$sql_common} mb_profile3 = 'Y' where mb_id = '{$mb_id}' ";
sql_query($sql);

// 승인이 완료된 프로필 수정 시 mypage.php로 연결
if($mb['mb_approval'] == 'Y' && $save_op == 'save') {
    die('mypage');
    //goto_url(G5_BBS_URL.'/mypage.php');
} else {
    die('page');
    //goto_url(G5_BBS_URL.'/'.$page.'?mb_id='.$mb_id);
}
?>