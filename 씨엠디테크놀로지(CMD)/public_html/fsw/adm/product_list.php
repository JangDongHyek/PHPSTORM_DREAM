<?php
$sub_menu = "300100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$sql_common = " from g5_write_fsw_product ";


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
if($ca_name){
    $sql_search.=" and ca_name = '$ca_name'";
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

$g5['title'] = '로봇제품관리';
include_once('./admin.head.php');

$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);

$colspan = 16;
?>
<style>
    .cat-tab{
        float:left;
    }
    .cat-tab ul{
        padding:0px;
    }
    .cat-tab ul li{
        list-style: none;
        float:left;
        padding:10px;
        border:1px solid #ccc;
        border-collapse: collapse;
        cursor:pointer;
    }
    .cat-tab .active{
        background-color: #000;
        color:#fff;
        font-weight:bold;
    }
</style>
<div class="local_ov01 local_ov">
    <?php echo $listall ?>
    총 제품수 <?php echo number_format($total_count) ?>개
</div>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">

    <label for="sfl" class="sound_only">검색대상</label>
    <select name="sfl" id="sfl">
        <option value="wr_subject"<?php echo get_selected($_GET['sfl'], "wr_subject"); ?>>제품명</option>
        <option value="wr_content"<?php echo get_selected($_GET['sfl'], "wr_content"); ?>>내용</option>
        <option value="wr_subject|wr_content"<?php echo get_selected($_GET['sfl'], "wr_subject|wr_content"); ?>>제품명 + 내용</option>
        <option value="ca_name"<?php echo get_selected($_GET['sfl'], "ca_name"); ?>>1차 분류명</option>
        <option value="wr_2"<?php echo get_selected($_GET['sfl'], "wr_2"); ?>>2차 분류명</option>
        <option value="ca_name|wr_2"<?php echo get_selected($_GET['sfl'], "ca_name|wr_2"); ?>>1차 + 2차 분류명</option>
    </select>
    <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
    <input type="text" name="stx" value="<?php echo $stx ?>" id="stx" required class="required frm_input">
    <input type="submit" class="btn_submit" value="검색">

</form>


<?php if ($is_admin == 'super') {
    $sql="select wr_subject from g5_write_fsw_category order by wr_id asc";
    $cat_result = sql_query($sql);

    ?>
    <div class="btn_add01 btn_add">
        <!-- 분류 시작 -->
        <div style="float:left" class="cat-tab">
            <ul>
                <li class="<?php echo $ca_name==""?"active":""?>" onclick="location.href='./product_list.php';">전체</li>
                <?php
                    for($i=0;$cat_row = sql_fetch_array($cat_result);$i++){
                ?>
                <li class="<?php echo $ca_name==$cat_row[wr_subject]?"active":""?>" onclick="location.href='?ca_name=<?php echo $cat_row[wr_subject]?>';"><?php echo $cat_row[wr_subject]?></li>
                <?php }?>
            </ul>
        </div>
        <!-- 분류 끝 -->

        <a href="./product_form.php?bo_table=fsw_product" id="member_add">제품추가</a>
    </div>
<?php } ?>

<form name="fmemberlist" id="fmemberlist" action="<?php echo G5_BBS_URL?>/board_list_update.php" onsubmit="return fmemberlist_submit(this);" method="post">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="bo_table" value="product">
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
                <th scope="col">분류</th>
                <th scope="col">제품코드</th>
                <th scope="col">제품명</th>
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
                    <td scope="col"" align="center"><?php echo $row[ca_name]?>/<?php echo $row[wr_2]?></td>
                    <td scope="col"" align="center"><?php echo $row[wr_1]?></td>
                    <td scope="col"" align="center"><?php echo $row[wr_subject]?></td>
                    <td headers="mb_list_mng"  class="td_mngsmall">
                        <a href="./product_form.php?bo_table=fsw_product&w=u&wr_id=<?php echo $row[wr_id]?><?php echo $qstr?>">수정</a>
                        <a href="javascript:;" onclick="productRemove('<?php echo $row[wr_id]?>','<?php echo $row[wr_subject]?>')">삭제</a>
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

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;ca_name='.$ca_name.'&amp;page='); ?>

<script>
    const productRemove = (id,subject) => {
        if(confirm(`${subject}를 삭제하시겠습니까?`)){
            location.href=`<?php echo G5_BBS_URL?>/delete.php?bo_table=fsw_product&wr_id=${id}<?php echo $qstr?>`;
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
