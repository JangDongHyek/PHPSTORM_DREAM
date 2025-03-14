<?php
$componentName = str_replace(".php","",basename(__FILE__));
$pathParts = explode(DIRECTORY_SEPARATOR, dirname(__FILE__));
$context_name = end($pathParts);
?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div v-if="load">
        <external-bs-modal :modal="modal">
            <template v-slot:header>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa-light fa-close"></i></button>
                <h5 class="modal-title" id="unitPriceModalLabel">기초단가 등록</h5>
            </template>

            <!-- body -->
            <template v-slot:default>
                <div class="form_wrap">
                    <div class="flex ai-c jc-sb">
                        <label for="" class="txt-up">카테고리 선택</label>&nbsp;&nbsp;
                        <button class="btn btn-mini btn-black">카테고리 추가</button>
                    </div>
                    <select v-model="row.category">
                        <option>콘크리트</option>
                        <option>거푸집</option>
                        <option>철근</option>
                    </select>
                    <div class="box box-gray">
                        <label for="">품명</label>
                        <div class="flex ai-c">
                            <input type="text" v-model="row.name" placeholder="품명"/>
                        </div>
                    </div>
                    <!-- <button class="btn btn-mini w100 btn-black" @click="standards.push('')">규격 추가</button> -->
                    <div class="box box-white">
                        <label for="">규격</label>
                        <div class="flex ai-c">
                            <input type="text" v-model="row.standard" placeholder="규격"/>
                        </div>
                        <label for="">재료비</label>
                        <div class="flex ai-c">
                            <input type="text" v-model="row.material" placeholder="금액" @input="jl.isNumberKeyInput"/>
                        </div>
                        <label for="">노무비</label>
                        <div class="flex ai-c">
                            <input type="text" v-model="row.labour" placeholder="금액" @input="jl.isNumberKeyInput"/>
                        </div>
                        <label for="">경비</label>
                        <div class="flex ai-c">
                            <input type="text" v-model="row.expense" placeholder="금액" @input="jl.isNumberKeyInput"/>
                        </div>
                    </div>
                    <br>
                </div>
            </template>


            <template v-slot:footer>
                <button type="button" class="btn btn-primary" @click="jl.postData(row,options)">등록 완료</button>
            </template>
        </external-bs-modal>
    </div>
</script>

<script>
    Jl_components.push({name : "<?=$componentName?>",object : {
            template: "#<?=$componentName?>-template",
            props: {
                modal : {type: Object, default: {} },
                primary : {type: String, default: "" },
                project_idx : {type: String, default: "" },
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
                        category : "콘크리트",
                        types : "단가",
                        name : "",
                        standard : "",
                        material : "0",
                        labour : "0",
                        expense : "0",
                        contents : [],
                    },
                    rows : [],

                    options : {
                        table : "project_price",
                        file_use : false,
                        required : [
                            {name : "name",message : `품명은 필수입니다.`},
                            {name : "standard",message : `규격은 필수입니다.`},
                            {name : "material",message : `재료비는 필수입니다.`},
                            {name : "labour",message : `노무비는 필수입니다.`},
                            {name : "expense",message : `경비는 필수입니다.`},
                        ],
                        href : "",
                    },

                    filter : {
                        table : "project_price",
                        primary : this.modal.primary,
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
                        if(this.modal.primary) {
                            this.row = await this.jl.getData({
                                table : 'project_price',
                                primary : this.modal.primary
                            });
                        }
                        this.modal.load = true;
                    }else {
                        this.modal.load = false;
                        this.modal.data = {};
                        this.row = {
                            project_idx : this.project_idx,
                            category : "콘크리트",
                            types : "단가",
                            name : "",
                            standard : "",
                            material : "",
                            labour : "",
                            expense : "",
                            contents : [],
                        };
                    }
                }
            }
        }});

</script>

<style>

</style>