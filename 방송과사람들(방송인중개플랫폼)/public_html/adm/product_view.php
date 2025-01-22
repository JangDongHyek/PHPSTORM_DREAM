<?php
$sub_menu = "250000";
include_once('./_common.php');

include_once('../jl/JlConfig.php');

auth_check($auth[$sub_menu], 'r');



$g5['title'] = '상품관리';
include_once('./admin.head.php');


?>
<script src="<?=$jl->URL?>/theme/basic_app/js/bootstrap.min.js"></script>
<link href="<?=$jl->URL?>/theme/basic_app/js/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?=$jl->URL?>/theme/basic_app/css/sub.css?ver=0.4">
<style>
    a:hover{text-decoration: none!important;}
    .required{background: none!important;}
    ul{list-style: none; margin: 0; padding: 0;}
    .inr{position:relative; width:1300px; margin:0 auto;}
    .inr.v2{position:relative; width:1000px; margin:0 auto;}
    .inr.v3{position:relative; width:1200px; margin:0 auto;}
    .inr:after{ display:block; content:""; clear:both;}
    #item_write #area_btn{display: flex; gap: 10px;}
    #item_write #area_btn > a{margin: 0!important;}
</style>
<div id="app">
    <product-input-main mb_no="<?=$_GET['mb_no']?>" primary="<?=$_GET['idx']?>" ref="productInput" ></product-input-main>
</div>

<?php $jl->pluginLoad(["summernote"]);?>
<?php $jl->vueLoad("app",["drag"]);?>

<?php $jl->componentLoad("adm/product");?>
<?php $jl->componentLoad("item");?>


<?php
include_once ($jl->ROOT."/component/product/product-input-main.php");
include_once ($jl->ROOT."/component/product/product-input-tab1.php");
include_once ($jl->ROOT."/component/product/product-input-tab2.php");
include_once ($jl->ROOT."/component/product/product-input-tab3.php");
include_once ($jl->ROOT."/component/slot/slot-modal.php");
include_once ($jl->ROOT."/component/naver-editor.php");
include_once ($jl->ROOT."/component/external/external-summernote.php");
include_once ($jl->ROOT."/component/external/external-bs-modal.php");
?>




<?php

?>
