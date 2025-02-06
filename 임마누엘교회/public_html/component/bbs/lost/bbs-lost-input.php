<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
        <div class="box_radius box_white table">
            <span class="txt_color">*</span> <span class="txt_gray">표시된 항목은 필수기입 항목입니다.</span>
            <div class="table">
                <table>
                    <tbody>
                    <tr class="top">
                        <td>품목 <span class="txt_color">*</span></td>
                        <td>
                            <input type="text" v-model="data.wr_3">
                        </td>
                    </tr>
                    <tr class="top">
                        <td>{{wr_2}}장소 <span class="txt_color">*</span></td>
                        <td>
                            <input type="text" v-model="data.wr_4">
                        </td>
                    </tr>
                    <tr class="top">
                        <td>{{wr_2}}일시 <span class="txt_color">*</span></td>
                        <td>
                            <div class="date-container">
                                <input type="date" class="date-input" :class="{'filled' : data.wr_5_focus}" @focus="data.wr_5_focus = true" aria-label="날짜 선택" v-model="data.wr_5" />
                                <label for="date-input" class="date-placeholder-label">{{data.wr_5 ? data.wr_5 : '날짜를 선택해주세요'}}</label>
                            </div>
                            <div class="date-container">
                                <input type="time" class="time-input" :class="{'filled' : data.wr_6_focus}" @focus="data.wr_6_focus = true" v-model="data.wr_6"/>
                                <label for="date-input" class="date-placeholder-label">{{data.wr_6 ? data.wr_6 : '시간을 선택해주세요'}}</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>특징 <span class="txt_color" v-if="wr_2 == '분실'">*</span></td>
                        <td>
                            <input type="text" placeholder="최대한 자세히 작성해주세요" v-model="data.wr_7">
                        </td>
                    </tr>
                    <tr>
                        <td>사진</td>
                        <td>
                            <div class="flex gap5">
                                <div class="uploader" :style="{ background : data.wr_8 ? 'none' : 'initial;'}" @click="$refs.file1.click()">
                                    사진 선택
                                    <template v-if="data.wr_8">
                                        <img v-if="data.wr_8.src" :src="jl.root+data.wr_8.src">
                                        <img v-else :src="data.wr_8.preview">
                                    </template>
                                    <input type="file" ref="file1" style="display: none;" @change="jl.changeFile($event,data,'wr_8')">
                                </div>

                                <div class="uploader" :style="{ background : data.wr_9 ? 'none' : 'initial;'}" @click="$refs.file2.click()">
                                    사진 선택
                                    <template v-if="data.wr_9">
                                        <img v-if="data.wr_9.src" :src="jl.root+data.wr_9.src">
                                        <img v-else :src="data.wr_9.preview">
                                    </template>
                                    <input type="file" ref="file2" style="display: none;" @change="jl.changeFile($event,data,'wr_9')">
                                </div>

                                <div class="uploader" :style="{ background : data.wr_10 ? 'none' : 'initial;'}" @click="$refs.file3.click()">
                                    사진 선택
                                    <template v-if="data.wr_10">
                                        <img v-if="data.wr_10.src" :src="jl.root+data.wr_10.src">
                                        <img v-else :src="data.wr_10.preview">
                                    </template>
                                    <input type="file" ref="file3" style="display: none;" @change="jl.changeFile($event,data,'wr_10')">
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>{{wr_2}}인 <span class="txt_color">*</span></td>
                        <td>
                            <input type="text" v-model="data.wr_11">
                        </td>
                    </tr>
                    <tr>
                        <td>연락처</td>
                        <td>
                            <input type="text" placeholder="" v-model="data.wr_12">
                        </td>
                    </tr>
                    <tr v-if="wr_2 == '분실'">
                        <td>교구/속</td>
                        <td>
                            <input type="text" placeholder="교회를 통해 연락 받길 원하면 작성해주세요" v-model="data.wr_13">
                        </td>
                    </tr>

                    <tr v-else>
                        <td>보관장소 <span class="txt_color">*</span></td>
                        <td>
                            <div class="gap5 select nowrap">
                                <input type="radio" name="state" id="s1" value="2층 사무실" v-model="data.wr_13">
                                <label class="w100" for="s1">2층 사무실</label>
                                <input type="radio" name="state" id="s2" value="경비실" v-model="data.wr_13">
                                <label class="w100" for="s2">경비실</label>
                                <input type="radio" name="state" id="s3" value="습득인 보관" v-model="data.wr_13">
                                <label class="w100" for="s3">습득인 보관</label>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <br>
            <button type="button" class="btn btn_color btn-large" @click="postBoard();">{{primary ? '수정하기' : '등록하기'}}</button>
        </div>
</script>

<script>
    Jl_components.push({name : "<?=$componentName?>",object : {
            template: "#<?=$componentName?>-template",
            props: {
                mb_no : {type: String, default: ""},
                wr_2 : {type: String, default: ""},
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

                    data: {
                        wr_1 : this.mb_no, // 유저 고유값
                        wr_2 : this.wr_2, // 분실,습득
                        wr_3 : "", // 품목
                        wr_4 : "", // 분실장소 || 습득장소
                        wr_5 : "", // 분실일 || 습득일
                        wr_6 : "", // 분실시간 || 습득시간
                        wr_7 : "", // 특징
                        wr_8 : "", // 사진1
                        wr_9 : "", // 사진2
                        wr_10 : "", // 사진3
                        wr_11 : "", // 분실인 || 습득인
                        wr_12 : "", // 연락처
                        wr_13 : "", // 교구/속 || 보관장소
                    },
                };
            },
            async created() {
                this.jl = new Jl('<?=$componentName?>');
                this.component_idx = this.jl.generateUniqueId();

                if(this.primary) await this.getBoard();
            },
            mounted() {
                this.$nextTick(() => {

                });
            },
            updated() {

            },
            methods: {
                async postBoard() {
                    let method = this.primary ? "update" : "insert";

                    let data = {
                        table: "g5_write_lost",
                        file_use : true
                    }

                    // object의 필수값을 설정하는 option
                    let required = [
                        {name : "wr_1",message : "로그인이 필요한 기능입니다."},
                        {name : "wr_2",message : "잘못된 접근입니다."},
                        {name : "wr_3",message : "품목은 필수값입니다."},
                        {name : "wr_4",message : `${this.wr_2}장소는 필수값입니다.`},
                        {name : "wr_5",message : `${this.wr_2}일자는 필수값입니다.`},
                        {name : "wr_6",message : `${this.wr_2}시간은 필수값입니다.`},
                        {name : "wr_11",message : `${this.wr_2}인은 필수값입니다.`},
                    ]
                    
                    if(this.wr_2 == '습득') {
                        required.push({name : "wr_13",message : "보관장소는 필수값입니다."})
                    }else {
                        required.push({name : "wr_7",message : "특징은 필수값입니다."})

                    }
                    let options = {required : required};

                    if (this.data) data = Object.assign(data, this.data); // paging 객체가있다면 병합

                    try {
                        let res = await this.jl.ajax(method, data, "/jl/JlApi.php",options);
                        await this.jl.alert("완료되었습니다.");
                        window.location.href="./lost";
                    } catch (e) {
                        await this.jl.alert(e.message)
                    }

                },
                async getBoard() {
                    let filter = {
                        table: "g5_write_lost",
                        primary : this.primary
                    }

                    if (this.paging) filter = Object.assign(filter, this.paging); // paging 객체가있다면 병합

                    try {
                        let res = await this.jl.ajax("get", filter, "/jl/JlApi.php");
                        this.data = res.data[0]
                        this.paging.count = res.count;
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