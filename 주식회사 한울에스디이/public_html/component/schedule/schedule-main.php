<?php
$componentName = str_replace(".php","",basename(__FILE__));
$pathParts = explode(DIRECTORY_SEPARATOR, dirname(__FILE__));
$context_name = end($pathParts);
?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div v-if="load">
        <div class="schedule-list">
            <div class="flex ai-c jc-sb">
                <div class="area_filter">
                    <input type="search" name="stx" placeholder="검색어 입력" value=""><button type="submit" class="btn-search"><i class="fa-regular fa-magnifying-glass"></i></button>
                </div>
                <div class="btn-wrap">
                    <button class="btn btn-small btn-gray" @click="changeExpanded('true')">전체 펼치기</button>
                    <button class="btn btn-small btn-gray" @click="changeExpanded('false')">전체 접기</button>
                    <button class="btn btn-small btn-darkblue" @click="modal.status = true;"><img :src="jl.root + 'img/common/excel_blue.svg'"> 가져오기</button>
                    <button class="btn btn-small btn-line"  @click="downExcel()"><img :src="jl.root + 'img/common/excel_green.svg'"> 내보내기</button>
                </div>
            </div>

            <div class="flex">
                <button class="view-btn btn" :class="{active : tab == 'day'}"  @click="tab = 'day'">일별</button>
                <button class="view-btn btn" :class="{active : tab == 'week'}"  @click="tab = 'week'">주별</button>
            </div>

            <div class="grid grid2" v-if="schedules.length > 0">
                <schedule-list :blocks="blocks"></schedule-list>

                <section class="calendar">
                    <schedule-calendar-day v-if="tab == 'day'" :blocks="blocks" :start_date="project_start_date" :end_date="project_end_date"></schedule-calendar-day>
                    <schedule-calendar-week v-if="tab == 'week'" :blocks="blocks" :start_date="project_start_date" :end_date="project_end_date"></schedule-calendar-week>
                </section>
            </div>

            <div class="grid grid2" v-else>
                스케쥴 데이터가 없습니다.
            </div>
        </div>

        <schedule-excel :modal="modal" :project_idx="project_idx"></schedule-excel>
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
                    schedules : [],
                    blocks : [],

                    tab : "day",

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

                        order_by : [
                            {column : "priority" , type : "DESC"},
                            {column : "idx" , type : "ASC"},
                        ],

                        get_info : {
                            add_object : [
                                {name : "expanded", value : "true"},
                            ]
                        },

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
                                get_info : {
                                    add_object : [
                                        {name : "expanded", value : "true"},
                                    ]
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
                                        get_info : {
                                            add_object : [
                                                {name : "expanded", value : "true"},
                                            ]
                                        },

                                        relations : [
                                            // 작업 데이터 구하는
                                            {
                                                table : "project_schedule" ,
                                                foreign : "area_idx",
                                                type : "data", // type(count,data)
                                                as : "schedule",
                                            },

                                            // 작업 기간 구하는
                                            {
                                                table : "project_schedule" ,
                                                foreign : "area_idx",
                                                type : "data", // type(count,data)
                                                as : "minmax",
                                                get_info : {
                                                    min : [
                                                        {
                                                            column : "start_date",
                                                            as : "min_date",
                                                        }
                                                    ],
                                                    max : [
                                                        {
                                                            column : "end_date",
                                                            as : "max_date",
                                                        }
                                                    ],
                                                },
                                            },
                                        ],
                                    },

                                    // 작업 데이터 구하는
                                    {
                                        table : "project_schedule" ,
                                        foreign : "floor_idx",
                                        type : "data", // type(count,data)
                                        as : "schedule",
                                    },

                                    // 작업 기간 구하는
                                    {
                                        table : "project_schedule" ,
                                        foreign : "floor_idx",
                                        type : "data", // type(count,data)
                                        as : "minmax",
                                        get_info : {
                                            min : [
                                                {
                                                    column : "start_date",
                                                    as : "min_date",
                                                }
                                            ],
                                            max : [
                                                {
                                                    column : "end_date",
                                                    as : "max_date",
                                                }
                                            ],
                                        },
                                    },
                                ],
                            },

                            // 작업 데이터 구하는
                            {
                                table : "project_schedule" ,
                                foreign : "block_idx",
                                type : "data", // type(count,data)
                                as : "schedule",
                            },

                            // 작업 기간 구하는
                            {
                                table : "project_schedule" ,
                                foreign : "block_idx",
                                type : "data", // type(count,data)
                                as : "minmax",
                                get_info : {
                                    min : [
                                        {
                                            column : "start_date",
                                            as : "min_date",
                                        }
                                    ],
                                    max : [
                                        {
                                            column : "end_date",
                                            as : "max_date",
                                        }
                                    ],
                                },
                            },

                        ],
                    },

                    modal : {
                        status : false,
                        load : false,
                        primary : "",
                        data : {},
                        class_1 : "",
                        class_2 : "",
                    },

                    project_start_date : "",
                    project_end_date : "",

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
                await this.jl.getsData(this.filter,this.blocks);
                await this.jl.getsData({
                    table : "project_schedule",
                    project_idx : this.project_idx,
                    get_info : {
                        min : [
                            {
                                column : "start_date",
                                as : "min_start_date",
                            }
                        ],
                        max : [
                            {
                                column : "end_date",
                                as : "max_end_date",
                            }
                        ],
                    },
                },this.schedules);

                if(this.schedules.length > 0) {
                    this.project_start_date = this.schedules[0]['min_start_date'];
                    this.project_end_date = this.schedules[0]['max_end_date'];
                }

                this.load = true;

                this.$nextTick(() => {

                });
            },
            updated() {

            },
            methods: {
                async changeExpanded(bool) {
                    this.filter.get_info.add_object[0].value = bool;
                    this.filter.relations[0].get_info.add_object[0].value = bool;
                    this.filter.relations[0].relations[0].get_info.add_object[0].value = bool;

                    await this.jl.getsData(this.filter,this.blocks);
                },
                async downExcel() {
                    let filter = {
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
                    };

                    let options = {
                        method : "excel_down",
                        download : "계획공정표 내보내기",
                        url : "api/project_schedule"
                    };

                    await this.jl.apiDownload(filter,options);

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