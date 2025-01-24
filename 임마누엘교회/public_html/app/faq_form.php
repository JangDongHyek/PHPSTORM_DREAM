<?php
$pid = "faq_form";
include_once("./app_head.php");
include_once("../jl/JlConfig.php");
?>

<div id="app">
    <div id="faq" class="form">
        <button class="btn btn_large btn_back" type="button" onclick="location.href='./faq'"><i class="fa-solid fa-arrow-left"></i> 자주하는질문 목록</button>
        <bbs-faq-input primary="<?=$_GET['primary']?>"></bbs-faq-input>
    </div>
</div>

<?
$jl->vueLoad('app');
$jl->componentLoad("/bbs/faq");
$jl->componentLoad("/item");
?>


<?php
include_once("./app_tail.php");
?>