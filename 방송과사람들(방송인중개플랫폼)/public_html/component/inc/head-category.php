<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div id="nav_area">
        <nav id="gnb">
            <h2>메인메뉴</h2>
            <ul id="gnb_1dul">
                <li class="gnb_1dli all_menu">
                    <a href="#Link" class="gnb_1da"><i class="fa-light fa-bars"></i> 전체메뉴</a>
                    <ul class="gnb_2dul">
                        <li class="gnb_2dli" v-for="item in data">
                            <a href="" class="gnb_2da">{{item.name}}</a>
                            <div class="gnb_2dli_list" style="display:none">
                                <ul class="gnb_2dul ver02" style="display:none">
                                    <li class="gnb_2dli" v-for="child in item.childs"><a href="" class="gnb_2da">{{child.name}}</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </li>

                <li class="gnb_1dli" v-for="item in data">
                    <a href="" class="gnb_1da">{{item.name}}<span></span></a>
                </li>
            </ul>
        </nav>
    </div>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {

        },
        data: function(){
            return {
                filter : {},
                data : {},
            };
        },
        created: function(){
            console.log("Vue Component : <?=$componentName?> Load")

            this.getData();
        },
        mounted: function(){
            this.$nextTick(() => {
                $('.gnb_1dli').hover(function() {
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

                $('#gnb .gnb_1dli').hover(function() {
                    $('ul.gnb_2dul', this).slideDown(200);
                    $('ul.gnb_2dul', this).css('display','block');
                    //$(this).children('a:first').addClass("hov");
                }, function() {
                    $('ul.gnb_2dul', this).slideUp(200);
                    $('ul.gnb_2dul', this).css('display','none');
                    //$(this).children('a:first').removeClass("hov");
                });
            });
        },
        methods: {
            getData: function () {
                var method = "get";
                var filter = JSON.parse(JSON.stringify(this.filter));

                var objs = {
                    _method: method,
                    filter: JSON.stringify(filter)
                };

                var res = ajax("/api/category.php", objs);
                if (res) {
                    console.log(res)
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