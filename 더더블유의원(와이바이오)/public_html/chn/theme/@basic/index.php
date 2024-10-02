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
						<h3>가슴성형</h3>
						<span>남다른 기술력과 풍부한 경험 <br>만족도 높은 수술결과</span>
						<div class="btn_more"><span>MORE</span></div>
					</div>
				</a>
			</div>
			<div class="swiper-slide">
				<a href="<?php echo G5_BBS_URL ?>/content.php?co_id=s4_01">
					<div class="area_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/bn02.jpg" alt=""></div>
					<div class="area_txt">
						<h3>가슴재수술</h3>
						<span>내 생애 마지막 가슴수술</span>
						<div class="btn_more"><span>MORE</span></div>
					</div>
				</a>
			</div>
			<div class="swiper-slide">
				<a href="<?php echo G5_BBS_URL ?>/content.php?co_id=s7_01">
					<div class="area_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/bn03.jpg" alt=""></div>
					<div class="area_txt">
						<h3>여유증</h3>
						<span>유선절제술과 지방흡입술을 동시에 진행하여 여유증에 대한 확실한 치료를 합니다</span>
						<div class="btn_more"><span>MORE</span></div>
					</div>
				</a>
			</div>
			<div class="swiper-slide">
				<a href="<?php echo G5_BBS_URL ?>/content.php?co_id=s6_01">
					<div class="area_img line"><img src="<?php echo G5_THEME_IMG_URL ?>/main/bn04.jpg" alt=""></div>
					<div class="area_txt">
						<h3>유방재건</h3>
						<span>유방외과 전문의가 직접 치료</span>
						<div class="btn_more"><span>MORE</span></div>
					</div>
				</a>
			</div>
			<div class="swiper-slide">
				<a href="<?php echo G5_BBS_URL ?>/content.php?co_id=s1_01">
					<div class="area_img line"><img src="<?php echo G5_THEME_IMG_URL ?>/main/bn05.jpg" alt=""></div>
					<div class="area_txt">
						<h3>맘모톰클리닉</h3>
						<span>작은 흉터로 안전하게 편안하게</span>
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
        <h4><span>유방암</span>검진</h4>
        <p>유방암은 조기발견이 최선의 예방입니다. <br>주기적인 검진으로 건강한 가슴을 지켜주세요.</p>
        <div class="more"><span>MORE<br> VIEW</span></div>
      </div>
    </a>
  </div>
  <div id="mClinic2" class="box1 wow fadeInRight animated" data-wow-delay="0.6s" data-wow-duration="0.8s">
    <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=s2_01">
      <div class="txt">
        <h4><span>보형물</span>특수검진</h4>
        <p>유방보형물 구별 및 관련 합병증과 <br>역형성 대세포림프종 진단을 위한 검진 입니다.</p>
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
						<span>무증상 환자에서의 유방보형물 검진 및 초음파를 이용한 보형물 구별연구</span>
						<em>교신저자</em>
					</div>
				</a>
			</div>
			<div class="swiper-slide">
				<a href="https://academic.oup.com/asjopenforum/article/doi/10.1093/asjof/ojab046/6424352" target="_blank">
					<div class="area_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/academy09.jpg" alt=""></div>
					<div class="area_txt">
						<h3>2021.11.09</h3>
						<span>모티바 유방보형물 <br>3년 안전성 연구</span>
						<em>교신저자</em>
					</div>
				</a>
			</div>
			<div class="swiper-slide">
				<a href="https://link.springer.com/article/10.1007%2Fs00266-021-02544-5" target="_blank">
					<div class="area_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/academy10.jpg" alt=""></div>
					<div class="area_txt">
						<h3>2021.08.30</h3>
						<span>구형구축진단을 위한 피막 두께 측정을 위한 초음파연구: Baker grade와의 상관관계에 대하여</span>
						<em>교신 및 제1저자</em>
					</div>
				</a>
			</div>
			<div class="swiper-slide">
				<a href="https://www.sciforschenonline.org/journals/surgery-open-access/JSOA236.php" target="_blank">
					<div class="area_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/academy01.jpg" alt=""></div>
					<div class="area_txt">
						<h3>2021.04.30</h3>
						<span>실리콘 보형물 피막외파열에 의한 실리콘종에 관한 case report</span>
						<em>교신 및 단독저자</em>
					</div>
				</a>
			</div>
			<div class="swiper-slide">
				<a href="https://www.tandfonline.com/doi/abs/10.1080/2000656X.2021.1888744?journalCode=iphs20" target="_blank">
					<div class="area_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/academy02.jpg" alt=""></div>
					<div class="area_txt">
						<h3>2021.03.04</h3>
						<span>벨라젤 &모티바 유방보형물 <br>1년 안전성 비교연구</span>
						<em>교신저자</em>
					</div>
				</a>
			</div>
			<div class="swiper-slide">
				<a href="https://www.sciforschenonline.org/journals/surgery-open-access/JSOA232.php" target="_blank">
					<div class="area_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/academy03.jpg" alt=""></div>
					<div class="area_txt">
						<h3>2021.02.26</h3>
						<span> 벨라젤 스무스파인 유방보형물 <br>3년 안전성 연구</span>
						<em>교신저자</em>
					</div>
				</a>
			</div>
			
			<div class="swiper-slide">
				<a href="https://www.sciforschenonline.org/journals/surgery-open-access/JSOA231.php" target="_blank">
					<div class="area_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/academy04.jpg" alt=""></div>
					<div class="area_txt">
						<h3>2021.01.11</h3>
						<span>한스바이오메드 제조 벨라젤 <br>유방보형물의 쉘 임의 변경에 대하여</span>
						<em>교신 및 단독저자</em>
					</div>
				</a>
			</div>
			<div class="swiper-slide">
				<a href="https://www.jkms.org/DOIx.php?id=10.3346/jkms.2020.35.e103" target="_blank">
					<div class="area_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/academy05.jpg" alt=""></div>
					<div class="area_txt">
						<h3>2020.02.10</h3>
						<span>한국 유방성형의 이해충돌 연구</span>
						<em>제1저자</em>
					</div>
				</a>
			</div>
			<div class="swiper-slide">
				<a href="https://www.sciforschenonline.org/journals/surgery-open-access/JSOA230.php" target="_blank">
					<div class="area_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/academy06.jpg" alt=""></div>
					<div class="area_txt">
						<h3>2020.12.28</h3>
						<span> 프랑스 P.I.P사 인공유방 보형물 사태와 한스바이오메드 벨라젤 인공유방 보형물 스캔들 연구</span>
						<em>교신 및 단독저자</em>
					</div>
				</a>
			</div>
			<div class="swiper-slide">
				<a href="https://journals.lww.com/prsgo/Fulltext/2019/12000/Short_term_Safety_of_Augmentation_Mammaplasty.8.aspx" target="_blank">
					<div class="area_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/academy07.jpg" alt=""></div>
					<div class="area_txt">
						<h3>2019.10.16</h3>
						<span>벨라젤 유방보형물 단기 안전성 연구</span>
						<em>교신저자</em>
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



