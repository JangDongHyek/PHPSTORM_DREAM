<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div v-if="load">
        <div class="inr v2 project-form">
            <h3>프로젝트 지원</h3>

            <div class="project-item">
                <a :href="'./project_view.php?primary='+project_idx" class="project-link">
                    <div class="thumb">
                        <img :src="jl.root + project.thumb[0].src" alt="프로젝트 이미지">
                    </div>
                    <div class="project-cont">
                        <div class="project-info">
                            <div class="project-category">
                                {{project.$category.name}} · {{project.$category2.name}}
                            </div>
                            <h2 class="project-title">{{project.subject}}</h2>
                            <p class="project-desc">{{project.description}}</p>
                        </div>
                        <div class="project-user">
                            <div class="user-info">
                                <img v-if="!user_thumb" src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg" alt="프로필 이미지">
                                <img v-else :src="jl.root + '/data/file/member/' + project.user_idx + '.jpg'" alt="프로필 이미지">
                                <span class="user-name">{{project.$g5_member.mb_nick}}</span>
                            </div>
                            <div class="view-count">👁️ {{project.hits.format()}}</div>
                        </div>
                    </div>
                    <ul class="prize-info">
                        <li><span>🏆 예산</span> {{ totalPrize(project).format() }}원</li>
                        <li><span>📌 지원자</span> 21명</li>
                        <li><span>📅 진행 기간</span> {{getDurationDays(project)}}일</li>
                        <li><span>📆 날짜</span> {{project.start_date.formatDate({type : '.'})}} ~ {{project.end_date.formatDate({type : '.'})}}</li>
                    </ul>
                </a>
            </div>
            <form>
                <div class="box_write">
                    <h4>지원명</h4>
                    <div class="cont">
                        <input v-model="row.subject" type="text" maxlength="30" placeholder="7자 이상 30자 이하">
                    </div>
                </div>
                <div class="box_content">
                    <div class="box_write02">
                        <h4 class="b_tit">
                            포트폴리오
                            <em>
                                <i name="subpoint" class="point">{{row.portfolios.length}}</i>/5
                            </em>
                        </h4>
                        <div class="cont">
                            <div class="area_box">
                                <ul id="file_list" class="photo_list">
                                    <li class="file_1" v-for="item,index in portfolio_view_rows">
                                        <div class="area_img">
                                            <img v-if="item.main_image_array.length" :src="jl.root + item.main_image_array[0].src">
                                            <div class="area_delete" @click="deletePortfolio(item)">
                                                <span class="sound_only">삭제</span>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="portfolio text-right">
                    <button type="button" class="btn" @click="modal.status = true;">
                        <i class="fa-regular fa-arrow-down-to-line"></i> 포트폴리오 불러오기
                    </button>
                </div>
                <br>
                <p class="text-center txt_blue">
                    나의 포트폴리오를 불러와서<br class="visible-xs">
                    프로젝트에 지원해보세요!
                </p>
                <br>


                <button type="button" class="project-add" @click="jl.postData(row,options)">프로젝트 지원하기</button>
            </form>
        </div>

        <external-bs-modal-new :modal="modal">
            <template v-slot:header>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="modal.status = false;"><i class="fa-light fa-xmark"></i></button>
            </template>

            <!-- body -->
            <template v-slot:default>
                <ul id="product_list">
                    <li class="nodata" v-if="portfolio_rows.length == 0">
                        <div class="nodata_wrap">
                            <div class="area_img"><img :src="`${jl.root}/theme/basic_app/img/app/img_nodata.svg`"></div>
                            <p>등록한 포트폴리오가 없습니다.</p>
                        </div>
                    </li>
                    <li v-else v-for="item in portfolio_rows">
                        <a :href="`${jl.root}/bbs/portfolio_view.php?idx=${item.idx}`" target="_blank">
                            <div class="area_img">
                                <img :src="jl.root+item.main_image_array[0].src" title="">
                            </div>
                            <div class="area_txt">
                                <span></span><!-- 업체명 -->
                                <h3>{{item.name}}</h3> <!-- 제목 -->
                            </div>
                        </a>
                        <button @click="row.portfolios.push(item.idx)">등록하기</button>
                    </li>
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
            primary : {type: String, default: ""},
            mb_no : {type: String, default: ""},
            project_idx : {type: String, default: ""},
        },
        data: function () {
            return {
                load : false,
                jl: null,
                component_idx: "",

                row: {
                    user_idx : this.mb_no,
                    project_idx : this.project_idx,
                    subject : "",
                    portfolios : [],
                    prize : "",
                    cancel : "",
                },
                rows : [],
                project : {},

                options : {
                    table : 'project_request',
                    file_use : true,
                    required : [
                        {//String
                            name : "subject",
                            message : `지원명은 7자 이상 30자 이하입니다`,
                            min : {length : 7, message : "지원명은 7자 이상 30자 이하입니다"},
                            max : {length : 30, message : "지원명은 7자 이상 30자 이하입니다"}
                        },
                        {//String
                            name : "portfolios",
                            max : {length : 5, message : "포트폴리오는 최대 5개 까지입니다."}
                        },
                    ],
                    href : "",
                },

                filter : {
                    table : "project_request",
                    primary : this.primary,
                    page: 1,
                    limit: 1,
                    count: 0,
                },

                modal : {
                    status : false,
                    load : false,
                    data : {},
                    class_1 : "",
                    class_2 : "",
                },

                user_thumb : false,

                portfolio_rows : [],
                portfolio_view_rows : [],
            };
        },
        async created() {
            this.jl = new Jl('<?=$componentName?>');
            this.component_idx = this.jl.generateUniqueId();

            if(!this.mb_no) {
                await this.jl.alert("로그인이 필요한 기능입니다.");
                window.history.back();
            }
        },
        async mounted() {
            if(this.project_idx) {
                this.project = await this.jl.getData({
                    table : "project",
                    primary : this.project_idx,

                    extensions : [
                        {table : "g5_member", foreign : "user_idx"},
                        {table : "category", foreign : "category1_idx"},
                        {table : "category", foreign : "category2_idx", as : "category2"},
                    ],
                });
            }else {
                await this.jl.alert("잘못된 접근입니다.");
                window.history.back();
            }

            await this.jl.ajax("file_exists",{src : `/data/file/member/${this.project.user_idx}.jpg`},"/jl/JlApi.php").then(response => {
                this.user_thumb = response.exists;
            }); // 파일 있는지 체크하는 ajax

            await this.jl.getsData({
                table : "member_portfolio",
                member_idx : this.mb_no,
            },this.portfolio_rows);

            if(this.primary) this.row = await this.jl.getData(this.filter);
            //await this.jl.getsData(this.filter,this.rows);

            this.load = true;

            this.$nextTick(() => {

            });
        },
        updated() {

        },
        methods: {
            deletePortfolio(portfolio) {
                let index = this.row.portfolios.findIndex(item => item == portfolio.idx);
                if (index !== -1) {
                    this.row.portfolios.splice(index, 1);
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
            async "row.portfolios"(value,old) {
                if(value.length == 0) {
                    this.portfolio_view_rows = [];
                    return false;
                }
                await this.jl.getsData({
                    table : "member_portfolio",
                    in : [
                        {key : "idx", array : value }
                    ],
                },this.portfolio_view_rows);
                console.log(value)
            },
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