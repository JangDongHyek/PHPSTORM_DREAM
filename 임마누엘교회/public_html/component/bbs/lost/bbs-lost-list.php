<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div>
        <div class="box_radius box_white table">
            <ul class="tabs">
                <li class="tab-link" :class="{'current' : tab == '습득'}" @click="tab = '습득'">보관된 분실물</li>
                <li class="tab-link" :class="{'current' : tab == '분실'}" @click="tab = '분실'">신고된 분실물</li>
            </ul>

            <div id="tab-1" class="tab-content current">
                <div class="table">
                    <table>
                        <thead>
                        <tr>
                            <th>품목</th>
                            <th>{{tab}}일</th>
                            <th>{{tab}}장소</th>
                            <th>처리상태</th>
                            <th>상세</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="board in boards">
                            <td>{{board.wr_3}}</td>
                            <td>{{board.wr_5}}</td>
                            <td>{{board.wr_4}}</td>
                            <td>
                                <button type="button" class="btn btn_mini btn_red" :class="{'btn_blue' : board.wr_14}">{{getStatus(board)}}</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn_mini btn_gray" @click="jl.href('./lost_view.php?idx='+board.wr_id)">보기</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <item-paging :paging="paging" @change="paging.page = $event; getBoards();"></item-paging>
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
                    boards : [],
                    tab : "습득",
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
                getStatus(board) {
                    if(this.tab == '습득') {
                        if(board.wr_14) return "인계완료";
                        else return "보관중";
                    }else {
                        if(board.wr_14) return "찾았어요";
                        else return "신고중";
                    }
                },
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
                async getBoards() {
                    let filter = {
                        table: "g5_write_lost",
                        wr_2 : this.tab,
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
            watch: {
                tab() {
                    this.paging.page = 1;
                    this.getBoards();
                }
            }
        }});

</script>

<style>

</style>