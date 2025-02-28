<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div v-if="load">
        <div class="join-view">
            <h6 v-if="getStatus(project) != '진행 중'">매칭 완료!</h6>
            <div v-if="getStatus(project) == '선정 완료'">
                <ul>
                    <li v-for="item,index in rows">
                        <a @click="modal.data = item; modal.status = true;">
                            <div class="img">
                                <span class="icon_1st">{{item.prize}}</span>
                                <img v-if="item.$member_portfolio.length" :src="jl.root + item.$member_portfolio[0].main_image_array[0].src">
                                <img v-else src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg">
                            </div>
<!--                           <p>#{{index+1}}</p>-->
                            <div class="profile">
                                <img v-if="!item.file_exists" src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg" alt="프로필 이미지">
                                <img v-else :src="jl.root + '/data/file/member/' + item.user_idx + '.jpg'" alt="프로필 이미지">
                                <span>{{item.$g5_member.mb_nick}}</span>
                            </div>
                        </a>
                        <div class="flex">
                            <button type="button" class="chatBtn">채팅하기</button><!--매칭 거부시 (> 매칭 실패로 변경 클래스 out 추가)-->
                            <button type="button" class="payBtn">예산 결제</button><!--매칭 완료시-->
                        </div>
                    </li>
                </ul>
            </div>
            <h6 v-if="getStatus(project) == '진행 중'">지원자</h6>
            <div v-if="getStatus(project) == '진행 중'">
                <div class="empty" v-if="rows.length == 0">
                    <i class="fa-duotone fa-object-subtract"></i>
                    지원자가 없어요.
                </div>
                <ul v-else>
                    <li v-for="item,index in rows">
                        <a @click="modal.data = item; modal.status = true;">
                            <div class="img">
                                <img v-if="item.$member_portfolio.length" :src="jl.root + item.$member_portfolio[0].main_image_array[0].src">
                                <img v-else src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg">
                            </div>
                            <p>#{{index+1}} {{item.subject}}</p><!--참여순서-->
                            <div class="profile">
                                <img v-if="!item.file_exists" src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg" alt="프로필 이미지">
                                <img v-else :src="jl.root + '/data/file/member/' + item.user_idx + '.jpg'" alt="프로필 이미지">
                                <span>{{item.$g5_member.mb_nick}}</span>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="empty" v-if="getStatus(project) == '진행 종료'">
                <i class="fa-regular fa-award"></i>
                아직 선정되지 않았어요.
            </div>
        </div>

        <external-bs-modal-new :modal="modal">
            <template v-slot:header>

            </template>

            <!-- body -->
            <template v-slot:default>
                <div>
                    <div class="portfolio-header">
                        지원자 상세 보기
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="portfolio-grid">
                        <div class="portfolio-info">
                            <h1 class="title">{{modal.data.subject}}</h1>
                            <p v-if="modal.data.prize" class="winner-badge">{{modal.data.prize}}</p>
                            <p class="description" v-html="jl.convertNewlinesToBr(modal.data.content)"></p>
                            <div class="profile" @click="jl.href('./profile.php?mb_no=' + modal.data.user_idx)">
                                <img v-if="!modal.data.file_exists" src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg" alt="프로필 이미지">
                                <img v-else :src="jl.root + '/data/file/member/' + modal.data.user_idx + '.jpg'" alt="프로필 이미지">
                                <span>{{modal.data.$g5_member.mb_nick}}</span>
                            </div>
                            <?/*button type="button" class="btn-down" v-if="modal.data.upfile" @click="jl.download(modal.data.upfile)">
                                첨부파일 다운로드
                            </button*/?>
                        </div>
                        <div class="portfolio-image">
                            <!--img v-for="image in modal.data.images" :src="jl.root + image.src"-->
                            <ul id="product_list" class="v2">
                                <li v-for="item in modal.data.$member_portfolio">
                                    <a>
                                        <div class="area_txt">
                                            <span></span>
                                            <h3>{{item.name}}</h3>
                                        </div>
                                        <div class="area_img">
                                            <img :src="jl.root + item.main_image_array[0].src" alt="뷰티인사이드 포스터">
                                        </div>
                                        <div class="area_cont"></div>
                                        <button class="port_btn" @click="item.show = !item.show">{{item.show ? '숨기기' : '더보기'}}</button>

                                        <div class="tab_cont" v-if="item.show">
                                            <section id="portfolio_info">
                                                <template v-for="item in item.content_image_array">
                                                    <img :src="`${jl.root}${item.src}`">
                                                </template>
                                                <nav class="lnb">
                                                    <div class="inr">
                                                        <ul>
                                                            <li><a class="active">포트폴리오 내용</a></li>
                                                        </ul>
                                                    </div>
                                                </nav>
                                                <div class="conts">{{ item.description }}</div>
                                            </section>

                                            <section>
                                                <template v-for="link in item.movie_link" v-if="jl.extractYoutube(link)">
                                                    <div class="embed-container">
                                                        <iframe
                                                                :src="'https://www.youtube.com/embed/' + jl.extractYoutube(link)"
                                                                title="YouTube video player"
                                                                frameborder="0"
                                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                                allowfullscreen>
                                                        </iframe>
                                                    </div><br>
                                                </template>
                                            </section>

                                            <a  :href="jl.root + '/bbs/portfolio_view.php?idx=' + item.idx" class="port_btn2">자세히 보기</a>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
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
            project : {type: Object, default: {}},
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
                    table : "project_request",
                    project_idx : this.project.idx,
                    cancel : "jl_null",
                    page: 1,
                    limit: 10000,
                    count: 0,

                    extensions : [
                        {table : "g5_member", foreign : "user_idx"},
                    ],
                },

                modal : {
                    status : false,
                    load : false,
                    data : {},
                    class_1 : "portfolio-container",
                    class_2 : "",
                },

                load : false,
            };
        },
        async created() {
            this.jl = new Jl('<?=$componentName?>');
            this.component_idx = this.jl.generateUniqueId();

            //if(this.primary) this.row = await this.jl.getData(this.filter);
//await this.jl.getsData(this.filter,this.rows);

            this.load = true;
        },
        async mounted() {
            if(this.project.idx) await this.jl.getsData(this.filter,this.rows,{
                callback : async (res) => {
                    let rows = res.data;
                    for (const row of rows) {
                        await this.jl.ajax("file_exists",{src : `/data/file/member/${row.user_idx}.jpg`},"/jl/JlApi.php").then(response => {
                            row.file_exists = response.exists;
                        });

                        row.$member_portfolio = [];

                        await this.jl.getsData({
                            table : "member_portfolio",
                            in : [
                                {key : "idx", array : row.portfolios }
                            ],
                        },row.$member_portfolio,{
                            callback : async (res2) => {
                                let rows2 = res2.data;
                                for (let row2 of rows2) {
                                    this.$set(row2,'show',false);
                                }

                                row.$member_portfolio = rows2;
                            },
                        });

                    }



                    this.filter.count = res.count;
                    this.rows = rows;
                },
            });
            this.$nextTick(() => {

            });
        },
        updated() {

        },
        methods: {
            getStatus(item) {
                if(item.choice) {
                    return "선정 완료";
                }else if(this.jl.isRangeDate(item.start_date,item.end_date)) {
                    return "진행 중";
                }else {
                    return "모집 종료";
                }
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