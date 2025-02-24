<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div v-if="load">
        <div v-if="load">
            <ul class="project-list">
                <li class="project-item" v-for="item in rows">
                    <ul class="prize-info">
                        <li><span>🏆 총 상금</span> {{ totalPrize(item.$project).format() }}원</li>
                        <li><span>📌 참여작</span> {{item.$project.$project_request}}개</li>
                        <li><span>📅 진행 기간</span> {{getDurationDays(item.$project)}}일</li>
                        <li><span>📆 날짜</span> {{item.$project.start_date.formatDate({type : '.'})}} ~ {{item.$project.end_date.formatDate({type : '.'})}}</li>
                    </ul>
                    <a class="project-link">
                        <div class="thumb" @click="jl.href('./project_view.php?primary=' + item.$project.idx)">
                            <img :src="jl.root + item.$project.thumb[0].src" alt="프로젝트 이미지">
                        </div>
                        <div class="project-cont">
                            <div class="project-info">
                                <div class="project-category">
                                    <span class="state v1" :class="getClass(item)">{{ getStatus(item) }}</span>
                                    {{item.$project.$category.name}} · {{item.$project.$category2.name}}
                                    <button type="button" class="bookmark"><i class="fa-light fa-bookmark"></i></button><!--북마크시 fa-solid fa-bookmark-->
                                </div>
                                <h2 class="project-title">{{item.$project.subject}}</h2>
                                <p class="project-desc">{{item.$project.description}}</p>
                            </div>
                        </div>
                    </a>
                    <div class="btn-wrap"><!--전문가 버전-->
                        <button type="button" v-if="!item.cancel && getStatus(item) != '선정 완료'" @click="jl.href(`./project_join.php?primary=${item.idx}&project_idx=${item.$project.idx}`)">지원 보기</button>
                        <button type="button" v-if="!item.cancel && getStatus(item) != '선정 완료'" @click="jl.postData(item,options)">지원 취소</button>
                        <button type="button" v-if="item.cancel" class="gray">지원 취소됨</button><!--취소시 교체 노출-->
                        <button type="button" v-if="getStatus(item) == '선정 완료'" class="blue" @click="modal.data = item; modal.status = true;">결과 확인</button>
                    </div>
                </li>
            </ul>

            <external-bs-modal-new :modal="modal">
                <template v-slot:header>
                    <div class="portfolio-header">
                        선정 결과
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </template>

                <!-- body -->
                <template v-slot:default>
                    <div>
                        <div class="box" v-if="modal.data.prize">
                            축하합니다! {{modal.data.prize}}에 선정되었습니다. <!--미선정되었습니다. 참여에 감사드립니다.-->
                        </div>

                        <div class="box" v-else>
                            미선정되었습니다. 참여에 감사드립니다.
                        </div>

                        <div class="prize-info">
                            <div class="">프로젝트 총 상금</div>
                            <div class="total-prize">{{totalPrize(modal.data.$project)}}원</div>
                            <ul>
                                <li v-for="p in modal.data.$project.prize">
                                    <span class="first-prize"><b>{{p.subject}}</b> {{p.money}}원</span> <span class="winner-count">x {{p.people}}명</span>
                                </li>
                            </ul>

                        </div>
                    </div>
                </template>


                <template v-slot:footer>

                </template>
            </external-bs-modal-new>
        </div>
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
                    table : "project_request",
                    file_use : false,
                    required : [
                        {name : "",message : ``},
                    ],
                    updated : [
                        {key : "cancel", value : true},
                    ],
                    confirm : {
                        message : '정말 취소하시겠습니까?',
                    },
                    href : "",
                },

                filter : {
                    table : "project_request",
                    page: 1,
                    limit: 1000,
                    count: 0,

                    relations : [
                        {table : "project_request" ,foreign : "project_idx",type : "count"}, // data,count
                    ],
                },

                modal : {
                    status : false,
                    load : false,
                    data : {},
                    class_1 : "prize-result",
                    class_2 : "",
                },

            };
        },
        async created() {
            this.jl = new Jl('<?=$componentName?>');
            this.component_idx = this.jl.generateUniqueId();
        },
        async mounted() {
            //if(this.primary) this.row = await this.jl.getData(this.filter);
            await this.jl.getsData(this.filter,this.rows);

            for (const row of this.rows) {
                let project = await this.jl.getData({
                    table : 'project',
                    primary : row.project_idx,
                    extensions : [
                        {table : "category", foreign : "category1_idx"},
                        {table : "category", foreign : "category2_idx", as : "category2"},
                    ],

                    relations : [
                        {
                            table : "project_request" ,
                            foreign : "project_idx",
                            type : "count",
                            filter : {
                                where : [
                                    {key : "cancel", value : 'jl_null', operator : ""} // AND,OR,AND NOT
                                ],
                            }
                        }, // data,count
                    ],
                });
                row['$project'] = project;
            }

            this.load = true;

            this.$nextTick(() => {

            });
        },
        updated() {

        },
        methods: {
            getClass(item) {
                if(item.cancel) return "v2";
                else if(item.$project.choice) return "v3";
                else return "v1";
            },
            getStatus(item) {
                if(item.cancel) return "지원 취소";
                else if(item.$project.choice) return "선정 완료";
                else return "지원 완료";
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
            async "modal.status"(value,old_value) {
                if(value) {
                    this.modal.load = true;
                }else {
                    this.modal.load = false;
                    this.modal.data = {};
                }
            }
        }
    });

</script>

<style>

</style>