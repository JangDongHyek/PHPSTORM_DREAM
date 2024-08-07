<?php
include_once("./_common.php");
include_once(G5_THEME_PATH.'/head.sub.php');

if(!$is_pjax){
	include_once(G5_LIB_PATH.'/outlogin.lib.php');
}

set_session("intro", 1);

?>
<div id="intro">
<?php echo outlogin('theme/basic'); // 외부 로그인 ?>
</div>
<?php
include_once(G5_THEME_MOBILE_PATH.'/tail.php');
?>
<script>

window.Android.logout();


</script>