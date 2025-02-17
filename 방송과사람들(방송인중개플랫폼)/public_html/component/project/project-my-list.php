<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div v-if="load">
        <ul class="project-list">
            <li class="project-item" v-for="item in arrays">
                <ul class="prize-info">
                    <li><span>🏆 총 상금</span> {{ totalPrize(item).format() }}원</li>
                    <li><span>📌 참여작</span> 21개</li>
                    <li><span>📅 진행 기간</span> {{getDurationDays(item)}}일</li>
                    <li><span>📆 날짜</span> {{item.start_date.formatDate({type : '.'})}} ~ {{item.end_date.formatDate({type : '.'})}}</li>
                </ul>
                <a class="project-link">
                    <div class="thumb" @click="jl.href('./project_view.php?primary=' + item.idx)">
                        <img :src="jl.root + item.thumb[0].src" alt="프로젝트 이미지">
                    </div>
                    <div class="project-cont">
                        <div class="project-info">
                            <div class="project-category">
                                <span class="state" :class="getStatus(item)">{{getStatus(item,'text')}}</span>
                                {{item.$category.name}} · {{item.$category2.name}}
                                <button type="button" class="bookmark"><i class="fa-light fa-bookmark"></i></button><!--북마크시 fa-solid fa-bookmark-->
                            </div>
                            <h2 class="project-title">{{item.subject}}</h2>
                            <p class="project-desc">{{item.description}}</p>
                        </div>
                    </div>
                </a>
                <div class="btn-wrap"><!--의뢰인 버전-->
                    <button type="button" @click="jl.href('./project_form.php?primary='+item.idx)">수정</button>
                    <button type="button" @click="jl.deleteData(item,'project')">삭제</button>
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

        <item-pagination :filter="filter" @change="filter.page = $event; jl.getsData(filter,arrays);"></item-pagination>
    </div>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            mb_no : {type: String, default: ""},
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
                        {table : "g5_member", foreign : "user_idx"},
                        {table : "category", foreign : "category1_idx"},
                        {table : "category", foreign : "category2_idx", as : "category2"},
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
            getStatus(item,type = "class") {
                if(item.choice) {
                    return type == "class" ? "v3" : "선정 완료";
                }else if(this.jl.isRangeDate(item.start_date,item.end_date)) {
                    return type == "class" ? "v1" : "진행 중";
                }else {
                    return type == "class" ? "v2" : "모집 종료";
                }
            },
            getDurationDays(item) {
                let startDate = item.start_date;
                let endDate = item.end_date;
                // 날짜 형식 검증 (YYYY-MM-DD)
                const dateRegex = /^\d{4}-\d{2}-\d{2}$/;

                if (!dateRegex.test(startDate) || !dateRegex.test(endDate)) {
                    throw new Error('날짜 형식은 YYYY-MM-DD로 입력해주세요.');
                }

                // Date 객체 생성
                const start = new Date(startDate);
                const end = new Date(endDate);

                if (isNaN(start.getTime()) || isNaN(end.getTime())) {
                    throw new Error('유효하지 않은 날짜입니다.');
                }

                // 일수 계산 (하루 86400000ms)
                const diffInMs = end - start;
                const diffInDays = diffInMs / (1000 * 60 * 60 * 24);

                if (diffInDays < 0) {
                    throw new Error('시작 날짜가 종료 날짜보다 이후일 수 없습니다.');
                }

                return diffInDays + 1; // 시작일부터 종료일까지 포함
            },
            totalPrize(item) {
                let total = 0;

                for (const prize of item.prize) {
                    total += prize.money * prize.people;
                }

                return total;
            }
        },
        computed: {

        },
        watch: {

        }
    });

</script>

<style>

</style>