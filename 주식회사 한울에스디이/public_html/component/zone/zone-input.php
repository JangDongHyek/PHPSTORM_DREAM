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
                <h5 class="modal-title" id="sectionModalLabel">작업 구역 관리</h5>
            </template>

            <!-- body -->
            <template v-slot:default>
                <div class="form_wrap">
                    <div class="flex ai-c">
                        <label for="" class="txt-up">구역 등록</label>&nbsp;&nbsp;
                        <button class="btn btn-mini btn-black">추가</button>
                    </div>
                    <div class="box box-white">
                        <div class="flex ai-c gap5">
                            <label for="">동 정보</label>
                            <button class="btn btn-mini btn-gray" @click="pushBlocks()">동일 추가</button>
                        </div>
                        <ul>
                            <li class="flex ai-c" v-for="block,index in blocks">
                                <input type="text" v-model="block.name" placeholder="0"/>&nbsp
                                <span>동</span>
                                <button class="btn btn-mini male-auto btn-line" @click="deleteBlocks(block,index)">삭제</button>
                            </li>
                        </ul>
                        <label for="">층 정보</label>
                        <div class="flex ai-c gap5">
                            <input type="text" name="" id="" placeholder="최소"/>&nbsp;<p>층</p> -
                            <input type="text" name="" id="" placeholder="최대"/>&nbsp;<p>층</p>
                        </div>
                        <label for="">구역 개수</label>
                        <div class="flex ai-c">
                            <input type="text" name="" id="" placeholder="0"/>
                        </div>
                        <p class="txt-gray">＊ 구역 개수 미설정시 층까지만 설정됩니다.</p>
                        <p class="txt-gray">＊ 구역명은 설정 완료 후 개별 설정 가능합니다.</p>
                        <p class="txt-gray">＊ 생성시 자동으로 [A~Z 구역] 으로 표기됩니다.</p>
                    </div>
                    <br>
                </div>
            </template>


            <template v-slot:footer>
                <button type="button" class="btn btn-primary">등록 완료</button>
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

                    row: {},
                    rows : [],

                    blocks : [],

                    options : {
                        table : "",
                        file_use : false,
                        required : [
                            {name : "",message : ``},
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
                deleteBlocks(block,index) {
                    if(block.idx) {

                    }else {
                        this.blocks.splice(index,1);
                    }
                },
                pushBlocks() {
                    this.blocks.push({
                        name : "",
                    });
                }
            },
            computed: {

            },
            watch: {
                async "modal.status"(value,old_value) {
                    if(value) {
                        if(this.modal.primary) {

                        }

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