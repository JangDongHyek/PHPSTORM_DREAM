<? 
//게시판 목록보기에서 제목 글자수 자르기 
$rg_title_cut = rg_cut_string($rg_title,15,'...'); 
?> 

<?

$origin_thumb = false;
$new_thumb = false;

//썸네일 가로세로 크기 설정 
$thum_width = 200; //세로는 가로 비율에 따라 바뀝

// 섬네일1의 url
$rg_thum1_url = $bbs_data_url.urlencode($rg_doc_num.'$1$'.$rg_file1_name);

if($rg_file1_name && eregi('(\.jpg|\.gif)$',$rg_file1_name)){
    $origin_thumb = true;
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
	
}else {
    if (preg_match('/<img[^>]+src=["\']([^"\']+)["\']/', $rg_content, $matches)) {
        $new_thumb = true;
        $firstImageSrc = $matches[1]; // 첫 번째 이미지의 src 값
    }
}
if($l_cols % $cols == 0) {
?>

<TR> 
	<TD align=middle bgColor=#ffffff colSpan='<?=$colspan?>' height=1>
	<IMG height=1 src="<?=$skin_board_url?>blank_.gif" width="100%" border=0></TD>
</TR>
<tr bgcolor="#FFFFFF">
<?
	}
	$l_cols++;
?>
	
     <td align="center" valign="top"> 
       
    <table width="180" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><img src="<?=$skin_board_url?>/img/gallery_list_view01.gif" width="230" height="14"></td>
  </tr>
  <tr>
    <td height="100" background="<?=$skin_board_url?>/img/gallery_list_view02.gif"><div align="center"> <?=$a_list_view?>
          <table border="0" cellspacing="1" cellpadding="1" bgcolor="#e6e6e6">
            <tr>
              <td bgcolor="#FFFFFF"> 
                <a href="./view.php?bbs_id=<?=$bbs_id?>&page=<?=$page?>&doc_num=<?=$rg_doc_num?>" title="<?=$rg_title?>">

                    <?if($origin_thumb) {?>
                <img src="<?=$rg_thum1_url?>" border="0" onerror="this.src='<?=$skin_board_url?>blank_.gif'" style="cursor:hand;" vspace="2" hspace="2">
                    <?}else if($new_thumb) {?>

                    <img src="<?=$firstImageSrc?>" border="0" onerror="this.src='<?=$skin_board_url?>blank_.gif'" style="cursor:hand;width: 200px; height: 113px" vspace="2" hspace="2" style="">
                <?}?>
              </td>
            </tr>
        </table></div></td>
  </tr>
  <tr>
    <td height="30" background="<?=$skin_board_url?>/img/gallery_list_view04.gif"><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td align="center"><?=$show_chk_begin?>
          <input type=checkbox name=chk_rg_num[] value='<?=$rg_doc_num?>'>
          <?=$show_chk_end?>
          <span onClick="rg_layer('<?=$site_url?>', '<?=$bbs_id?>','<?=$mb_id?>', '<?=$rg_name?>', '<?=$rg_email_enc?>', '<?=$rg_home_url?>', '<?=$mb_open_info?>','<?=$skin_board_url?>')" style='cursor:hand;'>
          <!--<?=$rg_mb_icon?> <?=$rg_name?>-->
          </span>
         <a href="./view.php?bbs_id=<?=$bbs_id?>&page=<?=$page?>&doc_num=<?=$rg_doc_num?>" title="<?=$rg_title?>"><?=$rg_title?></a>
          <span style='font-size:8pt;'>
          <?=$rg_cmt_count?>
          </span><?
if($_SESSION['ss_mb_level'] == "10"){
	echo"($admin_orderby)";
}
?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td> <?=$a_list_view?><img src="<?=$skin_board_url?>/img/gallery_list_view05.gif" border="0" /></a></td>
  </tr>
</table>
	</td>
<? /*
	<TD align=middle class="bbs"><?=$no?></TD>
<?=$show_category_begin?>
	<td align=middle class="bbs"><?=$rg_cat_name?></td>
<?=$show_category_end?>
	<TD nowrap>
<?=$show_chk_begin?>
	<input type=checkbox name=chk_rg_num[] value='<?=$rg_doc_num?>'>
<?=$show_chk_end?>
	<?=$rg_reply?> <?=$a_list_view?><?=$rg_title?></a> <span style='font-size:8pt;'><?=$rg_cmt_count?></span> <?=$rg_new_icon?></TD></xmp></xml></font>
	<TD align=middle class="bbs"><span onClick="rg_layer('<?=$site_url?>', '<?=$bbs_id?>','<?=$mb_id?>', '<?=$rg_name?>', '<?=$rg_email_enc?>', '<?=$rg_home_url?>', '<?=$mb_open_info?>')" style='cursor:hand;'><?=$rg_mb_icon?> <?=$rg_name?></span></TD>
	<TD align=middle class="bbs"><?=$rg_reg_date?></TD>
<?=$show_download_begin?>
<TD align=middle class="bbs"><?=$rg_file1_hit?></td>
<?=$show_download_end?>
	<TD align=middle class="bbs"><?=$rg_doc_hit?></TD>
<?=$show_vote_yes_begin?>
<TD align=middle class="bbs"><?=$rg_vote_yes?></td>
<?=$show_vote_yes_end?>
<?=$show_vote_no_begin?>
<TD align=middle class="bbs"><?=$rg_vote_no?></td>
<?=$show_vote_no_end?>
</TR>
*/?>
