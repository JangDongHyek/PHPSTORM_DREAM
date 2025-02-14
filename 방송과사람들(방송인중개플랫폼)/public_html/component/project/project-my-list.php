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
                                <span class="state v1">진행 중</span><span class="state v2">모집 종료</span><span class="state v3">선정 완료</span><!--의뢰인 버전-->
                                1차 카테고리 · 2차 카테고리
                                <button type="button" class="bookmark"><i class="fa-light fa-bookmark"></i></button><!--북마크시 fa-solid fa-bookmark-->
                            </div>
                            <h2 class="project-title">프로젝트명</h2>
                            <p class="project-desc">프로젝트 설명입니다.</p>
                        </div>
                    </div>
                </a>
                <div class="btn-wrap"><!--의뢰인 버전-->
                    <button type="button">수정</button>
                    <button type="button">삭제</button>
                    <button type="button" class="blue" @click="modal.status = true">선정</button>
                </div>
            </li>
        </ul>

        <external-bs-modal :modal="modal.status" @close="modal.status = false;" class_1="prize-container" class_2="">
            <template v-slot:header>

            </template>

            <!-- body -->
            <template v-slot:default>

                    <div>
                        <div class="portfolio-header">
                            선정하기
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="join-list">
                            <div class="btn-wrap">
                                <button type="button" class="project-add">선정 결과 저장</button><!--의뢰인 버전-->
                                <button type="button" class="project-done">미선정 마감</button><!--의뢰인 버전-->
                            </div>
                            <ul>
                                <li>
                                    <a>
                                        <div class="img"><img src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg"></div>
                                        <p>#1</p><!--참여순서-->
                                        <div class="profile">
                                            <img src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg" alt="프로필 이미지">
                                            <span>지원자</span>
                                            <select>
                                                <option>미선정</option>
                                                <option>1등</option>
                                                <option>2등</option>
                                                <option>3등</option>
                                            </select>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <div class="img"><img src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg"></div>
                                        <p>#2</p><!--참여순서-->
                                        <div class="profile">
                                            <img src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg" alt="프로필 이미지">
                                            <span>지원자</span>
                                            <select>
                                                <option>미선정</option>
                                                <option>1등</option>
                                                <option>2등</option>
                                                <option>3등</option>
                                            </select>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <div class="img"><img src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg"></div>
                                        <p>#3</p><!--참여순서-->
                                        <div class="profile">
                                            <img src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg" alt="프로필 이미지">
                                            <span>지원자</span>
                                            <select>
                                                <option>미선정</option>
                                                <option>1등</option>
                                                <option>2등</option>
                                                <option>3등</option>
                                            </select>
                                        </div>
                                    </a>
                                </li>
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

                data: {},
                arrays : [],

                options : {
                    required : [
                        {name : "",message : ``},
                    ],
                    href : "",
                },

                filter : {
                    table : "project",
                    user_idx : this.mb_no,

                    page: 1,
                    limit: 1,
                    count: 0,

                    extensions : [
                        {table : "g5_member", foreign : "user_idx"}
                    ],
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

            //if(this.primary) this.data = await this.jl.getData(this.filter);
            await this.jl.getsData(this.filter,this.arrays);

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