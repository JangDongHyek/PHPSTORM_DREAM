<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div>
        <!-- 파일 부분 -->
        <input type="file" @change="jl.changeFile($event,row,'upfile')"> <!-- 데이터의 기본값은 '' -->

        <!-- 드래그 파일부분 -->
        <input type="file" ref="multiUpload" multiple>
        <div class="dragZone" @click="$refs.multiUpload.click()"
             @drop.prevent="jl.dropFile($event,row,'upfile_array')" @dragover.prevent @dragleave.prevent>
        </div>

        <!-- 페이징 -->
        <item-paging :filter="filter" @change="jl.getsData(filter,rows);"></item-paging>

        <!-- 부트스트랩 기반 모달 -->
        <external-bs-modal :modal="modal">
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
        <external-bs-daum-postcode :modal="modal" @select="getAddress"></external-bs-daum-postcode>

        <!-- summernote -->
        <external-summernote :row="row" field="wr_content"></external-summernote>

        <button @click="jl.postData(row,options)">추가</button>
        <button @click="jl.deleteData(row,{message :'', href:''})">삭제</button>

        <item-captcha :row="row" field="captcha"></item-captcha>
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

                    where : [
                        {
                            key : "",
                            value : "",
                            logical : "", // 기본값 (AND),OR,AND NOT
                            source : "", // 조인시 사용가능
                            operator : "", // 기본값 (=) ,!= >= <=,
                        }
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
                        {
                            table : "user",
                            foreign : "user_idx",
                            as : "",// as값이있다면 $테이블명이아닌 $as값으로 가져온다
                        },
                    ],

                    // like테이블에 foreing키에 이테이블의 primary값을 가진 모든데이터를 가져오는 연결형구문
                    relations : [
                        {
                            table : "like" ,
                            foreign : "board_idx",
                            type : "count", // type(count,data)
                            filter : {

                            },
                        },
                    ],

                    join : {
                        table : "user", origin : "user_idx", join : "idx",type : "", // LEFT, INNER
                        source : false, // true 시 join 테이블이 조회 기준이 된다
                        select : ["column1","user.column2","user.column3 as a"], // 조회 기준이 아닌 테이블의 컬럼을 추가 조회하고싶을때 넣는다
                        //select : "*", // 조회 기준이 아닌 테이블의 모든 컬럼을 가져오고싶을때 사용 속도로 인한 비추천
                        group_by : [ // 그룹바이 sum이나 count 하고싶을떄
                            {
                                group : "g5_write_note.wr_id",
                                aggregate : "g5_write_note_like.idx",
                                as : "like_count",
                                type : "", // type 기본값은 COUNT
                            },
                        ],
                    },

                    add_query : " and idx = 'exam' ",

                    order_by_desc : ["idx"],
                    order_by_asc : ["idx"],
                },

                options : {
                    table : '',
                    file_use : false, // true 파일 사용
                    required : [
                        {name : "",message : ``}, //simple
                        {//String
                            name : "",
                            message : ``,
                            min : {length : 10, message : ""},
                            max : {length : 30, message : ""}
                        },
                        {//Array
                            name : "",
                            min : {length : 1, message : ""}
                            max : {length : 10, message : ""}
                        },
                    ],
                    updated : [
                        {key : "", value : ``},
                    ],
                    confirm : {
                        message : '',
                        callback : async () => { // false 시 실행되는 callback

                        },
                    },
                    return : false, // 해당값이 true이면 ajax만 날리고 바로 리턴
                    href : "",
                    callback : async (res) => {

                    },
                    //callback : this.callbackMethod // callback을 많이 사용한다면 해당방식으로 가능

                }


                data : {
                    table : "",

                    hits : "incr", // 인트타입의 컬럼인데 incr 이란 단어가 들어가면 해당컬럼 +1 로 쿼리가 대체된다

                    // 해당하는 조건에 걸리는 데이터가 있으면 error(message)를 반환
                    // 객체 하나당 묶음이라 여러개의 조건도 가능 아이디 확인, 닉네임 확인 이렇게하고싶으면 객체 두개필요
                    exists : [
                        {
                            where : [
                                {key : "", value : "", logical : ""},
                            ],
                            message : ""
                        }
                    ],

                    //데이터를 암호화 할때 필요 ex 정보 수정시 change_user_pw의값을 user_pw 에 암호화해서 삽입한다는 내용
                    hashes : [
                        {key : "user_pw", convert : "user_pw"}, // 회원가입할떄
                        {key : "change_user_pw", convert : "user_pw"}, // 회원 정보 수정할때
                    ],

                    // 해당 컨텐츠내용에 client_ip, status active 된 데이터가 없다면 추가
                    session_insert : [
                        {content : "project_hits"},
                    ],

                    // 해당 컨텐츠내용에 client_ip, status active 된 데이터가 있다면 해당 로직 중단
                    session_exists : [
                        {content : "project_hits", exit_type : "error"}, // exit_type 이 error일경우 error가반환 stop일경우 아무것도안함
                    ],
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
        mounted: async function(){
            // 파일 있는지 체크하는 ajax
            await this.jl.ajax("file_exists",{src : `/data/file/member/1.jpg`},"/jl/JlApi.php").then(response => {
                this.file_exists = response.exists;
            });

            this.$nextTick(() => {

            });
        },
        updated : function() {

        },
        methods: {
            async callbackMethod(res) {

            },
            getAddress(data) {
                console.log(data);
                this.modal = false;
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
            async "object.key" (value,old_value) {

            }
        }
    }});
</script>

<style>

</style>