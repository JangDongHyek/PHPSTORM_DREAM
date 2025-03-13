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
                <h5 class="modal-title" id="unitOptionModalLabel">옵션 단가 등록</h5>
            </template>

            <!-- body -->
            <template v-slot:default>
                <div class="form_wrap">
                    <div class="flex ai-c jc-sb">
                        <label for="" class="txt-up">카테고리 선택</label>&nbsp;&nbsp;
                    </div>
                    <select>
                        <option>콘크리트</option>
                        <option>거푸집</option>
                        <option>철근</option>
                    </select>
                    <div class="box box-gray">
                        <label for="">옵션 품명</label>
                        <div class="flex ai-c">
                            <input type="text" v-model="row.name" placeholder="옵션 품명"/>
                        </div>
                        <label for="">규격</label>
                        <div class="flex ai-c">
                            <input type="text" v-model="row.standard" placeholder="규격"/>
                        </div>
                    </div>
                    <div class="box box-white">
                        <label for="">계산</label><button class="btn btn-mini btn-gray" @click="addContent();">추가</button>
                        <div class="flex gap5" v-for="content,index in row.contents">
                            <select class="wfit" v-model="content.operator">
                                <option>기본값</option>
                                <option>+</option>
                                <option>-</option>
                            </select>
                            <select class="wfit" v-model="content.surcharge">
                                <option>미할증</option>
                                <option>할증</option>
                            </select>
                            <select v-model="content.price_idx">
                                <template v-for="item in rows">
                                    <option :value="item.idx">{{item.name}} [{{item.standard}}]</option>
                                </template>
                            </select>
                            <button class="btn btn-line" @click="row.contents.splice(index,1)">삭제</button>
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
                        category : "콘크리트",
                        types : "옵션",
                        name : "",
                        standard : "",
                        material : "",
                        labour : "",
                        expense : "",
                        contents : [],
                    },

                    rows : [],

                    options : {
                        table : "project_price",
                        file_use : false,
                        required : [
                            {name : "name",message : `품명은 필수입니다.`},
                            {name : "standard",message : `규격은 필수입니다.`},
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
                await this.jl.getsData({
                    table : "project_price",
                    project_idx : this.project_idx,
                    types : '단가'
                },this.rows);

                this.load = true;

                this.$nextTick(() => {

                });
            },
            updated() {

            },
            methods: {
                addContent() {
                    this.row.contents.push({
                        operator : "",
                        surcharge : "",
                        price_idx : "",
                    });
                }
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
                        this.row =  {
                            project_idx : this.project_idx,
                            category : "콘크리트",
                            types : "옵션",
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