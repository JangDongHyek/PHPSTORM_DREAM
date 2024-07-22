<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div class="row">
        <div class="col-2">
            <div class="form-group">
                <div
                    class="btn-group-vertical buttons"
                    role="group"
                    aria-label="Basic example"
                >
                    <button class="btn btn-secondary" @click="add">Add</button>
                    <button class="btn btn-secondary" @click="replace">Replace</button>
                </div>

                <div class="form-check">
                    <input
                        id="disabled"
                        type="checkbox"
                        v-model="enabled"
                        class="form-check-input"
                    />
                    <label class="form-check-label" for="disabled">DnD enabled</label>
                </div>
            </div>
        </div>

        <div class="col-6">
            <h3>Draggable {{ draggingInfo }}</h3>

            <draggable
                :list="list"
                :disabled="!enabled"
                class="list-group"
                ghost-class="ghost"
                :move="checkMove"
                @start="dragging = true"
                @end="dragging = false"
            >
                <div
                    class="list-group-item"
                    v-for="element in list"
                    :key="element.name"
                >
                    {{ element.name }}
                </div>
            </draggable>
        </div>

    </div>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {

        },
        data: function(){
            return {
                enabled: true,
                list: [
                    { name: "John", id: 0 },
                    { name: "Joao", id: 1 },
                    { name: "Jean", id: 2 }
                ],
                dragging: false
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
            add: function() {
                this.list.push({ name: "Juan " + id, id: id++ });
            },
            replace: function() {
                this.list = [{ name: "Edgard", id: id++ }];
            },
            checkMove: function(e) {
                window.console.log("Future index: " + e.draggedContext.futureIndex);
            }
        },
        computed: {
            draggingInfo() {
                return this.dragging ? "under drag" : "";
            }
        },
        watch : {

        }
    });
</script>

<style>

</style>