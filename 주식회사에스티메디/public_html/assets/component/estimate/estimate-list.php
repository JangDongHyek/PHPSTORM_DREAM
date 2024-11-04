<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div>
        <div class="btn_wrap">
            <a class="btn btn_small btn_line" @click="deletesData()">선택 삭제</a>
            <a class="btn btn_small btn_blue male-auto" href="./2">신규 견적</a>
        </div>

        <div class="board_list">
            <p>총 <strong class="txt_blue">{{filter.count}}</strong>개 </p>
            <ul>
                <li v-for="item in data">
                    <input type="checkbox" :value="item.idx" v-model="deletes">
                    <p class="p_num">{{item.jl_no}}</p>
                    <p class="p_title">
                        <a :href="'./estimateView?idx=' + item.idx">{{item.insert_date}}에 저장한 견적서</a>

                    </p>
                    <p class="p_date">{{item.insert_date.split(' ')[0]}}</p>
                </li>
            </ul>

            <item-pagination :filter="filter" @change="changePage"></item-pagination>

        </div>
    </div>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            mb_id : {type : String, default : ""},
            primary : {type : String, default : ""}
        },
        data: function(){
            return {
                jl : null,
                component_idx : "",
                filter : {
                    page : 1,
                    limit : 10,
                    count : 0,
                    order_by_desc : "insert_date",

                    mb_id : this.mb_id
                },

                data : [],
                modal : false,
                deletes : [],
            };
        },
        created: function(){
            this.jl = new Jl('<?=$componentName?>');
            this.component_idx = this.jl.generateUniqueId();

            this.getData();
        },
        mounted: function(){
            this.$nextTick(() => {

            });
        },
        methods: {
            async deletesData() {
                if(this.deletes.length == 0) {
                    alert("선택된 데이터가 없습니다.");
                    return false;
                }
                if(!confirm("정말 삭제하시겠습니까?")) return false;

                let obj = {
                    in_key : "idx",
                    in_value : this.deletes
                }

                try {
                    let res = await this.jl.ajax("where_delete",obj,"/api/bs_estimate");
                    alert("삭제되었습니다.");
                    window.location.reload();
                }catch (e) {
                }
            },
            changePage(page) {
                this.filter.page = page;

                this.getData();
            },
            async getData() {
                try {
                    let res = await this.jl.ajax("get",this.filter,"/api/bs_estimate");
                    this.data = res.data
                    this.filter.count = res.count;
                }catch (e) {
                    alert(e.message)
                }
            }
        },
        computed: {

        },
        watch : {

        }
    });
</script>

<style>

</style>