<?php $componentName = str_replace(".php", "", basename(__FILE__)); ?>
<script type="text/x-template" id="<?= $componentName ?>-template">
    <section id="profile07">
        <div>
            <h4>상주 가능 여부를 선택해 주세요</h4>
            <dl>
                <dd>
                    <select v-model="user.job_work_stay">
                        <option value="상주 가능">상주 가능</option>
                        <option value="상주 불가능">상주 불가능</option>
                    </select>
                </dd>
            </dl>
            <!--상주 가능 선택시-->
            <template v-if="user.job_work_stay == '상주 가능'">
                <dl>
                    <dt>희망 근무 형태</dt>
                    <dd class="flex select">
                        <input type="checkbox" id="check1" v-model="user.job_work_form" value="파트타임"><label
                                for="check1">파트타임</label>&nbsp;
                        <input type="checkbox" id="check2" v-model="user.job_work_form" value="풀타임"><label for="check2">풀타임</label>
                    </dd>
                </dl>
                <dl>
                    <dt>희망 근무지</dt>
                    <dd>
                        <select v-model="user.job_work_address">
                            <option>서대문/마포/은평</option>
                        </select>
                    </dd>
                </dl>
                <dl>
                    <dt>현재 상태</dt>
                    <dd>
                        <select v-model="user.job_work_status">
                            <option>프로젝트 찾는 중</option>
                            <option>프로젝트 투입 중</option>
                        </select>
                    </dd>
                </dl>
                <dl>
                    <dt>근무 시작 가능일</dt>
                    <dd>
                        <input type="date" v-model="user.job_work_date">
                    </dd>
                </dl>
                <dl>
                    <dt>희망 월급</dt>
                    <dd class="flex">
                        <div class="input-container">
                            <div class="input-wrapper">
                                <input type="text" placeholder="최소(천원단위)" v-model="user.job_work_smonth"
                                       @input="user.job_work_smonth = jl.formatNumber(user.job_work_smonth)"/>
                                <span class="unit">원</span>
                            </div>
                            <span v-if="checkMonth(user.job_work_smonth)" class="warning-message1SS2">
                                희망 월급을 최소 1만원이상 ~ 99,999,000원 이하, 천원 단위로 입력해 주세요.
                            </span>
                        </div>
                        <span>~</span>
                        <div class="input-container">
                            <div class="input-wrapper">
                                <input type="text" placeholder="최대(천원단위)" v-model="user.job_work_emonth"
                                       @input="user.job_work_emonth = jl.formatNumber(user.job_work_emonth)"/>
                                <span class="unit">원</span>
                            </div>
                            <span v-if="checkMonth(user.job_work_emonth)" class="warning-message1SS2">
                                희망 월급을 최소 1만원이상 ~ 99,999,000원 이하, 천원 단위로 입력해 주세요.
                            </span>
                        </div>
                    </dd>
                </dl>
            </template>
            <!--상주 가능 선택시-->
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
                filter: {},
                data: {
                    job_work_stay: "",
                    job_work_form: [],
                    job_work_address: "",
                    job_work_status: "",
                    job_work_date: "",
                    job_work_smonth: "",
                    job_work_emonth: "",
                },
            };
        },
        created: function () {
            this.jl = new Jl('<?=$componentName?>');
        },
        mounted: function () {
            this.$nextTick(() => {

            });
        },
        methods: {
            checkMonth : function(value) {
                var number = parseInt(value);

                if(isNaN(number)) return false;
                if(number < 10000) return true;
                if(number > 99999000) return true;
                if(number % 1000 === 0) return false;
                else return true;
            },
        },
        computed: {

        },
        watch: {}
    });
</script>

<style>
    .warning-message1SS2 {
        color: red;
        font-size: 12px;
        font-weight: bold;
        border: 1px solid red;
        padding: 5px;
        margin: 10px 0;
        background-color: #ffe6e6;
        width: fit-content;
    }

    .input-container {
        display: flex;
        flex-direction: column;
        flex: 1;
        position: relative;
    }
    .input-wrapper {
        display: flex;
        align-items: center;
    }
    .input-wrapper input {
        width: 100%;
        box-sizing: border-box;
        padding-right: 30px; /* "원" 텍스트 공간 확보 */
        height: 36px; /* 원하는 높이로 설정 */
        line-height: 36px; /* input 높이와 맞추기 */
    }
    .input-wrapper .unit {
        position: absolute;
        right: 10px;
        pointer-events: none; /* 텍스트가 클릭을 차단하지 않도록 */
        line-height: 36px; /* input 높이와 맞추기 */
    }
    dd.flex {
        display: flex;
        align-items: center; /* baseline을 center로 변경 */
        width: 100%;
    }
</style>