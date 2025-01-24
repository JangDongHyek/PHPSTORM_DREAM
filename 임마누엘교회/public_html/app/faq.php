<?php
$pid = "faq";
include_once("./app_head.php");
include_once("../jl/JlConfig.php");
?>
    <div id="app">
        <div id="faq">
            <div class="slogan">
                <?if($member['mb_1'] == '관리자'){?>
                    <button type="button" class="btn btn_color btn-large" onclick="location.href='./faq_form'">문답 등록</button>
                <?}?>
            </div>

            <bbs-faq-list mb_1="<?=$member['mb_1']?>"></bbs-faq-list>

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