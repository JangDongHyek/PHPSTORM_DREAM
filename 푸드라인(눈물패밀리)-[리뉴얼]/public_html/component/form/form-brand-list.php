<?php
$componentName = str_replace(".php","",basename(__FILE__));
$pathParts = explode(DIRECTORY_SEPARATOR, dirname(__FILE__));
$context_name = end($pathParts);
?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div v-if="load">
        <div class="tbl_head01 tbl_wrap">
            <table>
                <caption></caption>
                <thead>
                <tr>
                    <th scope="col" rowspan="2" id="mb_list_id">이름/직급</a></th>
                    <th scope="col" rowspan="2" id="mb_list_id">법인명(브랜드명)</a></th>
                    <th scope="col" rowspan="2" id="mb_list_id">연락처</a></th>
                    <th scope="col" rowspan="2" id="mb_list_id">플랫폼 운영 경험</a></th>
                    <th scope="col" rowspan="2" id="mb_list_id">현재 플랫폼 운영 여부</a></th>
                </tr>
                </thead>
                <tbody>
                <template v-for="item in rows">
                    <tr >
                        <td headers="mb_list_id" rowspan="2" class="td_name sv_use">{{item.name}}</td>
                        <td headers="mb_list_id" rowspan="2" class="td_name sv_use">{{item.brand}}</td>
                        <td headers="mb_list_id" rowspan="2" class="td_name sv_use">{{item.phone}}</td>
                        <td headers="mb_list_id" rowspan="2" class="td_name sv_use">{{item.platform}}</td>
                        <td headers="mb_list_id" rowspan="2" class="td_name sv_use">{{item.platform_run}}</td>
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
                    context_name : "<?=$context_name?>",
                    context : null,

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
                        table : "form_brand",
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
                const className = this.context_name.charAt(0).toUpperCase() + this.context_name.slice(1) + "Common";
                if (typeof window[className] !== 'undefined') {
                    this.context = new window[className](this.jl);
                }
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