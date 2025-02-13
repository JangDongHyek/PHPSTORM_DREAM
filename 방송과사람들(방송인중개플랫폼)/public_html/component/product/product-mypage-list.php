<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div>
        <div class="mypage_cont">
            <div class="box">
                <h3>나의 서비스관리</h3>


                <button @click="location.href=jl.root+'/bbs/item_write01.php'" class="btn new_btn">서비스 등록하기</button>
                <ul id="product_list">
                    <li class="nodata" v-if="data.length == 0">
                        <div class="nodata_wrap">
                            <div class="area_img"><img :src="`${jl.root}/theme/basic_app/img/app/img_nodata.svg`"></div>
                            <p>등록한 서비스가 없습니다.</p>
                        </div>
                    </li>

                    <li v-else v-for="item in data">
                        <i class="heart" :class="{'on' : checkLike(item.idx)}" @click="checkLike(item.idx) ? deleteLike(item.idx) : postLike(item.idx)"></i>
                        <a :href="`${jl.root}/bbs/item_view.php?idx=${item.idx}`">
                            <div class="area_img">
                                <img :src="`${jl.root}${item.main_image_array[0].src}`">
                            </div>
                            <div class="area_txt">
                                <span v-if="item.approval"><b class="color_blue"><i class="fa-solid fa-circle-check"></i> 승인완료</b></span>
                                <span v-else><i class="fa-solid fa-circle-exclamation"></i> 승인대기</span>
                                <h3>{{item.name}}</h3> <!-- 제목 -->
                                <div class="star"><i></i><em>{{ calcReview(item) }}</em></div> <!-- 별점 -->
                                <div class="price">{{getPrice(item).format()}}원 </div> <!-- 가격 -->
                            </div>
                        </a>
                        <div class="flex" v-if="!item.approval">
                            <a class="list_btn" :href="`${jl.root}/bbs/item_write01.php?idx=${item.idx}`">수정</a> 
                            <a class="list_btn" @click="deleteProduct(item)">삭제</a>
                        </div>
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
                    member_idx : this.mb_no,
                    registration : true,
                },
                data : {

                },
                likes : []
            };
        },
        created: function(){
            this.jl = new Jl('<?=$componentName?>');
            this.getData();
            this.getLike();
        },
        mounted: function(){
            this.$nextTick(() => {

            });
        },
        methods: {
            async deleteProduct(item) {
                if(!confirm("정말 삭제하시겠습니까?")) return false;
                let method = "delete";

                let filter = {
                    table : "member_product",
                    primary : item.idx, // delete일시 primary 카깂을 넣으면된다 primary 키값이 아니라면 삭제 안됌

                    file_use : true, // 저장된 파일 삭제할지 안할지 삭제할시 데이터의 컬럼명 이들어가야한다
                }
                try {
                    let res = await this.jl.ajax(method,filter,"/jl/JlApi.php");
                    alert("삭제되었습니다.");
                    window.location.reload();
                }catch (e) {
                    alert(e.message)
                }
            },
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
                // var filter = {primary: this.primary}
                var res = await this.jl.ajax("get",this.filter,"/api/member_product.php");

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