<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div v-if="load">
        <div id="class" class="list">
            <button class="btn btn_large btn_back" type="button" onclick="location.href='./class'"><i class="fa-solid fa-arrow-left"></i> 속회방 메인</button>
            <div class="slogan">
                <h6>{{wr_7}} 속회예배 현황
                    <span>이번주 예배 드린 속 <b>{{week_filter.count}}</b>개속 / 전체 {{filter.count}}개속 중</span>
                </h6>
            </div>
            <div class="box_radius box_white">
                <div class="table">
                    <table>
                        <thead>
                        <tr>
                            <th>속</th>
                            <th>속장</th>
                            <th>속회보고</th>
                            <th>특이사항</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="board in arrays">
                            <td>{{board.jl_no_reverse}}</td>
                            <td>{{board.wr_9}} {{board.wr_10}}</td>
                            <td>
                                <button type="button" class="btn btn_mini btn_color" @click="viewBoard(board)">보기</button>
                                <button type="button" class="btn btn_mini btn_line" v-if="mb_no == board.wr_1" @click="jl.href('./class_form?primary='+board.wr_id)">수정</button>
                            </td>
                            <td :class="{'color' : board.wr_6}">{{board.wr_6 ? '유' : '무'}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <item-paging :paging="filter" @change="filter.page = $event; this.jl.getsData(filter,arrays);"></item-paging>
            </div>
        </div>

        <external-bs-modal :modal="modal" @close="modal = false;">
            <template v-slot:header>
                <h4 class="modal-title" id="classViewModalLabel">속회보고</h4>
                <button type="button" class="close" @click="modal = false"><span aria-hidden="true">&times;</span></button>
            </template>

            <!-- body -->
            <template v-slot:default>
                <div class="table">
                    <table>
                        <tbody>
                        <tr class="top">
                            <td>소속</td>
                            <td>
                                <div class="flex ai-c gap5">
                                    <input type="text" readonly v-model="modal_data.wr_7"> 교구
                                    <input type="text" readonly v-model="modal_data.wr_8"> 속
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>속장</td>
                            <td>
                                <div class="flex ai-c gap5">
                                    <input type="text" placeholder="이름" readonly v-model="modal_data.wr_9">
                                    <input type="text" placeholder="직분" readonly v-model="modal_data.wr_10">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>일시 <span class="txt_color">*</span></td>
                            <td>
                                <input type="date" readonly v-model="modal_data.wr_2">
                            </td>
                        </tr>
                        <tr>
                            <td>장소 <span class="txt_color">*</span></td>
                            <td>
                                <input type="text" readonly v-model="modal_data.wr_3">
                            </td>
                        </tr>
                        <tr>
                            <td>인원 <span class="txt_color">*</span></td>
                            <td>
                                <div class="flex ai-c gap5">
                                    <input type="number" readonly v-model="modal_data.wr_4"> 명
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>헌금 <span class="txt_color">*</span></td>
                            <td>
                                <div class="flex ai-c gap5">
                                    <input type="number" readonly v-model="modal_data.wr_5"> 만원
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">특이사항 <span class="txt_color">*</span></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <textarea readonly v-model="modal_data.wr_6"></textarea>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </template>


            <template v-slot:footer>

            </template>
        </external-bs-modal>

    </div>
</script>

<script>
    Jl_components.push({name : "<?=$componentName?>",object : {
            template: "#<?=$componentName?>-template",
            props: {
                mb_no : {type: String, default: ""},
                mb_1 : {type: String, default: ""},
                wr_7 : {type: String, default: ""},
                primary : {type: String, default: ""},
            },
            data: function () {
                return {
                    load : false,
                    jl: null,
                    component_idx: "",

                    data: {},
                    arrays : [],

                    options : {
                        required : [
                            {name : "",message : ``},
                        ],
                        href : "",
                    },

                    filter : {
                        table : "g5_write_class_report",
                        page: 1,
                        limit: 10,
                        count: 0,
                        wr_7 : this.wr_7,
                    },

                    modal : false,
                    modal_data : {},

                    week_filter : {
                        table : "g5_write_class_report",
                        wr_7 : this.wr_7,
                        page: 1,
                        limit: 1,
                        add_query : " and YEARWEEK(wr_2, 1) = YEARWEEK(CURDATE(), 1)"
                    },

                    week : [],
                    rend : false,
                };
            },
            async created() {
                this.jl = new Jl('<?=$componentName?>');
                this.component_idx = this.jl.generateUniqueId();

                if(!this.wr_7) {
                    await this.jl.alert("잘못된 접근입니다.");
                    window.history.back();
                }

                await this.jl.getsData(this.week_filter,this.week);
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
                    let allows = ['관리자','목회자']

                    if(board.wr_1 == this.mb_no) {
                        this.modal_data = board;
                        this.modal = true;
                    }else {
                        if(!allows.includes(this.mb_1)) {
                            await this.jl.alert("작성자 본인만 볼 수 있습니다.")
                            return false;
                        }else {
                            this.modal_data = board;
                            this.modal = true;
                        }
                    }
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