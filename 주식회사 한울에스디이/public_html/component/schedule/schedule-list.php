<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <section class="schedule_task">
        <div class="task_header colgroup">
            <div class="border">공종명 및 상세</div>
            <div class="border">담당자</div>
            <div class="border">상태</div>
            <div class="border">시작예정일</div>
            <div class="border">마감예정일</div>
            <div class="border">시작일</div>
            <div class="border">마감일</div>
        </div>
        <template v-for="category,index in categoriesA">
            <div class="section_title" @click="toggleContent(index)">
                <i class="fa-solid fa-caret-down" :class="{'fa-caret-right' : !visibleContents[index]}"></i> {{category.category_a}}
            </div>
            <div class="section_content" v-show="visibleContents[index]" v-for="group,index2 in groups">
                <div class="task_content_dl">
                    <div class="zone_title" @click="toggleContent2(index2)">
                        <i class="fa-solid fa-caret-down" :class="{'fa-caret-right' : !visibleContents2[index2]}"></i> {{group.group_a}} [{{group.group_b}}] {{group.group_c}}
                    </div>
                    <dl class="dropdown_dl" v-show="visibleContents2[index2]">
                        <!--<dt class="colgroup">-->
                        <!--    <div class="border task_title"><i class="fa-light fa-angle-down"></i> 거푸집</div>-->
                        <!--    <div class="border"><input class="inputPm" type="text" name="" id="" placeholder="담당자 지정" value="김설주" data-toggle="modal" data-target="#pmSearchModal"/></div>-->
                        <!--    <div class="border">-->
                        <!--        <select class="statusSelect blue">-->
                        <!--            <option value="gray">예정</option>-->
                        <!--            <option value="green">진행</option>-->
                        <!--            <option value="blue" selected>완료</option>-->
                        <!--            <option value="black">보류</option>-->
                        <!--        </select>-->
                        <!--    </div>-->
                        <!--    <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>-->
                        <!--    <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>-->
                        <!--    <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>-->
                        <!--    <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>-->
                        <!--</dt>-->
                        <dd class="colgroup" v-for="item in schedule" v-if="checkGroup(group,item)">
                            <div class="border task_item"><span style="font-weight: bold; font-size: 15px;">{{item.category_b}}</span>  {{item.content}}</div>
                            <div class="border flex ai-c jc-c">
                                <template v-if="item.user_idx">
                                    <button class="btn_none" @click="manager_modal = true; manager_idx = item.idx">{{item.$user.company_person}}</button>
                                </template>

                                <template v-else>
                                    <button class="btn btn_mini btn_black" @click="manager_modal = true; manager_idx = item.idx">지정</button>
                                </template>
                                
                            </div>
                            <div class="border">
                                <select class="statusSelect" :class="getClass(item)" v-model="item.status" @change="updateData(item)">
                                    <option value="">예정</option>
                                    <option value="진행">진행</option>
                                    <option value="완료">완료</option>
                                    <option value="보류">보류</option>
                                </select>
                            </div>
                            <div class="border"><input type="date" class="datePicker" v-model="item.schedule_start_date"/></div>
                            <div class="border"><input type="date" class="datePicker" v-model="item.schedule_end_date"/></div>
                            <div class="border"><input type="date" class="datePicker" v-model="item.start_date" @change="updateData(item)"/></div>
                            <div class="border"><input type="date" class="datePicker" v-model="item.end_date"/></div>
                        </dd>
                    </dl>
                </div>
            </div>
        </template>

        <schedule-manager :modal="manager_modal" :project="project" @designate="designate" @close="manager_modal = false;"></schedule-manager>
    </section>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            project : { type : Object, default : {} },
            schedule : { type : Array, default : [] },
        },
        data: function(){
            return {
                jl : null,
                component_idx : "",
                filter : {
                    page : 1,
                    limit : 1,
                    count : 0,
                    order_by_desc : "insert_date",
                },

                data : [],
                modal : false,

                categoriesA : [],
                groups : [],

                visibleContents : [],
                visibleContents2 : [],

                manager_modal : false,
                manager_idx : "",
            };
        },
        created: function(){
            this.jl = new Jl('<?=$componentName?>');
            this.component_idx = this.jl.generateUniqueId();

            this.getCategoryA();
            this.getGroup();
        },
        mounted: function(){
            this.$nextTick(() => {

            });
        },
        methods: {
            async updateData(data) {
                try {
                    let res = await this.jl.ajax("update",data,"/api/project_schedule");
                    this.$emit('updateSchedule');

                }catch (e) {
                    alert(e.message)
                }
            },
            designate(user) {
                let data = {
                    idx : this.manager_idx,
                    user_idx : user.idx
                }

                this.updateData(data);
                this.manager_modal = false;
            },
            getClass(item) {
                if(item.status == '') return 'gray'
                if(item.status == '진행') return 'green'
                if(item.status == '완료') return 'blue'
                if(item.status == '보류') return 'black'
            },
            checkGroup(group,item) {
                if(group.group_a == item.group_a && group.group_b == item.group_b && group.group_c == item.group_c) return true
                return false;
            },
            toggleContent2(index) {
                // 클릭한 항목의 가시성 상태를 토글
                this.$set(this.visibleContents2, index, !this.visibleContents2[index]);
            },
            toggleContent(index) {
                // 클릭한 항목의 가시성 상태를 토글
                this.$set(this.visibleContents, index, !this.visibleContents[index]);
            },
            async getGroup() {
                try {
                    let filter = {
                        project_idx : this.project.idx,
                        column : ["group_a","group_b","group_c"],
                        order_by_asc: "group_a",
                    }
                    let res = await this.jl.ajax("distinct",filter,"/api/project_schedule");
                    this.groups = res.data

                    this.visibleContents2 = this.groups.map(() => true);
                }catch (e) {
                    alert(e.message)
                }
            },
            async getCategoryA() {
                try {
                    let filter = {
                        project_idx : this.project.idx,
                        column : "category_a",
                        order_by_asc: "category_a",
                    }
                    let res = await this.jl.ajax("distinct",filter,"/api/project_schedule");
                    this.categoriesA = res.data

                    this.visibleContents = this.categoriesA.map(() => true);
                }catch (e) {
                    alert(e.message)
                }
            },
            changePage(page) {
                this.filter.page = page;

                this.getData();
            },
        },
        computed: {

        },
        watch : {

        }
    });
</script>

<style>

</style>