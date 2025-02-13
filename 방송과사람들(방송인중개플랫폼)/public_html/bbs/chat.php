<?
include_once('./_common.php');
$name = "chat";
$g5['title'] = '채팅';

$room = $_GET['room'];
$sql = "SELECT a.*, 
               b.mb_nick 
        FROM member_chat a 
        LEFT JOIN g5_member b ON b.mb_no = a.sender_idx 
        WHERE a.room_idx = '{$room}'";
$result = sql_query($sql);

// 결과를 배열로 변환
$messages = [];
while ($row = sql_fetch_array($result)) {
    $messages[] = $row; // 각 메시지를 배열에 추가
}
include_once('./_head.php');
?>

    <link rel="stylesheet" href="<?=G5_URL?>/css/chat/style.css?v=<?=G5_CSS_VER?>">
    <input type="hidden" name="mbNo" id="mbNo" value="<?=$_SESSION['ss_mb_no']?>">
    <input type="hidden" name="mbRoom" id="mbRoom" value="<?=$room?>">
    <div id="area_chat">
        <div id="chat_room">
            <div class="chat_hd">
                <div class="back"><a onclick="location.replace(g5_bbs_url+'/chat_list.php');"><img
                                src="https://itforone.com:443/~broadcast/img/icon_chat_arrow.svg" title=""></a></div>
                <div class="name"></div>
                <a class="btn_more"></a>
                <ul class="edit_list edit_list_q" style="display: none;">
                    <li class="delete"><a>채팅방 나가기</a></li>
                </ul>
            </div>
            <div id="chat-msg" class="chat_msg">
                <div id="chat-view" class="chat_wrap">

                    <?php
                    foreach ($messages as $row) {
                        // 메시지 작성자 ID
                        $senderId = $row['sender_idx'];
                        // 메시지 내용
                        $message = $row['message'];
                        // 메시지 생성 시간
                        $createdAt = date('A h:i', strtotime($row['insert_date'])); // 시간 포맷 조정

                        if ($senderId == $_SESSION['ss_mb_no']) {
                            // 사용자가 보낸 메시지
                            echo '<div class="send">
                                <div class="area_msg">
                                    <div class="cont_wrap">
                                        <div class="cont_box">' . $message . '</div>
                                    </div>
                                    <div class="time">' . $createdAt . '</div>
                                </div>
                              </div>';
                        } else {
                            $icon_file = G5_DATA_PATH . '/file/member/' . $row['sender_idx'] . '.jpg'; // 상대방의 mb_no 사용
                            if (file_exists($icon_file)) {
                                $icon_url = G5_URL . '/data/file/member/' . $row['sender_idx'] . '.jpg';
                                $profileImg = '<img src="' . $icon_url . '" alt="Profile Photo">';
                            } else {
                                $profileImg = '<img src="' . G5_IMG_URL . '/img_smile.jpg" alt="Default Profile Photo">';
                            }
                            // 상대방이 보낸 메시지
                            echo '<div class="receive">
                                <div class="area_img">' . $profileImg . '</div>
                                <div class="area_msg">
                                    <div class="name">'.$row['mb_nick'].'</div>
                                    <div class="cont_box">' . $message . '</div>
                                    <div class="time date">' . $createdAt . '</div>
                                    <i class="read" data-mbNo="'.$row['sender_idx'].'">'.$row['confirm'].'</i>
                                </div>
                              </div>';
                        }
                    }
                    ?>


                    <!--<div class="data today" style="display: none;">2021년 11월 04일 목요일</div>
                    <div class="receive">
                        <div class="area_img"></div>
                        <div class="area_msg">
                            <div class="name">상대방이름</div>
                            <div class="cont_box msg">메세지</div>
                            <div class="time date">오후 4:08 <span class="read-status">1</span></div>
                        </div>
                    </div>
                    <div class="receive">
                        <div class="area_img"><img src="/img_smile.svg" class="basic"></div>
                        <div class="area_msg">
                            <div class="cont_box">
                                김하늘고객님 안녕하세요. PODOSEA입니다.
                                향후 1년 이내에 일을 시작하고 싶어 하는 비경제활동인구가 400만명에 육박해 역대 최다를 기록했다.
                            </div>
                            <div class="time">오후 4:08</div>
                        </div>
                    </div>
                    <div class="send">
                        <div class="area_msg">
                            <div class="cont_wrap">
                                <div class="cont_box">안녕하세요. 견적금액 문의드립니다.</div>
                                <i class="read">1</i></div>
                            <div class="time"> 오후 4:20</div>
                        </div>
                    </div>
                    <div class="send">
                        <div class="area_msg">
                            <div class="cont_wrap img">
                                <div class="cont_box img"><img src="../node-chat/uploads/10/o.jpg" alt="Image" class="uploaded-image" /></div>
                                <i class="read">1</i></div>
                            <div class="time"> 오후 4:20</div>
                        </div>
                    </div>-->
                </div>
            </div>
            <div class="chat_ft">
                <div id="btn-file" class="icon_attach" onclick="document.getElementById('fileInput').click();"></div>
                <input type="file" id="fileInput" class="hide">
                <div id="btn-camera" class="icon_attach" style="display: none;"></div>
                <div id="btn-image" class="icon_attach" style="display: none;"></div>
                <div class="chat_input"><textarea placeholder="내용을 입력해 주세요." name="message" id="msg"
                                                  class="msg-form"></textarea></div>
                <div id="submit-btn" class="icon_send btn-send"></div>
            </div>
        </div>
        <div id="chat_info" class="basic" style="display: block;">
            <div class="info_wrap">
                <div class="item_info"><i class="cate"></i>
                    <h3 class="subject"></h3></div>
                <div class="company_info">
                    <div class="profile_box">
                        <div class="profile"><img
                                    src="https://itforone.com:443/~broadcast/theme/basic_app/img/app/img_company01.jpg">
                        </div>
                        <div class="profile_info"><h3>스튜디오오늘</h3> <span>포트폴리오 6건</span></div>
                    </div>
                    <ul class="list_info">
                        <li><span>총작업수</span>
                            <h3>10건</h3></li>
                        <li><span>만족도</span>
                            <h3>98%</h3></li>
                        <li><span>평균응답시간</span>
                            <h3>1시간 이내</h3></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div id="basic_modal">
        <div tabindex="-1" class="modal fade" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><i
                                    class="fa-light fa-xmark"></i></button>
                        <h4 id="myModalLabel" class="modal-title"></h4></div>
                    <div class="modal-body">
                        <div class="txt confirm"><h2>채팅방을 나가시겠습니까?</h2> <em>(채팅방에서 나가면 대화내용이 모두 삭제됩니다.) </em></div>
                        <ul class="madal_btn">
                            <li data-dismiss="modal">취소</li>
                            <li class="ok">확인</li>
                        </ul>
                    </div> <!----></div>
            </div>
        </div>
    </div>

    <!-- message-template: 사용자가 보낸 메시지. -->
    <script id="message-template" type="text/template">
        <div class="send">
            <div class="area_msg">
                <div class="cont_wrap">
                    <div class="cont_box">{{{text}}}</div>
                    <i class="read">{{readStatus}}</i>
                </div>
                <div class="time">{{createdAt}}</div>
            </div>
        </div>
    </script>

    <!-- other-message-template: 상대방이 보낸 메시지. -->
    <script id="other-message-template" type="text/template">
        <div class="receive">
            <div class="area_img"></div>
            <div class="area_msg">
                <div class="name">{{from}}</div>
                <div class="cont_box msg">{{{text}}}</div>
                <div class="time date">{{createdAt}} <span class="read-status">{{readStatus}}</span></div>
            </div>
        </div>
    </script>
    <script src="<?=G5_JS_URL?>/socket.io.js"></script>
    <script src="<?=G5_JS_URL?>/chat-view.js"></script>
    <script type="text/javascript" src="<?=G5_JS_URL?>/moment.js"></script>
    <script type="text/javascript" src="<?=G5_JS_URL?>/mustache.js"></script>
<?
include_once('./_tail.php');
?>