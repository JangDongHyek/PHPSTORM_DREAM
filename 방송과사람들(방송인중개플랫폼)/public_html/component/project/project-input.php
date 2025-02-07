<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div v-if="load">

        <div id="item_write">
            <div class="inr v2" id="inr">
                <h3>프로젝트 의뢰등록</h3>
                <div class="box_list">
                    <div class="box_input col02">
                        <div class="box_write">
                            <h4><label for="cp_category1">상위카테고리<strong class="sound_only">필수</strong></label></h4>
                            <div class="cont">
                                <div class="select_box">
                                    <div class="box">
                                        <select class="frm_input" v-model="data.category1_idx">
                                            <option value="">선택해주세요</option>
                                            <option v-for="item in categories" :value="item.idx">{{item.name}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box_write">
                            <h4><label for="cp_category2">하위카테고리<strong class="sound_only">필수</strong></label></h4>
                            <div class="cont">
                                <div class="select_box">
                                    <select class="frm_input" v-model="data.category2_idx">
                                        <option value="">선택해주세요</option>
                                        <option v-for="item in category_child" :value="item.idx">{{item.name}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box_write">
                        <h4><label for="cp_company_name">회사명</label></h4>
                        <div class="cont">
                            <input type="text" name="cp_company_name" v-model="data.company_name" class="frm_input" size="40">
                        </div>
                    </div>
                    <div class="box_write">
                        <h4><label for="cp_company_explain">회사소개</label></h4>
                        <div class="cont">
                            <textarea name="cp_company_explain" v-model="data.company_content" id="cp_company_explain" class="frm_input"></textarea>
                        </div>
                    </div>
                    <div class="box_write">
                        <h4><label for="cp_title">제목</label></h4>
                        <div class="cont">
                            <input type="text" name="cp_title" v-model="data.subject" required id="cp_title" class="frm_input required" size="180" maxlength="200">
                        </div>
                    </div>
                    <div class="box_write">
                        <h4><label for="cp_logo_content">내용</label></h4>
                        <div class="cont">
                            <textarea name="cp_logo_content" id="cp_logo_content" v-model="data.content" class="frm_input"></textarea>
                        </div>
                    </div>
                    <div class="box_write">
                        <h4><label for="cp_datetime">마감기간</label></h4>
                        <div class="cont">
                            <input type="date" name="cp_datetime" v-model="data.end_date" class="frm_input" size="40">
                        </div>
                    </div>
                    <div class="box_write">
                        <h4><label for="cp_reward">희망 제작금액</label></h4>
                        <div class="cont">
                            <label>만원</label>
                            <input type="text" name="cp_reward" id="cp_reward" v-model="data.price" class="frm_input" onkeyup="numberWithCommas(this)" size="40">
                        </div>
                    </div>
                    <div class="box_write">
                        <h4><label for="image">메인이미지</label></h4>
                        <div class="cont">
                            <input type="file" name="main_img" @change="jl.changeFile($event,data,'main_image')">
                        </div>
                    </div>
                    <div class="box_write">
                        <h4><label for="image">참고 자료</label></h4>
                        <div class="cont">
                            <input type="file" name="data1" @change="jl.changeFile($event,data,'upfile1')">
                            <input type="file" name="data2" @change="jl.changeFile($event,data,'upfile2')">
                            <input type="file" name="data3" @change="jl.changeFile($event,data,'upfile3')">
                        </div>
                    </div>
                    <div class="box_write">
                        <h4><label for="cp_logo_sty">관련키워드</label></h4>
                        <div class="cont">
                            <input type="text" name="cp_logo_sty" v-model="data.keyword" class="frm_input" size="40">
                        </div>
                    </div>



                    <div id="area_btn">
                        <input type="button" value="확인" class="btn_next" @click="jl.postData(data,'project',options)">
                    </div>
                </div>
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
                jl: null,
                component_idx: "",

                paging: {
                    page: 1,
                    limit: 1,
                    count: 0,
                },

                data: {
                    file_use : true,
                    user_idx : this.mb_no,
                    category1_idx : "",
                    category2_idx : "",
                    company_name : "",
                    company_content : "",
                    subject : "",
                    content : "",
                    end_date : "",
                    price : "",
                    main_image : "",
                    upfile1 : "",
                    upfile2 : "",
                    upfile3 : "",
                    keyword : "",
                    status : false
                },

                options : {
                    required : [
                        {name : "user_idx",message : `로그인이 필요한 기능입니다.`},
                        {name : "category1_idx",message : `상위카테고리는 필수값입니다.`},
                        {name : "category2_idx",message : `하위카테고리는 필수값입니다.`},
                        {
                            name : "subject",message : `제목은 필수값입니다`,
                            min : {length : 10, message : "제목은 최소 10자 이상이여야 합니다."},
                            max : {length : 30, message : "제목은 최대 30자 이하여야 합니다."}
                        },
                        {name : "end_date",message : `마감기간은 필수값입니다.`},
                        {name : "price",message : `희망 제작 금액은 필수값입니다.`},
                    ],
                    href : "",
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

            this.load = true
        },
        mounted() {
            this.$nextTick(() => {

            });
        },
        updated() {

        },
        methods: {

        },
        computed: {
            category1_idx() {
                return this.data.category1_idx
            }
        },
        watch: {
            async category1_idx() {
                this.data.category2_idx = "";
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