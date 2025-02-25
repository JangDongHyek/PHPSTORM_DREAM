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
#gnb_1dul > li.gnb_1dli:nth-child(3) a.gnb_1da{ color:#DC000C !important;   transition:all 1s  !important;}
#gnb_1dul > li.gnb_1dli:nth-child(3) span{ display:block !important;  transition:all 1s  !important; width:100% !important}
.counterareabg{ padding:0 0 80px; text-align:center}
</style>
<section id="visual">
    <div class="swiper swiperVisual">
        <div class="swiper-wrapper">
            <!--<div class="swiper-slide v1">
                <div class="imgAreaBg">
                    <div class="slogan">
                        <h3>
                            <p>정직하고 확실하게</p>
                            <p>배달로 길을 이어주는</p>
                            <p>푸드<span class="txtRed">라</span>인</p>
                        </h3>
                        <a class="btnArrow">바로 문의하기</a>
                    </div>
                    <div class="imgMark">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/main/visual_mark.svg">
                    </div>
                </div>
            </div>-->
            <div class="swiper-slide busi_v1">
            <div class="imgAreaBg">
                    <div class="slogan">
                        <h3>
                            <p>직영 물류 인프라와 IT 역량으로</p>
                            <p>유통물류 <span class="txtRed">디지털</span>화</p>
                        </h3>
                        <a class="btnArrow">대리점 문의하기</a>
                    </div>
                    <!--<div class="imgMark">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/main/visual_mark.svg">
                    </div>-->
            </div>
            </div>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <!--<div class="swiper-pagination"></div>-->
    </div>

    <!-- Initialize Swiper -->

</section>


