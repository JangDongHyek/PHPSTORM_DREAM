<?php
$componentName = str_replace(".php","",basename(__FILE__));
$pathParts = explode(DIRECTORY_SEPARATOR, dirname(__FILE__));
$context = end($pathParts);
?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div v-if="load">
        <div class="inr">
            <ul id="area_history"><li><a href="">홈</a></li> <!----> <li><a href="" class="current">프로젝트</a></li></ul>
            <div id="list_top">
                <div class="total">총 {{filter.count}}건</div>
                <div class="sort_list" @click="modal.status = true;"><span>최신순</span></div>
            </div>
            <ul class="project-list" v-if="rows.length > 0">
                <li class="project-item" v-for="item in rows">
                    <a @click="jl.href('./project_view.php?primary=' + item.idx)" class="project-link">
                        <div class="thumb">
                            <img :src="jl.root + item.thumb[0].src" alt="프로젝트 이미지">
                        </div>
                        <div class="project-cont">
                            <div class="project-info">
                                <div class="project-category">
                                    {{item.$category.name}} · {{item.$category2.name}}
                                    <button type="button" class="bookmark" @click="event.stopPropagation();postBookmark(item)"><i :class="item.$project_bookmark.length ? 'fa-solid' : 'fa-light'" class="fa-bookmark"></i></button><!--북마크시 fa-solid fa-bookmark-->
                                </div>
                                <h2 class="project-title">{{item.subject}}</h2>
                                <p class="project-desc">{{item.description}}</p>
                            </div>
                            <div class="project-user">
                                <div class="user-info">
                                    <img class="user-img" v-if="!item.file_exists" src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg" alt="프로필 이미지">
                                    <img class="user-img" v-else :src="jl.root + '/data/file/member/' + item.user_idx + '.jpg'" alt="프로필 이미지">
                                    <span>{{item.$g5_member.mb_nick}}</span>
                                </div>
                                <div class="view-count">👁️ {{item.hits.format()}}</div>
                            </div>
                        </div>
                        <ul class="prize-info">
                            <li><span>🏆 예산</span> {{totalPrize(item).format()}} 원</li>
                            <li><span>📌 지원자</span> {{item.$project_request.length}}명</li>
                            <li><span>📅 진행 기간</span> {{getDurationDays(item)}}일</li>
                            <li><span>📆 날짜</span> {{item.start_date.formatDate({type : '.'})}} ~ {{item.end_date.formatDate({type : '.'})}} </li>
                        </ul>
                    </a>
                </li>
            </ul>
            
            <div v-else>
                <li class="nodata text-center">
                    <div class="nodata_wrap">
                        <div class="area_img"><img :src="`${jl.root}/theme/basic_app/img/app/img_nodata.svg`" width="250"></div>
                        <br><p>등록된 의뢰가 없습니다.</p>
                    </div>
                </li>
            </div>
        </div>

        <item-paging :filter="filter" @change="jl.getsData(filter,rows);"></item-paging>


        <external-bs-modal-new :modal="modal">
            <template v-slot:header>

            </template>

            <!-- body -->
            <template v-slot:default>
                <ul id="sort_list" class="sort_list_mobile">
                    <li :class="{'active' : filter.order_by_desc == 'idx'}" @click="filter.order_by_desc = 'idx'">최신순</li>
                    <li :class="{'active' : filter.order_by_desc == 'hits'}" @click="filter.order_by_desc = 'hits'">추천순</li>
                    <li>별점순</li>
                </ul>
            </template>


            <template v-slot:footer>

            </template>
        </external-bs-modal-new>
    </div>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            category1_idx : {type: String, default: ""},
            category2_idx : {type: String, default: ""},
            mb_no : {type: String, default: ""},
            primary : {type: String, default: ""},
        },
        data: function () {
            return {
                load : false,
                jl: null,
                component_idx: "",
                context : "<?=$context?>",

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
                    table : "project",

                    page: 1,
                    limit: 10,
                    count: 0,

                    category1_idx : this.category1_idx,
                    category2_idx : this.category2_idx,

                    status : true,

                    order_by_desc : "idx",

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
            //if(this.primary) this.row = await this.jl.getData(this.filter);
            await this.jl.getsData(this.filter,this.rows,{
                callback : async (res) => {
                    let rows = res.data;
                    for (const row of rows) {
                        await this.jl.ajax("file_exists",{src : `/data/file/member/${row.user_idx}.jpg`},"/jl/JlApi.php").then(response => {
                            row.file_exists = response.exists;
                        });
                    }

                    this.filter.count = res.count;
                    this.rows = rows;
                },
            });

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

                await this.jl.getsData(this.filter,this.rows,{
                    callback : async (res) => {
                        let rows = res.data;
                        for (const row of rows) {
                            await this.jl.ajax("file_exists",{src : `/data/file/member/${row.user_idx}.jpg`},"/jl/JlApi.php").then(response => {
                                row.file_exists = response.exists;
                            });
                        }

                        this.filter.count = res.count;
                        this.rows = rows;
                    },
                });
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