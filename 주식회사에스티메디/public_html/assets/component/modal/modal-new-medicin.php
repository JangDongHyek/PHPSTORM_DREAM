<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div>
        <item-bs-modal :modal="modal" @close="$emit('close')">
            <template v-slot:header>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </template>

            <template v-slot:default>
                <div class="search">
                    <input type="search" v-model="filter.like_value" @keyup.enter="getData()" placeholder="원하시는 제품을 검색하세요" value=""/>
                    <button type="button" class="btn" @click="getData();"><i class="fa-regular fa-magnifying-glass"></i></button>
                </div>

                <ul class="drugs_list">
                    <li v-for="item,index in products">
                        <div class="flex">
                            <input v-if="version == 1" type="checkbox" name="" :value="item.idx" v-model="carts">
                            <input v-if="version == 2" type="checkbox" @click="emitProduct(item)">
                            <label>
                                <div>
                                    <p class="p_name">{{item.PRODUCT_NM}}</p>
                                    <span>제조사 <strong>{{item.MAKER_NM}}</strong> |</span>
                                    <span>규격 <strong>{{item.PRODUCT_STANDARD}}</strong> |</span>
                                    <!--<span>대체약  <strong>무코스타</strong></span>-->
                                </div>
                                <div class="area_text">
                                    <p class="p_price" v-if="INSU_CHECK == 'Y'">{{parseInt(item.INSU_PRICE).format()}}원</p>
                                    <p class="p_price" v-if="INSU_CHECK == 'N'">{{parseInt(item.UNIT_PRICE).format()}}원</p>
                                </div>
                            </label>
                        </div>
                    </li>

                </ul>

                <item-pagination :filter="filter" @change="changePage"></item-pagination>
            </template>


            <template v-slot:footer>
                <button type="button" class="btn btn_middle btn_blue" data-dismiss="modal">선택 완료</button>
            </template>
        </item-bs-modal>
    </div>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            modal : {type : Boolean, default : false},
            INSU_CHECK : {type : String, default : "N"},
            primary : {type : String, default : ""},
            carts : {type : Array, default : []},
            version : {type : String, default : 1}
        },
        data: function(){
            return {
                jl : null,
                component_idx : "",
                filter : {
                    page : 1,
                    limit : 6,
                    count : 0,
                    //order_by_desc : "insert_date",

                    del_yn : "N",
                    use_yn : "Y",
                    like_key : "PRODUCT_NM",
                    like_value : "",
                },
                required : [
                    {name : "",message : ""},
                ],
                products : [],
            };
        },
        created: function(){
            this.jl = new Jl('<?=$componentName?>');
            this.component_idx = this.jl.generateUniqueId();

            this.getData();
        },
        mounted: function(){
            this.$nextTick(() => {

            });
        },
        methods: {
            emitProduct(product) {
                this.$emit('close')
                console.log(product);

            },
            changePage(page) {
                this.filter.page = page;

                this.getData();
            },
            async getData() {
                try {
                    let res = await this.jl.ajax("get",this.filter,"/api/bs_product");
                    this.products = res.data
                    this.filter.count = res.count;
                }catch (e) {
                    alert(e.message)
                }
            }
        },
        computed: {

        },
        watch : {
            modal() {
                this.filter.page = 1;
                this.filter.like_value = "";
            },
            carts: {
                handler(newVal, oldVal) {
                    this.$emit('update:carts',newVal);
                },
                deep: true // 배열 내부의 변화를 감지
            }
        }
    });
</script>

<style>

</style>