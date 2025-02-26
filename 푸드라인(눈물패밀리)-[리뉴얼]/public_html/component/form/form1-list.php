<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div v-if="load">
        <div class="tbl_head01 tbl_wrap">
            <table>
                <caption></caption>
                <thead>
                <tr>
                    <th scope="col" rowspan="2" id="mb_list_id">매장명</a></th>
                    <th scope="col" rowspan="2" id="mb_list_id">사업자번호</a></th>
                    <th scope="col" rowspan="2" id="mb_list_id">매장위치</a></th>
                    <th scope="col" rowspan="2" id="mb_list_id">이름</a></th>
                    <th scope="col" rowspan="2" id="mb_list_id">휴대폰번호</a></th>
                    <th scope="col" rowspan="2" id="mb_list_id">이메일</a></th>
                </tr>
                </thead>
                <tbody>
                <template v-for="item in rows">
                    <tr >
                        <td headers="mb_list_id" rowspan="2" class="td_name sv_use">{{item.subject}}</td>
                        <td headers="mb_list_id" rowspan="2" class="td_name sv_use">{{item.company_number}}</td>
                        <td headers="mb_list_id" rowspan="2" class="td_name sv_use">{{item.company_address}}</td>
                        <td headers="mb_list_id" rowspan="2" class="td_name sv_use">{{item.name}}</td>
                        <td headers="mb_list_id" rowspan="2" class="td_name sv_use">{{item.phone}}</td>
                        <td headers="mb_list_id" rowspan="2" class="td_name sv_use">{{item.email}}</td>
                    </tr>
                    <tr></tr>
                </template>

                </tbody>
            </table>
        </div>

        <item-paging :filter="filter" @change="jl.getsData(filter,rows);"></item-paging>
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

                    row: {},
                    rows : [],

                    options : {
                        table : "",
                        file_use : false,
                        required : [
                            {name : "",message : ``},
                        ],
                        href : "",
                    },

                    filter : {
                        table : "form_1",
                        page: 1,
                        limit: 10,
                        count: 0,
                    },

                    modal : {
                        status : false,
                        load : false,
                        data : {},
                        class_1 : "",
                        class_2 : "",
                    },

                };
            },
            async created() {
                this.jl = new Jl('<?=$componentName?>');
                this.component_idx = this.jl.generateUniqueId();
            },
            async mounted() {
                //if(this.primary) this.row = await this.jl.getData(this.filter);
                await this.jl.getsData(this.filter,this.rows);

                this.load = true;

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
                async "modal.status"(value,old_value) {
                    if(value) {
                        this.modal.load = true;
                    }else {
                        this.modal.load = false;
                        this.modal.data = {};
                    }
                }
            }
        }});

</script>

<style>

</style>