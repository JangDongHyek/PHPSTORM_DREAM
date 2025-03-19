<?php
$componentName = str_replace(".php","",basename(__FILE__));
$pathParts = explode(DIRECTORY_SEPARATOR, dirname(__FILE__));
$context_name = end($pathParts);
?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <td>
        <div class="flex gap5 ai-c">
            <input type="text" class="w200px" v-model="area.name" @change="area.status = 'update'" placeholder="구역명">
            <button class="btn btn-mini btn-line" @click="deleteArea(area)">삭제</button>
            <button class="btn btn-mini btn-gray" @click="putArea(area,'incr')"><i class="fa-solid fa-up"></i></button>
            <button class="btn btn-mini btn-gray" @click="putArea(area,'decr')" :disabled="area.priority <= 0"><i class="fa-solid fa-down"></i></button>
            <span>우선순위 <b>{{area.priority}}</b></span>
        </div>
    </td>
</script>

<script>
    Jl_components.push({name : "<?=$componentName?>",object : {
            template: "#<?=$componentName?>-template",
            props: {
                area : { type: Object, default: {} },
                rows : { type: Array, default: [] },

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
                async putArea(area,type) {
                    if(this.context.checkData(this.rows)) {
                        if(!await this.jl.confirm("수정된 데이터가있습니다. 진행시 수정된 데이터가 누락됩니다 진행하시겠습니까?"))
                            return false;
                    }

                    await this.jl.postData(area,{
                        table : "project_area",
                        updated : [
                            {key : "priority", value : type},
                        ],
                        callback : async (res) => {
                            this.$emit('update');
                        },
                    })
                },
                async deleteArea(area) {
                    if(this.context.checkData(this.rows)) {
                        if(!await this.jl.confirm("수정된 데이터가있습니다. 진행시 수정된 데이터가 누락됩니다 진행하시겠습니까?"))
                            return false;
                    }

                    await this.jl.deleteData(area,{
                        table : "project_area",
                        callback : async (res) => {
                            this.$emit('update');
                        },
                    })


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