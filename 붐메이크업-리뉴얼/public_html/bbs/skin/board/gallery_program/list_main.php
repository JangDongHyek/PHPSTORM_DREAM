<? 
//�Խ��� ��Ϻ��⿡�� ���� ���ڼ� �ڸ��� 
$rg_title = rg_cut_string($rg_title,40,'...'); 
?> 
<?
/******************************************************************
 �� ���ϼ��� �� 
�Ϲ� �Խ��� ��Ͻ�Ų

 �� ��Ų ������ ���� ���� ���� �� 

<?=$width?> 					���̺��� ����
<?=$skin_board_url?>	��Ų URL
<?=$site_url?>				����Ʈ URL
<?=$bbs_id?>					�Խ��� ���̵�
<?=$mb_id?>						ȸ�����̶�� ȸ�����̵�
<?=$mb_open_info?>		ȸ�����̶�� ������������(ȸ������)

<?=$no?> 							������ �Խù���ȣ(����)
<?=$rg_doc_num?>			�������� �Խù���ȣ(������ �Խù���ȣ)
<?=$rg_reply?>				����� ���̿� ������
<?=$rg_title?>				����
<?=$rg_cmt_count?>		�ڸ�Ʈ ����
<?=$rg_new_icon?>			���� ������
<?=$rg_reg_date?>			�۵����
<?=$rg_name?>					����ڸ�
<?=$rg_email_enc?>		����
<?=$rg_home_url?>			Ȩ������
<?=$rg_mb_icon?>			����ڰ� ȸ���̶�� ȸ��������
<?=$rg_doc_hit?>			����ȸ��

<?=$a_list_view?>			�ۺ��� ��ũ


<?=$show_category_begin?>ī�װ�<?=$show_category_end?>
<?=$rg_cat_name?>			ī�װ���
<?=$show_chk_begin?>īƮ���(üũ�ڽ�)<?=$show_chk_end?>
<?=$show_vote_yes_begin?>��õ��<?=$show_vote_yes_end?>
<?=$rg_vote_yes?>			��õ��
<?=$show_vote_no_begin?>����õ��<?=$show_vote_no_end?>
<?=$rg_vote_no?>			����õ��

******************************************************************/
?>

<?
	//����� ���μ��� ũ�� ���� 
	$thum_width = 85; 
	$thum_height = 65; 
//	$max_filesize = 1024*1024*2;

// ������1�� url
	$rg_thum1_url = $bbs_data_url.urlencode($rg_doc_num.'$1$'.$rg_file1_name);
	$rg_thum1_width = $thum_width; 
	$rg_thum1_height = $thum_height; 

	if($rg_file1_name && eregi('(\.jpg|\.png)$',$rg_file1_name)){


		//��������� �����ְ� ���� ���̹��� �����ֱ�(�������������� ����� ����)
		if(file_exists($bbs_data_path.$rg_doc_num.'$1$'.$rg_file1_name)) {
			
			// ����1�� �������
			$rg_file1_path = $bbs_data_path.$rg_doc_num.'$1$'.$rg_file1_name;
		}else{	
			
			// ����1�� �������
			$rg_file1_path = $bbs_data_path.$rg_doc_num.'$1$th2$'.$rg_file1_name;
		}

		// ������1�� �������
		$rg_thum1_path = $bbs_data_path.$rg_doc_num.'$1$th$'.$rg_file1_name;
		// ���͸�ũ �������
		//$watermark_path = $bbs_data_path."__watermark.jpg";
		// ������1�� url
		$rg_thum1_url = $bbs_data_url.urlencode($rg_doc_num.'$1$th$'.$rg_file1_name);

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
			$rg_thum1_url = $bbs_data_url.urlencode($rg_doc_num.'$1$'.$rg_file1_name);
		}
	}

	if($l_cols % $cols == 0) {
?>

<TR> 
	<TD align=middle bgColor=#ffffff colSpan='<?=$colspan?>' height=1>
</TR>
<tr bgcolor="#FFFFFF">
<?
	}
	$l_cols++;
?>
	
   <td width="30" align="center">
   <?=$no?>
   </tD>


	 <td align="left" valign="top"> 
       <table cellpadding="0" cellspacing="0"><tr><td height="10"></td></tr></table>
    <table cellspacing="0" cellpadding="0">
      <tr>
        <td align="left" valign="bottom"> 
          <?=$a_list_view?>
          <table border="0" cellspacing="1" cellpadding="0" bgcolor="#e6e6e6">
            <tr>
              <td bgcolor="#FFFFFF"> 
                <?=$a_list_view?>
                <img src="<?=$rg_thum1_url?>" border="0" width="<?=$rg_thum1_width?>" height="<?=$rg_thum1_height?>" onerror="this.src='<?=$skin_board_url?>blank_.gif'" ('<?=$rg_file1_url?>','<?=$rg_title?>') style="cursor:hand;" vspace="4" hspace="4">
			  </td>
				
            </tr>
          </table>
        </td>
				<td align="left" valign="top"> 
				 <BR><BR>&nbsp;&nbsp; <?=$show_chk_begin?>
				  <input type=checkbox name=chk_rg_num[] value='<?=$rg_doc_num?>'>
				  <?=$show_chk_end?>
				  <span onClick="rg_layer('<?=$site_url?>', '<?=$bbs_id?>','<?=$mb_id?>', '<?=$rg_name?>', '<?=$rg_email_enc?>', '<?=$rg_home_url?>', '<?=$mb_open_info?>','<?=$skin_board_url?>')" style='cursor:hand;'>
				  <!--<?=$rg_mb_icon?> <?=$rg_name?>-->
				  </span>
				  <?=$a_list_view?>
				  <?=$rg_title?></a>
				  <span style='font-size:8pt;'>
				  <?=$rg_cmt_count?>
				  </span>
				</td>
			</tr>

			<tr>
          
        <td height=15 align=center></td>
      </tr>
		</table>
		
	</td>
	<td width="40">
		<?=$rg_doc_hit?>
	</td>
	<td width="80">
		<?=$rg_reg_date?>
	</td>
<TR> 
		<TD height=1 colSpan='7' align=middle background="<?=$skin_board_url?>images/dot_line.gif" ></TD>
	</TR>