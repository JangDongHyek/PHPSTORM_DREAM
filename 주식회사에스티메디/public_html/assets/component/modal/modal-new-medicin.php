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
                            <input v-if="version == 1" :id="'item_id' + item.idx" type="checkbox" name="" :value="item.idx" v-model="carts">
                            <input v-if="version == 2" :id="'item_id' + item.idx" type="checkbox" :checked="isCarts(item)" @click="event.preventDefault(); emitProduct(item)">
                            <label :for="'item_id' + item.idx">
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

                    <li class="noDataAlign" id="mediRequest" v-if="search && products.length == 0">
						<i class="fa-solid fa-house-medical-circle-xmark"></i><br>
                    	등록된 상품이 없습니다.<br>
                    	<button type="button" class="btn btn_blue" @click="postRequest()">약품 입고 요청</button>
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
            mb_id : {type : String, default : ""},
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
                search : false,
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
            async postRequest() {
                if(!confirm(`${this.filter.like_value} 상품을 입고 요청 하시겠습니까?`)) return false;

                let obj = {
                    mb_id : this.mb_id,
                    content : this.filter.like_value,
                    status : "",
                }
                try {
                    let res = await this.jl.ajax("insert",obj,"/api/bs_product_request");

                    alert("완료 되었습니다");
                }catch (e) {
                    alert(e.message)
                }

            },
            isCarts(product) {
                return this.carts.some((cart) => cart.idx == product.idx);
            },
            emitProduct(product) {
                if(!confirm("해당 상품을 선택 하시겠습니까?")) return false;
                this.$set(product,'new_amount',1);
                let bool = false
                let carts = this.carts
                let index = 0;
                for(const item of carts) {
                    if(item == 1) {
                        carts[index] = product;
                        bool = true;
                        break;
                    }else {
                        if(item.idx == product.idx) {
                            alert("이미 등록된 상품입니다.");
                            return false;
                        }
                    }
                    index++;
                }

                if(!bool) this.carts.push(product);

                this.$emit('close')

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
                    this.search = true;
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

                if(this.modal && this.version == 2) this.getData();
                if(!this.modal) {
                    this.products = [];
                    this.search = false;
                }
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
