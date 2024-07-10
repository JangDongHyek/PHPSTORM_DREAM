<script type="text/x-template" id="page-component-template">
    <nav class="pg_wrap" v-if="parseInt(total)">
        <span class="pg">
            <a class="pg_page pg_start" @click="setPage(1)">처음</a>
            <!-- <a class="pg_page pg_prev">이전</a> -->
            <template v-for="index in getPages()">
                <strong v-if="current == index" class="pg_current">{{index}}</strong>
                <a v-else @click="setPage(index)" class="pg_page">{{index}}</a>

            </template>
            <!-- <a class="pg_page pg_next">다음</a> -->
                <a class="pg_page pg_end" @click="setPage(last)">맨끝</a>
        </span>
    </nav>
</script>

<script>
    Vue.component('page-component', {
        template: "#page-component-template",
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