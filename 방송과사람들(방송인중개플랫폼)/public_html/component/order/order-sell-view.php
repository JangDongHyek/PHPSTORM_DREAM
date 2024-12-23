<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div>
        <div id="item_view" class="order view">
            <div class="inr v2">
                <h3 class="ptitle">상세내역</h3>

                <div class="pd_info">
                    <div class="pd_view">
                        <i class="type">{{ data.status }}</i>
                        <i @click="modal = true" class="type" :class="getClass(data)"><em></em>{{ data.status }}</i>
                        <a href="<?=G5_BBS_URL?>/item_view.php">
                            <div class="img_pd"><img src="<?php echo G5_IMG_URL ?>/app/img_product01.jpg"></div><!--서비스 썸네일 추출-->
                            <div class="info">
                                <ul class="pd_info_list">
                                    <li class="data">{{ data.insert_date }}</li>
                                    <li>(주문번호:{{ data.order_no }})</li>
                                </ul>
                                <div class="tit">{{ data.MEMBER_PRODUCT.name }}</div>

                                <div id="seller_info">
                                    <div class="name"><p>스튜디오오늘</p></div>
                                </div>
                            </div>
                        </a>

                        <div class="sale_info">
                            <ul class="list_top">
                                <li class="pinfo">상품정보</li>
                                <li class="amount">수량</li>
                                <li class="price">금액</li>
                            </ul>
                            <ul class="list_sale">
                                <li class="pinfo">
                                    <h3>7일 완성 영상 (기획+촬영+편집)</h3>
                                    <span>작업일 <i class="point">7일</i></span>
                                </li>
                                <li class="amount">
                                    <em>수량</em> <span class="count">1개</span>
                                </li>
                                <li class="price"><span>200,000원</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="total">
                        <h3>총 결제금액</h3>
                        <div class="total_price">200,000원</div>
                    </div>
                </div>
                <div id="btn_cs">
                    <a href="">의뢰인과 채팅하기</a>
                </div>
            </div>
        </div>

        <slot-modal v-if="modal" :modal="modal" @close="modal = false">
            <ul id="sort_list">
                <li @click="putData('진행대기')" :class="{'active' : data.status == '진행대기'}"><em>진행대기</em></li>
                <li @click="putData('진행중')" :class="{'active' : data.status == '진행중'}"><em>진행중</em></li>
                <li @click="putData('완료')" :class="{'active' : data.status == '완료'}"><em>완료</em></li>
                <li @click="putData('취소')" :class="{'active' : data.status == '취소'}"><em>취소</em></li>
            </ul>
        </slot-modal>
    </div>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            primary : {type : String, default : ""},
            member_idx : {type : String, default : ""},
            order_no : {type : String, default : ""},
        },
        data: function(){
            return {
                jl : null,
                filter : {
                    seller_idx : this.member_idx,
                    order_no : this.order_no
                },
                data : {},

                modal : false
            };
        },
        created: function(){
            this.jl = new Jl('<?=$componentName?>');

            if(this.member_idx) this.getData();
        },
        mounted: function(){
            this.$nextTick(() => {

            });
        },
        methods: {
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
            async putData(status) {
                this.data.status = status
                var res = await this.jl.ajax("update",this.data,"/api/member_order.php");

                if(res) {

                }
            },

            async getData() {
                var res = await this.jl.ajax("get",this.filter,"/api/member_order.php");

                if(res) {
                    this.data = res.response.data[0];
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