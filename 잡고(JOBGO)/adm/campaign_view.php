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
$request_model->join("g5_member","user_idx","mb_no");
$request_model->where("campaign_idx",$_GET['idx']);
$request = $request_model->orderBy("status","ASC")->orderBy("insert_date","DESC")->get(array(
        "select" => array("g5_member.mb_name","g5_member.mb_id","g5_member.mb_hp")
));

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
    <h6 class="title"><a href="<?php echo G5_BBS_URL ?>/campaign_view.php" target="_blank"><?=$campaign['subject']?></a> <span><?=$campaign['company_name']?></span></h6>
    <p class="sub"><b>선정기간</b> ~ <?=$campaign['recruitment_date']?> <b>활동기간</b> ~ <?=$campaign['activity_date']?> </p>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>신청일</th>
                <th>참여자(아이디)</th>
                <th>연락처</th>
                <th>SNS 링크</th>
                <th>선정</th>
                <th>최초보고일</th>
                <th>활동링크</th>
                <th>설명 / 수정요청</th>
                <th>상태</th>
            </tr>
        </thead>
        <tbody>
            <? foreach ($request['data'] as $index => $d) {?>
            <tr>
                <td><?=$d['data_page_no']?></td>
                <td><?=$d['insert_date']?></td>
                <td><?=$d['mb_name']?>(<?=$d['mb_id']?>)</td>
                <td><?=$d['mb_hp']?></td>
                <td><a href="<?=$d['sns_link']?>" target="_blank"><?=$d['sns_link'] ?: '-' ?></a></td>
                <td class="<?=$d['status'] == '선정' ? 'bg3' : 'bg2'?>">
                    <!--
                    <select onchange="putRequest('<?=$d['idx']?>',event.target.value)">
                        <option value="">대기</option>
                        <option value="선정" <?=$d['status'] == '선정' ? 'selected' : ''?>>선정</option>
                        <option value="탈락" <?=$d['status'] == '탈락' ? 'selected' : ''?>>탈락</option>
                    </select>
                    -->

                    <select onchange="changeStatus('<?=$d['idx']?>',event.target.value)">
                        <option value="">대기</option>
                        <option value="선정" <?=$d['status'] == '선정' ? 'selected' : ''?>>선정</option>
                        <option value="탈락" <?=$d['status'] == '탈락' ? 'selected' : ''?>>탈락</option>
                    </select>
                </td>
                <td><?=$d['report_date'] ?: '-' ?></td>
                <td><a target="_blank" href="<?=$d['activity_link']?>"><i class="<?=$d['activity_link'] ? 'fa-solid fa-link' : ''?>"></i><?=$d['activity_link'] ? '활동링크' : '' ?></a></td>
                <td>
                    <div style="width: 300px" readonly><?=$d['description'] ?: '-' ?></div>
                    <textarea style="width: 300px" placeholder="수정요청을 입력하세요." id="textarea<?=$d['idx']?>" oninput="onStatus('<?=$d['idx']?>')"><?=$d['update_comment']?></textarea>
                    <!--<input type="button" value="저장" onclick="" class="btn_01">-->
                </td>
                <td>
                    <select onchange="changeStatus2('<?=$d['idx']?>',event.target.value)">
                        <option value="">대기</option>
                        <option value="보고" <?=$d['report_status'] == '보고' ? 'selected' : ''?>>보고</option>
                        <option value="수정요청" <?=$d['report_status'] == '수정요청' ? 'selected' : ''?>>수정요청</option>
                        <option value="보고완료" <?=$d['report_status'] == '보고완료' ? 'selected' : ''?>>보고완료</option>
                    </select>&nbsp;<br>
                    <a href="./campaign_submit?idx=<?=$d['idx']?>" onclick="window.open(this.href, '_blank', 'width=800, height=600'); return false;"><i class="fa-solid fa-link"></i> 히스토리</a>
                </td>
            </tr>
            <?}?>
        </tbody>
    </table>
</div>


<div class="btn_confirm01 btn_confirm">
    <input type="button" value="저장" onclick="putRequest2()" style="background: #0A7CC7" class="btn_submit"accesskey='s'>
    <a href="./campaign_list.php?<?php echo $qstr ?>">목록</a>
</div>

</form>

<? $jl->jsLoad(); ?>

<script>
    const jl = new Jl();
    let users = [];

    async function putRequest2() {
        try {
            if(!users.length) {
                alert("바뀐 데이터가 없습니다.");
                return false;
            }

            let obj = {
                campaign_idx : "<?=$_GET['idx']?>",
                aa : "aa",
                users : users
            }
            let res = await jl.ajax("update2",obj,"/api/campaign_request.php");
            alert("저장되었습니다.");
            window.location.reload();
        }catch (e) {
            alert(e.message)
        }
    }

    function onStatus(idx) {
        let update_comment = $(`#textarea${idx}`).val();

        let newObj = {idx:idx,update_comment:update_comment}
        let obj = jl.findObject(users,"idx",idx)

        if (obj) {
            obj.update_comment = update_comment
        }else {
            users.push(newObj);
        }
    }

    function changeStatus2(idx,report_status) {
        let newObj = {idx:idx,report_status:report_status}
        let obj = jl.findObject(users,"idx",idx)

        if (obj) {
            obj.report_status = report_status
        }else {
            users.push(newObj);
        }
    }

    function changeStatus(idx,status) {
        let newObj = {idx:idx,status:status}
        let obj = jl.findObject(users,"idx",idx)

        if (obj) {
            // 같은 idx를 가진 객체가 있으면 기존 객체를 삭제합니다.
            obj.status = status
        }else {
            users.push(newObj);
        }
    }

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
