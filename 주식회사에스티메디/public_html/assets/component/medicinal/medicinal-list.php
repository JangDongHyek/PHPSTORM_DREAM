<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <section id="user" class="ver2">
        <div class="location">
            <i class="fa-light fa-house-blank"></i> 홈 <i class="fa-light fa-angle-right"></i> <strong>의약품</strong>
        </div>
        <div class="inr flex js">
            <section>
                <h6>최근 주문
                    <button type="button" class="btn" id="listOpen1">접기</button>
                </h6>
                <div class="w100"><!--임시-->
                    <template v-for="order in orders">
                        <div class="flex js sub" id="drugs_list_recent">
                        <span class="flex gap10 ai-c w100">
                            <strong>주문일 <b class="txt_blue">{{order.reg_date.split(' ')[0]}}</b></strong>
                            <button type="button" class="btn male-auto btn_blueline" @click="orderToCart(order)">전체 담기</button>
                        </span>
                        </div>
                        <div class="drugs_list my_list">
                            <ul>
                                <li v-for="product in order.PRODUCTS">
                                    <div class="flex">
                                        <input type="checkbox" :value="product.INFO.idx" v-model="carts">
                                        <label for="checkIdx_recent1">
                                            <div>
                                                <p class="p_name">
                                                    {{product.INFO.PRODUCT_NM}}
                                                </p>
                                                <span>제조사 <strong>{{product.INFO.MAKER_NM}}</strong> |</span>
                                                <span>규격 <strong>{{product.INFO.PRODUCT_STANDARD}}</strong> |</span><br class="visible-xs">
                                                <span>성분명 <strong>{{product.INFO.CONS_CD_NM}}</strong> |</span>
                                                <span>재고수량  <strong>{{product.INFO.STOCK_QTY}}</strong></span>
                                            </div>
                                            <div class="area_text" v-if="INSU_CHECK == 'Y'">
												<p class="p_date"><span>개당 {{parseInt(product.INFO.INSU_PRICE).format()}}</span><br><b>{{product.item_cnt}}</b>개 구매</p>
                                                <p class="p_price" style="display: none">{{(product.INFO.INSU_PRICE * product.item_cnt)}}원</p>
                                                <p style="font-weight: 700;text-align: right;">{{(product.INFO.INSU_PRICE * product.item_cnt).format()}}원</p>
                                            </div>

                                            <div class="area_text" v-if="INSU_CHECK == 'N'">
                                                <p class="p_date"><span>개당 {{parseInt(product.INFO.UNIT_PRICE).format()}}</span><br><b>{{product.item_cnt}}</b>개 구매</p>
                                                <p class="p_price" style="display: none">{{(product.INFO.UNIT_PRICE * product.item_cnt)}}원</p>
                                                <p style="font-weight: 700;text-align: right;">{{(product.INFO.UNIT_PRICE * product.item_cnt).format()}}원</p>
                                            </div>
                                        </label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </template>

                    <item-pagination :filter="filter" @change="changePage"></item-pagination>
                </div>

            </section>
            <section id="simple">
                <h6>주문하기
                    <button type="button" class="btn" id="listOpen2">접기</button>
                </h6>

                <div>
                    <div class="flex gap10">

                        <button type="button" class="btn btn_large btn_blue" @click="new_modal=true;"><i class="fa-solid fa-cart-plus"></i> 신규약 담기</button>
                        <button type="button" class="btn btn_large btn_green" @click="postOrder()"><i class="fa-solid fa-bags-shopping"></i> 주문하기</button>
                    </div>
                    <div class="drugs_list">
                        <ul id="drugs_list">
                            <li v-for="product,index in cart_products">
                                <div class="flex">
                                    <button type="button" class="delete" @click="deleteCart(product.idx)"><i class="fa-solid fa-x"></i></button>
                                    <input type="checkbox" name="checkIdx" :value="product.idx" v-model="carts">
                                    <label>
                                        <div>
                                            <p class="p_name">
                                                {{product.PRODUCT_NM}}
                                            </p>
                                            <span>제조사 <strong>{{product.MAKER_NM}}</strong> |</span>
                                            <span>규격 <strong>{{product.PRODUCT_STANDARD}}</strong> |</span><br class="visible-xs">
                                            <span>성분명 <strong>{{product.CONS_CD_NM}}</strong> |</span>
                                            <span>재고수량  <strong>{{product.STOCK_QTY}}</strong></span>
                                        </div>
                                        <div class="area_text">
                                            <p class="p_price" v-if="INSU_CHECK == 'Y'">{{(product.INSU_PRICE * product.new_amount).format()}}원</p>
                                            <p class="p_price" v-if="INSU_CHECK == 'N'">{{(product.UNIT_PRICE * product.new_amount).format()}}원</p>
                                        </div>
                                    </label>
                                </div>

                                <div class="flex ai-e">
                                    <div class="more" @click="same_modal_product = product; same_modal = true;">
                                        <i class="fa-regular fa-arrow-turn-down-right"></i>
                                        <span><b>대체약</b>({{product.OTHER_PRODUCTS.length}})</span>
                                    </div>

                                    <div class="number_controller">
                                        <button type="button" @click="setAmount(product,product.new_amount-1)"><i class="fa-regular fa-minus"></i></button>
                                        <input type="number" name="inputNumber" v-model="product.new_amount" value="" readonly>
                                        <button type="button"  @click="setAmount(product,product.new_amount+1)"><i class="fa-regular fa-plus"></i></button>
                                    </div>
                                </div>
                            </li>
                            <li class="empty" v-if="cart_products.length == 0">
                                <p>담은 상품이 없습니다.</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </section>
        </div>

        <modal-new-medicin :modal="new_modal" @close="new_modal = false;" :carts.sync="carts"
                           :INSU_CHECK="INSU_CHECK"
        ></modal-new-medicin>

        <modal-same-medicin :modal="same_modal" @close="same_modal = false;" :product="same_modal_product" :carts.sync="carts"
                            :INSU_CHECK="INSU_CHECK"
        ></modal-same-medicin>

        <form name="order" autocomplete="off" method="post">
            <input type="hidden" name="productIdx" v-modal="productIdx"/> <!--상품인덱스-->
            <input type="hidden" name="productCnt" v-modal="productCnt"/> <!--구매수량-->
            <input type="hidden" name="totalPrice" v-modal="totalPrice"/> <!--총상품금액-->
        </form>
    </section>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            mb_id : {type : String, default : ""},
            INSU_CHECK : {type : String, default : "N"},
            primary : {type : String, default : ""},
        },
        data: function(){
            return {
                jl : null,
                component_idx : "",
                filter : {
                    page : 1,
                    limit : 6,
                    count : 0,

                    mb_id : this.mb_id,
                    order_by_desc : "reg_date",
                },

                orders : [],
                modal : false,
                cart_products : [],
                carts : [],

                new_modal : false,
                same_modal : false,
                same_modal_product : null,

                productIdx : "",
                productCnt : "",
                totalPrice : "",
            };
        },
        created: function(){
            this.jl = new Jl('<?=$componentName?>');
            this.component_idx = this.jl.generateUniqueId();

            console.log(this.INSU_CHECK);
            this.getOrders();
        },
        mounted: function(){
            this.$nextTick(() => {
                let a1 = document.querySelector('#listOpen1');
                a1.addEventListener('click', function () {
                    if (a1.classList.contains('on')) {
                        a1.classList.remove('on');
                        a1.innerText = "접기";
                    } else {
                        a1.classList.add('on');
                        a1.innerText = "열기";
                    }
                });

                let b1 = document.querySelector('#listOpen2');
                b1.addEventListener('click', function () {
                    if (b1.classList.contains('on')) {
                        b1.classList.remove('on');
                        b1.innerText = "접기";
                    } else {
                        b1.classList.add('on');
                        b1.innerText = "열기";
                    }
                });
            });
        },
        methods: {
            async postOrder() {
                let vue = this;
                let productIdx = "";
                let productCnt = "";
                let totalPrice = "0";
                let cartIdx = [];
                try {
                    for (const product of this.cart_products) {
                        let obj = {
                            add_cart_yn: "N",
                            mb_id: vue.mb_id,
                            product_idx: product.idx,
                            product_cnt: product.new_amount,
                            reg_date: "now()",
                            ord_idx: 0
                        };

                        if (productIdx) productIdx += ",";
                        productIdx += product.idx;

                        if (productCnt) productCnt += ",";
                        productCnt += product.new_amount;

                        // Ensure vue.jl.ajax returns a Promise to use await here
                        let res = await vue.jl.ajax("insert", obj, "/api/bs_product_cart");
                        let idx = res.idx
                        cartIdx.push(idx);
                    }
                }catch (e) {
                    alert(e.message)
                }

                this.productIdx = productIdx;
                this.productCnt = productCnt;
                this.totalPrice = totalPrice;

                let order_form = document.order;

                order_form.productIdx.value = productIdx;
                order_form.productCnt.value = productCnt;
                order_form.totalPrice.value = totalPrice;

                //
                for (let i = 0; i < cartIdx.length; i++) {
                    let input = document.createElement("input");
                    input.type = "hidden";
                    input.name = "cartIdx[]";
                    input.value = cartIdx[i];
                    console.log(cartIdx[i])
                    order_form.appendChild(input);
                }


                //
                order_form.action = baseUrl + 'orderSheet';
                order_form.submit();
            },
            setAmount(product,amount) {
                if(amount < 1) return false;
                if(product.STOCK_QTY < amount) return false;
                product.new_amount = amount;
            },
            changePage(page) {
                this.filter.page = page;

                this.getOrders();
            },
            deleteCart(idx) {
                let index = this.carts.findIndex(item => item == idx);
                if(index !== -1) {
                    this.carts.splice(index,1);
                }
            },
            orderToCart(order) {
                let carts = this.carts
                order.PRODUCTS.forEach(function(product) {
                    let product_idx = product.INFO.idx;

                    let index = carts.findIndex(item => item == product_idx);
                    if(index == -1) {
                        carts.push(product_idx)
                    }
                });
            },
            async getOrders() {
                try {
                    let res = await this.jl.ajax("get",this.filter,"/api/bs_order");
                    this.orders = res.data
                    this.filter.count = res.count;
                }catch (e) {
                    alert(e.message)
                }
            },
            async getProducts() {
                if(this.carts.length == 0) {
                    this.cart_products = [];
                    return false;
                }

                let obj = {
                    in_key1 : "idx",
                    in_value1 : this.carts
                };

                try {
                    let res = await this.jl.ajax("get",obj,"/api/bs_product");
                    res.data.forEach(function(item) {
                        item.new_amount = 1;
                    });
                    this.cart_products = res.data;



                }catch (e) {
                    alert(e.message)
                }
            }
        },
        computed: {

        },
        watch : {
            carts: {
                handler(newVal, oldVal) {
                    this.getProducts();
                },
                deep: true // 배열 내부의 변화를 감지
            }
        }
    });
</script>
