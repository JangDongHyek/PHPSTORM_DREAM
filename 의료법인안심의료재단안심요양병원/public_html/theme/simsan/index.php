<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}
include_once(G5_THEME_PATH.'/head.php');
?>
<style>
	#fav_area{
		border: none;
	}
	#fav_area .fav {
		padding: 60px 0;
	}
</style>
<div id="idx_wrapper">
	<!--메인슬라이더 시작-->
	<div id="visual" class="wow fadeInDown animated">
		<div class="txt">
			<h6>the best of ansim hospital</h6>
			<h2>안심요양병원은 <br class="hidden-xs" />가족처럼 <strong class="color_blue">진심어린 정성</strong>으로 <br class="hidden-xs" />보살핍니다.</h2>
			<p>
				일반가정에서 케어하기 힘든 질환들의 완벽한 치료와 재활을 위해서는 꼼꼼한 선택이 필요합니다.<br class="hidden-xs" />
				안심요양병원을 만나시면 행복한 생활과 더 나은 내일을 향한 희망을 함께 할 수 있습니다.
			</p>
		</div>
		<ul class="sliderbx">
			<li class="mv01"></li>
			<li class="mv02"></li>
		</ul>
		<!--.sliderbx-->

		<div class="scrolldown">
			<a href="#content"><i class="fa-regular fa-chevron-down"></i>SCROLL DOWN</a>
		</div>
		<div id="notice">
			<h4>
				새소식을 전해드립니다.
				<a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=notice" class="btn_moreview">더보기<i class="fa-regular fa-plus"></i></a>
			</h4>
			<?php echo latest("theme/basic", "notice", 1, 30); ?>
		</div>


	</div><!-- //visual -->

