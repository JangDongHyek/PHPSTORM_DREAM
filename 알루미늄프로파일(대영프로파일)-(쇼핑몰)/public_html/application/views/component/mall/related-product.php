<script type="text/x-template" id="related-product-template">
    <template v-if="data.length > 0">
        <dl>
            <dt>관련상품</dt>
            <dd class="cutting">
                <div class="image-container-5f9c8a" v-for="item in data">
                    <a :href="baseUrl+'/medicinal/' + item.idx" target="_blank">
                        <label v-if="item.product.file_name_list">
                            <img :src="baseUrl + '/assets/uploads/product/' + item.product.file_name_list.split(',')[0]" style="width: 100px; height: 100px;">
                        </label>
                        <div class="caption">{{item.product.prod_name}}</div>
                    </a>
                </div>
            </dd>
        </dl>
    </template>
</script>

<script>
    Vue.component('related-product', {
        template: "#related-product-template",
        props: {
            product_idx : {type : String, default: ""}
        },
        data: function(){
            return {
                filter : {
                    product_idx : this.product_idx
                },

                data : null
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

                var res = ajax("/api/relatedProduct/getData", objs);
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

<style>
    .image-container-5f9c8a {
        display: inline-block;
        text-align: center;
        margin: 10px;
    }

    .image-container-5f9c8a img {
        width: 100%;
        height: auto;
        display: block;
    }

    .image-container-5f9c8a .caption {
        margin-top: 8px;
        font-size: 1em;
        color: #333;
        font-family: 'Arial', sans-serif;
    }
</style>