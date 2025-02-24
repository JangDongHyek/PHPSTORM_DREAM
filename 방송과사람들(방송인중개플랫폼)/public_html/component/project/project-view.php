<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div v-if="load">
        <div class="project-view">
            <div class="grid">
                <section class="left">
                    <div class="thumbnail-container">
                        <img :src="jl.root + row.thumb[0].src" alt="프로젝트 이미지">
                    </div>
                </section>
                <section class="right">
                    <div class="info-box">
                        <div class="project-category">
                            {{row.$category.name}} · {{row.$category2.name}}
                            <button type="button" class="bookmark"><i class="fa-light fa-bookmark"></i></button><!--북마크시 fa-solid fa-bookmark-->
                        </div>
                        <h2>{{row.subject}}</h2>
                        <p class="subtitle">{{row.description}}</p>
                        <div class="profile">
                            <img v-if="!user_thumb" src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg" alt="프로필 이미지">
                            <img v-else :src="jl.root + '/data/file/member/' + row.user_idx + '.jpg'" alt="프로필 이미지">
                            <span>{{row.$g5_member.mb_nick}}</span>
                        </div>
                    </div>
                    <div class="prize-info">
                        <div class="">총 상금</div>
                        <div class="total-prize">{{totalPrize(row).format()}}원</div>
                        <ul>
                            <li v-for="item in row.prize">
                                <span class="first-prize"><b>{{item.subject}}</b> {{parseInt(item.money).format()}}원</span>
                                <span class="winner-count">x {{item.people}}명</span>
                            </li>
                        </ul>

                    </div>
                    <div class="meta-info">
                        <div>
                            진행 기간<br><b>{{getDurationDays(row)}}일</b><br>
                            <span>{{row.start_date.formatDate({type: '.'})}} - {{row.end_date.formatDate({type: '.'})}}</span>
                        </div>
                        <div>참여작<br><b>{{row.$project_request}}개</b></div>
                        <div>조회 수<br><b>{{row.hits}}</b></div>
                    </div>
                    <div class="button-container">
                        <button class="share-btn">공유하기</button>
                        <button class="apply-btn" @click="jl.href('./project_join.php?project_idx='+primary)">프로젝트 지원하기</button>
                    </div>
                </section>
            </div>

            <div class="tabs">
                <div class="tab" :class="{'active' : tab == 0}" @click="tab = 0">요청 사항</div>
                <div class="tab" :class="{'active' : tab == 1}" @click="tab = 1">참여작 <span class="count">{{row.$project_request}}</span></div>
                <div class="tab" :class="{'active' : tab == 2}" @click="tab = 2">문의 댓글 <span class="count">{{comment_count}}</span></div>
            </div>
            <div class="tab-content active">
                <div class="request-view" v-show="tab == 0">
                    <h6>의뢰 내용</h6>
                    <div v-html="row.content">

                    </div>
                    <h6>참고 레퍼런스</h6>
                    <div>
                        <div class="swiper sample-swiper">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide" v-for="item in row.images">
                                    <img :src="jl.root + item.src">
                                </div>
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>

                    </div>
                </div>

                <project-view-request :project="row" v-show="tab == 1"></project-view-request>
                <project-view-comment :project="row" v-show="tab == 2" :mb_no="mb_no"
                                      @commentLength="comment_count = $event;"
                ></project-view-comment>
            </div>
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

                row: {},
                rows : [],

                options : {
                    file_use : false,
                    required : [
                        {name : "",message : ``},
                    ],
                    href : "",
                },

                filter : {
                    table : "project",
                    primary : this.primary,
                    page: 1,
                    limit: 1,
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
                            type:'count',
                            filter : {
                                where : [
                                    {key : "cancel", value : 'jl_null', operator : ""} // AND,OR,AND NOT
                                ],
                            }
                        },
                    ],
                },

                modal : {
                    status : false,
                    data : {},
                },

                user_thumb : false,


                tab : 0,
                comment_count : 0,
            };
        },
        async created() {
            this.jl = new Jl('<?=$componentName?>');
            this.component_idx = this.jl.generateUniqueId();


        },
        async mounted() {
            if(this.primary) {
                let hitData = {
                    primary : this.primary,
                    hits : "incr",

                    session_insert : [
                        {content : "project_hits"+this.primary}
                    ],

                    session_exists : [
                        {content : "project_hits"+this.primary, exit_type : "stop"},
                    ],
                }
                await this.jl.postData(hitData,{table:"project",return : true})

                this.row = await this.jl.getData(this.filter);

                await this.jl.ajax("file_exists",{src : `/data/file/member/${this.row.user_idx}.jpg`},"/jl/JlApi.php").then(response => {
                    this.user_thumb = response.exists;
                }); // 파일 있는지 체크하는 ajax

                console.log(this.user_thumb)

            }
            else {
                await this.jl.alert("잘못된 접근입니다.");
                window.history.back();
            }

            this.load = true;

            //await this.jl.getsData(this.filter,this.rows);
            this.$nextTick(() => {
                let swiper = new Swiper(".sample-swiper", {
                    slidesPerView: "auto",
                    spaceBetween: 10,
                    pagination: {
                        el: ".swiper-pagination",
                        clickable: true,
                    },
                });
            });

        },
        updated() {

        },
        methods: {
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