<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div>
        <div class="table">
            <table>
                <thead>
                <tr>
                    <th>날짜</th>
                    <th>기도요청자</th>
                    <th>기도제목</th>
                    <th>구분</th>
                    <th>응답</th>
                </tr>
                </thead>
                <tbody>
                <tr @click="jl.href('./pray_view.php?idx='+prayer.idx)" v-for="prayer in prayers">
                    <td>{{prayer.insert_date.split(' ')[0]}}</td>
                    <td>{{prayer.name}} {{prayer.job}}</td>
                    <td><p class="cut">{{prayer.content}}</p></td>
                    <td>{{prayer.emergency}}</td>
                    <td>{{prayer.status}}</td>
                </tr>
                </tbody>
            </table>
        </div>

        <item-paging :paging="paging" @change="paging.page = $event; getPrayers();"></item-paging>
    </div>
</script>

<script>
    Jl_components.push({name : "<?=$componentName?>",object : {
            template: "#<?=$componentName?>-template",
            props: {
                primary: {type: String, default: ""}
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

                    prayers : [],
                };
            },
            async created() {
                this.jl = new Jl('<?=$componentName?>');
                this.component_idx = this.jl.generateUniqueId();

                await this.getPrayers();
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

                    if (this.data) data = Object.assign(data, this.data); // paging 객체가있다면 병합

                    try {
                        let res = await this.jl.ajax(method, data, "/jl/JlApi.php");
                    } catch (e) {
                        alert(e.message)
                    }

                },
                async getPrayers() {
                    let filter = {
                        table: "prayer",
                    }

                    if (this.paging) filter = Object.assign(filter, this.paging); // paging 객체가있다면 병합

                    try {
                        let res = await this.jl.ajax("get", filter, "/jl/JlApi.php");
                        this.prayers = res.data
                        this.paging.count = res.count;
                    } catch (e) {
                        alert(e.message)
                    }
                }
            },
            computed: {},
            watch: {}
        }});

</script>

<style>

</style>