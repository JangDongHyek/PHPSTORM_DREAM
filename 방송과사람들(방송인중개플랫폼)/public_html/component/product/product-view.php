<?php $componentName = str_replace(".php", "", basename(__FILE__)); ?>
<script type="text/x-template" id="<?= $componentName ?>-template">
    <div v-if="render">
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
                    <!--div class="swiper-container gallery_thumbs">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide" v-for="item in data.main_image_array">
                                <img :src="jl.root+item.src">
                            </div>
                        </div>
                    </div-->
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
                            <section>
                                <template v-for="link in data.movie_link" v-if="jl.extractYoutube(link)">
                                    <div class="embed-container">
                                        <iframe
                                                width="560"
                                                height="315"
                                                :src="'https://www.youtube.com/embed/' + jl.extractYoutube(link)"
                                                title="YouTube video player"
                                                frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                allowfullscreen>
                                        </iframe>
                                    </div>
                                </template>
                            </section>
                            <section id="area_service">
                                <!-- 여기서 부터 상세이미지-->
                                <div class="area_detail_img">
                                    <div class="img_box" v-for="item in data.content_image_array">
                                        <img :src="jl.root+item.src">
                                    </div>
                                </div>

                                <br>
                                <h3>서비스설명</h3>
                                <br>
                                <!--포트폴리오 디자인 추가
                                <div class="portfolio_list">
                                        <ul>
                                            <li>
                                                <div class="port_conts">//더보기 클릭시 클래스 expanded 추가
                                                    <div class="port_title">000 콘텐츠 인터뷰</div>
                                                    <div class="port_img">
                                                        <p><img src="https://search.pstatic.net/common/?src=http%3A%2F%2Fblogfiles.naver.net%2FMjAyMTEyMjNfMTMx%2FMDAxNjQwMjQyNzg3NTg4.wVfSHV1O10zd5-5-iUC9Oc5XXMltjpq_Qm5QIe-ecDwg.qPoymCA_M0zgj9LNGjrQaVSQj3iWoJ1PJOj9CkZ7t5cg.JPEG.eunu3061%2F490e499d692102c64cfd76f927c0132b.jpeg&type=sc960_832"></p>
                                                        <p><img src="https://search.pstatic.net/common/?src=http%3A%2F%2Fblogfiles.naver.net%2FMjAyMzA2MDRfMTMx%2FMDAxNjg1ODg4NDI0NDUz.VVct5HfUDUo8OkmUndkfKZLvtZaU7zADX-P1KEe-zF8g.CrT81-Z97KOJi0hX8u4JkIO_sYLatu-SeNCDN71yF_Yg.JPEG.alsdud838%2Foutput_1546078941.jpg&type=sc960_832"></p>
                                                        <p><img src="https://search.pstatic.net/common/?src=http%3A%2F%2Fimgnews.naver.net%2Fimage%2F144%2F2022%2F02%2F22%2F0000794913_001_20220222191502036.jpg&type=sc960_832"></p>
                                                        <p><img src="https://search.pstatic.net/common/?src=http%3A%2F%2Fpost.phinf.naver.net%2FMjAyMjAyMjJfMjgz%2FMDAxNjQ1NDk2NjIyMzc5.QeuRbbR9Topan8FQt-_Rhx0oBbxtCzcJDIM1yZBNm84g.oYqeFiHwwgmNhxVrLGZst_fQFs6J7M27wktdZSYueBgg.JPEG%2FIJ0xkTj9swH6yj_ejD_Uwp1IRM6Q.jpg&type=sc960_832"></p>
                                                    </div>
                                                    <div class="port_detail">
                                                        <strong>포트폴리오 설명</strong>
                                                        <p>2020년도 10월에 촬영한 000광고 화보촬영입니다</p>
                                                    </div>
                                                </div>
                                                <button name="btnToggle" class="port_btn">더보기</button>
                                            </li>
                                        </ul>
                                    </div>
                                // 추가-->

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
                            <div>
                                <h3>포트폴리오</h3>
                                <part-product-portfolio :login_mb_no="member_idx" :product="data"></part-product-portfolio>
                            </div>

                            <div>
                                <h3>관련 인기 상품</h3>
                                <part-product-relation :login_mb_no="member_idx" :product="data"></part-product-relation>
                            </div>

                            <div>
                                <h3>최근 본 서비스</h3>
                                <part-product-lately :login_mb_no="member_idx"></part-product-lately>
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

                portfolios : [],
                products : [],
                products_log : [],

                render : false,
            };
        },
        async created() {
            this.jl = new Jl('<?=$componentName?>');

            await this.getCategory();
            if(this.primary) await this.getData();
            await this.getReview();
            await this.getPortfolio();
            await this.getProduct();
            await this.getProductLog();
        },
        mounted: function () {
            this.$nextTick(() => {
                var swiper = new Swiper(".testSwiper", {
                    slidesPerView: 1,
                    spaceBetween: 10,
                    pagination: {
                        el: ".swiper-pagination",
                        clickable: true,
                    },
                    breakpoints: {
                        640: {
                            slidesPerView: 2,
                            spaceBetween: 20,
                        },
                        768: {
                            slidesPerView: 4,
                            spaceBetween: 40,
                        },
                        1024: {
                            slidesPerView: 5,
                            spaceBetween: 50,
                        },
                    },
                });
            });
        },
        methods: {
            async getLogProduct(arrays) {
                let filter = {
                    page : 1,
                    limit : 6,
                    in_key1 : "idx",
                    in_value1 : arrays
                };


                var res = await this.jl.ajax("get",filter,"/api/member_product.php");
                if(res) {
                    this.products_log = res.response.data;
                }
            },
            async getProductLog() {
                if(!this.member_idx) return false;
                let filter = {
                    member_idx : this.member_idx,
                }

                var res = await this.jl.ajax("get",filter,"/api/member_product_log.php");
                if(res) {
                    let arrays = [];

                    res.data.forEach(function(item) {
                        arrays.push(item.product_idx);
                    })

                    this.getLogProduct(arrays)
                }
            },
            async postProductLog() {
                if(!this.member_idx) return false;

                let obj = {
                    member_idx : this.member_idx,
                    product_idx : this.data.idx
                }

                console.log(77)
                console.log(obj)

                var res = await this.jl.ajax("insert",obj,"/api/member_product_log.php");
            },
            calcReview : function(item) {
                if(item.review_count == 0) return 0;

                let score = item.review_score / item.review_count;

                return Math.round(score * 2) / 2 / 10;
            },
            async getProduct() {
                let filter = {
                    order_by_desc : "review_score",
                    page : 1,
                    limit : 5,
                    not_key : "idx",
                    not_value : this.data.idx,
                    category_idx : this.data.category_idx,
                };

                var res = await this.jl.ajax("get",filter,"/api/member_product.php");
                if(res) {
                    this.products = res.response.data;
                }
            },
            async getPortfolio() {
                let filter = {
                    member_idx : this.member_idx,
                    page : 1,
                    limit : 5
                }

                var res = await this.jl.ajax("get",filter,"/api/member_portfolio.php");
                if(res) {
                    this.portfolios = res.response.data;
                }

            },
            async checkFile(file) {
                var filter = {file : file};
                var res = await this.jl.ajax("check_file",filter,"/api/common.php");

                if(res) {
                    return res.result;
                }
            },
            calcReview : function(item) {
                if(item.review_count == 0) return 0;

                let score = item.review_score / item.review_count;

                return Math.round(score * 2) / 2 / 10;
            },
            async getReview() {
                var filter = {
                    product_idx : this.data.idx,
                    page : this.page,
                    limit:this.limit
                };
                var res = await this.jl.ajax("get", filter, "/api/product_review.php");

                if (res) {
                    this.reviews = res.data
                    this.reviews_count = res.count
                }
            },
            findCategory : function(idx) {
                return this.categories.find(object => object['idx'] == idx);
            },
            async getCategory() {
                var filter = {}
                var res = await this.jl.ajax("get", filter, "/api/category.php");

                if (res) {
                    this.categories = res.response.data
                }
            },
            async getData() {
                var filter = {primary: this.primary}
                var res = await this.jl.ajax("get", filter, "/api/member_product.php");

                if (res) {
                    this.data = res.response.data[0]

                    this.render = true;
                }
            }
        },
        computed: {},
        watch: {
            data() {
                this.postProductLog();
            }
        }
    });
</script>

<style>

</style>