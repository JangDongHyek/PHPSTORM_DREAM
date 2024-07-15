<?
include_once('./_common.php');
$name = "chat";
$g5['title'] = '채팅';
include_once('./_head.php');

/** 채팅화면 (참고 : 채팅 관련 아이디(태그)는 '-' 사용, chat.js에서 app.js로 보낼 때 '_' 사용인듯 함 -- 소스 그대로 복사해서 사용해서 잘 모름.. **/

loginCheck($member['mb_id'], $member['mb_category']); // 로그인체크

if($private) {
    //$member['mb_id'] = 'drongo147';
}

// 공지사항 링크 타고 넘어올 경우 -- 관리자와 채팅으로 바로 연결
if(strpos($_SERVER['HTTP_REFERER'], 'board.php') !== false || $_GET['u'] == 'admin') {
    $you_mb_id = 'admin';
    if($member['mb_id'] == 'admin') {
        alert('올바른 경로가 아닙니다.');
    }
}

//if($member['mb_id'] == $you_mb_id) { // 내 아이디와 채팅 상대의 아이디가 같으면
//    alert('올바른 경로가 아닙니다.');
//}

//if(empty($inquiry_idx)) { alert('올바른 경로가 아닙니다.'); } // 견적의뢰 idx 확인 ==> 견적의뢰에서 채팅을 걸지 않고 다른데서 채팅을 할 수도 있기 때문에 주석 처리
if(empty($you_mb_id)) { // 채팅 상대방이 없으면 튕김 (경로 입력해서 들어올 경우 발생할 수 있음
    alert('올바른 경로가 아닙니다.', G5_BBS_URL.'/chat_list.php');
}

// 견적의뢰정보
if(!empty($inquiry_idx)) {
    $ci = sql_fetch(" select * from g5_company_inquiry where idx = '{$inquiry_idx}' ");
}
// 내정보
$mb = get_member($member['mb_id']);

// 채팅방 없으면 생성 (필요데이터 : 로그인아이디(발신자) - $member['mb_id'], 의뢰자아이디(수신자) - $you_mb_id)
$sql_search = " and ((room_user1 = '{$member['mb_id']}' and room_user2 = '{$you_mb_id}') or (room_user1 = '{$you_mb_id}' and room_user2 = '{$member['mb_id']}'))";
$cnt = sql_fetch(" select count(*) as cnt from chat_room where 1=1 {$sql_search}; ")['cnt'];
if(empty($cnt)) {
    // 채팅방 DB INSERT
    sql_query(" insert into chat_room set inquiry_idx = '{$inquiry_idx}', master_id = '{$member['mb_id']}', room_user1 = '{$member['mb_id']}', room_user2 = '{$you_mb_id}', createdAt = '".G5_TIME_YMDHIS."' ");
    $room_idx = sql_insert_id(); // 채팅방 idx

    if(!empty($room_idx)) { // 채팅방이 제대로 만들어진 후 채팅방 회원 INSERT
        // 채팅방에 들어갈 회원
        $room_user = array($member['mb_id'], $you_mb_id);
        for($i=0; $i<count($room_user); $i++) {
            // 채팅방 회원 정보
            $info = get_member($room_user[$i]);
            // 채팅방 회원 DB INSERT
            sql_query(" insert into chat_room_user set room_idx = {$room_idx}, user_id = '{$room_user[$i]}', user_name = '{$info['mb_name']}', createdAt = '".G5_TIME_YMDHIS."' ");
        }
    }
}
else {
    // 채팅방 있으면 채팅방 idx
    $room_idx = sql_fetch(" select id from chat_room where 1=1 {$sql_search} ")['id'];
}

