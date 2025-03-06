<?php
$componentName = str_replace(".php","",basename(__FILE__));
$pathParts = explode(DIRECTORY_SEPARATOR, dirname(__FILE__));
$context_name = end($pathParts);
?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div v-if="load">
        <button @click="postData()">추가</button>
        <ul class="category-list">
            <li class="category-item" v-for="item1 in rows">{{item1.name}}
                <button class="action-btn add-btn" @click="postData(item1)">추가</button>
                <button class="action-btn edit-btn" @click="putData(item1)">수정</button>
                <button class="action-btn delete-btn" @click="jl.deleteData(item1,options)">삭제</button>
                <ul class="category-sublist" v-if="item1.$category.length > 0">
                    <li class="category-item" v-for="item2 in item1.$category">{{item2.name}}
                        <button class="action-btn add-btn" @click="postData(item2)">추가</button>
                        <button class="action-btn edit-btn" @click="putData(item2)">수정</button>
                        <button class="action-btn delete-btn" @click="jl.deleteData(item2,options)">삭제</button>
                        <ul class="category-sublist">
                            <li class="category-item" v-for="item3 in item2.$category">{{item3.name}}
                                <button class="action-btn edit-btn" @click="putData(item3)">수정</button>
                                <button class="action-btn delete-btn" @click="jl.deleteData(item3,options)">삭제</button>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>

        <external-bs-modal :modal="modal">
            <template v-slot:header>
                <h5 class="modal-title" id="exampleModalLabel">{{modal.parent ? modal.parent.name + ' 하위 카테고리' : '카테고리'}} {{modal.data.primary ? '수정' : '추가'}}</h5>
            </template>

            <!-- body -->
            <template v-slot:default>
                <table class="input-table">
                    <tr>
                        <th><label for="name">이름</label></th>
                        <td><input type="text" id="name" name="name" v-model="modal.data.name" class="input-field"></td>
                    </tr>
                    <tr>
                        <th><label for="url">사용 URL</label></th>
                        <td><input type="text" id="url" name="url" v-model="modal.data.url" class="input-field"></td>
                    </tr>
                    <tr>
                        <th><label for="priority">우선순위</label></th>
                        <td><input type="number" id="priority" name="priority" v-model="modal.data.priority" class="input-field"></td>
                    </tr>
                </table>
            </template>


            <template v-slot:footer>
                <button type="button" class="btn btn-secondary" @click="modal.status = false;">Close</button>
                <button type="button" class="btn btn-primary" @click="jl.postData(modal.data,options)">Save changes</button>
            </template>
        </external-bs-modal>
    </div>
</script>

<script>
    Jl_components.push({name : "<?=$componentName?>",object : {
            template: "#<?=$componentName?>-template",
            props: {
                primary : {type: String, default: ""},
            },
            data: function () {
                return {
                    load : false,
                    jl: null,
                    component_idx: "",
                    context_name : "<?=$context_name?>",
                    context : null,

                    row: {

                    },
                    rows : [],

                    options : {
                        table : "category",
                        file_use : false,
                        required : [
                            {name : "name",message : `이름은 필수값입니다.`},
                        ],
                        href : "",
                    },

                    filter : {
                        table : "category",
                        parent_idx : 'jl_null',

                        relations : [
                            {
                                table : "category" ,
                                foreign : "parent_idx",
                                type : "data",
                                relations : [
                                    {
                                        table : "category" ,
                                        foreign : "parent_idx",
                                        type : "data",
                                        filter : {
                                            order_by_asc : "priority",
                                        }
                                    }, // type(count,data)
                                ],
                            }, // type(count,data)
                        ],

                        order_by_asc : "priority",
                    },

                    origin_data : {
                        parent_idx : "",
                        name : "",
                        url : "",
                        priority : 0,
                    },

                    modal : {
                        status : false,
                        load : false,
                        parent : null,
                        data : {
                            parent_idx : "",
                            name : "",
                            url : "",
                            priority : 0,
                        },
                        class_1 : "",
                        class_2 : "",
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
                //if(this.primary) this.row = await this.jl.getData(this.filter);
                await this.jl.getsData(this.filter,this.rows);

                this.load = true;

                this.$nextTick(() => {

                });
            },
            updated() {

            },
            methods: {
                putData(item) {
                    this.modal.data = this.jl.copyObject(this.origin_data);
                    this.modal.parent = null;

                    this.modal.data = this.jl.copyObject(item);
                    this.modal.status = true;
                },
                postData(item = null) {
                    this.modal.data = this.jl.copyObject(this.origin_data);
                    this.modal.parent = null;
                    if(item) {
                        this.modal.parent = item;
                        this.modal.data.parent_idx = item.idx;
                    }else {

                    }

                    this.modal.status = true;
                }
            },
            computed: {

            },
            watch: {
                async "modal.status"(value,old_value) {
                    if(value) {
                        this.modal.load = true;
                    }else {
                        this.modal.load = false;
                        this.modal.data = {};
                    }
                }
            }
        }});

</script>
<style>
    .action-btn {
        padding: 5px 10px;
        border: none;
        cursor: pointer;
        margin-right: 5px;
        font-size: 14px;
    }

    .add-btn {
        background: #28a745;
        color: white;
    }

    .edit-btn {
        background: #ffc107;
        color: black;
    }

    .delete-btn {
        background: #dc3545;
        color: white;
    }

    .category-list {
        list-style: none;
        padding-left: 0;
    }

    .category-item {
        cursor: pointer;
        font-weight: bold;
        background: #f0f0f0;
        padding: 8px;
        margin: 4px 0;
        border: 1px solid #ddd;
        position: relative;
    }

    .category-sublist {
        padding-left: 20px;
    }

    .category-subitem {
        padding: 6px;
        background: #f9f9f9;
        border-left: 3px solid #ddd;
    }

    .toggle-icon {
        position: absolute;
        right: 10px;
        font-weight: bold;
    }

    .active {
        display: block;
    }

    /*   폼 */

    .input-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .input-table th, .input-table td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
    }

    .input-table th {
        background: #f5f5f5;
        width: 30%;
    }

    .input-field {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
    }

    .submit-btn {
        margin-top: 10px;
        padding: 10px 15px;
        background: #007bff;
        color: white;
        border: none;
        cursor: pointer;
    }

    .submit-btn:hover {
        background: #0056b3;
    }
</style>