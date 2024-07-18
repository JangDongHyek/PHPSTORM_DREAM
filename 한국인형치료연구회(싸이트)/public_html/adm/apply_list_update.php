<?php

	include_once('./_common.php');

	if(count($chk)>0){	

			for($i=0; $i<count($chk); $i++){
	
				$sql ="delete from g5_write_{$dltflg} where wr_id = {$chk[$i]}";
				sql_query($sql);				

			}

	}

	alert("삭제 되었습니다.",G5_ADMIN_URL.'/list_apply.php?flg='.$flg);

?>