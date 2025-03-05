<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div>
        <div id="lost" class="form">
            <button class="btn btn_large btn_back" type="button" onclick="location.href='./lost'"><i class="fa-solid fa-arrow-left"></i> 분실 목록</button>
            <div class="box_radius box_white table">
                <span class="txt_color">*</span> <span class="txt_gray">표시된 항목은 필수기입 항목입니다.</span>
                <div class="table">
                    <table>
                        <tbody>
                        <tr class="top">
                            <td>품목 <span class="txt_color">*</span></td>
                            <td>
                                <input type="text">
                            </td>
                        </tr>
                        <tr class="top">
                            <td>분실장소 <span class="txt_color">*</span></td>
                            <td>
                                <input type="text">
                            </td>
                        </tr>
                        <tr class="top">
                            <td>분실일시 <span class="txt_color">*</span></td>
                            <td>
                                <div class="date-container">
                                    <input type="date" class="date-input" aria-label="날짜 선택" />
                                    <label for="date-input" class="date-placeholder-label">날짜를 선택해주세요</label>
                                </div>
                                <div class="date-container">
                                    <input type="time" class="time-input" />
                                    <label for="date-input" class="date-placeholder-label">시간을 선택해주세요</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>특징 <span class="txt_color">*</span></td>
                            <td>
                                <input type="text" placeholder="최대한 자세히 작성해주세요">
                            </td>
                        <tr>
                        <tr>
                            <td>사진</td>
                            <td>
                                <div class="flex gap5">
                                    <div class="uploader" data-id="1">사진 선택</div>
                                    <div class="uploader" data-id="2">사진 선택</div>
                                    <div class="uploader" data-id="3">사진 선택</div>
                                    <input type="file" id="file-input" accept="image/*" style="display: none;">
                                </div>
                            </td>
                        <tr>
                            <td>분실인 <span class="txt_color">*</span></td>
                            <td>
                                <input type="text">
                            </td>
                        </tr>
                        <tr>
                            <td>연락처</td>
                            <td>
                                <input type="text" placeholder="">
                            </td>
                        </tr>
                        <tr>
                            <td>교구/속</td>
                            <td>
                                <input type="text" placeholder="교회를 통해 연락 받길 원하면 작성해주세요">
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <br>
                <button type="button" class="btn btn_color btn-large" onclick="location.href='./lost'">등록하기</button>
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

                    // object의 필수값을 설정하는 option
                    let required = [
                        {name : "",message : ""},
                    ]
                    let options = {required : required};

                    if (this.data) data = Object.assign(data, this.data); // paging 객체가있다면 병합

                    try {
                        let res = await this.jl.ajax(method, data, "/jl/JlApi.php",options);
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