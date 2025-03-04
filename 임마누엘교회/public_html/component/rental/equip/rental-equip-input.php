<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div v-if="load">
            <span class="txt_color">*</span> <span class="txt_gray">표시된 항목은 필수기입 항목입니다.</span>
            <div class="table">
                <table>
                    <tbody>
                    <tr class="top">
                        <td>신청부서 <span class="txt_color">*</span></td>
                        <td>
                            <input type="text" v-model="data.department">
                        </td>
                    </tr>
                    <tr class="top">
                        <td>행사명 <span class="txt_color">*</span></td>
                        <td>
                            <input type="text" v-model="data.subject">
                        </td>
                    </tr>
                    <tr class="top">
                        <td>행사장소 <span class="txt_color">*</span></td>
                        <td>
                            <input type="text" v-model="data.place">
                        </td>
                    </tr>
                    <tr>
                        <td>날짜선택 <span class="txt_color">*</span></td>
                        <td>
                            <div class="date-container">
                                <input type="date" class="date-input" :class="{'filled' : data.use_date_focus}" @focus="data.use_date_focus = true" aria-label="날짜 선택" v-model="data.use_date"/>
                                <label for="date-input" class="date-placeholder-label">{{data.use_date ? data.use_date :'날짜를 선택해주세요'}}</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>수령인 <span class="txt_color">*</span></td>
                        <td>
                            <input type="text" v-model="data.recipient">
                        </td>
                    </tr>
                    <tr>
                        <td>신청자재 <span class="txt_color">*</span></td>
                        <td>
                            <input type="text" v-model="data.request">
                            <p class="text_left">* 수량이 2개 이상인 경우 수량도 표기해 주세요</p>
                        </td>
                    </tr>
                    <tr>
                        <td>수령일시</td>
                        <td>
                            <div class="flex wrap">
                                <div class="date-container">
                                    <input type="date" class="date-input" :class="{'filled' : data.dates1_focus}" @focus="data.dates1_focus = true" aria-label="날짜 선택" v-model="data.dates1"/>
                                    <label for="date-input" class="date-placeholder-label">{{data.dates1 ? data.dates1 :'날짜를 선택해주세요'}}</label>
                                </div>
                                <div class="date-container">
                                    <input type="time" class="time-input" :class="{'filled' : data.times1_focus}" @focus="data.times1_focus = true" v-model="data.times1" />
                                    <label for="date-input" class="date-placeholder-label">{{data.times1 ? data.times1 :'시간을 선택해주세요'}}</label>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>반납인 <span class="txt_color">*</span></td>
                        <td>
                            <input type="text" v-model="data.returner">
                        </td>
                    </tr>
                    <tr>
                        <td>반납일시</td>
                        <td>
                            <div class="flex wrap">
                                <div class="date-container">
                                    <input type="date" class="date-input" :class="{'filled' : data.dates2_focus}" @focus="data.dates2_focus = true" aria-label="날짜 선택" v-model="data.dates2"/>
                                    <label for="date-input" class="date-placeholder-label">{{data.dates2 ? data.dates2 :'날짜를 선택해주세요'}}</label>
                                </div>
                                <div class="date-container">
                                    <input type="time" class="time-input" :class="{'filled' : data.times2_focus}" @focus="data.times2_focus = true" v-model="data.times2" />
                                    <label for="date-input" class="date-placeholder-label">{{data.times2 ? data.times2 :'시간을 선택해주세요'}}</label>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>숙지사항<br>체크 <span class="txt_color">*</span></td>
                        <td class="text_left">
                            <label><input type="checkbox" v-model="data.check1">1. 다음 예약을 위해 반납일시를 엄수해주시기 바랍니다.</label><br>
                            <label><input type="checkbox" v-model="data.check2">2. 대여 물품이 분실, 파손 된 경우에 반드시 해당 부서에 고지하셔야 하며 수리 및 재구매로 인한 비용을 청구할 수 있습니다.</label>
                        </td>
                    </tr>
                    <tr>
                        <td>신청인 <span class="txt_color">*</span></td>
                        <td>
                            <input type="text" v-model="data.name">
                        </td>
                    </tr>
                    <tr>
                        <td>연락처 <span class="txt_color">*</span></td>
                        <td>
                            <input type="text" v-model="data.phone">
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="guide">
                <h6>위와 같이 대여를 신청합니다.</h6>
                <p>※주의사항 : 기재해주신 연락처로 확정문자를 받으셔야 예약이 확정됩니다. <br>
                    해당 일시에 예약신청이 먼저 되어 있거나 교회의 일정이 있을 경우
                    원하시는 일시에 대여가 불가할 수 있습니다.</p>
            </div>
            <br>
            <button type="button" class="btn btn_color btn-large" @click="jl.postData(data,options)">신청하기</button>
    </div>
</script>

<script>
    Jl_components.push({name : "<?=$componentName?>",object : {
            template: "#<?=$componentName?>-template",
            props: {
                mb_no : {type: String, default: ""},
                primary : {type: String, default: ""},
            },
            data: function () {
                return {
                    load : false,
                    jl: null,
                    component_idx: "",

                    data: {
                        user_idx : this.mb_no,
                        department : "",
                        subject : "",
                        place : "",
                        use_date : "",
                        recipient : "",
                        request : "",
                        dates1 : "",
                        times1 : "",
                        returner : "",
                        dates2 : "",
                        times2 : "",
                        name : "",
                        phone : "",
                        status : false,

                        check1 : false,
                        check2 : false,
                    },
                    arrays : [],

                    options : {
                        table : 'rental_equip',
                        required : [
                            {name : "user_idx",message : `로그인은 필수입니다.`},
                            {name : "department",message : `신청부서는 필수입니다.`},
                            {name : "subject",message : `행사명은 필수입니다.`},
                            {name : "place",message : `행사장소는 필수입니다.`},
                            {name : "use_date",message : `날짜선택은 필수입니다.`},
                            {name : "recipient",message : `수령인은 필수입니다.`},
                            {name : "request",message : `신청자재는 필수입니다.`},
                            {name : "returner",message : `반납인은 필수입니다.`},
                            {name : "check1",message : `숙지사항1에 체크해주세요.`},
                            {name : "check2",message : `숙지사항2에 체크해주세요.`},
                            {name : "name",message : `신청인은 필수입니다.`},
                            {name : "phone",message : `연락처는 필수입니다.`},
                        ],
                        href : "./rental_equip",
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
                        data : {},
                    },

                    rend : false,
                };
            },
            async created() {
                this.jl = new Jl('<?=$componentName?>');
                this.component_idx = this.jl.generateUniqueId();

                if(this.primary) this.data = await this.jl.getData(this.filter);
                //await this.jl.getsData(this.filter,this.arrays);

                this.load = true;
            },
            mounted() {
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

            }
        }});

</script>

<style>

</style>