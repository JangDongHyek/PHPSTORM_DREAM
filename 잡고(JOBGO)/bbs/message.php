<?php
global $pid;
$pid = "message";
$sub_id = "message";
include_once('./_common.php');
$g5['title'] = '문의하기';
include_once('./_head.php');

/**
 * 문의-채팅
 * ta_idx : 재능 idx / master_id : 구매자아이디 / room_name : 판매자닉네임 / sub_id : 판매자아이디 / room_id : 채팅방 id (chat_room - id)
 * ta_idx 정보가 있다면 해당 재능에 대한 채팅목록 및 채팅내용을 보여즘
 * ta_idx 정보가 없다면 전체 채팅 목록을 보여줌
 **/

if (empty($member['mb_id'])) {
    alert("로그인 후 이용해주세요.", G5_BBS_URL . "/login.php?url=message.php");
}

$sql = "select count(*) as cnt from chat_message where room_idx = '{$room_id}' ";
$row = sql_fetch($sql);
$first = 20 < $row['cnt'] - 20 ? $row['cnt'] - 20 : 0;

// 채팅방 정보
$sql = " select * from chat_room where id = '{$room_id}' ";
$chat = sql_fetch($sql);
// ===============================================================

// 전문인 정보
//if($member['mb_division'] == 2) { // 전문인
    $sub_id = $chat["sub_id"];
//}

// 채팅방 회원 정보 (상대방)
$you_nickname = sql_fetch(" select mb.mb_nick from chat_room_user as cru left join g5_member as mb on mb.mb_id = cru.user_id where room_idx = '{$room_id}' and mb_nick != '{$member['mb_nick']}' ; ")['mb_nick'];
$my_nickname = $member['mb_nick'];

// 전문인 회원 정보
$mb = get_member($sub_id);

// 전문인 프로필 이미지
$dest_path = G5_DATA_PATH . '/member/' . $mb_dir . '/' . $sub_id . '.jpg';

// 의뢰인 만족도
$sql = "select IF(avg(rating) is null,'없음',CONCAT (avg(rating),'점')) as avg from new_payment_review pr left join {$g5['talent_table']} ta on ta.ta_idx = pr.ta_idx where ta.mb_id = '{$sub_id}' ";
$member_avg = sql_fetch($sql)['avg'];

// 전문인 프로필 정보
$sql = "select *from {$g5['profile_table']} where mb_id = '{$sub_id}' ";
$profile = sql_fetch($sql);

// 전문인이 등록한 재능 리스트
$sql = " select ta.*, (select pta_pay from new_pay_talent where pta_info = 1 and ta_idx = ta.ta_idx) pta_pay from {$g5['talent_table']} as ta where ta.mb_id = '{$sub_id}' ";
$ta_result = sql_query($sql);

// 내가 구매한 서비스
$buy_count = sql_fetch(" select count(*) as count from new_payment where userId = '{$member['mb_id']}' and seller_id = '{$sub_id}' and ResultCode in('3001', '4000') ")['count'];
?>

<style>
    .ListSearch, .blockBox { background: unset !important; }
    <?php if(empty($room_id)) { ?> /*채팅방 입장 전*/
    .msgBox, .userBox, .msgTxt { background: lightgrey !important; opacity: 0.3; }
    <?php } ?>
</style>

