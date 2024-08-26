<?php
global $pid;
$pid = "job_view";
$sub_id = "job_view";
include_once('./_common.php');

$g5['title'] = '구인 상세';
include_once('./_head.php');
?>


    <article id="item_view" class="jobs">
        <div class="job_info">
            <div class="heart">
                <button type="button" class="heart off"><img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_off.png" alt="좋아요off" title="좋아요off"></button>
            </div>
            <header>
                <h6 class="item_tit">공고 제목</h6>
                <p class="txt_color">업체명</p>
            </header>
            <div id="cam_info">
                <p class="flex ai-c jc-sb">
                    <span>접수기간</span>
                    <span>2024.09.01까지</span>
                </p>
                <p class="flex ai-c jc-sb">
                    <span>급여형태</span>
                    <span>월 0원</span>
                </p>
            </div>
        </div>
        <!--아이템 뷰-->
        <section id="content_wrap">

            <!--아이템정보 왼쪽-->
            <div class="scroll_content">


                <!--정보 모바일 view-->
                <div class="fix_info visible-xs">
                    <button type="button" class="btn btn_large btn_color" onclick="showConfirm('신청완료', '결과는 마이페이지에서 확인하세요.')">지원하기</button>

                    <!--업체정보-->
                    <section class="mem_info">
                        <!--사진-->
                        <div class="myimg">
                            <!-- 등록 이미지 있을 경우 -->
                            <div class="p_box">
                                <div class="img_rd">
                                    <img class="p_img" src="<?php echo G5_THEME_IMG_URL ?>/main/no_img.jpg">
                                </div>
                                <p class="name">업체명</p>
                            </div>
                        </div>
                        <div class="profile">
                            <ul>
                                <li>
                                    <dl>
                                        <dt>채용 담당자</dt>
                                        <dd>담당자</dd>
                                    </dl>
                                </li>
                                <li>
                                    <dl>
                                        <dt>담당자 연락처</dt>
                                        <dd>070-000-000</dd>
                                    </dl>
                                </li>
                            </ul>
                        </div>
                        <p class="introduce"><span>기업 주소 | 주소</span>
                        </p>
                    </section>
                </div>
                <!--// 정보 모바일 view-->


                <!--탭-->
                <div class="tabArea">

                    <section class="et-hero-tabs">
                        <div class="et-hero-tabs-container">
                            <a class="et-hero-tab" href="#info">근무/모집 조건</a>
                            <a class="et-hero-tab" href="#details">상세 요강</a>
                            <a class="et-hero-tab" href="#company" style="border-right:0">기업 정보</a>
                            <span class="et-hero-tab-slider" style="width: 0px; left: 0px;"></span>
                        </div>
                    </section>

                    <div class="et-main cont">

                        <section class="et-slide" id="info">
                            <h3 class="title">근무 조건</h3>
                            <div>
                                <ul class="gridInfo">
                                    <li>
                                        <b>급여</b>
                                        <p class="txt_color">월급 | 2,700,000원</p>
                                        <p>고정급(216만원) + 인센티브(최대80만원) + 프로모션 + 정착수당(총150만원)</p>
                                    </li>
                                    <li>
                                        <b>직종</b>
                                        <p>서비스 기타, 고객상담·인바운드, 텔레마케팅·아웃바운드</p>
                                    </li>
                                    <li>
                                        <b>근무기간</b>
                                        <p>1년이상</p>
                                    </li>
                                    <li>
                                        <b>고용형태</b>
                                        <p>정규직</p>
                                    </li>
                                    <li>
                                        <b>근무시간</b>
                                        <p>09:00~18:00 | 휴게시간 60분</p>
                                    </li>
                                    <li>
                                        <b>복리후생</b>
                                        <p>국민연금, 고용보험, 산재보험, 건강보험, 연차, 인센티브제, 퇴직연금, 장기근속자 포상, 우수사원 표창/포상, 장기근속수당, 각종 경조금, 경조휴가제, 연월차수당</p>
                                    </li>
                                    <li>
                                        <b>근무요일</b>
                                        <p>주말 / 공휴일 휴무 (주5일)</p>
                                    </li>
                                    <li>
                                        <b>근무지역</b>
                                        <p>서울 강남구 역삼동 790-5 4층</p>
                                    </li>
                                </ul>
                            </div>
                            <div id="daumRoughmapContainer1724646483142" class="root_daum_roughmap root_daum_roughmap_landing" style="width: 100%; margin: 25px 0"></div>
                            <script charset="UTF-8" class="daum_roughmap_loader_script" src="https://ssl.daumcdn.net/dmaps/map_js_init/roughmapLoader.js"></script>
                            <script charset="UTF-8">
                                new daum.roughmap.Lander({
                                    "timestamp" : "1724646483142",
                                    "key" : "2kg9q",
                                    "mapHeight" : "200"
                                }).render();
                            </script>
                            <h3 class="title">모집 조건</h3>
                            <div>
                                <ul class="gridInfo">
                                    <li>
                                        <b>학력/경력</b>
                                        <p>무관/무관</p>
                                    </li>
                                    <li>
                                        <b>모집인원</b>
                                        <p>00명(미정)</p>
                                    </li>
                                </ul>
                            </div>
                        </section>
                        <hr/>

                        <section class="et-slide" id="details">
                            <h3 class="title">상세 요강</h3>
                            <div class="content-wrapper" id="content">
                                <!-- 콘텐츠 -->
                                <img src="<?php echo G5_THEME_IMG_URL ?>/main/no_img.jpg">
                                <img src="<?php echo G5_THEME_IMG_URL ?>/main/no_img.jpg">
                                <img src="<?php echo G5_THEME_IMG_URL ?>/main/no_img.jpg">
                            </div>
                            <button class="more-btn btn btn_line w100" id="moreBtn">더보기</button>
                        </section>
                        <hr/>

                        <section class="et-slide" id="company">
                            <h3 class="title">기업 정보</h3>
                            <div>
                                <ul class="gridInfo">
                                    <li>
                                        <b>대표</b>
                                        <p>대표자</p>
                                    </li>
                                    <li>
                                        <b>사업내용</b>
                                        <p>인재파견, 콜센터운영, 아웃소싱</p>
                                    </li>
                                    <li>
                                        <b>회사주소</b>
                                        <p>서울 성동구 아차산로 126 (성수동2가, 더리브세종타워) 9층</p>
                                    </li>
                                    <li>
                                        <b>홈페이지 </b>
                                        <p><a href="www.jobgo.ac" target="_blank">www.jobgo.ac</a></p>
                                    </li>
                                </ul>
                            </div>
                        </section>

                    </div>

                </div><!--//tabArea-->

            </div>


            <!-- 정보 오른쪽 모바일 사라짐-->
            <div class="fix_info hidden-xs">
                <button type="button" class="btn btn_large btn_color" onclick="showConfirm('지원할까요?', '결과는 마이페이지에서 확인하세요.')">지원하기</button>

                <!--업체정보-->
                <section class="mem_info">
                    <!--사진-->
                    <div class="myimg">
                        <!-- 등록 이미지 있을 경우 -->
                        <div class="p_box">
                            <div class="img_rd">
                                <img class="p_img" src="<?php echo G5_THEME_IMG_URL ?>/main/no_img.jpg">
                            </div>
                            <p class="name">업체명</p>
                        </div>
                    </div>
                    <div class="profile">
                        <ul>
                            <li>
                                <dl>
                                    <dt>채용 담당자</dt>
                                    <dd>담당자</dd>
                                </dl>
                            </li>
                            <li>
                                <dl>
                                    <dt>담당자 연락처</dt>
                                    <dd>070-000-000</dd>
                                </dl>
                            </li>
                        </ul>
                    </div>
                    <p class="introduce"><span>기업 주소 | 주소</span>
                    </p>
                </section>
            </div>
            <!--// 정보 오른쪽 모바일 사라짐-->

        </section>
        <!--아이템 뷰-->

    </article>

    <script>
        const content = document.getElementById('content');
        const moreBtn = document.getElementById('moreBtn');

        moreBtn.addEventListener('click', () => {
            content.classList.toggle('expanded');
            if (content.classList.contains('expanded')) {
                moreBtn.classList.add('hidden'); // 버튼 숨기기
            }
        });
    </script>

    <script id="rendered-js">

        function detail_produce(){
            $('[name = prev_produce]').css('display','none')
        }
        class StickyNavigation {//스크롤탭 JS

            constructor() {
                this.currentId = null;
                this.currentTab = null;
                this.tabContainerHeight = 147;
                this.lastScroll = 0;
                let self = this;
                $('.et-hero-tab').click(function () {
                    self.onTabClick(event, $(this));
                });
                $(window).scroll(() => {
                    this.onScroll();
                });
                $(window).resize(() => {
                    this.onResize();
                });
            }

            onTabClick(event, element) {
                event.preventDefault();
                let scrollTop = $(element.attr('href')).offset().top - this.tabContainerHeight + 1;
                $('html, body').animate({scrollTop: scrollTop}, 600);
            }

            onScroll() {
                this.checkHeaderPosition();
                this.findCurrentTabSelector();
                this.lastScroll = $(window).scrollTop();
            }

            onResize() {
                if (this.currentId) {
                    this.setSliderCss();
                }
            }

            checkHeaderPosition() {
                const headerHeight = 75;
                if ($(window).scrollTop() > headerHeight) {
                    $('.et-header').addClass('et-header--scrolled');
                } else {
                    $('.et-header').removeClass('et-header--scrolled');
                }
                let offset = $('.et-hero-tabs').offset().top + $('.et-hero-tabs').height() - this.tabContainerHeight - headerHeight;
                if ($(window).scrollTop() > this.lastScroll && $(window).scrollTop() > offset) {
                    $('.et-header').addClass('et-header--move-up');
                    $('.et-hero-tabs-container').removeClass('et-hero-tabs-container--top-first');
                    $('.et-hero-tabs-container').addClass('et-hero-tabs-container--top-second');
                } else if ($(window).scrollTop() < this.lastScroll && $(window).scrollTop() > offset) {
                    $('.et-header').removeClass('et-header--move-up');
                    $('.et-hero-tabs-container').removeClass('et-hero-tabs-container--top-second');
                    $('.et-hero-tabs-container').addClass('et-hero-tabs-container--top-first');
                } else {
                    $('.et-header').removeClass('et-header--move-up');
                    $('.et-hero-tabs-container').removeClass('et-hero-tabs-container--top-first');
                    $('.et-hero-tabs-container').removeClass('et-hero-tabs-container--top-second');
                }
            }

            findCurrentTabSelector(element) {
                let newCurrentId;
                let newCurrentTab;
                let self = this;
                $('.et-hero-tab').each(function () {
                    let id = $(this).attr('href');
                    let offsetTop = $(id).offset().top - self.tabContainerHeight;
                    let offsetBottom = $(id).offset().top + $(id).height() - self.tabContainerHeight;
                    if ($(window).scrollTop() > offsetTop && $(window).scrollTop() < offsetBottom) {
                        newCurrentId = id;
                        newCurrentTab = $(this);
                    }
                });
                if (this.currentId != newCurrentId || this.currentId === null) {
                    this.currentId = newCurrentId;
                    this.currentTab = newCurrentTab;
                    this.setSliderCss();
                }
            }

            setSliderCss() {
                let width = 0;
                let left = 0;
                if (this.currentTab) {
                    width = this.currentTab.css('width');
                    left = this.currentTab.offset().left;
                }
                $('.et-hero-tab-slider').css('width', width);
                $('.et-hero-tab-slider').css('left', left);
            }
        }

        new StickyNavigation();
        //# sourceURL=pen.js
    </script>


<?php
include_once('./_tail.php');
?>