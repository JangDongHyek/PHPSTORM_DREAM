<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <ul id="product_list" class="v2" >
        <li v-for="portfolio in portfolios">
            <a>
                <div class="area_txt">
                    <span></span><!-- 업체명 -->
                    <h3>{{portfolio.name}}</h3> <!-- 제목 -->
                </div>
                <div class="area_img">
                    <img :src="jl.root + portfolio.main_image_array[0].src" title="">
                </div>
                <div class="area_cont">
                    <div class="tab_cont" v-if="portfolio.show">
                        <section id="portfolio_info">
                                <template v-for="item in portfolio.content_image_array">
                                    <img :src="`${jl.root}${item.src}`">
                                </template>
                            <nav class="lnb">
                                <div class="inr">
                                    <ul>
                                        <li><a class="active">포트폴리오 내용</a></li>
                                    </ul>
                                </div>
                            </nav>
                            <div class="conts">{{ portfolio.description }}</div>
                        </section>

                        <section>
                            <template v-for="link in portfolio.movie_link" v-if="jl.extractYoutube(link)">
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

                        <a  :href="jl.root + '/bbs/portfolio_view.php?idx=' + portfolio.idx" class="port_btn2">자세히 보기</a>
                    </div>
                </div>
                <button class="port_btn" @click="portfolio.show = !portfolio.show">
                    {{portfolio.show ? '숨기기' : '더보기'}}
                </button>

            </a>
        </li>
    </ul>
    <?/*

    <script>
        document.querySelector('.port_btn').addEventListener('click', function () {
            const areaCont = document.querySelector('.area_cont');
            const button = this;

            if (areaCont.style.display === 'none' || areaCont.style.display === '') {
                areaCont.style.display = 'block';
                button.textContent = '숨기기';
            } else {
                areaCont.style.display = 'none';
                button.textContent = '더보기';
            }
        });
    </script>
*/?>
    <?/*div class="swiper ftSwiper" :id="'swiper'+component_idx">
        <ul id="product_list" class="swiper-wrapper">
            <li class="swiper-slide" v-for="portfolio in portfolios">
                <i class="heart" :class="getClass(portfolio)" @click="postHeart(portfolio)"></i>
                <a :href="jl.root + '/bbs/portfolio_view.php?idx=' + portfolio.idx">
                    <div class="area_img">
                        <img :src="jl.root + portfolio.main_image_array[0].src" title="">
                    </div>
                    <div class="area_txt">

                        <span></span><!-- 업체명 -->
                        <h3>{{portfolio.name}}</h3> <!-- 제목 -->
                    </div>

                </a>
            </li>
        </ul>
    </div*/?>
</script>

<script>

    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            login_mb_no : {type : String, default : ""},
            modal : {type : Boolean, default : false},
            product : {type : Object, default : null},
        },
        data: function(){
            return {
                jl : null,
                component_idx : "",
                filter : {
                    primary : this.primary
                },
                required : [
                    {name : "",message : ""},
                ],
                data : {},

                portfolios : [],
                likes : [],
            };
        },
        created: function(){
            this.jl = new Jl('<?=$componentName?>');
            this.component_idx = this.jl.generateUniqueId();

            this.getPortfolio();
            this.getLike();
        },
        mounted: function(){
            this.$nextTick(() => {
                let swiper = new Swiper(`#swiper${this.component_idx}`, {
                    slidesPerView: 2.5,
                    spaceBetween: 10,
                    grabCursor: true,
                    pagination: {
                        el: ".swiper-pagination",
                        clickable: true,
                    },
                    breakpoints: {
                        // 화면 너비가 1200px 이상일 때
                        1200: {
                            slidesPerView: 3.5,
                            spaceBetween: 20
                        },
                        // 화면 너비가 992px 이상일 때
                        950: {
                            slidesPerView: 3.5,
                            spaceBetween: 20
                        },
                        // 화면 너비가 768px 이상일 때
                        768: {
                            slidesPerView: 2.5,
                            spaceBetween: 15
                        },
                    }
                });
            });
        },
        updated : function() {

        },
        methods: {
            async postHeart(portfolio) {
                let method = "insert";

                if(!this.login_mb_no) return false;

                let data =  {
                    table : "member_portfolio_like",
                    member_idx : this.login_mb_no,
                    portfolio_idx : portfolio.idx
                }
                if(this.getClass(portfolio) == 'on') method = "where_delete";


                try {
                    let res = await this.jl.ajax(method,data,"/jl/JlApi.php");

                    await this.getLike();
                }catch (e) {
                    alert(e.message)
                }

            },
            getClass(portfolio) {
                if(this.likes.includes(portfolio.idx)) return "on";
            },
            async getLike() {
                let filter = {
                    table : "member_portfolio_like",
                    member_idx : this.login_mb_no
                }
                try {
                    let res = await this.jl.ajax("get",filter,"/jl/JlApi.php");
                    this.likes = this.jl.extractObjectsKey(res.data,"portfolio_idx");
                }catch (e) {
                    alert(e.message)
                }
            },
            async getPortfolio() {
                let array = [99999999, ...this.product.portfolios];

                let filter = {
                    table : "member_portfolio",
                    in : [
                        {key : "idx", array : array }
                    ],
                }
                try {
                    let res = await this.jl.ajax("get",filter,"/jl/JlApi.php");

                    for(let item of res.data) {
                        this.$set(item,'show',false);
                    }

                    this.portfolios = res.data
                    console.log(this.portfolios)
                }catch (e) {
                    alert(e.message)
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