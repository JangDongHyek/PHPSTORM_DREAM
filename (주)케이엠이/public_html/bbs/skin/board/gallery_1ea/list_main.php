<? 
//게시판 목록보기에서 제목 글자수 자르기 
$rg_title_cut = rg_cut_string($rg_title,15,'...'); 
?> 

<?
//썸네일 가로세로 크기 설정 
$thum_width = 270; //세로는 가로 비율에 따라 바뀝

// 섬네일1의 url
$rg_thum1_url = $bbs_data_url.urlencode($rg_doc_num.'$1$'.$rg_file1_name);

if($rg_file1_name && eregi('(\.jpg|\.gif)$',$rg_file1_name)){


	// 파일1의 서버경로
	$rg_file1_path = $bbs_data_path.$rg_doc_num.'$1$'.$rg_file1_name;

	// 섬네일1의 서버경로
	$rg_thum1_path = $bbs_data_path.$rg_doc_num.'$1$th$'.$rg_file1_name;

	// 섬네일1의 url
	$rg_thum1_url = $bbs_data_url.urlencode($rg_doc_num.'$1$th$'.$rg_file1_name);


	// 썸네일이 없다면 생성한다.
	if(!file_exists($rg_thum1_path)) {
		MakeThum_Gall_List($rg_doc_num,"1",$bbs_id,$rg_file1_name,$thum_width);
	}
	
}
if($l_cols != 0){
if($l_cols % $cols == 0) {
?>

<TR> 
	<TD align=middle bgColor=#ffffff colSpan='3' height=8>
	<IMG height=1 src="<?=$skin_board_url?>blank_.gif" width="100%" border=0></TD>
</TR>
<tr bgcolor="#FFFFFF">
<?
}
}
	$l_cols++;
?>
	
     <td width="100%" align="center" valign="top" colspan="3">

	
	<table width="100%" cellpadding=0 cellspacing=1 border=0 bgcolor="#DDDDDD">
	<tr>
		<td width="100%" bgcolor="#FFFFFF">
		<table width="100%" cellpadding=6 cellspacing=0 border=0>
		<tr>
			<td height="10" colspan="2"></td>
		</tr>
		<tr>
			<td width="300" rowspan="2" align="center"><a href="./view.php?bbs_id=<?=$bbs_id?>&page=<?=$page?>&doc_num=<?=$rg_doc_num?>" title="<?=$rg_title?>"><img src="<?=$rg_thum1_url?>" width="270" border="0" onerror="this.src='<?=$skin_board_url?>blank_.gif'" style="cursor:pointer;" /></a></td>
			<td valign="top" align="left"><span style="font-size:14pt; color:#0093D5; line-height:55px"><?=$rg_title?></span><BR><?=nl2br($rg_ext1)?></td>
		</tr>
		<tr>
			<td align="right" valign="bottom"><a href="./view.php?bbs_id=<?=$bbs_id?>&page=<?=$page?>&doc_num=<?=$rg_doc_num?>"><img src="../images/sub/detail.gif" align="absmiddle" border=0 /></a></td>
		</tr>
		<tr>
			<td height="10" colspan="2"></td>
		</tr>
		</table>
		</td>
	</tr>
	</table>
	</td>