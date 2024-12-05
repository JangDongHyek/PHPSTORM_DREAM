<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div class="tab-pane fade in" :id="component_id">
        <ul>
            <li v-for="item,index in data">
                <p class="icon" v-if="index == 0"><i class="fa-duotone fa-medal"></i></p>
                <p class="icon" v-else><strong>{{index+1}}</strong>위</p>
                <div class="img">
                    <img v-if="item.isThumb" :src="jl.root + item.path">
                    <img v-else :src="jl.root + '/theme/basic_app/img/noimg.jpg'">
                </div>
                <div class="text">
                    <div class="name">
                        <p class="photo">
                            <img v-if="item.isThumb" :src="jl.root + item.path">
                            <img v-else :src="jl.root + '/theme/basic_app/img/noimg.jpg'">
                        </p>
                        <strong>{{item.$seller['mb_nick']}}</strong>
                    </div>
                    <div class="price">{{parseInt(item.total_price).format()}}원</div>
                </div>
            </li>
        </ul>
        <button type="button" class="btn" v-if="!more" @click="more = true; getData();">더보기 <i class="fa-light fa-angle-down"></i></button>
    </div>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            primary : {type : String, default : ""},
            component_id : {type : String, default : ""},
            categories : {type : Array, default : []},

        },
        data: function(){
            return {
                jl : null,
                component_idx : "",
                filter : {
                    page : 1,
                    limit : 1,
                    count : 0,
                    order_by_desc : "insert_date",
                },

                category_data : [],
                data : [],
                modal : false,
                more : false,
                where : "",
            };
        },
        created: function(){
            this.jl = new Jl('<?=$componentName?>');
            this.getCategory();
        },
        mounted: function(){
            this.$nextTick(() => {

            });
        },
        methods: {
            changePage(page) {
                this.filter.page = page;

                this.getData();
            },
            getCategoryWhere() {
                let arr = this.categories;
                this.category_data.forEach((item) => {
                    arr.push(item.idx);
                });

                let where = `(${arr.join(",")})`;
                this.where = where;
                this.getData();
            },
            async getCategory() {
                let filter = {
                    in_key : "parent_idx",
                    in_value : this.categories
                }
                try {
                    let res = await this.jl.ajax("get",filter,"/api2/category.php");
                    this.category_data = res.data
                    this.getCategoryWhere();

                }catch (e) {
                    alert(e.message)
                }
            },
            async getData() {
                let limit = this.more ? 5 : 3
                let filter = {
                    query : "SELECT o.seller_idx, SUM(o.price) AS total_price FROM `member_order` AS o " +
                        "JOIN member_product AS p ON o.product_idx = p.idx " +
                        `WHERE p.category_idx in ${this.where}`  +
                        "GROUP BY o.seller_idx " +
                        "ORDER BY total_price DESC " +
                        `LIMIT ${limit};`
                }

                try {
                    let res = await this.jl.ajax("query",filter,"/api2/member_product.php");
                    this.data = res.data;
                }catch (e) {
                    alert(e.message)
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

</style>