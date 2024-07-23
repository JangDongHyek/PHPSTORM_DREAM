<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div>
        <div id="sub_cate2">
            <dl>
                <dt><i class="fa-brands fa-elementor"></i>{{category.parent ? category.parent.name : category.name}}</dt>
                <dd>
                    <a :href="JL_base_url + '/bbs/item_list.php?ctg=' + item.idx" v-for="item in (category.parent ? category.parent.childs : category.childs)">
                        {{item.name}}
                    </a>
                </dd>
            </dl>
        </div>

        <div class="inr">
            <ul id="area_history">
                <li><a href="">홈</a></li>
                <li v-if="category.parent"><a href="">{{category.parent.name}}</a></li>
                <li><a href="" class="current">{{category.name}}</a></li>
            </ul>
            <div id="list_top">
                <div class="total">총 1건</div>
                <div class="sort_list">
                    <span data-toggle="modal" data-target="#listModal">최신순</span>
                </div>
            </div>
            <ul id="product_list">
                <li class="nodata" v-if="total == 0">
                    <div class="nodata_wrap">
                        <div class="area_img"><img src="<?php echo G5_THEME_IMG_URL ?>/app/img_nodata.svg"></div>
                        <p>등록된 재능이 없습니다.</p>
                    </div>
                </li>

                <li v-else>
                    <i onclick="heart_click(15,this)" class="heart"></i>
                    <a href="https://itforone.com:443/~broadcast/bbs/item_view.php?idx=15">
                        <div class="area_img">
                            <img src="https://itforone.com:443/~broadcast/data/file/main_img/0_2039270465__d3e9d3a90aff883a7a587b48a12d57dd7db70d9c.jpg">
                        </div>
                        <div class="area_txt">
                            <span></span> <h3>영상제작</h3>
                            <div class="star"><i></i><em>5.0</em></div>
                            <div class="price">50,000원 </div>
                        </div>
                    </a>
                </li>


            </ul>




        </div>
    </div>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            parent_idx : {type : String,default : ""}
        },
        data: function(){
            return {
                jl : null,
                filter : {
                    idx : this.parent_idx
                },
                data : {

                },
                category : {},
                total : 0
            };
        },
        created: function(){
            this.jl = new JL('<?=$componentName?>');
            this.getCategory()
        },
        mounted: function(){
            this.$nextTick(() => {

            });
        },
        methods: {
            getCategory: function () {
                var method = "get";
                var filter = JSON.parse(JSON.stringify(this.filter));

                var objs = {
                    _method: method,
                    filter: JSON.stringify(filter)
                };

                var res = ajax("/api/category.php", objs);
                if (res) {
                    this.jl.log(res)
                    this.category = res.response.data[0]
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