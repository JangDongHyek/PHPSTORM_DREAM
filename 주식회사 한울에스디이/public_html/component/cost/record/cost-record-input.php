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
                <h5 class="modal-title" id="groupPriceModalLabel">수량단가 등록</h5>
            </template>

            <!-- body -->
            <template v-slot:default>
                <div class="form_wrap">
                    <div class="flex ai-c jc-sb">
                        <label for="" class="txt-up">카테고리 선택</label>&nbsp;&nbsp;
                    </div>
                    <select v-model="row.category">
                        <option>콘크리트</option>
                        <option>거푸집</option>
                        <option>철근</option>
                    </select>
                    <div class="box box-gray">
                        <label for="">품명</label>
                        <div class="flex ai-c">
                            <input type="text" v-model="row.name" placeholder="수량 품명"/>
                        </div>
                    </div>
                    <div class="box box-white">
                        <label for="">연관</label><button class="btn btn-mini btn-gray" @click="pushContents()">추가</button>
                        <div class="flex gap5 ai-c" v-for="content,index in contents">
                            <select v-model="content.price_idx">
                                <template v-for="price in prices">
                                    <option :value="price.idx">{{price.name}} [{{price.standard}}]</option>
                                </template>
                            </select>
                            <input type="number" class="w150px" v-model="content.surcharge" placeholder="할증(미입력시 0)">
                            <span>%</span>
                            <button class="btn btn-line" @click="deleteContent(content,index)">삭제</button>
                        </div>
                    </div>
                    <br>
                </div>
            </template>


            <template v-slot:footer>
                <button type="button" class="btn btn-primary" @click="postData()">등록 완료</button>
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
                        name : "",
                    },
                    contents : [],

                    rows : [],

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

                    prices : [],

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
                },this.prices);

                this.load = true;

                this.$nextTick(() => {

                });
            },
            updated() {

            },
            methods: {
                async postData() {
                    let record = await this.jl.postData(this.row,{
                        table : "project_record",
                        required : [
                            {name : "name",message : `품명을 입력해주세요.`},
                        ],
                        return : true,
                    })

                    for (const content of this.contents) {
                        content.record_idx = record.primary;
                        this.jl.postData(content,{
                            table : "project_record_items",
                            return : true,
                        })
                    }

                await this.jl.alert("완료되었습니다.");
                window.location.reload();
                },
                async deleteContent(content,index) {
                    if(content.idx) {
                        await this.jl.deleteData(content,{
                            table : "project_record_items",
                            message : "해당 데이터는 완료를 누르지 않아도 삭제됩니다 삭제하시겠습니까?",
                            callback : async (res) => {
                                this.contents.splice(index,1);
                            }
                        });


                    }else {
                        this.contents.splice(index,1);
                    }


                },
                pushContents() {
                    this.contents.push({
                       record_idx : "",
                       price_idx : "",
                       surcharge : 0,
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
                                table : "project_record",
                                primary : this.modal.primary,
                            });

                            await this.jl.getsData({
                                table : "project_record_items",
                                record_idx : this.modal.primary
                            },this.contents);
                        }
                        this.modal.load = true;
                    }else {
                        this.modal.load = false;
                        this.modal.data = {};

                        this.row =  {
                            project_idx : this.project_idx,
                                category : "콘크리트",
                                name : "",
                        };
                        this.contents = [];
                    }
                }
            }
        }});

</script>

<style>

</style>