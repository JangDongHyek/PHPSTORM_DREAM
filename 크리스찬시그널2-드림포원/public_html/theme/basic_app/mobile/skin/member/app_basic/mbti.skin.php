<?php
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
//add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
?>
<style>
	#container img{
		display: block;
		width: 100%;
	}
	.btn_mbti {
		display: table;
		color: #fff !important;
		background: #fe8ea6;
		font-size: 1.1em;
		font-weight: 600;
		border-radius: 15px;
		padding: 5px 15px;
		margin: 25px auto 55px;
	}
</style>
<img src="<?php echo G5_THEME_IMG_URL; ?>/app/mbti01.png" alt="">
<img src="<?php echo G5_THEME_IMG_URL; ?>/app/mbti02.png" alt="">

<div onclick="location.href='http://naver.me/GqHhrGVp'">
    <a class="btn_mbti" href="http://naver.me/GqHhrGVp" target="_blank">내 MBTI 알아보기 <i class="fas fa-arrow-right"></i></a>
</div>
