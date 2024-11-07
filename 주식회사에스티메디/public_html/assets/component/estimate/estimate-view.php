<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div>
        <div class="btn_wrap">
            <?/*a class="btn btn_small" onclick="">삭제</a>
		<a class="btn btn_small btn_gray" href="">수정</a*/?>
            <a class="btn btn_small btn_black" :href="'./estimatePrint?idx='+primary" target="_blank">출력</a>
            <a class="btn btn_small btn_blueline" @click="postOrder();">구매</a>
            <a class="btn btn_small btn_blue male-auto" href="./estimate">목록</a>
        </div>

        <div class="board_view">
            <div class="boxline">
                <div class="title">
                    <div class="info">
                        작성일 <p>{{data.insert_date}}</p>
                    </div>
                </div>


                <div class="view">
                    <section class="list_wrap">
                        <h6 class="table_total">
                            <span>ST 견적 금액</span>
                            <span>일금 영 <b><em class="korUnit" data-number="900750">{{jl.numberToKorean(stTotalPrice())}}</em>원</b></span>
                            <span><b>( ￦<em>{{stTotalPrice().format()}}</em>)</b> ※부가세 포함</span>
                        </h6>
                        <div class="table_wrap table">
                            <table>
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>제품명</th>
                                    <th>규격단가</th>
                                    <th>처방수량(월)</th>
                                    <th>기존합계</th>
                                    <th>대체의약품</th>
                                    <th>ST단가</th>
                                    <th>ST합계</th>
                                    <th>절감금액</th>
                                </tr>
                                </thead>
                                <tbody>
                                <template v-for="product,index in data.contents">
                                    <tr v-if="product == 1">
                                        <td alt="No.">
                                            <p class="temp">-</p>
                                        </td>
                                        <td alt="제품명">
                                            <p class="temp">제품명</p>
                                        </td>
                                        <td alt="포장단위" class="text_right">
                                            <p class="temp">규격단가</p>
                                        </td>
                                        <td alt="수량" class="text_right">
                                            <p class="temp">0</p>
                                        </td>
                                        <td alt="기존합계" class="text_right">
                                            <p class="temp">0</p>
                                        </td>
                                        <td alt="대체품목">
                                            <p class="temp">대체품목</p>
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
                                            <p>{{index+1}}</p>
                                        </td>
                                        <td alt="제품명">
                                            {{product.PRODUCT_NM}}
                                        </td>
                                        <td alt="규격단가" class="text_right">
                                            <p><em>규격단가</em>{{product.standard_price}}</p>
                                        </td>
                                        <td alt="수량">
                                            {{product.new_amount}}
                                        </td>

                                        <td alt="기존합계" class="text_right">
                                            <p><b><em>기존합계</em>{{(getPrice(product) * product.new_amount).format()}}</b></p>
                                        </td>
                                        <td alt="대체품목">
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
                                                    {{ ((getPrice(product) * product.new_amount) - (getPrice(getReplace(product)) * product.new_amount)).format() }}
                                                </b></p>
                                        </td>
                                    </tr>
                                </template>
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
                                        {{
                                        isNaN(stTotalPrice() / originTotalPrice())
                                        ? 0 : ((stTotalPrice() / originTotalPrice()) * 100).toFixed(2)
                                        }}%
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </section>
                </div>

            </div>
        </div>

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
            primary : {type : String, default : ""},
        },
        data: function(){
            return {
                jl : null,
                component_idx : "",
                filter : {
                    primary : this.primary
                },
                data : {},
            };
        },
        created: function(){
            this.jl = new Jl('<?=$componentName?>');
            this.component_idx = this.jl.generateUniqueId();

            if(this.primary) this.getData();
        },
        mounted: function(){
            this.$nextTick(() => {

            });
        },
        methods: {
            stTotalPrice() {
                let price = 0;

                for(let product of this.data.contents) {
                    if(product === 1 || typeof product !== 'object') continue;

                    price += this.getPrice(this.getReplace(product)) * product.new_amount;
                }

                return price;
            },
            originTotalPrice() {
                let price = 0;

                for(let product of this.data.contents) {
                    if(product === 1 || typeof product !== 'object') continue;
                    price += this.getPrice(product) * product.new_amount;
                }

                return price;
            },
            getReplace(product) {
                if(product.REPLACE_PRODUCTS.length == 0) return product;

                return product.REPLACE_PRODUCTS[0]['$info'];
            },
            getPrice(product) {
                //if(this.INSU_CHECK == "Y") return product.INSU_PRICE;
                //
                //if(product.prod_price == 0) return product.INSU_PRICE;
                //
                //return product.prod_price;

                return product.standard_price;
            },
            async getData() {
                try {
                    let res = await this.jl.ajax("get",this.filter,"/api/bs_estimate");
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

                let bool = true;

                try {
                    for (const product of this.data.contents) {
                        if(product == 1) continue;
                        bool = false

                        let replace = this.getReplace(product);
                        let obj = {
                            add_cart_yn: "N",
                            mb_id: vue.mb_id,
                            product_idx: replace.idx,
                            product_cnt: product.new_amount,
                            reg_date: "now()",
                            ord_idx: 0
                        };

                        if (productIdx) productIdx += ",";
                        productIdx += replace.idx;

                        if (productCnt) productCnt += ",";
                        productCnt += product.new_amount;

                        // Ensure vue.jl.ajax returns a Promise to use await here
                        let res = await vue.jl.ajax("insert", obj, "/api/bs_product_cart");
                        let idx = res.idx
                        cartIdx.push(idx);
                    }
                }catch (e) {
                    alert(e.message)
                    return false;
                }

                if(bool) {
                    alert("등록된 의약품이 없습니다.");
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