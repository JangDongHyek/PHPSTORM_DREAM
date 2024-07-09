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
      <div id="slogan">
         <div class="img01 wow fadeInUp animated" data-wow-delay="0.4s" data-wow-duration="0.8s">
             폭력 없는 세상, 행복한 가정<br>
             <b>양산가족상담센터</b>
         </div>
         <div class="mt wow fadeInUp animated" data-wow-delay="0.8s" data-wow-duration="0.8s">
          양산가족상담센터는 <br class="visible-xs"/>다양한 가족 문제들과 <br class="hidden-xs"/>
          대인관계 속에서 <br class="visible-xs"/>어려움을 겪고 있는 모든 분들과 함께합니다.</div>
      </div><!--#slogan-->
       <div class="swiper-container">
        <div class="swiper-wrapper">
          <div class="swiper-slide mv01">
          </div>
          <div class="swiper-slide mv02">
          </div>
          <div class="swiper-slide mv03">
          </div>
          <div class="swiper-slide mv04">
          </div>
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination wow fadeInUp animated" data-wow-delay="1.2s" data-wow-duration="0.8s"></div>
        <!-- Add Arrows -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
      </div>
      <script>
        var swiper = new Swiper('.swiper-container', {
          spaceBetween: 0,
          centeredSlides: true,
          autoplay: {
            delay: 5000,
            disableOnInteraction: false,
          },
		  speed : 1000,
          pagination: {
            el: '.swiper-pagination',
            clickable: true,
          },
          navigation:false,
		  //{
           // nextEl: '.swiper-button-next',
           // prevEl: '.swiper-button-prev',
         // },
        });
      </script>
</div><!--  #idx_wrapper -->


<div id="main_news">
    <div class="main_tit">
        <h2>양산가족상담센터</h2>
        <h3>소식</h3>
    </div>           
    <div class="in_box">
        <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=busi01" class="rv wow fadeInUp animated" data-wow-delay="0s" data-wow-duration="0.5s">
<!--            <img src="<?php echo G5_THEME_IMG_URL ?>/main/micon01.png">-->
            <span class="ic_info">
                <i class="fas fa-paste"></i>
            </span>
            <div class="txt">
                <h5><strong>프로그램 안내</strong></h5>
                <p>양산가족상담센터의 <br class="hidden-xs" />프로그램을 알려드립니다.</p>
                <span class="go_btn"><i class="fal fa-long-arrow-right"></i></span>
            </div>
        </a>

        <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=busi02" class="wow fadeInUp animated" data-wow-delay="0.2s" data-wow-duration="0.5s">
<!--            <img src="<?php echo G5_THEME_IMG_URL ?>/main/micon04.png">-->
            <span class="ic_info">
                <i class="fas fa-bullhorn"></i>
            </span>
            <div class="txt">
                <h5><strong>활동소식</strong></h5>
                <p>양산가족상담센터의 활동소식을<br class="hidden-xs" />확인하실 수 있습니다.</p>
                <span class="go_btn"><i class="fal fa-long-arrow-right"></i></span>
            </div>
        </a>

        <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=counseling01" class="wow fadeInUp animated" data-wow-delay="0.4s" data-wow-duration="0.5s">
<!--            <img src="<?php echo G5_THEME_IMG_URL ?>/main/micon03.png">-->
            <span class="ic_info">
                <i class="far fa-hand-heart"></i>
            </span>
            <div class="txt">
                <h5><strong>상담지원 안내</strong></h5>
                <p>양산가족상담센터 지원을 <br class="hidden-xs" />안내 해드립니다.</p>
                <span class="go_btn"><i class="fal fa-long-arrow-right"></i></span>
            </div>
        </a>

        <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=parti04" class="wow fadeInUp animated" data-wow-delay="0.6s" data-wow-duration="0.5s">
