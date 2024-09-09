
<?php
$sub_menu = "251000";
include_once('./_common.php');
include_once("../jl/JlConfig.php");
include_once('./admin.head.php');

if(!isset($_GET['idx'])) {
    echo "idx가 존재하지않는 잘못된 접근입니다.";
    die();
}

$model = new JlModel(array(
    "table" => "campaign_request_history",
    "primary" => "idx",
    "autoincrement" => true,
    "empty" => false
));

$campaign_request_model = new JlModel(array(
    "table" => "campaign_request"
));

$g5_member_model = new JlModel(array(
    "table" => "g5_member",
    "primary" => "mb_no"
));

$histories = $model->where("request_idx",$_GET['idx'])->get();

$request = $campaign_request_model->where("idx",$_GET['idx'])->get()['data'][0];
$user = $g5_member_model->where("mb_no",$request['user_idx'])->get()['data'][0];
?>
<style>
    #hd {display: none}
    #ft {display: none}
    #lnb {display: none}
    #container > h1 {display: none}
    #wrapper {min-width: unset!important;}
</style>
<div class="tbl_head02 tbl_wrap">
    <h6 class="title"><?=$user['mb_name']?></h6>
    <p class="sub"><b>아이디</b> <?=$user['mb_id']?> | <b>연락처</b> <?=$user['mb_hp']?> </p>
    <table>
        <thead>
        <tr>
            <th>No</th>
            <th>보고일</th>
            <th>활동링크</th>
            <th>설명</th>
            <th>상태변경일</th>
            <th>변경상태</th>
        </tr>
        </thead>
        <tbody>
            <?foreach ($histories['data'] as $index => $d) {?>
            <tr>
                <td><?=$d['data_page_no']?></td>
                <td><?=$d['report_date']?></td>
                <td><a target="_blank" href="<?=$d['activity_link']?>"><i class="fa-solid fa-link"></i>활동링크</a></td>
                <td><div style="width: 300px" readonly><?=$d['description']?></div></td>
                <td><?=$d['insert_date']?></td>
                <td><?=$d['report_status']?></td>
            </tr>

            <?if($d['report_status'] == '수정요청') {?>
            <tr>
                <td colspan="2"></td>
                <td colspan="4">
                    <textarea readonly><?=$d['update_comment']?></textarea>
                </td>
            </tr>
            <?}}?>

        <?if(!$histories['count']) {?>
            <tr>
                <td colspan="7" style="text-align: center">히스토리가 존재하지않습니다.</td>
            </tr>
        <?}?>

        </tbody>
    </table>
</div>


<?php
include_once('./admin.tail.php');
?>