// 채팅 상대방 정보 (chat_room_user에서 나를 제외한 데이터가 상대방 정보)
$you = sql_fetch(" select cru.*, mb.* from chat_room_user as cru left join g5_member as mb on mb.mb_id = cru.user_id where room_idx = '{$room_idx}' and user_id != '{$member['mb_id']}' ");
// 방이름
if($you['mb_category'] == '기업') {
    //$room_name = $you['user_id'].' ('.$you['mb_company_name'].')';
    $room_name = $you['mb_company_name']; // 회사명
}
else { // 일반
    $room_name = getNickOrId($you['mb_id']); // 닉네임 or 아이디
}
// 상대방 프로필 이미지
$user_img = getProfileImg($you['user_id'], $you['mb_category']);
?>

<? if($name=="chat") { ?>
	<body<?php echo isset($g5['body_script']) ? $g5['body_script'] : ''; ?> class="chat">
<?}?>

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">

<style>
	#container{padding:0;}
	#ft_copy{display:none;}
</style>


<!-- 벙커 선물하기 모달 -->
<div id="basic_modal">
	<!-- Modal -->
	<div class="modal fade review" id="presentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
		 aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span></span><span></span></button>
					<h4 class="modal-title" id="appModalLabel">벙커 선물하기</h4>
				</div>
				<div class="modal-body">
					<div class="txt">
						<h2>선물할 벙커를 입력해 주세요.</h2>
						<ul class="list_product charge">
							<li>
								<i>BUNKER</i>
								<input type="text" class="frm_input" placeholder="벙커" id="bunker" name="bunker" onkeyup="comma_number(this);">
							</li>
						</ul>
						<a href="javascript:confirmModal();">선물하기</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- 벙커 선물하기 모달 -->

<!-- 벙커 선물하기 확인 모달 -->
<div id="basic_modal">
	<!-- Modal -->
	<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
		 aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">
					<div class="txt confirm">
						<h2> <?=getNickOrId($you['mb_id'])?>님에게 <span class="blue gift_bunker"></span>벙커를 선물하시겠습니까?</h2>
						<em>(선물하신 벙커는 회수가 불가합니다.) </em>
					</div>
					<ul class="madal_btn">
						<li data-dismiss="modal">취소</li>
						<li class="ok" onclick="giftBunker();">확인</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- 벙커 선물하기 확인 모달 -->

<!-- 채팅방 나가기 확인 모달 -->
<div id="basic_modal">
    <!-- Modal -->
    <div class="modal fade" id="chatOutModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="txt confirm">
                        <h2>채팅방을 나가시겠습니까?</h2>
                        <em>(채팅방에서 나가면 대화내용이 모두 삭제됩니다.) </em>
                    </div>
                    <ul class="madal_btn">
                        <li data-dismiss="modal">취소</li>
                        <li class="ok" onclick="chatOut('<?=$room_idx?>');">확인</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 채팅방 나가기 확인 모달 -->

<div class="msg-forms" id="msg-forms" style="display: none;">
    <form name='form' id='form' method='post' enctype='multipart/form-data'>
        <input type="hidden" name="user_id" id="user_id" value="<?php echo $member['mb_id'] ?>"> <!--채팅자아이디-->
        <input type="hidden" name="room_idx" id="room_idx" value="<?php echo $room_idx ?>"> <!--chat_room idx-->
        <input type="hidden" name="user_name" id="user_name" value="<?php echo $member['mb_category'] == '일반' ? getNickOrId($member['mb_id']) : $member['mb_company_name'] ?>"> <!--채팅자(일반은닉네임/기업은회사이름)-->
        <input type="file" name="image" accept="*" id="image" style="display:none">
        <input type="hidden" name="room_name" id="room_name" value="<?=$room_name?>">
    </form>
</div>

