<?php
$pid = "video";
include_once("./app_head.php");
include_once("../jl/JlConfig.php");
?>
<div id="app">

    <div id="video">
        <div class="slogan">
            <h5>IMC 설교영상과 함께 하세요.</h5>
            <button type="button" class="btn btn_color btn-large" onclick="location.href='./video_form'">설교영상 등록</button>
        </div>
        <div class=" box_radius box_white">
            <h6>설교영상 목록</h6>
            <bbs-video-list mb_no="<?=$member['mb_no']?>"></bbs-video-list>
        </div>
    </div>
</div>

<?
$jl->vueLoad('app');
$jl->componentLoad("/bbs/video");
$jl->componentLoad("/item");
?>
<?php
include_once("./app_tail.php");
?>