<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div v-if="load">
        <div class="tbl_frm01 tbl_wrap">
            <div class="frm">
                <label for="wr_subject">제목<strong class="sound_only">필수</strong></label>
                <div id="autosave_wrapper">
                    <input type="text" name="wr_subject" v-model="data.wr_subject" placeholder="제목을 입력해주세요" id="wr_subject" required class="frm_input" maxlength="255">
                </div>

                <label for="wr_content">내용<strong class="sound_only">필수</strong></label>
                <div class="wr_content">
                    <external-summernote :datum="data" field="wr_content"></external-summernote>
                    <!--<textarea id="wr_content" name="wr_content" style="width:100%;height:300px" placeholder="내용을 입력해주세요"></textarea>-->
                </div>
            </div>
        </div>

        <div class="btn_confirm" id="ft_btn">
            <input type="button" value="등록하기" id="btn_submit" class="btn" @click="jl.postData(data,table,options)">
        </div>
    </div>
</script>

<script>
    Jl_components.push({name : "<?=$componentName?>",object : {
            template: "#<?=$componentName?>-template",
            props: {
                table : {type: String, default: ""},
                primary : {type: String, default: ""},
            },
            data: function () {
                return {
                    load : false,
                    jl: null,
                    component_idx: "",

                    data: {
                        wr_option : "html1",
                        wr_subject : "",
                        wr_content : "",
                        wr_datetime : "now()"
                    },
                    arrays : [],

                    options : {
                        required : [
                            {name : "wr_subject",message : `제목은 필수값입니다.`},
                            {name : "wr_content",message : `내용은 필수값입니다.`},
                        ],
                        href : `./board.php?bo_table=${this.table.replace("g5_write_", "")}`,
                    },

                    filter : {
                        table : this.table,
                        primary : this.primary,
                        page: 1,
                        limit: 1,
                        count: 0,
                    },

                    modal : {
                        status : false,
                        data : {},
                    },

                    load : false,
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