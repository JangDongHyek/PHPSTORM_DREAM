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
        <item-paging :filter="filter" @change="filter.page = $event; this.jl.getsData(filter,arrays);"></item-paging>

        <!-- 부트스트랩 기반 모달 -->
        <external-bs-modal :modal="modal" @close="modal = false;" class_1="" class_2="">
            <template v-slot:header>

            </template>

            <!-- body -->
            <template v-slot:default>
                <external-pdf-view v-if="modal"></external-pdf-view>
            </template>


            <template v-slot:footer>

            </template>
        </external-bs-modal>

        <!-- 부스스트랩이 있을시 사용가능한 다음주소찾기 모달-->
        <external-bs-daum-postcode :modal="modal" @close="modal = false;" @select="getAddress"></external-bs-daum-postcode>

        <button @click="jl.postData(data,'table_name',options)">추사</button>
        <button @click="jl.deleteData(data,'rental_hall',{message :'', href:''})">삭제</button>

    </div>
</script>

<script>
    Jl_components.push({name : "<?=$componentName?>",object : {
        template: "#<?=$componentName?>-template",
        props: {
            primary : {type : String, default : ""}
        },
        data: function(){
            return {
                jl : null,
                component_idx : "",

                modal : false,

                filter : {
                    page : 1,
                    limit : 1,
                    count : 0,
                },

                options : {
                    required : [
                        {name : "",message : ``},
                    ],
                    href : "",

                    callback : async (res) => {

                    }
                }


                data : {
                    table : "",
                }
            };
        },
        created: function(){
            this.jl = new Jl('<?=$componentName?>');
            this.component_idx = this.jl.generateUniqueId();

            if(this.primary) this.getData();
            //await this.jl.getsData(this.filter,this.arrays);

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
            getAddress(data) {
                console.log(data);
                this.modal = false;
            },
            async postData() {
                let method = this.primary ? "update" : "insert";

                // object의 필수값을 설정하는 option
                let required = [
                    {name : "",message : ""},
                ]

                let options = {required : required};

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

                    // 이테이블의 user_idx 값으로 user의 테이블에 primary값을 검색해 맞는 데이터 하나만 가져오는 확장형 구문
                    extensions : [
                        {table : "user", foreign : "user_idx"}
                    ],

                    // like테이블에 foreing키에 이테이블의 primary값을 가진 모든데이터를 가져오는 연결형구문
                    relations : [
                        {table : "like" ,foreign : "board_idx"}
                    ],

                    join : {
                        table : "user", origin : "user_idx", join : "idx",type : "" // LEFT, INNER
                        source : false, // true 시 join 테이블이 조회 기준이 된다
                        select : ["column1","user.column2","user.column3 as a"], // 조회 기준이 아닌 테이블의 컬럼을 추가 조회하고싶을때 넣는다
                        //select : "*", // 조회 기준이 아닌 테이블의 모든 컬럼을 가져오고싶을때 사용 속도로 인한 비추천
                        group_by : [ // 그룹바이 sum이나 count 하고싶을떄
                            {group : "g5_write_note.wr_id", aggregate : "g5_write_note_like.idx", as : "like_count", type : "" // 기본값은 COUNT}
                        ],
                    },

                    join_filter : [/*join 들어갈떄 개발예정 */],

                    add_query : " and idx = 'exam' ",

                    order_by_desc : ["idx"],
                    order_by_asc : ["idx"],
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
                if(! await this.jl.confirm("정말 삭제하시겠습니까?")) return false;
                let method = "delete";
                //let method = "where_delete";

                let filter = {
                    table : "",
                    primary : "", // delete일시 primary 카깂을 넣으면된다 primary 키값이 아니라면 삭제 안됌

                    file_use : true, // 저장된 파일 삭제할지 안할지 삭제할시 데이터의 컬럼명 이들어가야한다
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

            async jlPostData() {
                let data = {
                    table : "",
                    name : "",
                }

                let required = [
                    {name : "",message : ``},
                ],
                this.jl.postData(data,required,async (res) => {
                    // 세번째 매개변수인 콜백함수가 빈값일 경우 밑에 코드가 자동 실행됌
                    await this.jl.alert("완료되었습니다.");
                    window.location.reload();
                });
            }

            async jlGetData() {
                let filter = {
                    table : "",
                    primary : "",
                }
                let data = this.jlGetData(filter,async (res) => {
                    //함수내용
                    // 두번쨰 매개변수인 콜백함수가 빈값일경우 res.data[0]이 그냥 return 됌
                });
            }

            async jlGetsData() {
                let filter = {
                    table : "",
                    primary : "",
                }

                let datas = this.jlGetsData(filter,async (res) => {
                    //두번쨰 매개변수인 콜백함수가 빈값일경우 밑에 함수가 자동으로 적용됌
                    this.data_array = res.data
                    this.paging.count = res.count;
                });
            }
        },
        computed: {

        },
        watch : {

        }
    }});
</script>

<style>

</style>