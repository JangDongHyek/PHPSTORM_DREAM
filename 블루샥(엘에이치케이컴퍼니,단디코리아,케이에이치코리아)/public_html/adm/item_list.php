<?php
$sub_menu = "300000";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');
if($category_no){
	$where = " and category_no='$category_no'";
}
$sql="select count(*) as cnt from g5_item where 1 $where";
$row=sql_fetch($sql);
$total_count=$row['cnt'];
$rows=20;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select * from g5_item where 1 $where  order by orderby desc limit {$from_record}, {$rows}";
$result = sql_query($sql);

$g5['title'] = '상품발주관리';
include_once('./admin.head.php');
?>
<style>
	#tab{
		width:auto;
		
	}
	#tab ul { padding:0 20px}
	#tab ul li{
		list-style:none;
		float:left;
		min-width:50px;
		text-align:center;
		padding:15px 12px;
		border:solid #ccc 0x;
		border-bottom:0px;
		border-collapse: collapse;
		cursor:pointer;
		background:#e5ecef;
		margin:0 3px 5px 0;
	}
	#tab .active{
		background-color:#2f8bbf;
		color:#fff;
		font-weight:bold;
	}
</style>
<div class="local_ov01 local_ov">
    발주상품수 <?php echo number_format($total_count) ?>개
</div>

<?php if ($is_admin == 'super') { ?>
<div class="btn_add01 btn_add">
	<a href="javascript:;" id="cateView">분류관리</a>
    <a href="./item_form.php" id="bo_add">상품추가</a>
</div>
<?php } ?>

<form name="fboardlist" id="fboardlist" action="./item_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
<div id="tab">
	<?php
		$sql="select * from g5_category";
		$cResult=sql_query($sql);
	?>
	<ul>
		<li onclick="location.href='?';" class="<?php echo $category_no==""?"active":"";?>">전체</li>
		<?php
			for($i=0;$cRow=sql_fetch_array($cResult);$i++){?>
		<li onclick="location.href='?category_no=<?php echo $cRow[idx]?>';" class="<?php echo $category_no==$cRow[idx]?"active":"";?>"><?php echo $cRow[category_name]?></li>
		<?php }?>
	</ul>
</div>

<div class="tbl_head01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <colgroup>
           <col style="width:2%" />
           <col style="width:8%" />
           <col style="width:*" />
           <col style="width:10%" />
           <col style="width:5%" />
           <col style="width:5%" />
    </colgroup>
    <thead>
    <tr>
        <th scope="col">
            <label for="chkall" class="sound_only">상품 전체</label>
            <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
        </th>
        <th scope="col">이미지</th>
		<th scope="col">상품명</th>
		<th scope="col">가격</th>
		<th scope="col">정렬순서</th>
		<th scope="col">관리</th>
    </tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $bg = 'bg'.($i%2);
    ?>

    <tr class="<?php echo $bg; ?>">
        <td class="td_chk">
            <input type="hidden" name="idx[<?php echo $i ?>]" value="<?php echo $row['idx'] ?>" id="idx_<?php echo $i ?>">
            <input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
        </td>
        <td style="text-align:center">
			<?php
				if($row[item_image]){?>
			<img src="<?php echo G5_DATA_URL?>/item/thumb/<?php echo $row[item_image]?>">
			<?php }else{?>
			<div style="width:100px;height:100px;text-align:center;line-height:100px;border:1px solid #ccc">이미지 없음</div>
			<?php }?>
        </td>
        <td>
             <b><?php echo $row[item_name]?></b>
        </td>
        <td>
             <b><?php echo number_format($row[price])?></b>
        </td>
        <td align="center">
           <input type="number" name="orderby[<?php echo $i?>]" value="<?php echo $row[orderby]?>" class="frm_input" style="width:50px" onkeyup="$('#chk_<?php echo $i?>').prop('checked',true)">
        </td>
        <td>
			<a href="./item_form.php?idx=<?php echo $row[idx]?>&w=u">수정</a> / 
			<a href="javascript:;" onclick="itemRemove('<?php echo $row[idx]?>','<?php echo $row[item_name]?>')">삭제</a>
		</td>
    </tr>
    <?php
    }
    if ($i == 0)
        echo '<tr><td colspan="5" class="empty_table">자료가 없습니다.</td></tr>';
    ?>
    </tbody>
    </table>
</div>

<div class="btn_list01 btn_list">
    <?php if ($is_admin == 'super') { ?>
    <input type="submit" name="act_button" value="선택삭제" onclick="document.pressed=this.value">
	<input type="submit" name="act_button" value="정렬하기" onclick="document.pressed=this.value">
    <?php } ?>
</div>

</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, $_SERVER['SCRIPT_NAME'].'?'.$qstr.'&amp;page='); ?>

<script>
$(function(){
	$("#cateView").click(function(){
		window.open("./category.php","category","width=500,height=300,scrollbars=yes");
	});
});
//상품삭제
function itemRemove(idx,item_name){
	if(confirm(`${item_name} 이 상품을 삭제하시겠습니까?`)){
		location.href=`./item_remove.php?idx=${idx}`;
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
	if(document.pressed == "정렬하기") {
        if(!confirm("선택한 자료를 정렬하시겠습니까?")) {
            return false;
        }
    }
    return true;
}

</script>

<?php
include_once('./admin.tail.php');
?>