<div id="MessageBoxWrap">
	<div class="msgList">
        <div class="ListSearch">
            <form name="fsearch" method="get">
                <input type="hidden" name="idx" id="idx" value="<?=$ta_idx?>">
                <input type="hidden" name="sel_mb_id" id="sel_mb_id" value="<?=$chat['sub_id']?>">
                <input type="hidden" name="buy_mb_id" id="buy_mb_id" value="<?=$chat['master_id']?>">
                <input type="hidden" name="sel_room_id" id="sel_room_id" value="<?=$room_id?>"> <!--채팅목록에서 선택한 채팅방-->
                <div class="blockBox">
                    <div>
                        <label for="sch_state" class="sound_only">검색창</label>
                        <select name="sel" id="sch_state">
                            <option value="room_name" <?php echo $sel == 'room_name' ? 'selected' : '' ?>>닉네임</option>
                            <option value="ta_title" <?php echo $sel == 'ta_title' ? 'selected' : '' ?>>재능명</option>
                        </select>
                    </div>
                    <div >
                        <label class="sound_only">검색</label>
                        <input type="text" name="stx" value="<?=$_GET['stx']?>" id="stx" placeholder="검색어를 입력하세요.">
                        <button>검색</button>
                    </div>
                </div>
            </form>
        </div>
		<div class="scrollBox" style="overflow-y: auto !important;">
            <div id="chat-lists"></div>
		</div>
		<!-- /scrollBox -->
	</div>

    <?php if(empty($room_id)) { ?>
    <div class="unMsgBox"><!-- 클릭안되는 페이지 div -->
        <p>채팅방을 선택해 주세요</p>
    </div>
    <!-- /unMsgBox -->
    <?php } ?>

	<div class="msgCont">
		<div class="msgConts">
            <!-- 메세지내용  -->
            <div class="msgBox" style="overflow: unset !important;">

                <!--채팅시작-->
                <p class="warning">
                    잡고를 통하지 않고 전문가에게 직접 결제하는 경우<br/>서비스 불이행 / 환불 거부 / 연락두절 등의 문제가 발생할 수 있습니다.
                </p>
                <div class="chat-msg" id="chat-msg" style="overflow-y: auto;">
                    <div id="chat-view">
                        <div class="today" style="display: none;">2021년 6월 23일 수요일</div>
                        <div class="you-msg" style="display: none;">
                            <p class="nm">이름</p>
                            <span class="read-status">1</span>
                            <div class="msg">안녕하세요</div>
                            <div class="date">오후 12:16</div>
                        </div>
                        <div class="my-msg" style="display: none">
                            <p class="nm">이름</p>
                            <span class="read-status">1</span>
                            <div class="date">오후 12:14</div>
                            <div class="msg">안녕하세요</div>
                        </div>
                    </div>
                </div>
                <!--채팅끝-->

                <!--채팅폼시작-->
                <div class="msg-forms" id="msg-forms">
                    <form name='form' id='form1' method='post' enctype='multipart/form-data'>
                        <!-- msㄱg에서 폼 입력을 할 때 mb_id를 들고가서 상대방에게 입력중이라는 것을 표시해줘야 함 -->
                        <input type="hidden" name="user_id" id="user_id" value="<?php echo $member['mb_id'] ?>">
                        <input type="hidden" name="room_idx" id="room_idx" value="<?php echo $room_id ?>">
                        <input type="hidden" name="user_name" id="user_name" value="<?php echo $member['mb_name'] ?>">
                        <input type="hidden" name="you_nickname" id="you_nickname" value="<?php echo $you_nickname ?>">
                        <input type="hidden" name="my_nickname" id="my_nickname" value="<?php echo $my_nickname ?>">
                        <!--<input type="hidden" name="room_id" value="<?php /*echo $chat['room_id'] */?>">-->
                        <input type="file" name="image" accept="image/*" id="image" style="display:none">
                    </form>
                </div>
                <!--채팅폼끝-->
                <div class="user-input" id="user-input">
                    <!--입력중...-->
                </div>
            </div>

            <!-- 파트너 프로필 -->
            <div class="userBox">
                <div class="profileInfo">
                    <!--<p class="titleTextBoxDesign">전문인 정보</p>--><!-- 텍스트 타이틀 추가 위치 옮겨도 css 먹혀요 -->
                    <p class="img">
                        <?php
                        if(file_exists($dest_path)) { echo '<img src="'.$dest_url.'">'; }
                        else { echo '<img class="p_img" src="'.G5_THEME_IMG_URL.'/sub/default.png">'; }
                        ?>
                        <!--<img src="http://jobgo.ac/theme/basic/img/sub/default.png" alt="">-->
                    </p>
                    <p class="name"><?=$mb['mb_nick']?></p>
                </div>

                <div class="partnerInfo">
                    <div><h5>만족도</h5><span><?php if(!$idx) { ?><?=$member_avg?><?php } ?></span></div>
                    <!--<div><h5>회원구분</h5><span>개인회원</span></div>-->
                    <div><h5>연락가능시간</h5><span><?php if(!$idx) { ?><?=date('H:i',strtotime($profile['pf_call_time1']))?>~<?=date('H:i',strtotime($profile['pf_call_time2']))?><?php } ?></span></div>
                    <div><h5>평균응답시간</h5><span><?=$pf_time_list[$profile['pf_time']]?></span></div>
                </div>
                <div class="partnerHis">
                    <h4><a href="<?=G5_BBS_URL?>/my_item.php?tab=2">구매했던 서비스 <span><?=number_format($buy_count)?>건</span></a></h4>
                </div>
                <div class="partnerServ">
                    <h4>전문가 서비스</h4>
                    <ul class="serviceList">
                        <?php
                        for($i=0; $ta=sql_fetch_array($ta_result);$i++) {
                            // 재능 등록 이미지 (첫번째 이미지)
                            $file_sql = " select * from {$g5['board_file_table']} where bo_table = 'talent' and wr_id = {$ta['ta_idx']} order by bf_datetime limit 1 ";
                            $file_row = sql_fetch($file_sql);
                        ?>
                        <li>
                            <a href="<?php echo G5_BBS_URL; ?>/item_view.php?idx=<?=$ta['ta_idx']?>">
                                <div>
                                    <?php
                                    if($file_row['wr_id']) { ?>
                                    <img src="<?php echo G5_DATA_URL ?>/file/talent/<?=$file_row['bf_file']?>">
                                    <?php } else { ?>
                                    <img src="<?php echo G5_THEME_IMG_URL ?>/main/no_img.jpg"> <!-- 디폴트 이미지 -->
                                    <?php } ?>
                                    <!--<img src="<?php /*echo G5_THEME_IMG_URL */?>/common/msg_test.jpg" alt="서비스" >-->
                                </div>
                                <div class="txt">
                                    <p class="tit"><?=$ta['ta_title']?></p>
                                    <p class="pri"><?=number_format($ta['pta_pay'])?>원</p>
                                </div>
                            </a>
                        </li>
                        <?php
                        }
                        if($i == 0) {
                        ?>
                        <li style="text-align: center;">상품이 없습니다.</li>
                        <?php
                        }
                        ?>
                        <!--<li>
                            <a href="#">
                                <div><img src="<?php /*echo G5_THEME_IMG_URL */?>/common/msg_test.jpg" alt="서비스" ></div>
                                <div class="txt">
                                    <p class="tit">합격률 높은 사업 계획서로 컨설팅을 하세요</p>
                                    <p class="pri">35,000원</p>
                                </div>
                            </a>
                        </li>-->
                    </ul>
                </div>
            </div>
		</div>

		<div class="msgTxt">
            <div class="textareaBox">
                <label for="" class="sound_only">메시지 입력창</label>
                <textarea name="msg" id="msg" class="msg_form" cols="30" rows="1" placeholder="메시지를 입력하세요." style="resize: unset;"></textarea>
            </div>
            <div class="btnBox">
                <button class="btn" id="btn-file" type="button">파일첨부</button>
                <span class="txtSend">
					<button class="btn btn-send" id="chat-send" type="button">전송</button>
				</span>
            </div>
		</div>
	</div>
	<!-- /msgCont -->
