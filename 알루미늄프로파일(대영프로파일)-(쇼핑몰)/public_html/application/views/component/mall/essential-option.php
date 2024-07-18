<script type="text/x-template" id="essential-option-template">
    <template v-if="data.length > 0">
        <dl>
            <dt>필수옵션</dt>
            <dd class="cutting">
                <select v-model="select" @change="$emit('change','essential-option',select)">
                    <option value="">필수옵션</option>
                    <option v-for="item in data" :value="item">{{item.name}} (+{{parseInt(item.price).format()}}원)</option>
                </select>
            </dd>
        </dl>
    </template>
</script>

<script>
    Vue.component('essential-option', {
        template: "#essential-option-template",
        props: {
            product_idx : {type : String, default: ""}
        },
        data: function(){
            return {
                filter : {
                    product_idx : this.product_idx
                },

                data : null,
                select : "",
            };
        },
        created: function(){
            this.getData();
        },
        mounted: function(){

        },
        methods: {
            getData: function () {
                var method = "get";
                var filter = JSON.parse(JSON.stringify(this.filter));

                var objs = {
                    _method: method,
                    filter: JSON.stringify(filter)
                };

                var res = ajax("/api/essentialOption/getData", objs);
                if (res) {
                    console.log(res)
                    this.data = res.data
                }
            }
        },
        computed: {

        },
        watch : {

        }
    });
</script>