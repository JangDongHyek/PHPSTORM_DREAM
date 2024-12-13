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
  <TR bgcolor="#B6C232"> 
    <TD height=2></TD>
  </TR>
  </TABLE>
  
<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0 style="table-layout:fixed">
  <TR bgcolor=#FFFFFF height=21> 
    <TD width=12% bgcolor=F6F7E3 height="35"> 
      <div align="right">&nbsp;<img src="<?=$skin_board_url?>images/view_01.gif" width="28" height="14" />&nbsp;<img src="<?=$skin_board_url?>images/head_img09.gif" border=0></div>
    </TD>
    <TD colspan="3" style='padding-left:10;' height="35"> 
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td><font color=#000000><b> 
            <?=$rg_title?>
            </b></font></td>
          <td> 
            <div align="right" style='padding-right:20;'><font color=#000000><font color="#999999">[ 
              <?=$rg_reg_date?>
              ] </font></font></div>
          </td>
        </tr>
      </table>
    </TD>
  </TR>
  <TR bgcolor=#e7e7e7> 
    <TD height="1" colspan="4"></TD>
  </TR>
  <TR bgcolor=#FFFFFF > 
    <TD bgcolor=F6F7E3 height="35"> 
      <div align="right"><img src="<?=$skin_board_url?>images/list_03.gif" width="29" height="12" />&nbsp;&nbsp;<img src="<?=$skin_board_url?>images/head_img09.gif" border=0></div>
    </TD>
    <TD colspan="3" style='padding-left:10;' height=21><span onClick="rg_layer('<?=$site_url?>', '<?=$bbs_id?>','<?=$mb_id?>', '<?=$rg_name?>', '<?=$rg_email_enc?>', '<?=$rg_home_url?>', '<?=$mb_open_info?>')" style='cursor:hand;'> 
      </span> 
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td><span onClick="rg_layer('<?=$site_url?>', '<?=$bbs_id?>','<?=$mb_id?>', '<?=$rg_name?>', '<?=$rg_email_enc?>', '<?=$rg_home_url?>', '<?=$mb_open_info?>')" style='cursor:hand;'> 
            <?=$rg_mb_icon?>
            <?=$rg_name?>
            </span></td>
          <td style='padding-right:20;'> 
            <div align="right">조회수: 
              <?=$rg_doc_hit?>
              &nbsp; &nbsp; 
              <?=$show_vote_yes_begin?>
              추천: 
              <?=$rg_vote_yes?>
              <?=$show_vote_yes_end?>
              &nbsp; &nbsp; 
              <?=$show_vote_no_begin?>
              비추천: 
              <?=$rg_vote_no?>
              <?=$show_vote_no_end?>
            </div>
          </td>
        </tr>
      </table>
    </TD>
  </TR>
  <?=$show_home_begin?>
  <TR bgcolor=#FFFFFF height=35> 
    <TD bgcolor=F6F7E3 height=35> 
      <div align="right"><img src="<?=$skin_board_url?>images/list_06.gif" width="31"  />&nbsp;&nbsp;<img src="<?=$skin_board_url?>images/head_img09.gif" border=0></div>
    </TD>
    <TD colspan=3 style='padding-left:10;' height=21><?=$rg_doc_hit?></TD>
  </TR>
  <?=$show_home_end?>
  <?=$show_file1_begin?>
  <TR bgcolor=#FFFFFF height=21> 
    <TD bgcolor=F6F7E3 height=21> 
      <div align="right"><img src="<?=$skin_board_url?>images/list_07.gif" width="21" height="13" /> #1&nbsp;&nbsp;<img src="<?=$skin_board_url?>images/head_img09.gif" border=0></div>
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
    <TD bgcolor=F6F7E3 height=21> 
      <div align="right"><img src="<?=$skin_board_url?>images/list_07.gif" width="21" height="13" /> #2 &nbsp;&nbsp;<img src="<?=$skin_board_url?>images/head_img09.gif" border=0></div>
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
    <TD bgcolor=F6F7E3 height=21> 
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
    <TD bgcolor=F6F7E3 height=21> 
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

        <p>성명 : <?=$data['rg_name']?> </p>
        <p>생년월일 : <?=$data['birth']?> </p>
        <p>주소 : <?=$data['address1']?> <?=$data['address2']?> </p>
        <p>소속 기관명 : <?=$data['belong']?> </p>
        <p>휴대폰 : <?=$data['phone']?> </p>
        <p>근무형태 : <?=$data['work_type']?> </p>
        <p>신청 교육일 : <?=$data['request_date']?> </p>
        <p>교육시간 : <?=$data['work_time']?> </p>
        <p>남기고 싶은말 : <?=$data['rg_content']?> </p>


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