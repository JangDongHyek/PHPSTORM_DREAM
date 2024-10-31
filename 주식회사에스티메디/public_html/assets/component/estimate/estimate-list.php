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
                    <a class="btn btn_large btn_line" href="./estimate"><i class="fa-duotone fa-solid fa-floppy-disk"></i> 견적 저장</a>
                    <a class="btn btn_large btn_line" href="./estimatePrint" target="_blank"><i class="fa-duotone fa-solid fa-print"></i> 견적 출력</a>
                    <a class="btn btn_large btn_line" id=""><i class="fa-duotone fa-solid fa-bags-shopping"></i> 바로 구매</a>
                </div>
                <section class="list_wrap">
                    <div class="table_total">
                        <h5 class="origin">
                            <span>기존 견적 금액</span>
                            <span><b>￦<em class="price-wrapper"><div class="price-slash"></div>1,563,250</em></b></span>
                            <span class="txt_red txt_bold">&nbsp;<i class="fa-solid fa-down"></i> 58%</span>
                        </h5>
                        <h5>
                            <span>ST 견적 금액</span>
                            <span>일금 영 <b><em class="korUnit" data-number="900750"></em>원</b></span>
                            <span><b>( ￦<em>900,750</em>)</b> ※부가세 포함</span>
                        </h5>
                    </div>
                    <div class="table_wrap table">
                        <table>
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>제품명</th>
                                <th>포장단위</th>
                                <th>수량</th>
                                <th>약가</th>
                                <th>총수량</th>
                                <th>기존합계</th>
                                <th>ST단가</th>
                                <th>대체품목</th>
                                <th>ST합계</th>
                                <th>절감금액</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="product in data">
                                <td alt="No.">
                                    <p>1 <button type="button" class="btn btn_mini btn_black"><i class="fa-solid fa-trash"></i></button></p>

                                </td>
                                <td alt="제품명">
                                    <input type="text" value="산텐플루메토론0.02점안액/5ml">
                                </td>
                                <td alt="포장단위" class="text_right">
                                    <p><em>포장단위</em>100</p>
                                </td>
                                <td alt="수량">
                                    <div class="number_controller">
                                        <button type="button" onclick="changeCount(, -1)"><i class="fa-regular fa-minus"></i></button>
                                        <input type="number" name="inputNumber" value="1" onkeyup="this.value=numberChk(this.value);changeCount(, this.value, true)" id="inputNumber">
                                        <button type="button" onclick="changeCount(, 1)" id="Count_add1102"><i class="fa-regular fa-plus"></i></button>
                                    </div>
                                </td>
                                <td alt="약가" class="text_right">
                                    <p><em>약가</em>1,165</p>
                                </td>
                                <td alt="총수량" class="text_right">
                                    <p><em>총수량</em>100</p>
                                </td>
                                <td alt="기존합계" class="text_right">
                                    <p><b><em>기존합계</em>116,500</b></p>
                                </td>
                                <td alt="ST단가" class="text_right">
                                    <p><em>ST단가</em><b>825</b></p>
                                </td>
                                <td alt="대체품목">
                                    <p>
                                        <b>후메론점안액0.02%/5ml</b>
                                        <button type="button" data-toggle="modal" data-target="#moreModal1" class="btn btn_mini btn_black">변경</button>
                                    </p>
                                </td>
                                <td alt="ST합계" class="text_right">
                                    <p><em>ST합계</em><b>825</b></p>
                                </td>
                                <td alt="절감금액" class="text_right">
                                    <p class="txt_red"><em>절감금액</em><b>34,000</b></p>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="99">
                                    <button type="button" class="btn btn_mini btn_black" @click="new_modal = true;">추가</button>
                                </td>
                            </tr>

                            <tr class="bg2">
                                <td alt="계" colspan="6" class="text_right">
                                    기존합계
                                </td>
                                <td alt="기존합계" colspan="2" class="text_right">
                                    <p>1,563,250</p>
                                </td>
                                <td alt="계" colspan="1" class="text_right">
                                    ST합계
                                </td>
                                <td alt="ST합계" colspan="2" class="text_right">
                                    <p>900,750</p>
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
                                <td>1,563,250</td>
                                <td>900,750</td>
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
                                <td>662,500</td>
                                <td class="txt_red">58%</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </section>
            </div>
        </section>

        <modal-new-medicin :modal="new_modal" @close="new_modal = false;" :INSU_CHECK="INSU_CHECK"
                           version="2"
        ></modal-new-medicin>
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

                new_modal : false,
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
            async postData() {
                let method = this.primary ? "update" : "insert";
                let options = {required : this.required};
                try {
                    //if(!this.data.change_user_pw) throw new Error("비밀번호를 입력해주세요.");
                    let res = await this.jl.ajax(method,this.data,"/api/example.php",options);
                }catch (e) {
                    alert(e.message)
                }

            },
            async getData() {
                try {
                    let res = await this.jl.ajax("get",this.filter,"/api/example.php");
                    this.data = res.data[0]
                }catch (e) {
                    alert(e.message)
                }
            }
        },
        computed: {

        },
        watch : {
            search_key1() {
                this.search_value1_1 = "";
                this.search_value1_2 = "";
            }
        }
    });
</script>

<style>

</style>