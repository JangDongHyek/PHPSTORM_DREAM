<?php
include_once('./_common.php');

$name = "chat";
$g5['title'] = '채팅';

$room = $_GET['room'];
$sql = "SELECT a.*, 
               b.*
        FROM member_chat a 
        LEFT JOIN g5_member b ON b.mb_no = a.sender_idx 
        WHERE a.room_idx = '{$room}' ORDER BY idx ASC";
$result = sql_query($sql);

$member = get_member_no($_SESSION['ss_mb_no']);

/*$sql = "SELECT * FROM member_chat_room WHERE idx = '{$room}' AND (buyer_idx = '{$_SESSION['ss_mb_no']}' OR seller_idx = '{$_SESSION['ss_mb_no']}')";
$resultRoom = sql_fetch($sql);
if (!$resultRoom) {
    alert("참여 할수 없는 채팅방 입니다.", "../bbs/chat_list.php");
}*/

if (!$is_member) {
    alert("로그인이 필요합니다.", G5_BBS_URL . '/login.php?url=' . G5_BBS_URL . "/chat_list.php");
}else{
    $sql = "UPDATE member_chat SET confirm = NULL WHERE room_idx = '{$room}' and sender_idx != '{$_SESSION['ss_mb_no']}'";
    sql_query($sql);

    // member_product
    $sql = "select * from member_product where idx = '{$_GET['item']}'";
    $resProduct = sql_fetch($sql);
    $jsonString = $resProduct['main_image_array'];
    $imageArray = json_decode($jsonString, true);

    $imageSrc = '';
    if (!empty($imageArray) && isset($imageArray[0]['src'])) {
        $imageSrc = $imageArray[0]['src'];
    }

    // $resProduct['member_idx'] //6

    $sql = "select count(*) as cum from member_portfolio where member_idx = '{$resProduct['member_idx']}'";
    $porCount = sql_fetch($sql);
}

// 결과를 배열로 변환
$messages = [];
while ($row = sql_fetch_array($result)) {
    $messages[] = $row; // 각 메시지를 배열에 추가
}

// 날짜별로 메시지를 묶기 위한 배열
$groupedMessages = [];

// 메시지를 날짜별로 그룹화
foreach ($messages as $message) {
    // 메시지의 날짜를 추출
    $date = date('Y-m-d', strtotime($message['insert_date']));

    // 날짜가 배열에 없으면 초기화
    if (!isset($groupedMessages[$date])) {
        $groupedMessages[$date] = [];
    }

    // 해당 날짜의 메시지 추가
    $groupedMessages[$date][] = $message;
}

// 날짜를 기준으로 내림차순 정렬
ksort($groupedMessages); // 최신 날짜가 먼저 오도록 정렬

