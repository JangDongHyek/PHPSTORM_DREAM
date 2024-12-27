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

        <!-- 부트스트랩 기반 모달 -->
        <item-bs-modal :modal="modal" @close="$emit('close')">
            <template v-slot:header>

            </template>

            <!-- body -->
            <template v-slot:default>

            </template>


            <template v-slot:footer>

            </template>
        </item-bs-modal>
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

                modal : false,

                paging : {
                    page : 1,
                    limit : 1,
                    count : 0,
                }
            };
        },
        created: function(){
            this.jl = new Jl('<?=$componentName?>');
            this.component_idx = this.jl.generateUniqueId();

            if(this.primary) this.getData();

            // 플러그인이 필수인 컴포넌트일떄 사용
            let plugins = this.jl.checkPlugin(["jquery","bootstrap","summernote"]);
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

                // object의 필수값을 설정하는 option
                let required = [
                    {name : "",message : ""},
                ]

                let options = {required : this.required};

                let data = {
                    table : "",

                    file_use : false, // 파일 저장할지 안할지
                }
                try {
                    //if(!this.data.change_user_pw) throw new Error("비밀번호를 입력해주세요.");
                    let res = await this.jl.ajax(method,data,"/jl/JlApi.php",options);
                }catch (e) {
                    alert(e.message)
                }

            },
            async getData() {
                let filter = {
                    table : "order",

                    where : [
                        {key : "", value : "", operator : ""}
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

                    extensions : [
                        {table : "user", foreign : "user_idx"}
                    ],

                    join : {
                        table : "user", origin : "user_idx", join : "idx",
                        source : false, // true 시 join 테이블이 조회 기준이 된다
                        select : ["column1","user.column2","user.column3 as a"] // 조회 기준이 아닌 테이블의 컬럼을 추가 조회하고싶을때 넣는다
                        //select : "*" // 조회 기준이 아닌 테이블의 모든 컬럼을 가져오고싶을때 사용 속도로 인한 비추천
                    },

                    join_filter : [/*join 들어갈떄 개발예정 */],

                    add_query : " and idx = 'exam' ",

                    order_by_desc : "idx",
                    order_by_asc : "idx",
                }

                if(this.paging) filter = {...filter...this.paging}; // paging 객체가있다면 병합

                try {
                    let res = await this.jl.ajax("get",filter,"/jl/JlApi.php");
                    this.data = res.data
                    this.paging.count = res.count;
                }catch (e) {
                    alert(e.message)
                }
            },
            async deleteData() {
                let method = "delete";

                //let method = "where_delete";

                let filter = {
                    table : "",
                    primary : "", // delete일시 primary 카깂을 넣으면된다 primary 키값이 아니라면 삭제 안됌

                    file_use : false, // 저장된 파일 삭제할지 안할지 삭제할시 데이터의 컬럼명 이들어가야한다
                    file_columns : ["exam1","exma2"] // 파일값이 저장된 컬럼

                    // where_delete 일시 똑같이 조건 추가하면 된다 다중삭제가 되므로 조심히 사용해야한다
                }
                try {
                    //if(!this.data.change_user_pw) throw new Error("비밀번호를 입력해주세요.");
                    let res = await this.jl.ajax(method,filter,"/jl/JlApi.php");
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