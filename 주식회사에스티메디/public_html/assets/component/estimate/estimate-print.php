<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div>
        <h3 class="text-center">견적서</h3>
        <div class="table flex top">
            <div class="info">
                <h6>{{jl.dateToKorean(data.insert_date)}}</h6>
                <h6>{{member.mb_name}} 귀하</h6>
                <p>아래와 같이 견적합니다</p>
            </div>
            <table>
                <colgroup>
                    <col width="15%">
                    <col width="*">
                    <col width="15%">
                    <col width="25%">
                </colgroup>
                <tbody>
                <tr>
                    <th>등록번호</th>
                    <td colspan="3">{{member.biz_rno}}</td>
                </tr>
                <tr>
                    <th>상호</th>
                    <td>{{member.mb_name}}</td>
                    <th>성명</th>
                    <td>{{member.rep_name}}</td>
                </tr>
                <tr>
                    <th>주소</th>
                    <td colspan="3">{{member.cn_addr}} {{member.cn_addr_detail}}</td>
                </tr>
                <tr>
                    <th>전화번호</th>
                    <td colspan="3">TEL : {{member.cn_tel}}</td>
                </tr>
                </tbody>
            </table>
        </div>
        <h6 class="table_total mb">
            <span>견적금액</span>
            <span>
			<span>일금 영 <b><em class="korUnit" data-number="900750">{{jl.numberToKorean(stTotalPrice())}}</em>원</b></span>
                            <span><b>( ￦<em>{{stTotalPrice().format()}}</em>)</b> ※부가세 포함</span>
        </h6>
		<h6 class="table_total">
			<span>총 절감 금액</span>
			<span class="txt_bold">&nbsp;<i class="fa-solid fa-down"></i> {{getDiscount()}}%</span>&nbsp;&nbsp;&nbsp;
			<span class="txt_red"><b>￦<em>{{(originTotalPrice() - stTotalPrice()).format()}}</em></b></span>
		</h6>
        <div class="table_wrap table">
            <table>
                <colgroup>
                    <col style="width: 4%">
                    <col style="width: 15%">
                    <col style="width: 7%">
                    <col style="width: 9%">
                    <col style="width: 14%">
                    <col style="width: 15%">
                    <col style="width: 12%">
                    <col style="width: 13%">
                    <col style="width: 11%">
                </colgroup>
                <thead>
                <tr>
                    <th></th>
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
                            <p><em>규격단가</em>{{product.new_standard_price}}</p>
                        </td>
                        <td alt="수량">
                            {{product.new_amount}}
                        </td>

                        <td alt="기존합계" class="text_right">
                            <p><b><em>기존합계</em>{{(product.new_standard_price * product.new_amount).format()}}</b></p>
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
                                    {{ ((product.new_standard_price * product.new_amount) - (getPrice(getReplace(product)) * product.new_amount)).format() }}
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
                member : {},
            };
        },
        created: function(){
            this.jl = new Jl('<?=$componentName?>');
            this.component_idx = this.jl.generateUniqueId();

            if(this.primary) this.getData();
            if(this.mb_id) this.getMember();
        },
        mounted: function(){
            this.$nextTick(() => {

            });
        },
        methods: {
            getDiscount() {
                let origin = this.originTotalPrice()
                let st = this.stTotalPrice();
                let result = ((origin - st) / origin * 100).toFixed(2)
                if(isNaN(result)) return 0
                return result;
            },
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
                    price += product.new_standard_price * product.new_amount;
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
            async getMember() {
                let filter = {mb_id : this.mb_id}
                try {
                    let res = await this.jl.ajax("get",filter,"/api/bs_member");
                    this.member = res.data[0]
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
