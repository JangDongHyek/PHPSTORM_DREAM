<?
include_once('./_common.php');
include_once(G5_PATH."/jl/JlConfig.php");
$g5['title'] = '서비스등록';
include_once('./_head.php');
$name = "item_write";

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

$tab = empty($_GET['tab']) ? 1 : $_GET['tab'];


?>

<? if($name=="item_write") { ?>
	<body<?php echo isset($g5['body_script']) ? $g5['body_script'] : ''; ?> class="item_write">
<?}?>


<style>
	#ft_menu{display:none;}
</style>

<div id="vueapp">
    <product-input-main mb_no="<?=$member['mb_no']?>" primary="<?=$_GET['idx']?>" tab="<?=$tab?>" ref="productInput"></product-input-main>
</div>

<script src="<?=$jl->URL?>/plugin/summernote/summernote.min.js"></script>
<link rel="stylesheet" href="<?=$jl->URL?>/plugin/summernote/summernote.min.css">

<?php
$jl->vueLoad("vueapp");
include_once ($jl->ROOT."/component/product/product-input-main.php");
include_once ($jl->ROOT."/component/product/product-input-tab1.php");
include_once ($jl->ROOT."/component/product/product-input-tab2.php");
include_once ($jl->ROOT."/component/product/product-input-tab3.php");
include_once ($jl->ROOT."/component/slot/slot-modal.php");
include_once ($jl->ROOT."/component/naver-editor.php");
include_once ($jl->ROOT."/component/external/external-summernote.php");
include_once ($jl->ROOT."/component/external/external-bs-modal.php");
?>







<?php include_once('./_tail.php'); ?>