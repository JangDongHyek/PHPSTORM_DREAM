<?php
$sub_menu = '400420';
include_once('./_common.php');

auth_check($auth[$sub_menu], "r");

$g5['title'] = '도시락관리';
include_once (G5_ADMIN_PATH.'/admin.head.php');
$sql="select price from month_menu_price";
$row=sql_fetch($sql);
$price=$row[price];

$sql="select * from apartment where is_view='Y' order by idx asc";
$row=sql_fetch($sql);
if($a_idx==""){
	$a_idx=$row[idx];
}


$setMonth=strtotime($month."-01");
if($setMonth <= strtotime(date("Y-m-01"))) {
	alert(str_replace("-","년",$month)."월에는 도시락 메뉴를 입력하실 수 없습니다.");
}
if(!$month){
	$month = date("Y-m",strtotime(date("Y-m-d")." +1 month"));
}
$startDay = "1";
$endDay = date("t",strtotime($month."-01"));
$weekNames = array("1"=>"월","2"=>"화","3"=>"수","4"=>"목","5"=>"금");
?>

<style>
td.icon_area {text-align: left !important;}
.icon_area label {display:inline-block;margin:0 2px 2px 0;padding:0 8px;border-radius:30px;line-height:20px;font-size:11px;background:#f3f3f3}
.icon_area .icon_soldout{position:absolute;top:10px;left:10px;background:#ff0000;color:#fff;border-radius:0}
.icon_area .icon_hit{color:#32b4be}
.icon_area .icon_rec{color:#32be5a}
.icon_area .icon_sale{color:#b9be32}
.icon_area .icon_new{color:#be329d}
.icon_area .icon_best{color:#ff0000}
</style>



<!-- 리스트 -->
<form name="fitemlistupdate" method="post" action="./month_menu_update.php" <?/*onsubmit="return fitemlist_submit(this);"*/?> autocomplete="off" id="fitemlistupdate">
	
	
	

	<div class="tbl_head01 tbl_wrap">
		<?php
			$sql="select * from apartment where is_view='Y'";
			$result=sql_query($sql);
		?>
		<select name="a_idx" onchange="location.href='?month=<?php echo $month?>&a_idx='+this.value;">
			<?php
				for($i=0;$row=sql_fetch_array($result);$i++){
			?>
			<option value="<?php echo $row[idx]?>"<?php echo $row[idx]==$a_idx?" selected":"";?>><?php echo $row[apartment_name]?></option>
			<?php }?>
		</select>
		<button onclick="apartmentPopup()" class="btn btn_submit" type="button">단지등록</button>
		가격 설정 
		<input type="number" name="price" value="<?php echo $price?>" class="frm_input" id="price">
		<button onclick="monthMenuPriceChange()" class="btn btn_submit" type="button">가격변경</button>
		<script type="text/javascript">
			function monthMenuPriceChange(){
				$.ajax({
					url:"./ajax.price.change.php",
					data:{price:$("#price").val()},
					dataType:"html",
					type:"POST",
					success:function(){
						alert("가격이 변동되었습니다.");
					}
				});
			}
		</script>
		<table>
		<!-- <caption><?php echo $g5['title']; ?> 목록</caption>
		<colgroup>
		<col width="3%">
		<col width="5%">
		<col width="90px">
		<col width="*">
		<col width="10%">
		<col width="7%">
		<col width="7%">
		<col width="7%">
		<col width="5%">
		<col width="5%">
		<col width="5%">
		</colgroup> -->
		<thead>
		<tr>
			
			<th colspan="8">
				<a href="?month=<?php echo date("Y-m",strtotime($month."-01"." -1 month"))?>&a_idx=<?php echo $a_idx?>">이전달</a>
				&nbsp;&nbsp;
				<?php echo str_replace("-","년",$month)."월";?>
				&nbsp;&nbsp;
				<a href="?month=<?php echo date("Y-m",strtotime($month."-01"." +1 month"))?>&a_idx=<?php echo $a_idx?>">다음달</a>
			</th>
		</tr>
		<tr>
			<th scope="col">일자</th>
			<th scope="col">요일</th>
			<th scope="col">국</a></th>
			<th scope="col">주요리</th>
			<th scope="col">부요리1</th>
			<th scope="col">부요리2</th>
			<th scope="col">비가열 사이드</th>
			<th scope="col">공급처</th>
		</tr>
		</thead>
		<tbody>
		<?php
			for($i=1;$i<=$endDay;$i++){
				$day=$i<10?"0".$i:$i;
				$weekName = date("w",strtotime($month."-".$day));
				if($weekNames[$weekName]){
					$m_date=$month."-".$day;
					$sql="select * from month_menu where m_date='$m_date' and a_idx='$a_idx'";
					$row=sql_fetch($sql);
		?>
		<tr>
			<td scope="col">
				<?php echo $day?>
				<input type="hidden" name="m_date[]" value="<?php echo $month."-".$day?>">
			</td>
			<td scope="col"><?php echo $weekNames[$weekName]?></td>
			<td scope="col"><input type="text" name="soup[]" value="<?php echo $row[soup]?>" class="frm_input"></td>
			<td scope="col"><input type="text" name="main[]" value="<?php echo $row[main]?>" class="frm_input"></td>
			<td scope="col"><input type="text" name="heat[]" value="<?php echo $row[heat]?>" class="frm_input"></td>
			<td scope="col"><input type="text" name="pickled[]" value="<?php echo $row[pickled]?>" class="frm_input"></td>
			<td scope="col"><input type="text" name="unheated[]" value="<?php echo $row[unheated]?>" class="frm_input"></td>
			<td scope="col"><input type="text" name="supplier[]" value="<?php echo $row[supplier]?>" class="frm_input"></td>
		</tr>
		<?php }}?>
		</tbody>
		</table><br/>
		<div style="width:100%;text-align:center">
		<button type="submit" class="btn btn_submit">확인</button>
		</div>
	</div>

</form>
<!-- 리스트 -->

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "{$_SERVER['SCRIPT_NAME']}?$qstr&amp;page="); ?>

<script>
$(function() {
	// select변경시 체크박스선택
	$("#fitemlistupdate select").on("change", function() {
		setChkbox($(this));
	});

	// chkbox변경시 체크박스선택
	$("#fitemlistupdate input[type='checkbox']").on("click", function() {
		setChkbox($(this));
	});

	// text변경시 체크박스 선택
	$("#fitemlistupdate input[type='text']").on("keyup", function() {
		setChkbox($(this));
	});
});

// 체크박스선택
function setChkbox(el) {
	var no = $(el).parents('tr').data("no"),
		chkbox = $("#chk_"+no);

	if ($(el).attr('name') == "chk[]") {
		return;
	}
	if (chkbox.length > 0) {
		chkbox.prop("checked", true);
	}
}
function apartmentPopup(){
	window.open("./popup_apartment.php","apartment","width=800,height=600,scrollbars=yes");
}


<?/*
// 복사
$(function() {
    $(".itemcopy").click(function() {
        var href = $(this).attr("href");
        window.open(href, "copywin", "left=100, top=100, width=300, height=200, scrollbars=0");
        return false;
    });
});
*/?>
</script>

<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');
?>
