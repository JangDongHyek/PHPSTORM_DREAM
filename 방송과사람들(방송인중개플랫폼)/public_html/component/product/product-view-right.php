<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div class="item_right">
        <div class="item_info">
            <template v-for="item in data.keywords">
                <i class="cate">{{item}}</i>
            </template>
            <h3 class="subject">{{data.name}}</h3>
            <div class="company_info">
                <div class="profile_box">
                    <div class="profile">
                        <img v-if="checkFile(`/data/file/member/${product.member_idx}.jpg`)" :src="`${jl.root}/data/file/member/${product.member_idx}.jpg`">
                        <img v-else :src="`${jl.root}/img/img_smile.jpg`">
                    </div>
                    <div class="profile_info" @click="location.href=jl.root+'/bbs/profile.php?mb_no='+product.member_idx">
                        <h3>{{ product.MEMBER.mb_nick }}</h3>

                        <div class="area_star">
                            <div class="img_star" :class="`v${calcReview(product) * 10}`">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                            <em>{{ calcReview(product) }}</em>
                            <span class="review">({{ product.review_count }}개 리뷰)</span>
                        </div>
                    </div>
                </div>
                <ul class="list_info">
                    <li>
                        <span>거래건수</span>
                        <h3>10건</h3>
                    </li>
                    <li>
                        <span>만족도</span>
                        <h3>98%</h3>
                    </li>
                    <li>
                        <span>회원구분</span>
                        <h3>
                            개인
                        </h3>
                    </li>
                    <!--<li>
                                <span>평균응답시간</span>
                                <h3>
                                    <? /* if($mb['re_time'] == "1") echo "30분 이내";
                                    else if($mb['re_time'] == "2") echo "1시간 이내";
                                    else echo "1시간 이상";
                                    */ ?>
                                </h3>
                            </li>-->
                </ul>
                <!--자기소개글-->
                <p class="pf_produce">자기소개글</p>
                <a href="" class="btn_cs" @click="event.preventDefault(); postChatRoom();">전문가에게 문의하기</a>
            </div>
            <br>
            <div class="price_info">
                <div role="tabpanel">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <template v-if="!product.package">
                            <li role="presentation" :class="{'active' : tab == 'basic'}">
                                <a href="">BASIC</a>
                            </li>
                        </template>

                        <template v-else>
                            <li role="presentation" :class="{'active' : tab == 'standard'}">
                                <a href="" @click="event.preventDefault(); tab = 'standard'">STANDARD</a>
                            </li>
                            <li role="presentation" :class="{'active' : tab == 'deluxe'}">
                                <a href="" @click="event.preventDefault(); tab = 'deluxe'">DELUXE</a>
                            </li>
                            <li role="presentation" :class="{'active' : tab == 'premium'}">
                                <a href="" @click="event.preventDefault(); tab = 'premium'">PREMIUM</a>
                            </li>
                        </template>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="price1">
                            <div class="price">{{parseInt(product[tab].price).format()}} 원</div>
                            <div class="price_detail">
                                <strong class="title">{{ product[tab].name }}</strong><br>
                                <div class="conts">
                                    {{ product[tab].description }}
                                </div>
                                <div class="box_gray">
                                    <dt>작업기간</dt>
                                    <dd>{{ product[tab].work }}일</dd>
                                    <dt>수정횟수</dt>
                                    <dd>{{ product[tab].modify }}회</dd>
                                    <dt>추가옵션</dt>
                                    <span class="line"></span>
                                    <template v-for="item in product.options" v-if="item.bool">
                                        <dt>{{ item.name }}</dt>
                                        <dd v-if="item.detail == 'detail'">{{parseInt(item[tab].price).format()}}원 추가시 {{item[tab].option}}</dd>
                                        <dd v-if="item.detail == 'custom'">{{item.description}}</dd>
                                        <dd v-if="!item.detail"></dd>
                                    </template>
                                    <span class="line"></span>
                                    <dt>세금계산서 발행</dt>
                                    <dd>가능</dd>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="area_btn">
            <!-- 찜하기 눌렀을 때 class="on"추가 -->
            <div class="icon_jjim" :class="{'on' : checkLike(product.idx)}" @click="postLike(product.idx)"></div>
            <a href="" class="btn_cs">문의하기</a>
            <div class="box_btn"><a href="" @click="event.preventDefault(); postOrder();">구매하기</a></div>
        </div>
    </div>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            product : {type : Object, default : null},
            member_idx : {type : String, default : ""},
        },
        data: function(){
            return {
                jl : null,
                filter : {

                },
                data : {

                },
                tab : 'basic',
                likes : [],
            };
        },
        created: function(){
            this.jl = new Jl('<?=$componentName?>');
            if(this.product.package) this.tab = 'standard'
            this.getLike();
        },
        mounted: function(){
            this.$nextTick(() => {

            });
        },
        methods: {
            async postChatRoom() {
                if(this.member_idx) {
                    let obj = {
                        buyer_idx : this.member_idx,
                        seller_idx : this.product.member_idx
                    }

                    var res = await this.jl.ajax("insert", obj, "/api/member_chat_room.php");

                    window.location.href = `${this.jl.root}/bbs/chat.php?idx=${res.data.idx}`
                }else {
                    alert("로그인이 필요한 기능입니다.");
                }
            },
            calcReview : function(item) {
                if(item.review_count == 0) return 0;

                let score = item.review_score / item.review_count;

                return Math.round(score * 2) / 2 / 10;
            },
            async postOrder() {
                if(!this.member_idx) {
                    alert("로그인이 필요한 기능입니다.");
                    return false;
                }


                let order = {
                    order_no : this.jl.generateUniqueId(),
                    member_idx : this.member_idx,
                    seller_idx : this.product.member_idx,
                    product_idx : this.product.idx,
                    package : this.tab,
                    options : "옵션 아직 회의진행중",
                    price : parseInt(this.product[this.tab].price),
                    status : "진행대기"
                }

                var res = await this.jl.ajax("insert", order, "/api/member_order.php");

                if (res) {
                    alert("구매가 완료되었습니다.");
                }
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
            async checkFile(file) {
                var filter = {file : file};
                var res = await this.jl.ajax("check_file",filter,"/api/common.php");

                if(res) {
                    return res.result;
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