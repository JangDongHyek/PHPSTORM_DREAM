<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div>
        <div class="mypage_cont">
            <div class="box">
                <h3>판매관리</h3>
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
                    <li v-else v-for="item in data">
                        <div class="area_img">
                            <a :href="`${jl.root}/bbs/mypage_sale_view.php?order_no=${item.order_no}`">
                                <img :src="jl.root+item.MEMBER_PRODUCT.main_image_array[0].src">
                            </a>
                        </div>
                        <div class="area_right">
                            <i class="type" :class="getClass(item)" @click="select_item = item; modal = true"><em></em>{{ item.status }}</i>
                            <div class="area_txt">
                                <a href="<?php echo G5_BBS_URL ?>/mypage_sale_view.php">

                                    <h3>{{ item.MEMBER_PRODUCT.name }}</h3> <!-- 제목 -->
                                    <div class="price">{{ parseInt(item.price).format() }}원</div> <!-- 가격 -->
                                    <div id="seller_info">
                                        <div class="photo">
                                            <img class="p_img" v-if="checkFile(`/data/file/member/${item.BUYER.mb_no}.jpg`)" :src="`${jl.root}/data/file/member/${item.BUYER.mb_no}.jpg`">
                                            <img class="p_img" v-else :src="`${jl.root}/img/img_smile.jpg`">
                                        </div>
                                        <div class="name"><p>{{ item.BUYER.mb_nick }}</p></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </li>
                </ul>

            </div>
        </div>

        <slot-modal v-if="modal" :modal="modal" @close="modal = false">
            <ul id="sort_list">
                <li @click="putData('진행대기')" :class="{'active' : select_item.status == '진행대기'}"><em>진행대기</em></li>
                <li @click="putData('진행중')" :class="{'active' : select_item.status == '진행중'}"><em>진행중</em></li>
                <li @click="putData('완료')" :class="{'active' : select_item.status == '완료'}"><em>완료</em></li>
                <li @click="putData('취소')" :class="{'active' : select_item.status == '취소'}"><em>취소</em></li>
            </ul>
        </slot-modal>
    </div>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            primary : {type : String, default : ""},
            member_idx : {type : String, default : ""}
        },
        data: function(){
            return {
                jl : null,
                filter : {
                    seller_idx : this.member_idx,
                    page : 1,
                    limit : 8,
                },
                count : 0,
                data : [],

                select_item : null,

                modal : false
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
            checkFile : function(file) {
                var filter = {file : file};
                var res = this.jl.ajax("check_file",filter,"/api/common.php");

                if(res) {
                    return res.result;
                }
            },
            putData : function(status) {
                this.select_item.status = status
                var res = this.jl.ajax("update",this.select_item,"/api/member_order.php");

                if(res) {

                }
            },
            postData : function() {
                var method = this.primary ? "update" : "insert";
                var res = this.jl.ajax(method,this.data,"/api/example.php");

                if(res) {

                }
            },
            getData: function () {
                var res = this.jl.ajax("get",this.filter,"/api/member_order.php");

                if(res) {
                    this.data = res.response.data;
                    this.count = res.response.count;
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