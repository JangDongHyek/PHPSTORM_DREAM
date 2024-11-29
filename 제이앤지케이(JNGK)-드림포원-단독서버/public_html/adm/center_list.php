<?php
$sub_menu = "200100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$sql_common = " from g5_center ";
$sql_search = " where 1=1 and center_code != 'center10' "; // center10 : 테스트데이터

if(empty($_REQUEST['close'])) {
    $sql_search .= " and (close_date is null or close_date = '0000-00-00') ";
} else {
    $sql_search .= " and (close_date is not null and close_date != '0000-00-00') "; // 폐쇄일 입력한 아카데미는 조회하지 않음
}

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
$listall2 = '<a href="'.$_SERVER['SCRIPT_NAME'].'?close=Y" class="ov_listall">폐점센터</a>';

$g5['title'] = '센터관리';
include_once('./admin.head.php');

$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
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
#lere_modal .modal-content .close {
    position: absolute;
    top: 10px;
    right: 15px;
    font-size: 40px;
    opacity: 1;
    text-shadow: 0;
    z-index: 10;
}

#lere_modal .modal-dialog{ width: 100%;max-width:1300px; margin:30px auto;}
#lere_modal .modal-body{ padding:60px 15px 15px;}
#lere_modal iframe{ border:0; width:100%; height:830px}
@media (max-width:1201px) {
#lere_modal .modal-dialog{ margin:0px auto;}
#lere_modal iframe{ height:100vh}
}
</style>

<div id="lere_modal">
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div class="modal-body">
                    <iframe src="" id="iframe" scrolling="auto"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="local_ov01 local_ov">
    <?php echo $listall ?>
    <?php echo $listall2 ?>
    총 센터수 <?php echo number_format($total_count) ?>개
</div>

<form name="fmemberlist" id="fmemberlist" action="./member_list_update.php" onsubmit="return fmemberlist_submit(this);" method="post">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="">

<div class="tbl_head02 tbl_wrap mb_tbl">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <colgroup>
        <col width="3%">
        <col width="20%">
        <col width="5%">
        <col width="5%">
    </colgroup>
    <thead>
	<tr>
		<th>No.</th>
		<th>센터명</th>
		<th>팀장명</th>
        <th>수정</th>
	</tr>
    </thead>
    <tbody>
    <?php
    $k = 0;
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $k++;
    ?>
	<tr class="<?php echo $bg; ?>">
        <td><?=$k?></td>
        <td style="text-decoration: underline; cursor: pointer;" onclick="popup_adm('<?=$row['center_code']?>');"><?=$row['center_name']?></td>
        <td><?=$row['center_mb_name']?></td>
        <td>
            <a href="./center_form.php?idx=<?=$row['idx']?>&w=u" class="btn_remo">수정</a>
            <?php if($member['mb_level'] == 10){ ?>
            <a href="<?=G5_ADMIN_URL?>/member_list_exceldown.php?center_code=<?=$row['center_code']?>&member_option=전체&pro=<?=$_REQUEST['pro']?>" target='_blank' class="btn_remo">엑셀 다운</a>
            <?php } ?>
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
        <a href="./center_form.php" id="center_add" class="btn_adm_ok">센터 등록하기</a>
    </div>
<?php } ?>

</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page='); ?>

<script>
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

function tabClick(value) {
    $('#member_option').val(value);
    fsearch.submit();
}

var win = null;
function popup_adm(center_code) {
    $('#myModal').modal('show');
    $('#iframe').attr('src', g5_admin_url+'/link_page.php?center_code='+center_code);
    // var url = g5_admin_url+'/link_page.php?center_code='+center_code;

    // win = window.open(url, "center_team_adm", "left=100,top=100,width=1500,height=800,scrollbars=yes,resizable=yes");
    // win.focus();
}

// function test() {
//     location.replace(g5_admin_url+'/link_page.php');
// }

$('#myModal').on('hide.bs.modal', function(e){
    location.replace(g5_admin_url+'/link_page.php');
    e.stopImmediatePropagation();
});

</script>

<?php
include_once ('./admin.tail.php');
?>
