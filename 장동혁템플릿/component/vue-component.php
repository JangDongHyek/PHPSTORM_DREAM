<script type="text/x-template" id="vue-component-template">
    <div>

    </div>
</script>

<script>
    Vue.component('vue-component', {
        template: "#vue-component-template",
        props: {

        },
        data: function(){
            return {
                filter : {},
                data : {},
            };
        },
        created: function(){

        },
        mounted: function(){

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
                    this.data = res.response.data[0]
                }
            }
        },
        computed: {

        },
        watch : {

        }
    });
</script>