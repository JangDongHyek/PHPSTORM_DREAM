<?php
include_once('./_common.php');
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

$wr_id = $_GET['wr_id'];

$result = sql_query("select * from g5_write_business_sub where wr_id = '{$wr_id}' order by (case sb_import when 1 Then '1' End) Desc, sb_order asc");
for($i=0; $i<$row=sql_fetch_array($result); $i++){
?>	
<div class="row box-price">
	<dl class="col-xs-12">
		<dd class="col-xs-12">
			<?php 
			if($row['sb_file']){ 
				$data_path = G5_DATA_PATH."/file/".$bo_table."/sub";
				$data_url = G5_DATA_URL."/file/".$bo_table."/sub";
				$thumb = thumbnail($row['sb_file'], $data_path, $data_path, 360, 240, false);
				$img_url = $data_url."/".$thumb;
			?>
			<img src="<?php echo $img_url;?>" style="width:100%; height:100%;">
			<?php } ?>
		</dd>
		<dd class="col-xs-8 text-left box-txt">
			<?php echo $row['sb_subject'];?>
		</dd>
		<dd class="col-xs-4 text-right box-txt">
			<span><?php echo number_format($row['sb_price']);?></span> 원
		</dd>
	</dl>
</div>
<?php } ?>