<?php
$componentName = str_replace(".php","",basename(__FILE__));
$pathParts = explode(DIRECTORY_SEPARATOR, dirname(__FILE__));
$context_name = end($pathParts);
?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div v-if="load">
        <section class="list_table">
            <div class="area_filter flex ai-c gap5">
                <div class="flex ai-c">
                    <strong class="total">총 {{filter.count}}건</strong>
                    <div class="search">
                        <select v-model="filter.like[0].key">
                            <option value="name">품명</option>
                            <option value="category">카테고리</option>
                        </select>
                        <input type="search" placeholder="검색어 입력" v-model="filter.like[0].value" @keyup.enter="jl.getsData(this.filter,this.rows,{search : true});">
                        <button type="button" class="btn-search" @click="jl.getsData(this.filter,this.rows,{search : true});"><i class="fa-regular fa-magnifying-glass"></i></button>
                    </div>
                </div>
                <button class="btn btn-line male-auto" @click="excel_modal.status = true;"><img :src="jl.root + 'img/common/excel_green.svg'"> 업로드</button>
                <button type="button" class="btn btn-darkblue" @click="modal.primary = ''; modal.status = true;">항목 추가</button>
            </div>
            <div class="table">
                <table>
                    <colgroup>
                        <col width="75px">
                        <col width="10%">
                        <col width="10%">
                        <col width="auto">
                        <col width="80px">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>NO.</th>
                        <th>카테고리</th>
                        <th>품명</th>
                        <th>연관</th>
                        <th>관리</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="item in rows">
                        <th>{{item.jl_no}}</th>
                        <th>{{item.category}}</th>
                        <td>{{item.name}}</td>
                        <td>
                            <template v-if="item.$project_record_items.length > 0">
                                <ul class="flex flexwrap gap5">
                                    <li v-for="price in item.$project_record_items">
                                        {{price.$project_price.name}} [{{price.$project_price.standard}}]
                                        <b v-if="price.surcharge">* {{price.surcharge}}%</b>
                                    </li>
                                </ul>
                            </template>

                            <template v-else>
                                연관된 기초항목이 없습니다.
                            </template>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-mini btn-black" @click="modal.primary = item.idx; modal.status = true;">수정</button>
                            <button class="btn btn-mini btn-line" @click="jl.deleteData(item,options)">삭제</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <item-paging :filter="filter" @change="jl.getsData(filter,rows);"></item-paging>
        </section>

        <cost-record-input :modal="modal" :project_idx="project_idx"></cost-record-input>

        <cost-record-excel :modal="excel_modal" :project_idx="project_idx"></cost-record-excel>
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

                    options : {
                        table : "project_record",
                        file_use : false,
                        required : [
                            {name : "",message : ``},
                        ],
                        href : "",

                        relations : [
                            {
                                table : "project_record_items" ,
                                foreign : "record_idx",
                            },
                        ],
                    },

                    filter : {
                        table : "project_record",
                        page: 1,
                        limit: 10,
                        count: 0,

                        like : [
                            {key : "name", value : ""}
                        ],

                        relations : [
                            {
                                table : "project_record_items" ,
                                foreign : "record_idx",
                                type : "data", // type(count,data)
                                filter : {

                                },
                                extensions : [
                                    {
                                        table : "project_price",
                                        foreign : "price_idx",
                                        as : "",// as값이있다면 $테이블명이아닌 $as값으로 가져온다
                                    },
                                ],
                            },
                        ],
                    },

                    modal : {
                        status : false,
                        load : false,
                        primary : "",
                        data : {},
                        class_1 : "groupPriceModal",
                        class_2 : "modal-wide",
                    },

                    excel_modal : {
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
                //if(this.primary) this.row = await this.jl.getData(this.filter);
                await this.jl.getsData(this.filter,this.rows);

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