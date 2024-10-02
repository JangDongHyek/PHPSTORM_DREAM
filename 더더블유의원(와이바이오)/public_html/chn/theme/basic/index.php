<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

include_once(G5_THEME_PATH.'/head.php');

?>

<div id="idx_wrapper">
    <!--메인슬라이더 시작-->
    <div id="visual" class="wow fadeIn animated" data-wow-delay="0.2s" data-wow-duration="0.8s">
        <ul class="sliderbx">
        	<li class="mv01">
				<video autoplay controls loop playsinline muted width="100%">

					<source src="<?php echo G5_THEME_IMG_URL ?>/main/mvisual01.mp4"
							type="video/mp4">

					Sorry, your browser doesn't support embedded videos.
				</video>
			
			</li>
        	<li class="mv02"><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=greet01"></a></li>
			<li class="mv03"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=story"></a></li>
        	<li class="mv04"><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=s4_01"></a></li>
        	<li class="mv05"></li>
        	<li class="mv06"><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=greet03"></a></li>
        </ul><!--.sliderbx-->
    </div><!-- //visual -->
</div><!--  #idx_wrapper -->



<div id="insta_area">
	<div class="mtit">
		<h3><span class="fc-b">R</span>EAL <span class="fc-b">S</span>TORY</h3>
	</div>
	<div class="in">
			<span class="tit wow fadeIn animated" data-wow-delay="0.4s" data-wow-duration="0.6s">
            	<a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=story"><strong><img src="<?php echo G5_THEME_IMG_URL ?>/main/real_txt.jpg" /></strong></a>
            </span>
			<div class="area_bg wow fadeInUp animated" data-wow-delay="0.2s" data-wow-duration="0.8s">
				<img class="w" src="<?php echo G5_THEME_IMG_URL ?>/main/bg_real.jpg" />
				<img class="m" src="<?php echo G5_THEME_IMG_URL ?>/main/m_bg_real.jpg" />
			
			</div>
		<!--
        <ul class="gal cf">
        	
			
        	<li class="wow fadeInUp animated" data-wow-delay="0.2s" data-wow-duration="0.4s"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=story"><img src="<?php echo G5_THEME_IMG_URL ?>/main/photo01.jpg" /><div class="bg"></div></a></li>
            <li class="wow fadeInDown animated" data-wow-delay="0.4s" data-wow-duration="0.4s"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=story"><img src="<?php echo G5_THEME_IMG_URL ?>/main/photo02.jpg" /><div class="bg"></div></a></li>
            <li class="wow fadeInUp animated" data-wow-delay="0.6s" data-wow-duration="0.4s"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=story"><img src="<?php echo G5_THEME_IMG_URL ?>/main/photo03.jpg" /><div class="bg"></div></a></li>
            <li class="wow fadeInUp animated" data-wow-delay="0.8s" data-wow-duration="0.4s"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=story"><img src="<?php echo G5_THEME_IMG_URL ?>/main/photo04.jpg" /><div class="bg"></div></a></li>            
            <li class="wow fadeInDown animated" data-wow-delay="1s" data-wow-duration="0.4s"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=story"><img src="<?php echo G5_THEME_IMG_URL ?>/main/photo05.jpg" /><div class="bg"></div></a></li>
            <li class="wow fadeInDown animated" data-wow-delay="1.4s" data-wow-duration="0.4s"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=story"><img src="<?php echo G5_THEME_IMG_URL ?>/main/photo06.jpg" /><div class="bg"></div></a></li>
            <li class="wow fadeInUp animated" data-wow-delay="1.2s" data-wow-duration="0.4s"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=story"><img src="<?php echo G5_THEME_IMG_URL ?>/main/photo07.jpg" /><div class="bg"></div></a></li>
            <li class="wow fadeInUp animated" data-wow-delay="1.6s" data-wow-duration="0.4s"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=story"><img src="<?php echo G5_THEME_IMG_URL ?>/main/photo08.jpg" /><div class="bg"></div></a></li>
            <li class="wow fadeInUp animated" data-wow-delay="1.8s" data-wow-duration="0.4s"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=story"><img src="<?php echo G5_THEME_IMG_URL ?>/main/photo09.jpg" /><div class="bg"></div></a></li>
            <li class="wow fadeInUp animated" data-wow-delay="2s" data-wow-duration="0.4s"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=story"><img src="<?php echo G5_THEME_IMG_URL ?>/main/photo10.jpg" /><div class="bg"></div></a></li>
        </ul>
		-->
    </div>
</div><!--insta_area-->


