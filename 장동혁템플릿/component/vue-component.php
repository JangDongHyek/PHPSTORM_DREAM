<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div>
        <input type="file" @change="jl.changeFile($event,data,'upfile')">
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
            this.jl = new JL('<?=$componentName?>');
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
                var res = this.jl.ajax("get",this.data,"/api/example.php");

                if(res) {
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