<?php
$componentName = str_replace(".php","",basename(__FILE__));
$pathParts = explode(DIRECTORY_SEPARATOR, dirname(__FILE__));
$context_name = end($pathParts);
?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div v-if="load">
        <section class="schedule_task">
            <div class="task_header colgroup">
                <div class="border">작업 구역</div>
                <div class="border">담당자</div>
                <div class="border">상태</div>
                <div class="border">시작예정일</div>
                <div class="border">마감예정일</div>
                <div class="border">예상소요</div>
                <div class="border">시작일</div>
                <div class="border">마감일</div>
            </div>

            <template v-for="block in blocks">
                <div class="section_title zone_title" @click="block.expanded = !block.expanded">
                    <i class="fa-solid fa-caret-down" :class="{'fa-caret-right' : !block.expanded}"></i> {{block.name}}
                </div>

                <div class="section_content" v-for="floor in block.$floors" v-if="block.expanded">
                    <div class="zone_title c1" @click="floor.expanded = !floor.expanded">
                        <i class="fa-solid fa-caret-down" :class="{'fa-caret-right' : !floor.expanded}"></i> {{floor.name}}
                    </div>

                    <div class="section_content" v-for="area in floor.$areas" v-if="floor.expanded">
                        <div class="task_content_dl">
                            <div class="colgroup task_item">
                                <div class="border">{{area.name}}</div>
                                <div class="border"><input type="text" placeholder="담당자"/></div>
                                <div class="border">
                                    <select class="statusSelect red">
                                        <option value="예정" >예정</option>
                                        <option value="진행">진행</option>
                                        <option value="조기">조기</option>
                                        <option value="완료">완료</option>
                                        <option value="초과" selected>초과</option>
                                    </select>
                                </div>
                                <div class="border"><input type="date" :value="area.$schedule[0].start_date" /></div>
                                <div class="border"><input type="date" :value="area.$schedule[0].end_date" /></div>
                                <div class="border"><input type="number" :value="area.$schedule[0].work_days"/></div>
                                <div class="border"><input type="date" value="2025-03-01" /></div>
                                <div class="border"><input type="date" value="2025-03-15" /></div>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </section>
    </div>
</script>

<script>
    Jl_components.push({name : "<?=$componentName?>",object : {
            template: "#<?=$componentName?>-template",
            props: {
                blocks : { type: Array, default: [] },
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