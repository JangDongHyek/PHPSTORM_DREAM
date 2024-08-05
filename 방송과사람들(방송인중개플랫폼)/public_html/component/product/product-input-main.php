<?php $componentName = str_replace(".php", "", basename(__FILE__)); ?>
<script type="text/x-template" id="<?= $componentName ?>-template">
    <div>
        <product-input-tab1 v-if="tab == 1"
                            :product="data" :mb_no="mb_no" @changeTab="tab = $event"
        ></product-input-tab1>

        <product-input-tab2 v-show="tab == 2"
                            :product="data" :mb_no="mb_no" @changeTab="tab = $event" :default_content="default_content"
        ></product-input-tab2>

        <product-input-tab3 v-if="tab == 3"
                            :product="data" :mb_no="mb_no" @changeTab="tab = $event"
        ></product-input-tab3>

    </div>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            primary: {type: String, default: ""},
            mb_no: {type: String, default: ""}
        },
        data: function () {
            return {
                jl: null,
                filter: {},
                tab: 2,
                default_content : [], //naver-editor 참조 변수

                data: {
                    //common
                    idx: "",
                    member_idx: "",

                    //tab1
                    name: "",
                    category_idx: "",
                    gender: "",
                    age: "",
                    area: [],
                    weekend: [],
                    types: [],
                    styles: [],
                    keywords: [],
                    package : false,
                    basic : {name : "",description : ""},
                    standard : {name : "",description : ""},
                    deluxe : {name : "",description : ""},
                    premium : {name : "",description : ""},
                    //추가옵션부분은 회의 끝나면 추가

                    //tab2
                    service: "",
                    questions: [],
                    product_info1: "",
                    product_info2: "",
                    product_info3: "",
                    product_info4: "",
                    product_info5: "",
                    product_info6: "",

                    //tab3
                    main_image_array: [],
                    content_image_array: [],
                    movie_file_array: [],
                    movie_link: [],
                },
            };
        },
        created: function () {
            this.jl = new JL('<?=$componentName?>');
        },
        mounted: function () {
            this.$nextTick(() => {

            });
        },
        methods: {
            postData: function () {
                var method = this.primary ? "update" : "insert";
                var res = this.jl.ajax(method, this.data, "/api/example.php");

                if (res) {

                }
            },
            getData: function () {
                var filter = {primary: this.primary}
                var res = this.jl.ajax("get", filter, "/api/example.php");

                if (res) {
                    this.data = res.response.data

                }
            }
        },
        computed: {},
        watch: {
            tab: function () {
                window.scrollTo(0, 0)
            }
        }
    });
</script>

<style>

</style>