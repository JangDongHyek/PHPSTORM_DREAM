<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div>
        <div class="box_radius box_white table">
            <h6>{{board.wr_11}}</h6>
            <p>연락처 | {{board.wr_12}}</p>
            <hr>
            <p><b class="icon icon_gray">장소/시간 </b> <br><i class="fa-solid fa-booth-curtain txt_blue"></i> {{board.wr_4}} <br><i class="fa-solid fa-clock txt_blue"></i>{{board.wr_5}} {{board.wr_6}} </p>
            <p><b class="icon icon_gray">품목</b> {{board.wr_3}} </p>
            <p><b class="icon icon_gray">특징</b> {{board.wr_7}} </p>
            
            <p v-if="board.wr_2 == '습득'"><b class="icon icon_gray">보관장소</b> - {{board.wr_13}}</p>
            <p v-else><b class="icon icon_gray">교구/속</b> - {{board.wr_13}}</p>

            <img v-if="board.wr_8" :src="jl.root+board.wr_8.src" alt="">
            <img v-if="board.wr_9" :src="jl.root+board.wr_9.src" alt="">
            <img v-if="board.wr_10" :src="jl.root+board.wr_10.src" alt="">

            <button class="btn btn_large btn_blue" type="button" v-if="admin ||board.wr_1 == mb_no" @click="postBoard()">찾았어요</button>
            <button class="btn w100 btn_line" type="button" v-if="board.wr_1 == mb_no" @click="putHref()">수정하기</button>

            <button v-if="board.wr_1 == mb_no || admin" class="btn btn_large btn_gray2" type="button" @click="jl.deleteData(board,'g5_write_lost',{href:'./lost'})">삭제</button>
        </div>
    </div>
</script>

<script>
    Jl_components.push({name : "<?=$componentName?>",object : {
            template: "#<?=$componentName?>-template",
            props: {
                mb_no : {type: String, default: ""},
                admin : {type: String, default: ""},
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

                    board : {},
                };
            },
            async created() {
                this.jl = new Jl('<?=$componentName?>');
                this.component_idx = this.jl.generateUniqueId();

                await this.getBoard();
            },
            mounted() {
                this.$nextTick(() => {

                });
            },
            updated() {

            },
            methods: {
                putHref() {
                    this.jl.href(`./lost_form?tab=${this.board.wr_2 == '습득' ? 1 : 2}&idx=${this.board.wr_id}`)
                },
                async postBoard() {
                    let data = {
                        table: "g5_write_lost",
                        primary : this.board.wr_id,
                        wr_14 : true,
                    }

                    try {
                        if(!data.primary) throw new Error("잘못된 접근입니다.");
                        if(this.board.wr_14) throw new Error("이미 찾은 분실물입니다.");
                        let res = await this.jl.ajax("update", data, "/jl/JlApi.php");

                        await this.jl.alert("수정되었습니다.");
                        window.location.reload();
                    } catch (e) {
                        await this.jl.alert(e.message)
                    }

                },
                async getBoard() {
                    let filter = {
                        table: "g5_write_lost",
                        primary : this.primary
                    }

                    if (this.paging) filter = Object.assign(filter, this.paging); // paging 객체가있다면 병합

                    try {
                        let res = await this.jl.ajax("get", filter, "/jl/JlApi.php");
                        this.board = res.data[0]
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