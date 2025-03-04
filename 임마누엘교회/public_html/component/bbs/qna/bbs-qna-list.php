<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div v-if="load">
        <div class="box_radius box_white">
            <div class="table">
                <table>
                    <thead>
                    <tr>
                        <th>날짜</th>
                        <th>상태</th>
                        <th>문의 제목</th>
                        <th>작성인</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-if="arrays.length > 0"  v-for="board in arrays">
                        <td>{{board.wr_datetime.split(' ')[0]}}</td>
                        <td class="txt_bold" :class="{'txt_blue' : board.wr_2}">{{board.wr_2 ? '완료' : '접수'}}</td>
                        <td><p class="cut" @click="viewBoard(board)">{{board.wr_subject}}</p></td>
                        <td>{{board.$g5_member.mb_name}}</td>
                    </tr>

                    <tr v-else>
                        <td colspan="20">
                            작성된 내용이 없습니다.
                        </td>
                    </tr>

                    </tbody>
                </table>
            </div>
            <item-paging :paging="filter" @change="filter.page = $event; this.jl.getsData(filter,arrays);"></item-paging>
        </div>

        <item-bs-modal :modal="modal" @close="modal = false;">
            <template v-slot:header>
                <h4 class="modal-title" id="inquiryModalLabel">문의 내용</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </template>

            <!-- body -->
            <template v-slot:default>
                <div v-if="modal_data.wr_id">
                    <div class="icon icon_big icon_line">{{modal_data.$g5_member.mb_name}} ({{modal_data.$g5_member.mb_2}} {{modal_data.$g5_member.mb_3}}) <b>{{modal_data.wr_datetime.split(' ')[0]}}</b></div>
                    {{modal_data.wr_subject}}
                </div>
                <textarea placeholder="답변 작성" v-model="modal_data.wr_content"></textarea>
            </template>


            <template v-slot:footer>
                <button type="button" class="btn btn-secondary" @click="modal_data = {}; modal = false;">닫기</button>
                <button type="button" class="btn btn-primary" @click="modal_data.wr_2 = true; jl.postData(modal_data,options)">저장</button>
            </template>
        </item-bs-modal>
    </div>
</script>

<script>
    Jl_components.push({name : "<?=$componentName?>",object : {
            template: "#<?=$componentName?>-template",
            props: {
                mb_1 : {type: String, default: ""},
                primary : {type: String, default: ""},
            },
            data: function () {
                return {
                    load : false,
                    jl: null,
                    component_idx: "",

                    modal : false,
                    modal_data : {},

                    data: {},
                    arrays : [],

                    options : {
                        table : 'g5_write_qna',
                        required : [

                        ],
                        href : "",
                    },

                    filter : {
                        table : "g5_write_qna",
                        page: 1,
                        limit: 10,
                        count: 0,

                        extensions : [
                            {table : "g5_member", foreign : "wr_1"}
                        ],
                    },

                    rend : false,
                };
            },
            async created() {
                this.jl = new Jl('<?=$componentName?>');
                this.component_idx = this.jl.generateUniqueId();

                //if(this.primary) this.data = await this.jl.getData(this.filter);
                await this.jl.getsData(this.filter,this.arrays);

                this.load = true;
            },
            mounted() {
                this.$nextTick(() => {

                });
            },
            updated() {

            },
            methods: {
                async viewBoard(board) {
                    if(this.mb_1 != '관리자') {
                        await this.jl.alert("관리자만 확인 가능합니다.");
                        return false;
                    }
                    this.modal_data = board;
                    this.modal = true;
                }
            },
            computed: {

            },
            watch: {

            }
        }});

</script>

<style>

</style>