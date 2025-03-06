<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div id="note" class="form">
        <div class="box_radius box_white table">
            <table>
                <tbody>
                <tr class="top">
                    <td>주일 말씀</td>
                    <td>
                        <input type="text" v-model="site_setting.note_day" readonly>
                        <button type="button" class="btn btn_colorline w100" @click="jl.open(video.wr_content)">설교영상 보기</button>
                    </td>
                </tr>
                <tr>
                    <td>이번주 결단</td>
                    <td>
                        <input type="text" v-model="site_setting.note_week" readonly>
                    </td>
                </tr>
                <tr>
                    <td>실천 기간</td>
                    <td>
                        <input type="date" v-model="site_setting.note_date" readonly>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">나의 결단내용 <span class="txt_color">*</span></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <p class="text_left">* 150자 내외로 작성할 수 있습니다.</p>
                        <textarea placeholder="내용을 입력하세요" v-model="board.wr_content"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>공개여부 <span class="txt_color">*</span></td>
                    <td>
                        <div class="gap5 select nowrap">
                            <input type="radio" name="view" id="v1" value="공개" v-model="board.wr_2">
                            <label class="w100" for="v1">공개</label>
                            <input type="radio" name="view" id="v2" value="비공개" v-model="board.wr_2">
                            <label class="w100" for="v2">비공개</label>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
            <br>
            <button type="button" class="btn btn_color btn-large" @click="postBoard()">등록하기</button>
        </div>
    </div>
</script>

<script>
    Jl_components.push({name : "<?=$componentName?>",object : {
            template: "#<?=$componentName?>-template",
            props: {
                primary : {type: String, default: ""},
                mb_no : {type: String, default: ""},
                mb_id : {type: String, default: ""},
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

                    board: {
                        wr_content : "",
                        wr_1 : this.mb_no,
                        wr_2 : "공개",
                    },

                    site_setting : {},

                    video : {},
                };
            },
            async created() {
                this.jl = new Jl('<?=$componentName?>');
                this.component_idx = this.jl.generateUniqueId();

                await this.getSiteSetting();
                await this.getVideo();
            },
            mounted() {
                this.$nextTick(() => {

                });
            },
            updated() {

            },
            methods: {
                async postBoard() {
                    if(!this.mb_no) {
                        await this.jl.alert("로그인이 필요한 기능입니다.");
                        return false;
                    }

                    // object의 필수값을 설정하는 option
                    let required = [
                        {name : "wr_content",message : "내용을 입력해주세요."},
                    ]
                    let options = {required : required};

                    let method = this.primary ? "update" : "insert";
                    let data = {
                        table: "g5_write_note",
                        wr_subject : this.site_setting.note_week
                    }

                    if (this.board) data = Object.assign(data, this.board); // paging 객체가있다면 병합

                    try {
                        let res = await this.jl.ajax(method, data, "/jl/JlApi.php",options);

                        if(res.success) {

                            let week = this.getWeekRange();
                            let week_data = await this.jl.getData({
                                table : "g5_write_note",
                                wr_1 : this.mb_no,
                                between : [
                                    {key : "wr_datetime", start : week.firstDay.format(), end: week.lastDay.format()}
                                ],
                                where : [
                                    {key : "primary", value : res.primary, operator : "AND NOT"}
                                ],
                            });

                            if(!week_data) {
                                await this.jl.ajax("point",{table : "g5_point",mb_id : this.mb_id, point : 100,content:"결단노트"},"/jl/JlApi.php");
                            }

                            await this.jl.alert("완료되었습니다.");
                            window.location.href="./note";
                        }


                    } catch (e) {
                        await this.jl.alert(e.message)
                    }

                },
                async getVideo() {
                    let filter = {
                        table: "g5_write_video",
                        order_by_desc : "wr_id",
                    }

                    try {
                        let res = await this.jl.ajax("get", filter, "/jl/JlApi.php");
                        this.video = res.data[0]
                    } catch (e) {
                        alert(e.message)
                    }
                },
                async getSiteSetting() {
                    let filter = {
                        table: "site_setting",
                        order_by_desc : "idx",
                    }

                    try {
                        let res = await this.jl.ajax("get", filter, "/jl/JlApi.php");
                        this.site_setting = res.data[0]
                    } catch (e) {
                        alert(e.message)
                    }
                },
                getWeekRange() {
                    const today = new Date();
                    const dayOfWeek = today.getDay(); // 0 (일요일) ~ 6 (토요일)

                    // 첫 번째 날 (월요일 기준)
                    const firstDay = new Date(today);
                    firstDay.setDate(today.getDate() - (dayOfWeek === 0 ? 6 : dayOfWeek - 1));

                    // 마지막 날 (일요일)
                    const lastDay = new Date(firstDay);
                    lastDay.setDate(firstDay.getDate() + 6);


                    return {
                        firstDay: firstDay,
                        lastDay: lastDay,
                    };
                }
            },
            computed: {},
            watch: {}
        }});

</script>

<style>

</style>