<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div>
        <div class="sch_wrap">
            <p class="tit">검색조건
                <a class="btn btn-gray btn-md male-auto" href="" >조건초기화</a>
                <button class="btn btn-blue btn-md" onclick="">검색하기</button></p>
            </p>
            <div class="box flexwrap">
                <div>
                    <p>일자구분</p>
                    <div class="input_date">
                        <div class="input_select w150px">
                            <select class="border_gray">
                                <option value="D1" selected="">입금확인일</option>
                                <option value="D3">매출기준일</option>
                                <option value="D7">구매결정일</option>
                                <option value="D4">환불일</option>
                                <option value="D6">정산완료일</option>
                            </select>
                        </div>
                        <div class="input_select">
                            <!--i class="fa-duotone fa-calendar"></i-->
                            <input type="date" class="border_gray" id="startDate" name="startDate">
                        </div>
                        ~
                        <div class="input_select">
                            <!--i class="fa-duotone fa-calendar"></i-->
                            <input type="date" class="border_gray" id="endDate" name="endDate">
                        </div>
                        <div class="select flex nowrap">
                            <input type="radio" id="date1" name="date" value="">
                            <label for="date1">오늘</label>
                            <input type="radio" id="date2" name="date" value="">
                            <label for="date2">일주일</label>
                            <input type="radio" id="date3" name="date" value="">
                            <label for="date3">한달</label>
                            <input type="radio" id="date4" name="date" value="">
                            <label for="date4">3개월</label>
                        </div>
                    </div>
                </div>

                <div>
                    <p>검색하기</p>
                    <div class="flex gap5">
                        <div class="input_select">
                            <select class="border_gray" v-model="filter.search_key">
                                <option value="">선택</option>
                                <option value="PayNo">결제번호</option>
                                <option value="OrderNo">주문번호</option>
                                <option value="SiteGoodsNo">상품번호</option>
                            </select>
                        </div>
                        <div class="input_search">
                            <input type="text" placeholder="검색어를 입력하세요" class="border_gray" v-model="filter.search_value">
                            <button @click="getData()"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="result_wrap">
            <div class="box_gray">
                <div class="monthBox" :class="{'monthBg' : item == month}" data-action="calcMonth" data-month="1" v-for="item in 12" @click="month = item">
                    <h2>{{item}}월</h2>
                    <p>{{ totalMonthData(item).format() }}원</p>
                </div>
            </div>
            <div class="top_text">
                <div class="wrap w100 flex">
                    <h1>정산 내역 <span class="color-blue">{{ getYear() }}.{{ month.toString().padStart(2,'0') }}</span></h1>
                </div>
            </div>
            <div class="table">
                <table>
                    <colgroup>
                        <col style="width: 50px;">
                        <col style="width: ;">
                        <col style="width: 50px;">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>판매일자</th>
                        <th>구분</th>
                        <th>판매자코드/거래처명</th>
                        <th>주문번호</th>
                        <th>구매자명(아이디)</th>
                        <th>상품명</th>
                        <th>결제방식</th>
                        <th>주문금액</th>
                        <th>할인금액</th>
                        <th>최종결제금액</th>
                        <th>누계</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="sum">
                        <td colspan="2">기간합계</td>
                        <td colspan="99"><b>0원</b></td>
                    </tr>
                    <tr v-for="item in orders">
                        <td>{{ item.data_page_no }}</td>
                        <td>{{ item.OrderDate }}</td>
                        <td>
                            <div class="box__flag" :class="item.SiteType == 1 ? 'box__flag--auction' : 'box__flag--gmarket'"></div>
                        </td>
                        <td>{{ item.OutGoodsNo }}</td>
                        <td><a data-toggle="modal" data-target="#orderSheetModal">{{ item.OrderNo }}</a></td>
                        <td>{{ item.BuyerName }}({{ item.BuyerID }})</td>
                        <td>{{ item.GoodsName }}</td>
                        <td>카드결제</td>
                        <td>{{ parseInt(item.OrderAmount).format() }}원</td>
                        <td>
                            <details>
                                <summary>총 할인 {{ totalDiscount(item).format() }}원</summary>
                                <dl>
                                    <dt>판매자할인</dt>
                                    <dd>-{{parseInt(item.SellerDiscountPrice1).format()}}</dd>
                                    <dt>쿠폰할인</dt>
                                    <dd>-</dd>
                                    <dt>지마켓(비투피)할인</dt>
                                    <dd>-</dd>
                                    <dt>스마일캐시지급</dt>
                                    <dd>-{{item.SellerCashBackMoney ? parseInt(item.SellerCashBackMoney).format() : 0}}</dd>
                                </dl>
                            </details>
                        </td>
                        <td>{{ parseInt(item.AcntMoney).format() }}원</td>
                        <td>{{ parseInt(item.OrderAmount).format() }}원</td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <calculate-paging :page="filter.page" :limit="filter.limit" :total="total" @change="filter.page = $event; getData();"></calculate-paging>
        </div>
    </div>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            mb_id : {type : String, default : ""}
        },
        data: function(){
            return {
                jl : null,
                filter : {
                    mb_id : this.mb_id,
                    page : 1,
                    limit : 10,
                    s_date : `20${this.getYear()}-${this.getMonth().toString().padStart(2,'0')}-01`,
                    e_date : `20${this.getYear()}-${this.getMonth().toString().padStart(2,'0')}-31`,
                    search_key : "",
                    search_value : "",
                },
                data : {

                },
                orders : [],
                total : 0,
                total_orders : [],

                month : 0
            };
        },
        created: function(){
            this.jl = new JL('<?=$componentName?>');
            this.month = this.getMonth();

            this.getData()
            this.totalData();
            console.log(this.filter)
            this.totalMonthData("07");
        },
        mounted: function(){
            this.$nextTick(() => {

            });
        },
        methods: {
            getYear : function() {
                const date = new Date();
                const fullYear = date.getFullYear(); // getFullYear() returns the full year (e.g., 2024)
                const twoDigitYear = fullYear % 100; // Extract the last two digits
                return twoDigitYear;
            },
            getMonth : function() {
                const date = new Date();
                const month = date.getMonth() + 1; // getMonth() returns 0-11, so we add 1
                return month;
            },
            getLastDay : function(month) {
                return new Date(`20${this.getYear()}`, month, 0).getDate();
            },
            postData : function() {
                var method = this.primary ? "update" : "insert";
                var res = this.jl.ajax(method,this.data,"/calculate/api/getData");

                if(res) {

                }
            },
            getData: function () {
                var res = this.jl.ajax("get",this.filter,"/api/calculate/getData");

                if(res) {
                    this.orders = res.response.data;
                    this.total = res.response.count;
                }
            },
            totalData: function () {
                var filter = {
                    mb_id : this.mb_id,
                    s_date : `20${this.getYear()}-01-01`,
                    e_date : `20${this.getYear()}-12-31`,
                }
                var res = this.jl.ajax("get",filter,"/api/calculate/getData");

                if(res) {
                    this.total_orders = res.response.data;
                }
            },
            filterByDate : function(month) {
                //JS Date 객체는 30일이 마지막날인데 31일로 할경우 다음달 1일을 가져오기때문에 마지막일 가져와서 대입
                const start = new Date(`20${this.getYear()}-${month.toString().padStart(2,'0')}-01 00:00:00`);
                const end = new Date(`20${this.getYear()}-${month.toString().padStart(2,'0')}-${this.getLastDay(month)} 23:59:59`);

                const data = this.jl.copyObject(this.total_orders);

                return data.filter(item => {
                    const itemDate = new Date(item.OrderDate);
                    return itemDate > start && itemDate < end;
                });
            },
            totalMonthData : function(month) {
                var data = this.filterByDate(month)
                var result = 0;

                data.forEach(function(item) {
                    result += parseInt(item.AcntMoney)
                });

                return result;
            },
            totalDiscount : function(item) {
                var result = 0;
                result += item.SellerCashBackMoney ? parseInt(item.SellerCashBackMoney) : 0;
                result += item.SellerDiscountPrice1 ? parseInt(item.SellerDiscountPrice1) : 0;

                return result;
            }
        },
        computed: {

        },
        watch : {
            month : function () {
                this.filter.s_date = `20${this.getYear()}-${this.month.toString().padStart(2,'0')}-01`;
                this.filter.e_date = `20${this.getYear()}-${this.month.toString().padStart(2,'0')}-31`;

                this.getData();
            }
        }
    });
</script>

<style>

</style>