<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div v-if="load">
        <div class="join-view">
            <h6>선정 작품</h6>
            <div>
                <div class="empty">
                    <i class="fa-regular fa-award"></i>
                    아직 선정되지 않았어요.
                </div>
                <ul>
                    <li>
                        <a data-toggle="modal" data-target="#joinViewModal" >
                            <div class="img"><span class="icon_1st">1등</span><img src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg"></div>
                            <p>#3</p><!--참여순서-->
                            <div class="profile">
                                <img src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg" alt="프로필 이미지">
                                <span>지원자</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a>
                            <div class="img"><span class="icon_2nd">2등</span><img src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg"></div>
                            <p>#2</p><!--참여순서-->
                            <div class="profile">
                                <img src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg" alt="프로필 이미지">
                                <span>지원자</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a>
                            <div class="img"><span class="icon_3th">3등</span><img src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg"></div>
                            <p>#1</p><!--참여순서-->
                            <div class="profile">
                                <img src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg" alt="프로필 이미지">
                                <span>지원자</span>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
            <h6>참여 작품</h6>
            <div>
                <div class="empty">
                    <i class="fa-duotone fa-object-subtract"></i>
                    참여한 작품이 없어요.
                </div>
                <ul>
                    <li>
                        <a>
                            <div class="img"><img src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg"></div>
                            <p>#1</p><!--참여순서-->
                            <div class="profile">
                                <img src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg" alt="프로필 이미지">
                                <span>지원자</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a>
                            <div class="img"><img src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg"></div>
                            <p>#2</p><!--참여순서-->
                            <div class="profile">
                                <img src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg" alt="프로필 이미지">
                                <span>지원자</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a>
                            <div class="img"><img src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg"></div>
                            <p>#3</p><!--참여순서-->
                            <div class="profile">
                                <img src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg" alt="프로필 이미지">
                                <span>지원자</span>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
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
                    file_use : false,
                    required : [
                        {name : "",message : ``},
                    ],
                    href : "",
                },

                filter : {
                    table : "",
                    primary : this.primary,
                    page: 1,
                    limit: 1,
                    count: 0,
                },

                modal : {
                    status : false,
                    data : {},
                },

                load : false,
            };
        },
        async created() {
            this.jl = new Jl('<?=$componentName?>');
            this.component_idx = this.jl.generateUniqueId();

            //if(this.primary) this.row = await this.jl.getData(this.filter);
//await this.jl.getsData(this.filter,this.rows);

            this.load = true;
        },
        mounted() {
            this.$nextTick(() => {

            });
        },
        updated() {

        },
        methods: {

        },
        computed: {

        },
        watch: {

        }
    });

</script>

<style>

</style>