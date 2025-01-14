<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div class="b-pagination-outer" v-if="parseInt(count)">
        <ul id="border-pagination">
            <li @click="setPage(1)"><a>«</a></li>
            <li @click="setPage(page-1)"><a>‹</a></li>

            <template v-for="index in getPages()">
                <li @click="setPage(index)"><a :class="{'active' : index == page}">{{index}}</a></li>

            </template>
            <li @click="setPage(page+1)"><a>›</a></li>
            <li @click="setPage(last)"><a>»</a></li>

        </ul>
    </div>
</script>

<script>
    Jl_components.push({name : "<?=$componentName?>",object : {
            template: "#<?=$componentName?>-template",
            props: {
                paging: {type: Object, default: null},
            },
            data: function () {
                return {
                    jl: null,
                };
            },
            created: function () {
                this.jl = new Jl('<?=$componentName?>');
            },
            mounted: function () {

            },
            methods: {
                getPages: function () {
                    var current = this.current;
                    var last = this.last;
                    var offset = 0;
                    var min = current - 2;
                    var max = current + 2;

                    if (min < 1) offset = 1 - min;
                    if (max > last) offset = last - max;

                    var pages = [];
                    for (var i = min + offset; i <= max + offset; i++) {
                        if (1 <= i && i <= last) pages.push(i);
                    }
                    return pages;
                },
                setPage: function (page) {
                    if (page < 1) page = 1;
                    else if (page > this.last) page = this.last;

                    this.page = page;
                    this.$emit("change", page);
                }
            },
            computed: {
                count: function () {
                    return this.paging.count
                },
                limit: function () {
                    return this.paging.limit
                },
                page: function () {
                    return this.paging.page
                },
                current: function () {
                    return parseInt(this.page);
                },
                last: function () {
                    return Math.ceil(this.count / this.limit);
                }
            }
        }});
</script>

<style>

</style>