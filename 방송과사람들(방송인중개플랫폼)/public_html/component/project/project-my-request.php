<?php
$componentName = str_replace(".php","",basename(__FILE__));
$pathParts = explode(DIRECTORY_SEPARATOR, dirname(__FILE__));
$context = end($pathParts);
?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div v-if="load">
        <div v-if="load">
            <ul class="project-list" v-if="rows.length > 0">
                <li class="project-item" v-for="item in rows">
                    <ul class="prize-info">
                        <li><span>🏆 예산</span> {{ common.totalPrize(item.$project).format() }}원</li>
                        <li><span>📌 지원자</span> {{item.$project.$project_request}}명</li>
                        <li><span>📅 진행 기간</span> {{common.getDurationDays(item.$project)}}일</li>
                        <li><span>📆 날짜</span> {{item.$project.start_date.formatDate({type : '.'})}} ~ {{item.$project.end_date.formatDate({type : '.'})}}</li>
                    </ul>
                    <a class="project-link">
                        <div class="thumb" @click="jl.href('./project_view.php?primary=' + item.$project.idx)">
                            <img :src="jl.root + item.$project.thumb[0].src" alt="프로젝트 이미지">
                        </div>
                        <div class="project-cont">
                            <div class="project-info">
                                <div class="project-category">
                                    <span class="state v1" :class="common.getClass(item.$project,item)">{{ common.getStatus(item.$project,item) }}</span>
                                    {{item.$project.$category.name}} · {{item.$project.$category2.name}}
                                    <button type="button" class="bookmark" @click="postBookmark(item.$project)"><i :class="item.$project.$project_bookmark.length ? 'fa-solid' : 'fa-light'" class="fa-bookmark"></i></button><!--북마크시 fa-solid fa-bookmark-->
                                </div>
                                <h2 class="project-title" @click="jl.href('./project_view.php?primary=' + item.$project.idx)">{{item.$project.subject}}</h2>
                                <p class="project-desc">{{item.$project.description}}</p>
                            </div>
                        </div>
                    </a>
                    <div class="btn-wrap"><!--전문가 버전-->
                        <button type="button" v-if="common.getStatus(item.$project,item) == '대기중'" @click="jl.href(`./project_join.php?primary=${item.idx}&project_idx=${item.$project.idx}`)">지원 보기</button>
                        <button type="button" v-if="common.getStatus(item.$project,item) == '대기중'" @click="jl.postData(item,options)">지원 취소</button>
                        <button type="button" v-if="item.cancel" class="gray">지원 취소됨</button><!--취소시 교체 노출-->
                        <button type="button" v-if="item.prize">수락/거부</button><!--매칭 (수락 이후 완료하기로)-->
                        <button type="button" v-if="common.getStatus(item.$project,item) == '마감'" class="blue" @click="modal.data = item; modal.status = true;">결과 확인</button><!--탈락-->
                        <template v-if="common.getStatus(item.$project,item) == '마감'">
                            <button type="button" v-if="item.prize" class="blue2">의뢰 채팅</button><!--매칭전후 모두 사용가능 (거부시 사용불가처리)-->
                        </template>
                        <template v-else>
                            <button type="button" v-if="!item.cancel" class="blue2">의뢰 채팅</button><!--매칭전후 모두 사용가능 (거부시 사용불가처리)-->
                        </template>
                    </div>
                </li>
            </ul>

            <div v-else>
                <div class="nodata">
                    <div class="box text-center">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/app/icon_nodata.svg">
                        <p>지원한 프로젝트가 없습니다.<p>
                    </div>
                </div>
            </div>

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
                            축하합니다! {{modal.data.prize}}에 선정되었습니다.
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

                    user_idx : this.mb_no,

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
            const className = this.context.charAt(0).toUpperCase() + this.context.slice(1) + "Common";
            if (typeof window[className] !== 'undefined') {
                this.common = new window[className](this.jl);
            }
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
                        {
                            table : "project_bookmark" ,
                            foreign : "project_idx",
                            type : "data",
                            filter : {
                                user_idx : this.mb_no,
                            },
                        }, // type(count,data)
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
            async postBookmark(project) {
                let row = {user_idx : this.mb_no,project_idx : project.idx};
                let options = {table : "project_bookmark",return : true};


                if(project.$project_bookmark.length) {
                    await this.jl.deleteData(project.$project_bookmark[0],options)
                }else {
                    await this.jl.postData(row,options);
                }

                window.location.reload();
                //await this.jl.getsData(this.filter,this.arrays);
            },


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