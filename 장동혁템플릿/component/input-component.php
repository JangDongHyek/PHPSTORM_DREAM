<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div>
        <item-bs-modal :modal="modal" @close="$emit('close')">
            <template v-slot:header>

            </template>

            <!-- body -->
            <template v-slot:default>

            </template>


            <template v-slot:footer>

            </template>
        </item-bs-modal>
    </div>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            modal : {type : Boolean, default : false},
            primary : {type : String, default : ""},
        },
        data: function(){
            return {
                jl : null,
                component_idx : "",

                paging : {
                    page : 1,
                    limit : 1,
                    count : 0,
                }
            };
        },
        async created(){
            this.jl = new Jl('<?=$componentName?>');
            this.component_idx = this.jl.generateUniqueId();
        },
        mounted: function(){
            this.$nextTick(() => {

            });
        },
        updated : function() {

        },
        methods: {
            async postData() {
                let method = this.primary ? "update" : "insert";
                let data = {
                    table : "",
                }
                try {
                    let res = await this.jl.ajax(method,data,"/jl/JlApi.php");
                }catch (e) {
                    alert(e.message)
                }

            },
            async getData() {
                let filter = {
                    table : "order",
                }
                try {
                    let res = await this.jl.ajax("get",filter,"/jl/JlApi.php");
                    this.data = res.data[0]
                }catch (e) {
                    alert(e.message)
                }
            }
        },
        computed: {

        },
        watch : {
            modal() {
                if(this.modal) {
                    console.log(this.primary)
                }
            }
        }
    });
</script>

<style>

</style>