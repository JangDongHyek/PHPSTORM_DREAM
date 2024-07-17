<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="' . $member_skin_url . '/style.css">', 0);
?>

<style>
	#ft{display:none;}
</style>

<div class="mbskin join_type">
	<div class="inr">
		<form name="fregister" id="fregister" action="<?php echo $register_action_url ?>" onsubmit="return fregister_submit(this);" method="POST" autocomplete="off">
			<h1 class="logo">
				<img src="<?php echo G5_THEME_IMG_URL ?>/app/logo2.svg" alt="PODOSEA">
				<span class="title_top"><strong class="point">회원가입</strong>을 환영합니다.</span>
			</h1>
			
			<div class="join_type cf">
						<div id="member1" onclick="add_class(this.id);" class="type client"><!--선택하면 일반회원 가입화면으로 넘어감-->
							<a href="<?php echo G5_BBS_URL ?>/register_form.php">
								<img alt="일반회원" src="<?php echo G5_THEME_IMG_URL ?>/app/icon_join01.svg">
								<div class="title">
									<span>조선, 해양 관련 어떤 것이든 <br>포도씨와 함께 소통하세요! </span>
								</div>
								<div class="btn_join">일반회원 가입하기</div>
							</a>
						</div>
						<div id="member2" onclick="add_class(this.id);" class="type client"><!--선택하면 기업회원 가입화면으로 넘어감-->
							<a href="<?php echo G5_BBS_URL ?>/register_company_form.php">
								<img alt="기업회원" src="<?php echo G5_THEME_IMG_URL ?>/app/icon_join02.svg">
								<div class="title">
									<span>기업홈피 + 온라인광고 + 고객연결까지 <br>포도씨에서 한번에 해결하세요</span>
								</div>
								<div class="btn_join">기업회원 가입하기</div>
							</a>
						</div>
			</div><!--join_type-->


		   <!-- <div class="btn_confirm">
				<input type="submit" class="btn_submit btn btn-primary btn-lg" value="가입신청하기">
			</div>-->

		</form>
	</div>
</div>

<script>
    function add_class(w){
        $('.type').removeClass('action');
        $('#'+w).addClass('action');
    }
</script>