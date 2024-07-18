<script type="text/x-template" id="related-product-input-template">
    <div class="form-container">
        <h2>관련상품</h2>

        <div class="form-group">
            <label for="name">상품명:</label>
            <input type="text" v-model="filter.prod_name">
            <button type="button" class="add-btn" @click="getProduct">검색</button>
        </div>

        <table class="table-8t7g45" v-if="products && products.length > 0">
            <thead>
            <tr>
                <th>썸네일</th>
                <th>상품명</th>
                <th>가격</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="item in products">
                <td>
                    <template v-if="item.file_name_list">
                        <img :src="baseUrl + '/assets/uploads/product/' + item.file_name_list.split(',')[0]" style="width: 100px; height: 100px;">
                    </template>
                </td>
                <td>
                    {{item.prod_name}}
                </td>
                <td>
                    {{parseInt(item.prod_price2).format()}}원
                </td>
                <td>
                    <button type="button" class="add-btn" @click="postData(item.idx)">추가</button>
                </td>
            </tr>
            </tbody>
        </table>

        <div v-if="products && products.length == 0">
            <h2>검색한 상품이 존재하지않습니다.</h2>
        </div>

        <!--<div class="form-group">-->
        <!--    <label for="description">가격:</label>-->
        <!--    <input type="text" v-model="data.price" @input="data.price = data.price.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">-->
        <!--</div>-->
        <!--<button type="button" class="add-btn" @click="postData">추가하기</button>-->
    </div>
</script>

<script>
    Vue.component('related-product-input', {
        template: "#related-product-input-template",
        props: {
            primary : {type : String, defualt : ""},
            product_idx : {type : String, defualt : ""},
        },
        data: function () {
            return {
                filter : {
                    prod_name : "",
                },
                products : null,
                data : {}
            };
        },
        created: function () {
            if(this.product_idx) this.data.product_idx = this.product_idx;
            if(this.primary) this.getData();

        },
        mounted: function () {

        },
        methods: {
            postData : function(idx) {
                var obj = {
                    product_idx : this.product_idx,
                    related_idx : idx
                }

                var objs = {
                    obj: JSON.stringify(obj),
                };

                var res = ajax("/api/relatedProduct/postData", objs);

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

                var res = ajax("/api/relatedProduct/getData", objs);
                if (res) {
                    console.log(res)
                    this.data = res.data[0]
                }
            },
            getProduct: function () {
                var method = "get";
                var filter = JSON.parse(JSON.stringify(this.filter));

                var objs = {
                    _method: method,
                    filter: JSON.stringify(filter)
                };

                var res = ajax("/api/relatedProduct/getProduct", objs);
                if (res) {
                    console.log(res)
                    this.products = res.data
                }
            },
        },
        computed: {},
        watch: {}
    });
</script>

<style>
    .table-8t7g45 {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
        font-size: 1.2em;
        font-family: 'Arial', sans-serif;
        min-width: 400px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    }
    .table-8t7g45 thead tr {
        background-color: #009879;
        color: #ffffff;
        text-align: left;
    }
    .table-8t7g45 th, .table-8t7g45 td {
        padding: 12px 15px;
    }
    .table-8t7g45 tbody tr {
        border-bottom: 1px solid #dddddd;
    }
    .table-8t7g45 tbody tr:nth-of-type(even) {
        background-color: #f3f3f3;
    }
    .table-8t7g45 tbody tr:last-of-type {
        border-bottom: 2px solid #009879;
    }
    .table-8t7g45 tbody tr.active-row {
        font-weight: bold;
        color: #009879;
    }

    .form-container {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        width: 600px;
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