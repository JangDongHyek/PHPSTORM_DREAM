<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div>
        <div class="tbl_head02 tbl_wrap mb_tbl">
            <table>
                <caption>리스트</caption>
                <thead>
                <tr>
                    <th>no</th>
                    <th>아이디</th>
                    <th>학교</th>
                    <th>전공</th>
                    <th>상태</th>
                    <th>파일</th>
                </tr>
                </thead>
                <tbody>
                <tr class="bg0" v-for="item,index in data">
                    <td>{{item.jl_no_reverse}}</td>
                    <td>{{item.$g5_member.mb_id}}</td>
                    <td>{{item.name}}</td>
                    <td>{{item.major}}</td>
                    <td>{{item.state}}</td>
                    <td><a :href="jl.root+item.upfile.src" :download="item.upfile.name">{{item.upfile.name}}</a></td>
                </tr>
                </tbody>
            </table>

            <item-pagination :filter="filter" @change="changePage"></item-pagination>
        </div>
    </div>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
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
                },

                data : [],
                modal : false,
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
        updated : function() {

        },
        methods: {
            changePage(page) {
                this.filter.page = page;

                this.getData();
            },
            async getData() {
                try {
                    let res = await this.jl.ajax("get",this.filter,"/api2/member_school.php");
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