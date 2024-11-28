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
                <i class="fa-solid fa-caret-down"></i> {{category.category_a}}
            </div>
            <div class="section_content" v-show="visibleContents[index]" v-for="group in groups">
                <div class="task_content_dl">
                    <div class="zone_title">
                        {{group.group_a}} [{{group.group_b}}] {{group.group_c}}
                    </div>
                    <dl class="dropdown_dl">
                        <dt class="colgroup">
                            <div class="border task_title"><i class="fa-light fa-angle-down"></i> 거푸집</div>
                            <div class="border"><input class="inputPm" type="text" name="" id="" placeholder="담당자 지정" value="김설주" data-toggle="modal" data-target="#pmSearchModal"/></div>
                            <div class="border">
                                <select class="statusSelect blue">
                                    <option value="gray">예정</option>
                                    <option value="green">진행</option>
                                    <option value="blue" selected>완료</option>
                                    <option value="black">보류</option>
                                </select>
                            </div>
                            <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                            <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                            <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                            <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                        </dt>
                        <dd class="colgroup">
                            <div class="border task_item">현장 준비 및 기초 작업</div>
                            <div class="border"></div>
                            <div class="border">
                                <select class="statusSelect">
                                    <option value="gray">예정</option>
                                    <option value="green">진행</option>
                                    <option value="blue" selected>완료</option>
                                    <option value="black">보류</option>
                                </select>
                            </div>
                            <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                            <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                            <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                            <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                        </dd>
                        <dd class="colgroup">
                            <div class="border task_item">거푸집 설치 및 보강</div>
                            <div class="border"></div>
                            <div class="border">
                                <select class="statusSelect">
                                    <option value="gray">예정</option>
                                    <option value="green">진행</option>
                                    <option value="blue" selected>완료</option>
                                    <option value="black">보류</option>
                                </select>
                            </div>
                            <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                            <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                            <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                            <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                        </dd>
                        <dd class="colgroup">
                            <div class="border task_item">관통부 및 매립물 설치</div>
                            <div class="border"></div>
                            <div class="border">
                                <select class="statusSelect">
                                    <option value="gray">예정</option>
                                    <option value="green">진행</option>
                                    <option value="blue" selected>완료</option>
                                    <option value="black">보류</option>
                                </select>
                            </div>
                            <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                            <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                            <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                            <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                        </dd>
                    </dl>
                    <dl class="dropdown_dl">
                        <dt class="colgroup">
                            <div class="border task_title"><i class="fa-light fa-angle-down"></i> 철근</div>
                            <div class="border"><input class="inputPm" type="text" name="" id="" placeholder="담당자 지정" value="조민석" data-toggle="modal" data-target="#pmSearchModal"/></div>
                            <div class="border">
                                <select class="statusSelect">
                                    <option value="gray">예정</option>
                                    <option value="green" selected>진행</option>
                                    <option value="blue">완료</option>
                                    <option value="black">보류</option>
                                </select>
                            </div>
                            <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                            <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                            <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                            <div class="border"><input type="text" class="datePicker" name="" id="" value="" placeholder="-"/></div>
                        </dt>
                        <dd class="colgroup">
                            <div class="border task_item">철근 배치 및 체크</div>
                            <div class="border"></div>
                            <div class="border">
                                <select class="statusSelect">
                                    <option value="gray">예정</option>
                                    <option value="green" selected>진행</option>
                                    <option value="blue">완료</option>
                                    <option value="black">보류</option>
                                </select>
                            </div>
                            <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                            <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                            <div class="border"><input type="text" class="datePicker" name="" id="" value="" placeholder="-"/></div>
                            <div class="border"><input type="text" class="datePicker" name="" id="" value="" placeholder="-"/></div>
                        </dd>
                        <dd class="colgroup">
                            <div class="border task_item">철근 연결 및 보강</div>
                            <div class="border"></div>
                            <div class="border">
                                <select class="statusSelect">
                                    <option value="gray" selected>예정</option>
                                    <option value="green">진행</option>
                                    <option value="blue">완료</option>
                                    <option value="black">보류</option>
                                </select>
                            </div>
                            <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                            <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                            <div class="border"><input type="text" class="datePicker" name="" id="" value="" placeholder="-"/></div>
                            <div class="border"><input type="text" class="datePicker" name="" id="" value="" placeholder="-"/></div>
                        </dd>
                        <dd class="colgroup">
                            <div class="border task_item">철근 검수 및 조정</div>
                            <div class="border"></div>
                            <div class="border">
                                <select class="statusSelect">
                                    <option value="gray" selected>예정</option>
                                    <option value="green">진행</option>
                                    <option value="blue">완료</option>
                                    <option value="black">보류</option>
                                </select>
                            </div>
                            <div class="border"><input type="text" class="datePicker" name="" id="" value="" placeholder="-"/></div>
                            <div class="border"><input type="text" class="datePicker" name="" id="" value="" placeholder="-"/></div>
                            <div class="border"><input type="text" class="datePicker" name="" id="" value="" placeholder="-"/></div>
                            <div class="border"><input type="text" class="datePicker" name="" id="" value="" placeholder="-"/></div>
                        </dd>
                    </dl>
                    <dl class="dropdown_dl">
                        <dt class="colgroup">
                            <div class="border task_title"><i class="fa-light fa-angle-right"></i> 레미콘</div>
                            <div class="border"><input class="inputPm" type="text" name="" id="" placeholder="담당자 지정" value="" data-toggle="modal" data-target="#pmSearchModal"/></div>
                            <div class="border">
                                <select class="statusSelect">
                                    <option value="gray">예정</option>
                                    <option value="green">진행</option>
                                    <option value="blue">완료</option>
                                    <option value="black" selected>보류</option>
                                </select>
                            </div>
                            <div class="border"><input type="text" class="datePicker" name="" id="" value="" placeholder="-"/></div>
                            <div class="border"><input type="text" class="datePicker" name="" id="" value="" placeholder="-"/></div>
                            <div class="border"><input type="text" class="datePicker" name="" id="" value="" placeholder="-"/></div>
                            <div class="border"><input type="text" class="datePicker" name="" id="" value="" placeholder="-"/></div>
                        </dt>
                    </dl>
                </div>
            </div>
        </template>

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

                visibleContents : []
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