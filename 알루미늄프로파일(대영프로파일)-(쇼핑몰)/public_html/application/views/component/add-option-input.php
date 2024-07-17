<script type="text/x-template" id="add-option-input-template">
    <div class="form-container">
        <h2>추가옵션</h2>
        <div class="form-group">
            <label for="name">옵션명:</label>
            <input type="text" v-model="data.name">
        </div>
        <div class="form-group">
            <label for="description">가격:</label>
            <input type="text" v-model="data.price" @input="data.price = data.price.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
        </div>
        <button type="button" class="add-btn" @click="postData">추가하기</button>
    </div>
</script>

<script>
    Vue.component('add-option-input', {
        template: "#add-option-input-template",
        props: {
            primary : {type : String, defualt : ""},
            product_idx : {type : String, defualt : ""},
        },
        data: function () {
            return {
                data : {
                    product_idx : "",
                    name : "",
                    price : "0"
                }
            };
        },
        created: function () {
            if(this.product_idx) this.data.product_idx = this.product_idx;
            if(this.primary) this.getData();

        },
        mounted: function () {

        },
        methods: {
            postData : function() {
                var method = this.primary ? "put" : "post";
                var obj = JSON.parse(JSON.stringify(this.data));

                var objs = {
                    _method: method,
                    obj: JSON.stringify(obj),
                };

                var res = ajax("/api/addOption/"+method+"Data", objs);

                if (res) {
                    console.log(res)

                    alert("완료 되었습니다.");
                    this.$emit("close");
                    this.$emit("update");
                }
            },
            getData: function () {
                var method = "get";
                var filter = { idx : this.primary };

                var objs = {
                    _method: method,
                    filter: JSON.stringify(filter)
                };

                var res = ajax("/api/addOption/getData", objs);
                if (res) {
                    console.log(res)
                    this.data = res.data[0]
                }
            },
        },
        computed: {},
        watch: {}
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


    .form-group {
        margin-bottom: 15px;
        text-align: left;
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