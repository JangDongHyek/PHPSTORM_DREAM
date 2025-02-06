<?php
$pid = "class_all";
include_once("./app_head.php");
include_once("../jl/JlConfig.php");
?>
<div id="app">
    <div id="class" class="list">
        <button class="btn btn_large btn_back" type="button" onclick="location.href='./class'"><i class="fa-solid fa-arrow-left"></i> 속회방 메인</button>
        <div class="slogan">
            <h6>전체 속회예배 현황
                <span>이번주 예배 드린 속 <b>0</b>개속 / 전체 150개속 중</span>
            </h6>
        </div>

        <bbs-class_report-all-list></bbs-class_report-all-list>
    </div>
    <!--페이징 삽입 바람-->
    <!--보기 모달 연결 바람-->
</div>
<?
$jl->vueLoad('app');
$jl->componentLoad("/bbs/class_report");
$jl->componentLoad("/item");
$jl->componentLoad("/external");
?>
<?php
include_once("./app_tail.php");
?>