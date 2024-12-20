<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <section id="profile04">
        <div>
            <h4>학력전공</h4>
            <dl>
                <dt>학교명</dt>
                <dd><input type="text" id="" placeholder="학교명 입력" v-model="school.name"></dd>
            </dl>
            <dl>
                <dt>전공</dt>
                <dd><input type="text" id="" placeholder="전공 입력" v-model="school.major"></dd>
            </dl>
            <dl>
                <dt>상태</dt>
                <dd>
                    <select v-model="school.state">
                        <option value="이수">이수</option>
                        <option value="졸업">졸업</option>
                        <option value="재학">재학</option>
                        <option value="휴학">휴학</option>
                    </select>
                </dd>
            </dl>
            <dl>
                <dt>증빙자료 첨부(선택)</dt>
                <dd>
                    <div id="addFile" class="addFile">
                        <label class="btn" for="school_file">파일 첨부</label>
                        <span>{{school.upfile ? school.upfile.name : '증빙자료 파일 첨부'}}</span>
                        <input type="file" id="school_file" style="display: none;" @change="updateSchoolFile">
                    </div>
                </dd>
            </dl>
            <div class="box_blue" id="tip">
                <p>TIP</p>
                <ul>
                    <li>증빙 자료 첨부하시면 담당자 검토후 확인 마크<i class="fa-solid fa-badge-check"></i>를 달아드립니다.</li>
                    <li><strong>첨부가능자료 : 재학증명서, 졸업증명서,성적증명서</strong></li>
                </ul>
            </div>
            <button class="btn btn_middle btn_blue2" @click="postSchool">등록 및 추가</button>
            <hr>
            <br>

            <br>
            <div class="tag">
                <template v-for="item in schools">
                    <span>{{item.name}}·{{item.major}}·{{item.state}}·
                        <i class="fa-light fa-paperclip" v-if="item.file"></i>
                        <a href="" @click="event.preventDefault(); deleteSchool(item.idx);" class="del"><i class="fa-light fa-xmark"></i></a>
                    </span>
                </template>
            </div>

        </div>
        <div>
            <h4>보유 자격증</h4>
            <br>
            <dl>
                <dt>자격증명</dt>
                <dd><input type="text" id="" placeholder="자격증명 입력" v-model="certify.name"></dd>
            </dl>
            <dl>
                <dt>발급기관</dt>
                <dd><input type="text" id="" placeholder="발급기관 입력" v-model="certify.agency"></dd>
            </dl>
            <dl>
                <dt>발급일</dt>
                <dd><input type="date" v-model="certify.issue_date"></dd>
            </dl>
            <dl>
                <dt>증빙자료 첨부(선택)</dt>
                <dd>
                    <div id="addFile" class="addFile">
                        <label class="btn" for="certify_file">파일 첨부</label>
                        <span>{{certify.upfile ? certify.upfile.name : '증빙자료 파일 첨부'}}</span>
                        <input type="file" id="certify_file" style="display: none;" @change="updateCertifyFile">
                    </div>
                </dd>
            </dl>
            <div class="box_blue" id="tip">
                <p>TIP</p>
                <ul>
                    <li>증빙 자료 첨부하시면 담당자 검토후 확인 마크<i class="fa-sharp fa-solid fa-badge-check"></i>를 달아드립니다.</li>
                    <li><strong>첨부가능자료 : 자격증사본</strong></li>
                </ul>
            </div>
            <button class="btn btn_middle btn_blue2" @click="postCertify">등록 및 추가</button>
            <br>

            <div class="tag">
                <template v-for="item in certifies">
                    <span>{{item.name}}·{{item.agency}}·{{item.issue_date}}·
                        <i class="fa-light fa-paperclip" v-if="item.upfile"></i>
                        <a class="del" href="" @click="event.preventDefault(); deleteCertify(item.idx);"><i class="fa-light fa-xmark"></i></a>
                    </span>
                </template>
            </div>


        </div>
    </section>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            user: {type: Object, default: {}}
        },
        data: function(){
            return {
                jl : null,
                filter : {
                    member_idx : this.user.mb_no,
                    approval : '1'
                },
                data : {

                },

                modal : false,
                school : {
                    idx : "",
                    member_idx : this.user.mb_no,
                    name : "",
                    major : "",
                    state : "",
                    upfile : "",
                    mark : false
                },
                schools : [],

                modal2 : false,
                certify : {
                    idx : "",
                    member_idx : this.user.mb_no,
                    name : "",
                    agency : "",
                    issue_date : "",
                    upfile : "",
                    mark : false,
                },
                certifies : [],
            };
        },
        created: function(){
            this.jl = new Jl('<?=$componentName?>');
            this.getSchool();
            this.getCertify();
        },
        mounted: function(){
            this.$nextTick(() => {

            });
        },
        methods: {
            async deleteSchool(idx) {
                if(!confirm("삭제하시겠습니까? 해당 데이터는 삭제시 바로 삭제됩니다.")) return false;
                var method = "delete";
                var filter = {idx : idx }

                var res = await this.jl.ajax(method,filter,"/api/member_school.php");

                if(res) {
                    this.jl.log(res);
                    this.getSchool();
                }
            },
            async postSchool() {
                var method = this.school.idx ? "update" : "insert";
                var obj = this.jl.copyObject(this.school);

                var res = await this.jl.ajax(method,obj,"/api/member_school.php");
                if (res) {
                    this.jl.log(res)
                    alert("추가되었습니다. 승인 완료가 되면 노출됩니다.")
                    this.school = this.jl.initObject(this.school)
                    this.school.member_idx = this.user.mb_no;
                    this.getSchool();
                    this.modal = false;
                }
            },
            updateSchoolFile : function() {
                const file = event.target.files[0];
                if (file) {
                    this.school.upfile = file;
                } else {
                    this.school.upfile = '';
                }
            },
            async deleteCertify(idx) {
                if(!confirm("삭제하시겠습니까? 해당 데이터는 삭제시 바로 삭제됩니다.")) return false;
                var method = "delete";
                var filter = {idx : idx }

                var res = await this.jl.ajax(method,filter,"/api/member_certify.php");

                if(res) {
                    this.jl.log(res);
                    this.getCertify();
                }
            },
            async postCertify() {
                var method = this.certify.idx ? "update" : "insert";
                var obj = this.jl.copyObject(this.certify);

                var res = await this.jl.ajax(method,obj,"/api/member_certify.php");
                if (res) {
                    this.jl.log(res)
                    alert("추가되었습니다. 승인 완료가 되면 노출됩니다.")
                    this.certify = this.jl.initObject(this.certify)
                    this.certify.member_idx = this.user.mb_no;
                    this.getCertify();
                    this.modal2 = false;
                }
            },
            updateCertifyFile : function() {
                const file = event.target.files[0];
                if (file) {
                    this.certify.upfile = file;
                } else {
                    this.certify.upfile = '';
                }
            },
            async getSchool() {
                var method = "get";
                var filter = JSON.parse(JSON.stringify(this.filter));

                var res = await this.jl.ajax(method,filter,"/api/member_school.php");
                if (res) {
                    this.jl.log(res)
                    this.schools = res.response.data
                }
            },
            async getCertify() {
                var method = "get";
                var filter = JSON.parse(JSON.stringify(this.filter));

                var res = await this.jl.ajax(method,filter,"/api/member_certify.php");
                if (res) {
                    this.jl.log(res)
                    this.certifies = res.response.data
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