<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div v-if="load">
        <div id="mypoint" class="">
            <div class="box_radius box_line">
                <p>
                    <b>👛 포인트 적립 활동 안내</b> <br>
                    <span class="icon icon_color2">01</span> 결단노트 작성시 100포인트 지급(주 1회)<br>
                    <span class="icon icon_color2">02</span> 속회보고 작성시 100포인트 지급(속장만 해당)
                </p>
            </div>
            <div class="box_radius box_blue">
                <h6>현재 포인트</h6>
                <h6 class="txt_blue txt_bold">{{member.mb_point.format()}} <i class="fa-solid fa-circle-p"></i></h6>
            </div>
            <div class="box_radius box_white">
                <div class="select">
                    <input type="radio" v-model="filter.types" value=""  @change="setFilter();this.jl.getsData(filter,arrays);" name="list" id="list1"><label for="list1">전체</label>
                    <input type="radio" v-model="filter.types" value="적립" @change="setFilter(); this.jl.getsData(filter,arrays);" name="list" id="list2"><label for="list2">적립</label>
                    <input type="radio" v-model="filter.types" value="차감" @change="setFilter(); this.jl.getsData(filter,arrays);" name="list" id="list3"><label for="list3">차감</label>
                </div>
                <ul>
                    <li v-if="arrays.length == 0">
                        <h6 class="empty">
                            <i class="fa-solid fa-circle-p"></i><br>
                            내역이 없습니다.
                        </h6>
                    </li>
                    <li v-else v-for="item in arrays">
                        <p>
                            <span :class="item.po_point > 0 ? 'txt_blue' : 'txt_red'">{{item.po_point > 0 ? '적립' : '차감'}}({{item.po_content}})</span>
                            <br>
                            {{item.po_datetime.formatDate({type:'.',time:true})}}
                        </p>
                        <h6>{{item.po_point.format()}}</h6>
                    </li>
                </ul>
            </div>

            <item-paging :paging="filter" @change="filter.page = $event; this.jl.getsData(filter,arrays);"></item-paging>
        </div>
    </div>
</script>

<script>
    Jl_components.push({name : "<?=$componentName?>",object : {
            template: "#<?=$componentName?>-template",
            props: {
                mb_id : {type: String, default: ""},
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
                        table : "g5_point",
                        mb_id : this.mb_id,
                        page: 1,
                        limit: 10,
                        count: 0,

                    },

                    modal : {
                        status : false,
                        data : {},
                    },

                    member : {},

                    rend : false,
                };
            },
            async created() {
                this.jl = new Jl('<?=$componentName?>');
                this.component_idx = this.jl.generateUniqueId();

                //if(this.primary) this.data = await this.jl.getData(this.filter);
                await this.jl.getsData(this.filter,this.arrays);
                this.member = await this.jl.getData({
                    table : "g5_member",
                    mb_id : this.mb_id
                });

                this.load = true;
            },
            mounted() {
                this.$nextTick(() => {

                });
            },
            updated() {

            },
            methods: {
                setFilter() {
                    this.filter.page = 1;
                    this.filter.add_query = "";
                    if(this.filter.types == "적립") {
                        this.filter.add_query = " AND po_point > 0"
                    }

                    if(this.filter.types == "차감") {
                        this.filter.add_query = " AND po_point < 0"
                    }
                }
            },
            computed: {

            },
            watch: {

            }
        }});

</script>

<style>

</style>