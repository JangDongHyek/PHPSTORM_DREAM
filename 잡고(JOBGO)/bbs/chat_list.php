<?php
include_once('./_common.php');
$g5['title'] = '문의';
include_once(G5_PATH . '/head.php');
?>

<style>
    /*로딩바*/
    #mask { position:absolute; z-index:9000; background-color:#000000; display:none; left:0; top:0;}
    #loadingImg { position:absolute; left:50%; top:50%; display:none; z-index:10000;    transform: translate(-50%, -50%);}
    #loadingImg img {
        width: 80px;
        height: 80px;
    }
</style>

<div id="MessageBoxWrap" class="appVer">
    <div class="msgList">
        <div class="ListSearch">
            <form name="fsearch" method="get">
                <input type="hidden" name="idx" id="idx" value="<?=$ta_idx?>">
                <input type="hidden" name="sel_room_id" id="sel_room_id" value="<?=$room_id?>"> <!--채팅목록에서 선택한 채팅방-->
                <div class="blockBox">
                    <div>
                        <label for="sch_state" class="sound_only">검색창</label>
                        <select name="sel" id="sch_state">
                            <option value="room_name" <?php echo $sel == 'room_name' ? 'selected' : '' ?>>닉네임</option>
                            <option value="ta_title" <?php echo $sel == 'ta_title' ? 'selected' : '' ?>>재능명</option>
                        </select>
                    </div>
                    <div style="position: relative">
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
</div>

<script src = "<?=G5_JS_URL?>/socket.io.js"> </script>
<script src = "<?=G5_JS_URL?>/chat.js"></script>
<script type="text/javascript">
	chatLogin('<?=$member['mb_id']?>');
	chatList('<?=$member['mb_id']?>');

    // 로딩바 표시
    function showLoadingBar() {
        var maskHeight = $(document).height();
        var maskWidth = window.document.body.clientWidth;
        var mask = "<div id='mask'></div>";
        var loadingImg = '';
        loadingImg += "<div id='loadingImg'>";
        loadingImg += "<img src='<?=G5_IMG_URL?>/loading.gif'/>";
        loadingImg += "</div>";
        $('body').append(mask).append(loadingImg);
        $('#mask').css({'width': maskWidth, 'height': maskHeight, 'opacity': '0.3'})
        $('#mask').show();
        $('#loadingImg').show();
    }

    // 로딩바 숨김
    function hideLoadingBar() {
        $('#mask, #loadingImg').hide();
        $('#mask, #loadingImg').remove();
    }
</script>

<?php
include_once(G5_PATH.'/tail.php');
?>