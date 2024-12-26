<?php $componentName = str_replace(".php", "", basename(__FILE__)); ?>
<script type="text/x-template" id="<?= $componentName ?>-template">
    <section id="profile05">
        <div>
            <h4>경력기간</h4>
            <div>
                <dl>
                    <dt>총 경력기간을 선택해 주세요</dt>
                    <dd>
                        <select v-model="user.job_career">
                            <option disabled value="">총 경력기간을 선택해 주세요</option>
                            <option value="신입">신입</option>
                            <option value="1년">1년</option>
                            <option value="2년">2년</option>
                            <option value="3년">3년</option>
                            <option value="4년">4년</option>
                            <option value="5년">5년</option>
                            <option value="6년">6년</option>
                            <option value="7년">7년</option>
                            <option value="8년">8년</option>
                            <option value="9년">9년</option>
                            <option value="10년">10년</option>
                            <option value="11년">11년</option>
                            <option value="12년">12년</option>
                            <option value="13년">13년</option>
                            <option value="14년">14년</option>
                            <option value="15년">15년</option>
                            <option value="16년 이상">16년 이상</option>
                        </select>
                    </dd>
                </dl>
                <div class="box_blue" id="tip">
                    <p>TIP</p>
                    <ul>
                        <li>전문 분야와 직접적으로 연관된 총 경력 기간을 선택해 주세요.</li>
                    </ul>
                </div>
            </div>
            <br><br>
            <!--<label for="">경력사항을 작성해주세요</label>
            <input type="text" name="" id="" placeholder="추가해주세요" @click="modal = true;"/>-->
            <dl>
                <dt>경력사항</dt>
                <dd><input type="text" id="" v-model="career.content" placeholder="회사명 및 이력 입력"></dd>
            </dl>
            <dl>
                <dt>경력기간</dt>
                <dd class="flex"><input type="date" v-model="career.start_date"> ~ <input type="date" v-model="career.end_date"></dd>
            </dl>
            <dl>
                <dt>근무지역</dt>
                <dd><input type="text" id="" placeholder="근무지역" v-model="career.address"></dd>
            </dl>
            <dl>
                <dt>증빙자료 첨부(선택)</dt>
                <dd>
                    <div id="addFile" class="addFile">
                        <label class="btn" for="school_file">파일 첨부</label>
                        <span>{{career.upfile ? career.upfile.name : '증빙자료 파일 첨부'}}</span>
                        <input type="file" id="school_file" style="display: none;" @change="jl.changeFile($event,career,'upfile')">
                    </div>
                </dd>
            </dl>
            <br>
            <!--
            <div class="modal fade" :class="{'in' : modal}" id="educationModal" tabindex="-1"
                 :style="{display : modal ? 'block' : 'none'}" @click.self="modal = false;">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                    @click="modal = false"><i class="fa-light fa-close"></i></button>
                            <h5 class="modal-title" id="educationModalLabel">경력사항을 작성해주세요</h5>
                        </div>
                        <div class="modal-body" >
                            <div>
                                <p class="red_point">
                                    <input type="checkbox" id="freelancer-checkbox" name="freelancer" v-model="career.free">
                                    <label for="freelancer-checkbox">프리렌서인 경우, 체크해주세요</label>
                                </p>
                                <dl>
                                    <dt>회사명</dt>
                                    <dd>
                                        <input type="text" placeholder="회사명 입력" v-model="career.name">
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>근무부서</dt>
                                    <dd>
                                        <input type="text" placeholder="근무부서 입력" v-model="career.dept">
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>직위</dt>
                                    <dd>
                                        <input type="text" placeholder="직위 입력" v-model="career.position">
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>근무지</dt>
                                    <dd>
                                        <select v-model="career.address">
                                            <option disabled value="">시/도 선택</option>
                                            <option v-for="item in areas" :value="item">{{item}}</option>
                                        </select>
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>근무기간</dt>
                                    <dd>
                                        <div class="flex">
                                            <select v-model="career.year">
                                                <option disabled value="">년</option>
                                                <option v-for="item in 99" :value="item">{{item}}년</option>
                                            </select>
                                            &nbsp;
                                            <select v-model="career.month">
                                                <option disabled value="">개월</option>
                                                <option v-for="item in 12" :value="item">{{item}}개월</option>
                                            </select>
                                        </div>
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>증빙자료 첨부(선택)</dt>
                                    <dd>
                                        <div id="addFile" class="addFile">
                                            <label class="btn" for="school_file">파일 첨부</label>
                                            <span>{{career.upfile ? career.upfile.name : '증빙자료 파일 첨부'}}</span>
                                            <input type="file" id="school_file" style="display: none;" @change="jl.changeFile($event,career,'upfile')">
                                        </div>
                                    </dd>
                                </dl>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" @click="postCareer()">적용</button>
                        </div>
                    </div>
                </div>
            </div>
            -->
            <button class="btn btn_middle btn_blue2" @click="postCareer()">{{career.idx ? "수정" : "추가"}}</button>

            <br>
            <div class="career_list">
                <template v-for="item in careers">
                    <span>
                        <h3>
                            <b>{{item.content}}</b>
                            <a class="modify" @click="putCareer(item)">수정</a>
                            <a class="del" href="" @click="event.preventDefault(); deleteCareer(item);"><i class="fa-light fa-xmark"></i></a>
                        </h3>
                        <p class="addr">{{item.address}}</p>
                        <p class="date">{{item.start_date}}~{{item.end_date}}</p>
                        <a class="file" v-if="item.upfile" :download="item.upfile.name" :href="jl.root+item.upfile.src">
                            <i class="fa-light fa-paperclip"> </i>{{item.upfile.name}}
                        </a>
                        
                    </span>
                </template>
            </div>

    </section>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            user: {type: Object, default: {}}
        },
        data: function () {
            return {
                jl: null,
                filter: {
                    member_idx : this.user.mb_no
                },
                data: {},
                modal: false,
                career : {
                    member_idx : this.user.mb_no,
                    free : "",
                    name : "",
                    dept : "",
                    position : "",
                    address : "",
                    year : "",
                    month : "",
                    upfile : ""
                },
                careers : [],

                areas : [
                    "서울특별시",
                    "부산광역시",
                    "대구광역시",
                    "인천광역시",
                    "광주광역시",
                    "대전광역시",
                    "울산광역시",
                    "세종특별자치시",
                    "경기도",
                    "강원도",
                    "충청북도",
                    "충청남도",
                    "전라북도",
                    "전라남도",
                    "경상북도",
                    "경상남도",
                    "제주특별자치도",
                    "해외"
                ],
            };
        },
        created: function () {
            this.jl = new Jl('<?=$componentName?>');
            this.getCareer();
        },
        mounted: function () {
            this.$nextTick(() => {

            });
        },
        methods: {
            putCareer(item) {
                this.career = item;
            },
            async deleteCareer(career) {
                var res = await this.jl.ajax("delete",career,"/api/member_career.php");

                if(res) {
                    this.getCareer();
                }
            },
            async postCareer() {
                var method = this.career.idx ? "update" : "insert";
                var obj = this.jl.copyObject(this.career);

                var res = await this.jl.ajax(method,obj,"/api/member_career.php");

                if (res) {
                    console.log(res)

                    this.career = this.jl.initObject(this.career);
                    this.career.member_idx = this.user.mb_no;
                    this.getCareer()
                    this.modal = false;
                }
            },
            async getCareer() {
                var res = await this.jl.ajax("get",this.filter,"/api/member_career.php");

                if (res) {
                    this.careers = res.response.data
                }
            }
        },
        computed: {},
        watch: {}
    });
</script>

<style>

</style>