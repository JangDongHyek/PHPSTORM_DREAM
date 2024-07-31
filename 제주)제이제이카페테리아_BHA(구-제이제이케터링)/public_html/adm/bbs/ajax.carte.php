<?php
include_once('./_common.php');

//2018-08-21 배성현 : 야식 추가

$sql = "select * from $write_table where wr_1 = '".date("Y-m-d", $mktime)."' and wr_2 = '".$sme."'"; 
$view = sql_fetch($sql);

if($sme == "조 식"){
	$rowspan = 2;
	$menu = array("탕류", "추가");
}else if($sme == "중 식"){
	$rowspan = 5;
	$menu = array("한식", "일품", "쉐프", "음료", "샐러드");
}else if($sme == "석 식"){
	$rowspan = 2;
	$menu = array("한식 Or 일품", "한정 일품");
}else if($sme == "야 식"){
	$rowspan = 3;
	$menu = array("한식", "샌드위치", "김밥");
}
?>

<div class="tbl_head01 tbl_wrap" style="margin-top:20px;">
	<table>
		<colgroup>
		   <col style="width:12%" />
		   <col style="width:12%" />
		   <col style="width:auto" />
		</colgroup>
		<tr>
			<th rowspan="<?php echo $rowspan;?>"><?php echo $sme?></th>
			<?php 
			for($i=0; $i<count($menu); $i++) { 
				if($i!=0) echo "</tr><tr>";	
				$sql = "select * from $write_table where wr_1 = '".date("Y-m-d", $mktime)."' and wr_2 = '".$sme."' and wr_3 = '".$menu[$i]."'"; 
				$list = sql_fetch($sql);
			?>
			<th><?php echo $menu[$i]; ?></th>
			<td class="<?php if($list['wr_4']) echo "border-red";?>">
				<p class="menu text-center <?php if($list['wr_5']) echo "font-bold"; ?>"><?php echo $list['wr_subject']; ?></p>
				
				<?php 
					for($k=6; $k<=16; $k+=2){
						if($list['wr_'.$k]){
				?>
						<p class="menu text-center <?php if($list['wr_'.($k+1)]) echo "font-bold";?>"><?php echo $list['wr_'.$k]?></p>
				<?php
						}
					} 
				?>
			</td>
			<?php } ?>
		</tr>
	</table>
</div>