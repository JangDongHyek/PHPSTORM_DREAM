<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div>

    </div>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {

        },
        data: function(){
            return {
                filter : {

                },
                data : {

                },
            };
        },
        created: function(){
            console.log("Vue Component : <?=$componentName?> Load")
        },
        mounted: function(){
            this.$nextTick(() => {

            });
        },
        methods: {
            getData: function () {
                var method = "get";
                var filter = JSON.parse(JSON.stringify(this.filter));

                var objs = {
                    _method: method,
                    filter: JSON.stringify(filter)
                };

                var res = ajax("/api/example.php", objs);
                if (res) {
                    console.log(res)
                    this.data = res.response.data
                }
            }
        },
        computed: {

        },
        watch : {

        }
    });
</script>

<style>

</style>