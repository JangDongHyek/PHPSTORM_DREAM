<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div class="form-container">
        <h2>보유기술 추가</h2>
        <div class="form-group">
            <label for="name">이름:</label>
            <input type="text" v-model="data.name">
        </div>
        <div class="form-group">
            <label for="description">노출 순서:</label>
            <input type="number" v-model="data.priority">
        </div>
        <button type="button" class="add-btn" @click="postData">추가하기</button>
    </div>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            primary : {type : String, default : ""},
            parent_idx : {type : String, defualt : ""}
        },
        data: function(){
            return {
                jl : null,
                filter : {
                    page : 0,
                    limit : 0,
                    count : 0,
                    search_key1 : "",
                    search_value1_1 : "",
                    search_value1_2 : "",
                    search_like_key1 : "",
                    search_like_value1 : "",
                    not_key1 : "",
                    not_value1 : "",
                    in_key1 : "",
                    in_value : [],
                    order_by_desc : "insert_date",
                    order_by_asc : "",
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

            if(this.primary) this.getData();
        },
        mounted: function(){
            this.$nextTick(() => {

            });
        },
        methods: {
            async postData() {
                let method = this.primary ? "update" : "insert";
                let options = {required : this.required};
                try {
                    let res = await this.jl.ajax(method,this.data,"/api/skills.php",options);
                }catch (e) {
                    alert(e.message)
                }

            },
            async getData() {
                try {
                    let res = await this.jl.ajax("get",this.filter,"/api/example.php");
                    this.data = res.data[0]
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
    .form-container {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        width: 300px;
        text-align: center;
    }

    h2 {
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 15px;
        text-align: left;
    }

    label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
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