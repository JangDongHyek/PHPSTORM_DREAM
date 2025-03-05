<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div id="friend" class="form">
        <div class="box_radius box_white">
            <span class="txt_color">*</span> <span class="txt_gray">표시된 항목은 필수기입 항목입니다.</span>
            <div class="table">
                <table>
                    <tbody>
                    <tr class="top">
                        <td>이름 <span class="txt_color">*</span></td>
                        <td>
                            <input type="text" placeholder="이름" v-model="data.wr_name">
                        </td>
                    </tr>
                    <tr>
                        <td>직분 <span class="txt_color">*</span></td>
                        <td>
                            <input type="text" placeholder="직분" v-model="data.wr_2">
                        </td>
                    </tr>
                    <tr>
                        <td>교구 <span class="txt_color">*</span></td>
                        <td>
                            <input type="text" placeholder="교구" v-model="data.wr_3">
                        </td>
                    </tr>
                    <tr>
                        <td>유형 <span class="txt_color">*</span></td>
                        <td>
                            <div class="gap5 select grid grid4">
                                <input type="radio" name="cate" id="c1" value="장 례" v-model="data.wr_4">
                                <label class="w100" for="c1">장 례</label>
                                <input type="radio" name="cate" id="c2" value="결 혼" v-model="data.wr_4">
                                <label class="w100" for="c2">결 혼</label>
                                <input type="radio" name="cate" id="c3" value="입 원" v-model="data.wr_4">
                                <label class="w100" for="c3">입 원</label>
                                <input type="radio" name="cate" id="c4" value="수 술" v-model="data.wr_4">
                                <label class="w100" for="c4">수 술</label>
                                <input type="radio" name="cate" id="c5" value="개 업" v-model="data.wr_4">
                                <label class="w100" for="c5">개 업</label>
                                <input type="radio" name="cate" id="c6" value="출 산" v-model="data.wr_4">
                                <label class="w100" for="c6">출 산</label>
                                <span>
                                    <input type="radio" name="cate" id="c7" value="기타" v-model="data.wr_4">
                                    <label class="w100" for="c7">기타</label>
                                    <input type="text" placeholder="직접 입력" v-model="data.wr_5">
                                </span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>기간 <span class="txt_color">*</span></td>
                        <td>
                            <div class="flex gap5 date">
                                <span><input type="date" max="9999-12-31" v-model="data.wr_6"> 부터</span>
                                <span><input type="date" max="9999-12-31" v-model="data.wr_7"> 까지</span>
                            </div>
                            <p class="text_left">* 기간이 만료된 소식은 자동삭제 됩니다.</p>
                        </td>
                    </tr>
                    <tr>
                        <td>제목 <span class="txt_color">*</span></td>
                        <td>
                            <input type="text" placeholder="제목" v-model="data.wr_subject">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">상세내용 <span class="txt_color">*</span></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <textarea placeholder="내용을 입력하세요" v-model="data.wr_content"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>장소안내</td>
                        <td>
                            <div class="flex gap5 ai-c">
                                <input type="text" placeholder="주소입력" @click="modal = true;" v-model="data.wr_8" readonly>
                                <button type="button" class="btn btn_gray btn_h40" @click="modal = true;">검색</button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>마음전할곳</td>
                        <td>
                            <div class="flex gap5 ai-c">
                                <input type="text" placeholder="은행" v-model="data.wr_11">
                                <input type="text" placeholder="예금주" v-model="data.wr_12">
                            </div>
                            <input type="text" placeholder="계좌번호" v-model="data.wr_13">
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <br>
            <button type="button" class="btn btn_color btn-large" @click="postBoard()">등록하기</button>

            <external-bs-daum-postcode :modal="modal" @close="modal = false;" @select="getAddress"></external-bs-daum-postcode>
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
                        wr_1 : this.mb_no, // 유저 고유값
                        wr_name : "", // 이름
                        wr_2 : "", // 직분
                        wr_3 : "", // 교구
                        wr_4 : "장 례", // 유형
                        wr_5 : "", // 유형 직접입력시
                        wr_6 : "", // 기간s
                        wr_7 : "", // 기간e
                        wr_subject : "", //
                        wr_content : "", //
                        wr_8 : "", // 주소1
                        wr_9 : "", // 주소2
                        wr_10 : "", // 주소3
                        wr_11 : "", // 은행
                        wr_12 : "", // 예금주
                        wr_13 : "", // 계좌번호
                    },

                    modal : false,
                };
            },
            async created() {
                this.jl = new Jl('<?=$componentName?>');
                this.component_idx = this.jl.generateUniqueId();
            },
            async mounted() {
                if(this.primary) this.data = await this.jl.getData({
                    table : "g5_write_friend",
                    primary : this.primary,
                });
                this.$nextTick(() => {

                });
            },
            updated() {

            },
            methods: {
                getAddress(data) {
                    console.log(data);
                    this.data.wr_8 = data.address
                    this.data.wr_9 = data;
                    this.modal = false;
                },
                async postBoard() {
                    let method = this.primary ? "update" : "insert";
                    let data = {
                        table: "g5_write_friend",
                    }

                    // object의 필수값을 설정하는 option
                    let required = [
                        {name : "wr_1",message : "로그인이 필요한 기능입니다."},
                        {name : "wr_name",message : "이름은 필수값입니다."},
                        {name : "wr_2",message : "직분은 필수값입니다."},
                        {name : "wr_3",message : "교구는 필수값입니다."},
                        {name : "wr_4",message : "유형은 필수값입니다."},
                        {name : "wr_6",message : "기간은 필수값입니다."},
                        {name : "wr_7",message : "기간은 필수값입니다."},
                        {name : "wr_subject",message : "제목은 필수값입니다."},
                        {name : "wr_content",message : "내용은 필수값입니다."},
                    ]
                    let options = {required : required};

                    if (this.data) data = Object.assign(data, this.data); // paging 객체가있다면 병합

                    try {
                        let res = await this.jl.ajax(method, data, "/jl/JlApi.php",options);
                        await this.jl.alert("완료되었습니다.");
                        window.location.href = "./friend";
                    } catch (e) {
                        await this.jl.alert(e.message)
                    }

                },
                async getData() {
                    let filter = {
                        table: "user",
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