<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <section id="profile04">
        <div>
            <h4>학력전공</h4>
            <label for="">학력 · 전공</label>
            <input type="text" name="" id="" placeholder="추가해주세요" @click="modal = true;"/>
            <br><br>
            <!-- 학력 전공 등록 모달 -->
            <div class="modal fade" :class="{'in' : modal}" id="educationModal" tabindex="-1" :style="{display : modal ? 'block' : 'none'}" @click.self="modal = false;">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="modal = false"><i class="fa-light fa-close"></i></button>
                            <h5 class="modal-title" id="educationModalLabel">학력 · 전공</h5>
                        </div>
                        <div class="modal-body">
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
                                    <li>증빙 자료 첨부하시면 담당자 검토후 확인 마크<i class="fa-sharp fa-solid fa-badge-check"></i>를 달아드립니다.</li>
                                    <li><strong>첨부가능자료 : 재학증명서, 졸업증명서,성적증명서</strong></li>
                                </ul>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>-->
                            <button type="button" class="btn btn-primary" @click="postSchool">적용</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 학력 전공 리스트 -->
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
            <label for="">보유 자격증</label>
            <input type="text" name="" id="" placeholder="추가해주세요" @click="modal2 = true;"/>
            <br><br>
            <!-- 학력 전공 등록 모달 -->
            <div class="modal fade" :class="{'in' : modal2}" tabindex="-1" :style="{display : modal2 ? 'block' : 'none'}" @click.self="modal2 = false;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa-light fa-close"></i></button>
                            <h5 class="modal-title" id="licenseModalLabel">보유 자격증</h5>
                        </div>
                        <div class="modal-body">
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
                        </div>
                        <div class="modal-footer">
                            <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>-->
                            <button type="button" class="btn btn-primary" @click="postCertify">적용</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 학력 전공 리스트 -->
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
                    member_idx : this.user.mb_no
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
            this.jl = new JL('<?=$componentName?>');
            this.getSchool();
            this.getCertify();
        },
        mounted: function(){
            this.$nextTick(() => {

            });
        },
        methods: {
            deleteSchool : function(idx) {
                var method = "delete";
                var filter = {idx : idx }

                var objs = {_method: method};
                objs = this.jl.processObject(objs,filter);
                console.log(objs);
                var res = ajax("/api/member_school.php", objs);

                if(res) {
                    this.jl.log(res);
                    this.getSchool();
                }
            },
            postSchool : function() {
                var method = this.school.idx ? "update" : "insert";
                var obj = this.jl.copyObject(this.school);

                var objs = {_method: method};
                objs = this.jl.processObject(objs,obj);

                var res = ajax("/api/member_school.php", objs);
                if (res) {
                    this.jl.log(res)
                    alert("추가되었습니다.")
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
            deleteCertify : function(idx) {
                var method = "delete";
                var filter = {idx : idx }

                var objs = {_method: method};
                objs = this.jl.processObject(objs,filter);
                console.log(objs);
                var res = ajax("/api/member_certify.php", objs);

                if(res) {
                    this.jl.log(res);
                    this.getCertify();
                }
            },
            postCertify : function() {
                var method = this.certify.idx ? "update" : "insert";
                var obj = this.jl.copyObject(this.certify);

                var objs = {_method: method};
                objs = this.jl.processObject(objs,obj);

                var res = ajax("/api/member_certify.php", objs);
                if (res) {
                    this.jl.log(res)
                    alert("추가되었습니다.")
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
            getSchool: function () {
                var method = "get";
                var filter = JSON.parse(JSON.stringify(this.filter));

                var objs = {
                    _method: method,
                    filter: JSON.stringify(filter)
                };

                var res = ajax("/api/member_school.php", objs);
                if (res) {
                    this.jl.log(res)
                    this.schools = res.response.data
                }
            },
            getCertify: function () {
                var method = "get";
                var filter = JSON.parse(JSON.stringify(this.filter));

                var objs = {_method: method};
                objs = this.jl.processObject(objs,filter);

                var res = ajax("/api/member_certify.php", objs);
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