<!--
<div id="m_bg">
    <div id="atc01_wrap">
        <div class="m_01 m01 wow fadeInUp animated" data-wow-delay="0.2s" data-wow-duration="0.8s">
            <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=s3_01">   
				<div class="dg"><img src="<?php echo G5_THEME_IMG_URL ?>/main/dg01.jpg" title=""></div>
                <div class="plus"></div>
            	<p class="more">VIEW</p>       
                <div class="txt">
                    <p class="sh_tit">가슴성형센터</p>
                    더 더블유의원 대표원장님이 직접 수술집도합니다.
                </div>
            </a>
        </div>
        <div class="m_01 m02 wow fadeInUp animated" data-wow-delay="0.6s" data-wow-duration="0.8s">
            <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=s3_02">
				<div class="dg"><img src="<?php echo G5_THEME_IMG_URL ?>/main/dg02.jpg" title=""></div>
                <div class="plus"></div>  
            	<p class="more">VIEW</p>        
                <div class="txt">
                    <p class="sh_tit">모티바 나노가슴성형</p>
                    가장 자연스러운 가슴을 선물합니다.
                </div>
            </a>
        </div>  
        <div class="m_01 m03 wow fadeInUp animated" data-wow-delay="0.4s" data-wow-duration="0.8s">
            <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=s3_03"> 
                <div class="dg"><img src="<?php echo G5_THEME_IMG_URL ?>/main/dg03.jpg" title=""></div>
                <div class="plus"></div>    
                <p class="more">VIEW</p>  
                <div class="txt">
                    <p class="sh_tit">멘토가슴성형</p>
                    내 몸에 가장 어울리는 자연스러운 가슴핏
                </div>
            </a>
        </div>
        <div class="m_01 m01 wow fadeInUp animated" data-wow-delay="1s" data-wow-duration="0.8s">
            <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=s3_04">
				<div class="dg"><img src="<?php echo G5_THEME_IMG_URL ?>/main/dg04.jpg" title=""></div> 
                <div class="plus"></div>  
            	<p class="more">VIEW</p>  
                <div class="txt">
                    <p class="sh_tit">세빈프리미엄 가슴성형</p>
                    선택의 폭이 넓어진 BASE로 아름다운 맞춤형 가슴을 만들어 드립니다.
                </div>
            </a>
        </div>
        <div class="m_01 m02 wow fadeInUp animated" data-wow-delay="0.8s" data-wow-duration="0.8s">
            <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=s3_05">
				<div class="dg"><img src="<?php echo G5_THEME_IMG_URL ?>/main/dg05.jpg" title=""></div>
                <div class="plus"></div>
            	<p class="more">VIEW</p>             
                <div class="txt">
                    <p class="sh_tit">마이크로텍스쳐 가슴성형</p>
                    내 것 같이 자연스럽고 말랑말랑 기분좋은 촉감
                </div>
            </a>
        </div>  
        <div class="m_01 m03 wow fadeInUp animated" data-wow-delay="1.2s" data-wow-duration="0.8s">
            <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=s3_06"> 
				<div class="dg"><img src="<?php echo G5_THEME_IMG_URL ?>/main/dg06.jpg" title=""></div>
                <div class="plus"></div> 
                <p class="more">VIEW</p>   
                <div class="txt">
                    <p class="sh_tit">가슴축소</p>
                    적절한 크기와 모양을 만들어 드립니다.
                </div>
            </a>
        </div>
    </div><!--atc01_wrap
</div><!--m_bg
-->





<div id="big_ban" class="wow fadeInUp animated" data-wow-delay="0.2s" data-wow-duration="0.8s" style="visibility: visible; animation-duration: 0.8s; animation-delay: 0.2s; animation-name: fadeInUp;">
	<div class="mtit">
		<h3>THE <span class="fc-b">W</span> STORY</h3>
	</div>	    
	<div class="swiper mySwiper wow fadeIn animated" data-wow-delay="0.2s" data-wow-duration="0.8s">
		<div class="swiper-button-next"></div>
		<div class="swiper-button-prev"></div>
		<div class="swiper-wrapper">
			<div class="swiper-slide">
				<a href="<?php echo G5_BBS_URL ?>/content.php?co_id=s3_01">
					<div class="area_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/bn01.jpg" alt=""></div>
					<div class="area_txt">
						<h3>胸部整形</h3>
						<span>与众不同的技术和丰富的经验 <br>满意度高的手术结果</span>
						<div class="btn_more"><span>MORE</span></div>
					</div>
				</a>
			</div>
			<div class="swiper-slide">
				<a href="<?php echo G5_BBS_URL ?>/content.php?co_id=s4_01">
					<div class="area_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/bn02.jpg" alt=""></div>
					<div class="area_txt">
						<h3>胸部修复手术</h3>
						<span>今生最后的乳房手术</span>
						<div class="btn_more"><span>MORE</span></div>
					</div>
				</a>
			</div>
			<div class="swiper-slide">
				<a href="<?php echo G5_BBS_URL ?>/content.php?co_id=s7_01">
					<div class="area_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/bn03.jpg" alt=""></div>
					<div class="area_txt">
						<h3>女乳症</h3>
						<span>同时进行乳腺切除术和吸脂术 <br>对女乳症进行切实治疗</span>
						<div class="btn_more"><span>MORE</span></div>
					</div>
				</a>
			</div>
			<div class="swiper-slide">
				<a href="<?php echo G5_BBS_URL ?>/content.php?co_id=s6_01">
					<div class="area_img line"><img src="<?php echo G5_THEME_IMG_URL ?>/main/bn04.jpg" alt=""></div>
					<div class="area_txt">
						<h3>乳房再造</h3>
						<span>由乳房专家亲自治疗</span>
						<div class="btn_more"><span>MORE</span></div>
					</div>
				</a>
			</div>
			<div class="swiper-slide">
				<a href="<?php echo G5_BBS_URL ?>/content.php?co_id=s1_01">
					<div class="area_img line"><img src="<?php echo G5_THEME_IMG_URL ?>/main/bn05.jpg" alt=""></div>
					<div class="area_txt">
						<h3>麦默通</h3>
						<span>通过小切口安全舒适</span>
						<div class="btn_more"><span>MORE</span></div>
					</div>
				</a>
			</div>
		</div>
		
	</div>	
