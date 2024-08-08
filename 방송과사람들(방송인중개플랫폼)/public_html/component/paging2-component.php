<script type="text/x-template" id="paging2-component-template">
    <div id="paging" v-if="parseInt(total)">
        <a href="" @click="event.preventDefault(); setPage(1)" class="pg_page pg_start">처음</a>
        <a href="" @click="event.preventDefault(); setPage(current-5)" class="pg_page pg_prev">이전</a>
        <template v-for="index in getPages()">
            <span v-if="index == page" class="current">{{ index }}<span class="sound_only">페이지</span></span>
            <a v-else href="" @click="event.preventDefault(); $emit('change',index);" class="pg_page">{{ index }}<span class="sound_only">페이지</span></a>
        </template>
        <a href="" @click="event.preventDefault(); setPage(current+5)" class="pg_page pg_next">다음</a>
        <a href="" @click="event.preventDefault(); setPage(last)" class="pg_page pg_end">맨끝</a>
    </div>
</script>

<script>
    Vue.component('paging2-component', {
        template: "#paging2-component-template",
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