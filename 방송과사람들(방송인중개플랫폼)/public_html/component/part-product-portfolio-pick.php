<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div class="swiper ftSwiper" :id="'swiper'+component_idx">
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
    </div>
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
                    this.likes = this.jl.getObjectsToKey(res.data,"portfolio_idx");
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
                    this.portfolios = res.data
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