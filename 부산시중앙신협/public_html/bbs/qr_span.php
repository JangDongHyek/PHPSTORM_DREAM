<? 
include_once("./_common.php");

$g5['title'] = 'QR코드 스캔';
$pid = "qr_span";
include_once('./_head.php');

if(!$is_member){
	goto_url(G5_URL."/bbs/login.php");
}

if($member[mb_level] < 8){
	alert("관리자만 접근 가능합니다.", G5_URL."/bbs/logout.php");
}

if($is_app == false){
	alert("잘못된 접근입니다.", G5_URL."/bbs/logout.php");
}

?>
<link rel="stylesheet" href="<?=G5_BBS_URL?>/style.css?v=<?=G5_CSS_VER?>">
<style>
	body,
	#container,
	.btm_nav_box{
		background: #F2F2F2;
	}
</style>

<div class="autoW bdpd text-center">
    <div id="qr_span" class="">
		<div class="con_wrap">
			<img src="<?php echo G5_THEME_IMG_URL ?>/common/qr_img.png?v=<?=G5_CSS_VER?>" alt="">
		</div>
    </div>
</div>
</div>
<script>

</script>

<?php
include_once('./_tail.php');
?>
