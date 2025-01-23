<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div>

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
                data_array : [],

                filter : {
                    table : "",
                    page: 1,
                    limit: 1,
                    count: 0,
                },

                rend : false,
            };
        },
        async created() {
            this.jl = new Jl('<?=$componentName?>');
            this.component_idx = this.jl.generateUniqueId();

            if(this.primary) this.data = await this.jl.getData(this.filter);

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