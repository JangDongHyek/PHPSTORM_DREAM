<?php
$componentName = str_replace(".php","",basename(__FILE__));
$pathParts = explode(DIRECTORY_SEPARATOR, dirname(__FILE__));
$context_name = end($pathParts);
?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div v-if="load">
        <div class="scon_right">
            <div class="formWarp">
                <div class="formArea">
                    <ul>
                        <li>
                            <dl>
                                <dt>
                                    <span>이름</span><span class="red">*</span>
                                </dt>
                                <dd>
                                    <input type="text" name="on_name" placeholder="예) 홍길동" v-model="row.name" required>
                                </dd>
                            </dl>
                        </li>
                        <li>
                            <dl>
                                <dt>
                                    <span>연락처</span><span class="red">*</span>
                                </dt>
                                <dd>
                                    <input type="text" name="on_hp" placeholder="예) 010-1234-5678" v-model="row.phone" required>
                                </dd>
                            </dl>
                        </li>
                        <li>
                            <dl>
                                <dt>
                                    <span>배달 대행 운영 경험</span><span class="red">*</span>
                                </dt>
                                <dd>
                                    <div>
                                        <input type="hidden" name="on_1_subj" value="배달 대행 운영 경험">
                                        <input type="radio" name="on_1" id="on_11" value="운영 경험 있음" v-model="row.exp">
                                        <label for="on_11">운영 경험 있음</label>
                                        <input type="radio" name="on_1" id="on_12" value="운영 경험 없음" v-model="row.exp">
                                        <label for="on_12">운영 경험 없음</label>
                                    </div>
                                </dd>
                            </dl>
                        </li>
                        <li>
                            <dl>
                                <dt>
                                    <span>현재 배달 대행 운영 여부</span><span class="red">*</span>
                                </dt>
                                <dd>
                                    <div>
                                        <input type="hidden" name="on_2_subj" value="현재 배달 대행 운영 여부">
                                        <input type="radio" name="on_2" id="on_21" value="운영중" v-model="row.manage">
                                        <label for="on_21">운영중</label>
                                        <input type="radio" name="on_2" id="on_22" value="운영 하지 않음" v-model="row.manage">
                                        <label for="on_22">운영 하지 않음</label>
                                    </div>
                                </dd>
                            </dl>
                        </li>
                        <li>
                            <dl>
                                <dt>
                                    <span>현재 사용중인 프로그램</span><span class="red">*</span>
                                </dt>
                                <dd>
                                    <input type="text" name="on_3" placeholder="예) 온나플러스 프로그램, 없으면 없음 으로 기재" v-model="row.use_program" required>
                                </dd>
                            </dl>
                        </li>
                        <li>
                            <dl>
                                <dt>
                                    <span>함께하는 라이더 수</span><span class="red">*</span>
                                </dt>
                                <dd>
                                    <input type="text" name="on_4" v-model="row.riders" required>
                                </dd>
                            </dl>
                        </li>
                        <li>
                            <dl>
                                <dt>
                                    <span>운영 중인 가맹점 수</span><span class="red">*</span>
                                </dt>
                                <dd>
                                    <input type="text" name="on_5"v-model="row.shops" required>
                                </dd>
                            </dl>
                        </li>
                        <li>
                            <dl>
                                <dt>
                                    <span>하루 평균 주문 건수</span><span class="red">*</span>
                                </dt>
                                <dd>
                                    <div>
                                        <input type="text" name="on_6" v-model="row.day_orders" placeholder="예) 주중 100건, 주말 200건" required>
                                    </div>
                                </dd>
                            </dl>
                        </li>
                        <li>
                            <dl>
                                <dt>
                                    <span>희망 개설 지역</span>
                                </dt>
                                <dd>
                                    <input type="text" placeholder="상세 주소 입력" name="on_7" v-model="row.hope_address">
                                </dd>
                            </dl>
                        </li>
                        <li>
                            <dl>
                                <dt>
                                    <span>기타 참고 사항 (300자 이내)</span>
                                </dt>
                                <dd>
                                    <textarea placeholder="예) 운영기간, 권역범위 등 자유롭게 내용을 남겨 주세요" v-model="row.content" name="on_content" maxlength="300"></textarea>
                                </dd>
                            </dl>
                        </li>
                        <li>
                            <dl>
                                <dt>
                                    <span>자동등록방지</span><span class="red">*</span>
                                </dt>
                                <dd>
                                    <item-captcha :row="row" field="captcha"></item-captcha>
                                </dd>
                            </dl>
                        </li>
                    </ul>
                </div>

                <div class="agree">
                    <div class="agree_list" style="text-align:left;">
                        <p></p><table width="99%" align="center" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                            <tr>
                                <td height="25" class="align_left" style="line-height: 18px; border:0px;"><strong>개인정보의 수집목적 및 이용 </strong></td>
                            </tr>
                            <tr>
                                <td class="align_left" style="line-height: 18px; border:0px;">
                                    개인정보를 수집하는 목적은 푸드라인만의 정보와 맞춤회된 서비스를 제공하기 위하여 필요한 최소한의 정보만 수집하고 있습니다.<br><br>
                                    푸드라인에 등록하신 모든 회원과 방문객의 개인정보는 기본 수집 목적 이외에 다른 용도로 이용하거나 회원님의 동의 없이 제3자에게 제공할 수 없으며 회원정보와 관련한 회원이 피해를 입을 경우 이에 대한 모든 책임은 푸드라인에서 집니다.<br><br>
                                    개인정보수집 또는 이용에 대한 동의 철회시 푸드라인은(는) 개인정보를 수집하지 않으며 개인정보는 철회와 동시에 삭제됩니다.
                                </td>
                            </tr>
                            <tr>
                                <td height="25" class="align_left" style="line-height: 18px; border:0px;"><br><strong>수집하는 개인정보 항목 및 수집방법</strong></td>
                            </tr>
                            <tr>
                                <td class="align_left" style="line-height: 18px; border:0px;">푸드라인은(는) 이용자의 정보 수집시 서비스 제공에 필요한 최소한의 정보만을 수집하며 민감한 개인정보의 수집을 엄격히 제한하고 있습니다.<br><br>
                                    <table width="100%" align="center" border="0" cellspacing="0" cellpadding="10">
                                        <tbody>
                                        <tr>
                                            <td class="align_left" style="line-height: 18px; border:0px; padding:5px;" bgcolor="#efefef">* 필수사항 : 이름, 매장정보, 사업자정보, 회사명, 주소, 연락처</td>
                                        </tr>
                                        <tr>
                                            <td class="align_left" style="line-height: 18px; border:0px; padding:5px;" bgcolor="#efefef">* 선택사항 : 이메일주소</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <br>
                                </td>
                            </tr>
                            <tr>
                                <td height="25" class="align_left" style="line-height: 18px; border:0px;"><strong>개인정보의 보유 및 이용기간</strong></td>
                            </tr>
                            <tr>
                                <td class="align_left" style="line-height: 18px; border:0px;">
                                    푸드라인은(는) 방문객께서 푸드라인이(가) 제공하는 서비스를 받는 동안 개인정보를 계속 보유하며 맞춤화된 서비스 제공을 위해 이용하게 됩니다. 다만 방문객께서 탈퇴를 원하시거나 푸드라인 약관에 의거 방문객자격 상실의 경우에는 등록된 방문객의 정보는 완전히 삭제되며 어떠한 용도로도 열람 또는 이용할 수 없도록 처리됩니다.
                                </td>
                            </tr>
                            </tbody></table><p></p>
                    </div>
                    <!--<input type="checkbox">&nbsp;<label for="cka">개인정보처리방침에 동의</label>-->
                </div>

                <div class="online_bt">
                    <button type="button" @click="jl.postData(row,options)" class="btn_ok" id="btn_submit">제출하기 <i class="fa-solid fa-angles-right"></i></button>
                </div>
            </div>
        </div>

    </div>
