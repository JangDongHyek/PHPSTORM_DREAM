<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div v-if="load">
        <div class="inr v2 project-form">
            <h3>프로젝트 의뢰</h3>
            <form>
                <div class="box_write">
                    <h4>제목</h4>
                    <div class="cont">
                        <input v-model="data.subject" type="text" maxlength="30" placeholder="7자이상 30자 이하">
                    </div>
                </div>
                <div class="box_write">
                    <h4>한줄 설명</h4>
                    <div class="cont">
                        <input v-model="data.description" type="text" maxlength="30" placeholder="7자이상 30자 이하">
                    </div>
                </div>
                <div class="box_write">
                    <h4>진행 기간</h4>
                    <div class="cont">
                        <input v-model="data.start_date" type="date"> ~
                        <input v-model="data.end_date" type="date">
                    </div>
                </div>
                <div class="box_write">
                    <h4>1차 카테고리</h4>
                    <div class="cont">
                        <select v-model="data.category1_idx">
                            <option value="">선택해주세요</option>
                            <option v-for="item in categories" :value="item.idx">{{item.name}}</option>
                        </select>
                    </div>
                </div>
                <div class="box_write">
                    <h4>2차 카테고리</h4>
                    <div class="cont">
                        <select v-model="data.category2_idx">
                            <option value="">선택해주세요</option>
                            <option v-for="item in category_child" :value="item.idx">{{item.name}}</option>
                        </select>
                    </div>
                </div>
                <div class="box_content">
                    <div class="box_write02">
                        <h4 class="b_tit">의뢰 내용</h4>
                        <div class="cont">
                            <external-summernote-new :row="data" field="content"></external-summernote-new>
                        </div>
                    </div>
                </div>

                <div class="box_content">
                    <div class="box_write02">
                        <h4 class="b_tit">메인이미지등록
                            <em><i class="point" name="point">{{ data.thumb.length }}</i>/1</em>
                            <span v-if="data.thumb.length > 1" style="color : red;">메인 이미지는 최대 1장입니다.</span>
                        </h4>
                        <div class="cont">
                            <div class="area_box">

                                <!-- 처음화면에서는 안보였다가 이미지 등록하면 나타나게 해주세요 ~~ -->
                                <ul class="photo_list" id="file_list">
                                    <li class="file_1" v-for="item,index in data.thumb">
                                        <div class="area_img">
                                            <img :src="item.preview ? item.preview : jl.root+item.src">
                                            <div class="area_delete" @click="data.thumb.splice(index,1)"><span class="sound_only">삭제</span></div>
                                        </div>
                                    </li>
                                </ul>
                                <!-- //이미지 미리보기 -->

                                <template>

                                    <input type="file" name="file" id="input_file" multiple accept="*" style="position: absolute; left: -999; opacity:0; width: 0; height: 0;"
                                           ref="main_image_array" @change="jl.changeFile($event,data,'thumb')">
                                    <div id="fileDrag" class="img_wrap" @click="$refs.main_image_array.click();"
                                         @drop.prevent="jl.dropFile($event,data,'thumb')" @dragover.prevent @dragleave.prevent>
                                        <div class="area_txt">
                                            <div class="area_img"><img
                                                        :src="`${jl.root}/theme/basic_app/img/app/icon_upload.svg`"></div>
                                            <span class="w">마우스로 드래그해서 파일을 추가하세요.</span>
                                            <span class="m">파일을 추가하세요.</span>
                                        </div>
                                    </div>
                                    <em>※이미지 권장 비율(4:3)</em>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="box_content">
                    <div class="box_write02">
                        <h4 class="b_tit">참고 레퍼런스 이미지
                            <em><i class="point" id="img_count">{{data.images.length}}</i>/10</em>
                            <span id="img_limit_msg" style="color: red; display: none;">참고 레퍼런스 이미지는 최대 10장입니다.</span>
                        </h4>
                        <div class="cont">
                            <div class="area_box">

                                <!-- 처음화면에서는 안보였다가 이미지 등록하면 나타나게 해주세요 ~~ -->
                                <ul class="photo_list" id="file_list">
                                    <li class="file_1" v-for="item,index in data.images">
                                        <div class="area_img">
                                            <img :src="item.preview ? item.preview : jl.root+item.src">
                                            <div class="area_delete" @click="data.images.splice(index,1)"><span class="sound_only">삭제</span></div>
                                        </div>
                                    </li>
                                </ul>
                                <!-- //이미지 미리보기 -->

                                <template>
                                    <input type="file" name="file" id="input_file" multiple accept="*" style="position: absolute; left: -999; opacity:0; width: 0; height: 0;"
                                           ref="images" @change="jl.changeFile($event,data,'images')">
                                    <div id="fileDrag" class="img_wrap" @click="$refs.images.click();"
                                         @drop.prevent="jl.dropFile($event,data,'images')" @dragover.prevent @dragleave.prevent>
                                        <div class="area_txt">
                                            <div class="area_img"><img
                                                        :src="`${jl.root}/theme/basic_app/img/app/icon_upload.svg`"></div>
                                            <span class="w">마우스로 드래그해서 파일을 추가하세요.</span>
                                            <span class="m">파일을 추가하세요.</span>
                                        </div>
                                    </div>
                                    <em>※이미지 권장 사이즈: (1:1)</em>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box_content">
                    <div class="box_write02">
                        <h4>상금</h4>
                        <div class="cont">
                            <div class="box_ck">
                                <ul class="area_filter" id="area_filter">
                                    <li v-for="item,index in data.prize">
                                        <div class="filter_active">
                                            <dl class="grid">
                                                <dt><label>수상명</label></dt>
                                                <dd class="flex">
                                                    <input type="text" placeholder="수상명" v-model="item.subject" class="titleInput">
                                                    <span id="deletePrizeBtn" @click="data.prize.splice(index,1)">등수 삭제</span>
                                                </dd>
                                                <dt><label>인원</label></dt>
                                                <dd><input type="text" placeholder="인원을 입력해주세요" v-model="item.people" class="titleInput"></dd>
                                                <dt><label>인당 상금</label></dt>
                                                <dd><input type="number" placeholder="상금을 입력해주세요" v-model="item.money" class="descInput"></dd>
                                            </dl>
                                        </div>
                                    </li>
                                </ul>
                                <div>
                                    <span id="addPrizeBtn" @click="data.prize.push({subject:'',people:'',money:''})">등수 추가</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="button" class="project-add" @click="jl.postData(data,'project',options)">프로젝트 의뢰하기</button>
            </form>
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
                jl: null,
                component_idx: "",

                paging: {
                    page: 1,
                    limit: 1,
                    count: 0,
                },

                data: {
                    user_idx : this.mb_no,
                    subject : "",
                    description : "",
                    start_date : "",
                    end_date : "",
                    category1_idx : "",
                    category2_idx : "",
                    content : "",
                    thumb : [],
                    images : [],
                    prize : [],
                    status : false
                },

                options : {
                    file_use : true,
                    required : [
                        {name : "user_idx",message : `로그인이 필요한 기능입니다.`},
                        {
                            name : "subject",
                            message : `제목은 필수값입니다`,
                            min : {length : 7, message : "제목은 최소 7자 이상이여야 합니다."},
                            max : {length : 30, message : "제목은 최대 30자 이하여야 합니다."}
                        },
                        {
                            name : "description",
                            message : `한줄설명은 필수값입니다`,
                            min : {length : 7, message : "한줄설명은 최소 7자 이상이여야 합니다."},
                            max : {length : 30, message : "한줄설명은 최대 30자 이하여야 합니다."}
                        },
                        {name : "start_date",message : `진행기간을 입력해주세요.`},
                        {name : "end_date",message : `진행기간을 입력해주세요.`},
                        {name : "category1_idx",message : `상위카테고리는 필수값입니다.`},
                        {name : "category2_idx",message : `하위카테고리는 필수값입니다.`},
                        {name : "content",message : `의뢰내용을 입력해주세요.`},
                        {
                            name : "thumb",
                            min : {length : 1, message : "메인이미지는 필수값입니다."},
                            max : {length : 1, message : "메인이미지는 최대 1장입니다."}
                        },
                        {
                            name : "images",
                            max : {length : 10, message : "참고 래퍼런스 자료는 최대 10장입니다."}
                        },
                    ],
                    href : "./mypage_project_my.php",
                },

                filter : {
                    table : "project",
                    primary : this.primary,
                    page: 1,
                    limit: 1,
                    count: 0,
                },


                categories : [],
                category_child : [],

                load : false,
            };
        },
        async created() {
            this.jl = new Jl('<?=$componentName?>');
            this.component_idx = this.jl.generateUniqueId();

            if(!this.mb_no) {
                await this.jl.alert("로그인이 필요한 기능입니다.");
                window.history.back();
            }

            await this.jl.getsData({
                table : "category",
                parent_idx : 0,
            },this.categories);

            if(this.primary) {
                this.data = await this.jl.getData(this.filter);
            }


            this.load = true
        },
        mounted() {
            this.$nextTick(() => {

            });
        },
        updated() {

        },
        methods: {
            addMovie() {
                if(this.data.movie_link.length >= 10) {
                    alert("동영상 등록은 최대 10개입니다.");
                    return false;
                }
                this.data.movie_link.push('');
            },
        },
        computed: {
            category1_idx() {
                return this.data.category1_idx
            }
        },
        watch: {
            async category1_idx() {
                if(!this.data.idx) {
                    this.data.category2_idx = "";
                }
                this.category_child = [];

                if(this.category1_idx) {
                    let parent = this.jl.findObject(this.categories, "idx", this.data.category1_idx)

                    await this.jl.getsData({
                        table : "category",
                        parent_idx : parent.idx,
                    },this.category_child);

                }
            }
        }
    });

</script>

<style>

</style>