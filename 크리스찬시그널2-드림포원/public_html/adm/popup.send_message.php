<?php
$sub_menu = "200100";
include_once('./_common.php');

$title = '';
if(!empty($_GET['mb_no'])) {
    $mb_no = $_GET['mb_no'];
    $mb_id = sql_fetch(" select mb_id from g5_member where mb_no = {$mb_no} ")['mb_id'];

    $mb = get_member($mb_id);

    $title = $mb['mb_nick'] . '님께 메세지 보내기';
} else {
    $title = '단체 메세지 보내기';
}


$g5['title'] = '메세지 보내기';
include_once(G5_PATH.'/head.sub.php');
?>

<style>
    #menu_frm {
        text-align: center;
        overflow-y: hidden;
    }
    #menu_frm .metf {
        font-size: 1.7em;
        font-weight: 500;
        padding: 30px 20px 10px 20px;
    }
</style>

<div id="menu_frm" class="new_win">
    <div class="metf"><?=$title?></div>

    <form name="fsendform" id="fsendform" method="post" action="./send_message_update.php" onsubmit="return fsendform_submit(this);" autocomplete="off">
        <input type="hidden" name="w" id="w" value="<?=$w?>">
        <input type="hidden" name="idx" id="idx" value="<?=$_GET['idx']?>">

        <div class="tbl_head01 tbl_wrap">
            <textarea class="form-control doc-text" rows="10" id="message" name="message" style="resize: unset;"></textarea>
        </div>

        <div class="btn_confirm01 btn_confirm">
            <input type="button" name="act_button" value="확인" class="btn_submit" onclick="send_message('<?=$mb_no?>')">
        </div>

    </form>

</div>

<script>
function fsendform_submit(f)
{
    return true;
}

// 메시지 전송하기
var is_post = false;
function send_message(mb_no) {
    if(is_post) {
        return false;
    }
    is_post = true;

    $.ajax({
        type: 'POST',
        url: g5_bbs_url + "/ajax.send_message.php",
        data: {mb_no: mb_no, message:  $('textarea#message').val() },
        success: function (data) {
            if(data == 'success') {
                alert('메세지를 전송하였습니다.');
                window.close();
                is_post = false;
            }
        }
    });
}
</script>

<?php
include_once(G5_PATH.'/tail.sub.php');
?>