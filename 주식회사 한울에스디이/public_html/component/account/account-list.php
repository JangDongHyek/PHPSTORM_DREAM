<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div>
        <div class="area_filter flex ai-c jc-sb">
            <div class="flex ai-c">
                <strong class="total">총 {{filter.count}}건</strong>
                <div class="search">
                    <select v-model="filter.like_key">
                        <option value="company_name">소속사명</option>
                        <option value="company_person">이름</option>
                        <option value="user_id">아이디</option>
                        <option value="company_person_phone">연락처</option>
                    </select>
                    <input type="search" v-model="filter.like_value" placeholder="검색어 입력" value="" @keyup.enter="filter.page = 1; getData();">
                    <button type="submit" class="btn_search" @click="filter.page = 1; getData();"><i class="fa-regular fa-magnifying-glass"></i></button>
                </div>
            </div>
            <button type="button" class="btn btn_darkblue" @click="modal = true">계정 등록</button>
        </div>
        <div class="table">
            <table>
                <colgroup>
                    <col width="20px">
                    <col width="auto">
                    <col width="auto">
                    <col width="auto">
                    <col width="auto">
                    <col width="auto">
                    <col width="auto">
                    <col width="auto">
                    <col width="auto">
                </colgroup>
                <thead>
                <tr>
                    <th></th>
                    <th>소속사명</th>
                    <th>아이디</th>
                    <th class="text-center">이름</th>
                    <th class="text-center">연락처</th>
                    <th class="text-center">담당</th>
                    <th class="text-center">비고</th>
                    <th class="text-center">등록일</th>
                    <th class="text-center">관리</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="item in data">
                    <th class="text-center">{{item.jl_no_reverse}}</th>
                    <th>{{item.company_name}}</th>
                    <td>{{item.user_id}}</td>
                    <td class="text-center">{{item.company_person}}</td>
                    <td class="text-center">{{item.company_person_phone}}</td>
                    <td class="text-center">개발예정</td>
                    <td class="text-center">{{item.notes}}</td>
                    <td class="text-center">{{item.insert_date.split(' ')[0]}}</td>
                    <td class="text-center"><button class="btn btn_mini btn_black" @click="primary = item.idx; modal = true;">수정</button></td>
                </tr>
                </tbody>
            </table>
        </div>

        <pagination-component :filter="filter" @change="changePage"></pagination-component>

        <account-input :modal="modal" @close="modal = false; primary = ''" :project_idx="project_idx" :primary="primary"></account-input>
    </div>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            project_idx : {type : String, default : ""},
            primary : {type : String, default : ""}
        },
        data: function(){
            return {
                jl : null,
                component_idx : "",
                filter : {
                    project : this.project_idx,
                    page : 1,
                    limit : 10,
                    count : 0,
                    order_by_desc : "insert_date",

                    like_key : "company_name",
                    like_value : "",
                },
                required : [
                    {name : "",message : ""},
                ],
                data : {},
                modal : false,
            };
        },
        created: function(){
            this.jl = new Jl('<?=$componentName?>');
            this.component_idx = this.jl.generateUniqueId();

            this.getData();
        },
        mounted: function(){
            this.$nextTick(() => {

            });
        },
        methods: {
            changePage(page) {
                this.filter.page = page;

                this.getData();
            },
            async getData() {
                try {
                    let res = await this.jl.ajax("get",this.filter,"/api/user");
                    this.data = res.data
                    this.filter.count = res.count;
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