<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div>
        <div class="table">
            <table>
                <thead>
                <tr>
                    <th>종류</th>
                    <th>일시</th>
                    <th>신청부서(인)</th>
                    <th>간략내용</th>
                    <th>상세내용</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="board in data_array">
                    <td>{{board.wr_2}}</td>
                    <td>{{board.wr_4}} {{board.wr_5}}</td>
                    <td>{{board.wr_3}}</td>
                    <td><p class="cut">{{board.wr_6}}</p></td>
                    <td>
                        <button type="button" class="btn btn_mini btn_gray" @click="jl.href('./helper_view.php?primary='+board.wr_id)">보기</button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <item-paging :paging="paging" @change="paging.page = $event; getsData();"></item-paging>
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
                    data_array : [],
                };
            },
            async created() {
                this.jl = new Jl('<?=$componentName?>');
                this.component_idx = this.jl.generateUniqueId();

                if(this.primary) this.getData();

                await this.getsData();
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
                        {name : "",message : ``},
                    ]
                    let options = {required : required};

                    if (this.data) data = Object.assign(data, this.data); // paging 객체가있다면 병합
                    method = data.idx ? 'update' : 'insert';

                    try {
                        let res = await this.jl.ajax(method, data, "/jl/JlApi.php",options);
                    } catch (e) {
                        await this.jl.alert(e.message)
                    }

                },
                async getData() {
                    let filter = {
                        table: "",
                    }

                    try {
                        let res = await this.jl.ajax("get", filter, "/jl/JlApi.php");
                        this.data = res.data[0]
                    } catch (e) {
                        await this.jl.alert(e.message)
                    }
                },
                async getsData() {
                    let filter = {
                        table: "g5_write_helper",
                    }

                    if (this.paging) filter = Object.assign(filter, this.paging); // paging 객체가있다면 병합

                    try {
                        let res = await this.jl.ajax("get", filter, "/jl/JlApi.php");
                        this.data_array = res.data
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