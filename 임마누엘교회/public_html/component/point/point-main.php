<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div v-if="load">
        <div id="mypoint" class="">
            <div class="box_radius box_blue">
                <h6>현재 포인트</h6>
                <h6 class="txt_blue txt_bold">2,000 <i class="fa-solid fa-circle-p"></i></h6>
            </div>
            <div class="box_radius box_white">
                <div class="select">
                    <input type="radio" v-model="filter.po_expired" value=""  @change="filter.page = 1; this.jl.getsData(filter,arrays);" name="list" id="list1"><label for="list1">전체</label>
                    <input type="radio" v-model="filter.po_expired" value="0" @change="filter.page = 1; this.jl.getsData(filter,arrays);" name="list" id="list2"><label for="list2">적립</label>
                    <input type="radio" v-model="filter.po_expired" value="1" @change="filter.page = 1; this.jl.getsData(filter,arrays);" name="list" id="list3"><label for="list3">차감</label>
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
                            <span :class="item.po_expired == 0 ? 'txt_blue' : 'txt_red'">{{item.po_expired == 0 ? '적립' : '차감'}}</span>
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
                        limit: 1,
                        count: 0,
                        po_expired : '',
                    },

                    modal : {
                        status : false,
                        data : {},
                    },

                    rend : false,
                };
            },
            async created() {
                this.jl = new Jl('<?=$componentName?>');
                this.component_idx = this.jl.generateUniqueId();

                //if(this.primary) this.data = await this.jl.getData(this.filter);
                await this.jl.getsData(this.filter,this.arrays);

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