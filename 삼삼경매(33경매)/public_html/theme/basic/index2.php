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
	<div id="visual" class="wow fadeInDown animated">
		<div class="txt">
			<h3 class="wow fadeInDown" data-wow-delay="0.1s">안정적인 목돈관리 수익과<br>
            은행보다 높은 수익이 없을까?</h3>
			<h2 class="wow fadeInDown" data-wow-delay="0.2s">담보물채권 / 경매의 <strong class="color_blue">새로운 가치 투자</strong></h2>
			<p class="wow fadeInDown" data-wow-delay="0.3s">
				각 분야별 전문 강사님들이 <br class="visible-sm visible-xs">당신을 위한 핵심 강좌를 준비하고 있습니다.
			</p>
            <a class="btn wow fadeInDown" data-wow-delay="0.4s" href="<?php echo G5_BBS_URL ?>/content.php?co_id=company">삼삼경매란?</a>
		</div>
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide mv01"></div>
                <div class="swiper-slide mv02"></div>
                <div class="swiper-slide mv03"></div>
            </div>
            <div class="swiper-pagination"></div>
        </div>

        <!--<ul class="sliderbx">
			<li class="mv01"></li>
			<li class="mv02"></li>
		</ul>-->
		<!--.sliderbx-->
        <div class="line">
            <i class="left"></i>
            <i class="right"></i>
            <i class="bottom"></i>
        </div>
		<div class="scrolldown wow fadeInUp" data-wow-delay="0.4s">
            <a href="#content"><i class="fa-regular fa-chevron-down"></i><span>SCROLL DOWN</span></a>
		</div>
		<div id="notice" class="wow fadeInUp" data-wow-delay="0.4s">
			<h4>
				새소식을 전해드립니다.
				<a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=notice" class="btn_moreview">더보기<i class="fa-regular fa-plus"></i></a>
			</h4>
			<?php echo latest("theme/basic", "notice", 1, 30); ?>
		</div>


	</div><!-- //visual -->

