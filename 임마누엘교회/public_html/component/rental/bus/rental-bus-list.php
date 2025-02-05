<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div v-if="load">
        <div class="table">
            <table>
                <thead>
                <tr>
                    <th>사용일</th>
                    <th>신청인</th>
                    <th>신청부서</th>
                    <th>차량</th>
                    <th>관리</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="item in arrays">
                    <td>{{item.dates1.formatDate({type : '.'})}}</td>
                    <td>{{item.$g5_member.mb_name}} {{item.$g5_member.mb_1}}</td>
                    <td>{{item.department}}</td>
                    <td>{{item.types}}</td>
                    <td>
                        <button type="button" class="btn btn_mini btn_gray" @click="jl.href('./bus_view?idx=' + item.idx)">보기</button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <item-paging :paging="filter" @change="filter.page = $event; this.jl.getsData(filter,arrays);"></item-paging>
    </div>
</script>

<script>
    Jl_components.push({name : "<?=$componentName?>",object : {
            template: "#<?=$componentName?>-template",
            props: {
                admin : {type: String, default: ""},
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
                        table : "rental_bus",
                        primary : this.primary,
                        page: 1,
                        limit: 1,
                        count: 0,
                        extensions : [
                            {table : "g5_member", foreign : "user_idx"}
                        ],
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

                if(!this.admin) this.filter.status = true;

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