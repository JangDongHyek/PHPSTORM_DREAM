<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div>
        <div class="flex ai-c jc-sb">
            <div class="area_filter">
                <input type="search" name="stx" placeholder="검색어 입력" value=""><button type="submit" class="btn_search"><i class="fa-regular fa-magnifying-glass"></i></button>
            </div>
            <div class="btn_wrap">
                <button class="btn btn_small btn_blueline" data-toggle="modal" data-target="#sectionModal">작업구역관리</button>
                <button class="btn btn_small btn_darkblue" @click="modal = true;"><img src="<?=base_url()?>img/common/excel_blue.svg"> 가져오기</button>
                <button class="btn btn_small btn_line"><img src="<?=base_url()?>img/common/excel_green.svg"> 내보내기</button>
            </div>
        </div>
        <div class="grid grid2">
            <schedule-list :project="project" :schedule="schedule"></schedule-list>

            <schedule-calendar :project="project" :schedule="schedule"></schedule-calendar>

        </div>

        <schedule-excel-modal :modal="modal" @close="modal = false;" :project_idx="project_idx"></schedule-excel-modal>
    </div>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            project_idx : {type : String, default : ""},
        },
        data: function(){
            return {
                jl : null,
                component_idx : "",
                filter : {
                    idx : this.project_idx
                },
                required : [
                    {name : "",message : ""},
                ],
                project : {},
                schedule : [],

                modal : false,
            };
        },
        created: function(){
            this.jl = new Jl('<?=$componentName?>');
            this.component_idx = this.jl.generateUniqueId();

            this.getProject();
            this.getSchedule();
        },
        mounted: function(){
            this.$nextTick(() => {

            });
        },
        methods: {
            async getSchedule() {
                try {
                    let filter = {
                        project_idx : this.project_idx,
                        order_by_asc : "schedule_start_date"
                    }
                    let res = await this.jl.ajax("get",filter,"/api/project_schedule");
                    this.schedule = res.data
                }catch (e) {
                    alert(e.message)
                }
            },
            async getProject() {
                try {
                    let res = await this.jl.ajax("get",this.filter,"/api/project_base");
                    this.project = res.data[0];
                }catch (e) {
                    alert(e.message)
                }
            }
        },
        computed: {

        },
        watch : {

        }
    });
</script>

<style>

</style>