<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div v-if="load">

    </div>
</script>

<script>
    Vue.component('<?=$componentName?>', {
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
                    required : [
                        {name : "",message : ``},
                    ],
                    href : "",
                },

                filter : {
                    table : "",
                    primary : this.primary,
                    page: 1,
                    limit: 1,
                    count: 0,
                },

                modal : {
                    status : false,
                    data : {},
                },

                load : false,
            };
        },
        async created() {
            this.jl = new Jl('<?=$componentName?>');
            this.component_idx = this.jl.generateUniqueId();

            if(this.primary) this.row = await this.jl.getData(this.filter);
//await this.jl.getsData(this.filter,this.rows);

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
    });

</script>

<style>

</style>