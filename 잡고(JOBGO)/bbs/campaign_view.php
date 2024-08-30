<?php
global $pid;
$pid = "campagin_view";
$sub_id = "campagin_view";
include_once('./_common.php');
include_once("../jl/JlConfig.php");

if(!$_GET['idx']) alert("잘못된경로입니다.");

//캠페인 데이터
$model = new JlModel(array(
    "table" => "campaign",
    "primary" => "idx",
    "autoincrement" => true,
    "empty" => false
));
$data = $model->where("idx",$_GET['idx'])->get()['data'][0];

$g5['title'] = '상세';
include_once('./_head.php');
?>


    <article id="item_view">

        <!--아이템 뷰-->
        <section id="content_wrap">

            <!--아이템정보 왼쪽-->
            <div class="scroll_content">

                <!--이미지롤링-->
                <!-- Swiper -->
                <div class="swiper camSwiper">
                    <div class="swiper-wrapper">
                        <? foreach($data['thumb'] as $d) { ?>
                        <div class="swiper-slide"><img src="<?=$jl->URL.$d['src']?>"></div>
                        <?}?>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
                <!-- Initialize Swiper -->
                <script>
                    var swiper = new Swiper(".camSwiper", {
                        pagination: {
                            el: ".swiper-pagination",
                        },
                        autoHeight : true,
                    });
                </script>

                <!--가격/재능 정보 모바일 view-->
                <div class="fix_info visible-xs">
                    <div id="cam_count" class="flex ai-c gap10">
                        <div class="mb flex gap5 ai-c">
                            <div class="count">
                                <b class="txt_color">0</b>/<?=$data['recruitment']?>
                            </div>
                            <p><?=$data['status']?></p>
                        </div>
                        <div class="heart male-auto" name="">
                            <button type="button" class="heart off"><img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_off.png" alt="좋아요off" title="좋아요off"></button>
                        </div>
                    </div>
                    <header>
                        <h6 class="item_tit"><?=$data['subject']?></h6>
                        <p class="txt_color"><?=$data['company_name']?></p>
                    </header>
                    <div id="cam_info">
                        <p class="flex ai-c jc-sb">
                            <span>모집기간</span>
                            <span><?=$data['recruitment_date']?>까지</span>
                        </p>
                        <p class="flex ai-c jc-sb">
                            <span>활동기간</span>
                            <span><?=$data['activity_date']?>까지</span>
                        </p>
                        <p class="flex ai-c jc-sb">
                            <span>제공내역</span>
                            <span><?=$data['service']?> + <b class="txt_color">잡고 캐쉬 <?=number_format($data['service_cash'])?></b></span>
                        </p>
                    </div>
                    <button type="button" class="btn btn_large btn_color" onclick="showConfirm('신청완료', '결과는 캠페인 관리에서 확인하세요.')">신청하기</button>

                    <!--업체정보-->
                    <section class="mem_info">
                        <!--사진-->
                        <div class="myimg">
                            <!-- 등록 이미지 있을 경우 -->
                            <div class="p_box">
                                <div class="img_rd">
                                    <?if($data['company_thumb']) {?>
                                    <img class="p_img" src="<?=$jl->URL.$data['company_thumb']['src']?>">
                                    <?}else {?>
                                    <img class="p_img" src="<?php echo G5_THEME_IMG_URL ?>/main/no_img.jpg">
                                    <?}?>
                                </div>
                                <p class="name"><?=$data['company_name']?></p>
                            </div>
                        </div>
                        <div class="profile">
                            <ul>
                                <li>
                                    <dl>
                                        <dt>영업 시간</dt>
                                        <dd><?=$data['company_time']?></dd>
                                    </dl>
                                </li>
                                <li>
                                    <dl>
                                        <dt>대표전화</dt>
                                        <dd><?=$data['company_tel']?></dd>
                                    </dl>
                                </li>
                            </ul>
                        </div>
                        <p class="introduce"><span><?=$data['company_address1']?> | <?=$data['company_address2']?></span>
                        </p>
                    </section>
                    <button type="button" class="btn btn_large btn_gray" style="margin-bottom: 20px">캠페인에 대해 궁금한 점이 있나요?</button>
                </div>
                <!--//업체 정보 모바일 view-->


                <!--탭-->
                <div class="tabArea">

                    <section class="et-hero-tabs">
                        <div class="et-hero-tabs-container">
                            <a class="et-hero-tab" href="#info">기본안내</a>
                            <a class="et-hero-tab" href="#service">제공내역</a>
                            <a class="et-hero-tab" href="#react">필수활동</a>
                            <a class="et-hero-tab" href="#notice" style="border-right:0">안내사항</a>
                            <span class="et-hero-tab-slider" style="width: 0px; left: 0px;"></span>
                        </div>
                    </section>

                    <div class="et-main cont">
                        <section class="et-slide" id="info">
                            <h3 class="title">기본안내</h3>
                            <div class="content-wrapper" id="content">
                                <?=str_replace("\\", " ", $data['basic_guide'])?>
                            </div>
                            <button class="more-btn btn btn_line w100" id="moreBtn">더보기</button>
                        </section>

                        <hr/>

                        <section class="et-slide" id="service">
                            <h3 class="title">제공내역</h3>
                            <div style="white-space: pre-wrap !important;"><?=$data['service']?> + 잡고 캐쉬 <?=number_format($data['service_cash'])?></div>
                        </section>

                        <hr/>

                        <section class="et-slide" id="react">
                            <h3 class="title">필수활동</h3>
                            <div style="white-space: pre-wrap !important;">
                                <?=$data['required']?>
                            </div>
                        </section>

                        <hr/>

                        <section class="et-slide" id="notice">
                            <h3 class="title">안내사항</h3>
                            <div style="white-space: pre-wrap !important;">
