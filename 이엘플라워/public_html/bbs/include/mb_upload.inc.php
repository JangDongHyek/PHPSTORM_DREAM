<?
	if(realpath($_SERVER[SCRIPT_FILENAME]) == realpath(__FILE__)) exit;

	if($del_mb_photo) 
		if(@unlink($member_photo_path.$mb_photo))
			$mb_photo = '';

	// ȸ������ ����ó��
	$file = $HTTP_POST_FILES["mb_photo"];
	if($file[size]>0) {
		$temp=explode(".",$file[name]);
		$file[ext]=$temp[count($temp)-1];
		$file[server_name] = "{$mb_num}_".rg_get_uniqid(4).".$file[ext]";
		
		if($mb_photo) {
			if(@unlink($member_photo_path.$mb_photo)) {
				$mb_photo = '';
			}
		}
		
		if(@copy($file[tmp_name], $member_photo_path.$file[server_name])) {
			$mb_photo = $file[server_name];
		} else {
		  // �Ϻ� �������� ���ε�� ������ ���� �ȵɰ�� �õ��Ѵ�.
			// 2003-10-15
			if(@move_uploaded_file($file[tmp_name], $member_photo_path.$file[server_name])) {
				$mb_photo = $file[server_name];
			} else {
				$mb_photo = '';
			}
		}
	}
	// ȸ�������� ����ó��
	if($del_mb_icon) 
		if(@unlink($member_icon_path.$mb_icon))
			$mb_icon = '';

	$file = $HTTP_POST_FILES["mb_icon"];
	if($file[size]>0) {
		$temp=explode(".",$file[name]);
		$file[ext]=$temp[count($temp)-1];
		$file[server_name] = "{$mb_num}_".rg_get_uniqid(4).".$file[ext]";
		
		if($mb_icon) {
			if(@unlink($member_icon_path.$mb_icon)) {
				$mb_icon = '';
			}
		}
		
		if(@copy($file[tmp_name], $member_icon_path.$file[server_name])) {
			$mb_icon = $file[server_name];
		} else {
		  // �Ϻ� �������� ���ε�� ������ ���� �ȵɰ�� �õ��Ѵ�.
			// 2003-10-15
			if(@move_uploaded_file($file[tmp_name], $member_icon_path.$file[server_name])) {
				$mb_icon = $file[server_name];
			} else {
				$mb_icon = '';
			}
		}
	}
?>