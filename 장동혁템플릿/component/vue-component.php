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
                filter : {
                    page : 1,
                    limit : 1,
                    count : 0,
                    order_by_desc : "insert_date"
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

            if(this.primary) this.getData();
        },
        mounted: function(){
            this.$nextTick(() => {

            });
        },
        methods: {
            postData : function() {
                let method = this.primary ? "update" : "insert";

                try {
                    let res = this.jl.ajax(method,this.data,"/api/example.php",this.required);
                }catch (e) {
                    alert(e)
                }

            },
            getData: function () {
                let filter = {primary: this.primary}

                try {
                    let res = this.jl.ajax("get",filter,"/api/example.php");
                    this.data = res.data[0]
                }catch (e) {
                    alert(e)
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