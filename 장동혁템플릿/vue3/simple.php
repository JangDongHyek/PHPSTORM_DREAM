<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">

</script>

<script>
    Jl_components.push({name : "<?=$componentName?>",object : {
        template: "#<?=$componentName?>-template",
        props: {
            primary: {type: String, default: ""},
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
            };
        },
        async created() {
            this.jl = new Jl('<?=$componentName?>');
            this.component_idx = this.jl.generateUniqueId();
        },
        mounted() {
            this.$nextTick(() => {

            });
        },
        updated() {

        },
        methods: {
            async postData() {
                let method = this.primary ? "update" : "insert";
                let data = {
                    table: "",
                }

                // object의 필수값을 설정하는 option
                let required = [
                    {name : "",message : ""},
                ]
                let options = {required : required};

                if (this.data) data = Object.assign(data, this.data); // paging 객체가있다면 병합

                try {
                    let res = await this.jl.ajax(method, data, "/jl/JlApi.php",options);
                } catch (e) {
                    await this.jl.alert(e.message)
                }

            },
            async getData() {
                let filter = {
                    table: "user",
                }

                if (this.paging) filter = Object.assign(filter, this.paging); // paging 객체가있다면 병합

                try {
                    let res = await this.jl.ajax("get", filter, "/jl/JlApi.php");
                    this.data = res.data[0]
                    this.paging.count = res.count;
                } catch (e) {
                    await this.jl.alert(e.message)
                }
            }
        },
        computed: {},
        watch: {}
    }});

</script>

<style>

</style>