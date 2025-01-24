<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div v-if="load">
        <div id="class" class="main">
            <div class="slogan">
                <h3>제{{study.chapter}}과</h3>
                <h2>❝<b>{{study.subject}}</b>❞</h2>
                <a class="btn btn_color btn-large" @click="modal = true;">공부하기</a>
            </div>
            <div class="box_radius box_white">
                <h6>속회소식</h6>
                <div class="box_gray" v-if="classes[0]" v-html="jl.convertNewlinesToBr(classes[0].wr_content)"></div>
                <div class="table" v-if="classes.length > 1">
                    <p class="flex jc-sb ai-c">
                        <b>이전 소식</b>
                        <a class="more" href="class_noti">+ 더보기</a>
                    </p>
                    <div class="table">
                        <table>
                            <tbody><!--3개만-->
                            <template v-for="board,index in classes">
                                <tr v-if="index > 0">
                                    <td><p class="cut" @click="modal2.data = board; modal2.status = true;">{{board.wr_content}}</p></td>
                                </tr>
                            </template>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="grid grid2">
                <button class="btn" type="button" onclick="location.href='./class_form'">속회보고</button>
                <button class="btn" type="button" onclick="location.href='./class_list'">속회예배현황</button>
                <button class="btn" type="button" onclick="location.href='./class_leader'">목회자탭</button>
                <button class="btn" type="button" onclick="window.open('https://www.bskorea.or.kr/bible/korbibReadpage.php')">성경읽기</button>
            </div>
        </div>

        <item-bs-modal :modal="modal" @close="modal = false;" classes="pdf_modal">
            <template v-slot:header>

            </template>

            <!-- body -->
            <template v-slot:default>
                <external-pdf-view v-if="modal" :src="study.upfile.src" @close="modal = false;"></external-pdf-view>
            </template>


            <template v-slot:footer>

            </template>
        </item-bs-modal>

        <external-bs-modal :modal="modal2.status" @close="modal2.status = false;" class_1="" class_2="">
            <template v-slot:header>
                <h4 class="modal-title" id="classNotiModalLabel">속회보고</h4>
                <button type="button" class="close" @click="modal2.status = false;"><span aria-hidden="true">&times;</span></button>
            </template>

            <!-- body -->
            <template v-slot:default>
                <textarea placeholder="속회소식를 작성하세요." readonly v-model="modal2.data.wr_content"></textarea>
            </template>


            <template v-slot:footer>

            </template>
        </external-bs-modal>
    </div>
</script>

<script>
    Jl_components.push({name : "<?=$componentName?>",object : {
            template: "#<?=$componentName?>-template",
            props: {
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

                    data: {},

                    modal : false,
                    modal2 : {
                        status : false,
                        data : {},
                    },

                    class_filter : {
                        table : "g5_write_class",
                        page: 1,
                        limit: 4,
                        count: 0,
                    },
                    classes : [],

                    study_filter : {
                        table : "class_study",
                        page: 1,
                        limit: 1,
                        count: 0,
                    },

                    study : {},
                    load : false,
                };
            },
            async created() {
                this.jl = new Jl('<?=$componentName?>');
                this.component_idx = this.jl.generateUniqueId();

                await this.jl.getsData(this.class_filter,this.classes);
                this.study = await this.jl.getData(this.study_filter);

                this.load = true;
            },
            mounted() {
                this.$nextTick(() => {

                });
            },
            updated() {

            },
            methods: {
                async postData() {
                    let method = this.primary ? "update" : "insert";
                    let data = {
                        table: "",
                    }

                    // object의 필수값을 설정하는 option
                    let required = [
                        {name : "",message : ""},
                    ]
                    let options = {required : required};

                    if (this.data) data = Object.assign(data, this.data); // paging 객체가있다면 병합

                    try {
                        let res = await this.jl.ajax(method, data, "/jl/JlApi.php",options);
                    } catch (e) {
                        await this.jl.alert(e.message)
                    }

                },
                async getData() {
                    let filter = {
                        table: "user",
                    }

                    if (this.paging) filter = Object.assign(filter, this.paging); // paging 객체가있다면 병합

                    try {
                        let res = await this.jl.ajax("get", filter, "/jl/JlApi.php");
                        this.data = res.data[0]
                        this.paging.count = res.count;
                    } catch (e) {
                        await this.jl.alert(e.message)
                    }
                }
            },
            computed: {},
            watch: {}
        }});

</script>

<style>

</style>