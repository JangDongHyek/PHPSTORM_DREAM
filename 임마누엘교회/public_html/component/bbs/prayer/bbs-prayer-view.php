<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div v-if="prayer.idx">
        <p><b class="icon icon_gray">{{prayer.status}}</b> <b class="txt_color">{{prayer.emergency}}</b></p>
        <h6>{{prayer.name}} {{prayer.job}}</h6>
        <p>요청기간 | {{prayer.insert_date.split(' ')[0]}} - {{prayer.request_date}} </p>
        <hr>
        <p><b class="icon icon_gray">{{prayer.types2 ? prayer.types2 : prayer.types }}</b> {{prayer.content}}</p>
    </div>

</script>

<script>
    Jl_components.push({name : "<?=$componentName?>",object : {
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

                    prayer: {},
                };
            },
            async created() {
                this.jl = new Jl('<?=$componentName?>');
                this.component_idx = this.jl.generateUniqueId();

                if(this.primary) await this.getPrayer();
            },
            mounted() {
                this.$nextTick(() => {

                });
            },
            updated() {

            },
            methods: {
                async getPrayer() {
                    let filter = {
                        table: "prayer",
                        primary : this.primary
                    }

                    if (this.paging) filter = Object.assign(filter, this.paging); // paging 객체가있다면 병합

                    try {
                        let res = await this.jl.ajax("get", filter, "/jl/JlApi.php");
                        this.prayer = res.data[0]
                        this.paging.count = res.count;
                    } catch (e) {
                        alert(e.message)
                    }
                }
            },
            computed: {},
            watch: {}
        }});

</script>

<style>

</style>