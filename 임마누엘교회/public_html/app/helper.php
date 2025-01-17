<?php
$pid = "helper";
include_once("./app_head.php");
include_once("../jl/JlConfig.php");
?>
<div id="app">
    <div id="helper">
        <div class="slogan">
            <h5>성도들 간에 도움의 손길이 필요할 때 요청하고 자원하여<br>
                도움을 주고 받는 발론티어 커뮤니티입니다.</h5>
            <button type="button" class="btn btn_color btn-large" onclick="location.href='./helper_form'">요청하기</button>
        </div>
        <div class=" box_radius box_white">
            <h6>도움이 필요해요</h6>
            <bbs-helper-list></bbs-helper-list>
        </div>
    </div>
</div>


<?
$jl->vueLoad('app');
$jl->componentLoad("/bbs/helper");
$jl->componentLoad("/item");
?>
<?php
include_once("./app_tail.php");
?>