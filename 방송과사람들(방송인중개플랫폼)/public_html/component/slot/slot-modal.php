<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div id="basic_modal">
        <div class="modal fade" :class="{'in' : modal}" tabindex="-1" :style="{display : modal ? 'block' : 'none'}" @click.self="$emit('close')">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="$emit('close')"><i class="fa-light fa-xmark"></i></button>
                        <h4 class="modal-title" id="myModalLabel">{{ title }}</h4>
                    </div>
                    <div class="modal-body">
                        <slot></slot>
                    </div>
                    <div class="modal-footer" v-if="footer">
                        <button v-if="confirm" type="button" class="btn btn-default" data-dismiss="modal" @click="$emit('onEvent')">확인</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal" @click="$emit('close')">닫기</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            modal : {type : Boolean, default : false},
            title : {type : String, default : ""},
            confirm : {type : Boolean, default : false},
            footer : {type : Boolean, default : true},
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