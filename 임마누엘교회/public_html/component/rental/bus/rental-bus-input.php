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
                    <td>탑승인원 <span class="txt_color">*</span></td>
                    <td>
                        <input type="number" v-model="data.people">
                    </td>
                </tr>
                <tr>
                    <td>신청차량 <span class="txt_color">*</span></td>
                    <td>
                        <div class="gap5 select nowrap">
                            <input type="radio" name="state" id="s1" value="31인승" v-model="data.types">
                            <label class="w100" for="s1">31인승</label>
                            <input type="radio" name="state" id="s2" value="24인승" v-model="data.types">
                            <label class="w100" for="s2">24인승</label>
                            <input type="radio" name="state" id="s3" value="31+24인승" v-model="data.types">
                            <label class="w100" for="s3">31+24인승</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>날짜선택 <span class="txt_color">*</span></td>
                    <td>
                        <div class="date-container">
                            <input type="date" class="date-input" aria-label="날짜 선택" v-model="data.dates1"/>
                            <label for="date-input" class="date-placeholder-label">{{data.dates1 ? data.dates1 : '날짜를 선택해주세요'}}</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>도착행선지 <span class="txt_color">*</span></td>
                    <td>
                        <input type="text" v-model="data.destination1">
                    </td>
                </tr>
                <tr>
                    <td>교회출발시간 <span class="txt_color">*</span></td>
                    <td>
                        <div class="date-container">
                            <input type="time" class="time-input" v-model="data.times1"/>
                            <label for="date-input" class="date-placeholder-label">{{data.times1 ? data.times1 : '시간을 선택해주세요'}}</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>출발행선지 <span class="txt_color">*</span></td>
                    <td>
                        <input type="text" v-model="data.destination2">
                    </td>
                </tr>
                <tr>
                    <td>현지출발시간 <span class="txt_color">*</span></td>
                    <td>
                        <div class="date-container">
                            <input type="time" class="time-input" v-model="data.times2"/>
                            <label for="date-input" class="date-placeholder-label">{{data.times2 ? data.times2 : '시간을 선택해주세요'}}</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>당일외출발</td>
                    <td>
                        <div class="flex wrap">
                            <div class="date-container">
                                <input type="date" class="date-input" aria-label="날짜 선택" v-model="data.dates2"/>
                                <label for="date-input" class="date-placeholder-label">{{data.dates2 ? data.dates2 : '날짜를 선택해주세요'}}</label>
                            </div>

                            <div class="date-container">
                                <input type="time" class="time-input" v-model="data.times3"/>
                                <label for="date-input" class="date-placeholder-label">{{data.times3 ? data.times3 : '시간을 선택해주세요'}}</label>
                            </div>
                        </div>
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
            <h6>위와 같이 버스 사용을 신청합니다.</h6>
            <p>※주의사항 : 1.기재해주신 연락처로 확정문자를 받으셔야 예약이 확정됩니다. <br>
                해당 일시에 예약신청이 먼저 되어 있거나 필수 운행 일정이 있을 경우
                원하시는 일시에 사용이 불가할 수 있습니다.<br>
                2.운행비용에 대한 안내를 사무실에서 반드시 확인하시길 바랍니다.</p>
        </div>
        <br>
        <button type="button" class="btn btn_color btn-large" @click="jl.postData(data,'rental_bus',options)">신청하기</button>
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
                        people : "",
                        types : "31인승",
                        dates1 : "",
                        destination1 : "",
                        times1 : "",
                        destination2 : "",
                        times2 : "",
                        dates2 : "",
                        times3 : "",
                        name : "",
                        phone : "",
                        status : false,
                    },
                    arrays : [],

                    options : {
                        required : [
                            {name : "user_idx",message : `로그인이 필요한 기능입니다.`},
                            {name : "department",message : `신청부서를 입력해주세요.`},
                            {name : "subject",message : `행사명을 입력해주세요.`},
                            {name : "people",message : `탑승인원을 입력해주세요.`},
                            {name : "dates1",message : `날짜를 선택해주세요`},
                            {name : "destination1",message : `도착행선지를 입력해주세요`},
                            {name : "times1",message : `교회 출발시간을 입력해주세요`},
                            {name : "destination2",message : `출발행선지를 입력해주세요`},
                            {name : "times2",message : `현지출발시간을 입력해주세요.`},
                            {name : "name",message : `신청인을 입력해주세요.`},
                            {name : "phone",message : `연락처를 입력해주세요.`},
                        ],
                        href : "./rental_bus",
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