</div>


<script>
  var swiper = new Swiper(".mySwiper", {
	slidesPerView: 3,
	spaceBetween: 50,
	navigation: {
	  nextEl: ".swiper-button-next",
	  prevEl: ".swiper-button-prev",
	},
  breakpoints: {
	200: {
		slidesPerView: 1,
		spaceBetween: 0,
	  },
	450: {
		slidesPerView: 2,
		spaceBetween: 10,
	  },
	550: {
		slidesPerView: 2,
		spaceBetween: 15,
	  },
	768: {
		slidesPerView: 2,
		spaceBetween: 20,
	  },
	 1024: {
		slidesPerView: 3,
		spaceBetween: 30,
	  },
	1400: {
		slidesPerView: 3,
		spaceBetween: 50,
	  },
	},
  });
</script>


<div id="mClinic">
  <div class="mtit">
    <h3><span class="fc-b">THE W</span> CLINIC</h3>
  </div>
  <div id="mClinic1" class="box1 wow fadeInLeft animated" data-wow-delay="0.2s" data-wow-duration="0.8s">
    <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=s1_04">
      <div class="txt">
        <h4><span>乳房癌</span>检查</h4>
        <p>乳腺癌的早期发现是最好的预防 <br>通过定期检查，让乳房变得健康</p>
        <div class="more"><span>MORE<br> VIEW</span></div>
      </div>
    </a>
  </div>
  <div id="mClinic2" class="box1 wow fadeInRight animated" data-wow-delay="0.6s" data-wow-duration="0.8s">
    <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=s2_01">
      <div class="txt">
        <h4><span>假体</span>特殊检查</h4>
        <p>专为区分乳房假体和相关并发症和诊断 <br>间变性大细胞淋巴瘤进行的假体特殊检查</p>
        <div class="more"><span>MORE<br> VIEW</span></div>
      </div>
    </a>
  </div>
  <!--
  <div id="mClinic3" class="box2 wow fadeInUp animated" data-wow-delay="1.0s" data-wow-duration="0.8s">
    <a href="#">
      <div class="txt">
        <h4><span>체형성형</span>클리닉</h4>
        <p>풍부한 수술경험과 첨단장비로 매끈하고 <br class="visible-xs" />균형잡힌 바디라인을 만들어 드립니다.</p>
        <div class="more"><span>MORE<br> VIEW</span></div>
      </div>
    </a>
  </div>
  -->
</div>




