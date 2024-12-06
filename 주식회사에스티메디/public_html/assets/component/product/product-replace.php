<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div v-if="product_idx">
        <p class="name">대체의약품 설정</p>
        <div class="alter">
            <div class="flex">
                <select class="wfit" v-model="filter.like_key">
                    <option value="PRODUCT_NM">상품명</option>
                    <option value="PRODUCT_CD">제품코드</option>
                    <option value="CONS_CD">성분코드</option>
                    <option value="CONS_CD_SEQ">성분코드SEQ</option>
                    <option value="CONS">성분분류코드</option>
                    <option value="CONS_NM">성분분류명</option>
                </select>
                <input class="search-bar" v-model="filter.like_value" type="search" value="" placeholder="검색어를 입력하세요" @keydown.enter.prevent="page=1; getProduct();">
                <button type="button" @click="page=1; getProduct()" class="btn_search"><i class="fa-light fa-magnifying-glass"></i></button>
            </div>
            <ul class="search_result" v-if="search">
                <li class="empty" v-if="products.length == 0">
                    해당 결과가 없습니다.
                </li>
                <li v-else v-for="product in products">
                    <h6>{{product.PRODUCT_NM}} <span>{{product.MAKER_NM}}</span></h6>
                    <p>{{product.PRODUCT_CD}}</p>
                    <p>{{product.CONS_CD}}</p>
                    <p>{{product.CONS_CD_SEQ}}</p>
                    <p>{{product.CONS}}</p>
                    <p>{{product.CONS_NM}}</p>
                    <button type="button" class="btn btn_mini btn_blue" @click="postReplace(product)">선택</button>
                </li>

                <item-pagination :filter="filter" @change="changePage"></item-pagination>
            </ul>
            <div class="table">
                <table>
                    <colgroup>
                        <col style="width: 100px">
                        <col style="width: auto">
                        <col style="width: auto">
                        <col style="width: auto">
                        <col style="width: auto">
                        <col style="width: auto">
                        <col style="width: 100px">
                    </colgroup>
                    <thead>
                    <tr>
                        <th rowspan="2">No.</th>
                        <th>제품명</th>
                        <th>성분코드</th>
                        <th>성분분류코드</th>
                        <th>성분명</th>
                        <th>규격</th>
                        <th>관리</th>
                    </tr>
                    <tr>
                        <th>제품코드</th>
                        <th>성분코드SEQ</th>
                        <th>성분분류명</th>
                        <th>제조사명</th>
                        <th>단위</th>
                        <th>우선순위</th>
                    </tr>
                    </thead>
                    <tbody>
                    <template v-for="product in replaces">
                        <tr>
                            <td rowspan="2">{{product.jl_no}}</td>
                            <td>{{product.$info.PRODUCT_NM}}</td>
                            <td>{{product.$info.CONS_CD}}</td>
                            <td>{{product.$info.CONS}}</td>
                            <td>{{product.$info.CONS_CD_NM}}</td>
                            <td>{{product.$info.PRODUCT_STANDARD}}</td>
                            <td><button type="button" class="btn btn_mini btn_black" @click="deleteReplace(product.idx)">삭제</button></td>
                        </tr>
                        <tr>
                            <td>{{product.$info.PRODUCT_CD}}</td>
                            <td>{{product.$info.CONS_CD_SEQ}}</td>
                            <td>{{product.$info.CONS_NM}}</td>
                            <td>{{product.$info.MAKER_NM}}</td>
                            <td>{{product.$info.PRODUCT_UNIT}}</td>
                            <td><input type="number" v-model="product.priority"></td>
                        </tr>
                    </template>
                    <tr class="empty" v-if="replaces.length == 0">
                        <td colspan="999">대체의약품을 설정하세요.</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            product_idx : {type : String, default : ""}
        },
        data: function(){
            return {
                jl : null,
                component_idx : "",
                filter : {
                    page : 1,
                    limit : 3,
                    count : 0,

                    product_idx : this.product_idx,

                    del_yn : "N",
                    use_yn : "Y",
                    USE_GU_YN : "Y",
                    like_key : "PRODUCT_NM",
                    like_value : ""
                },
                required : [
                    {name : "",message : ""},
                ],
                data : [],

                search : false,
                products : [],
                replaces : [],
            };
        },
        created: function(){
            this.jl = new Jl('<?=$componentName?>');
            this.component_idx = this.jl.generateUniqueId();

            this.getReplace();
        },
        mounted: function(){
            this.$nextTick(() => {

            });
        },
        methods: {
            async deleteReplace(idx) {
                if(!confirm("삭제 하시겠습니까?")) return false;
                let obj = {
                    idx : idx
                }
                try {
                    //if(!this.data.change_user_pw) throw new Error("비밀번호를 입력해주세요.");
                    let res = await this.jl.ajax("delete",obj,"/api/bs_product_replace");

                    this.getReplace();
                }catch (e) {
                    alert(e.message)
                }

            },
            async getReplace() {
                try {
                    let res = await this.jl.ajax("get",this.filter,"/api/bs_product_replace");
                    this.replaces = res.data
                }catch (e) {
                    alert(e.message)
                }
            },
            async postReplace(product) {
                let obj = {
                    product_idx : this.product_idx,
                    replace_idx : product.idx
                }
                try {
                    //if(!this.data.change_user_pw) throw new Error("비밀번호를 입력해주세요.");
                    let res = await this.jl.ajax("insert",obj,"/api/bs_product_replace");

                    this.getReplace();
                }catch (e) {
                    alert(e.message)
                }

            },
            changePage(page) {
                this.filter.page = page;

                this.getProduct();
            },
            async getProduct() {
                this.search = true;
                try {
                    let res = await this.jl.ajax("get",this.filter,"/api/bs_product");
                    this.products = res.data
                    this.filter.count = res.count
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