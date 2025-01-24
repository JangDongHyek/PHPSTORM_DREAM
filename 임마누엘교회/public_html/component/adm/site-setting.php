<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div>
        <button class="btn btn_large btn_blue btn_b02" @click="postData();">저장</button>
        <br>
        <div class="table">
            <table>
                <thead>
                <tr>
                    <th>항목</th>
                    <th>설정값</th>
                </tr>
                </thead>
                <tbody>

                <tr>
                    <td><b>메인</b> IMC 표어</td>
                    <td>
                        <textarea v-model="data.imc"></textarea>
                    </td>
                </tr>

                <!--<tr>-->
                <!--    <td><b>금주의 설교</b> 유튜브 링크</td>-->
                <!--    <td>-->
                <!--        <input type="text" v-model="data.main_youtube">-->
                <!--    </td>-->
                <!--</tr>-->


                <tr>
                    <td><b>결단노트</b> 주일말씀</td>
                    <td>
                        <input type="text" v-model="data.note_day">
                    </td>
                </tr>

                <tr>
                    <td><b>결단노트</b> 이번주 결단</td>
                    <td>
                        <input type="text" v-model="data.note_week">
                    </td>
                </tr>

                <tr>
                    <td><b>결단노트</b> 실천기간</td>
                    <td>
                        <input type="date" v-model="data.note_date" max="9999-12-31">
                    </td>
                </tr>
                <tr>
                    <td><b>유튜브</b></td>
                    <td>
                        <input type="text" v-model="data.sns_youtube">
                    </td>
                </tr>
                <tr>
                    <td><b>카카오톡</b></td>
                    <td>
                        <input type="text" v-model="data.sns_kakao">
                    </td>
                </tr>
                <tr>
                    <td><b>페이스북</b></td>
                    <td>
                        <input type="text" v-model="data.sns_facebook">
                    </td>
                </tr>
                <tr>
                    <td><b>인스타그램</b></td>
                    <td>
                        <input type="text" v-model="data.sns_insta">
                    </td>
                </tr>
                <tr>
                    <td><b>블로그</b></td>
                    <td>
                        <input type="text" v-model="data.sns_blog">
                    </td>
                </tr>
                <tr>
                    <td><b>틱톡</b></td>
                    <td>
                        <input type="text" v-model="data.sns_tiktok">
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</script>

<script>
    Jl_components.push({name : "<?=$componentName?>",object : {
            template: "#<?=$componentName?>-template",
            props: {
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

                    data: {
                        imc : "",
                        main_youtube : "",
                        note_day : "",
                        note_week : "",
                        note_date : "",
                        sns_youtube : "",
                        sns_kakao : "",
                        sns_facebook : "",
                        sns_insta : "",
                        sns_blog : "",
                        sns_tiktok : "",
                    },
                };
            },
            async created() {
                this.jl = new Jl('<?=$componentName?>');
                this.component_idx = this.jl.generateUniqueId();

                this.getData();
            },
            mounted() {
                this.$nextTick(() => {

                });
            },
            updated() {

            },
            methods: {
                async postData() {
                    let method = "insert";
                    let data = {
                        table: "site_setting",
                    }

                    if (this.data) data = Object.assign(data, this.data); // paging 객체가있다면 병합

                    data.idx = "";

                    try {
                        let res = await this.jl.ajax(method, data, "/jl/JlApi.php");
                        await this.jl.alert("변경되었습니다.");
                        window.location.reload();
                    } catch (e) {
                        await this.jl.alert(e.message)
                    }

                },
                async getData() {
                    let filter = {
                        table: "site_setting",
                        order_by_desc : "idx"
                    }

                    try {
                        let res = await this.jl.ajax("get", filter, "/jl/JlApi.php");
                        this.data = res.data[0]
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