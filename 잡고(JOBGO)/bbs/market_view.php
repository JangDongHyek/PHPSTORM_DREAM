<?php
global $pid;
$pid = "market_view";
$sub_id = "market_view";
include_once('./_common.php');

$g5['title'] = '마켓 상세';
include_once('./_head.php');
?>

    <article id="item_view" class="market">

        <!--아이템 뷰-->
        <section id="content_wrap">

            <!--아이템정보 왼쪽-->
            <div class="scroll_content">

                <!--이미지롤링-->
                <!-- Swiper -->
                <div class="swiper camSwiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide"><img src="<?php echo G5_THEME_IMG_URL ?>/main/no_img.jpg"></div>
                        <div class="swiper-slide"><img src="<?php echo G5_THEME_IMG_URL ?>/main/no_img.jpg"></div>
                        <div class="swiper-slide"><img src="<?php echo G5_THEME_IMG_URL ?>/main/no_img.jpg"></div>
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
                            <p>카테고리</p>
                        </div>
                        <div class="heart male-auto" name="">
                            <button type="button" class="heart off"><img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_off.png" alt="좋아요off" title="좋아요off"></button>
                        </div>
                    </div>
                    <header>
                        <h6 class="item_tit">상품명</h6>
                        <p class="txt_color">업체명</p>
                        <div class="flex ai-c gap10 end">
                            <strong class="txt_color">40%</strong>
                            <s>29,800원</s>
                        </div>
                        <h5 class="text-right">17,900원</h5>
                    </header>
                    <div id="cam_info">
                        <p class="flex ai-c jc-sb">
                            <span>배송비</span>
                            <span>3,000원</span>
                        </p>
                        <p class="flex ai-c jc-sb">
                            <span>리워드</span>
                            <span>상품가 <b class="txt_color">5%</b></span>
                        </p>
                    </div>
                    <button type="button" class="btn btn_large btn_gray">상품 판매에 대해 궁금한 점이 있나요?</button>
                </div>
                <!--//업체 정보 모바일 view-->


                <!--탭-->
                <div class="tabArea">

                    <section class="et-hero-tabs">
                        <div class="et-hero-tabs-container">
                            <a class="et-hero-tab" href="#info">제품 정보</a>
                            <a class="et-hero-tab" href="#notice">상세 정보</a>
                            <a class="et-hero-tab" href="#review" style="border-right:0">사용 후기</a>
                            <span class="et-hero-tab-slider" style="width: 0px; left: 0px;"></span>
                        </div>
                    </section>

                    <div class="et-main cont">
                        <section class="et-slide" id="info">
                            <h3 class="title">제품 정보</h3>
                            <div class="content-wrapper" id="content">
                                <!-- 콘텐츠 -->
                                <img src="<?php echo G5_THEME_IMG_URL ?>/main/no_img.jpg">
                                <img src="<?php echo G5_THEME_IMG_URL ?>/main/no_img.jpg">
                                <img src="<?php echo G5_THEME_IMG_URL ?>/main/no_img.jpg">
                            </div>
                            <button class="more-btn btn btn_line w100" id="moreBtn">더보기</button>
                        </section>

                        <hr/>

                        <section class="et-slide" id="notice">
                            <h3 class="title">판매 안내</h3>
                            <div>
                                자동으로 구매 링크가 생성되어 제공됩니다. 해당 링크를 통해 구입시 결제건당 리워드를 제공합니다. 결제 후 취소/환불 시 제공된 리워드가 반환될 수 있습니다.
                            </div>
                            <h3 class="title">배송/교환</h3>
                            <div>
                                <ul class="gridInfo">
                                    <li>
                                        <b>반품/교환 택배사</b>
                                        <p>한진택배</p>
                                    </li>
                                    <li>
                                        <b>반품배송비(편도)</b>
                                        <p>3,000원</p>
                                    </li>
                                    <li>
                                        <b>반품배송비(왕복)</b>
                                        <p>6,000원</p>
                                    </li>
                                    <li>
                                        <b>반품/교환지</b>
                                        <p>인천 남동구 서창남로 45 304~306호</p>
                                    </li>
                                    <li>
                                        <b>반품/교환 사유에 따른 요청 가능 기간</b>
                                        <p style="white-space: pre-wrap !important;">1. 구매자 단순 변심은 상품 수령 후 7일 이내 (구매자 반품배송비 부담)
2. 표시/광고와 상이, 계약 내용과 다르게 이행된 경우 상품 수령 후 3개월 이내 혹은 표시/광고와 다른 사실을 안 날로부터 30일 이내(판매자 상품 배송비 부담), 둘 중 하나 경과 시 반품/교환 불가                                                </p>
                                    </li>
                                    <li>
                                        <b>반품/교환 불가능 사유</b>
                                        <p style="white-space: pre-wrap !important;">1. 반품요청기간이 지난 경우
