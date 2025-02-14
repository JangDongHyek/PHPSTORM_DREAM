<?
include_once('./_common.php');
include_once(G5_PATH."/jl/JlConfig.php");
$name = "cmypage";
$pid = "mypage";
$g5['title'] = '마이페이지';
include_once('./_head.php');
?>

<? if($name=="cmypage") { ?>
<body<?php echo isset($g5['body_script']) ? $g5['body_script'] : ''; ?> class="cmypage">
<?}?>

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">

<div id="area_mypage">
    <div class="inr">
        <?php include('./mypage_banner.php'); ?>
        <div id="mypage_wrap">
            <?php include_once('./mypage_info.php'); ?>

            <div class="mypage_cont">
                <div class="box">
                    <h3>프로젝트 의뢰 LIST</h3><!--의뢰인 :의뢰 / 전문가 : 지원-->
                    <button type="button" class="project-add" onclick="window.location.href='./project_form.php'">프로젝트 의뢰하기</button><!--의뢰인 버전-->

                    <project-my-list></project-my-list>
                </div>
            </div>
            <!-- 마이페이지에만 나오는 메뉴 -->
            <?php include_once('./mypage_menu.php'); ?>
        </div>
    </div>
</div>


<?
$jl->vueLoad("area_mypage");
$jl->componentLoad("project");
$jl->componentLoad("external");
?>

<?
include_once('./_tail.php');
?>
