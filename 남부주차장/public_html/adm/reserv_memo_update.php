<?php
include_once('./_common.php');
$wr_memo=addslashes($wr_memo);
$sql="update g5_write_b_reserv set wr_memo='$wr_memo' where wr_id='$wr_id'";
sql_query($sql);
?>
<script type="text/javascript">
alert("메모를 저장하였습니다.");
self.close();
</script>
<?php exit;?>