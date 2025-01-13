<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div id="prayer" class="form" :class="{'pc_form' : pc}">
        <div class="box_radius box_white table">
            <ul class="tabs">
                <li class="tab-link current" data-tab="tab-1">요청하기</li>
                <li class="tab-link" data-tab="tab-2">나의 기도요청 내역</li>
            </ul>

            <div id="tab-1" class="tab-content current">
                <span class="txt_color">*</span> <span class="txt_gray">표시된 항목은 필수기입 항목입니다.</span>
                <div class="table">
                    <table>
                        <tbody>
                        <tr class="top">
                            <td>소속</td>
                            <td>
                                <div class="flex ai-c gap5">
                                    <input type="text"> 교구
                                    <input type="text"> 속
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>이름/직분 <span class="txt_color">*</span></td>
                            <td>
                                <div class="flex ai-c gap5">
                                    <input type="text" placeholder="이름" required>
                                    <input type="text" placeholder="직분" required>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>기간 <span class="txt_color">*</span></td>
                            <td>
                                <div class="flex ai-c gap5">
                                    <input type="date" required> 까지
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>유형 <span class="txt_color">*</span></td>
                            <td>
                                <div class="gap5 nowrap select">
                                    <input type="radio" name="cate" id="c1" value="1">
                                    <label class="w100" for="c1">질병</label>
                                    <input type="radio" name="cate" id="c2" value="3" checked="">
                                    <label class="w100" for="c2">가족</label>
                                    <input type="radio" name="cate" id="c3" value="3">
                                    <label class="w100" for="c3">생업</label>
                                    <input type="radio" name="cate" id="c4" value="4">
                                    <label class="w100" for="c4">신앙</label>
                                </div>
                                <input type="text" placeholder="직접 입력">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">기도내용 <span class="txt_color">*</span></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <textarea placeholder="내용을 입력하세요"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>공개대상 <span class="txt_color">*</span></td>
                            <td>
                                <div class="gap5 select nowrap">
                                    <input type="radio" name="view" id="v1" value="1">
                                    <label class="w100" for="v1">전체공개</label>
                                    <input type="radio" name="view" id="v2" value="3" checked="">
                                    <label class="w100" for="v2">도고기도팀</label>
                                    <input type="radio" name="view" id="v3" value="3">
                                    <label class="w100" for="v3">목회자만</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>긴급대상 <span class="txt_color">*</span></td>
                            <td>
                                <div class="gap5 select nowrap">
                                    <input type="radio" name="state" id="s1" value="1">
                                    <label class="w100" for="s1">긴급</label>
                                    <input type="radio" name="state" id="s2" value="3" checked="">
                                    <label class="w100" for="s2">일반</label>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <br>
                <button type="button" class="btn btn_color btn-large" onclick="location.href='./prayer'">등록하기</button>
            </div>

            <div id="tab-2" class="tab-content">

                <div class="table">
                    <table>
                        <thead>
                        <tr>
                            <th>번호</th>
                            <th>기도제목</th>
                            <th>기간</th>
                            <th>수정/완료</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td><p class="cut">기도제목 예시입니다.</p></td>
                            <td>24.09.01-24.10.01</td>
                            <td>
                                <button type="button" class="btn btn_mini btn_line">수정</button>
                                <button type="button" onclick="showToast('기도가 완료되었어요')" class="btn btn_mini btn_colorline">완료</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="b-pagination-outer">
                    <ul id="border-pagination">


                        <li><a href="javascript:void(0)" class="active">1</a></li>
                        <li><a href="?page=2&amp;" class="">2</a></li>
                        <li><a href="?page=3&amp;" class="">3</a></li>
                        <li><a href="?page=4&amp;" class="">4</a></li>


                        <li><a href="?page=4&amp;">»</a></li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</script>

<script>
    Jl_components.push({name : "<?=$componentName?>",object : {
            template: "#<?=$componentName?>-template",
            props: {
                pc: {type: Boolean, default: false},
                primary: {type: String, default: ""}
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

                    data: {},
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
                    let method = this.primary ? "update" : "insert";
                    let data = {
                        table: "",
                    }

                    if (this.data) data = Object.assign(data, this.data); // paging 객체가있다면 병합

                    try {
                        let res = await this.jl.ajax(method, data, "/jl/JlApi.php");
                    } catch (e) {
                        alert(e.message)
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