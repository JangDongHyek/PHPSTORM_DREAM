<?php
$componentName = str_replace(".php","",basename(__FILE__));
$pathParts = explode(DIRECTORY_SEPARATOR, dirname(__FILE__));
$context_name = end($pathParts);
?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div v-if="load">
        <div class="sub-nav">
            <div class="cinner">
                <ul class="sub-1ul">
                    <li class="sub-1li home"><a href="/" class="sub-1item" title="홈으로 이동">홈</a></li>
                    <li class="sub-1li" id="nav1" v-if="row.$parent.$parent">
                        <a href="javascript:void(0);" class="sub-1item" title="페이지 이동">{{row.$parent.$parent.name}}</a>
                        <ul class="sub-2ul">
                            <li class="sub-2li" v-for="item in row.$parent.$parent.$category">
                                <a :href="jl.root + '/' + item.url" class="sub-2item" :title="item.name">{{item.name}}</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sub-1li" id="nav2" v-if="row.$parent">
                        <a href="javascript:void(0);" class="sub-1item" title="페이지 이동">{{row.$parent.name}}</a>
                        <ul class="sub-2ul">
                            <li class="sub-2li" v-for="item in row.$parent.$category">
                                <a :href="jl.root + '/' + item.url" class="sub-2item" :title="item.name">{{item.name}}</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sub-1li" id="nav3" v-if="row.primary">
                        <a href="javascript:void(0);" class="sub-1item" title="페이지 이동">{{row.name}}</a>
                    </li>
                </ul>
            </div>
        </div><!--//sub-nav-->
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
                        url : "",
                        extensions : [
                            {
                                table : "category",
                                foreign : "parent_idx",
                                as : "parent",
                                relations : [
                                    {
                                        table : "category" ,
                                        foreign : "parent_idx",
                                        type : "data", // type(count,data)
                                        filter : {
                                            order_by_asc : "priority"
                                        },
                                    },
                                ],
                                extensions : [
                                    {
                                        table : "category",
                                        foreign : "parent_idx",
                                        as : "parent",
                                        relations : [
                                            {
                                                table : "category" ,
                                                foreign : "parent_idx",
                                                type : "data", // type(count,data)
                                                filter : {
                                                    order_by_asc : "priority"
                                                },
                                            },
                                        ],
                                    }, // as값이있다면 $테이블명이아닌 $as값으로 가져온다
                                ],
                            }, // as값이있다면 $테이블명이아닌 $as값으로 가져온다
                        ],
                    },

                    modal : {
                        status : false,
                        load : false,
                        data : {},
                        class_1 : "",
                        class_2 : "",
                    },

                    url : "",

                };
            },
            async created() {
                this.jl = new Jl('<?=$componentName?>');
                this.component_idx = this.jl.generateUniqueId();
                const className = this.context_name.charAt(0).toUpperCase() + this.context_name.slice(1) + "Common";
                if (typeof window[className] !== 'undefined') {
                    this.context = new window[className](this.jl);
                }

                const url = new URL(window.location.href);
                this.filter.url = url.pathname.replace("/~hankukjiban_re/", "") + url.search;
            },
            async mounted() {
                if(this.filter.url) this.row = await this.jl.getData(this.filter);
                //await this.jl.getsData(this.filter,this.rows);

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