<? 
include_once('./_common.php');
include_once(G5_PATH."/jl/JlConfig.php");
$g5['title'] = '프로젝트 의뢰';
include_once('./_head.php');
$name = "project_view";
$pid = "project_list";
?>

<div id="area_project">
    <div class="inr">
        <ul id="area_history"><li><a href="">홈</a></li> <!----> <li><a href="<?php echo G5_BBS_URL ?>/project_list?category1_idx=20" class="current">프로젝트</a></li></ul>
    </div>

    <project-view primary="<?=$_GET['primary']?>" mb_no="<?=$member['mb_no']?>" tab="<?=$_GET['tab']?>"></project-view>
</div>

<? $jl->vueLoad('area_project',['swiper']); ?>
<? $jl->componentLoad("/project"); ?>
<? $jl->componentLoad("external"); ?>


<?php
include_once('./_tail.php');
?>