<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div>
        1122
    </div>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            primary : {type : String, default : ""}
        },
        data: function(){
            return {
                jl : null,
                filter : {

                },
                data : {

                },
            };
        },
        created: function(){
            this.jl = new Jl('<?=$componentName?>');

            if(this.primary) this.getData();
        },
        mounted: function(){
            this.$nextTick(() => {

            });
        },
        methods: {
            postData : function() {
                var method = this.primary ? "update" : "insert";
                var res = this.jl.ajax(method,this.data,"/api/example.php");

                if(res) {

                }
            },
            getData: function () {
                var filter = {primary: this.primary}
                var res = this.jl.ajax("get",filter,"/api/example.php");

                if(res) {
                    this.data = res.data[0]
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