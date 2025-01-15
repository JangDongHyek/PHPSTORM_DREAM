<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div>
        <div class="table">
            <table>
                <colgroup>
                    <col style="width: 50px">
                    <col style="width: auto">
                    <col style="width: auto">
                    <col style="width: 70px">
                </colgroup>
                <thead>
                <tr>
                    <th>No</th>
                    <th></th>
                    <th>제목</th>
                    <th>작성일</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="board in boards">
                    <td>1</td>
                    <td>
                        <div class="video-container">
                            <iframe
                                :src="'https://www.youtube.com/embed/'+jl.extractYoutube(board.wr_content)"
                                title="YouTube video player"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen>
                            </iframe>
                        </div>
                    </td>
                    <td><p class="cut" @click="jl.open(board.wr_content)">{{board.wr_subject}}</p></td>
                    <td>
                        {{board.wr_datetime.split(' ')[0]}}
                        <button type="button" class="btn btn_mini btn_line" v-if="mb_no == board.wr_1" @click="deleteBoard(board)">삭제</button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <item-paging :paging="paging" @change="paging.page = $event; getBoards();"></item-paging>

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

                    data: {},

                    boards : [],
                };
            },
            async created() {
                this.jl = new Jl('<?=$componentName?>');
                this.component_idx = this.jl.generateUniqueId();

                await this.getBoards();
            },
            mounted() {
                this.$nextTick(() => {

                });
            },
            updated() {

            },
            methods: {
                async deleteBoard(board) {
                    if(! await this.jl.confirm("정말 삭제하시겠습니까?")) return false;
                    let method = "delete";

                    let filter = {
                        table : "g5_write_video",
                        primary : board.wr_id, // delete일시 primary 카깂을 넣으면된다 primary 키값이 아니라면 삭제 안됌
                    }
                    try {
                        let res = await this.jl.ajax(method,filter,"/jl/JlApi.php");

                        await this.jl.alert("완료되었습니다.");
                        window.location.reload();
                    }catch (e) {
                        alert(e.message)
                    }
                },
                async getBoards() {
                    let filter = {
                        table: "g5_write_video",
                    }

                    if (this.paging) filter = Object.assign(filter, this.paging); // paging 객체가있다면 병합

                    try {
                        let res = await this.jl.ajax("get", filter, "/jl/JlApi.php");
                        this.boards = res.data
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