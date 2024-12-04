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

        <template v-for="category_a,index in category_a">
            <div class="section_title" @click="category_a.visible = !category_a.visible">
                <i class="fa-solid fa-caret-down" :class="{'fa-caret-right' : !category_a.visible}"></i> {{category_a.category_a}}
            </div>
            <!-- group_a 반복 -->
            <div class="section_content" v-show="category_a.visible" v-for="group_a,index2 in category_a.group_a">
                <div class="task_content_dl">
                    <div class="zone_title" @click="group_a.visible = !group_a.visible">
                        <i class="fa-solid fa-caret-down" :class="{'fa-caret-right' : !group_a.visible}"></i> {{group_a.group_a}}
                    </div>
                    <dl class="dropdown_dl">
                        <!-- group_b 반복 -->
                        <div class="section_content" v-show="group_a.visible" v-for="group_b,index3 in group_a.group_b">
                            <div class="task_content_dl">
                                <div class="zone_title" @click="group_b.visible = !group_b.visible">
                                    <i class="fa-solid fa-caret-down" :class="{'fa-caret-right' : !group_b.visible}"></i> {{group_b.group_b}}
                                </div>
                                <dl class="dropdown_dl">

                                    <!-- group_c 반복 -->
                                    <div class="section_content" v-show="group_b.visible" v-for="group_c,index4 in group_b.group_c">
                                        <div class="task_content_dl">
                                            <div class="zone_title" @click="group_c.visible = !group_c.visible">
                                                <i class="fa-solid fa-caret-down" :class="{'fa-caret-right' : !group_c.visible}"></i> {{group_c.group_c}}
                                            </div>
                                            <dl class="dropdown_dl">

                                                <!-- category_b 반복 -->
                                                <div class="section_content" v-show="group_c.visible" v-for="category_b,index5 in group_c.category_b">
                                                    <div class="task_content_dl" @click="category_b.visible = !category_b.visible">
                                                        <div class="zone_title">
                                                            <i class="fa-solid fa-caret-down" :class="{'fa-caret-right' : !category_b.visible}"></i> {{category_b.category_b}}
                                                        </div>
                                                        <dl class="dropdown_dl">

                                                            <!-- data 반복 -->
                                                            <div class="section_content" v-show="category_b.visible">
                                                                <div class="task_content_dl">
                                                                    <div class="zone_title">
                                                                    </div>
                                                                    <dl class="dropdown_dl">

                                                                        <dd class="colgroup"  v-for="item,index4 in category_b.data">
                                                                            <div class="border task_item">  {{item.content}}</div>
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

                                                        </dl>
                                                    </div>
                                                </div>

                                            </dl>
                                        </div>
                                    </div>

                                </dl>
                            </div>
                        </div>

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

                category_a : [],
                groups : [],

                visibleContents : [],
                visibleContents2 : [],
                visibleContents3 : [],
                visibleContents4 : [],


                manager_modal : false,
                manager_idx : "",
            };
        },
        created: function(){
            this.jl = new Jl('<?=$componentName?>');
            this.component_idx = this.jl.generateUniqueId();

            this.getCategoryA();
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
            async getCategoryA() {
                try {
                    let filter = {
                        project_idx : this.project.idx,
                        column : "category_a",
                        order_by_asc: "category_a",
                    }
                    let res = await this.jl.ajax("group_category",filter,"/api/project_schedule");
                    //
                    //for (let i = 0; i < categoriesA.length; i++) {
                    //    categoriesA[i]['groupA'] = await this.getGroupA(categoriesA[i])
                    //}
                    //
                    //console.log(categoriesA);
                    //
                    this.category_a = res.data
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