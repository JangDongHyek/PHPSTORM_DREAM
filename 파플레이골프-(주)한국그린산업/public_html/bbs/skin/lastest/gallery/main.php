<?
/*
<?=$rg_mb_icon?> 
<?=$rg_reg_date?>
*/?>
<?	//썸네일 가로세로 크기 설정 
	$thum_width = 90; 
	$thum_height = 73;
	$max_filesize = 1024*1024*2;	

	// 섬네일1의 url
	$rg_thum1_url = '';
	$rg_thum1_width = $thum_width; 
	$rg_thum1_height = $thum_height; 

	if($rg_file1_name && eregi('(\.gif|\.jpg|\.png)$',$rg_file1_name)){

		// 파일1의 서버경로
		$rg_file1_path = $bbs_data_path.$rg_doc_num.'$1$'.$rg_file1_name;
		// 섬네일1의 서버경로
		$rg_thum1_path = $bbs_data_path.$rg_doc_num.'$1$latest_th$'.$rg_file1_name;
		// 섬네일1의 url
		$rg_thum1_url = $bbs_data_url.urlencode($rg_doc_num.'$1$latest_th$'.$rg_file1_name);

		if(file_exists($rg_file1_path))
		{
			//썸네일 이미지 크기 가로세로 비율 조정 
			$rg_file1_info = getimagesize($rg_file1_path);
			$rg_file1_width = $rg_file1_info[0]; 
			$rg_file1_height = $rg_file1_info[1];
		}else
		{
			$rg_file1_width = 0;
			$rg_file1_height = 0;
		}

		if(($rg_file1_width * $rg_file1_height) < 5800000 && ($rg_file1_info[2] != 1))
		{
			if($rg_file1_width > $rg_file1_height) { 
				$rg_thum1_width = $thum_width; 
				$rg_thum1_height = ceil($rg_thum1_width/$rg_file1_width * $rg_file1_height); 
			} else { 
				$rg_thum1_height = $thum_height; 
				$rg_thum1_width = ceil($rg_thum1_height/$rg_file1_height * $rg_file1_width); 
			}

			// 썸네일이 없다면 생성한다.
			if(!file_exists($rg_thum1_path)) {
				$arr_error = thumbnailImageCreate($rg_file1_path, $rg_thum1_path, $rg_thum1_width, $rg_thum1_height, 100);
			}
		} else {
			// 섬네일1의 url
			$rg_thum1_url = $bbs_data_url.urlencode($rg_doc_num.'$1$'.$rg_file1_name);
		}
	}
?>
<td valign="top" align="center">
	<TABLE WIDTH=111 BORDER=0 align="center" CELLPADDING=0 CELLSPACING=0>
		<TR>
			<TD COLSPAN=3>
				<IMG SRC="<?=$skin_lastest_url?>images/gallery_1.gif" WIDTH=111 HEIGHT=5 ALT=""></TD>
		</TR>
		<TR>
			<TD width="6">
				<IMG SRC="<?=$skin_lastest_url?>images/gallery_2.gif" WIDTH=6 HEIGHT=75 ALT=""></TD>
			<TD width="98"><div align="center"><?=$a_list?><img src="<?=$rg_thum1_url?>" width="<?=$rg_thum1_width?>" height="<?=$rg_thum1_height?>" hspace="1" vspace="1" border="0" onerror="this.src='<?=$skin_lastest_url?>blank_.gif'"></a></div></TD>
			<TD width="7">
				<IMG SRC="<?=$skin_lastest_url?>images/gallery_4.gif" WIDTH=7 HEIGHT=75 ALT=""></TD>
		</TR>
		<TR>
			<TD COLSPAN=3>
				<IMG SRC="<?=$skin_lastest_url?>images/gallery_5.gif" WIDTH=111 HEIGHT=6 ALT=""></TD>
		</TR>
		<TR>
			<TD height="20" COLSPAN=3><div align="center" class="text style1"><?=$a_list?> <?=$rg_title?> <?=$rg_new_icon?></div></TD>
		</TR>
	</TABLE>
</td>
