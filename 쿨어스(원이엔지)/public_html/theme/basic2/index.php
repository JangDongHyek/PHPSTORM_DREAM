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
    <div id="visual" class="wow fadeInUp animated">
        <div class="area_txt">
			<p class="en">Marine Carbon Capture System (MCCS)</p>
            <h3 class="wow fadeInUp animated" data-wow-delay="0.4s" data-wow-duration="0.8s">선박용 이산화탄소 포집장치<br class="hidden-xs">탄소중립시대를 이끌어갈 기술혁신 기업</span></h3>
            <p class="wow fadeInUp animated" data-wow-delay="0.8s" data-wow-duration="0.8s">
            주식회사 쿨어스 는 선박에 최적화된 고체흡수 기술고도화를 반영한<br class="hidden-xs">저비용, 소형화된 장비 와 시스템을 선박에 적용하여
			<br class="hidden-xs">해운업의 친환경 목표달성 과 경쟁력 강화를 지원 합니다. 
        </div>
		<ul class="sliderbx">
        	<li class="mv01">
                <div class="abox_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/mvisual01.jpg" alt="" /></div>
            </li>
        	<li class="mv02">
                <div class="abox_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/mvisual02.jpg" alt="" /></div>
            </li>
        	<li class="mv03">
                <div class="abox_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/mvisual03.jpg" alt="" /></div>
            </li>
        	<li class="mv04">
                <div class="abox_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/mvisual04.jpg" alt="" /></div>
            </li>
        </ul><!--.sliderbx-->
		<!--<div class="scrolldown">
			<a href="#content">
				<i class="icon"></i>
				<i class="txt">SCROLL</i>
			</a>
		</div>-->

        <div class="scrolldown wow fadeInUp" data-wow-delay="0.4s">
            <a href="#content"><i class="fa-regular fa-chevron-down"></i><span>SCROLL DOWN</span></a>
        </div>
        <div id="notice" class="wow fadeInUp" data-wow-delay="0.4s">
            <h4>
                새소식을 전해드립니다.
                <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=notice" class="btn_moreview">더보기<i class="fa-regular fa-plus"></i></a>
            </h4>
            <?php echo latest("theme/basic2", "notice", 1, 30); ?>
        </div>
    </div><!-- //visual -->	
</div><!--  #idx_wrapper -->
<!--<div class="fixed_bg"></div>-->
<!--
		<div class="area_link">
			<a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=contact">견적문의</a>
        </div>
-->

<div id="content">

    <!--추가 컨텐츠-->
    <div class="area_business v2">
        <div class="area_title">
            <h5 class="wow fadeInDown" data-wow-delay="0.1s"><strong>BUSINESS</strong> AREA</h5>
            <p class="eng wow fadeInDown" data-wow-delay="0.3s">Marine Carbon<br class="hidden-xs">
                Capture Technology</p>
            <span class="wow fadeInDown" data-wow-delay="0.4s">화석연료 연소로 발생하는 CO2를 <br class="hidden-xs">
                대기배출 전에 포집(capture)하고 <br class="hidden-xs">
                고순도 액상 CO2 형태로 선체내에 저장하는 기술 </span>
            <br>
            <a class="btn_more" href="<?php echo G5_BBS_URL ?>/content.php?co_id=pro02_01">MORE VIEW <i class="fa-light fa-chevron-right"></i></a>
        </div>
        <div class="area_swiper">
            <div class="swiper business">
                <div class="swiper-button-wrap">
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
                <div class="swiper-wrapper">
                    <div class="swiper-slide b01 wow fadeInLeft animated" data-wow-delay="0.5s" data-wow-duration="0.8s">
                        <dl>
                            <dt><strong></strong> MCCS장비의 필요성 </dt>
                            <dd>CO2포집장치 (CCS장치)를 설치하여 선박에서 배출되는 CO2를 포집하여 IMO의 규제에 대응 준비 해야 합니다.</dd>
                        </dl>
                    </div>
                    <div class="swiper-slide b02 wow fadeInLeft animated" data-wow-delay="0.8s" data-wow-duration="0.8s">
                        <dl>
                            <dt><strong></strong> 선박 온실가스 배출 규제 </dt>
                            <dd>IMO2023 전략에서 제시한 목표/ 평균 CO2 배출량을 2008년 대비 2030년까지 최소 40% 감축 해야 합니다.</dd>
                        </dl>
                    </div>
                    <div class="swiper-slide b03 wow fadeInLeft animated" data-wow-delay="1.1s" data-wow-duration="0.8s">
                        <dl>
                            <dt><strong></strong> Marine CCS (MCCS) </dt>
                            <dd>최적화된 고체흡수제를 사용한 고도화 기술을 반영한 저비용, 소형화 된 장비 와 시스템을 선박에 적용합니다.</dd>
                        </dl>
                    </div>
