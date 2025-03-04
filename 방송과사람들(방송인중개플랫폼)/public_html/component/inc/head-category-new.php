<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div v-if="load">
        <div id="nav_area">
            <nav id="gnb">
                <h2>메인메뉴</h2>
                <ul id="gnb_1dul">
                    <li class="gnb_1dli all_menu">
                        <a class="gnb_1da">
                            <i class="fa-light fa-bars"></i> 전체메뉴
                        </a>
                        <ul class="gnb_2dul">
                            <li class="gnb_2dli" v-for="item in rows">
                                <a class="gnb_2da" :href="`?category1_idx=${item.idx}`">{{item.name}}</a>
                                <div class="gnb_2dli_list" style="display: none;">
                                    <ul class="gnb_2dul ver02" style="display: none;">
                                        <li class="gnb_2dli" v-for="child in item.$category"><a class="gnb_2da">{{child.name}}</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
                <span class="main-category">{{category1.name}}</span>
                <div class="menu-container">
                    <div id="target_scroll" class="menu-wrapper">
                        <ul id="gnb_1dul" class="menu">
                            <li class="gnb_1dli single_menu">
                                <a class="gnb_1da" :href="`?category1_idx=${category1.idx}`">전체<span></span></a>
                            </li>

                            <li v-for="item in category1.$category" class="gnb_1dli single_menu" :class="{'active' : category2_idx == item.idx}">
                                <a class="gnb_1da" :href="`?category1_idx=${category1.idx}&category2_idx=${item.idx}`">{{item.name}}<span></span></a>
                            </li>
                        </ul>
                    </div>
                    <button class="scroll-button left-button" :class="{'end' : scroll_position == 0}" @click="moveScroll(-100)"><i class="fa-light fa-angle-left"></i></button> <!-- todo: 양쪽 끝까지 갔을때 end 클래스 추가-->
                    <button class="scroll-button right-button" :class="{'end' : scroll_end}" @click="moveScroll(100)"><i class="fa-light fa-angle-right"></i></button>
                </div>
            </nav>
        </div>
    </div>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            category1_idx : {type: String, default: ""},
            category2_idx : {type: String, default: ""},
            primary : {type: String, default: ""},
        },
        data: function () {
            return {
                load : false,
                jl: null,
                component_idx: "",

                row: {},
                rows : [],

                options : {
                    table : "",
                    file_use : false,
                    required : [
                        {name : "",message : ``},
                    ],
                    href : "",
                },

                filter : {
                    table : "category",
                    parent_idx : 0,

                    order_by_asc : "priority",

                    relations : [
                        {
                            table : "category" ,
                            foreign : "parent_idx",
                            type : "data",
                            filter : {

                            },
                        }, // type(count,data)
                    ],
                },

                scroll_position : 0,
                scroll_end : false,

                modal : {
                    status : false,
                    load : false,
                    data : {},
                    class_1 : "",
                    class_2 : "",
                },

            };
        },
        async created() {
            this.jl = new Jl('<?=$componentName?>');
            this.component_idx = this.jl.generateUniqueId();
        },
        async mounted() {
            //if(this.primary) this.row = await this.jl.getData(this.filter);
            await this.jl.getsData(this.filter,this.rows);

            this.load = true;

            this.$nextTick(() => {
                $('.gnb_1dli.all_menu').hover(function() {
                    //$('ul.gnb_2dul', this).fadeIn(400);
                    $('ul.gnb_2dul', this).fadeIn(0);
                    $('ul.gnb_2dul', this).css('display','block');
                    $(this).children('a:first').addClass("hov");
                }, function() {
                    //$('ul.gnb_2dul', this).fadeOut(400);
                    $('ul.gnb_2dul', this).fadeOut(0);
                    $('ul.gnb_2dul', this).css('display','none');
                    $(this).children('a:first').removeClass("hov");
                });

                $('.gnb_1dli.all_menu > .gnb_2dul > .gnb_2dli').hover(function() {
                    $(this).children('.gnb_2dli_list').css('display','block');
                }, function() {
                    $('.gnb_2dli_list').css('display','none');
                });

                $('#gnb .gnb_1dli.all_menu').hover(function() {
                    $('ul.gnb_2dul', this).slideDown(200);
                    $('ul.gnb_2dul', this).css('display','grid');
                    //$(this).children('a:first').addClass("hov");
                }, function() {
                    $('ul.gnb_2dul', this).slideUp(200);
                    $('ul.gnb_2dul', this).css('display','none');
                    //$(this).children('a:first').removeClass("hov");
                });

                const menuWrapper = document.querySelector('.menu-wrapper');
                let isDragging = false;
                let startX;
                let scrollLeft;

                if (menuWrapper){
                    menuWrapper.addEventListener('mousedown', (e) => {
                        isDragging = true;
                        startX = e.pageX - menuWrapper.offsetLeft;
                        scrollLeft = menuWrapper.scrollLeft;
                        menuWrapper.style.cursor = 'grabbing';
                    });

                    menuWrapper.addEventListener('mouseleave', () => {
                        isDragging = false;
                        menuWrapper.style.cursor = 'grab';
                    });

                    menuWrapper.addEventListener('mouseup', () => {
                        isDragging = false;
                        menuWrapper.style.cursor = 'grab';
                    });

                    menuWrapper.addEventListener('mousemove', (e) => {
                        if (!isDragging) return;
                        e.preventDefault();
                        const x = e.pageX - menuWrapper.offsetLeft;
                        const walk = (x - startX) * 3; // 스크롤 속도 조절
                        menuWrapper.scrollLeft = scrollLeft - walk;
                    });

                    // 마우스 휠 이벤트 추가
                    menuWrapper.addEventListener('wheel', (e) => {
                        e.preventDefault();
                        menuWrapper.scrollLeft += e.deltaY;
                    });
                }
            });

            this.scrollableDiv = document.getElementById('target_scroll');
        },
        updated() {

        },
        methods: {
            moveScroll(offset) {
                const scrollableDiv = document.getElementById('target_scroll');
                const scrollWidth = scrollableDiv.scrollWidth; // 전체 스크롤 길이
                const clientWidth = scrollableDiv.clientWidth;
                let scrollSize = scrollWidth - clientWidth;

                scrollableDiv.scrollBy({ left: offset, behavior: 'smooth' });

                this.scroll_position = this.scroll_position + offset;

                if(this.scroll_position < 0) this.scroll_position = 0;

                console.log(scrollWidth)
                console.log(this.scroll_position)
                console.log(clientWidth);
                if(this.scroll_position >= scrollSize) {
                    this.scroll_position = scrollSize;
                    this.scroll_end = true;
                }
                else this.scroll_end = false;
            },
        },
        computed: {
            category1() {
                if(this.rows.length) return this.jl.findObject(this.rows,"idx",this.category1_idx);
                return {};
            }
        },
        watch: {
            async "modal.status"(value,old_value) {
                if(value) {
                    this.modal.load = true;
                }else {
                    this.modal.load = false;
                    this.modal.data = {};
                }
            }
        }
    });

</script>

<style>

</style>