</div><!--  #idx_wrapper -->
<div id="content">

	<div id="m_content01">
		<header>
			<p class="eng wow fadeInDown" data-wow-delay="0.1s">professional treatment methods</p>
			<h3 class="wow fadeInDown" data-wow-delay="0.3s">마음까지 치유하는 <span class="color_blue">안심요양병원 전문치료프로그램</span></h3>
			<p class="wow fadeInDown" data-wow-delay="0.4s">안심요양병원의 원칙이 환자분들의 신뢰를 얻을 수 있게 해준 가장 중요한 자산입니다.</p>
		</header>
		<div id="m_treat">
			<ul>
				<li class="wow fadeInUp" data-wow-delay="0.1s" onclick="location.href='<?php echo G5_BBS_URL ?>/content.php?co_id=intro02'" style="cursor: pointer;">
					<dl>
						<dt>내과</dt>
						<dd>
							고혈압,당뇨,협심증,심근경색,심부전<br class="hidden-xs" />
							신부전,암,심장질환, 간질환<br class="hidden-xs" />
							부정맥, 위장장애
						</dd>
						<dd class="more"></dd>
					</dl>
				</li>
				<li class="wow fadeInUp" data-wow-delay="0.3s" onclick="location.href='<?php echo G5_BBS_URL ?>/content.php?co_id=intro02'" style="cursor: pointer;">
					<dl>
						<dt>가정의학과</dt>
						<dd>
							호흡기 및 순환기질환<br class="hidden-xs" />
							신경계(뇌졸증, 뇌출혈 등) 질환<br class="hidden-xs" />
							관절 및 척추질환
						</dd>
						<dd class="more"></dd>
					</dl>
				</li>
				<li class="wow fadeInUp" data-wow-delay="0.7s" onclick="location.href='<?php echo G5_BBS_URL ?>/content.php?co_id=intro02'" style="cursor: pointer;">
					<dl>
						<dt>정형외과</dt>
						<dd>
							근골격계질환,류마티스 관절염<br class="hidden-xs" />
							어깨질환,만성통증<br class="hidden-xs" />
							골다공증, 강직성 척수염 등
						</dd>
						<dd class="more"></dd>
					</dl>
				</li>
				<li class="wow fadeInUp" data-wow-delay="0.9s" onclick="location.href='<?php echo G5_BBS_URL ?>/content.php?co_id=greet01'" style="cursor: pointer;">
					<dl>
						<dt>안심요양병원 소개</dt>
						<dd>
							부모님을 내 집처럼 편안하게 모실 수 있는 병원<br class="hidden-xs" />
							늘 환자의 입장에서 생각하고 실천하는<br class="hidden-xs" />
							안심요양병원이 되겠습니다.
						</dd>
						<dd class="more"></dd>
					</dl>
				</li>
			</ul>
		</div>
	</div>


	<div id="m_content03">
		<header>
			<p class="eng wow fadeInDown" data-wow-delay="0.1s">Medical TEAM</p>
			<h3 class="wow fadeInDown" data-wow-delay="0.3s">바르고 곧은 마음의 <span class="color_blue">안심요양병원 의료진</span></h3>
			<p class="wow fadeInDown" data-wow-delay="0.5s">정직한 진료로 환자의 마음까지 치료하겠습니다.</p>
			<a href="<?php echo G5_BBS_URL ?>/content.php?co_id=intro01" class="btn_more">의료진 바로가기<i class="fa-light fa-angle-right"></i></a>
		</header>
		<div class="area">
			<div class="doctors"><img src="<?php echo G5_THEME_IMG_URL ?>/main/m_doctors.png" alt="" class="imgWidth" /></div>
		</div>
	</div>
	
	<div id="m_content04">
		<div class="area">
			<ul>
				<li class="wow fadeInDown" data-wow-delay="0.1s">
					<h3>안심요양 병원소식 <span>news & notice</span></h3>
					<a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=news" class="btn_more">더보기 +</a>
				</li>
				<li class="wow fadeInDown" data-wow-delay="0.3s"><?php echo latest("theme/basic2", "news", 3, 25); ?></li>
			</ul>
		</div>
	</div>

	<div id="m_content05">
		<div class="grid_wrap">
			<div class="wow fadeInLeft cs" data-wow-delay="0.3s">
				<h2><span><strong>안심요양병원</strong> 고객센터</span></h2>
				<p>평일 : 09:00 - 18:00   점심 : 12:00 ~ 13:00  휴무 : 토,일, 공휴일</p>
				<h1>051.<span class="color_blue">865.0300</span></h1>
				<h6>Fax : 051-865-8822</h6>
				<h6>E-mail : ansimcure@hanmail.net</h6>
				<div class="btn_wrap">
					<a href="javascript:alert('준비중입니다.');" class="cs_ban ver1">상담예약<img src="<?php echo G5_THEME_IMG_URL ?>/main/ic01.png" alt=""></a>
					<a href="javascript:alert('준비중입니다.');" class="cs_ban ver2">자주묻는질문<img src="<?php echo G5_THEME_IMG_URL ?>/main/ic02.png" alt=""></a>
					<a href="javascript:alert('준비중입니다.');" class="cs_ban ver3"><img src="<?php echo G5_THEME_IMG_URL ?>/main/ic03.png" alt="">카톡 “안심요양병원”</a>
				</div>
			</div>
			<div class="wow fadeInRight health_info" data-wow-delay="0.3s">
				<h2>
					<span><strong>안심요양병원</strong> 건강상식</span>
					<span class="btn_moreview">더보기<i class="fa-regular fa-plus"></i></span>
				</h2>
				<?php echo latest("theme/health_info", "health_info", 8, 30); ?>
			</div>
		</div>
		
		
		<!--지도-->
		<div id="daumRoughmapContainer1673573324356" class="root_daum_roughmap root_daum_roughmap_landing wow fadeInDown" data-wow-delay="0.5s" style="width:100%"></div>
	</div>
</div>

<script charset="UTF-8" class="daum_roughmap_loader_script" src="https://ssl.daumcdn.net/dmaps/map_js_init/roughmapLoader.js"></script>
<script charset="UTF-8">
	new daum.roughmap.Lander({
		"timestamp": "1673573324356",
		"key": "2devx",
		"mapWidth": "100%",
		"mapHeight": "400"
	}).render();
</script>

<?php
include_once(G5_PATH.'/tail.php');
?>
