<script type="text/x-template" id="essential-option-list-template">
    <div>
        <p class="name">필수옵션</p>
        <div class="price">
            <p class="line" v-for="item in data">
                <label>{{item.name}}</label>
                <label>{{parseInt(item.price).format()}}원</label>
                <button type="button" @click="primary = item.idx; modal = true">수정</button>
                <button type="button" @click="deleteData(item.idx)">삭제</button>
            </p>
            <button type="button" @click="primary = ''; modal= true">옵션 추가</button>
        </div>

        <modal-component v-if="modal" @close="modal = false" @update="getData" v-slot="slot">
            <essential-option-input @close="modal = false" @update="getData" :primary="primary" :product_idx="product_idx"></essential-option-input>
        </modal-component>
    </div>
</script>

<script>
    Vue.component('essential-option-list', {
        template: "#essential-option-list-template",
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
                    product_idx : ""
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

                var res = ajax("api/essentialOption/getData", objs);
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

                    var res = ajax("/api/essentialOption/deleteData", objs);
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