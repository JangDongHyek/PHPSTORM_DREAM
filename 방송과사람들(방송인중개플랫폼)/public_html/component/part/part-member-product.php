<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div class="swiper ftSwiper" :id="'swiper'+component_idx">
        <ul id="product_list" class="swiper-wrapper">
            <li class="swiper-slide" v-for="product in products">
                <i @click="postHeart(product)" class="heart" :class="getClass(product)"></i>
                <a :href="jl.root + '/bbs/item_view.php?idx=' + product.idx">
                    <div class="area_img">
                        <img :src="jl.root + product.main_image_array[0].src">
                    </div>
                    <div class="area_txt">
                        <span></span> <h3>{{product.name}}</h3>
                        <div class="price">
                            {{parseInt(product.basic.price).format()}}원
                        </div>
                        <div class="star">
                            <i></i><em>0</em>
                        </div>
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
            primary : {type : String, default : ""},
            mb_no : {type : String, default : ""},
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
                products : [],
                likes : [],
            };
        },
        created: function(){
            this.jl = new Jl('<?=$componentName?>');
            this.component_idx = this.jl.generateUniqueId();

            this.getProduct();
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
                            slidesPerView: 1,
                            spaceBetween: 15
                        },
                    }
                });
            });
        },
        updated : function() {

        },
        methods: {
            async postHeart(product) {
                let method = "insert";

                let data =  {
                    member_idx : this.login_mb_no,
                    product_idx : product.idx
                }
                if(this.getClass(product) == 'on') method = "where_delete";


                try {
                    let res = await this.jl.ajax(method,data,"/api2/member_product_like.php");

                    await this.getLike();
                }catch (e) {
                    alert(e.message)
                }

            },
            getClass(product) {
                if (this.likes.some(like => like == product.idx)) {
                    return "on";
                }
            },
            async getLike() {
                let filter = {
                    member_idx : this.login_mb_no
                }
                try {
                    let res = await this.jl.ajax("get",filter,"/api2/member_product_like.php");
                    this.likes = this.jl.extractObjectsKey(res.data,"product_idx");
                }catch (e) {
                    alert(e.message)
                }
            },
            async getProduct() {
                let filter = {
                    member_idx : this.mb_no,
                    approval : "1",
                }
                try {
                    let res = await this.jl.ajax("get",filter,"/api2/member_product.php");
                    this.products = res.data
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