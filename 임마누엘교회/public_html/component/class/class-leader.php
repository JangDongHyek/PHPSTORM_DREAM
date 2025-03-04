<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div v-if="load">
        <div id="class" class="leader">
            <button class="btn btn_large btn_back" type="button" onclick="location.href='./class'"><i class="fa-solid fa-arrow-left"></i> 속회방 메인</button>
            <div class="wrap">
                <button class="btn" type="button" @click="modal.status = true;"><i class="fa-solid fa-book-medical"></i>이번주 속회공부 자료</button>
                <button class="btn" type="button" @click="modal2 = true;"><i class="fa-sharp fa-solid fa-quote-left"></i>속회소식 작성</button>
                <!--button class="btn" type="button" onclick="location.href='./class_noti'"><i class="fa-solid fa-quote-right"></i>작성한 속회소식</button-->
                <button class="btn" type="button" onclick="location.href='./class_all'"><i class="fa-solid fa-align-left"></i>지난 속회보고 열람</button>
            </div>
        </div>

        <external-bs-modal :modal="modal.status" @close="modal.status = false;" class_1="" class_2="">
            <template v-slot:header>
                <h4 class="modal-title" id="classNotiModalLabel">속회공부 자료</h4>
                <button type="button" class="close" @click="modal.status = false;"><span aria-hidden="true">&times;</span></button>
            </template>

            <!-- body -->
            <template v-slot:default>
                <label>제 *과</label>
                <input type="number" v-model="modal.data.chapter" @input="jl.isNumberKeyInput">
                <label>제목</label>
                <input type="text" v-model="modal.data.subject">
                <label>자료</label>
                <div>
                    <!-- 숨겨진 파일 입력 요소 -->
                    <input type="file" id="file-input" class="file-input" @change="jl.changeFile($event,modal.data,'upfile')">
                    <!-- 커스텀 파일 입력 라벨 -->
                    <label for="file-input" class="custom-file-label">파일 선택</label>
                    <!-- 선택된 파일 이름을 표시할 요소 -->
                    <span class="file-name" id="file-name">{{modal.data.upfile ? modal.data.upfile.name : '선택된 파일 없음'}}</span>
                </div>
            </template>


            <template v-slot:footer>
                <button type="button" class="btn btn-default" @click="modal.status = false;">닫기</button>
                <button type="button" class="btn btn-default" @click="jl.postData(modal.data,options)">작성</button>
            </template>
        </external-bs-modal>

        <external-bs-modal :modal="modal2" @close="modal2 = false;" class_1="" class_2="">
            <template v-slot:header>
                <h4 class="modal-title" id="classNotiModalLabel">속회보고</h4>
                <button type="button" class="close" @click="modal2 = false;"><span aria-hidden="true">&times;</span></button>
            </template>

            <!-- body -->
            <template v-slot:default>
                <textarea placeholder="속회소식를 작성하세요." v-model="modal2_data.wr_content"></textarea>
            </template>


            <template v-slot:footer>
                <button type="button" class="btn btn-default" @click="modal2 = false;">닫기</button>
                <button type="button" class="btn btn-default" @click="jl.postData(modal2_data,{table : 'g5_write_class'})">작성</button>
            </template>
        </external-bs-modal>
    </div>
</script>

<script>
    Jl_components.push({name : "<?=$componentName?>",object : {
            template: "#<?=$componentName?>-template",
            props: {
                primary : {type: String, default: ""},
                mb_no : {type: String, default: ""},
                mb_1 : {type: String, default: ""},
                admin : {type: String, default: ""},
            },
            data: function () {
                return {
                    load : false,
                    jl: null,
                    component_idx: "",

                    data: {},
                    arrays : [],

                    options : {
                        table : 'class_study',
                        required : [
                            {name : "chapter",message : `과를 입력해주세요.`},
                            {name : "subject",message : `제목을 입력해주세요.`},
                            {name : "upfile",message : `자료를 등록해주세요.`},
                        ],
                        href : "",
                    },

                    filter : {
                        table : "",
                        primary : this.primary,
                        page: 1,
                        limit: 1,
                        count: 0,
                    },

                    modal : {
                        status : false,
                        data : {
                            table : "class_study",
                            file_use : true,
                            chapter : "",
                            subject:  "",
                            upfile : "",
                        },
                    },
                    modal2 : false,
                    modal2_data : {
                        wr_content : "",
                    },


                    rend : false,
                };
            },
            async created() {
                this.jl = new Jl('<?=$componentName?>');
                this.component_idx = this.jl.generateUniqueId();

                let allows = ["관리자","목회자"]

                if(!allows.includes(this.mb_1)) {
                    await this.jl.alert("목회자만 접근 가능합니다.");
                    window.history.back();
                }

                if(this.primary) this.data = await this.jl.getData(this.filter);
                //await this.jl.getsData(this.filter,this.arrays);

                this.load = true;
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

            },
            watch: {

            }
        }});

</script>

<style>

</style>