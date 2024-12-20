<?php
$sub_menu = "500000";
include_once('./_common.php');
include_once('./admin.head.php');

$sql="select * from g5_price";
$row=sql_fetch($sql);
?>

<style>
.mb_tbl table {text-align: center;}
</style>



<div class="tbl_head02 tbl_wrap mb_tbl">
<form name="form" id="form" action="./price_update.php" onsubmit="return fmemberlist_submit(this);" method="post">

    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <thead>
	<tr>
		<th>요금설정</th>
		<th>설정하기</th>
	</tr>

    </thead>
    <tbody id="park-list">
	<tr>
		<td>
			<input type="number" name="price" value="<?=$row[price]?>" class="frm_input">원
		</td>
		<td><button>수정하기</button></td>
	</tr>
    
    </tbody>
    </table>

</div>

<div class="btn_list01 btn_list">
    <input type="submit" name="act_button" value="최종확인">
</div>

</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page='); ?>

<script>
document.querySelector("#ok").addEventListener('click',function(){
	var strHtml="<tr>";
	strHtml+="<td><input type='hidden' name='idx[]' value=''><input type='text' name='line_name[]' value='"+document.getElementById("line-name").value+"'></td>";
	strHtml+="<td><input type='number' name='order[]' value='0'>";
	strHtml+='<td><a href="javascript:;" onclick="remove(this)">삭제하기</a></td>';
	strHtml+="</tr>";
	$("#park-list").append(strHtml);
	$("#line-name").val("");

});
function remove(t){
	if(confirm("주차라인을 삭제하시겠습니까?")){
		$(t).parent().parent().remove();
	}
}

function parkRemove(idx){
	if(confirm("주차라인을 삭제하시겠습니까?")){
		location.href="park_remove.php?idx="+idx;
	}else{
		
	}
}
</script>

<?php
include_once ('./admin.tail.php');
?>
