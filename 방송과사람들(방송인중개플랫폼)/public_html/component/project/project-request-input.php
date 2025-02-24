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
                        <li><span>🏆 총 상금</span> {{ totalPrize(project).format() }}원</li>
                        <li><span>📌 참여작</span> 21개</li>
                        <li><span>📅 진행 기간</span> {{getDurationDays(project)}}일</li>
                        <li><span>📆 날짜</span> {{project.start_date.formatDate({type : '.'})}} ~ {{project.end_date.formatDate({type : '.'})}}</li>
                    </ul>
                </a>
            </div>
            <form>
                <div class="box_write">
                    <h4>작품명</h4>
                    <div class="cont">
                        <input v-model="row.subject" type="text" maxlength="30" placeholder="7자이상 30자 이하">
                    </div>
                </div>
                <div class="box_content">
                    <div class="box_write02">
                        <h4 class="b_tit">작품 사용</h4>
                        <div class="cont">
                            <textarea v-model="row.content"></textarea><!--에디터 말고 textarea 사용-->
                        </div>
                    </div>
                </div>

                <div class="box_content">
                    <div class="box_write02">
                        <h4 class="b_tit">작품 이미지
                            <em><i class="point" id="img_count">{{row.images.length}}</i>/10</em>
                            <span id="img_limit_msg" style="color: red; display: none;">작품 이미지는 최대 10장입니다.</span>
                        </h4>
                        <div class="cont">
                            <div class="area_box">

                                <!-- 처음화면에서는 안보였다가 이미지 등록하면 나타나게 해주세요 ~~ -->
                                <ul class="photo_list" id="file_list">
                                    <li class="file_1" v-for="item,index in row.images">
                                        <div class="area_img">
                                            <img :src="item.preview ? item.preview : jl.root+item.src">
                                            <div class="area_delete" @click="row.images.splice(index,1)"><span class="sound_only">삭제</span></div>
                                        </div>
                                    </li>
                                </ul>
                                <!-- //이미지 미리보기 -->

                                <template>
                                    <input type="file" name="file" id="input_file" multiple accept="*" style="position: absolute; left: -999; opacity:0; width: 0; height: 0;"
                                           ref="images" @change="jl.changeFile($event,row,'images')">
                                    <div id="fileDrag" class="img_wrap" @click="$refs.images.click();"
                                         @drop.prevent="jl.dropFile($event,row,'images')" @dragover.prevent @dragleave.prevent>
                                        <div class="area_txt">
                                            <div class="area_img"><img
                                                    :src="`${jl.root}/theme/basic_app/img/app/icon_upload.svg`"></div>
                                            <span class="w">마우스로 드래그해서 파일을 추가하세요.</span>
                                            <span class="m">파일을 추가하세요.</span>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="box_write">
                    <h4>첨부파일</h4>
                    <div class="cont">
                        <label class="file-upload">
                            파일 선택
                            <input type="file" @change="jl.changeFile($event,row,'upfile')">
                        </label>
                        <p class="file-name">{{row.upfile.name ? row.upfile.name : '선택된 파일 없음'}}</p>
                    </div>
                </div>

                <button type="button" class="project-add" @click="jl.postData(row,options)">프로젝트 지원하기</button>
            </form>
        </div>
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
                    content : "",
                    images : [],
                    upfile : {},
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
                            message : `작품명은 7이상 30자 이하입니다`,
                            min : {length : 7, message : "작품명은 7이상 30자 이하입니다"},
                            max : {length : 30, message : "작품명은 7이상 30자 이하입니다"}
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
                    data : {},
                },

                user_thumb : false,

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

            if(this.primary) this.row = await this.jl.getData(this.filter);
            //await this.jl.getsData(this.filter,this.rows);

            this.load = true;

            this.$nextTick(() => {

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