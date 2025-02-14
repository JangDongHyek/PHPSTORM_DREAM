<?php
$sub_menu = "250100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'w');

$idx = $_GET['idx'];

$me = sql_fetch(" select me.*, send.mb_name as send_mb_name, receive.mb_name as receive_mb_name from g5_message as me left join g5_member as send on me.send_mb_id = send.mb_id left join g5_member as receive on me.receive_mb_id = receive.mb_id where me.idx = {$idx} ");

$g5['title'] .= '메세지 상세 정보';
include_once('./admin.head.php');

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js
?>

<style>
    body, input::placeholder {
        font-family: "Nanum Gothic";
    }
    table caption {
        height: 30px;
        font-size: 15px;
        overflow: hidden;
        text-align: left;
        font-weight: bold;
        line-height: 1.5;
    }
    .mb_5 {
        margin-bottom: 5px;
    }
    .code {
        float: left;
        width: 100px;
        height: 20px;
        border: 1px solid black;
        text-align: center;
        margin-right: 5px;
        margin-bottom: 5px;
        cursor: pointer;
    }
    .btn_add .tab {float: left; list-style: none; padding: 0; margin: 0; margin-bottom: 10px;}
    .btn_add .tab li {float: left;}
    .btn_add .tab a {border-left: 0; background: #FFF;}
    .btn_add .tab .on {background: #f0f0f0;}
    .btn_add .tab li:nth-child(1) a {border-left: 1px solid #ccc;}
    .on {background: lightblue;}
    .btn_approval {
        margin: 0; padding: 0; border: 0; background: blue; color: #fff; cursor: pointer;
    }
    .btn_confirm .btn_approval {
         padding: 0 15px; border: 0; height: 30px; color: #fff;
    }
    .file_select {
        border: 1px solid black; width: 80px; text-align: center; margin-top: 5px; background-color: lightgray;height; height: 20px;
    }
</style>

<script>
$(function() {
});

function fmember_submit(f)
{
    return true;
}
</script>

<form name="fmember" id="fmember" action="./adm.ajax.controller.php" onsubmit="fmember_submit(this);" method="post">
    <input type="hidden" name="mode" value="message_update">
    <input type="hidden" name="idx" value="<?=$idx?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="token" value="">
    <input type="hidden" name="sca" value="<?=$sca?>">

    <!-- 회원-기본정보 -->
    <div class="tbl_frm01 tbl_wrap tab_member">
        <table>
            <!--<caption>기본 정보</caption>-->
            <colgroup>
                <col class="grid_4">
                <col>
                <col class="grid_4">
                <col>
            </colgroup>
            <tbody>
            <tr>
                <th scope="row"><label for="send_mb_name">보낸 이름<?php echo $sound_only ?></label></th>
                <td>
                    <?php echo $me['send_mb_name'] ?>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="receive_mb_name">받는 이름<?php echo $sound_only ?></label></th>
                <td>
                    <?php echo $me['receive_mb_name'] ?>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="message">메세지<?php echo $sound_only ?></label></th>
                <td>
                    <textarea name="message" class="frm_input"><?php echo strip_tags($me['message']) ?></textarea>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="message_date">전송 일시<?php echo $sound_only ?></label></th>
                <td>
                    <?php echo substr($me['message_date'],0,16) ?>
                </td>
            </tr>
            <?php if ($me["up_datetime"] != null){ ?>
                <tr>
                    <th scope="row"><label for="message_date">수정 일시<?php echo $sound_only ?></label></th>
                    <td>
                        <?php echo substr($me['up_datetime'],0,16) ?>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

    <div class="btn_confirm01 btn_confirm">
        <input type="submit" value="확인" class="btn_submit" style="background: #0f192a" accesskey='s'>
        <a href="./message_list.php?<?php echo $qstr ?>">목록</a>
        <input type="button" value="삭제" class="btn_submit" onclick="message_del();" style="float: right" accesskey='s'>

    </div>
</form>

<?php
include_once('./admin.tail.php');
?>
<script>
    function message_del() {
        if (confirm("삭제하시겠습니까? 삭제 시 메세지는 영원히 삭제되며 복구가 불가능합니다.")){
            $("[name = mode]").val("message_del");
            $("#fmember").submit();
        }
    }
</script>
