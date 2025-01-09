<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div>
        <section id="first02">
            <div class="inr">
                <img src="<?= ASSETS_URL ?>/img/main/clip.png" class="clip">
                <div class="info">
                    <h6>STmedi <strong>에스티메디</strong>&nbsp;견적서</h6>
                </div>
                <div class="flex js info">
                    <p>공급자 <strong>에스티메디</strong>&nbsp;</p>
                    <span>
					<p>견적일 : <?php echo date('Y/m/d ', time()); ?></p>
					<p>&nbsp;| &nbsp; 견적번호 : <?php echo date('Ymd', time()); ?>0001</p>
				</span>
                </div>
                <div class="box_red">
                    <p>
                        <i class="fa-solid fa-triangle-exclamation"></i> 제품이 검색되지 않을 시, 성분명으로 검색해보세요.
                    </p>
                </div>

                <div class="btn_wrap btn_list">
                    <a class="btn btn_large btn_line" @click="postEstimate(1)"><i class="fa-duotone fa-solid fa-floppy-disk"></i> 견적 저장</a>
                    <a class="btn btn_large btn_line" @click="postEstimate(2)"" target="_blank"><i class="fa-duotone fa-solid fa-print"></i> 견적 출력</a>
                    <a class="btn btn_large btn_line" @click="postOrder()"><i class="fa-duotone fa-solid fa-bags-shopping"></i> 의약품 구매</a>
                </div>
                <section class="list_wrap">
                    <div class="table_total">
                        <h5 class="origin">
                            <span>기존 견적 금액</span>
                            <span><b>￦<em class="price-wrapper"><div class="price-slash"></div>{{originTotalPrice().format()}}</em></b></span>
                            <span class="txt_red txt_bold">&nbsp;<i class="fa-solid fa-down"></i> {{getDiscount()}}%</span>
                        </h5>
                        <h5>
                            <span>ST 견적 금액</span>
                            <span>일금 영 <b><em class="korUnit" data-number="900750">{{jl.numberToKorean(stTotalPrice())}}</em>원</b></span>
                            <span><b>( ￦<em>{{stTotalPrice().format()}}</em>)</b> ※부가세 포함</span>
                        </h5>
                    </div>
                    <div class="table_wrap table">
                        <table>
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>제품명</th>
                                <th>단가</th>
                                <th>처방수량(월)</th>
                                <th>기존합계</th>
                                <th>대체의약품</th>
                                <th>ST단가</th>
                                <th>ST합계</th>
                                <th>절감금액</th>
                            </tr>
                            </thead>
                            <tbody>
                            <template v-for="product,index in carts">
                                <tr v-if="product == 1">
                                    <td alt="No.">
                                        <p class="temp">-</p>
                                    </td>
                                    <td alt="제품명">
                                        <input type="text" value="제품을 선택하세요." readonly @click="new_modal = true;">
                                    </td>
                                    <td alt="단가" class="text_right">
                                        <p class="temp">단가</p>
                                    </td>
                                    <td alt="수량" class="text_right">
                                        <p class="temp">0</p>
                                    </td>

                                    <td alt="기존합계" class="text_right">
                                        <p class="temp">0</p>
                                    </td>
                                    <td alt="대체의약품">
                                        <p class="temp">대체의약품</p>
                                    </td>
                                    <td alt="ST단가" class="text_right">
                                        <p class="temp">0</p>
                                    </td>
                                    <td alt="ST합계" class="text_right">
                                        <p class="temp">0</p>
                                    </td>
                                    <td alt="절감금액" class="text_right">
                                        <p class="temp">0</p>
                                    </td>
                                </tr>
                                <tr v-else>
                                    <td alt="No.">
                                        <p>{{index+1}} <button type="button" class="btn btn_mini btn_black" @click="deleteCart(index)"><i class="fa-solid fa-trash"></i></button></p>
                                    </td>
                                    <td alt="제품명">
                                        <input type="text" :value="product.PRODUCT_NM" readonly>
                                    </td>
                                    <td alt="규격단가" class="text_right">
                                        <input type="number" v-model="product.new_standard_price" @keydown="jl.isNumberKey">
                                    </td>
                                    <td alt="수량">
                                        <div class="number_controller">
                                            <button type="button" @click="product.new_amount > 1 ? product.new_amount-- : product.new_amount"><i class="fa-regular fa-minus"></i></button>
                                            <input type="number" name="inputNumber" v-model="product.new_amount" @keydown="jl.isNumberKey"/>
                                            <button type="button" @click="product.new_amount++"><i class="fa-regular fa-plus"></i></button>
                                        </div>
                                    </td>

                                    <td alt="기존합계" class="text_right">
                                        <p><b><em>기존합계</em>{{(product.new_standard_price * product.new_amount).format()}}</b></p>
                                    </td>
                                    <td alt="대체의약품">
                                        <p>
                                            <b>{{getReplace(product).PRODUCT_NM}}</b>
                                            <!--<button type="button" data-toggle="modal" data-target="#moreModal1" class="btn btn_mini btn_black">변경</button>-->
                                        </p>
                                    </td>
                                    <td alt="ST단가" class="text_right">
                                        <p><em>ST단가</em><b>{{getPrice(getReplace(product)).format()}}</b></p>
                                    </td>
                                    <td alt="ST합계" class="text_right">
                                        <p><em>ST합계</em><b>{{(getPrice(getReplace(product)) * product.new_amount).format()}}</b></p>
                                    </td>
                                    <td alt="절감금액" class="text_right">
                                        <p class="txt_red"><em>절감금액</em><b>
                                                {{ ((product.new_standard_price * product.new_amount) - (getPrice(getReplace(product)) * product.new_amount)).format() }}
                                            </b></p>
                                    </td>
                                </tr>
                            </template>

                            <tr>
                                <td colspan="99">
                                    <button type="button" class="btn btn_mini btn_black" @click="new_modal = true;">추가</button>
                                </td>
                            </tr>

                            <tr class="bg2">
                                <td alt="계" colspan="5" class="text_right">
                                    기존합계
                                </td>
                                <td alt="기존합계" colspan="2" class="text_right">
                                    <p>{{originTotalPrice().format()}}</p>
                                </td>
                                <td alt="계" colspan="1" class="text_right">
                                    ST합계
                                </td>
                                <td alt="ST합계" colspan="2" class="text_right">
                                    <p>{{stTotalPrice().format()}}</p>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="total_table table flex">
                        <table>
                            <colgroup>
                                <col style="width: 50%">
                                <col style="width: 50%">
                            </colgroup>
                            <thead>
                            <tr>
                                <th>기존 합계</th>
                                <th>ST 합계</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{originTotalPrice().format()}}</td>
                                <td>{{stTotalPrice().format()}}</td>
                            </tr>
                            </tbody>
                        </table>
                        <table>
                            <colgroup>
                                <col style="width: 50%">
                                <col style="width: 50%">
                            </colgroup>
                            <thead>
                            <tr>
                                <th>차액</th>
                                <th>절감 %</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{(originTotalPrice() - stTotalPrice()).format()}}</td>
                                <td class="txt_red">
                                    {{getDiscount()}}%
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </section>
            </div>
        </section>

        <button type="button" class="btn btn_ani btn_large" @click="postOrder();"><i class="fa-solid fa-pills"></i> 의약품 바로구매</button>

        <modal-new-medicin :modal="new_modal" @close="new_modal = false;" :INSU_CHECK="INSU_CHECK" :carts.sync="carts"
                           version="2" :mb_id="mb_id"
        ></modal-new-medicin>

        <form name="order" autocomplete="off" method="post">
            <input type="hidden" name="productIdx"/> <!--상품인덱스-->
            <input type="hidden" name="productCnt"/> <!--구매수량-->
            <input type="hidden" name="totalPrice"/> <!--총상품금액-->
        </form>
    </div>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            mb_id : {type : String, default : ""},
            INSU_CHECK : {type : String, default : "N"},
            primary : {type : String, default : ""}
        },
        data: function(){
            return {
                jl : null,
                component_idx : "",
                filter : {
                    page : 0,
                    limit : 0,
                    count : 0,
                },
                required : [
                    {name : "",message : ""},
                ],
                data : [],
                carts : [1,1,1,1,1,1,1,1,1,1],

                new_modal : false,
            };
        },
        created: function(){
            this.jl = new Jl('<?=$componentName?>');
            this.component_idx = this.jl.generateUniqueId();

            if(this.primary) this.getEstimate();
        },
        mounted: function(){
            this.$nextTick(() => {

            });
        },
        methods: {
            async getEstimate() {
                try {
                    let filter = {
                        idx : this.primary
                    };
                    let res = await this.jl.ajax("get",filter,"/api/bs_estimate");
                    //this.data = res.data[0]
                    this.carts = res.data[0].contents;
                }catch (e) {
                    alert(e.message)
                }
            },
            getDiscount() {
                let origin = this.originTotalPrice()
                let st = this.stTotalPrice();
                let result = ((origin - st) / origin * 100).toFixed(2)
                if(isNaN(result)) return 0
                return result;
            },
            async postEstimate(type) {
                let method = this.primary ? "update" : "insert";

                let bool = true
                for(let cart of this.carts) {
                    if(cart == 1) continue;
                    bool = false
                }

                if(bool) {
                    alert("등록된 상품이 없습니다.");
                    return false;
                }

                let obj = {
                    mb_id : this.mb_id,
                    contents : this.carts
                }

                if(this.primary) obj.idx = this.primary;

                try {
                    //if(!this.data.change_user_pw) throw new Error("비밀번호를 입력해주세요.");
                    let res = await this.jl.ajax(method,obj,"/api/bs_estimate");
                    if(type == 1) window.location.href = "./estimate";
                    else window.location.href = "./estimatePrint?idx=" + res.idx;

                }catch (e) {
                    alert(e.message)
                }
            },
            stTotalPrice() {
                let price = 0;

                for(let product of this.carts) {
                    if(product === 1 || typeof product !== 'object') continue;

                    price += this.getPrice(this.getReplace(product)) * product.new_amount;
                }

                return price;
            },
            originTotalPrice() {
                let price = 0;

                for(let product of this.carts) {
                    if(product === 1 || typeof product !== 'object') continue;
                    price += product.new_standard_price * product.new_amount;
                }

                return price;
            },
            getReplace(product) {
                if(product.REPLACE_PRODUCTS.length == 0) return product;

                return product.REPLACE_PRODUCTS[0]['$info'];
            },
            deleteCart(index) {
                this.carts.splice(index,1);
                this.carts.push(1);
            },
            getPrice(product) {
                //if(this.INSU_CHECK == "Y") return product.INSU_PRICE;
                //
                //if(product.prod_price == 0) return product.INSU_PRICE;
                //
                //return product.prod_price;
                console.log(product)
                return product.standard_price;
            },
            async getData() {
                try {
                    let res = await this.jl.ajax("get",this.filter,"/api/example.php");
                    this.data = res.data[0]
                }catch (e) {
                    alert(e.message)
                }
            },
            async postOrder() {
                let vue = this;
                let productIdx = "";
                let productCnt = "";
                let totalPrice = "0";
                let cartIdx = [];

                let newCart = [];
                for (const product of this.carts) {
                    if(product == 1) continue;
                    let replace = this.getReplace(product);

                    let obj = {
                        add_cart_yn: "N",
                        mb_id: vue.mb_id,
                        product_idx: replace.idx,
                        //product_cnt: product.new_amount,
                        product_cnt: 1,
                        reg_date: "now()",
                        ord_idx: 0
                    };

                    //let cartIdx = newCart.findIndex(item => item['product_idx'] === obj.product_idx);
                    let idx = this.jl.findObject(newCart,"product_idx",obj.product_idx,false,true)
                    console.log(idx);
                    if(idx !== -1) newCart[idx].product_cnt += 1;
                    else newCart.push(obj);
                }

                if(newCart.length == 0) {
                    alert("등록된 의약품이 없습니다.");
                    return false;
                }

                try {
                    for (const product of newCart) {
                        if (productIdx) productIdx += ",";
                        productIdx += product.idx;

                        if (productCnt) productCnt += ",";
                        productCnt += product.product_cnt;

                        // Ensure vue.jl.ajax returns a Promise to use await here
                        let res = await vue.jl.ajax("insert", product, "/api/bs_product_cart");
                        let idx = res.idx
                        cartIdx.push(idx);
                    }
                }catch (e) {
                    alert(e.message)
                    return false;
                }

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