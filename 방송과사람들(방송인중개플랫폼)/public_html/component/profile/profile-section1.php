<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <section id="profile01">
        <div>
            <h4>활동정보</h4>
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
            <dl><dt class="flex"><strong>근무가능지역 (*최대 3개까지 선택가능)</strong> <a href="" class="del">전체삭제</a></dt>
                <dd>
                    <div id="item_write" class="box_write">
                        <h5>지역</h5>
                        <div class="cont box">
                            <input type="checkbox" :disabled="user.work_area.includes('선택안함')" v-model="user.work_area" value="국내" id="domestic" name="location"><label for="domestic">국내</label>
                            <input type="checkbox" :disabled="user.work_area.includes('선택안함')" v-model="user.work_area" value="해외" id="overseas" name="location"><label for="overseas">해외</label>
                            <input type="checkbox" :disabled="user.work_area.includes('선택안함')" v-model="user.work_area" value="협의가능" id="overseas1" name="location"><label for="overseas1">협의가능</label>
                            <input type="checkbox" @click="user.work_area = [];" v-model="user.work_area" value="선택안함" id="overseas2" name="location"><label for="overseas2">선택안함</label>
                        </div>
                    </div>

                    <div id="item_write" class="box_write" v-if="user.work_area.includes('국내')">
                        <h5>상세지역</h5>
                        <div class="cont box">
                            <template v-for="region,rindex in regions">
                                <input type="checkbox" :disabled="user.work_region.includes('전국')" v-model="user.work_region" :value="region" :id="'rindex'+rindex" name="location"><label :for="'rindex'+rindex">{{region}}</label>
                            </template>
                            <input type="checkbox" @click="user.work_region = [];" v-model="user.work_region" value="전국" id="rindex15111" name="location"><label for="rindex15111">전국</label>
                        </div>
                    </div>
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
                regions : ["서울", "경기", "인천", "강원", "대전", "세종", "충남", "충북", "부산", "울산", "경남", "경북", "대구", "광주", "전남", "전북", "제주"],
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