- 캠페인 미션 또는 가이드라인이 지켜지지 않을 시에 수정 요청이 있을 수 있습니다.
- 기자단 캠페인은 가이드라인과 사진이 별도로 제공될 수 있습니다.
- 사진을 제공하는 캠페인의 경우, 사진을 편집하여 콘텐츠 등록 부탁드립니다.
- 협의없이 캠페인 취소는 불가하오니, 취소 사유를 반드시 알려주시길 바랍니다.
- 포인트는 캠페인 참여 완료 확인 이후 14일 이내로 지급됩니다.
- 업체 측 요청에 따라 선정 인플루언서 수가 변경될 수 있습니다.
- 작성하신 콘텐츠는 반드시 6개월동안 유지하여야 하며, 미유지 시 페널티가 부과됩니다.
                            </div>
                        </section>

                    </div>

                </div><!--//tabArea-->

            </div>


            <!-- 정보 오른쪽 모바일 사라짐-->
            <div class="fix_info hidden-xs">
                <div id="cam_count" class="flex ai-c gap10">
                    <div class="mb flex gap5 ai-c">
                        <div class="count">
                            <b class="txt_color">0</b>/<?=$data['recruitment']?>
                        </div>
                        <p><?=$data['status']?></p>
                    </div>
                    <div class="heart male-auto" name="">
                        <button type="button" class="heart off"><img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_off.png" alt="좋아요off" title="좋아요off"></button>
                    </div>
                </div>
                <header>
                    <h6 class="item_tit"><?=$data['subject']?></h6>
                    <p class="txt_color"><?=$data['company_name']?></p>
                </header>
                <div id="cam_info">
                    <p class="flex ai-c jc-sb">
                        <span>모집기간</span>
                        <span><?=$data['recruitment_date']?>까지</span>
                    </p>
                    <p class="flex ai-c jc-sb">
                        <span>활동기간</span>
                        <span><?=$data['activity_date']?>까지</span>
                    </p>
                    <p class="flex ai-c jc-sb">
                        <span>제공내역</span>
                        <span><?=$data['service']?> + <b class="txt_color">잡고 캐쉬 <?=number_format($data['service_cash'])?></b></span>
                    </p>
                </div>
                <button type="button" class="btn btn_large btn_color" onclick="showConfirm('신청완료', '결과는 캠페인 관리에서 확인하세요.')">신청하기</button>

                <!--업체정보-->
                <section class="mem_info">
                    <!--사진-->
                    <div class="myimg">
                        <!-- 등록 이미지 있을 경우 -->
                        <div class="p_box">
                            <div class="img_rd">
                                <?if($data['company_thumb']) {?>
                                    <img class="p_img" src="<?=$jl->URL.$data['company_thumb']['src']?>">
                                <?}else {?>
                                    <img class="p_img" src="<?php echo G5_THEME_IMG_URL ?>/main/no_img.jpg">
                                <?}?>
                            </div>
                            <p class="name"><?=$data['subject']?></p>
                        </div>
                    </div>
                    <div class="profile">
                        <ul>
                            <li>
                                <dl>
                                    <dt>영업 시간</dt>
                                    <dd><?=$data['company_time']?></dd>
                                </dl>
                            </li>
                            <li>
                                <dl>
                                    <dt>대표전화</dt>
                                    <dd><?=$data['company_tel']?></dd>
                                </dl>
                            </li>
                        </ul>
                    </div>
                    <p class="introduce"><span><?=$data['company_address1']?> | <?=$data['company_address2']?></span>
                    </p>
                </section>
                <button type="button" class="btn btn_large btn_gray">캠페인에 대해 궁금한 점이 있나요?</button>
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