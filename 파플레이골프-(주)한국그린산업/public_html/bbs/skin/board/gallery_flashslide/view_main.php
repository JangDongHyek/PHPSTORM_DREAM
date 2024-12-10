<TABLE cellSpacing=0 cellPadding=0 width="<?=$width?>" border=0>
<TR> 
	<TD align=right>
    <?=$show_prev_begin?><?=$a_prev?><img src="<?=$skin_board_url?>images/prev.gif" border=0></a><?=$show_prev_end?>
    <?=$show_next_begin?><?=$a_next?><img src="<?=$skin_board_url?>images/next.gif" border=0></a><?=$show_next_end?>
	</TD>
</TR>


<TR>
	<TD bgColor=#CCCCCC>
	
	
<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0 style="table-layout:fixed">
  <TR bgcolor="#999999"> 
    <TD height=2></TD>
  </TR>
  </TABLE>
  
<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0 style="table-layout:fixed">
  <?=$show_file1_begin?>
  <TR bgcolor=#FFFFFF height=21> 
    <TD bgcolor=#ffffff height=21> 
      <div align="right">다운로드 #1&nbsp;&nbsp;<img src="<?=$skin_board_url?>images/head_img09.gif" border=0></div>
    </TD>
    <TD colspan=3 style='padding-left:10;' height=21> 
      <?=$a_file1?>
      <?=$rg_file1_name?>
      ( 
      <?=$rg_file1_size?>
      )</a>, Down: 
      <?=$rg_file1_hit?>
    </TD>
  </TR>
  <?=$show_file1_end?>
  <?=$show_file2_begin?>
  <TR bgcolor=#FFFFFF height=21> 
    <TD bgcolor=#ffffff height=21> 
      <div align="right">다운로드 #2 &nbsp;&nbsp;<img src="<?=$skin_board_url?>images/head_img09.gif" border=0></div>
    </TD>
    <TD colspan=3 style='padding-left:10;' height=21> 
      <?=$a_file2?>
      <?=$rg_file2_name?>
      ( 
      <?=$rg_file2_size?>
      )</a>, Down: 
      <?=$rg_file2_hit?>
    </TD>
  </TR>
  <?=$show_file2_end?>
  <?=$show_link1_begin?>
  <TR bgcolor=#FFFFFF height=21> 
    <TD bgcolor=#ffffff height=21> 
      <div align="right">링크 #1&nbsp;&nbsp;<img src="<?=$skin_board_url?>images/head_img09.gif" border=0></div>
    </TD>
    <TD colspan=3 style='padding-left:10;' height=21> 
      <?=$a_link1?>
      <?=$rg_link1_url?></a>
      , Hit: 
      <?=$rg_link1_hit?>
    </TD>
  </TR>
  <?=$show_link1_end?>
  <?=$show_link2_begin?>
  <TR bgcolor=#FFFFFF height=21> 
    <TD bgcolor=#ffffff height=21> 
      <div align="right">링크 #2&nbsp;&nbsp;<img src="<?=$skin_board_url?>images/head_img09.gif" border=0></div>
    </TD>
    <TD colspan=3 style='padding-left:10;' height=21> 
      <?=$a_link2?>
      <?=$rg_link2_url?></a>
      , Hit: 
      <?=$rg_link2_hit?>
    </TD>
  </TR>
  <?=$show_link2_end?>
      <TR bgcolor=#e7e7e7> 
    <TD height="1" colspan="4"></TD>
  </TR>
  <TR bgcolor=#FFFFFF> <TD colspan=4 style='padding:15;' class="bbs" style='word-break:break-all' id="contents">
    <?=$show_ext1_begin?>
    <?=$show_ext1_title?>
    : 
    <?=$rg_ext1?>
    <br>
    <?=$show_ext1_end?>
    <?=$show_ext2_begin?>
    <?=$show_ext2_title?>
    : 
    <?=$rg_ext2?>
    <br>
    <?=$show_ext2_end?>
    <?=$show_ext3_begin?>
    <?=$show_ext3_title?>
    : 
    <?=$rg_ext3?>
    <br>
    <?=$show_ext3_end?>
    <?=$show_ext4_begin?>
    <?=$show_ext4_title?>
    : 
    <?=$rg_ext4?>
    <br>
    <?=$show_ext4_end?>
    <?=$show_ext5_begin?>
    <?=$show_ext5_title?>
    : 
    <?=$rg_ext5?>
    <br>
    <?=$show_ext5_end?>

    <?=$show_file1_view_begin?>


	<?
	$rg_file1_path = $bbs_data_path.$rg_file1_name;
	$rg_file2_path = $bbs_data_path.$rg_file2_name;
	?>

    <p align='center'>순서:<?=$admin_orderby?></p>


    <p align='center'><img src="<?=$rg_file1_path?>" border="0" onerror="this.src='<?=$skin_board_url?>blank_.gif'" id=img_file1></p>
   
    <br>
    <?=$show_file1_view_end?>
    <?=$show_file2_view_begin?>
	<p align="center"><img src="<?=$rg_file2_path?>" border="0" onerror="this.src='<?=$skin_board_url?>blank_.gif'" id=img_file2></p> 
    
    <br>
    <?=$show_file2_view_end?>
    <br>
    <TR bgcolor=#e7e7e7> 
    <TD height="1" colspan="4"></TD>
  </TR>
    <?=$show_signature_begin?>
    <div id="Layer1" style="width:100%; height:100px; overflow: hidden;word-break:break-all;background-color:#F7F7F7;layer-background-color:#F7F7F7;"> 
      <p style="margin:5;"> 
        <?=$mb_signature?>
    </div></div>
    <?=$show_signature_end?>
    <!-- 테러 태그 방지용 --></xml></xmp>
    <a href=""></a><a href=''></a> </TD></TR>
</TABLE>
	</TD>
</TR>
<TR>
	<TD height=5></TD>
</TR>
