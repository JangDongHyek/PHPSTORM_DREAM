<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div v-if="load">
        <div class="box_radius box_white">
            <div class="flex">
                <select class="w100" v-model="filter.wr_7">
                    <option value="">전체</option>
                    <option v-for="n in 12" :value="n+'교구'">{{n}}교구</option>
                </select>
                <select class="w100" v-model="filter.wr_8">
                    <option value="">전체</option>
                    <option v-for="n in 30" :value="n+'속'">{{n}}속</option>
                </select>
                <button class="btn btn_h40 btn_color" type="button" @click="filter.page = 1; this.jl.getsData(filter,arrays);">검색</button>
            </div>
        </div>
        <div class="box_radius box_white">
            <div class="table">
                <table>
                    <thead>
                    <tr>
                        <th>교구</th>
                        <th>속</th>
                        <th>속장</th>
                        <th>속회보고</th>
                        <th>특이사항</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-if="arrays.length > 0" v-for="board in arrays">
                        <td>{{board.wr_7}}</td>
                        <td>{{board.wr_8}}</td>
                        <td>{{board.wr_9}} {{board.wr_10}}</td>
                        <td>
                            <button type="button" class="btn btn_mini btn_color" @click="modal.data = board; modal.status = true;">보기</button>
                            <button type="button" class="btn btn_mini btn_line" v-if="admin || mb_no == board.wr_1" @click="jl.href('./class_form?primary='+board.wr_id)">수정</button>
                        </td>
                        <td :class="{'color' : board.wr_6}">{{board.wr_6 ? '유' : '무'}}</td>
                    </tr>
                    <tr v-else>
                        <td colspan="20">
                            작성된 내용이 없습니다.
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <item-paging :paging="filter" @change="filter.page = $event; this.jl.getsData(filter,arrays);"></item-paging>

        <external-bs-modal :modal="modal.status" @close="modal.status = false;">
            <template v-slot:header>
                <h4 class="modal-title" id="classViewModalLabel">속회보고</h4>
                <button type="button" class="close" @click="modal.status = false"><span aria-hidden="true">&times;</span></button>
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
                                    <input type="text" readonly v-model="modal.data.wr_7">
                                    <input type="text" readonly v-model="modal.data.wr_8">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>속장</td>
                            <td>
                                <div class="flex ai-c gap5">
                                    <input type="text" placeholder="이름" readonly v-model="modal.data.wr_9">
                                    <input type="text" placeholder="직분" readonly v-model="modal.data.wr_10">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>일시 <span class="txt_color">*</span></td>
                            <td>
                                <input type="date" :readonly="!admin" v-model="modal.data.wr_2">
                            </td>
                        </tr>
                        <tr>
                            <td>장소 <span class="txt_color">*</span></td>
                            <td>
                                <input type="text" :readonly="!admin" v-model="modal.data.wr_3">
                            </td>
                        </tr>
                        <tr>
                            <td>인원 <span class="txt_color">*</span></td>
                            <td>
                                <div class="flex ai-c gap5">
                                    <input type="number" :readonly="!admin" v-model="modal.data.wr_4"> 명
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>헌금 <span class="txt_color">*</span></td>
                            <td>
                                <div class="flex ai-c gap5">
                                    <input type="number" :readonly="!admin" v-model="modal.data.wr_5"> 원
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">특이사항 <span class="txt_color">*</span></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <textarea :readonly="!admin" v-model="modal.data.wr_6"></textarea>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2" v-if="admin || modal.data.wr_1 == mb_no">
                                <button  class="btn btn_large btn_gray2" type="button" @click="jl.postData(modal.data,options)">수정</button>
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
                        table : 'g5_write_class_report',
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
                        wr_7 : "",
                        wr_8 : "",
                    },

                    modal : {
                        status : false,
                        data : {},
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

            },
            computed: {

            },
            watch: {

            }
        }});

</script>

<style>

</style>