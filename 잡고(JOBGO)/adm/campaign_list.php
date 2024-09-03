<?php
$sub_menu = "251100";
include_once('./_common.php');
include_once("../jl/JlConfig.php");

auth_check($auth[$sub_menu], 'r');

$model = new JlModel(array(
    "table" => "campaign",
    "primary" => "idx",
    "autoincrement" => true,
    "empty" => false
));

if($_GET['category']) $model->where("category",$_GET['category']);


$limit = 10;
$page = $_GET['page'] ? $_GET['page'] : 1;
$data = $model->get($page,$limit);
$total_page = ceil($data['count'] / $limit);

$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';

$g5['title'] = '캠페인관리';
include_once('./admin.head.php');



$colspan = 16;

$request_model = new JlModel(array(
    "table" => "campaign_request",
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

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">
    <input type="hidden" name="big_ctg" value="<?php echo $big_ctg ?>">
    <input type="hidden" name="small_ctg" value="<?php echo $small_ctg ?>">
    <label for="sfl" class="sound_only">검색대상</label>

</form>
<form id="fsearch2" name="fsearch2" class="local_sch01 local_sch" method="get">
    <label for="big_ctg" class="sound_only">검색대상</label>
    <select name="big_ctg" id="big_ctg" onchange="ctg_change(this.value);">
        <option value="">카테고리</option>
        <option value="SNS">SNS</option>
        <option value="디자인">디자인</option>
        <option value="체험단">체험단</option>
    </select>
</form>
<div class="btn_add01 btn_add">
    <a href="./campaign_form.php" id="member_add">캠페인 추가</a>
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
                <th>카테고리</th>
                <th>업체명</th>
                <th>제목</th>
                <th>모집기간</th>
                <th>활동기간</th>
                <th>제공캐쉬</th>
                <th>진행상태</th>
                <th>작성일</th>
                <th>모집인원</th>
                <th>관리</th>
            </tr>
            </thead>
            <tbody>
            <? foreach ($data['data'] as $index => $d) {
                $request = $request_model->where("campaign_idx",$d['idx'])->get()['count'];
                $request_model->where("campaign_idx",$d['idx']);
                $select = $request_model->where("status","선정")->get()['count'];
                ?>
                <tr>
                    <td><?=$d['data_page_nor']?></td>
                    <td><?=$d['category']?></td>
                    <td><?=$d['company_name']?></td>
                    <td><?=$d['subject']?></td>
                    <td><?=$d['recruitment_date']?></td>
                    <td><?=$d['activity_date']?></td>
                    <td><?=$d['service_cash']?></td>
                    <td><?=$d['status']?></td>
                    <td><?=$d['insert_date']?></td>
                    <td><a href="./campaign_view.php?idx=<?=$d['idx']?>">지원 <?=$request?>명 | 선정 <?=$select?>명</a></td>
                    <td>
                        <a href="./campaign_form.php?idx=<?=$d['idx']?>">관리</a>
                        <a href="" onclick="event.preventDefault(); deleteData('<?=$d['idx']?>')">삭제</a>
                    </td>
                </tr>
            <? }
            if ($data['count'] == 0)
                echo "<tr><td colspan=\"".$colspan."\" class=\"empty_table\">자료가 없습니다.</td></tr>";
            ?>


            <?/*php
            $list_rows = 15;
            $list_no = $total_count - ($list_rows * ($page - 1));
            for ($i=0; $row=sql_fetch_array($result); $i++) {

                $s_mod = '<a href="./compete_form.php?'.$qstr.'&amp;w=u&amp;idx='.$row['cp_idx'].'">보기/수정</a>';

                $bg = 'bg'.($i%2);
                $mb = get_member($row['mb_id']);
                ?>
                <tr class="<?php echo $bg; ?>">

                </tr>

                <?php
                $list_no--;
            }
            if ($i == 0)
                echo "<tr><td colspan=\"".$colspan."\" class=\"empty_table\">자료가 없습니다.</td></tr>";
            */?>
            </tbody>
        </table>
    </div>


</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?category='.$_GET['category'].'&amp;page='); ?>
<? $jl->jsLoad(); ?>
<script>
    const jl = new Jl();

    async function deleteData(idx) {
        if(!confirm("삭제하시겠습니까?")) return false;

        let obj = {idx : idx};

        try {
            let res = await jl.ajax("delete",obj,"/api/campaign.php");
            alert("삭제되었습니다.");
            window.location.reload();
        }catch (e) {
            alert(e)
        }
    }

    function ctg_change(type) {

        location.href = g5_admin_url + "/campaign_list.php?category=" + type;

    }

</script>

<?php
include_once ('./admin.tail.php');
?>
