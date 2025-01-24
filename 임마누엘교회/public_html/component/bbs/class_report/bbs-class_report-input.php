<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div v-if="load">
        <div id="class" class="form">
            <div class="box_radius box_white">
                <div class="table">
                    <table>
                        <tbody>
                        <tr class="top">
                            <td>소속</td>
                            <td>
                                <div class="flex ai-c gap5">
                                    <input type="text" readonly v-model="data.wr_7"> 교구
                                    <input type="text" readonly v-model="data.wr_8"> 속
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>속장</td>
                            <td>
                                <div class="flex ai-c gap5">
                                    <input type="text" placeholder="이름" readonly v-model="data.wr_9">
                                    <input type="text" placeholder="직분" readonly v-model="data.wr_10">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>일시 <span class="txt_color">*</span></td>
                            <td>
                                <input type="date" required v-model="data.wr_2">
                            </td>
                        </tr>
                        <tr>
                            <td>장소 <span class="txt_color">*</span></td>
                            <td>
                                <input type="text" required v-model="data.wr_3">
                            </td>
                        </tr>
                        <tr>
                            <td>인원 <span class="txt_color">*</span></td>
                            <td>
                                <div class="flex ai-c gap5">
                                    <input type="number" required v-model="data.wr_4" @input="jl.isNumberKeyInput"> 명
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>헌금 <span class="txt_color">*</span></td>
                            <td>
                                <div class="flex ai-c gap5">
                                    <input type="number" required v-model="data.wr_5" @input="jl.isNumberKeyInput"> 만원
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">특이사항 <span class="txt_color"></span></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <textarea placeholder="입력시 특이사항이 있는걸로 간주됩니다." v-model="data.wr_6"></textarea>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <br>
                <button type="button" class="btn btn_color btn-large" @click="jl.postData(data,'g5_write_class_report',options)">등록하기</button>
            </div>
        </div>
    </div>
</script>

<script>
    Jl_components.push({name : "<?=$componentName?>",object : {
            template: "#<?=$componentName?>-template",
            props: {
                mb_no : {type: String, default: ""},
                mb_1 : {type: String, default: ""},
                mb_2 : {type: String, default: ""},
                mb_3 : {type: String, default: ""},
                mb_name : {type: String, default: ""},
                primary : {type: String, default: ""},
            },
            data: function () {
                return {
                    load : false,
                    jl: null,
                    component_idx: "",

                    data: {
                        wr_1 : this.mb_no,
                        wr_2 : "",
                        wr_3 : "",
                        wr_4 : "",
                        wr_5 : "",
                        wr_6 : "",
                        wr_7 : this.mb_2,
                        wr_8 : this.mb_3,
                        wr_9 : this.mb_name,
                        wr_10 : this.mb_1,
                    },
                    arrays : [],

                    options : {
                        required : [
                            {name : "wr_2",message : `일시를 입력해주세요`},
                            {name : "wr_3",message : `장소를 입력해주세요`},
                            {name : "wr_4",message : `인원을 입력해주세요`},
                            {name : "wr_5",message : `헌금을 입력해주세요`},
                        ],
                        href : "./class",
                    },

                    filter : {
                        table : "g5_write_class_report",
                        primary : this.primary,
                        page: 1,
                        limit: 1,
                        count: 0,
                    },

                    rend : false,

                    member : {},
                };
            },
            async created() {
                this.jl = new Jl('<?=$componentName?>');
                this.component_idx = this.jl.generateUniqueId();

                if(!this.mb_no) {
                    await this.jl.alert("로그인이 필요한 페이지입니다.");
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