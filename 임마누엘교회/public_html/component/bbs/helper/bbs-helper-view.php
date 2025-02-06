<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div v-if="rend">
        <div class="box_radius box_white table">
            <p></p>
            <h6 class="txt_color"><b class="icon icon_color">{{data.wr_2}}</b> {{data.wr_3}}</h6>
            <p class="txt_bold">기간 | {{data.wr_4}} <span v-for="item,index in data.wr_5">{{item}} {{index ? '' : ','}}</span></p>
            <hr>
            <h6>{{data.wr_6}}</h6><!--제목-->
            <div class="cont"><!--내용-->
                <p style="white-space: pre-line" v-html="data.wr_7"></p>
            </div>
            <hr>
            <p class="flex gap10">
                <b class="icon icon_gray w100px">요청자</b> {{data.wr_8}}
            </p>
            <p class="flex gap10">
                <b class="icon icon_gray w100px">연락처</b> {{data.wr_9}}
            </p>
            <p class="flex gap10">
                <b class="icon icon_gray w100px">지원마감</b> {{data.wr_10}}
            </p>
            <p class="flex gap10"  data-toggle="modal" @click="modal2 = true;">
                <a class="icon icon_color w100px" >지원목록</a> 총 {{data.$helper_applicant.length}}명
            </p>
            <br>
            <button class="btn btn_large btn_blue" type="button" @click="openModel()">지원하기</button>
            <br>
            <br>
            <div class="flex gap10">
                <button class="btn w100 btn_line" type="button" v-if="data.wr_1 == mb_no" @click="jl.href('./helper_form.php?primary='+data.wr_id)">수정</button>
                <button class="btn w100 btn_red2" type="button" v-if="data.wr_1 == mb_no" @click="putBoard()">종료</button>
            </div>
        </div>

        <item-bs-modal :modal="modal2" @close="modal2 = false;" classes="a b">
            <template v-slot:header>
                <h4 class="modal-title" id="helperListModalLabel">지원자 리스트</h4>
                <button @click="modal2 = false;" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </template>

            <!-- body -->
            <template v-slot:default>
                <ul class="list">
                    <li v-for="applicant in data.$helper_applicant"><span>{{applicant.name}}</span>{{applicant.phone}}</li>
                </ul>
            </template>
        </item-bs-modal>

        <item-bs-modal :modal="modal" @close="modal = false;">
            <template v-slot:header>
                <h4 class="modal-title" id="helpModalLabel">지원하기</h4>
                <button @click="modal = false;" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </template>

            <!-- body -->
            <template v-slot:default>
                <label>이름</label>
                <input type="text" v-model="applicant.name">
                <label>연락처</label>
                <input type="text" v-model="applicant.phone">
            </template>


            <template v-slot:footer>
                <button type="button" class="btn" data-dismiss="modal">닫기</button>
                <button type="button" class="btn txt_color" @click="postHelperApplicant()">지원</button>
            </template>
        </item-bs-modal>
    </div>
</script>

<script>
    Jl_components.push({name : "<?=$componentName?>",object : {
            template: "#<?=$componentName?>-template",
            props: {
                mb_no : {type: String, default: ""},
                primary : {type: String, default: ""},
            },
            data: function () {
                return {
                    jl: null,
                    component_idx: "",

                    paging: {
                        page: 1,
                        limit: 1,
                        count: 0,
                    },

                    data: {},
                    data_array : [],

                    modal : false,
                    modal2 : false,

                    applicant : {
                        user_idx : this.mb_no,
                        board_idx : this.primary,
                        name : "",
                        phone : "",
                    },

                    rend : false,
                };
            },
            async created() {
                this.jl = new Jl('<?=$componentName?>');
                this.component_idx = this.jl.generateUniqueId();

                if(this.primary) await this.getData();

                this.rend = true;
            },
            mounted() {
                this.$nextTick(() => {

                });
            },
            updated() {

            },
            methods: {
                async openModel() {
                    const givenDate = new Date(this.data.wr_10); // 주어진 날짜
                    const today = new Date();

// 시간을 제외하고 연월일만 비교하려면 아래와 같이 처리
                    const givenDateOnly = new Date(givenDate.getFullYear(), givenDate.getMonth(), givenDate.getDate());
                    const todayOnly = new Date(today.getFullYear(), today.getMonth(), today.getDate());
                    try {
                        if(this.data.wr_11) throw new Error("종료된 게시글입니다.");
                        if (todayOnly > givenDateOnly) throw new Error("지원 마감된 게시글입니다.")

                        this.modal = true;
                    } catch (e) {
                        await this.jl.alert(e.message)
                    }

                },
                async putBoard() {
                    if(!await this.jl.confirm("종료되면 돌릴수없습니다. 정말 종료하시겠습니까?")) return false;
                    let data = {
                        table: "g5_write_helper",
                        primary : this.primary,
                        wr_11 : true,
                    }

                    try {
                        if(this.data.wr_11) throw new Error("이미 종료된 게시글입니다.");

                        let res = await this.jl.ajax("update", data, "/jl/JlApi.php");
                        await this.jl.alert("종료되었습니다");
                        window.location.reload();
                    } catch (e) {
                        await this.jl.alert(e.message)
                    }

                },
                async postHelperApplicant() {
                    let data = {
                        table: "helper_applicant",

                        exists : [
                            {
                                where : [
                                    {key : "board_idx", value : this.primary, operator : ""},
                                    {key : "user_idx", value : this.mb_no, operator : ""},
                                ],
                                message : "이미 신청하였습니다."
                            }
                        ],
                    }

                    // object의 필수값을 설정하는 option
                    let required = [
                        {name : "user_idx",message : `로그인이 필요한 기능입니다.`},
                        {name : "name",message : `이름은 필수 값입니다.`},
                        {name : "phone",message : `연락처는 필수 값입니다.`},
                    ]
                    let options = {required : required};

                    if (this.applicant) data = Object.assign(data, this.applicant); // paging 객체가있다면 병합

                    try {
                        let res = await this.jl.ajax("insert", data, "/jl/JlApi.php",options);
                        await this.jl.alert("완료되었습니다.");
                        window.location.reload();
                    } catch (e) {
                        await this.jl.alert(e.message)
                    }

                },
                async getData() {
                    let filter = {
                        table: "g5_write_helper",
                        primary : this.primary,

                        relations : [
                            {table : "helper_applicant" ,foreign : "board_idx"}
                        ]
                    }

                    try {
                        let res = await this.jl.ajax("get", filter, "/jl/JlApi.php");
                        this.data = res.data[0]
                    } catch (e) {
                        await this.jl.alert(e.message)
                    }
                }
            },
            computed: {},
            watch: {}
        }});

</script>

<style>

</style>