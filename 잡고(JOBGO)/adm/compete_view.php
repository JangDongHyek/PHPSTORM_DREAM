<?php
$sub_menu = "251000";
include_once('./_common.php');
include_once("../jl/JlConfig.php");

auth_check($auth[$sub_menu], 'w');

if(!$_GET['idx']) alert("잘못된 접근입니다.");

//캠페인 데이터
$compete_model = new JlModel(array(
    "table" => "compete",
    "primary" => "idx",
    "autoincrement" => true,
    "empty" => false
));
$compete = $compete_model->where("idx",$_GET['idx'])->get()['data'][0];

//신청자
$request_model = new JlModel(array(
    "table" => "compete_request",
    "primary" => "idx",
    "autoincrement" => true,
    "empty" => false
));
$request_model->join("g5_member","user_idx","mb_no");
$request_model->where("compete_idx",$_GET['idx']);
$request = $request_model->orderBy("status","ASC")->orderBy("insert_date","DESC")->get(array(
    "select" => array("g5_member.mb_name","g5_member.mb_id","g5_member.mb_hp")
));

$request_model = new JlModel(array(
    "table" => "compete_request",
    "primary" => "idx",
    "autoincrement" => true,
    "empty" => false
));

$g5['title'] = '공모전 '.$html_title;
include_once('./admin.head.php');

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨


?>
<style>
    .title {margin-bottom: 10px; font-size: 2em}
    .title span {font-size: 12px}
    .sub {margin-bottom: 15px;font-size: 16px}
</style>


<div class="tbl_head02 tbl_wrap">
    <h6 class="title"><a href="<?php echo G5_BBS_URL ?>/compete_view.php" target="_blank">공모전명</a> <span>업체명</span></h6>
    <p class="sub"><b>기간</b> <?=explode(" ",$compete['start_date'])[0]?>-<?=explode(" ",$compete['end_date'])[0]?> (<?=$compete['status']?>)</p>
    <?foreach($compete['prize'] as $c) {?>
        <p><b>상금</b> <?=$c['rank']?>등 * <?=$c['people']?>명 * <?=number_format($c['money'])?>원</p>
    <?}?>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>참여일</th>
                <th>참여자(아이디)</th>
                <th>연락처</th>
                <th>제출파일</th>
                <th>설명</th>
                <th>선정</th>
            </tr>
        </thead>
        <tbody>
            <?foreach($request['data'] as $index => $d){?>
            <tr>
                <td><?=$d['data_page_no']?></td>
                <td><?=$d['insert_date']?></td>
                <td><?=$d['mb_name']?>(<?=$d['mb_id']?>)</td>
                <td><?=$d['mb_hp']?></td>
                <td><a href="<?=G5_URL."/".$d['compete_file'][0]['src']?>" download="<?=$d['compete_file'][0]['name']?>"><i class="fa-regular fa-paperclip"></i> 제출파일</a></td>
                <td><textarea style="width: 800px"><?=$d['description']?></textarea></td>
                <td>
                    <select onchange="changeStatus('<?=$d['idx']?>',event.target.value)">
                        <option value="" <?=$d['status'] == '' ? 'selected' : ''?>>대기</option>
                        <?foreach ($compete['prize'] as $p) {?>
                            <option value="<?=$p['rank']?>" <?=$d['status'] == $p['rank'] ? 'selected' : ''?>><?=$p['rank']?>등 * <?=$p['people']?></option>
                        <?}?>
                        <option value="탈락" <?=$d['status'] == '탈락' ? 'selected' : ''?>>탈락</option>
                    </select>
                </td>
            </tr>
            <?}?>
        </tbody>
    </table>
</div>

<div class="btn_confirm01 btn_confirm">
    <input type="button" value="저장" style="background: #0A7CC7" class="btn_submit" accesskey='s' onclick="putRequest2()">
    <a href="./compete_list.php?<?php echo $qstr ?>">목록</a>
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
                compete_idx : "<?=$_GET['idx']?>",
                aa : "aa",
                users : users
            }

            let res = await jl.ajax("update2",obj,"/api/compete_request.php");
            alert("저장되었습니다.");
            window.location.reload();
        }catch (e) {
            alert(e.message)
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
</script>


<?php
include_once('./admin.tail.php');
?>
