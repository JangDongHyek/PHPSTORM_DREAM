<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <section class="list_table">
        <div class="area_filter flex ai-c jc-sb">
            <div class="flex ai-c">
                <strong class="total">총 {{paging.count}}건</strong>
                <input type="date" v-model="filter.start" placeholder="날짜 선택" value="">
                ~
                <input type="date" v-model="filter.end" placeholder="날짜 선택" value="">
                <div class="search">
                    <select name="sfl" v-model="filter.like_key">
                        <option value="file">파일명</option>
                        <option value="user.company_person">등록자</option>
                    </select>
                    <input type="search" name="stx" placeholder="검색어 입력" v-model="filter.like_value" @keyup.enter="paging.page = 1; getData();">
                    <button type="button" class="btn_search" @click="paging.page = 1; getData();" ><i class="fa-regular fa-magnifying-glass"></i></button>
                </div>
            </div>
            <button type="button" class="btn btn_line" @click="downloads()"><i class="fa-light fa-arrow-down-to-line"></i> 다운로드</button>
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
                    <th class="text-center"></th>
                    <th>파일명</th>
                    <th class="text-center">용량</th>
                    <th class="text-center">등록자</th>
                    <th class="text-center">카테고리</th>
                    <th class="text-center">등록일</th>
                    <th class="text-center">다운</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="item in data">
                    <th class="text-center"><input type="checkbox" v-model="checks" :value="item"/></th>
                    <td>{{item.file.name}}</td>
                    <td class="text-center">{{item.file.size.formatBytes()}}</td>
                    <td class="text-center">{{item.company_person}}</td>
                    <td class="text-center">
                        {{item.category_a}}
                        {{item.group_a}}
                        {{item.group_b}}
                        {{item.group_c}}
                        {{item.category_b}}
                    </td>
                    <td class="text-center">{{item.insert_date.split(' ')[0]}}</td>
                    <td class="text-center"><button class="btn btn_mini btn_black" @click="jl.download(item.file)">다운로드</button></td>
                </tr>
                </tbody>
            </table>
        </div>

        <pagination-component :filter="paging" @change="paging.page = $event; getData();"></pagination-component>
    </section>
</script>

<script>
    Jl_components.push({name : "<?=$componentName?>",object : {
            template: "#<?=$componentName?>-template",
            props: {
                project_idx: {type: String, default: ""},
                primary: {type: String, default: ""},
            },
            data: function () {
                return {
                    jl: null,
                    component_idx: "",

                    paging: {
                        page: 1,
                        limit: 10,
                        count: 0,
                    },

                    data: [],

                    filter : {
                        start : "",
                        end : "",

                        like_key : "file",
                    },

                    checks : [],
                };
            },
            async created() {
                this.jl = new Jl('<?=$componentName?>');
                this.component_idx = this.jl.generateUniqueId();
                this.getData();
            },
            mounted() {
                this.$nextTick(() => {

                });
            },
            updated() {

            },
            methods: {
                downloads() {
                    if(!this.checks.length) {
                        alert("체크된게 없습니다.");
                        return false;
                    }
                    for (const item of this.checks) {
                        this.jl.download(item.file);
                    }
                },
                async postData() {
                    let method = this.primary ? "update" : "insert";
                    let data = {
                        table: "",
                    }

                    if (this.data) data = Object.assign(data, this.data); // paging 객체가있다면 병합

                    try {
                        let res = await this.jl.ajax(method, data, "/jl/JlApi.php");
                    } catch (e) {
                        alert(e.message)
                    }

                },
                async getData() {
                    let filter = {
                        table: "project_schedule_data",
                        project_idx : this.project_idx,

                        where : [
                            {key : "file", value : "jl_null", operator : "AND NOT"}
                        ],

                        between : [
                            {key : "insert_date", start : this.filter.start, end: this.filter.end}
                        ],

                        like : [
                            {key : this.filter.like_key, value : this.filter.like_value}
                        ],



                        join : {
                            table : "user", origin : "user_idx", join : "idx",
                            source : false, // true 시 join 테이블이 조회 기준이 된다
                            select : [
                                "user.category_a","user.category_b","user.group_a","user.group_b","user.group_c",
                                "user.company_person"
                            ] // 조회 기준이 아닌 테이블의 컬럼을 추가 조회하고싶을때 넣는다
                            //select : "*" // 조회 기준이 아닌 테이블의 모든 컬럼을 가져오고싶을때 사용 속도로 인한 비추천
                        },
                    }

                    if (this.paging) filter = Object.assign(filter, this.paging); // paging 객체가있다면 병합

                    try {
                        let res = await this.jl.ajax("get", filter, "/jl/JlApi.php");
                        this.data = res.data
                        this.paging.count = res.count;
                    } catch (e) {
                        alert(e.message)
                    }
                }
            },
            computed: {},
            watch: {}
        }});

</script>

<style>

</style>