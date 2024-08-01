<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div class="pagination_wrap" v-if="parseInt(total)">
        <a href="" class="page-prev" @click="event.preventDefault(); setPage(page-1)"><i class="fa-regular fa-angle-left"></i></a>
        <div class="page-now">{{page}} / {{last}}</div>
        <a href="" class="page-next" @click="event.preventDefault(); setPage(page+1)"><i class="fa-regular fa-angle-right"></i></a>
    </div>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            total: { type: Number, default: 0 },
            limit: { type: Number, default: 20 },
            page:  { type: Number, default: 1 },
        },
        data: function(){
            return {

            };
        },
        created: function(){
            console.log(this.total);
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
                if(page < 1) return false;
                else if(page > this.last) return false;

                this.page = page;
                this.$emit("change", page);
            }
        },
        computed: {
            current: function(){
                return parseInt(this.page);
            },
            last: function(){
                return Math.ceil(this.total/this.limit);
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