2. 구매자의 책임 있는 사유로 상품 등이 멸실 또는 훼손된 경우
3. 구매자의 책임있는 사유로 포장이 훼손되어 상품 가치가 현저히 상실된 경우
4. 구매자의 사용 또는 일부 소비에 의하여 상품의 가치가 현저히 감소한 경우&nbsp;
5. 시간의 경과에 의하여 재판매가 곤란할 정도로 상품 등의 가치가 현저히 감소한 경우
6. 고객의 요청사항에 맞춰 제작에 들어가는 맞춤제작상품의 경우
7. 복제가 가능한 상품 등의 포장을 훼손한 경우&nbsp;</p>
                                    </li>
                                </ul>
                            </div>
                        </section>

                        <hr/>

                        <section class="et-slide" id="review">
                            <h3 class="title t_margin50">상품 후기</h3>
                            <div class="grade">
                                <ul>
                                    <li><p class="point">0.0</p></li>
                                    <li>
                                        <!-- 1점이 20% -->
                                        <span class="star_rating"><span style="width:20%"></span></span><br/>0개의 후기
                                    </li>
                                </ul>
                            </div>
                            <!--리뷰리스트-->
                            <div id="item_review">
                                <div class="in">
                                    <div class="rev cf">

                                        <!--상품 후기 글쓰기-->
                                        <div id="reply" class="b_margin50">
                                            <div class="grade_wrap">
                                                <input type="radio" id="grade_star1" name="grade_stars" value="1">
                                                <label for="grade_star1"><span><i class="fas fa-star"></i></label>
                                                <input type="radio" id="grade_star2" name="grade_stars" value="2">
                                                <label for="grade_star2"><span><i class="fas fa-star"></i><span><i class="fas fa-star"></i></label>
                                                <input type="radio" id="grade_star3" name="grade_stars" value="3">
                                                <label for="grade_star3"><span><i class="fas fa-star"></i><span><i class="fas fa-star"></i><span><i class="fas fa-star"></i></label> <br class="grade_br"/>
                                                <input type="radio" id="grade_star4" name="grade_stars" value="4">
                                                <label for="grade_star4"><span><i class="fas fa-star"></i><span><i class="fas fa-star"></i><span><i class="fas fa-star"></i><span><i class="fas fa-star"></i></label>
                                                <input type="radio" id="grade_star5" name="grade_stars" value="5">
                                                <label for="grade_star5"><span><i class="fas fa-star"></i><span><i class="fas fa-star"></i><span><i class="fas fa-star"></i><span><i class="fas fa-star"></i><span><i class="fas fa-star"></i></label>
                                            </div>
                                            <section class="cmt">
                                                <textarea name="review_contents" id="review_contents" required="" maxlength="5000" placeholder="상품 후기를 입력해주세요" style="resize: unset;"></textarea>
                                                <input type="button" onclick="review_insert();" id="cmt_btn_submit" value="리뷰작성" accesskey="s">
                                            </section>
                                        </div>
                                        <!--//상품 후기 글쓰기-->
                                        <div class="list cf">
                                            <div class="mg">
                                                <img src="https://www.jobgo.ac:443/theme/basic/img/sub/default.png">
                                            </div>
                                            <div class="info">
                                                <div class="txt">굿</div>
                                                <!-- 리뷰내용최대3줄추출 -->
                                                <div class="nick"><span><i class="fas fa-user-circle"></i></span>닉네임</div><!--닉네임 일부분 노출-->
                                                <div class="date">2024-09-14 15:07
                                                    <div class="star">
                                                        <span class="on"><i class="fas fa-star"></i></span>
                                                        <span class="on"><i class="fas fa-star"></i></span>
                                                        <span class="on"><i class="fas fa-star"></i></span>
                                                        <span class="on"><i class="fas fa-star"></i></span>
                                                        <span class="on"><i class="fas fa-star"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div><!--rev-->
                                </div><!--in-->
                                <div class="review_more">
                                    <a href="javascript:void(0);" onclick="review_append();">더 보기</a>
                                </div>
                            </div>
                        </section>
                    </div>

                </div><!--//tabArea-->

            </div>


            <!-- 정보 오른쪽 모바일 사라짐-->
            <div class="fix_info hidden-xs">
                <div id="cam_count" class="flex ai-c gap10">
                    <div class="mb flex gap5 ai-c">
                        <p>카테고리</p>
                    </div>
                    <div class="heart male-auto" name="">
                        <button type="button" class="heart off"><img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_off.png" alt="좋아요off" title="좋아요off"></button>
                    </div>
                </div>
                <header>
                    <h6 class="item_tit">상품명</h6>
                    <p class="txt_color">업체명</p>
                    <div class="flex ai-c gap10 end">
                        <strong class="txt_color">40%</strong>
                        <s>29,800원</s>
                    </div>
                    <h5 class="text-right">17,900원</h5>
                </header>
                <div id="cam_info">
                    <p class="flex ai-c jc-sb">
                        <span>배송비</span>
                        <span>3,000원</span>
                    </p>
                    <p class="flex ai-c jc-sb">
                        <span>리워드</span>
                        <span>상품가 <b class="txt_color">5%</b></span>
                    </p>
                </div>
                <div class="op_select" id="select_list">
                    <input type="hidden" id="one_stock" value="9935">
                    <select class="mb15 w100">
                        <option>티뷰티 붓기차 75g (5,000mg * 15포) + 0원</option>
                    </select>
                    <div class="op_box" id="op_box_one">
                        <div class="tit">
                            <strong>티뷰티 붓기차 75g (5,000mg * 15포)	</strong>
                        </div>
                        <div class="flex jc-sb ai-c">
                            <p class="number_controller">
                                <button><i class="fa-regular fa-minus" onclick="set_option_count('-','one')"></i></button><input id="count_one" type="text" value="1" readonly=""><button onclick="set_option_count('+','one')"><i class="fa-regular fa-plus"></i></button>
                            </p>
                            <p>
                                <strong id="cost_one">17,900</strong>원
                            </p>
                        </div>
                    </div>
                </div>
                <dl class="total flex jc-sb ai-c">
                    <dt>주문금액</dt>
                    <dd><strong id="total_cost">20,900</strong>원</dd>
                </dl>
                <div class="btn_wrap">
                    <button type="button" class="btn btn_large btn_color2" onclick="">판매하기</button>
                    <button class="btn btn_large btn_color" onclick="">구매하기</button>
                    <button class="btn btn_large btn_line" onclick="">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </button>
                </div>
                <button type="button" class="btn btn_large btn_gray">상품 판매에 대해 궁금한 점이 있나요?</button>
            </div>
            <!--// 정보 오른쪽 모바일 사라짐-->
            <div class="area_fixed" style="display: none;">
                <a class="option_close"><i class="fa-duotone fa-chevron-down"></i></a>
                <div class="area_option" id="prod_opt_list">

                    <select class="mb15 w100">
                        <option>티뷰티 붓기차 75g (5,000mg * 15포) + 0원</option>
                    </select>
                    <ul class="option_list">
                        <li>
                            <div class="flex jc-sb ai-c">
                                <p class="number_controller">
                                    <button type="button" class="btn_opt_min"><i class="fa-regular fa-minus"></i></button>
                                    <input type="number" name="itemCnt" value="1">
                                    <button type="button" class="btn_opt_plus"><i class="fa-regular fa-plus"></i></button>
                                </p>
                                <div class="price txt_black" data-item-wrap="price">230,000원</div>
                            </div>
                        </li>
                    </ul>
                    <ul class="option_list b0" id="addedOptionArea">
                    </ul>
                </div>

                <div class="area_total" data-item-wrap="price">
                    <div class="price_wrap flex jc-sb ai-c">
                        <div class="txt_black">총 상품 금액</div>
                        <div class="price txt_color" id="prod_total_price">230,000원</div>
                    </div>
                </div>
                <div class="area_btn">
                    <button type="button" class="btn btn_large btn_color2" onclick="">판매하기</button>
                    <button class="btn btn_large btn_color" onclick="">구매하기</button>
                    <button class="btn btn_large btn_line" onclick="">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </button>
                </div>
            </div> <!--area_fixed-->
            <div class="fixed_btn">
                <button type="button" class="btn btn_large btn_color2" onclick="">판매하기</button>
                <button class="btn btn_large btn_color" onclick="">구매하기</button>
                <button class="btn btn_large btn_line" onclick="">
                    <i class="fa-solid fa-cart-shopping"></i>
                </button>
            </div><!--fixed_btn-->
        </section>
        <!--아이템 뷰-->

    </article>

    <script>

        //모바일 옵션선택
        $(document).ready(function () {
            // Show area_fixed when the "구매하기" button is clicked
            $(".fixed_btn").click(function () {
                $(".area_fixed").show();
            });

            // Hide area_fixed when the "닫기" button is clicked
            $(".area_fixed .option_close").click(function () {
                $(".area_fixed").hide();
            });
        });

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