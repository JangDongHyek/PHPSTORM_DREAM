<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div class="container" v-if="parseInt(count)">
        <div class="pagination">
            <a @click="setPage(1)">&laquo;</a>
            <template v-for="index in getPages()">
            <a @click="setPage(index)" :class="{'active' : index == page}">{{index}}</a>
            </template>
            <a @click="setPage(last)">&raquo;</a>
        </div>
    </div>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            count: { type: Number, default: 0 },
            limit: { type: Number, default: 20 },
            page:  { type: Number, default: 1 },
        },
        data: function(){
            return {
                jl : null,
            };
        },
        created: function(){
            this.jl = new Jl('<?=$componentName?>');
        },
        mounted: function(){

        },
        methods: {
            getPages: function(){
                var current = this.current;
                var last = this.last;
                var offset = 0;
                var min = current - 2;
                var max = current + 2;

                if(min < 1) offset = 1 - min;
                if(max > last) offset = last - max;

                var pages = [];
                for(var i = min + offset; i <= max + offset; i++){
                    if(1 <= i && i <= last) pages.push(i);
                }
                return pages;
            },
            setPage: function(page){
                if(page < 1) page = 1;
                else if(page > this.last) page = this.last;

                this.page = page;
                this.$emit("change", page);
            }
        },
        computed: {
            current: function(){
                return parseInt(this.page);
            },
            last: function(){
                return Math.ceil(this.count/this.limit);
            }
        }
    });
</script>

<style>
    .container {
        text-align: center; /* 텍스트 가운데 정렬 */
    }

    .pagination {
        display: inline-block;
    }

    .pagination a {
        color: black;
        float: left;
        padding: 8px 16px;
        text-decoration: none;
        transition: background-color .3s;
        border: 1px solid #ddd;
        margin: 0 4px;
    }

    .pagination a.active {
        background-color: #4CAF50;
        color: white;
        border: 1px solid #4CAF50;
    }

    .pagination a:hover:not(.active) {
        background-color: #ddd;
    }
</style>