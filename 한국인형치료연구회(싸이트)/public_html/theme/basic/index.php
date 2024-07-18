<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

include_once(G5_THEME_PATH.'/head.php');
?>


<!--
<div id="idx_wrapper">
    <!--메인슬라이더 시작
    <div id="visual" class="wow fadeIn animated">

        <ul class="sliderbx">
        	<li class="mv01">
				<div id="slogan">
					<span>Korea Association of Figure Theraphy </span>
					<h2>Counseling & Psycotherapy</h2>
				</div>
			</li>
        	<li class="mv02">
				<div id="slogan">
					<h2>인형치료</h2>
					<p>무의식을 표현해주는 동물인형과 의식의 내용을 전달하는 <br>
					가족인형을 통해 내담자 자신의 치료적 은유를 표현하도록 합니다.</p>
				</div>
			</li>
        	<li class="mv03">
				<div id="slogan">
					<h2>인형치료 연구 논문<br>투고를 받습니다.</h2>
					<em>학회지 편집규정 및 원고작성요령을 참고해주세요.</em>
				</div>
			</li>
        </ul><!--.sliderbx
    </div><!-- //visual
</div><!--  #idx_wrapper -->


<div id="content">
	<div class="area_quick">
		<div class="inr">
			<div class="quick_title">
				<h2>Quick</h2>
				<span>퀵메뉴바로가기</span>
			</div>
			<ul class="quick_list">
				<li>
					<a href="<?php echo G5_BBS_URL ?>/content.php?co_id=academy01">
						<span></span>
						<h3>학회장인사말</h3>
					</a>
				</li>
				<li>
					<a href="<?php echo G5_BBS_URL ?>/content.php?co_id=intro">
						<span></span>
						<h3>인형치료소개</h3>
					</a>
				</li>
				<li>
					<a href="<?php echo G5_BBS_URL ?>/content.php?co_id=academy03">
						<span></span>
						<h3>학회조직도</h3>
					</a>
				</li>
				<li>
					<a href="<?php echo G5_BBS_URL ?>/content.php?co_id=location">
						<span></span>
						<h3>오시는길</h3>
					</a>
				</li>
				<li>
					<a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=edu&sca=인형상담심리상담사+2급과정">
						<span></span>
						<h3>교육접수</h3>
					</a>
				</li>
				<li>
					<a href="<?php echo G5_BBS_URL ?>/content.php?co_id=research01">
						<span></span>
						<h3>자격과정안내</h3>
					</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="area_bn">

			<ul class="bn_list">
				<li>
					<a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=academy">
						<div class="area_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/img_bn04.jpg"></div>
						<div class="area_txt">
							<span>Workshop/Conference</span>
							<h3>워크숍/학술대회</h3>
						</div>
					</a>
				</li>
				<li>
					<a href="<?php echo G5_BBS_URL ?>/content.php?co_id=academy01">
						<div class="area_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/img_bn01.jpg"></div>
						<div class="area_txt">
							<span>Korean Association of Figure Therapy</span>
							<h3>한국인형치료학회</h3>
						</div>
					</a>
				</li>
				<li>
					<a href="<?php echo G5_BBS_URL ?>/content.php?co_id=research01">
						<div class="area_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/img_bn02.jpg"></div>
						<div class="area_txt">
							<span>Korean Association of Figure Therapy</span>
							<h3>한국인형치료연구회</h3>
						</div>
					</a>
				</li>
				<li>
					<a href="<?php echo G5_BBS_URL ?>/content.php?co_id=aspt01">
						<div class="area_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/img_bn03.jpg"></div>
						<div class="area_txt">
							<span> Animal Symbol Personality Type</span>
							<h3>동물상징성격유형검사(ASPT)</h3>
						</div>
					</a>
				</li>
				<li>
					<a href="https://kaft.jams.or.kr" target="_blank">
						<div class="area_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/img_bn05.jpg"></div>
						<div class="area_txt">
							<h3 class="title">인형치료연구</h3>
							<h3>서류 제출 바로가기</h3>
						</div>
					</a>
				</li>
			</ul>

	</div>

	<div class="area_board">
		<div class="inr">

			<div class="area_notice">
				 <?php echo latest("theme/basic", "notice",3, 23); ?>
			</div>
			<div class="area_gallery">
				 <?php echo latest("theme/gallery3", "gallery",10, 23); ?>
			</div>

			<!--
			<div class="area_bn">
				<ul class="bn_list">
					<li>
						<a href="<?php echo G5_BBS_URL ?>/content.php?co_id=academy01">
							<div class="area_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/img_bn01.jpg"></div>
							<div class="area_txt">
								<span>Korean Association of Figure Therapy</span>
								<h3>한국인형치료학회</h3>
							</div>
						</a>
					</li>
					<li>
						<a href="<?php echo G5_BBS_URL ?>/content.php?co_id=research01">
							<div class="area_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/img_bn02.jpg"></div>
							<div class="area_txt">
								<span>Korean Association of Figure Therapy</span>
								<h3>한국인형치료연구회</h3>
							</div>
						</a>
					</li>
					<li>
						<a href="<?php echo G5_BBS_URL ?>/content.php?co_id=aspt01">
							<div class="area_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/img_bn03.jpg"></div>
							<div class="area_txt">
								<span> Animal Symbol Personality Type</span>
								<h3>동물상징성격유형검사(ASPT)</h3>
							</div>
						</a>
					</li>
				</ul>
			</div>

			-->
		</div>
	</div>

</div>



<?php
include_once(G5_PATH.'/tail.php');
?>
