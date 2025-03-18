<?php
$componentName = str_replace(".php","",basename(__FILE__));
$pathParts = explode(DIRECTORY_SEPARATOR, dirname(__FILE__));
$context_name = end($pathParts);
?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <td :rowspan="context.getBlockRowspan(block)">
        <input type="text" v-model="block.name" @change="block.status = 'update'" class="txt-blue" placeholder="동 정보">
        <button class="btn btn-mini btn-blueline" @click="postFloor(block)">층 추가</button>
        <button class="btn btn-mini btn-line" @click="deleteBlock(block)">삭제</button>
        <div>
            <button class="btn btn-mini btn-gray" @click="putBlock(block,'incr')"><i class="fa-solid fa-up"></i></button>
            <button class="btn btn-mini btn-gray" @click="putBlock(block,'decr')" :disabled="block.priority <= 0"><i class="fa-solid fa-down"></i></button>
            <span>우선순위 : {{block.priority}}</span>
        </div>
    </td>
</script>

<script>
    Jl_components.push({name : "<?=$componentName?>",object : {
            template: "#<?=$componentName?>-template",
            props: {
                rows : { type: Array, default: [] },
                block : { type: String, default: "" },
                primary : { type: String, default: "" },
            },
            data: function () {
                return {
                    load : false,
                    jl: null,
                    component_idx: "",
                    context_name : "<?=$context_name?>",
                    context : null,

                    row: {},

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

                    modal : {
                        status : false,
                        load : false,
                        primary : "",
                        data : {},
                        class_1 : "",
                        class_2 : "",
                    },

                };
            },
            async created() {
                this.jl = new Jl('<?=$componentName?>');
                this.component_idx = this.jl.generateUniqueId();
                const className = this.context_name.charAt(0).toUpperCase() + this.context_name.slice(1) + "Common";
                console.log(className);
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
                async putBlock(block,type) {
                    if(this.context.checkData(this.rows)) {
                        if(!await this.jl.confirm("수정된 데이터가있습니다. 진행시 수정된 데이터가 누락됩니다 진행하시겠습니까?"))
                            return false;
                    }

                    await this.jl.postData(block,{
                        table : "project_block",
                        updated : [
                            {key : "priority", value : type},
                        ],
                        callback : async (res) => {
                            this.$emit('update');
                        },
                    })
                },
                async deleteBlock(block) {
                    if(this.context.checkData(this.rows)) {
                        if(!await this.jl.confirm("수정된 데이터가있습니다. 진행시 수정된 데이터가 누락됩니다 진행하시겠습니까?"))
                            return false;
                    }

                    await this.jl.deleteData(block, {
                        table : "project_block",
                        relations : [
                            {
                                table : "project_floor" ,
                                foreign : "block_idx",
                            },
                            {
                                table : "project_area" ,
                                foreign : "block_idx",
                            },
                        ],
                        callback : async (res) => {
                            this.$emit('update');
                        },
                    })
                },

                async postFloor(block) {
                    if(this.context.checkData(this.rows)) {
                        if(!await this.jl.confirm("수정된 데이터가있습니다. 진행시 수정된 데이터가 누락됩니다 진행하시겠습니까?"))
                            return false;
                    }

                    let floor = {
                        project_idx : this.project_idx,
                        block_idx : block.idx,
                        name : "",
                        priority : 0,
                    };

                    await this.jl.postData(floor,{
                        table : "project_floor",
                        callback : async (res) => {
                            this.$emit('update');
                        },
                    });
                },

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