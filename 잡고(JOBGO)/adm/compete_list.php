<?php
$sub_menu = "251000";
include_once('./_common.php');
include_once("../jl/JlConfig.php");

auth_check($auth[$sub_menu], 'r');

$model = new JlModel(array(
    "table" => "compete",
    "primary" => "idx",
    "autoincrement" => true,
    "empty" => false
));

$limit = 10;
$page = $_GET['page'] ? $_GET['page'] : 1;
$data = $model->get(array(
    "page" => $page,
    "limit" => $limit
));
$total_page = ceil($data['count'] / $limit);


$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';

$g5['title'] = '공모전관리';
include_once('./admin.head.php');

$colspan = 16;

$request_model = new JlModel(array(
    "table" => "compete_request",
    "primary" => "idx",
    "autoincrement" => true,
    "empty" => false
));

?>

<style>
    .mb_tbl table {text-align: center;}

</style>

<div class="local_ov01 local_ov">
    <?php echo $listall ?>
    총게시글 <?php echo number_format($data['count']) ?> 개
    <a href="?sst=mb_leave_date&amp;sod=desc&amp;sfl=<?php echo $sfl ?>&amp;stx=<?php echo $stx ?>"></a>
</div>



<div class="btn_add01 btn_add">
    <a href="./compete_form.php" id="member_add">공모전 추가</a>
</div>



<form name="fmemberlist" id="fmemberlist" action="./member_list_update.php" onsubmit="return fmemberlist_submit(this);" method="post">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="big_ctg" value="<?php echo $big_ctg ?>">
    <input type="hidden" name="small_ctg" value="<?php echo $small_ctg ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="token" value="">

    <div class="tbl_head02 tbl_wrap mb_tbl">
        <table>
            <caption><?php echo $g5['title']; ?> 목록</caption>
            <thead>
            <tr>
                <th>No</th>
                <th>업체명</th>
                <th>제목</th>
                <th>기간</th>
                <th>상금</th>
                <!--<th>진행상태</th>-->
                <th>작성일</th>
                <th>접수작품</th>
                <th>관리</th>
            </tr>
            </thead>
            <tbody>
            <? foreach($data['data'] as $index => $d) {
                $request = $request_model->where("compete_idx",$d['idx'])->get()['count'];
                ?>
                <tr>
                    <td><?=$d['data_page_no']?></td>
                    <td><?=$d['company_name']?></td>
                    <td>
                        <a href="<?=G5_URL."/bbs/compete_view.php?idx=".$d['idx']?>" target="_blank"><?=$d['subject']?></a>
                    </td>
                    <td>
                        신청 <?=explode(" ",$d['start_date'])[0]?> <br>
                        심사 <?=explode(" ",$d['end_date'])[0]?>
                    </td>
                    <td>
                        <? foreach($d['prize'] as $index2 => $i) {?>
                            <?=$i['rank']?> <?=$i['people']?> 명 <?=$i['money']?> <br>
                        <?}?>
                        <? if(!count($d['prize'])) echo "상금이 존재하지않습니다."?>
                    </td>
                    <!--<td>--><?//=$d['status']?><!--</td>-->
                    <td><?=$d['insert_date']?></td>
                    <td><a href="./compete_view.php?idx=<?=$d['idx']?>"><?=number_format($request)?>건</a></td>
                    <td>
                        <a href="./compete_form.php?idx=<?=$d['idx']?>">관리</a>
                        <a href="" onclick="event.preventDefault(); putData('<?=$d['idx']?>')">종료</a>
                        <a href="" onclick="event.preventDefault(); deleteData('<?=$d['idx']?>')">삭제</a>
                    </td>
                </tr>
            <? } ?>

            <? if(!$data['count']) {?>
                <tr><td colspan=\"".$colspan."\" class=\"empty_table\">자료가 없습니다.</td></tr>
            <?}?>

            </tbody>
        </table>
    </div>


</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page='); ?>

<? $jl->jsLoad(); ?>
<script>
    const jl = new Jl();

    async function putData(idx) {
        if(!confirm("종료 처리 하시겠습니까?")) return false;

        let obj = {idx : idx,status : "종료"};

        try {
            let res = await jl.ajax("update",obj,"/api/compete.php");
            alert("종료되었습니다.");
            window.location.reload();
        }catch (e) {
            alert(e)
        }
    }

    async function deleteData(idx) {
        if(!confirm("삭제하시겠습니까?")) return false;

        let obj = {idx : idx};

        try {
            let res = await jl.ajax("delete",obj,"/api/compete.php");
            alert("삭제되었습니다.");
            window.location.reload();
        }catch (e) {
            alert(e)
        }
    }
</script>

<script>
    $(document).ready(function () {

    })

    function fmemberlist_submit(f)
    {
        if (!is_checked("chk[]")) {
            alert(document.pressed+" 하실 항목을 하나 이상 선택하세요.");
            return false;
        }

        if(document.pressed == "선택삭제") {
            if(!confirm("선택한 자료를 정말 삭제하시겠습니까?")) {
                return false;
            }
        }

        return true;
    }

    function ctg_change(type) {

        var big_ctg = $("#big_ctg").val();
        if (type == 'small'){
            var small_ctg = $("#small_ctg").val();
        }else{
            var small_ctg = "";
        }
        var params = "",
            sfl = $("#sfl").val(),
            stx = $("#stx").val();

        if (stx != "" || big_ctg != "" || small_ctg != "") {
            params += (params == "")? "?" : "&";
            params += "sfl=" + sfl + "&stx=" + stx+ "&big_ctg=" + big_ctg + "&small_ctg=" + small_ctg;
        }

        location.href = g5_admin_url + "/competition_list.php" + params;

    }

</script>

<?php
include_once ('./admin.tail.php');
?>
