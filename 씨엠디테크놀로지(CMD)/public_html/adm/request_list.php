<?php
$sub_menu = "400000";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$sql_common = " from g5_request ";


$sql_search = " where 1 ";


if ($stx) {
    $sql_search .= " and ( ";
    $sql_search .= " ({$sfl} like '{$stx}%') ";

    $sql_search .= " ) ";
}
if (!$sst) {
    $sst = "idx";
    $sod = "desc";
}

$sql_order = " order by {$sst} {$sod} ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';

$g5['title'] = '견적관리';
include_once('./admin.head.php');

$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);

$colspan = 16;
$status = array("접수","확인중","완료");
?>
<style>
    .admin-modal {
        position: fixed;
        top: 0px;
        left: 0px;
        width: 100%;
        height: 100vh;
        z-index: 10;
        display:none;

    }
    .admin-modal-back{
        position: fixed;
        top: 0px;
        left: 0px;
        width: 100%;
        height: 100vh;
        z-index: 10;
        background-color: rgba(0, 0, 0, 0.5);
    }
    .admin-modal-form{
        position: fixed;
        background-color: #fff;
        top: calc((100vh - 150px) / 2);
        left: calc((100% - 800px) / 2);
        height: 150px;
        z-index: 11;
        width: 800px;
        padding: 10px;
        border-radius: 10px
    }
    .status{
        width:100%;
        padding:0px;
    }
    .status1{ display:inline; background:#333; color:#fff; padding:7px 12px; text-align:center; font-weight:bold;}
    .status2{ display:inline; background:#7f9231; color:#fff; padding:7px 12px; text-align:center; font-weight:bold;}
    .status3{ display:inline; background:#08a2cd; color:#fff; padding:7px 12px; text-align:center; font-weight:bold;}
    .status li{
        list-style: none;
        width:97%;
        border-bottom:1px solid #ccc;
        padding:10px;
    }
    .status .active{
        background-color:#00adff;
        color:#fff;
        font-weight: bold;
    }
</style>
<div class="local_ov01 local_ov">
    <?php echo $listall ?>
    총 견적수 <?php echo number_format($total_count) ?>개
</div>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">

    <label for="sfl" class="sound_only">검색대상</label>
    <select name="sfl" id="sfl">
        <option value="mb_id"<?php echo get_selected($_GET['sfl'], "mb_id"); ?>>회원아이디</option>
        <option value="mb_name"<?php echo get_selected($_GET['sfl'], "mb_name"); ?>>회원이름</option>
    </select>
    <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
    <input type="text" name="stx" value="<?php echo $stx ?>" id="stx" required class="required frm_input">
    <input type="submit" class="btn_submit" value="검색">

</form>




<form name="fmemberlist" id="fmemberlist" action="<?php echo G5_BBS_URL?>/board_list_update.php" onsubmit="return fmemberlist_submit(this);" method="post">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="bo_table" value="category">
    <input type="hidden" name="token" value="">

    <div class="tbl_head02 tbl_wrap">
        <table>
            <caption><?php echo $g5['title']; ?> 목록</caption>
            <thead>
            <tr>
                <th scope="col">번호</th>
                <th scope="col">제품명</th>
                <th scope="col">아이디(이름)</th>
                <th scope="col">연락처</th>
                <th scope="col">상태</th>
                <th scope="col">날짜</th>
                <th scope="col"id="mb_list_mng">관리</th>
            </tr>

            </thead>
            <tbody>
            <?php
            $no = $total_count - $from_record;
            for ($i=0; $row=sql_fetch_array($result); $i++) {
                $sql="select mb_hp from g5_member where mb_id='$row[mb_id]'";
                $mem = sql_fetch($sql);
                ?>

                <tr class="<?php echo $bg; ?>">

                    <td scope="col" align="center"><?php echo $no?></td>
                    <td scope="col"" align="center">
                    <a href="./request_view.php?idx=<?php echo $row[idx]?>"><?php echo $row[wr_subject]?></a>
                    </td>
                    <td scope="col"" align="center">
                    <a href="./request_view.php?idx=<?php echo $row[idx]?>">
                        <?php echo $row[mb_id]?>(<?php echo $row[mb_name]?>)
                    </a>
                    </td>
                    <td scope="col"" align="center">
                    <a href="./request_view.php?idx=<?php echo $row[idx]?>">
                        <?php echo $row[mb_hp]?>
                    </a>
                    </td>
                    <td scope="col"" align="center">
                    <!-- <select name="status" id="status" onchange="changeStatus('<?php echo $row[idx]?>',this)">
                            <option value="">선택</option>
                            <?php
                    for($i=0;$i<count($status);$i++){
                        ?>
                                <option value="<?php echo $i?>" <?php echo $row[status]==$i?" selected":"";?>><?php echo $status[$i]?></option>
                            <?php }?>
                        </select>-->
                    <a href="javascript:;" class="status<?php echo $row[status]+1?>" onclick="statusModal('<?php echo $row[idx]?>','<?php echo $row[status]?>')"><?php echo $status[$row[status]]?></a>
                    </td>
                    <td scope="col"" align="center">
                    <?php echo substr($row[regdate],2,8)?>
                    </td>
                    <td headers="mb_list_mng"  class="td_mngsmall">
                        <a href="./request_view.php?idx=<?php echo $row[idx]?>">보기</a>
                        <a href="javascript:;" onclick="requestRemove('<?php echo $row[idx]?>')">삭제</a>
                    </td>
                </tr>
                <tr class="<?php echo $bg; ?>">

                    <td scope="col" align="center" colspan="7">
                        <?php echo nl2br($row[content]);?>
                    </td>
                </tr>

                <?php
                $no--;
            }
            if ($i == 0)
                echo "<tr><td colspan=\"".$colspan."\" class=\"empty_table\">자료가 없습니다.</td></tr>";
            ?>
            </tbody>
        </table>
    </div>

    <div class="btn_list01 btn_list">
        <input type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value">
    </div>


</form>
<div class="admin-modal" id="admin-modal">
    <div class="admin-modal-back" id="admin-modal-back"></div>
    <div class="admin-modal-form">
        <ul class="status" id="status">
            <?php
            for($i=0;$i<count($status);$i++){
                ?>
                <li onclick="changeStatus('<?php echo $i?>')">
                    <?php echo $status[$i]?>
                </li>
            <?php }?>
        </ul>
    </div>
</div>
<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page='); ?>
<?php
	$qstr=str_replace("&amp;","&",$qstr);			
?>
<script>
    $("#admin-modal-back").click(()=>{
        $("#admin-modal").fadeOut();

    });
    let idx = 0;

    const statusModal = (id,status) => {
        idx = id;
        $("#admin-modal").fadeIn();
        for(let i=0;i<$("#status").find("li").length;i++){
            if(i === Number(status)){
                $("#status").find("li").eq(i).addClass("active");
            }else{
                $("#status").find("li").eq(i).removeClass("active");
            }
        }
    }
    const changeStatus = (status) => {
        const data = {
            idx:idx,
            status:status
        }
        if(confirm(`선택한 견적 상태를 변경하시겠습니까?`)){

            $.ajax({
                url:"./ajax.request.change.php",
                data:data,
                type:'post',
                dataType:'html',
                success:(result)=>{
                    if(result === 'ok'){
                        alert('상태가 변경되었습니다.');
                    }else{
                        alert('상태 변경에 실패하였습니다.');
                    }
                    location.reload();
                }
            });
        }
    }
    const requestRemove = (idx,subject) => {
        if(confirm(`이 견적서를 삭제하시겠습니까?`)){
            location.href=`./request_delete.php?idx=${idx}<?php echo $qstr?>`;
        }
    }
</script>

<?php
include_once ('./admin.tail.php');
?>