<div id="mIntro">
  <div class="mtit wow fadeIn animated" data-wow-delay="0.2s" data-wow-duration="0.8s" >
    <h3>ACADEMIC ACTIVITY</h3>
  </div>
  <div class="swiper academySwiper wow fadeIn animated" data-wow-delay="0.4s" data-wow-duration="0.8s">

		<div class="swiper-wrapper">
			<div class="swiper-slide">
				<a href="https://link.springer.com/article/10.1007%2Fs00266-021-02701-w" target="_blank">
					<div class="area_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/academy08.jpg" alt=""></div>
					<div class="area_txt">
						<h3>2022.01.13</h3>
						<span>无症状患者的乳房假体检查及 <br>利用超声波鉴别假体的研究 </span>
						<em>通讯作者</em>
					</div>
				</a>
			</div>
			<div class="swiper-slide">
				<a href="https://academic.oup.com/asjopenforum/article/doi/10.1093/asjof/ojab046/6424352" target="_blank">
					<div class="area_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/academy09.jpg" alt=""></div>
					<div class="area_txt">
						<h3>2021.11.09</h3>
						<span>魔滴乳房假体3年安全性研究</span>
						<em>通讯作者</em>
					</div>
				</a>
			</div>
			<div class="swiper-slide">
				<a href="https://link.springer.com/article/10.1007%2Fs00266-021-02544-5" target="_blank">
					<div class="area_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/academy10.jpg" alt=""></div>
					<div class="area_txt">
						<h3>2021.08.30</h3>
						<span>为了诊断包膜挛缩，测量皮膜厚度的 <br>超声波研究:关于与Baker grade的相关关系   </span>
						<em>通讯兼第一作者</em>
					</div>
				</a>
			</div>
			<div class="swiper-slide">
				<a href="https://www.sciforschenonline.org/journals/surgery-open-access/JSOA236.php" target="_blank">
					<div class="area_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/academy01.jpg" alt=""></div>
					<div class="area_txt">
						<h3>2021.04.30</h3>
						<span>关于硅胶假体包膜外破裂 <br>引发硅胶瘤的病例报告</span>
						<em>通讯兼独立作者</em>
					</div>
				</a>
			</div>
			<div class="swiper-slide">
				<a href="https://www.tandfonline.com/doi/abs/10.1080/2000656X.2021.1888744?journalCode=iphs20" target="_blank">
					<div class="area_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/academy02.jpg" alt=""></div>
					<div class="area_txt">
						<h3>2021.03.04</h3>
						<span>蓓菈 &魔滴乳房假体1年安全性比较研究</span>
						<em>通讯作者</em>
					</div>
				</a>
			</div>
			<div class="swiper-slide">
				<a href="https://www.sciforschenonline.org/journals/surgery-open-access/JSOA232.php" target="_blank">
					<div class="area_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/academy03.jpg" alt=""></div>
					<div class="area_txt">
						<h3>2021.02.26</h3>
						<span>BellaGel SmoothFine乳房假体 <br>3年安全性比较研究 </span>
						<em>通讯作者</em>
					</div>
				</a>
			</div>
			
			<div class="swiper-slide">
				<a href="https://www.sciforschenonline.org/journals/surgery-open-access/JSOA231.php" target="_blank">
					<div class="area_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/academy04.jpg" alt=""></div>
					<div class="area_txt">
						<h3>2021.01.11</h3>
						<span>关于韩士生科制造蓓菈乳房假体的外壳变化</span>
						<em>通讯兼独立作者</em>
					</div>
				</a>
			</div>
			<div class="swiper-slide">
				<a href="https://www.jkms.org/DOIx.php?id=10.3346/jkms.2020.35.e103" target="_blank">
					<div class="area_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/academy05.jpg" alt=""></div>
					<div class="area_txt">
						<h3>2020.02.10</h3>
						<span>韩国乳房整形的厉害冲突研究 </span>
						<em>第一作者</em>
					</div>
				</a>
			</div>
			<div class="swiper-slide">
				<a href="https://www.sciforschenonline.org/journals/surgery-open-access/JSOA230.php" target="_blank">
					<div class="area_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/academy06.jpg" alt=""></div>
					<div class="area_txt">
						<h3>2020.12.28</h3>
						<span>法国P.I.P公司人工乳房假体事态及 <br>韩士生科蓓菈人工乳房假体丑闻研究</span>
						<em>通讯兼独立作者</em>
					</div>
				</a>
			</div>
			<div class="swiper-slide">
				<a href="https://journals.lww.com/prsgo/Fulltext/2019/12000/Short_term_Safety_of_Augmentation_Mammaplasty.8.aspx" target="_blank">
					<div class="area_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/academy07.jpg" alt=""></div>
					<div class="area_txt">
						<h3>2019.10.16</h3>
						<span>蓓菈乳房假体短期安全性研究 </span>
						<em>通讯作者</em>
					</div>
				</a>
			</div>
		</div>	
		<div class="swiper-pagination"></div>
	</div>
</div>


<script>
  var swiper = new Swiper(".academySwiper", {
	slidesPerView: 4,
	spaceBetween: 30,

	loop:false,
	autoplay: {
		delay: 7000,
		disableOnInteraction: false,
	},
	pagination: {
	  el: ".swiper-pagination",
	  clickable: true,
	},
	breakpoints: {
	200: {
		slidesPerView: 1,
		spaceBetween: 0,
	  },
	400: {
		slidesPerView: 2,
		spaceBetween: 10,
	  },
	550: {
		slidesPerView: 2,
		spaceBetween: 15,
	  },
	768: {
		slidesPerView: 3,
		spaceBetween: 20,
	  },
	 1024: {
		slidesPerView: 4,
		spaceBetween: 20,
	  },
	1400: {
		slidesPerView: 4,
		spaceBetween: 30,
	  },
	},
  });
</script>



<?php
include_once(G5_PATH.'/tail.php');
?>