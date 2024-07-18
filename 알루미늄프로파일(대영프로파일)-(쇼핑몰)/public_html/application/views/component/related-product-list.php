<script type="text/x-template" id="related-product-list-template">
    <div>
        <p class="name">관련상품</p>
        <div class="price">
            <p class="line" v-for="item in data">
                <label v-if="item.product.file_name_list">
                    <img :src="baseUrl + '/assets/uploads/product/' + item.product.file_name_list.split(',')[0]" style="width: 100px; height: 100px;">
                </label>
                <label>{{item.product.prod_name}}</label>
                <label>{{parseInt(item.product.prod_price).format()}}원</label>
                <button type="button" @click="deleteData(item.idx)">삭제</button>
            </p>
            <button type="button" @click="primary = ''; modal= true">상품 추가</button>
        </div>

        <modal-component v-if="modal" @close="modal = false" @update="getData" v-slot="slot">
            <related-product-input @close="modal = false" @update="getData" :primary="primary" :product_idx="product_idx"></related-product-input>
        </modal-component>
    </div>
</script>

<script>
    Vue.component('related-product-list', {
        template: "#related-product-list-template",
        props: {
            product_idx : {type : String, default : ""}
        },
        data: function(){
            return {
                modal: false,

                data: [],
                total: 0,

                primary: "",

                filter: {
                    product_idx : "",
                }
            };
        },
        created: function(){
            if(this.product_idx) this.filter.product_idx = this.product_idx;
            this.getData();
        },
        mounted: function(){

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

                var res = ajax("api/relatedProduct/getData", objs);
                if (res) {
                    console.log(res)
                    this.data = res.data;
                }
            },
            deleteData: function (idx) {
                console.log(idx)
                if (confirm("정말 삭제하시겠습니까?")) {
                    var method = "delete";
                    var objs = {
                        _method: method,
                        idx: idx
                    };

                    var res = ajax("/api/relatedProduct/deleteData", objs);
                    if (res) {
                        alert("삭제되었습니다.");
                        this.getData();
                    }
                }
            }
        },
        computed: {

        },
        watch : {

        }
    });
</script>