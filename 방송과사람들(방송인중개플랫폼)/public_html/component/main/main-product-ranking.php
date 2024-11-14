<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div class="tab-pane fade in active" id="tab1">
        <ul>
            <li>
                <p class="icon"><i class="fa-duotone fa-medal"></i></p>
                <div class="img">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/noimg.jpg">
                </div>
                <div class="text">
                    <div class="name">
                        <p class="photo"><img src="<?php echo G5_THEME_IMG_URL ?>/noimg.jpg"></p>
                        <strong>배우 안효섭</strong>
                    </div>
                    <div class="price">322,546,560원</div>
                </div>
            </li>
            <li>
                <p class="icon"><strong>2</strong>위</p>
                <div class="img">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/noimg.jpg">
                </div>
                <div class="text">
                    <div class="name">
                        <p class="photo">
                            <img src="<?php echo G5_THEME_IMG_URL ?>/noimg.jpg">
                        </p>
                        <strong>배우 안효섭</strong>
                    </div>
                    <div class="price">322,546,560원</div>
                </div>
            </li>
            <li>
                <p class="icon"><strong>3</strong>위</p>
                <div class="img">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/noimg.jpg">
                </div>
                <div class="text">
                    <div class="name">
                        <p class="photo">
                            <img src="<?php echo G5_THEME_IMG_URL ?>/noimg.jpg">
                        </p>
                        <strong>배우 안효섭</strong>
                    </div>
                    <div class="price">322,546,560원</div>
                </div>
            </li>
        </ul>
        <button type="button" class="btn">더보기 <i class="fa-light fa-angle-down"></i></button>
    </div>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            primary : {type : String, default : ""}
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

                data : [],
                modal : false,
            };
        },
        created: function(){
            this.jl = new JL('<?=$componentName?>');

            this.getData();
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
            async getData() {
                let filter = {
                    query : "SELECT o.seller_idx, sum(o.price) as total_price FROM `member_order` as o JOIN member_product as p on o.product_idx = p.idx group by o.seller_idx order by total_price desc"
                }

                try {
                    let res = await this.jl.ajax("query",filter,"/api2/member_product.php");
                    console.log(res);
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