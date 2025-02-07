<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div v-if="load">
        <div class="box_radius box_white">
            <h6>이전 속회 소식</h6>
            <div class="table">
                <table>
                    <thead>
                    <tr>
                        <th>날짜</th>
                        <th>내용</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="board in arrays">
                        <td>{{board.wr_datetime.split(' ')[0]}}</td>
                        <td><p class="cut" @click="modal_data = board; modal = true;">{{board.wr_content}}</p></td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <item-paging :paging="filter" @change="filter.page = $event; this.jl.getsData(filter,arrays);"></item-paging>
        </div>

        <external-bs-modal :modal="modal" @close="modal = false;" class_1="" class_2="">
            <template v-slot:header>
                <h4 class="modal-title" id="classNotiModalLabel">속회보고</h4>
                <button type="button" class="close" @click="modal = false;"><span aria-hidden="true">&times;</span></button>
            </template>

            <!-- body -->
            <template v-slot:default>
                <textarea style="min-height: 50vh" placeholder="속회소식를 작성하세요." readonly v-model="modal_data.wr_content"></textarea>
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
                        required : [
                            {name : "",message : ``},
                        ],
                        href : "",
                    },

                    filter : {
                        table : "g5_write_class",
                        primary : this.primary,
                        page: 1,
                        limit: 10,
                        count: 0,
                    },

                    modal : false,
                    modal_data : {},

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