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
                    <td>사용목적 <span class="txt_color">*</span></td>
                    <td>
                        <input type="text" v-model="data.use_content">
                    </td>
                </tr>
                <tr class="top">
                    <td>날짜선택 <span class="txt_color">*</span></td>
                    <td>
                        <div class="date-container">
                            <input type="date" class="date-input" :class="{'filled' : data.use_date_focus}" @focus="data.use_date_focus = true" aria-label="날짜 선택" v-model="data.use_date" :min="jl.getToday()"/>
                            <label for="date-input" class="date-placeholder-label">{{ data.use_date ? data.use_date : '날짜를 선택해주세요'}}</label>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <br>
        <p class="text_center txt_blue"><i class="fa-solid fa-left-right"></i> 좌우로 스크롤 하세요</p>
        <div class="table">
            <!-- 예루살렘성전 Table -->
            <table class="click">
                <tbody>
                <tr v-for="place in places">
                    <td>{{place}}</td>
                    <td v-for="time in times" :class="getClass(place,time)" @click="selectPlaceTime(place,time)">{{time}}</td>
                </tr>
                </tbody>
            </table>
        </div>
        <p class="text_center txt_blue"><i class="fa-solid fa-left-right"></i> 좌우로 스크롤 하세요</p>
        <br>
        <div class="table">
            <table>
                <tbody>
                <tr>
                    <td>음식섭취 <span class="txt_color">*</span></td>
                    <td>
                        <div class="gap5 select nowrap">
                            <input type="radio" name="state" id="s1" value="유" v-model="data.food_intake">
                            <label class="w100" for="s1">유</label>
                            <input type="radio" name="state" id="s2" value="무" v-model="data.food_intake">
                            <label class="w100" for="s2">무</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>특이사항</td>
                    <td>
                        <input type="text" v-model="data.note">
                    </td>
                </tr>
                <tr>
                    <td>숙지사항<br>체크 <span class="txt_color">*</span></td>
                    <td class="text_left">
                        <label><input type="checkbox" v-model="data.check1"> 1. 다음 예약을 위해 사용시간을 엄수해주시기 바랍니다.</label><br>
                        <label><input type="checkbox" v-model="data.check2"> 2. 해당 장소의 열쇠를 받으신 경우 사용 후 즉시 경비실에 열쇠를 반납해 주셔야 합니다.</label><br>
                        <label><input type="checkbox" v-model="data.check3"> 3. 사용 후에는 뒷정리 및 소등, 냉난방기를 꼭 꺼주시길 부탁드립니다.</label><br>
                        <label><input type="checkbox" v-model="data.check4"> 4. 사용시 기물 등이 분실, 파손 된 경우 반드시 해당 내용을 사무실에 고지해 주시기 바랍니다.</label>
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
            <h6>위와 같이 대관을 신청합니다.</h6>
            <p>※주의사항 : 기재해주신 연락처로 확정문자를 받으셔야 예약이 확정됩니다.<br>
                해당 장소와 시간에 예약신청이 먼저 되어 있는 경우,
                원하시는 장소와 시간에 사용이 불가할 수 있습니다.</p>
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
                        use_content : "",
                        use_date : "",
                        use_place : "",
                        use_time : [],
                        food_intake : "무",
                        note : "",
                        name : "",
                        phone : "",
                        status : false,

                        check1 : false,
                        check2 : false,
                        check3 : false,
                        check4 : false,
                    },
                    arrays : [],

                    options : {
                        table : 'rental_lecture',
                        required : [
                            {name : "user_idx",message : `로그인이 필요한 기능입니다.`},
                            {name : "department",message : `신청부서를 입력해주세요`},
                            {name : "use_content",message : `사용목적을 입력해주세요`},
                            {name : "use_date",message : `날짜를 선택해주세요`},
                            {name : "use_place",message : `장소와 시간을 선택해주세요`},
                            {name : "check1",message : `숙지사항1 체크를 해주세요.`},
                            {name : "check2",message : `숙지사항2 체크를 해주세요.`},
                            {name : "check3",message : `숙지사항3 체크를 해주세요.`},
                            {name : "check4",message : `숙지사항4 체크를 해주세요.`},
                            {name : "name",message : `신청인을 입력해주세요`},
                            {name : "phone",message : `연락처를 입력해주세요`},
                        ],
                        href : "./rental_lecture",
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

                    places : ["15층 IMC라운지 전체", "15층 IMC라운지 회의실", "13층 단체숙소 1301", "13층 단체숙소 1302", "13층 단체숙소 1303", "13층 단체숙소 1304", "11층 드림2부실", "10층 드림1부실", "에벤에셀홀"],
                    times : ["09~10", "10~11", "11~12", "12~13", "13~14", "14~15", "15~16", "16~17", "17~18", "18~19", "19~20"],

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
                selectPlaceTime(place,time) {
                    if(this.data.use_place != place) this.data.use_time = [];
                    if(this.getClass(place,time) == "disabled") return false;

                    this.data.use_place = place;

                    if(this.data.use_time.includes(time)) {
                        this.data.use_time.splice(this.data.use_time.indexOf(time),1)
                    }else {
                        this.data.use_time.push(time);
                    }
                },
                getClass(place,time) {
                    if(!this.data.use_date) return 'disabled';

                    let reservedFilter = this.arrays.filter(arr => arr.use_place == place);

                    let mergedArray = [];
                    reservedFilter.forEach(arr => {
                        mergedArray = mergedArray.concat(arr.use_time);
                    });

                    if(mergedArray.includes(time)) return 'disabled';

                    if(this.data.use_place == place && this.data.use_time.includes(time)) return "selected";
                    return "";
                }
            },
            computed: {
                use_date() {
                    return this.data.use_date
                }
            },
            watch: {
                async use_date() {
                    await this.jl.getsData({
                        table : "rental_lecture",
                        use_date : this.use_date,
                        status : true,
                    },this.arrays);
                }
            }
        }});

</script>

<style>

</style>