<!--            <img src="<?php echo G5_THEME_IMG_URL ?>/main/micon05.png">-->
            <span class="ic_info">
                <i class="far fa-hands-heart"></i>
            </span>
            <div class="txt">
                <h5><strong>참여하기</strong></h5>
                <p>양산가족상담센터의 <br class="hidden-xs" />아름다운 동행에 함께 해 주세요.</p>
                <span class="go_btn"><i class="fal fa-long-arrow-right"></i></span>
            </div>
        </a>
    </div><!--in_box-->
</div><!--main_news-->


<div id="middle2">
	<div id="middle2_in">
        <div class="abox abox01">
            <!--탭타이틀-->
            <div class="tabs">
                <div class="tad"><a href="#tab1" class="selected">공지사항</a></div>
                <div class="tad"><a href="#tab2">사이버 상담</a></div>
            </div>
            <!--탭컨텐츠패널-->
            <div class="panels">
                <div class="pd" id="tab1"><?php echo latest("theme/basic", "notice",4, 24); ?></div>
                <div class="pd" id="tab2"><?php echo latest("theme/basic", "counseling02",4, 24); ?></div>
            </div>
        </div><!--.abox-->
        
        <div class="abox abox02">
            <?php echo latest("theme/gallery", "busi03",3, 18); ?>
        </div><!--.abox-->
        
        <div class="abox abox03">
            <dl>
                <dt>상담안내</dt>
				<div class="tel">055-362-1366</div>
               <div class="tel">055-366-4001</div>
                <dd>
                	<ul>
                      <li><strong>상담시간</strong> 월 ~ 금 09:00 ~ 18:00</li>
                      <li><strong style="background:#fff;"></strong> (주말 및 공휴일 휴무)</li>
<!--                       <li><strong>행정전화</strong> 055-363-2633</li>-->
                    	<li><strong>팩스번호</strong> <?php echo $config['cf_5']; ?></li>
                    	<li><strong>이메일</strong> <?php echo $config['cf_6']; ?></li>
                    </ul>
                
                </dd>
            </dl>
        </div><!--.abox-->
    </div><!--#middle2_in-->
</div><!--#middle2-->


<div id="middle">

    
    <!--롤링배너-->
    <div id="fav_area">
        <div class="fav">
            <div class="slide-wrap">
                <div class="arr">
                    <span class="btn-prev"><a href="javascript:;"><i class="far fa-chevron-left"></i></a></span>
                    <span class="btn-next"><a href="javascript:;"><i class="far fa-chevron-right"></i></a></span>
                </div><!--arr 버튼부분-->

                <div class="slide-box">
                    <div class="thm"><a href="www.mogef.go.kr" target="_blank">
           <img src="<?php echo G5_THEME_IMG_URL ?>/main/micon01.jpg"></a>
                   </div>
                    <div class="thm"><a href="http://www.yangsan.go.kr" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/main/micon02.jpg"></a></div>
                    <div class="thm"><a href="http://www.women1366.or.kr" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/main/micon03.jpg"></a></div>
                    <div class="thm"><a href="http://www.ysmhc.or.kr" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/main/micon04.jpg"></a></div>
                    <div class="thm"><a href="http://www.yscamc.org" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/main/micon05.jpg"></a></div>
                    <div class="thm"><a href="http://yangsan.familynet.or.kr" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/main/micon06.jpg"></a></div>
                    <div class="thm"><a href="http://www.kn1391.or.kr" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/main/micon07.jpg"></a></div>
                    <div class="thm"><a href="https://www.yangsan.go.kr/teen/main.do" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/main/micon08.jpg"></a></div>
                    <div class="thm"><a href="http://ucvc.kcva.or.kr" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/main/micon09.jpg"></a></div>
                </div><!--slide-box-->        
            </div><!--slide-wrap-->
        </div><!--fav-->
    </div>

    <script>
    $('.slide-box').each(function(){
            $(this).slick({
                slidesToShow:7,
                slidesToScroll: 1,
                infinite: true,
                dots: true, 
                accessibility: true,
                arrows: true,
                prevArrow: $(this).parents('.slide-wrap').find('.btn-prev'),
                nextArrow: $(this).parents('.slide-wrap').find('.btn-next'),
                speed: 600,
                autoplay:true,
                autoplaySpeed: 1000,
                responsive: [  // 반응형일때 원하는 사이즈에서 보여지는 갯수 조절할 수 있음.
                    {
                        breakpoint: 990,
                        settings: {
                            slidesToShow: 3,
                        }
                    }
                ] 

            })
    })
    </script>
