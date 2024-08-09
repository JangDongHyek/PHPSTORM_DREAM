<?php $componentName = str_replace(".php", "", basename(__FILE__)); ?>
<script type="text/x-template" id="<?= $componentName ?>-template">
    <div>
        <div id="item_view" class="view">
            <div class="inr">
                <ul id="area_history">
                    <li><a href="">홈</a></li>
                    <li>
                        <a :href="`${jl.root}/bbs/item_list.php?ctg=${data.CATEGORY.data[0].parent_idx}`" class="current">{{ findCategory(data.CATEGORY.data[0].parent_idx).name }}</a>
                    </li>
                    <li>
                        <a :href="`${jl.root}/bbs/item_list.php?ctg=${data.category_idx}&category_idx=${data.CATEGORY.data[0].parent_idx}`"
                           class="current">{{ findCategory(data.category_idx).name }}</a>
                    </li>
                </ul>
                <div class="item_left">

                    <div class="swiper-container gallery_top">
                        <div class="swiper-wrapper">
                                <div class="swiper-slide" v-for="item in data.main_image_array">
                                    <img :src="jl.root+item.src">
                                </div>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                    <div class="swiper-container gallery_thumbs">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide" v-for="item in data.content_image_array">
                                <img :src="jl.root+item.src">
                            </div>
                        </div>
                    </div>
                    <!--공유하기버튼--><a class="btn_share"><i class="fa-regular fa-share-nodes"></i></a>
                </div>

                <product-view-right :product="data" :member_idx="member_idx"></product-view-right>

                <div class="item_left">
                    <div class="area_tab">
                        <nav class="lnb">
                            <div class="inr">
                                <ul>
                                    <li><a class="active" href="#area_service">서비스설명</a></li>
                                    <li><a href="#faq">자주찾는 질문</a></li>
                                    <!--<li><a href="#area_price">가격정보</a></li>-->
                                    <!--<li><a href="#area_edit">수정·재진행</a></li>-->
                                    <li><a href="#area_cancel">취소·환불 규정</a></li>
                                    <li><a href="#area_info">상품정보고시</a></li>
                                    <li><a href="#area_review">서비스평가</a></li>
                                </ul>
                            </div>
                        </nav>
                        <div class="tab_cont">
                            <section id="area_service">
                                <h3>서비스설명</h3>
                                <div class="embed-container" v-html="data.service"></div>
                                <!-- 여기서 부터 상세이미지-->
                                <div class="area_detail_img">
                                    <div class="img_box" v-for="item in data.main_image_array">
                                        <img :src="jl.root+item.src">
                                    </div>
                                </div>
                                <br>
                                <!--서비스 추가 옵션-->
                                <dl class="service_option">
                                    <dt>성별</dt>
                                    <dd>{{ data.gender }}</dd>
                                    <dt>연령</dt>
                                    <dd>{{ data.age }}</dd>
                                    <dt>지역</dt>
                                    <dd>{{ data.area }}</dd>
                                    <dt>주말 작업</dt>
                                    <dd>{{ data.weekend }}</dd>
                                    <dt>작업 유형</dt>
                                    <dd>{{ data.styles }}</dd>
                                </dl>

                                <br>
                                <!--서비스 안내-->
                                <div class="sevice_info">
                                    <strong>[서비스 안내]</strong>
                                    <span>서비스 제공 시간, 참여 역할, 출장비 등의 제반 사항에 따라 서비스 비용이 상이할 수 있으니 구체적으로 상담 후, 구매 부탁드립니다.</span>
                                    <span>모든 거래는 방송과 사람들 규정에 따라 안전 결제 시스템을 이용한 선결제로 진행됩니다.</span>
                                </div>
                            </section>
                            <section id="faq">
                                <h3>자주찾는 질문</h3>
                                <div class="box_gray">
                                    <template v-for="item in data.questions">
                                        <dl>
                                            <dt>Q. {{ item.question }}</dt>
                                            <dd>A. {{ item.answer }}</dd>
                                        </dl>
                                    </template>
                                </div>
                            </section>
                            <section id="area_cancel">
                                <h3>취소 및 환불 규정</h3>
                                <div class="box"
                                     style="white-space: pre-wrap;"><?= isset($popup_result['cr_content']) ? $popup_result['cr_content'] : "등록안됨"; ?></div>
                            </section>
                            <section id="area_info">
                                <h3>상품정보고시</h3>
                                <dl class="box_gray">
                                    <dt>서비스제공자</dt>
                                    <dd>{{ data.product_info1 }} <a class="btn">상세 정보 보기</a></dd>
                                    <dt>취소·환불 조건</dt>
                                    <dd>{{ data.product_info2 }}</dd>
                                    <dt>인증·허가사항</dt>
                                    <dd>{{ data.product_info3 }}</dd>
                                    <dt>취소·환불방법</dt>
                                    <dd>{{ data.product_info4 }}</dd>
                                    <dt>이용조건</dt>
                                    <dd>{{ data.product_info5 }}</dd>
                                    <dt>소비자 상담전화</dt>
                                    <dd>{{ data.product_info6 }}</dd>
                                </dl>

                            </section>
                            <section id="area_review">
                                <h3>서비스 평가</h3>
                                <div class="box">
                                    <div class="review_total">
                                        <h3>{{ calcReview(data) }}</h3>
                                        <div class="area_star">
                                            <div class="img_star" :class="`v${calcReview(data) * 10}`">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </div>
                                            <span class="review">{{ data.review_count }}개 리뷰</span>
                                        </div>
                                        <dl class="box_gray">
                                            <dt>결과물 만족도</dt>
                                            <dd><strong>5.0</strong></dd>
                                            <dt>친절한 상담</dt>
                                            <dd><strong>4.5</strong></dd>
                                            <dt>신속한 대응</dt>
                                            <dd><strong>3.0</strong></dd>
                                        </dl>

                                    </div>
                                    <ul class="review_list">
                                        <li v-for="item,index in reviews">
                                            <div class="title">
                                                <div class="profile">
                                                    <img v-if="checkFile(`/data/file/member/${item.G5_MEMBER.member_idx}.jpg`)" :src="`${jl.root}/data/file/member/${item.G5_MEMBER.member_idx}.jpg`">
                                                    <img v-else :src="`${jl.root}/img/img_smile.jpg`">
                                                </div>
                                                <div class="profile_info">
                                                    <h4>{{ item.G5_MEMBER.mb_nick[0] }}**</h4><!-- 이름 -->
                                                    <div class="area_star">
                                                        <div class="img_star" :class="`v${item.score}`">
                                                            <span></span>
                                                            <span></span>
                                                            <span></span>
                                                            <span></span>
                                                            <span></span>
                                                        </div>
                                                        <em>{{ item.score/10 }}</em>
                                                        <span class="data">{{ item.insert_date }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="order_info">
                                                <span>작업일 : 24시간 이내</span><span>주문금액 : 20 ~ 30만원</span></div>
                                            <div class="cont" id="content" :class="{'expanded' : mores.includes(item.idx)}">
                                                {{ item.content }}
                                            </div>
                                            <div class="button" v-if="item.content.length > 250 && !mores.includes(item.idx)" id="toggleButton" @click="mores.push(item.idx)">더보기</div>
                                            <div class="button" v-if="mores.includes(item.idx)" id="toggleButton" @click="mores.splice(mores.indexOf(item.idx),1)">접기</div>
                                        </li>
                                    </ul>
                                    <div class="btn_more" v-if="(page * limit) < reviews_count" @click="page+=1;"><span>더보기</span></div>
                                </div>
                            </section>

                        </div>

                        <div class="area_ft_list">
                            <!--포트폴리오-->
                            <div>
                                <h3>포트폴리오</h3>
                                <div class="swiper ftSwiper">
                                    <ul id="product_list" class="swiper-wrapper">
                                        <li class="swiper-slide">
                                            <i class="heart " onclick="heart_click(15,this)"></i>
                                            <a href="https://itforone.com:443/~broadcast/bbs/item_view.php?idx=15">
                                                <div class="area_img">
                                                    <img src="https://itforone.com:443/~broadcast/data/file/main_img/0_2039270465__d3e9d3a90aff883a7a587b48a12d57dd7db70d9c.jpg"
                                                         title="">
                                                </div>
                                                <div class="area_txt">

                                                    <span></span><!-- 업체명 -->
                                                    <h3>영상제작</h3> <!-- 제목 -->
                                                    <div class="price">50,000원</div> <!-- 가격 -->
                                                    <div class="star"><i></i><em>5.0</em></div> <!-- 별점 -->
                                                </div>

                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!--관련 인기 상품-->
                            <div>
                                <h3>관련 인기 상품</h3>
                                <div class="swiper ftSwiper">
                                    <ul id="product_list" class="swiper-wrapper">
                                        <li class="swiper-slide">
                                            <i class="heart " onclick="heart_click(15,this)"></i>
                                            <a href="https://itforone.com:443/~broadcast/bbs/item_view.php?idx=15">
                                                <div class="area_img">
                                                    <img src="https://itforone.com:443/~broadcast/data/file/main_img/0_2039270465__d3e9d3a90aff883a7a587b48a12d57dd7db70d9c.jpg"
                                                         title="">
                                                </div>
                                                <div class="area_txt">

                                                    <span></span><!-- 업체명 -->
                                                    <h3>영상제작</h3> <!-- 제목 -->
                                                    <div class="price">50,000원</div> <!-- 가격 -->
                                                    <div class="star"><i></i><em>5.0</em></div> <!-- 별점 -->
                                                </div>

                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!--최근 본 서비스-->
                            <div>
                                <h3>최근 본 서비스</h3>
                                <div class="swiper ftSwiper">
                                    <ul id="product_list" class="swiper-wrapper">
                                        <li class="swiper-slide">
                                            <i class="heart " onclick="heart_click(15,this)"></i>
                                            <a href="https://itforone.com:443/~broadcast/bbs/item_view.php?idx=15">
                                                <div class="area_img">
                                                    <img src="https://itforone.com:443/~broadcast/data/file/main_img/0_2039270465__d3e9d3a90aff883a7a587b48a12d57dd7db70d9c.jpg"
                                                         title="">
                                                </div>
                                                <div class="area_txt">

                                                    <span></span><!-- 업체명 -->
                                                    <h3>영상제작</h3> <!-- 제목 -->
                                                    <div class="price">50,000원</div> <!-- 가격 -->
                                                    <div class="star"><i></i><em>5.0</em></div> <!-- 별점 -->
                                                </div>

                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            primary: {type: String, default: ""},
            member_idx: {type: String, default: ""}
        },
        data: function () {
            return {
                jl: null,
                filter: {},
                data: {},
                categories : [],
                reviews : [],
                page : 1,
                limit : 5,
                reviews_count : 0,
                mores : [],
            };
        },
        created: function () {
            this.jl = new JL('<?=$componentName?>');

            if(this.primary) this.getData();
            this.getCategory();
            this.getReview();
        },
        mounted: function () {
            this.$nextTick(() => {

            });
        },
        methods: {
            checkFile : function(file) {
                var filter = {file : file};
                var res = this.jl.ajax("check_file",filter,"/api/common.php");

                if(res) {
                    return res.result;
                }
            },
            calcReview : function(item) {
                if(item.review_count == 0) return 0;

                let score = item.review_score / item.review_count;

                return Math.round(score * 2) / 2 / 10;
            },
            getReview : function() {
                var filter = {
                    product_idx : this.data.idx,
                    page : this.page,
                    limit:this.limit
                };
                var res = this.jl.ajax("get", filter, "/api/product_review.php");

                if (res) {
                    this.reviews = res.data
                    this.reviews_count = res.count
                }
            },
            postData: function () {
                var method = this.primary ? "update" : "insert";
                var res = this.jl.ajax(method, this.data, "/api/example.php");

                if (res) {

                }
            },
            findCategory : function(idx) {
                return this.categories.find(object => object['idx'] == idx);
            },
            getCategory : function() {
                var filter = {}
                var res = this.jl.ajax("get", filter, "/api/category.php");

                if (res) {
                    this.categories = res.response.data
                }
            },
            getData: function () {
                var filter = {primary: this.primary}
                var res = this.jl.ajax("get", filter, "/api/member_product.php");

                if (res) {
                    this.data = res.response.data[0]
                }
            }
        },
        computed: {},
        watch: {}
    });
</script>

<style>

</style>