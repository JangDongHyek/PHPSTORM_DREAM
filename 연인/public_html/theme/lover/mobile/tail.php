<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>
	    </div>
    </div>
</div>




    <?php if (defined('_INDEX_')) { // index에서만 실행 ?>
        <div id="">
            <div class="text-center copy t_margin10">COPYRIGHTⓒLOVER.ALL RIGHTS RESERVED.</div>
        </div>
    <? } ?>

    <? if($is_member) { ?>
    <!-- 로그인 -->
    <div id="new_ft">
        <a href="<?=G5_BBS_URL?>/helper.php" class="<?php if($sub_id=="helper"){ echo "on"; } ?>"><img src="<?php echo G5_THEME_IMG_URL; ?>/new/new_ft1<?php if($sub_id=="helper"){ echo "on"; } ?>.svg"><p>헬퍼<span class="hidden-xxs"> 프로필</span></p></a>
        <a href="<?=G5_BBS_URL?>/board.php?bo_table=b_notice" class="<?php if($bo_table=="b_notice"){ echo "on"; } ?>"><img src="<?php echo G5_THEME_IMG_URL; ?>/new/new_ft2<?php if($bo_table=="b_notice"){ echo "on"; } ?>.svg"><p>공지사항</p></a>
        <a href="<?=G5_URL?>" class="home <?php if(defined('_INDEX_')){ echo "on"; } ?>"><img src="<?php echo G5_THEME_IMG_URL; ?>/new/new_ft<?php if(defined('_INDEX_')){ echo "on"; } ?>.svg"></a>
        <a href="<?=G5_BBS_URL?>/board.php?bo_table=b_counsel" class="<?php if($bo_table=="b_counsel"){ echo "on"; } ?>"><img src="<?php echo G5_THEME_IMG_URL; ?>/new/new_ft3<?php if($bo_table=="b_counsel"){ echo "on"; } ?>.svg"><p>연애상담</p></a>
        <a href="<?=G5_BBS_URL?>/channel.php" class="<?php if($sub_id=="channel"){ echo "on"; } ?>"><img src="<?php echo G5_THEME_IMG_URL; ?>/new/new_ft4<?php if($sub_id=="channel"){ echo "on"; } ?>.svg"><p>톡상담<span class="hidden-xxs"> 신청</span></p></a>
    </div>
    <?} else {?>
    <!-- 비로그인 -->
    <div id="new_ft">
        <a></a>
        <a href="<?=G5_URL?>" class="home <?php if(defined('_INDEX_')){ echo "on"; } ?>"><img src="<?php echo G5_THEME_IMG_URL; ?>/new/new_ft<?php if(defined('_INDEX_')){ echo "on"; } ?>.svg"></a>
        <a></a>
    </div>
    <?}?>


<?/*php } else {?>
    <?php if (defined('_INDEX_')) { // index에서만 실행 ?>
        <div id="">
            <div class="text-center copy t_margin10">COPYRIGHTⓒLOVER.ALL RIGHTS RESERVED.</div>
        </div>
    <? } else if ($bo_table == "review") { // 커플후기 (비회원 열람가능) ?>

    <?php }else{ // index 아닐때 실행
        $ft_path = G5_THEME_IMG_URL."/common/";
        $base_img = array($ft_path."icon_bottom01.png", $ft_path."icon_bottom02.png", $ft_path."icon_bottom03.png", $ft_path."icon_bottom04.png");
        $over_img = array($ft_path."icon_bottom01_over.png", $ft_path."icon_bottom02_over.png", $ft_path."icon_bottom03_over.png", $ft_path."icon_bottom04_over.png");
    ?>
    <div class="ft_fix_area">
        <ul>
             <li>
                <div><a href="<?=G5_BBS_URL?>/helper.php"><img src="<? echo ($sub_id == "helper")? $over_img[0] : $base_img[0]; ?>" alt="헬퍼프로필"></a></div>
             </li><!--
             --><li>
                <div><a href="<?=G5_BBS_URL?>/board.php?bo_table=b_notice"><img src="<? echo ($bo_table == "b_notice")? $over_img[2] : $base_img[2]; ?>" alt="공지사항"></a></div>
             </li><!--
             --><li>
                <div><a href="<?=G5_BBS_URL?>/board.php?bo_table=b_counsel"><img src="<? echo ($bo_table == "b_counsel")? $over_img[1] : $base_img[1]; ?>" alt="연애상담소"></a></div>
             </li><!--
             --><li>
                <div><a href="<?=G5_BBS_URL?>/channel.php"><img src="<? echo ($sub_id == "channel")? $over_img[3] : $base_img[3]; ?>" alt="상담신청"></a></div>
             </li>
        </ul>
    </div>
    <? } ?>

<?php }*/?>


<? if($member[mb_id]=="test01"){?>
<a href="./bbs/register_result.php" style="padding:40px; position:relative; top:10px; margin: 0 auto;">테스트 로그인중</a>
<?		 }?>
<div id="gobtn">
	<a href="#hd" class="goHd"><span></span>브라우저 최상단으로 이동합니다</a><!--
	<a href="#ft" class="goFt"><span></span>브라우저 최하단으로 이동합니다</a>-->
</div>

<?php
if(G5_DEVICE_BUTTON_DISPLAY && G5_IS_MOBILE) { ?>
<a href="<?php echo get_device_change_url(); ?>" id="device_change">PC 버전으로 보기</a>
<?php
}

if ($config['cf_analytics']) {
    echo $config['cf_analytics'];
}
?>

<script>
$(function() {
    // 폰트 리사이즈 쿠키있으면 실행
    font_resize("container", get_cookie("ck_font_resize_rmv_class"), get_cookie("ck_font_resize_add_class"));
});
</script>


<?php
include_once(G5_THEME_PATH."/tail.sub.php");
?>