$sql0 = "SELECT * FROM member_chat_room WHERE idx = '{$room}'";
$result0 = sql_fetch($sql0);
include_once('./_head.php');
?>

    <link rel="stylesheet" href="<?= G5_URL ?>/css/chat/style.css?v=<?= G5_CSS_VER ?>">
    <input type="hidden" name="mbNo" id="mbNo" value="<?= $_SESSION['ss_mb_no'] ?>">
    <input type="hidden" name="mbRoom" id="mbRoom" value="<?= $room ?>">
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
                    // 메시지 출력
                    foreach ($groupedMessages as $date => $dateMessages) {
                        echo '<div class="date-header text-center">' . $date . '</div>'; // 날짜 출력

                        foreach ($dateMessages as $row) {
                            // 메시지 작성자 ID
                            $senderId = $row['sender_idx'];
                            // 메시지 내용
                            $message = $row['message'];
                            // 메시지 생성 시간
                            $createdAt = date('A h:i', strtotime($row['insert_date'])); // 시간 포맷 조정
                            if ($senderId === '0'){
                                echo '
                                <div class="alert-message receive">
                                    <div class="area_msg">
                                        <div class="name"><i class="fa-solid fa-hexagon-exclamation"></i> 경고</div>
                                        <div class="cont_box msg">' . $message . '</div>
                                        
                                    </div>
                                </div>
                                ';
                            }
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
                            } else if ($senderId !== '0'){
                                // 상대방이 보낸 메시지
                                $icon_file = G5_DATA_PATH . '/file/member/' . $row['sender_idx'] . '.jpg'; // 상대방의 mb_no 사용
                                if (file_exists($icon_file)) {
                                    $icon_url = G5_URL . '/data/file/member/' . $row['sender_idx'] . '.jpg';
                                    $profileImg = '<img src="' . $icon_url . '" alt="Profile Photo">';
                                } else {
                                    $profileImg = '<img src="' . G5_IMG_URL . '/img_smile.jpg" alt="Default Profile Photo">';
                                }

                                echo '<div class="receive">
                            <div class="area_img">';
                                // mb_level이 3일 경우 이미지에 a 태그 추가
                                if ($row['mb_level'] == 3) {
                                    echo '<a href="../bbs/profile.php?mb_no=' . $row['mb_no'] . '">' . $profileImg . '</a>';
                                } else {
                                    echo $profileImg;
                                }

                                echo '</div>
                                <div class="area_msg" data-idx="'.$row['idx'].'">
                                    <div class="name">' . $row['mb_nick'] . '</div>
                                    <div class="cont_box">' . $message . '</div>
                                    <div class="time date">' . $createdAt . '</div>
                                    <i class="read" data-mbNo="' . $row['fsender_idx'] . '">' . $row['confirm'] . '</i>
                                </div>
                              </div>';
                            }
                        }
                    }
                    ?>
                    <?php if ($result0['buyer_idx'] == 0 || $result0['seller_idx'] == 0): ?>

                        <div class="out-message receive">
                            <div class="area_msg">
                                <div class="cont_box msg">상대방이 채팅방에서 나가셨습니다.</div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php if ($result0['buyer_idx'] != 0 && $result0['seller_idx'] != 0): ?>
                <div class="chat_ft">
                    <div id="btn-file" class="icon_attach" onclick="document.getElementById('fileInput').click();"></div>
                    <input type="file" id="fileInput" class="hide">
                    <div id="btn-camera" class="icon_attach" style="display: none;"></div>
                    <div id="btn-image" class="icon_attach" style="display: none;"></div>
                    <div class="chat_input"><textarea placeholder="내용을 입력해 주세요." name="message" id="msg"
                                                      class="msg-form"></textarea></div>
                    <div id="submit-btn" class="icon_send btn-send"></div>
                </div>
            <?php endif; ?>
        </div>
        <div id="chat_info" class="basic" style="display: block;">
            <div class="info_wrap">
                <div class="item_info"><i class="cate"></i>
                    <h3 class="subject"></h3></div>
                <div class="company_info">
                    <div class="profile_box">
                        <div class="profile"><img
                                    src="<?= G5_URL ?><?= $imageSrc?>">
                        </div>
                        <div class="profile_info"><h3><?=$resProduct['name']?></h3> <span>포트폴리오 <?=$porCount['cum']?>건</span></div>
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

    <div id="alert-container" class="alert-message" style="display: none;"></div>

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

    <!-- alert-message-template: 경고문구. -->
    <script id="alert-message-template" type="text/template">
        <div class="alert-message receive">
            <div class="area_msg">
                <div class="name">경고</div>
                <div class="cont_box msg">{{{text}}}</div> 
            </div>
        </div>
    </script>

    <script id="out-message-template" type="text/template">
        <div class="out-message receive">
            <div class="area_msg">
                <div class="cont_box msg">{{{text}}}</div>
            </div>
        </div>
    </script>
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
            <div class="area_img">
                {{^isUser  }} <!--전문가-->
                <a href="../bbs/profile.php?mb_no={{mbNo}}">
                    <img src="../data/file/member/{{mbNo}}.jpg" alt="Profile Photo" onerror="this.onerror=null; this.src='../img/img_smile.jpg';">
                </a>
                {{/isUser  }}
                {{#isUser  }} <!--일반회원-->
                <img src="../data/file/member/{{mbNo}}.jpg" alt="Profile Photo" onerror="this.onerror=null; this.src='../img/img_smile.jpg';">
                {{/isUser  }}
            </div>
            <div class="area_msg">
                <div class="name">{{from}}</div>
                <div class="cont_box msg">{{{text}}}</div>
                <div class="time date">{{createdAt}} <span class="read-status">{{readStatus}}</span></div>
            </div>
        </div>
    </script>
    <script src="<?= G5_JS_URL ?>/socket.io.js"></script>
    <script src="<?= G5_JS_URL ?>/chat-view.js"></script>
    <script type="text/javascript" src="<?= G5_JS_URL ?>/moment.js"></script>
    <script type="text/javascript" src="<?= G5_JS_URL ?>/mustache.js"></script>
    <script>
        const btnMore = document.querySelector('.btn_more');
        const editList = document.querySelector('.edit_list.edit_list_q');
        const delet = document.querySelector('li.delete');
        btnMore.addEventListener('click', function (e) {
            e.preventDefault();

            // 현재 display 상태에 따라 보이거나 숨기기
            if (editList.style.display === 'none' || editList.style.display === '') {
                editList.style.display = 'block'; // 보이게 설정
            } else {
                editList.style.display = 'none'; // 숨기기 설정
            }
        })

        delet.addEventListener('click', function (e) {
            e.preventDefault();
            $('#basic_modal').modal('show');

            Swal.fire({
                title: '채팅 나가기',
                text: '채팅을 나가시겠습니까?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: '네, 나갈게요',
                cancelButtonText: '취소'
            }).then((result) => {
                if (result.isConfirmed) {
                    memberCharDel();
                    $.ajax({
                        type: "POST",
                        url: "../api/member_char_del.php",
                        dataType: "JSON",
                        data: {
                            'room': "<?= $_GET["room"]?>",
                            'idx': "<?=$_SESSION['ss_mb_no']?>"
                        },
                        success: function (data) {
                            if (data.status === 'success') {
                                // 성공시 메시지 없음
                                location.href = "../bbs/chat_list.php";
                            } else {
                                Swal.fire({
                                    title: '통신 실패',
                                    text: data.message || '잠시 후 다시 시도해 주세요.',
                                    confirmButtonText: '닫기',
                                });
                            }
                        },
                        error: function (xhr, status, error) {
                            Swal.fire({
                                title: '통신 실패',
                                text: '잠시 후 다시 시도해 주세요.',
                                confirmButtonText: '닫기',
                            });
                        }
                    });
                }
            });
        })
    </script>
<?php
include_once('./_tail.php');
?>