<div id="area_chat" <?php echo $you['mb_level'] == 10 ? 'class="admin"' : ''; ?>>
    <div id="chat_room">
        <div class="chat_hd">
            <div class="back"><a onclick="location.replace(g5_bbs_url+'/chat_list.php');"><img src="<?=G5_IMG_URL?>/icon_chat_arrow.svg"></a></div>
            <div class="name"><?=$room_name?></div>
            <!--<div class="interest_corp"></div>-->
            <a href="javascript:edit_open('edit_list_q');" class="btn_more"></a>
            <ul class="edit_list edit_list_q" style="display: none;">
                <!--
				<?php if(!$is_admin) { ?>
                <li class="modify"><a href="<?=G5_BBS_URL?>/company_view.php?idx=<?=$inquiry_idx?>">내가 요청한 의뢰보기</a></li>
                <?php } ?>
				-->
                <?php if($you['mb_level'] != 10) { ?>
                <li class="bunker"><a data-toggle="modal" data-target="#presentModal">벙커 선물하기</a></li>
                <?php } ?>
                <li class="delete"><a data-toggle="modal" data-target="#chatOutModal">채팅방 나가기</a></li>
            </ul>
        </div>
        <div class="chat_msg" id="chat-msg">
            <div class="chat_wrap" id="chat-view">
                <!--상단날짜-->
                <div class="data today" style="display: none;">2021년 11월 04일 목요일</div>
                <!--받은메세지(상대방)-->
                <!--<div class="receive">
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
                        <div class="estimate">
                            <h3>견적서</h3>
                            <div class="cont">
                            <p>
                            김철수 고객님 안녕하세요. <br>
                            요청하신 견적 제안금액입니다.
                            </p>
                            <div class="price">
                                <span>견적제안금액</span>
                                <h4>20,000,000원</h4>
                            </div>
                            <p class="gray">
                            궁금한점이 있으시면, <br>채팅으로 문의해주세요.
                            </p>
                            </div>
                        </div>
                        <div class="time">오후 4:08</div>
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
                </div>-->
                <!--받은메세지(나)-->
                <!--<div class="send">
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
                </div>-->
            </div>
        </div>
        <div class="chat_ft">
            <div class="icon_attach" id="btn-file"></div>
            <div class="chat_input"><textarea placeholder="내용을 입력해 주세요." name="msg" id="msg" class="msg-form"></textarea></div>
            <!-- 메세지 입력할때 class="on" 추가 -->
            <div class="icon_send btn-send" id="chat-send"></div>
        </div>
    </div>

    <!-- 기업회원과 채팅할 때 -->
    <?php if($you['mb_category'] == '기업') { ?>
    <div id="chat_info" class="corp">
        <div class="info_wrap">
        <div class="chat_profile">
            <div class="area_photo">
                <?=getProfileImg($you['mb_id'], $you['mb_category']);?>
            </div>
            <div class="cop_info">
                <em class="<?=$you['mb_grade']?>"><?=$you['mb_grade']?></em>
                <h3><?=$you['mb_company_name']?></h3> <!-- 회사명 -->
                <div class="area_star">
                    <div class="img_star v<?=companyScore($you['mb_id'])?>">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <span><?=companyScore($you['mb_id'], 'Y')?>점</span>
                </div>
            </div>
        </div>
        <div class="corp_home"><a href="<?=G5_BBS_URL?>/company.php?mb_no=<?=$you['mb_no']?>" target="_blank">기업홈페이지 보기</a></div>
        <div class="area_nm">
			<a href="" data-toggle="modal" data-target="#presentModal" class="btn_bunker">벙커 선물하기</a>
        </div>
		<div class="info_box">
            <div class="chat_box">
                <h3>소개</h3>
                <div class="cont">
                    <p><?=$you['mb_company_introduce']?></p>
                </div>
            </div>
            <div class="chat_box">
                <h3>정보</h3>
                <div class="cont">
                    <ul class="list_info">
                        <li>
                            <em>업종</em>
                            <span><?=$company_sectors[$you['mb_company_sector']]?></span>
                        </li>
                        <li>
                            <em>설립일</em>
                            <span><?=str_replace('-','.',substr($you['mb_company_establish_date'],0,10))?></span>
                        </li>
                        <li>
                            <em>주소</em>
                            <span><?=$you['mb_addr1'].' '.$you['mb_addr2']?></span>
                        </li>
                        <li>
                            <em>주요 제품 및 서비스</em>
                            <span>
                                <ul class="list_service">
                                <?php
                                $mb_goods_service = '';
                                if(!empty($you['mb_goods_service'])) {
                                    $temp = explode('|',$you['mb_goods_service']);
                                    for($i=0; $i<count($temp); $i++) {
                                        $mb_goods_service .= '<li>'.$temp[$i].'</li>';
                                    }
                                }
                                ?>
                                <?=$mb_goods_service?>
                                </ul>
                            </span>
                        </li>
                        <li>
                            <em>전화번호</em>
                            <span><?=$you['mb_company_tel']?></span>
                        </li>
                        <li>
                            <em>팩스</em>
                            <span><?=$you['mb_company_fax']?></span>
                        </li>
                    </ul>
                </div>
            </div>
            </div>
        </div>
    </div>
    <?php } ?>
    <!-- //기업회원과 채팅할 때 -->


    <!-- 일반회원과 채팅할 때 -->
    <?php if($you['mb_category'] == '일반') { ?>
    <div id="chat_info" class="basic">
        <div class="info_wrap">
        <div class="chat_profile">
            <div class="area_photo">
                <?=getProfileImg($you['mb_id'], $you['mb_category']);?>
            </div>
            <div class="cop_info">
                <i class="lv<?=array_search($you['mb_grade'], $member_grade)?>"><?=$you['mb_grade']?></i> <!-- 회원등급 -->
                <h3><?=getNickOrId($you['mb_id'])?></h3> <!-- 닉네임 -->
				<em>포도씨 항해 거리</em> <span class="blue"><?=number_format($you['mb_grade_point'])?>NM</span>
            </div>

        </div>
        <div class="area_nm">
			<a href="" data-toggle="modal" data-target="#presentModal" class="btn_bunker">벙커 선물하기</a>
        </div>

        <div class="info_box">
            <div class="chat_box">
                <h3>소개</h3>
                <div class="cont">
                    <p><?=$you['mb_introduce']?></p>
                </div>
            </div>
            <div class="chat_box">
                <h3>정보</h3>
                <div class="cont">
                    <ul class="list_info">
                        <?php
                        // 질문수
                        $q_count = sql_fetch(" select count(*) as count from g5_helpme where mb_id = '{$you['mb_id']}' and del_yn is null; ")['count'];
                        // 답변수
                        $a_count = sql_fetch(" select count(*) as count from g5_helpme_answer where mb_id = '{$you['mb_id']}' and del_yn is null; ")['count'];
                        // 채택된 답변수
                        $s_count = sql_fetch(" select count(*) as count from g5_helpme_answer where mb_id = '{$you['mb_id']}' and an_selection = 'Y' and del_yn is null; ")['count'];
                        ?>
                        <li>
                            <em>지역</em>
                            <span><?=$you['mb_si']?></span>
                        </li>
                        <li>
                            <em>헬프미 질문</em>
                            <span><?=number_format($q_count)?>건</span>
                        </li>
                        <li>
                            <em>헬프미 답변</em>
                            <span><?=number_format($a_count)?>건</span>
                        </li>
                        <li>
                            <em>채택된 답변</em>
                            <span><?=number_format($s_count)?>건</span>
                        </li>
                    </ul>
                </div>
            </div>
            </div>
        </div>
    </div>
    <!-- //일반회원과 채팅할 때 -->
    <?php } ?>
