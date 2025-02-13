<?
include_once('./_common.php');
include_once('./class/Lib.php');
$name = "chat";
$g5['title'] = '채팅';
include_once('./_head.php');

$jl = new JL();

?>

<? if($name=="chat") { ?>
    <body<?php echo isset($g5['body_script']) ? $g5['body_script'] : ''; ?> class="chat">
<?}?>

    <link rel="stylesheet" href="<?=G5_URL?>/css/chat/style.css?v=<?= G5_CSS_VER ?>">

    <style>
        #container{padding:0;}
        #ft_copy{display:none;}
    </style>

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
                            <li class="ok" onClick="chatOut('<?=$room_idx?>');">확인</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 채팅방 나가기 확인 모달 -->
    <div id="vueApp">
        <chat-view></chat-view>
    </div>



    <!-- 이미지 업로드 모달 -->
    <div id="basic_modal">
        <!-- Modal -->
        <div class="modal fade" id="chataddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <ul>
                            <li id="btn-camera"><i class="fa-solid fa-camera"></i> <p>카메라</p></li>
                            <li id="btn-img"><i class="fa-solid fa-image"></i> <p>앨범</p></li>
                            <li id="btn-file"><i class="fa-solid fa-files"></i> <p>파일</p></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 이미지 업로드 모달 -->



<?
$jl->vueLoad("vueApp");
$jl->includeDir("/component/chat");
$jl->includeDir("/component/slot");
include_once('./_tail.php');
?>