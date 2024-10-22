<?
include_once("./_common.php");
$g5['title'] = '삼삼 CLASS';
$co_id = 'class';
include_once(G5_PATH.'/_head.php');
?>
    <div class="area_expert" id="app">
        <h2 class="title">삼삼CLASS 신청하기</h2>
        <div class="expert_form">
            <form>
                <div class="form_wrap">
                    <div class="form">
                        <dl>
                            <dt><label for="wr_name">이름<strong class="sound_only">*</strong></label></dt>
                            <dd><input type="text" v-model="data.name" name="aa" required="" size="10" maxlength="20"></dd>
                        </dl>
                        <dl class="flex">
                            <dt>성별<strong class="sound_only">*</strong></dt>
                            <dd>
                                <input type="radio" id="gender_female" v-model="data.gender" name="gender" value="여성"><label for="gender_female">여성</label>
                                <input type="radio" id="gender_male" v-model="data.gender" name="gender" value="남성"><label for="gender_male">남성</label>
                            </dd>
                        </dl>
                        <dl>
                            <dt><label for="contact">연락처<strong class="sound_only">*</strong></label></dt>
                            <dd><input type="text" id="contact" v-model="data.phone" name="contact" placeholder="연락처"></dd>
                        </dl>
                        <!--
                        <dl>
                            <dt><label for="email">이메일<strong class="sound_only">*</strong></label></dt>
                            <dd><input type="text" id="email" v-model="data.email" name="email" placeholder="이메일"></dd>
                        </dl>
                        <dl>
                            <dt><label for="birthdate">생년월일<strong class="sound_only">*</strong></label></dt>
                            <dd><input type="date" id="birthdate" v-model="data.birth" name="birthdate" placeholder="생년월일"></dd>
                        </dl>
                        -->
                        <dl>
                            <dt><label for="address">주소<strong class="sound_only">*</strong></label></dt>
                            <dd><input type="text" id="address" v-model="data.address" name="address" placeholder="시(서울시는 구까지 입력 부탁드립니다)"></dd>
                        </dl>
                        <dl>
                            <dt><label for="occupation">직업<strong class="sound_only">*</strong></label></dt>
                            <dd><input type="text" id="occupation" v-model="data.job" name="occupation" placeholder="직업"></dd>
                        </dl>
                        <dl>
                            <dt><label for="amount">투자가능금액<strong class="sound_only">*</strong></label></dt>
                            <dd><input type="text" id="amount" v-model="data.amount" name="amount" placeholder="금액"></dd>
                        </dl>
                        <dl>
                            <dt><label for="etc">문의사항<strong class="sound_only">*</strong></label></dt>
                            <dd><textarea id="etc" v-model="data.etc"></textarea></dd>
                        </dl>
                    </div>
                </div>
                <div class="btn_confirm">
                    <input type="button" @click="postData" value="클래스 신청" id="btn_submit" accesskey="s" class="btn_submit">
                    <a href="<?php echo  G5_BBS_URL?>/class.list.php" class="btn_cancel">취소</a>
                </div>
            </form>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/vue@2.7.16"></script>

<script>
// Vue 인스턴스 생성
document.addEventListener('DOMContentLoaded', function(){
    new Vue({
        el: '#app',
        data: {
            idx : "<?=$_GET['id']?>",
            base_url : "<?=G5_URL?>",
            data : {
                class_idx : "",
                name : "",
                gender : "",
                phone : "",
                email : "",
                birth : "",
                address : "",
                etc : "",
                amount : "",
                job : ""
            },
            datas : [],
            filter : [],
            total : [],
            checks : [],
            all_check : false,
        },
        created : function() {
            if(!this.idx) {
                alert("잘못된 경로입니다.")
                history.back();
            }

            this.data.class_idx = this.idx;
        },
        mounted : function() {
            
        },
        methods: {
            postData : function() {
                if(this.data.name.trim() == "") {
                    alert("이름을 입력해주세요.");
                    return false;
                }

                if(this.data.gender == "") {
                    alert("성별을 선택 해주세요.");
                    return false;
                }

                if(this.data.phone.trim() == "") {
                    alert("연락처를 입력해주세요.");
                    return false;
                }

                /*
                if(this.data.email.trim() == "") {
                    alert("이메일을 입력해주세요.");
                    return false;
                }

                if(this.data.birth.trim() == "") {
                    alert("생년월일을 입력해주세요.");
                    return false;
                }*/

                if(this.data.address.trim() == "") {
                    alert("주소를 입력해주세요.");
                    return false;
                }

                if(this.data.job.trim() == "") {
                    alert("직업을 입력해주세요.");
                    return false;
                }

                if(this.data.amount.trim() == "") {
                    alert("투자가능금액을 입력해주세요.");
                    return false;
                }

                var method = "post";
                var obj = JSON.parse(JSON.stringify(this.data));
                

                var objs = {
                    _method : method,
                    obj : JSON.stringify(obj),
                };

                var res = this.ajax(this.base_url + "/api/g5_class_request.php",objs);

                if(res) {
                    alert("신청이 완료되었습니다.");
                    window.location.href = this.base_url + "/bbs/class.register.list.php";
                }
            },
            deletesData : function() {
                var method = "deletes";

                if(this.checks.length <= 0) {
                    alert("하나 이상 선택하셔야합니다.");
                    return false;
                }

                var objs = {
                    _method : method,
                    arrays : JSON.stringify(this.checks)
                };

                var res = this.ajax(this.base_url + "/api/",objs);
                if(res) {
                    alert("삭제되었습니다.");
                    window.location.reload();
                }
            },
            getData : function() {
                var method = "get";

                var objs = {
                    _method : method,
                    _idx : this.idx
                };

                var res = this.ajax(this.base_url + "/api/g5_class.php",objs);
                if(res) {
                    console.log(res)
                    this.data = res.data;
                }
            },
            getsData : function() {
                var method = "gets";

                var objs = {
                    _method : method,
                    filter : this.filter
                };

                var res = this.ajax(this.base_url + "/api/",objs);
                if(res) {
                    console.log(res)
                    this.datas = res.datas.datas;
                    this.total = res.datas.count;
                }
            },
            ajax : function(url,objs) {
                var form = new FormData();
                if(url.indexOf(".php") == -1) url = url + ".php";
                for(var i in objs) {
                    form.append(i, objs[i]);
                }

                var result = null;
                $.ajax({
                    url : url,
                    method : "post",
                    enctype : "multipart/form-data",
                    processData : false,
                    contentType : false,
                    async : false,
                    cache : false,
                    data : form,
                    dataType : "json",
                    success: function(res){
                        if(!res.success) alert(res.message);
                        else {
                            result = res;

                            if(res.data) {
                                var obj = res.data;
                                for(field in obj) {
                                    if(field.indexOf("_id") !== -1) continue;
                                    try {
                                        obj[field] = JSON.parse(obj[field]);
                                    } catch (e) {

                                    }
                                }
                                res.data = obj;
                            }
                        }
                    }
                });

                return result;
            }
        },
        computed : {
        },
        watch : {
            all_check : function() {
                this.checks = [];

                if(this.all_check) {
                    this.datas.forEach((item) => {
                        this.checks.push(item._idx);
                    });
                }
            }
        }

    });
}, false);
</script>
<?
include_once(G5_PATH.'/_tail.php');
?>