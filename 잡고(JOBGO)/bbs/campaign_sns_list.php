<?php
include_once("../jl/JlConfig.php");
global $pid;
$pid = "sns_list";
$sub_id = "campagin_list";
include_once('./_common.php');

$g5['title'] = 'SNS 포스팅';
include_once('./_head.php');
?>

<div id="vueContent">
    <div id="banner" class="black mt0">
        <h6><b class="txt_color3">대학생에게 필요한 ○○</b></h6>
        <h6 class="txt_bold2 txt_white">용돈, 알바, 대외활동!</h6>
        <h6 class="txt_thin txt_white">잡고가 함께 해요</h6>
        <button type="button" class="btn btn_black" onclick="location.href='<?php echo G5_URL ?>/new_cpn_service.php'">새로워진 잡고 <i class="fa-solid fa-right"></i></button>
    </div>

    <campaign-list></campaign-list>

    <nav class="pg_wrap">
        <span class="pg" id="emo_pg"></span>
    </nav>
</div>

<?php
$jl->vueLoad("vueContent");
$jl->includeDir("/component/campaign");
include_once('./_tail.php');
?>