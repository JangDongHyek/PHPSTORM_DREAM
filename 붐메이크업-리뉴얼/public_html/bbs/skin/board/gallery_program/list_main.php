<? 
//게시판 목록보기에서 제목 글자수 자르기 
$rg_title = rg_cut_string($rg_title,40,'...'); 
?> 
<?
/******************************************************************
 ★ 파일설명 ★ 
일반 게시판 목록스킨

 ★ 스킨 제작을 위한 변수 설명 ★ 

<?=$width?> 					테이블의 넓이
<?=$skin_board_url?>	스킨 URL
<?=$site_url?>				사이트 URL
<?=$bbs_id?>					게시판 아이디
<?=$mb_id?>						회원글이라면 회원아이디
<?=$mb_open_info?>		회원글이라면 정보공개여부(회원정보)

<?=$no?> 							논리적인 게시물번호(순서)
<?=$rg_doc_num?>			물리적인 게시물번호(디비상의 게시물번호)
<?=$rg_reply?>				응답글 깊이와 아이콘
<?=$rg_title?>				제목
<?=$rg_cmt_count?>		코멘트 갯수
<?=$rg_new_icon?>			새글 아이콘
<?=$rg_reg_date?>			글등록일
<?=$rg_name?>					등록자명
<?=$rg_email_enc?>		메일
<?=$rg_home_url?>			홈페이지
<?=$rg_mb_icon?>			등록자가 회원이라면 회원아이콘
<?=$rg_doc_hit?>			글조회수

<?=$a_list_view?>			글보기 링크


<?=$show_category_begin?>카테고리<?=$show_category_end?>
<?=$rg_cat_name?>			카테고리명
<?=$show_chk_begin?>카트사용(체크박스)<?=$show_chk_end?>
<?=$show_vote_yes_begin?>추천수<?=$show_vote_yes_end?>
<?=$rg_vote_yes?>			추천수
<?=$show_vote_no_begin?>비추천수<?=$show_vote_no_end?>
<?=$rg_vote_no?>			비추천수

******************************************************************/
?>

<?
	//썸네일 가로세로 크기 설정 
	$thum_width = 85; 
	$thum_height = 65; 
//	$max_filesize = 1024*1024*2;

// 섬네일1의 url
	$rg_thum1_url = $bbs_data_url.urlencode($rg_doc_num.'$1$'.$rg_file1_name);
	$rg_thum1_width = $thum_width; 
	$rg_thum1_height = $thum_height; 

	if($rg_file1_name && eregi('(\.jpg|\.png)$',$rg_file1_name)){


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
		// 워터마크 서버경로
		//$watermark_path = $bbs_data_path."__watermark.jpg";
		// 섬네일1의 url
		$rg_thum1_url = $bbs_data_url.urlencode($rg_doc_num.'$1$th$'.$rg_file1_name);

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
					
			// 썸네일이 없다면 생성한다.
			if(!file_exists($rg_thum1_path)) {
				$arr_error = thumbnailImageCreate($rg_file1_path, $rg_thum1_path, $rg_thum1_width, $rg_thum1_height, 100);
			}
		} else {
			// 섬네일1의 url
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