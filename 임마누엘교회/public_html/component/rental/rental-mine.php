<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div v-if="load">
        <div class="box_radius box_white">
            <ul class="tabs">
                <li class="tab-link" :class="{current : tab == '본관'}" @click="tab = '본관'" data-tab="hall">본관</li>
                <li class="tab-link" :class="{current : tab == '교육관'}" @click="tab = '교육관'" data-tab="lecture">교육관</li>
                <li class="tab-link" :class="{current : tab == '버스'}" @click="tab = '버스'" data-tab="bus">버스</li>
                <li class="tab-link" :class="{current : tab == '교회비품'}" @click="tab = '교회비품'" data-tab="equip">교회비품</li>
            </ul>
            <!-- 탭메뉴  -->
            <!-- 탭 내용 -->
            <div role="tabpanel" v-show="tab == '본관'"  id="hall">
                <rental-hall-my-list :mb_no="mb_no"></rental-hall-my-list>
            </div>
            <div role="tabpanel" v-show="tab == '교육관'" id="lecture">
                <rental-lecture-my-list :mb_no="mb_no"></rental-lecture-my-list>
            </div>
            <div role="tabpanel" v-show="tab == '버스'" id="bus">
                <rental-bus-my-list :mb_no="mb_no"></rental-bus-my-list>
            </div>
            <div role="tabpanel" v-show="tab == '교회비품'"  id="equip">
                <rental-equip-my-list :mb_no="mb_no"></rental-equip-my-list>
            </div>
        </div>
    </div>
</script>

<script>
    Jl_components.push({name : "<?=$componentName?>",object : {
            template: "#<?=$componentName?>-template",
            props: {
                mb_no : {type: String, default: ""},
                primary : {type: String, default: ""},
            },
            data: function () {
                return {
                    load : false,
                    jl: null,
                    component_idx: "",

                    data: {},
                    arrays : [],

                    options : {
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

                    tab : "본관",

                    rend : false,
                };
            },
            async created() {
                this.jl = new Jl('<?=$componentName?>');
                this.component_idx = this.jl.generateUniqueId();

                if(this.primary) this.data = await this.jl.getData(this.filter);
                //await this.jl.getsData(this.filter,this.arrays);

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
        }});

</script>

<style>

</style>