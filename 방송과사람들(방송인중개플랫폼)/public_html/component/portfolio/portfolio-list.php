<?php $componentName = str_replace(".php", "", basename(__FILE__)); ?>
<script type="text/x-template" id="<?= $componentName ?>-template">
    <div class="mypage_cont">
        <div class="box">
            <h3>나의 포트폴리오관리</h3>

            <ul id="product_list">
                <li>
                    <i class="heart on"></i>
                    <a href="">
                        <div class="area_img">
                            <img src="">
                        </div>
                        <div class="area_txt">

                            <span>업체명</span><!-- 업체명 -->
                            <h3>제목</h3> <!-- 제목 -->
                        </div>

                    </a>
                    <a class="list_btn" href="<?= G5_BBS_URL . "/portfolio_write.php?idx=" . $row['i_idx'] ?>">수정</a>
                    <!-- 제목 -->
                </li>

                <li class="nodata" v-if="data.length == 0">
                    <div class="nodata_wrap">
                        <div class="area_img"><img :src="`${jl.root}/theme/basic_app/img/app/img_nodata.svg`"></div>
                        <p>등록한 포트폴리오가 없습니다.</p>
                        <button @click="location.href=`${jl.root}/bbs/portfolio_write.php`" class="btn">
                            포트폴리오 등록하기
                        </button>
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
            primary: {type: String, default: ""}
        },
        data: function () {
            return {
                jl: null,
                filter: {},
                data: [],
            };
        },
        created: function () {
            this.jl = new JL('<?=$componentName?>');
        },
        mounted: function () {
            this.$nextTick(() => {

            });
        },
        methods: {
            postData: function () {
                var method = this.primary ? "update" : "insert";
                var res = this.jl.ajax(method, this.data, "/api/example.php");

                if (res) {

                }
            },
            getData: function () {
                var res = this.jl.ajax("get", this.data, "/api/example.php");

                if (res) {
                    this.data = res.response.data

                }
            }
        },
        computed: {},
        watch: {}
    });
</script>

<style>

</style>