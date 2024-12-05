<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div>
        <div class="mypage_cont">
            <div class="box">
                <h3>찜한내역</h3>

                <ul id="product_list">
                    <li class="nodata" v-if="data.length == 0">
                        <div class="nodata_wrap">
                            <div class="area_img"><img :src="`${jl.root}/theme/basic_app/img/app/img_nodata.svg`"></div>
                            <p>찜한 재능이 없습니다.</p>
                        </div>
                    </li>

                    <li v-else v-for="item in data">
                        <i class="heart" :class="{'on' : checkLike(item.idx)}" @click="checkLike(item.idx) ? deleteLike(item.idx) : postLike(item.idx)"></i>
                        <a :href="`${jl.root}/bbs/item_view.php?idx=${item.idx}`">
                            <div class="area_img">
                                <img :src="`${jl.root}${item.main_image_array[0].src}`">
                            </div>
                            <div class="area_txt">

                                <span></span><!-- 업체명 -->
                                <h3>{{item.name}}</h3> <!-- 제목 -->
                                <div class="star"><i></i><em>{{ calcReview(item) }}</em></div> <!-- 별점 -->
                                <div class="price">{{getPrice(item).format()}}원 </div> <!-- 가격 -->
                            </div>
                        </a>
                    </li>
                </ul>

            </div>
        </div>
    </div>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            mb_no : {type : String, default : ""},
            primary : {type : String, default : ""},
        },
        data: function(){
            return {
                jl : null,
                filter : {
                    member_idx : this.mb_no
                },
                data : [],
                likes : []
            };
        },
        created: function(){
            this.jl = new Jl('<?=$componentName?>');
            this.getLike();
            this.getData();
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
            getPrice : function(item) {
                var result = 0;
                if(item.package) {
                    result = parseInt(item.standard.price);
                }else {
                    result = parseInt(item.basic.price);
                }

                return result;
            },
            async getData() {
                let likes = [];

                this.likes.forEach((item) => {
                    likes.push(item.product_idx)
                });

                if(likes.length == 0) return false;

                var filter = {group_ors :likes,member_idx : this.mb_no}
                var res = await this.jl.ajax("get",filter,"/api/member_product.php");

                if(res) {
                    this.data = res.response.data
                }
            },
            checkLike : function(product_idx) {
                return this.likes.some(obj => obj.product_idx == product_idx)
            },
            async postLike(product_idx) {
                var data = {member_idx : this.mb_no,product_idx : product_idx}
                var res = await this.jl.ajax("insert",data,"/api/member_product_like.php");

                if(res) {
                    this.getLike();
                }
            },
            async deleteLike(product_idx) {
                var data = {
                    member_idx : this.mb_no,
                    product_idx : product_idx
                }

                var res = await this.jl.ajax("sql_delete", data, "/api/member_product_like.php");

                if (res) {
                    this.getLike();
                }
            },
            async getLike() {
                var res = await this.jl.ajax("get",this.filter,"/api/member_product_like.php");

                if(res) {
                    this.likes = res.response.data
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