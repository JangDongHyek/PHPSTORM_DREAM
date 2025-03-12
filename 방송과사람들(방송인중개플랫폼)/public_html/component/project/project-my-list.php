<?php
$componentName = str_replace(".php","",basename(__FILE__));
$pathParts = explode(DIRECTORY_SEPARATOR, dirname(__FILE__));
$context = end($pathParts);
?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div v-if="load">
        <ul class="project-list" v-if="arrays.length > 0">
            <li class="project-item" v-for="item in arrays">
                <ul class="prize-info">
                    <li><span>🏆 예산</span> {{ totalPrize(item).format() }}원</li>
                    <li><span>📌 지원자</span> {{item.$project_request.length}}명</li>
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
                                <span class="state" :class="common.getClass(item)" >{{common.getStatus(item)}}</span>
                                {{item.$category.name}} · {{item.$category2.name}}
                                <button type="button" class="bookmark" @click="postBookmark(item)"><i :class="item.$project_bookmark.length ? 'fa-solid' : 'fa-light'" class="fa-bookmark"></i></button><!--북마크시 fa-solid fa-bookmark-->
                            </div>
                            <h2 class="project-title" @click="jl.href('./project_view.php?primary=' + item.idx)">{{item.subject}}</h2>
                            <p class="project-desc">{{item.description}}</p>
                        </div>
                    </div>
                </a>
                <div class="btn-wrap"><!--의뢰인 버전-->
                    <button type="button" v-if="!item.status" @click="jl.href('./project_form.php?primary='+item.idx)">수정</button>
                    <button type="button" v-if="!item.choice && !item.status" @click="jl.deleteData(item,{table : 'project'})">삭제</button>
                    <button type="button" v-else @click="jl.href('./project_view.php?tab=1&primary=' + item.idx)">매칭보기</button>
                    <button type="button" class="blue" @click="modal.status = true; modal.data = item">선정</button>
                </div>
            </li>
        </ul>

        <div v-else>
            <div class="nodata">
                <div class="box text-center">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/app/icon_nodata.svg">
                    <p>의뢰한 프로젝트가 없습니다.<p>
                </div>
            </div>
        </div>

        <external-bs-modal-new :modal="modal">
            <template v-slot:header>
                <div class="portfolio-header">
                    선정하기
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </template>

            <!-- body -->
            <template v-slot:default>

                    <div>

                        <div class="join-list">
                            <div class="btn-wrap">
                                <button type="button" class="project-add" @click="putData(true)">선정 결과 저장</button><!--의뢰인 버전-->
                                <button type="button" class="project-done" @click="putData(false)">미선정 마감</button><!--의뢰인 버전-->
                            </div>
                            <ul>
                                <li v-for="item,index in modal.data.$project_request">
                                    <a>
                                        <div class="img" @click="jl.href('./portfolio_view.php?idx=' + item.$member_portfolio.idx)">
                                            <img v-if="item.portfolios.length == 0" src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg">
                                            <img v-else :src="jl.root + item.$member_portfolio.main_image_array[0].src">
                                        </div>
                                        <p>#{{index+1}}</p><!--참여순서-->
                                        <div class="profile">
                                            <template @click="jl.href('./profile.php?mb_no=' + item.user_idx)">
                                                <img v-if="!item.file_exists" src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg" alt="프로필 이미지">
                                                <img v-else :src="jl.root + '/data/file/member/' + item.user_idx + '.jpg'" alt="프로필 이미지">
                                                <span>{{item.$g5_member.mb_nick}}</span>
                                            </template>
                                            <select v-model="item.prize">
                                                <option value="">미선정</option>
                                                <option v-for="p in modal.data.prize" :vlaue="p.subject">{{p.subject}}</option>
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
        </external-bs-modal-new>

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
                context : "<?=$context?>",
                common : null,

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
                    limit: 10,
                    count: 0,

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
                    class_1 : "prize-container",
                    class_2 : "",
                },

                load : false,
            };
        },
        async created() {
            this.jl = new Jl('<?=$componentName?>');
            this.component_idx = this.jl.generateUniqueId();
            const className = this.context.charAt(0).toUpperCase() + this.context.slice(1) + "Common";
            console.log(className)
            if (typeof window[className] !== 'undefined') {
                console.log(22)
                this.common = new window[className](this.jl);
            }

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
            async postBookmark(project) {
                let row = {user_idx : this.mb_no,project_idx : project.idx};
                let options = {table : "project_bookmark",return : true};

                if(project.$project_bookmark.length) {
                    await this.jl.deleteData(project.$project_bookmark[0],options)
                }else {
                    await this.jl.postData(row,options);
                }

                await this.jl.getsData(this.filter,this.arrays);
            },
            async putData(bool) {
                if(bool) {
                    for (const row of this.modal.data.$project_request) {
                        await this.jl.postData(row,{table : "project_request",return : true});
                    }
                }else {
                    for (const row of this.modal.data.$project_request) {
                        await this.jl.postData(row,{
                            table : "project_request",
                            return : true,
                            updated : [
                                {key : "prize", value : ''},
                            ]
                        });
                    }
                }

                await this.jl.postData(this.modal.data,{
                    table : "project",
                    updated : [
                        {key : "choice", value : bool},
                    ],
                })
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
            async "modal.status" (value,old_value) {
                if(value) {
                    for (const row of this.modal.data.$project_request) {
                        await this.jl.ajax("file_exists",{src : `/data/file/member/${row.user_idx}.jpg`},"/jl/JlApi.php").then(response => {
                            row.file_exists = response.exists;
                        });

                        let user = await this.jl.getData({table : "g5_member",primary : row.user_idx});
                        row.$g5_member = user;

                        let portfolios = await this.jl.getData({
                            table : "member_portfolio",
                            in : [
                                {key : "idx", array : row.portfolios }
                            ],
                        });

                        row.$member_portfolio = portfolios;
                    }
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