<?php
$sub_menu = "220100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$sql_common = " from g5_lesson ";
$sql_search = " where center_code = '{$member['center_code']}' and use_yn = 'Y' ";

if (!$sst) {
    $sst = "idx";
    $sod = "asc";
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

$g5['title'] = '상품관리';
include_once('./admin.head.php');

$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
//echo $sql;
$result = sql_query($sql);

$colspan = 16;
?>

<style>
.mb_tbl table {text-align: center;}
.btn_remo {
    display: inline-block;
    width: 75px;
    line-height: 32px;
    text-align: center;
    border-radius: 3px;
    border: 1px solid #ccc;
    background: #f2f2f2;
}
</style>

<div class="local_ov01 local_ov">
    <?php echo $listall ?>
    총 상품수 <?php echo number_format($total_count) ?>개
    <a href="javascript:void(0);" class="btn_remo" onclick="fee_management();" style="float: right;margin-bottom: 5px;">수수료 관리</a>
</div>

<div class="tbl_head02 tbl_wrap mb_tbl">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <colgroup>
        <col width="10%">
        <col width="10%">
        <col width="10%">
        <col width="10%">
        <col width="10%">
        <col width="10%">
    </colgroup>
    <thead>
	<tr>
		<th>No.</th>
		<th>레슨명</th>
		<th>레슨시간</th>
		<th>레슨횟수</th>
		<th>금액</th>
		<th>수정/삭제</th>
	</tr>
    </thead>

    <tbody>
    <?php
    $k = 0;
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $k++;
    ?>
	<tr class="<?php echo $bg; ?>" >
        <td><?=$k?></td>
        <td><?=$row['lesson_name']?></td>
        <td><?=$row['lesson_time']?></td>
        <td><?=$row['lesson_count']?></td>
        <td><?=number_format($row['lesson_price'])?>원</td>
        <td>
            <a href="javascript:void(0);" class="btn_remo" onclick="lesson_popup('<?=$row['idx']?>','u');">수정</a>
            <a href="javascript:void(0);" class="btn_remo" onclick="lesson_popup('<?=$row['idx']?>','d')">삭제</a>
        </td>
	</tr>
    <?php
    }
    if ($i == 0)
        echo "<tr><td colspan=\"".$colspan."\" class=\"empty_table\">자료가 없습니다.</td></tr>";
    ?>
    </tbody>
    </table>
</div>

<?php if ($is_admin == 'super') { ?>
    <div class="adm_pw_btn">
        <a href="javascript:void(0);" id="lesson_add" class="btn_adm_ok" onclick="lesson_popup();">상품 등록하기</a>
    </div>
<?php } ?>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page='); ?>

<script>

// 레슨상품등록/수정/삭제
function lesson_popup(idx, w) {
    if(idx != '') {
        var url = "./lesson_form.php?idx="+idx+"&w="+w;
    } else {
        var url = "./lesson_form.php";
    }

    if(w == 'd') {
        if (confirm('레슨 상품을 삭제하시겠습니까?')) {
            $.ajax({
                type: 'GET',
                url: g5_admin_url + "/lesson_form.php",
                data: {
                    idx: idx,
                    w: w,
                },
                success: function (data) {
                    if(data == 'success') {
                        alert('삭제하였습니다.');
                        location.replace(g5_admin_url + '/lesson_list.php');
                    }
                },
            });
        }
    }
    else {
        if('<?=$ios_flag?>' || '<?=$android_flag?>') {
            location.href = url;
        }

        window.open(url, "add_lesson", "left=100,top=100,width=550,height=450,scrollbars=yes,resizable=yes");
    }

    return false;
}

// 수수료 관리
function fee_management() {
    var url = "./fees_form.php?center_code=<?=$member['center_code']?>";

    if('<?=$ios_flag?>' || '<?=$android_flag?>') {
        location.href = url;
    }

    window.open(url, "fees_management", "left=100,top=100,width=450,height=300,scrollbars=yes,resizable=yes");
}
</script>

<?php
include_once ('./admin.tail.php');
?>
