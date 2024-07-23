<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div>
        <draggabble v-model="data" group="group" @start="onStart" @end="onEnd" @change="onChange" :move="onMove">
            <div>
                <li v-for="item,index in data" :key="index">1</li>
            </div>
        </draggabble>
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
            onMove : function(e) {
                console.log(e)
            },
            onChange : function(e) {
                console.log(e);
            },
            onStart : function() {

            },
            onEnd : function() {

            },
        },
        computed: {

        },
        watch : {

        }
    });
</script>

<style>

</style>