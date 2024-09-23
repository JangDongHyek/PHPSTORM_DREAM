<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/tail.php');
    return;
}
?>

			</div>
			<!--#scont-->
		</div>
		<!--#scont_wrap-->
	<? if(defined('_INDEX_')) {?>
	<!--메인컨테이너 부분-->
	</div>
	<!--#container_index-->
	<? } else  { ?>
	<!--서브컨테이너 부분-->
	</div>
	<!--#container-->
	<? } ?>
</div>

<!-- } 콘텐츠 끝 -->

<hr>

	<? if($pid == 'event6' || $pid == 'rent6') {?>


<div id="footer" class="openNav">
	<div class="ft_wrap">
		<div class="ft_info">

			<address>
			<img src="<?php echo G5_THEME_IMG_URL ?>/common/logo.svg">
				<h1>도운스페이스</h1>
				<div class="first">
					<span>서울특별시 강남구 논현로152길 9, 6층</span>
				</div>
				<div class="first">
					<span>9 Nonhyeon-ro 152-gil, Gangnam-gu, Seoul</span>
				</div>
				<div class="first">
					<p>사업자등록번호:</p>
					<span>177-85-02305</span>
				</div>
				<div class="first">
					<p>대표자:</p>
					<span>마승철</span>
				</div>
				<div class="first">
					<p>Instargram:</p>
					<span>@the_dowoon</span>
				</div>
                <div class="first">
                    <p>대표전화:</p>
                    <span>02-547-1522 / 02-543-1529</span>
                </div>
				<p class="copy">
					COPYRIGHT(c) 2023 <strong><?php echo $config['cf_title']; ?>.</strong> ALL RIGHTS RESERVED.
					
					<?php if ($is_admin) {  ?>
					<a class="btn_adm" href="<?php echo G5_BBS_URL ?>/logout.php"><i class="fa fa-unlock"></i> </a>
					<a class="btn_adm" href="<?php echo G5_URL ?>/adm"> <i class="fas fa-cog"></i> <strong>관리자</strong></a>
					<?php } else {  ?>
					<a class="btn_adm" href="<?php echo G5_BBS_URL ?>/login.php"><i class="fa fa-lock"></i></a>
					<?php }  ?>
				</p>
			</address>
		</div>
		<div class="ft_sns">
			<a href="https://www.instagram.com/the_dowoon/" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/common/ft_sns3.png"></a>
            <a href="https://blog.naver.com/the_dowoon " target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/common/ft_sns1.png"></a>
			<a href="http://pf.kakao.com/_mwxcMG/friend" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/common/ft_sns4.png"></a>
			
		</div>
		<div class="ft_family">
			<div class="ft_pop_down">
				<span class="title">FAMILY SITE</span>
				<ul>
					<li><a href="https://www.naracellar.com/" target="_blank">나라셀라</a></li>
					<li><a href="https://www.1kmwine.io/" target="_blank">와인원 (1KMWINE) </a></li>
					<li><a href="https://korii.kr/" target="_blank">RESTAURANT KORII </a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="scrolltop">
		<a href="#hd" class="goHd">
			<img src="<?php echo G5_THEME_IMG_URL ?>/common/ic_up.svg" alt="">
		</a>
	</div>
</div>
<!--#footer-->


	<? } else  { ?>


<div id="footer" class="openNav">
	<div class="ft_wrap">
		<div class="ft_info">

			<address>
			<img src="<?php echo G5_THEME_IMG_URL ?>/common/logo.svg">
				<h1>나라셀라(주) 도운점</h1>
				<div class="first">
					<span>서울특별시 강남구 논현로152길 9, 1~7층, 지하2층(신사동, 도운빌딩)</span>
				</div>
				<div class="first">
					<span>9 Nonhyeon-ro 152-gil, Gangnam-gu, Seoul</span>
				</div>
				<div class="first">
					<p>사업자등록번호:</p>
					<span>141-85-22170</span>
				</div>
				<div class="first">
					<p>대표자:</p>
					<span>마승철</span>
				</div>
				<div class="first">
					<p>Instargram:</p>
					<span>@the_dowoon</span>
				</div>
                <div class="first">
                    <p>대표전화:</p>
                    <span>02-547-1522 / 02-543-1529</span>
                </div>
				<p class="copy">
					COPYRIGHT(c) 2023 <strong><?php echo $config['cf_title']; ?>.</strong> ALL RIGHTS RESERVED.
					
					<?php if ($is_admin) {  ?>
					<a class="btn_adm" href="<?php echo G5_BBS_URL ?>/logout.php"><i class="fa fa-unlock"></i> </a>
					<a class="btn_adm" href="<?php echo G5_URL ?>/adm"> <i class="fas fa-cog"></i> <strong>관리자</strong></a>
					<?php } else {  ?>
					<a class="btn_adm" href="<?php echo G5_BBS_URL ?>/login.php"><i class="fa fa-lock"></i></a>
					<?php }  ?>
				</p>
			</address>
		</div>
		<div class="ft_sns">
			<a href="https://www.instagram.com/the_dowoon/" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/common/ft_sns3.png"></a>
            <a href="https://blog.naver.com/the_dowoon " target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/common/ft_sns1.png"></a>
			<a href="http://pf.kakao.com/_mwxcMG/friend" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/common/ft_sns4.png"></a>
			
		</div>
		<div class="ft_family">
			<div class="ft_pop_down">
				<span class="title">FAMILY SITE</span>
				<ul>
					<li><a href="https://www.naracellar.com/" target="_blank">나라셀라</a></li>
					<li><a href="https://www.1kmwine.io/" target="_blank">와인원 (1KMWINE) </a></li>
					<li><a href="https://korii.kr/" target="_blank">RESTAURANT KORII </a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="scrolltop">
		<a href="#hd" class="goHd">
			<img src="<?php echo G5_THEME_IMG_URL ?>/common/ic_up.svg" alt="">
		</a>
	</div>
</div>
<!--#footer-->


	<? } ?>



<script type="text/javascript">
	//리스트 슬라이드
	$(".ft_pop_down > .title").click(function(){
	   $(this).parent().children('ul').slideToggle('fast');
	   $(this).toggleClass('on');
	});	
</script>
	
<script>
	$(function() {
		// 폰트 리사이즈 쿠키있으면 실행
		font_resize("container", get_cookie("ck_font_resize_rmv_class"), get_cookie("ck_font_resize_add_class"));
	});

</script>

<?php
include_once(G5_PATH."/tail.sub.php");
?>
