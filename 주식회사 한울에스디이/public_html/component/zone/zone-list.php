<?php
$componentName = str_replace(".php","",basename(__FILE__));
$pathParts = explode(DIRECTORY_SEPARATOR, dirname(__FILE__));
$context_name = end($pathParts);
?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div v-if="load">
        <div class="zone">
            <div class="flex ai-c jc-sb">
                <button class="btn btn-small btn-blue" @click="modal.primary = '' ; modal.status = true;">구역 추가</button>
                <button class="btn btn-small btn-darkblue male-auto" @click="putData();">저장</button>
            </div>
            <div class="flex">
                <div class="left">
                    <div class="sticky">
                        <button type="button" class="btn btn-gray w100" @click="modal.primary = '' ; modal.status = true;">구역 추가</button>
                        <ul>
                            <li v-for="block in all_blocks" :class="{ active : filter.in[0].array.includes(block.idx)}">
                                <a @click="checkFilter(block)">
                                    <i class="fa-duotone fa-grid-horizontal"></i> {{block.name}}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="table">
                    <table>
                        <thead>
                        <tr>
                            <th>동</th>
                            <th>층</th>
                            <th>구역</th>
                        </tr>
                        </thead>

                        <tbody v-for="block,block_index in rows">
                        <!-- 층이없다면 -->
                        <template v-if="block.$floors.length == 0">
                            <tr>
                                <zone-part-block :rows="rows" :block="block" @update="updateData();"></zone-part-block>
                                <td colspan="2">층 없음</td>
                            </tr>
                        </template>

                        <!-- 층이 있다면 -->
                        <template v-if="block.$floors.length > 0">
                            <template v-for="floor,floor_index in block.$floors">

                                <!-- 0번째 층이라면 -->
                                <template v-if="floor_index == 0">
                                    <!-- 구역이 없다면 -->
                                    <template v-if="floor.$areas.length == 0">
                                        <tr>
                                            <!-- 동에대한 정보  -->
                                            <zone-part-block :rows="rows" :block="block" @update="updateData();"></zone-part-block>

                                            <zone-part-floor :rows="rows" :floor="floor" @update="updateData();"></zone-part-floor>

                                            <td>구역 없음</td>
                                        </tr>
                                    </template>

                                    <!-- 구역이 있다면 -->
                                    <template v-if="floor.$areas.length > 0">
                                        <tr>
                                            <!-- 동에대한 정보  -->
                                            <zone-part-block :rows="rows" :block="block" @update="updateData();"></zone-part-block>

                                            <zone-part-floor :rows="rows" :floor="floor" @update="updateData();"></zone-part-floor>

                                            <zone-part-area :rows="rows" :area="floor.$areas[0]" @update="updateData();"></zone-part-area>
                                        </tr>

                                        <!-- 구역 tr 생성 -->
                                        <template v-for="area,area_index in floor.$areas">
                                            <tr v-if="area_index != 0">
                                                <zone-part-area v-if="area_index != 0" :rows="rows" :area="area" @update="updateData();"></zone-part-area>
                                            </tr>
                                        </template>
                                    </template>
                                </template>

                                <!-- 0번째 층이 아니라면 -->
                                <template v-if="floor_index != 0">
                                    <tr>
                                        <zone-part-floor :rows="rows" :floor="floor" @update="updateData();"></zone-part-floor>

                                        <!-- 구역이없다면 -->
                                        <template v-if="floor.$areas.length == 0">
                                            <td>구역 없음</td>
                                        </template>

                                        <!-- 구역이있다면 -->
                                        <template v-if="floor.$areas.length > 0">
                                            <zone-part-area :rows="rows" :area="floor.$areas[0]" @update="updateData();"></zone-part-area>
                                        </template>
                                    </tr>

                                    <!-- 구역 tr 생성 -->
                                    <template v-for="area,area_index in floor.$areas">
                                        <tr v-if="area_index != 0">
                                            <zone-part-area :rows="rows" :area="area" @update="updateData();"></zone-part-area>
                                        </tr>
                                    </template>
                                </template>
                            </template>
                        </template>


                        </tbody>

                    </table>
                </div>
            </div>
        </div>

        <zone-input :modal="modal" :project_idx="project_idx"></zone-input>
    </div>
