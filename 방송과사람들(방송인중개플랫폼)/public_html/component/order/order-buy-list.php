<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div>
        <div class="mypage_cont">
            <div class="box">
                <h3>구매관리</h3>
                <ul class="sort_list">
                    <li class="active"><a href="">전체(4)</a></li>
                    <li><a href="">진행대기(1)</a></li>
                    <li><a href="">진행중(1)</a></li>
                    <li><a href="">완료(1)</a></li>
                    <li><a href="">취소(1)</a></li>
                </ul>
                <ul id="product_list" class="col01">
                    <li class="nodata" v-if="data.length == 0">
                        <div class="box">
                            <img src="<?php echo G5_THEME_IMG_URL ?>/app/icon_nodata.svg">
                            <p>구매한 재능상품이 없습니다.<p>
                        </div>
                    </li>

                    <!-- 완료상태일때 li class="review" 추가 & 리뷰쓰기버튼 나오게 해주세요. -->
                    <li v-else v-for="item in data" :class="{'review' : item.status=='완료'}">
                        <div class="area_img">
                            <a :href="`${jl.root}/bbs/mypage_view.php`">
                                <img :src="jl.root+item.MEMBER_PRODUCT.main_image_array[0].src">
                            </a>
                        </div>

                        <div class="area_right">
                            <i class="type" :class="getClass(item)">
                                <em v-if="item.status == '완료'"></em>{{item.status}}
                            </i>
                            <div class="area_txt">
                                <a :href="`${jl.root}/bbs/mypage_view.php`">
                                    <h3>{{ item.MEMBER_PRODUCT.name }}</h3> <!-- 제목 -->
                                    <div class="price">
                                        {{ parseInt(item.MEMBER_PRODUCT[item.package].price).format() }}
                                        원 ~
                                    </div> <!-- 가격 -->
                                    <div id="seller_info">
                                        <div class="photo">
                                            <img class="p_img" v-if="checkFile(`/data/file/member/${item.MEMBER.mb_no}.jpg`)" :src="`${jl.root}/data/file/member/${item.MEMBER.mb_no}.jpg`">
                                            <img class="p_img" v-else :src="`${jl.root}/img/img_smile.jpg`">
                                        </div>
                                        <div class="name"><p>{{ item.MEMBER.mb_nick }}</p></div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <!-- 리뷰쓰기 버튼-->
                        <div class="area_complete" v-if="item.status == '완료'">
                            <i class="btn_review" @click="select_item = item; modal = true">리뷰쓰기</i>
                        </div>
                        <!-- //리뷰쓰기 버튼 -->
                    </li>
                </ul>

            </div>
        </div>

        <slot-modal v-if="modal" :modal="modal" @close="modal = false" confirm="true" @onEvent="postReview()">
            <div id="star_rating">
                <h2>별점을 선택해 주세요.</h2>
                <div class="box">
                    <p class="star_rating">
                        <a href="" @click="event.preventDefault(); review.score = 10" :class="{'on' : review.score >= 10}"><i></i></a>
                        <a href="" @click="event.preventDefault(); review.score = 20" :class="{'on' : review.score >= 20}"><i></i></a>
                        <a href="" @click="event.preventDefault(); review.score = 30" :class="{'on' : review.score >= 30}"><i></i></a>
                        <a href="" @click="event.preventDefault(); review.score = 40" :class="{'on' : review.score >= 40}"><i></i></a>
                        <a href="" @click="event.preventDefault(); review.score = 50" :class="{'on' : review.score >= 50}"><i></i></a>
                    </p>
                </div>
            </div>
            <!--star_rating-->
            <h2>후기를 작성해 주세요.</h2>
            <div class="box">
                <div class="cont">
                    <textarea name="r_content" style="width: 100%;" v-model="review.content"></textarea>
                </div>
            </div>
        </slot-modal>
    </div>
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
                    member_idx : this.member_idx,
                    page : 1,
                    limit : 8,
                },
                count : 0,
                data : [],

                select_item : null,
                modal : false,
                review : {
                    member_idx : this.member_idx,
                    score : 0,
                    content : "",
                }
            };
        },
        created: function(){
            this.jl = new JL('<?=$componentName?>');

            if(this.member_idx) this.getData();
        },
        mounted: function(){
            this.$nextTick(() => {

            });
        },
        methods: {
            getReview : function() {
                let filter = {product_idx : this.select_item.product_idx, member_idx : this.member_idx}
                var res = this.jl.ajax("get",filter,"/api/product_review.php");

                if(res) {
                    if(res.data[0]) {
                        this.review = res.data[0];
                        this.review.prev_score = this.review.score;
                    }
                }
            },
            postReview : function() {
                var method = this.review.idx ? "update" : "insert";
                this.review.product_idx = this.select_item.product_idx;
                var res = this.jl.ajax(method,this.review,"/api/product_review.php");

                if(res) {
                    alert("완료되었습니다.")
                    this.modal = false;
                }
            },
            checkFile : function(file) {
                var filter = {file : file};
                var res = this.jl.ajax("check_file",filter,"/api/common.php");

                if(res) {
                    return res.result;
                }
            },
            getClass : function(item) {
                switch (item.status) {
                    case "진행대기" :
                        return "";
                    case "진행중" :
                        return "v2";
                    case "완료" :
                        return "v3";
                    case "취소" :
                        return "v4";
                    default :
                        return "";
                }
            },
            postData : function() {
                var method = this.primary ? "update" : "insert";
                var res = this.jl.ajax(method,this.data,"/api/example.php");

                if(res) {

                }
            },
            getData: function () {
                var filter = {}
                var res = this.jl.ajax("get",this.filter,"/api/member_order.php");

                if(res) {
                    this.data = res.response.data
                    this.count = res.response.count;
                }
            }
        },
        computed: {

        },
        watch : {
            modal : function() {
                if(this.modal) {
                    this.getReview();
                }else {
                    this.select_item = null;
                }
            }
        }
    });
</script>

<style>

</style>