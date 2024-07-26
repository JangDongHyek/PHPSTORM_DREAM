<script type="text/x-template" id="adm-category-list-template">
    <div class="outer-container">
        <div class="container">
            <draggable v-model="data" group="categories" class="category-list" @change="onChange">
                <template v-for="item,index in data">
                    <li :key="index" @click="(select_item && select_item.idx == item.idx) ? select_item = '' : select_item = item;">
                        <div class="category-header">
                            <div class="category-title">{{ item.name }}</div>
                            <div class="category-actions">
                                <button @click="event.stopPropagation(); primary = '';parent_idx = item.idx; modal = true">추가</button>
                                <button @click="event.stopPropagation(); parent_idx = ''; primary = item.idx; modal = true">수정</button>
                                <button @click="event.stopPropagation(); deleteData(item.idx)">삭제</button>
                            </div>
                        </div>
                        <draggable v-model="item.childs" :group="'subcategories' + index" class="subcategory-list" @change="onChange2(item.childs)">
                            <template v-for="child,index2 in item.childs">
                                <li :key="index2" v-show="select_item.idx == item.idx">
                                    <div class="subcategory-header">
                                        <div class="subcategory-title">{{ child.name }}</div>
                                        <div class="subcategory-actions">
                                            <button @click="event.stopPropagation(); primary = child.idx; modal = true">수정</button>
                                            <button @click="event.stopPropagation(); deleteData(child.idx)">삭제</button>
                                        </div>
                                    </div>
                                </li>
                            </template>
                        </draggable>
                    </li>
                </template>
            </draggable>

            <button class="button-add1ASD" @click="primary = ''; parent_idx=''; modal = true;">추가</button>
        </div>

        <modal-component v-if="modal" @close="modal = false" @update="getData" v-slot="slot">
            <adm-category-input @close="modal = false" @update="getData" :primary="primary" :parent_idx="parent_idx"></adm-category-input>
        </modal-component>
    </div>
</script>

<script>
    Vue.component('adm-category-list', {
        template: "#adm-category-list-template",
        props: {},

        data: function () {
            return {
                modal: false,
                data: [],
                total : 0,
                primary : "",
                parent_idx : "",
                select_item : "",
                filter: {
                    page: 1,
                    limit: 50,
                    parent_idx : "",
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
            onChange2 : function(childs) {
                childs.forEach(function(data,index) {
                    obj = {
                        idx : data.idx,
                        name : data.name,
                        priority : index
                    }
                    var objs = {
                        _method: "update",
                        obj: JSON.stringify(obj),
                    };

                    var res = ajax("/api/category.php", objs);

                })
            },
            onChange : function(e) {
                this.data.forEach(function(data,index) {
                    obj = {
                        idx : data.idx,
                        name : data.name,
                        priority : index
                    }

                    var objs = {
                        _method: "update",
                        obj: JSON.stringify(obj),
                    };

                    var res = ajax("/api/category.php", objs);
                })
            },
            changePage : function(page) {
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

                var res = ajax("/api/category.php", objs);
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

                    var res = ajax("/api/category.php", objs);
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
    /* 버튼의 기본 스타일 */
    .button-add1ASD {
        background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
        border: none;
        color: white;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
        border-radius: 25px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease-in-out;
    }

    /* 버튼의 호버 스타일 */
    .button-add1ASD:hover {
        background: linear-gradient(135deg, #2575fc 0%, #6a11cb 100%);
        box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
        transform: translateY(-2px);
    }

    /* 버튼의 활성화 상태 스타일 */
    .button-add1ASD:active {
        box-shadow: 0 3px 5px rgba(0, 0, 0, 0.2);
        transform: translateY(0);
    }

    .outer-container {
        display: flex;
        justify-content: center;
        padding: 20px;
        background-color: #ffffff;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .container {
        width: 100%;
        max-width: 1700px; /* 최대 너비를 줄입니다 */
    }

    .category-list {
        display: flex;
        flex-wrap: wrap; /* 아이템이 화면을 초과하면 다음 줄로 이동 */
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .category-list > li {
        background-color: #ffffff;
        border: 1px solid #ddd;
        border-radius: 4px;
        margin: 5px;
        padding: 10px 15px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        flex: 1 1 calc(33.333% - 10px); /* 3개의 아이템이 가로로 배치되고, 여백을 감안한 비율 */
        box-sizing: border-box; /* 패딩과 테두리 포함 */
    }

    .category-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .category-title {
        font-size: 18px;
        font-weight: bold;
        color: #333;
        margin-bottom: 5px;
    }

    .category-actions {
        display: flex;
        gap: 5px; /* 버튼 사이의 간격 */
    }

    .category-actions button {
        padding: 5px 10px;
        font-size: 14px;
        cursor: pointer;
        border: none;
        border-radius: 4px;
        color: #fff;
        background-color: #007bff; /* 기본 버튼 색상 */
        transition: background-color 0.3s ease;
        display: flex; /* Flexbox를 사용하여 텍스트를 가운데 정렬 */
        align-items: center;
        justify-content: center;
    }

    .category-actions button:hover {
        background-color: #0056b3; /* 버튼 호버 색상 */
    }

    .category-actions button:nth-of-type(2) {
        background-color: #28a745; /* 수정 버튼 색상 */
    }

    .category-actions button:nth-of-type(2):hover {
        background-color: #218838; /* 수정 버튼 호버 색상 */
    }

    .category-actions button:nth-of-type(3) {
        background-color: #dc3545; /* 삭제 버튼 색상 */
    }

    .category-actions button:nth-of-type(3):hover {
        background-color: #c82333; /* 삭제 버튼 호버 색상 */
    }

    .subcategory-list {
        list-style: none;
        padding: 0;
        margin: 0;
        margin-top: 10px;
        display: flex;
        flex-direction: column; /* 세로로 나열 */
    }

    .subcategory-list > li {
        background-color: #f9f9f9;
        border: 1px solid #eee;
        border-radius: 4px;
        margin-bottom: 5px;
        padding: 5px 10px;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        box-sizing: border-box; /* 패딩과 테두리 포함 */
    }

    .subcategory-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .subcategory-title {
        font-size: 16px;
        color: #555;
    }

    .subcategory-actions {
        display: flex;
        gap: 5px; /* 버튼 사이의 간격 */
    }

    .subcategory-actions button {
        padding: 5px 10px;
        font-size: 14px;
        cursor: pointer;
        border: none;
        border-radius: 4px;
        color: #fff;
        background-color: #007bff; /* 기본 버튼 색상 */
        transition: background-color 0.3s ease;
        display: flex; /* Flexbox를 사용하여 텍스트를 가운데 정렬 */
        align-items: center;
        justify-content: center;
    }

    .subcategory-actions button:hover {
        background-color: #0056b3; /* 버튼 호버 색상 */
    }

    @media (max-width: 768px) {
        .category-list > li {
            flex: 1 1 calc(50% - 10px); /* 작은 화면에서는 2개씩 배치 */
        }

        .subcategory-list > li {
            flex: 1 1 calc(100% - 10px); /* 작은 화면에서는 1개씩 배치 */
        }
    }

    @media (max-width: 480px) {
        .category-list > li {
            flex: 1 1 calc(100% - 10px); /* 더 작은 화면에서는 1개씩 배치 */
        }
    }
</style>