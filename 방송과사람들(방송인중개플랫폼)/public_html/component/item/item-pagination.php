<?php $componentName = str_replace(".php", "", basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div class="paging" v-if="parseInt(count)">
        <div class="pagingWrap">
            <a class="first" @click="setPage(1)">
                <!-- SVG 코드 -->
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M18 6l-1.41-1.41L10.17 12l6.42 7.41L18 18l-6-6z"/>
                    <path d="M6 6l-1.41-1.41L4.59 12l6.42 7.41L6 18l-6-6z"/>
                </svg>
            </a>
            <a class="prev" @click="setPage(page-1)">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M15.41 16.59L10.83 12l4.58-4.59L14 6l-6 6 6 6z"/>
                </svg>
            </a>
            <template v-for="index in getPages()">
                <a @click="setPage(index)" :class="{'active': index == page}">{{ index }}</a>
            </template>
            <a class="next" @click="setPage(page+1)">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M8.59 16.59L13.17 12l-4.58-4.59L10 6l6 6-6 6z"/>
                </svg>
            </a>
            <a class="last" @click="setPage(last)">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M6 6l1.41-1.41L13.83 12l-6.42 7.41L6 18l6-6z"/>
                    <path d="M18 6l1.41-1.41L19.83 12l-6.42 7.41L18 18l6-6z"/>
                </svg>
            </a>
        </div>
    </div>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            filter: { type: Object, default: null },
        },
        data: function () {
            return { jl: null };
        },
        created: function () {
            this.jl = new Jl('<?=$componentName?>');
        },
        methods: {
            getPages: function () {
                var current = this.current, last = this.last, offset = 0, min = current - 2, max = current + 2;

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
            count: function () { return this.filter.count; },
            limit: function () { return this.filter.limit; },
            page: function () { return this.filter.page; },
            current: function () { return parseInt(this.page); },
            last: function () { return Math.ceil(this.count / this.limit); }
        }
    });
</script>

<style>
    .paging {
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 20px 0;
        font-family: Arial, sans-serif;
    }

    .pagingWrap a {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        margin: 0 5px;
        padding: 8px 12px;
        border: 1px solid #ddd;
        border-radius: 4px;
        text-decoration: none;
        color: #333;
        cursor: pointer;
        transition: background-color 0.3s, color 0.3s;
    }

    .pagingWrap a:hover {
        background-color: #007BFF;
        color: #fff;
    }

    .pagingWrap a.active {
        background-color: #007BFF;
        color: #fff;
        border-color: #007BFF;
    }

    .pagingWrap svg {
        width: 16px;
        height: 16px;
        fill: #333;
        transition: fill 0.3s;
    }

    .pagingWrap a:hover svg {
        fill: #fff;
    }
</style>
