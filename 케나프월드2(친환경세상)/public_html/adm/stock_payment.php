<?php
$sub_menu = "200400";
include_once("./_common.php");

auth_check($auth[$sub_menu], 'r');

$sql_search = "";
//$sql_search .= " mb_id = '{$member['mb_id']}'";
$sql_search .= " and refund_status not in ('Y') ";

if ($stx) {
    $sql_search .= " AND (";
    switch ($sfl) {
        case 'mb_id':
            // mb_id의 경우, 입력값을 그대로 사용
            $sql_search .= " mb_id = '".sql_real_escape_string($stx)."' ";
            break;
        case 'mb_name':
            // mb_name의 경우, JOIN을 사용하여 이름을 가져옴
            $sql_search .= " mb_id IN (SELECT mb_id FROM g5_member WHERE mb_name LIKE '%".sql_real_escape_string($stx)."%') ";
            break;
    }
    $sql_search .= ")";
}

$sql = " select count(*) as cnt from stocks where (1=1) {$sql_search}";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = 30;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$list_num = $total_count - ($page - 1) * $rows;

$sql = " select * from stocks where (1=1) {$sql_search} order by id desc limit {$from_record}, {$rows} ";
$result = sql_query($sql);

$write_pages = get_paging($rows, $page, $total_page, G5_ADMIN_URL.'/stock_payment.php?'.$qstr.'&amp;page=');
$g5['title'] = '주식 지급내역';

include_once('./admin.head.php');
?>

<section id="point_mng">
    <h2 class="h2_frm">개별회원 주식 증감 설정</h2>

    <form name="fpointlist2" method="post" id="fpointlist2" action="./point_update.php" autocomplete="off">
        <div class="tbl_frm01 tbl_wrap">
            <table>
                <colgroup>
                    <col class="grid_4">
                    <col>
                </colgroup>
                <tbody>
                <tr>
                    <th scope="row"><label for="mb_id">회원아이디<strong class="sound_only">필수</strong></label></th>
                    <td>
                        <input type="text" name="mb_id" value="<?php echo $mb_id ?>" id="mb_id" class="required frm_input" required>
                        <input type="checkbox" name="mb_register" id="mb_register" value="Y" class="">
                        <label for="mb_register">회원가입 주식 지급</label>
                        <p>
                            회원가입 주식 지급시, 해당회원의 추천인에게도 5주가 지급됩니다.
                        </p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="po_content">지급 사유<strong class="sound_only">필수</strong></label></th>
                    <td><input type="text" name="payment_reason" id="payment_reason" required class="required frm_input" size="80"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="po_point">지급 주식갯수<strong class="sound_only">필수</strong></label></th>
                    <td><input type="text" name="holding_count" id="holding_count" required class="required frm_input"></td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="btn_confirm01 btn_confirm">
            <input type="button" value="지급" id="pay_stock_btn" onclick="insertStock()" class="btn_submit">
        </div>

    </form>

</section>

<form name="fsearch" id="fsearch" class="local_sch01 local_sch" method="get">
    <label for="sfl" class="sound_only">검색대상</label>
    <select name="sfl" id="sfl">
        <option value="mb_id"<?php echo get_selected($_GET['sfl'], "mb_id"); ?>>회원아이디</option>
        <option value="mb_name"<?php echo get_selected($_GET['sfl'], "mb_name"); ?>>이름</option>
    </select>
    <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
    <input type="text" name="stx" value="<?php echo $stx ?>" id="stx" class="frm_input">
    <input type="submit" class="btn_submit" value="검색">
</form>

