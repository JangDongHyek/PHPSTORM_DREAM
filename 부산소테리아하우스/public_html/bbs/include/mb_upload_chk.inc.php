<?
	// 회원사진 파일처리
	$file = $HTTP_POST_FILES["mb_photo"];
	if($file[size]>0) {
		$temp=explode(".",$file[name]);
		$file[ext]=$temp[count($temp)-1];
		
		$match = eregi($file[ext],"jpg,gif");
		if(!$match) {
			$msg = str_replace ("%file_ext%", "jpg,gif", "$msg_upload_ext");
			rg_href('',$msg,'','back');
		}
	}

	// 회원아이콘 파일처리
	$file = $HTTP_POST_FILES["mb_icon"];
	if($file[size]>0) {
		$temp=explode(".",$file[name]);
		$file[ext]=$temp[count($temp)-1];

		$match = eregi($file[ext],"jpg,gif");
		if(!$match) {
			$msg = str_replace ("%file_ext%", "jpg,gif", "$msg_upload_ext");
			rg_href('',$msg,'','back');
		}

		// 이미지 크기 체크 
		$tmp = GetImageSize($file[tmp_name]);
		if($tmp[0] > 16 || $tmp[1] > 16) {
			rg_href('',"아이콘 크기는 가로세로 16이하로 해주세요.",'','back');
		}
	}
?>