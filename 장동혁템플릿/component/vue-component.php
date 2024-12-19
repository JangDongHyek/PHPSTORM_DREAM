<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div>
        <!-- 파일 부분 -->
        <input type="file" @change="jl.changeFile($event,data,'upfile')"> <!-- 데이터의 기본값은 '' -->

        <!-- 드래그 파일부분 -->
        <input type="file" ref="multiUpload" multiple>
        <div class="dragZone" @click="$refs.multiUpload.click()"
             @drop.prevent="jl.dropFile($event,data,'upfile_array')" @dragover.prevent @dragleave.prevent>
        </div>

        <!-- 페이징 -->
        <part-paging :filter="filter" @change="filter.page = $event; getData();"></part-paging>
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
                    page : 0,
                    limit : 0,
                    count : 0,
                    order_by_desc : "insert_date",

                    exam : "",

                    where : [
                        {key : "", value : ""}
                    ],

                    like : [
                        {key : "", value : ""}
                    ],

                    between : [
                        {key : "", start : "", end: ""}
                    ],

                    in : [
                        {key : "", array : [] }
                    ],

                    group_where : [
                        {key : "", value : ""},
                        {key : "", value : ""},
                    ],

                    group_like : [
                        {key : "", value : ""},
                        {key : "", value : ""},
                    ],
                },
                required : [
                    {name : "",message : ""},
                ],
                data : {

                },
            };
        },
        created: function(){
            this.jl = new Jl('<?=$componentName?>');
            this.component_idx = this.jl.generateUniqueId();

            if(this.primary) this.getData();
        },
        mounted: function(){
            this.$nextTick(() => {

            });
        },
        updated : function() {

        },
        methods: {
            async postData() {
                let method = this.primary ? "update" : "insert";
                let options = {required : this.required};
                try {
                    //if(!this.data.change_user_pw) throw new Error("비밀번호를 입력해주세요.");
                    let res = await this.jl.ajax(method,this.data,"/api/example.php",options);
                }catch (e) {
                    alert(e.message)
                }

            },
            async getData() {
                try {
                    let res = await this.jl.ajax("get",this.filter,"/api/example.php");
                    this.data = res.data[0]
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