<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div v-if="load">
        <ul class="project-list">
            <li class="project-item">
                <ul class="prize-info">
                    <li><span>🏆 총 상금</span> 80만 원</li>
                    <li><span>📌 참여작</span> 21개</li>
                    <li><span>📅 진행 기간</span> 6일</li>
                    <li><span>📆 날짜</span> 25.02.05 ~ 25.02.11</li>
                </ul>
                <a class="project-link">
                    <div class="thumb" onclick="location.href='./project_view.php'">
                        <img src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg" alt="프로젝트 이미지">
                    </div>
                    <div class="project-cont">
                        <div class="project-info">
                            <div class="project-category">
                                <span class="state v1">지원 완료</span><span class="state v2">지원 취소</span><span class="state v3">선정 완료</span>
                                1차 카테고리 · 2차 카테고리
                                <button type="button" class="bookmark"><i class="fa-light fa-bookmark"></i></button><!--북마크시 fa-solid fa-bookmark-->
                            </div>
                            <h2 class="project-title">프로젝트명</h2>
                            <p class="project-desc">프로젝트 설명입니다.</p>
                        </div>
                    </div>
                </a>
                <div class="btn-wrap"><!--전문가 버전-->
                    <button type="button" onclick="location.href='./project_join.php'">지원 보기</button>
                    <button type="button">지원 취소</button>
                    <button type="button" class="gray">지원 취소됨</button><!--취소시 교체 노출-->
                    <button type="button" class="blue" data-toggle="modal" data-target="#prizeCheckModal">결과 확인</button>
                </div>
            </li>
        </ul>

        <external-bs-modal :modal="modal.status" @close="modal.status = false;" class_1="prize-result" class_2="">
            <template v-slot:header>

            </template>

            <!-- body -->
            <template v-slot:default>
                <div>
                    <div class="portfolio-header">
                        선정 결과
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="box">
                        축하합니다! 1등에 선정되었습니다. <!--미선정되었습니다. 참여에 감사드립니다.-->
                    </div>
                    <div class="prize-info">
                        <div class="">프로젝트 총 상금</div>
                        <div class="total-prize">35만 원</div>
                        <ul>
                            <li><span class="first-prize"><b>1등</b> 35만 원</span> <span class="winner-count">x 1명</span></li>
                        </ul>

                    </div>
                </div>
            </template>


            <template v-slot:footer>

            </template>
        </external-bs-modal>
    </div>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            primary : {type: String, default: ""},
        },
        data: function () {
            return {
                load : false,
                jl: null,
                component_idx: "",

                row: {},
                rows : [],

                options : {
                    required : [
                        {name : "",message : ``},
                    ],
                    href : "",
                },

                filter : {
                    table : "",
                    primary : this.primary,
                    page: 1,
                    limit: 1,
                    count: 0,
                },

                modal : {
                    status : false,
                    data : {},
                },

                load : false,
            };
        },
        async created() {
            this.jl = new Jl('<?=$componentName?>');
            this.component_idx = this.jl.generateUniqueId();

            if(this.primary) this.row = await this.jl.getData(this.filter);
//await this.jl.getsData(this.filter,this.rows);

            this.load = true;
        },
        mounted() {
            this.$nextTick(() => {

            });
        },
        updated() {

        },
        methods: {

        },
        computed: {

        },
        watch: {

        }
    });

</script>

<style>

</style>