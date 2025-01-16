<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div>
        <div id="class" class="main">
            <div class="slogan">
                <h3>제44과</h3>
                <h2>❝<b>구원 받은 성도의 삶</b>❞</h2>
                <a class="btn btn_color btn-large" @click="modal = true;">공부하기</a>
            </div>
            <div class="box_radius box_white">
                <h6>속회소식</h6>
                <div class="box_gray">
                    <p>
                        1.속장교육 : 10월 30일 오전 11시. 목요기도회 후. 베들레헴성전<br>
                        많은 참석 바랍니다.<br>
                        2.연합속회 : 11월 7일 오전 11시. 예루살렘성전.<br>
                        연합속회 후 교구별로 점심식사가 있습니다.
                    </p>
                </div>
                <div class="table">
                    <p class="flex jc-sb ai-c">
                        <b>이전 소식</b>
                        <a class="more" href="class_noti">+ 더보기</a>
                    </p>
                    <div class="table">
                        <table>
                            <tbody><!--3개만-->
                            <tr>
                                <td><p class="cut" onclick="location.href='./class_noti_view'">1.속장교육 : 10월 30일 오전 11시. 목요기도회 후. 베들레헴성전</p></td>
                            </tr>
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

        <item-bs-modal :modal="modal" @close="modal = false;">
            <template v-slot:header>

            </template>

            <!-- body -->
            <template v-slot:default>
                <external-pdf-view v-if="modal" src="/app/file/44.pdf" @close="modal = false;"></external-pdf-view>
            </template>


            <template v-slot:footer>

            </template>
        </item-bs-modal>
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
                };
            },
            async created() {
                this.jl = new Jl('<?=$componentName?>');
                this.component_idx = this.jl.generateUniqueId();
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