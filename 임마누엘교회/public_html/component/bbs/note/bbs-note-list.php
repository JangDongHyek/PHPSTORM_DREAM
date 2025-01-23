<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div>
        <div class="table">
            <table>
                <thead>
                <tr>
                    <th>번호</th>
                    <th>이름</th>
                    <th>결단 및 실천</th>
                    <th>응원해요</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="board in boards">
                    <td>{{board.jl_no}}</td>
                    <td>{{board.$g5_member.mb_name}}</td>
                    <td><p class="cut" @click="viewContent(board)">{{board.wr_2 == '공개' ? board.wr_content : '비공개입니다.'}}</p></td>
                    <td><a @click="postLike(board)"><i class="fa-duotone fa-solid fa-hands-clapping"></i> {{board.like_count}}</a></td>
                </tr>
                </tbody>
            </table>
        </div>

        <item-paging :paging="paging" @change="paging.page = $event; getBoards();"></item-paging>

        <item-bs-modal :modal="modal" @close="modal = false;">
            <template v-slot:header>
                <h4 class="modal-title" id="noteViewModalLabel">결단노트</h4>
                <button type="button" class="close" @click="modal = false;"><span aria-hidden="true">&times;</span></button>
            </template>

            <!-- body -->
            <template v-slot:default >
                <h6 class="flex ai-c jc-sb" v-if="note.$g5_member">{{note.$g5_member.mb_name}} <span class="icon icon_gray">작성일시 | {{note.wr_datetime}} </span></h6>
                <br>
                {{note.wr_content}}
            </template>


            <template v-slot:footer>

            </template>
        </item-bs-modal>
    </div>
</script>

<script>
    Jl_components.push({name : "<?=$componentName?>",object : {
            template: "#<?=$componentName?>-template",
            props: {
                mb_1 : {type: String, default: ""},
                mb_no : {type: String, default: ""},
                primary: {type: String, default: ""},
            },
            data: function () {
                return {
                    jl: null,
                    component_idx: "",

                    paging: {
                        page: 1,
                        limit: 10,
                        count: 0,
                    },

                    data: {},

                    boards : [],

                    modal : false,
                    note : {},
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
                async viewContent(board) {
                    let allows = ['관리자']

                    if(board.wr_2 == "공개") {
                        this.note = board;
                        this.modal = true;
                    }else {
                        if(board.wr_1 == this.mb_no) {
                            this.note = board;
                            this.modal = true;
                        }else {
                            if(!allows.includes(this.mb_1)) {
                                await this.jl.alert("권한이 부족합니다.")
                                return false;
                            }else {
                                this.note = board;
                                this.modal = true;
                            }
                        }
                    }

                },
                async postLike(board) {
                    if(!this.mb_no) {
                        await this.jl.alert("로그인이 필요한 기능입니다.");
                        return false;
                    }
                    let method = "insert";
                    let data = {
                        table: "g5_write_note_like",
                        board_idx : board.wr_id,
                        user_idx : this.mb_no,

                        exists : [
                            {
                                where : [
                                    {key : "board_idx", value : board.wr_id},
                                    {key : "user_idx", value : this.mb_no}
                                ],
                                message : "이미 박수를 친 결단노트입니다."
                            }
                        ],
                    }

                    if (this.data) data = Object.assign(data, this.data); // paging 객체가있다면 병합

                    try {
                        let res = await this.jl.ajax(method, data, "/jl/JlApi.php");

                        await this.jl.alert("응원해요!🙌");
                        await this.getBoards();
                    } catch (e) {
                        alert(e.message)
                    }

                },
                async getBoards() {
                    let filter = {
                        table: "g5_write_note",

                        extensions : [
                            {table : "g5_member", foreign : "wr_1"}
                        ],

                        join : {
                            table : "g5_write_note_like", origin : "wr_id", join : "board_idx", type : "LEFT",
                            source : false, // true 시 join 테이블이 조회 기준이 된다
                            select : [], // 조회 기준이 아닌 테이블의 컬럼을 추가 조회하고싶을때 넣는다
                            //select : "*" // 조회 기준이 아닌 테이블의 모든 컬럼을 가져오고싶을때 사용 속도로 인한 비추천
                            group_by : [
                                {group : "g5_write_note.wr_id", aggregate : "g5_write_note_like.idx", as : "like_count", type : ""}
                            ]
                        },
                    }

                    if (this.paging) filter = Object.assign(filter, this.paging); // paging 객체가있다면 병합

                    try {
                        let res = await this.jl.ajax("get", filter, "/jl/JlApi.php");
                        this.boards = res.data
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