<?php
	include_once("./_common.php");
	$sql="select * from g5_write_franchise where wr_subject like '%$wr_subject%'";
	$result=sql_query($sql);
	for($i=0;$row=sql_fetch_array($result);$i++){
?>
	<li>
		<dl>
		  <dt><?php echo $row[wr_subject]?></dt>
		  <dd><button class="btn btn-primary" type="button" onclick="storeChoice('<?php echo $row[wr_subject]?>')">선택</button></dd> 
		</dl>  
	</li>
<?php }
	if($i==0){
?>
<li>
	검색된 결과가 없습니다.
</li>
<?php }?>

<script type="text/javascript">
	function storeChoice(wr_1){
		$("#wr_1").val(wr_1);
		$("#wr-subject").val("");
		$("#mySearch").modal("hide");
	}
</script>