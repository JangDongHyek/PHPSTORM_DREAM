<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div>
        <div class="modal fade" :class="modal.class_1" :id="component_idx" tabindex="-1" :aria-hidden="modal.status">
            <div class="modal-dialog" :class="modal.class_2">
                <template v-if="modal.load">
                    <div class="modal-content">
                        <div class="modal-header" v-if="$slots.header">
                            <slot name="header"></slot>
                        </div>
                        <div class="modal-body">
                            <slot></slot>
                        </div>
                        <div class="modal-footer" v-if="$slots.footer">
                            <slot name="footer"></slot>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>
</script>

<script>
    Jl_components.push({name : "<?=$componentName?>",object : {
            template: "#<?=$componentName?>-template",
            props: {
                modal: {type: Object, default: {}},
            },
            data: function () {
                return {
                    jl: null,
                    component_idx: "",

                };
            },
            created: function () {
                this.jl = new Jl('<?=$componentName?>');
                this.component_idx = this.jl.generateUniqueId();

            },
            mounted: function () {
                $(`#${this.component_idx}`).on('hide.bs.modal', this.hideModal);

                this.$nextTick(() => {

                });
            },
            methods: {
                hideModal() {
                    this.modal.status = false;
                }
            },
            computed: {},
            watch: {
                "modal.status"(value) {
                    if (value) $(`#${this.component_idx}`).modal('show');
                    else {
                        $(`#${this.component_idx}`).modal('hide');
                    }
                }
            }
        }});
</script>

<style>

</style>