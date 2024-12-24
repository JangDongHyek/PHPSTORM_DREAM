<?php
$sub_menu = "200600";
include_once("./_common.php");

auth_check($auth[$sub_menu], 'r');

$sql_search = "";
//$sql_search .= " mb_id = '{$member['mb_id']}'";

$sql = " select count(*) as cnt from petition where (1=1) ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = 30;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$list_num = $total_count - ($page - 1) * $rows;

$sql = " select * from petition where (1=1) {$sql_search} order by idx desc limit {$from_record}, {$rows} ";

$result = sql_query($sql);


$g5['title'] = '청원서 작성목록';
echo $sql;
$write_pages = get_paging($rows, $page, $total_page, G5_ADMIN_URL.'/petition_list.php?'.$qstr.'&amp;page=');

include_once('./admin.head.php');
?>
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
            <!--<a href="./v5_member_excel_down.php" class="btn" download>엑셀다운로드</a>-->
		</div>
		<table>
		<caption><?php echo $g5['title']; ?> 목록</caption>
		<thead>
		<tr>
			<!--<th scope="col">
				<label for="chkall" class="sound_only">게시판 전체</label>
				<input type="checkbox" name="chkall" value="1" id="chkall" onclick="stock_check_all(this.form)">
			</th>-->
			<th scope="col">번호</th>
			<th scope="col">아이디</th>
			<th scope="col">성명</th>
			<th scope="col">전화번호</th>
			<th scope="col">생년월일</th>
			<th scope="col">소속</th>
			<th scope="col">주소</th>
			<th scope="col">작성일</th>
			<th scope="col">추천인이름</th>
			<th scope="col">추천인전화번호</th>
		</tr>
		</thead>
		<tbody>
		<?php 
		for($i=0; $i<$row=sql_fetch_array($result); $i++){
			$bg = 'bg'.$i%2;

			/*if($row['po_id']){
				$po = sql_fetch("select * from g5_point where po_id = '{$row['po_id']}'");
				if(!$po)
					$po_status = "(삭제됨)";
				else
					$po_status = "";
			}*/

			$mb = sql_fetch("select * from g5_member where mb_id = '{$row['mb_id']}'");
			$recommended_mb = sql_fetch("select * from g5_member where mb_id = '{$mb['mb_recommend']}'");
		?>
		<tr class="<?php echo $bg; ?>">
			<!--<td class="td_chk">
				<label for="chk_<?php /*echo $i; */?>" class="sound_only"><?php /*echo get_text($row['idx']) */?></label>
				<input type="checkbox" name="chk[]" value="<?php /*echo $i */?>" id="chk_<?php /*echo $i */?>" <?php /*echo $row[refund_status]=="Y"?"disabled":"";*/?>>
                <input type="hidden" name="stock_id[<?php /*echo $i */?>]" value="<?php /*echo $row['idx'] */?>">
			</td>-->
			<td class="td_num"><?php echo ($list_num - $i);?></td>
			<td class="td_datetime" style="width:200px;"><?php echo $mb[mb_name]?>(<?php echo $row['mb_id'];?>)</td>
			<td class="td_datetime" style="width:400px;"><?php echo $row['name']; ?></td>
			<td class="td_datetime" style="width:200px;"><?php echo $row['mb_hp'];?></td>
			<td class="td_datetime" style="width:200px;"><?php echo $row['birthdate'];?></td>
			<td class="td_datetime" style="width:100px;"><?php echo $row['organization'];?></td>
			<td class="td_datetime" style="width:200px;"><?php echo $row['address'];?></td>
			<td><?php echo $row['created_at'];?></td>
			<td style="width:100px;"><?php echo $recommended_mb['mb_name'];?></td>
			<td><?php echo $recommended_mb['mb_id'];?></td>
		</tr>
		<?php
		}
		if ($i == 0)
			echo '<tr><td colspan="9" class="empty_table">신청내역이 없습니다.</td></tr>';
		?>
		</tbody>
		</table>
		
		<div class="text-center"><?php echo $write_pages;?></div>

        <div class="btn_list01 text-left" style="padding-top:10px;">
            <a href="./v5_petition_excel_down.php" class="" download>엑셀다운로드</a>
        </div>
	</div>
	</form>
</article>

<script>
function stock_check_all(f)
{
    var chk = document.getElementsByName("chk[]");

    for (i=0; i<chk.length; i++)
        chk[i].checked = f.chkall.checked;
}

function setChange(stock_id, v){
	/*if(confirm(v+"(으)로 상태를 변경하시겠습니까? \n※ 수락시, 지급 상태가 변경됩니다.")){
		$.post("<?php echo G5_ADMIN_URL;?>/ajax_update_stock_info_admin.php", {stockId:stock_id, status:v}, function (e){
			if(e.status)
				location.reload();
			else
				alert(e.msg);
		}, "json");
	}*/
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
