<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div>
        <div class="mypage_cont">
            <div class="box">
                <h3>나의 서비스관리</h3>

                <ul id="product_list">
                    <li class="nodata" v-if="data.length == 0">
                        <div class="nodata_wrap">
                            <div class="area_img"><img :src="`${jl.root}/theme/basic_app/img/app/img_nodata.svg`"></div>
                            <p>등록한 서비스이 없습니다.</p>
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
                                <div class="star"><i></i><em>5.0</em></div> <!-- 별점 -->
                                <div class="price">{{getPrice(item).format()}}원 </div> <!-- 가격 -->
                            </div>
                        </a>
                        <a class="list_btn" :href="`${jl.root}/bbs/item_write01.php?idx=${item.idx}`">수정</a> <!-- 제목 -->
                    </li>
                </ul>

            </div>

            <button @click="location.href=jl.root+'/bbs/item_write01.php'" class="btn">서비스 등록하기</button>

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
                data : {

                },
                likes : []
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
            getPrice : function(item) {
                var result = 0;
                if(item.package) {
                    result = parseInt(item.standard.price);
                }else {
                    result = parseInt(item.basic.price);
                }

                return result;
            },
            postData : function() {
                var method = this.primary ? "update" : "insert";
                var res = this.jl.ajax(method,this.data,"/api/example.php");

                if(res) {

                }
            },
            getData: function () {
                // var filter = {primary: this.primary}
                var res = this.jl.ajax("get",this.filter,"/api/member_product.php");

                if(res) {
                    this.data = res.response.data
                }
            },
            checkLike : function(product_idx) {
                return this.likes.some(obj => obj.product_idx == product_idx)
            },
            postLike : function(product_idx) {
                var data = {member_idx : this.mb_no,product_idx : product_idx}
                var res = this.jl.ajax("insert",data,"/api/member_product_like.php");

                if(res) {
                    this.getLike();
                }
            },
            deleteLike : function(product_idx) {
                var data = {
                    member_idx : this.mb_no,
                    product_idx : product_idx
                }

                var res = this.jl.ajax("sql_delete", data, "/api/member_product_like.php");

                if (res) {
                    this.getLike();
                }
            },
            getLike : function() {
                var res = this.jl.ajax("get",this.filter,"/api/member_product_like.php");

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