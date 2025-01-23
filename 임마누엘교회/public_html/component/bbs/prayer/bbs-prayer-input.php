<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div id="prayer" class="form" :class="{'pc_form' : pc}">
        <div class="box_radius box_white table">
            <ul class="tabs">
                <li class="tab-link" :class="{'current' : tab == 1}" data-tab="tab-1" @click="tab = 1">요청하기</li>
                <li class="tab-link" :class="{'current' : tab == 2}" data-tab="tab-2" @click="tab = 2">나의 기도요청 내역</li>
            </ul>

            <div v-show="tab == 1" class="tab-content current">
                <span class="txt_color">*</span> <span class="txt_gray">표시된 항목은 필수기입 항목입니다.</span>
                <div class="table">
                    <table>
                        <tbody>
                        <tr class="top">
                            <td>소속</td>
                            <td>
                                <div class="flex ai-c gap5">
                                    <input type="text" v-model="data.belong"> 교구
                                    <input type="text" v-model="data.parish"> 속
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>이름/직분 <span class="txt_color">*</span></td>
                            <td>
                                <div class="flex ai-c gap5">
                                    <input type="text" v-model="data.name" placeholder="이름" required>
                                    <input type="text" v-model="data.job" placeholder="직분" required>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>기간 <span class="txt_color">*</span></td>
                            <td>
                                <div class="flex ai-c gap5">
                                    <input type="date" v-model="data.request_date" required max="9999-12-31"> 까지
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>유형 <span class="txt_color">*</span></td>
                            <td>
                                <div class="gap5 nowrap select">
                                    <input type="radio" name="cate" id="c1" value="질병" v-model="data.types">
                                    <label class="w100" for="c1">질병</label>
                                    <input type="radio" name="cate" id="c2" value="가족" v-model="data.types">
                                    <label class="w100" for="c2">가족</label>
                                    <input type="radio" name="cate" id="c3" value="생업" v-model="data.types">
                                    <label class="w100" for="c3">생업</label>
                                    <input type="radio" name="cate" id="c4" value="신앙" v-model="data.types">
                                    <label class="w100" for="c4">신앙</label>
                                </div>
                                <input type="text" v-model="data.types2" placeholder="직접 입력">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">기도내용 <span class="txt_color">*</span></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <textarea placeholder="내용을 입력하세요" v-model="data.content"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>공개대상 <span class="txt_color">*</span></td>
                            <td>
                                <div class="gap5 select nowrap">
                                    <input type="radio" name="view" id="v1" value="전체공개" v-model="data.republic">
                                    <label class="w100" for="v1">전체공개</label>
                                    <input type="radio" name="view" id="v2" value="도고기도팀" v-model="data.republic">
                                    <label class="w100" for="v2">도고기도팀</label>
                                    <input type="radio" name="view" id="v3" value="목회자만" v-model="data.republic">
                                    <label class="w100" for="v3">목회자만</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>긴급대상 <span class="txt_color">*</span></td>
                            <td>
                                <div class="gap5 select nowrap">
                                    <input type="radio" name="state" id="s1" value="긴급" v-model="data.emergency">
                                    <label class="w100" for="s1">긴급</label>
                                    <input type="radio" name="state" id="s2" value="일반" v-model="data.emergency">
                                    <label class="w100" for="s2">일반</label>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <br>
                <button type="button" class="btn btn_color btn-large" @click="postData()">등록하기</button>
            </div>

            <bbs-prayer-mylist v-show="tab == 2" :pc="pc" :mb_no="mb_no" @modify="getPrayer"></bbs-prayer-mylist>
        </div>
    </div>
</script>

<script>
    Jl_components.push({name : "<?=$componentName?>",object : {
            template: "#<?=$componentName?>-template",
            props: {
                pc: {type: Boolean, default: false},
                mb_no : {type: String, default: ""},
                primary: {type: String, default: ""}
            },
            data: function () {
                return {
                    jl: null,
                    component_idx: "",

                    tab : 1,

                    paging: {
                        page: 1,
                        limit: 1,
                        count: 0,
                    },

                    data: {
                        user_idx : this.mb_no,
                        belong : "",
                        parish : "",
                        name : "",
                        job : "",
                        request_date : "",
                        types : "질병",
                        types2 : "",
                        content : "",
                        republic : "전체공개",
                        emergency : "일반",
                        status : "진행"
                    },
                };
            },
            async created() {
                this.jl = new Jl('<?=$componentName?>');
                this.component_idx = this.jl.generateUniqueId();
            },
            mounted() {
                this.$nextTick(() => {

                });
            },
            updated() {

            },
            methods: {
                async postData() {
                    if(!this.mb_no) {
                        await this.jl.alert("로그인이 필요한 기능입니다.");
                        return false;
                    }

                    // object의 필수값을 설정하는 option
                    let required = [
                        {name : "name",message : "이름/직분은 필수기입 항복입니다."},
                        {name : "job",message : "이름/직분은 필수기입 항복입니다."},
                        {name : "request_date",message : "기간은 필수기입 항목입니다."},
                        {name : "content",message : "기도내용은 필수기입 항복입니다."},
                    ]
                    let options = {required : required};

                    let data = {
                        table: "prayer",
                    }

                    if (this.data) data = Object.assign(data, this.data); // paging 객체가있다면 병합

                    let method = this.data.idx ? "update" : "insert";


                    try {
                        let res = await this.jl.ajax(method, data, "/jl/JlApi.php",options);

                        await this.jl.alert("신청되었습니다.");
                        window.location.href = "./prayer";
                    } catch (e) {
                        await this.jl.alert(e.message)
                    }

                },
                async getPrayer(idx) {
                    this.tab = 1;
                    let filter = {
                        table: "prayer",
                        idx : idx,
                    }

                    if (this.paging) filter = Object.assign(filter, this.paging); // paging 객체가있다면 병합

                    try {
                        let res = await this.jl.ajax("get", filter, "/jl/JlApi.php");
                        this.data = res.data[0]
                    } catch (e) {
                        alert(e.message)
                    }
                }
            },
            computed: {},
            watch: {}
        }});

</script>

<style>

</style>