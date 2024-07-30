<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>
    </div>
</div>

<!--고객용하단-->
<?php if ($member['mb_level'] == 2) {?>
<div id="ft">
	<div id="ft_menu">
    	<ul>
            <li <?php if(defined('_INDEX_')){ echo "class='on'"; } ?>>
                <a href="<?php echo G5_URL ?>/index.php">
                <img src="<?php echo G5_THEME_IMG_URL ?>/app/ft_icon01<?php if(defined('_INDEX_')){ echo "_on"; } ?>.png">
                <p>홈</p>
                </a>
            </li>
        	<li <?php if($bo_table == "inf"){ echo "class='on'"; } ?>>
                <a href="#hash-menu" id="hash_menu" data-role="button" data-url="<?php echo G5_PLUGIN_URL;?>/hash/" data-ref="1" data-animation="left">
                <img src="<?php echo G5_THEME_IMG_URL; ?>/app/ft_icon02.png" />
                <p>카테고리</p>
                </a>
            </li>
            <li <?php if($is_mypage == "my_reser"){ echo "class='on'"; } ?>>
                <a href="<?php echo G5_BBS_URL ?>/my_reser.php">
                <img src="<?php echo G5_THEME_IMG_URL ?>/app/ft_icon05<?php if($is_mypage == "my_reser"){ echo "_on"; } ?>.png">
                <p>예약현황</p>
                </a>
            </li>
            <li <?php if($is_mypage == "mypage"){ echo "class='on'"; } ?>>
                <a href="<?php echo G5_BBS_URL ?>/mypage.php">
                <img src="<?php echo G5_THEME_IMG_URL ?>/app/ft_icon04<?php if($is_mypage == "mypage"){ echo "_on"; } ?>.png">
                <p>마이페이지</p>
                </a>
            </li>
        </ul>
    </div>
</div><!--고객용하단-->
<?php } ?>


<!--매니저용 하단-->
<?php if ($member['mb_level'] >= 3) {?>
<div id="ft">
	<div id="ft_menu_manager">
    	<ul>
            <!--<li <?php if(defined('_INDEX_')){ echo "class='on'"; } ?>>
                <a href="<?php echo G5_URL ?>/index.php">
                <img src="<?php echo G5_THEME_IMG_URL ?>/app/ft_icon01<?php if(defined('_INDEX_')){ echo "_on"; } ?>.png">
                <p>홈</p>
                </a>
            </li>-->
        	<li <?php if($bo_table == "inf"){ echo "class='on'"; } ?>>
                <!--<a href="#hash-menu" id="hash_menu" data-role="button" data-url="<?php echo G5_PLUGIN_URL;?>/hash/" data-ref="1" data-animation="left">-->
                <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=notice_manager">
                <img src="<?php echo G5_THEME_IMG_URL; ?>/app/ft_icon02_manager<?php if($is_mypage == "my_order"){ echo "_on"; } ?>.png" />
                <p>공지/전달</p>
                </a>
            </li>
            <li <?php if($is_mypage == "my_order"){ echo "class='on'"; } ?>>
                <a href="<?php echo G5_BBS_URL ?>/my_order.php">
                <img src="<?php echo G5_THEME_IMG_URL ?>/app/ft_icon05<?php if($is_mypage == "my_order"){ echo "_on"; } ?>.png">
                <p>작업현황</p>
                </a>
            </li>
            <li <?php if($is_mypage == "mypage"){ echo "class='on'"; } ?>>
                <a href="<?php echo G5_BBS_URL ?>/mypage_manager.php">
                <img src="<?php echo G5_THEME_IMG_URL ?>/app/ft_icon04<?php if($is_mypage == "mypage"){ echo "_on"; } ?>.png">
                <p>마이페이지</p>
                </a>
            </li>
        </ul>
    </div>
</div>
<!--매니저용 하단-->
<?php } ?>



<?php
if(G5_DEVICE_BUTTON_DISPLAY && G5_IS_MOBILE) { ?>
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