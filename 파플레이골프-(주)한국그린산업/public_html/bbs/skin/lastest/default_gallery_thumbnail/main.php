<?	//썸네일 가로세로 크기 설정 
	$thum_width = 110; 
	$thum_height = 55; 

  if($rg_file1_name && eregi('(\.gif|\.jpg|\.png)$',$rg_file1_name)){
		
		
		//썸네일있음 보여주고 없음 본이미지 보여주기(사이즈작은놈은 썸네일 없음)
	if(file_exists($bbs_data_path.$rg_doc_num.'$1$'.$rg_file1_name)) {
		
		// 파일1의 서버경로
		$rg_file1_path = $bbs_data_path.$rg_doc_num.'$1$'.$rg_file1_name;
	}else{	
		
		// 파일1의 서버경로
		$rg_file1_path = $bbs_data_path.$rg_doc_num.'$1$th2$'.$rg_file1_name;
	}

		// 섬네일1의 서버경로
		$rg_thum1_path = $bbs_data_path.$rg_doc_num.'$1$th$'.$rg_file1_name;
		// 섬네일1의 url
		//$rg_thum1_url = $bbs_data_url.$rg_doc_num.'$1$th$'.$rg_file1_name;

		$rg_thum1_url = $bbs_data_url.urlencode($rg_doc_num.'$1$th$'.$rg_file1_name);

		if(file_exists($rg_file1_path))
		{
			//썸네일 이미지 크기 가로세로 비율 조정 
			$rg_file1_info = getimagesize($rg_file1_path); 
			$rg_file1_width = $rg_file1_info[0]; 
			$rg_file1_height = $rg_file1_info[1]; 
			if($rg_file1_width > $rg_file1_height) { 
				$rg_thum1_width = $thum_width; 
				$rg_thum1_height = ceil($rg_thum1_width/$rg_file1_width * $rg_file1_height); 
			} else { 
				$rg_thum1_height = $thum_height; 
				$rg_thum1_width = ceil($rg_thum1_height/$rg_file1_height * $rg_file1_width); 
			} 
					
			// 썸네일이 없다면 생성한다.
			if(!file_exists($rg_thum1_path)) {
				thumbnailImageCreate($rg_file1_path, $rg_thum1_path, $rg_thum1_width, $rg_thum1_height);
			}
		}
	} else {
		// 섬네일1의 url
		$rg_thum1_url = '';
		$rg_thum1_width = $thum_width; 
		$rg_thum1_height = $thum_height; 
	}
?>
	<td valign="top" align="center">
		<table style="table-layout:fixed" width="100%">
			<tr>
				<td align="center">
				<table width="<?=$thum_width?>" height="<?=$thum_height?>" border="0" cellpadding="2" cellspacing="1" bgcolor="#E3E3E3"><td align="center" valign="middle" bgcolor="#FFFFFF">
				<?=$a_list?><img src="<?=$rg_thum1_url?>" width="110" height="70" hspace="1" vspace="1" border="0" onerror="this.src='<?=$skin_lastest_url?>blank_.gif'"></a></td></table></td>
			</tr>
			<tr>
				<td nowrap align="center">
				<?=$a_list?> <?=$rg_title?> <?=$rg_new_icon?></a>
				</td>
			</tr>
		</table>	
	</td>
