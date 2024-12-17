<?php
$sub_menu = "250000";
include_once('./_common.php');

include_once('../jl/JlConfig.php');

auth_check($auth[$sub_menu], 'r');



$g5['title'] = '상품관리';
include_once('./admin.head.php');


?>
<link rel="stylesheet" type="text/css" href="<?=$jl->URL?>/theme/basic_app/css/common.css?v=0.4">
<link rel="stylesheet" type="text/css" href="<?=$jl->URL?>/theme/basic_app/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?=$jl->URL?>/theme/basic_app/css/mobile.css?v=0.4">
<link rel="stylesheet" type="text/css" href="<?=$jl->URL?>/theme/basic_app/css/sub.css?ver=0.4">
<div id="app">
    <product-input-main mb_no="<?=$member['mb_no']?>" primary="<?=$_GET['idx']?>" ref="productInput"></product-input-main>
</div>


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
?>




<?php

?>