<div id="main_cus">
	<div class="in">
        <div class="big_form">
            <h1>SMS 간편상담<span>문자로 보다 간편하게 답변을 받아보세요.</span></h1>
                <form action="<?=G5_BBS_URL?>/write_update.php" onsubmit="return index_write_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" >
                <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
                <input type="hidden" name="bo_table" value="consult">
                <div class="f_box cf">
                    <div class="formbox a1">  
                        <strong class="title">이름</strong>
                        <div class="form"><input type="text" name="wr_name"></div>
                    </div>
                    
                    <div class="formbox a2">  
                        <strong class="title">전화번호</strong>
                        <div class="form tel">
                            <select class="select" name="phone[]">
                                <option value="010">010</option>
                                <option value="011">011</option>
                                <option value="016">016</option>
                                <option value="017">017</option>
                                <option value="018">018</option>
                                <option value="019">019</option>        
                            </select>
                            <span class="unit">-</span>
                            <input type="text" id="phone2" name="phone[]" class="text" maxlength="4">
                            <span class="unit">-</span>
                            <input type="text" id="phone3" name="phone[]" class="text" maxlength="4">
                        </div>
                    </div>
    
                    <div class="formbox a3">  
                        <strong class="title">유형</strong>
                        <div class="form hw">
                            <select class="select" name="data[]">
                                <option>가슴확대</option>
                                <option>가슴축소</option>
                                <option>가슴재수술</option>
                                <option>맘모톰</option>
                                <option>유방검진</option>
                                <option>보형물특수검진</option>
                                <option>유방재건</option>
                                <option>유륜/유두축소</option>
                                <option>여유증</option>
                                <option>지방흡입</option>
                                <option>피부/레이저</option>
                            </select>
                       </div>
                    </div>
                    
                   <div class="subm"><input type="submit" value="상담신청"></div> 
               </div><!--f_box-->
               
               <div class="agree">
                    <label>
                        <input type="checkbox" name="agree" class="" id="" value=1>
                        <em></em><span>개인정보수집이용에 동의합니다.</span>
                    </label>	    										
               </div>
                
               </form>
        </div><!--big_form-->

        
        
    </div><!--in-->
</div><!--main_cus-->


<?php
include_once(G5_PATH.'/tail.php');
?>