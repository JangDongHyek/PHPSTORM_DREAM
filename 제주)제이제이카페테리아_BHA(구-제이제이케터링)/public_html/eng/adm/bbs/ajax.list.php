<?php
include_once('./_common.php');
$wr_id = $_GET['wr_id'];

if($bo_table == "ac_breakdown" || $bo_table == "ac_sales")
	$bo_write_table = "g5_write_account";
else if($bo_table == "repair")
	$bo_write_table = "g5_write_customer";

$sql = "select * from $bo_write_table where wr_id = '{$wr_id}'";
$view = sql_fetch($sql);

if($bo_table == "ac_breakdown" || $bo_table == "ac_sales")
	$ca_name = cut_str($view['ca_name'], 2, "");
else if($bo_table == "repair")
	$ca_name = cut_str($view['ca_name'], 3, "");

############################## 거래내역 ##############################
$sql_search = " wr_1 = '".$view['wr_id']."'";

if($sfl || $stx){
	$sql_search .= " and ( {$sfl} = '{$stx}' ) ";
}

// 총 거래내역
$sql = " SELECT COUNT(DISTINCT `wr_parent`) AS `cnt` FROM $write_table WHERE {$sql_search} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$page_rows = 10;
$list_page_rows = 10;
if(!$page) $page = 1;

$total_page  = ceil($total_count / $page_rows);  // 전체 페이지 계산
$from_record = ($page - 1) * $page_rows; // 시작 열을 구함

if (!$sst) {
    if ($board['bo_sort_field']) {
        $sst = $board['bo_sort_field'];
    } else {
        $sst  = "wr_num, wr_reply";
        $sod = "";
    }
} else {
    // 게시물 리스트의 정렬 대상 필드가 아니라면 공백으로 (nasca 님 09.06.16)
    // 리스트에서 다른 필드로 정렬을 하려면 아래의 코드에 해당 필드를 추가하세요.
    // $sst = preg_match("/^(wr_subject|wr_datetime|wr_hit|wr_good|wr_nogood)$/i", $sst) ? $sst : "";
    $sst = preg_match("/^(wr_datetime|wr_hit|wr_good|wr_nogood)$/i", $sst) ? $sst : "";
}

if(!$sst)
    $sst  = "wr_num, wr_reply";

if($board['bo_orderby']){
	$sst = "wr_orderby desc, " . $sst;
}

if ($sst) {
    $sql_order = " order by {$ob} {$sst} {$sod} ";
}

// 해당 거래내역
$sql = " select * from $write_table where {$sql_search} {$sql_order} limit {$from_record}, $page_rows ";
$result = sql_query($sql);

// 페이징
$write_pages = ajax_paging(10, $page, $total_page, './board.php?bo_table=ac_breakdown&amp;'.$qstr.'&amp;page=');
?>

	
<?php for($i=0; $i<$row=sql_fetch_array($result); $i++){ ?>
	<?php if($bo_table=="repair"){ ?>
	<tr>
		<td class="text-center"><?php echo $row['wr_2']?></td>
		<td class="text-center"><?php echo $row['wr_3']?> </td>
		<td class="text-center"><?php echo $row['wr_4']?></td>
		<td class="text-center"><?php echo $row['wr_content']?></td>
		<td class="text-center"><?php echo $row['wr_5']?></td>
		<td class="text-center">
			<input type="button" class="btn_cancel" value="수정" onclick="window.open('<?php echo G5_ADMIN_URL?>/bbs/write.php?bo_table=<?php echo $bo_table; ?>&wr_id=<?php echo $row['wr_id']; ?>&w=u','_blank','width=850, height=700, toolbar=no, menubar=no, scrollbars=yes, resizable=yes'); return false;"> 
			<a href="<?php echo G5_ADMIN_URL?>/bbs/delete.win.php?bo_table=<?php echo $bo_table?>&wr_id=<?php echo $row['wr_id']?>&sst=<?php echo $sst?>&sod=<?php echo $sod?>&sfl=<?php echo $sfl?>&stx=<?php echo $stx?>&page=<?php echo $page?>&wr_1=<?php echo $row['wr_1']?>" onclick="return confirm('한번 삭제된 내역은 복구하실 수 없습니다. 정말 삭제하시겠습니까?')==true ? true:false; "class="btn_cancel">삭제</a>
		</td>
	</tr>
	<?php }else{ ?>
	<tr>
		<td class="text-center"><?php echo $row['wr_2']?></td>
		<td class="text-center"><?php echo $row['wr_3']?> </td>
		<td class="text-center"><?php echo $row['wr_4']?> 개</td>
		<td class="text-center"><?php echo $row['wr_5']?> 원</td>
		<td class="text-center"><?php echo $row['wr_6']?> 원</td>
		<td class="text-center"><?php echo $row['wr_7']?> 원</td>
		<td class="text-center"><?php echo $row['wr_8']?> 원</td>
		<?php if($bo_table=="ac_sales"){ ?>
		<td class="text-center"><?php echo $row['wr_9']?"입금":"미입금"?></td>
		<td class="text-center"><?php echo $row['wr_10']?></td>
		<td class="text-center"><?php echo $row['wr_11']?> <?php echo $row['wr_12']?> <?php echo $row['wr_13']?></td>
		<?php } ?>
		<td class="text-center"><?php echo $row['wr_content']?></td>
		<td class="text-center">
			<input type="button" class="btn_cancel" value="수정" onclick="window.open('<?php echo G5_ADMIN_URL?>/bbs/write.php?bo_table=<?php echo $bo_table; ?>&wr_id=<?php echo $row['wr_id']; ?>&w=u','_blank','width=850, height=700, toolbar=no, menubar=no, scrollbars=yes, resizable=yes'); return false;"> 
			<a href="<?php echo G5_ADMIN_URL?>/bbs/delete.win.php?bo_table=<?php echo $bo_table?>&wr_id=<?php echo $row['wr_id']?>&sst=<?php echo $sst?>&sod=<?php echo $sod?>&sfl=<?php echo $sfl?>&stx=<?php echo $stx?>&page=<?php echo $page?>&wr_1=<?php echo $row['wr_1']?>" onclick="return confirm('한번 삭제된 내역은 복구하실 수 없습니다. 정말 삭제하시겠습니까?')==true ? true:false; "class="btn_cancel">삭제</a>
		</td>
	</tr>
	<?php } ?>
<?php } ?>
<?php if($i==0){ ?>
<tr>
	<td colspan="<?php echo $bo_table=="ac_sales"? 12:9?>" class="text-center">등록된 <?php echo $ca_name; ?> 내역이 없습니다.</td>
</tr>
<?php }else{ ?>
<tr>
	<td colspan="<?php echo $bo_table=="ac_sales"? 12:9?>" class="text-center" style="border:0;"><?php echo $write_pages ?></td>
</tr>
<?php } ?>