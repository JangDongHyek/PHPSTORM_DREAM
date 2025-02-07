<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div v-if="load">

    </div>
</script>

<script>
    Vue.component('<?=$componentName?>', {
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
                        limit: 1,
                        count: 0,
                    },

                    data: {},

                    load : false,
                };
            },
            async created() {
                this.jl = new Jl('<?=$componentName?>');
                this.component_idx = this.jl.generateUniqueId();

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
            computed: {},
            watch: {}
        });

</script>

<style>

</style>