</div><!--  #idx_wrapper -->
<div id="content">

	<div class="area_business">
		<div class="area_title">
			<h5 class="wow fadeInDown" data-wow-delay="0.1s"><strong>BUSINESS</strong> AREA</h5>
			<p class="eng wow fadeInDown" data-wow-delay="0.3s">creative + property<br class="hidden-xs">
                + investment</p>
			<span class="wow fadeInDown" data-wow-delay="0.4s">삼삼경매 에서는 직접 투자를 통한 <br class="hidden-xs">
                노하우와 경험을 여러분께 전달해 <br class="hidden-xs">
                드리고 있습니다.</span>
            <br>
            <a class="btn_more" href="<?php echo G5_BBS_URL ?>/content.php?co_id=service01">MORE VIEW <i class="fa-light fa-chevron-right"></i></a>
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
                            <dt><strong>01</strong> 부동산 경매, 공매</dt>
                            <dd>부동산 경매 및 공매를 통해 투자 및 매각 기회를 제공하며 전문적인 컨설팅을 지원합니다.</dd>
                        </dl>
                    </div>
                    <div class="swiper-slide b02 wow fadeInLeft animated" data-wow-delay="0.8s" data-wow-duration="0.8s">
                        <dl>
                            <dt><strong>02</strong> GPL, NPL 투자</dt>
                            <dd>건전한 금융 거래 지원을 위한 GPL/NPL 투자 솔루션을 제공, 자산의 효율적인 운용을 돕습니다.</dd>
                        </dl>
                    </div>
                    <div class="swiper-slide b03 wow fadeInLeft animated" data-wow-delay="1.1s" data-wow-duration="0.8s">
                        <dl>
                            <dt><strong>03</strong> 경매취하</dt>
                            <dd>부동산 경매의 취소나 조정이 필요할 때 법적 절차와 시장 동향에 대한 조언을 제공하여 안정적인 해결책을 찾아줍니다.</dd>
                        </dl>
                    </div>
                    <div class="swiper-slide b04 wow fadeInLeft animated" data-wow-delay="1.4s" data-wow-duration="0.8s">
                        <dl>
                            <dt><strong>04</strong> 대위변제</dt>
                            <dd>채무자를 대신하여 채무를 변제하는 대위변제 서비스를 제공하여 재무적인 부담을 덜어줍니다.</dd>
                        </dl>
                    </div>
                    <div class="swiper-slide b05 wow fadeInLeft animated" data-wow-delay="1.7s" data-wow-duration="0.8s">
                        <dl>
                            <dt><strong>05</strong> 집행정지</dt>
                            <dd>부동산 경매에서 법적 절차를 통해 집행을 정지시키고 관리하여 전문가들은 경매 취소나 조정을 위해 필수적인 역할을 합니다.</dd>
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
                    </div>
                    <!--<div class="swiper-slide b01 wow fadeInLeft animated" data-wow-delay="0.5s" data-wow-duration="0.8s">
                        <dl>
                            <dt><strong>01</strong> 매매사업자</dt>
                            <dd>매매사업자는 법원 경매를 모니터링하고, 매매 가능성이 높은 매물을 선정하여 매입을 진행합니다.</dd>
                        </dl>
                    </div>
                    <div class="swiper-slide b02 wow fadeInLeft animated" data-wow-delay="0.8s" data-wow-duration="0.8s">
                        <dl class="b02">
                            <dt><strong>02</strong> 공인중개사사무소</dt>
                            <dd>공인중개사사무소에서는 법원 경매 물건을 중개하고, 관련 정보를 제공하여 거래를 돕습니다.</dd>
                        </dl>
                    </div>
                    <div class="swiper-slide b03 wow fadeInLeft animated" data-wow-delay="1.1s" data-wow-duration="0.8s">
                        <dl>
                            <dt><strong>03</strong> 법률경매</dt>
                            <dd>법률경매에서는 법률적인 자문과 함께 경매 절차를 지원하며, 법적 문제 해결을 돕습니다.</dd>
                        </dl>
                    </div>
                    <div class="swiper-slide b04 wow fadeInLeft animated" data-wow-delay="1.4s" data-wow-duration="0.8s">
                        <dl>
                            <dt><strong>04</strong> 대부사업자</dt>
                            <dd>대부사업자는 경매 매물의 자금 조달을 지원하고, 필요한 대출 서비스를 제공합니다.</dd>
                        </dl>
                    </div>
                    <div class="swiper-slide b05 wow fadeInLeft animated" data-wow-delay="1.7s" data-wow-duration="0.8s">
                        <dl>
                            <dt><strong>05</strong> 협업법무사</dt>
                            <dd>협업법무사는 경매 절차와 관련된 법률 서비스를 제공하고, 문서 작성 및 검토를 지원합니다.</dd>
                        </dl>
                    </div>-->
                </div>
            </div>
        </div>
    </div>

    <div class="area_performance">
        <div class="area_title">
            <h5 class="wow fadeInDown" data-wow-delay="0.1s"><strong>BUSINESS</strong> performance</h5><br>
            <span class="wow fadeInDown" data-wow-delay="0.4s">삼삼경매에서는 직접투자를 통한 노하우와 경험을 여러분께 전달해 드리고 있습니다.</span>
            <br>
        </div>
        <div class="counter_area">
            <!--숫자증감애니메이션-->
            <div class="counterareabg">
                <div class="counter_wrap">
                    <p><span class="counter" data-start="0" data-end="57"><br />0</span></p>
                    <p><span class="counter" data-start="0" data-end="120">0</span></p>
                    <p><span class="counter" data-start="0" data-end="2120">0</span></p>
                    <p><span class="counter" data-start="0" data-end="283">0</span></p>
                </div>
                <div class="title_wrap">
                    <div class="inr">
                        <div class="title">
                            <p>일일 모니터링 경매 물건</p>
                            <span>2024년 기준</span>
                        </div>
                        <div class="title">
                            <p>현재 진행중인 경매물건</p>
                            <span>2024년 5월 기준</span>
                        </div>
                        <div class="title">
                            <p>완료된 경매 물건</p>
                            <span>2024년 기준</span>
                        </div>
                        <div class="title">
                            <p>관리중인 경매 물건</p>
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

    <div class="area_expert">
        <div class="area_title">
            <h5 class="wow fadeInDown" data-wow-delay="0.1s"><strong>EXPERT</strong> OFFLINE CLASS</h5><br>
            <span class="wow fadeInDown" data-wow-delay="0.4s">부동산 경매 전문가와 함께하는 오프라인 클래스, 삼삼경매만의 차별화를 경험하세요</span>
        </div>
        <div class="area_swiper wow fadeInLeft animated" data-wow-delay="0.5s" data-wow-duration="0.8s">
            <div class="swiper expert">
                <div class="swiper-button-wrap">
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="area_img">
                            <div class="img"><img src="<?php echo  G5_THEME_IMG_URL?>/main/expert_img_noimg.png"></div>
                            <div class="title">
                                <span>경매기초학습</span>
                                <p>어떻게 투자 할 것인가?<br>투자방법 분석</p>
                            </div>
                        </div>
                        <div class="area_text">
                            <p>[경매기초학습] 어떻게 투자할 것인가? 초보 경매 투자방법 분석을 밝혀 드립니다.</p>
                            <span>부동산학과 홍길동 교수</span>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="area_img">
                            <div class="img"><img src="<?php echo  G5_THEME_IMG_URL?>/main/expert_img_test01.png"></div>
                            <div class="title">
                                <span>경매기초학습</span>
                                <p>어떻게 투자 할 것인가?<br>투자방법 분석</p>
                            </div>
                        </div>
                        <div class="area_text">
                            <p>[경매기초학습] 어떻게 투자할 것인가? 초보 경매 투자방법 분석을 밝혀 드립니다.</p>
                            <span>부동산학과 홍길동 교수</span>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="area_img">
                            <div class="img"><img src="<?php echo  G5_THEME_IMG_URL?>/main/expert_img_test02.png"></div>
                            <div class="title">
                                <span>경매기초학습</span>
                                <p>어떻게 투자 할 것인가?<br>투자방법 분석</p>
                            </div>
                        </div>
                        <div class="area_text">
                            <p>[경매기초학습] 어떻게 투자할 것인가? 초보 경매 투자방법 분석을 밝혀 드립니다.</p>
                            <span>부동산학과 홍길동 교수</span>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="area_img">
                            <div class="img"><img src="<?php echo  G5_THEME_IMG_URL?>/main/expert_img_test03.png"></div>
                            <div class="title">
                                <span>경매기초학습</span>
                                <p>어떻게 투자 할 것인가?<br>투자방법 분석</p>
                            </div>
                        </div>
                        <div class="area_text">
                            <p>[경매기초학습] 어떻게 투자할 것인가? 초보 경매 투자방법 분석을 밝혀 드립니다.</p>
                            <span>부동산학과 홍길동 교수</span>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="area_img">
                            <div class="img"><img src="<?php echo  G5_THEME_IMG_URL?>/main/expert_img_noimg.png"></div>
                            <div class="title">
                                <span>경매기초학습</span>
                                <p>어떻게 투자 할 것인가?<br>투자방법 분석</p>
                            </div>
                        </div>
                        <div class="area_text">
                            <p>[경매기초학습] 어떻게 투자할 것인가? 초보 경매 투자방법 분석을 밝혀 드립니다.</p>
                            <span>부동산학과 홍길동 교수</span>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="area_img">
                            <div class="img"><img src="<?php echo  G5_THEME_IMG_URL?>/main/expert_img_test01.png"></div>
                            <div class="title">
                                <span>경매기초학습</span>
                                <p>어떻게 투자 할 것인가?<br>투자방법 분석</p>
                            </div>
                        </div>
                        <div class="area_text">
                            <p>[경매기초학습] 어떻게 투자할 것인가? 초보 경매 투자방법 분석을 밝혀 드립니다.</p>
                            <span>부동산학과 홍길동 교수</span>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="area_img">
                            <div class="img"><img src="<?php echo  G5_THEME_IMG_URL?>/main/expert_img_test02.png"></div>
                            <div class="title">
                                <span>경매기초학습</span>
                                <p>어떻게 투자 할 것인가?<br>투자방법 분석</p>
                            </div>
                        </div>
                        <div class="area_text">
                            <p>[경매기초학습] 어떻게 투자할 것인가? 초보 경매 투자방법 분석을 밝혀 드립니다.</p>
                            <span>부동산학과 홍길동 교수</span>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="area_img">
                            <div class="img"><img src="<?php echo  G5_THEME_IMG_URL?>/main/expert_img_test03.png"></div>
                            <div class="title">
                                <span>경매기초학습</span>
                                <p>어떻게 투자 할 것인가?<br>투자방법 분석</p>
                            </div>
                        </div>
                        <div class="area_text">
                            <p>[경매기초학습] 어떻게 투자할 것인가? 초보 경매 투자방법 분석을 밝혀 드립니다.</p>
                            <span>부동산학과 홍길동 교수</span>
                        </div>
                    </div>
                </div>


            </div>
        </div>
        <a class="btn_more" href="<?php echo G5_BBS_URL ?>/class.list.php">MORE VIEW <i class="fa-light fa-chevron-right"></i></a>
    </div>

    <div class="area_company">
        <div class="area_img wow fadeInLeft animated" data-wow-delay="1.0s" data-wow-duration="0.8s">
            <img src="<?php echo G5_THEME_IMG_URL ?>/main/area_company.png">
        </div>
        <div class="area_text">
            <div class="area_title">
                <div class="wow fadeInRight animated" data-wow-delay="1.2s" data-wow-duration="0.8s">
                    <p class="eng wow fadeInDown" data-wow-delay="0.1s"><strong>SAFE</strong> INVESTMENT</p><br>
                    <h4 class="wow fadeInDown" data-wow-delay="0.1s">안전하면서 은행보다 높은 수익은?</h4>
                        <h5 class="wow fadeInDown" data-wow-delay="0.1s">삼삼경매에서 해답을 찾으세요</h5><br>
                    <span class="wow fadeInDown" data-wow-delay="0.4s">삼삼경매 에서는 직접 투자를 통한<br>