<!--                  <div class="swiper-slide b04 wow fadeInLeft animated" data-wow-delay="1.4s" data-wow-duration="0.8s">
                        <dl>
                            <dt><strong></strong> OCCS장비의 필요성 </dt>
                            <dd>CO2포집장치(CCS장치)를 설치하여 선박에서 배출되는 CO2를 포집하여 IMO의 규제에 대응 준비해야함</dd>
                        </dl>
                    </div>
                    <div class="swiper-slide b05 wow fadeInLeft animated" data-wow-delay="1.7s" data-wow-duration="0.8s">
                        <dl>
                            <dt><strong></strong> 선박 온실가스 배출 규제</dt>
                            <dd>IMO2023전략에서 제시한 목표 / 평균 CO2배출량을 2008년 대비 2030년까지 최소 40%감축</dd>
                        </dl>
                    </div>
                   <div class="swiper-slide b06 wow fadeInLeft animated" data-wow-delay="1.7s" data-wow-duration="0.8s">
                        <dl>
                            <dt><strong>06</strong> 연기, 공탁</dt>
                            <dd>법적 절차를 통해 일정을 연기하거나 재산을 공탁하여 이해당사자의 이익을 보호하는 경매 과정에서 필수적인 역할을 합니다.</dd>
                        </dl>
                    </div>
                    <div class="swiper-slide b07 wow fadeInLeft animated" data-wow-delay="1.7s" data-wow-duration="0.8s">
                        <dl>
                            <dt><strong>07</strong> 취소소송</dt>
                            <dd>부동산 및 금융 거래에 관한 취소 소송을 전문적으로 대행하여 소송 과정을 원활히 진행합니다.</dd>
                        </dl>
                    </div>-->
                </div>
            </div>
        </div>
    </div>

    <div class="area_performance">
        <div class="area_title">
            <h5 class="wow fadeInDown" data-wow-delay="0.1s"><strong>BUSINESS</strong> Differentiation</h5><br>
            <span class="wow fadeInDown" data-wow-delay="0.4s">쿨어스의 타기업과의 OCCS의 성능 기술 차별성 - 선박설치에 용이한 소형화 장비/건식 흡수제의 내구성 강화로 유지보수비 저감 </span>
            <br>
        </div>
        <div class="counter_area">
            <!--숫자증감애니메이션-->
            <div class="counterareabg">
                <div class="counter_wrap">
                    <p><span class="counter" data-start="0" data-end="8"><br />0</span>%</p>
                    <p><span class="counter" data-start="0" data-end="90">0</span>%</p>
                    <p><span class="counter" data-start="0" data-end="99.9">0</span>%</p>
                    <p><span class="counter" data-start="0" data-end="99.99">0</span>%</p>
                </div>
                <div class="title_wrap">
                    <div class="inr">
                        <div class="title">
                            <p>건식흡수제의 흡수능 최대화</p>
                            <span>2024년 기준</span>
                        </div>
                        <div class="title">
                            <p>CO2 포집율 90% 이상 과 CO2 순농도 99.9% 의 고효율화</p>
                            <span>2024년 5월 기준</span>
                        </div>
                        <div class="title">
                            <p>선박설치에 용이한 소형화 장비</p>
                            <span>2024년 기준</span>
                        </div>
                        <div class="title">
                            <p>건식 흡수제의 내구성 강화로 유지보수비 저감</p>
                            <span>2024년 기준</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="counter_img">
                <img src="<?php echo G5_THEME_IMG_URL ?>/main/performance_img.jpg">
            </div>
        </div>
        <script>
            $(document).ready(function() {
                // 클래스가 "counter"인 모든 요소를 선택합니다.
                const $counters = $(".counter");

                // 노출 비율(%)과 애니메이션 속도(ms)을 설정합니다.
                const exposurePercentage = 100; // ex) 스크롤 했을 때 $counters 컨텐츠가 화면에 100% 노출되면 숫자가 올라갑니다.
                const duration = 1000; // ex) 1000 = 1초

                // 숫자에 쉼표를 추가할지 여부를 설정합니다.
                const addCommas = true; // ex) true = 1,000 / false = 1000

                // 숫자를 업데이트하고 애니메이션하는 함수 정의
                function updateCounter($el, start, end) {
                    let startTime;
                    function animateCounter(timestamp) {
                        if (!startTime) startTime = timestamp;
                        const progress = (timestamp - startTime) / duration;
                        const current = Math.round(start + progress * (end - start));
                        const formattedNumber = addCommas ? current.toLocaleString() : current;
                        $el.text(formattedNumber);

                        if (progress < 1) {
                            requestAnimationFrame(animateCounter);
                        } else {
                            $el.text(addCommas ? end.toLocaleString() : end);
                        }
                    }
                    requestAnimationFrame(animateCounter);
                }

                // 초기화 함수 정의
                function initCounters() {
                    $counters.each(function() {
                        const $el = $(this);
                        const start = parseInt($el.data("start"));
                        const end = parseInt($el.data("end"));
                        // 숫자를 업데이트하고 애니메이션을 시작합니다.
                        updateCounter($el, start, end);
                    });
                }

                // 초기화 함수 호출
                initCounters();

                // 윈도우의 사이즈가 변경될 때마다 실행됩니다.
                $(window).on('resize', function() {
                    if ($(window).width() > 1200) {
                        $(window).on('scroll', function() {
                            // 각 "counter" 요소에 대해 반복합니다.
                            $counters.each(function() {
                                const $el = $(this);
                                // 요소가 아직 스크롤되지 않았다면 처리합니다.
                                if (!$el.data('scrolled')) {
                                    // 요소의 위치 정보를 가져옵니다.
                                    const rect = $el[0].getBoundingClientRect();
                                    const winHeight = window.innerHeight;
                                    const contentHeight = rect.bottom - rect.top;

                                    // 요소가 화면에 특정 비율만큼 노출될 때 처리합니다.
                                    if (rect.top <= winHeight - (contentHeight * exposurePercentage / 100) && rect.bottom >= (contentHeight * exposurePercentage / 100)) {
                                        const start = parseInt($el.data("start"));
                                        const end = parseInt($el.data("end"));
                                        // 숫자를 업데이트하고 애니메이션을 시작합니다.
                                        updateCounter($el, start, end);
                                        $el.data('scrolled', true);
                                    }
                                }
                            });
                        }).scroll(); // 초기화
                    } else {
                        // 윈도우 사이즈가 1200px 이하일 때 스크롤 이벤트 제거
                        $(window).off('scroll');
                        // 초기화 함수 호출
                        initCounters();
                    }
                }).resize(); // 초기화
            });
        </script>
    </div>

    <div class="idx_company">
        <div class="inr">
            <div class="idx_title">
                <h3>About COOL EARTH</h3>
            </div>
            <div class="txt">
                <h4>탄소중립 시대 이끌 기술혁신 기업<br>
                    선박의 고효율 운영과 친환경 기술 및 고체 흡착 기술 기반 분리 시스템 전문가</h4>
                <p>(주) 쿨어스는 선박·산업용 냉동공조장치 및 관련 응용장치의 설계 제작/ 설치 기술과 실적을 보유한 기업으로<br>
