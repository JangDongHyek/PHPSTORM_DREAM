<script type="text/x-template" id="input-component-template">
    <div class="form-container">
        <h2>폼 타이틀 단</h2>
        <div class="form-group">
            <label for="name">탭1:</label>
            <input type="text" v-model="data.tap1">
        </div>
        <div class="form-group">
            <label for="description">탭2:</label>
            <input type="text" v-model="data.tap2" @input="data.tap2 = data.tap2.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
        </div>
        <button type="button" class="add-btn" @click="postData">추가하기</button>
    </div>
</script>

<script>
    Vue.component('input-component', {
        template: "#input-component-template",
        props: {
            primary : {type : String, defualt : ""},
        },
        data: function () {
            return {
                data : {
                    tap1 : "",
                    tap2 : ""
                }
            };
        },
        created: function () {
            if(this.primary) this.getData();
        },
        mounted: function () {

        },
        methods: {
            postData : function() {
                var method = this.primary ? "update" : "insert";
                var obj = JSON.parse(JSON.stringify(this.data));

                var objs = {
                    _method: method,
                    obj: JSON.stringify(obj),
                };

                var res = ajax("/api/example.php", objs);

                if (res) {
                    console.log(res)

                    alert("완료 되었습니다.");
                    this.$emit("close");
                    this.$emit("update");
                }
            },
            getData: function () {
                var method = "get";
                var filter = { primary : this.primary };

                var objs = {
                    _method: method,
                    filter: JSON.stringify(filter)
                };

                var res = ajax("/api/example.php", objs);
                if (res) {
                    console.log(res)
                    this.data = res.response.data[0]
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