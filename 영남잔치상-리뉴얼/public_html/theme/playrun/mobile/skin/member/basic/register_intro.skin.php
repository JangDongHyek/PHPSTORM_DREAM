<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>

<div class="mbskin">
	<div class="area_join">
		<a class="join" href="<?php echo G5_BBS_URL ?>/register.php">쇼핑몰 회원가입</a>
		<div class="sns_join">
		<h3>SNS계정 간편 회원가입</h3>
			<p> 
				SNS계정을 연동하여 빠르고 쉽고 안전하게 회원가입 할 수 있습니다.<br>
				이 과정에서 고객님의 데이터는 철저하게 보호됩니다.
			</p>
			<?php
			// 소셜로그인 사용시 소셜로그인 버튼
			include_once(get_social_skin_path().'/social_login.skin.php');
			?>
		</div>
		<div class="join_question">
			<p> 이미 쇼핑몰 회원이세요?</p>
			<a href="<?php echo G5_BBS_URL; ?>/login.php"><span>로그인</span></a>
		</div>
	</div>
</div>