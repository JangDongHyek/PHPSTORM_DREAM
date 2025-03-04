<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div v-if="load">
        <div class="box_radius box_white table">
            <span class="txt_color">*</span> <span class="txt_gray">표시된 항목은 필수기입 항목입니다.</span>
            <div class="table">
                <div class="table">
                    <table>
                        <tbody>
                        <tr class="top">
                            <td>문의내용 <span class="txt_color">*</span></td>
                        </tr>
                        <tr>
                            <td>
                                <textarea v-model="data.wr_subject"></textarea>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <br>
            <button type="button" class="btn btn_color btn-large" @click="jl.postData(data,options)">등록하기</button>
        </div>
    </div>
</script>

<script>
    Jl_components.push({name : "<?=$componentName?>",object : {
            template: "#<?=$componentName?>-template",
            props: {
                mb_no : {type: String, default: ""},
                primary : {type: String, default: ""},
            },
            data: function () {
                return {
                    load : false,
                    jl: null,
                    component_idx: "",

                    data: {
                        wr_subject : "",
                        wr_1 : this.mb_no,
                        wr_2 : false,
                    },
                    arrays : [],

                    options : {
                        table : 'g5_write_qna',
                        required : [
                            {name : "wr_1",message : `로그인이 필요한 기능입니다.`},
                            {name : "wr_subject",message : `내용은 필수입니다.`},
                        ],
                        href : "./inquiry",
                    },

                    filter : {
                        table : "",
                        page: 1,
                        limit: 1,
                        count: 0,
                    },

                    rend : false,
                };
            },
            async created() {
                this.jl = new Jl('<?=$componentName?>');
                this.component_idx = this.jl.generateUniqueId();

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