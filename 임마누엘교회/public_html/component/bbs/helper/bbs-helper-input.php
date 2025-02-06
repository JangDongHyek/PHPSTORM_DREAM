<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div>
        <div id="helper" class="form">
            <div class="box_radius box_white">
                <span class="txt_color">*</span> <span class="txt_gray">표시된 항목은 필수기입 항목입니다.</span>
                <div class="table">
                    <table>
                        <tbody>
                        <tr class="top">
                            <td>종류선택<span class="txt_color">*</span></td>
                            <td>
                                <div class="gap5 select grid grid3">
                                    <input type="radio" name="cate" id="c1" value="행사보조" v-model="data.wr_2">
                                    <label class="w100" for="c1">행사보조</label>
                                    <input type="radio" name="cate" id="c2" value="예배스탭" v-model="data.wr_2">
                                    <label class="w100" for="c2">예배스탭</label>
                                    <input type="radio" name="cate" id="c3" value="식당봉사" v-model="data.wr_2">
                                    <label class="w100" for="c3">식당봉사</label>
                                    <input type="radio" name="cate" id="c4" value="야외행사" v-model="data.wr_2">
                                    <label class="w100" for="c4">야외행사</label>
                                    <input type="radio" name="cate" id="c5" value="개인용무" v-model="data.wr_2">
                                    <label class="w100" for="c5">개인용무</label>
                                    <input type="radio" name="cate" id="c6" value="기타" v-model="data.wr_2">
                                    <label class="w100" for="c6">기타</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>신청부서(인) <span class="txt_color">*</span></td>
                            <td>
                                <input type="text" placeholder="" v-model="data.wr_3">
                            </td>
                        </tr>
                        <tr>
                            <td>일시 <span class="txt_color">*</span></td>
                            <td>
                                <div class="date-container">
                                    <input type="date" class="date-input" :class="{'filled' : data.wr_4_focus}" @focus="data.wr_4_focus = true" aria-label="날짜 선택" v-model="data.wr_4"/>
                                    <label for="date-input" class="date-placeholder-label">{{data.wr_4 ? data.wr_4 : '날짜를 선택해주세요'}}</label>
                                </div>
                                <div class="gap5 select grid grid3">
                                    <input type="checkbox" :disabled="data.wr_5.includes('종일')" name="day" id="d1" value="오전" v-model="data.wr_5">
                                    <label class="w100" for="d1">오전</label>
                                    <input type="checkbox" :disabled="data.wr_5.includes('종일')" name="day" id="d2" value="오후" v-model="data.wr_5">
                                    <label class="w100" for="d2">오후</label>
                                    <input type="checkbox" @click="data.wr_5.includes('종일') ? data.wr_5 = [] : data.wr_5 = ['종일']" name="day" id="d3" value="종일" v-model="data.wr_5">
                                    <label class="w100" for="d3">종일</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>간략내용 <span class="txt_color">*</span></td>
                            <td>
                                <input type="text" placeholder="15자 내외로 작성해주세요" v-model="data.wr_6" maxlength="15">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">상세내용 <span class="txt_color">*</span></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <textarea placeholder="내용을 입력하세요" v-model="data.wr_7"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>요청자 <span class="txt_color">*</span></td>
                            <td>
                                <input type="text" v-model="data.wr_8">
                            </td>
                        </tr>
                        <tr>
                            <td>연락처 <span class="txt_color">*</span></td>
                            <td>
                                <input type="text" v-model="data.wr_9">
                            </td>
                        </tr>
                        <tr>
                            <td>지원마감</td>
                            <td>
                                <div class="date-container">
                                    <input type="date" class="date-input" :class="{'filled' : data.wr_10_focus}" @focus="data.wr_10_focus = true" aria-label="날짜 선택" v-model="data.wr_10"/>
                                    <label for="date-input" class="date-placeholder-label">{{data.wr_10 ? data.wr_10 : '날짜를 선택해주세요'}}</label>
                                </div>

                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <br>
                <button type="button" class="btn btn_color btn-large" @click="postData();">등록하기</button>
            </div>
        </div>
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
                    jl: null,
                    component_idx: "",

                    paging: {
                        page: 1,
                        limit: 1,
                        count: 0,
                    },

                    data: {
                        wr_1 : this.mb_no, // 유저고유값
                        wr_2 : "행사보조", // 종류선택
                        wr_3 : "", // 신청부서
                        wr_4 : "", // 일자
                        wr_5 : [], // 오전 오후 종일
                        wr_6 : "", // 간략 내용
                        wr_7 : "", // 상세 내용
                        wr_8 : "", // 요청자
                        wr_9 : "", // 연락처
                        wr_10 : "", // 지원마감일
                    },
                };
            },
            async created() {
                this.jl = new Jl('<?=$componentName?>');
                this.component_idx = this.jl.generateUniqueId();

                if(this.primary) this.getData();
            },
            mounted() {
                this.$nextTick(() => {

                });
            },
            updated() {

            },
            methods: {
                async postData() {
                    let method = this.primary ? "update" : "insert";
                    let data = {
                        table: "g5_write_helper",
                    }

                    // object의 필수값을 설정하는 option
                    let required = [
                        {name : "wr_1",message : `로그인이 필요한 기능입니다.`},
                        {name : "wr_3",message : `신청부서는 필수입니다.`},
                        {name : "wr_4",message : `날짜를 선택해주세요.`},
                        {name : "wr_6",message : `간략 내용은 필수입니다.`},
                        {name : "wr_7",message : `상세내용은 필수입니다.`},
                        {name : "wr_8",message : `요청자를 입력해주세요.`},
                        {name : "wr_9",message : `연락처를 입력해주세요.`},
                    ]
                    let options = {required : required};

                    if (this.data) data = Object.assign(data, this.data); // paging 객체가있다면 병합

                    try {
                        let res = await this.jl.ajax(method, data, "/jl/JlApi.php",options);
                        await this.jl.alert("완료되었습니다.");
                        window.location.href = "./helper.php";
                    } catch (e) {
                        await this.jl.alert(e.message)
                    }

                },
                async getData() {
                    let filter = {
                        table: "g5_write_helper",
                        primary : this.primary,
                    }

                    if (this.paging) filter = Object.assign(filter, this.paging); // paging 객체가있다면 병합

                    try {
                        let res = await this.jl.ajax("get", filter, "/jl/JlApi.php");
                        this.data = res.data[0]
                        this.paging.count = res.count;
                    } catch (e) {
                        await this.jl.alert(e.message)
                    }
                }
            },
            computed: {},
            watch: {}
        }});

</script>

<style>

</style>