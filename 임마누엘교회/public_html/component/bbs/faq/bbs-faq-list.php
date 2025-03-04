<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div v-if="load">
        <div class="box_radius box_white">
            <div class="list" v-if="arrays.length > 0">
                <ul>
                    <li v-for="board in arrays">
                        <details>
                            <summary><span class="ask">Q</span> {{board.wr_subject}}</summary>
                            <div>
                                <span class="answer">A</span>
                                {{board.wr_content}}
                                <br>
                                <button type="button" class="btn btn_mini btn_line" v-if="mb_1 == '관리자'" @click="jl.href('./faq_form?primary='+board.wr_id)">수정</button>
                                <button type="button" class="btn btn_mini btn_colorline" v-if="mb_1 == '관리자'" @click="jl.deleteData(board,{table :'g5_write_faq'})">삭제</button>
                            </div>
                        </details>
                    </li>
                </ul>
            </div>

            <div v-else>작성된 내용이 없습니다.</div>

            <item-paging :paging="filter" @change="filter.page = $event; this.jl.getsData(filter,arrays);"></item-paging>
        </div>
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

                    data: {},
                    arrays : [],

                    filter : {
                        table : "g5_write_faq",
                        page: 1,
                        limit: 1,
                        count: 0,
                    },

                    rend : false,
                };
            },
            async created() {
                this.jl = new Jl('<?=$componentName?>');
                this.component_idx = this.jl.generateUniqueId();

                if(this.primary) this.data = await this.jl.getData(this.filter);
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