</div>


<!--<script src="--><?//=G5_JS_URL ?><!--/socket.io.js"></script>-->
<script src="<?=G5_JS_URL?>/chat.js?v=<?=G5_JS_VER?>"></script> <!--head.php에 추가했으나 없으면 정상적으로 동작 안해서 별도 추가-->
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script> <!-- 날짜 포맷 관련 라이브러리 -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/locale/ko.js"></script> <!-- 날짜 포맷 관련 라이브러리 -->

<script>
	// 수정/삭제
	$(document).ready(function(e) {
        //chatLogin('<?//=$member['mb_id']?>//'); // head로 이동
        room_in('<?=$member['mb_id']?>', '<?=$member['mb_name']?>', '<?=$room_idx?>', '<?=$user_img?>');
        window.onload = function () {
            const chat_msg = document.getElementById("chat-msg");
            const scrolltop = chat_msg.scrollHeight - chat_msg.offsetHeight;
            chat_msg.scrollTop = Math.round(scrolltop);
        }

		if (!$(e.target).hasClass('btn_more')) { // btn_more가 포함된 영역 밖 클릭 시 수정/삭제 영역 숨김
			$('.edit_list').attr('style', 'display: none;');
		}

		$('.msg-form').keyup(function() {
		   if(this.value.length != 0) {
		       $('.icon_send').addClass('on');
           } else {
		       $('.icon_send').removeClass('on');
           }
        });

		// 스크롤 최하단으로 이동 - aOS에서 키보드 자판에 대화 내용이 가려짐
        if('<?=$android?>') {
            $('#msg').focus(function() {
                setTimeout(function() {
                    $('#chat-msg').scrollTop($('#chat-msg')[0].scrollHeight);
                }, 400);
            });
        }

		/*$('#msg').onfocus = function(e) {
		    alert('focus');
            const chat_msg = document.getElementById("chat-msg");
            const scrolltop = Math.round(chat_msg.scrollHeight - chat_msg.offsetHeight);
            chat_msg.scrollTop = scrolltop;
        }*/
	});

	var g_class2 = '';
	function edit_open(mode) { // mode : 각 답변에 적용된 클래스
		if(g_class2 != mode) {
			$('.edit_list').attr('style', 'display: none;');
		}
		g_class2 = mode;

		if($('.'+mode).attr('style').indexOf('block') != -1) {
			$('.'+mode).attr('style', 'display: none;');
		} else {
			$('.'+mode).attr('style', 'display: block;');
		}
	}

	// 벙커 선물하기 확인 모달
	function confirmModal() {
	    if($('#bunker').val() == 0 || $('#bunker').val().length == 0) {
	        swal('벙커를 입력해 주세요.');
	        return false;
        }
	    $('.gift_bunker').text($('#bunker').val()); // 벙커
        $('#presentModal').modal('hide');
	    $('#confirmModal').modal('show');
    }

    // 벙커 선물하기
    var is_post = false;
    function giftBunker() {
        if(is_post) {
            return false;
        }
        is_post = true;

        if('<?=$member['mb_bunker']*1?>' < $('#bunker').val().replace(',','')*1) {
            swal('벙커가 부족합니다.\n나의 벙커 <?=$member['mb_bunker']*1?> BUNKER');
            $('#confirmModal').modal('hide');
            is_post = false;
            return false;
        }

	    $.ajax({
            url: g5_bbs_url+'/ajax.gift_bunker.php',
            type: 'POST',
            data: {bunker: $('#bunker').val(), you_id: '<?=$you['mb_id']?>'},
            success: function(data) {
                if(data == 'success') {
                    swal('<?=getNickOrId($you['mb_id'])?>님에게 벙커를 선물하였습니다.')
                    .then(()=>{
                        location.reload();
                    });
                }
                else if(data == 'no_bunker') {
                    swal('BUNKER가 부족합니다.');
                    $('#confirmModal').modal('hide');
                    is_post = false;
                }
            },
        });
    }

    // 채팅방 나가기
    function chatOut(room_idx) {
        $.ajax({
            url: './ajax.chat_out.php',
            data: {room_idx : room_idx},
            type: 'post',
            success: function(data) {
                if(data) {
                    location.replace('./chat_list.php');
                }
            },
        });
    }

    // 파일사이즈체크
    function fileSizeCheck() {
        swal('파일이 최대 용량 10MB를 초과합니다.');
        return false;
    }
</script>

<?
include_once('./_tail.php');
?>
