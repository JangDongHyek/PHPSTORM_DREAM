<?php
$sub_menu = "200220";
include_once("./_common.php");

auth_check($auth[$sub_menu], 'r');
if($stl&&$stx){
	$sql_search = " and {$stl} = '$stx'";
}


$sql = " select count(*) as cnt from g5_wallet where (1=1) {$sql_search}";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = 30;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$list_num = $total_count - ($page - 1) * $rows;

$sql = " select * from g5_wallet where (1=1) {$sql_search} order by wl_datetime desc limit {$from_record}, {$rows} ";
$result = sql_query($sql);

$g5['title'] = '포인트 신청목록';

$write_pages = get_paging($rows, $page, $total_page, G5_ADMIN_URL.'/wallet_list.php?'.$qstr.'&amp;page=');

include_once('./admin.head.php');
?>
<article class="text-center" style="padding:20px 0;">
	<form name="fboardlist" id="fboardlist" action="./wallet_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
	<input type="hidden" name="sst" value="<?php echo $sst ?>">
	<input type="hidden" name="sod" value="<?php echo $sod ?>">
	<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
	<input type="hidden" name="stx" value="<?php echo $stx ?>">
	<input type="hidden" name="page" value="<?php echo $page ?>">
	<input type="hidden" name="token" value="<?php echo $token ?>">

	<div class="tbl_head01 tbl_wrap">
		<div class="well text-left">
			<p>※ 이미 지급된 포인트는 포인트 관리를 통해 수정해주셔야합니다.</p>
			<p>※ 이미 지급된 포인트는 재지급하실 수 없습니다. (기존 지급된 포인트 삭제 후 재지급은 가능)</p>
			<!--<p>※ 지급된 포인트는 고유번호를 통해 포인트 관리에서 확인하실 수 있습니다.</p>-->
		</div>
		<table>
		<caption><?php echo $g5['title']; ?> 목록</caption>
		<thead>
		<tr>
			<th scope="col">
				<label for="chkall" class="sound_only">게시판 전체</label>
				<input type="checkbox" name="chkall" value="1" id="chkall" >
			</th>
			<th scope="col">번호</th>
			<th scope="col">아이디</th>
			<th scope="col">신청 포인트</th>
			<th scope="col">신청일</th>
			<th scope="col">수락일</th>
			<th scope="col">상태</th>
			<!--<th scope="col">고유번호</th>-->
			<th scope="col">관리</th>
		</tr>
		</thead>
		<tbody>
		<?php 
		for($i=0; $i<$row=sql_fetch_array($result); $i++){
			$bg = 'bg'.$i%2;

			if($row['po_id']){
				$po = sql_fetch("select * from g5_point where po_id = '{$row['po_id']}'");
				if(!$po)
					$po_status = "(삭제됨)";
				else
					$po_status = "";
			}

			$sql="select * from g5_member where mb_id='$row[mb_id]'";
			$row2=sql_fetch($sql);
		?>
		<tr class="<?php echo $bg; ?>">
			<td class="td_chk">
				<label for="chk_<?php echo $i; ?>" class="sound_only"><?php echo get_text($row['wl_id']) ?></label>
				<input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>"<?php echo $row[wl_status]=="수락"?"disabled":"";?>>
        <input type="hidden" name="wl_id[<?php echo $i ?>]" value="<?php echo $row['wl_id'] ?>">
			</td>
			<td class="td_num"><?php echo ($list_num - $i);?></td>
			<td class="td_datetime" style="width:200px;"><a href="?stl=mb_id&stx=<?=$row[mb_id]?>"><?php echo $row2['mb_name'];?>(<?=$row[mb_id]?>)</a></td>
			<td class="td_datetime" style="width:200px;"><?php echo number_format($row['wl_money']);?></td>
			<td class="td_datetime" style="width:200px;"><?php echo $row['wl_datetime'];?></td>
			<td class="td_datetime" style="width:200px;"><?php echo $row['po_datetime'];?></td>
			<td><?php echo $row['wl_status'];?> <?php echo $row['po_id']?$po_status:"";?></td>
			<!--<td><?php echo $row['po_id'];?></td>-->
			<td>
				<? if($row[wl_status]=="신청"){?>
				<input type="button" value="수락" class="btn btn-default btn-sm" onclick="return setWallet('<?php echo $row['wl_id'];?>', this.value)">
				<input type="button" value="거절" class="btn btn-default btn-sm" onclick="return setWallet('<?php echo $row['wl_id'];?>', this.value)">
				<input type="button" value="취소" class="btn btn-default btn-sm" onclick="return setWallet('<?php echo $row['wl_id'];?>', this.value)">
				<? }else{?>
				수락된 포인트 신청입니다.
				<? }?>
			</td>
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
			<!--<input type="submit" name="btn_submit" value="선택수락" onclick="document.pressed=this.value">-->
			<input type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value">
			<input type="submit" name="btn_submit" value="선택거절" onclick="document.pressed=this.value">
			<input type="submit" name="btn_submit" value="선택취소" onclick="document.pressed=this.value">
		</div>
	</div>
	</form>
</article>

<script>
$(function(){
	$("#chkall").click(function(){
		var isBoolean=$(this).prop("checked");
		for(var i=1;i<$("input[type='checkbox']").size();i++){
			if($("input[type='checkbox']").eq(i).attr("disabled")==undefined){
				$("input[type='checkbox']").eq(i).prop("checked",isBoolean);
			}
		}
	});
});
function setWallet(wl_id, v){
	if(confirm(v+"(으)로 상태를 변경하시겠습니까? \n※ 수락시, 신청된 포인트가 지급됩니다.")){
		$.get("<?php echo G5_ADMIN_URL;?>/ajax.wallet_update.php", {wl_id:wl_id, v:v}, function (e){
			console.log(e);
			if(e.success)
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
