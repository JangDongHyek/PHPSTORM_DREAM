<?
/*
<?=$rg_mb_icon?> 
<?=$rg_reg_date?>
*/?>
<?	//����� ���μ��� ũ�� ���� 
	$thum_width = 80; 
	$thum_height = 80; 

  if($rg_file1_name && eregi('(\.gif|\.jpg|\.png)$',$rg_file1_name)){
		// ����1�� �������
		$rg_file1_path = $bbs_data_path.$rg_doc_num.'$1$'.$rg_file1_name;
		// ������1�� �������
		$rg_thum1_path = $bbs_data_path.$rg_doc_num.'$1$th$'.$rg_file1_name;
		// ������1�� url
		$rg_thum1_url = $bbs_data_url.$rg_doc_num.'$1$th$'.$rg_file1_name;

		if(file_exists($rg_file1_path))
		{
			//����� �̹��� ũ�� ���μ��� ���� ���� 
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
					
			// ������� ���ٸ� �����Ѵ�.
			if(!file_exists($rg_thum1_path)) {
				thumbnailImageCreate($rg_file1_path, $rg_thum1_path, $rg_thum1_width, $rg_thum1_height);
			}
		}
	} else {
		// ������1�� url
		$rg_thum1_url = '';
		$rg_thum1_width = $thum_width; 
		$rg_thum1_height = $thum_height; 
	}
?>
	<td valign="top" align="center">
		<table style="table-layout:fixed" width="100%">
			<tr>
				<td align="center">
				<table border="0" cellpadding="0" cellspacing="0" width="<?=$thum_width?>" height="<?=$thum_height?>"><td align="center" valign="middle">
				<?=$a_list?><img src="<?=$rg_thum1_url?>" width="<?=$rg_thum1_width?>" height="<?=$rg_thum1_height?>" hspace="1" vspace="1" border="0" onerror="this.src='<?=$skin_lastest_url?>blank_.gif'"></a></td></table></td>
			</tr>
			<tr>
				<td nowrap align="center">
				<?=$a_list?> <?=$rg_title?> <?=$rg_new_icon?></a>
				</td>
			</tr>
		</table>	
	</td>