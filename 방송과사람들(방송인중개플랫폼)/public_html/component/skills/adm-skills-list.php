<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
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
            <adm-skills-input @close="modal = false" @update="getData" :primary="primary" :parent_idx="parent_idx"></adm-skills-input>
        </modal-component>
    </div>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
        },
        data: function(){
            return {
                jl : null,
                filter : {
                    parent_idx : "jl_null"
                },
                required : [
                    {name : "",message : ""},
                ],
                data : [],
                modal : false,
                primary : "",
                parent_idx : "",
                select_item : "",
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
            onChange2 : function(childs) {
                let app = this;

                childs.forEach(function(data,index) {
                    let obj = {
                        idx : data.idx,
                        name : data.name,
                        priority : index
                    }

                    app.jl.ajax("update",obj,"/api/skills.php");

                })
            },
            onChange : function(e) {
                let app = this;
                this.data.forEach(function(data,index) {
                    let obj = {
                        idx : data.idx,
                        name : data.name,
                        priority : index
                    }


                    app.jl.ajax("update",obj,"/api/skills.php");
                })
            },
            async deleteData(idx) {
                let obj = {primary : idx}
                if(!confirm("정말 삭제 하시겠습니까?")) return false;
                try {
                    let res = await this.jl.ajax("delete",obj,"/api/skills.php");
                    alert("삭제되었습니다.");
                    await this.getData();
                }catch (e) {
                    alert(e.message)
                }

            },
            async getData() {
                try {
                    let res = await this.jl.ajax("get",this.filter,"/api/skills.php");
                    this.data = res.data
                }catch (e) {
                    alert(e.message)
                }
            }
        },
        computed: {

        },
        watch : {
            search_key1() {
                this.search_value1_1 = "";
                this.search_value1_2 = "";
            }
        }
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