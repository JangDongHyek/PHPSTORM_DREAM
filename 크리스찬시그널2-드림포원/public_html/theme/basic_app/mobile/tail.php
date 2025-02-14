<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>
    </div>
</div>


<a onclick="location.href='https://pf.kakao.com/_aQMhG'" target="_blank" id="btn_kakao">
	<img src="<?php echo G5_THEME_IMG_URL; ?>/app/kakao.gif" alt="">
</a>

<?php if(basename($_SERVER["PHP_SELF"]) != 'register.php' && basename($_SERVER["PHP_SELF"]) != 'register_form.php' && basename($_SERVER["PHP_SELF"]) != 'register_result.php' && basename($_SERVER["PHP_SELF"]) != 'my_profile01.php' && basename($_SERVER["PHP_SELF"]) != 'my_profile02.php' && basename($_SERVER["PHP_SELF"]) != 'my_profile03.php' && basename($_SERVER["PHP_SELF"]) != 'my_profile_end.php') { ?>
<div id="ft">
	<div id="ft_menu">
    	<ul>
            <li <?php if(defined('_INDEX_')){ echo "class='on'"; } ?>>
                <a href="<?php echo G5_URL ?>/index.php">
                <img src="<?php echo G5_THEME_IMG_URL ?>/app/ft_icon01<?php if(defined('_INDEX_')){ echo "_on"; } ?>.png">
                <p>홈</p>
                </a>
            </li>
            <li <?php if($is_mypage == "mem_new"){ echo "class='on'"; } ?>>
                <a href="<?php echo G5_BBS_URL ?>/mem_new.php">
                <img src="<?php echo G5_THEME_IMG_URL ?>/app/ft_icon02<?php if($is_mypage == "mem_new"){ echo "_on"; } ?>.png">
                <p>전체회원</p>
                </a>
            </li>
            <li <?php if($is_mypage == "mem_love"){ echo "class='on'"; } ?>>
                <a href="<?php echo G5_BBS_URL ?>/mem_love.php">
                <img src="<?php echo G5_THEME_IMG_URL ?>/app/ft_icon03<?php if($is_mypage == "mem_love"){ echo "_on"; } ?>.png">
                <p>결제전회원</p>
                </a>
            </li>
            <li <?php if($is_mypage == "mypage"){ echo "class='on'"; } ?>>
                <a href="<?php echo G5_BBS_URL ?>/mypage.php">
                <img src="<?php echo G5_THEME_IMG_URL ?>/app/ft_icon04<?php if($is_mypage == "mypage"){ echo "_on"; } ?>.png">
                <p>마이페이지</p>
                </a>
            </li>
        	<li <?php if($bo_table == "inf"){ echo "class='on'"; } ?>>
                <a href="#hash-menu" id="hash_menu" data-role="button" data-url="<?php echo G5_PLUGIN_URL;?>/hash/" data-ref="1" data-animation="left">
                <img src="<?php echo G5_THEME_IMG_URL; ?>/app/ft_icon05.png" />
                <p>더보기</p>
                </a>
            </li>
        </ul>
    </div>
    <?php /*?><div id="ft_copy">
        <div id="ft_company">
            <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=company">회사소개</a>
            <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=privacy">개인정보취급방침</a>
            <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=provision">서비스이용약관</a>
        </div>
        Copyright &copy; <b>RIDERS</b> All rights reserved.<br>
    </div><?php */?>
</div>
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