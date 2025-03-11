<?php
$componentName = str_replace(".php","",basename(__FILE__));
$pathParts = explode(DIRECTORY_SEPARATOR, dirname(__FILE__));
$context_name = end($pathParts);
?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div v-if="load">
        <div class="gnb_wrap" >
            <ul>
                <li v-for="item1 in rows">
                    <a style="cursor:pointer" :href="jl.root+'/'+item1.url">{{item1.name}}</a>
                    <ul v-if="item1.$category.length > 0">
                        <li v-for="item2 in item1.$category">
                            <a :href="jl.root+'/'+item2.url">{{item2.name}}</a>

                            <ul v-if="item2.$category.length> 0">
                                <li v-for="item3 in item2.$category">
                                    <a :href="jl.root+'/'+item3.url">{{item3.name}}</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
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
                        table : "category",
                        parent_idx : 'jl_null',

                        relations : [
                            {
                                table : "category" ,
                                foreign : "parent_idx",
                                type : "data",
                                filter : {
                                    order_by_asc : "priority",
                                },
                                relations : [
                                    {
                                        table : "category" ,
                                        foreign : "parent_idx",
                                        type : "data",
                                        filter : {
                                            order_by_asc : "priority",
                                        }
                                    }, // type(count,data)
                                ],
                            }, // type(count,data)
                        ],

                        order_by_asc : "priority",
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