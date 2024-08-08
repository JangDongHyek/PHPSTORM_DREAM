<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <section>
        <h3 class="title">신규 재능 상품</h3>
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
                        <div class="star"><i></i><em>5.0</em></div> <!-- 별점 -->
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
        },
        data: function(){
            return {
                jl : null,
                filter : {

                },
                data : {

                },
                likes : [],
            };
        },
        created: function(){
            this.jl = new JL('<?=$componentName?>');

            this.getData();
            this.getLike();
        },
        mounted: function(){
            this.$nextTick(() => {

            });
        },
        methods: {
            checkLike : function(product_idx) {
                return this.likes.some(obj => obj.product_idx == product_idx)
            },
            getLike : function() {
                var filter = {member_idx : this.member_idx}
                var res = this.jl.ajax("get", filter, "/api/member_product_like.php");

                if (res) {
                    this.likes = res.response.data
                }
            },
            postLike : function(product_idx) {
                var data = {
                    member_idx : this.member_idx,
                    product_idx : product_idx
                };

                var res = this.jl.ajax("like", data, "/api/member_product_like.php");

                if (res) {
                    this.getLike();
                }
            },
            postData : function() {
                var method = this.primary ? "update" : "insert";
                var res = this.jl.ajax(method,this.data,"/api/example.php");

                if(res) {

                }
            },
            getData: function () {
                var filter = {page : 1, limit : 8,order_by_desc : "insert_date"}
                var res = this.jl.ajax("get",filter,"/api/member_product.php");

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