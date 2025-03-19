<?php
$componentName = str_replace(".php","",basename(__FILE__));
$pathParts = explode(DIRECTORY_SEPARATOR, dirname(__FILE__));
$context_name = end($pathParts);
?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div v-if="load">
        <div id="weekly-schedule" class="schedule-wrapper">
            <div id="weekly-month-header" class="month-header"><div class="month-label" style="width: 400px;">2025년 3월</div><div class="month-label" style="width: 400px;">2025년 4월</div></div>
            <div id="weekly-weeks" class="schedule"><div class="schedule-row"><div class="week" style="width: 80px;">1주차</div><div class="week" style="width: 80px;">2주차</div><div class="week today" style="width: 80px;">3주차<div class="today-line"></div><div class="today-line"></div></div><div class="week" style="width: 80px;">4주차</div><div class="week" style="width: 80px;">5주차</div><div class="week" style="width: 80px;">1주차</div><div class="week" style="width: 80px;">2주차</div><div class="week" style="width: 80px;">3주차</div><div class="week" style="width: 80px;">4주차</div><div class="week" style="width: 80px;">5주차</div></div><div class="schedule-row"><div class="week" style="width: 80px;"><div class="task zone-title" style="width: 700px;">101동</div></div><div class="week" style="width: 80px;"></div><div class="week" style="width: 80px;"><div class="today-line"></div></div><div class="week" style="width: 80px;"></div><div class="week" style="width: 80px;"></div><div class="week" style="width: 80px;"></div><div class="week" style="width: 80px;"></div><div class="week" style="width: 80px;"></div><div class="week" style="width: 80px;"></div><div class="week" style="width: 80px;"></div></div><div class="schedule-row"><div class="week" style="width: 80px;"><div class="task zone-sub" style="width: 220px;">1층</div></div><div class="week" style="width: 80px;"></div><div class="week" style="width: 80px;"><div class="today-line"></div></div><div class="week" style="width: 80px;"></div><div class="week" style="width: 80px;"></div><div class="week" style="width: 80px;"></div><div class="week" style="width: 80px;"></div><div class="week" style="width: 80px;"></div><div class="week" style="width: 80px;"></div><div class="week" style="width: 80px;"></div></div><div class="schedule-row"><div class="week" style="width: 80px;"><div class="task red" style="width: 140px;">A구역</div></div><div class="week" style="width: 80px;"></div><div class="week" style="width: 80px;"><div class="today-line"></div></div><div class="week" style="width: 80px;"></div><div class="week" style="width: 80px;"></div><div class="week" style="width: 80px;"></div><div class="week" style="width: 80px;"></div><div class="week" style="width: 80px;"></div><div class="week" style="width: 80px;"></div><div class="week" style="width: 80px;"></div></div><div class="schedule-row"><div class="week" style="width: 80px;"></div><div class="week" style="width: 80px;"><div class="task blue" style="width: 140px;">B구역</div></div><div class="week" style="width: 80px;"><div class="today-line"></div></div><div class="week" style="width: 80px;"></div><div class="week" style="width: 80px;"></div><div class="week" style="width: 80px;"></div><div class="week" style="width: 80px;"></div><div class="week" style="width: 80px;"></div><div class="week" style="width: 80px;"></div><div class="week" style="width: 80px;"></div></div><div class="schedule-row"><div class="week" style="width: 80px;"></div><div class="week" style="width: 80px;"></div><div class="week" style="width: 80px;"><div class="task zone-sub" style="width: 540px;">2층</div><div class="today-line"></div></div><div class="week" style="width: 80px;"></div><div class="week" style="width: 80px;"></div><div class="week" style="width: 80px;"></div><div class="week" style="width: 80px;"></div><div class="week" style="width: 80px;"></div><div class="week" style="width: 80px;"></div><div class="week" style="width: 80px;"></div></div><div class="schedule-row"><div class="week" style="width: 80px;"></div><div class="week" style="width: 80px;"></div><div class="week" style="width: 80px;"><div class="task green" style="width: 380px;">A구역</div><div class="today-line"></div></div><div class="week" style="width: 80px;"></div><div class="week" style="width: 80px;"></div><div class="week" style="width: 80px;"></div><div class="week" style="width: 80px;"></div><div class="week" style="width: 80px;"></div><div class="week" style="width: 80px;"></div><div class="week" style="width: 80px;"></div></div><div class="schedule-row"><div class="week" style="width: 80px;"></div><div class="week" style="width: 80px;"></div><div class="week" style="width: 80px;"><div class="today-line"></div></div><div class="week" style="width: 80px;"></div><div class="week" style="width: 80px;"></div><div class="week" style="width: 80px;"></div><div class="week" style="width: 80px;"><div class="task gray" style="width: 220px;">B구역</div></div><div class="week" style="width: 80px;"></div><div class="week" style="width: 80px;"></div><div class="week" style="width: 80px;"></div></div></div>
        </div>
    </div>
</script>

<script>
    Jl_components.push({name : "<?=$componentName?>",object : {
            template: "#<?=$componentName?>-template",
            props: {
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