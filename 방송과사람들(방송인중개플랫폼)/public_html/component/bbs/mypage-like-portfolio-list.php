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
<!--                        <i class="heart" :class="{'on' : checkLike(item.idx)}" @click="checkLike(item.idx) ? deleteLike(item.idx) : postLike(item.idx)"></i>-->
                        <a :href="`${jl.root}/bbs/portfolio_view.php?idx=${item.idx}`">
                            <div class="area_img">
                                <img :src="`${jl.root}${item.main_image_array[0].src}`">
                            </div>
                            <div class="area_txt">
                                <h3>{{item.name}}</h3> <!-- 제목 -->
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
            primary: {type: String, default: ""},
            mb_no: {type: String, default: ""},
        },
        data: function () {
            return {
                jl: null,
                component_idx: "",

                paging: {
                    page: 1,
                    limit: 1,
                    count: 0,
                },

                data: {},
            };
        },
        async created() {
            this.jl = new Jl('<?=$componentName?>');
            this.component_idx = this.jl.generateUniqueId();

            await this.getPortfolioLike();
        },
        mounted() {
            this.$nextTick(() => {

            });
        },
        updated() {

        },
        methods: {
            async postData() {
                let method = this.primary ? "update" : "insert";
                let data = {
                    table: "",
                }

                if (this.data) data = Object.assign(data, this.data); // paging 객체가있다면 병합

                try {
                    let res = await this.jl.ajax(method, data, "/jl/JlApi.php");
                } catch (e) {
                    alert(e.message)
                }

            },
            async getPortfolioLike() {
                let filter = {
                    table: "member_portfolio_like",

                    member_idx : this.mb_no,

                    join : {
                        table : "member_portfolio", origin : "portfolio_idx", join : "idx",
                        source : true, // true 시 join 테이블이 조회 기준이 된다
                        //select : ["column1","user.column2","user.column3 as a"] // 조회 기준이 아닌 테이블의 컬럼을 추가 조회하고싶을때 넣는다
                        //select : "*" // 조회 기준이 아닌 테이블의 모든 컬럼을 가져오고싶을때 사용 속도로 인한 비추천
                    },
                }

                try {
                    let res = await this.jl.ajax("get", filter, "/jl/JlApi.php");
                    this.data = res.data
                } catch (e) {
                    alert(e.message)
                }
            }
        },
        computed: {},
        watch: {}
    });

</script>

<style>

</style>