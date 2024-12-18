<?
include_once('./_common.php');
$g5['title'] = '포트폴리오등록';
include_once('./_head.php');
$name = "item_write";
include_once(G5_PATH."/jl/JlConfig.php");

//재능정보
$idx = $_REQUEST['idx'];
$sql = "select * from new_item left join new_category c on i.i_ctg = c.c_idx where i_idx = '{$idx}' ";
$view = sql_fetch($sql);

$main_ctg = ctg_list(0);

//$view_ctg = ctg_info($view["i_ctg"]);

if(!$is_member){
    alert("회원이시라면 로그인 후 이용해주세요.",G5_BBS_URL.'/login.php?url='.G5_BBS_URL."/item_write01.php" );
}

$c_name = ctg_info($view['c_p_idx'])["c_name"];
$c_name2 = $view["c_name"];
?>

<? if($name=="item_write") { ?>
	<body<?php echo isset($g5['body_script']) ? $g5['body_script'] : ''; ?> class="item_write">
<?}?>

<style>
	#ft_menu{display:none;}
</style>

<div id="vueapp">
    <portfolio-input mb_no="<?=$member['mb_no']?>" primary="<?=$_GET['idx']?>"></portfolio-input>
</div>

<?php
$jl->vueLoad("vueapp");
$jl->includeDir("/component/portfolio");
?>


<?php include_once('./_tail.php'); ?>