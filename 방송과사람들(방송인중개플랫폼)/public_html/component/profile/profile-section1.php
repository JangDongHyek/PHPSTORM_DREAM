<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <section id="profile01">
        <div>
            <h4>기본정보</h4>
            <dl>
                <dt>자기 소개 문구</dt>
                <dd><textarea placeholder="자기소개문구를 입력해주세요" v-model="user.self_content"></textarea></dd>
            </dl>

            <dl>
                <dt>채팅 가능 시간 설정</dt>
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
            <dl><dt class="flex"><strong>근무지역 (*최대 3개까지 선택가능)</strong> <a href="" class="del">전체삭제</a></dt>
                <dd class="flex">
                    <input type="text" v-model="temp" placeholder="지역입력후 추가 버튼을 눌러주세요">
                    <button class="btn btn_blue2" @click="addArea()">추가</button>
                </dd>
                <dd class="tag">
                    <span v-for="item,index in user.work_area">{{item}}<a class="del" @click="user.work_area.splice(index,1)"><i class="fa-light fa-xmark"></i></a></span>
                </dd>
            </dl>
            <dl>
                <dt>상주 여부</dt>
                <dd>
                    <input type="radio" id="available" name="residence" v-model="user.work_stay" value="true"><label for="available">가능</label>
                    <input type="radio" id="not-available" name="residence" v-model="user.work_stay" value="false"><label for="not-available">불가능</label>
                </dd>
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
                data : {},

                temp : "",
            };
        },
        created: function(){
            this.jl = new Jl('<?=$componentName?>');
        },
        mounted: function(){
            this.$nextTick(() => {

            });
        },
        methods: {
            addArea() {
                if(this.temp.trim() == "") {
                    alert("근무 지역을 입력해주세요.");
                    return false;
                }

                if(this.user.work_area.length >= 3) {
                    alert("근무지역은 최대 3개까지입니다.");
                    return false;
                }

                this.user.work_area.push(this.temp);
                this.temp = "";
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