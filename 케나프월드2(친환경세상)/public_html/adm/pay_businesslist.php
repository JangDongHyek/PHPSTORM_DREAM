<?php
$sub_menu = "400000";
include_once('./_common.php');
$g5['title']  = "정보등록 결재관리";
include_once ('./admin.head.php');

auth_check($auth[$sub_menu], 'r');

$sql_common = " from g5_pay_business";

$sql_search = " where mb_id!='lets080' ";

if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case 'enddate' :
            $sql_search .= " ({$sfl} like '{$stx}%') ";
            break;

        default :
            $sql_search .= " ({$sfl} like '{$stx}%') ";
            break;
    }
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


$sql="select * from g5_pay_business {$sql_search} {$sql_order} limit {$from_record}, {$rows}";
$result = sql_query($sql);




?>
<form name="fsearch" id="fsearch" class="local_sch01 local_sch" method="get">
<label for="sfl" class="sound_only">검색대상</label>
<select name="sfl" id="sfl">
    <option value="enddate"<?php echo get_selected($_GET['sfl'], "enddate"); ?>>만료일</option>
</select>
<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
<input type="text" name="stx" readonly value="<?php echo $stx ?>" id="stx" required class="required frm_input">
<input type="submit" class="btn_submit" value="검색">
</form>


<form name="fassetlist" id="fassetlist" method="post" action="./businesslist_delete.php" onsubmit="return fassetlist_submit(this);">

<div class="tbl_head01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <thead>
    <tr>
        <th scope="col">
            <label for="chkall" class="sound_only">정보등록 결재내역 전체</label>
            <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
        </th>
        <th scope="col">회원아이디</a></th>
        <th scope="col">이름</th>
        <th scope="col">닉네임</th>
        <th scope="col">이용 상품</a></th>
        <th scope="col">시작일</a></th>
        <th scope="col">만료일</a></th>
        <th scope="col">결재캐시</th>
    </tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) {
		$sql="select * from g5_member where mb_id = '{$row['mb_id']}'";
		$mbinfo = sql_fetch($sql);
		
		switch($row['amount']){
			case 550000: $product = '무한 550000캐시';break;
			case 90000: $product = '1년간 90000캐시';break;
			case 50000: $product = '6개월 50000캐시';break;
			case 30000: $product = '3개월 30000캐시';break;
			case 10000: $product = '1개월 10000캐시';break;
			case 100: $product = '적립이용 100캐시';break;
		}

        $bg = 'bg'.($i%2);
    ?>

    <tr class="<?php echo $bg; ?>">
        <td class="td_chk">         
            <label for="chk_<?php echo $i; ?>" class="sound_only"><?php echo $row['po_content'] ?> 내역</label>
            <input type="checkbox" name="chk[]" value="<?php echo $row['idx'] ?>" id="chk_<?php echo $i ?>">
        </td>
        <td class="td_mbid"><?php echo $row['mb_id'] ?></td>
        <td class="td_mbname"><?php echo get_text($mbinfo['mb_name']); ?></td>
        <td class="td_name sv_use"><div><?php echo $mbinfo['mb_nick'] ?></div></td>
		<td class="td_mbname"><?=$product?></td>
		<td class="td_mbname"><?=$row['startdate']?></td>
		<td class="td_mbname"><?=$row['enddate']?></td>
		<td class="td_mbname"><?=$row['amount']?></td>       
    </tr>
    <?php
    }

    if ($i == 0)
  //      echo '<tr><td colspan="'.$colspan.'" class="empty_table">자료가 없습니다.</td></tr>';
    ?>
    </tbody>
    </table>
</div>

<div class="btn_list01 btn_list">
    <input type="submit" name="act_button" value="선택삭제" onclick="document.pressed=this.value">
</div>

</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "{$_SERVER['SCRIPT_NAME']}?$qstr&amp;page="); ?>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script>


 $("#stx").datepicker({
                dateFormat: 'yy-mm-dd'
                ,showMonthAfterYear:true
                ,monthNamesShort: ['1','2','3','4','5','6','7','8','9','10','11','12'] //달력의 월 부분 텍스트
                ,monthNames: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'] //달력의 월 부분 Tooltip 텍스트
                ,dayNamesMin: ['일','월','화','수','목','금','토'] //달력의 요일 부분 텍스트
                ,dayNames: ['일요일','월요일','화요일','수요일','목요일','금요일','토요일'] //달력의 요일 부분 Tooltip 텍스트
            });            


function fassetlist_submit(f)
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
