<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div>
        <div id="sub_cate2">
            <dl>
                <dt><i class="fa-brands fa-elementor"></i>{{category.parent ? category.parent.name : category.name}}</dt>
                <dd>
                    <a :href="Jl_base_url + '/bbs/item_list.php?ctg=' + item.idx" v-for="item in (category.parent ? category.parent.childs : category.childs)">
                        {{item.name}}
                    </a>
                </dd>
            </dl>
        </div>

        <div class="inr">
            <ul id="area_history">
                <li><a href="">홈</a></li>
                <li v-if="category.parent"><a href="">{{category.parent.name}}</a></li>
                <li><a href="" class="current">{{category.name}}</a></li>
            </ul>
            <div id="list_top">
                <div class="total">총 {{products_count}}건</div>
                <div class="sort_list">
                    <span data-toggle="modal" data-target="#listModal">최신순</span>
                </div>
            </div>
            <ul id="product_list">
                <li class="nodata" v-if="products_count == 0">
                    <div class="nodata_wrap">
                        <div class="area_img"><img src="<?php echo G5_THEME_IMG_URL ?>/app/img_nodata.svg"></div>
                        <p>등록된 재능이 없습니다.</p>
                    </div>
                </li>

                <li v-else v-for="item in products">
                    <i class="heart" :class="{'on' : checkLike(item.idx)}" @click="postLike(item.idx)"></i>
                    <a :href="`${jl.root}/bbs/item_view.php?idx=${item.idx}`">
                        <div class="area_img">
                            <img :src="jl.root+item.main_image_array[0].src">
                        </div>
                        <div class="area_txt">
                            <span></span> <h3>{{ item.name }}</h3>
                            <div class="star"><i></i><em>{{ calcReview(item) }}</em></div>
                            <div class="price">{{ item.package ? parseInt(item.standard.price).format() : parseInt(item.basic.price).format() }}원 </div>
                        </div>
                    </a>
                </li>

                <!--광고-->
                <!--//광고-->

            </ul>


            <paging2-component :page="page" :total="products_count" :limit="limit" @change="page=$event"></paging2-component>

        </div>
    </div>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            ctg : {type : String,default : ""},
            category_idx : {type : String,default : ""},
            member_idx : {type : String,default : ""},
        },
        data: function(){
            return {
                jl : null,
                filter : {
                    idx : this.ctg
                },
                data : {

                },
                category : {},
                products : [],
                products_count : 0,
                page : 1,
                limit : 10,

                likes : [],
            };
        },
        created: function(){
            this.jl = new Jl('<?=$componentName?>');
            this.getCategory();
            this.getProduct();
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
            async getProduct() {
                var parent_idx = this.category_idx ? '' : this.ctg;
                var category_idx = this.ctg;

                var filter = {parent_idx : parent_idx, category_idx : category_idx}

                var res = await this.jl.ajax("get",filter,"/api/member_product.php");
                if(res){
                    this.products = res.response.data;
                    this.products_count = res.response.count;
                }
            },
            async getCategory() {
                var method = "get";

                var res = await this.jl.ajax(method,this.filter,"/api/category.php");
                if (res) {
                    this.jl.log(res)
                    this.category = res.response.data[0]
                }
            }
        },
        computed: {

        },
        watch : {
            page : function() {
                this.getProduct();
            }
        }
    });
</script>

<style>

</style>