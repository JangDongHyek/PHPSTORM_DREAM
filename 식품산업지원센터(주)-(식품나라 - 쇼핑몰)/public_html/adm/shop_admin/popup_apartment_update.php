<?php
	include_once("./_common.php");
	for($i=0;$i<count($apartment_name);$i++){
		$path = G5_DATA_URL . "/apartment/";
		$apartment_photo = $old_apartment_photo[$i];
		if($photo_remove[$i]){
			unlink($path.$old_apartment_photo[$i]);
			$apartment_photo="";
		}
		if($_FILES['apartment_photo']['name'][$i]) {
				
			$dotIndexOf = strpos($_FILES['apartment_photo']['name'][$i], ".") + 1;
			$imgLength = strlen($_FILES['apartment_photo']['name'][$i]);
			$ext = strtolower(substr($_FILES['apartment_photo']['name'][$i], $dotIndexOf, $imgLength));//확장자
			$uploadPath = G5_DATA_PATH . "/apartment/";
			$apartment_photo = $i.date("YmdHis").".".$ext;
			if (!move_uploaded_file($_FILES['apartment_photo']['tmp_name'][$i], $uploadPath . $apartment_photo)) {
				
			} else {	
			}	
		}else{
			
		}
		

		if($idx[$i]==""){
			if($apartment_name[$i]){
				$sql="insert apartment set apartment_name='$apartment_name[$i]',apartment_photo='$apartment_photo'";
			}
		}else{
			$sql="update apartment set apartment_name='$apartment_name[$i]',apartment_photo='$apartment_photo' where idx='$idx[$i]'";
		}

		
		
		sql_query($sql);
	}
	goto_url("./popup_apartment.php");
?>