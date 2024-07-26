<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div>
        <input type="file" @change="updateFile">
    </div>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {

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
                var obj = this.jl.copyObject();

                var objs = {_method: method};
                objs = this.jl.processObject(objs,obj);

                var res = ajax("/api/example.php", objs);

                if (res) {
                    console.log(res)
                }
            },
            updateFile : function() {
                const file = event.target.files[0];
                if (file) {
                    this.data.file = file;
                } else {
                    this.data.file = '';
                }
            },
            getData: function () {
                var method = "get";
                var filter = this.jl.copyObject(this.filter);

                var objs = {_method: method};
                objs = this.jl.processObject(objs,obj);

                var res = ajax("/api/example.php", objs);
                if (res) {
                    this.jl.log(res)
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