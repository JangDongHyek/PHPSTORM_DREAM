<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div>
        <div class="search-container">
            <select class="search-select" v-model="filter.search_key">
                <option value="">선택해주세요.</option>
                <option value="type">구분</option>
                <option value="name">성명</option>
                <option value="phone">연락처</option>
                <option value="company">고객사명</option>
            </select>
            <input type="text" class="search-input" placeholder="검색어를 입력하세요" v-model="filter.search_value">
            <input type="date" class="search-input" v-model="filter.sdate">~
            <input type="date" class="search-input" v-model="filter.edate">
            <button class="search-button" @click="getData()">
                <img src="https://img.icons8.com/material-rounded/24/000000/search.png" alt="검색">
            </button>

        </div>

        <div style="float : right; top: 10px; right: 10px; padding: 10px 20px">
            <button style="background-color: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 5px;" @click="modal = true">+ 고객등록</button>

            <button style="background-color: green; color: white; padding: 10px 20px; border: none; border-radius: 5px;" @click="csvData">
                엑셀 다운로드
            </button>
        </div>

        <div class="container">


            <table>
                <thead>
                <tr>
                    <th>No</th>
                    <th>날짜</th>
                    <th>구분</th>
                    <th>성명</th>
                    <th>연락처</th>
                    <th>고객사명</th>
                    <th>비고</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="item in data">
                    <td>{{item.data_page_nor}}</td>
                    <td>{{item.insert_date}}</td>
                    <td>{{item.type}}</td>
                    <td>{{item.name}}</td>
                    <td>{{item.phone}}</td>
                    <td>{{item.company}}</td>
                    <td>{{item.content}}</td>
                    <td>
                        <button class="delete-button" aria-label="삭제" @click="deleteData(item)">
                            <i class="far fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>


            <part-paging :filter="filter" @change="filter.page = $event; getData();"></part-paging>

            <slot-modal v-if="modal" @close="modal = false;">
                <consult-input></consult-input>
            </slot-modal>
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
                    order_by_desc : "insert_date"
                },
                required : [
                    {name : "",message : ""},
                ],
                data : {

                },


                modal : false,
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

                let options = {"download" : `${year}${month}${day}상담리스트.csv`}
                try {
                    let res = await this.jl.ajax("get",this.filter,"/api/consult_excel.php",options);

                }catch (e) {
                    alert(e)
                }
            },
            async deleteData(item) {
                try {
                    if(confirm("정말 삭제하시겠습니까?")) {
                        let res = await this.jl.ajax("delete",item,"/api/consult.php");
                        alert("삭제되었습니다.");
                        this.getData();
                    }
                }catch (e) {
                    alert(e)
                }

            },
            async postData() {
                let method = this.primary ? "update" : "insert";

                try {
                    let res = await this.jl.ajax(method,this.data,"/api/example.php",this.required);
                }catch (e) {
                    alert(e)
                }

            },
            async getData() {
                try {
                    let res = await this.jl.ajax("get",this.filter,"/api/consult.php");
                    this.data = res.data;
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
        gap: 5px;
    }

    .search-select {
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 4px;
        outline: none;
        height: 40px;
        margin: 0;
        width: fit-content;
    }

    .search-input {
        padding: 5px;
        border: 1px solid #ccc;
        width: fit-content;
        min-width: 170px;
        border-radius: 4px;
        outline: none;
        margin-top: 0!important;
        height: 40px;
    }

    .search-button {
        padding: 6px 10px;
        border: 1px solid #ccc;
        background-color: #f8f8f8;
        cursor: pointer;
        border-radius: 4px;
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

    .delete-button i {
        color: #ff0000; /* 빨간색으로 아이콘 색상을 지정 */
    }

    .delete-button i:hover {
        color: #733f3f; /* 호버 시 색상 변경 */
    }
</style>