<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div>
        <div class="modal fade" :class="class_1" :id="component_idx" tabindex="-1" :aria-hidden="modal">
            <div class="modal-dialog" :class="class_2">
                <div class="modal-content">
                    <div class="modal-header">
                        <slot name="header"></slot>
                    </div>
                    <div class="modal-body">
                        <slot></slot>
                    </div>
                    <div class="modal-footer">
                        <slot name="footer"></slot>
                    </div>
                </div>
            </div>
        </div>
    </div>
</script>

<script>
    Jl_components.push({name : "<?=$componentName?>",object : {
            template: "#<?=$componentName?>-template",
            props: {
                modal : {type : Boolean, default : false},
                class_1 : {type : String, default : ""},
                class_2 : {type : String, default : ""},
            },
            data: function(){
                return {
                    jl : null,
                    component_idx : "",

                };
            },
            created: function(){
                this.jl = new Jl('<?=$componentName?>');
                this.component_idx = this.jl.generateUniqueId();

            },
            mounted: function(){
                $(`#${this.component_idx}`).on('hide.bs.modal', this.hideModal);

                this.$nextTick(() => {

                });
            },
            methods: {
                hideModal() {
                    this.$emit("close");
                }
            },
            computed: {

            },
            watch : {
                modal() {
                    if(this.modal) $(`#${this.component_idx}`).modal('show');
                    else {
                        $(`#${this.component_idx}`).modal('hide');
                    }
                }
            }
        }});
</script>

<style>

</style>