<script type="text/x-template" id="modal-component-template">
    <div class="modal-mask" @click.self="modalClose">
        <div class="modal-wrapper">
            <div class="modal-container">
                <slot></slot>
                <!--<button class="modal-default-button" @click="modalClose">닫기</button>-->
            </div>
        </div>
    </div>
</script>

<script>
    Vue.component('modal-component', {
        template: "#modal-component-template",
        props: {

        },
        data: function(){
            return {

            };
        },
        created: function(){
            this.init();
        },
        mounted: function(){

        },
        methods: {
            modalClose : function() {
                this.$emit("close")
            },
            init : function() {
                var component = this;


                $(document).keydown(function(e){
                    var code = e.keyCode || e.which;

                    if (code == 27) {
                        $(document).off('keydown')
                        component.modalClose();
                    }
                });

                // this.$nextTick(function() {
                //     $('.modal').draggable();
                // });
            }
        },
        computed: {

        }
    });
</script>

<style scoped>
    .modal-mask {
        position: fixed;
        z-index: 9998;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .modal-wrapper {
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .modal-container {
        border-radius: 2px;
        text-align: center;
    }

    .modal-default-button {
        margin-top: 20px;
    }
</style>