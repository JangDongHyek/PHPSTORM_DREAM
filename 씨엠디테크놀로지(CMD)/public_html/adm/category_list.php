<?php
$sub_menu = "300200";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$sql_common = " from g5_write_category ";


$sql_search = " where 1 ";


if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case 'wr_1':
        case 'wr_subject' :
            $sql_search .= " ({$sfl} like '%{$stx}%') ";
            break;
        case'wr_subject|wr_1':
            $sfls = explode('|',$sfl);
            $sql_search.=" $sfls[0] like '%{$stx}%' or $sfls[1] like '%{$stx}%'";
            break;
        default :
            $sql_search .= " ({$sfl} like '{$stx}%') ";
            break;
    }
    $sql_search .= " ) ";
}
if (!$sst) {
    $sst = "wr_id";
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

$g5['title'] = '분류관리';
include_once('./admin.head.php');

$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);

$colspan = 16;
?>

<div class="local_ov01 local_ov">
    <?php echo $listall ?>
    총 분류수 <?php echo number_format($total_count) ?>개
</div>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">

    <label for="sfl" class="sound_only">검색대상</label>
    <select name="sfl" id="sfl">
        <option value="wr_subject"<?php echo get_selected($_GET['sfl'], "wr_subject"); ?>>1차 분류명</option>
        <option value="wr_1"<?php echo get_selected($_GET['sfl'], "wr_content"); ?>>2차 분류명</option>
        <option value="wr_subject|wr_1"<?php echo get_selected($_GET['sfl'], "wr_subject|wr_1"); ?>>1차 + 2차 분류명</option>
    </select>
    <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
    <input type="text" name="stx" value="<?php echo $stx ?>" id="stx" required class="required frm_input">
    <input type="submit" class="btn_submit" value="검색">

</form>


<?php if ($is_admin == 'super') { ?>
    <div class="btn_add01 btn_add">
        <a href="./category_form.php" id="member_add">분류추가</a>
    </div>
<?php } ?>

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
                <th scope="col" id="mb_list_chk">
                    <label for="chkall" class="sound_only">분류 전체</label>
                    <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
                </th>
                <th scope="col">번호</th>
                <th scope="col">1차 분류명</th>
                <th scope="col">2차 분류명</th>
                <th scope="col"id="mb_list_mng">관리</th>
            </tr>

            </thead>
            <tbody>
            <?php
            $no = $total_count - $from_record;
            for ($i=0; $row=sql_fetch_array($result); $i++) {
                
                ?>

                <tr class="<?php echo $bg; ?>">
                    <td headers="mb_list_chk" class="td_chk">
                        <input type="hidden" name="chk_wr_id[<?php echo $i ?>]" value="<?php echo $row['wr_id'] ?>" id="wr_id_<?php echo $i ?>">
                        <label for="chk_<?php echo $i; ?>" class="sound_only"></label>
                        <input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
                    </td>
                    <td scope="col" align="center"><?php echo $no?></td>
                    <td scope="col"" align="center"><?php echo $row[wr_subject]?></td>
                    <td scope="col"" align="center"><?php echo $row[wr_1]?></td>
                    <td headers="mb_list_mng"  class="td_mngsmall">
                        <a href="./category_form.php?w=u&wr_id=<?php echo $row[wr_id]?><?php echo $qstr?>">수정</a>
                        <a href="javascript:;" onclick="categoryRemove('<?php echo $row[wr_id]?>','<?php echo $row[wr_subject]?>')">삭제</a>
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

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page='); ?>

<script>
    const categoryRemove = (id,subject) => {
        if(confirm(`${subject}를 삭제하시겠습니까?`)){
            location.href=`<?php echo G5_BBS_URL?>/delete.php?bo_table=category&wr_id=${id}<?php echo $qstr?>`;
        }
    }
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
</script>

<?php
include_once ('./admin.tail.php');
?>
