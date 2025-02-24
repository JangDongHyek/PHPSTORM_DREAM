<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div v-if="load">
        <div class="join-view">
            <h6 v-if="getStatus(project) != '진행 중'">선정 작품</h6>
            <div>
                <ul v-if="getStatus(project) == '선정 완료'">
                    <li v-for="item,index in rows" v-if="item.prize">
                        <a @click="modal.data = item; modal.status = true;">
                            <div class="img">
                                <span class="icon_1st">{{item.prize}}</span>
                                <img v-if="item.images.length == 0" src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg">
                                <img v-else :src="jl.root + item.images[0].src">
                            </div>
<!--                           <p>#{{index+1}}</p>-->
                            <div class="profile">
                                <img v-if="!item.file_exists" src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg" alt="프로필 이미지">
                                <img v-else :src="jl.root + '/data/file/member/' + item.user_idx + '.jpg'" alt="프로필 이미지">
                                <span>{{item.$g5_member.mb_nick}}</span>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
            <h6 v-if="getStatus(project) == '진행 중'">참여 작품</h6>
            <div v-if="getStatus(project) == '진행 중'">
                <div class="empty" v-if="rows.length == 0">
                    <i class="fa-duotone fa-object-subtract"></i>
                    참여한 작품이 없어요.
                </div>
                <ul v-else>
                    <li v-for="item,index in rows">
                        <a @click="modal.data = item; modal.status = true;">
                            <div class="img">
                                <img v-if="item.images.length == 0" src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg">
                                <img v-else :src="jl.root + item.images[0].src">
                            </div>
                            <p>#{{index+1}}</p><!--참여순서-->
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
                        작품 상세 보기
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="portfolio-grid">
                        <div class="portfolio-info">
                            <h1 class="title">{{modal.data.subject}}</h1>
                            <p class="winner-badge">{{modal.data.prize}}</p>
                            <p class="description" v-html="jl.convertNewlinesToBr(modal.data.content)"></p>
                            <div class="profile">
                                <img v-if="!modal.data.file_exists" src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg" alt="프로필 이미지">
                                <img v-else :src="jl.root + '/data/file/member/' + modal.data.user_idx + '.jpg'" alt="프로필 이미지">
                                <span>{{modal.data.$g5_member.mb_nick}}</span>
                            </div>
                            <button type="button" class="btn-down" v-if="modal.data.upfile" @click="jl.download(modal.data.upfile)">
                                첨부파일 다운로드
                            </button>
                        </div>
                        <div class="portfolio-image">
                            <img v-for="image in modal.data.images" :src="jl.root + image.src">
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