<article class="text-center" style="padding:20px 0;">
	<form name="fboardlist" id="fboardlist" action="./update_stock_info_admin.php" onsubmit="return fboardlist_submit(this);" method="post">
	<input type="hidden" name="sst" value="<?php echo $sst ?>">
	<input type="hidden" name="sod" value="<?php echo $sod ?>">
	<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
	<input type="hidden" name="stx" value="<?php echo $stx ?>">
	<input type="hidden" name="page" value="<?php echo $page ?>">
	<input type="hidden" name="token" value="<?php echo $token ?>">

	<div class="tbl_head01 tbl_wrap">
		<div class="well text-left">
			<!--<p>※ 이미 환전된 포인트는 포인트 관리를 통해 수정해주셔야합니다.</p>
			<p>※ 이미 환전된 포인트는 재환전하실 수 없습니다. (기존 환전된 포인트 삭제 후 재환전은 가능)</p>-->
		</div>
		<table>
		<caption><?php echo $g5['title']; ?> 목록</caption>
            <colgroup>
                <col width="30px">
                <col width="50px">
                <col width="15%">
                <col width="*">
                <col width="15%">
                <col width="10%">
                <col width="10%">
            </colgroup>
		<thead>
		<tr>
			<th scope="col">
				<label for="chkall" class="sound_only">게시판 전체</label>
				<input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
			</th>
			<th scope="col">번호</th>
			<th scope="col">아이디</th>
            <th scope="col">지급내용</th>
			<th scope="col">지급주식</th>
			<th scope="col">일시</th>
			<th scope="col">총 보유 주식</th>
		</tr>
		</thead>
		<tbody>
		<?php
		for($i=0; $i<$row=sql_fetch_array($result); $i++){
			$bg = 'bg'.$i%2;

			$mb = sql_fetch("select * from g5_member where mb_id = '{$row['mb_id']}'");
            $totalHoldingCount = getTotalHoldingCount($mb[mb_id]);
		?>
		<tr class="<?php echo $bg; ?>">
			<td class="td_chk">
				<label for="chk_<?php echo $i; ?>" class="sound_only"><?php echo get_text($row['ch_id']) ?></label>
                <input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>" <?php echo $row[refund_status]=="Y"?"disabled":"";?>>
                <input type="hidden" name="stock_id[<?php echo $i ?>]" value="<?php echo $row['id'] ?>">
			</td>
			<td class="td_num"><?php echo ($list_num - $i);?></td>
            <td class="td_id"><?php echo $mb[mb_name]?>(<?php echo $row['mb_id'];?>)</td>
            <td><?php echo $row['payment_reason'];?></td>
			<td><?php echo $row['holding_count'];?></td>
            <td class="td_datetime"><?php echo $row['issuance_date'];?></td>
			<td><?php echo $row['total_holding_count'];?></td>
		</tr>
		<?php
		}
		if ($i == 0)
			echo '<tr><td colspan="9" class="empty_table">내역이 없습니다.</td></tr>';
		?>
		</tbody>
		</table>
		
		<div class="text-center"><?php echo $write_pages;?></div>	

		<div class="btn_list01 text-left" style="padding-top:10px;">
            <a href="./v5_member_excel_down.php" class="btn" download>엑셀다운로드</a>
            <input type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value">
		</div>
	</div>
	</form>
</article>

<script>
    /**
     * 주식지급
     */
    function insertStock() {

        //지급 주식수
        let payCnt = $('#holding_count').val();
        //회원 아이디
        let mbId = $('#mb_id').val();
        //지급사유
        let paymentReason = $('#payment_reason').val();
        //회원 가입 여부
        let mbRegister = '';
        if ($('#mb_register').is(':checked')) {
            // 체크박스가 체크되었을 때
            console.log("체크됨");
            mbRegister = 'Y';
        } else {
            // 체크박스가 체크되지 않았을 때
            console.log("체크되지 않음");
            mbRegister = 'N';
        }


        $.ajax({
            url: 'insert_stock_ajax.php',
            type: 'POST',
            data: {
                mbId: mbId,
                holdingCount: payCnt,
                paymentReason: paymentReason,
                mbRegister: mbRegister
            },
            dataType: 'json',
            success: function(response) {
                if(response.success) {
                    // 성공 처리
                    alert('주식이 성공적으로 지급되었습니다.');
                    location.reload();
                } else {
                    // 실패 처리
                    alert('주식 지급 중 오류가 발생했습니다.');
                    location.reload();
                }
            },
            error: function(xhr, status, error) {
                // 오류 처리
                alert('오류가 발생했습니다: ' + error);
            }
        });
    }

    function stock_check_all(f)
{
    var chk = document.getElementsByName("chk[]");

    for (i=0; i<chk.length; i++)
        chk[i].checked = f.chkall.checked;
}

function setChange(stock_id, v){
	if(confirm(v+"(으)로 상태를 변경하시겠습니까? \n※ 수락시, 지급 상태가 변경됩니다.")){
		$.post("<?php echo G5_ADMIN_URL;?>/update_stock_info_admin.php", {stockId:stock_id, status:v}, function (e){
			if(e.status)
				location.reload();
			else
				alert(e.msg);
		}, "json");
	}
}

function fboardlist_submit(f)
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
include_once('./admin.tail.php');
?>
