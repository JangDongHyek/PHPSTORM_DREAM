<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

include_once(G5_THEME_PATH.'/head.php');
?>



	<div class="mainWrap w1200">
		<div class="textBox"  data-aos="fade-down" >
			<p class="title" ><img src="<?php echo G5_THEME_IMG_URL ?>/main/main_tit.png" alt="똑똑한 선택! 즐거운 여행!"></p>
			<p>최상의 서비스로 감동을 드립니다.</p>
		</div>
		<ul class="mainCont">
			<li data-aos="fade-up">
				<h2>신차 장기 <br>렌트 서비스 <p>견적은 정확하게 <br>계약은 쉽게!</p></h2>
				<p>
					<a href="<?php echo G5_BBS_URL ?>/content.php?co_id=rent_new">신차 장기렌트 서비스</a>
					<a href="<?php echo G5_BBS_URL ?>/write.php?bo_table=reserve&ca_name=신차 장기렌트">예약하기</a>
				</p>
			</li>
			<li data-aos="fade-up" data-aos-delay="100">
				<h2>무심사 <br>중고차 렌트<p>기다림없이! <br>빠른 렌트카 대여!</p></h2>
				<p>
					<a href="<?php echo G5_BBS_URL ?>/content.php?co_id=rent_old">중고차 렌트서비스</a>
					<a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=rent_old_sch">중고차 검색</a>
					<a href="<?php echo G5_BBS_URL ?>/write.php?bo_table=reserve&ca_name=무심사 중고차렌트">예약하기</a>
				</p>
			</li>
			<li data-aos="fade-up" data-aos-delay="200">
				<h2>단기 대여 <br>서비스 <p>더욱 가볍게! <br>빠른 실시간 예약</p></h2>
				<p>
					<a href="<?php echo G5_BBS_URL ?>/rent_pay.php">대여요금</a>
					<a href="<?php echo G5_BBS_URL ?>/content.php?co_id=rent_acc">사고대차 서비스</a>
					<a href="<?php echo G5_BBS_URL ?>/write.php?bo_table=reserve&ca_name=단기대여 서비스">예약하기</a>
				</p>
			</li>
			<li data-aos="fade-up" data-aos-delay="300">
				<h2>고객지원 <br>센터 <p>친절한 상담과 <br>답변을 약속드립니다.</p></h2>
				<p><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=customer">고객센터</a></p>
			</li>
		</ul>
	</div>
	<!-- /mainWrap -->


<?php
include_once(G5_PATH.'/tail.php');
?>