<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div>
        <div id="portfolio_view" class="view">
            <div class="inr">

                <ul id="area_history">
                    <li><a href="">홈</a></li>
                    <li>
                        <a class="current">포트폴리오</a>
                    </li>
                    <li>
                        <a class="current">{{ member.mb_nick }} 님</a>
                    </li>
                </ul>
                <div class="item_right">
                    <div class="item_hd">
                        <div class="title">{{ data.name }}</div>
                        <!--div class="title">{{ member.mb_nick }} 님의 포트폴리오</div-->
                        <div class="btn_wrap">
                            <!--신고하기버튼--><a class="btn_share"><i class="fa-regular fa-siren"></i></a>&nbsp;
                            <!--공유하기버튼--><a class="btn_share"><i class="fa-regular fa-share-nodes"></i></a>
                        </div>
                    </div>
                    <div class="item_info">
                        <div class="profile_box">
                            <div class="profile">
                                <img v-if="checkFile('/data/file/member/${member.mb_no}.jpg')" :src="`${jl.root}/data/file/member/${member.mb_no}.jpg`">
                                <img v-else :src="`${jl.root}/img/img_smile.jpg`">
                            </div>
                            <div class="profile_info">
                                <h3 @click="window.location.href=`${jl.root}/bbs/profile.php?mb_no=${member.mb_no}`">{{member.mb_nick}}</h3>
                                <div id="heartIcon"><i class="fa-light fa-heart"></i> 27</div>
                            </div>
                        </div>
                        <br>
                        <template v-for="item in member.mb_interest">
                            <i class="cate">{{item}}</i> <!--전문분야-->
                        </template>
                        <span class="icon">{{data.CATEGORY.data[0].name}}</span>
                        <h2></h2>
                        <div id="area_btn">
                            <a href="" class="box_btn">문의하기</a>
                            <!-- 찜하기 눌렀을 때 class="on"추가 -->
                            <div class="icon_jjim" :class="{'on' : checkLike(data.idx)}" @click=" checkLike(data.idx) ? deleteLike(data.idx) : postLike(data.idx)"></div>
                        </div>
                    </div>
                </div>
                <div class="item_left">
                    <div class="area_tab">
                        <div class="tab_cont">
                            <section id="portfolio_info">
                                <div class="area_img">
                                    <template v-for="item in data.main_image_array">
                                        <img :src="`${jl.root}${item.src}`">
                                    </template>
                                </div>
                                <br>
                                <nav class="lnb">
                                    <div class="inr">
                                        <ul>
                                            <li><a class="active">서비스설명</a></li>
                                        </ul>
                                    </div>
                                </nav>
                                <br>
                                <div class="area_img">
                                    <template v-for="item in data.content_image_array">
                                        <img :src="`${jl.root}${item.src}`">
                                    </template>
                                </div>
                                <br>
                                <h3>포트폴리오 설명</h3>
                                <div class="conts">{{ data.description }}</div>
                            </section>

                            <section>
                                <template v-for="link in data.movie_link" v-if="jl.extractYoutube(link)">
                                    <div class="embed-container">
                                        <iframe
                                                :src="'https://www.youtube.com/embed/' + jl.extractYoutube(link)"
                                                title="YouTube video player"
                                                frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                allowfullscreen>
                                        </iframe>
                                    </div><br>
                                </template>
                            </section>

                        </div>
                        <div class="area_ft_list">
                            <div>
                                <h3>{{ member.mb_nick }}님의 다른 포트폴리오</h3>
                                <div class="swiper ftSwiper">
                                    <ul id="product_list" class="swiper-wrapper portfolio_list">
                                        <li class="swiper-slide" v-for="item in portfolios">
                                            <i class="heart" :class="{'on' : checkLike(item.idx)}" @click="checkLike(item.idx) ? deleteLike(item.idx) : postLike(item.idx)"></i>
                                            <a :href="`${jl.root}/bbs/portfolio_view.php?idx=${item.idx}`">
                                                <h3>{{ item.name }}</h3> <!-- 제목 -->
                                                <div class="area_img">
                                                    <img :src="`${jl.root}${item.main_image_array[0].src}`" title="">
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div>
                                <h3>{{ member.mb_nick }}님의 전문가 서비스</h3>
                                <div class="swiper ftSwiper">
                                    <ul id="product_list" class="swiper-wrapper">
                                        <li class="swiper-slide">
                                            <i class="heart on"></i>
                                            <a href="https://itforone.com:443/~broadcast/bbs/item_view.php?idx=15">
                                                <div class="area_img">
                                                    <img :src="jl.root + '/theme/basic_app/img/noimg.jpg'">
                                                </div>
                                                <div class="area_txt">
                                                    <h3>영상제작</h3> <!-- 제목 -->
                                                    <div class="price">50,000원 </div> <!-- 가격 -->
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
            mb_no: {type: String, default: ""},
            primary: {type: String, default: ""}
        },
        data: function(){
            return {
                jl : null,
                filter : {

                },
                data : {

                },
                member : {},
                portfolios : [],
                likes : [],
            };
        },
        created: function(){
            this.jl = new Jl('<?=$componentName?>');
            console.log(this.primary)
            if(this.primary) this.getData();
            this.getMember();
            this.getPortfolios();
            this.getLike();
        },
        mounted: function(){
            this.$nextTick(() => {

            });
        },
        methods: {
            async deleteLike(portfolio_idx) {
                var method = "sql_delete";
                var data = {
                    member_idx : this.mb_no,
                    portfolio_idx : portfolio_idx
                }
                var res = await this.jl.ajax(method, data, "/api/member_portfolio_like.php");

                if (res) {
                    this.getLike();
                }
            },
            checkLike : function(portfolio_idx) {
                return this.likes.some(obj => obj.portfolio_idx == portfolio_idx)
            },
            async getLike() {
                var filter = {member_idx : this.mb_no}
                var res = await this.jl.ajax("get", filter, "/api/member_portfolio_like.php");

                if (res) {
                    this.likes = res.response.data
                }
            },
            async postLike(portfolio_idx) {
                var method = "insert";
                var data = {
                    member_idx : this.mb_no,
                    portfolio_idx : portfolio_idx
                }
                var res = await this.jl.ajax(method, data, "/api/member_portfolio_like.php");

                if (res) {
                    this.getLike();
                }
            },
            async checkFile(file) {
                var filter = {file : file};
                var res = await this.jl.ajax("check_file",filter,"/api/common.php");

                if(res) {
                    return res.result;
                }
            },
            async getMember() {
                var method = "get";
                var filter = {primary : this.mb_no};

                var res = await this.jl.ajax("get",filter,"/api/g5_member.php");
                if (res) {
                    console.log(res)
                    this.member = res.response.data[0];
                }
            },
            async getData() {
                var filter = {primary: this.primary}
                var res = await this.jl.ajax("get",filter,"/api/member_portfolio.php");

                if(res) {
                    this.data = res.response.data[0];
                }
            },
            async getPortfolios() {
                var filter = {exclusion : this.primary,member_idx : this.mb_no}
                var res = await this.jl.ajax("get",filter,"/api/member_portfolio.php");

                if(res) {
                    this.portfolios = res.response.data;
                }
            }
        },
        computed: {

        },
        watch : {

        }
    });
</script>

<style>

</style>