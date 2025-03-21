<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if(G5_COMMUNITY_USE === false) {
    include_once(G5_THEME_MSHOP_PATH.'/shop.tail.php');
    return;
}
?>
    </div>
</div>

<hr>

<?php echo poll('theme/basic'); // 설문조사 ?>

<hr>

<div id="ft">
    <?php echo popular('theme/basic'); // 인기검색어 ?>
    <?php echo visit('theme/basic'); // 방문자수 ?>
    <div id="ft_copy">
        <div id="ft_company">
            <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=company">회사소개</a>
            <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=privacy">개인정보취급방침</a>
            <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=provision">서비스이용약관</a>
        </div>
        Copyright &copy; <b>소유하신 도메인.</b> All rights reserved.<br>
        <a href="#">상단으로</a>
    </div>
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
<!-----Comodo SEAL Start---------->
<img src="https://www.ucert.co.kr/image/trustlogo/comodo_secure_113x59_white.png" width="113" height="59" align="absmiddle" border="0" style="cursor:pointer;" Onclick="javascript:window.open('https://www.ucert.co.kr/trustlogo/sseal_comodo.html?sealnum=fe49e3ce54c6b365&sealid=6ae438d732d97336d7e1d64f94454efb', 'mark', 'scrollbars=no, resizable=no, width=400, height=500');">
<!-----Comodo SEAL End---------->
<?php
include_once(G5_THEME_PATH."/tail.sub.php");
?>