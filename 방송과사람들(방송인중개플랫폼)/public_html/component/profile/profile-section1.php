<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <section id="profile01">
        <div>
            <h4>기본정보</h4>
            <dl>
                <dt>닉네임</dt>
                <dd><input type="text" id="mb_nick" placeholder="활동명 or 회사명" v-model="user.mb_nick"></dd>
            </dl>
            <dl>
                <dt>연락 가능한 번호</dt>
                <dd><input type="text" id="" placeholder="000-0000-0000" v-model="user.job_phone" @input="user.job_phone = jl.formatPhone(user.job_phone)"></dd>
            </dl>

            <dl>
                <dt>연락 가능 시간 설정</dt>
                <dd>
                    <div class="flex">
                        <select name="call_hour_1" class="select text-center" v-model="user.job_sdate" title="시간">
                            <option :value="item.toString().padStart(2,'0')" v-for="item in 24">{{item.toString().padStart(2,'0')}}시</option>
                        </select>
                        <span>-</span>
                        <select name="call_hour_2" class="select text-center" v-model="user.job_edate" title="시간">
                            <option :value="item.toString().padStart(2,'0')" v-for="item in 24">{{item.toString().padStart(2,'0')}}시</option>
                        </select>

                </dd>
            </dl>
            <dl>
                <dt>안심번호</dt>
                <dd><input type="text" placeholder="서비스를 등록하시면 자동으로 부여됩니다." disabled></dd>
            </dl>
            <dl>
                <dt>안심번호 공개여부</dt>
                <dd class="select">
                    <input type="radio" id="only_clients" name="security_number" disabled>
                    <label for="only_clients">내 서비스를 결제한 의뢰인에게만 공개</label>
                    <input type="radio" id="all_members" name="security_number" disabled>
                    <label for="all_members">미결제 회원에게도 공개</label>
                </dd>
            </dl>
        </div>
        <div>
            <h4>인증정보</h4>
            <dl>
                <dt>실명</dt>
                <dd><input type="text" id="" placeholder="실명 입력" v-model="user.mb_name"></dd>
            </dl>
            <dl>
                <dt>주민등록번호</dt>
                <dd><input type="text" id="" maxlength="13" v-model="user.regi_number" placeholder="주민등록번호 입력"></dd>
            </dl>
            <dl>
                <dt>은행</dt>
                <dd>
                    <select v-model="user.bank_name">
                        <option>토스뱅크</option>
                    </select>
                </dd>
            </dl>
            <dl>
                <dt>수입금 출금 계좌</dt>
                <dd><input type="text" id="" v-model="user.bank_number" maxlength="13" placeholder="수입금 출금 계좌 입력"></dd>
            </dl>
        </div>
    </section>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            user : {type : Object, default : {}}
        },
        data: function(){
            return {
                jl : null,
                filter : {

                },
                data : {
                    mb_nick : "",
                    job_phone : "",     //new
                    job_sdate : "",     //new
                    job_edate : "",     //new
                    mb_name : "",
                    regi_number : "",   //new
                    bank_name : "",     //new
                    bank_number : "",   //new
                },
            };
        },
        created: function(){
            this.jl = new JL('<?=$componentName?>');
        },
        mounted: function(){
            this.$nextTick(() => {

            });
        },
        methods: {
            getData: function () {
                var method = "get";
                var filter = JSON.parse(JSON.stringify(this.filter));

                var objs = {
                    _method: method,
                    filter: JSON.stringify(filter)
                };

                var res = ajax("/api/example.php", objs);
                if (res) {
                    this.jl.log(res)
                    this.data = res.response.data
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