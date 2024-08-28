<?php
include_once("./_common.php");
include_once(G5_PATH."/head.sub.php");

?>
<script>
function number_format(data)
{
    var tmp = '';
    var number = '';
    var cutlen = 3;
    var comma = ',';
    var i;
    
    data = data + '';

    var sign = data.match(/^[\+\-]/);
    if(sign) {
        data = data.replace(/^[\+\-]/, "");
    }

    len = data.length;
    mod = (len % cutlen);
    k = cutlen - mod;
    for (i=0; i<data.length; i++)
    {
        number = number + data.charAt(i);

        if (i < data.length - 1)
        {
            k++;
            if ((k % cutlen) == 0)
            {
                number = number + comma;
                k = 0;
            }
        }
    }

    if(sign != null)
        number = sign+number;

    return number;
}
function numberFormat(t){
	const priceInt = t.value.replace(/,/gi,"");
    if(isNaN(priceInt)){
        t.value="0";
    }else {
        const price = number_format(priceInt);
        t.value=price;
    }
}
$(function(){
	$("#add-form").click(()=>{
		let strHtml=`
			<tr>
					<td>
						<input type="text" name="model[]" value="">
						<input type="hidden" name="idx[]" value="">
					</td>
					<td><input type="text" name="day1[]" value="" onkeyup="numberFormat(this)" size="10" style="text-align:right"></td>
					<td><input type="text" name="day3[]" value="" onkeyup="numberFormat(this)" size="10" style="text-align:right"></td>
					<td><input type="text" name="day5[]" value="" onkeyup="numberFormat(this)" size="10" style="text-align:right"></td>
					<td><input type="text" name="day7[]" value="" onkeyup="numberFormat(this)" size="10" style="text-align:right"></td>
					<td><input type="text" name="hour6[]" value="" onkeyup="numberFormat(this)" size="10" style="text-align:right"></td>
					<td><input type="text" name="hour10[]" value="" onkeyup="numberFormat(this)" size="10" style="text-align:right"></td>
					<td><input type="text" name="hour12[]" value="" onkeyup="numberFormat(this)" size="10" style="text-align:right"></td>
			</tr>
		`;
		$("#form-list").append(strHtml);

	});
	$("#remove-form").click(()=>{
		$("#form-list").find("tr:last").remove();
	});
});
</script>

	<h2>
		<?=$ca_nameArr[$no]?>의 대여요금 수정
		<button type="button" class="btn" id="add-form">추가</button>
		<button type="button" class="btn" id="remove-form">삭제</button>
	</h2>
	
	<form name="form" method="post" action="<?php echo G5_BBS_URL?>/pop_model_write2_update.php">
	<input type="hidden" name="ca_name" value="<?=$ca_nameArr[$no]?>">
	<table class="to_table">
		<caption>범아렌트카 대여요금안내</caption>
		<colgroup>
			<col width="*">
			<col width="9%">
			<col width="9%">
			<col width="9%">
			<col width="9%">
			<col width="9%">
			<col width="9%">
			<col width="9%">
		</colgroup>

		<thead>
			<tr>
				<th rowspan="2" class="tit">
					<?=$ca_nameArr[$no]?>
				</th>
				<th colspan="4">대여기간별 일일요금</th>
				<th colspan="3">대여시간별요금</th>
			</tr>
			<tr>
				<th>1~2일</th>
				<th>3~4일</th>
				<th>5~6일</th>
				<th>7일이상</th>
				<th>6시간</th>
				<th>10시간</th>
				<th>12시간</th>
			</tr>
		</thead>
		<tbody id="form-list">
			<?php
			
				$sql="select * from g5_rental_fee where ca_name='".$ca_nameArr[$no]."'";
				$result=sql_query($sql);
				for($i=0;$row=sql_fetch_array($result);$i++){?>
				<tr>
					<td>
						<input type="text" name="model[]" value="<?=$row[model]?>">
						<input type="hidden" name="idx[]" value="">
					</td>
					<td><input type="text" name="day1[]" value="<?=$row[day1]?>" onkeyup="numberFormat(this)" size="10" style="text-align:right"></td>
					<td><input type="text" name="day3[]" value="<?=$row[day3]?>" onkeyup="numberFormat(this)" size="10" style="text-align:right"></td>
					<td><input type="text" name="day5[]" value="<?=$row[day5]?>" onkeyup="numberFormat(this)" size="10" style="text-align:right"></td>
					<td><input type="text" name="day7[]" value="<?=$row[day7]?>" onkeyup="numberFormat(this)" size="10" style="text-align:right"></td>
					<td><input type="text" name="hour6[]" value="<?=$row[hour6]?>" onkeyup="numberFormat(this)" size="10" style="text-align:right"></td>
					<td><input type="text" name="hour10[]" value="<?=$row[hour10]?>" onkeyup="numberFormat(this)" size="10" style="text-align:right"></td>
					<td><input type="text" name="hour12[]" value="<?=$row[hour12]?>" onkeyup="numberFormat(this)" size="10" style="text-align:right"></td>
				</tr>
			<?php
				}/*
				for($i=0;$i<count($modelArr[$no]);$i++){
					$sql="select * from g5_rental_fee where model='".$modelArr[$no][$i]."'";
					$row=sql_fetch($sql);
			?>
			<tr>
				<td>
					<?=$modelArr[$no][$i]?>
					<input type="hidden" name="model[]" value="<?=$modelArr[$no][$i]?>">
					<input type="hidden" name="idx[]" value="">
				</td>
				<td><input type="text" name="day1[]" value="<?=$row[day1]?>" onkeyup="numberFormat(this)" size="10" style="text-align:right"></td>
				<td><input type="text" name="day3[]" value="<?=$row[day3]?>" onkeyup="numberFormat(this)" size="10" style="text-align:right"></td>
				<td><input type="text" name="day5[]" value="<?=$row[day5]?>" onkeyup="numberFormat(this)" size="10" style="text-align:right"></td>
				<td><input type="text" name="day7[]" value="<?=$row[day7]?>" onkeyup="numberFormat(this)" size="10" style="text-align:right"></td>
				<td><input type="text" name="hour6[]" value="<?=$row[hour6]?>" onkeyup="numberFormat(this)" size="10" style="text-align:right"></td>
				<td><input type="text" name="hour10[]" value="<?=$row[hour10]?>" onkeyup="numberFormat(this)" size="10" style="text-align:right"></td>
				<td><input type="text" name="hour12[]" value="<?=$row[hour12]?>" onkeyup="numberFormat(this)" size="10" style="text-align:right"></td>
			</tr>
			<?php }*/?>
			
		</tbody>
	</table>
	<div class="text-center">
		<button class="btn btn-success">수정하기</button>
	</div>
	</form>

<?php
include_once(G5_PATH."/tail.sub.php");
?>