</script>

<script>
    Jl_components.push({name : "<?=$componentName?>",object : {
            template: "#<?=$componentName?>-template",
            props: {
                project_idx : { type: String, default: "" },
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
                    all_blocks : [],

                    options : {
                        table : "",
                        file_use : false,
                        required : [
                            {name : "",message : ``},
                        ],
                        href : "",
                    },

                    filter : {
                        table : "project_block",
                        project_idx : this.project_idx,

                        in : [
                            {key : "idx", array : [] }
                        ],

                        relations : [
                            {
                                table : "project_floor" ,
                                foreign : "block_idx",
                                type : "data", // type(count,data)
                                as : "floors",
                                filter : {
                                    order_by : [
                                        {column : "priority" , type : "DESC"},
                                        {column : "idx" , type : "ASC"},
                                    ],
                                },

                                relations : [
                                    {
                                        table : "project_area" ,
                                        foreign : "floor_idx",
                                        type : "data", // type(count,data)
                                        as : "areas",
                                        filter : {
                                            order_by : [
                                                {column : "priority" , type : "DESC"},
                                                {column : "idx" , type : "ASC"},
                                            ],
                                        },
                                    },
                                ],

                            },
                        ],

                        order_by : [
                            {column : "priority" , type : "DESC"},
                            {column : "idx" , type : "ASC"},
                        ],
                    },

                    modal : {
                        status : false,
                        load : false,
                        primary : "",
                        data : {},
                        class_1 : "sectionModal",
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
                //if(this.primary) this.row = await this.jl.getData(this.filter);
                await this.jl.getsData(this.filter,this.rows);
                await this.jl.getsData({
                    table : "project_block",
                    project_idx : this.project_idx,
                    order_by : [
                        {column : "priority" , type : "DESC"},
                        {column : "idx" , type : "ASC"},
                    ],
                },this.all_blocks);

                this.load = true;

                this.$nextTick(() => {

                });
            },
            updated() {

            },
            methods: {
                async updateData() {
                    await this.jl.getsData(this.filter,this.rows);
                    await this.jl.getsData({
                        table : "project_block",
                        project_idx : this.project_idx,
                        order_by : [
                            {column : "priority" , type : "DESC"},
                            {column : "idx" , type : "ASC"},
                        ],
                    },this.all_blocks);

                },
                checkData() {
                    for (const block of this.rows) {
                        if(block.status == 'update') {
                            return true;
                        }

                        for (const floor of block.$floors) {
                            if(floor.status == 'update') {
                                return true;
                            }

                            for (const area of floor.$areas) {
                                if(area.status == 'update') {
                                    return true;
                                }
                            }
                        }
                    }

                    return false;
                },
                async putData() {
                    if(!this.checkData()) {
                        await this.jl.alert("수정된 데이터가 없습니다.");
                        return false;
                    }
                    for (const block of this.rows) {
                        if(block.status == 'update') {
                            await this.jl.postData(block,{table : "project_block",return : true});
                        }

                        for (const floor of block.$floors) {
                            if(floor.status == 'update') {
                                await this.jl.postData(floor,{table : "project_floor",return :  true});
                            }

                            for (const area of floor.$areas) {
                                if(area.status == 'update') {
                                    await this.jl.postData(area,{table : "project_area",return : true});
                                }
                            }
                        }
                    }

                    await this.jl.alert("완료되었습니다.");
                    window.location.reload();
                },
                async checkFilter(block) {
                    let array = this.filter.in[0].array;

                    let index = array.indexOf(block.idx);

                    if(index !== -1) {
                        array.splice(index,1)
                    }else {
                        array.push(block.idx);
                    }

                    await this.jl.getsData(this.filter,this.rows);
                }
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