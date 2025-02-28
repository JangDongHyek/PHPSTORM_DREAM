<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div v-if="load">
        <ul class="project-list" v-if="rows.length">
            <li class="project-item" v-for="item in rows">
                <ul class="prize-info">
                    <li><span>🏆 예산</span> {{ totalPrize(item.$project).format() }}원</li>
                    <li><span>📌 지원자</span> {{item.$project.$project_request.length}}명</li>
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
                                {{item.$project.$category.name}} · {{item.$project.$category2.name}}
                                <button type="button" class="bookmark" @click="postBookmark(item.$project)"><i :class="item.$project.$project_bookmark.length ? 'fa-solid' : 'fa-light'" class="fa-bookmark"></i></button><!--북마크시 fa-solid fa-bookmark-->
                            </div>
                            <h2 class="project-title" @click="jl.href('./project_view.php?primary=' + item.$project.idx)">{{item.$project.subject}}</h2>
                            <p class="project-desc">{{item.$project.description}}</p>
                        </div>
                    </div>
                </a>
            </li>
        </ul>

        <div v-else>북마크한 프로젝트가 없습니다</div>

        <item-pagination :filter="filter" @change="filter.page = $event; jl.getsData(filter,rows);"></item-pagination>
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
                    table : "",
                    file_use : false,
                    required : [
                        {name : "",message : ``},
                    ],
                    href : "",
                },

                filter : {
                    table : "project_bookmark",
                    user_idx : this.mb_no,

                    page: 1,
                    limit: 10,
                    count: 0,

                    extensions : [
                        {
                            table : "project",
                            foreign : "project_idx",
                            as : "",
                            extensions : [
                                {table : "g5_member", foreign : "user_idx"},
                                {table : "category", foreign : "category1_idx"},
                                {table : "category", foreign : "category2_idx", as : "category2"},
                            ],
                            relations : [
                                {
                                    table : "project_request" ,
                                    foreign : "project_idx",
                                    type : "data",
                                    filter : {
                                        where : [
                                            {key : "cancel", value : 'jl_null', operator : ""} // AND,OR,AND NOT
                                        ],
                                    }
                                }, // data,count
                                {
                                    table : "project_bookmark" ,
                                    foreign : "project_idx",
                                    type : "data",
                                    filter : {
                                        user_idx : this.mb_no,
                                    },
                                }, // type(count,data)
                            ],
                        }, // as값이있다면 $테이블명이아닌 $as값으로 가져온다
                    ],
                },

                modal : {
                    status : false,
                    load : false,
                    data : {},
                    class_1 : "",
                    class_2 : "",
                },

            };
        },
        async created() {
            this.jl = new Jl('<?=$componentName?>');
            this.component_idx = this.jl.generateUniqueId();
        },
        async mounted() {
            if(this.primary) this.row = await this.jl.getData(this.filter);
            await this.jl.getsData(this.filter,this.rows);



            this.load = true;

            this.$nextTick(() => {

            });
        },
        updated() {

        },
        methods: {
            async postBookmark(project) {
                let row = {user_idx : this.mb_no,project_idx : project.idx};
                let options = {table : "project_bookmark",return : true};

                if(project.$project_bookmark.length) {
                    await this.jl.deleteData(project.$project_bookmark[0],options)
                }else {
                    await this.jl.postData(row,options);
                }

                await this.jl.getsData(this.filter,this.rows);
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