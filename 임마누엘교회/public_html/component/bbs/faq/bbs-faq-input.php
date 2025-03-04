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
                            <td>질문 <span class="txt_color">*</span></td>
                        </tr>
                        <tr>
                            <td>
                                <textarea v-model="data.wr_subject"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>답변 <span class="txt_color">*</span></td>
                        </tr>
                        <tr>
                            <td>
                                <textarea v-model="data.wr_content"></textarea>
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
                primary : {type: String, default: ""},
            },
            data: function () {
                return {
                    load : false,
                    jl: null,
                    component_idx: "",

                    data: {
                        wr_subject : "",
                        wr_content : "",
                    },
                    data_array : [],

                    options : {
                        table : "g5_write_faq",
                        required : [
                            {name : "wr_subject",message : `질문은 필수값입니다.`},
                            {name : "wr_content",message : `답변은 필수값입니다.`},
                        ],
                        href : "./faq",
                    },

                    filter : {
                        table : "g5_write_faq",
                        primary : this.primary,
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