</script>

<script>
    Jl_components.push({name : "<?=$componentName?>",object : {
            template: "#<?=$componentName?>-template",
            props: {
                primary : {type: String, default: ""},
            },
            data: function () {
                return {
                    load : false,
                    jl: null,
                    component_idx: "",
                    context_name : "<?=$context_name?>",
                    context : null,

                    row: {
                        name : "",
                        phone : "",
                        exp : "운영 경험 있음",
                        manage : "운영중",
                        use_program : "",
                        riders : "",
                        shops : "",
                        day_orders : "",
                        hope_address : "",
                        content : "",

                        captcha : false,
                    },
                    rows : [],

                    options : {
                        table : "form_fran",
                        file_use : false,
                        required : [
                            {name : "name",message : `이름은 필수값입니다.`},
                            {name : "phone",message : `연락처는 필수값입니다.`},
                            {name : "use_program",message : `사용중인 프로그램을 입력해주세요.`},
                            {name : "riders",message : `함께하는 라이더 수를 입력해주세요.`},
                            {name : "shops",message : `운영중인 가맹점 수를 입력해주세요.`},
                            {name : "day_orders",message : `하루 평균 주문 건수를 입력해주세요`},
                            {name : "hope_address",message : `희망 개설 지역을 입력해주세요.`},
                            {name : "content",message : `기타 참고사항을 입력해주세요.`},
                            {name : "captcha",message : `자동등록방지를 확인해주세요.`},
                        ],
                        href : "",
                    },

                    filter : {
                        table : "",
                        primary : this.primary,
                        page: 1,
                        limit: 1,
                        count: 0,
                    },

                    modal : {
                        status : false,
                        load : false,
                        data : {},
                        class_1 : "",
                        class_2 : "",
                    },

                };
            },
            async created() {
                this.jl = new Jl('<?=$componentName?>');
                this.component_idx = this.jl.generateUniqueId();
                const className = this.context_name.charAt(0).toUpperCase() + this.context_name.slice(1) + "Common";
                if (typeof window[className] !== 'undefined') {
                    this.context = new window[className](this.jl);
                }
            },
            async mounted() {
                if(this.primary) this.row = await this.jl.getData(this.filter);
                //await this.jl.getsData(this.filter,this.rows);

                this.load = true;

                this.$nextTick(() => {

                });
            },
            updated() {

            },
            methods: {

            },
            computed: {

            },
            watch: {
                async "modal.status"(value,old_value) {
                    if(value) {
                        this.modal.load = true;
                    }else {
                        this.modal.load = false;
                        this.modal.data = {};
                    }
                }
            }
        }});

</script>

<style>

</style>