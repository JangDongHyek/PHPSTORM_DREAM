<?php $componentName = str_replace(".php", "", basename(__FILE__)); ?>
<script type="text/x-template" id="<?= $componentName ?>-template">
    <div class="mypage_cont">
        <div class="box">
            <h3>나의 포트폴리오관리</h3>


            <ul id="product_list">
                <li v-for="item in data">
                    <i class="heart" :class="{'on' : checkLike(item.idx)}" @click="checkLike(item.idx) ? deleteLike(item.idx) : postLike(item.idx)"></i>
                    <a :href="`${jl.root}/bbs/portfolio_view.php?idx=${item.idx}`">
                        <div class="area_img" v-if="item.main_image_array.length > 0">
                            <img :src="jl.root+item.main_image_array[0].src">
                        </div>
                    </a>
                    <div class="area_txt">
                        <!-- <span>업체명</span>업체명 -->
                        <div class="grid">
                            <h3>{{ item.name }}</h3> <!-- 제목 -->
                            <a :href="`${jl.root}/bbs/portfolio_write.php?idx=${item.idx}`"><i class="fa-regular fa-pen"></i><!--수정--></a>
                            <a href="" @click="event.preventDefault(); deleteData(item)"><i class="fa-light fa-trash"></i><!--삭제--></a>
                        </div>
                    </div>
                </li>
                
                <li class="write_btn">
                    <a @click="location.href=`${jl.root}/bbs/portfolio_write.php`">
                        <button class="area_img">
                            <i class="fa-light fa-plus"></i>
                        </button>
                    </a>
                    <div class="area_txt">
                        <h3>포트폴리오 추가하기</h3>
                    </div>
                </li>

                <li class="nodata" v-if="data.length == 0">
                    <div class="nodata_wrap">
                        <div class="area_img"><img :src="`${jl.root}/theme/basic_app/img/app/img_nodata.svg`"></div>
                        <p>등록한 포트폴리오가 없습니다.</p>
                    </div>
                </li>
            </ul>
        </div>
        
    </div>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            mb_no: {type: String, default: ""}
        },
        data: function () {
            return {
                jl: null,
                filter: {},
                data: [],
                likes : [],
            };
        },
        created: function () {
            this.jl = new JL('<?=$componentName?>');
            this.getData();
            this.getLike();
        },
        mounted: function () {
            this.$nextTick(() => {

            });
        },
        methods: {
            deleteLike : function(portfolio_idx) {
                var method = "sql_delete";
                var data = {
                    member_idx : this.mb_no,
                    portfolio_idx : portfolio_idx
                }
                var res = this.jl.ajax(method, data, "/api/member_portfolio_like.php");

                if (res) {
                    this.getLike();
                }
            },
            checkLike : function(portfolio_idx) {
                return this.likes.some(obj => obj.portfolio_idx == portfolio_idx)
            },
            getLike : function() {
                var filter = {member_idx : this.mb_no}
                var res = this.jl.ajax("get", filter, "/api/member_portfolio_like.php");

                if (res) {
                    this.likes = res.response.data
                }
            },
            postLike : function(portfolio_idx) {
                var method = "insert";
                var data = {
                    member_idx : this.mb_no,
                    portfolio_idx : portfolio_idx
                }
                var res = this.jl.ajax(method, data, "/api/member_portfolio_like.php");

                if (res) {
                    this.getLike();
                }
            },
            postData: function () {
                var method = this.primary ? "update" : "insert";
                var res = this.jl.ajax(method, this.data, "/api/example.php");

                if (res) {

                }
            },
            getData: function () {
                var filter = {member_idx : this.mb_no}
                var res = this.jl.ajax("get", filter, "/api/member_portfolio.php");

                if (res) {
                    this.data = res.response.data
                }
            },
            deleteData: function (item) {
                if(confirm('삭제하시겠습니까?')) {
                    var res = this.jl.ajax("delete", item, "/api/member_portfolio.php");

                    if (res) {
                        alert("완료되었습니다")
                        this.getData();
                    }
                }
            }
        },
        computed: {},
        watch: {}
    });
</script>

<style>

</style>