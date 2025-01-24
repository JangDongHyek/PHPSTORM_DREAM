<?php
$pid = "inquiry";
include_once("./app_head.php");
include_once("../jl/JlConfig.php");
?>
<div id="app">
    <div id="inquiry">
        <div class="slogan">
            <button type="button" class="btn btn_color btn-large" onclick="location.href='./inquiry_form'">관리자 문의하기</button>
        </div>

        <bbs-qna-list mb_1="<?=$member['mb_1']?>"></bbs-qna-list>
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