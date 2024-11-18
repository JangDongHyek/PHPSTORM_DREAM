<?php
include_once('./_common.php');
$sql="select * from g5_person";
$row=sql_fetch($sql);
$total=$ceo+$disign +$developer+$sales+$manager;
if(0 < $row[total]){
	
	$sql="update g5_person set ceo='$ceo',total='$total',disign='$disign',developer ='$developer',sales='$sales',manager='$manager'";
}else{
	$sql="insert g5_person set ceo='$ceo',total='$total',disign='$disign',developer ='$developer',sales='$sales',manager='$manager'";
}
sql_query($sql);
?>
<script type="text/javascript">
	opener.document.location.reload();
	self.close();
</script>