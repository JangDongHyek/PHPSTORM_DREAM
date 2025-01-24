<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div id="video" class="form">
        <div class="box_radius box_white">
            <span class="txt_color">*</span> <span class="txt_gray">표시된 항목은 필수기입 항목입니다.</span>
            <div class="table">
                <table>
                    <tbody>
                    <tr class="top">
                        <td>제목 <span class="txt_color">*</span></td>
                        <td>
                            <input type="text" v-model="board.wr_subject" placeholder="제목">
                        </td>
                    </tr>
                    <tr>
                        <td>동영상 링크 <span class="txt_color">*</span></td>
                        <td>
                            <input type="text" v-model="board.wr_content" placeholder="링크">
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <br>
            <button type="button" class="btn btn_color btn-large" @click="postBoard()">등록하기</button>
        </div>
    </div>
</script>

<script>
    Jl_components.push({name : "<?=$componentName?>",object : {
            template: "#<?=$componentName?>-template",
            props: {
                mb_no: {type: String, default: ""},
                primary: {type: String, default: ""},
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

                    board: {
                        wr_1 : this.mb_no,
                        wr_subject : "",
                        wr_content : "",
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
                async postBoard() {
                    let method = this.primary ? "update" : "insert";
                    let data = {
                        table: "g5_write_video",
                    }

                    let required = [
                        {name : "wr_1",message : "로그인이 필요한 기능입니다."},
                        {name : "wr_subject",message : "제목은 필수값입니다."},
                        {name : "wr_content",message : "링크는 필수값입니다."},
                    ]
                    let options = {required : required};

                    if (this.board) data = Object.assign(data, this.board); // paging 객체가있다면 병합

                    try {
                        let res = await this.jl.ajax(method, data, "/jl/JlApi.php",options);
                        await this.jl.alert("완료되었습니다.");
                        window.location.href = "./video";
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