<!--
	<div id="middle_in">
    <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=greet03">
        <div class="abox abox01">
        	<div class="abox_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/micon01.png" alt="" /></div>
            <dl>
                <dt>가정폭력 전문상담</dt>
            </dl>
        </div>
    </a>
    <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=greet03">
        <div class="abox abox02">
        	<div class="abox_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/micon02.png" alt="" /></div>
            <dl>
                <dt>교육문화사업</dt>
            </dl>
        </div>
    </a>
    <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=greet03">
        <div class="abox abox02">
        	<div class="abox_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/micon03.png" alt="" /></div>
            <dl>
                <dt>지역사회 연대사업</dt>
            </dl>
        </div>
    </a>
    <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=greet03">
        <div class="abox abox02">
        	<div class="abox_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/micon04.png" alt="" /></div>
            <dl>
                <dt>홍보사업</dt>
            </dl>
        </div>
    </a>
    <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=greet03">
        <div class="abox abox02">
        	<div class="abox_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/micon05.png" alt="" /></div>
            <dl>
                <dt>후원사업</dt>
            </dl>
        </div>
    </a>
    </div>
-->
</div><!--#middle-->

<!--
<div id="mbanner">
	<div id="mbanner_in">
	<a href="http://www.mohw.go.kr/react/index.jsp" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/main/mbanner01.gif" alt="보건복지부" /></a>
	<a href="http://www.gijang.go.kr/index.gijang" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/main/mbanner02.gif" alt="기장군" /></a>
	<a href="http://www.busan.go.kr/open/index.jsp" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/main/mbanner03.gif" alt="부산시" /></a>
	<a href="http://www.bsjahwal.or.kr/main.php" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/main/mbanner04.gif" alt="부산지역자활센터협회" /></a>
	<a href="http://www.busanjh.or.kr/" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/main/mbanner05.gif" alt="부산광역자활센터" /></a>
	<a href="https://www.kdissw.or.kr/" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/main/mbanner06.gif" alt="한국자활복지개발원" /></a>
    </div>
</div>
-->
<!--#mbanner-->




<?php /*?><div id="middle">
	<div id="middle_in">
        <div class="abox abox01">
            <dl>
                <dt>진료시간 안내</dt>
                <dd>
                	<ul>
                    	<li><strong>평일진료</strong> AM 9:00 ~ PM 6:00</li>
                    	<li><strong>점심시간</strong> PM 12:30 ~ PM 1:30</li>
                    	<li><strong>휴진안내</strong> 토요일/일요일/공휴일</li>
                    </ul>
                
                </dd>
            </dl>
        </div><!--.abox-->
        <div class="abox abox02">
            <dl>
                <dt>맑은병원 오시는길</dt>
                <dd>부산광역시 동래구<br />금강로 91(온천동, 대동빌딩)</dd>
                <p>명륜역 1,3번 출구<br />
                 110번, 110-1번, 121번, 131번, 148-1번,<br />
                77번, 80번, 100-1번</p>
                
                <div class="main_map">
                    <div class="mmap"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/map_img.jpg" /></div>
                </div><!--.main_map-->
                <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=location" class="moree">자세히보기 &nbsp;<i class="far fa-angle-right"></i></a>
            </dl>
        </div><!--.abox-->
        
    </div>
</div>
<?php */?>

<?php
include_once(G5_PATH.'/tail.php');
?>