<div id="idx_wrapper">
    <section class="area_map">
        <div class="titleArea">
            <span class="wow fadeInDown" data-wow-delay="0.3s">FOOD<span class="txtRed">LINE</span> Distributor</span>
            <h3 class="wow fadeInUp" data-wow-delay="0.4s">푸드<span class="txtRed">라</span>인 각지역 운영중인 회사</h3>
        </div>
        <div class="contsArea">
            <div class="imgArea wow fadeInUpBig" data-wow-delay="0.7s">
                <img src="<?php echo G5_THEME_IMG_URL ?>/sub/map.png">
            </div>
            <div class="textArea">
            </div>
        </div>
    </section>



    <section class="area_found">
        <div class="titleArea">
            <span class="wow fadeInDown" data-wow-delay="0.3s">FOOD<span class="txtRed">L</span>INE Foundation</span>
            <h3>
                <p class="wow fadeInUp" data-wow-delay="0.4s">라이더 창업, 함께 떠나는</p>
                <p class="wow fadeInUp" data-wow-delay="0.5s"><span class="txtRed">성공</span>의 여정!</p>
            </h3>
            <div class="txt">
                <p class="wow fadeInDownBig" data-wow-delay="0.6s">안녕하세요, 라이더 여러분! 물류 업계의 혁신과 성장에 함께하실 창업자를 찾고 있습니다.</p>
                <p class="wow fadeInDownBig" data-wow-delay="0.6s">저희와 함께 미래의 성공을 향해 나아갈 라이더를 기다리고 있습니다.</p>
            </div>
        </div>
        <div class="contsArea">
            <dl class="wow fadeInUpBig" data-wow-delay="0.7s">
                <p class="icon wow flipInX" data-wow-delay="0.9s" data-wow-duration="1s">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/sub/found_icon01.svg"></p>
                <dt>왜 우리와 함께해야 하는가?</dt>
                <dd><strong class="txtRed">경험과 노하우</strong> 업계에서 오랜 기간의 경험을 토대로 라이더들에게 필요한 최고의 노하우를 전수합니다.</dd>
                <dd><strong class="txtRed">혁신적인 기술</strong> 최신 기술을 적극 도입하여 라이더들이 더 효율적이고 편리하게 업무를 수행할 수 있도록 지원합니다.</dd>
            </dl>
            <dl class="wow fadeInUpBig" data-wow-delay="0.7s">
                <p class="icon wow flipInX" data-wow-delay="1.0s" data-wow-duration="1s">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/sub/found_icon02.svg"></p>
                <dt>혜택 및 지원 사항</dt>
                <dd><strong class="txtRed">맞춤형 교육 프로그램</strong> 창업 이전과 이후에도 꾸준한 교육 프로그램을 통해 라이더들의 전문성을 향상시킵니다.</dd>
                <dd><strong class="txtRed">고수익 모델</strong> 경제적 보상을 통해 창업자들이 안정적인 수입을 얻을 수 있도록 지원합니다.</dd>
            </dl>
            <dl class="wow fadeInUpBig" data-wow-delay="0.7s">
                <p class="icon wow flipInX" data-wow-delay="1.1s" data-wow-duration="1s">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/sub/found_icon03.svg"></p>
                <dt>파트너십 혜택</dt>
                <dd><strong class="txtRed">마케팅 및 홍보 지원</strong> 강력한 마케팅 팀을 통해 브랜드 인지도를 높이고 라이더들에게 안정적인 주문을 보장합니다.</dd>
                <dd><strong class="txtRed">협력 업체 혜택</strong> 다양한 제휴 업체와의 협력을 통해 라이더들에게 다양한 혜택을 제공합니다.</dd>
            </dl>
        </div>
        <!--<div class="line">
            <div class="wow fadeInDownBig" animation-duration="1s" data-wow-delay="0s"></div>
            <div class="wow fadeInRightBig" animation-duration="1s" data-wow-delay="0.5s"></div>
        </div>-->
    </section>


    <section class="imgBgArea" style="background:#f8f8f8">
        <div class="titleArea">
            <span class="wow fadeInDown" data-wow-delay="0.3s">FOOD<span class="txtRed">LINE</span> IDENTITY</span>
            <h3 class="wow fadeInUp" data-wow-delay="0.4s">푸드<span class="txtRed">라</span>인은 지역의 평판, 업력을 평가하여<br /> 지점개설을 도와드리고 있습니다.</h3>
        </div>
        <!--숫자증감애니메이션-->
        <div class="counterareabg">
             <div>
                 <span class="title">상점수</span>
                 <span class="title">하루 배달</span>
                 <span class="title">라이더수</span>
             </div>
             <div>
                 <span class="counter" data-start="0" data-end="9120"><br />0</span>
                 <span class="counter" data-start="0" data-end="93384">0</span>
                 <span class="counter" data-start="0" data-end="8402">0</span>
             </div>
        </div>
    </section>

        <section class="area_news">
                <div class="imgArea"></div>
                <div class="contsArea">
                    <div class="titleArea">
                        <span class="wow fadeInDown" data-wow-delay="0.3s">
                            <img src="<?php echo G5_THEME_IMG_URL ?>/sub/news_logo.png">
                        </span>
                        <h3 class="wow fadeInUp" data-wow-delay="0.4s">
                            푸드라인, 식당 창업·운영비 낮춰 배달료 인하 꾀한다
                        </h3>
                    </div>
                    <div class="conts">
                        배달대행 플랫폼 업체 푸드라인이 플랫폼 개발사를 합병하고 사업 확장에 본격 나선다. 주문 중개·가전렌털 등을 통해 식당 창업 및 운영비를 낮춰 배달료를 인하하는 사업 모델이다.
                        <br><br>
                        푸드라인은 큐텍코리아를 합병했다고 15일 밝혔다. 큐텍은 배민 등 주문형 배달 플랫폼에 들어온 콜을 라이더에게 전달하는 1세대 분리형 배달 플랫폼 개발사다. 푸드라인은 큐텍 합병을 통해 상점과 라이더를 확보하고 기존 사업과 시너지를 낸다는 전략이다.
                        <br><br>
                        푸드라인은 주문 중개 애플리케이션(앱) 'CS몰'을 운영 중이다. 식당에서 필요한 식자재를 도매가에 판매하고 무료로 배송할 계획이다. 해당 몰 내에서 식자재를 구매한 식당에게는 포인트를 지급, 푸드라인 배달 라이더 이용시 활용할 수 있다. 푸드라인 라이더에게 지급해야 하는 배달료 일부를 지원한다.
                        <br><br>
                        <a href="https://n.news.naver.com/article/030/0003173421?lfrom=kakao" target="_blank">뉴스 바로가기</a>
                    </div>
                </div>
        </section>


    <section class="idx_review">
        <div class="titleArea">
            <span class="wow fadeInDown" data-wow-delay="0.3s">FOOD<span class="txtRed">L</span>INE rider REVIEW</span>
            <h3 class="wow fadeInUp" data-wow-delay="0.4s"><span class="txtRed">라</span>이더의 현장이야기</h3>
        </div>
        <!-- Swiper -->
        <div class="swiper swiperReview wow fadeInUp" data-wow-delay="0.5s">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="box">
                        <div class="imgArea">
                            <img src="<?php echo G5_THEME_IMG_URL ?>/sub/rider_review01.jpg">
                        </div>
                        <div class="txtArea">
                            <span>안전라이더</span>
                            <p>도전의 순간, 배달 라이더의 기억에 남는 배달 이야기</p>
                            <div>어느 날, 빠른 배달을 위해 서둘러 골목길을 달리던 라이더가 갑작스런 차량 결함으로 인해 급제동을 걸어야 하는 상황에 처했습니다. 이 불가피한 도전 속에서 그는 고객의 음식을 안전하게 전달하기 위해 무모한 상황에서 창의적인 해결책을 찾아내는 이야기를 풀어냅니다.</div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="box">
                        <div class="imgArea">
                            <img src="<?php echo G5_THEME_IMG_URL ?>/sub/rider_review02.jpg">
                        </div>
                        <div class="txtArea">
                            <span>스피드라이더</span>
                            <p>비 오는 날의 히어로, 라이더의 용기로운 대응</p>
                            <div>비 오는 날, 한 손에는 음식 가방을 들고 다른 손에는 우산을 든 라이더가 있었습니다. 그는 가끔은 우산을 쓰기 힘들 때도 있었지만, 고객의 기대와 배달의 미션에 충실하기 위해 비 오는 날도 흔들림 없이 음식을 배달하는 용감한 모습을 선보였습니다.</div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="box">
                        <div class="imgArea">
                            <img src="<?php echo G5_THEME_IMG_URL ?>/sub/rider_review03.jpg">
                        </div>
                        <div class="txtArea">
                            <span>친절라이드</span>
                            <p>미소와 감동, 배달 라이더의 특별한 배달 경험</p>
                            <div>어느 날, 라이더는 주문받은 음식을 전달하러 갔는데, 고객이 축하 파티를 열고자 한다는 이야기를 듣게 되었습니다. 특별한 날을 함께하게 된 라이더는 그들의 행복한 순간에 함께 웃음과 감동을 전하며 배달이 더 특별한 경험으로 남았던 이야기를 소개합니다.</div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="box">
                        <div class="imgArea">
                            <img src="<?php echo G5_THEME_IMG_URL ?>/sub/rider_review01.jpg">
                        </div>
                        <div class="txtArea">
                            <span>안전라이더</span>
                            <p>도전의 순간, 배달 라이더의 기억에 남는 배달 이야기</p>
                            <div>어느 날, 빠른 배달을 위해 서둘러 골목길을 달리던 라이더가 갑작스런 차량 결함으로 인해 급제동을 걸어야 하는 상황에 처했습니다. 이 불가피한 도전 속에서 그는 고객의 음식을 안전하게 전달하기 위해 무모한 상황에서 창의적인 해결책을 찾아내는 이야기를 풀어냅니다.</div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="box">
                        <div class="imgArea">
                            <img src="<?php echo G5_THEME_IMG_URL ?>/sub/rider_review02.jpg">
                        </div>
                        <div class="txtArea">
                            <span>스피드라이더</span>
                            <p>비 오는 날의 히어로, 라이더의 용기로운 대응</p>
                            <div>비 오는 날, 한 손에는 음식 가방을 들고 다른 손에는 우산을 든 라이더가 있었습니다. 그는 가끔은 우산을 쓰기 힘들 때도 있었지만, 고객의 기대와 배달의 미션에 충실하기 위해 비 오는 날도 흔들림 없이 음식을 배달하는 용감한 모습을 선보였습니다.</div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="box">
                        <div class="imgArea">
                            <img src="<?php echo G5_THEME_IMG_URL ?>/sub/rider_review03.jpg">
                        </div>
                        <div class="txtArea">
                            <span>친절라이드</span>
                            <p>미소와 감동, 배달 라이더의 특별한 배달 경험</p>
                            <div>어느 날, 라이더는 주문받은 음식을 전달하러 갔는데, 고객이 축하 파티를 열고자 한다는 이야기를 듣게 되었습니다. 특별한 날을 함께하게 된 라이더는 그들의 행복한 순간에 함께 웃음과 감동을 전하며 배달이 더 특별한 경험으로 남았던 이야기를 소개합니다.</div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="swiper-pagination"></div>
        </div>

        <div class="text-center wow fadeInDown" data-wow-delay="0.6s">
            <a class="btnRed">후기 더보기 <i class="fa-light fa-plus"></i></a>
        </div>
    </section>
    <section class="idx_overview wow fadeInDown" data-wow-delay="0.3s">
        <div class="inr">
            <div class="text">
                <div class="line wow fadeInLeft" data-wow-delay="0.4s">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/main/foodline.png">
                </div>
                <h4>
                    <p class="wow fadeInLeft" data-wow-delay="0.5s">언제나, 어디서나 푸드라인이</p>
                    <p class="txtRed wow fadeInRight" data-wow-delay="0.6s">배달로 길을 이어드립니다.</p>
                </h4>
                <div class="conts wow fadeInLeft" data-wow-delay="0.7s">
                    편리하고 효율적인 시스템과 전문적인 컨설팅을 통해 <br>
                    최상의 서비스를 약속드립니다. <br>
                    라이더와 가맹점 모두가 상생하는 미래, 푸드라인이 만듭니다.
                </div>
            </div>
        </div>
    </section>
</div>
    <script>
        // Initialize Swiper when the DOM is ready
        document.addEventListener('DOMContentLoaded', function () {
            //메인
            var mySwiper = new Swiper('.swiperVisual', {
                slidesPerView: 1,
                spaceBetween: 0,
                loop: true,
                autoplay: {
                    delay: 6000, // milliseconds
                    disableOnInteraction: false,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
            });

            //서비스
            var swiper = new Swiper(".swiperService", {
                scrollbar: {
                    el: ".swiper-scrollbar",
                    hide: false,
                },
                mousewheel: {
                    enabled: true,
                },
            });

            //리뷰
            var swiper = new Swiper(".swiperReview", {
                slidesPerView: 1,
                spaceBetween: 30,
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                loop: true, // Enable looping
                autoplay: {
                    delay: 3000, // Set the delay in milliseconds
                    disableOnInteraction: false, // Allow manual navigation while autoplay is active
                },
                breakpoints: {
                    // When window width is <= 768px, set slidesPerView to 1
                    1200: {
                        slidesPerView: 3,
                    },
                    768: {
                        slidesPerView: 2,
                    },
                },
            });
        });
    </script>
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

<?php
include_once(G5_PATH.'/tail.php');
?>