친환경에너지 및 탄소중립 기술에 대한 지속적인 연구를 통해 기후변화시대에 경쟁력 있는 기술을 개발하고 있습니다.. </p>
            </div>
            <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=greet01" class="more wow fadeInDown" data-wow-delay="0.8s">자세히 보기 <i class="fa-light fa-angle-right"></i></a>
        </div>
    </div>

    <div class="idx_cs">
        <div class="inr">
            <div class="banner">
                <div>
                    <dl onclick="location.href='<?php echo G5_BBS_URL ?>/content.php?co_id=greet03'">
                        <dt>품질경영</dt>
                        <dd>품질방침을 달성하기 위한<br>
                            실현 가능한 품질 목표 설정</dd>
                    </dl>
                </div>
                <div></div>
                <div>
                    <dl onclick="location.href='<?php echo G5_BBS_URL ?>/content.php?co_id=greet00'">
                        <dt>기업개요</dt>
                        <dd>지속적인 연구개발을 통한<br>
                            기술선진화 구축</dd>
                    </dl>
                </div>
                <div>
                    <dl onclick="location.href='<?php echo G5_BBS_URL ?>/board.php?bo_table=performance'">
                        <dt>수행실적</dt>
                        <dd>R&D 주요 수행실적<br>
                            정부출연 개발과제</dd>
                    </dl>
                </div>
            </div>
            <div class="latest">
                <?php echo latest('theme/basic3', 'notice', 2, 100); ?>
            </div>
        </div>
    </div>


</div>

    <script>

        var swiper = new Swiper(".business", {
            slidesPerView: 3,
            spaceBetween: 30,
            loop: true,
            initialSlide: 0, // Ensure the first slide starts on the left
            centeredSlides: false, // Disable centered slides
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                // When window width is >= 768px
                1600: {
                    slidesPerView: 2
                },
                768: {
                    slidesPerView: 2
                },
                // When window width is < 768px
                550: {
                    slidesPerView: 1
                }
            }
        });


    </script>

<?php
include_once(G5_PATH.'/tail.php');
?>