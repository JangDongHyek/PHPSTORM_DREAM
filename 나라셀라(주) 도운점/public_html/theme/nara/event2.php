<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_THEME_PATH.'/head.php');

$floor = 2;
?>

<style></style>

<section id="class" class="f2">
    <ul class="tab">
        <li class="active"><a href="./event2.php">클래스</a></li>
        <li class=""><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=2fphoto">이용후기</a></li>
    </ul>
    
    <? include_once("inc/eventMain.php"); ?>
</section>


<?php
include_once(G5_PATH.'/tail.php');
?>
