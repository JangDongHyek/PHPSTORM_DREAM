<?
	// ȸ������ ����ó��
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

	// ȸ�������� ����ó��
	$file = $HTTP_POST_FILES["mb_icon"];
	if($file[size]>0) {
		$temp=explode(".",$file[name]);
		$file[ext]=$temp[count($temp)-1];

		$match = eregi($file[ext],"jpg,gif");
		if(!$match) {
			$msg = str_replace ("%file_ext%", "jpg,gif", "$msg_upload_ext");
			rg_href('',$msg,'','back');
		}

		// �̹��� ũ�� üũ 
		$tmp = GetImageSize($file[tmp_name]);
		if($tmp[0] > 16 || $tmp[1] > 16) {
			rg_href('',"������ ũ��� ���μ��� 16���Ϸ� ���ּ���.",'','back');
		}
	}
?>