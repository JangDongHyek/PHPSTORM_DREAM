<?php
// 회원 포인트내역
include_once('./_common.php');

//print_r($_POST);
$mb_id = $_POST['mb_id']; 
$page = $_POST['page'];

$sql_common = "FROM g5_point WHERE mb_id = '{$mb_id}'";

// 페이징
$sql = " SELECT COUNT(*) AS cnt {$sql_common} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];
$list_rows = 30;	//$config['cf_page_rows'];				// 한페이지 글 개수
$total_page  = ceil($total_count / $list_rows);				// 전체페이지
if ((int)$page > $total_page) $page = $total_page;

if ($page < 1) $page = 1;
$from_record = ($page - 1) * $list_rows;					// 시작 열
$sql_limit = " LIMIT {$from_record}, {$list_rows}";			// 리스트 sql에 limit 추가

$list_page_rows = 5;										// 한블록 개수
$list_no = $total_count - ($list_rows * ($page - 1));		// 글번호(내림차순)

// 리스트
$sql = "SELECT * {$sql_common} ORDER BY po_id DESC {$sql_limit} ";
$result = sql_query($sql);
$result_cnt = sql_num_rows($result);

// 회원포인트
$mb = get_member($mb_id, "mb_point");

?>

<style>
#point_list {margin: 50px 0 20px;}
#point_list h1 .btn {color: #FFF; background: #ff3061; font-size: 12px; border: 0; height: 25px; line-height: 25px; margin-left: 10px;}
#frm_area {display: none; font-size: 13px;}
.tbl_head02 .empty {padding: 10px 0; text-align: center;}
.tbl_head02 table {text-align: center;}
</style>

<h1>
	포인트 내역
	<? if ($member['mb_level'] == "10") { ?>
	<button type="button" class="btn" onclick="pointFrm();">포인트 충전/차감</button>
	<div id="frm_area">
		<form name="pFrm" onsubmit="return pointSubmit(this);" autocomplete="off">
			<input type="hidden" name="mb_id" value="<?=$mb_id?>">
			<select name="po_type" style="background-color:#fff312; padding:0 4px; border:1px solid #958e05">
				<option value="save">충전</option>
				<option value="use">차감</option>
			</select>
            <input type="text" name="po_charge_memo" class="frm_input" size="15" placeholder="요금 입력" style="background-color:#fff312; padding:0 6px; border:1px solid #958e05">
			<input type="text" name="po_content" class="frm_input" size="60" style="background-color:#fff312; padding:0 6px; border:1px solid #958e05" placeholder="내역 입력" required>
			<input type="text" name="po_point" class="frm_input f_num" size="15" style="background-color:#fff312; padding:0 6px; border:1px solid #958e05" placeholder="포인트 입력" required>
			<button type="submit" class="btn_frmline">등록완료</button>
		</form>
	</div>
	<? } ?>
</h1>
<div class="tbl_head02 tbl_wrap mb_tbl">
	<p style="font-weight: bold;">· 보유 포인트 : <?=number_format($mb['mb_point'])?></p>
	<table>
	<caption>회원포인트 내역</caption>
	<colgroup>
		<col width="5%">
		<col width="15%">
		<col width="10%">
		<col width="*">
		<col width="10%">
		<col width="10%">
		<col width="10%">
		<col width="*">
	</colgroup>
	<thead>
	<tr>
		<th>No.</th>
		<th>일자</th>
		<th>요금</th>
		<th>내역</th>
		<th>충전포인트</th>
		<th>차감포인트</th>
		<th>잔여포인트</th>
		<th>비고</th>
	</tr>
	</thead>
	<tbody>
	<? if ($total_count == 0) { ?>
	<tr>
		<td colspan="7" class="empty">포인트 내역이 없습니다.</td>
	</tr>
	<?
	} else {
		while($row = sql_fetch_array($result)) {
	?>
	<tr class="bg0">
		<td><?=$list_no?></td>
		<td><?=date("Y-m-d H:i:s", strtotime($row['po_datetime']))?></td>
        <td><?=$row['po_charge_memo']?></td>
		<td><?=$row['po_content']?> <? if ($row['po_rel_id']) echo " - " . $row['po_rel_id']; ?></td>
		<td><?=number_format($row['po_point'])?></td>
		<td><?=number_format($row['po_use_point'])?></td>
		<td><?=number_format($row['po_mb_point'])?></td>
		<td><?=$point_actions[$row['po_rel_action']]?></td>
	</tr>
	<?
		$list_no--;
		}
	}
	?>
	</tbody>
	</table>

	<? if ($total_page > 1) { ?>
	<nav class="pg_wrap">
		<span class="pg">
			<?php
			// list_rows : 한페이지 개수
			// list_page_rows : 한블럭 페이지 개수
			$page_num = ceil($total_count / $list_rows);	// 총페이지
			$block_num = ceil($page_num / $list_page_rows);	// 총블럭
			$now_block = ceil($page / $list_page_rows);

			$s_page = ($now_block * $list_page_rows) - ($list_page_rows - 1);	// 시작블록
			if ($s_page <= 1) $s_page = 1;
			$e_page = ($now_block * $list_page_rows);
			if ($page_num <= $e_page) $e_page = $page_num;						// 끝블록
			?>
			<?php if ($now_block > 1) { ?>
			<a href="javascript:void(0)" onclick="getPointList(<?php echo $s_page-1?>)" class="pg_page">이전</a>
			<?php } ?>
			
			<?php for ($p=$s_page; $p<=$e_page; $p++) { ?>
			<a href="javascript:void(0)" <?php if ($page != $p) { ?>onclick="getPointList(<?php echo $p?>)"<?php } ?> class="<?php echo ($page == $p)? "pg_current" : "pg_page"; ?>"><?php echo $p?></a>
			<?php } ?>

			<?php if ($block_num > 1 && $block_num != $now_block) { ?>
			<a href="javascript:void(0)" onclick="getPointList(<?php echo $e_page+1?>)" class="pg_page">다음</a>
			<?php } ?>
		</span>
	</nav>
	<? } ?>

</div>


