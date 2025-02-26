<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div v-if="load">
        <div class="scon_right">
            <div class="formWarp">
                    <input type="hidden" name="w" value="">
                    <input type="hidden" name="bo_table" value="onlinewrite">					<input type="hidden" name="on_category" value="라이더 지원 문의">
                    <input type="hidden" name="fname" value="fwrite">
                    <input type="hidden" name="on_subject" value="라이더 지원 문의">

                    <div class="formArea">
                        <ul>
                            <li>
                                <dl>
                                    <dt>
                                        <span>이름</span><span class="red">*</span>
                                    </dt>
                                    <dd>
                                        <input type="text" name="on_name" v-model="row.name" placeholder="예) 홍길동" required="">
                                    </dd>
                                </dl>
                            </li>
                            <li>
                                <dl>
                                    <dt>
                                        <span>생년월일</span><span class="red">*</span>
                                    </dt>
                                    <dd>
                                        <input type="hidden" name="on_1_subj" value="생년월일">
                                        <input type="text" name="on_1" v-model="row.birth" placeholder="예) 19990101" required="">
                                    </dd>
                                </dl>
                            </li>
                            <li>
                                <dl>
                                    <dt>
                                        <span>연락처</span><span class="red">*</span>
                                    </dt>
                                    <dd>
                                        <input type="text" name="on_hp" v-model="row.phone" placeholder="예) 010-1234-5678" required="">
                                    </dd>
                                </dl>
                            </li>
                            <li>
                                <dl>
                                    <dt>
                                        <span>배달경험</span><span class="red">*</span>
                                    </dt>
                                    <dd>
                                        <div class="rider">
                                            <input type="radio" name="on_2" value="없음" id="on_21" v-model="row.exp">
                                            <label for="on_21">없음</label>
                                            <input type="radio" name="on_2" value="6개월 미만" id="on_22" v-model="row.exp">
                                            <label for="on_22">6개월 미만</label>
                                            <input type="radio" name="on_2" value="6개월~1년" id="on_23" v-model="row.exp">
                                            <label for="on_23">6개월~1년</label>
                                            <input type="radio" name="on_2" value="1년 이상" id="on_24" v-model="row.exp">
                                            <label for="on_24">1년 이상</label>
                                            <input type="radio" name="on_2" value="2년 이상" id="on_25" v-model="row.exp">
                                            <label for="on_25">2년 이상</label>
                                        </div>
                                    </dd>
                                </dl>
                            </li>
                            <li>
                                <dl>
                                    <dt>
                                        <span>희망근무시간</span><span class="red">*</span>
                                    </dt>
                                    <dd>
                                        <div>
                                            <input type="radio" name="on_3" value="풀타임" id="on_31" v-model="row.hope_time">
                                            <label for="on_31">풀타임</label>
                                            <input type="radio" name="on_3" value="파트타임" id="on_32" v-model="row.hope_time">
                                            <label for="on_32">파트타임</label>
                                        </div>
                                    </dd>
                                </dl>
                            </li>
                            <li>
                                <dl>
                                    <dt>
                                        <span>바이크 보유 여부</span><span class="red">*</span>
                                    </dt>
                                    <dd>
                                        <div>
                                            <input type="radio" name="on_4" value="보유" id="on_41" v-model="row.bike">
                                            <label for="on_41">네, 보유하고 있습니다.</label>
                                            <input type="radio" name="on_4" value="없음" id="on_42" v-model="row.bike">
                                            <label for="on_42">아니오, 없습니다.</label>
                                        </div>
                                    </dd>
                                </dl>
                            </li>
                            <li>
                                <dl>
                                    <dt>
                                        <span>희망 근무 지역</span>
                                    </dt>
                                    <dd class="hopeArea">
                                        <input type="text" placeholder="희망 근무 지역 (예, 서울 종로구)" name="on_5" v-model="row.hope_address">
                                        <!-- <p>2지망</p>
                                        <input type="text" placeholder="상세 주소 입력" name="hope_location2">
                                        <p>3지망</p>
                                        <input type="text" placeholder="상세 주소 입력" name="hope_location3"> -->
                                    </dd>
                                </dl>
                            </li><li>
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
                        <input type="checkbox" required="" id="cka">&nbsp;<label for="cka">개인정보처리방침에 동의</label>
                    </div>
                    <div class="online_bt">
                        <button type="submit" class="btn_ok" @click="jl.postData(row,options)">제출하기 <i class="fa-solid fa-angles-right"></i></button>
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

                    row: {
                        name : "",
                        birth : "",
                        phone : "",
                        exp : "없음",
                        hope_time : "파트타임",
                        bike : "보유",
                        hope_address : "",
                        captcha : false,
                    },
                    rows : [],

                    options : {
                        table : "form_3",
                        file_use : false,
                        required : [
                            {name : "name",message : `이름을 입력해주세요.`},
                            {name : "birth",message : `생년월일을 입력해주세요.`},
                            {name : "phone",message : `연락처를 입력해주세요.`},
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