<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div id="nav_area" v-if="category_idx">
        <nav id="gnb">
            <h2>메인메뉴</h2>
            <ul id="gnb_1dul">
                <li class="gnb_1dli all_menu">
                    <a href="#" class="gnb_1da"><i class="fa-light fa-bars"></i> 전체메뉴</a>
                    <ul class="gnb_2dul">
                        <li class="gnb_2dli" v-for="item in data" v-if="item.parent_idx == 0">
                            <a :href="`${Jl_base_url}/bbs/item_list.php?ctg=${item.idx}`" class="gnb_2da" @mouseover="over_idx = item.idx">{{item.name}}</a>
                            <div class="gnb_2dli_list" style="display: none">
                                <ul class="gnb_2dul ver02" style="display: none">
                                    <li class="gnb_2dli" v-for="child in item.childs"><a :href="`${Jl_base_url}/bbs/item_list.php?ctg=${child.idx}&category_idx=${item.idx}`" class="gnb_2da">{{child.name}}</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
            <div class="menu-container">
                <div class="menu-wrapper">
                <ul id="gnb_1dul" class="menu">
                    <li class="gnb_1dli single_menu">
                        <a :href="`${jl.root}/bbs/item_list.php?ctg=${category_idx}`" class="gnb_1da">전체<span></span></a>
                    </li>
                    <li class="gnb_1dli single_menu" v-for="item in categories" v-if="item.parent_idx == category_idx">
                        <a :href="`${Jl_base_url}/bbs/item_list.php?ctg=${item.idx}&category_idx=${item.parent_idx}`" class="gnb_1da">
                            {{item.name}}<span></span>
                        </a>
                        <!-- Uncomment and adjust if you want to include child items -->
                        <!-- <div class="gnb_2dli_list">
                            <ul class="gnb_2dul ver02">
                                <li class="gnb_2dli" v-for="child in item.childs">
                                    <a :href="JL_base_url+'/bbs/item_list.php?ctg=' + child.idx" class="gnb_2da">{{child.name}}</a>
                                </li>
                            </ul>
                        </div> -->
                    </li>
                </ul>
                </div>
                <!--<button class="scroll-button left-button"><i class="fa-light fa-angle-left"></i></button>
                <button class="scroll-button right-button"><i class="fa-light fa-angle-right"></i></button>-->
            </div>
        </nav>
    </div>
</script>

<script>
    //상단 메뉴 슬라이드
        document.addEventListener('DOMContentLoaded', function() {

    });

</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            category_idx : {type : String, default : ""}
        },
        data: function(){
            return {
                jl : null,
                filter : {
                    parent_idx : ""
                },
                data : {},
                categories : [],
                over_idx : "",
            };
        },
        created: function(){
            this.jl = new Jl('<?=$componentName?>');
            this.getData();
            this.getCategory()
        },
        mounted: function(){
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
                    $('ul.gnb_2dul', this).css('display','block');
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
            });
        },
        methods: {
            async getCategory() {
                var filter = {
                    parent_idx : this.category_idx
                }
                var objs = {
                    _method: "get",
                    filter: JSON.stringify(filter)
                };

                var res = await this.jl.ajax("get",filter,"/api/category.php");

                if(res) {
                    this.jl.log(res,arguments.callee.name)
                    this.categories = res.response.data

                }
            },
            async getData() {
                var method = "get";
                var filter = JSON.parse(JSON.stringify(this.filter));

                var objs = {
                    _method: method,
                    filter: JSON.stringify(filter)
                };

                var res = await this.jl.ajax(method,filter,"/api/category.php");
                if (res) {
                    this.jl.log(res,arguments.callee.name)
                    this.data = res.response.data
                }
            }
        },
        computed: {

        },
        watch : {

        }
    });
</script>