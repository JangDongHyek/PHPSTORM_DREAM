<?php
$sub_menu = '400430';
include_once('./_common.php');

auth_check($auth[$sub_menu], "r");

$g5['title'] = '주문내역';
include_once (G5_ADMIN_PATH.'/admin.head.php');
include_once(G5_PLUGIN_PATH.'/jquery-ui/datepicker.php');
$sql = " select count(idx) as cnt from lunch_order where 1 and order_no!=''";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함
$list_no = $total_count - ($rows * ($page - 1));		// 글번호(내림차순)

$sql="select * from lunch_order where 1 and order_no!='' limit $from_record, $rows";
$result=sql_query($sql);
?>


<form name="forderlist" id="forderlist" onsubmit="return forderlist_submit(this);" method="post" autocomplete="off">
<input type="hidden" name="search_od_status" value="<?php echo $od_status; ?>">

<div class="tbl_head01 tbl_wrap">
	<table class="table table-bordered">
		<thead>
		<tr>
			<th scope="col">주문번호</th>
			<th scope="col">이름</th>
			<th scope="col">연락처</th>
			<th scope="col">메뉴</th>
			<th scope="col">주문날짜</th>
		</tr>
		</thead>
		<tbody>
		<?php
			for($i=0;$row=sql_fetch_array($result);$i++){
				$sql="select l.m_idx,m.m_date,m.main,count(m.idx) as cnt from lunch_order_menu l, month_menu m where l.m_idx=m.idx and l.order_no='$row[order_no]'";
				$row2=sql_fetch($sql);
				
		?>
		
		<tr>
			<td scope="col">
				<a href="./month_menu_order_result.php?order_no=<?php echo $row[order_no]?>">
				<?php echo $row[order_no]?>
				</a>
			</td>
			<td><a href="./month_menu_order_result.php?order_no=<?php echo $row[order_no]?>"><?php echo $row[mb_name]?></a></td>
			<td><a href="./month_menu_order_result.php?order_no=<?php echo $row[order_no]?>"><?php echo $row[mb_tel]?></a></td>
		
			<td scope="col">
				<a href="./month_menu_order_result.php?order_no=<?php echo $row[order_no]?>">
				<?php echo substr($row2[m_date],-5)?>
				<?php echo $row2[main]?>
				<?php echo 1 < $row2[cnt]?"외".intval($row2[cnt]-1)."개":""?>
				</a>
				
			</td>
			<td scope="col"><?php echo substr($row[order_date],0,10)?></td>
			
		</tr>
		<?php }
			if($i==0){
		?>
		<tr>
			<td colspan="3">데이터가 없습니다.</td>
		</tr>
		<?php }?>
		
		</tbody>
	</table>
</div>

<? /*
<div class="local_cmd01 local_cmd">
<?php if (($od_status == '' || $od_status == '완료' || $od_status == '전체취소' || $od_status == '부분취소') == false) {
    // 검색된 주문상태가 '전체', '완료', '전체취소', '부분취소' 가 아니라면
?>
    <label for="od_status" class="cmd_tit">주문상태 변경</label>
    <?php
    $change_status = "";
    if ($od_status == '주문') $change_status = "입금";
    if ($od_status == '입금') $change_status = "준비";
    if ($od_status == '준비') $change_status = "배송";
    if ($od_status == '배송') $change_status = "완료";
    ?>
    <label><input type="checkbox" name="od_status" value="<?php echo $change_status; ?>"> '<?php echo $od_status ?>'상태에서 '<strong><?php echo $change_status ?></strong>'상태로 변경합니다.</label>
    <?php if($od_status == '주문' || $od_status == '준비') { ?>
    <input type="checkbox" name="od_send_mail" value="1" id="od_send_mail" checked="checked">
    <label for="od_send_mail"><?php echo $change_status; ?>안내 메일</label>
    <input type="checkbox" name="send_sms" value="1" id="od_send_sms" checked="checked">
    <label for="od_send_sms"><?php echo $change_status; ?>안내 SMS</label>
    <?php } ?>
    <?php if($od_status == '준비') { ?>
    <input type="checkbox" name="send_escrow" value="1" id="od_send_escrow">
    <label for="od_send_escrow">에스크로배송등록</label>
    <?php } ?>
    <input type="submit" value="선택수정" class="btn_submit" onclick="document.pressed=this.value">
<?php } ?>
    <?php if ($od_status == '주문') { ?> <span>주문상태에서만 삭제가 가능합니다.</span> <input type="submit" value="선택삭제" class="btn_submit" onclick="document.pressed=this.value"><?php } ?>
</div>
*/ ?>


</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "{$_SERVER['SCRIPT_NAME']}?$qstr&amp;page="); ?>

<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');
?>
