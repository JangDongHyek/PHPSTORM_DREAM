<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div>
        <table>
            <tr>
                <th>금주의 설교 유튜브 링크</th>
                <td>
                    <input type="text" v-model="data.main_youtube">
                </td>
            </tr>

            <tr>
                <th>결단노트 - 주일말씀</th>
                <td>
                    <input type="text" v-model="data.note_day">
                </td>
            </tr>

            <tr>
                <th>결단노트 - 이번주 결단</th>
                <td>
                    <input type="text" v-model="data.note_week">
                </td>
            </tr>

            <tr>
                <th>결단노트 - 실천기간</th>
                <td>
                    <input type="date" v-model="data.note_date">
                </td>
            </tr>
        </table>

        <button @click="postData();">저장</button>
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
                        main_youtube : "",
                        note_day : "",
                        note_week : "",
                        note_date : "",
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
                        alert("변경되었습니다.");
                        window.location.reload();
                    } catch (e) {
                        alert(e.message)
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
                        alert(e.message)
                    }
                }
            },
            computed: {},
            watch: {}
        }});

</script>

<style>
    /* 테이블 기본 스타일 */
    table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
        font-size: 16px;
        text-align: left;
        background-color: #f9f9f9;
        border: 1px solid #ddd;
        border-radius: 8px;
        overflow: hidden;
    }

    /* 테이블 헤더 스타일 */
    table th {
        background-color: #007BFF;
        color: #fff;
        font-weight: bold;
        padding: 12px;
        text-align: center;
        border-bottom: 2px solid #ddd;
    }

    /* 테이블 셀 스타일 */
    table td {
        padding: 12px;
        border-bottom: 1px solid #ddd;
    }

    /* 홀수 행 배경색 */
    table tr:nth-child(odd) {
        background-color: #f4f4f4;
    }

    /* 테이블 행 hover 효과 */
    table tr:hover {
        background-color: #e9ecef;
    }

    /* 입력 필드 스타일 */
    table input[type="text"],
    table input[type="date"] {
        width: 100%;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
        box-sizing: border-box;
    }

    /* 버튼 스타일 */
    button {
        background-color: #28a745;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 14px;
        margin-top: 10px;
    }

    button:hover {
        background-color: #218838;
    }
</style>