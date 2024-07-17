<script type="text/x-template" id="list-component-template">
    <div>
        <div class="example-table">
            <table>
                <thead>
                <tr>
                    <th>탭1</th>
                    <th>탭2</th>
                    <th>이벤트</th>
                </tr>
                </thead>

                <tbody>
                <tr v-for="item in data">
                    <td>{{item.tap1}}</td>
                    <td>{{item.tap2}}</td>
                    <td>
                        <button class="edit-btn" @click="primary = item.idx; modal = true">편집</button>
                        <button class="delete-btn" @click="deleteData(item.idx)">삭제</button>
                    </td>
                </tr>
                </tbody>
            </table>

            <div class="add-button-container">
                <button class="add-btn" @click="primary = ''; parent_idx = ''; modal = true">추가하기</button>
            </div>
        </div>

        <paging-component :page="filter.page" :limit="filter.limit" :total="total"
                          @change="changePage"></paging-component>

        <modal-component v-if="modal" @close="modal = false" @update="getData" v-slot="slot">
            <input-component @close="modal = false" @update="getData" :primary="primary"></input-component>
        </modal-component>
    </div>
</script>

<script>
    Vue.component('list-component', {
        template: "#list-component-template",
        props: {},
        data: function () {
            return {
                modal: false,

                data: [],
                total: 0,

                primary: "",

                filter: {
                    page: 1,
                    limit: 10,
                    search_key1: "",
                    search_value1: ""
                }
            };
        },
        created: function () {
            this.getData();
        },
        mounted: function () {

        },
        methods: {
            changePage: function (page) {
                this.filter.page = page;
                this.getData();
            },
            getData: function () {
                var method = "get";
                var filter = JSON.parse(JSON.stringify(this.filter));
                var objs = {
                    _method: method,
                    filter: JSON.stringify(filter)
                };

                var res = ajax("/api/example.php", objs);
                if (res) {
                    console.log(res)
                    this.data = res.response.data;
                    this.total = res.response.count;
                }
            },
            deleteData: function (idx) {
                console.log(idx)
                if (confirm("정말 삭제하시겠습니까?")) {
                    var method = "delete";
                    var objs = {
                        _method: method,
                        primary: idx
                    };

                    var res = ajax("/api/example.php", objs);
                    if (res) {
                        alert("삭제되었습니다.");
                        this.getData();
                    }
                }
            }
        },
        computed: {},
        watch: {}
    });
</script>


<style>
    .example-table {
        width: 98%;
        max-width: 2400px;
        margin: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 15px;
        text-align: left;
    }

    th {
        background-color: #007bff;
        color: #fff;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    tr:hover {
        background-color: #f1f1f1;
    }

    .edit-btn, .delete-btn {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 10px 15px;
        margin: 5px;
        cursor: pointer;
        border-radius: 4px;
        transition: background 0.3s;
    }

    .delete-btn {
        background-color: #dc3545;
    }

    .edit-btn:hover {
        background-color: #0056b3;
    }

    .delete-btn:hover {
        background-color: #c82333;
    }

    .add-button-container {
        display: flex;
        justify-content: flex-end;
        padding: 15px;
    }

    .add-btn {
        background-color: #28a745;
        color: white;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        border-radius: 4px;
        transition: background 0.3s;
    }

    .add-btn:hover {
        background-color: #218838;
    }
</style>