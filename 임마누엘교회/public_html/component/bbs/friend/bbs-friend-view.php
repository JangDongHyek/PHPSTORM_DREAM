<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div>
        <div class="box_radius box_white table" v-if="board.wr_id">
            <p><b class="icon icon_color">{{board.wr_4}}</b></p>
            <h6 class="txt_color">{{board.wr_3}} | {{board.wr_name}} {{board.wr_2}}</h6>
            <p>기간 | {{board.wr_6.split(' ')[0]}} - {{board.wr_7.split(' ')[0]}} </p>
            <hr>
            <h6>{{board.wr_subject}}</h6><!--제목-->
            <p>{{board.wr_content}}</p><!--내용-->
            <hr>
            <p class="flex gap10">
                <b class="icon icon_line w100px">장소</b>{{board.wr_8}}
                <button type="button" class="btn btn_gray btn_mini male-auto" @click="jl.generateClipboard(board.wr_8)">복사</button>
            </p>

            <!--<external-daum-map></external-daum-map>-->

            <p class="flex gap10">
                <b class="icon icon_line w100px">마음전할곳</b>{{board.wr_11}} {{board.wr_13}} ({{board.wr_12}})
                <button type="button" class="btn btn_gray btn_mini male-auto" @click="jl.generateClipboard(board.wr_11+' '+board.wr_13)">복사</button>
            </p>
        </div>
    </div>
</script>

<script>
    Jl_components.push({name : "<?=$componentName?>",object : {
            template: "#<?=$componentName?>-template",
            props: {
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
                async getBoard() {
                    let filter = {
                        table: "g5_write_friend",
                        primary : this.primary
                    }

                    if (this.paging) filter = Object.assign(filter, this.paging); // paging 객체가있다면 병합

                    try {
                        let res = await this.jl.ajax("get", filter, "/jl/JlApi.php");
                        this.board = res.data[0]
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