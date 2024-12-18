<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <section>
        <h3 class="title">{{ title }}</h3>
        <ul id="product_list">
            <li v-for="item in data">
                <i class="heart" :class="{'on' : checkLike(item.idx)}" @click="postLike(item.idx)"></i>
                <a :href="`${jl.root}/bbs/item_view.php?idx=${item.idx}`">
                    <div class="area_img">
                        <img :src="jl.root+item.main_image_array[0].src">
                    </div>
                    <div class="area_txt">

                        <span>업체명</span><!-- 업체명 -->
                        <h3>{{item.name}}</h3> <!-- 제목 -->
                        <div class="star"><i></i><em>{{ calcReview(item) }}</em></div> <!-- 별점 -->
                        <div class="price">{{ item.package ? parseInt(item.standard.price).format() : parseInt(item.basic.price).format() }}원 </div> <!-- 가격 -->
                    </div>

                </a>
            </li>
        </ul>
    </section>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            primary : {type : String, default : ""},
            member_idx : {type : String, default : ""},
            order_by_key : {type : String, default : ""},
            order_by_value : {type : String, default : ""},
            title : {type : String, default : ""},
        },
        data: function(){
            return {
                jl : null,
                filter : {
                    page : 1,
                    limit : 8,
                    approval : true
                },
                data : {

                },
                likes : [],
            };
        },
        created: function(){
            this.jl = new Jl('<?=$componentName?>');
            this.filter[this.order_by_key] = this.order_by_value;

            this.getData();
            this.getLike();
        },
        mounted: function(){
            this.$nextTick(() => {

            });
        },
        methods: {
            calcReview : function(item) {
                if(item.review_count == 0) return 0;

                let score = item.review_score / item.review_count;

                return Math.round(score * 2) / 2 / 10;
            },
            checkLike : function(product_idx) {
                return this.likes.some(obj => obj.product_idx == product_idx)
            },
            async getLike() {
                var filter = {member_idx : this.member_idx}
                var res = await this.jl.ajax("get", filter, "/api/member_product_like.php");

                if (res) {
                    this.likes = res.response.data
                }
            },
            async postLike(product_idx) {
                var data = {
                    member_idx : this.member_idx,
                    product_idx : product_idx
                };

                var res = await this.jl.ajax("like", data, "/api/member_product_like.php");

                if (res) {
                    this.getLike();
                }
            },
            async getData() {
                var res = await this.jl.ajax("get",this.filter,"/api/member_product.php");

                if(res) {
                    this.data = res.response.data
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