노하우와 경험을 여러분께 전달해<br>
드리고 있습니다.</span>
                </div>
            </div>
            <a class="btn_more" href="<?php echo G5_BBS_URL ?>/content.php?co_id=company">MORE VIEW <i class="fa-light fa-chevron-right"></i></a>
            <br><br>
        </div>
    </div>

    <div class="area_review">
        <div class="area_swiper wow fadeInLeft animated" data-wow-delay="0.5s" data-wow-duration="0.8s">
            <div class="swiper review">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="title">
                            <div class="icon"><img src="<?php echo G5_THEME_IMG_URL ?>/common/logo_icon.png" /></div>
                            <div class="title_text">
                                <span>직장인 김민영</span>
                                <p>주말반 3주차 성공투자를 위한 부동산 경매교육</p>
                            </div>
                        </div>
                        <div class="text">
                            인터넷에서 검색하다가 얻어걸린 강의라 솔직히 크게 기대는 안하고 첫 강의를 들었다. 그래서 현장강의도 신청하지 않았었는데, 첫번째 강의 끝나자마자 바로 가서 현장강의도 신청했다. 우선 군더더기 없는 설명이 좋았고, 이론만 주구장창 설명하지 않아서 3시간 이라는 시간이 금방 지나갔다.
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="title">
                            <div class="icon"><img src="<?php echo G5_THEME_IMG_URL ?>/common/logo_icon.png" /></div>
                            <div class="title_text">
                                <span>공인중개사 조은옥</span>
                                <p>대부업 강의후기</p>
                            </div>
                        </div>
                        <div class="text">
                            경매에 관심만 있었지 아무것도 모르는 상태에서 강의를 들었습니다
                            단어도 어렵고 생소한 용어들도 많았지만 대표님이 예시를 들어가며 이해하기 쉽게  설명을 너무 잘해주십니다. 남은 강의도 대표님의 말처럼 희망을 놓지 않고 열심히 하려고 합니다. 자국이 남을때 까지요~~~^^
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="title">
                            <div class="icon"><img src="<?php echo G5_THEME_IMG_URL ?>/common/logo_icon.png" /></div>
                            <div class="title_text">
                                <span>직장인 송한별</span>
                                <p>경매 2주차 후기입니다-^^</p>
                            </div>
                        </div>
                        <div class="text">
                            경매라는 분야에 모르는 상태에서 강의를 듣는다 했을때 막막하기도 하고 과연 제가 잘 따라갈수 있을까 걱정이 많이 되면서 신청했었습니다.
                            강의를 처음 들었을때 이해가 어렵고 멍때리면서 수업을 듣겠구나 싶었는데
                            강사님께서 경매용어들이나 내용에 있어서 하나하나 쉽게 풀어주면서 ........
                        </div>
                    </div>
                </div>
                <div class="swiper-button-wrap">
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
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

