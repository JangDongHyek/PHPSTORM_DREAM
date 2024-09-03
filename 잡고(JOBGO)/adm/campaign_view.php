<?php
$sub_menu = "251000";
include_once('./_common.php');
include_once("../jl/JlConfig.php");

auth_check($auth[$sub_menu], 'w');

if(!$_GET['idx']) alert("잘못된 접근입니다.");

//캠페인 데이터
$campaign_model = new JlModel(array(
    "table" => "campaign",
    "primary" => "idx",
    "autoincrement" => true,
    "empty" => false
));
$campaign = $campaign_model->where("idx",$_GET['idx'])->get()['data'][0];

//신청자
$request_model = new JlModel(array(
    "table" => "campaign_request",
    "primary" => "idx",
    "autoincrement" => true,
    "empty" => false
));
$request_model->where("campaign_idx",$_GET['idx']);
$request = $request_model->orderBy("status","ASC")->orderBy("insert_date","DESC")->get();

$request_model = new JlModel(array(
    "table" => "campaign_request",
    "primary" => "idx",
    "autoincrement" => true,
    "empty" => false
));

$g5['title'] = '캠페인 '.$html_title;
include_once('./admin.head.php');

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨


?>
<style>
    .title {margin-bottom: 10px; font-size: 2em}
    .title span {font-size: 12px}
    .sub {margin-bottom: 15px;font-size: 16px}
</style>


<div class="tbl_head02 tbl_wrap">
    <h6 class="title"><a href="<?php echo G5_BBS_URL ?>/campaign_view.php" target="_blank">캠페인명</a> <span>업체명</span></h6>
    <p class="sub"><b>선정기간</b> ~ 24.01.01 <b>활동기간</b> ~ 24.01.01 </p>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>신청일</th>
                <th>참여자(아이디)</th>
                <th>연락처</th>
                <th>SNS 링크</th>
                <th>보고일</th>
                <th>활동링크</th>
                <th>설명</th>
                <th>선정</th>
            </tr>
        </thead>
        <tbody>
            <? foreach ($request['data'] as $index => $d) {?>
            <tr>
                <td><?=$d['data_page_no']?></td>
                <td><?=$d['insert_date']?></td>
                <td>참여자(아이디)</td>
                <td>010-0000-0000</td>
                <td><a href="<?=$d['sns_link']?>" target="_blank"><?=$d['sns_link'] ?: '-' ?></a></td>
                <td><?=$d['report_date'] ?: '-' ?></td>
                <td><a target="_blank" href="<?=$d['activity_link']?>"><i class="<?=$d['activity_link'] ? 'fa-solid fa-link' : ''?>"></i><?=$d['activity_link'] ? '활동링크' : '-' ?></a></td>
                <td><textarea style="width: 500px"><?=$d['description']?></textarea></td>
                <td>
                    <select onchange="putRequest('<?=$d['idx']?>',event.target.value)">
                        <option value="">대기</option>
                        <option value="선정" <?=$d['status'] == '선정' ? 'selected' : ''?>>선정</option>
                        <option value="탈락" <?=$d['status'] == '탈락' ? 'selected' : ''?>>탈락</option>
                    </select>
                </td>
            </tr>
            <?}?>
        </tbody>
    </table>
</div>

<div class="btn_confirm01 btn_confirm">
    <input type="submit" value="저장" style="background: #0A7CC7" class="btn_submit"accesskey='s'>
    <a href="./campaign_list.php?<?php echo $qstr ?>">목록</a>
</div>

</form>

<? $jl->jsLoad(); ?>

<script>
    const jl = new Jl();

    async function putRequest(idx,status) {
        try {
            let obj = {
                idx : idx,
                status : status
            }

            let res = await jl.ajax("update",obj,"/api/campaign_request.php");
        }catch (e) {
            alert(e.message)
        }
    }

</script>


<?php
include_once('./admin.tail.php');
?>
