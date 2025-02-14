<?php
$sub_menu = "200100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'w');

$mb_id = $_GET['mb_id'];
$mb = get_member($mb_id);

$mr = sql_fetch(" select * from g5_member_report where report_mb_no = {$mb['mb_no']} ");

$g5['title'] .= '신고 회원 '.$html_title;
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

<form name="fmember" id="fmember" action="./member_report_form_update.php" onsubmit="fmember_submit(this);" method="post" enctype="multipart/form-data">
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
        <th scope="row"><label for="report_category">신고 사유<?php echo $sound_only ?></label></th>
        <td>
            <input type="text" name="report_category" value="<?php echo $mr['report_category'] ?>" id="report_category" class="frm_input" readonly size="30">
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="report_contents">신고 내용<?php echo $sound_only ?></label></th>
        <td>
            <textarea name="report_contents" class="frm_input" readonly><?php echo $mr['report_contents'] ?></textarea>
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="report_date">신고 일자<?php echo $sound_only ?></label></th>
        <td>
            <input type="text" name="report_date" value="<?php echo $mr['report_date'] ?>" id="report_date" class="frm_input" readonly size="30">
        </td>
    </tr>
    </tbody>
    </table>
</div>

<div class="btn_confirm01 btn_confirm">
    <!--<input type="submit" value="확인" class="btn_submit" accesskey='s'>-->
    <a href="./member_report_list.php?<?php echo $qstr ?>">목록</a>
</div>
</form>

<script>
$(function() {
});

function fmember_submit(f)
{
    return true;
}
</script>

<?php
include_once('./admin.tail.php');
?>
