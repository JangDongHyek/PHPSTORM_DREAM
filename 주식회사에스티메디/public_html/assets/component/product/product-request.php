<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div>
        <div class="panel">
            <p>총 <span class="green">{{data.length}}</span>개 </p>
            <div>
                <select v-model="filter.like_key">
                    <option value="content">요청검색어</option>
                </select>
                <input class="search-bar" type="search" v-model="filter.like_value" value="" placeholder="검색어를 입력하세요" @keyup.enter="getData(); page =1;">
                <button type="submit" class="btn_search"><i class="fa-light fa-magnifying-glass"></i></button>
            </div>
        </div>

        <div class="box3">
            <div class="table adm">
                <table>
                    <colgroup>
                        <col width="20px">
                        <col width="30px">
                        <col width="auto">
                        <col width="100px">
                        <col width="200px">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>상태</th>
                        <th>요청검색어</th>
                        <th>요청일</th>
                        <th>요청자(아이디)</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="item in data">
                        <td>{{item.jl_no}}</td>
                        <td>
                            <select style="margin-bottom: 0" v-model="item.status" @change="updateData(item)">
                                <option value="">미확인</option>
                                <option value="확인">확인</option>
                                <option value="입고">입고</option>
                            </select>
                        </td>
                        <td>{{item.content}}</td>
                        <td>{{item.insert_date.split(' ')[0]}}</td>
                        <td>{{item.mb_id}}</td>
                    </tr>
                    <tr v-if="data.length == 0"><td colspan="20" class="noDataAlign">등록된 요청이 없습니다.</td></tr>
                    </tbody>
                </table>
            </div>

            <item-pagination :filter="filter" @change="changePage"></item-pagination>
        </div>
    </div>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            primary : {type : String, default : ""}
        },
        data: function(){
            return {
                jl : null,
                component_idx : "",
                filter : {
                    page : 1,
                    limit : 10,
                    count : 0,
                    order_by_desc : "insert_date",

                    like_key : "content",
                    like_value : "",
                },

                data : [],
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
            async updateData(item) {
                try {
                    let res = await this.jl.ajax("update",item,"/api/bs_product_request");
                }catch (e) {
                    alert(e.message)
                }
            },
            changePage(page) {
                this.filter.page = page;

                this.getData();
            },
            async getData() {
                try {
                    let res = await this.jl.ajax("get",this.filter,"/api/bs_product_request");
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