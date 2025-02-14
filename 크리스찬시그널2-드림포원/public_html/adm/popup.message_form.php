<?php
include_once('./_common.php');

auth_check($auth[$sub_menu], 'w');

$idx = $_GET['idx'];

$me = sql_fetch(" select me.*, send.mb_name as send_mb_name, receive.mb_name as receive_mb_name from g5_message as me left join g5_member as send on me.send_mb_id = send.mb_id left join g5_member as receive on me.receive_mb_id = receive.mb_id where me.idx = {$idx} ");

$g5['title'] .= '메세지 상세 정보';
//include_once('./admin.head.php');

if (defined('G5_IS_ADMIN')) {
    if (!defined('_THEME_PREVIEW_'))
        echo '<link rel="stylesheet" href="' . G5_ADMIN_URL . '/css/admin.css">' . PHP_EOL;
} else {
    echo '<link rel="stylesheet" href="' . G5_CSS_URL . '/' . (G5_IS_MOBILE ? 'mobile' : 'default') . '.css">' . PHP_EOL;
}
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
    table {
        font-size: 13px;
    }
</style>

<h1 style="margin-top: 20px;"><?=$g5['title']?></h1>

<form name="fmember" id="fmember" method="post" enctype="multipart/form-data">
<input type="hidden" name="w" value="<?php echo $w ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="">
<input type="hidden" name="sca" value="<?=$sca?>">

<?php for ($i=1; $i<=10; $i++) { ?>
<input type="hidden" name="mb_<?php echo $i ?>" value="<?php echo $mb['mb_'.$i] ?>" id="mb_<?php echo $i ?>">
<?php } ?>

<!-- 회원-기본정보 -->
<div class="tbl_frm01 tbl_wrap tab_member" style="margin-top: 20px;">
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
            <input type="text" name="send_mb_name" value="<?php echo $me['send_mb_name'] ?>" id="send_mb_name" class="frm_input" readonly size="30">
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="receive_mb_name">받는 이름<?php echo $sound_only ?></label></th>
        <td>
            <input type="text" name="receive_mb_name" value="<?php echo $me['receive_mb_name'] ?>" id="receive_mb_name" class="frm_input" readonly size="30">
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="message">메세지<?php echo $sound_only ?></label></th>
        <td>
            <textarea name="message" class="frm_input" readonly><?php echo $me['message'] ?></textarea>
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="message_date">전송 일시<?php echo $sound_only ?></label></th>
        <td>
            <input type="text" name="message_date" value="<?php echo substr($me['message_date'],0,16) ?>" id="message_date" class="frm_input" readonly size="30">
        </td>
    </tr>
    </tbody>
    </table>
</div>

<div class="btn_confirm01 btn_confirm">
    <!--<input type="submit" value="확인" class="btn_submit" accesskey='s'>-->
    <a href="./popup.message_list.php?<?php echo $qstr ?>">목록</a>
</div>
</form>