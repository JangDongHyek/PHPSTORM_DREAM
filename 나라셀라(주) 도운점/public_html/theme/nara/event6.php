<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_THEME_PATH.'/head.php');

$floor = 6;
?>

<style></style>

<section id="class" class="f6">
    <ul class="tab">
        <li class="active"><a href="./event6.php">클래스</a></li>
        <li class=""><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=6fphoto">이용후기</a></li>
    </ul>

    <? include_once("inc/eventMain.php"); ?>

</section>

<?php
include_once(G5_PATH.'/tail.php');
?>