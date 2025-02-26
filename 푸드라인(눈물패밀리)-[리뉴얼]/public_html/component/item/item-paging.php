<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div class="paging" v-if="parseInt(count)">
        <div class="pagingWrap">
            <a class="first" @click="setPage(1)" :class="{'disabled': page === 1}">
                <i class="fa-light fa-chevrons-left"></i>
            </a>
            <a class="prev" @click="setPage(page - 1)" :class="{'disabled': page === 1}">
                <i class="fa-light fa-chevron-left"></i>
            </a>
            <template v-for="index in getPages()">
                <a @click="setPage(index)" :class="{'active': index === page}">{{ index }}</a>
            </template>
            <a class="next" @click="setPage(page + 1)" :class="{'disabled': page === last}">
                <i class="fa-light fa-chevron-right"></i>
            </a>
            <a class="last" @click="setPage(last)" :class="{'disabled': page === last}">
                <i class="fa-light fa-chevrons-right"></i>
            </a>
        </div>
    </div>


</script>

<script>
    Jl_components.push({name : "<?=$componentName?>",object : {
            template: "#<?=$componentName?>-template",
            props: {
                filter: {type: Object, default: null},
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
                    this.filter.page = page;
                    this.$emit("change", page);
                }
            },
            computed: {
                count: function () {
                    return this.filter.count
                },
                limit: function () {
                    return this.filter.limit
                },
                page: function () {
                    return this.filter.page
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
    .paging {
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 20px 0;
    }

    .pagingWrap {
        display: flex;
        gap: 5px;
        padding: 10px;
        background: #f8f8f8;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .pagingWrap a {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 35px;
        height: 35px;
        font-size: 16px;
        font-weight: bold;
        text-decoration: none;
        color: #007bff;
        border-radius: 5px;
        transition: background 0.2s ease, color 0.2s ease;
        cursor: pointer;
    }

    .pagingWrap a:hover {
        background: #007bff;
        color: white;
    }

    .pagingWrap a.active {
        background: #007bff;
        color: white;
        font-weight: bold;
        pointer-events: none;
    }

    .pagingWrap a.disabled {
        color: #aaa;
        pointer-events: none;
        cursor: default;
    }

    /* 반응형 스타일 */
    @media (max-width: 480px) {
        .pagingWrap a {
            width: 30px;
            height: 30px;
            font-size: 14px;
        }
    }

</style>