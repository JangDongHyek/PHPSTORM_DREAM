<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div>
        <div id="area_chat" <?php //echo $you['mb_level'] == 10 ? 'class="admin"' : ''; ?>>
            <div id="chat_room">
                <div class="chat_hd">
                    <div class="back"><a onClick="location.replace(g5_bbs_url+'/chat_list.php');"><img src="<?=G5_IMG_URL?>/icon_chat_arrow.svg"></a></div>
                    <div class="name"><?=$room_name?></div>
                    <!--<div class="interest_corp"></div>-->
                    <a @click="more = !more" class="btn_more"></a>
                    <ul class="edit_list edit_list_q" v-show="more">
                        <li class="delete"><a @click="modal = true">채팅방 나가기</a></li>
                    </ul>
                </div>

                <div class="chat_msg" id="chat-msg">
                    <div class="chat_wrap" id="chat-view">
                        <!--상단날짜-->
                        <div class="data today" style="display: None;">2021년 11월 04일 목요일</div>
                        <!--받은메세지(상대방)-->
                        <div class="receive">
                    <div class="area_img"></div>
                    <div class="area_msg">
                        <div class="name">상대방이름</div>
                        <div class="cont_box msg">메세지</div>
                        <div class="time date">오후 4:08 <span class="read-status">1</span></div>
                    </div>
                </div>

                <div class="receive">
                    <div class="area_img"><img class="basic" src="<?php /*echo G5_IMG_URL */?>/img_smile.svg"></div>
                    <div class="area_msg">
                        <div class="cont_box">
                            김하늘고객님 안녕하세요. PODOSEA입니다.
                            향후 1년 이내에 일을 시작하고 싶어 하는 비경제활동인구가 400만명에 육박해 역대 최다를 기록했다.
                        </div>
                        <div class="time">오후 4:08</div>
                    </div>
                </div>

                <!--받은메세지(나)-->
                <div class="send">
                    <div class="area_msg">
                        <div class="cont_wrap">
                            <div class="cont_box">안녕하세요. 견적금액 문의드립니다.</div>
                            <i class="read">1</i>
                        </div>
                        <div class="time"> 오후 4:20</div>
                    </div>
                </div>
                <div class="send">
                    <div class="area_msg">
                        <div class="cont_wrap img">
                            <div class="cont_box img">
                                <img src="<?php /*echo G5_IMG_URL */?>/img_photo.jpg">
                            </div>
                            <i class="read">1</i>
                        </div>
                        <div class="time"> 오후 4:20</div>
                    </div>
                </div>
                    </div>
                </div>
                <div class="chat_ft">
                    <? if(isMobile()) { ?>
                        <div class="icon_attach" data-toggle="modal" data-target="#chataddModal"></div>
                    <?} else {?>
                        <div class="icon_attach" id="btn-file"></div>
                        <div class="icon_attach" id="btn-camera" style="display: none"></div>
                        <div class="icon_attach" id="btn-image" style="display: none"></div>
                    <?}?>
                    <div class="chat_input"><textarea placeholder="내용을 입력해 주세요." name="msg" id="msg" class="msg-form"></textarea></div>
                    <!-- 메세지 입력할때 class="on" 추가 -->
                    <div class="icon_send btn-send" id="chat-send"></div>
                </div>
            </div>


            <!-- 일반회원과 채팅할 때 -->
            <div id="chat_info" class="basic" style="display: block">
                <div class="info_wrap">

                    <div class="item_info">
                        <i class="cate"><?=$ctg_name?></i>
                        <h3 class="subject"><?=$ci['i_title']?></h3>
                    </div>
                    <div class="company_info">
                        <div class="profile_box">
                            <div class="profile"><img src="<?php echo G5_THEME_IMG_URL ?>/app/img_company01.jpg"></div>
                            <div class="profile_info">
                                <h3>스튜디오오늘</h3>
                                <span>포트폴리오 6건</span>
                            </div>
                        </div>
                        <ul class="list_info">
                            <li>
                                <span>총작업수</span>
                                <h3>10건</h3>
                            </li>
                            <li>
                                <span>만족도</span>
                                <h3>98%</h3>
                            </li>
                            <li>
                                <span>평균응답시간</span>
                                <h3>1시간 이내</h3>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- //일반회원과 채팅할 때 -->
        </div>

        <slot-modal :modal="modal" :footer="false" @close="modal = false">
            <div class="txt confirm">
                <h2>채팅방을 나가시겠습니까?</h2>
                <em>(채팅방에서 나가면 대화내용이 모두 삭제됩니다.) </em>
            </div>
            <ul class="madal_btn">
                <li data-dismiss="modal" @click="modal = false;">취소</li>
                <li class="ok"">확인</li>
            </ul>
        </slot-modal>
    </div>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            mb_no : {type : String, default : ""}
        },
        data: function(){
            return {
                jl : null,
                filter : {
                    page : 1,
                    limit : 1,
                    count : 0,
                    search_key1 : "",
                    search_value1_1 : "",
                    search_value1_2 : "",
                    search_like_key1 : "",
                    search_like_value1 : "",
                    not_key1 : "",
                    not_value1 : "",
                    in_key1 : "",
                    in_value : [],
                    order_by_desc : "insert_date",
                    order_by_asc : "",
                },
                required : [
                    {name : "",message : ""},
                ],
                data : {

                },

                more : false,
                modal : false,
            };
        },
        created: function(){
            this.jl = new JL('<?=$componentName?>');

            if(this.primary) this.getData();
        },
        mounted: function(){
            this.$nextTick(() => {

            });
        },
        methods: {
            postData() {
                let method = this.primary ? "update" : "insert";
                try {
                    let res = this.jl.ajax(method,this.data,"/api/example.php");
                }catch (e) {
                    alert(e)
                }

            },
            getData() {
                try {
                    let res = this.jl.ajax("get",this.filter,"/api/example.php");
                    this.data = res.data[0]
                }catch (e) {
                    alert(e)
                }
            }
        },
        computed: {

        },
        watch : {
            search_key1() {
                this.search_value1_1 = "";
                this.search_value1_2 = "";
            }
        }
    });
</script>

<style>

</style>