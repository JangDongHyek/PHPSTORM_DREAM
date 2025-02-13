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
                    <input type="search" v-model="filter.group_like_value" @keyup.enter="filter.page = 1; getData()" placeholder="원하시는 제품을 검색하세요" value=""/>
                    <button type="button" class="btn" @click="filter.page = 1; getData();"><i class="fa-regular fa-magnifying-glass"></i></button>
                </div>

                <ul class="drugs_list">
                    <li v-for="item,index in products">
                        <div class="flex">
                            <input v-if="version == 1" :id="'item_id' + item.idx" type="checkbox" :checked="isCarts2(item)" @click="addCart(item)">
                            <input v-if="version == 2" :id="'item_id' + item.idx" type="checkbox" :checked="isCarts(item)" @click="event.preventDefault(); emitProduct(item)">
                            <label :for="'item_id' + item.idx">
                                <div>
                                    <p class="p_name">{{item.PRODUCT_NM}}</p>
                                    <span>제조사 <strong>{{item.MAKER_NM}}</strong> |</span>
                                    <span>규격 <strong>{{item.PRODUCT_STANDARD}}</strong> |</span>
                                    <!--<span>대체약  <strong>무코스타</strong></span>-->
                                </div>
                                <div class="area_text">
                                    <template v-if="item.sell_yn == 'N'">
                                        <a class="btn btn_blue" @click="event.preventDefault(); addCart(item)">제품문의</a>
                                    </template>
                                    <template v-else>
                                        <p class="p_price">{{getPrice(item)}}원</p>
                                    </template>
                                </div>
                            </label>
                        </div>
                    </li>

                    <li class="noDataAlign" id="mediRequest" v-if="search && products.length == 0">
						<i class="fa-solid fa-house-medical-circle-xmark"></i><br>
                    	등록된 상품이 없습니다.<br>
                    	<button type="button" class="btn btn_blue" @click="postRequest()">제품문의</button>
                    </li>
                </ul>

                <item-pagination :filter="filter" @change="changePage"></item-pagination>
            </template>


            <template v-slot:footer>
                <!--<button type="button" class="btn btn_middle btn_blue" data-dismiss="modal">선택 완료</button>-->
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
            version : {type : String, default : 1} // 1 의약품 2 비교견적
        },
        data: function(){
            return {
                jl : null,
                component_idx : "",
                filter : {
                    page : 1,
                    limit : 6,
                    count : 0,
                    order_by_desc : "sell_yn",

                    del_yn : "N",
                    use_yn : "Y",
                    USE_GU_YN : "Y",
                    group_like_key : "PRODUCT_NM",
                    group_like_value : "",
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
            getPrice(item) {
                let price;
                if(this.INSU_CHECK == "Y") {
                    price =item.INSU_PRICE

                    if(!price) {
                        price = item.prod_price;
                    }
                }else {
                    price = item.prod_price

                    if(!price) {
                        price = item.INSU_PRICE;
                    }
                }

                if (typeof price === 'string' && price.includes(',')) {
                    return price; // ','가 있으면 그대로 반환
                }

                price = parseInt(price)

                return price.format();
            },
            async postRequest(product = null) {
                let content;
                if(product) {
                    content = product.PRODUCT_NM
                }else {
                    if(!confirm(`${this.filter.like_value} 상품을 제품문의 하시겠습니까?`)) return false;
                    content = this.filter.like_value
                }


                let obj = {
                    mb_id : this.mb_id,
                    content : content,
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
            isCarts2(product) {
                return this.carts.includes(product.idx);
            },
            addCart(product) {
                if(product.sell_yn == "N") {
                    event.preventDefault();
                    if(!confirm("해당 상품은 재고가 없습니다. 제품문의 하시겠습니까?")) return false;
                    this.postRequest(product)
                    return false;
                }

                this.carts.push(product.idx)
            },
            emitProduct(product) {
                //if(!confirm("해당 상품을 선택 하시겠습니까?")) return false;
                if(product.sell_yn == "N") {
                    if(!product.REPLACE_PRODUCTS.length) {
                        if(!confirm("해당 상품은 재고가 없습니다. 제품문의 하시겠습니까?")) return false;
                        this.postRequest(product)
                        return false;
                    }
                }
                this.$set(product,'new_amount',1);
                this.$set(product,'new_standard_price',0);

                console.log(11)
                console.log(product)
                let insu_price = product.INSU_PRICE
                if(typeof insu_price === "string") insu_price = parseInt(insu_price.replace(/,/g, "").split(".")[0], 10);
                console.log(22)

                product.new_standard_price = insu_price / product.ACC_UNIT;
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

                console.log(product)
                if(!bool) this.carts.push(product);

                this.$emit('close')

            },
            changePage(page) {
                this.filter.page = page;

                this.getData();
            },
            async getData() {
                try {
                    let filter = this.filter
                    filter.group_like_key2 = "keyword";
                    filter.group_like_value2 = filter.group_like_value;

                    let res = await this.jl.ajax("get",filter,"/api/bs_product");
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
                if(!this.modal && this.version == 2) {
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
