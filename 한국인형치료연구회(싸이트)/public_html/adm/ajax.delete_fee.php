<?php

	include_once('./_common.php');

	if(count($idx)>0){
				
				for($i=0; $i<count($idx); $i++){

						$sql ="delete from g5_member_annualfee where idx = {$idx[$i]}";
						sql_query($sql);

				}
						
	}

?>