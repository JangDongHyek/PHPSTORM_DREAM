<script charset="UTF-8" class="daum_roughmap_loader_script" src="https://ssl.daumcdn.net/dmaps/map_js_init/roughmapLoader.js"></script>
<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div>
        <div class="table">
            <table>
                <thead>
                <tr>
                    <th>구분</th>
                    <th>교구/이름</th>
                    <th>제목</th>
                    <th>시작일</th>
                    <th>종료일</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="board in boards">
                    <td>{{board.wr_5 ? board.wr_5 : board.wr_4}}</td>
                    <td>{{board.wr_3}}/{{board.wr_name}}</td>
                    <td><p class="cut" @click="jl.href('./friend_view.php?idx='+board.wr_id)">{{board.wr_subject}}</p></td>
                    <td>{{board.wr_6.split(' ')[0]}}</td>
                    <td>{{board.wr_7.split(' ')[0]}}</td>
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
                        table: "g5_write_friend",
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