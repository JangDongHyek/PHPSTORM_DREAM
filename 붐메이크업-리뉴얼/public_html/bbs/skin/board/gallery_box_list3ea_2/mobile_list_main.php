<? 
//�Խ��� ��Ϻ��⿡�� ���� ���ڼ� �ڸ��� 
//$rg_title_cut = rg_cut_string($rg_title,15,'...'); 
?> 



<?
	//����� ���μ��� ũ�� ���� 
	$thum_width = 70; 
	$thum_height = 94; 
//	$max_filesize = 1024*1024*2;

// ������1�� url
	$rg_thum1_url = $bbs_data_url.urlencode($rg_doc_num.'$1$th2$'.$rg_file1_name);
	$rg_thum1_width = $thum_width; 
	$rg_thum1_height = $thum_height; 

	if($rg_file1_name && eregi('(\.jpg|\.png)$',$rg_file1_name)){


		//��������� �����ְ� ���� ���̹��� �����ֱ�(�������������� ����� ����)
		if(file_exists($bbs_data_path.$rg_doc_num.'$1$th2$'.$rg_file1_name)) {
			
			// ����1�� �������
			$rg_file1_path = $bbs_data_path.$rg_doc_num.'$1$th2$'.$rg_file1_name;
		}else{	
			
			// ����1�� �������
			$rg_file1_path = $bbs_data_path.$rg_doc_num.'$1$th2$'.$rg_file1_name;
		}

		// ������1�� �������
		$rg_thum1_path = $bbs_data_path.$rg_doc_num.'$1$th2$'.$rg_file1_name;
		// ���͸�ũ �������
		//$watermark_path = $bbs_data_path."__watermark.jpg";
		// ������1�� url
		$rg_thum1_url = $bbs_data_url.urlencode($rg_doc_num.'$1$th2$'.$rg_file1_name);

		if(file_exists($rg_file1_path))
		{
			//����� �̹��� ũ�� ���μ��� ���� ���� 
			$rg_file1_info = getimagesize($rg_file1_path);
			$rg_file1_width = $rg_file1_info[0]; 
			$rg_file1_height = $rg_file1_info[1];
		}else
		{
			$rg_file1_width = 0;
			$rg_file1_height = 0;
		}

//		echo "$rg_thum1_url";
//		echo "<br>$rg_file1_width";
//		echo "<br>$rg_file1_height";
//		exit;
// && filesize($rg_file1_path) < $max_filesize)
		
		if(($rg_file1_width * $rg_file1_height) < 5800000 && ($rg_file1_info[2] != 1))
		{
			if($rg_file1_width > $rg_file1_height) { 
				$rg_thum1_width = $thum_width; 
				$rg_thum1_height = ceil($rg_thum1_width/$rg_file1_width * $rg_file1_height); 
			} else { 
				$rg_thum1_height = $thum_height; 
				$rg_thum1_width = ceil($rg_thum1_height/$rg_file1_height * $rg_file1_width); 
			}
					
			// ������� ���ٸ� �����Ѵ�.
			if(!file_exists($rg_thum1_path)) {
				$arr_error = thumbnailImageCreate($rg_file1_path, $rg_thum1_path, $rg_thum1_width, $rg_thum1_height, 100);
			}
		} else {
			// ������1�� url
			$rg_thum1_url = $bbs_data_url.urlencode($rg_doc_num.'$1$th2$'.$rg_file1_name);
		}
	}

	$l_cols++;
?>
				<div style="display:none">
                  <?=$rg_thum1_url?>
                  <div style="display:none"><?=$rg_title?></div>
                </div>
				<? /*?><!-- Thumbnails -->
				<a href="#" onclick="showPreview('<?=$rg_thum1_url?>','<?=$l_cols?>');return false"> <img src="<?=$rg_thum1_url?>" border="0" onerror="this.src='<?=$skin_board_url?>blank_.gif'" style="cursor:hand;" vspace="2" hspace="2" width="<?=$thum_width?>" height="55"></a>		
			
				<!-- End thumbnails -->
				
				<!-- Image captions -->	
				<div class="imageCaption">
					<span style="font-size:14px;font-weight:bold"><?=$rg_title?><br>
					<?=$show_write_begin?><?=$a_write?><IMG src="<?=$skin_board_url?>images/write.gif" border=0></a><?=$show_write_end?>
					<?=$show_edit_begin?>
					<a href="mobile_edit.php?mode=edit&bbs_id=<?=$bbs_id?>&page=<?=$page?>&doc_num=<?=$rg_doc_num?>">
					<IMG src="<?=$skin_board_url?>images/modify.gif" border=0></a><?=$show_edit_end?>
					<?=$show_delete_begin?>
					<a href="mobile_delete.php?bbs_id=<?=$bbs_id?>&page=<?=$page?>&doc_num=<?=$rg_doc_num?>">
					<IMG src="<?=$skin_board_url?>images/delete.gif" border=0></a><?=$show_delete_end?>
					</span>
				</div>
				<div id="img<?=$l_cols?>" style="display:none"><?=$rg_file1_url?></div>
				<div id="title<?=$l_cols?>" style="display:none">
					<span style="font-size:14px;font-weight:bold"><?=$rg_title?></span>
					<br>
					<?=$show_write_begin?><?=$a_write?><IMG src="<?=$skin_board_url?>images/write.gif" border=0></a><?=$show_write_end?>
					<?=$show_edit_begin?>
					<a href="mobile_edit.php?mode=edit&bbs_id=<?=$bbs_id?>&page=<?=$page?>&doc_num=<?=$rg_doc_num?>">
					<IMG src="<?=$skin_board_url?>images/modify.gif" border=0></a><?=$show_edit_end?>
					<?=$show_delete_begin?>
					<a href="mobile_delete.php?bbs_id=<?=$bbs_id?>&page=<?=$page?>&doc_num=<?=$rg_doc_num?>">
					<IMG src="<?=$skin_board_url?>images/delete.gif" border=0></a><?=$show_delete_end?>
				</div>
				<!-- End image captions -->
				<? */?>
				
				
		