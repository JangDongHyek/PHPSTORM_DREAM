<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div v-if="load">

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

            if(this.primary) this.data = await this.jl.getData(this.filter);
            //await this.jl.getsData(this.filter,this.arrays);

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