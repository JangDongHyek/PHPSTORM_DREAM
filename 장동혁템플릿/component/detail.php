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

                    // 해당하는 조건에 걸리는 데이터가 있으면 error(message)를 반환
                    // 객체 하나당 묶음이라 여러개의 조건도 가능 아이디 확인, 닉네임 확인 이렇게하고싶으면 객체 두개필요
                    exists : [
                        {
                            where : [
                                {key : "", value : "", operator : ""}
                            ],
                            message : ""
                        }
                    ],

                    //데이터를 암호화 할때 필요 ex 정보 수정시 change_user_pw의값을 user_pw 에 암호화해서 삽입한다는 내용
                    hashes : [
                        {key : "user_pw", convert : "user_pw"}, // 회원가입할떄
                        {key : "change_user_pw", convert : "user_pw"}, // 회원 정보 수정할때
                    ]
                }

                if(this.data) data = {...data...this.data}; // data 객체가있다면 병합
                try {
                    //if(!this.data.change_user_pw) throw new Error("비밀번호를 입력해주세요.");
                    let res = await this.jl.ajax(method,data,"/jl/JlApi.php",options);

                    await this.jl.alert('저장되었습니다.');

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

                    // where_delete 일시
                }
                try {
                    //if(!this.data.change_user_pw) throw new Error("비밀번호를 입력해주세요.");
                    let res = await this.jl.ajax(method,filter,"/jl/JlApi.php");
                }catch (e) {
                    alert(e.message)
                }
            },

            //중복 제거안되는 데이터만 가져오는 함수
            // Ex ) A라는 컬럼에 일식,중식,한식 이렇게 총 100개의 데이터가있으면 column에 A넣을시 3개의 데이터만 반환됌
            async distinctData() {
                let filter = {
                    table : "example",
                    user_idx : this.user_idx,
                    column : "", // 중복 제거후 안겹치는 데이터만 가져오고싶은 컬럼

                    //조건은 get과 같이 똑같이 조건 추가하면 된다 다중삭제가 되므로 조심히 사용해야한다
                }

                try {
                    let res = await this.jl.ajax("distinct",filter,"/jl/JlApi");
                }catch (e) {
                    alert(e.message)
                }
            },
        },
        computed: {

        },
        watch : {

        }
    });
</script>

<style>

</style>