</div>
<!-- /MessageBoxWrap -->

<!--<link rel="stylesheet" href="<?/*= G5_CSS_URL */?>/chat.css"/>-->
<script src = "<?=G5_JS_URL?>/socket.io.js"> </script>
<script src = "<?=G5_JS_URL?>/chat.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script> <!-- 날짜 포맷 관련 라이브러리 -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/locale/ko.js"></script> <!-- 날짜 포맷 관련 라이브러리 -->

<script>
    // 리스트에서 사용
    chatLogin('<?=$member['mb_id']?>');
    chatList('<?=$member['mb_id']?>'); // 채팅 목록

    // 로딩바 표시
    function showLoadingBar() {
        //var maskHeight = $(document).height();
        //var maskWidth = window.document.body.clientWidth;
        //var mask = "<div id='mask'></div>";
        //var loadingImg = '';
        //loadingImg += "<div id='loadingImg'>";
        //loadingImg += "<img src='<?//=G5_IMG_URL?>///loading.gif'/>";
        //loadingImg += "</div>";
        //$('body').append(mask).append(loadingImg);
        //$('#mask').css({'width': maskWidth, 'height': maskHeight, 'opacity': '0.3'})
        //$('#mask').show();
        //$('#loadingImg').show();
    }

    // 로딩바 숨김
    function hideLoadingBar() {
        // $('#mask, #loadingImg').hide();
        // $('#mask, #loadingImg').remove();
    }
</script>

<script type="text/javascript">
    <?php if(!empty($room_id)) { ?>
    // 채팅방에서 사용
    room_in('<?=$member['mb_id']?>', '<?=$member['mb_name']?>', '<?=$room_id?>');
    window.onload = function () {
        const chat_msg = document.getElementById("chat-msg");
        const scrolltop = chat_msg.scrollHeight - chat_msg.offsetHeight;
        chat_msg.scrollTop = scrolltop;
    }

    $(document).ready(function () {
        $("text").on("keyup", "textarea", function (e) {
            $(this).css("height", "auto");
            $(this).height(this.scrollHeight);
        });
        $("text").find("textarea").keyup();

        /*// 검색버튼 클릭
        $(".btnSchBox .img").click(function() {
            $(".blockBox").toggleClass("on");
            $(this).toggleClass("on");
        });*/
    });
    <?php } ?>
</script>
<?php
include_once('./_tail.php');
?>