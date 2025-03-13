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
                            <option value="standard">규격</option>
                        </select>
                        <input type="search" placeholder="검색어 입력" v-model="filter.like[0].value" @keyup.enter="jl.getsData(this.filter,this.rows,{search:true});">
                        <button type="button" class="btn-search" @click="jl.getsData(this.filter,this.rows,{search:true});"><i class="fa-regular fa-magnifying-glass"></i></button>
                    </div>
                </div>
                <button class="btn btn-line male-auto" @click="excel_modal.status = true;"><img :src="jl.root + 'img/common/excel_green.svg'"> 업로드</button>
                <button type="button" class="btn btn-darkblue" @click="input_modal.primary = ''; input_modal.status = true;">단가 추가</button>
                <button type="button" class="btn btn-blue" @click="option_modal.status = true;">옵션 단가 설정</button>
            </div>
            <div class="table">
                <table>
                    <colgroup>
                        <col width="75px">
                        <col width="auto">
                        <col width="auto">
                        <col width="auto">
                        <col width="auto">
                        <col width="auto">
                        <col width="auto">
                        <col width="auto">
                        <col width="140px">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>NO.</th>
                        <th>카테고리</th>
                        <th>품명</th>
                        <th>규격</th>
                        <th>재료비</th>
                        <th>노무비</th>
                        <th>경비</th>
                        <th>합계</th>
                        <th>관리</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="item in rows">
                        <th>{{item.jl_no}}</th>
                        <th>{{item.category}}</th>
                        <td>
                            <select class="optionSelect" :class="{'green' : item.types == '옵션'}" v-model="item.types" @change="changeType($event,item)">
                                <option value="단가">단가</option>
                                <option value="옵션">옵션</option>
                            </select>
                            {{item.name}}</td>
                        <td>{{item.standard}}</td>
                        <td class="text-right">{{ getMaterial(item).format()}}</td>
                        <td class="text-right">{{ getLabour(item).format()}}</td>
                        <td class="text-right">{{ getExpense(item).format()}}</td>
                        <td class="text-right">{{ getTotal(item).format() }}</td>
                        <td class="text-center">
                            <button class="btn btn-mini btn-black" @click="openModal(item)">수정</button>
                            <button class="btn btn-mini btn-line" @click="jl.deleteData(item,options)">삭제</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <item-paging :filter="filter" @change="jl.getsData(filter,rows);"></item-paging>
        </section>

        <cost-price-input :modal="input_modal" :project_idx="project_idx"></cost-price-input>
        <cost-price-option :modal="option_modal" :project_idx="project_idx"></cost-price-option>
        <cost-price-excel :modal="excel_modal" :project_idx="project_idx"></cost-price-excel>
    </div>
</script>

<script>
    Jl_components.push({name : "<?=$componentName?>",object : {
            template: "#<?=$componentName?>-template",
            props: {
                primary : {type: String, default: ""},
                project_idx : {type: String, default: ""},
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
                    all_rows : [],

                    options : {
                        table : "project_price",
                        file_use : false,
                        required : [
                            {name : "",message : ``},
                        ],
                        href : "",
                    },

                    filter : {
                        table : "project_price",
                        project_idx : this.project_idx,
                        name : "",
                        page: 1,
                        limit: 10,
                        count: 0,

                        like : [
                            {
                                key : "name",
                                value : "",
                            }
                        ],
                    },

                    excel_modal : {
                        status : false,
                        load : false,
                        data : {},
                        primary : "",
                        class_1 : "",
                        class_2 : "",
                    },

                    input_modal : {
                        status : false,
                        load : false,
                        data : {},
                        primary : "",
                        class_1 : "",
                        class_2 : "",
                    },

                    option_modal : {
                        status : false,
                        load : false,
                        data : {},
                        primary : "",
                        class_1 : "",
                        class_2 : "modal-wide",
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
                await this.jl.getsData(this.filter,this.rows);
                await this.jl.getsData({
                    table : "project_price",
                    project_idx : this.project_idx,
                    types : "단가"
                },this.all_rows);

                this.load = true;

                this.$nextTick(() => {

                });
            },
            updated() {

            },
            methods: {
                openModal(item) {
                    if(item.types == '단가') {
                        this.input_modal.primary = item.primary;
                        this.input_modal.status = true;
                    }else {
                        this.option_modal.primary = item.primary;
                        this.option_modal.status = true;
                    }

                },
                getMaterial(item) {
                    if(item.types == '단가') return item.material;
                    let price = 0;

                    for (const content of item.contents) {
                        let content_row = this.jl.findObject(this.all_rows,"idx",content.price_idx);
                        price += content_row.material;
                    }

                    return price
                },
                getLabour(item) {
                    if(item.types == '단가') return item.labour;
                    let price = 0;

                    for (const content of item.contents) {
                        let content_row = this.jl.findObject(this.all_rows,"idx",content.price_idx);
                        price += content_row.labour;
                    }

                    return price
                },
                getExpense(item) {
                    if(item.types == '단가') return item.expense;
                    let price = 0;

                    for (const content of item.contents) {
                        let content_row = this.jl.findObject(this.all_rows,"idx",content.price_idx);
                        price += content_row.expense;
                    }

                    return price
                },
                getTotal(item) {
                    if(item.types == '단가') return (item.material + item.labour + item.expense);

                    let material = this.getMaterial(item);
                    let labour = this.getLabour(item);
                    let expense = this.getExpense(item);

                    return (material + labour + expense)
                },
                async changeType(event,item) {
                    item.types = event.target.value;
                    await this.jl.postData(item,{
                        table:'project_price',
                        return : true, // 해당값이 true이면 ajax만 날리고 바로 리턴
                    })
                }
            },
            computed: {

            },
            watch: {
                async "input_modal.status"(value,old_value) {
                    if(value) {
                        this.input_modal.load = true;
                    }else {
                        this.input_modal.load = false;
                        this.input_modal.data = {};
                    }
                },

                async "option_modal.status"(value,old_value) {
                    if(value) {
                        this.option_modal.load = true;
                    }else {
                        this.option_modal.load = false;
                        this.option_modal.data = {};
                    }
                }
            }
        }});

</script>

<style>

</style>