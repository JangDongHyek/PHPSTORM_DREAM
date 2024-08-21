<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div>
        <div class="search-container">
            <select class="search-select" v-model="filter.search_key">
                <option value="">선택해주세요.</option>
                <option value="type">구분</option>
                <option value="mb_name">성명</option>
                <option value="mb_hp">연락처</option>
                <option value="mb_company">고객사명</option>
                <option value="reg_date">캐쉬백 신청일시</option>
                <option value="use_date">해피라이프 이용일자</option>
            </select>
            <template v-if="filter.search_key == 'reg_date' || filter.search_key == 'use_date'">
                <input type="date" class="search-input" v-model="filter.sdate">~
                <input type="date" class="search-input" v-model="filter.edate">
            </template>
            <template v-else>
                <input type="text" class="search-input" placeholder="검색어를 입력하세요" v-model="filter.search_value">
            </template>
            <button class="search-button" @click="getData()">
                <img src="https://img.icons8.com/material-rounded/24/000000/search.png" alt="검색">
            </button>

        </div>

        <div style="float : right; top: 10px; right: 10px; padding: 10px 20px">
            <button style="background-color: green; color: white; padding: 10px 20px; border: none; border-radius: 5px;" @click="csvData">
                엑셀 다운로드
            </button>
        </div>

        <div class="container">


            <table>
                <thead>
                <tr>
                    <th>No</th>
                    <th>구분</th>
                    <th>캐쉬백 신청일시</th>
                    <th>신청인 성명</th>
                    <th>신청인 휴대폰</th>
                    <th>신청인 고객사명</th>
                    <th>해피라이프 이용일자</th>
                    <th>이용인 성명</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="item in data">
                    <td>{{item.data_page_nor}}</td>
                    <td>{{item.type}}</td>
                    <td>{{item.reg_date}}</td>
                    <td>{{item.mb_name}}</td>
                    <td>{{item.mb_hp}}</td>
                    <td>{{item.mb_company}}</td>
                    <td>{{item.use_date}}</td>
                    <td>{{item.use_name}}</td>
                </tr>
                </tbody>
            </table>

            <part-paging :filter="filter" @change="filter.page = $event; getData();"></part-paging>
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
                filter : {
                    page : 1,
                    limit : 10,
                    count : 0,
                    search_key : "",
                    search_value : "",
                    sdate : "",
                    edate : "",
                    order_by_desc : "reg_date"
                },
                required : [
                    {name : "",message : ""},
                ],
                data : {

                },
            };
        },
        created: function(){
            this.jl = new Jl('<?=$componentName?>');

            this.getData();
        },
        mounted: function(){
            this.$nextTick(() => {

            });
        },
        methods: {
            async csvData() {
                const date = new Date();

                const year = date.getFullYear();
                const month = ('0' + (date.getMonth() + 1)).slice(-2);  // 월은 0부터 시작하므로 +1 필요
                const day = ('0' + date.getDate()).slice(-2);

                let options = {"download" : `${year}${month}${day}캐쉬백신청리스트.csv`}
                try {
                    let res = await this.jl.ajax("csv",this.filter,"/api/v5_sangjo_sub.php",options);

                }catch (e) {
                    alert(e)
                }
            },
            async postData() {
                let method = this.primary ? "update" : "insert";
                let options = {required : this.required};
                try {
                    let res = await this.jl.ajax(method,this.data,"/api/example.php",options);
                }catch (e) {
                    alert(e)
                }

            },
            async getData() {
                try {
                    let res = await this.jl.ajax("get",this.filter,"/api/v5_sangjo_sub.php");
                    this.data = res.data
                    this.filter.count = res.count;
                }catch (e) {
                    alert(e)
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
    .search-container {
        display: flex;
        align-items: center;
        width: 30%;
    }

    .search-select {
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 4px 0 0 4px;
        outline: none;
        height: 40px;
        margin: 0;
    }

    .search-input {
        padding: 5px;
        border: 1px solid #ccc;
        border-left: none;
        width: 200px;
        border-radius: 0;
        outline: none;
        margin-top: 0!important;
        height: 40px;
    }

    .search-button {
        padding: 6px 10px;
        border: 1px solid #ccc;
        border-left: none;
        background-color: #f8f8f8;
        cursor: pointer;
        border-radius: 0 4px 4px 0;
        outline: none;
        height: 40px;
    }

    .search-button img {
        width: 16px;
        height: 16px;
    }

    .container {
        width: 100%;
        margin: 0 auto;
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    th, td {
        padding: 12px;
        text-align: center;
        border-bottom: 1px solid #ddd;
    }

    thead th {
        background-color: #f5f5f5;
    }

    tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .pagination {
        text-align: center;
        margin-top: 10px;
    }

    .pagination span {
        margin: 0 5px;
        color: #666;
        cursor: pointer;
    }

    .register-button {
        display: block;
        width: 150px;
        margin: 20px auto;
        padding: 10px 20px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        cursor: pointer;
        text-align: center;
    }

    .register-button:hover {
        background-color: #0056b3;
    }

    .delete-button {
        background-color: transparent;
        border: none;
        cursor: pointer;
        padding: 10px;
    }

    .delete-button svg {
        width: 24px;
        height: 24px;
        fill: #ff0000; /* 빨간색으로 아이콘 색상을 지정 */
    }

    .delete-button svg:hover {
        fill: #cc0000; /* 호버 시 색상 변경 */
    }
</style>