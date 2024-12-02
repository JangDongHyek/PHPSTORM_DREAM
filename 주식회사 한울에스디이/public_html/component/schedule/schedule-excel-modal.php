<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div>
        <item-bs-modal :modal="modal" @close="$emit('close')">
            <template v-slot:header>
                
            </template>

            <!-- body -->
            <template v-slot:default>
                <div class="flex ai-c">
                    <label class="btn btn_mini btn_line" for="file_btn">파일 선택</label>&nbsp;
                    <span class="file_info" v-if="data.upfile">{{data.upfile.name}}</span>
                    <span class="file_info" v-else>선택된 파일 없음</span>
                </div>
                <input type="file" v-show="false" id="file_btn" @change="jl.changeFile($event, data, 'upfile')">
            </template>


            <template v-slot:footer>
                <button class="btn btn-primary" @click="postData()">업로드</button>
            </template>
        </item-bs-modal>
    </div>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            modal : {type : Boolean, default : false},
            primary : {type : String, default : ""},
            project_idx : {type : String, default : ""},
        },
        data: function(){
            return {
                jl : null,
                component_idx : "",
                filter : {},
                required : [
                    {name : "",message : ""},
                ],
                data : {
                    upfile : "",
                    project_idx : this.project_idx,
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
        methods: {
            async postData() {
                let options = {required : this.required};
                try {
                    //if(this.data.change_user_pw != this.data.user_pw_re) throw new Error("비밀번호와 비밀번호 확인이 다릅니다.");

                    let res = await this.jl.ajax('csv_insert',this.data,"/api/project_schedule",options);

                    alert("완료 되었습니다");
                    window.location.reload();
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