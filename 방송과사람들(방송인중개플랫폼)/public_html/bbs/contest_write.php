<?php
$sub_id = "contest";
include_once('./_common.php');
include_once(G5_PATH."/jl/JlConfig.php");
$g5['title'] = '프로젝트 의뢰';
include_once('./_head.php');

add_stylesheet('<link rel="stylesheet" href="' . $member_skin_url . '/style.css">', 0);
add_stylesheet('<link rel="stylesheet" href="' . $member_skin_url . '/style_pro.css">', 0);
$url = "";
?>
    <link rel="stylesheet" href="<?= $member_skin_url?>/competition.css">
    <style>
        #ft{display: none!important;}
    </style>
<?
include_once('./_common.php');
$g5['title'] = '재능등록';
include_once('./_head.php');
$name = "item_write";

//재능정보
$idx = $_REQUEST['idx'];
$sql = "select * from new_item where i_idx = '{$idx}' ";
$view = sql_fetch($sql);

if ($view['i_idx'] != "") {
    $ctg_key = array_search($view['i_ctg'], array_column($main_ctg, 'code')) + 1;
}

if(!$is_member){
    alert("회원이시라면 로그인 후 이용해주세요.",G5_BBS_URL.'/login.php?url='.G5_BBS_URL."/contest_write.php" );
}

?>

<div id="app">
    <project-input mb_no="<?=$member['mb_no']?>"></project-input>
</div>

<?php $jl->vueLoad('app');?>
<?php $jl->componentLoad('project');?>


<?php
include_once('./_tail.php');
?>