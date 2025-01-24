<?php
$pid = "inquiry_form";
include_once("./app_head.php");
include_once("../jl/JlConfig.php");
?>
<div id="app">
    <div id="inquiry" class="form">
        <button class="btn btn_large btn_back" type="button" onclick="location.href='./inquiry'"><i class="fa-solid fa-arrow-left"></i> 문의 목록</button>
        <bbs-qna-input mb_no="<?=$member['mb_no']?>"></bbs-qna-input>
    </div>
</div>

<?
$jl->vueLoad('app');
$jl->componentLoad("/bbs/qna");
$jl->componentLoad("/item");
?>
<?php
include_once("./app_tail.php");
?>