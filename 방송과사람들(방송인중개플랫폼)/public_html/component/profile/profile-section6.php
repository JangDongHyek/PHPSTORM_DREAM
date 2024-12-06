<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <section id="profile06">
        <div>
            <h4>희망시급</h4>
            <dl>
                <dt>희망시급을 작성해 주세요</dt>
                <dd class="flex">
                    <input type="text" class="text-right" placeholder="" v-model="user.job_hourly" @input="user.job_hourly = jl.formatNumber(user.job_hourly,true)">&nbsp;원
                </dd>
                <dd class="setting">
                    <input type="checkbox" id="btnToggle1" v-model="user.job_hourly_consultation">
                    <label class="control">협의가능</label>
                </dd>
            </dl>
        </div>
    </section>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            user: {type: Object, default: {}}
        },
        data: function(){
            return {
                jl : null,
                filter : {

                },
                data : {
                    job_hourly : "",
                    job_hourly_consultation : false
                },
            };
        },
        created: function(){
            this.jl = new Jl('<?=$componentName?>');
            if(!this.user.job_hourly_consultation) this.user.job_hourly_consultation = false
        },
        mounted: function(){
            this.$nextTick(() => {

            });
        },
        methods: {

        },
        computed: {

        },
        watch : {

        }
    });
</script>

<style>

</style>