<?php
$componentName = str_replace(".php","",basename(__FILE__));
$pathParts = explode(DIRECTORY_SEPARATOR, dirname(__FILE__));
$context_name = end($pathParts);
?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div v-if="load">
        <external-bs-modal :modal="modal">
            <template v-slot:header>

            </template>

            <!-- body -->
            <template v-slot:default>
                <a class="btn btn-blueline w100" href="../file/price_sample.xlsx" download="수량단가 엑셀샘플"><img :src="jl.root + 'img/common/excel_green.svg'"> 샘플 다운로드</a>
                <div class="flex ai-c">
                    <label class="btn btn_mini btn_line" for="file_btn">파일 선택</label>&nbsp;
                    <span class="file_info">{{row.upfile ? row.upfile.name : '선택된 파일 없음'}}</span>
                </div>
                <input type="file" v-show="false" id="file_btn" @change="jl.changeFile($event,row,'upfile')">
            </template>


            <template v-slot:footer>
                <button class="btn btn-primary" @click="jl.postData(row,options)">업로드</button>
            </template>
        </external-bs-modal>
    </div>
</script>

<script>
    Jl_components.push({name : "<?=$componentName?>",object : {
            template: "#<?=$componentName?>-template",
            props: {
                modal : { type: Object, default: {} },
                primary : { type: String, default: "" },
                project_idx : { type: String, default: "" },
            },
            data: function () {
                return {
                    load : false,
                    jl: null,
                    component_idx: "",
                    context_name : "<?=$context_name?>",
                    context : null,

                    row: {
                        project_idx : this.project_idx,
                        upfile : "",
                    },
                    rows : [],

                    options : {
                        table : "project_record",
                        file_use : true,
                        required : [
                            {name : "upfile",message : `파일을 업로드해주세요.`},
                        ],
                        url : "/api/project_record",
                        method : "excel",
                        href : "",
                    },

                    filter : {
                        table : "",
                        primary : this.primary,
                        page: 1,
                        limit: 1,
                        count: 0,
                    },


                };
            },
            async created() {
                this.jl = new Jl('<?=$componentName?>');
                this.component_idx = this.jl.generateUniqueId();
                const className = this.context_name.charAt(0).toUpperCase() + this.context_name.slice(1) + "Common";
                if (typeof window[className] !== 'undefined') {
                    this.context = new window[className](this.jl);
                }
            },
            async mounted() {
                if(this.primary) this.row = await this.jl.getData(this.filter);
                //await this.jl.getsData(this.filter,this.rows);

                this.load = true;

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
                async "modal.status"(value,old_value) {
                    if(value) {
                        this.modal.load = true;
                    }else {
                        this.modal.load = false;
                        this.modal.data = {};
                    }
                }
            }
        }});

</script>

<style>

</style>