<script>
    $(document).ready(function(){
        // 스크롤이 발생할 때
        $(window).scroll(function(){
            var sct = $(window).scrollTop();
            if(sct >= 130){
                // #hd에 클래스 on 추가
                $("#hd").addClass("on");
            } else {
                // #hd에 클래스 on 제거
                $("#hd").removeClass("on");
            }
        }); // 스크롤 이벤트 끝
    });


    //bx메인슬라이더시작
    var swiper = new Swiper('.swiper-container', {
        effect: 'fade',
        fadeEffect: {
            crossFade: true
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
            renderBullet: function (index, className) {
                return '<span class="' + className + '">' + (index + 1) + '</span>';
            },
        },
        autoplay: {
            delay: 3000, // Time between transitions in milliseconds
            disableOnInteraction: false, // Keep autoplay running after user interactions
        },
        loop: true, // Enable infinite loop
    });

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
                slidesPerView: 3
            },
            // When window width is < 768px
            550: {
                slidesPerView: 1
            }
        }
    });

    var swiper = new Swiper(".expert", {
        slidesPerView: 6,
        spaceBetween: 30,
        loop: true,
        //initialSlide: 0, // Ensure the first slide starts on the left
        centeredSlides: true, // Disable centered slides
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
            992: {
                slidesPerView: 4,
                spaceBetween: 10,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 10,
            },
            // When window width is < 768px
            550: {
                slidesPerView: 2,
                spaceBetween: 10,
            }
        }
    });

    var swiper = new Swiper(".review", {
        slidesPerView: 3,
        spaceBetween: 30,
        loop: true,
        centeredSlides: true, // Disable centered slides
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        breakpoints: {
            // When window width is >= 768px
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
