<? 
//�Խ��� ��Ϻ��⿡�� ���� ���ڼ� �ڸ��� 
$rg_title_cut = rg_cut_string($rg_title,15,'...'); 
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
$rg_content=str_replace("<br />","<BR>",nl2br($rg_content));
if($_SESSION[ss_mb_level]==10){
	
	$a_list_view=$a_list_view;
	$a_list_end="</a>";
}else{
	$a_list_view="";
	$a_list_end="";
}
?>
	<?=$a_list_view?>
	<tr>
		<td>
					<table border="0" cellpadding="0" cellspacing="1" align="center" bgcolor="#cccccc">
						<tr>
							<td valign="middle" align="center" bgcolor="#ffffff" width="130">
							<?
								if($rg_file1_name){
							?>
							<a href="javascript:img_new_window('<?=$rg_thum1_url?>','<?=$rg_title?>')"><img src="<?=$rg_thum1_url?>" width="130" border="0" onerror="this.src=_blank.gif"><?=$a_list_end?>
							<? }?>
							</td>
							<td valign="top" align="left" bgcolor="#ffffff" style="padding-left:15px;padding-top:15px;TABLE-layout:fixed">
								<table width="180" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><?=$a_list_view?><span style="color:#315fb7;font-weight:bold;font-size:20px"><?=$rg_title?></span><?=$a_list_end?></td>
									</tr>
									<tr>
										<td  style="word_break;font-size:17px;line-height:20px"><div style="width:180px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;clear:both"><?=$a_list_view?><?=$rg_ext1?><?=$a_list_end?></div></td>
									</tr>
									<tr>
										<td  style="word_break;font-size:17px;line-height:20px"><div style="word_break;width:180px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;clear:both"><?=$a_list_view?><?=$rg_ext2?><?=$a_list_end?></div></td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
			</td>
		</tr>
		<?=$a_list_end?>
		<tr>
			<TD height="15"></TD>
		</tr>

				
				
				
		